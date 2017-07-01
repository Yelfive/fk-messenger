<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-07-01
 */

namespace fk\messenger\Sender;

use AlibabaAliqinFcSmsNumSendRequest;
use TopClient;

include __DIR__ . '/../../lib/AliDaYu/AutoLoader.php';

class AliDaYu implements SenderInterface
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

    public function send($mobile, $data)
    {
        $client = $this->getClient();
        $request = new AlibabaAliqinFcSmsNumSendRequest;
        if (!empty($data['extend'])) $request->setExtend($data['extend']);
        $request->setSmsType('normal');
        $request->setSmsFreeSignName($this->signature);
        if (!empty($data['params'])) $request->setSmsParam(json_encode($data['params'], JSON_UNESCAPED_UNICODE));
        $request->setRecNum($mobile);
        $request->setSmsTemplateCode($data['template']);
        $response = $client->execute($request);
        var_dump($response);
        die;
    }
}