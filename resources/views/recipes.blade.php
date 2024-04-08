@extends('layouts/main')

@section('content')

<style>
    .recipe-card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        background-color: #f9f9f9;
        margin-bottom: 20px;
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

    .comment-form {
        margin-top: 30px;
    }

    .comment-form h3 {
        font-size: 1.2em;
        margin-bottom: 15px;
    }

    .comment-form form {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
    }

    .comment-form form label {
        font-weight: bold;
    }

    .comment-form form input[type="text"],
    .comment-form form input[type="email"],
    .comment-form form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .comment-form form textarea {
        resize: vertical;
    }

    .comment-form form button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
    }

    .comment-form form button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .comments {
        margin-top: 30px;
    }

    .comment {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f0f0f0;
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

            <!-- Read More, Edit, and Delete Buttons -->
            <div class="mb-3">
                <button><a href="{{ route('recipes.show', ['url' => $recipe->url]) }}" class="btn btn-primary">Read more</a></button>
                <button><a href="{{ route('recipes.edit', ['recipe' => $recipe->id]) }}" class="btn btn-secondary">Edit</a></button>         
                <form action="{{ route('recipes.destroy', ['id' => $recipe->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>

            <!-- Comment Form -->
            <div class="comment-form">
                <h3>Add Comment</h3>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif    
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}"> <!-- Assuming $recipe is the variable containing the current recipe's details -->

                  <div class="form-group">
                       <label for="content">Comment:</label>
                     <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                  </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- End Comment Form -->

            <!-- Display Comments -->
            @if(isset($recipe->comments) && $recipe->comments->isNotEmpty())
                <h3 class="mt-4">Comments</h3>
                <ul class="comments">
                    @foreach($recipe->comments as $comment)
                        <li class="comment">
                            <p><strong>Name:</strong> {{ $comment->name ?? 'Anonymous' }}</p>
                            <p><strong>Email:</strong> {{ $comment->email ?? 'No email provided' }}</p>
                            <p><strong>Comment:</strong> {{ $comment->content }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No comments yet.</p>
            @endif
            <!-- End Display Comments -->

            <!-- Note Moyenne -->
            <div class="mt-4">
            <div>
                <p><strong>Note moyenne :</strong> {{ $recipe->ratings()->avg('stars') ?? 'Pas encore noté' }}</p>
            </div
                <form action="{{ route('ratings.store', ['recipe' => $recipe->id]) }}" method="POST">
                    @csrf
                    <label for="score">Note :</label>
                    <select name="score" id="score">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button type="submit">Noter</button>
                </form>
            </div>
            <!-- End Note Moyenne -->

        </div>
    </div>
    @endforeach
</div>
@endsection
