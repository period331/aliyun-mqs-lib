<?php
// baocaixiong 下午2:11

namespace Mqs\Validators;

use Mqs\Exceptions\ParameterException;
use Mqs\Requests\ListQueue;


class ValidatorBase
{
    public static function validateString($item)
    {
        if (! is_string($item)) {
            throw new ParameterException('TypeInvalid', sprintf( "Bad type: '%s', '%s' expect type '%s'.",  gettype($item), $item, 'string'));
        }
    }

    public static function validateNumber($item)
    {
        if (! is_numeric($item)) {
            throw new ParameterException('TypeInvalid', sprintf( "Bad type: '%s', '%s' expect type '%s'.",  gettype($item), $item, 'numeric'));
        }
    }

    public static function validateFloat($item)
    {
        if (! is_float($item)) {
            throw new ParameterException('TypeInvalid', sprintf( "Bad type: '%s', '%s' expect type '%s'.",  gettype($item), $item, 'float'));
        }
    }

    public static function markerValidate($item)
    {
        self::validateString($item);
    }

    public static function retnumberValidate($item)
    {
        self::validateNumber($item);

        if ($item != -1 && $item <= 0) {
            throw new ParameterException('HeaderInvalid', sprintf('Bad value: "%s", x-mqs-number should larger than 0.', $item));
        }
    }

    public static function queueNameValidate($name)
    {
        self::validateString($name);

        if (! strlen($name)) {
            throw new ParameterException('QueueNameInvalid', sprintf('Bad value: "%s", the length of queue_name should larger than 1.', $name));
        }
    }

    public static function listConditionValidate(ListQueue $req)
    {
        if ($req->getPrefix() != '') {
            self::validateString($req->getPrefix());
        }

        self::markerValidate($req->getMarker());
        self::retnumberValidate($req->getRetnumber());
    }
}