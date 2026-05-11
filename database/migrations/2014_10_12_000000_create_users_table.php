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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // nullable untuk OAuth (Google Login)
            $table->rememberToken();

            // === Multi-Role & Identity ===
            $table->enum('role', ['super_admin', 'yayasan', 'bendahara', 'guru', 'staff', 'siswa', 'orang_tua'])
                  ->default('siswa');

            // Relasi ke tabel profil (nullable karena admin tidak punya profil)
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();

            // === Google OAuth ===
            $table->string('google_id')->nullable()->unique();
            $table->string('avatar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
