<?php
// baocaixiong 下午3:03

namespace Mqs\Validators;


use Mqs\Requests\SetQueueAttributes;

class SetQueueAttrValidator extends QueueValidator
{
    public static function validate(SetQueueAttributes $req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}