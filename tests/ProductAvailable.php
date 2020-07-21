<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

require_once __DIR__ . '/../vendor/autoload.php';

use xiaoet\Client;
use xiaoet\request\ProductAvailableRequest;

$req = new ProductAvailableRequest();
$req->setUserId('u_5f12ce75c0261_kt0qceLMJV');
$req->setProductId('p_5ebea6f4c7856_cshEyhuS');
$req->setPaymentType(2);

$config = require(__DIR__ . '/config.php');
$client = new Client($config);

$rs = $client->execute($req);
print_r($rs);
