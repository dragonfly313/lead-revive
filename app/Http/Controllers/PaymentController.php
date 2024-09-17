<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SquareService;

class PaymentController extends Controller
{
    protected $squareService;

    public function __construct(SquareService $squareService)
    {
        $this->squareService = $squareService;
    }

    public function createPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'sourceId' => 'required|string',
        ]);

        $result = $this->squareService->createPayment($request->amount, $request->currency, $request->sourceId);

        return response()->json($result);
    }
}
