<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

use App\Http\Requests\Api\AuthRequest;

use App\Contracts\ResponseContract;

use App\Models\User;

class AuthController
{
    public function __construct(public ResponseContract $json)
    {
    }

    /**
     * @OA\Post(
     *     path="/register",
     *     operationId="auth.register",
     *     tags={"Auth"},
     *     summary="Register new user",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="User name",
     *                     example="Jessica Smith"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     description="Email address",
     *                     example="example@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="Password",
     *                     example="example"
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     type="string",
     *                     description="Password confirmation",
     *                     example="example"
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string"),
     *         ),
     *     ),
     * )
     *
     * @param \App\Http\Requests\Api\AuthRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create($request->validated());

        return $this->json->response([
            'token' => $user->createToken('api_token')->plainTextToken,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/login",
     *     operationId="auth.login",
     *     tags={"Auth"},
     *     summary="Login user",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     description="Email address",
     *                     example="example@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="Password",
     *                     example="example"
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string"),
     *         ),
     *     ),
     * )
     *
     * @param \App\Http\Requests\Api\AuthRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::firstWhere('email', $request->input('email'));
        if ($user && \Hash::check($request->input('password'), $user->password)) {
            return $this->json->response([
                'token' => $user->createToken('api_token')->plainTextToken,
            ]);

        }
        return $this->json->response([], 'Credentials not match', JsonResponse::HTTP_UNAUTHORIZED);

        
    }

    /**
     * @OA\Post(
     *     path="/logout",
     *     security={{ "sanctum": {"*"} }},
     *     operationId="auth.logout",
     *     tags={"Auth"},
     *     summary="Logout",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="token",
     *                     type="string",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(ref="#/components/schemas/Response"),
     *         ),
     *     ),
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::user()->tokens()->delete();

        return $this->json->response([], 'Logged out');
    }
}
