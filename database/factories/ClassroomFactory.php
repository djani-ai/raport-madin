<?php

namespace Database\Factories;

use App\Models\SchoolYear;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomFactory extends Factory
{

    public function definition(): array
    {
        $levels = ['Awwaliyah', 'Wustha', 'Ulya'];
        $level = $this->faker->randomElement($levels);
        $className = $level . ' ' . $this->faker->randomElement(['A', 'B', 'C', '1', '2']);
        return [
            'name' => $className,
            'level' => $level,
            'hr_teacher_id' => Teacher::query()->inRandomOrder()->first()?->user_id,
            'school_year_id' => function () {
                return SchoolYear::where('is_active', true)->inRandomOrder()->first()->id;
            },
        ];
    }
}
