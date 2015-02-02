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
    /**
     * @var Mqs
     */
    protected $mqs;

    protected $temp;

    /**
     *  setup test
     */
    public function setUp()
    {
        $this->mqs = new Mqs(TEST_MQS_URL, TEST_MQS_ACCESS_KEY, TEST_MQS_ACCESS_SECRET);
        parent::setUp();
    }

    /**
     * test create queue
     *
     * @group testCreateQueue
     */
    public function testCreateQueue()
    {
        $req = $this->mqs->createQueue($this->temp = 'test-queue');
        $req->initAccount($this->mqs->account);

        $req->params([
            'MessageRetentionPeriod' => 1296000
        ]);

        $res = $req->send();
    }

    public function tearDown()
    {
        $list = $this->mqs->listQueue($this->temp)->initAccount($this->mqs->account)->send();
    }
}