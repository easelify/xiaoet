<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.0
 */

require_once __DIR__ . '/../vendor/autoload.php';

use xiaoet\Client;
use xiaoet\request\UserOrdersGetRequest;

$req = new UserOrdersGetRequest();
$req->setUserId('u_5f12ce75c0261_kt0qceLMJV');

$config = require(__DIR__ . '/config.php');
$client = new Client($config);

$rs = $client->execute($req);
print_r($rs);
