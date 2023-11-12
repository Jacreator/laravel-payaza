<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct() {
        $this->userService = new UserService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json([
                "code" => 200,
                "message" => "user fetched successfully",
                "data" => $this->userService->all()
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
    public function store(UserCreateRequest $request)
    {
        try {
            return response()->json([
                "code"=> 200,
                "message"=> "user created successfully",
                "data"=> $this->userService->store($request->all())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error"=> $e->getMessage()
            ]);
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
