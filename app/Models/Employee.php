<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nip', 'name', 'position', 'subject', 'employee_type',
        'education', 'photo', 'email', 'phone', 'status',
        'address',
        'join_date',
        'basic_salary',      // Gaji pokok (untuk Payroll)
        'tunjangan_jabatan', // Tunjangan Jabatan (untuk Payroll)
        'rate_per_jtm',      // Rate per Jam Tatap Muka (untuk kalkulasi gaji guru)
    ];

    protected $casts = [
        'join_date'       => 'date',
        'basic_salary'    => 'integer',
        'tunjangan_jabatan' => 'integer',
        'rate_per_jtm'    => 'integer',
    ];

    // =========================================
    // Relasi
    // =========================================
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'teacher_name', 'name');
    }
}

