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
    .comment-form {
        margin-top: 30px;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
    }
    .comment-form h3 {
        font-size: 1.2em;
        margin-bottom: 15px;
    }
    .comment-form label {
        font-weight: bold;
    }
    .comment-form input[type="text"],
    .comment-form input[type="email"],
    .comment-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box; /* Include padding and border in element's total width and height */
    }
    .comment-form textarea {
        resize: vertical;
    }
    .comment-form button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    .comment-form button[type="submit"]:hover {
        background-color: #0056b3;
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

            <!-- Comment Form -->
            <div class="comment-form">
                <h3>Leave a Comment</h3>
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="save-info">
                        <label class="form-check-label" for="save-info">Save my name and email in this browser for the next time I comment.</label>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LcAULIpAAAAAAviEye9KXP9nPIxON3enHvKMYzq"></div>
                    <!-- Add your CAPTCHA integration code here if applicable -->
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
            </div>
            <!-- End Comment Form -->
        </div>
    </div>
    @endforeach
   <!-- <script src="https://www.google.com/recaptcha/enterprise.js?render=6LcAULIpAAAAAAviEye9KXP9nPIxON3enHvKMYzq"></script>
    <script>
    function onClick(e) {
    e.preventDefault();
    grecaptcha.enterprise.ready(async () => {
      const token = await grecaptcha.enterprise.execute('6LcAULIpAAAAAAviEye9KXP9nPIxON3enHvKMYzq', {action: 'LOGIN'});
    }); 
    </script>-->
    
</div>
@endsection