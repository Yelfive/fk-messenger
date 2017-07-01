<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-07-01
 */

namespace fk\messenger\Sender;

use AliyunMNS\Client;
use AliyunMNS\Model\BatchSmsAttributes;
use AliyunMNS\Model\MessageAttributes;
use AliyunMNS\Requests\PublishMessageRequest;

class AliCloud implements SenderInterface
{

    public $endPoint;
    public $accessKey;
    public $accessId;

    public $topic;
    public $signature;

    /**
     * @var Client
     */
    protected $client;

    public function template()
    {
    }

    protected function getClient()
    {
        if ($this->client instanceof Client) return $this->client;

        return $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
    }

    /**
     * @return \AliyunMNS\Topic
     */
    protected function getTopic()
    {
        return $this->getClient()->getTopicRef($this->topic);
    }

    public function send($mobile, $data)
    {
        /**
         * Step 2. 获取主题引用
         */
        $topic = $this->getTopic();
        /**
         * Step 3. 生成SMS消息属性
         */
        // 3.1 设置发送短信的签名（SMSSignName）和模板（SMSTemplateCode）
        $batchSmsAttributes = new BatchSmsAttributes($this->signature, $data['template']);
        // 3.2 （如果在短信模板中定义了参数）指定短信模板中对应参数的值
//        $batchSmsAttributes->addReceiver("YourReceiverPhoneNumber1", array("YourSMSTemplateParamKey1" => "value1"));
//        $batchSmsAttributes->addReceiver("YourReceiverPhoneNumber2", array("YourSMSTemplateParamKey1" => "value1"));

        $batchSmsAttributes->addReceiver($mobile, $data['params'] ?? []);

        $messageAttributes = new MessageAttributes(array($batchSmsAttributes));
        /**
         * Step 4. 设置SMS消息体（必须）
         *
         * 注：目前暂时不支持消息内容为空，需要指定消息内容，不为空即可。
         */
        $messageBody = $data['message']??'';
        /**
         * Step 5. 发布SMS消息
         */
        $request = new PublishMessageRequest($messageBody, $messageAttributes);
        $res = $topic->publishMessage($request);
        return $res->isSucceed();
    }

    public function batchSend()
    {
    }


}