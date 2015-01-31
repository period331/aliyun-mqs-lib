<?php

namespace Mqs;

/**
 * Class Account
 * @package Mqs
 */
class Account
{
    protected $host;

    protected $accessKey;

    protected $accessSecret;

    /**
     * @param string $host
     * @param string $key
     * @param string $secret
     */
    public function __construct($host, $key, $secret)
    {
        $this->host = $host;
        $this->accessKey = $key;
        $this->accessSecret = $secret;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getSchemeHost()
    {
        return 'http://'.$this->host;
    }

    /**
     * @return string
     */
    public function getAccessKey()
    {
        return $this->accessKey;
    }

    /**
     * @return string
     */
    public function getAccessSecret()
    {
        return $this->accessSecret;
    }
}