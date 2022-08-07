<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\ResponseContract;
use App\Enums\OrderStatusEnum;
use App\Http\Requests\Api\OrderSaveRequest;
use App\Http\Resources\OrderResource;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController
{
    public function __construct(public ResponseContract $json)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            'orders' => OrderResource::collection(
                Order::with(['owner', 'recipient'])->get()
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\OrderSaveRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderSaveRequest $request): \Illuminate\Http\JsonResponse
    {
        $order = new Order($request->validated());
        $order->status = OrderStatusEnum::OPENED->value;

        Auth::user()->ownerOrders()->save($order);

        return $this->json->response(data: [
            'order' => OrderResource::make($order),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order): \Illuminate\Http\JsonResponse
    {
        return $this->json->response(data: [
            'order' => OrderResource::make($order->load(['owner', 'recipient'])),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\OrderSaveRequest $request
     * @param \App\Models\Order $order
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrderSaveRequest $request, Order $order): \Illuminate\Http\JsonResponse
    {
        if ($order->status !== OrderStatusEnum::OPENED->value) {
            return $this->json->response(
                data: [],
                message: 'Уже нельзя обновить заказ',
                httpSTatusCode: \Illuminate\Http\JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            );
        }
        $order->update($request->validated());

        return $this->json->response(data: [
            'order' => OrderResource::make($order->load(['owner', 'recipient'])),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order): \Illuminate\Http\JsonResponse
    {
        try {
            $order->delete();
        } catch (\Throwable $e) {
            return $this->json->error(message: $e->getMessage());
        }

        return $this->json->response(
            data: [],
            message: 'Заказ удален',
        );
    }
}
