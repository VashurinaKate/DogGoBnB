<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

class AuthRequest extends BaseApiRequest
{
    /**
     * @inheritdoc
     */
    public function authorize(): bool
    {
        return is_null($this->user());
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        $rules = [
            'phone' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
        ];
        if ($this->routeIs('auth.register')) {
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:12', 'unique:users,phone'],
                'email' => ['string', 'email:rfc,dns', 'unique:users,email'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ];
        }

        return $rules;
    }
}
