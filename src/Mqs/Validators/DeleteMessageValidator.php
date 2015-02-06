<?php
// baocaixiong 下午3:21

namespace Mqs\Validators;


use Mqs\Requests\DeleteMessage;

class DeleteMessageValidator extends MessageValidator
{
    public static function validate(DeleteMessage $req)
    {
        parent::validate($req);

        self::receiptHandleValidate($req->getReceiptHandler());
    }

}