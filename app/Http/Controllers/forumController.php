<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\forumThreadRequest;
use Illuminate\Support\Facades\DB;

class forumController extends Controller
{
    public function home()
    {
        $threads = DB::select('select * from threads');
        return view('forumHome', ['threads' => $threads]);
    }

    public function post(forumThreadRequest $request)
    {
        $post = [];

        $post['author'] = $request->get('author');
        if($post['author'] == ""){
            $post['author'] = "Anonymous";
        }
        $post['subject'] = $request->get('subject');
        $post['content'] = $request->get('content');

        DB::table('threads')->insert([
            'author' => $post['author'],
            'subject' => $post['subject'],
            'content' => $post['content'],
        ]);

        return redirect()->route('forum.home');
    }
}
