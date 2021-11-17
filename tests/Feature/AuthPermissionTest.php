<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class AuthPermissionTest extends TestCase
{
    use refreshdatabase;

    public function setup(): void
    {
        parent::setup();
        $this->actingAs(User::factory()->create());
    }

    public function test_auth_signup_redirect_dashboard_index()
    {
        $response = $this->get(route('auth.signup'));

        $response->assertRedirect(route('dashboard.index'));
    }

    public function test_auth_signin_redirect_dashboard_index()
    {
        $response = $this->get(route('auth.signin'));

        $response->assertRedirect(route('dashboard.index'));
    }
}
