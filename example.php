<?php

require 'vendor/autoload.php';

use PCsoft\RakanFon\RakanFon;
use PCsoft\RakanFon\Resources\PaymentType;

$rakanfon = new RakanFon();
$rakanfon->setUsername('YOUR_USERNAME');
$rakanfon->setPassword('YOUR_PASSWORD');
$rakanfon->setToken('YOUR_TOKEN');
$rakanfon->build();

$payment = $rakanfon->createPayment(
    paymentType: PaymentType::YEMEN_MOBILE,
    phone: '773769681',
    amount: 100,
    trackingId: '3213210001',
);
