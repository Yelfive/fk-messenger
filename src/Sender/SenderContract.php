<?php

/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @date 2017-12-25
 */

namespace fk\messenger\Sender;

abstract class SenderContract implements SenderInterface
{
    /**
     * @var array Last response data
     */
    protected $result;

    public function response()
    {
        return $this->result;
    }
}