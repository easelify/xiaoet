<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.0
 */

namespace xiaoet\request;

use xiaoet\Xiaoet;
use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class PurchaseDeleteRequest extends BaseRequest
{
    public $version = '1.0.0';
    private $_api_name = 'xe.purchase.delete';
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
     * @var int required 付款方式（只支持）：2-单笔（单个商品）3-付费产品包（专栏会员等）15-超级会员
     */
    private $_payment_type;

    public function setPaymentType(int $payment_type)
    {
        $availableTypes = [Xiaoet::PAYMENT_SINGLE, Xiaoet::PAYMENT_PACKAGE, Xiaoet::PAYMENT_SUPER_VIP];
        if (!in_array($payment_type, $availableTypes)) {
            throw new XiaoetInvalidApiParameterException('付款方式错误');
        }
        $this->_payment_type = $payment_type;
    }

    public function getPaymentType() : int
    {
        return $this->_payment_type;
    }

    /**
     * @var int 单笔购买时为必要参数，资源类型：1-图文、2-音频、3-视频、4-直播、23-超级会员
     */
    private $_resource_type;

    public function setResourceType(int $resource_type)
    {
        $availableTypes = [Xiaoet::TYPE_POST, Xiaoet::TYPE_AUDIO, Xiaoet::TYPE_VIDEO, Xiaoet::TYPE_LIVE, Xiaoet::TYPE_SUPER_VIP];
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
     * @var string 单笔购买时为必要参数，资源id
     */
    private $_resource_id;

    public function setResourceId(string $resource_id)
    {
        $this->_resource_id = $resource_id;
    }

    public function getResourceId() : string
    {
        return $this->_resource_id;
    }

    /**
     * @var string 资源ID/商品编码: 购买产品包时和超级会员时为必要参数，产品包id
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
        $data = ['user_id' => $this->_user_id];
        if (!empty($this->_payment_type)) {
            $data['payment_type'] = $this->_payment_type;
        }
        if (!empty($this->_resource_type)) {
            $data['resource_type'] = $this->_resource_type;
        }
        if (!empty($this->_resource_id)) {
            $data['resource_id'] = $this->_resource_id;
        }
        if (!empty($this->_product_id)) {
            $data['product_id'] = $this->_product_id;
        }
        return [
            'user_id' => $this->_user_id,
            'data' => $data
        ];
    }
}
