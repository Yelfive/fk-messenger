<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 7/1/17
 * Time: 08:08
 */

namespace fk\messenger\Sender;


interface SenderInterface
{
    public function send($mobile, $content);
}