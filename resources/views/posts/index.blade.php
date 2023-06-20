@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">News posts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    @foreach ($posts as $post)
                        <h2><a href="{{ route('posts.show', $post->id) }}" style="color: inherit;">{{ $post->title }}</a></h2>
                        <small>
                            Gepost door 
                            <a href="{{ route('profile', $post->user->name) }}">
                                {{ $post->user->name }}
                                @if ($post->user->is_admin)
                                    <i class="bi bi-person-fill-gear"></i>
                                @endif
                            </a> {{ $post->created_at->diffForHumans() }}
                        </small>
                            
                        @if($post->user_id == Auth::user()?->id)
                            <a href="{{ route('posts.edit', $post->id) }}" style="float: right;">Wijzig</a>
                        @endauth
                        <br>
                        
                        <p style="font-size: 1.3rem">
                            {{ $post->likes()->count() }}

                            @if ($post->likes->contains('user_id', auth()->id()))
                                <a href="{{ route('like.destroy', $post->id) }}"><i class="bi bi-hand-thumbs-up-fill"></i></a>
                            @else
                                <a href="{{ route('like', $post->id) }}"><i class="bi bi-hand-thumbs-up"></i></a>
                            @endif
                            
                        </p>

                        <hr>
                        
                    @endforeach

                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
