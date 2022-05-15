<?php

namespace PCsoft\RakanFon\Resources;

class PaymentStatus
{
    const SUCCESS = 'Success';
    const FAILED = 'Failed';
    const HOLD = 'Hold';
    const NOT_FOUND = 'Not Found';

    /**
     * The result of the payment.
     *
     * @var string|\PCsoft\RakanFon\Resources\OperationResult
     * @var string|\PCsoft\RakanFon\Resources\PaymentStatus
     */
    public function __construct(public string $operationResult, public string $paymentStatus)
    {
        //
    }
}
