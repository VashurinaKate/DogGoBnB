<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

class ReveiwSaveRequest extends BaseApiRequest
{
 /**
 * 
 * 
 * @OA\Schema(
 *     schema="ReveiwSaveRequest",
 *     type="object",
 *     @OA\Property(
 *         property="that_id",
 *         type="integer",
 *         description="Ыender ID",
 *         example="3"
 *     ),
 *     @OA\Property(
 *         property="to_whom_id",
 *         type="integer",
 *         description="Recipient ID",
 *         example="3"
 *     ),
 *     @OA\Property(
 *         property="rating",
 *         type="integer",
 *         description="rating",
 *         example="3"
 *     ),
 *     @OA\Property(
 *         property="comment",
 *         type="string",
 *         description="comment",
 *         example="хороший отзыв"
 *     ),
 * )
     * @inheritdoc
     */
    public function rules(): array
    {
        $isMethodPost = $this->isMethod('post');
        return [
            'that_id' => [Rule::requiredIf($isMethodPost), 'int'],
            'to_whom_id' => [Rule::requiredIf($isMethodPost), 'int'],
            'rating' => [Rule::requiredIf($isMethodPost), 'int', 'max:10'],
            'comment' => [Rule::requiredIf($isMethodPost), 'string', 'max:1000'],
        ];
    }
}
