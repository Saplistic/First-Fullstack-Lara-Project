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
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));

    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'cover_image' => 'nullable|mimes:png,jpg,jpeg,gif|max:2048',
            'content' => 'required|min:20'
        ]);

        if ($request->hasFile('cover_image')) {
            $newImageName = time() . '-' . $request->title . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('images/post_covers'), $newImageName);
        }

        $post = new Post;
        if (isset($newImageName)) {
            $post->cover_image_path = $newImageName;
        }
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('posts.index')->with('status', 'Post succesfully created');
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    public function edit(string $id)
    {

        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::user()->id) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|min:3',
            'cover_image' => 'nullable|mimes:png,jpg,jpeg,gif|max:2048',
            'content' => 'required|min:20'
        ]);

        if ($request->hasFile('cover_image')) {
            $newImageName = time() . '-' . $request->title . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('images/post_covers'), $newImageName);
        }

        if (isset($newImageName)) {

            $post->cover_image_path = $newImageName;
        }
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();
        return redirect()->route('posts.show', $post->id)->with('status', 'Post successfully edited');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        Like::where('post_id', '=', $post->id)->delete();
        $post->delete();

        return redirect('posts')->with('status', 'Post deleted');
    }
}