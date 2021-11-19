<?php

namespace App\Http\Controllers;


class DevController extends Controller
{
    public function __invoke($file_path)
    {
        $full_path_view = 'dev/' . $file_path;

        abort_unless(view()->exists($full_path_view), 404);

        return view($full_path_view);
    }
}
