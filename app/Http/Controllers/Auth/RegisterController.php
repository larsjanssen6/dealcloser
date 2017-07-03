<?php

namespace App\Http\Controllers\Auth;

use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
use Auth;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Events\Registered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * IUserRepo implementation
     *
     * @var IUserRepo
     */
    private $userRepo;

    /**
     * IRoleRepo implementation
     *
     * @var IRoleRepo
     */
    private $roleRepo;

    /**
     * Create a new controller instance. Only users with permission
     * register-users have access to this controller.
     *
     * @param IUserRepo $userRepo
     * @param IRoleRepo $roleRepo
     */
    public function __construct(IUserRepo $userRepo, IRoleRepo $roleRepo)
    {
        $this->middleware('permission:register-users');
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    /**
     * Show user registration form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('auth.register')->with([
            'roles' => $this->roleRepo->getAll()
        ]);
    }

    /**
     * Store a new user
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        $user = $this->userRepo->create(
            collect($request->only('name', 'last_name', 'email', 'function'))
                ->merge([
                        'confirmation_code' => str_random(30),
                        'password' => str_random(10)
                    ])
                ->toArray()
        )->assignRole($request->role);

        event(new Registered($user));

        return back()->with('status', 'Gebruiker geregistreerd e-mail succesvol verzonden');
    }
}


