<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerSell extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'external_id',
        'amount',
        'comission_amount',
        'payload',
        'status',
        'currency',
        'date_transaction'
    ];

    public function setExternalId($value)
    {
        if (isset($value['paymentId'])) {
            $this->external_id = (string)$value['paymentId'];
        } else if (isset($value['transactionId'])) {
            $this->external_id = (string)$value['transactionId'];
        } else if (isset($value['apid'])) {
            $this->external_id = (string)$value['apid'];
        } else {
            $this->external_id = null;
        }
    }

    public function setAmount($value)
    {
        if (isset($value['saleAmount']['amount'])) {
            $this->amount = $value['saleAmount']['amount'];
        } else if (isset($value['gmv'])) {
            $this->amount = $value['gmv'];
        } else if (isset($value['price'])) {
            $this->amount = $value['price'];
        } else {
            $this->amount = null;
        }
    }

    public function setCommissionAmount($value)
    {
        if (isset($value['commissionAmount']['amount'])) {
            $this->comission_amount = $value['commissionAmount']['amount'] ?? 0;
        } else if (isset($value['commission'])) {
            $this->comission_amount = $value['commission'] ?? 0;
        } else {
            $this->comission_amount = 0;
        }
    }

    public function setPayload($value)
    {
        $this->payload = json_encode($value); // Serializa o payload se necessário
    }

    public function setStatus($value)
    {
        if (isset($value['commissionStatus'])) {
            $this->status = strtoupper($value['commissionStatus']);
        } else if (isset($value['statusName'])) {
            $this->status = strtoupper($value['statusName']);
        } else if (isset($value['status']['name'])) {
            if (isset($value['holdEndDate']) && $value['holdEndDate'] > now()) {
                $this->status = 'PENDING';
            } else if (isset($value['decisionDate']) && $value['decisionDate'] <= now()) {
                $this->status = 'APPROVED';
            } else if (isset($value['processingEndDate']) && $value['processingEndDate'] <= now()) {
                $this->status = 'DENIED';
            } else {
                $this->status = 'CANCELED';
            }
        } else {
            $this->status = 'CANCELED';
        }
    }

    public function setCurrency($value)
    {
        if (isset($value['saleAmount']['currency'])) {
            $this->currency = $value['saleAmount']['currency'];
        } else if (isset($value['currency'])) {
            $this->currency = $value['currency'];
        } else if (isset($value['paymentCurrency'])) {
            $this->currency = $value['paymentCurrency'];
        } else {
            $this->currency = null;
        }
    }

    public function setDateTransaction($value)
    {
        if (isset($value['transactionDate'])) {
            $this->date_transaction = $value['transactionDate'];
        } else if (isset($value['processedDate'])) {
            $datetime = \DateTime::createFromFormat('d/m/Y', $value['processedDate']);
            $formattedDateTime = $datetime ? $datetime->format('Y-m-d\TH:i:s') : null;
            $this->date_transaction = $formattedDateTime;
        } else if (isset($value['processingEndDate'])) {
            $datetime = \DateTime::createFromFormat('Y-m-d H:i:s', $value['processingEndDate']);
            $formattedDateTime = $datetime ? $datetime->format('Y-m-d\TH:i:s') : null;
            $this->date_transaction = $formattedDateTime;
        } else {
            $this->date_transaction = null;
        }
    }
}