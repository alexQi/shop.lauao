<?php
include(VIEW_DIR.DS.'function'.DS.'mobile_layout.php');
include(VIEW_DIR.DS.'function'.DS.'reviser.php');

class general_controller extends Controller
{
    public function init()
    {
        $this->common = array
        (
            'baseurl' => $GLOBALS['cfg']['http_host'],
            'theme' => $GLOBALS['cfg']['http_host'] . '/public/theme/mobile/' . $GLOBALS['cfg']['enabled_theme'],
        );
        utilities::crontab();
        return ;
        $client_ip = get_ip();
        if (empty($_SESSION['USER']['USER_ID']))
        {
            $user_model = new user_model();

            if (!isset($_GET['code']))
            {
                $realUrl = 'http://'.$_SERVER['HTTP_HOST'].'/m/index.html';
                $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$GLOBALS['wechat']['AppID'].'&redirect_uri='.urlencode($realUrl).'&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect';
                redirect($url);
            }
            //获取用户openId
            $wechat = plugin::instance('oauth', 'wechat');
            $wechatUser = $wechat->getAccessToken();
//              var_dump($wechatUser);die();


            if($user = $user_model->find(array('open_id' => $wechatUser->openid)))
            {
                if(request('stay')) $user_model->stay_login($user['user_id'], $user['password'], $client_ip);
                $user_model->set_logined_info($client_ip, $user['user_id'], $user['username'], $user['avatar']);
            }
            else
            {
                //获取用户信息
                $wechatUserInfo = $wechat->get_user_info($wechatUser->access_token,$wechatUser->openid);
                $data = array
                (
                    'username' => $wechatUserInfo['nickname'],
                    'email'    => '',
                    'password' => '123456',
                    'avatar'   => $wechatUserInfo['headimgurl'],
                    'open_id'  => $wechatUserInfo['openid'],
                    'repassword' => '',
                    'captcha'  => '',
                );
                $user_model->register($data);
            }

        }
        return true;
    }
    
    protected function compiler($tpl)
    {
        $this->display('mobile'.DS.$GLOBALS['cfg']['enabled_theme'].DS.$tpl);
    }

    protected function is_logined($jump = TRUE)
    {
        if (empty($_SESSION['USER']['USER_ID']))
        {
            if($cookie = request('USER_STAYED', null, 'cookie'))
            {
                $user_model = new user_model();
                if($user_model->check_stayed($cookie, get_ip()))
                {
                    $_SESSION['REDIRECT'] = $_SERVER['REQUEST_URI'];
                    if($jump) jump($_SERVER['REQUEST_URI']);
                }
            }
            if($jump) jump(url('mobile/user', 'login'));
            return FALSE;
        }
        return $_SESSION['USER']['USER_ID'];
    }

    protected function prompt($type = null, $text = null, $redirect = null, $time = 3)
    {
        if(empty($type)) $type = 'default';
        if(empty($redirect)) $redirect = 'javascript:history.back()';
        $this->rs = array('type' => $type, 'text' => $text, 'redirect' => $redirect, 'time' => $time);
        $this->compiler('prompt.html');
        exit;
    }

}
