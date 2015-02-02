<?php
// baocaixiong 下午4:32

namespace Mqs\Requests;


class PeekMessage extends BaseRequest
{
    protected $urlParams = [
        'peekonly' => true
    ];

    public function __construct($queueName)
    {
        $this->queueName = $queueName;
        $this->requestResource = '/'.$queueName.'/messages';
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function setPeekonly($bool)
    {
        $this->urlParams['peekonly'] = $bool;

        return $this;
    }
}