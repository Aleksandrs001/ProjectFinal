<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;

    protected $fillable=[
        'acc_id',
        'crypto_symbol',
        'crypto_info',
        'crypto_buy_price',
        'crypto_sell_price',
        'crypto_buy_amount',
        'crypto_sell_amount',
        'crypto_amount',
        'crypto_buy_price*amount',
        'crypto_sell_price*amount',
    ];

}
