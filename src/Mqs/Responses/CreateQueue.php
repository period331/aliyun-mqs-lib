<?php // baocaixiong 下午3:03

namespace Mqs\Responses;


class CreateQueue extends BaseResponse
{
    /**
     * @return int
     */
    public function getDelaySeconds()
    {
        return $this->request->getDelaySeconds();
    }

    /**
     * @return int
     */
    public function getMaximumMessageSize()
    {
        return $this->request->getMaximumMessageSize();
    }

    /**
     * @return int
     */
    public function getMessageRetentionPeriod()
    {
        return $this->request->getMessageRetentionPeriod();
    }

    /**
     * @return int
     */
    public function getVisibilityTimeout()
    {
        return $this->request->getVisibilityTimeout();
    }

    /**
     * @return int
     */
    public function getPollingWaitSeconds()
    {
        return $this->request->getPollingWaitSeconds();
    }
}