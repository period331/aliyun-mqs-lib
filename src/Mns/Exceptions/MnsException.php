<?php

namespace Mns\Exceptions;


class MnsException extends \Exception
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