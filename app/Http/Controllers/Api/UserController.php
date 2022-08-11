<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\ResponseContract;

use App\Http\Resources\UserResource;

use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    public function __construct(public ResponseContract $json)
    {
    }

    /**
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
