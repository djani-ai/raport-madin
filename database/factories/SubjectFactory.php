<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected static $subjectNumber = 1;
    public function definition(): array
    {
        $subjects = [
            ['name' => 'Al-Qur\'an Hadits', 'arabic_name' => 'القرآن الحديث'],
            ['name' => 'Aqidah Akhlaq', 'arabic_name' => 'عقيدة أخلاق'],
            ['name' => 'Fiqih', 'arabic_name' => 'فقه'],
            ['name' => 'Sejarah Kebudayaan Islam', 'arabic_name' => 'تاريخ الثقافة الإسلامية'],
            ['name' => 'Bahasa Arab', 'arabic_name' => 'اللغة العربية'],
            ['name' => 'Matematika', 'arabic_name' => 'رياضيات'],
            ['name' => 'Bahasa Indonesia', 'arabic_name' => 'اللغة الإندونيسية'],
            ['name' => 'Ilmu Pengetahuan Alam', 'arabic_name' => 'علوم طبيعية'],
            ['name' => 'Ilmu Pengetahuan Sosial', 'arabic_name' => 'علوم اجتماعية'],
        ];
        $subject = $this->faker->unique()->randomElement($subjects);
        return [
            'no' => self::$subjectNumber++,
            'name' => $subject['name'],
            'arabic_name' => $subject['arabic_name'],
        ];
    }
}
