<?php
/**
 * Created by PhpStorm.
 * User: baocaixiong
 * Date: 15/2/2
 * Time: 上午11:31
 */

namespace Mqs\Requests;


class DeleteQueue extends BaseRequest
{
    /**
     * @var string
     */
    protected $method = 'DELETE';

    /**
     * @param string $queueName
     */
    public function __construct($queueName)
    {
        $this->queueName = $queueName;
        $this->requestResource = '/'.$this->queueName;
    }

}