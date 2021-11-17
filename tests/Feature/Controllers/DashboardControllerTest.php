<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_dashboard_index_status_ok_subjects_chunk_empty()
    {
        $response = $this->get(route('dashboard.index'));

        $empty = $response->viewData('subjects_chunk')->isEmpty();

        $this->assertTrue($empty);
    }

    // TODO: Didn't test
    // public function test_dashboard_index_status_ok_subjects_chunk()
    // {
    //     $this->user->subjects()->save(Subject::factory()->make());

    //     $response = $this->get(route('dashboard.index'));

    //     $response->assertViewHas('subjects_chunk', Subject::all()->chunk(3));
    // }
}
