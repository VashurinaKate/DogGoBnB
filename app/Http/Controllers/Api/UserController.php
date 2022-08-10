<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\ResponseContract;

use App\Http\Resources\UserResource;

use App\Models\User;

class UserController
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
            UserResource::collection(User::all())
        ]);
    }
}
