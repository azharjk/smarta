<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;
use App\Models\Subject;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_user_follow_status_not_found()
    {
        $response = $this->get(route('user.follow', ['subject_id' => 12312])); // random subject id

        $response->assertNotFound();
    }

    public function test_user_follow_status_ok_redirect_back()
    {
        $subject = Subject::factory()->create();

        $response = $this->from(route('dashboard.index'))->get(route('user.follow', ['subject_id' => $subject->id]));

        $this->assertDatabaseHas('subjects_followers', [
            'subject_id' => $subject->id,
            'follower_id' => $this->user->id
        ]);

        $response->assertRedirect(route('dashboard.index'));
    }

    public function test_user_unfollow_status_not_found()
    {
        $response = $this->get(route('user.unfollow', ['subject_id' => 12312])); // random subject id

        $response->assertNotFound();
    }

    public function test_user_unfollow_status_ok_redirect_back()
    {
        $subject = Subject::factory()->create();
        $subject->followers()->attach($this->user->id);

        $this->assertDatabaseHas('subjects_followers', [
            'subject_id' => $subject->id,
            'follower_id' => $this->user->id
        ]);

        $response = $this->from(route('dashboard.index'))->get(route('user.unfollow', ['subject_id' => $subject->id]));

        $this->assertDatabaseMissing('subjects_followers', [
            'subject_id' => $subject->id,
            'follower_id' => $this->user->id
        ]);

        $response->assertRedirect(route('dashboard.index'));
    }
}
