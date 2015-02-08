<?php
// baocaixiong 下午3:10

namespace Mqs\Laravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\QueueManager;
use Illuminate\Config\Repository;
use Mqs\Account;


class MqsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('baocaixiong/aliyun-mqs-lib');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booted(function() {
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

                $queue = $config->get('queue.connections.mqs.queue', 'default');
                $keepAlive = $config->get('queue.connections.mqs.keepalive', 10);

                return new MqsQueue($queue, $keepAlive);
            });
        });
        
    }
}