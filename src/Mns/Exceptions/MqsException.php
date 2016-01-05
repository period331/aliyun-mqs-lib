<?php

namespace Mns\Exceptions;


class MqsException extends \Exception
{
    public $type;

    public $message;

    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;

        parent::__construct($message);
    }
}