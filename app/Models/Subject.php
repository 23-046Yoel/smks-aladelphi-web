<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'code', 'teacher_name'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
