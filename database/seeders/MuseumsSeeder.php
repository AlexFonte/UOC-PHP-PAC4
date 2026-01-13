<?php

namespace Database\Seeders;

use App\Models\Museum;
use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MuseumsSeeder extends Seeder
{
    /**
     * Run the database seeds for museums.
     */
    public function run(): void
    {
        // 1) Crear 4 temáticas (valores controlados)
        $topics = collect([
            'arqueología',
            'ciencia',
            'historia del arte',
            'historia',
        ])->map(fn($name) => Topic::firstOrCreate(['name' => $name]));

        // 2) Crear 40 museos ficticios
        $museums = Museum::factory()->count(40)->create();

        // 3) Minimo 20 museos con mínimo 2 temáticas
        $museums->take(20)->each(function ($museum) use ($topics) {
            $museum->topics()->sync(
                $topics->random(3)->pluck('id')->all()
            );
        });

        // 4) El resto con 1 o 2 temáticas
        $museums->skip(20)->each(function ($museum) use ($topics) {
            $museum->topics()->sync(
                $topics->random(rand(1, 2))->pluck('id')->all()
            );
        });

    }
}
