<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Database\Seeder;

class ClientOrderSeeder extends Seeder
{
    public function run(): void
    {
        Client::factory()->count(10)->create()->each(function ($client) {
            Order::factory()->count(rand(2, 5))->create([
                'client_id' => $client->id,
            ]);
        });
    }
}
