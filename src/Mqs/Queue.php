<?php
// baocaixiong 下午3:23

namespace Mqs;


use Mqs\Exceptions\QueueExists;
use Mqs\Requests\CreateQueue;

class Queue
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * @param string $queueName
     * @param bool $exists
     */
    public function __construct($queueName, $exists = false)
    {
        $this->name = $queueName;

        $this->exists = $exists;
    }

    /**
     * @return Responses\CreateQueue
     * @throws \Exception
     */
    public function create()
    {
        if ($this->exists) {
            throw new QueueExists;
        }

        $req = new CreateQueue($this->name);
        return $req->send();
    }

    public function peekMessage()
    {

    }
}