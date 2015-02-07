<?php
// baocaixiong 下午3:55

namespace Mqs\Responses;
use Mqs\Traits\Message;


class PeekMessage extends BaseResponse
{
    use Message;

    /**
     * 是否未找到job
     *
     * @return bool
     */
    public function isNotFound()
    {
        return $this->stats == 404;
    }
}