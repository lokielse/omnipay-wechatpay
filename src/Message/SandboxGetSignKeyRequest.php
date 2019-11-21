<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Http\Exception\NetworkException;
use Omnipay\Common\Http\Exception\RequestException;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\WechatPay\Helper;

/**
 * Class GetSignKey
 *
 * @package Omnipay\WechatPay\Message
 * @author  Ionut Cioflan <ionut.cioflan@dcsplus.net>
 */
class SandboxGetSignKeyRequest
    extends BaseAbstractRequest
{
    protected $sandboxEndpoint = 'https://api.mch.weixin.qq.com/sandboxnew/pay/getsignkey';

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'mch_id'
        );

        $data = array(
            'mch_id'           => $this->getMchId(),
            'nonce_str'        => md5(uniqid('', true)),//*
        );

        $data = array_filter($data);

        $data['sign'] = Helper::sign($data, $this->getApiKey());

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send
     *
     * @return ResponseInterface
     * @throws NetworkException
     * @throws RequestException
     */
    public function sendData($data)
    {
        $request      = $this->httpClient->request('POST', $this->sandboxEndpoint, [], Helper::array2xml($data));
        $response     = $request->getBody();
        $responseData = Helper::xml2array($response);

        return $this->response = new SandboxGetSignKeyResponse($this, $responseData);
    }
}