<!-- resources/views/recipes/single.blade.php -->
@extends('layouts/main')

@section('content')


<div class="columns is-multiline">
    <div class="column is-12">
        <h1 class="title">{{ $recipe->title }}</h1>
        <p>Utilisateur: {{ $recipe->user->name }}</p>
        <p>Description :{{ $recipe->content }}</p>
        <p>Ingrédients : {{ $recipe->ingredients}}</p>
    </div>
</div>




@endsection

