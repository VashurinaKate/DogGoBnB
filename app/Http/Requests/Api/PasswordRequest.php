<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

class PasswordRequest extends BaseApiRequest
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        $rules = [
            'old_password' => ['required', 'string', 'min:6', 'confirmed'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
        return $rules;
        
    }
}
