# Laravel notification channel for IFTTT VOIP Calls

This package is designed to provide a custom Laravel notification channel and facade for sending VOIP messages via IFTTT.

## Installation

You can install the package via composer:

```bash
composer require arimolzer/ifttt-voip
```

## Usage

A complete example of how to add the VOIP call channel to a notification is below:

``` php

use Arimolzer\IftttVoip\Channels\IftttVoipCall;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ContactRequestSubmitted extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [IftttVoipCall::class];
    }
    
    public function toIftttVoipCall($notifiable) : IftttVoipCall
    {
        return (new IftttVoipCall)
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

You can also make an asynchronous VOIP call via the `IftttVoip::call()` facade. eg.

```php
IftttVoipFacade::call($message->param1, $message->param2, $message->param3, $message->event, $message->key);
```

### Testing

``` bash
composer test
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
