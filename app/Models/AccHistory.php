<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccHistory extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'currency_symbol',
        'history',
        'transferred_from',
        'transferred_to',
    ];
}
