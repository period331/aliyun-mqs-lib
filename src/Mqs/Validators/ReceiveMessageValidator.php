<?php
// baocaixiong 下午3:19

namespace Mqs\Validators;


use Mqs\Requests\ReceiveMessage;

class ReceiveMessageValidator extends MessageValidator
{
    /**
     * @param ReceiveMessage $req
     * @throws \Mqs\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}