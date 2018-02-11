<?php

namespace App\Http\Controllers;

/* Not needed since we have our own request file being used */
/*use Illuminate\Http\Request;*/
use App\Http\Requests\echoTestRequest;

class echoTestController extends Controller
{
    public function input()
    {
        /* 
        | We return a 'view'. A file that will become the generated HTML the user sees 
        | This view is stored in resources\views and will have the file extention .blade.php
        */
        return view('echoTest');
    }
    public function output(echoTestRequest $request)
    {
        $echo = [];

        $echo['bname'] = $request->get('name');

        return view('echoTest', $echo);
    }
}
