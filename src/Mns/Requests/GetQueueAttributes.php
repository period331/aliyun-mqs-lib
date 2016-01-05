<?php

namespace Mns\Requests;


class GetQueueAttributes extends BaseRequest
{
    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @param string $queueName
     */
    public function __construct($queueName)
    {
        $this->queueName = $queueName;
        $this->requestResource = '/'.$this->queueName;
    }
}