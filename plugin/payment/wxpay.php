<?php

/**
 * WxPay Payment
 *
 * @author Cigery
 * Unfinished
 */
class wxpay extends abstract_payment {
    public function create_pay_url($args) {
        $params = array
        (
            'appid'        => $this->config['appid'],
            'mch_id'       => $this->config['mch_id'],
            'nonce_str'    => self::getNonceStr(),
            'body'         => $args['goods_name'],
            'out_trade_no' => $args['order_id'],
            'total_fee'    => $args['order_amount'] * 100,
            'openid'      => $args['open_id'],
            'attach'       => serialize("{$GLOBALS['cfg']['site_name']}订单-{$args['order_id']}"),
        );

        return $this->_get_prepayid($params);
    }

    public static function getNonceStr($length = 32) {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str   = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    public function set_js_params($args) {
        $params = array
        (
            'appId'     => $this->config['appid'],
            'timeStamp' => (string)$_SERVER['REQUEST_TIME'],
            'nonceStr'  => random_chars(32),
            'package'   => "prepay_id={$args['prepay_id']}",
            'signType'  => 'MD5',
        );
        return $params;
    }

    private function _get_openid() {
        if (!isset($_GET['code'])) {
            $params = array
            (
                'appid'         => $this->config['appid'],
                'redirect_uri'  => urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']),
                'response_type' => 'code',
                'scope'         => 'snsapi_base',
                'state'         => 'STATE#wechat_redirect',
            );
            $url    = 'https://open.weixin.qq.com/connect/oauth2/authorize?' . $this->_set_params($params);

        } else {
            $params = array
            (
                'appid'      => $this->config['appid'],
                'secret'     => $this->config['secret'],
                'code'       => $_GET['code'],
                'grant_type' => 'authorization_code',
            );
            $url    = 'https://api.weixin.qq.com/sns/oauth2/access_token?' . $this->_set_params($params);
            $ch     = curl_init();
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($ch);
            curl_close($ch);
            $res = json_decode($res, true);
            return $res['openid'];
        }
    }

    public function GetJsApiParameters($UnifiedOrderResult)
    {
        if(!array_key_exists("appid", $UnifiedOrderResult)
            || !array_key_exists("prepay_id", $UnifiedOrderResult)
            || $UnifiedOrderResult['prepay_id'] == "")
        {
            return "参数错误";
        }
        $params['appId'] =$UnifiedOrderResult["appid"];
        $timeStamp = time();
        $params['timeStamp'] ="$timeStamp";
        $params['nonceStr']  =self::getNonceStr();
        $params['package'] = "prepay_id=" . $UnifiedOrderResult['prepay_id'];
        $params['signType'] = 'MD5';
        $params['paySign'] = $this->MakeSign($params);
        $parameters = json_encode($params);
        return $parameters;
    }

    public function MakeSign($data)
    {
        $partnerKey = $this->config['key'];
        //签名步骤一：按字典序排序参数
        ksort($data);
        $string = $this->ToUrlParams($data);
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=".$partnerKey;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }

    /**
     * 格式化参数格式化成url参数
     */
    public function ToUrlParams($data)
    {
        $buff = "";
        foreach ($data as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    public function response($args) {
        if ($this->_verifier($args)) {
            $order_model = new order_model();
            $this->order = $order_model->find(array('order_id' => $args['out_trade_no']));
            if ($args['trade_status'] == 'TRADE_FINISHED' || $args['trade_status'] == 'TRADE_SUCCESS') {
                $this->message = '付款成功！您可以在订单详情里关注您的订单状态';
                $this->completed($args['out_trade_no'], $args['trade_no']);
                return true;
            } else {
                $this->message = '支付失败';
            }
        } else {
            $this->message = '付款验证失败';
        }
        return false;
    }

    private function _get_prepayid($args) {
        $params = array
        (
            'notify_url'       => $this->baseurl . '/api/pay/notify/wxpay',
            'trade_type'       => 'JSAPI',
            'spbill_create_ip' => get_ip(),
        );

        $params = array_merge($params,$args);
        $params['sign'] = $this->MakeSign($params);
        $xml = $this->_array_to_xml($params);
        $res = $this->_post_xml('https://api.mch.weixin.qq.com/pay/unifiedorder', $xml);
        $res = $this->_xml_to_array($res);
        $jsConfig = $this->GetJsApiParameters($res);
        return $jsConfig;
    }

    private function _array_to_xml($array) {
        $xml = '<xml>';
        foreach ($array as $k => $v) {
            if (is_numeric($v)) {
                $xml .= '<' . $k . '>' . $v . '</' . $k . '>';
            } else {
                $xml .= '<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>';
            }
        }
        $xml .= '</xml>';
        return $xml;
    }

    private function _xml_to_array($xml) {
        libxml_disable_entity_loader(true);
        $array = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array;
    }

    private function _post_xml($url, $xml) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    private function _set_params($params) {
        $args = '';
        foreach ($params as $k => $v) {
            if ($k != 'sign')
                $args .= $k . '=' . $v . '&';
        }
        return trim($args, '&');
    }
}