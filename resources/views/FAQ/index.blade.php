@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">FAQs</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @foreach ($categories as $category)

                        <h2 style="margin: 15px 10px" >
                            {{ $category->name }}
                            {{-- admin: category actions --}}
                            <div style="float: right; font-size: 1.3rem">
                                <small>Actions: </small>
                                <a href="#editCategory{{ $category->id }}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="editCategory{{ $category->id }}" style="color: black"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('FAQs.category.destroy', $category->id) }}" onclick="return confirm('Are you sure you want to delete this category & its corresponding questions, this action cannot be undone!');" style="color: red"><i class="bi bi-x-square"></i></a>
                            </div>
                        </h2>
                        
                        <div class="collapse" id="editCategory{{ $category->id }}">
                            <div class="card card-body" style="display: inline-block">

                                {{-- admin: change category name action --}}
                                <form method="POST" action="{{ route('FAQs.category.update', $category->id) }}" class="row g-3">
                                    @csrf
                                    @method("PUT")

                                    <div class="col-auto">
                                        <input type="text" name="name" class="form-control" id="newName" value="{{ $category->name }}" placeholder="Naam categorie">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-success mb-3">Aanpassen</button>
                                    </div>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </form>
                            </div>

                        </div>

                        <div class="accordion" id="accordion_{{ $category->id }}">

                            @foreach ($category->questions as $question)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $question->id }}_{{ $category->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $question->id }}_{{ $category->id }}" aria-expanded="false" aria-controls="collapse-{{ $question->id }}_{{ $category->id }}">
                                            {{ $question->title }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $question->id }}_{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $question->id }}_{{ $category->id }}" data-bs-parent="#accordion_{{ $category->id }}">
                                        <div class="accordion-body">
                                            {{ $question->answer }}
                                            {{-- admin: question actions --}}
                                            <div>
                                                <b>Actions: </b>
                                                <a href="{{ route('FAQ.edit', $question->id) }}" style="color: black; font-size: 1.3rem"><i class="bi bi-pencil-square"></i></a>
                                                <a href="{{ route('FAQ.destroy', $question->id) }}"  onclick="return confirm('Are you sure you want to delete this question, this action cannot be undone!');" style="color: red; font-size: 1.3rem"><i class="bi bi-x-square"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                            @endforeach
                            {{-- admin: create new question action --}}
                            <div style="padding: 5px">
                                <a href="{{ route('FAQ.create', $category->id) }}" style="color: green">Nieuwe vraag <i class="bi bi-plus-square"></i></a>
                            </div>
                        </div>

                    @endforeach
                    
                    <div style="margin-top: 40px">
                        <a class="btn btn-success" data-bs-toggle="collapse" href="#addCategory" role="button" aria-expanded="false" aria-controls="addCategory">Nieuwe categorie aanmaken</a>
                        <div class="collapse" id="addCategory">
                            <div class="card card-body" style="display: inline-block">
                                
                                {{-- admin: store new category action  --}}
                                <form method="POST" action="{{ route('FAQs.category.store') }}" class="row g-3">
                                    @csrf

                                    <div class="col-auto">
                                        <input type="text" name="name" class="form-control" placeholder="Categorie">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-success mb-3">Aanmaken</button>
                                    </div>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </form>
                            </div>
                        </div>
                        <br>

                    </div>
                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
