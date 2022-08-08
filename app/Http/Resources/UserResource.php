<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Enums\RoleEnum;

/**
 * @mixin \App\Models\User
 */
class UserResource extends JsonResource
{
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
     *         @OA\JsonContent(ref="#/components/schemas/UserResource"),
     *     )
     * ),
     *
     * @OA\Schema(
     *     schema="UserResource",
     *     type="object",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="User id",
     *         example="1"
     *     ),
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         description="User name",
     *         example="Jessica Brown"
     *     ),
     *     @OA\Property(
     *         property="email",
     *         type="string",
     *         description="Email address",
     *         example="example@example.ru"
     *     ),
     *     @OA\Property(
     *         property="role",
     *         type="integer",
     *         description="User role index",
     *         example="1"
     *     ),
     *     @OA\Property(
     *         property="role_label",
     *         type="string",
     *         description="User role label",
     *         example="Владелец"
     *     ),
     * )
     *
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'role_label' => RoleEnum::from($this->role)->label(),
        ];
    }
}
