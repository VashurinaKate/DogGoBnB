<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="DogGoBnB API",
 *     version="1.0 beta",
 * )
 * @OA\Server(
 *     description="PMO server",
 *     url="http://localhost/api/v1"
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     in="header",
 *     name="Bearer",
 *     securityScheme="bearer_token"
 * )
 * @OA\PathItem(path="/api/v1")
 *
 * @OA\Schema(
 *  schema="Response",
 *  title="Sample schema for using references",
 *  type="object",
 *      @OA\Property(property="message", type="string"),
 *      @OA\Property(property="errors", type="null"),
 *      @OA\Property(property="data"),
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
