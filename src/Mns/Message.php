<?php

namespace Mns;

use Mns\Traits\Message as MessageTrait;
use Mns\Traits\Object;

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