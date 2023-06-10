<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
// use Illuminate\Support\Facades\Auth;
use Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($postId, Request $request)
    {
        $post = Post::findOrFail($postId);

        if ((Like::where('post_id', '=', $postId)->where('user_id', '=', Auth::user()->id)->first()) != NULL) {
            return redirect()->route('posts.index')->with('status', 'Post already liked');
        }

        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->post_id = $postId;
        $like->save();

        return redirect()->route('posts.index')->with('status', 'Post liked');
    }
}
