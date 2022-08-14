<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserSaveRequest;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

use App\Contracts\ResponseContract;

use App\Http\Resources\UserResource;

use App\Models\User;

class UserController
{
    public function __construct(public ResponseContract $json)
    {
    }

    /**
     * @OA\Get(
     *     path="/users",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="users",
     *     tags={"Users"},
     *     summary="Get users list",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     )
     * )
     *
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $filters = $request->input('filters');
        // $users = User::query()
        //     ->when($filters, function (Builder $query) use ($filters) {
        //         $query
        //     })
        // ;

        if ($filters) {
            $users = User::whereRelation('locations', 'id', $filters['city_id'])->get();
        } else {
            $users = User::all();
        }

        return $this->json->response(data: [
            'users' => UserResource::collection($users)
        ]);
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="user profile show",
     *     tags={"Users"},
     *     summary="Show user profile by ID",
     *     @OA\Parameter(
     *         description="User ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource"),
     *     )
     * )
     *
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            'user' => UserResource::make($user),
        ]);
    }

    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="update user profile",
     *     tags={"Users"},
     *     summary="Update user profile",
     *     @OA\Parameter(
     *         description="User ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/UserSaveRequest"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource"),
     *     )
     * )
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\UserSaveRequest $request
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserSaveRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        $user->update($request->validated());

        return $this->json->response(data: [
            'user' => UserResource::make($user),
        ]);
    }
}
