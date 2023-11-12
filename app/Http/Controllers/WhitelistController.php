<?php

namespace App\Http\Controllers;

use App\Http\Requests\WhitelistingCreateRequest;
use Illuminate\Http\Request;
use App\Service\WhiteListingService;

class WhitelistController extends Controller
{
    protected $whitelistService;
    public function __construct(){
        $this->whitelistService = new WhiteListingService();
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
    public function store(WhitelistingCreateRequest $request)
    {
        try {
            return response()->json([
                "message" => "ip whitelisted",
                "code" => 200,
                "data"=> $this->whitelistService->create($request->all())
            ]);
        } catch (\Exception $e) {
            throw $e;
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
