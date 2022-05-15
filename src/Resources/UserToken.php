<?php

namespace PCsoft\RakanFon\Resources;

class UserToken
{
    /**
     * Create a new user token instance.
     *
     * @param string $password
     * @param string|\PCsoft\RakanFon\Resources\OperationType $operationType
     * @param string $trackingId 
     * @return void
     */
    public function __construct(private string $password, private string $operationType, private string $trackingId)
    {
        //
    }

    public function toMessage()
    {
        return join('#', [$this->password, $this->trackingId, $this->operationType]);
    }
}
