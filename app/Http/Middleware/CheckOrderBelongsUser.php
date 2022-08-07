<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckOrderBelongsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure(Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        /** @var \App\Models\Order $order */
        $order = $request->route()->parameter('order');
        if ($order->owner->isNot($request->user())) {
            return app(\App\Contracts\ResponseContract::class)->response([], 'Stop it!', JsonResponse::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
