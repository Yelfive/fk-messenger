<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */

namespace fk\messenger\Sender;

/**
 * All the public property can be set by
 * calling [[Messenger::with]]
 * @see \fk\messenger\Messenger::loadSender() for more detail
 */
interface SenderInterface
{
    /**
     * @param string $mobile
     * @param mixed $message This field differs from senders, some may want a string message, some may desire an array parameters
     * @return bool
     */
    public function send($mobile, $message);

    /**
     * Get last response, may be error, may be success
     * @return array
     */
    public function response();
}