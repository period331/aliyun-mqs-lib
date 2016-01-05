<?php

namespace Mns;

use Mns\Traits\Object;
use Mns\Traits\Queue as QueueTrait;

class Queue
{
    use QueueTrait;
    use Object;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->setterConstruct($attributes);
    }
}