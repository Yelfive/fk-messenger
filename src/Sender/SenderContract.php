<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-12-25
 */

namespace fk\messenger\Sender;

abstract class SenderContract implements SenderInterface
{
    /**
     * @var array Last response data
     */
    protected $result;

    /**
     * @var string Signature of a sms message
     */
    public $signature;

    public function response()
    {
        return $this->result;
    }

    public function sign(&$message)
    {
        if (is_string($message) && $this->signature && false === strpos($message, '【')) {
            $message = "【{$this->signature}】$message";
        }
    }
}