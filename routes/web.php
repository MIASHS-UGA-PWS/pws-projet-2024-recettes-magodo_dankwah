<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;

Route::get('/', [HomeController::class, 'index']);

Route::get( '/recipes/create',[RecipeController::class, 'create'])->name('recipes.create');

Route::get('/recipes', [RecipeController::class, 'index']);

Route::get('/recipes/{url}', [\App\Http\Controllers\RecipeController::class, 'show'])->name('recipes.show');

Route::get('/contact', [ContactController::class, 'index']);
Route::get('/contact/create', [ContactController::class, 'create']);

Route::post('/contact', [ContactController::class, 'store']);

Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

// CRUD  :

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes');

//Route::get('/recipes/{recipe}/edit',[RecipeController::class, 'edit'])->name('edit');
Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
Route::put('/recipes/{recipe}',[RecipeController::class, 'update'])->name('update');


Route::post('/recipes',[RecipeController::class, 'store'])->name('store');

