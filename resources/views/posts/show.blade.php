@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card overflow-hidden">

                @if ( ($post->cover_image_path != NULL))
                    <div style="height: 100px; width: 100%; background: url({{ asset('images/post_covers/' . $post->cover_image_path) }}) center / cover"></div>
                @endif

                <div class="card-body">

                    <h3>{{ $post->title }}</h3>

                    <small>
                        Gepost door 
                        <a href="{{ route('profile', $post->user->name) }}">
                            <img src="@if ($post->user->profile_image_path != NULL && file_exists(public_path('images/users/' . $post->user->profile_image_path))) {{ asset('images/users/' . $post->user->profile_image_path) }} @else {{ asset('images/user.png') }} @endif" width="20" height="20" class="rounded-circle">
                            {{ $post->user->name }}
                            @if ($post->user->is_admin)
                                <i class="bi bi-person-fill-gear"></i>
                            @endif
                        </a>
                         op {{ $post->created_at->format('d/m/Y \o\m H:i') }}, {{ $post->created_at->diffForHumans() }}
                    </small><br>
                    <br>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <p>{{ $post->content }}</p>

                    @if($post->user_id == Auth::user()?->id)
                        <a href="{{ route('posts.edit', $post->id) }}" style="float: right">Edit</a>
                    @endauth
                    
                    <p style="font-size: 1.3rem">
                        {{ $post->likes()->count() }}

                        @if ($post->likes->contains('user_id', auth()->id()))
                            <a href="{{ route('like.destroy', $post->id) }}"><i class="bi bi-hand-thumbs-up-fill"></i></a>
                        @else
                            <a href="{{ route('like', $post->id) }}"><i class="bi bi-hand-thumbs-up"></i></a>
                        @endif
                    </p>

                    @if (Auth::user()?->is_admin)
                        <form method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" href="{{ route('posts.destroy', $post->id) }}" onclick="return confirm('Are you sure you want to delete this post, this action cannot be undone!');" class="btn btn-outline-danger">Delete post</button>
                        </form>
                    @endif

                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
