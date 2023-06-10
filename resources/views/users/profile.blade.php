@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}'s profiel</div>

                <div class="card-body">

                    <h2>Gemaakte posts ({{ ($user->posts)->count() }})</h2>
                    @foreach ($user->posts as $post)
                        <a href="">{{ $post->title }}</a><br>
                    @endforeach

                    <hr>
                    
                    <h2>Gelikte posts ({{ ($user->likes)->count() }})</h2>
                
                    @foreach ($user->likes as $like)
                        <a href="">{{ $like->post->title }}</a><br>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
