<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

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
     *         @OA\JsonContent(
     *             ref="#/components/schemas/UserResource"
     *         )
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

        return $this->json->response([
            UserResource::collection($users)
        ]);
    }
}
