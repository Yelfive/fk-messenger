<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-12-10
 */

namespace fk\messenger\Sender;

use Qcloud\Sms\SmsSingleSender;

class Tencent extends SenderContract
{

    public $appId;

    public $appKey;

    public function send($mobile, $message)
    {
        $sender = new SmsSingleSender($this->appId, $this->appKey);
        $result = $sender->send(0, '86', $mobile, $message);
        $this->result = $res = json_decode($result, true);
        return isset($result) && $res['result'] === 0;
    }
}