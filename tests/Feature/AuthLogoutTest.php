<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class AuthLogoutTest extends TestCase
{
    use refreshdatabase;

    public function setup(): void
    {
        parent::setup();
        $this->actingAs(User::factory()->create());
    }

    public function test_dashboard_status_ok()
    {
        $response = $this->get(route('dashboard.index'));

        $response->assertOk();
    }

    public function test_auth_logout_redirect()
    {
        $response = $this->get(route('auth.logout'));

        $response->assertRedirect(route('auth.signin'));
    }
}
