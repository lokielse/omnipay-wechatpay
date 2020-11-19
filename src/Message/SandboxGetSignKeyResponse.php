<?php

namespace Omnipay\WechatPay\Message;

/**
 * Class GetSignKeyResponse
 *
 * @package Omnipay\WechatPay\Message
 * @author  Ionut Cioflan <ionut.cioflan@dcsplus.net>
 */
class SandboxGetSignKeyResponse extends BaseAbstractResponse
{
    /**
     * @var SandboxGetSignKeyRequest
     */
    protected $request;

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return isset($this->getData()['return_code']) && $this->getData()['return_code'] === 'SUCCESS';
    }

    public function getSandboxKey()
    {
        return isset($this->getData()['sandbox_signkey']) ? $this->getData()['sandbox_signkey'] : null;
    }

    public function getReturnMessage()
    {
        if (isset($this->getData()['return_msg'])) {
            return $this->getData()['return_msg'];
        }


        if (isset($this->getData()['retmsg'])) {
            return $this->getData()['retmsg'];
        }

        return null;
    }

}