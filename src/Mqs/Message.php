<?php
// baocaixiong 下午4:12

namespace Mqs;

use Mqs\Traits\Message as MessageTrait;
use Mqs\Traits\Object;

class Message
{
    use MessageTrait;
    use Object;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->setterConstruct($attributes);
    }
}