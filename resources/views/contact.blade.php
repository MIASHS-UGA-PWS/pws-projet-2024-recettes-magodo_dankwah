@extends('layouts.main')

@section('content')

    <h1>Contact Us</h1>

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/contact">
        @csrf

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required />

        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required />

        <br>
        

        <label for="phone">Phone:</label>
        <input type="phone" name="phone" id="phone" required />

        <br>

        <label for="message">Message:</label>
        <textarea name="message" id="message"></textarea>

        <br>

        <button type="submit">Submit</button>
    </form>
@endsection