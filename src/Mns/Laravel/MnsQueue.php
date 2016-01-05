<?php

namespace Mns\Laravel;

use Illuminate\Queue\Queue;
use Mns\Exceptions\RequestException;
use Mns\Requests\ReceiveMessage;
use Mns\Requests\SendMessage;
use Mns\Responses\SendMessage as SendMessageRes;
use Mns\Responses\ReceiveMessage as ReceiveMessageRes;

/**
 * Class MqsQueue
 * @package Mns\Laravel
 */
class MnsQueue extends Queue
{
    /**
     * 默认队列名称
     *
     * @var string
     */
    protected $default;

    /**
     * 保持连接时间
     *
     * @var int
     */
    protected $keepAlive = 30;

    /**
     * @param string $default
     * @param int $keepAlive
     */
    public function __construct($default = 'default', $keepAlive = 30)
    {
        $this->default = $default;
        $this->keepAlive = $keepAlive;
    }

    /**
     * Push a new job onto the queue.
     *
     * @param  string $job
     * @param  mixed $data
     * @param  string $queue
     * @return mixed
     */
    public function push($job, $data = '', $queue = null)
    {
        return $this->pushRaw($this->createPayload($job, $data), $queue);
    }

    /**
     * Push a raw payload onto the queue.
     *
     * @param  string $payload
     * @param  string $queue
     * @param  array $options
     * @return mixed
     */
    public function pushRaw($payload, $queue = null, array $options = array())
    {
        $req = new SendMessage($this->getQueue($queue));
        $req->setMessageBody($payload);

        /**
         * @var $res SendMessageRes
         */
        $res = $req->send();

        return $res->getMessageId();
    }

    /**
     * Push a new job onto the queue after a delay.
     *
     * @param  \DateTime|int $delay
     * @param  string $job
     * @param  mixed $data
     * @param  string $queue
     * @return mixed
     */
    public function later($delay, $job, $data = '', $queue = null)
    {
        $payload = $this->createPayload($job, $data);
        $req = new SendMessage($this->getQueue($queue));

        $req->setMessageBody($payload);
        $req->setDelaySeconds($this->getSeconds($delay));

        /**
         * @var $res SendMessageRes
         */
        $res = $req->send();

        return $res->getMessageId();
    }

    /**
     * Pop the next job off of the queue.
     *
     * @param  string $queue
     * @return \Illuminate\Queue\Jobs\Job|null
     * @throws RequestException
     * @throws \Exception
     */
    public function pop($queue = null)
    {
        $req = new ReceiveMessage($queue = $this->getQueue($queue));

        $req->setWaitseconds($this->keepAlive);

        try {
            /**
             * @var $res ReceiveMessageRes
             */
            $res = $req->send();
        } catch (RequestException $e) {
            if ($e->type == 'MessageNotExist') {
                return null;
            }

            throw $e;
        }

        if (!$res->isNotFound() and $job = $res->getMessage()) {
            return new MqsJob($this->container, $job, $queue);
        }

        return null;
    }

    /**
     * @param string $queue
     * @return string
     */
    public function getQueue($queue = '')
    {
        return $queue ?: $this->default;
    }

    public function connect()
    {
        return $this;
    }
}