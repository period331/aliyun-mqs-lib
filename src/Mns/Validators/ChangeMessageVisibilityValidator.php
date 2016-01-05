<?php

namespace Mns\Validators;


use Mns\Exceptions\ParameterException;
use Mns\Requests\ChangeMessageVisibility;

class ChangeMessageVisibilityValidator extends MessageValidator
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