<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    /*{
        return view('welcome');
    }*/

    {
        $recipes = Recipe::latest()->take(3)->get();
        return view('welcome', ['recipes' => $recipes]);
    }

}





