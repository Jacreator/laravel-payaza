<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('wallet_id');
            $table->string('amount_paid');
            $table->string('convenienceFee');
            $table->string('fee');
            $table->string('switchFee');
            $table->string('settlement_amount');
            $table->string('status');
            $table->string('description');
            $table->string('currency');
            $table->string('payment_method');
            $table->string('payment_type');
            $table->string('sender_wallet_id');
            $table->string('trans_ref');
            $table->string('pay_ref');
            $table->string('receiver');
            $table->string('transaction_type');
            $table->string('two_fa_code_verify');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
