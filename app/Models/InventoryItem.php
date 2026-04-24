<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_code', 'name', 'category', 'quantity', 
        'location', 'condition', 'photo', 'description'
    ];
}
