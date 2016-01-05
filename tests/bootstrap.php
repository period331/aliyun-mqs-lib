<?php

$loader = require __DIR__ . "/../vendor/autoload.php";
$loader->addPsr4('Mns\\', __DIR__ . '/Mns');


if (!defined('TEST_MNS_URL')) {
    define('TEST_MNS_URL', '');
}

if (! defined('TEST_MNS_ACCESS_KEY')) {
    define('TEST_MNS_ACCESS_KEY', '');
}

if (! defined('TEST_MNS_ACCESS_SECRET')) {
    define('TEST_MNS_ACCESS_SECRET', '');
}


if (! TEST_MNS_ACCESS_KEY || ! TEST_MNS_ACCESS_SECRET || !TEST_MNS_URL) {
    die('please set aliyun mns key and secret');
}

\Mns\Account::init(TEST_MNS_URL, TEST_MNS_ACCESS_KEY, TEST_MNS_ACCESS_SECRET);

date_default_timezone_set('UTC');
