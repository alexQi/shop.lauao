<?php if(!class_exists("View", false)) exit("no direct access allowed");?><script type="text/javascript">
$(function(){
  $('#theme-form dl').hover(
    function(){
      $(this).addClass('hover');
    },
    function(){
      $(this).removeClass('hover');
    }
  );
  $('#theme-form dl').click(function(){
    $('#theme-form dl').removeClass('selected').find('dd.tick').remove();
    $(this).addClass('selected').append('<dd class="tick"><i></i></dd>');
    $('#theme-form input[name="theme"]').val($(this).data('theme'));
  });
});

function updateTheme(){
  if($('#theme-form input[name="theme"]').val() == ''){
    $('body').vdsAlert({msg:"请选择您想启用的模板主题"});
    return false;
  }
  $('#theme-form').submit();
}
</script>
<div class="bw-row pad10 cut">
  <h2 class="th ta-c">当前模板主题</h2>
  <dl class="curtheme bw-row pad10 cut">
    <dt class="pad10 fl ta-c"><img src="public/theme/frontend/<?php echo htmlspecialchars($rs['enabled_theme']['dirname'], ENT_QUOTES, "UTF-8"); ?>/thumbnail.jpg" /></dt>
    <dd>
      <table class="dataform">
        <tr>
          <th>名称</th>
          <td><a href="<?php echo htmlspecialchars($rs['enabled_theme']['link'], ENT_QUOTES, "UTF-8"); ?>" target="_blank" class="blue"><?php echo htmlspecialchars($rs['enabled_theme']['name'], ENT_QUOTES, "UTF-8"); ?></a></td>
        </tr>
        <tr>
          <th>版本</th>
          <td><?php echo htmlspecialchars($rs['enabled_theme']['version'], ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <tr>
          <th>作者</th>
          <td><?php echo htmlspecialchars($rs['enabled_theme']['author'], ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <tr>
          <th>日期</th>
          <td><?php echo htmlspecialchars($rs['enabled_theme']['date'], ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <tr>
          <th>简介</th>
          <td><?php echo htmlspecialchars($rs['enabled_theme']['describe'], ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
      </table>
    </dd>
  </dl>
</div>
<div class="bw-row mt5 pad10">
  <h2 class="th ta-c">全部可用模板主题</h2>
  <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'setting', 'a'=>'update', 'step'=>'theme', ));?>" id="theme-form">
    <input type="hidden" name="theme" value="" />
    <div class="themes module mt10 cut">
      <?php $_foreach_v_counter = 0; $_foreach_v_total = count($rs['themes']);?><?php foreach( $rs['themes'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
      <dl class="ta-c" title="点击选中" data-theme="<?php echo htmlspecialchars($v['dirname'], ENT_QUOTES, "UTF-8"); ?>">
        <dt><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></dt>
        <dd class="mt10"><img src="public/theme/frontend/<?php echo htmlspecialchars($v['dirname'], ENT_QUOTES, "UTF-8"); ?>/thumbnail.jpg" /></dd>
        <dd class="mt10 c888"><?php echo htmlspecialchars($v['describe'], ENT_QUOTES, "UTF-8"); ?></dd>
        <dd class="tick"><i></i></dd>
      </dl>
      <?php endforeach; ?>
    </div>
  </form>
</div>
<div class="bw-row mt5 pad10 ta-c"><button type="button" class="cbtn btn" onclick="updateTheme()">启 用</button></div>