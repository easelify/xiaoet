<?php
/**
 * @author Jun <easelify@gmail.com>
 * @since  1.0.1
 */

namespace xiaoet;

class Xiaoet
{
    /**
     * @var 商品/资源类型
     */
    const TYPE_POST = 1;                    // 文章
    const TYPE_AUDIO = 2;                   // 音频
    const TYPE_VIDEO = 3;                   // 视频
    const TYPE_LIVE = 4;                    // 直播
    const TYPE_MEMBER = 5;                  // 会员
    const TYPE_COLUMN = 6;                  // 专栏
    const TYPE_COMMUNITY = 7;               // 社群
    const TYPE_BIG_COLUMN = 8;              // 大专栏
    const TYPE_EBOOK = 20;                  // 电子书
    const TYPE_PHYSICAL_GOODS = 21;         // 实物商品
    const TYPE_SUPER_VIP = 23;              // 超级会员
    const TYPE_CAMP = 25;                   // 训练营
    const TYPE_FACE_EDU = 29;               // 面授课

    public static function getGoodsTypes() : array
    {
        return [
            self::TYPE_POST,
            self::TYPE_AUDIO,
            self::TYPE_VIDEO,
            self::TYPE_LIVE,
            self::TYPE_MEMBER,
            self::TYPE_COLUMN,
            self::TYPE_COMMUNITY,
            self::TYPE_BIG_COLUMN,
            self::TYPE_EBOOK,
            self::TYPE_PHYSICAL_GOODS,
            self::TYPE_SUPER_VIP,
            self::TYPE_CAMP,
            self::TYPE_FACE_EDU
        ];
    }

    public static function getResourceTypes() : array
    {
        return self::getGoodsTypes();
    }

    /**
     * @var 付款类型
     */
    const PAYMENT_SINGLE = 2;               // 单笔交易
    const PAYMENT_PACKAGE = 3;              // 付费产品包
    const PAYMENT_GROUPBUY = 4;             // 团购
    const PAYMENT_GIVEAWAY_SINGLE = 5;      // 单笔的购买赠送
    const PAYMENT_GIVEAWAY_PACKAGE = 6;     // 产品包的购买赠送
    const PAYMENT_QA = 7;                   // 问答提问
    const PAYMENT_QA_TAP = 8;               // 问答偷听
    const PAYMENT_SIGNUP = 11;              // 付费活动报名
    const PAYMENT_REWARD = 12;              // 打赏
    const PAYMENT_GROUP_SINGLE = 13;        // 拼团单个资源
    const PAYMENT_GROUP_PACKAGE = 14;       // 拼团产品包
    const PAYMENT_SUPER_VIP = 15;           // 超级会员
    const PAYMENT_GIVEAWAY = 4;             // 聚合类型:赠送
    const PAYMENT_GROUP = 5;                // 聚合类型:拼团

    public static function getPaymentTypes() : array
    {
        return [
            self::PAYMENT_SINGLE,
            self::PAYMENT_PACKAGE,
            self::PAYMENT_GROUPBUY,
            self::PAYMENT_GIVEAWAY_SINGLE,
            self::PAYMENT_GIVEAWAY_PACKAGE,
            self::PAYMENT_QA,
            self::PAYMENT_QA_TAP,
            self::PAYMENT_SIGNUP,
            self::PAYMENT_REWARD,
            self::PAYMENT_GROUP_SINGLE,
            self::PAYMENT_GROUP_PACKAGE,
            self::PAYMENT_SUPER_VIP
        ];
    }

    /**
     * @var 订单状态
     */
    const ORDER_STATUS_NOTPAY = 0;          // 未支付
    const ORDER_STATUS_PAID = 1;            // 支付成功
    const ORDER_STATU_PAYMENT_FAILED = 2;   // 支付失败
    const ORDER_STATUS_EXPIRED = 6;         // 订单过期
    const ORDER_STATUS_REFUNDED = 10;       // 退款成功

    public static function getOrderStatus() : array
    {
        return [
            self::ORDER_STATUS_NOTPAY,
            self::ORDER_STATUS_PAID,
            self::ORDER_STATU_PAYMENT_FAILED,
            self::ORDER_STATUS_EXPIRED,
            self::ORDER_STATUS_REFUNDED
        ];
    }
}
