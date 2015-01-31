<?php

$loader = require __DIR__ . "/../vendor/autoload.php";
$loader->addPsr4('Mqs\\', __DIR__.'/Mqs');



define('TEST_MQS_URL', 'iftbe2qyyp.mqs-cn-beijing.aliyuncs.com');
define('TEST_MQS_ACCESS_KEY', 'LiUoB1wjqin5zf5t');
define('TEST_MQS_ACCESS_SECRET', 'G0awx4iXrfPD4QeN7VOoM93JDbs17C');

date_default_timezone_set('UTC');
