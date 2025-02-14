<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('client');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return $query->get();
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());
        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = Order::with('client')->find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->update($request->validated());
        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
