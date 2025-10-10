<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolYearFactory extends Factory
{

    public function definition(): array
    {
        // Menghasilkan tahun awal yang unik antara 2020 dan 2030
        $startYear = $this->faker->unique()->numberBetween(2020, 2030);

        // Membuat format nama tahun ajaran, contoh: "2024/2025"
        $yearName = $startYear . '/' . ($startYear + 1);

        return [
            'name' => $yearName,
            'semester' => $this->faker->randomElement(['Ganjil', 'Genap']),
            'is_active' => false, // Default-nya tidak aktif
        ];
    }
}
