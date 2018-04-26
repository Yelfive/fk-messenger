<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2018-04-26
 */

namespace fk\messenger\Sender;

abstract class SenderResultContract
{
    public $originalProperties = [];

    public function __construct(array $properties)
    {
        foreach ($properties as $k => $value) {
            $this->$k = $value;
        }
        $this->originalProperties = $properties;
    }
}