<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {/*
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->has(\App\Models\Coche::factory(10))->create([
             'name' => 'Test',
             'ape1' => 'test',
             'tlf' => '123123123',
             'fechNac' => '1999-07-21',
             'email' => 'test@example.com',
             'rol' => 'user',
             'password' => Hash::make('testtest'),
         ]); */

         \App\Models\User::factory()->create([
            'name' => 'huesped',
            'ape1' => 'huesped',
            'tlf' => '123123123',
            'fechNac' => '1999-07-21',
            'email' => 'huesped@example.com',
            'rol' => 'user',
            'password' => Hash::make('huesped123'),
        ]);
/*
         \App\Models\User::factory()->create([
            'name' => 'admin',
            'ape1' => 'admin',
            'tlf' => '123123123',
            'fechNac' => '1999-07-21',
            'email' => 'admin@example.com',
            'rol' => 'admin',
            'password' => Hash::make('adminadmin'),
        ]);

 */
    }
}
