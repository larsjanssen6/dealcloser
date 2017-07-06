<?php

namespace App\Http\Controllers\Settings\User;

use App\Dealcloser\Interfaces\Repositories\IDepartmentRepo;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\User\ProfileRequest;
use Illuminate\Support\Facades\Auth;

class SettingsProfileController extends Controller
{
    /**
     * IUserRepo implementation
     *
     * @var IUserRepo
     */
    private $userRepo;

    /**
     * IDepartmentRepo implementation
     *
     * @var IUserRepo
     */
    private $departmentRepo;

    /**
     * Create a new controller instance. Only users with permission
     * register-users have access to this controller.
     *
     * @param IUserRepo $userRepo
     * @param IDepartmentRepo $departmentRepo
     */
    public function __construct(IUserRepo $userRepo, IDepartmentRepo $departmentRepo)
    {
        $this->userRepo = $userRepo;
        $this->departmentRepo = $departmentRepo;
    }

    /**
     * Show user profile settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.user.show')->with([
            'user' => $this->userRepo->find(Auth::user()->id),
            'departments' => $this->departmentRepo->getAll()
        ]);
    }

    /**
     * Update user profile settings.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $items = collect(['name', 'last_name', 'email', 'function', 'department_id']);

        if(isset($request->password)) {
            $items = $items->merge('password');
        }

        $this->userRepo->update(Auth::user()->id, $request->only($items->toArray()));

        return back()
            ->with('status', 'Profiel geupdatet!');
    }
}
