<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('student_classrooms', function (Blueprint $table) {
            $table->id();

            // Menggunakan sintaks yang lebih modern dan ringkas untuk foreign key
            $table->foreignId('school_years_id')->constrained('school_years');
            $table->foreignId('classrooms_id')->constrained('classrooms');
            $table->foreignId('students_id')->constrained('Students');

            // ✅ INI PERBAIKANNYA: Memberi nama spesifik yang lebih pendek untuk unique index
            $table->unique(
                ['school_years_id', 'classrooms_id', 'students_id'],
                'student_classroom_year_unique' // Nama custom yang pendek
            );

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_classrooms');
    }
};
