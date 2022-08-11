<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class TransformUserIndexRequest extends TransformsRequest
{
    /**
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function transform($key, $value): mixed
    {
        return $key === 'filters' ?
            json_decode($value, true) :
            $value;
    }
}
