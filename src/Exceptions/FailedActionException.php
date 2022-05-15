<?php

namespace PCsoft\RakanFon\Exceptions;

use Exception;
use PCsoft\RakanFon\Resources\ErrorCode;

class FailedActionException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct(public $resultMessage, mixed $body)
    {
        $body = json_encode($body) ?? $body;
        $resultMessage = ErrorCode::all()[$this->resultMessage];

        parent::__construct("{$resultMessage}\n$$body");
    }
}
