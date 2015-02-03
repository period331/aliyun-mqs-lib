<?php

namespace Mqs\Requests;
use LSS\XML2Array;
use Mqs\Mqs;

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
        parent::setUp();
    }

    /**
     * test create queue
     *
     * @group testCreateQueue
     */
    public function testCreateQueue()
    {
        $req = new CreateQueue($this->temp='test-queue');
        $req->setMessageRetentionPeriod(1296000);

        $res = $req->send();
    }

    public function tearDown()
    {
        $req = new DeleteQueue($this->temp);
        $res = $req->send();
    }
}