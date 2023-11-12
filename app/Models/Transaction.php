<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "wallet_id",
        "amount_paid",
        "convenienceFee",
        "fee",
        "switchFee",
        "settlement_amount",
        "status",
        "description",
        "currency",
        "payment_method",
        "payment_type",
        "sender_wallet_id",
        "trans_ref",
        "pay_ref",
        "receiver",
        "transaction_type",
        "two_fa_code_verify",
    ];
}
