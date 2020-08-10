<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.1
 */

namespace xiaoet\request;

use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class OrderDeliveryRequest extends BaseRequest
{
    public $version = '1.0.0';
    private $_api_name = 'xe.order.delivery';
    public function getApiName() : string
    {
        return $this->_api_name;
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
     * @var array required 要注册的用户数据
     * @link https://api-doc.xiaoe-tech.com/index.php?s=/2&page_id=4175
     */
    private $_data;

    public function setData(array $data)
    {
        $keys = array_keys($data);
        $diff = array_diff($keys, [
            'payment_type', 'resource_type', 'resource_id', 'product_id', 'user_id', 'out_order_id', 'pay_way', 'channel_id',
            'channel_info', 'period', 'period_time', 'agent'
        ]);
        if (!empty($diff)) {
            throw new XiaoetInvalidApiParameterException('您提交了不支持的字段: ' . join(', ', $diff));
        }
        $this->_data = $data;
    }

    public function getData() : array
    {
        return is_array($this->_data) ? $this->_data : [];
    }

    public function getRequestData() : array
    {
        if (empty($this->_data)) {
            throw new XiaoetInvalidApiParameterException('data不能为空');
        }
        return [
            'user_id' => $this->_user_id,
            'data' => $this->_data
        ];
    }

}
