<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;

class OrderController extends Controller
{
    public function index()
    {
        return Order::paginate();
    }

    public function store(OrderStoreRequest $request)
    {
        $data = $request->validated();

        $order = Order::create($data);

        return $order;
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function update(
        Order $order,
        OrderUpdateRequest $request
    ) {
        $data = $request->validated();

        $order->update($data);

        return $order;
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->noContent();
    }
}