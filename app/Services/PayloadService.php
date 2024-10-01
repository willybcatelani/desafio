<?php

namespace App\Services;

use App\Models\PartnerSell;

class PayloadService
{
    protected $baseUrl = 'https://storage.googleapis.com/media.cuponeria.com.br/backend-test/';

    public function getPayload($payloadId)
    {
        $url = $this->baseUrl . $payloadId . '.txt';
        $fgc = file_get_contents($url);
        $data = json_decode($fgc, true) ?? [];

        if (empty($data)) {
            throw new \InvalidArgumentException('Payload está vazio ou não é válido.');
        }

        $partnerSell = new PartnerSell();
        
        $partnerSell->setExternalId($data);
        $partnerSell->setAmount($data);
        $partnerSell->setCommissionAmount($data);
        $partnerSell->setPayload($data);
        $partnerSell->setStatus($data);
        $partnerSell->setCurrency($data);
        $partnerSell->setDateTransaction($data);
        
        return $partnerSell;
    }
}
