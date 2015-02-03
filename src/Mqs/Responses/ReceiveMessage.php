<?php
// baocaixiong 下午5:52

namespace Mqs\Responses;

use Mqs\Message;


class ReceiveMessage extends BaseResponse
{
    /**
     * @return Message
     */
    public function getMessage()
    {
        return new Message($this->arrayBody['Message']);
    }

    /**
     * 是否未找到job
     *
     * @return bool
     */
    public function isNotFound()
    {
        return $this->stats == 404;
    }
}