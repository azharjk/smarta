<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class GuestLoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth_signin_status_ok()
    {
        $response = $this->get(route('auth.signin'));

        $response->assertOk();
    }

    public function test_auth_login_redirect_dashboard_if_credentials_matched()
    {
        $user = User::factory()->create(['email' => 'bad_email', 'password' => bcrypt('correct_passwd')]);
        $this->assertDatabaseHas('users', ['email' => 'bad_email']);

        $response = $this->post(route('auth.login'), [
            'email' => 'bad_email', // Still using bad email
            'password' => 'correct_passwd'
        ]);

        $response->assertRedirect(route('dashboard.index'));
    }

    public function test_auth_login_string_info_if_credentials_not_matched()
    {
        $user = User::factory()->create(['email' => 'bad_email', 'password' => bcrypt('bad_passwd')]);
        $this->assertDatabaseHas('users', ['email' => 'bad_email']);

        // TODO: temporary failing return test for password not matched
        $response = $this->post(route('auth.login'), [
            'email' => 'bad_email', // Still using bad email
            'password' => 'wrong_passwd'
        ]);

        $response->assertSeeText('Incorrect credentials');
    }
}
