<?php
// baocaixiong 下午3:04

namespace Mqs\Responses;


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
}