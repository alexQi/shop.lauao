<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript">
function submitForm(){
  $('#instruction').vdsFieldChecker({rules:{maxlen:[240, '使用说明不能超过240个字符']}});
  $('#seq').vdsFieldChecker({rules:{seq:[true, '排序只能填写0到99的整数']}});
  $('form').vdsFormChecker();
}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>编辑支付方式</h2></div>
  <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'payment_method', 'a'=>'edit', 'id'=>$rs['id'], 'step'=>'submit', ));?>">
    <input type="hidden" name="params" id="params" />
    <div class="box">
      <div class="module">
        <table class="dataform">
          <tr>
            <th width="110">名称</th>
            <td><b class="c666"><?php echo htmlspecialchars($rs['name'], ENT_QUOTES, "UTF-8"); ?></b></td>
          </tr>
          <tr>
            <th width="110">支付类型</th>
            <td><?php echo htmlspecialchars($type_map[$rs['type']], ENT_QUOTES, "UTF-8"); ?></td>
          </tr>
          <?php if (!empty($rs['config_tpl'])) : ?><?php include $_view_obj->compile($rs['config_tpl']); ?><?php endif; ?>
          <tr>
            <th>使用说明</th>
            <td>
              <textarea class="txtarea" name="instruction" id="instruction" cols="88" rows="5"><?php echo htmlspecialchars($rs['instruction'], ENT_QUOTES, "UTF-8"); ?></textarea>
              <p class="c999 mt10">"使用说明" 将会在用户下单页面选择支付方式时显示</p>
            </td>
          </tr>
          <tr>
            <th>排序</th>
            <td><input class="w50 txt" name="seq" id="seq" type="text" value="<?php echo htmlspecialchars($rs['seq'], ENT_QUOTES, "UTF-8"); ?>" /></td>
          </tr>
          <tr>
            <th>状态</th>
            <td>
              <p class="pad5">
                <label class="green"><input type="radio" name="enable" value="1" <?php if ($rs['enable'] == 1) : ?>checked="checked"<?php endif; ?> /> 启用</label>
                <label class="red ml20"><input type="radio" name="enable" value="0" <?php if ($rs['enable'] == 0) : ?>checked="checked"<?php endif; ?> /> 关闭</label>
              </p>
            </td>
          </tr>
        </table>
      </div>
      <div class="submitbtn">
        <button type="button" class="ubtn btn" onclick="submitForm()">保存并更新</button>
        <button type="reset" class="fbtn btn">重置表单</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>