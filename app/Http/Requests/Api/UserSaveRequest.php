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
 *         property="description",
 *         type="string",
 *         description="Description",
 *         example="Quae sed ut debitis. Fuga nihil provident iure. Inventore et est et est aut odio."
 *      ),
 *      @OA\Property(
 *         property="address",
 *         type="string",
 *         description="User address",
 *         example="Лесная 13 д.12"
 *      ),
 *      @OA\Property(
 *         property="img",
 *         type="string",
 *         description="User img",
 *         example="storage/images/L71A7fXs9iffn4J0YxqDnABxkXC11ZfoPrBe38wV.jpg"
 *      ),
 *      @OA\Property(
 *         property="otherAnimals",
 *         type="integer",
 *         description="User otherAnimals",
 *         example="1"
 *      ),
 *      @OA\Property(
 *         property="locations",
 *         type="integer",
 *         description="User locations index",
 *         example="22"
 *      ),
 *      @OA\Property(
 *         property="petSize",
 *         type="integer",
 *         description="User role index",
 *         example="[1,2]"
 *      ),
 * )
 */
class UserSaveRequest extends BaseApiRequest
{
    public function rules(): array
    {
        $isMethodPut = $this->isMethod('put');

        return [
            'name' => ['string', 'max:50', 'nullable'],
            'email' => [Rule::requiredIf($isMethodPut), 'email', 'max:50'],
            'phone' => ['string', 'max:12', 'nullable'],
            'role' => [Rule::requiredIf($isMethodPut), 'integer'],
            'description' => ['string', 'min:1', 'nullable'],
            'address' => ['string', 'max:50', 'nullable'],
            'img' => [ 'string', 'max:50', 'nullable'],
            'otherAnimals' => [Rule::requiredIf($isMethodPut), 'integer','max:1']
        ];
    }
}
