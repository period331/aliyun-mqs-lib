<?php
// baocaixiong 下午3:03

namespace Mqs\Validators;


use Mqs\Requests\SetQueueAttributes;

class SetQueueAttrValidator extends QueueValidator
{
    /**
     * @param SetQueueAttributes $req
     * @throws \Mqs\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}