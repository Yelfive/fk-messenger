# FK Messenger

## Tencent

```php
<?php

/**
 * @var string $mobile
 * @var string $message
 */
$messenger = new \fk\messenger\Messenger();
$messenger->with([
    'sender' => \fk\messenger\Sender\Tencent::class,
    'appId' => 'app id',
    'appKey' => 'app key',
])->send($mobile , $message);

```