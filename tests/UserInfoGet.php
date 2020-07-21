<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

require_once __DIR__ . '/../vendor/autoload.php';

use xiaoet\Client;
use xiaoet\request\UserInfoGetRequest;

$req = new UserInfoGetRequest();
$req->setUserId('u_5ec2a39b6857a_vG4siBRLLy');

$config = require(__DIR__ . '/config.php');
$client = new Client($config);

$rs = $client->execute($req);
print_r($rs);
