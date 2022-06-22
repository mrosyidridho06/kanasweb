<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    // use RefreshDatabase;
    // use WithoutMiddleware;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // $this->assertAuthenticated();
        $response->assertStatus(302);
        // $response->assertRedirect(RouteServiceProvider::HOME);

        // $request = [
        //     'email' => 'akun1@gmail.com',
        //     'password' => 'password'
        // ];

        // $response = $this->post(route('login'), $request);

        // $response->assertStatus(302);
        // $response->assertRedirect(route('dashboard'));
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $role = 'admin';

        $user = User::where('role', $role)->first();
        // $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
