<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

require_once __DIR__ . '/../vendor/autoload.php';

use xiaoet\Client;
use xiaoet\request\AccessTokenRequest;

$config = require(__DIR__ . '/config.php');

$req = new AccessTokenRequest();
$req->setAppId($config['app_id']);
$req->setClientId($config['client_id']);
$req->setSecretKey($config['app_secret']);

$client = new Client($config);

$rs = $client->execute($req);
print_r($rs);

if ($rs['code'] == 0) {
    $accessToken = $rs['data']['access_token'];
    file_put_contents('./accesstoken.txt', $accessToken);
}
