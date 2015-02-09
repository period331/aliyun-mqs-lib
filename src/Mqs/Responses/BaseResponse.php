<?php
// baocaixiong 下午3:04

namespace Mqs\Responses;

use Httpful\Response;
use LSS\XML2Array;
use Mqs\Requests\BaseRequest;
use Mqs\Traits\Object;

class BaseResponse
{
    use Object;
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
     * @var bool
     */
    protected $isSuccess = false;

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

        if (in_array($this->stats, $this->request->getExpectedStatus())) {
            $this->isSuccess = true;
        }

        $this->parseResBody();

        $this->setterConstruct($this->arrayBody);
    }

    /**
     * @return array|\DOMDocument
     * @throws \Exception
     */
    protected function parseResBody()
    {
        $array = ['temp' => []];
        if ($this->interRes->body) {
            $array = XML2Array::createArray($this->interRes->body);
        }

        $this->arrayBody = array_values($array)[0];
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->isSuccess;
    }

}