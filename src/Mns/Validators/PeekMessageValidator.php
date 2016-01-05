<?php

namespace Mns\Validators;


use Mns\Requests\PeekMessage;

class PeekMessageValidator extends MessageValidator
{
    /**
     * @param PeekMessage $req
     * @throws \Mns\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}