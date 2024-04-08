<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment; 
use Illuminate\Support\Facades\Mail;
use App\Mail\NewCommentNotification;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        
    $request->validate([
        'content' => 'required|string',
        'recipe_id' => 'required|exists:recipes,id', //  'recipes' is the table name for recipes
        'name' => 'required|string', // 'name' field in your form
        'email' => 'required|email', //  'email' field in your form
        'comment' => 'required|string', //  'comment' field in your form
    ]);

    // Create a new comment instance and fill it with validated data
    $comment = new Comment();
    $comment->content = $request->input('content');
    $comment->recipe_id = $request->input('recipe_id');
    $comment->name = $request->input('name');
    $comment->email = $request->input('email');
    $comment->comment = $request->input('comment');

    // Save the comment to the database
    $comment->save();

    return back()->with('success', 'Comment posted successfully!');
   }

    public function show($id)
    {
    // Assuming this is the method that returns the view where you're trying to display comments
    $recipe = Recipe::with('comments')->findOrFail($id);

    return view('recipe', compact('recipe'));
   }

}