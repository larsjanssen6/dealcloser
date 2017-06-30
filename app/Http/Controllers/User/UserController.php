<?php

namespace App\Http\Controllers\User;

use App\Dealcloser\Core\User\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('user.users')->with([
            'users' => User::orderBy('name', 'last_name')->paginate(10)
        ]);
    }
}
