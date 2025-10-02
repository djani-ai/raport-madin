<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin banget',
            'username' => 'adminbanget',
            'email' => 'Admin_banget@dabas.id',
            'password' => bcrypt('Salah123@#'),
        ]);

        SchoolYear::create([
            'name' => '2025',
            'semester' => 'Ganjil',
            'is_active' => true,
        ]);
    }
}
