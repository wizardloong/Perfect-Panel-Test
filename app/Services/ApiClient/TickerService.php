<?php

namespace App\Services\ApiClient;

use Illuminate\Support\Facades\Http;

class TickerService
{
    const TIKER_URL = 'https://blockchain.info/ticker';

    public function get(): array
    {
        $response = Http::get(self::TIKER_URL);

        return $response->json();
    }
}