<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('sort')->nullable();
            $table->foreignId('school_year_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('classroom_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('lock_value_status')->nullable()->default(false);
            $table->timestamps();
            $table->unique(['school_year_id', 'classroom_id', 'subject_id', 'teacher_id'], 'unique_schedule');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
