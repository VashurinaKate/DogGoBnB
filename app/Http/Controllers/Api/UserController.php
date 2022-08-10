<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Contracts\ResponseContract;

use App\Models\User;
use App\Queries\QueryBuilderSitters;
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
            User::all(),
        ]);//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $locations, QueryBuilderSitters $sitters ): \Illuminate\Http\JsonResponse
    {
        $sittersV = $sitters->getSiters($locations);
        return $this->json->response([
            $sittersV,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }
}
