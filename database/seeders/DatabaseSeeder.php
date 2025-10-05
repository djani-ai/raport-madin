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
        // User::factory(10)->create();
        // Role::factory()->create([
        //     'name' => 'super_admin',
        //     'guard_name' => 'web',
        // ]);
        User::factory()->create([
            'name' => 'Admin banget',
            'username' => 'adminbanget',
            'email' => 'Admin_banget@dabas.id',
            'password' => bcrypt('Salah123@#'),
        ]);
        SchoolYear::factory()->create([
            'name' => '2025',
            'semester' => 'Ganjil',
            'is_active' => true,
        ]);
        Teacher::factory()->create([
            'name' => 'Guru HR 1',
            'nip' => '1234567890'
        ]);
        Classroom::factory()->create([
            'name' => '1A',
            'level' => 'Awwaliyah',
            'school_year_id' => 1,
            'hr_teacher_id' => 1,
        ]);
        Subject::factory()->create([
            'name' => 'Bahasa Arab',
            'arabic_name' => 'اللغة العربية',
            'no' => 1,
        ]);
        Student::factory()->create([
            'student_number' => '2025001',
            'name' => 'Siswa 1',
            'gender' => 'L',
        ]);
    }
}
