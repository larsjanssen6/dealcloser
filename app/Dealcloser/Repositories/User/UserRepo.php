<?php

namespace App\Dealcloser\Repositories\User;

use App\Dealcloser\Core\User\User;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;

class UserRepo implements IUserRepo
{
    /**
     * Store a user
     *
     * @param array $user
     * @return User
     */
    public function store(array $user)
    {
        return User::create($user);
    }

    /**
     * Update a user
     *
     * @param User $user
     * @param array $request
     */
    public function update(User $user, $request)
    {
        if(isset($request['password'])) {
            $request['password'] = bcrypt($request['password']);
        }

        $user->update($request);
    }

    /**
     * Find a user based on id
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * Check if value exists
     *
     * @param $column
     * @param $value
     * @return mixed
     */
    public function exists($column, $value)
    {
        return User::where($column, $value)->exists();
    }

    /**
     * Activate user
     *
     * @param $token
     * @param $password
     * @return User $user
     */
    public function activate($token, $password)
    {
        return tap(User::where('confirmation_code', $token)->first(), function ($user) use ($password) {
            $user->update([
                'active' => true,
                'confirmation_code' => null,
                'password' => bcrypt($password)
            ]);
        });
    }
}

