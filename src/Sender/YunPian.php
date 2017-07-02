<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-07-02
 */

namespace fk\messenger\Sender;

use fk\messenger\SendFailedException;
use Yunpian\Sdk\Constant\Code;
use Yunpian\Sdk\YunpianClient;

class YunPian implements SenderInterface
{
    public $result;

    public $apiKey;

    public function send($mobile, $data)
    {
        $client = YunpianClient::create($this->apiKey);

        $param = [YunpianClient::MOBILE => $mobile, YunpianClient::TEXT => $data];
        $result = $client->sms()->single_send($param);

        if ($result->code() === Code::OK) return true;

        throw new SendFailedException($this, $result);
    }
}