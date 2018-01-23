<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/poper.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/file.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript" src="public/theme/backend/js/list.js"></script>
<script type="text/javascript">
$(function(){
  $("input[name='id']:checked").prop('checked', false);
});

function doDelete(){
  if(true == isChecked(true)){
    var form = $('<form></form>', {method:'post', action:"<?php echo url(array('m'=>$MOD, 'c'=>'file', 'a'=>'delete', ));?>", border:0});
    $('input[name="id"]:checked').each(function(i){
      var val = $(this).data('path');
      form.append('<input name="path[]" value="'+val+'" type="hidden" />');
    });
    form.submit();
    return false;
  }
}

function isChecked(multipe){
  var size = $("input[name='id']:checked").size();
  multipe = multipe || false;
  if(size < 1){ 
    $('body').vdsAlert({msg:'请先选中一个文件'});
    return false;
  }
  if(multipe != true){
    if(size > 1){$('body').vdsAlert({msg:'只能一次选择一个文件'});return false;}
  }
  return true;
}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>上传文件列表</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae add btn" onclick="doUpload('pop')"><i></i><font>上传文件</font></a>
      <a class="ae btn" onclick="doRename('pop')"><i class="edit"></i><font>重命名</font></a>
      <a class="ae btn" onclick="doDelete()"><i class="remove"></i><font>删除</font></a>
    </div>
    <div class="module mt5">
      <table class="datalist">
        <tr>
          <th width="30">选择</th>
          <th width="30">类型</th>
          <th class="ta-l">名称</th>
          <th width="120">大小</th>
        </tr>
        <?php if ($parentdir != '/') : ?>
        <tr>
          <td class="ta-l" colspan="3"><a class="blue" href="<?php echo url(array('c'=>'backend/file', 'a'=>'index', 'path'=>$parentdir, ));?>">上级目录</a></td>
          <td>/</td>
        </tr>
        <?php endif; ?>
        <?php if (!empty($results)) : ?>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($results);?><?php foreach( $results as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <tr>
          <td><input name="id" type="checkbox" data-path="<?php echo htmlspecialchars($v['path'], ENT_QUOTES, "UTF-8"); ?>" data-name="<?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?>" data-type="<?php echo htmlspecialchars($v['type'], ENT_QUOTES, "UTF-8"); ?>" /></td>
          <td><i class="<?php echo htmlspecialchars($v['type'], ENT_QUOTES, "UTF-8"); ?> icon"></i></td>
          <td class="ta-l"><?php if ($v['type'] == 'folder') : ?><a class="blue" href="<?php echo url(array('c'=>'backend/file', 'a'=>'index', 'path'=>$v['path'], ));?>"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></a><?php elseif ($v['type'] == 'picture') : ?><a class="blue" onclick="$(this).vdsPopMedia({src:'upload/<?php echo htmlspecialchars($v['path'], ENT_QUOTES, "UTF-8"); ?>', type:'image'})"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></a><?php elseif ($v['type'] == 'flash') : ?><a class="blue" onclick="$(this).vdsPopMedia({src:'upload/<?php echo htmlspecialchars($v['path'], ENT_QUOTES, "UTF-8"); ?>', type:'flash'})"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></a><?php else : ?><font class="c666"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></font><?php endif; ?></td>
          <td class="c666"><?php echo htmlspecialchars($v['size'], ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </table>
    </div>
    <?php if (!empty($paging)) : ?>
    <div class="libom mt5"><?php echo html_paging(array('paging'=>$paging, 'class'=>'paging', 'm'=>$MOD, 'c'=>'file', 'a'=>'index', 'path'=>$path, ));?></div>
    <?php endif; ?>
  </div>
</div>
<?php include $_view_obj->compile('backend/tools/file_rename.html'); ?>
<?php include $_view_obj->compile('backend/tools/file_upload.html'); ?>
</body>
</html>