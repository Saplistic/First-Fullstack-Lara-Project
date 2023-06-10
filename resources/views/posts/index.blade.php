@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    @foreach ($posts as $post)
                        <h2>{{ $post->title }}</h2>
                        <p>{{ $post->content }}</p>
                        <small>Gepost door {{ $post->user->name }} op {{ $post->created_at->format('d/m/Y \o\m H:i') }}</small>
                        @if($post->user_id == Auth::user()?->id)
                            <a href="{{ route('posts.edit', $post->id) }}" style="float: right">Edit</a>
                        @endauth
                        <br>
                        
                        {{-- @foreach ($post->likes as $like)
                            <li>liked by user with id {{ $like->user_id }}</li>
                        @endforeach --}}
                        
                        <p style="font-size: 1.3rem">
                            {{ $post->likes()->count() }}

                            @if ($post->likes->contains('user_id', auth()->id()))
                                <a href=""><i class="bi bi-hand-thumbs-up-fill"></i></a>
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
