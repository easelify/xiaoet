小鹅通云服务PHPSDK
================

## 通过Composer安装

```
composer require easelify/xiaoet
```

## 使用范例

```php
use xiaoet\Client;
use xiaoet\request\AccessTokenRequest;
use xiaoet\request\UserInfoGetRequest;

// 创建 Client 对象
$config = [
    'app_id' => 'your app id',
    'client_id' => 'your client id',
    'app_secret' => 'your app secret',
];
$client = new Client($config);

// 获取 access token
$req = new AccessTokenRequest();
$req->setAppId($config['app_id']);
$req->setClientId($config['client_id']);
$req->setSecretKey($config['app_secret']);
$rs = $client->execute($req);

$accessToken = '';
if ($rs['code'] == 0) {
    // 可储存$accessToken到数据库或文件备用
    $accessToken = $rs['data']['access_token'];
} else {
    throw new \Exception('Access Token 获取失败');
}

// 获取用户信息
$req = new UserInfoGetRequest();
$req->setUserId('u_5ec2a39b6857a_vG4siBRLLy');
$rs = $client->execute($req, $accessToken);
print_r($rs);
```

更多范例详见 ./tests 目录

## Licensing 

Licensed under the 3-clause BSD license. See the [LICENSE](LICENSE) file for details.
