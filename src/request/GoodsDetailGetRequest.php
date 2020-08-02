<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.0
 */

namespace xiaoet\request;

use xiaoet\Xiaoet;
use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class GoodsDetailGetRequest extends BaseRequest
{
    public $version = '3.0.0';
    private $_api_name = 'xe.goods.detail.get';
    public function getApiName() : string
    {
        return $this->_api_name;
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
     * @var int required 商品类型
     */
    private $_goods_type;

    public function setGoodsType(int $goods_type)
    {
        $availableTypes = Xiaoet::getGoodsTypes();
        if (!in_array($goods_type, $availableTypes)) {
            throw new XiaoetInvalidApiParameterException('商品类型错误');
        }
        $this->_goods_type = $goods_type;
    }

    public function getGoodsType() : int
    {
        return $this->_goods_type;
    }

    public function getRequestData() : array
    {
        $data = [
            'goods_id' => $this->_goods_id,
            'goods_type' => $this->_goods_type
        ];
        return ['data' => $data];
    }
}
