<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.0
 */

namespace xiaoet\request;

use xiaoet\Xiaoet;
use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class OrderListGetRequest extends BaseRequest
{
    public $version = '1.0.0';
    private $_api_name = 'xe.order.list.get';
    public function getApiName() : string
    {
        return $this->_api_name;
    }

    /**
     * @var string 排序方式。格式为column:asc/desc，column可选值：created_at
     */
    private $_order_by = 'created_at:desc';

    public function setOrderBy(string $order_by)
    {
        if (!in_array($order_by, ['created_at:asc', 'created_at:desc'])) {
            throw new XiaoetInvalidApiParameterException('传入了不支持的排序方式, 目前只支持: created_at:asc 和 created_at:desc');
        }
        $this->_order_by = $order_by;
    }

    public function getOrderBy() : string
    {
        return $this->_order_by;
    }

    /**
     * @var int 页码, 从0开始, 默认为0
     */
    private $_page_index = 0;

    public function setPageIndex(int $page_index)
    {
        $this->_page_index = $page_index;
    }

    public function getPageIndex() : int
    {
        return $this->_page_index;
    }

    /**
     * @var int 每页请求条数，最大支持50,默认取10条
     */
    private $_page_size = 10;

    public function setPageSize(int $page_size)
    {
        if ($page_size < 1 || $page_size > 50) {
            throw new XiaoetInvalidApiParameterException('page_size错误, 只能在范围1-50内');
        }
        $this->_page_size = $page_size;
    }

    public function getPageSize() : int
    {
        return $this->_page_size;
    }

    /**
     * @var string 用户ID
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
     * @var int 查询起始时间，unix 时间戳，单位为秒。与end_time的差值不能超过86400（24小时），如果为空，则默认取以end_time为准24小时前的时间戳
     */
    private $_begin_time;

    public function setBeginTime(int $begin_time)
    {
        $this->_begin_time = $begin_time;
    }

    public function getBeginTime() : int
    {
        return $this->_begin_time;
    }

    /**
     * @var int 查询结束时间，unix 时间戳，单位为秒。与begin_time的差值不能超过86400（24小时），如果为空，则默认取当前最新时间戳
     */
    private $_end_time;

    public function setEndTime(int $end_time)
    {
        if (!empty($this->_begin_time) && $this->_begin_time - $end_time > 86400) {
            throw new XiaoetInvalidApiParameterException('查询的时间区间不可超过86400秒');
        }
        $this->_end_time = $end_time;
    }

    public function getEndTime() : int
    {
        return $this->_end_time;
    }

    /**
     * @var int 订单状态：0-未支付 1-支付成功 2-支付失败 3-已退款(如拼团未成功等情况) 6-订单超时未支付，自动取消
     */
    private $_order_state;

    public function setOrderState(int $order_state)
    {
        $availableStatus = Xiaoet::getOrderStatus();
        if (!in_array($order_state, $availableStatus)) {
            throw new XiaoetInvalidApiParameterException('订单状态错误');
        }
        $this->_order_state = $order_state;
    }

    public function getOrderState() : int
    {
        return $this->_order_state;
    }
    
    /**
     * @var int 查询单笔资源时(即payment_type=2时)需传入该参数，1-图文 2-音频 3-视频 4-直播 5-活动 7-社群 不填查全部类型
     */
    private $_resource_type;

    public function setResourceType(int $resource_type)
    {
        $availableTypes = Xiaoet::getResourceTypes();
        if (!in_array($resource_type, $availableTypes)) {
            throw new XiaoetInvalidApiParameterException('资源类型错误');
        }
        $this->_resource_type = $resource_type;
    }

    public function getResourceType() : int
    {
        return $this->_resource_type;
    }

    /**
     * @var int 付费类型 2-单笔 3-订阅付费产品包(专栏和会员) 4-购买赠送 5-拼团 默认取出这四种类型的所有订单
     */
    private $_payment_type;

    public function setPaymentType(int $payment_type)
    {
        $availableTypes = [Xiaoet::PAYMENT_SINGLE, Xiaoet::PAYMENT_PACKAGE, Xiaoet::PAYMENT_GIVEAWAY, Xiaoet::PAYMENT_GROUP];
        if (!in_array($payment_type, $availableTypes)) {
            throw new XiaoetInvalidApiParameterException('付费类型错误');
        }
        $this->_payment_type = $payment_type;
    }

    public function getPaymentType() : int
    {
        return $this->_payment_type;
    }

    /**
     * @var int 购买时使用的客户端类型，0-小程序 1-公众号 10-其他，不填查全部类型
     */
    private $_client_type;

    public function setClientType(int $client_type)
    {
        if (!in_array($client_type, [0, 1, 10])) {
            throw new XiaoetInvalidApiParameterException('客户端类型必须是0,1或10');
        }
        $this->_client_type = $client_type;
    }

    public function getClientType() : int
    {
        return $this->_client_type;
    }

    /**
     * @var string 商品编码
     */
    private $_goods_no;

    public function setGoodsNo(string $goods_no)
    {
        $this->_goods_no = $goods_no;
    }

    public function getGoodsNo() : string
    {
        return $this->_goods_no;
    }

    public function getRequestData() : array
    {
        if ($this->_payment_type == 2 && empty($this->_resource_type)) {
            throw new XiaoetInvalidApiParameterException('当前请求必须指定资源类型');
        }
        if (empty($this->_end_time)) {
            $this->_end_time = time();
            $this->_begin_time = $this->_end_time - 86400;
        } elseif (empty($this->_begin_time)) {
            $this->_begin_time = $this->_end_time - 86400;
        }

        $data = [
            'order_by' => $this->_order_by,
            'page_index' => $this->_page_index,
            'page_size' => $this->_page_size,
            'begin_time' => $this->_begin_time,
            'end_time' => $this->_end_time,
        ];
        if (!empty($this->_user_id)) {
            $data['user_id'] = $this->_user_id;
        }
        if (!empty($this->_order_state)) {
            $data['order_state'] = $this->_order_state;
        }
        if (!empty($this->_resource_type)) {
            $data['resource_type'] = $this->_resource_type;
        }
        if (!empty($this->_payment_type)) {
            $data['payment_type'] = $this->_payment_type;
        }
        if (!empty($this->_client_type)) {
            $data['client_type'] = $this->_client_type;
        }
        if (!empty($this->_goods_no)) {
            $data['goods_no'] = $this->_goods_no;
        }
        
        return ['data' => $data];
    }
}
