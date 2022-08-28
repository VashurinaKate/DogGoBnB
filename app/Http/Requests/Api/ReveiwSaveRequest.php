<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

class ReveiwSaveRequest extends BaseApiRequest
{
    /**
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
