<?php
require_once "vendor/autoload.php";

use PhalApi\Config\FileConfig;
$di         = \PhalApi\DI();
$di->config = new FileConfig('./config');

$config = $di->config->get("app.on_holidays_list");

$tt = new \PhalApi\Weekday\Lite($config);
echo $tt->isWeekday();
echo "\n";
