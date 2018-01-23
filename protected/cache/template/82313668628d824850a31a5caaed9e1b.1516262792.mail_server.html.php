<?php if(!class_exists("View", false)) exit("no direct access allowed");?><script type="text/javascript">
//发送测试邮件
function sendTestMail(btn){
  var checker = $('#recipient').vdsFieldChecker({
    rules: {required:[true, '请输入接收邮箱地址'], email:[true, '无效的邮箱地址']},
    tipsPos: 'abs'
  });
  if(checker) return false;
  
  var dataset = {
    smtp_server: $('#smtp_server').val(),
    smtp_port: $('#smtp_port').val(),
    smtp_user: $('#smtp_user').val(),
    smtp_password: $('#smtp_password').val(),
    smtp_secure: $('input[name="smtp_secure"]:checked').val(),
    recipient: $('#recipient').val()
  }	
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: "<?php echo url(array('m'=>$MOD, 'c'=>'setting', 'a'=>'test_sendmail', ));?>",
    data: dataset,
    beforeSend: function(){$(btn).prop('disabled', true).text('正在尝试发送邮件...');},
    success: function(res){
      $(btn).prop('disabled', false).text('发送测试邮件');
      if(res.status == 'success'){
        $('body').vdsAlert({msg:'发送成功，请登录邮箱查看是否收到测试邮件'})
      }else{
        $('body').vdsAlert({msg:'发送失败：'+res.msg});
      }
    },
    error: function(){ $('body').vdsAlert({msg:'请求出错'})}
  });
}
</script>
<div class="ta-c bw-row pad10 cut">
  <h3 class="th">测试邮件服务器</h3>
  <p class="mt10"><input class="w200 txt ta-c" name="recipient" id="recipient" type="text" placeholder="输入接收测试邮件的邮箱地址" warnpos="fixed" /></p>
  <p class="mt10"><button class="cbtn btn ml5" type="button" onclick="sendTestMail(this)">发送测试邮件</button></p>
  <p class="c999 mt10">尝试连接邮件服务器并发送测试邮件，用于检测邮件服务器是否设置正确</p>
</div>
<form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'setting', 'a'=>'update', 'step'=>'mail', ));?>">
  <div class="bw-row mt5 pad10">
    <table class="dataform">
      <tr>
        <th width="100">服务器</th>
        <td><input class="w200 txt" name="smtp_server" id="smtp_server" type="text" value="<?php echo htmlspecialchars($rs['smtp_server'], ENT_QUOTES, "UTF-8"); ?>" />
          <font class="caaa ml20">邮件服务商的 SMTP 服务器地址</font> </td>
      </tr>
      <tr>
        <th>端口</th>
        <td><input class="w200 txt" name="smtp_port" id="smtp_port" type="text" value="<?php echo htmlspecialchars($rs['smtp_port'], ENT_QUOTES, "UTF-8"); ?>" />
          <font class="caaa ml20">SMTP 邮件服务器的 TCP 连接端口</font> </td>
      </tr>
      <tr>
        <th>用户名</th>
        <td><input class="w200 txt" name="smtp_user" id="smtp_user" type="text" value="<?php echo htmlspecialchars($rs['smtp_user'], ENT_QUOTES, "UTF-8"); ?>" />
          <font class="caaa ml20">SMTP 邮件服务器所需身份验证的用户名</font> </td>
      </tr>
      <tr>
        <th>密码</th>
        <td><input class="w200 txt" name="smtp_password" id="smtp_password" type="password" value="<?php echo htmlspecialchars($rs['smtp_password'], ENT_QUOTES, "UTF-8"); ?>" />
          <font class="caaa ml20">SMTP 邮件服务器所需身份验证的密码</font> </td>
      </tr>
      <tr>
        <th>安全加密</th>
        <td>
          <div class="pad5">
            <label><input type="radio" name="smtp_secure" value="" <?php if (empty($rs['smtp_secure'])) : ?>checked="checked"<?php endif; ?> /><font class="red ml5">无</font></label>
            <label class="ml20"><input type="radio" name="smtp_secure" value="tls" <?php if ($rs['smtp_secure'] == 'tls') : ?>checked="checked"<?php endif; ?> /><font class="green ml5">TLS</font></label>
            <label class="ml20"><input type="radio" name="smtp_secure" value="ssl" <?php if ($rs['smtp_secure'] == 'ssl') : ?>checked="checked"<?php endif; ?> /><font class="green ml5">SSL</font></label>
            <font class="ml20 vtcmid caaa">安全连接前缀, 支持TLS加密以及SSL加密, 如果没有请选择 "无"</font>
          </div>
        </td>
      </tr>
    </table>
    <div class="submitbtn">
      <button type="submit" class="ubtn btn">保存并更新邮件设置</button>
      <button type="reset" class="fbtn btn">重置表单</button>
    </div>
  </div>
</form>