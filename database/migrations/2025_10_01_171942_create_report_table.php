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
            $table->unsignedBigInteger('school_year_id');
            $table->foreign('school_year_id')->references('id')->on('school_year');
            $table->unsignedBigInteger('students_id');
            $table->foreign('students_id')->references('id')->on('Students');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('Class');
            $table->integer('rank')->nullable();
            $table->text('guardian_note')->nullable();
            $table->text('head_note')->nullable();
            $table->enum('status_up', ["Naik", "Tinggal", "Lulus"])->nullable();
            $table->date('print_date')->nullable();
            $table->unique(['school_year_id', 'students_id', 'class_id']);
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
