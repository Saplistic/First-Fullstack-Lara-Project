<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:20'
        ]);

        //bijniet geslaagde validatie komer we hier niet terug, gaat onieuw naar form

        $post = new Post;
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('posts.index')->with('status', 'Post succesfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::user()->id) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:20'
        ]);

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();
        return redirect()->route('posts.index')->with('status', 'Post successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}