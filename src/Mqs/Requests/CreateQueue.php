<?php

namespace Mqs\Requests;

use Mqs\Account;

class CreateQueue extends BaseRequest
{
    protected $payload = [
        'DelaySeconds' => 0,
        'MaximumMessageSize' => 65536,
        'MessageRetentionPeriod' => 345600,
        'VisibilityTimeout' => 30,
        'PollingWaitSeconds' => 0
    ];

    protected $method = 'PUT';

    /**
     * @var string
     */
    protected $queueName;

    /**
     * @param Account $account
     * @param string $queueName
     */
    public function __construct(Account $account, $queueName)
    {
        $this->queueName = $queueName;

        $this->requestResource = '/'.$this->queueName;

        parent::__construct($account);
    }
}