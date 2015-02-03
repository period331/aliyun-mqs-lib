<?php
// baocaixiong 下午3:41

namespace Mqs\Laravel;

use Illuminate\Container\Container;
use Illuminate\Queue\Jobs\Job;
use Mqs\Message;
use Mqs\Requests\ChangeMessageVisibility;

class MqsJob extends Job
{
    /**
     * @var Message
     */
    protected $job;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var string
     */
    protected $queue;

    /**
     * Create a new job instance.
     *
     * @param  \Illuminate\Container\Container $container
     * @param  Message $job
     * @param  string $queue
     */
    public function __construct(Container $container, Message $job, $queue)
    {
        $this->job = $job;
        $this->queue = $queue;
        $this->container = $container;
    }

    /**
     * Fire the job.
     *
     * @return void
     */
    public function fire()
    {
        $this->resolveAndFire(json_decode($this->getRawBody(), true));
    }

    /**
     * Release the job back into the queue.
     *
     * @param  int $delay
     * @return void
     */
    public function release($delay = 0)
    {
        $req = new ChangeMessageVisibility($this->queue);
        $req->setReceiptHandle($this->job->getReceiptHandle());
        $req->setVisibilityTimeout($delay);

        /**
         * @var $res \Mqs\Responses\ChangeMessageVisibility
         */
        $req->send();
    }

    /**
     * Get the number of times the job has been attempted.
     *
     * @return int
     */
    public function attempts()
    {
        return $this->job->getDequeueCount();
    }

    /**
     * Get the raw body string for the job.
     *
     * @return string
     */
    public function getRawBody()
    {
        return $this->job->getRawBody();
    }
}