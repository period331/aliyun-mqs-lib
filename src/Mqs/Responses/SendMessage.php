<?php
// baocaixiong 下午5:53

namespace Mqs\Responses;


class SendMessage extends BaseResponse
{

    /**
     * @return int
     */
    public function getMessageId()
    {
        return $this->arrayBody['Message']['MessageId'];
    }
}