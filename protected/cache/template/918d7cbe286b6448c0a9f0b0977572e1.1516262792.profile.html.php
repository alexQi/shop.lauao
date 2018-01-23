<?php if(!class_exists("View", false)) exit("no direct access allowed");?><script type="text/javascript">
function updateProfile(){
  var form = $('#form-profile'), qq = form.find('input[name="qq"]');
  form.find('input[name="nickname"]').vdsFieldChecker({rules: {maxlen:[30, '昵称不能超过30个字符']}});
  qq.vdsFieldChecker({rules: {qq:[/^$|^[1-9][0-9]{4,12}$/.test(qq.val()), 'QQ号码格式不正确']}});
  form.find('txtarea[name="signature"]').vdsFieldChecker({rules: {maxlen:[240, '个性签名不能超过240个字符']}});
  form.vdsFormChecker();
}
</script>
<div class="bw-row mt5 pad5 cut">
  <h3 class="th ta-c">用户资料</h3>
  <div class="pad5 cut">
    <form method="post" id="form-profile" enctype="multipart/form-data" action="<?php echo url(array('m'=>$MOD, 'c'=>'user', 'a'=>'edit_profile', 'id'=>$user['user_id'], ));?>">
    <table class="dataform">
      <tr>
        <th width="12%">昵称</th>
        <td width="38%"><input class="w200 txt" name="nickname" value="<?php echo htmlspecialchars($profile['nickname'], ENT_QUOTES, "UTF-8"); ?>" type="text" /></td>
        <th width="12%">性别</th>
        <td>
          <label><input type="radio" name="gender" value="0" <?php if ($profile['gender'] == 0) : ?>checked="checked"<?php endif; ?> /><font class="ml5">保密</font></label>
          <label class="ml10"><input type="radio" name="gender" value="1" <?php if ($profile['gender'] == 1) : ?>checked="checked"<?php endif; ?> /><font class="ml5">男</font></label>
          <label class="ml10"><input type="radio" name="gender" value="2" <?php if ($profile['gender'] == 2) : ?>checked="checked"<?php endif; ?> /><font class="ml5">女</font></label>
        </td>
      </tr>
      <tr>
        <th>出生日期</th>
        <td>
          <select class="slt" name="birth_year"><?php echo html_date_options(array('type'=>"year", 'default'=>$profile['birth_year'], ));?></select>
          <select class="slt" name="birth_month"><?php echo html_date_options(array('type'=>"month", 'default'=>$profile['birth_month'], ));?></select>
          <select class="slt" name="birth_day"><?php echo html_date_options(array('type'=>"day", 'default'=>$profile['birth_day'], ));?></select>
        </td>
        <th>QQ</th>
        <td><input class="w200 txt" name="qq" value="<?php echo htmlspecialchars($profile['qq'], ENT_QUOTES, "UTF-8"); ?>" type="text" /></td>
      </tr>
      <tr>
        <th>个性签名</th>
        <td colspan="3"><textarea class="txtarea" name="signature" cols="60" rows="4"><?php echo htmlspecialchars($profile['signature'], ENT_QUOTES, "UTF-8"); ?></textarea></td>
      </tr>
      <tr>
        <td colspan="4">
          <div class="pad10 ta-c">
            <button type="button" class="ubtn btn" onclick="updateProfile()">保存并更新资料</button>
            <span class="sep20"></span>
            <button type="reset" class="ubtn btn">重置表单</button>
          </div>
        </td>
      </tr>
    </table>
    </form>
  </div>
</div>