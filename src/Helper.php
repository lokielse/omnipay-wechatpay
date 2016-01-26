<?php

namespace Omnipay\WechatPay;

use SimpleXMLElement;

class Helper
{

    public static function post($url, $data = array (), $timeout = 3, $options = array ())
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, self::array2xml($data));
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt_array($ch, $options);

        $result = curl_exec($ch);

        $result = self::xml2array($result);

        return $result;
    }


    public static function array2xml($data, $root = 'xml')
    {
        $data = array_filter($data);
        $data = array_flip($data);
        $xml  = new SimpleXMLElement("<{$root}/>");
        array_walk_recursive($data, array ($xml, 'addChild'));

        return $xml->asXML();
    }


    public static function xml2array($xml)
    {
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }


    public static function sign($data, $key)
    {
        unset($data['sign']);

        ksort($data);

        $query = urldecode(http_build_query($data));
        $query .= "&key={$key}";

        return strtoupper(md5($query));
    }
}
