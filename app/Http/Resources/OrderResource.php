<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Enums\OrderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'owner' => UserResource::make($this->whenLoaded('owner')),
            'recipient' => UserResource::make($this->whenLoaded('recipient')),
            'comment' => $this->comment,
            'status' => $this->status,
            'status_label' => OrderStatusEnum::from($this->status)->label(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
