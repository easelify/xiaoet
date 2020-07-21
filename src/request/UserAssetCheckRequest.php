<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

namespace xiaoet\request;

use xiaoet\request\BaseRequest;

class UserAssetCheckRequest extends BaseRequest
{
    public $version = '1.0.0';
    private $_api_name = 'xe.user.asset.check';
    public function getApiName() : string
    {
        return $this->_api_name;
    }

    /**
     * @var string required 用户ID
     */
    private $_user_id;

    public function setUserId(string $user_id)
    {
        $this->_user_id = $user_id;
    }

    public function getUserId() : string
    {
        return $this->_user_id;
    }

    /**
     * @var string required 资源id
     */
    private $_goods_id;

    public function setGoodsId(string $goods_id)
    {
        $this->_goods_id = $goods_id;
    }

    public function getGoodsId() : string
    {
        return $this->_goods_id;
    }

    /**
     * @var string required 资产类型：goods：产品包商品
     */
    private $_asset_type = 'goods';

    public function setAssetType(string $asset_type)
    {
        $this->_asset_type = $asset_type;
    }

    public function getAssetType() : string
    {
        return $this->_asset_type;
    }

    public function getRequestData() : array
    {
        return [
            'user_id' => $this->_user_id,
            'goods_id' => $this->_goods_id,
            'asset_type' => $this->_asset_type
        ];
    }
}
