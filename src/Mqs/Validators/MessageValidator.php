<?php
// baocaixiong 下午3:07

namespace Mqs\Validators;


use Mqs\Exceptions\ParameterException;

class MessageValidator extends BaseValidator
{
    public static function receiptHandleValidate($handler)
    {
        if ( ! $handler) {
            throw new ParameterException('ReceiptHandleInvalid', 'The receipt handle should not be null.');
        }
    }

    public static function waitsecondsValidate($seconds)
    {
        if ($seconds < 0 || $seconds > 30) {
            throw new ParameterException('WaitSecondsInvalid', 'The value of waitSeconds should be between 0 and 30.');
        }
    }

    public static function validate($req)
    {
        // pass
    }
}