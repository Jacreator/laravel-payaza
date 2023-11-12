<?php

namespace App\Service;

use App\Models\User;
use App\Models\Transaction;
use App\Service\BaseService;
use App\Eunms\ETransferStatus;
use App\Eunms\ETransactionType;
use Illuminate\Support\Facades\DB;
use App\Eunms\ETransferPaymentType;
use App\Eunms\ETransferPaymentMethod;
use Exception;

class TransactionService extends BaseService
{
    protected $userService;
    protected $userIDService;

    public function __construct()
    {
        $this->model = new Transaction();
        $this->userService = new UserService();
        $this->userIDService = new UserIDService();
    }

    public function initiateFundsTransfer($payload)
    {
        try {
            [
                'receiver_email' => $receiver_email,
                'amount' => $amount,
                'fee' => $fee,
                'total_amount' => $total_amount,
                'description' => $description,
                'email' => $email,
                'user' => $user,
                'transType' => $transType,
            ] = $payload;

            $user = $this->userService->find($user);

            if (strtolower($email) === strtolower($receiver_email)) {
                return 'sender and receiver cannot be the same person!';
            }

            $userWalletExist = $this->userService->findByWhere('email', $email);

            $receiver = $this->userService->findByWhere('email', strtolower($receiver_email));

            if (!$receiver) {
                return 'receiver wallet does not exist!';
            }

            if ($userWalletExist->available_balance < intval($total_amount)) {
                return 'insufficient funds!';
            }

            // Generate transaction record
            $prepareTransactionLog = [
                'user_id' => $user->id,
                'amount_paid' => $total_amount,
                'fee' => $fee,
                'switchFee' => $fee,
                'settlement_amount' => $amount,
                'status' => ETransferStatus::PENDING,
                'description' => $description ?: $user->name,
                'payment_method' => ETransferPaymentMethod::WALLET_WALLET,
                'payment_type' => ETransferPaymentType::DEBIT,
                'sender_wallet_id' => $user->id,
                'receiver' => $receiver->id,
                'transaction_type' => ETransactionType::TRANSFER,
            ];

            $transaction = logTransaction($prepareTransactionLog);

            // Notify user of credit
            $OTPMessage = null;

            $name = $receiver->name;

            return [
                'message' => $OTPMessage ?: 'Enter your PIN to complete the transaction',
                'receiver' => ['name' => $name, 'email' => $receiver->email],
                'transaction' => [
                    'trans_ref' => $transaction->trans_ref,
                    'amount' => $amount,
                    'fee' => $fee,
                    'total_amount' => $total_amount,
                ],
                'id' => $transaction->id,
            ];
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function verifyTransaction($payload)
    {
        try {
            $transRef = $payload['trans_ref'];
            $otp = $payload['otp'];
            $receiverType = $payload['receiverType'];
            $userId = $payload['user'];

            $trans = $this->findByWhere('trans_ref', $transRef);

            if (!$trans) {
                return 'unknown transaction reference!';
            }

            if ($trans->status !== 'pending') {
                return 'transaction already completed!';
            }

            // get sender
            $senderWallet = $this->userService->findByWhere('id', $trans->wallet_id);

            if (!$senderWallet) {
                return 'invalid sender wallet';
            }

            if ($receiverType === 'wallet') {
                return $this->transactionToWallet([
                    'trans' => $trans,
                    'otp' => $otp,
                    'senderWallet' => $senderWallet,
                    'userId' => $userId
                ]);
            } elseif ($receiverType === 'bank') {
                return $this->transactionToBank([$trans, $otp, $senderWallet, $userId]);
            }
        } catch (Exception $error) {

            return $error->getMessage();
        }
    }

    public function transactionToWallet($payload)
    {
        try {
            $trans = $payload['trans'];
            $userId = $payload['userId'];
            $otp = $payload['otp'];
            $senderWallet =  $payload['senderWallet'];


            // get receiver wallet
            $receiverWallet = $this->userService->findByWhere('id', $trans->receiver);

            $userPin = $this->userIDService->findByWhere('user_id', $userId);
            if (!$userPin->validPin($otp)) {
                return 'Invalid OTP or Pin provided!';
            }

            // sender balance verification second instance
            if ($senderWallet->available_balance < intval($trans->amount_paid)) {
                return 'Insufficient funds!';
            }
            $amountPaid = intval($trans->amount_paid);
            // Debit sender available balance and put on lock
            $senderWallet->available_balance -= $amountPaid;
            $senderWallet->locked_fund += $amountPaid;
            $senderWallet->save();
            

            // Credit receiver wallet
            // $receiverWallet->ledger_balance += $trans->settlement_amount;
            $receiverWallet->available_balance += $trans->settlement_amount;
            $receiverWallet->save();

            // Remove funds from locked funds and ledger for sender
            $senderWalletDebitLockAndLedger = $this->userService->findByWhere('id', $senderWallet->id);
            $senderWalletDebitLockAndLedger->locked_fund -= $amountPaid;
            $senderWalletDebitLockAndLedger->save();

            // Update transaction record for sender
            $trans->sender_wallet_id = $senderWallet->id;
            $trans->status = 'completed';
            $trans->two_fa_code_verify = true;
            $trans->save();

            return $trans;
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
    private function transactionToBank($payload)
    {
    }
}
