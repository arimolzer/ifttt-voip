# Laravel notification channel for IFTTT VOIP Calls

[![Latest Version on Packagist](https://img.shields.io/packagist/v/arimolzer/ifttt-webhook.svg?style=flat-square)](https://packagist.org/packages/arimolzer/ifttt-webhook)
[![Build Status](https://img.shields.io/travis/arimolzer/ifttt-webhook/master.svg?style=flat-square)](https://travis-ci.org/arimolzer/ifttt-webhook)
[![Quality Score](https://img.shields.io/scrutinizer/g/arimolzer/ifttt-webhook.svg?style=flat-square)](https://scrutinizer-ci.com/g/arimolzer/ifttt-webhook)
[![Total Downloads](https://img.shields.io/packagist/dt/arimolzer/ifttt-webhook.svg?style=flat-square)](https://packagist.org/packages/arimolzer/ifttt-webhook)

This package is designed to provide a custom Laravel notification channel and facade for webhooks to IFTTT.

## Installation

You can install the package via composer:

```bash
composer require arimolzer/ifttt-webhook
```

## Usage

A complete example of how to add the IFTTT webhook channel to a notification is below:

``` php

use Arimolzer\IftttWebhook\Channels\IftttWebhookChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ContactRequestSubmitted extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [IftttWebhookChannel::class];
    }
    
    public function toIftttWebhookChannel($notifiable) : IftttWebhookChannel
    {
        return (new IftttWebhookChannel)
            ->setKey(env('IFTTT_VOIP_WEBHOOK_KEY'))
            ->setEvent(env('IFTTT_VOIP_WEBHOOK_EVENT'))
            ->setParams(
                $notifiable->param1,
                $notifiable->param2
                $notifiable->param3
            );
    }
}
```

You can also make an asynchronous webhook call via the `IftttWebhook::get()` facade. eg.

```php
IftttWebhookFacade::get($message->param1, $message->param2, $message->param3, $message->event, $message->key);
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ari.molzer@molzertech.com instead of using the issue tracker.

## Credits

- [Ari Molzer](https://github.com/arimolzer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
