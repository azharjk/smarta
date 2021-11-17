<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

// TODO: change controller name or merge with SubjectController
class MySubjectController extends Controller
{
    public function index()
    {
        $subjects_chunk = Auth::user()->followedSubjects->chunk(3);

        return view('subject.index', ['subjects_chunk' => $subjects_chunk]);
    }
}
