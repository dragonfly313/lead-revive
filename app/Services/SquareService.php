<?php

namespace App\Services;

use Square\SquareClient;
use Square\Models\CreatePaymentRequest;

class SquareService
{
    protected $client;

    public function __construct()
    {
        $this->client = new SquareClient([
            'accessToken' => env('SQUARE_ACCESS_TOKEN'),
            'environment' => 'sandbox' // Change to 'production' for live
        ]);
    }

    public function createPayment($amount, $currency, $sourceId)
    {
        $paymentsApi = $this->client->getPaymentsApi();
        $body = new CreatePaymentRequest($amount, $sourceId, uniqid(), null, $currency);
        
        try {
            $response = $paymentsApi->createPayment($body);
            return $response->getResult();
        } catch (\Exception $e) {
            // Handle errors
            return $e->getMessage();
        }
    }
}
