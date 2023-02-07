<?php

namespace App\Services\Api;

use App\Services\ApiClient\TickerService;

class ApiService
{
    private TickerService $tickerService;

    public function __construct(TickerService $tickerService)
    {
        $this->tickerService = $tickerService;
    }

    public function rates(array $params, float $fee = 0.02): array
    {
        $tickers = $this->tickerService->get();

        $response = array_map(function ($item) use ($fee) {
            return $item = $item['buy'] + $item['buy'] * $fee;
        }, $tickers);

        if (!empty($params['currency'])) {
            $currencies = explode(',', $params['currency']);
            $response = array_filter($response, function ($key) use ($currencies) {
                return in_array($key, $currencies);
            }, ARRAY_FILTER_USE_KEY);
        }

        asort($response);

        return $response;
    }

    public function convert(array $params, float $fee = 0.02): array
    {
        $tickers = $this->tickerService->get();

        $currencyFrom = $params['currency_from'];
        $currencyTo = $params['currency_to'];

        $buyRate = $tickers[$currencyFrom]['buy'] + $tickers[$currencyFrom]['buy'] * $fee;
        $sellRate = $tickers[$currencyTo]['sell'] + $tickers[$currencyTo]['sell'] * $fee;
        $exchangeRate = $buyRate/$sellRate;

        $converted = $exchangeRate * $params['value'];
        if ($currencyTo == 'USD') {
            $converted = round($converted, 2);
        } else {
            $converted = round($converted, 10);
        }

        return [
            'currency_from' => $currencyFrom,
            'currency_to' => $currencyTo,
            'value' => $params['value'],
            'converted_value' => $converted,
            'rate' => $exchangeRate,
        ];
    }
}