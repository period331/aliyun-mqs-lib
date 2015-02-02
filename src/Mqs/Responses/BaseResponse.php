<?php
// baocaixiong 下午3:04

namespace Mqs\Responses;

use Httpful\Response;

class BaseResponse
{
    /**
     * @var int
     */
    public $stats = 200;

    /**
     * @var array
     */
    public $headers = [];

    /**
     * @var string
     */
    public $errorMessage = '';

    /**
     * @var Response
     */
    public $interRes;

    /**
     * @param Response $res
     */
    public function __construct(Response $res)
    {
        $this->interRes = $res;
    }
}