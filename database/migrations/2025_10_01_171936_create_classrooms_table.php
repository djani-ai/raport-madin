<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->enum('level', ["Awwaliyah", "Wustha", "Ulya"]);
            $table->foreignId('hr_teacher_id')->references('id')->on('users')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('school_year_id')->references('id')->on('school_years')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }


    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
