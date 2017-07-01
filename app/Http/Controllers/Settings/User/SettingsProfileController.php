<?php

namespace App\Http\Controllers\Settings\User;

use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
     * Create a new controller instance. Only users with permission
     * register-users have access to this controller.
     *
     * @param IUserRepo $userRepo
     */
    public function __construct(IUserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Show user profile settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.user.show')->with([
            'user' => $this->userRepo->find(Auth::user()->id)
        ]);
    }

    /**
     * Update user profile settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->userRepo->update(Auth::user(), $request->only(
            'name', 'last_name', 'email', 'password', 'function'
        ));

        return back()
            ->with('status', 'Profiel geupdatet!');
    }
}
