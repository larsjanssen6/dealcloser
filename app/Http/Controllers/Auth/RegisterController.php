<?php

namespace App\Http\Controllers\Auth;

use App\Dealcloser\Interfaces\Repositories\IDepartmentRepo;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
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
     * IDepartmentRepo implementation
     *
     * @var IRoleRepo
     */
    private $departmentRepo;

    /**
     * Create a new controller instance. Only users with permission
     * register-users have access to this controller.
     *
     * @param IUserRepo $userRepo
     * @param IRoleRepo $roleRepo
     * @param IDepartmentRepo $departmentRepo
     */
    public function __construct(IUserRepo $userRepo, IRoleRepo $roleRepo, IDepartmentRepo $departmentRepo)
    {
        $this->middleware('permission:register-users');
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
        $this->departmentRepo = $departmentRepo;
    }

    /**
     * Show user registration form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register')->with([
            'roles' => $this->roleRepo->getAll(),
            'departments' => $this->departmentRepo->getAll()
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
        if ($this->userCanBeRegistered(settings()->users, $this->userRepo->count())
        ) {
            $user = $this->userRepo->create(
                collect($request->only('name', 'last_name', 'email', 'function', 'department_id'))
                    ->merge([
                        'confirmation_code' => str_random(30),
                        'password' => str_random(10)
                    ])
                    ->toArray()
            )->assignRole($request->role);

            event(new Registered($user));

            return back()->with('status', 'Gebruiker geregistreerd e-mail succesvol verzonden');
        }

        return back()->with([
            'status' => 'Het gebruikers limiet is bereikt. Contacteer de beheerder.',
            'class' => 'is-danger'
        ]);
    }

    /**
     * Check if a user can be registered
     *
     * @param null $max
     * @param $users
     * @return bool
     */
    public function userCanBeRegistered($max = null, $users)
    {
        if (isset($max)) {
            return $max > $users;
        }

        return true;
    }
}




