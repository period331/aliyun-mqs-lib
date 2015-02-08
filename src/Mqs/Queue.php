<?php
// baocaixiong 下午3:23

namespace Mqs;

use Mqs\Traits\Object;
use Mqs\Traits\Queue as QueueTrait;

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