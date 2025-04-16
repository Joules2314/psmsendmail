<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Email;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Cria 10 usuarios 
        User::factory(10)->create()->each(function ($user) {

            Email::factory()->create([
                'user_id'=>$user->id,
                'user_name'=> $user->name,
            ]);
        }); 

    }
}
