<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @mixin \App\Models\Location
 *
 * @OA\Schema(
 *     schema="LocationResource",
 *     type="array",
 *     @OA\Items(
 *         @OA\Property(property="id", type="integer", example="1"),
 *         @OA\Property(property="city", type="string", example="Москва"),
 *     )
 * )
 */
class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'city' => $this->city,
        ];
    }
}
