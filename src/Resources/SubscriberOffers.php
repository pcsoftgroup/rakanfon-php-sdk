<?php

namespace PCsoft\RakanFon\Resources;

class SubscriberOffers
{
    /**
     * The result of the payment.
     *
     * @var string|\PCsoft\RakanFon\Resources\OperationResult $operationResult
     * 
     * The Balance in the prepaid numbers or the Available credit amount for the postpaid numbers
     * @var int $balance
     * 
     * @var string|\PCsoft\RakanFon\Resources\MobileType $mobileType
     * @var string|\PCsoft\RakanFon\Resources\UIMType $uimType
     * @var array $offers
     */
    public function __construct(public string $operationResult, public int $balance, public int $mobileType, public string $uimType, public array $offers)
    {
        //
    }
}
