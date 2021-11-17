<?php

namespace App\Http\Controllers;

use App\Models\Subject;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $subjects_chunk = Subject::all()->chunk(3);
        return view('dashboard.index', ['subjects_chunk' => $subjects_chunk]);
    }
}
