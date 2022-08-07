<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class OrderSaveRequest extends BaseApiRequest
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        $isMethodPost = $this->isMethod('post');

        return [
            'comment' => [Rule::requiredIf($isMethodPost), 'string', 'max:1000'],
            'start_date' => [Rule::requiredIf($isMethodPost), 'date_format:Y-m-d H:i:s'],
            'end_date' => [Rule::requiredIf($isMethodPost), 'date_format:Y-m-d H:i:s'],
        ];
    }
}
