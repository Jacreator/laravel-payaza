<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserID extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pin',
    ];

    public function validPin($pin) {
        $dbPin = decryptId($this->pin);
        if ($pin == $dbPin) {
            return true;
        }
        return false;
    }
}
