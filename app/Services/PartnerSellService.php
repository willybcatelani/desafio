<?php

namespace App\Services;

use App\Models\PartnerSell;

class PartnerSellService
{
    public function handle($data)
    {
        return PartnerSell::create($data);
    }
}