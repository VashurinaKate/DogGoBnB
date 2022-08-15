<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Enums\RoleEnum;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @mixin \App\Models\User
 *
 * @OA\Schema(
 *     schema="UserSaveRequest",
 *     type="object",
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="User name",
 *         example="Jessica"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="Email address",
 *         example="ex@ex.ru"
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         description="Phone number",
 *         example="+71234567890"
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
 *         description="Description",
 *         example="Quae sed ut debitis. Fuga nihil provident iure. Inventore et est et est aut odio."
 *      ),
 * )
 */
class UserSaveRequest extends BaseApiRequest
{
    public function rules(): array
    {
        $isMethodPost = $this->isMethod('post');

        return [
            'name' => [Rule::requiredIf($isMethodPost), 'string', 'max:50'],
            'email' => [Rule::requiredIf($isMethodPost), 'email', 'max:50'],
            'phone' => [Rule::requiredIf($isMethodPost), 'string', 'max:12'],
            // 'role' => [Rule::requiredIf($isMethodPost), 'integer'],
            // 'locations' =>
            'description' => [Rule::requiredIf($isMethodPost), 'string', 'max:1000'],
        ];
    }
}
