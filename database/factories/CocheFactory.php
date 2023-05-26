<?php

namespace Database\Factories;

use App\Models\Coche;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coche>
 */
class CocheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'marca' => $this->faker->company,
            'modelo' => $this->faker->word,
            'tipo' => $this->faker->randomElement(Coche::TIPOS),
            'precio' => $this->faker->randomFloat(2, 1000, 100000),
            'matricula' => $this->faker->bothify('####???'),
            'combustible' => $this->faker->randomElement(Coche::COMBUSTIBLES),
            'cambio' => $this->faker->randomElement(Coche::CAMBIO),
            'ano' => $this->faker->year,
            'motor' => $this->faker->randomFloat(1, 1.0, 4.0),
            'cilindrada' => $this->faker->randomNumber(4),
            'color' => $this->faker->safeColorName,
            'plazas' => $this->faker->randomNumber(1, false),
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'foto' => 'storage/coches/Factory/coche.jpg',
            'validado' => true,
        ];
    }
}
