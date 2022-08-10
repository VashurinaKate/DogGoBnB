<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Contracts\ResponseContract;

use App\Models\Location;

class LocationController
{
    public function __construct(public ResponseContract $json)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([
            'cities' => Location::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Location $location
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Location $location): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([
            'location' => $location->load(['users']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Location $location
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Location $location): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Location $location
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Location $location): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }
}
