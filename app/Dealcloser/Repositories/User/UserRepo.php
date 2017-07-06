<?php

namespace App\Dealcloser\Repositories\User;

use App\Dealcloser\Core\User\User;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Dealcloser\Repositories\EloquentRepo;

class UserRepo extends EloquentRepo implements IUserRepo
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * Update user if there is a password encrypt it.
     *
     * @param $id
     * @param array $request
     * @return bool|mixed|void
     */
    public function update($id, array $request)
    {
        if (isset($request['password'])) {
            $request['password'] = bcrypt($request['password']);
        }

        parent::update($id, $request);
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
        return tap($this->findBy('confirmation_code', $token), function ($user) use ($password) {
            $user->update([
                'active' => true,
                'confirmation_code' => null,
                'password' => bcrypt($password)
            ]);
        });
    }
}