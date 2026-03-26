<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_unverified_user_can_login_without_email_verification(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('onboarding', absolute: false));
    }

    public function test_registration_marks_email_as_verified_immediately(): void
    {
        $response = $this->post('/register', [
            'name' => 'Verified User',
            'email' => 'verified@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $this->assertNotNull(Auth::user()?->email_verified_at);
        $response->assertRedirect(route('onboarding', absolute: false));
    }
}
