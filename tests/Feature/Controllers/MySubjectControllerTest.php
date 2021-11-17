<?php

namespace Tests\Feature\Controllers;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class MySubjectControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_mysubject_index_status_ok_subjects_chunk()
    {
        $subject = Subject::factory()->create();
        $this->user->followedSubjects()->attach($subject->id);

        $response = $this->get(route('mysubject.index'));

        $actual = $this->user->followedSubjects->chunk(3);

        $response->assertViewHas('subjects_chunk', $actual);
    }

    public function test_mysubject_index_status_ok_subjects_chunk_empty()
    {
        $response = $this->get(route('mysubject.index'));

        $empty = $response->viewData('subjects_chunk')->isEmpty();

        $this->assertTrue($empty);
    }
}
