<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::paginate();
        return view('posts.manage', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $sponsor = User::where('role', 'sponsor')->get();
        $orphan = User::where('role', 'orphan')->get();
        return view('posts.create', compact('sponsor', 'orphan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->description;
        $post->orphan_id = $request->orphan_id;
        $post->sponsor_id = $request->sponsor_id;
        $post->save();
        return response(['result' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $post = Post::find($post->id);
        $sponsor = User::where('role', 'sponsor')->get();
        $orphan = User::where('role', 'orphan')->get();
        return view('posts.edit', compact('post', 'orphan', 'sponsor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post = Post::find($post->id);
        $post->title = $request->title;
        $post->content = $request->description;
        $post->orphan_id = $request->orphan_id;
        $post->sponsor_id = $request->sponsor_id;

        $post->save();

        return response(['result' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}

class IObservable
{
func constructor()
this.observers = []

func add(observer)
// subclasses should implement this

func remove(observer)
// subclasses should implement this

func notify()
// subclasses should implement this
}

class IObserver:
{
    func constructor(observable):
this . observable = observable

func update()
// subclasses should implement this
}
