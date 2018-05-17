<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-07-01
 */

namespace fk\messenger;

use fk\messenger\Sender\SenderContract;
use fk\messenger\Sender\SenderInterface;

class Messenger
{
    const WITH_ALI_CLOUD = 'AliCloud';
    const WITH_YUN_PIAN = 'YunPian';
    const WITH_TENCENT = 'Tencent';

    public $with;

    /**
     * @var SenderInterface
     */
    private $_sender;

    protected $content;

    public function with(array $with)
    {
        $this->with = $with;
        return $this;
    }

    /**
     * @param string $mobile
     * @param array|string $content
     * @return bool
     */
    public function send($mobile, $content): bool
    {
        $sender = $this->loadSender();
        $sender->sign($content);
        $this->content = $content;
        return $sender->send($mobile, $content);
    }

    /**
     * @return SenderContract
     */
    protected function loadSender()
    {
        if ($this->_sender instanceof SenderContract) return $this->_sender;
        $with = $this->with;
        $senderClass = $with['sender'];
        unset($with['sender']);
        $sender = new $senderClass;
        foreach ($with as $k => $v) {
            $sender->$k = $v;
        }
        return $this->_sender = $sender;
    }

    public function getResponse()
    {
        return $this->loadSender()->response();
    }

    public function getContent()
    {
        return $this->content;
    }
}