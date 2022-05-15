<?php

namespace PCsoft\RakanFon\Operations;

use PCsoft\RakanFon\Contracts\Operation;
use PCsoft\RakanFon\Resources\OperationType;
use PCsoft\RakanFon\Resources\Payment;
use PCsoft\RakanFon\Resources\PaymentType;
use PCsoft\RakanFon\Resources\Resource;

class DoPayment implements Operation
{
    /**
     * The referance of the payment.
     *
     * @param \PCsoft\RakanFon\Resources\PaymentType $paymentType
     * @param string $phone
     * @param int $amount
     */
    public function __construct(private int $paymentType, private string $phone, private int $amount, private string $trackingId, private int $region = 0)
    {
        // Make sure that phone length is 9 or 8
        assert(in_array(strlen($phone), [9, 8]), 'Please make sure that phone length is valid');

        // Make sure that region not equal 0 when it's for electricity or wate as descripted in documentation 
        assert(!($region == 0 && in_array($paymentType, [PaymentType::ELECTRICITY, PaymentType::WATER])), 'Region can\'t be 0 when paying electricity');
    }

    public function getType(): string
    {
        return OperationType::PAYMENT;
    }

    public function getTrakingId(): string
    {
        return $this->trackingId;
    }

    public function toMessage(): string
    {
        return join('#', [$this->paymentType, $this->phone, $this->amount, $this->region]);
    }
}
