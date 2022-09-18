<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserSaveRequest;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

use App\Contracts\ResponseContract;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
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
     * @OA\Get(
     *     path="/recipients?filters[city_id]=id",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="users show",
     *     tags={"recipients"},
     *     summary="Get  recipients filters[city_id]",
     *     @OA\Parameter(
     *         description="recipients ID",
     *         in="path",
     *         name="filters[city_id]",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource"),
     *     )
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $filters = $request->input('filters');
               
        if ($filters) {  
            if (array_key_exists('city_id', $filters) && array_key_exists('pet_size', $filters)){
                $users = User::with('locations','petSize')
                    ->whereRelation('locations','id', $filters['city_id'])
                    ->whereRelation('petSize', 'id', $filters['pet_size'])
                    ->get();  
            } else if (array_key_exists('city_id', $filters)){
                $users = User::with('locations')
                    ->whereRelation('locations','id', $filters['city_id'])
                    ->get();  
            } else if (array_key_exists('pet_size', $filters)){
                $users = User::with('petSize')
                    ->whereRelation('petSize', 'id', $filters['pet_size'])
                    ->get(); 
            } else {
                $users = User::with('locations')->whereRelation('locations', 'id','>',0)->get();
            }
        } else {
            $users = User::with('locations')->whereRelation('locations', 'id','>',0)->get();
        }
        $users = $users->where('role','=', 2);
        return $this->json->response(data: [
            'users' => UserResource::collection($users),
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
    //UserSaveRequest
    public function update(UserSaveRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        $usernew = $request->all();
        Auth::user()->update($request->validated());
        Auth::user()->locations()->sync([$usernew['locations']]);
        Auth::user()->petSize()->sync($usernew['petSize']);
        return $this->json->response(data: [
            'user' => UserResource::make(Auth::user()),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        $users = Auth::user();
        $users->img !== null ? Storage::delete($users->img) : 0;
        //$users->reveiwThat->isNotEmpty() ? $users->reveiwThat()->delete() : 0;
        $users->reveiwWhom->isNotEmpty() ? $users->reviewWhom()->delete() : 0;
        $users->locations->isNotEmpty() ? $users->locations()->detach() : 0;
        $users->petSize->isNotEmpty() ? $users->petSize()->detach() : 0;
        $users->delete();
        return $this->json->response(data: [
            null,
        ]);
    }
}
