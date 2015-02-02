<?php

namespace Mqs\Requests;
use Mqs\Account;

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
     * @param \Mqs\Account $account
     * @param string $prefix
     */
    public function __construct(Account $account, $prefix = '')
    {
        parent::__construct($account);

        $this->prefix = $prefix;
    }

    /**
     * 添加特有的 request headers
     */
    protected function makeSpecificHeaders()
    {
        parent::makeSpecificHeaders();

        $this->prefix and $this->httpful->addHeader('x-mqs-prefix', $this->prefix);
    }

}