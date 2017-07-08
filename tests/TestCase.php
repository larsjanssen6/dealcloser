<?php

namespace Tests;

use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * All permissions
     *
     * @var
     */
    protected $permissions;

    /**
     * User instance with super-admin role
     *
     * @var
     */
    protected $superAdminRole;

    /**
     * User instance
     *
     * @var
     */
    protected $user;

    /**
     * Test setup
     */
    public function setup()
    {
        parent::setUp();

        $this->permissions = [
            'register-users' => 'register-users',
            'edit-company-settings' => 'edit-company-settings',
            'edit-permission-settings' => 'edit-permission-settings',
            'edit-role-settings' => 'edit-role-settings',
            'edit-usage-settings' => 'edit-usage-settings',
            'application-is-always-active' => 'application-is-always-active',
            'edit-users' => 'edit-users',
            'register-relations' => 'register-relations'
        ];

        $this->superAdminRole = Role::first();
        $this->user = create(User::class, ['password' => bcrypt('secret')]);
    }

    /**
     * @param null $user
     *
     * @return $this
     */
    protected function signIn($user = null)
    {
        $user = $user ?: create('App\User');
        $this->actingAs($user);

        return $this;
    }

    /**
     * Reload the permissions.
     *
     * @return bool
     */
    protected function reloadPermissions()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        return app(PermissionRegistrar::class)->registerPermissions();
    }
}
