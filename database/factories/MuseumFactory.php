<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Museum;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Museum>
 */
class MuseumFactory extends Factory
{
    protected $model = Museum::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 400; // para asegurar imagenes únicas
        return [
            'name' => $this->faker->unique()->company . ' Museum',
            'city' => $this->faker->unique()->city, // 1 museo por ciudad
            'schedule' => $this->faker->sentence(3), // frase corta de 3 palabras
            'visitguided' => $this->faker->randomElement(['sí', 'no']),
            'price' => $this->faker->randomFloat(2, 0, 30), // precio entre 0 y 30 € radom
            // imagen única: usamos picsum.photos con id creciente para que las imágenes no se repitan
            'urlImg' => 'https://picsum.photos/id/' . ($counter++ ).'/2000/1200.webp',
        ];
    }
}
