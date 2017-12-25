# FK Messenger

**Usage**

```php
<?php

/**
 * @var string $mobile
 * @var mixed $data
 */
$messenger = new \fk\messenger\Messenger();
$messenger->with([
    'sender' => \fk\messenger\Sender\SenderInterface::class,
    // ... rest sender public properties
])->send($mobile , $data);

```

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