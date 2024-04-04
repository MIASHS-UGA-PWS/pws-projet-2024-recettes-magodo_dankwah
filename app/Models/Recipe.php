<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recipes';

    /**
     * Get the user who authored the recipe.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
