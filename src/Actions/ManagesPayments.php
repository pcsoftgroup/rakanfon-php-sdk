<?php

namespace PCsoft\RakanFon\Actions;

use PCsoft\RakanFon\Exceptions\FailedActionException;
use PCsoft\RakanFon\Operations\DoPayment;
use PCsoft\RakanFon\Operations\QueryTRStatus;
use PCsoft\RakanFon\Operations\QueryTRStatus2;
use PCsoft\RakanFon\Resources\ErrorCode;
use PCsoft\RakanFon\Resources\OperationResult;
use PCsoft\RakanFon\Resources\Payment;
use PCsoft\RakanFon\Resources\PaymentStatus;

trait ManagesPayments
{
    /**
     * Create a new payment. API recommends a 2 minute delay between checks.
     *
     * @param  int|\PCsoft\RakanFon\Resources\PaymentType  $type
     * @param  string  $phone
     * @param  int  $amount
     * @param  int  $region
     * @return \PCsoft\RakanFon\Resources\Payment
     */
    public function createPayment(int $paymentType, string $phone, int $amount, string $trackingId, int $region = 0)
    {
        $response = $this->post(new DoPayment(
            paymentType: $paymentType,
            phone: $phone,
            amount: $amount,
            region: $region,
            trackingId: $trackingId,
        ))['s:Body']['DoOperationResponse'];

        if (ErrorCode::contains($resultMessage = $response['DoOperationResult']))
            throw new FailedActionException($resultMessage, $response);

        $chunks = explode('#', $response['DoOperationResult']);

        return new Payment(
            operationResult: (string) $chunks[0],
            paymentStatus: OperationResult::fromPaymentStatus((string) $chunks[0]),
            remainingBalance: (int) str_replace(',', '', $chunks[1]),
            subscriberMobileType: (string) $chunks[2],
            transactionId: (int) $chunks[3],
            amount: (int) $chunks[4],
        );
    }

    /**
     * Check a payment instance.
     *
     * @param  string  $reference
     * @return \PCsoft\RakanFon\Resources\PaymentStatus
     */
    public function checkPaymentByClientReference(string $reference)
    {
        $response = $this->post(new QueryTRStatus2(
            trackingId: $reference,
        ))['s:Body']['DoOperationResponse'];

        $chunks = explode('#', $response['DoOperationResult']);

        return new PaymentStatus(
            operationResult: (string) $chunks[0],
            paymentStatus: (string) $chunks[1],
        );
    }

    /**
     * Check a payment instance.
     *
     * @param  int  $reference
     * @return \PCsoft\RakanFon\Resources\PaymentStatus
     */
    public function checkPaymentByProviderReference(int $reference)
    {
        $response = $this->post(new QueryTRStatus(
            trackingId: $reference,
        ))['s:Body']['DoOperationResponse'];

        $chunks = explode('#', $response['DoOperationResult']);

        return new PaymentStatus(
            operationResult: (string) $chunks[0],
            paymentStatus: (string) $chunks[1],
        );
    }
}
