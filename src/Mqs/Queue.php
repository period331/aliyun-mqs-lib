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
     * @param string $queueName
     */
    public function __construct($queueName)
    {
        $this->name = $queueName;
    }

    public function create()
    {

    }
}