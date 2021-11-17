<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Forum;

class ForumController extends Controller
{
    public function show($subject_id, $forum_id) {
        $subject = Auth::user()->subjects()->find($subject_id);
        abort_if(is_null($subject), 404);

        $forum = $subject->forums()->find($forum_id);
        abort_if(is_null($forum), 404);

        return view('forum.show', [
            'subject' => $subject,
            'forum' => $forum
        ]);
    }

    public function create()
    {
        $subjects = Auth::user()->subjects()->get();
        return view('forum.create', ['subjects' => $subjects]);
    }

    public function store(Request $request)
    {
        // TODO: do input validation before using the data
        $data = $request->all();
        $forum = Forum::create($data);

        return redirect()->route('forum.show', ['subject_id' => $data['subject_id'], 'forum_id' => $forum->id]);
    }
}
