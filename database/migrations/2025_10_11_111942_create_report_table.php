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

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_year_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('classroom_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('total_score')->nullable();
            $table->integer('average_score')->nullable();
            $table->integer('rank')->nullable();
            $table->text('guardian_note')->nullable();
            $table->text('head_note')->nullable();
            $table->integer('presense_sick')->nullable();
            $table->integer('presense_permission')->nullable();
            $table->integer('presense_absen')->nullable();
            $table->enum('behavior', ["A", "B", "C", "D", "E"])->nullable();
            $table->enum('orderly', ["A", "B", "C", "D", "E"])->nullable();
            $table->enum('perseverance', ["A", "B", "C", "D", "E"])->nullable();
            $table->enum('status_up', ["Naik", "Tinggal", "Lulus"])->nullable();
            $table->date('print_date')->nullable();
            $table->unique(['school_year_id', 'student_id', 'classroom_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
