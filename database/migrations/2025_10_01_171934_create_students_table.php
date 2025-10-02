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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_number', 20)->unique();
            $table->string('national_id', 20)->nullable();
            $table->string('name', 100);
            $table->enum('gender', ["L", "P"]);
            $table->string('birth_place', 50)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('religion', 20)->nullable();
            $table->integer('child_number')->nullable();
            $table->string('family_status', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('school_name', 100)->nullable();
            $table->string('father_name', 100)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('father_national_id', 20)->nullable();
            $table->string('mother_national_id', 20)->nullable();
            $table->string('father_job', 50)->nullable();
            $table->string('mother_job', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
