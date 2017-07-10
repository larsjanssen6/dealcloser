<?php

namespace Tests\Feature\User;

use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_destroy_a_user()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-users']);
        $this->user->assignRole($this->superAdminRole->name);

        $user = create(User::class);
        $total = User::count();

        $this->actingAs($this->user)->deleteJson('/gebruikers/' . $user->id)
            ->assertJson(['status' => 'Verwijderd']);

        $this->assertEquals($total -1, User::count());
        $this->assertDatabaseMissing('user', $user->toArray());
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_destroy_a_user()
    {
        $user = create(User::class);
        $total = User::count();

        $this->actingAs($this->user)->deleteJson('/gebruikers/' . $user->id)
            ->assertJson(["status" => "Niet geautoriseerd!"]);

        $this->assertEquals($total, User::count());
        $this->assertDatabaseHas('user', $user->toArray());
    }
}

