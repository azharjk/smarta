<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;
use App\Models\Subject;
use App\Models\Forum;

class ForumControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_forum_show_status_not_found_if_subject_null()
    {
        $response = $this->get(route('forum.show', ['subject_id' => 213, 'forum_id' => 123])); // random both id

        $response->assertNotFound();
    }

    public function test_forum_show_status_not_found_if_forum_null()
    {
        $subject = Subject::factory()->create();

        $this->user->subjects()->save($subject);

        $response = $this->get(route('forum.show', ['subject_id' => $subject->id, 'forum_id' => 12321])); // random forum id

        $response->assertNotFound();
    }

    public function test_forum_show_status_ok_subject_forum()
    {
        $subject = Subject::factory()->create();
        $forum = $subject->forums()->save(Forum::factory()->make());

        $this->user->subjects()->save($subject);

        $response = $this->get(route('forum.show', ['subject_id' => $subject->id, 'forum_id' => $forum->id]));

        $response->assertOk();
        $response->assertViewHas(['subject' => $subject, 'forum' => $forum]);
    }

    public function test_forum_create_status_ok_subjects()
    {
        $subjects = Subject::factory(2)->create();
        $this->user->subjects()->saveMany($subjects);

        $response = $this->get(route('forum.create'));

        $response->assertOk();
        $this->assertEquals($subjects->toArray(), $response->viewData('subjects')->toArray());
    }

    public function test_forum_create_status_ok_subjects_empty()
    {
        $response = $this->get(route('forum.create'));

        $response->assertOk();
        $this->assertEquals([], $response->viewData('subjects')->toArray());
    }

    public function test_forum_store_redirect_forum_show()
    {
        $subject = Subject::factory()->create();
        $this->user->subjects()->save($subject);

        $response = $this->post(route('forum.store'), [
            'subject_id' => $subject->id,
            'name' => 'forumone',
            'description' => 'forumone desc'
        ]);

        $this->assertDatabaseHas('subjects', ['name' => $subject->name]);
        $this->assertDatabaseHas('forums', ['name' => 'forumone']);

        $response->assertRedirect(route('forum.show', ['subject_id' => $subject->id, 'forum_id' => $subject->forums[0]->id]));
    }
}
