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
use App\Models\Practice;
use App\Models\Reservation;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 20 categorías
        $categories = Category::factory(20)->create();

        // Crear usuarios
        $users = User::factory(10)->create();
        $trainers = User::factory(3)->create(['role' => 'trainer']);

        // Crear usuario administrador
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'ramcesvedes@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $users->push($admin);
        $users = $users->merge($trainers);

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

                // Crear progreso para cada ejercicio
                foreach ($exercises as $exercise) {
                    Progress::factory(3)->create([
                        'user_id' => $user->id,
                        'exercise_id' => $exercise->id
                    ]);
                }
            }
        }

        // Crear hilos y respuestas
        Thread::factory(20)->create([
            'category_id' => fn() => $categories->random()->id
        ])->each(function ($thread) use ($users) {
            Reply::factory(rand(1, 5))->create([
                'thread_id' => $thread->id,
                'user_id' => $users->random()->id
            ]);
        });

        // Crear prácticas para los próximos 30 días
        $startDate = Carbon::now()->startOfDay();
        $classNames = [
            'Yoga Básico', 'Pilates', 'Zumba', 'Spinning', 'CrossFit', 
            'Body Combat', 'Stretching', 'Funcional', 'GAP', 'Body Pump'
        ];
        
        foreach ($trainers as $trainer) {
            for ($i = 0; $i < 30; $i++) {
                $date = $startDate->copy()->addDays($i);
                
                // Crear 2-4 clases por día
                $numClasses = rand(2, 4);
                for ($j = 0; $j < $numClasses; $j++) {
                    $hour = rand(8, 20); // Clases entre 8 AM y 8 PM
                    $minute = rand(0, 1) * 30; // Minutos en 0 o 30
                    
                    $practice = Practice::create([
                        'trainer_id' => $trainer->id,
                        'name' => $classNames[array_rand($classNames)],
                        'description' => 'Clase de ' . $classNames[array_rand($classNames)] . ' con ' . $trainer->name,
                        'date_time' => $date->copy()->setTime($hour, $minute),
                        'capacity' => rand(10, 20),
                        'duration' => rand(1, 2) * 30 // 30 o 60 minutos
                    ]);

                    // Agregar algunas reservas aleatorias
                    $maxReservations = min($practice->capacity - 1, $users->count() - 1);
                    $numReservations = rand(0, $maxReservations);
                    $reservedUsers = $users->random($numReservations);
                    
                    foreach ($reservedUsers as $user) {
                        Reservation::create([
                            'user_id' => $user->id,
                            'practice_id' => $practice->id,
                            'date' => $date->toDateString()
                        ]);
                    }
                }
            }
        }
    }
}