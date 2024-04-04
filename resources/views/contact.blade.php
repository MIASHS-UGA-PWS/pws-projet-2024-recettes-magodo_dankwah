@extends('layouts.main')

@section('content')

<style>
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="phone"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box; /* To include padding and border in the width */
        }

        textarea {
            resize: vertical; /* Allow vertical resizing */
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .success-message {
            margin-top: 70px;
            padding: 10px;
            background-color: #dff0d8;
            border: 1px solid #d0e9c6;
            border-radius: 3px;
        }

        h1 {
            text-align: center; /* Center align the heading */
            font-size: 2em; /* Adjust the font size */
            color: #333; /* Set the color */
            margin-bottom: 20px; /* Add some space below the heading */
        }
    </style>

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