<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\{PayloadService, PartnerSellService};

class PartnerSellController extends Controller
{
    public function store(Request $request, PartnerSellService $partnerSellService, PayloadService $payloadService)
    {
        $payload = $payloadService->getPayload($request->input('payload_id'));
        $partnerSellService->handle($payload->getAttributes());

        return response()->json(['message' => 'Payload saved successfully']);
    }
}
