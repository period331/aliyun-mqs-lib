<?php
// baocaixiong 下午4:07

namespace Mqs\Responses;


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