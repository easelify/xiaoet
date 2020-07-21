<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

require_once __DIR__ . '/../vendor/autoload.php';

use xiaoet\Client;
use xiaoet\request\OrderListGetRequest;

$req = new OrderListGetRequest();
$req->setEndTime(strtotime('2020-07-19 23:59:59'));

$config = require(__DIR__ . '/config.php');
$client = new Client($config);

$rs = $client->execute($req);
print_r($rs);
