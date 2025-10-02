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

        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->enum('level', ["Awwaliyah", "Wustha", "Ulya"]);
            $table->unsignedBigInteger('hr_teacher_id')->nullable();
            $table->foreign('hr_teacher_id')->references('id')->on('Users');
            $table->unsignedBigInteger('school_year_id');
            $table->foreign('school_year_id')->references('id')->on('school_years');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }


    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
