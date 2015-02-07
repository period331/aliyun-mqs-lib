<?php
// baocaixiong 下午3:23

namespace Mqs\Validators;


use Mqs\Exceptions\ParameterException;
use Mqs\Requests\ChangeMessageVisibility;

class ChangeMsgVisValidator extends MessageValidator
{
    /**
     * @param ChangeMessageVisibility $req
     * @throws ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::receiptHandleValidate($req->getReceiptHandler());
        self::validateNumber($timeout = $req->getVisibilityTimeout());

        if ($timeout < 0 || $timeout > 43200) {
            throw new ParameterException('VisibilityTimeoutInvalid', sprintf('Bad value: "%d", visibility timeout should between 0 and 43200.', $timeout));
        }
    }
}