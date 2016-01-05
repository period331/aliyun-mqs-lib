<?php

namespace Mns\Requests;
use Mns\Responses\SendMessage as SendMessageRes;
use Mns\Responses\ReceiveMessage as ReceiveMessageRes;
use Mns\Responses\DeleteMessage as DeleteMessageRes;
use Mns\Responses\PeekMessage as PeekMessageRes;
use Mns\Responses\ChangeMessageVisibility as ChangeMessageVisibilityRes;


class SendMessageTest extends \PHPUnit_Framework_TestCase
{
    protected $queue = 'test-queue';

    protected $message = ['nihao' => 'nihao'];

    public function setUp()
    {
        $req = new CreateQueue($this->queue);
        $req->setVisibilityTimeout(5);
        $req->send();

        parent::setUp();
    }

    /**
     * @group testMessage
     */
    public function testMessage()
    {
        $req = new SendMessage($this->queue);

        $req->setMessageBody($this->message);

        /**
         * @var $res SendMessageRes
         */
        $res = $req->send();

        $this->assertEquals(strtoupper(md5('{"nihao":"nihao"}')), $res->getMessageBodyMD5());

        $req = new ReceiveMessage($this->queue);
        /**
         * @var $res ReceiveMessageRes
         */
        $res = $req->send();

        $req = new DeleteMessage($this->queue);

        /**
         * @var $delRes DeleteMessageRes
         */
        $delRes = $req->setReceiptHandle($res->getReceiptHandle())->send();
        $this->assertTrue($delRes->isSuccess());

        $req = new SendMessage($this->queue);

        $req->setMessageBody($this->message);
        /**
         * @var $res SendMessageRes
         */
        $res = $req->send();
        $this->assertTrue($res->isSuccess());

        $peekReq = new PeekMessage($this->queue);
        /**
         * @var $peekRes PeekMessageRes
         */
        $peekRes = $peekReq->send();
        $this->assertTrue($peekRes->isSuccess());
        $this->assertNotEmpty($peekRes->getMessageId());
        $this->assertEquals(strtoupper(md5('{"nihao":"nihao"}')), $peekRes->getMessageBodyMD5());


        $req = new ReceiveMessage($this->queue);
        /**
         * @var $res ReceiveMessageRes
         */
        $res = $req->send();

        $cmvReq = new ChangeMessageVisibility($this->queue);
        $cmvReq->setReceiptHandle($res->getReceiptHandle());

        $cmvReq->setVisibilityTimeout(10);

        /**
         * @var $cmvRes ChangeMessageVisibilityRes
         */
        $cmvRes = $cmvReq->send();

        $this->assertTrue($cmvRes->isSuccess());
    }

    public function tearDown()
    {
        $req = new DeleteQueue($this->queue);
        $req->send();
    }
}