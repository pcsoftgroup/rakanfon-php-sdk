<?php

namespace PCsoft\RakanFon\Actions;

use PCsoft\RakanFon\Exceptions\FailedActionException;
use PCsoft\RakanFon\Operations\QuerySubsBalance;
use PCsoft\RakanFon\Operations\QuerySubsOffers;
use PCsoft\RakanFon\Resources\ErrorCode;
use PCsoft\RakanFon\Resources\SubscriberBalance;
use PCsoft\RakanFon\Resources\SubscriberOffers;

trait ManagesSubscribers
{
    /**
     * Fetch subscriber balance
     *
     * @param  int|\PCsoft\RakanFon\Resources\PaymentType  $paymentType
     * @param  string  $phone
     * @param  int  $amount
     * @param  int  $region
     * @return \PCsoft\RakanFon\Resources\SubscriberBalance
     */
    public function fetchSubscriberBalance(int $paymentType, string $phone)
    {
        $response = $this->post(new QuerySubsBalance(
            paymentType: $paymentType,
            phone: $phone,
        ))['s:Body']['DoOperationResponse'];

        if (ErrorCode::contains($resultMessage = $response['DoOperationResult']))
            throw new FailedActionException($resultMessage, $response);

        $chunks = explode('#', $response['DoOperationResult']);

        return new SubscriberBalance(
            operationResult: (string) $chunks[0],
            balance: (int) $chunks[1],
            mobileType: (string) $chunks[2],
            credit: (int) $chunks[3],
            loanStatus: (string) $chunks[4],
        );
    }

    /**
     * Fetch subscriber offers
     *
     * @param  int|\PCsoft\RakanFon\Resources\PaymentType  $paymentType
     * @param  string  $phone
     * @return \PCsoft\RakanFon\Resources\SubscriberOffers
     */
    public function fetchSubscriberOffers(int $paymentType, string $phone)
    {
        $response = $this->post(new QuerySubsOffers(
            paymentType: $paymentType,
            phone: $phone,
        ))['s:Body']['DoOperationResponse'];

        if (ErrorCode::contains($resultMessage = $response['DoOperationResult']))
            throw new FailedActionException($resultMessage, $response);

        $chunks = explode('#', $response['DoOperationResult']);

        return new SubscriberOffers(
            operationResult: (string) $chunks[0],
            balance: (int) $chunks[1],
            mobileType: (string) $chunks[2],
            uimType: (string) $chunks[3],
            offers: (array) explode(',', $chunks[4]),
        );
    }
}
