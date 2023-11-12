<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'account_number',
        "available_balance",
        "locked_fund",
    ];

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
        'password' => 'hashed',
    ];

    public function setAvailableBalanceAttribute($value)
    {
        $this->attributes['available_balance'] = $value / 100;
    }

    public function getAvailableBalanceAttribute()
    {
        return $this->attributes['available_balance']* 100;
    }

    public function getLockedFundAttribute() {
        return $this->attributes['locked_fund'] * 100;
    }

    public function setLockedFundAttribute($value)
    {
        $this->attributes['locked_fund'] = $value / 100;
    }
}
