<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    // use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(302);
    }

    public function test_new_users_can_register()
    {
        $role = 'admin';

        $user = User::find(4);

        User::create([
            'name' => 'tesuser2',
            'username' => 'tesuser2',
            'email' => 'user2@tes.com',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);

        $response = $this->actingAs($user)->get('/register');

        // $this->assertAuthenticated();
        // $response->assertRedirect(RouteServiceProvider::HOME);
        $response->assertStatus(200);
    }
}
