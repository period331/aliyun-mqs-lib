<?php
// baocaixiong 下午3:06

namespace Mqs\Validators;


use Mqs\Requests\GetQueueAttributes;

class GetQueueAttrValidator extends QueueValidator
{
    public static function validate(GetQueueAttributes $req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}