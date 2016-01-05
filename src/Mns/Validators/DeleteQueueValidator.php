<?php

namespace Mns\Validators;


use Mns\Requests\DeleteQueue;

class DeleteQueueValidator extends QueueValidator
{
    /**
     * @param DeleteQueue $req
     * @throws \Mns\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}