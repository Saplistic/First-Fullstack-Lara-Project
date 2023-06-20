@extends('layouts.app')


@section('additional-resources')
    <link rel="stylesheet" href="{{ asset('css/pfp.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Function to preview the uploaded image
        function previewImage(event) {
          var reader = new FileReader();
          reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result;
          }
          reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profiel wijzigen</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="text-center"  style="margin-bottom: 30px;">
                                <div class="profile-image-preview">
                                    <img id="preview" class="rounded-circle" src="@if ($user->profile_image_path != NULL && file_exists(public_path('images/' . $user->profile_image_path))) {{ asset('images/' . $user->profile_image_path) }} @else {{ asset('images/user.png') }} @endif">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image-upload" class="col-md-4 col-form-label text-md-end">Profielfoto wijzigen?</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="image-upload" name="profile_image" accept="image/*" onchange="previewImage(event)">

                                    @error('profile_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="biography" class="col-md-4 col-form-label text-md-end">Bio</label>

                                <div class="col-md-6">
                                    <textarea id="biography" class="form-control @error('biography') is-invalid @enderror" name="biography" autofocus>{{ $user->biography }}</textarea>

                                    @error('biography')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="birthdate" class="col-md-4 col-form-label text-md-end">{{ __('Birth date') }}</label>

                                <div class="col-md-6">
                                    <input id="birthdate" type="date" class="form-control @error('password') is-invalid @enderror" name="birthdate" value="{{ $user->birthdate }}" required autofocus>

                                    @error('birthdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Wijzigingen toepassen
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
