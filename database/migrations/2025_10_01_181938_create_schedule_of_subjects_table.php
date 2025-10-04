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

        Schema::create('schedule_of_subjects', function (Blueprint $table) {
            $table->id();

            // Menggunakan sintaks yang lebih modern dan ringkas
            $table->foreignId('school_year_id')->constrained('school_year');
            $table->foreignId('classroom_id')->constrained('classroom');
            $table->foreignId('subject_id')->constrained('Subject'); // Pastikan nama tabel 'Subject' sudah benar
            $table->foreignId('teacher_id')->constrained('Users');   // Pastikan nama tabel 'Users' sudah benar

            // ✅ INI PERBAIKANNYA: Memberi nama custom yang lebih pendek untuk unique index
            $table->unique(
                ['classroom_id', 'subject_id', 'school_year_id'],
                'class_subject_year_unique' // Nama custom yang lebih pendek
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
        Schema::dropIfExists('schedule_of_subjects');
    }
};
