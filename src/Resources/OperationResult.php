<?php

namespace PCsoft\RakanFon\Resources;

class OperationResult
{
    const OK = 'OK';
    const HOLD = 'HOLD';
    const ERROR = 'ERROR';

    public static function fromPaymentStatus(string $paymentStatus): string
    {
        return [
            OperationResult::ERROR => PaymentStatus::FAILED,
            OperationResult::HOLD =>   PaymentStatus::HOLD,
            OperationResult::OK => PaymentStatus::SUCCESS,
        ][$paymentStatus];
    }
}
