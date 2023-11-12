<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserIdCreateRequest;
use App\Models\UserID;
use App\Service\UserIDService;
use Exception;
use Illuminate\Http\Request;

class UserIDController extends Controller
{
    protected $userIdService;
    public function __construct() {
        $this->userIdService = new UserIDService();
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
    public function store(UserIdCreateRequest $request)
    {
        try {
            return response()->json([
                'code' => 200,
                'message'=> 'created successfully',
                "data"=> $this->userIdService->store($request->all()),
            ]);
        } catch(Exception $error) {
            return response()->json(["error"=> $error->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserID $userID)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserID $userID)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserID $userID)
    {
        //
    }
}
