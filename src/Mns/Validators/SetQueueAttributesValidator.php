<?php

namespace Mns\Validators;


use Mns\Requests\SetQueueAttributes;

class SetQueueAttributesValidator extends QueueValidator
{
    /**
     * @param SetQueueAttributes $req
     * @throws \Mns\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}