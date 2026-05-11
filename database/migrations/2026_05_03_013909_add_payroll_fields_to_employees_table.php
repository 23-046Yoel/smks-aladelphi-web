<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('address')->nullable()->after('phone');
            $table->date('join_date')->nullable()->after('address');
            $table->unsignedBigInteger('basic_salary')->default(0)->after('join_date');       // Gaji pokok
            $table->unsignedBigInteger('tunjangan_jabatan')->default(0)->after('basic_salary'); // Tunjangan
            $table->unsignedInteger('rate_per_jtm')->default(0)->after('tunjangan_jabatan');   // Rate per JTM (Jam Tatap Muka)
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['address', 'join_date', 'basic_salary', 'tunjangan_jabatan', 'rate_per_jtm']);
        });
    }
};
