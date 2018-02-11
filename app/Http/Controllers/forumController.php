<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class forumController extends Controller
{
    public function home()
    {
        $threads = DB::select('select * from threads');
        return view('forumHome', ['threads' => $threads]);
    }
}
