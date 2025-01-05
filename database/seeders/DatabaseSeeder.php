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
        //* crear 9 usuarios, 10 categorias y 1 usuario por defecto
        \App\Models\User::factory(9)->create();

        // ? Cada categoria va a tener 20 preguntas
            //* la relacion existe de forma fisica en los modelos
        \App\Models\Category::factory(10)->hasThreads(20)->create();
        
        \App\Models\User::factory()->create([
            'email' => 'ramcesvedes@gmail.com',
            'password'=>bcrypt("password"),
            'role' => 'admin'
        ]);

        \App\Models\Reply::factory(400)->create();
    }
}