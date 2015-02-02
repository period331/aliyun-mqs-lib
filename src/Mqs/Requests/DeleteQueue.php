<?php
/**
 * Created by PhpStorm.
 * User: baocaixiong
 * Date: 15/2/2
 * Time: 上午11:31
 */

namespace Mqs\Requests;


use Mqs\Account;

class DeleteQueue extends BaseRequest
{
    /**
     * @var string
     */
    protected $queueName;

    /**
     * @var string
     */
    protected $method = 'DELETE';

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