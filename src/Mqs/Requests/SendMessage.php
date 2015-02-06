<?php
namespace Mqs\Requests;

class SendMessage extends BaseRequest
{
    protected $method = 'POST';

    protected $payload = [
        'MessageBody' => [],
        'DelaySeconds' => 0,
        'Priority' => 8
    ];

    /**
     * @param string $queueName
     */
    public function __construct($queueName)
    {
        $this->queueName = $queueName;
        $this->requestResource = '/'.$queueName.'/messages';
    }

    /**
     * @param mixed $body
     * @return $this
     */
    public function setMessageBody(array $body)
    {
        $body = json_encode($body);

        $this->payload['MessageBody'] = $body;

        return $this;
    }

    /**
     * @param int $seconds
     * @return $this
     */
    public function setDelaySeconds($seconds = 0)
    {
        $this->payload['DelaySeconds'] = $seconds;

        return $this;
    }

    /**
     * @param int $priority
     * @return $this
     */
    public function setPriority($priority = 8)
    {
        $this->payload['Priority'] = $priority;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessageBody()
    {
        return $this->payload['MessageBody'];
    }

    /**
     * @return int
     */
    public function getDelaySeconds()
    {
        return $this->payload['DelaySeconds'];
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->payload['Priority'];
    }
}