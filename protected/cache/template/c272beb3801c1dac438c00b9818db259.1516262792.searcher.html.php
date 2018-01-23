<?php if(!class_exists("View", false)) exit("no direct access allowed");?><div class="searcher module hide" id="searcher">
  <div class="main">
    <a class="close pointer" href="#home" onclick="outSearch()"><i class="iconfont">&#xe62d;</i></a>
    <div class="scin cut">
      <a class="fr" onclick="searchGoods()"><i class="iconfont">&#xe600;</i></a>
      <div class="in cut"><input id="kwenter" name="kw" type="text" class="variseclear" value="<?php if (!empty($_GET['kw'])) : ?><?php echo htmlspecialchars($_GET['kw'], ENT_QUOTES, "UTF-8"); ?><?php endif; ?>" required="required" /><i class="vinclrbtn iconfont">&#xe62d;</i></div>
    </div>
  </div>
  <?php if (!empty($hot_searches)) : ?>
  <dl class="hot">
    <dt>热搜：</dt>
    <dd>
      <?php $_foreach_v_counter = 0; $_foreach_v_total = count($hot_searches);?><?php foreach( $hot_searches as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
      <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'kw'=>$v, ));?>"><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></a>
      <?php endforeach; ?>
    </dd>
  </dl>
  <?php endif; ?>
</div>
<script type="text/javascript">
$(function(){
  $('#kwfake').focus(function(){$('#wrapper').hide();$('#searcher').show();$(this).blur();$('#kwenter').focus();});
  showHistory();
});

function searchGoods(){
  var words = $('#kwenter').val(), target = "<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'kw'=>'$words', ));?>";
  if(words != ''){
    var history = getJsonStorage('SEARCH_HISTORY');
    if(history == null) history = [];
    if($.inArray(words, history) < 0){
      if(history.unshift(words) > 10) history.pop();
    }
    setJsonStorage('SEARCH_HISTORY', history);
  }
  window.location.href = target.replace('$words', words);
}

function showHistory(){
  var history = getJsonStorage('SEARCH_HISTORY');
  if(history != null){
    $('#searcher').append(juicer($('#history-tpl').html(), {list:history}));
  }
}

function clearHistory(){
  $.vdsConfirm({
    content: '您确定要全部清空吗?',
    ok: function(){
      localStorage.removeItem('SEARCH_HISTORY');
      $('#history').remove();
    }
  });
}
</script>
<script type="text/template" id="history-tpl">
<dl class="history" id="history">
  <dt>历史：</dt>
  <dd>
    {@each list as v}
    <a href="<?php echo url(array('c'=>'mobile/search', 'a'=>'index', 'kw'=>'${v}', ));?>">${v}</a>
    {@/each}
    <a class="clear" onclick="clearHistory()">清除历史记录</a>
  </dd>
</dl>
</script>