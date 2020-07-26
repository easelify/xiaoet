<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.0
 */

namespace xiaoet\request;

use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class UserInfoUpdateRequest extends BaseRequest
{
    public $version = '1.0.0';
    private $_api_name = 'xe.user.info.update';
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
     * @var array required 要更新的用户数据
     * @link https://api-doc.xiaoe-tech.com/index.php?s=/2&page_id=4161
     */
    private $_update_data;

    public function setUpdateData(array $update_data)
    {
        $keys = array_keys($update_data);
        $diff = array_diff($keys, ['nickname', 'name', 'avatar', 'gender', 'city', 'province', 'country', 'phone', 'birth', 'address', 'company', 'job']);
        if (!empty($diff)) {
            throw new XiaoetInvalidApiParameterException('您提交了不支持的字段: ' . join(', ', $diff));
        }
        $this->_update_data = $update_data;
    }

    public function getUpdateData() : array
    {
        return is_array($this->_update_data) ? $this->_update_data : [];
    }

    public function getRequestData() : array
    {
        if (empty($this->_user_id)) {
            throw new XiaoetInvalidApiParameterException('user_id不能为空');
        }
        if (empty($this->_update_data)) {
            throw new XiaoetInvalidApiParameterException('update_data不能为空');
        }
        return [
            'user_id' => $this->_user_id,
            'data' => ['update_data' => $this->_update_data]
        ];
    }
}
