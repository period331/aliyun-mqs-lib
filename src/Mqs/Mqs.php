<?php

namespace Mqs;

use Mqs\Requests\CreateQueue;
use Mqs\Requests\DeleteQueue;
use Mqs\Requests\ListQueue;

class Mqs
{
    const VERSION = '2014-07-08';

    /**
     * @var Account
     */
    protected $account;

    /**
     * @param string $host
     * @param string $key
     * @param string $secret
     */
    public function __construct($host, $key, $secret)
    {
        $this->account = new Account($host, $key, $secret);
    }

    /**
     * @param string $queueName
     *
     * @return CreateQueue
     */
    public function createQueue($queueName)
    {
        return new CreateQueue($this->account, $queueName);
    }

    /**
     * @param string $prefix
     * @return ListQueue
     */
    public function listQueue($prefix = '')
    {
        return new ListQueue($this->account, $prefix);
    }

    /**
     * @param string $queueName
     * @return DeleteQueue
     */
    public function deleteQueue($queueName)
    {
        return new DeleteQueue($this->account, $queueName);
    }
}
