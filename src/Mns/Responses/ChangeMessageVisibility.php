<?php

namespace Mns\Responses;


class ChangeMessageVisibility extends BaseResponse
{
    protected $nextVisibleTime = -1;

    protected $receiptHandle = '';

    /**
     * @return int
     */
    public function getNextVisibleTime()
    {
        return $this->nextVisibleTime;
    }

    /**
     * @return string
     */
    public function getReceiptHandle()
    {
        return $this->receiptHandle;
    }
}