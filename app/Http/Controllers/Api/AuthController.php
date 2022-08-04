<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Api\AuthRequest;

use App\Contracts\ResponseContract;

use App\Models\User;

class AuthController
{
    public function __construct(public ResponseContract $json) {}

    /**
     * @param \App\Http\Requests\Api\AuthRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRequest $request)
    {
        $user = User::create($request->validated());

        return $this->json->response([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

    /**
     * @param \App\Http\Requests\Api\AuthRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request): \Illuminate\Http\JsonResponse
    {
        if (!Auth::attempt($request->validated())) {
            return $this->json->response([], 'Credentials not match', JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->json->response([
            'token' => Auth::user()->createToken('API Token')->plainTextToken
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::user()->tokens()->delete();

        return $this->json->response([], 'Logged out');
    }
}
