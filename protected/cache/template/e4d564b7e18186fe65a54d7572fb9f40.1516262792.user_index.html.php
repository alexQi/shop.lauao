<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<title>用户中心 - <?php echo htmlspecialchars($GLOBALS['cfg']['site_name'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/user.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript">
$(function(){
  $('#order-pending a').each(function(i, e){
    $.getJSON("<?php echo url(array('c'=>'api/order', 'a'=>'pending', ));?>", {pending:$(e).data('pending')}, function(res){
      if(res.status == 'success' && res.count > 0) $(e).find('em').text(res.count).show();
    }); 
  });
  viewCartbar();
  preserveSpace('footnav');
});

function logout(){
  $.vdsConfirm({
    content:'您确定要登出吗?',
    ok: function(){
      window.location.href = "<?php echo url(array('c'=>'mobile/user', 'a'=>'logout', ));?>";
    }
  });
}
</script>
</head>
<body>
<div class="wrapper">
  <div class="topinfo">
    <div class="module xauto cut">
      <div class="avatar fl"><a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'profile', ));?>"><img src="<?php if (!empty($user['avatar'])) : ?><?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/user/avatar/<?php echo htmlspecialchars($user['avatar'], ENT_QUOTES, "UTF-8"); ?><?php else : ?><?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/image/noavatar_m.gif<?php endif; ?>" /></h3></div>
      <div class="info">
        <dl>
          <dd class="mt5"><font class="f14"><?php echo htmlspecialchars($user['username'], ENT_QUOTES, "UTF-8"); ?></font><span class="ml10 dim"><?php echo htmlspecialchars($account['group_name'], ENT_QUOTES, "UTF-8"); ?></span></dd>
          <dd class="mt5">
            <font class="dim">账户余额：</font><b><?php echo htmlspecialchars($account['balance'], ENT_QUOTES, "UTF-8"); ?> 元</b>
            <span class="sep5"></span>
            <font class="dim">积分：</font><b><?php echo htmlspecialchars($account['points'], ENT_QUOTES, "UTF-8"); ?></b>
          </dd>
        </dl>
      </div>
    </div>
    <div class="menus cut">
      <ul>
        <li><a href="<?php echo url(array('c'=>'mobile/favorite', 'a'=>'list', ));?>"><i class="iconfont">&#xe60a;</i><p>商品收藏</p></a></li>
        <li><a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'footprint', ));?>"><i class="iconfont">&#xe613;</i><p>我的足迹</p></a></li>
        <li><a href="<?php echo url(array('c'=>'mobile/consignee', 'a'=>'list', ));?>"><i class="iconfont">&#xe625;</i><p>收件地址</p></a></li>
        <li><a href="<?php echo url(array('c'=>'mobile/review', 'a'=>'list', ));?>"><i class="iconfont">&#xe622;</i><p>我的评价</p></a></li>
      </ul>
    </div>
  </div>
  <div class="columns module mt10 cut">
    <div class="order">
      <div class="th"><a class="fr" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'list', 'order_status'=>'all', ));?>">查看全部订单<i class="iconfont">&#xe614;</i></a><i class="icon"></i><font class="f14">我的订单</font></div>
      <div class="menus cut" id="order-pending">
        <a data-pending="pay" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'list', 'pending'=>'pay', ));?>"><i class="iconfont">&#xe624;</i><p>待付款</p><em>0</em></a>
        <a data-pending="ship" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'list', 'pending'=>'ship', ));?>"><i class="iconfont">&#xe623;</i><p>待发货</p><em>0</em></a>
        <a data-pending="sign" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'list', 'pending'=>'sign', ));?>"><i class="iconfont">&#xe627;</i><p>待签收</p><em>0</em></a>
        <a data-pending="review" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'list', 'pending'=>'review', ));?>"><i class="iconfont">&#xe62c;</i><p>待评价</p><em>0</em></a>
      </div>
    </div>
    <a class="aftersales row mt10" href="<?php echo url(array('c'=>'mobile/aftersales', 'a'=>'list', ));?>">
      <span class="fl"><i class="iconfont">&#xe608;</i><font class="f14">售后服务</font></span>
      <span class="fr"><i class="iconfont">&#xe614;</i></span>
    </a>
    <a class="feedback row" href="<?php echo url(array('c'=>'mobile/feedback', 'a'=>'list', ));?>">
      <span class="fl"><i class="iconfont">&#xe634;</i><font class="f14">咨询反馈</font></span>
      <span class="fr"><i class="iconfont">&#xe614;</i></span>
    </a>
    <a class="urinfo row" href="<?php echo url(array('c'=>'mobile/user', 'a'=>'profile', ));?>">
      <span class="fl"><i class="iconfont">&#xe636;</i><font class="f14">个人设置</font></span>
      <span class="fr"><i class="iconfont">&#xe614;</i></span>
    </a>
    <a class="helper row" href="<?php echo url(array('c'=>'mobile/help', 'a'=>'index', ));?>">
      <span class="fl"><i class="iconfont">&#xe640;</i><font class="f14">帮助中心</font></span>
      <span class="fr"><i class="iconfont">&#xe614;</i></span>
    </a>
    <a class="logout row" onclick="logout()">
      <span class="fl"><i class="iconfont">&#xe63d;</i><font class="f14">退出登录</font></span>
    </a>
  </div>
</div>
<div class="footnav absmu" id="footnav">
  <a href="<?php echo url(array('c'=>'mobile/main', 'a'=>'index', ));?>"><i class="iconfont">&#xe606;</i><span>首页</span></a>
  <a href="<?php echo url(array('c'=>'mobile/category', 'a'=>'index', ));?>"><i class="iconfont">&#xe60b;</i><span>商品分类</span></a>
  <a id="cartbar" href="<?php echo url(array('c'=>'mobile/cart', 'a'=>'index', ));?>"><i class="iconfont">&#xe603;</i><span>购物车</span><em class="hide">0</em></a>
  <a class="cur"><i class="iconfont">&#xe632;</i><span>我的</span></a>
</div>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>