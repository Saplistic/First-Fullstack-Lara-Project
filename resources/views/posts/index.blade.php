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
                        <small>Gepost door {{ $post->user->name }} op {{ $post->created_at->format('d/m/Y') }}</small>
                        @if($post->user_id == Auth::user()?->id)
                            <a href="{{ route('posts.edit', $post->id) }}" style="float: right">Edit</a>
                        @endauth
                        <hr>
                    @endforeach

                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
