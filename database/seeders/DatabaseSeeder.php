<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin banget',
            'username' => 'adminbanget',
            'email' => 'Admin_banget@dabas.id',
            'password' => bcrypt('Salah123@#'),
        ]);
        SchoolYear::factory()->create([
            'name' => '2025/2026',
            'semester' => 'Ganjil',
            'is_active' => true,
        ]);
        Teacher::factory()->count(5)->create();
        Classroom::factory()->count(1)->create();
        Subject::factory()->count(5)->create();
        Student::factory()->count(10)->create();
    }
}
