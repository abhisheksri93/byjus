<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('randomDigit')) {
    function randomDigit($length)
    {
        // $CI =& get_instance();
        $numbers = range(1, 9);
        shuffle($numbers);
        $digits = '';

        for ($i = 0; $i < $length; $i++)
            $digits .= $numbers[$i];
        return $digits;
    }
}

if (!function_exists('randomName')) {
    function randomName($length)
    {
        // $CI =& get_instance();
        $numbers = range(1, 9);
        shuffle($numbers);

        $digits = '';
        for ($i = 0; $i < $length; $i++)
            $digits .= $numbers[$i];

        $alpha = range('a', 'z');
        shuffle($alpha);

        $alphaN = '';
        for ($i = 0; $i < $length; $i++)
            $alphaN .= $alpha[$i];

        $name = $digits . $alphaN;
        $name = str_split($name, 1);
        shuffle($name);
        $str = '';

        for ($i = 0; $i < sizeof($name); $i++)
            $str .= $name[$i];
        return $str;
    }
}

if (!function_exists('encrypt')) {
    function encrypt($sData, $secretKey = "mailer@byjustest.com*~12345")
    {
        $sResult = '';

        for ($i = 0; $i < strlen($sData); $i++) {
            $sChar = substr($sData, $i, 1);
            $sKeyChar = substr($secretKey, ($i % strlen($secretKey)) - 1, 1);
            $sChar = chr(ord($sChar) + ord($sKeyChar));
            $sResult .= $sChar;
        }

        return encode_base64($sResult);
    }
}

if (!function_exists('decrypt')) {
    function decrypt($sData, $secretKey = "mailer@byjustest.com*~12345")
    {
        if (is_numeric($sData))
            return $sData;

        $sResult = '';
        $sData = decode_base64($sData);

        for ($i = 0; $i < strlen($sData); $i++) {
            $sChar = substr($sData, $i, 1);
            $sKeyChar = substr($secretKey, ($i % strlen($secretKey)) - 1, 1);
            $sChar = chr(ord($sChar) - ord($sKeyChar));
            $sResult .= $sChar;
        }

        return $sResult;
    }
}

if (!function_exists('encode_base64')) {
    function encode_base64($sData)
    {
        $sBase64 = base64_encode($sData);
        return str_replace('=', '', strtr($sBase64, '+/', '-_'));
    }
}

if (!function_exists('decode_base64')) {
    function decode_base64($sData)
    {
        $sBase64 = strtr($sData, '-_', '+/');
        return base64_decode($sBase64 . '==');
    }
}

if (!function_exists('ckc_debug_array')) {
    function ckc_debug_array($value)
    {
        echo "<pre>";
        print_r($value);
        die();
    }
}

if (!function_exists('check_url')) {
    function check_url($url) {
        $headers = @get_headers( $url);
        $headers = (is_array($headers)) ? implode( "\n ", $headers) : $headers;

        return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
    }
}

if (!function_exists('get_domain')) {
    function get_domain($url)
    {
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return false;
    }
}

?>