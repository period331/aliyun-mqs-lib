<?php

namespace Mns\Validators;


use Mns\Requests\ReceiveMessage;

class ReceiveMessageValidator extends MessageValidator
{
    /**
     * @param ReceiveMessage $req
     * @throws \Mns\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
        self::waitsecondsValidate($req->getWaitseconds());
    }
}