<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since 1.0.0
 */

namespace xiaoet\request;

use xiaoet\request\BaseRequest;
use xiaoet\XiaoetInvalidApiParameterException;

class UserInfoGetRequest extends BaseRequest
{
    public $version = '1.0.0';
    private $_api_name = 'xe.user.info.get';
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
     * @var string Union ID
     */
    private $_wx_union_id;

    public function setWxUnionId(string $wx_union_id)
    {
        $this->_wx_union_id = $wx_union_id;
    }

    public function getWxUnionId() : string
    {
        return $this->_wx_union_id;
    }

    /**
     * @var string Phone Number
     */
    private $_phone;

    public function setPhone(string $phone)
    {
        $this->_phone = $phone;
    }

    public function getPhone() : string
    {
        return $this->_phone;
    }

    /**
     * @var array required 所要查询的字段集合
     */
    private $_field_list = [
        'wx_union_id', 'wx_open_id', 'wx_app_open_id', 'nickname', 'name', 'avatar', 'gender',
        'city', 'province', 'country', 'phone', 'birth', 'address', 'company', 'job', 'phone_collect'
    ];

    public function setFieldList(array $field_list)
    {
        $diff = array_diff($field_list, [
            'wx_union_id', 'wx_open_id', 'wx_app_open_id', 'nickname', 'name', 'avatar', 'gender',
            'city', 'province', 'country', 'phone', 'birth', 'address', 'company', 'job', 'phone_collect'
        ]);
        if (!empty($diff)) {
            throw new XiaoetInvalidApiParameterException('field_list参数包含不支持的字段: ' . join(', ', $diff));
        }
        $this->_field_list = $field_list;
    }

    public function getFieldList() : array
    {
        return is_array($this->_field_list) ? $this->_field_list : [];
    }

    public function getRequestData() : array
    {
        if (empty($this->_user_id) && empty($this->_wx_union_id) && empty($this->_phone)) {
            throw new XiaoetInvalidApiParameterException('user_id, wx_union_id, phone至少需要传入一项');
        }
        if (empty($this->_field_list)) {
            throw new XiaoetInvalidApiParameterException('field_list不能为空');
        }
        $data = [];
        $data['field_list'] = $this->_field_list;
        if (!empty($this->_user_id)) {
            return [
                'user_id' => $this->_user_id,
                'data' => $data,
            ];
        } elseif (!empty($this->_wx_union_id)) {
            $data['wx_union_id'] = $this->_wx_union_id;
            return ['data' => $data];
        } elseif (!empty($this->_phone)) {
            $data['phone'] = $this->_phone;
            return ['data' => $data];
        }

        return [];
    }
}
