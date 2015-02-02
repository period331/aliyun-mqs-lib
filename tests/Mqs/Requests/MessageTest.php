<?php

namespace Mqs\Requests;
use Mqs\Mqs;


class SendMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Mqs
     */
    protected $mqs;

    public function setUp()
    {
        $this->mqs = new Mqs(TEST_MQS_URL, TEST_MQS_ACCESS_KEY, TEST_MQS_ACCESS_SECRET);
        parent::setUp();
    }

    /**
     * @group testSendMessage
     */
    public function testSendMessage()
    {
        $req = $this->mqs->sendMessage('mqs-lib-test');
        $req->params([
            'MessageBody' => 'nihao'
        ]);

        $req->send();
    }

    /**
     * @group testReceiveMessage
     */
    public function testReceiveMessage()
    {
        $req = $this->mqs->receiveMessage('mqs-lib-test')->send();
        var_dump($req);
    }
}