<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

namespace xiaoet\request;

class BaseRequest
{
    /**
     * @var bool 是否使用POST
     */
    public $useHttpPost = true;

    /**
     * @var bool 是否在请求地址上使用版本号, 目前仅获取 access token 时不需要
     */
    public $useVersionParam = true;

    /**
     * @var string 当前接口的版本, 每个端点的版本可能不一样
     */
    public $version = '1.0.0';

    public function getRequestData() : array
    {
        return [];
    }
}
