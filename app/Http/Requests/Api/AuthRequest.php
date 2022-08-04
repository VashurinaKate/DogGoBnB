<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

class AuthRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return is_null($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            'email' => ['required', 'string', 'email:rfc,dns'],
            'password' => ['required', 'string', 'min:6'],
        ];
        if ($this->routeIs('register')) {
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email:rfc,dns', 'unique:users,email'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ];
        }

        return $rules;
    }
}
