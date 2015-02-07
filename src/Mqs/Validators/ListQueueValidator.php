<?php
// baocaixiong 下午3:00

namespace Mqs\Validators;


use Mqs\Requests\ListQueue;

class ListQueueValidator extends QueueValidator
{
    /**
     * @param ListQueue $req
     * @throws \Mqs\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}