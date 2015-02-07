<?php

namespace Mqs\Requests;

use Mqs\Responses\GetQueueAttributes as GetQueueAttributesRes;
use Mqs\Responses\ListQueue as ListQueueRes;

/**
 * Class CreateQueueTest
 * @package Mqs\Requests
 */
class CreateQueueTest extends \PHPUnit_Framework_TestCase
{
    protected $temp;

    /**
     *  setup test
     */
    public function setUp()
    {
        $this->temp = 'test-queue';
        parent::setUp();
    }

    /**
     * test create queue
     *
     * @group testQueue
     */
    public function testQueue()
    {
        $req = new CreateQueue($this->temp='test-queue');

        $res = $req->send();
        $this->assertTrue($res->isSuccess());

        $req = new SetQueueAttributes($this->temp);
        $req->setMaximumMessageSize(1990);
        $res = $req->send();
        $this->assertTrue($res->isSuccess());

        $req = new GetQueueAttributes($this->temp);

        /**
         * @var $res GetQueueAttributesRes
         */
        $res = $req->send();
        $this->assertEquals(1990, $res->getMaximumMessageSize());

        $req = new ListQueue();
        $req->setPrefix($this->temp);
        $req->setWithMeta(true);
        /**
         * @var $res ListQueueRes
         */
        $res = $req->send();

        $this->assertTrue($res->hasQueue($this->temp));
    }

    public function tearDown()
    {
        $req = new DeleteQueue($this->temp);
        $req->send();
    }
}