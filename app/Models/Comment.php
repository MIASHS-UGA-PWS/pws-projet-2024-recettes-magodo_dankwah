<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments'; 
    protected $fillable = ['content', 'recipe_id'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Define any relationships if applicable
    public function recipe()
    {
        return $this->belongsTo(Recipe::class); // Assuming a comment belongs to a recipe

        
    }



}
