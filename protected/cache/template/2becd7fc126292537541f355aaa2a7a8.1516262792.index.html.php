<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE HTML>
<html>
<head>
<?php include $_view_obj->compile('mobile/default/lib/meta.html'); ?>
<meta name="keywords" content="<?php echo htmlspecialchars($GLOBALS['cfg']['home_keywords'], ENT_QUOTES, "UTF-8"); ?>" />
<meta name="description" content="<?php echo htmlspecialchars($GLOBALS['cfg']['home_description'], ENT_QUOTES, "UTF-8"); ?>" />
<title><?php echo htmlspecialchars($GLOBALS['cfg']['home_title'], ENT_QUOTES, "UTF-8"); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/iconfont/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/css/index.css" />
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['theme'], ENT_QUOTES, "UTF-8"); ?>/js/verydows.mobile.js"></script>
<script type="text/javascript">
$(function(){
  viewCartbar();
  preserveSpace('footnav');
  $('#latest').vdsTouchSlider({pernum:2});
  $('#recommend').vdsTouchSlider({pernum:2});
  $('#bargain').vdsTouchSlider({pernum:2});
});

function inSearch(){
  $('#wrapper').hide();
  $('#searcher').show();
}

function outSearch(){
  $('#searcher').hide();
  $('#wrapper').show();
}
</script>
</head>
<body>
<?php include $_view_obj->compile('mobile/default/lib/searcher.html'); ?>
<div class="wrapper" id="wrapper">
  <!-- header start -->
  <div class="header">
    <h1>Verydows</h1>
    <div class="op rt">
      <a class="pointer" href="#search" onclick="inSearch()"><i class="f22 iconfont">&#xe609;</i></a>
      <a class="pointer" href="<?php echo url(array('c'=>'mobile/user', 'a'=>'index', ));?>"><i class="f22 iconfont">&#xe60d;</i></a>
    </div>
  </div>
  <!-- header end -->
  <!-- banner start -->
  <?php echo layout_adv(array('id'=>'7', ));?>
  <!-- banner end -->
  <div class="wnav">
    <a class="news" href="<?php echo url(array('c'=>'mobile/article', 'a'=>'index', ));?>"><div><i class="iconfont">&#xe61e;</i></div><span>资讯</span></a>
    <a class="order" href="<?php echo url(array('c'=>'mobile/order', 'a'=>'list', ));?>"><div><i class="iconfont">&#xe619;</i></div><span>我的订单</span></a>
    <a class="fav" href="<?php echo url(array('c'=>'mobile/favorite', 'a'=>'list', ));?>"><div><i class="iconfont">&#xe605;</i></div><span>收藏夹</span></a>
    <a class="history" href="<?php echo url(array('c'=>'mobile/user', 'a'=>'footprint', ));?>"><div><i class="iconfont">&#xe613;</i></div><span>足迹</span></a>
  </div>
  <!-- newarrival start -->
  <div class="lateral mt8">
    <div class="th">
      <h2><i class="icon"></i><font>新品上市</font></h2>
    </div>
    <?php if (!empty($newarrival)) : ?>
    <div class="gli">
      <div class="slider" id="latest">
        <ul>
          <?php $_foreach_v_counter = 0; $_foreach_v_total = count($newarrival);?><?php foreach( $newarrival as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
          <li>
            <div class="im"><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img alt="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/150x150/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></div>
            <h3><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo truncate($v['goods_name'], 40);?></a></h3>
            <p class="price"><i>¥</i><?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></p>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="clearfix"></div>
        <div class="trigger mt5"></div>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <!-- newarrival end -->
  <!-- recommend start -->
  <div class="lateral mt8">
    <div class="th">
      <h2><i class="icon"></i><font>推荐商品</font></h2>
    </div>
    <?php if (!empty($recommend)) : ?>
    <div class="gli">
      <div class="slider" id="recommend">
        <ul>
          <?php $_foreach_v_counter = 0; $_foreach_v_total = count($recommend);?><?php foreach( $recommend as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
          <li>
            <div class="im"><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img alt="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/150x150/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></div>
            <h3><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo truncate($v['goods_name'], 40);?></a></h3>
            <p class="price"><i>¥</i><?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></p>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="clearfix"></div>
        <div class="trigger mt5"></div>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <!-- recommend end -->
  <!-- bargain start -->
  <div class="lateral mt8">
    <div class="th">
      <h2><i class="icon"></i><font>特价促销</font></h2>
    </div>
    <?php if (!empty($bargain)) : ?>
    <div class="gli">
      <div class="slider" id="bargain">
        <ul>
          <?php $_foreach_v_counter = 0; $_foreach_v_total = count($bargain);?><?php foreach( $bargain as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
          <li>
            <div class="im"><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><img alt="<?php echo htmlspecialchars($v['goods_name'], ENT_QUOTES, "UTF-8"); ?>" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/upload/goods/prime/150x150/<?php echo htmlspecialchars($v['goods_image'], ENT_QUOTES, "UTF-8"); ?>" /></a></div>
            <h3><a href="<?php echo url(array('c'=>'mobile/goods', 'a'=>'index', 'id'=>$v['goods_id'], ));?>"><?php echo truncate($v['goods_name'], 40);?></a></h3>
            <p class="price"><i>¥</i><?php echo htmlspecialchars($v['now_price'], ENT_QUOTES, "UTF-8"); ?></p>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="clearfix"></div>
        <div class="trigger mt5"></div>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <!-- bargain end -->
  <!-- footer start -->
  <div class="footer mt8">
    <div class="links">
      <a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'login', ));?>">登录</a>|
      <a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'register', ));?>">注册</a>|
      <a href="<?php echo url(array('c'=>'mobile/feedback', 'a'=>'apply', ));?>">反馈</a>
    </div>
    <div class="devices mt15">
      <a href="<?php echo url(array('c'=>'main', 'a'=>'index', 'display'=>'pc', ));?>">电脑版</a>
      <a href="<?php echo url(array('c'=>'mobile/main', 'a'=>'index', ));?>">触屏版</a>
    </div>
    <div class="copyright mt10 c999">
      <p>Copyright © 2016 Verydows.com 版权所有</p>
      <p class="powered mt8">Powered by Verydows</p>
    </div>
  </div>
  <!-- footer end -->
</div>
<div class="footnav absmu" id="footnav">
  <a class="cur"><i class="iconfont">&#xe606;</i><span>首页</span></a>
  <a href="<?php echo url(array('c'=>'mobile/category', 'a'=>'index', ));?>"><i class="iconfont">&#xe60b;</i><span>商品分类</span></a>
  <a id="cartbar" href="<?php echo url(array('c'=>'mobile/cart', 'a'=>'index', ));?>"><i class="iconfont">&#xe603;</i><span>购物车</span><em class="hide">0</em></a>
  <a href="<?php echo url(array('c'=>'mobile/user', 'a'=>'index', ));?>"><i class="iconfont">&#xe632;</i><span>我的</span></a>
</div>
<script type="text/javascript" src="<?php echo htmlspecialchars($common['baseurl'], ENT_QUOTES, "UTF-8"); ?>/public/script/juicer.js"></script>
<?php include $_view_obj->compile('mobile/default/lib/footer.html'); ?>
</body>
</html>