<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'class',
        'major',
        'spp_amount',
    ];

    public function sppPayments()
    {
        return $this->hasMany(SppPayment::class);
    }
}
