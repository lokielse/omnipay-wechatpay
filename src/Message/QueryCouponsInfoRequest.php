<?php

namespace Omnipay\WechatPay\Message;

use GuzzleHttp\Client;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\WechatPay\Helper;

/**
 * Class QueryCouponsInfoRequest
 *
 * @package Omnipay\WechatPay\Message
 * @link    https://pay.weixin.qq.com/wiki/doc/api/tools/sp_coupon.php?chapter=12_5&index=6
 * @method  QueryCouponsInfoResponse send()
 */
class QueryCouponsInfoRequest extends BaseAbstractRequest
{
    protected $endpoint = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/querycouponsinfo';


    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('coupon_id', 'openid', 'stock_id', 'app_id', 'mch_id', 'cert_path', 'key_path');

        $data = array(
            'stock_id'  => $this->getStockId(),
            'coupon_id' => $this->getCouponId(),
            'stock_id' => $this->getStockId(),
            'appid'            => $this->getAppId(),
            'openid'           => $this->getOpenId(),
            'mch_id'           => $this->getMchId(),
            'nonce_str'        => md5(uniqid()),
        );
        $data = array_filter($data);

        $data['sign'] = Helper::sign($data, $this->getApiKey());

        return $data;
    }

    /**
     * @return mixed
     */
    public function getCouponId()
    {
        return $this->getParameter('coupon_id');
    }

    /**
     * @param mixed $stockId
     */
    public function setCouponId($couponId)
    {
        $this->setParameter('coupon_id', $couponId);
    }

    /**
     * @return mixed
     */
    public function getStockId()
    {
        return $this->getParameter('stock_id');
    }

    /**
     * @param mixed $stockId
     */
    public function setStockId($stockId)
    {
        $this->setParameter('stock_id', $stockId);
    }

    /**
     * @return mixed
     */
    public function getOpenId()
    {
        return $this->getParameter('openid');
    }

    /**
     * @param mixed $openId
     */
    public function setOpenId($openid)
    {
        $this->setParameter('openid', $openid);
    }

    /**
     * @return mixed
     */
    public function getCertPath()
    {
        return $this->getParameter('cert_path');
    }


    /**
     * @param mixed $certPath
     */
    public function setCertPath($certPath)
    {
        $this->setParameter('cert_path', $certPath);
    }


    /**
     * @return mixed
     */
    public function getKeyPath()
    {
        return $this->getParameter('key_path');
    }


    /**
     * @param mixed $keyPath
     */
    public function setKeyPath($keyPath)
    {
        $this->setParameter('key_path', $keyPath);
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
        $body         = Helper::array2xml($data);
        $client       = new Client();

        $options = [
            'body'    => $body,
            'verify'  => true,
            'cert'    => $this->getCertPath(),
            'ssl_key' => $this->getKeyPath(),
        ];
        $response = $client->request('POST', $this->endpoint, $options)->getBody();
        $responseData = Helper::xml2array($response);

        return $this->response = new CouponTransfersResponse($this, $responseData);
    }
}
