<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

namespace xiaoet\request;

use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class UserOrdersGetRequest extends BaseRequest
{
    public $version = '1.0.0';
    private $_api_name = 'xe.get.user.orders';
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
     * @var string 订单ID
     */
    private $_order_id;

    public function setOrderId(string $order_id)
    {
        $this->_order_id = $order_id;
    }

    public function getOrderId() : string
    {
        return $this->_order_id;
    }

    /**
     * @var string 资源ID/商品编码
     */
    private $_product_id;

    public function setProductId(string $product_id)
    {
        $this->_product_id = $product_id;
    }

    public function getProductId() : string
    {
        return $this->_product_id;
    }

    /**
     * @var string 订单创建开始时间，例如：2019-08-01 12:00:00 格式
     */
    private $_begin_time;

    public function setBeginTime(string $begin_time)
    {
        $this->_begin_time = $begin_time;
    }

    public function getBeginTime() : string
    {
        return $this->_begin_time;
    }

    /**
     * @var string 订单创建结束时间，例如：2019-08-01 12:00:00 格式
     */
    private $_end_time;

    public function setEndTime(string $end_time)
    {
        $this->_end_time = $end_time;
    }

    public function getEndTime() : string
    {
        return $this->_end_time;
    }

    /**
     * @var int 订单状态 0-未支付 1-支付成功 2-支付失败 6-订单过期 10-退款成功
     */
    private $_order_state;

    public function setOrderState(int $order_state)
    {
        if (!in_array($order_state, [0, 1, 2, 6, 10])) {
            throw new XiaoetInvalidApiParameterException('订单状态必须是0,1,2,6或10');
        }
        $this->_order_state = $order_state;
    }

    public function getOrderState() : int
    {
        return $this->_order_state;
    }

    /**
     * @var int 付费类型
     * - 2-单笔、3-付费产品包、4-团购、5-单笔的购买赠送、6-产品包的购买赠送、7-问答提问、8-问答偷听
     * - 11-付费活动报名、12-打赏类型、13-拼团单个资源、14-拼团产品包、15-超级会员
     */
    private $_payment_type;

    public function setPaymentType(int $payment_type)
    {
        $allow_values = [2, 3, 4, 5, 6, 7, 8, 11, 12, 13, 14, 15];
        if (!in_array($payment_type, $allow_values)) {
            throw new XiaoetInvalidApiParameterException('付费类型必须是 ' . join(', ', $allow_values) . ' 中的一个');
        }
        $this->_payment_type = $payment_type;
    }

    public function getPaymentType() : int
    {
        return $this->_payment_type;
    }

    /**
     * @var int 资源类型
     * - 0-无（不通过资源的购买入口）1-图文、2-音频、3-视频、4-直播、5-活动报名、6-专栏/会员、7-社群、8-大专栏
     * - 20-电子书、21-实物商品、23-超级会员 25-训练营 29-面授课
     */
    private $_resource_type;

    public function setResourceType(int $resource_type)
    {
        $allow_values = [0, 1, 2, 3, 4, 5, 6, 7, 8, 20, 21, 23, 25, 29];
        if (!in_array($resource_type, $allow_values)) {
            throw new XiaoetInvalidApiParameterException('资源类型必须是 ' . join(', ', $allow_values) . ' 中的一个');
        }
        $this->_resource_type = $resource_type;
    }

    public function getResourceType() : int
    {
        return $this->_resource_type;
    }

    /**
     * @var int 购买时使用的客户端类型，0-小程序 1-公众号 10-开放API，不填查全部类型
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

    public function getRequestData() : array
    {
        if (empty($this->_user_id)) {
            throw new XiaoetInvalidApiParameterException('用户ID不能为空');
        }
        $data = [
            'page_index' => $this->_page_index,
            'page_size' => $this->_page_size,
            'order_by' => $this->_order_by,
        ];
        if (!empty($this->_order_id)) {
            $data['order_id'] = $this->_order_id;
        }
        if (!empty($this->_product_id)) {
            $data['product_id'] = $this->_product_id;
        }
        if (!empty($this->_begin_time)) {
            $data['begin_time'] = $this->_begin_time;
        }
        if (!empty($this->_end_time)) {
            $data['end_time'] = $this->_end_time;
        }
        if (!empty($this->_order_state)) {
            $data['order_state'] = $this->_order_state;
        }
        if (!empty($this->_payment_type)) {
            $data['payment_type'] = $this->_payment_type;
        }
        if (!empty($this->_resource_type)) {
            $data['resource_type'] = $this->_resource_type;
        }
        if (!empty($this->_client_type)) {
            $data['client_type'] = $this->_client_type;
        }

        $final_data = [
            'user_id' => $this->_user_id,
            'data' => $data,
        ];

        return $final_data;
    }
}
