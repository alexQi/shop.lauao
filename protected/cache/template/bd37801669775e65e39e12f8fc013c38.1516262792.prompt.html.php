<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript">
var countdown = <?php echo htmlspecialchars($rs['time'], ENT_QUOTES, "UTF-8"); ?>;
var timer;
$(function(){
  $('#countdown').text(countdown);
  timer = window.setInterval(redirect, 1000); 
})  

function redirect(){
  if(countdown <= 1) {window.clearInterval(timer);}
  countdown --;
  $('#countdown').text(countdown);
  if (countdown == 0){
    window.location.href = '<?php echo $rs['redirect']; ?>';
  }
}
</script>
</head>
<body>
<div class="content">
  <div class="loc">
    <h2><i class="icon"></i>系统提示</h2>
  </div>
  <div class="box">
    <div class="prompt">
      <h3 class="<?php echo htmlspecialchars($rs['type'], ENT_QUOTES, "UTF-8"); ?>"><?php if (is_array($rs['text'])) : ?><?php $_foreach_v_counter = 0; $_foreach_v_total = count($rs['text']);?><?php foreach( $rs['text'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?><br />
        <?php endforeach; ?><?php else : ?><?php echo htmlspecialchars($rs['text'], ENT_QUOTES, "UTF-8"); ?><?php endif; ?></h3>
      <p class="c999 mt15">系统将在 <span id="countdown">0</span> 秒后自动跳转到系统指定页面</p>
      <p class="mt15"><a href="<?php echo $rs['redirect']; ?>">如果浏览器没有自动跳转，请点击这里</a></p>
    </div>
  </div>
</div>
</body>
</html>
