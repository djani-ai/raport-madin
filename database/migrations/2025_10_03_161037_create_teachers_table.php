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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade'); // jika user dihapus, guru ikut terhapus
            $table->string('nip', 30)->nullable()->unique(); // Nomor Induk Pegawai (optional)
            $table->string('name', 100); // nama lengkap
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('signature', 255)->nullable();
            $table->string('specialization', 100)->nullable(); // mapel utama
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
