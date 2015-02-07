<?php

namespace Mqs\Requests;

/**
 * Class ListQueue
 * @package Mqs\Requests
 */
class ListQueue extends BaseRequest
{
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
    public function setPrefix($prefix)
    {
        $this->specificHeaders['x-mqs-prefix'] = $prefix;

        return $this;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function setRetNumber($number)
    {
        $this->specificHeaders['x-mqs-ret-number'] = $number;

        return $this;
    }

    /**
     * @param string $marker
     * @return $this
     */
    public function setMarker($marker)
    {
        $this->specificHeaders['x-mqs-ret-number'] = $marker;

        return $this;
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function setWithMeta($bool)
    {
        $this->specificHeaders['x-mqs-with-meta'] = $bool ? 'true' : 'false';

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getMarker()
    {
        return isset($this->specificHeaders['x-mqs-marker']) ? $this->specificHeaders['x-mqs-marker'] : '';
    }

    public function getRetnumber()
    {
        return isset($this->specificHeaders['x-mqs-ret-number']) ? $this->specificHeaders['x-mqs-ret-number'] : -1;
    }
}