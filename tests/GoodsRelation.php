<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.0
 */

require_once __DIR__ . '/../vendor/autoload.php';

use xiaoet\Client;
use xiaoet\request\GoodsRelationGetRequest;

$req = new GoodsRelationGetRequest();
$req->setGoodsId('p_5ebea6f4c7856_cshEyhuS');
$req->setGoodsType(6);
$req->setResourceType([1, 2, 3]);

$config = require(__DIR__ . '/config.php');
$client = new Client($config);

$rs = $client->execute($req);
print_r($rs);
