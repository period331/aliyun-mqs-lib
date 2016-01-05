<?php

namespace Mns\Validators;


use Mns\Requests\GetQueueAttributes;

class GetQueueAttributesValidator extends QueueValidator
{
    /**
     * @param GetQueueAttributes $req
     * @throws \Mns\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}