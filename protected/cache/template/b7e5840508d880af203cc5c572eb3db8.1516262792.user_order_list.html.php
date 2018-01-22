<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<title><?php echo htmlspecialchars($title, ENT_QUOTES, "UTF-8"); ?> - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/user.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript">
$(function(){
  showOrders();
  $.vdsTouchScroll({
    onBottom: function(){
      var obj = $('#orders');
      if(obj.data('cur') != obj.data('next')){
        showOrders();
      }else{
        $('#nomore').show();
      }
    },
  });
});

function showOrders(){
  var container = $('#orders'), pending = container.data('pending'), page_id = container.data('next');
  $.asynList("<?php echo url(array('c'=>'api/order', 'a'=>'list', ));?>", {pending:pending, page:page_id, pernum:5}, function(res){
    if(res.status == 'success'){
      $('#orders').append(juicer($('#order-tpl').html(), res));
      if(res.paging){
        container.data('cur', page_id);
        container.data('next', res.paging.next_page);
      }
    }else if(res.status == 'nodata'){
      $('#orders').append($('#nodata-tpl').html());
    }else{
      $.vdsPrompt({content:res.msg});
    }
  });
}
</script>
</head>
<body>
<div class="wrapper" id="wrapper">
  <div class="header">
    <div class="op lt"><a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'index', ));?>"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h2><?php echo htmlspecialchars($title, ENT_QUOTES, "UTF-8"); ?></h2>
  </div>
  <div class="orderli module cut" id="orders" data-pending="<?php echo htmlspecialchars($pending, ENT_QUOTES, "UTF-8"); ?>" data-cur="1" data-next="1"></div>
  <div class="nomore hide" id="nomore">—— 没有更多内容了 ——</div>
</div>
<!-- 订单模板开始 -->
<script type="text/template" id="order-tpl">
{@each list as v}
<div class="item">
  <div class="th c666"><span class="fr">${v.progress}</span><font class="mr5">订单号:</font><b>${v.order_id}</b></div>
  {@each v.goods_list as vv}
  <div class="goods">
    <a class="im" href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>'${vv.goods_id}', ));?>"><img src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/100x100/${vv.goods_image}" /></a>
    <div class="info">
      <p><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>'${vv.goods_id}', ));?>">${vv.goods_name}</a></p>
      {@if vv.goods_opts != null}
      <p class="c999 mt5">{@each vv.goods_opts as o}<span class="mr10">${o.opt_type}: [<font class="c666">${o.opt_text}</font>]</span>{@/each}</p>
      {@/if}
      <p class="mt5">
        <font class="c999 mr5">单价:</font><i class="cny">¥</i>${vv.goods_price}<span class="sep10"></span><font class="c999 mr5">数量:</font>${vv.goods_qty}
      </p>
    </div>
  </div>
  {@/each}
  <div class="total"><font class="mr5">总额:</font><span class="red"><i class="cny">¥</i><font class="f14">${v.order_amount}</font></span><span class="ml5 c999">(含运费：<i class="cny">¥</i>${v.shipping_amount})</span></div>
  <div class="act">
    <a href="<?php echo url(array('c'=>'mobile/order', 'a'=>'view', 'id'=>'${v.order_id}', ));?>">查看详细</a>
    {@if v.order_status == 0}
    <a class="b1" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'rebuy', 'id'=>'${v.order_id}', ));?>">重新购买</a>
    {@else if v.order_status == 1}
    {@if v.payment_method != 2}<a class="b1" href="<?php echo url(array('c'=>'mobile/pay', 'a'=>'index', 'order_id'=>'${v.order_id}', ));?>">立即付款</a>{@/if}
    <a class="b2" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'cancel', 'id'=>'${v.order_id}', ));?>">取消订单</a>
    {@else if v.order_status == 3}
    <a class="b1" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'delivered', 'id'=>'${v.order_id}', ));?>">确认签收</a>
    {@else if v.order_status == 4}
    <a class="b1" href="<?php echo url(array('c'=>'mobile/review', 'a'=>'order', 'order_id'=>'${v.order_id}', ));?>">评价</a>
    <a class="b2" href="<?php echo url(array('c'=>'mobile/aftersales', 'a'=>'order', 'order_id'=>'${v.order_id}', ));?>">售后</a>
    {@/if}
  </div>
</div>
{@/each}
</script>
<script type="text/template" id="nodata-tpl">
<div class="nodata">
  <div class="th"><span><i class="iconfont">&#xe619;</i></span><div class="line"></div></div>
  <p>暂无相关订单内容</p>
</div>
</script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>