<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.0
 */

namespace xiaoet\request;

use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class ProductAvailableRequest extends BaseRequest
{
    public $version = '1.0.0';
    private $_api_name = 'xe.product.available';
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
     * @var string required 产品ID
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
     * @var int required 付费类型
     * - 2-单笔、3-付费产品包、4-团购、5-单笔的购买赠送、6-产品包的购买赠送、7-问答提问、8-问答偷听
     * - 11-付费活动报名、12-打赏类型、13-拼团单个资源、14-拼团产品包、15-超级会员
     */
    private $_payment_type;

    public function setPaymentType(int $payment_type)
    {
        $allowType = [2, 3, 4, 5, 6, 7, 8, 11, 12, 13, 14, 15];
        if (!in_array($payment_type, $allowType)) {
            throw new XiaoetInvalidApiParameterException('付费类型必须是 ' . join(',', $allowType) . ' 其中之一');
        }
        $this->_payment_type = $payment_type;
    }

    public function getPaymentType() : int
    {
        return $this->_payment_type;
    }

    public function getRequestData() : array
    {
        $data = [
            'product_id' => $this->_product_id,
            'payment_type' => $this->_payment_type
        ];
        return [
            'user_id' => $this->_user_id,
            'data' => $data
        ];
    }
}
