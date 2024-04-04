<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;


class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $recipes = Recipe::all();
        return view('recipes',[
            'recipes' => $recipes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipes.create',[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $recipe_url)
    {
        $recipe = \App\Models\Recipe::where('url',$recipe_url)->firstOrFail();

        return view('recipes/single', [
            'recipe' => $recipe,
            //'averageRating' => $averageRating,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // Validate request data
         $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'ingredients' => 'required',
            'price' => 'required|numeric',
            'tags' => 'nullable|string',
        ]);

        // Find the recipe
        $recipe = Recipe::findOrFail($id);

        // Update recipe
        $recipe->update($validatedData);

        return redirect('/recipes')->with('success', 'Recipe updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(string $id)
    {
        // Find the recipe
        $recipe = Recipe::findOrFail($id);

        // Delete the recipe
        $recipe->delete();

        return redirect('/recipes')->with('success', 'Recipe deleted successfully!');
    }
}
