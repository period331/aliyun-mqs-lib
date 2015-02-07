<?php
// baocaixiong 下午4:58

namespace Mqs\Responses;


class ListQueue extends BaseResponse
{
    protected $queue;

    /**
     * @param array $queues
     */
    protected function setQueue(array $queues)
    {
        if (! isset($queues[0])) {
            $queues = [$queues];
        }

        $this->queue = $queues;
    }

    public function getQueues()
    {
        return $this->queue;
    }

    /**
     * @param string $queueName
     * @return bool
     */
    public function hasQueue($queueName)
    {
        foreach ($this->queue as $queue) {
            if (isset($queue['QueueName']) && $queueName == $queue['QueueName']) {
                return true;
            }

            if (isset($queue['QueueUrl']) && trim(parse_url($queue['QueueUrl'], PHP_URL_PATH), '/') == $queueName) {
                return true;
            }
        }

        return false;
    }
}