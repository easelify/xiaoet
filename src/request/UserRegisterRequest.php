<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.0
 */

namespace xiaoet\request;

use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class UserRegisterRequest extends BaseRequest
{
    public $version = '1.0.0';
    private $_api_name = 'xe.user.register';
    public function getApiName() : string
    {
        return $this->_api_name;
    }

    /**
     * @var array required 要注册的用户数据
     * @link https://api-doc.xiaoe-tech.com/index.php?s=/2&page_id=4157
     */
    private $_data;

    public function setData(array $data)
    {
        $keys = array_keys($data);
        $diff = array_diff($keys, ['wx_union_id', 'phone', 'avatar', 'nickname', 'country', 'province', 'city', 'gender']);
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
            'data' => $this->_data
        ];
    }
}
