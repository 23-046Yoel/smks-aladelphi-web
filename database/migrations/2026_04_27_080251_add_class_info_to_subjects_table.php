<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('class_name')->nullable()->after('teacher_name'); // e.g., "X RPL 1"
            $table->string('class_president')->nullable()->after('class_name'); // Ketua kelas
        });
    }

    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn(['class_name', 'class_president']);
        });
    }
};
