<?php
// baocaixiong 下午3:00

namespace Mqs\Validators;


use Mqs\Requests\ListQueue;

class ListQueueValidator extends QueueValidator
{
    public static function validate(ListQueue $req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}