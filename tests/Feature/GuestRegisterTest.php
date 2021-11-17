<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use App\Models\User;

class GuestRegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth_signup_status_ok()
    {
        $response = $this->get(route('auth.signup'));

        $response->assertOk();
    }

    // TODO: create tests for field validation
    public function test_auth_register_redirect_dashboard_if_password_matched()
    {
        $response = $this->post(route('auth.register'), [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'bad_email', // Still using bad email
            'password' => 'janedoe123',
            'confirm_password' => 'janedoe123'
        ]);

        $response->assertRedirect(route('dashboard.index'));

        $this->assertTrue(Auth::check());

        $this->assertDatabaseHas('users', ['email' => 'bad_email']);

        $user = User::where('email', 'bad_email')->first();
        $this->assertNotNull($user);

        $this->assertNotEquals('janedoe123', $user->password);
    }

    // TODO: temporary failing return test for password not matched
    public function test_auth_register_string_info_if_password_not_matched()
    {
         $response = $this->post(route('auth.register'), [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'bad_email', // Still using bad email
            'password' => 'janedoe123',
            'confirm_password' => 'notmatchedpwd'
        ]);

        $response->assertSeeText('Password not matched');
    }
}
