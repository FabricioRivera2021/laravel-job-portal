<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employer;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //creando un usuario para pruebas de login
        User::factory()->create([
            'name' => 'Fabricio Rivera',
            'email' => 'Fabricio@rivera.com',
        ]);

        //creando 300 usuarios
        User::factory(300)->create();
        $users = User::all()->shuffle();
        //creando los empleadores (todos deben pertenecer a un usuario, mas no todos los users son empleadores)
        for ( $i = 0; $i < 20; $i++ ) {
            Employer::factory()->create([
                //se crean 20 empleadores, cada ves que se genera uno se elimina un usuario del loop para que no se repita
                'user_id' => $users->pop()->id 
            ]);
        }

        $employers = Employer::all();
        //se crean 100 ofertas de trabajo
        for ( $i = 0; $i < 100; $i++ ) {
            Job::factory()->create([
                'employer_id' => $employers->random()->id
            ]);
        }

        //para cada usuario
        foreach($users as $user){
            //carga en la variable $jobs de 0 a 4 jobs
            $jobs = Job::inRandomOrder()->take(rand(0, 4))->get();

            //para cada job
            foreach($jobs as $job){
                //crea una aplicacion a "jobApplication" del usuario que se esta iterando en ese momento
                JobApplication::factory()->create([
                    'job_id' => $job->id,
                    'user_id' => $user->id
                ]);
            }
        }

        // \App\Models\User::factory(10)->create();
    }
}
