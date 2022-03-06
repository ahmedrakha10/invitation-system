<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteCode extends Model
{
    use HasFactory;

    protected $table    = 'invite_codes';
    protected $fillable = ['code', 'user_id', 'quantity', 'quantity_used'];

    protected $casts = [
        'expires_at'  => 'datetime',
        'approved_at' => 'datetime'
    ];

    public function hasAvailableQuantity()
    {
        return $this->quantity_used < $this->quantity;
    }

    public function hasExpired()
    {
        return $this->expires_at?->lt(now());
    }
}
