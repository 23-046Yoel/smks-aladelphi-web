<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nis',
        'name',
        'class',
        'major',
        'spp_amount',
        'email',
        'phone',
        'parent_phone',  // Nomor WA orang tua (untuk notifikasi Kirimi.id)
        'status',        // 'aktif', 'alumni', 'keluar'
        'graduation_year',
    ];

    protected $casts = [
        'graduation_year' => 'integer',
    ];

    // =========================================
    // Relasi
    // =========================================
    public function sppPayments()
    {
        return $this->hasMany(SppPayment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    // =========================================
    // Scope: Filter hanya siswa aktif
    // =========================================
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope: Filter hanya alumni
    public function scopeAlumni($query)
    {
        return $query->where('status', 'alumni');
    }
}

