<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

use App\Http\Resources\LocationResource;

use App\Contracts\ResponseContract;

use App\Models\Location;

class LocationController
{
    public function __construct(public ResponseContract $json)
    {
    }

    /**
     * @OA\Get(
     *     path="/locations",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="locations",
     *     tags={"Locations"},
     *     summary="Get locations list",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/LocationResource"),
     *     )
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(
            data: [
            'cities' => LocationResource::collection(Location::all()),
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
