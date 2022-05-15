<?php

namespace PCsoft\RakanFon\Resources;

class Payment
{
    /**
     * The result of the payment.
     *
     * @var string|\PCsoft\RakanFon\Resources\OperationResult  $operationResult
     * @var string|\PCsoft\RakanFon\Resources\PaymentStatus  $paymentStatus
     * @var string|\PCsoft\RakanFon\Resources\MobileType  $subscriberMobileType
     * @var int  $remainingBalance
     * @var int  $transactionId
     * @var int  $amount
     */
    public function __construct(public string $operationResult, public string $paymentStatus, public string $subscriberMobileType, public int $remainingBalance, public int $transactionId, public int $amount)
    {
        //
    }
}
