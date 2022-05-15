<?php

namespace PCsoft\RakanFon\Resources;

class OperationType
{
    const FETCH_AGENT_BALANCE = 'QueryMyBalance';
    const FETCH_SUBSCRIBER_BALANCE = 'QuerySubsBalance';
    const FETCH_SUBSCRIBER_OFFERS = 'QuerySubsOffers';
    const CHECK_STATUS_BY_PROVIDER_REFERENCE = 'QueryTRStatus';
    const CHECK_STATUS_BY_CLIENT_REFERENCE = 'QueryTRStatus2';
    const PAYMENT = 'DoPayment';
    const SUBSCRIBE_YEMEN_MOBILE_OFFER = 'AddOffer';
    const RESUBSCRIBE_YEMEN_MOBILE_OFFER = 'RenewOffer';
    const UNSUBSCRIBE_YEMEN_MOBILE_OFFER = 'RemoveOffer';
    const SUBSCRIBE_MTN_OFFER = 'AddMTNOffer';
    const SUBSCRIBE_SABAFON_OFFER = 'ADDSFOFFER';
    const SUBSCRIBE_PROTECTED_SABAFON_OFFER = 'ADDSFADOFFER';
    const CHANGE_PASSWORD = 'ChangePassword';
}
