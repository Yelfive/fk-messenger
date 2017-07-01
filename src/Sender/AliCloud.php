<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-07-01
 */

namespace fk\messenger\Sender;

use AliyunMNS\Client;
use AliyunMNS\Model\BatchSmsAttributes;
use AliyunMNS\Model\MessageAttributes;
use AliyunMNS\Exception\MnsException;
use AliyunMNS\Requests\PublishMessageRequest;

class AliCloud implements SenderInterface
{

    public $endPoint;
    public $accessKey;
    public $accessId;

    /**
     * @var Client
     */
    public $client;

    public function __construct()
    {
        /**
         * Step 1. 初始化Client
         */
        $this->endPoint = "YourMNSEndpoint"; // eg. http://1234567890123456.mns.cn-shenzhen.aliyuncs.com
        $this->accessId = "YourAccessId";
        $this->accessKey = "YourAccessKey";
        $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
    }

    public function template()
    {
    }

    public function send($mobile, $content)
    {
        /**
         * Step 2. 获取主题引用
         */
        $topicName = "YourTopicName";
        $topic = $this->client->getTopicRef($topicName);
        /**
         * Step 3. 生成SMS消息属性
         */
        // 3.1 设置发送短信的签名（SMSSignName）和模板（SMSTemplateCode）
        $batchSmsAttributes = new BatchSmsAttributes("YourSMSSignName", "YourSMSTemplateCode");
        // 3.2 （如果在短信模板中定义了参数）指定短信模板中对应参数的值
        $batchSmsAttributes->addReceiver("YourReceiverPhoneNumber1", array("YourSMSTemplateParamKey1" => "value1"));
        $batchSmsAttributes->addReceiver("YourReceiverPhoneNumber2", array("YourSMSTemplateParamKey1" => "value1"));
        $messageAttributes = new MessageAttributes(array($batchSmsAttributes));
        /**
         * Step 4. 设置SMS消息体（必须）
         *
         * 注：目前暂时不支持消息内容为空，需要指定消息内容，不为空即可。
         */
        $messageBody = "smsmessage";
        /**
         * Step 5. 发布SMS消息
         */
        $request = new PublishMessageRequest($messageBody, $messageAttributes);
        try {
            $res = $topic->publishMessage($request);
            echo $res->isSucceed();
            echo "\n";
            echo $res->getMessageId();
            echo "\n";
        } catch (MnsException $e) {
            echo $e;
            echo "\n";
        }
    }

}