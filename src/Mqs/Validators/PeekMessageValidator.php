<?php
// baocaixiong 下午3:22

namespace Mqs\Validators;


use Mqs\Requests\PeekMessage;

class PeekMessageValidator extends MessageValidator
{
    /**
     * @param PeekMessage $req
     * @throws \Mqs\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}