<?php

namespace Omnipay\WechatPay\Message;

/**
 * Class QueryOrderResponse
 *
 * @package Omnipay\WechatPay\Message
 * @link    https://pay.weixin.qq.com/wiki/doc/api/app/app.php?chapter=9_2&index=4
 */
class QueryOrderResponse extends BaseAbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->isPaid();
    }

    public function isPaid()
    {
        $data = $this->getData();

        return isset($data['result_code']) && $data['result_code'] == 'SUCCESS'
            && isset($data['result_code']) && $data['result_code'] == "SUCCESS"
            && isset($data['trade_state']) && $data['trade_state'] == "SUCCESS";
    }
}
