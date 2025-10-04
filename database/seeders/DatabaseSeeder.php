<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // User::factory(10)->create();
        Role::factory()->create([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);
        User::factory()->create([
            'name' => 'Admin banget',
            'username' => 'adminbanget',
            'email' => 'Admin_banget@dabas.id',
            'password' => bcrypt('Salah123@#'),
        ])
            ->assignRole('super_admin');;
        SchoolYear::factory()->create([
            'name' => '2025',
            'semester' => 'Ganjil',
            'is_active' => true,
        ]);
    }
}
