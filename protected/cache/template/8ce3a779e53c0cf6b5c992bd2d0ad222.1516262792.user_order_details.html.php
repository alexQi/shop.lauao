<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<title>订单详情 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/user.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript">
$(function(){
  preserveSpace('footact');
  countdown();
});

function countdown(){
  var obj = $('#countdown');
  if(obj.size() == 0) return false;
  var remaining = parseInt(obj.data('remaining'));
  window.setInterval(function(){
    var _d = 0, _h = 0, _m = 0, _s = 0;
    if(remaining > 0){
      _d = Math.floor(remaining / (60 * 60 * 24));
      _h = Math.floor(remaining / (60 * 60)) - (_d * 24);
      _m = Math.floor(remaining / 60) - (_d * 24 * 60) - (_h * 60);
      _s = Math.floor(remaining) - (_d * 24 * 60 * 60) - (_h * 60 * 60) - (_m * 60);
    }
    if(_m <= 9) _m = '0' + _m;
    if(_s <= 9) _s = '0' + _s;
    obj.find('.remaining').text(_d+'天'+_h+'小时'+_m+'分'+_s+'秒');
    remaining --;
    obj.data('remaining', remaining);
  }, 1000);
}
</script>
</head>
<body>
<div class="wrapper" id="wrapper">
  <!-- header start -->
  <div class="header">
    <div class="op lt"><a href="<?php echo url(array('c'=>'mobile/order', 'a'=>'list', ));?>"><i class="f20 iconfont">&#xe602;</i></a></div>
    <h2>订单详情</h2>
  </div>
  <!-- header end -->
  <div class="order cut">
    <?php if (!empty($countdown)) : ?>
    <dl class="countdown mb8 cut" id="countdown" data-remaining="<?php echo htmlspecialchars($countdown, ENT_QUOTES, "UTF-8"); ?>">
      <dt><i class="iconfont">&#xe633;</i></dt>
      <dd>
        <p class="c666 mt2">您还有<font class="remaining red">0天0小时0分0秒</font><?php if ($order['order_status'] == 1) : ?>来付款，超时订单将自动取消<?php else : ?>确认签收，超时订单将自动签收<?php endif; ?></p>
      </dd>
    </dl>
    <?php endif; ?>
    <div class="blank ptb5 f14 cut">
      <dl class="col"><dt>订单号：</dt><dd><?php echo htmlspecialchars($order['order_id'], ENT_QUOTES, "UTF-8"); ?></dd></dl>
      <dl class="col"><dt>订单状态：</dt><dd><font class="red"><?php echo array_pop($progress);?></font></dd></dl>
      <dl class="col"><dt>下单时间：</dt><dd><?php echo date('Y-m-d H:i:s', $order['created_date']);?></dd></dl>
      <dl class="col"><dt>支付方式：</dt><dd><?php echo htmlspecialchars($order['payment_method_name'], ENT_QUOTES, "UTF-8"); ?></dd></dl>
      <dl class="col"><dt>配送方式：</dt><dd><?php echo htmlspecialchars($order['shipping_method_name'], ENT_QUOTES, "UTF-8"); ?></dd></dl>
    </div>
    <?php if (!empty($carrier) && !empty($shipping)) : ?>
    <dl class="carrier col mt8">
      <dt><i class="iconfont">&#xe623;</i></dt>
      <dd>
        <h4 class="c666"><?php echo htmlspecialchars($carrier['name'], ENT_QUOTES, "UTF-8"); ?></h4>
        <p class="mt5 c888">运单编号：<a class="blue" href="<?php echo htmlspecialchars($carrier['tracking_url'], ENT_QUOTES, "UTF-8"); ?><?php echo htmlspecialchars($shipping['tracking_no'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($shipping['tracking_no'], ENT_QUOTES, "UTF-8"); ?></a></p>
        <p class="mt5 c888">客服电话：<a class="blue" href="tel:<?php echo htmlspecialchars($carrier['service_tel'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($carrier['service_tel'], ENT_QUOTES, "UTF-8"); ?></a></p>
      </dd>
    </dl>
    <?php endif; ?>
    <dl class="address col mt8">
      <dt><i class="iconfont">&#xe62f;</i></dt>
      <dd class="c666">
        <h4><?php echo htmlspecialchars($consignee['receiver'], ENT_QUOTES, "UTF-8"); ?><span class="ml10"><?php echo htmlspecialchars($consignee['mobile'], ENT_QUOTES, "UTF-8"); ?></span></h4>
        <p class="mt5"><?php echo htmlspecialchars($consignee['province'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($consignee['city'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($consignee['borough'], ENT_QUOTES, "UTF-8"); ?> <?php echo htmlspecialchars($consignee['address'], ENT_QUOTES, "UTF-8"); ?><?php if (!empty($consignee['zip'])) : ?><br /><?php echo htmlspecialchars($consignee['zip'], ENT_QUOTES, "UTF-8"); ?><?php endif; ?></p>
      </dd>
    </dl>
    <div class="parcel mt8">
      <ul>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($goods_list);?><?php foreach( $goods_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <li>
          <div class="im"><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img alt="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/50x50/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></div>
          <div class="info">
            <p class="name"><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?></a></p>
            <?php if (!empty($v['goods_opts'])) : ?>
            <p class="c999 mt5"><?php $_foreach_o_counter = 0; $_foreach_o_total = count($v['goods_opts']);?><?php foreach( $v['goods_opts'] as $o ) : ?><?php $_foreach_o_index = $_foreach_o_counter;$_foreach_o_iteration = $_foreach_o_counter + 1;$_foreach_o_first = ($_foreach_o_counter == 0);$_foreach_o_last = ($_foreach_o_counter == $_foreach_o_total - 1);$_foreach_o_counter++;?><span class="mr5">[<?php echo htmlspecialchars($o['opt_type'], ENT_QUOTES, "UTF-8"); ?>: <font class="c666"><?php echo htmlspecialchars($o['opt_text'], ENT_QUOTES, "UTF-8"); ?></font>]</span><?php endforeach; ?></p>
            <?php endif; ?>
            <p class="subtotal mt5 c999">共<b class="q"><?php echo htmlspecialchars($v['goods_qty'], ENT_QUOTES, "UTF-8"); ?></b>件<span class="price ml10"><i class="cny">¥</i><?php echo htmlspecialchars($v['goods_price'], ENT_QUOTES, "UTF-8"); ?></span></p>
          </div>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="amount mt8 f14 cut">
      <dl class="col mt10"><dt>商品总计：</dt><dd><i class="cny">¥</i><?php echo htmlspecialchars($order['goods_amount'], ENT_QUOTES, "UTF-8"); ?></dd></dl>
      <dl class="col mt10"><dt>运费：</dt><dd><i class="cny">¥</i><?php echo htmlspecialchars($order['shipping_amount'], ENT_QUOTES, "UTF-8"); ?></dd></dl>
      <dl class="col total mt10"><dt>订单总额：</dt><dd class="f16"><i class="cny">¥</i><?php echo htmlspecialchars($order['order_amount'], ENT_QUOTES, "UTF-8"); ?></dd></dl>
    </div>
    <?php if (!empty($order['memos'])) : ?>
    <dl class="memo col mt8">
      <dt><i class="iconfont" style="">&#xe631;</i></dt>
      <dd class="f12 c666"><?php echo htmlspecialchars($order['memos'], ENT_QUOTES, "UTF-8"); ?></dd>
    </dl>
    <?php endif; ?>
  </div>
</div>
<div class="orderact footfixed" id="footact">
  <?php if ($order['order_status'] == 1) : ?>
  <a class="b2" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'cancel', 'id'=>$order['order_id'], ));?>">取消订单</a>
  <?php if ($order['payment_method'] != 2) : ?><a class="b1" href="<?php echo url(array('c'=>'mobile/pay', 'a'=>'index', 'order_id'=>$order['order_id'], ));?>">去付款</a><?php endif; ?>
  <?php elseif ($order['order_status'] == 3) : ?>
  <a class="b1" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'delivered', 'id'=>$order['order_id'], ));?>">确认签收</a>
  <?php elseif ($order['order_status'] == 4) : ?>
  <a class="b3" href="<?php echo url(array('c'=>'mobile/aftersales', 'a'=>'order', 'order_id'=>$order['order_id'], ));?>">售后</a>
  <a class="b1" href="<?php echo url(array('c'=>'mobile/review', 'a'=>'order', 'order_id'=>$order['order_id'], ));?>">评价</a>
  <?php elseif ($order['order_status'] == 0) : ?>
  <a class="b1" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'rebuy', 'id'=>$order['order_id'], ));?>">重新购买</a>
  <?php endif; ?>
</div>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>