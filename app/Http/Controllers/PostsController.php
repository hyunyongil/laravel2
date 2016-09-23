<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PostsController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, \App\Post::$rules);

        return '[' . __METHOD__ . '] ' . 'validate the form data from the create form and create a new instance';
    }
}
