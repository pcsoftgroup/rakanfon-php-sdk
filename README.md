# RakanFon SDK

## Introduction

The [RakanFon](http://rakan.rakanfon.com:9099) SDK provides an expressive interface for interacting with RakanFon's API.

### Installation

To install the SDK in your project you need to add the package via composer:

```json
{
    "require": {
        "pcsoftgroup/rakanfon-php-sdk": "dev-main"
    },
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/pcsoftgroup/rakanfon-php-sdk.git"
        }
    ]
}
```

### Upgrading

When upgrading to a new major version of RakanFon SDK, it's important that you carefully review [the upgrade guide](https://github.com/pcsoftgroup/rakanfon-php-sdk/blob/main/UPGRADE.md).

### Basic Usage

You can create an instance of the SDK like so:

```php
use PCsoft\RakanFon\RakanFon;
use PCsoft\RakanFon\Resources\PaymentType;

$rakanfon = new RakanFon();
$rakanfon->setUsername('YOUR_USERNAME');
$rakanfon->setPassword('YOUR_PASSWORD');
$rakanfon->setToken('YOUR_TOKEN');
$rakanfon->build();

$payment = $rakanfon->createPayment(
    type: PaymentType::YEMEN_MOBILE,
    phone: '773769681',
    amount: 100,
    trackingId: '3213210001',
);
```

## Contributing

Thank you for considering contributing to RakanFon SDK! You can read the contribution guide [here](.github/CONTRIBUTING.md).

## Code of Conduct

In order to ensure that the PCsoft community is welcoming to all, please review and abide by the [Code of Conduct](https://pcsoftgroup.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

Please review [our security policy](https://github.com/pcsoftgroup/rakanfon-php-sdk/security/policy) on how to report security vulnerabilities.

## License

PCsoft RakanFon SDK is open-sourced software licensed under the [MIT license](LICENSE.md).
