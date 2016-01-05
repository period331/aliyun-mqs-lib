<?php

namespace Mns\Validators;


use Mns\Requests\DeleteMessage;

class DeleteMessageValidator extends MessageValidator
{
    /**
     * @param DeleteMessage $req
     * @throws \Mns\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::receiptHandleValidate($req->getReceiptHandler());
    }

}