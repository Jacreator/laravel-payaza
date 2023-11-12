<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKeys extends Model
{
    use HasFactory;

    protected $fillable = [
        "secret",
        "key",
        "user_agent",
        "user_id",
        "secret_value",
        "key_value",
    ];
}
