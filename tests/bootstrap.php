<?php

$loader = require __DIR__ . "/../vendor/autoload.php";
$loader->addPsr4('Mns\\', __DIR__ . '/Mns');



define('TEST_MQS_URL', '');
define('TEST_MQS_ACCESS_KEY', '');
define('TEST_MQS_ACCESS_SECRET', '');

if (! TEST_MQS_ACCESS_KEY || ! TEST_MQS_ACCESS_SECRET || !TEST_MQS_URL) {
    die('please set aliyun mqs key.');
}

\Mns\Account::init(TEST_MQS_URL, TEST_MQS_ACCESS_KEY, TEST_MQS_ACCESS_SECRET);

date_default_timezone_set('UTC');
