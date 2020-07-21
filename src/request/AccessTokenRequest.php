<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

namespace xiaoet\request;

use xiaoet\request\BaseRequest;

class AccessTokenRequest extends BaseRequest
{
    private $_api_name = 'token';

    public function getApiName() : string
    {
        return $this->_api_name;
    }

    public $useHttpPost = false;
    public $useVersionParam = false;

    /**
     * @var string 店铺的业务id
     */
    private $_app_id;

    public function setAppId(string $app_id)
    {
        $this->_app_id = $app_id;
    }

    public function getAppId() : string
    {
        return $this->_app_id;
    }

    /**
     * @var string 应用的唯一标识，通过 client_id 来鉴别应用的身份
     */
    private $_client_id;

    public function setClientId(string $client_id)
    {
        $this->_client_id = $client_id;
    }

    public function getClientId() : string
    {
        return $this->_client_id;
    }

    /**
     * @var string 应用的凭证秘钥，即client_secret，用来保证应用来源的可靠性，防止被伪造
     */
    private $_secret_key;

    public function setSecretKey(string $secret_key)
    {
        $this->_secret_key = $secret_key;
    }

    public function getSecretKey() : string
    {
        return $this->_secret_key;
    }

    /**
     * @var string 固定值 client_credential
     */
    private $_grant_type = 'client_credential';

    public function getRequestData() : array
    {
        return [
            'app_id' => $this->_app_id,
            'client_id' => $this->_client_id,
            'secret_key' => $this->_secret_key,
            'grant_type' => $this->_grant_type,
        ];
    }
}
