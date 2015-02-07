<?php
// baocaixiong 下午3:21

namespace Mqs\Validators;


use Mqs\Requests\DeleteMessage;

class DeleteMessageValidator extends MessageValidator
{
    /**
     * @param DeleteMessage $req
     * @throws \Mqs\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::receiptHandleValidate($req->getReceiptHandler());
    }

}