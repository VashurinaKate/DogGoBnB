<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Enums\RoleEnum;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="OrderSaveRequest",
 *     type="object",
 *     @OA\Property(
 *         property="recipient_id",
 *         type="integer",
 *         description="Recipient ID",
 *         example="3"
 *     ),
 *     @OA\Property(
 *         property="comment",
 *         type="string",
 *         description="Order comment",
 *         example="Оставить кошку с 17.08.22 до 25.08.22. Номер телефона 812345"
 *     ),
 *     @OA\Property(
 *         property="start_date",
 *         type="string",
 *         description="Order start date",
 *         example="2022-12-01 16:56:21"
 *     ),
 *     @OA\Property(
 *         property="end_date",
 *         type="string",
 *         description="Order end date",
 *         example="2022-09-07 20:56:28"
 *      ),
 * )
 */
class OrderSaveRequest extends BaseApiRequest
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        $isMethodPost = $this->isMethod('post');

        return [
            'recipient_id' => [
                Rule::requiredIf($isMethodPost),
                'int',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role', RoleEnum::RECIPIENT->value);
                }),
            ],
            'comment' => [Rule::requiredIf($isMethodPost), 'string', 'max:1000'],
            'start_date' => [Rule::requiredIf($isMethodPost), 'date_format:Y-m-d H:i'],
            'end_date' => [Rule::requiredIf($isMethodPost), 'date_format:Y-m-d H:i'],
        ];
    }
}
