<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.0
 */

namespace xiaoet\request;

use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class GoodsRelationGetRequest extends BaseRequest
{
    public $version = '3.0.0';
    private $_api_name = 'xe.goods.relation.get';
    public function getApiName() : string
    {
        return $this->_api_name;
    }

    /**
     * @var string required 专栏id
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
     * @var int required 商品类型: 会员-5 / 专栏-6 / 大专栏-8
     */
    private $_goods_type;

    public function setGoodsType(int $goods_type)
    {
        if (!in_array($goods_type, [5, 6, 8])) {
            throw new XiaoetInvalidApiParameterException('商品类型必须是5,6或8');
        }
        $this->_goods_type = $goods_type;
    }

    public function getGoodsType() : int
    {
        return $this->_goods_type;
    }

    /**
     * @var string 上一页数据最后一条数据的resource_id，分页时使用，获取第一页数据时该参数为空
     */
    private $_last_id;

    public function setLastId(string $last_id)
    {
        $this->_last_id = $last_id;
    }

    public function getLastId() : string
    {
        return $this->_last_id;
    }

    /**
     * @var int required 每次获取资源条数
     */
    private $_page_size = 20;

    public function setPageSize(int $page_size)
    {
        $this->_page_size = $page_size;
    }

    public function getPageSize() : int
    {
        return $this->_page_size;
    }

    /**
     * @var array required 资源类型: 图文-1，音频-2，视频-3，直播-4，专栏-6，电子书-20
     */
    private $_resource_type;

    public function setResourceType(array $resource_type)
    {
        if (!empty(array_diff($resource_type, [1, 2, 3, 4, 6, 20]))) {
            throw new XiaoetInvalidApiParameterException('资源类型必须是1,2,3,4,6或20');
        }
        $this->_resource_type = $resource_type;
    }

    public function getResourceType() : array
    {
        return $this->_resource_type;
    }

    public function getRequestData() : array
    {
        $data = [
            'goods_id' => $this->_goods_id,
            'goods_type' => $this->_goods_type,
            'resource_type' => $this->_resource_type,
            'page_size' => $this->_page_size,
            'last_id' => $this->_last_id
        ];
        return ['data' => $data];
    }
}
