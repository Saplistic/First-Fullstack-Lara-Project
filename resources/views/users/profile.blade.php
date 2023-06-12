@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()?->is_admin && !$user->is_admin)
                        <a type="submit" href="{{ route('grantAdminPermissions', $user->id) }}" style="float: right" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Promote to admin</a>
                    @endif
                    <h3 style="display: inline-block">
                        {{ $user->name }}'s
                        @if ($user->is_admin)
                            <i class="bi bi-person-fill-gear"></i>
                        @endif profiel
                    </h3>
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="" style="max-width: 500px">
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

                    <div class="" style="max-width: 300px">

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
