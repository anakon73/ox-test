<?php

use App\Models\Client;

it('can get all clients', function () {
    Client::factory()->count(5)->create();

    $response = $this->getJson('/api/clients');

    $response->assertStatus(200)
        ->assertJsonCount(5);
});

it('can create a client', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '1234567890',
    ];

    $response = $this->postJson('/api/clients', $data);

    $response->assertStatus(201)
        ->assertJson($data);
});

it('can get client details', function () {
    $data = Client::factory()->create();

    $response = $this->getJson("/api/clients/{$data->id}");

    $response->assertStatus(200)
        ->assertJson([
            'id' => $data->id,
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
        ]);
});

it('can update a client', function () {
    $client = Client::factory()->create();

    $data = [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
    ];

    $response = $this->putJson("/api/clients/{$client->id}", $data);

    $response->assertStatus(200)
        ->assertJson($data);
});

it('can delete a client', function () {
    $client = Client::factory()->create();

    $response = $this->deleteJson("/api/clients/{$client->id}");

    $response->assertStatus(200)
        ->assertJson(['message' => 'Client deleted successfully']);

    $this->assertDatabaseMissing('clients', ['id' => $client->id]);
});
