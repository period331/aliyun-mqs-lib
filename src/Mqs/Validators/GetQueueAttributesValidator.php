<?php
// baocaixiong 下午3:06

namespace Mqs\Validators;


use Mqs\Requests\GetQueueAttributes;

class GetQueueAttributesValidator extends QueueValidator
{
    /**
     * @param GetQueueAttributes $req
     * @throws \Mqs\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}