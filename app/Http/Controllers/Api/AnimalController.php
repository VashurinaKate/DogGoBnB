<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Contracts\ResponseContract;

use App\Models\Animal;

class AnimalController
{
    public function __construct(public ResponseContract $json)
    {
    }

    /**
     * @OA\Get(
     *     path="/animals",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="animals",
     *     tags={"Animals"},
     *     summary="Get animals list",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 type="integer",
     *                 description="Animal id",
     *                 example="1"
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Type of animal",
     *                 example="Кошка"
     *             ),
     *         ),
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([
            'animals' => Animal::all(),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Animal $animal
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Animal $animal): \Illuminate\Http\JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Animal $animal
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Animal $animal): \Illuminate\Http\JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Animal $animal
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Animal $animal): \Illuminate\Http\JsonResponse
    {
        //
    }
}
