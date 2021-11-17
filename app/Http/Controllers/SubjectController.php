<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Subject;

// TODO: change controller name or merge with MySubjectController
class SubjectController extends Controller
{
    public function index()
    {
        // TODO: right now instantly take user from Auth::user()
        $subjects_chunk = Auth::user()->subjects->chunk(3);

        return view('subject.index', ['subjects_chunk' => $subjects_chunk]);
    }

    public function show($subject_id)
    {
        $subject = Subject::find($subject_id);

        abort_if(is_null($subject), 404);

        return view('subject.show', ['subject' => $subject]);
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store(Request $request)
    {
        // TODO: do input validation before using the data
        $data = $request->all();
        $subject = Auth::user()->subjects()->create($data);

        return redirect()->route('subject.show', ['subject_id' => $subject->id]);
    }
}
