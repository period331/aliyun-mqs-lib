<?php

namespace Mqs\Requests;
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

    /**
     *  setup test
     */
    public function setUp()
    {
        $this->mqs = new Mqs(TEST_MQS_URL, TEST_MQS_ACCESS_KEY, TEST_MQS_ACCESS_SECRET);

        $list = $this->mqs->listQueue('test-queue1')->send();

        if ($list->body->count() > 0) {

        }

        parent::setUp();
    }

    /**
     * test create queue
     */
    public function testCreateQueue()
    {
        $req = $this->mqs->createQueue('test-queue1');
        $req->params([
            'MessageRetentionPeriod' => 1296000
        ]);
        $res = $req->send();
    }

    public function setDown()
    {

    }
}