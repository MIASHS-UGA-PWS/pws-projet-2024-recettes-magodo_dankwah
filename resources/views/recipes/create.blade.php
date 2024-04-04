@extends('layouts/main')

@section('content')

<style>
    .recipe-form {
    max-width: 600px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}

</style>

<div class="container">
    <h1>Create Recipe</h1>

    <form method="GET" action="{{ route('recipes.create') }}">
        @csrf

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients:</label>
            <textarea class="form-control" id="ingredients" name="ingredients" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" class="form-control" id="tags" name="tags">
        </div>

        <button type="submit" class="btn btn-primary">Create Recipe</button>
    </form>
</div>

@endsection
