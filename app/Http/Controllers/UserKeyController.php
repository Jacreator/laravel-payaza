<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserKeyCreateRequest;
use App\Service\UserKeyService;
use Illuminate\Http\Request;

class UserKeyController extends Controller
{
    protected $userKey;
    public function __construct()
    {
        $this->userKey = new UserKeyService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json([
                "code" => 200,
                "message" => "fetched successful",
                "data" => $this->userKey
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserKeyCreateRequest $request)
    {
        try {
            return response()->json([
                "message" => "Created successfully",
                "code" => 200,
                "data" => $this->userKey->store($request->all()),
            ]);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
