<?php

namespace Mns\Responses;

use Mns\Traits\Message;


class ReceiveMessage extends BaseResponse
{
    use Message;

    /**
     * 是否未找到job
     *
     * @return bool
     */
    public function isNotFound()
    {
        return $this->stats == 404;
    }

    /**
     * @return \Mns\Message
     */
    public function getMessage()
    {
        return new \Mns\Message($this->arrayBody);
    }
}