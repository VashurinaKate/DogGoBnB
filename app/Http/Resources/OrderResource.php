<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

use App\Enums\OrderStatusEnum;

/**
 * @mixin \App\Models\Order
 *
 * @OA\Schema(
 *     schema="OrderResource",
 *     oneOf={
 *         @OA\Schema(
 *             type="object",
 *             @OA\Property(
 *                 property="owner",
 *                 ref="#/components/schemas/UserResource"
 *             ),
 *         ),
 *         @OA\Schema(
 *             type="object",
 *             @OA\Property(
 *                 property="owner",
 *                 ref="#/components/schemas/UserResource"
 *             ),
 *             @OA\Property(
 *                 property="recipient",
 *                 ref="#/components/schemas/UserResource"
 *             ),
 *         ),
 *     },
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Order id",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="comment",
 *         type="string",
 *         description="Order comment",
 *         example="Оставить кошку с 17.08.22 до 25.08.22. Номер телефона 812345"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         description="Order status",
 *         example="1"
 *      ),
 *      @OA\Property(
 *          property="status_label",
 *          type="string",
 *          description="Order status label",
 *          example="Открыт"
 *      ),
 *      @OA\Property(
 *          property="start_date",
 *          type="string",
 *          description="Order start date",
 *          example="2022-12-01 16:56:21"
 *      ),
 *      @OA\Property(
 *          property="end_date",
 *          type="string",
 *          description="Order end date",
 *          example="2022-09-07 20:56:28"
 *       ),
 * )
 */
class OrderResource extends JsonResource
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
