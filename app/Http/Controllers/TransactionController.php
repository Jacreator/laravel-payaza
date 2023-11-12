<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitTransactionRequest;
use App\Http\Requests\VerifyTransactionRequest;
use Exception;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Service\TransactionService;

class TransactionController extends Controller
{
    public $tranService;
    public function __construct() {
        $this->tranService = new TransactionService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function initTransaction(InitTransactionRequest $request) {
        try {
            return response()->json([
                "code" => 200,
                "message" => "Transaction init successfully",
                "data" => $this->tranService->initiateFundsTransfer($request->all())
            ]);
        } catch(Exception $error) {
            return response()->json([
                "code" => 400,
                "message" => $error->getMessage()
            ]);
        }
    }

    public function verifyTransaction(VerifyTransactionRequest $request){
        try {
            return response()->json([
                "code"=> 200,
                "message"=> "transaction completed successfully",
                "data"=> $this->tranService->verifyTransaction($request->all())
            ]);
        } catch(Exception $error) {
            return response()->json([
                "code"=> 400,
                "message"=> $error->getMessage()
            ]);
        }
    }
}
