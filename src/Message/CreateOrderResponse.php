<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\WechatPay\Helper;

/**
 * Class CreateOrderResponse
 * @package Omnipay\WechatPay\Message
 * @link    https://pay.weixin.qq.com/wiki/doc/api/app.php?chapter=9_1
 */
class CreateOrderResponse extends BaseAbstractResponse
{

    /**
     * @var CreateOrderRequest
     */
    protected $request;


    public function getOrderData()
    {
        if ($this->isSuccessful()) {
            $data = array (
                'app_id'    => $this->request->getAppId(),
                'mch_id'    => $this->request->getMchId(),
                'prepay_id' => $this->getPrepayId(),
                'package'   => 'Sign=WXPay',
                'nonce'     => md5(uniqid()),
                'timestamp' => time(),
            );

            $data['sign'] = Helper::sign($data, $this->request->getApiKey());
        } else {
            $data = null;
        }

        return $data;
    }


    public function getCodeUrl()
    {
        if ($this->isSuccessful() && $this->request->getTradeType() == 'NATIVE') {
            return $this->getData()['code_url'];
        } else {
            return null;
        }
    }


    public function getPrepayId()
    {
        if ($this->isSuccessful()) {
            return $this->getData()['prepay_id'];
        } else {
            return null;
        }
    }
}
