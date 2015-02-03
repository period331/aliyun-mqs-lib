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
     * @var Account
     */
    private static $instance;

    /**
     * @param string $host
     * @param string $key
     * @param string $secret
     *
     * @return Account
     */
    public static function init($host, $key, $secret)
    {
        return self::$instance = new self($host, $key, $secret);
    }

    /**
     * @return Account
     * @throws \Exception
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            throw new \Exception('the Account is not initialize.');
        }

        return self::$instance;
    }

    /**
     * @param string $host
     * @param string $key
     * @param string $secret
     */
    private function __construct($host, $key, $secret)
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