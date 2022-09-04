<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Enums\RoleEnum;
use OpenApi\Annotations as OA;

use App\Http\Resources\PetSizeResource;
/**
 * @mixin \App\Models\User
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
 *         property="phone",
 *         type="string",
 *         description="User's phone number",
 *         example="+79201234567"
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
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="User description",
 *         example="Quae sed ut debitis. Fuga nihil provident iure. Inventore et est et est aut odio."
 *     ),
 *     @OA\Property(
 *         property="locations",
 *         type="string",
 *         description="User description",
 *         example="Санкт-Петербург"
 *     ),
 * )
 */
class UserResource extends JsonResource
{
    /**
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
            'phone' => $this->phone,
            'role' => $this->role,
            'img' => $this->img,
            'address'=> $this->address,
            'role_label' => RoleEnum::from($this->role)->label(),
            'description' => $this->description,
            'locations' => $this->locations[0]->name,
            'rating' => $this->reveiwWhom->avg('rating')|0,
            'otherAnimals' => $this->otherAnimals,
            'petSize' => PetSizeResource::collection($this->petSize)
            // LocationResource::collection( $this->whenLoaded('locations')),
        ];
    }
}
