<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RatingsController extends Controller
{


public function store(Request $request, $recipe)
{
    $anonymousUser = User::firstOrCreate(
        ['email' => 'anonymous@user.com'],
        ['name' => 'Anonymous', 'password' => Hash::make('password')]
    );

    $rating = new Rating;
    $rating->recipe_id = $recipe;
    $rating->stars = $request->score;
    $rating->user_id = $anonymousUser->id;
    $rating->save();

    return back();
}
}