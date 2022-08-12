<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\ResponseContract;
use OpenApi\Annotations as OA;
use App\Http\Resources\UserResource;

use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    public function __construct(public ResponseContract $json)
    {
    }

    /**@OA\Get(
     *     path="/recipients",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="recipients",
     *     tags={"recipients"},
     *     summary="Get recipients list",
     *      @OA\Parameter(
     *         description="Order ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     * @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource"),
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

        return $this->json->response([
            UserResource::collection($users)
        ]);
    }
}
