<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Events\Registered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
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
        $this->middleware('permission:register-users');
        $this->userRepo = $userRepo;
    }

    /**
     * Show user registration form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('auth.register')->with([
            'roles' => Role::all()
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
        $user = $this->userRepo->store(
            collect($request->only('name', 'last_name', 'email', 'function'))
                ->merge([
                    'confirmation_code' => str_random(30),
                    'password' => encrypt(str_random(10))
                ])
                ->toArray()
        )->assignRole($request->role);

        event(new Registered($user));

        return back()->with('status', 'Gebruiker geregistreerd e-mail succesvol verzonden');
    }
}


