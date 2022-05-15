<?php

namespace PCsoft\RakanFon\Resources;

class SubscriberBalance
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
     * 
     * The Balance in the Postpaid numbers or the Available credit amount for the Prepaid numbers
     * @var int $credit
     * 
     * @var string|\PCsoft\RakanFon\Resources\LoanStatus $loanStatus
     */
    public function __construct(public string $operationResult, public int $balance, public int $mobileType, public int $credit, public string $loanStatus)
    {
        //
    }
}
