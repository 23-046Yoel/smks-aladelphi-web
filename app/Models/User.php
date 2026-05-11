<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'student_id',
        'employee_id',
        'google_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // =========================================
    // Relasi ke profil (Student / Employee)
    // =========================================
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // =========================================
    // Helper: cek role secara langsung
    // =========================================
    public function isYayasan(): bool    { return $this->role === 'yayasan'; }
    public function isBendahara(): bool  { return $this->role === 'bendahara'; }
    public function isGuru(): bool       { return $this->role === 'guru'; }
    public function isSiswa(): bool      { return $this->role === 'siswa'; }
    public function isSuperAdmin(): bool { return $this->role === 'super_admin'; }
}
