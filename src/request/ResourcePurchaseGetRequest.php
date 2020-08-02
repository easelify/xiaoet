<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.0
 */

namespace xiaoet\request;

use xiaoet\Xiaoet;
use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class ResourcePurchaseGetRequest extends BaseRequest
{
    public $version = '1.0.0';
    private $_api_name = 'xe.resource.purchase.get';
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
     * @var int 页码, 从1开始, 默认为1
     */
    private $_page_index = 1;

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
     * @var string 查询起始时间，订购创建的开始时间，例如：2019-08-01 12:00:00 格式
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
     * @var string 订购创建的结束时间，例如：2019-08-01 12:00:00 格式
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
     * @var int 资源类型
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
     * @var int 付费类型: 购买类型：2-单品，3-产品包（专栏，大专栏，会员），15-超级会员
     */
    private $_payment_type;

    public function setPaymentType(int $payment_type)
    {
        $availableTypes = [Xiaoet::PAYMENT_SINGLE, Xiaoet::PAYMENT_PACKAGE, Xiaoet::PAYMENT_SUPER_VIP];
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
     * @var string 产品ID
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

    public function getRequestData() : array
    {
        $data = [
            'user_id' => $this->_user_id,
            'order_by' => $this->_order_by,
            'page_index' => $this->_page_index,
            'page_size' => $this->_page_size,
        ];
        if (!empty($this->_resource_type)) {
            $data['resource_type'] = $this->_resource_type;
        }
        if (!empty($this->_payment_type)) {
            $data['payment_type'] = $this->_payment_type;
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
        return ['data' => $data];
    }
}
