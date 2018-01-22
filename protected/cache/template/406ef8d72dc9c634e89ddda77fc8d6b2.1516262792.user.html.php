<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/user.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/poper.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>用户信息</h2></div>
  <div class="box">
    <div class="bw-row pad5 cut">
      <h3 class="th ta-c">基本信息</h3>
      <div class="pad5">
        <table class="dataform">
          <tr>
            <th width="12%">用户名</th>
            <td width="38%"><?php echo htmlspecialchars($user['username'], ENT_QUOTES, "UTF-8"); ?></td>
            <th width="12%">状态</th>
            <td><?php if ($user['status'] == 1) : ?><font class="red">限制</font><?php else : ?><font class="green">正常</font><?php endif; ?></td>
          </tr>
          <tr>
            <th>邮箱</th>
            <td><?php echo htmlspecialchars($user['email'], ENT_QUOTES, "UTF-8"); ?><?php if ($user['email_status'] == 1) : ?><font class="green ml10">[已验证]</font><?php else : ?><font class="red ml10">[未验证]</font><?php endif; ?></td>
            <th>头像</th>
            <td>
              <?php if (!empty($user['avatar'])) : ?>
              <img width="40" height="40" src="<?php echo htmlspecialchars($baseurl, ENT_QUOTES, "UTF-8"); ?>/upload/user/avatar/<?php echo htmlspecialchars($user['avatar'], ENT_QUOTES, "UTF-8"); ?>" />
              <?php else : ?>
              <font class="c999">未设置</font>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th>手机号</th>
            <td>
              <?php if (!empty($user['mobile'])) : ?>
              <?php echo htmlspecialchars($user['mobile'], ENT_QUOTES, "UTF-8"); ?><?php if ($user['mobile_status'] == 1) : ?><font class="green ml10">[已验证]</font><?php else : ?><font class="red ml10">[未验证]</font><?php endif; ?>
              <?php else : ?>
              <font class="c999">未设置</font>
              <?php endif; ?>
            </td>
            <th>用户组</th>
            <td><?php echo htmlspecialchars($account['group_name'], ENT_QUOTES, "UTF-8"); ?></td>
          </tr>
          <tr>
            <th>账户经验</th>
            <td><?php echo htmlspecialchars($account['exp'], ENT_QUOTES, "UTF-8"); ?></td>
            <th>注册日期</th>
            <td><?php echo date('Y-m-d h:i:s', $record['created_date']);?></td>
          </tr>
          <tr>
            <th>账户余额</th>
            <td><?php echo htmlspecialchars($account['balance'], ENT_QUOTES, "UTF-8"); ?></td>
            <th>最后登陆日期</th>
            <td><?php echo date('Y-m-d h:i:s', $record['last_date']);?></td>
          </tr>
          <tr>
            <th>账户积分</th>
            <td><?php echo htmlspecialchars($account['points'], ENT_QUOTES, "UTF-8"); ?></td>
            <th>最后登陆IP</th>
            <td><?php echo htmlspecialchars($record['last_ip'], ENT_QUOTES, "UTF-8"); ?></td>
          </tr>
          <tr>
            <td colspan="4">
              <div class="pad10 ta-c">
                <a class="cbtn sm btn" onclick="popResetPwd()">重设密码</a><span class="sep20"></span>
                <a class="cbtn sm btn" onclick="popRevise()">调整账户数据</a><span class="sep20"></span>
                <a class="cbtn sm btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'view', 'step'=>'order', 'id'=>$user['user_id'], ));?>">订单记录</a><span class="sep20"></span>
                <a class="cbtn sm btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'view', 'step'=>'account', 'id'=>$user['user_id'], ));?>">账户记录</a><span class="sep20"></span>
                <a class="cbtn sm btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'view', 'step'=>'consignee', 'id'=>$user['user_id'], ));?>">收件地址</a>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <!-- 用户资料开始 -->
    <?php include $_view_obj->compile('backend/user/profile.html'); ?>
    <!-- 用户资料结束 -->
  </div>
  </form>
</div>
<?php include $_view_obj->compile('backend/user/reset_password.html'); ?>
<?php include $_view_obj->compile('backend/user/revise_account.html'); ?>
</body>
</html>