@extends('layouts/main')

@section('content')


<style>
    .recipe-card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        background-color: #f9f9f9;
    }

    .recipe-card h2 {
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .recipe-card p {
        margin-bottom: 10px;
    }

    .recipe-card button {
        margin-right: 10px;
    }
</style>

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <button><a href="{{ route('recipes.create') }}" class="btn btn-primary">Add Recipe</a></button>
        </div>
    </div>

    @foreach ($recipes as $recipe)
    <div class="row mb-4">
        <div class="col-md-12 recipe-card">
            <h2>{{ $recipe->title }}</h2>
            <p class="text-muted">By {{ $recipe->user->name }}</p>
            <p>{{ $recipe->content }}</p>
            <p><strong>Ingredients:</strong> {{ $recipe->ingredients }}</p>
            <button><a href="{{ route('recipes.show', ['url' => $recipe->url]) }}" class="btn btn-primary">Read more</a></button>
            <button><a href="{{ route('recipes.edit', ['recipe' => $recipe->id]) }}" class="btn btn-secondary">Edit</a></button>         
            <form action="{{ route('recipes.destroy', ['id' => $recipe->id]) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    @endforeach

</div>

@endsection
