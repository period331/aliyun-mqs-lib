<?php

namespace Mqs\Requests;

/**
 * Class ListQueue
 * @package Mqs\Requests
 */
class ListQueue extends BaseRequest
{
    protected $payload = [];

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var string
     */
    protected $requestResource = '/';

    /**
     * @param string $prefix
     * @return $this
     */
    public function prefix($prefix)
    {
        $this->specificHeaders['x-mqs-prefix'] = $prefix;

        return $this;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function retNumber($number)
    {
        $this->specificHeaders['x-mqs-ret-number'] = $number;

        return $this;
    }

    /**
     * @param string $marker
     * @return $this
     */
    public function marker($marker)
    {
        $this->specificHeaders['x-mqs-ret-number'] = $marker;

        return $this;
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function withMeta($bool)
    {
        $this->specificHeaders['x-mqs-with-meta'] = $bool ? 'true' : 'false';

        return $this;
    }
}