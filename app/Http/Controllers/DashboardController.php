<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $subjects_chunk = Subject::all()->chunk(3);
        return view('dashboard.index', ['subjects_chunk' => $subjects_chunk]);
    }

    public function follow($subject_id)
    {
        $subject = Subject::findOrFail($subject_id);
        $subject->followers()->attach(Auth::user()->id);

        return redirect()->back();
    }

    public function unfollow($subject_id)
    {
        $subject = Subject::findOrFail($subject_id);
        $subject->followers()->detach(Auth::user()->id);

        return redirect()->back();
    }
}
