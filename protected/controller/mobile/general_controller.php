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
//        utilities::crontab();

        //确认是否授权微信
        if (!isset($_GET['code']))
        {
            $realUrl = $_SERVER['HTTP_HOST'];
            log::write($realUrl);
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$GLOBALS['wechat']['AppID'].'&redirect_uri='.urlencode($realUrl).'&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect';
            return redirect($url);
        }else{
            return true;
        }
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
