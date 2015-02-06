<?php
// baocaixiong 下午3:19

namespace Mqs\Validators;


use Mqs\Requests\ReceiveMessage;

class ReceiveMessageValidator extends MessageValidator
{
    public static function validate(ReceiveMessage $req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}