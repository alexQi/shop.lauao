<?php if(!class_exists("View", false)) exit("no direct access allowed");?><script type="text/javascript">
function addGoodsThumb(e, type){ //增加
  var tpl = $('#goods-thumb-tpl').html();
  if(type == 0){
    tpl = tpl.replace(/\{\$type\}/g, 'goods_img_thumb');
  }else{
    tpl = tpl.replace(/\{\$type\}/g, 'goods_album_thumb');
  }
  $(e).closest('.module').find('table').append(tpl);
}
function removeGoodsThumb(e){
  $(e).closest('tr').remove();
}
</script>
<div class="bw-row mt5 pad10">
  <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'setting', 'a'=>'update', 'step'=>'goods', ));?>">
  <table class="dataform">
  <tr>
    <th width="110">热搜关键词</th>
    <td>
      <input class="w500 txt" name="goods_hot_searches" type="text" value="<?php echo htmlspecialchars($rs['goods_hot_searches'], ENT_QUOTES, "UTF-8"); ?>" />
      <p class="caaa mt10">商品热门搜索关键词，多个关键词请使用半角逗号(,)隔开</p>
    </td>
  </tr>
  <tr>
    <th>商品索引检索</th>
    <td>
      <label><input type="radio" name="goods_fulltext_query" value="1" <?php if ($rs['goods_fulltext_query'] == 1) : ?>checked="checked"<?php endif; ?> /><font class="green ml5">使用</font></label>
      <label class="ml20"><input type="radio" name="goods_fulltext_query" value="0" <?php if ($rs['goods_fulltext_query'] == 0) : ?>checked="checked"<?php endif; ?> /><font class="red ml5">关闭</font></label>
      <p class="caaa mt10">开启 MySql FULLTEXT 索引搜索商品，使用此项功能前，请确保服务器 MySql 配置文件中的 "ft_min_word_len" 项设置为 "ft_min_word_len=1"</p>
    </td>
    </tr>
    <tr>
      <th>显示数据个数</th>
        <td>
          <table class="dataform">
            <tr>
              <th width="80">分类列表</th>
              <td>
                <input class="w50 txt" name="cate_goods_per_num" type="text" value="<?php echo htmlspecialchars($rs['cate_goods_per_num'], ENT_QUOTES, "UTF-8"); ?>" />
                <font class="caaa ml20">前台商品分类页面中每页显示商品的最大个数</font>
              </td>
            </tr>
            <tr>
              <th>搜索结果</th>
              <td><input class="w50 txt" name="goods_search_per_num" type="text" value="<?php echo htmlspecialchars($rs['goods_search_per_num'], ENT_QUOTES, "UTF-8"); ?>" /><font class="caaa ml20">前台商品搜索结果中每页显示商品的最大个数</font></td>
            </tr>
            <tr>
              <th>浏览历史</th>
              <td>
                <input class="w50 txt" name="goods_history_num" type="text" value="<?php echo htmlspecialchars($rs['goods_history_num'], ENT_QUOTES, "UTF-8"); ?>" />
                <font class="caaa ml20">浏览历史栏显示商品最大个数, 值须在 1~20 之间</font>
             </td>
           </tr>
           <tr>
             <th>关联商品</th>
             <td><input class="w50 txt" name="goods_related_num" type="text" value="<?php echo htmlspecialchars($rs['goods_related_num'], ENT_QUOTES, "UTF-8"); ?>" /><font class="caaa ml20">关联商品显示最大个数, 值须在1以上</font></td>
           </tr>
           <tr>
             <th>评价列表</th>
             <td><input class="w50 txt" name="goods_review_per_num" type="text" value="<?php echo htmlspecialchars($rs['goods_review_per_num'], ENT_QUOTES, "UTF-8"); ?>" /><font class="caaa ml20">商品页面中每页显示评论的最大个数, 值须在1以上</font></td>
           </tr> 
         </table>
       </td>
     </tr>
     <tr>
       <th>显示库存</th>
       <td>
         <div class="pad5">
           <label><input type="radio" name="show_goods_stock" value="1" <?php if ($rs['show_goods_stock'] == 1) : ?>checked="checked"<?php endif; ?> /><font class="green ml5">是</font></label>
           <label class="ml20"><input type="radio" name="show_goods_stock" value="0" <?php if ($rs['show_goods_stock'] == 0) : ?>checked="checked"<?php endif; ?> /><font class="red ml5">否</font></label>
           <font class="ml20 vtcmid caaa">前台商品详情页中是否显示商品剩余库存数量</font>
         </div>
       </td>
       </tr>
       <tr>
         <th>上传图片类型</th>
         <td>
           <input class="w250 txt" name="upload_goods_filetype" type="text" value="<?php echo htmlspecialchars($rs['upload_goods_filetype'], ENT_QUOTES, "UTF-8"); ?>" />
           <font class="caaa ml20">允许上传的商品图片类型，请使用如 ".jpg" 这样的扩展名格式，多个不同类型请用 "|" 分隔</font>
         </td>
       </tr>
       <tr>
         <th>上传图片大小</th>
         <td>
           <input class="w100 txt" name="upload_goods_filesize" type="text" value="<?php echo htmlspecialchars($rs['upload_goods_filesize'], ENT_QUOTES, "UTF-8"); ?>" />
           <font class="caaa ml20">上传商品图片大小上限(单位可以是"KB"或"MB")，为 0 则表示系统不做限制(使用PHP默认配置)</font>
         </td>
       </tr>
       <tr>
         <th>生成缩略图</th>
         <td>
           <div class="module">
             <div class="pad5">
               <font class="c666 mr10">商品主要图片</font>
               <button type="button" class="cbtn sm btn" onclick="addGoodsThumb(this, 0)">+1 缩略图</button>
               <font class="caaa ml20">系统会将生成的缩略图保存在商品图片目录中以设定的"宽x高"命名的文件夹下</font>
             </div>
             <div class="pad5">
               <table class="dataform">
                 <?php $_foreach_v_counter = 0; $_foreach_v_total = count($rs['goods_img_thumb']);?><?php foreach( $rs['goods_img_thumb'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
                 <tr>
                   <td width="35"><button type="button" class="mbtn btn" onclick="removeGoodsThumb(this)">移除</button></td>
                   <td>
                     <label class="mr10"><font class="c888 mr5">宽:</font><input class="w50 txt" name="goods_img_thumb[w][]" value="<?php echo htmlspecialchars($v['w'], ENT_QUOTES, "UTF-8"); ?>" /></label>
                     <label><font class="c888 mr10">高:</font><input class="w50 txt" name="goods_img_thumb[h][]" value="<?php echo htmlspecialchars($v['h'], ENT_QUOTES, "UTF-8"); ?>" /></label>
                   </td>
		</tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
          <div class="module mt5">
            <div class="pad5">
              <font class="c666 mr10">商品相册图片</font>
              <button type="button" class="cbtn sm btn" onclick="addGoodsThumb(this, 1)">+1 缩略图</button>
              <font class="caaa ml20">系统会将生成的缩略图保存在商品相册目录中以设定的"宽x高"命名的文件夹下</font>
            </div>
            <div class="pad5">
              <table class="dataform">
                <?php $_foreach_v_counter = 0; $_foreach_v_total = count($rs['goods_album_thumb']);?><?php foreach( $rs['goods_album_thumb'] as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
                <tr>
                  <td width="35"><button type="button" class="mbtn btn" onclick="removeGoodsThumb(this)">移除</button></td>
                  <td>
                    <label class="mr10"><font class="c888 mr5">宽:</font><input class="w50 txt" name="goods_album_thumb[w][]" value="<?php echo htmlspecialchars($v['w'], ENT_QUOTES, "UTF-8"); ?>" /></label>
                    <label><font class="c888 mr10">高:</font><input class="w50 txt" name="goods_album_thumb[h][]" value="<?php echo htmlspecialchars($v['h'], ENT_QUOTES, "UTF-8"); ?>" /></label>
                  </td>
                </tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </td>
      </tr>
    </table>
    <div class="submitbtn">
      <button type="submit" class="ubtn btn">保存并更新商品设置</button>
      <button type="reset" class="fbtn btn">重置表单</button>
    </div>
  </form>
</div>
<script type="text/template" id="goods-thumb-tpl">
<tr>
  <td width="35"><button type="button" class="mbtn btn" onclick="removeGoodsThumb(this)">移除</button></td>
  <td>
    <label class="mr10"><font class="c888 mr5">宽:</font><input class="w50 txt" name="{$type}[w][]" /></label>
    <label><font class="c888 mr10">高:</font><input class="w50 txt" name="{$type}[h][]" /></label>
  </td>
</tr>
</script>