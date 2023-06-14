@extends('layouts.app')

@section('additional-resources')
    <link rel="stylesheet" href="{{ asset('css/pfp.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()?->is_admin && !$user->is_admin)
                        <a type="submit" href="{{ route('grantAdminPermissions', $user->id) }}" style="float: right" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Promote to admin</a>
                    @endif

                    @if (Auth::user()?->id == $user->id)
                        <a href="{{ route('user.edit') }}" style="float: right; color: gray">Profiel bewerken <i class="bi bi-gear-fill" style="font-size: 1.2pc"></i></a>
                    @endif

                    <h2 style="display: inline-block">
                        {{ $user->name }}'s
                        @if ($user->is_admin)
                            <i class="bi bi-person-fill-gear"></i>
                        @endif profiel
                    </h2>
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="avatar-container" style="margin: 20px; display: flex;">
                        <div class="profile-image-preview" style="margin-right: 20px;">
                            <img id="preview" class="rounded-circle" src="@if ($user->profile_image_path != NULL && file_exists(public_path('images/' . $user->profile_image_path))) {{ asset('images/' . $user->profile_image_path) }} @else {{ asset('images/user.png') }} @endif">
                        </div>
                        <div style="display: inline-block; flex-grow: 1;">
                            <h5>Bio</h5>
                            <p>{{ $user->biography }}</p>
                        </div>
                    </div>
                    
                    <hr>

                    <div style="max-width: 500px">
                        <h4>Gemaakte posts ({{ ($user->posts)->count() }})</h3>
                        <ul class="list-group list-group-flush">
                            @foreach ($user->posts as $post)
                                <li class="list-group-item">
                                    <p style="float: right; margin: 0px">{{ $post->created_at->diffForHumans() }}</p>
                                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a><br>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <hr>

                    <div style="max-width: 300px">

                        <h4>Gelikte posts ({{ ($user->likes)->count() }})</h3>

                        <ul class="list-group list-group-flush">
                            @foreach ($user->likes as $like)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', $like->post->id) }}">{{ $like->post->title }}</a><br>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
