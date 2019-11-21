<?php

namespace Omnipay\WechatPay\Message;

/**
 * Class GetSignKeyResponse
 *
 * @package Omnipay\WechatPay\Message
 * @author  Ionut Cioflan <ionut.cioflan@dcsplus.net>
 */
class SandboxGetSignKeyResponse
    extends BaseAbstractResponse
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
        return ($this->getData()['return_code'] ?? null) === 'SUCCESS';
    }

    public function getSandboxKey()
    {
        return $this->getData()['sandbox_signkey'] ?? null;
    }
}