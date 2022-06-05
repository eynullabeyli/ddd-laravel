<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use MyApp\Domain\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertNoContent();
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
