<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2018-04-26
 */

namespace fk\messenger\Sender;

use GuzzleHttp\Client;

/**
 * Class HaoTing
 * @package fk\messenger\Sender
 * @method HaoTingResult response()
 */
class HaoTing extends SenderContract
{

    public $host = 'http://sms.haotingyun.com/v2/sms';
    public $app_key = '';

    /**
     * @param string $mobile
     * @param mixed $message This field differs from senders, some may want a string message, some may desire an array parameters
     * @return bool
     */
    public function send($mobile, $message)
    {
        $uri = "$this->host/single_send.json";

        $response = (new Client())->post($uri, [
            'form_params' => [
                'apikey' => $this->app_key,
                'mobile' => $mobile,
                'text' => $message,
            ],
            'http_errors' => false,
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        $this->result = new HaoTingResult($result);
        return $this->result->code === 0;
    }
}

/**
 * Class HaoTingResult
 * @package fk\messenger\Sender
 * @property int $code
 * @property string $msg
 * @property int $count
 * @property float $fee
 * @property string $unit
 * @property string $mobile
 * @property int $sid
 */
Class HaoTingResult extends SenderResultContract
{
}