@extends('layouts/main')

@section('content')

<style>
    .container {
        max-width: 600px;
        margin: 50px auto; /* Center the container vertically and horizontally */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

<div class="container">
    <h1>Edit Recipe</h1>

    <form method="POST" action="{{ route('recipes.edit', ['recipe' => $recipe->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $recipe->title }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" required>{{ $recipe->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients:</label>
            <textarea class="form-control" id="ingredients" name="ingredients" required>{{ $recipe->ingredients }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $recipe->price }}" required>
        </div>

        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" class="form-control" id="tags" name="tags" value="{{ $recipe->tags }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Recipe</button>
    </form>
</div>

@endsection
