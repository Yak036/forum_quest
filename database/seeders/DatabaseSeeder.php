<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Routine;
use App\Models\Exercise;
use App\Models\Progress;
use App\Models\Category;
use App\Models\Thread;
use App\Models\Reply;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 20 categorías
        Category::factory(20)->create();

        // Crear usuarios
        $users = User::factory(10)->create();

        // Crear usuario administrador
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'ramcesvedes@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $users->push($admin);

        // Crear rutinas, ejercicios y progresos para cada usuario
        foreach ($users as $user) {
            // Crear 5 rutinas para el usuario
            $routines = Routine::factory(5)->create([
                'user_id' => $user->id
            ]);

            foreach ($routines as $routine) {
                // Crear 5 ejercicios para la rutina
                $exercises = Exercise::factory(5)->create([
                    'routine_id' => $routine->id
                ]);

                foreach ($exercises as $exercise) {
                    // Crear 2 progresos para el ejercicio
                    Progress::factory(2)->create([
                        'exercise_id' => $exercise->id
                    ]);
                }
            }
        }

        // Obtener todas las categorías para asignarlas a los threads
        $categories = Category::all();

        // Crear threads con categorías aleatorias
        Thread::factory(20)->create([
            'category_id' => function () use ($categories) {
                return $categories->random()->id;
            }
        ]);

        // Crear replies
        Reply::factory(400)->create();
    }
}