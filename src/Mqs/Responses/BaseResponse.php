<?php
// baocaixiong 下午3:04

namespace Mqs\Responses;

use Httpful\Response;
use LSS\XML2Array;
use Mqs\Requests\BaseRequest;

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
     * @var array|\DOMDocument
     */
    public $arrayBody = [];

    /**
     * @var \Httpful\Response
     */
    public $interRes;

    /**
     * @var \Httpful\Request
     */
    public $interReq;

    /**
     * @var BaseRequest
     */
    public $request;

    /**
     * @param Response $res
     * @param BaseRequest $request
     */
    public function __construct(Response $res, BaseRequest $request)
    {
        $this->interRes = $res;
        $this->interReq = $res->request;
        $this->request = $request;

        $this->stats = $res->code;
        $this->headers = $res->headers;

        $this->arrayBody = $this->parseResBody();

        foreach (array_values($this->arrayBody)[0] as $key => $value) {
            if (property_exists($this, $pro = camel_case($key))) {
                $this->$pro = $value;
            }
        }
    }

    /**
     * @return array|\DOMDocument
     * @throws \Exception
     */
    protected function parseResBody()
    {
        return XML2Array::createArray($this->interRes->body);
    }

}