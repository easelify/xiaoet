<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.1
 */

require_once __DIR__ . '/../vendor/autoload.php';

use xiaoet\Xiaoet;
use xiaoet\Client;
use xiaoet\request\OrderDeliveryRequest;

$req = new OrderDeliveryRequest();
$req->setUserId('u_5ec2a39b6857a_vG4siBRLLy');
$req->setData([
    'user_id' => 'u_5ec2a39b6857a_vG4siBRLLy',
    'resource_type' => Xiaoet::TYPE_MEMBER,
    'payment_type' => Xiaoet::PAYMENT_PACKAGE,
    'product_id' => 'p_5f1eea16e4b0df48afbe2c13'
]);

$config = require(__DIR__ . '/config.php');
$client = new Client($config);

$rs = $client->execute($req);
print_r($rs);
