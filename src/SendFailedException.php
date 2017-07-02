<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-07-03
 */

namespace fk\messenger;

class SendFailedException extends \Exception
{

    protected $sender;

    protected $result;

    public function __construct($sender, $result)
    {
        $this->sender = $sender;
        $this->result = $result;
        $message = 'Messenger failed deliver the message through ' . get_class($sender);
        $code = 0;
        $previous = null;
        parent::__construct($message, $code, $previous);
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function getResult()
    {
        return $this->result;
    }
}