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
    public function send($mobile, $data);
}