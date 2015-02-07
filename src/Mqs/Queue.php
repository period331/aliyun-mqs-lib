<?php
// baocaixiong 下午3:23

namespace Mqs;

use Mqs\Traits\Queue as QueueTrait;

class Queue
{
    use QueueTrait;
    use QueueTrait {
        construct as protected;
    };

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->construct($attributes);
    }
}