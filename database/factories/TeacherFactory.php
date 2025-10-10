<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specializations = [
            'Matematika',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Ilmu Pengetahuan Alam (IPA)',
            'Ilmu Pengetahuan Sosial (IPS)',
            'Pendidikan Jasmani, Olahraga, dan Kesehatan (PJOK)',
            'Seni Budaya',
            'Fisika',
            'Kimia',
            'Biologi',
        ];
        return [
            'user_id' => User::factory(),
            'nip' => $this->faker->unique()->numerify('##################'),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'signature' => null,
            'specialization' => $this->faker->randomElement($specializations),
        ];
    }
}
