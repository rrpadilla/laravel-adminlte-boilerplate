<?php

namespace Tests\Feature\Controllers\Admin;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_can_not_manage_users()
    {
        $user = factory(User::class)->create();
        $this->assertFalse($user->isAdmin());

        // View List
        $response = $this->actingAs($user)->get(route('admin::users.index'));
        $response->assertRedirect(route('dashboard::index'));

        // Create User
        $tmpUser = factory(User::class)->make();
        $response = $this->actingAs($user)->post(route('admin::users.store'), 
            array_merge($tmpUser->toarray(), [
                'password' => 'secret',
                'password_confirmation' => 'secret',
                '_token' => csrf_token(),
            ]));
        $this->assertDatabaseMissing('users', [
            'email' => $tmpUser->email
        ]);
        $response->assertRedirect(route('dashboard::index'));

        // Delete User
        $newUser = factory(User::class)->create();
        $response = $this->actingAs($user)->delete(route('admin::users.destroy', $newUser->id));
        $this->assertDatabaseHas('users', [
            'id' => $newUser->id
        ]);
        $response->assertRedirect(route('dashboard::index'));
    }

    public function test_admin_can_manage_users()
    {
        $user = factory(User::class, 'admin')->create();
        $this->assertTrue($user->isAdmin());

        // View List
        $response = $this->actingAs($user)->get(route('admin::users.index'));
        $response->assertStatus(200);

        // Create User
        $tmpUser = factory(User::class)->make();
        $response = $this->actingAs($user)->post(route('admin::users.store'), 
            array_merge($tmpUser->toarray(), [
                'password' => 'secret',
                'password_confirmation' => 'secret',
                '_token' => csrf_token(),
            ]));
        $this->assertDatabaseHas('users', [
            'email' => $tmpUser->email
        ]);
        $response->assertRedirect(route('admin::users.index'));

        // Delete User
        $newUser = factory(User::class)->create();
        $response = $this->actingAs($user)->delete(route('admin::users.destroy', $newUser->id));
        $this->assertDatabaseMissing('users', [
            'id' => $newUser->id
        ]);
        $response->assertRedirect(route('admin::users.index'));

        // Can not Delete Own User
        $response = $this->actingAs($user)->delete(route('admin::users.destroy', $user->id));
        $this->assertDatabaseHas('users', [
            'id' => $user->id
        ]);
    }
}
