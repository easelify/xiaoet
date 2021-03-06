小鹅通云服务PHPSDK
================

官方文档 <https://api-doc.xiaoe-tech.com/index.php?s=/2&page_id=420>

## 通过Composer安装

```
composer require easelify/xiaoet
```

国内用户建议使用[阿里云的Composer镜像](https://developer.aliyun.com/composer)下载速度快，本项目默认也是使用该镜像！

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
    // 根据 expires_in 字段做统一获取
    $accessToken = $rs['data']['access_token'];
} else {
    throw new \Exception('Access Token 获取失败: ' . $rs['msg']);
}

// 获取用户信息
$req = new UserInfoGetRequest();
$req->setUserId('u_5ec2a39b6857a_vG4siBRLLy');
$rs = $client->execute($req, $accessToken);
print_r($rs);
```

更多范例详见 ./tests 目录

## 交流

欢迎关注公众号：不用上班的程序员

![qrcode](docs/mp_qrcode.jpg)

## Licensing 

Licensed under the 3-clause BSD license. See the [LICENSE](LICENSE) file for details.
