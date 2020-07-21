<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

namespace xiaoet;

class Client
{
    public $gateway = 'https://api.xiaoe-tech.com';
    
    /**
     * @var string 授权店铺ID, 注意不是应用的 client_id
     */
    public $app_id;

    /**
     * @var string 应用密钥, 即应用的 client_sercet
     */
    public $app_secret;

    /**
     * @var string Access Token, 详见 AccessTokenRequest
     */
    public $access_token;

    /**
     * @var int 使用途径
     * - 0-服务端自用，1-iOS，2-android，3-pc浏览器，4-手机浏览器,100-超级权限
     * - 超级权限：在获取资源的时候，资源购买关系永远为真，资源链接会返回
     */
    public $use_type = 1;

    /**
     * @var int 超时时间 (秒)
     */
    public $timeout = 30;

    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * 执行API请求
     * 
     * @param mixed $req BaseRequest
     * @param string $access_token
     *
     * @return mixed
     */
    public function execute($req, $access_token = '')
    {
        $apiName = $req->getApiName();
        $data = $req->getRequestData();

        $url = $this->gateway . '/' . $apiName;
        if ($req->useVersionParam) {
            $url .= '/' . $req->version;
        }

        if ($req->useHttpPost) {
            $publicData = [
                'timestamp' => time(),
                'app_id' => $this->app_id,
                'access_token' => $access_token ?: $this->access_token,
                'use_type' => $this->use_type,
                'sign' => $this->sign($data),
            ];
            $finalData = $publicData + $data;
            $client = new \GuzzleHttp\Client();
            $rs = $client->request('POST', $url, ['json' => $finalData, 'timeout' => $this->timeout]);
        } else {
            // GET方式调用的API接口无需签名
            $url .= '?' . http_build_query($data);
            $client = new \GuzzleHttp\Client();
            $rs = $client->request('GET', $url, ['timeout' => $this->timeout]);
        }

        return json_decode($rs->getBody(), true);
    }

    public function sign(array $params) : string
    {
        ksort($params);
        $rawString = '';
        $rawData = [];

        foreach ($params as $key => $value) {
            if ($key == 'sign') {
                continue;
            }
            if (is_array($value) || is_object($value)) {
                $fixedValue = json_encode($value, JSON_NUMERIC_CHECK);
            } else {
                $fixedValue = (string) $value;
            }
            $rawData[] = $key . '=' . $fixedValue;
        }

        $rawString = join('&', $rawData);
        $rawString .= '&app_secret=' . $this->app_secret;
        
        return strtolower(md5($rawString));
    }

    public function checkSign(array $params, string $sign = '') : bool
    {
        if (empty($sign)) {
            $sign = array_key_exists('sign', $params) ? $params['sign'] : '';
            if (empty($sign)) {
                throw new \Exception('缺少参数 sign');
            }
        }
        
        return $this->sign($params) == $sign;
    }
}
