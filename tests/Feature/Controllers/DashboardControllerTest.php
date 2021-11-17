<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;
use App\Models\Subject;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
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

    public function test_dashboard_follow_status_not_found()
    {
        $response = $this->get(route('dashboard.follow', ['subject_id' => 12312])); // random subject id

        $response->assertNotFound();
    }

    public function test_dashboard_follow_status_ok_redirect_back()
    {
        $subject = Subject::factory()->create();

        $response = $this->from(route('dashboard.index'))->get(route('dashboard.follow', ['subject_id' => $subject->id]));

        $this->assertDatabaseHas('subjects_followers', [
            'subject_id' => $subject->id,
            'follower_id' => $this->user->id
        ]);

        $response->assertRedirect(route('dashboard.index'));
    }

    public function test_dashboard_unfollow_status_not_found()
    {
        $response = $this->get(route('dashboard.unfollow', ['subject_id' => 12312])); // random subject id

        $response->assertNotFound();
    }

    public function test_dashboard_unfollow_status_ok_redirect_back()
    {
        $subject = Subject::factory()->create();
        $subject->followers()->attach($this->user->id);

        $this->assertDatabaseHas('subjects_followers', [
            'subject_id' => $subject->id,
            'follower_id' => $this->user->id
        ]);

        $response = $this->from(route('dashboard.index'))->get(route('dashboard.unfollow', ['subject_id' => $subject->id]));

        $this->assertDatabaseMissing('subjects_followers', [
            'subject_id' => $subject->id,
            'follower_id' => $this->user->id
        ]);

        $response->assertRedirect(route('dashboard.index'));
    }
}
