<?php
// baocaixiong 下午3:10

namespace Mqs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\QueueManager;
use Illuminate\Config\Repository;
use Mqs\Laravel\MqsQueue;


class MqsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /**
         * @var $queueManager QueueManager
         */
        $queueManager = $this->app['queue'];

        $queueManager->extend('mqs', function () {

            /**
             * @var $config Repository
             */
            $config = $this->app['config'];

            Account::init($config->get('queue.connections.mqs.host'),
                $config->get('queue.connections.mqs.key'),
                $config->get('queue.connections.mqs.secret')
            );

            $queue = $config->get('queue.connections.mqs.name', 'default');
            $keepAlive = $config->get('queue.connections.mqs.keepalive', 10);

            return new MqsQueue($queue, $keepAlive);
        });
    }
}