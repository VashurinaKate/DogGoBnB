<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

class PasswordRequest extends BaseApiRequest
{
    /**
     * @inheritdoc
     */
    public function authorize(): bool
    {
        return !is_null($this->user());
    }
    
     public function rules(): array
    {
        $rules = [
            'old_password' => ['required', 'string', 'min:6'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            // 'old_password' => 'current_password:api'
        ];
        return $rules;
        
    }
}
