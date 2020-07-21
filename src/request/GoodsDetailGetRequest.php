<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

namespace xiaoet\request;

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
     * @var int required 商品类型: 图文-1，音频-2，视频-3，直播-4，会员-5，专栏-6，大专栏-8，电子书-20
     */
    private $_goods_type;

    public function setGoodsType(int $goods_type)
    {
        if (!in_array($goods_type, [1, 2, 3, 4, 5, 6, 8, 20])) {
            throw new XiaoetInvalidApiParameterException('商品类型必须是1,2,3,4,5,6,8或20');
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
