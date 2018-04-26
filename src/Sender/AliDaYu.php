<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-07-01
 */

namespace fk\messenger\Sender;

use AlibabaAliqinFcSmsNumSendRequest;
use TopClient;

include __DIR__ . '/../../lib/AliDaYu/AutoLoader.php';

class AliDaYu extends SenderContract
{

    public $appKey;
    public $secretKey;
    public $signature;

    public $logPath;

    private $_client;

    /**
     * @return TopClient
     */
    protected function getClient()
    {
        if ($this->_client instanceof TopClient) return $this->_client;

        define('TOP_SDK_WORK_DIR', $this->logPath ?: sys_get_temp_dir());

        return $this->_client = new TopClient($this->appKey, $this->secretKey);
    }

    public function send($mobile, $message)
    {
        $client = $this->getClient();
        $request = new AlibabaAliqinFcSmsNumSendRequest;
        if (!empty($message['extend'])) $request->setExtend($message['extend']);
        $request->setSmsType('normal');
        $request->setSmsFreeSignName($this->signature);
        if (!empty($message['params'])) $request->setSmsParam(json_encode($message['params'], JSON_UNESCAPED_UNICODE));
        $request->setRecNum($mobile);
        $request->setSmsTemplateCode($message['template']);
        $response = $client->execute($request);
        var_dump($response);
        die;
    }
}