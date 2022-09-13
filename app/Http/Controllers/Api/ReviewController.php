<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ReveiwSaveRequest;
use App\Contracts\ResponseContract;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

use App\Models\Review;
use App\Http\Resources\ReviewResource;

class ReviewController
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
     * @OA\Response(
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
        return $this->json->response(['reviews' => ReviewResource::collection(Review::all())]);
    }

    /**
     * @OA\Post(
     *     path="/reviewsave",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="review store",
     *     tags={"Reviews"},
     *     summary="reviews store",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/ReveiwSaveRequest"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *         @OA\Property(
     *           property="to_whom_id",
     *           type="integer",
     *           description="Recipient ID",
     *           example="3"
     *         ),
     *         @OA\Property(
     *           property="rating",
     *           type="integer",
     *           description="rating",
     *           example="3"
     *          ),
     *         @OA\Property(
     *           property="comment",
     *           type="string",
     *           description="comment",
     *           example="хороший отзыв"
     *          ),
     *         ),
     *     )
     * )
     * Store a newly created resource in storage.
     *
     * @param ReveiwSaveRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReveiwSaveRequest $request): \Illuminate\Http\JsonResponse
    {
        // $created_reviews = Review::create($request->validated());
        $review = new Review($request->validated());
        Auth::user()->reviewThat()->save($review);

        return $this->json->response(['reviews' => $review]);
    }

    /**
     * @OA\Get(
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
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $reviews = Review::where('to_whom_id', '=', $id)->get();

        return $this->json->response(['reviews' => ReviewResource::collection($reviews)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReveiwSaveRequest $request
     * @param Review $review
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ReveiwSaveRequest $request, Review $review): \Illuminate\Http\JsonResponse
    {
        $review = new Review($request->validated());
        // $review->update($request);
        // fixme: ???
        Auth::user()->reviewThat()->update($request->validated());

        return $this->json->response(['reviews' => $review]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        return $this->json->response([]);
    }
}
