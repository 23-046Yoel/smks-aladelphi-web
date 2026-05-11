<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('email')->nullable()->after('nis');
            $table->string('phone')->nullable()->after('email');
            $table->string('parent_phone')->nullable()->after('phone'); // WA orang tua
            $table->enum('status', ['aktif', 'alumni', 'keluar'])->default('aktif')->after('major');
            $table->unsignedSmallInteger('graduation_year')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone', 'parent_phone', 'status', 'graduation_year']);
        });
    }
};
