<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use function Illuminate\Support\enum_value;

class StudentFactory extends Factory
{

    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');
        return [
            'student_number' => $faker->unique()->numerify('SIS########'),
            'national_id' => $faker->numerify('################'),
            'name' => $faker->name(),
            'gender' => $faker->randomElement(['L', 'P']),
            'birth_place' => $faker->city(),
            'birth_date' => $faker->dateTimeBetween('-15 years', '-10 years')->format('Y-m-d'),
            'religion' => $faker->randomElement([
                'Islam',
                'Kristen',
                'Katolik',
                'Hindu',
                'Buddha',
                'Konghucu'
            ]),
            'child_number' => $faker->numberBetween(1, 5),
            'family_status' => $faker->randomElement([
                'Anak Kandung',
                'Anak Angkat',
                'Anak Tiri'
            ]),
            'address' => $faker->address(),
            'school_name' => 'MI ' . $faker->city(), // contoh: MI Yogyakarta
            'father_name' => $faker->name('male'),
            'mother_name' => $faker->name('female'),
            'father_national_id' => $faker->numerify('################'),
            'mother_national_id' => $faker->numerify('################'),
            'father_job' => $faker->randomElement([
                'PNS',
                'Petani',
                'Wiraswasta',
                'Buruh',
                'Guru',
                'Nelayan',
                'Karyawan Swasta',
                'Tidak Bekerja'
            ]),
            'mother_job' => $faker->randomElement([
                'PNS',
                'Ibu Rumah Tangga',
                'Wiraswasta',
                'Guru',
                'Karyawan Swasta',
                'Tidak Bekerja'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
