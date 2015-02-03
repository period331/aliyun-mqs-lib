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
     * @var string
     */
    public $errorMessage = '';

    /**
     * @var array|\DOMDocument
     */
    public $arrayBody = [];

    /**
     * @var Response
     */
    public $interRes;

    /**
     * @var BaseRequest
     */
    public $request;

    /**
     * @param Response $res
     */
    public function __construct(Response $res)
    {
        $this->interRes = $res;
        $this->request = $res->request;

        $this->stats = $res->code;
        $this->headers = $res->headers;

        $this->arrayBody = $this->parseResBody();

        if (isset($this->arrayBody['Error'])) {
            $err = $this->arrayBody['Error'];
            $this->errorMessage = sprintf('Code:%s, Message: %s, RequestId: %s, HostId: %s',
                $err['Code'], $err['Message'], $err['RequestId'], $err['HostId']
            );
        }
    }

    /**
     * @return array|\DOMDocument
     * @throws \Exception
     */
    protected function parseResBody()
    {
        return XML2Array::createArray($this->interRes->raw_body);
    }

}