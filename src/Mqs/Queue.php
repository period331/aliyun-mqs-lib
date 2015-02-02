<?php
// baocaixiong 下午3:23

namespace Mqs;


class Queue
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     * @param string $queueName
     */
    public function __construct(Client $client, $queueName)
    {
        $this->client = $client;
        $this->name = $queueName;
    }
}