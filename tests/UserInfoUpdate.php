<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

require_once __DIR__ . '/../vendor/autoload.php';

use xiaoet\Client;
use xiaoet\request\UserInfoUpdateRequest;

$req = new UserInfoUpdateRequest();
$req->setUserId('u_5ec2a39b6857a_vG4siBRLLy');
$req->setUpdateData([
    'birth' => '1988-12-12',
    'job' => '软件开发'
]);

$config = require(__DIR__ . '/config.php');
$client = new Client($config);

$rs = $client->execute($req);
print_r($rs);
