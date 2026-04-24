<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'registration_number', 'name', 'email', 'phone', 
        'gender', 'previous_school', 'major', 'address', 'status'
    ];
    use HasFactory;
}
