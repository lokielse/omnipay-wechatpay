<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\WechatPay\Helper;

/**
 * Class CreateOrderRequest
 * @package Omnipay\WechatPay\Message
 * @link    https://pay.weixin.qq.com/wiki/doc/api/app.php?chapter=9_1
 * @method CreateOrderResponse send()
 */
class CreateOrderRequest extends BaseAbstractRequest
{

    protected $endpoint = 'https://api.mch.weixin.qq.com/pay/unifiedorder';


    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validate(
            'app_id',
            'mch_id',
            'body',
            'out_trade_no',
            'total_fee',
            'notify_url',
            'trade_type',
            'spbill_create_ip'
        );

        $tradeType = strtoupper($this->getTradeType());

        if ($tradeType == 'JSAPI') {
            $this->validate('open_id');
        }

        $data = array (
            'appid'            => $this->getAppId(),//*
            'mch_id'           => $this->getMchId(),
            'device_info'      => $this->getDeviceInfo(),//*
            'body'             => $this->getBody(),//*
            'detail'           => $this->getDetail(),
            'attach'           => $this->getAttach(),
            'out_trade_no'     => $this->getOutTradeNo(),//*
            'fee_type'         => $this->getFeeType(),
            'total_fee'        => $this->getTotalFee(),//*
            'spbill_create_ip' => $this->getSpbillCreateIp(),//*
            'time_start'       => $this->getTimeStart(),//yyyyMMddHHmmss
            'time_expire'      => $this->getTimeExpire(),//yyyyMMddHHmmss
            'goods_tag'        => $this->getGoodsTag(),
            'notify_url'       => $this->getNotifyUrl(), //*
            'trade_type'       => $this->getTradeType(), //*
            'limit_pay'        => $this->getLimitPay(),
            'openid'           => $this->getOpenId(),//*(trade_type=JSAPI)
            'nonce_str'        => md5(uniqid()),//*
        );

        $data = array_filter($data);

        $data['sign'] = Helper::sign($data, $this->getApiKey());

        return $data;
    }


    /**
     * @return mixed
     */
    public function getDeviceInfo()
    {
        return $this->getParameter('device_Info');
    }


    /**
     * @param mixed $deviceInfo
     */
    public function setDeviceInfo($deviceInfo)
    {
        $this->setParameter('device_Info', $deviceInfo);
    }


    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->getParameter('body');
    }


    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->setParameter('body', $body);
    }


    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->getParameter('detail');
    }


    /**
     * @param mixed $detail
     */
    public function setDetail($detail)
    {
        $this->setParameter('detail', $detail);
    }


    /**
     * @return mixed
     */
    public function getAttach()
    {
        return $this->getParameter('attach');
    }


    /**
     * @param mixed $attach
     */
    public function setAttach($attach)
    {
        $this->setParameter('attach', $attach);
    }


    /**
     * @return mixed
     */
    public function getOutTradeNo()
    {
        return $this->getParameter('out_trade_no');
    }


    /**
     * @param mixed $outTradeNo
     */
    public function setOutTradeNo($outTradeNo)
    {
        $this->setParameter('out_trade_no', $outTradeNo);
    }


    /**
     * @return mixed
     */
    public function getFeeType()
    {
        return $this->getParameter('fee_type');
    }


    /**
     * @param mixed $feeType
     */
    public function setFeeType($feeType)
    {
        $this->setParameter('fee_type', $feeType);
    }


    /**
     * @return mixed
     */
    public function getTotalFee()
    {
        return $this->getParameter('total_fee');
    }


    /**
     * @param mixed $totalFee
     */
    public function setTotalFee($totalFee)
    {
        $this->setParameter('total_fee', $totalFee);
    }


    /**
     * @return mixed
     */
    public function getSpbillCreateIp()
    {
        return $this->getParameter('spbill_create_ip');
    }


    /**
     * @param mixed $spbillCreateIp
     */
    public function setSpbillCreateIp($spbillCreateIp)
    {
        $this->setParameter('spbill_create_ip', $spbillCreateIp);
    }


    /**
     * @return mixed
     */
    public function getTimeStart()
    {
        return $this->getParameter('time_start');
    }


    /**
     * @param mixed $timeStart
     */
    public function setTimeStart($timeStart)
    {
        $this->setParameter('time_start', $timeStart);
    }


    /**
     * @return mixed
     */
    public function getTimeExpire()
    {
        return $this->getParameter('time_expire');
    }


    /**
     * @param mixed $timeExpire
     */
    public function setTimeExpire($timeExpire)
    {
        $this->setParameter('time_expire', $timeExpire);
    }


    /**
     * @return mixed
     */
    public function getGoodsTag()
    {
        return $this->getParameter('goods_tag');
    }


    /**
     * @param mixed $goodsTag
     */
    public function setGoodsTag($goodsTag)
    {
        $this->setParameter('goods_tag', $goodsTag);
    }


    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }


    public function setNotifyUrl($notifyUrl)
    {
        $this->setParameter('notify_url', $notifyUrl);
    }


    /**
     * @return mixed
     */
    public function getTradeType()
    {
        return $this->getParameter('trade_type');
    }


    /**
     * @param mixed $tradeType
     */
    public function setTradeType($tradeType)
    {
        $this->setParameter('trade_type', $tradeType);
    }


    /**
     * @return mixed
     */
    public function getLimitPay()
    {
        return $this->getParameter('limit_pay');
    }


    /**
     * @param mixed $limitPay
     */
    public function setLimitPay($limitPay)
    {
        $this->setParameter('limit_pay', $limitPay);
    }


    /**
     * @return mixed
     */
    public function getOpenId()
    {
        return $this->getParameter('open_id');
    }


    /**
     * @param mixed $openId
     */
    public function setOpenId($openId)
    {
        $this->setParameter('open_id', $openId);
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $response = $this->httpClient->post($this->endpoint,null, $data);

        return $this->response = new CreateOrderResponse($this, $response->getBody());
    }
}
