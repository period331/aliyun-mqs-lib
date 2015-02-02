<?php
// baocaixiong 下午4:59

namespace Mqs\Responses;

use Httpful\Request;
use Httpful\Response;

class CreateQueueTest extends \PHPUnit_Framework_TestCase
{
    protected $failedRes;

    protected $successRes;

    /**
     * @param $status
     * @return Response
     */
    protected function interRes($status)
    {
        return $status ? new Response(
            '',
            "HTTP/1.1 200 OK\r\nServer: MOCK-SERVER\r\nContent-Type: text/xml;charset=utf-8\r\nx-mqs-request-id: 0",
            Request::init()
        )
            : new Response(
            '<?xml version="1.0"?>
<Error xmlns="http://mqs.aliyuncs.com/doc/v1">
  <Code>0</Code>
  <Message>这里是错误信息</Message>
  <RequestId>1</RequestId>
  <HostId>test.com</HostId>
</Error>',
            "HTTP/1.1 400 OK\r\nServer: MOCK-SERVER\r\nContent-Type: text/xml;charset=utf-8\r\nx-mqs-request-id: 0",
            Request::init()
        );
    }

    /**
     *  setup test
     */
    public function setUp()
    {
        $this->failedRes = new CreateQueue($this->interRes(false));
        $this->successRes = new CreateQueue($this->interRes(true));

        parent::setUp();
    }

    /**
     * @group testCreateQueueResponseFailed
     */
    public function testCreateQueueResponseFailed()
    {
        var_dump($this->failedRes);
    }
}