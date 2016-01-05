<?php

namespace Mns\Laravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\QueueManager;
use Illuminate\Config\Repository;
use Mns\Account;


class MnsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('baocaixiong/aliyun-mns-lib');
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

                Account::init($config->get('queue.connections.mns.host'),
                    $config->get('queue.connections.mns.key'),
                    $config->get('queue.connections.mns.secret')
                );

                $queue = $config->get('queue.connections.mns.queue', 'default');
                $keepAlive = $config->get('queue.connections.mns.keepalive', 10);

                return new MnsQueue($queue, $keepAlive);
            });
        });
        
    }
}