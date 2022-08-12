<?php

use App\Http\Middleware\CheckOrderBelongsUser;

use App\Http\Middleware\TransformUserIndexRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    AnimalController, OrderController, UserController, LocationController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('animals', [AnimalController::class, 'index']);
    Route::apiResource('orders', OrderController::class)
        ->only(['index', 'store']);
    Route::apiResource('orders', OrderController::class)
        ->except(['index', 'store'])
        ->middleware(CheckOrderBelongsUser::class);
    Route::apiResource('recipients', UserController::class)
        ->middleware(TransformUserIndexRequest::class);
    Route::apiResource('locations', LocationController::class);
});

Route::get('task1', function() {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    // ini_set('memory_limit', '-1');
    // Напишите функцию, которая развернёт список.
    // Последний элемент должен стать первым, а первый - последним.
    // $c→next должен содержать $b и так далее...

    class Test
    {
        public ?self $next;

        public static function make(): static
        {
            return new static();
        }

        public function toArray(): array
        {
            return (array) $this;
        }
    }

    $a = Test::make();
    $b = Test::make();
    $c = Test::make();
    $a->next = $b;
    $b->next = $c;
    $c->next = null;

    // $new = null;
    // function reverse(&$new, &$obj) {
    //     if(is_object($new) && (spl_object_id($new)-1) === 0) {
    //         return null;
    //     }

    //     $getLast = function (&$obj) use(&$getLast) {
    //         if($obj->next === null) {
    //             return $obj;
    //         }

    //         return $getLast($obj->next);
    //     };

    //     $dropLast = function (&$obj) use(&$dropLast) {
    //         if (!isset($obj->next)) {
    //             return null;
    //         }
    //         if ($obj->next->next === null) {
    //             $obj->next = null;
    //             return null;
    //         }

    //         return $dropLast($obj->next);
    //     };

    //     if ($new === null) {
    //         $new = $getLast($obj);
    //         $dropLast($obj);
    //         $new->next = $getLast($obj);
    //     } else {
    //         $new->next = $getLast($obj);
    //     }

    //     $dropLast($obj);

    //     return reverse($new->next, $obj);
    // }

    function reverse(?Test $a) {
        // $result = null;
        // do {
        //     $result = new Test($a->next, $result);
        // } while (($list = $a->next) !== null);

        // return $result;
        // dd($a);
        $dropLast = function ($obj) use(&$dropLast) {
            if (!isset($obj->next)) {
                return null;
            }
            if ($obj->next->next === null) {
                $obj->next = null;

                return null;
            }

            return $dropLast($obj->next);
        };
        $arr = $a->toArray();
        foreach ($a as $item) {
            if (!$item) {
                return $arr;
            }
            $arr += $a->next->toArray();
            // dd($a);
            // if ($a->next === null) {
            //     return $arr;
            // }
            // reverse($arr['next']);
            $dropLast($a);
            reverse($a);
        }

        return $arr;
    }

    $ob1 = reverse($a);
    dd("111", $ob1);
});
