<?php
require_once __DIR__ . '/vendor/autoload.php';
ini_set('display_errors', 'On');
go(function () {
    \Swango\Aliyun\Slb\Scene\FindServerByServerName::find('wmp');
});