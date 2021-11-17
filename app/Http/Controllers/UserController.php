<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Subject;

class UserController extends Controller
{
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
