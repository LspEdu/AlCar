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
    {
         \App\Models\User::factory(10)->create();

         $user = \App\Models\User::factory()->create([
             'name' => 'Elon',
             'ape1' => 'Musk',
             'tlf' => '655463621',
             'fechNac' => '1999-07-21',
             'email' => 'millonarioLoco@paypal.com',
             'rol' => 'user',
             'password' => Hash::make('testtest'),
             'dni' => '12321323T',
             'avatar' => 'storage/coches/Factory/elon.webp',
         ]);

         $user->coches()->create([
            'marca' => 'Audi',
            'modelo' => 'A7',
            'tipo' => 'utilitario',
            'precio' => 300,
            'matricula' => '3712JKL',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => null,
            'cilindrada' => null,
            'color' => null,
            'plazas' => 5,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/3712JKL/audiA7.png',
            'validado' => true,
         ]);

         $user->coches()->create([
            'marca' => 'Corvette',
            'modelo' => 'Stingray',
            'tipo' => 'superdeportivo',
            'precio' => 600,
            'matricula' => '4729JLU',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => null,
            'cilindrada' => null,
            'color' => null,
            'plazas' => 2,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/4729JLU/corvetteStingray.png',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'McLaren',
            'modelo' => '540c',
            'tipo' => 'superdeportivo',
            'precio' => 600,
            'matricula' => '3698MLS',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => null,
            'cilindrada' => null,
            'color' => null,
            'plazas' => 5,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/3698MLS/mclaren540c.jpeg',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'Porsche',
            'modelo' => 'Panamera',
            'tipo' => 'deportivo',
            'precio' => 350,
            'matricula' => '3945LSP',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => null,
            'cilindrada' => null,
            'color' => null,
            'plazas' => 5,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/3945LSP/porschePanamera.png',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'Shelby',
            'modelo' => 'Mustang',
            'tipo' => 'deportivo',
            'precio' => 300,
            'matricula' => '5423LSJ',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => null,
            'cilindrada' => null,
            'color' => null,
            'plazas' => 5,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/5423LSJ/shelbyMustang.jpg',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'Audi',
            'modelo' => 'Q8',
            'tipo' => 'utilitario',
            'precio' => 450,
            'matricula' => '3628KML',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => 'V8',
            'cilindrada' => null,
            'color' => 'Marrón',
            'plazas' => 7,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/3628KML/audiQ8.jpg',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'Audi',
            'modelo' => 'R8',
            'tipo' => 'deportivo',
            'precio' => 700,
            'matricula' => '5678KLP',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => 'V10',
            'cilindrada' => null,
            'color' => null,
            'plazas' => 2,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/5678KLP/audiR8.jpg',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'Audi',
            'modelo' => 'RS6 Avant',
            'tipo' => 'utilitario',
            'precio' => 400,
            'matricula' => '9012LMN',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => 'V8',
            'cilindrada' => null,
            'color' => null,
            'plazas' => 5,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/9012LMN/audirs6avant.jpg',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'Audi',
            'modelo' => 'RS7',
            'tipo' => 'deportivo',
            'precio' => 380,
            'matricula' => '3456KLQ',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => null,
            'cilindrada' => null,
            'color' => null,
            'plazas' => 5,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/3456KLQ/audirs7.jpg',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'Audi',
            'modelo' => 'S8',
            'tipo' => 'deportivo',
            'precio' => 300,
            'matricula' => '7890KLR',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => null,
            'cilindrada' => null,
            'color' => null,
            'plazas' => 5,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/7890KLR/audis8.jpg',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'BMW',
            'modelo' => 'Series 8',
            'tipo' => 'deportivo',
            'precio' => 300,
            'matricula' => '2345KLM',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => null,
            'cilindrada' => null,
            'color' => null,
            'plazas' => 3,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/2345KLM/bmw8.jpeg',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'BMW',
            'modelo' => 'M5',
            'tipo' => 'deportivo',
            'precio' => 300,
            'matricula' => '6789KLS',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => null,
            'cilindrada' => null,
            'color' => null,
            'plazas' => 5,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/6789KLS/bmwM5.jpeg',
            'validado' => true,
         ]);
         $user->coches()->create([
            'marca' => 'BMW',
            'modelo' => 'M8',
            'tipo' => 'deportivo',
            'precio' => 457,
            'matricula' => '0123KLM',
            'combustible' => 'gasolina',
            'cambio' => 'automatico',
            'ano' => 2022,
            'motor' => null,
            'cilindrada' => null,
            'color' => null,
            'plazas' => 4,
            'lat' => '36.78837',
            'lng' => '-6.34084',
            'foto' => 'storage/coches/Factory/0123KLM/bmwM8.jpg',
            'validado' => true,
         ]);



         \App\Models\User::factory()->create([
            'name' => 'huesped',
            'ape1' => 'huesped',
            'tlf' => '123123123',
            'dni' => '89898989R',
            'fechNac' => '1999-07-21',
            'email' => 'huesped@example.com',
            'rol' => 'user',
            'password' => Hash::make('testtest'),
        ]);

         \App\Models\User::factory()->create([
            'name' => 'admin',
            'ape1' => 'admin',
            'tlf' => '123123123',
            'dni' => '45453634E',
            'fechNac' => '1999-07-21',
            'email' => 'admin@example.com',
            'rol' => 'admin',
            'password' => Hash::make('adminadmin'),
        ]);


    }
}
