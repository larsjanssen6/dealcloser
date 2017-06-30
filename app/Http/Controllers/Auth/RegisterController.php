<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:register-users');
    }

    public function show()
    {
        return view('auth.register')->with([
            'roles' => Role::all()
        ]);
    }
    
    public function store(RegisterRequest $request)
    {

    }
}
