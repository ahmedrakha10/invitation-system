<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activated_at'
    ];


    // Attr

    public function active()
    {
        return !is_null($this->activated_at);
    }

    public function activate()
    {
        $this->update(['activated_at' => now()]);
    }

    public function inviteCodes()
    {
        return $this->hasMany(InviteCode::class);
    }

    public function reachedInviteCodeRequestLimit()
    {
        return $this->inviteCodes()->count() >= 3;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'activated_at'      => 'datetime',
    ];
}
