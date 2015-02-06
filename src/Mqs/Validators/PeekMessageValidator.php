<?php
// baocaixiong 下午3:22

namespace Mqs\Validators;


use Mqs\Requests\PeekMessage;

class PeekMessageValidator extends MessageValidator
{
    public static function validate(PeekMessage $req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}