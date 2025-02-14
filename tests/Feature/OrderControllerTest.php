<?php

use App\Models\Client;
use App\Models\Order;

it('can get all orders', function () {
    Order::factory()->count(5)->create();

    $response = $this->getJson('/api/orders');

    $response->assertStatus(200)
        ->assertJsonCount(5);
});

it('can create an order', function () {
    $client = Client::factory()->create();

    $data = [
        'client_id' => $client->id,
        'description' => 'Website Development',
        'amount' => 1000,
        'status' => 'pending',
        'due_date' => '2023-12-31',
    ];

    $response = $this->postJson('/api/orders', $data);

    $response->assertStatus(201)
        ->assertJson($data);
});

it('can get order details', function () {
    $data = Order::factory()->create();

    $response = $this->getJson("/api/orders/{$data->id}");

    $response->assertJson([
        'id' => $data->id,
        'description' => $data->description,
        'amount' => (float) $data->amount,
        'status' => $data->status,
        'due_date' => $data->due_date->format('Y-m-d'),
        'client' => [
            'id' => $data->client->id,
            'name' => $data->client->name,
            'email' => $data->client->email,
            'phone' => $data->client->phone,
        ],
    ]);
});

it('can update an order', function () {
    $order = Order::factory()->create();

    $data = [
        'status' => 'completed',
    ];

    $response = $this->putJson("/api/orders/{$order->id}", $data);

    $response->assertStatus(200)
        ->assertJson($data);
});

it('can delete an order', function () {
    $order = Order::factory()->create();

    $response = $this->deleteJson("/api/orders/{$order->id}");

    $response->assertStatus(200)
        ->assertJson(['message' => 'Order deleted successfully']);

    $this->assertDatabaseMissing('orders', ['id' => $order->id]);
});
