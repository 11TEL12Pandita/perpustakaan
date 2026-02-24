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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'siswa']);
            $table->timestamps();
        });

        // Tabel untuk data siswa
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->string('nis')->unique();
            $table->string('nama');
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // Tabel untuk data admin
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('user');
    }
};
