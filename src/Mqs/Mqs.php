<?php

namespace Mqs;

use Mqs\Requests\CreateQueue;
use Mqs\Requests\DeleteMessage;
use Mqs\Requests\DeleteQueue;
use Mqs\Requests\ListQueue;
use Mqs\Requests\ReceiveMessage;
use Mqs\Requests\SendMessage;

const GET_ACCOUNT_STATUS = 200;
const CREATE_QUEUE_STATUS = 201;
const DELETE_QUEUE_STATUS = 204;
const LIST_QUEUE_STATUS = 200;
const SET_QUEUE_ATTRIBUTES_STATUS = 200;
const SEND_MESSAGE_STATUS = 201;
const RECEIVE_MESSAGE_STATUS = 200;
const DELETE_MESSAGE_STATUS = 204;
const PEEK_MESSAGE_STATUS = 200;
const CHANGE_MESSAGE_VISIBILITY_STATUS = 200;
const SET_POLICY_STATUS = 204;
const DELETE_POLICY_STATUS = 204;
const GET_POLICY_STATUS = 200;

/**
 * Class Mqs
 * @package Mqs
 */
class Mqs
{
    const VERSION = '2014-07-08';

    /**
     * @var Account
     */
    public $account;

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
        return new CreateQueue($queueName);
    }

    /**
     * @param string $prefix
     * @return ListQueue
     */
    public function listQueue($prefix = '')
    {
        return new ListQueue($prefix);
    }

    /**
     * @param string $queueName
     * @return DeleteQueue
     */
    public function deleteQueue($queueName)
    {
        return new DeleteQueue($queueName);
    }

    /**
     * @param string $queueName
     * @return SendMessage
     */
    public function sendMessage($queueName)
    {
        return new SendMessage($queueName);
    }

    /**
     * @param string $queueName
     * @param int $waitSeconds
     * @return ReceiveMessage
     */
    public function receiveMessage($queueName, $waitSeconds = 10)
    {
        return new ReceiveMessage($queueName, $waitSeconds);
    }

    /**
     * @param string $queueName
     * @return DeleteMessage
     */
    public function deleteMessage($queueName)
    {
        return new DeleteMessage($queueName);
    }
}
