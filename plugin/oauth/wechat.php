<?php
/**
 * OAuth2.0 Tencent wechat
 * @author alex
 */
class wechat extends abstract_oauth
{

    public $data = array();
    public $api;
    public $msgType;
    public $msg = "不知道是什么鬼地方出错啦～～";
    public $msgTpl;

    public function create_login_url($state)
    {

    }

    public function check_callback($args)
    {

    }

    public function get_oauth_key($access_token)
    {

    }

    public function get_user_info($access_token, $oauth_key)
    {
        $param['appid']      = $GLOBALS['wechat']['AppID'];
        $param['secret']     = $GLOBALS['wechat']['AppSecret'];
        $param['code']       = $_GET['code'];
        $param['grant_type'] = 'authorization_code';
        $res = httpRequest('https://api.weixin.qq.com/sns/oauth2/access_token',$param);
        return json_decode($res);
    }

    public function valid()

    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            return $echoStr;
        }else{
            return false;
        }
    }

    public function checkSignature()
    {
//        log::write(json_encode($_GET));
        if (!isset($_GET["signature"]) || !isset($_GET["timestamp"]) || !isset($_GET["nonce"]))
        {
            return false;
        }
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce     = $_GET["nonce"];

        $token = $GLOBALS['wechat']['Token'];
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

//        log::write($tmpStr);

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function getAccessToken(){
        $param['grant_type'] = 'client_credential';
        $param['appid']      = $GLOBALS['wechat']['AppID'];
        $param['secret']     = $GLOBALS['wechat']['AppSecret'];
        $res = httpRequest($GLOBALS['wechat']['getToken'],$param,'post');
        return json_decode($res);
    }


    public function getMsg(){
        $fileContent = file_get_contents("php://input");
        libxml_disable_entity_loader(true);
        $data = simplexml_load_string($fileContent, 'SimpleXMLElement', LIBXML_NOCDATA);
        $data = json_encode($data);

        $data = json_decode($data, true);
        if (!empty($data)){
            $this->data    = $data;
            $this->msgType = strtolower($this->data['MsgType']);
            $this->responMsg();
            return true;
        }else{
            return false;
        }
    }

    public function responMsg()
    {
        $this->api = new Api();

        switch ($this->msgType){
            case 'event':
                if ($this->data['Event']=='subscribe')
                {
                    $this->msg = '欢迎关注我 O(∩_∩)O~∑ , 有啥想知道的尽管问我吧  (：◎)≡ ';

                }else if ($this->data['Event']=='unsubscribe')
                {
                    #取消关注 不做处理
                    //........
                }
                break;
            case 'text':
                $this->api->queryParam['queryString'] = $this->data['Content'];
                break;
            case 'image':
                #....
                break;
            case 'voice':
                $this->api->queryParam['queryString'] = $this->data['Recognition'];
                break;
            case 'video':
                #....
                break;
            case 'location':
                //..
                break;
            case 'link':
                //..
                break;
            default:
                break;
        }

        if (!isset($this->data['Event']) || $this->data['Event'] !='subscribe')
        {
            $useId = preg_replace('/[_-]+/','F',$this->data['FromUserName']);
            $this->api->userId = $useId;

            // 获取API信息
            $this->api->getApiInfo();
            $this->msg = $this->api->run();
        }


        $this->msgType = $this->msgType == 'event' || $this->msgType == 'voice' ? 'text':$this->msgType;
        $this->msgTpl  = $GLOBALS['wechat']['tpl'][$this->msgType];
    }

    public function sendMsg(){
        $result = sprintf($this->msgTpl, $this->data['FromUserName'], $this->data['ToUserName'], time(), $this->msg);

        return $result;
    }


}