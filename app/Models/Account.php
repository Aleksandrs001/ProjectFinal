<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'balance',
        'label',
        'valute',
        'deleted_at',

    ];
    use SoftDeletes;
    protected $dates = [
        'deleted_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function getCurrencySymbolAttribute(): string
    {
        return $this->valute;
    }
    public function getFormattedBalance(): string
    {
        return number_format($this->balance /100, 2);
    }
    public function userCard(): BelongsTo
    {
        return $this->belongsTo(UserCard::class);
    }
    public function crypto(): BelongsTo
    {
        return $this->belongsTo(Crypto::class);
    }

}
