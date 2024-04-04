<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

         // Create 10 fake recipes
         \App\Models\Recipe::factory()->count(10)->create();

         // create 10 fake contacts
         \App\Models\Contact::factory()->count(10)->create();

         //create  10 fake comments 

         \App\Models\Comment::factory()->count(10)->create();



         //\App\Models\User::factory()->create([
           //  'name' => 'Test User',
        //    'email' => 'test@example.com',
        // ]);

        
    }
}
