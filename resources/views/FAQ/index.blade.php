@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">FAQs</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                    
                    @foreach ($categories as $category)

                        <h2 style="margin: 15px 10px">{{ $category->name }}</h2>
                        
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
                                        </div>
                                    </div>
                                  </div>
                            @endforeach
                        </div>

                    @endforeach
                    

                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
