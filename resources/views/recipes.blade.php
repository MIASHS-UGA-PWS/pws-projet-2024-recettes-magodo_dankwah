@extends('layouts/main')

@section('content')

@foreach ($recipes as $recipe)
<div class="columns is-multiline">
    <div class="column is-12">
        <h1 class="title">{{ $recipe->title }}</h1>
        <p>Utilisateur: {{ $recipe->user->name }}</p>
        <p>Description :{{ $recipe->content }}</p>
        <p>Ingrédients : {{ $recipe->ingredients}}</p>
        <a href="{{ route('recipes.show', ['url' => $recipe->url]) }}">Read more</a>
    </div>
</div>
@endforeach



@endsection