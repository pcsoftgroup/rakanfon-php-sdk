<?php

namespace PCsoft\RakanFon\Operations;

use PCsoft\RakanFon\Contracts\Operation;
use PCsoft\RakanFon\Resources\OperationType;
use PCsoft\RakanFon\Resources\PaymentType;

class QuerySubsOffers implements Operation
{
    /**
     * The referance of the payment.
     *
     * @param \PCsoft\RakanFon\Resources\PaymentType $paymentType
     * @param string $phone
     * @param int $amount
     */
    public function __construct(private int $paymentType, private string $phone)
    {
        assert($this->paymentType == PaymentType::YEMEN_MOBILE, 'Sorry, fetching offer currently available for Yemen Mobile only');
    }

    public function getType(): string
    {
        return OperationType::FETCH_SUBSCRIBER_OFFERS;
    }

    public function getTrakingId(): string
    {
        return '0';
    }

    public function toMessage(): string
    {
        return join('#', [$this->phone]);
    }
}
