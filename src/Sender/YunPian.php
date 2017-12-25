<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-07-02
 */

namespace fk\messenger\Sender;

use Yunpian\Sdk\Constant\Code;
use Yunpian\Sdk\YunpianClient;

class YunPian extends SenderContract
{
    public $result;

    public $apiKey;

    public function send($mobile, $data)
    {
        $client = YunpianClient::create($this->apiKey);

        $param = [YunpianClient::MOBILE => $mobile, YunpianClient::TEXT => $data];
        /** @var \Yunpian\Sdk\Model\Result $result */
        $result = $client->sms()->single_send($param);
        $this->result = $result->data();

        return $result->code() === Code::OK;
    }

    /**
     * Get last response, may be error, may be success
     * @return array
     */
    public function response()
    {
        return $this->result;
    }
}