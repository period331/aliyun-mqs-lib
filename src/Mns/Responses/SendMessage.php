<?php

namespace Mns\Responses;


class SendMessage extends BaseResponse
{
    protected $messageId = 0;

    protected $messageBodyMD5 = 0;


    /**
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @return int
     */
    public function getMessageBodyMD5()
    {
        return $this->messageBodyMD5;
    }
}