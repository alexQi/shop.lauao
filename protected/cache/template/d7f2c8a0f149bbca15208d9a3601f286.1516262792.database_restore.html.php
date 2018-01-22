<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/database.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript" src="public/theme/backend/js/list.js"></script>
<script type="text/javascript">
function restore(e){
  var selected = $('#files-form input[type="checkbox"]:checked');
  if(selected.size() < 1){
    $('body').vdsAlert({msg:'请选择您需要导入的备份数据文件'});
    return false;
  }else if(selected.size() > 1){
    $('body').vdsAlert({msg:'只能选择一项备份数据文件'});
    return false;
  }else{
    $(e).vdsConfirm({
      text: '注：此举将会覆盖现有数据库数据<br />您确定要使用备份数据文件"'+selected.val()+'"导入吗？',
      left: 375,
      top: -30,
      confirmed: function(){importFile(selected.val());},
    });
  }
}

function importFile(file){
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: "<?php echo url(array('m'=>$MOD, 'c'=>'database', 'a'=>'restore', 'step'=>'import', ));?>",
    data: {'file':file},
    beforeSend: function(){$.vdsMasker(true);$('#waiting').vdsMidst({gotop: -200}).show();},
    success: function(res){
      $.vdsMasker(false);
      $('#waiting').hide();
      if(res.status == 'success'){
        $('#prompt').find('h3').addClass('green').text('成功导入备份数据文件!');
      }else{
        $('#prompt').find('h3').addClass('red').text(res.msg);
      }
      $('#restore').empty().append($('#prompt').html());
    },
    error: function(){ $.vdsMasker(false);$('#waiting').hide();$('body').vdsAlert({msg:"处理请求时发生错误"});}
  });
}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>数据库恢复</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="sbtn sm btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'database', 'a'=>'backup', ));?>"><font>备份</font></a>
      <a class="sbtn sm btn disabled"><font>恢复</font></a>
      <a class="sbtn sm btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'database', 'a'=>'optimize', ));?>"><font>优化</font></a>
    </div>
    <?php if (!empty($file_list)) : ?>
    <div class="bw-row mt5 pad10" id="restore">
      <form method="post" id="files-form">
        <table class="datalist">
          <tr>
            <th width="50">选择</th>
            <th class="ta-l">备份文件名</th>
            <th width="150">大小</th>
            <th width="110">日期</th>
          </tr>
          <?php $_foreach_v_counter = 0; $_foreach_v_total = count($file_list);?><?php foreach( $file_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
          <tr>
            <td><input name="file[]" type="checkbox" value="<?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?>" /></td>
            <td class="ta-l"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></td>
            <td><?php echo htmlspecialchars($v['size'], ENT_QUOTES, "UTF-8"); ?></td>
            <td class="c666"><?php echo date('Y-m-d H:i:s', $v['mtime']);?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      </form>
      <div class="mt8 pad5">
        <button type="button" class="cbtn btn" onclick="restore(this)">导入</button>
        <span class="sep20"></span>
        <button type="button" class="cbtn btn" onclick="domulent('<?php echo url(array('m'=>$MOD, 'c'=>'database', 'a'=>'restore', 'step'=>'delete', ));?>', 'files-form', 'file[]')">删除</button>
      </div>
    </div>
    <?php else : ?>
    <div class='nors mt5'>暂无数据备份文件...</div>
    <?php endif; ?>
  </div>
</div>
<!-- waiting start -->
<div class="waiting ta-c cut hide" id="waiting">
  <h3 class="c666 f14">正在导入备份文件...</h3>
  <div class="loading"></div>
</div>
<!-- waiting end -->
<!-- rs start -->
<div id="prompt" class="hide">
  <h3 class="f14 pad10 ta-c"></h3>
</div>
<!-- rs start -->
</body>
</html>