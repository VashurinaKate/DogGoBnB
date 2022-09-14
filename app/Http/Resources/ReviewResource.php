<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Review
 *
 * @OA\Schema(
 *     schema="ReviewResource",
 *     type="array",
 *     @OA\Items(
 *         @OA\Property(property="id", type="integer", example="1"),
 *         @OA\Property(property="that_id", type="integer", example="6"),
 *         @OA\Property(property="to_whom_id", type="integer", example="6"),
 *         @OA\Property(property="rating", type="integer", example="5"),
 *         @OA\Property(property="comment", type="string", example="Omnis quidem cum aut suscipit fugit. Beatae nisi ad et aut sint. Eaque et optio amet iure."),
 *         
  *             
 *     )
 * )
 */


class ReviewResource extends JsonResource
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
            'that_id' => $this->that_id,
            'that_name' => $this->reviewsThat == null ? 'неизвестный' : $this->reviewsThat->name,
            'to_whom_id' => $this->to_whom_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            // LocationResource::collection( $this->whenLoaded('locations')),
        ];;
    }
}
