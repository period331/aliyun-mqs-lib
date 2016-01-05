<?php

namespace Mns\Requests;


class DeleteQueue extends BaseRequest
{
    /**
     * @var string
     */
    protected $method = 'DELETE';

    protected $expectedStatus = 204;

    /**
     * @param string $queueName
     */
    public function __construct($queueName)
    {
        $this->queueName = $queueName;
        $this->requestResource = '/'.$this->queueName;
    }

}