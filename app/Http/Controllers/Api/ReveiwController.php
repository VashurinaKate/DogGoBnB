<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ReveiwSaveRequest;
use App\Contracts\ResponseContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

use App\Models\Review;
use App\Http\Resources\ReviewResource;
class ReveiwController
{
    public function __construct(public ResponseContract $json)
    {
    }
    /**
     * @OA\Get(
     *     path="/reviews",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="reviews",
     *     tags={"Reviews"},
     *     summary="Get reviews list",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/ReviewResource")
     *     )
     * )
     * 
     * 
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/ReviewResource"),
     *     )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(
            data: [
                'reviews' => Review::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReveiwSaveRequest $request): \Illuminate\Http\JsonResponse
    {
        
        
        // $created_reviews = Review::create($request->validated());
        
        $review = new Review($request->validated());
        
        Auth::user()->reveiwThat()->save($review);
        return $this->json->response(
            data: [
                'reviews' => ReviewResource::make($review)
                ]
            );
    }

    /**
     *  @OA\Get(
     *     path="/reviews/{id}",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="reviews profile show",
     *     tags={"Reviews"},
     *     summary="Show reviews by user ID",
     *     @OA\Parameter(
     *         description="User ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *      
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/ReviewResource")
     *     )
     * )
     * 
     * 
     *    
     * )
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response( 
            data: [
            'reviews' => Review::where('to_whom_id', '=', $id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }
}
