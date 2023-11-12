<?php

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

function encryptId($key)
{
    // ID to be encrypted
    $id = $key;

    // Encrypt the ID
    $encryptedId = Crypt::encryptString($id);

    return $encryptedId;
}

function decryptId($encryptedId)
{

    // Decrypt the ID
    $decrypted = Crypt::decryptString($encryptedId);

    return $decrypted;
}

function logTransaction($payload) {
    extract($payload);
    
    $transaction = new Transaction();

    $transaction->wallet_id = $user_id;
    $transaction->amount_paid = $amount_paid ?? "0";
    $transaction->convenienceFee = $convenienceFee ?? "0";
    $transaction->fee = $fee ?? "0";
    $transaction->switchFee = $switchFee ?? "0";
    $transaction->settlement_amount = $settlement_amount ?? "0";
    $transaction->status = $status;
    $transaction->description = $description;
    $transaction->currency = "NGN";
    $transaction->payment_method = $payment_method;
    $transaction->payment_type = $payment_type;
    $transaction->sender_wallet_id = $sender_wallet_id;

    $transaction->trans_ref = $trans_ref ?? bin2hex(random_bytes(5));
    $transaction->pay_ref = $pay_ref ?? bin2hex(random_bytes(5));
    $transaction->receiver = $receiver;
    $transaction->transaction_type = $transaction_type;
    $transaction->two_fa_code_verify = false;

    $transaction->save();
    return $transaction;
}