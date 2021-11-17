<?php

namespace Tests\Feature\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubjectControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_subject_index_status_ok()
    {
        $response = $this->get(route('subject.index'));

        $response->assertOk();
    }

    public function test_subject_index_subjects_chunk_empty()
    {
        $response = $this->get(route('subject.index'));

        $empty = $response->viewData('subjects_chunk')->isEmpty();

        $this->assertTrue($empty);
    }

    public function test_subject_index_subjects_chunk_not_empty()
    {
        $this->user->subjects()->saveMany(Subject::factory(2)->make());

        $response = $this->get(route('subject.index'));
        $subjects_chunk = $response->viewData('subjects_chunk');

        $this->assertCount(2, $subjects_chunk[0]);
    }

    public function test_subject_show_status_not_found()
    {
        $response = $this->get(route('subject.show', ['subject_id' => 123213])); // random id

        $response->assertNotFound();
    }

    public function test_subject_show_status_ok_subject_not_null()
    {
        $subject = Subject::factory()->make();
        $this->user->subjects()->save($subject);

        $response = $this->get(route('subject.show', ['subject_id' => $subject->id]));

        $response->assertOk();
        $response->assertViewHas('subject', $subject);
    }

    public function test_subject_create_status_ok()
    {
        $response = $this->get(route('subject.create'));

        $response->assertOk();
    }

    public function test_subject_store_redirect_subject_show()
    {
        $response = $this->post(route('subject.store'), [
            'name' => 'subject_name_dummy',
            'description' => 'subject_name_dummy_desc'
        ]);

        $this->assertDatabaseHas('subjects', ['name' => 'subject_name_dummy']);

        $response->assertRedirect(route('subject.show', ['subject_id' => Subject::latest()->first()->id]));
    }
}
