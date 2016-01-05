<?php

namespace Mns\Validators;


use Mns\Requests\ListQueue;

class ListQueueValidator extends QueueValidator
{
    /**
     * @param ListQueue $req
     * @throws \Mns\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::listConditionValidate($req);
    }
}