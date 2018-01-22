<?php if(!class_exists("View", false)) exit("no direct access allowed");?><div class="bw-row pad10 cut">
  <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'setting', 'a'=>'update', 'step'=>'home', ));?>">
    <table class="dataform">
      <tr>
        <th width="110">首页标题</th>
        <td><input class="w400 txt" name="home_title" type="text" value="<?php echo htmlspecialchars($rs['home_title'], ENT_QUOTES, "UTF-8"); ?>" /><font class="caaa ml20">网站首页在浏览器窗口标题栏显示的内容</font></td>
      </tr>
      <tr>
        <th>首页关键字</th>
        <td><textarea class="txtarea" name="home_keywords" cols="80" rows="4"><?php echo htmlspecialchars($rs['home_keywords'], ENT_QUOTES, "UTF-8"); ?></textarea><font class="caaa ml20">网站首页在浏览器窗口标题栏显示的内容</font></td>
      </tr>
      <tr>
        <th>首页描述</th>
        <td><textarea class="txtarea" name="home_description" cols="80" rows="4"><?php echo htmlspecialchars($rs['home_description'], ENT_QUOTES, "UTF-8"); ?></textarea></td>
      </tr>
    </table>
    <div class="submitbtn">
      <button type="submit" class="ubtn btn">保存并更新首页设置</button>
      <button type="reset" class="fbtn btn">重置表单</button>
    </div>
  </form>
</div>