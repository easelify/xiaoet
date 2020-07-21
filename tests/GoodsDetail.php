<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

require_once __DIR__ . '/../vendor/autoload.php';

use xiaoet\Client;
use xiaoet\request\GoodsDetailGetRequest;

$req = new GoodsDetailGetRequest();
$req->setGoodsId('v_5ecbe0de25d50_mRCw5UTb');
$req->setGoodsType(3);

$config = require(__DIR__ . '/config.php');
$client = new Client($config);

$rs = $client->execute($req);
print_r($rs);
