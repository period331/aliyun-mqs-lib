<?php
// baocaixiong 下午4:12

namespace Mqs;

use Mqs\Traits\Message as MessageTrait;

class Message
{
    use MessageTrait;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $con = setter_construct($this);
        $con($attributes);
    }
}