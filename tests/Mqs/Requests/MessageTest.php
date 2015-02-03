<?php

namespace Mqs\Requests;


class SendMessageTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @group testSendMessage
     */
    public function testSendMessage()
    {
        $req = new SendMessage('mqs-lib-test');

        $req->setMessageBody(['nihao' => 'nihao']);

        var_dump($req->send());
    }

    /**
     * @group testReceiveMessage
     */
    public function testReceiveMessage()
    {
        $req = new ReceiveMessage('mqs-lib-test');
        $req->setWaitseconds(10);
        $res = $req->send();
        var_dump($res);
    }
}