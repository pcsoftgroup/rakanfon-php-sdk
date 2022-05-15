<?php

namespace PCsoft\RakanFon\Operations;

use PCsoft\RakanFon\Contracts\Operation;
use PCsoft\RakanFon\Resources\OperationType;

class QueryTRStatus2 implements Operation
{
    /**
     * The referance of the payment.
     *
     * @param string $trackingId
     */
    public function __construct(private string $trackingId)
    {
        //
    }

    public function getType(): string
    {
        return OperationType::CHECK_STATUS_BY_CLIENT_REFERENCE;
    }

    public function getTrakingId(): string
    {
        return $this->trackingId;
    }

    public function toMessage(): string
    {
        return join('#', [$this->trackingId]);
    }
}
