<?php

namespace Mqs\Requests;


class ReceiveMessage extends BaseRequest
{
    protected $method = 'GET';

    protected $payload = [
        'waitseconds' => 10
    ];

    public function __construct($queueName)
    {
        $this->queueName = $queueName;
        $this->requestResource = '/'.$queueName.'/messages';
    }

    /**
     * @param int $seconds
     * @return $this
     */
    public function setWaitseconds($seconds = 10)
    {
        $this->payload['waitseconds'] = $seconds;

        return $this;
    }
}