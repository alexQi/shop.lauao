<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/panel.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript" src="public/theme/backend/js/panel.js"></script>
<script type="text/javascript">
function jump(uri){
  var url = 'index.php?m=<?php echo htmlspecialchars($MOD, ENT_QUOTES, "UTF-8"); ?>&' + uri;
  parent.$('#main').attr('src', url);
}
</script>
</head>
<body>
<!-- 头部开始 -->
<?php include $_view_obj->compile('backend/lib/header.html'); ?>
<!-- 头部结束 -->
<div class="container">
  <!-- 菜单开始 -->
  <div class="nav fl" id="nav">
    <?php $_foreach_v_counter = 0; $_foreach_v_total = count($menus);?><?php foreach( $menus as $k => $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
    <h2><?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?></h2>
    <?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v);?><?php foreach( $v as $kk => $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?>
    <?php if (!is_array($vv)) : ?>
    <div class="nochild">
      <ul><li onclick="jump('<?php echo htmlspecialchars($vv, ENT_QUOTES, "UTF-8"); ?>')"><a><i class="arrow"></i><?php echo htmlspecialchars($kk, ENT_QUOTES, "UTF-8"); ?></a></li></ul>
    </div>
    <?php else : ?>
    <div>
      <h3><a><i class="arrow"></i><?php echo htmlspecialchars($kk, ENT_QUOTES, "UTF-8"); ?></a></h3>
      <ul>
        <?php $_foreach_vvv_counter = 0; $_foreach_vvv_total = count($vv);?><?php foreach( $vv as $kkk => $vvv ) : ?><?php $_foreach_vvv_index = $_foreach_vvv_counter;$_foreach_vvv_iteration = $_foreach_vvv_counter + 1;$_foreach_vvv_first = ($_foreach_vvv_counter == 0);$_foreach_vvv_last = ($_foreach_vvv_counter == $_foreach_vvv_total - 1);$_foreach_vvv_counter++;?>
        <li onclick="jump('<?php echo htmlspecialchars($vvv, ENT_QUOTES, "UTF-8"); ?>')"><a><i class="arrow"></i><?php echo htmlspecialchars($kkk, ENT_QUOTES, "UTF-8"); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endforeach; ?>
  </div>
  <!-- 菜单结束 -->
  <!-- 主体开始 -->
  <div class="rwrap">
    <iframe name="main" id="main" scrolling="auto" width="100%" height="700" frameborder="0" src="<?php echo url(array('m'=>$MOD, 'c'=>'main', 'a'=>'dashboard', ));?>"></iframe>
  </div>
  <!-- 主体结束 -->
</div>
<!-- 页脚开始 -->
<div class="footer" id="footer"><p>Powered by Lauao © <?php echo date('Y');?></p></div>
<!-- 页脚结束-->
</body>
</html>