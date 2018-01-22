<?php if(!class_exists("View", false)) exit("no direct access allowed");?><div class="header" id="header">
  <div class="logo fl"><a href="<?php echo url(array('m'=>$MOD, 'c'=>'main', 'a'=>'panel', ));?>">Verydows Panel</a></div>
  <div class="top-links fr cut">
    <a title="前端首页" class="icon front" target="_blank" href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">前端首页</a>
    <a title="帮助文档" class="icon help" href="http://www.verydows.com/manual/starting.html" target="_blank">帮助文档</a>
    <a title="设置" class="icon sets" href="<?php echo url(array('m'=>$MOD, 'c'=>'setting', 'a'=>'index', ));?>">设置</a>
    <a title="用户信息" class="icon user" onClick="popAc('pop-user')">用户信息</a>
    <a title="清理缓存" class="icon wipe" onClick="popAc('pop-clean')">清理缓存</a>
    <a title="退出登录" class="icon logout" href="<?php echo url(array('m'=>$MOD, 'c'=>'main', 'a'=>'logout', ));?>">退出登录</a>
  </div>
</div>
<div class="module hdline"></div>
<div class="acpop hide" id="pop-user"> <a class="close" onClick="closeUser()">×</a>
  <h2 class="c999">登录用户: <font class="f14 c666 ml5"><?php echo htmlspecialchars($_SESSION['ADMIN']['USERNAME'], ENT_QUOTES, "UTF-8"); ?></font></h2>
  <div class="module poinfo cut">
    <dl>
      <dt>姓名</dt>
      <dd><?php if (!empty($admin['name'])) : ?><?php echo htmlspecialchars($admin['name'], ENT_QUOTES, "UTF-8"); ?><?php else : ?><font class="c999">未设置</font><?php endif; ?></dd>
    </dl>
    <dl>
      <dt>邮箱</dt>
      <dd><?php echo htmlspecialchars($admin['email'], ENT_QUOTES, "UTF-8"); ?></dd>
    </dl>
    <dl>
      <dt>上次登录时间</dt>
      <dd><?php echo date('Y-m-d H:i:s', $admin['last_date']);?></dd>
    </dl>
    <dl>
      <dt>上次登录IP</dt>
      <dd><?php echo htmlspecialchars($admin['last_ip'], ENT_QUOTES, "UTF-8"); ?></dd>
    </dl>
    <div class="bl"></div>
    <div class="pwd mt15 hide" id="pwd">
      <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'main', 'a'=>'reset_password', ));?>">
        <dl>
          <dt>原密码</dt>
          <dd><input class="txt" name="old_password" id="old_password" type="password" /></dd>
        </dl>
        <dl>
          <dt>新密码</dt>
          <dd><input class="txt" name="new_password" id="new_password" type="password" /></dd>
        </dl>
        <dl>
          <dt>确认新密码</dt>
          <dd><input class="txt" name="repassword" id="repassword" type="password" /></dd>
        </dl>
      </form>
    </div>
  </div>
  <div class="ta-c">
    <button type="button" class="ubtn sm btn hide" onClick="submitPwd()">确定修改</button>
    <button type="button"class="fbtn sm btn" onclick="resetPwd()">重设密码</button>
    <span class="sep20"></span>
    <button type="button" class="fbtn sm btn" onclick="closeUser()">关闭</button>
  </div>
</div>
<div class="acpop hide" id="pop-clean">
  <a class="close" onclick="closeAc('pop-clean')">×</a>
  <h2 class="c999">清理缓存</h2>
  <div class="poinfo cut">
    <ul id="clean-select">
      <li><label onclick="checkAllClean()"><input type="checkbox" /><font>全部清理</font></label></li>
      <li><label><input name="clean" type="checkbox" value="data" /><font>清理数据缓存</font></label></li>
      <li><label><input name="clean" type="checkbox" value="template" /><font>清理模板缓存</font></label></li>
      <li><label><input name="clean" type="checkbox" value="static" /><font>清理静态缓存</font></label></li>
    </ul>
    <div class="cleaning cut hide" id="cleaning">
      <h3 class="c888 f14">正在清理</h3>
      <div class="loading x-auto"></div>
    </div>
  </div>
  <div class="ta-c">
    <button type="button" class="ubtn sm btn" onClick="cleanCache('<?php echo url(array('m'=>$MOD, 'c'=>'cleaner', 'a'=>'wiping', ));?>')">确定清理</button>
    <span class="sep20"></span>
    <button type="button" class="fbtn sm btn" onClick="closeAc('pop-clean')">取消</button>
  </div>
</div>