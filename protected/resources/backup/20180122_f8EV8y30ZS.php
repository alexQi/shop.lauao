# -------------------------------------------------------------
# <?php die();?>
# Verydows Database Backup
# Program: Verydows 2.0 Release 20161112
# MySql: 5.6.38 
# Database: akmall 
# Creation: 2018-01-22 22:34:21
# Official: http://www.verydows.com
# -------------------------------------------------------------

DROP TABLE IF EXISTS `akmall_admin`;
CREATE TABLE `akmall_admin` (
  `user_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(16) NOT NULL,
  `password` char(32) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `last_ip` char(15) NOT NULL DEFAULT '',
  `last_date` int(10) unsigned NOT NULL DEFAULT '0',
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  `hash` char(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_admin` VALUES
('1','admin','d592ab1ec0350cc4aa23c77df2a3eda7','','514438556@qq.com','127.0.0.1','1516630732','1516264119','d655fafc6eeaff1eea20fe4444aa5e38e80dcfa2');


DROP TABLE IF EXISTS `akmall_admin_active`;
CREATE TABLE `akmall_admin_active` (
  `sess_id` char(32) NOT NULL DEFAULT '',
  `user_id` smallint(5) unsigned NOT NULL,
  `ip` char(15) NOT NULL DEFAULT '0.0.0.0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `expires` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`sess_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `akmall_admin_active` VALUES
('eje9tdmqdro97dml4mid5io2cu','1','127.0.0.1','1516630732','1516632398');


DROP TABLE IF EXISTS `akmall_admin_role`;
CREATE TABLE `akmall_admin_role` (
  `user_id` smallint(5) unsigned NOT NULL,
  `role_id` smallint(5) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_adv`;
CREATE TABLE `akmall_adv` (
  `adv_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `position_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `type` char(5) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `codes` text NOT NULL,
  `start_date` int(10) unsigned NOT NULL DEFAULT '0',
  `end_date` int(10) unsigned NOT NULL DEFAULT '0',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '99',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`adv_id`),
  KEY `position_id` (`position_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_adv_position`;
CREATE TABLE `akmall_adv_position` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `codes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_aftersales`;
CREATE TABLE `akmall_aftersales` (
  `as_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `order_id` char(15) NOT NULL DEFAULT '',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goods_qty` smallint(5) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `cause` text NOT NULL,
  `mobile` char(11) NOT NULL DEFAULT '',
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`as_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_aftersales_message`;
CREATE TABLE `akmall_aftersales_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `as_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `admin_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `as_id` (`as_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_article`;
CREATE TABLE `akmall_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(180) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `brief` varchar(240) NOT NULL DEFAULT '',
  `meta_keywords` varchar(240) NOT NULL DEFAULT '',
  `meta_description` varchar(240) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cate_id` (`cate_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_article_cate`;
CREATE TABLE `akmall_article_cate` (
  `cate_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(60) NOT NULL,
  `meta_keywords` varchar(240) NOT NULL DEFAULT '',
  `meta_description` varchar(240) NOT NULL DEFAULT '',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '99',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_brand`;
CREATE TABLE `akmall_brand` (
  `brand_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(60) NOT NULL DEFAULT '',
  `brand_logo` varchar(255) NOT NULL DEFAULT '',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '99',
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_brand` VALUES
('1','自产商品','','99');


DROP TABLE IF EXISTS `akmall_email_queue`;
CREATE TABLE `akmall_email_queue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL DEFAULT '',
  `tpl_id` char(30) NOT NULL DEFAULT '',
  `subject` varchar(240) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `is_html` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `last_err` varchar(255) NOT NULL DEFAULT '',
  `err_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_email_subscription`;
CREATE TABLE `akmall_email_subscription` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL DEFAULT '',
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_email_template`;
CREATE TABLE `akmall_email_template` (
  `id` char(30) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `subject` varchar(240) NOT NULL DEFAULT '',
  `is_html` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `akmall_email_template` VALUES
('email_captcha','邮箱验证码','验证码','1');


DROP TABLE IF EXISTS `akmall_feedback`;
CREATE TABLE `akmall_feedback` (
  `fb_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(120) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `mobile` char(11) NOT NULL DEFAULT '',
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fb_id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_feedback_message`;
CREATE TABLE `akmall_feedback_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fb_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `admin_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fb_id` (`fb_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_friendlink`;
CREATE TABLE `akmall_friendlink` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_goods`;
CREATE TABLE `akmall_goods` (
  `goods_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(180) NOT NULL DEFAULT '',
  `goods_sn` char(20) NOT NULL DEFAULT '',
  `now_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `original_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `goods_image` varchar(30) NOT NULL DEFAULT '',
  `goods_brief` text NOT NULL,
  `goods_content` text NOT NULL,
  `goods_weight` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `stock_qty` smallint(4) unsigned NOT NULL DEFAULT '0',
  `meta_keywords` varchar(240) NOT NULL DEFAULT '',
  `meta_description` varchar(240) NOT NULL DEFAULT '',
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  `newarrival` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bargain` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`),
  KEY `cate_id` (`cate_id`),
  FULLTEXT KEY `indexing` (`goods_name`,`meta_keywords`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_goods` VALUES
('1','2','1','火龙果','1111','10.00','20.00','945a65ec9025236.jpg','<h3 class=\"tb-main-title\" data-title=\"越南红心火龙果2个(大果)410g以上/个 新鲜水果\" data-spm-anchor-id=\"2013.1.iteminfo.i0.5ee7facciD6aVz\" style=\"font-size: 16px; min-height: 21px; line-height: 21px; color: rgb(60, 60, 60); font-family: tahoma, arial, &quot;Hiragino Sans GB&quot;, 宋体, sans-serif; white-space: normal;\">越南红心火龙果2个(大果)410g以上/个 新鲜水果</h3><p><br/></p>','<p><img alt=\"红心火龙果1\" src=\"https://img.alicdn.com/imgextra/i1/2674240726/TB2Wt4WnxTI8KJjSspiXXbM4FXa_!!2674240726.jpg\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"红心火龙果2\" src=\"https://img.alicdn.com/imgextra/i1/2674240726/TB2MySinDnI8KJjSszbXXb4KFXa_!!2674240726.jpg\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"红心火龙果3\" src=\"https://img.alicdn.com/imgextra/i3/2674240726/TB2zy17nv6H8KJjy0FjXXaXepXa_!!2674240726.jpg\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"红心火龙果4\" src=\"https://img.alicdn.com/imgextra/i4/2674240726/TB2X6LanvDH8KJjy1XcXXcpdXXa_!!2674240726.jpg\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"红心火龙果5\" src=\"https://img.alicdn.com/imgextra/i3/2674240726/TB2bFLnnwDD8KJjy0FdXXcjvXXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"红心火龙果6\" src=\"https://img.alicdn.com/imgextra/i2/2674240726/TB26NR_nDTI8KJjSsphXXcFppXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"红心火龙果7\" src=\"https://img.alicdn.com/imgextra/i4/2674240726/TB2M_ivnsnI8KJjSspeXXcwIpXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"红心火龙果8\" src=\"https://img.alicdn.com/imgextra/i3/2674240726/TB23Z8WnCYH8KJjSspdXXcRgVXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"红心火龙果9\" src=\"https://img.alicdn.com/imgextra/i3/2674240726/TB2m5SinDnI8KJjSszbXXb4KFXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"红心火龙果10\" src=\"https://img.alicdn.com/imgextra/i3/2674240726/TB27bmrnC_I8KJjy0FoXXaFnVXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"undefined\" src=\"https://img.alicdn.com/imgextra/i2/2674240726/TB2S8N7ntzJ8KJjSspkXXbF7VXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"undefined\" src=\"https://img.alicdn.com/imgextra/i1/2674240726/TB2nrqrnC_I8KJjy0FoXXaFnVXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"undefined\" src=\"https://img.alicdn.com/imgextra/i3/2674240726/TB2xTmvnsnI8KJjSspeXXcwIpXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"undefined\" src=\"https://img.alicdn.com/imgextra/i4/2674240726/TB2anmvnsnI8KJjSspeXXcwIpXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"undefined\" src=\"https://img.alicdn.com/imgextra/i2/2674240726/TB2FurynrYI8KJjy0FaXXbAiVXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/><br style=\"color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal;\"/><img alt=\"undefined\" src=\"https://img.alicdn.com/imgextra/i4/2674240726/TB2jMpVnwvD8KJjSsplXXaIEFXa_!!2674240726.jpg\" class=\"\" style=\"border: 0px; vertical-align: top; color: rgb(0, 0, 0); font-family: tahoma, arial, 宋体, sans-serif; font-size: 14px; white-space: normal; width: 750px;\"/></p>','0.00','9998','','','1516629545','1','1','1','1');


DROP TABLE IF EXISTS `akmall_goods_album`;
CREATE TABLE `akmall_goods_album` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) unsigned NOT NULL,
  `image` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_goods_attr`;
CREATE TABLE `akmall_goods_attr` (
  `goods_id` mediumint(8) unsigned NOT NULL,
  `attr_id` mediumint(8) NOT NULL,
  `value` varchar(160) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_goods_cate`;
CREATE TABLE `akmall_goods_cate` (
  `cate_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `cate_name` varchar(60) NOT NULL DEFAULT '',
  `meta_keywords` varchar(240) NOT NULL DEFAULT '',
  `meta_description` varchar(240) NOT NULL DEFAULT '',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '99',
  PRIMARY KEY (`cate_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_goods_cate` VALUES
('1','0','蔬菜','蔬菜，新鲜蔬菜','安康市最新鲜的蔬菜','99'),
('2','0','水果','','','99');


DROP TABLE IF EXISTS `akmall_goods_cate_attr`;
CREATE TABLE `akmall_goods_cate_attr` (
  `attr_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL DEFAULT '',
  `opts` text NOT NULL,
  `uom` varchar(20) NOT NULL DEFAULT '',
  `filtrate` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '99',
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_goods_cate_brand`;
CREATE TABLE `akmall_goods_cate_brand` (
  `cate_id` smallint(5) unsigned NOT NULL,
  `brand_id` smallint(5) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_goods_optional`;
CREATE TABLE `akmall_goods_optional` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `opt_text` varchar(80) NOT NULL DEFAULT '',
  `opt_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_goods_optional` VALUES
('11','4','1','两斤装','10.00'),
('10','4','1','五斤装','20.00');


DROP TABLE IF EXISTS `akmall_goods_optional_type`;
CREATE TABLE `akmall_goods_optional_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_goods_optional_type` VALUES
('4','套餐');


DROP TABLE IF EXISTS `akmall_goods_related`;
CREATE TABLE `akmall_goods_related` (
  `goods_id` mediumint(8) NOT NULL,
  `related_id` mediumint(8) NOT NULL,
  `direction` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`goods_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_goods_review`;
CREATE TABLE `akmall_goods_review` (
  `review_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` char(15) NOT NULL DEFAULT '',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rating` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `replied` text NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `goods_id` (`goods_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_help`;
CREATE TABLE `akmall_help` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `meta_keywords` varchar(240) NOT NULL DEFAULT '',
  `meta_description` varchar(240) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cate_id` (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_help_cate`;
CREATE TABLE `akmall_help_cate` (
  `cate_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(60) NOT NULL DEFAULT '',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_navigation`;
CREATE TABLE `akmall_navigation` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `position` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `target` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '99',
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_oauth`;
CREATE TABLE `akmall_oauth` (
  `party` char(10) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL,
  `params` text NOT NULL,
  `instruction` varchar(240) NOT NULL DEFAULT '',
  `enable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`party`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `akmall_oauth` VALUES
('qq','腾讯QQ','{\"app_id\":\"\",\"app_key\":\"\"}','QQ互联开放平台为第三方网站提供了丰富的API。第三方网站接入QQ互联开放平台后，即可通过调用平台提供的API实现用户使用QQ帐号登录网站功能，且可以获取到腾讯QQ用户的相关信息。','1'),
('weibo','新浪微博','{\"app_key\":\"\",\"app_secret\":\"\"}','网站接入是微博针对第三方网站提供的社会化网络接入方案。接入微连接让您的网站支持用微博帐号登录，基于OAuth2.0协议，使用微博 Open API 进行开发， 即可用微博帐号登录你的网站， 让你的网站降低新用户注册成本，快速获取大量用户。','1');


DROP TABLE IF EXISTS `akmall_order`;
CREATE TABLE `akmall_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` char(15) NOT NULL DEFAULT '',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `shipping_method` smallint(5) unsigned NOT NULL DEFAULT '0',
  `payment_method` smallint(5) unsigned NOT NULL DEFAULT '0',
  `order_status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `goods_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `shipping_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `order_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `memos` varchar(240) NOT NULL DEFAULT '',
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  `payment_date` int(10) unsigned NOT NULL DEFAULT '0',
  `thirdparty_trade_id` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_order` VALUES
('1','118110003333835','1','1','0','1','20.00','0.00','20.00','','1516629993','0','');


DROP TABLE IF EXISTS `akmall_order_consignee`;
CREATE TABLE `akmall_order_consignee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` char(15) NOT NULL DEFAULT '',
  `receiver` varchar(20) NOT NULL DEFAULT '',
  `province` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(20) NOT NULL DEFAULT '',
  `borough` varchar(20) NOT NULL DEFAULT '',
  `address` varchar(240) NOT NULL DEFAULT '',
  `zip` char(6) NOT NULL DEFAULT '',
  `mobile` char(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_order_consignee` VALUES
('1','118110003333835','111','天津市','市辖区','南开区','111','725004','18368182313');


DROP TABLE IF EXISTS `akmall_order_goods`;
CREATE TABLE `akmall_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` char(15) NOT NULL DEFAULT '',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(180) NOT NULL DEFAULT '',
  `goods_image` varchar(30) NOT NULL DEFAULT '',
  `goods_qty` smallint(5) NOT NULL DEFAULT '1',
  `goods_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `is_reviewed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_order_goods` VALUES
('1','118110003333835','1','火龙果','945a65ec9025236.jpg','1','20.00','0');


DROP TABLE IF EXISTS `akmall_order_goods_optional`;
CREATE TABLE `akmall_order_goods_optional` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `map_id` int(10) unsigned NOT NULL DEFAULT '0',
  `opt_id` int(10) unsigned NOT NULL DEFAULT '0',
  `opt_type` varchar(20) NOT NULL DEFAULT '',
  `opt_text` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_order_goods_optional` VALUES
('1','1','11','套餐','两斤装');


DROP TABLE IF EXISTS `akmall_order_log`;
CREATE TABLE `akmall_order_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` char(15) NOT NULL DEFAULT '',
  `admin_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `operate` char(10) NOT NULL,
  `cause` varchar(240) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_order_shipping`;
CREATE TABLE `akmall_order_shipping` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` char(15) NOT NULL DEFAULT '',
  `carrier_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tracking_no` varchar(20) NOT NULL DEFAULT '',
  `memos` varchar(240) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_payment_method`;
CREATE TABLE `akmall_payment_method` (
  `id` tinyint(3) unsigned NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pcode` varchar(20) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `instruction` varchar(240) NOT NULL DEFAULT '',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '99',
  `enable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `akmall_payment_method` VALUES
('1','余额支付','0','balance','[\"\"]','','2','1'),
('2','货到付款','1','cod','[\"\"]','','3','1'),
('3','支付宝','0','alipay','{\"seller\":\"\",\"partner\":\"\",\"key\":\"\"}','','1','1'),
('0','微信','0','wechat','','','4','1');


DROP TABLE IF EXISTS `akmall_request_error`;
CREATE TABLE `akmall_request_error` (
  `ip` char(15) NOT NULL DEFAULT '0.0.0.0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `count` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `lockout` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ip`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `akmall_request_error` VALUES
('127.0.0.1','1516204800','3','0'),
('127.0.0.1','1516550400','3','0');


DROP TABLE IF EXISTS `akmall_role`;
CREATE TABLE `akmall_role` (
  `role_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL DEFAULT '',
  `role_desc` varchar(240) NOT NULL DEFAULT '',
  `role_acl` text NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_sendmail_limit`;
CREATE TABLE `akmall_sendmail_limit` (
  `ip` char(15) NOT NULL DEFAULT '',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` char(30) NOT NULL DEFAULT '',
  `count` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_setting`;
CREATE TABLE `akmall_setting` (
  `sk` varchar(30) NOT NULL,
  `sv` text NOT NULL,
  PRIMARY KEY (`sk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `akmall_setting` VALUES
('site_name',''),
('home_title','Lauao 商城系统'),
('home_keywords',''),
('home_description',''),
('footer_info',''),
('goods_search_per_num','20'),
('upload_filetype','.jpg|.jpeg|.gif|.png|.bmp|.swf|.flv|.avi|.rmvb'),
('upload_filesize','2MB'),
('captcha_admin_login','2'),
('captcha_user_login','2'),
('captcha_user_register','1'),
('captcha_feedback','1'),
('smtp_server','smtp.163.com'),
('smtp_user','test@163.com'),
('smtp_password',''),
('smtp_port','25'),
('smtp_secure',''),
('admin_mult_ip_login','0'),
('upload_goods_filesize','300KB'),
('visitor_stats','0'),
('goods_hot_searches',''),
('cate_goods_per_num','20'),
('goods_history_num','5'),
('goods_related_num','5'),
('goods_review_per_num','10'),
('upload_goods_filetype','.jpg|.png|.gif'),
('show_goods_stock','0'),
('order_cancel_expires','2'),
('goods_img_thumb','[{\"w\":350,\"h\":350},{\"w\":150,\"h\":150},{\"w\":100,\"h\":100},{\"w\":50,\"h\":50}]'),
('goods_album_thumb','[{\"w\":350,\"h\":350},{\"w\":50,\"h\":50}]'),
('enabled_theme','default'),
('user_consignee_limits','15'),
('upload_avatar_filesize','200KB'),
('order_delivery_expires','7'),
('user_register_email_verify','0'),
('user_review_approve','0'),
('rewrite_enable','1'),
('data_cache_lifetime','0'),
('goods_fulltext_query','0'),
('debug','0'),
('rewrite_rule','{\"m\\/pay\\/return\\/<pcode>.html\":\"mobile\\/pay\\/return\",\"pay\\/return\\/<pcode>.html\":\"pay\\/return\",\"api\\/pay\\/notify\\/<pcode>\":\"api\\/pay\\/notify\",\"api\\/oauth\\/callback\\/<party>\":\"api\\/oauth\\/callback\",\"m\\/index.html\":\"mobile\\/main\\/index\",\"m\\/<c>\\/<a>.html\":\"mobile\\/<c>\\/<a>\",\"api\\/<c>\\/<a>\":\"api\\/<c>\\/<a>\",\"404.html\":\"main\\/404\",\"index.html\":\"main\\/index\",\"<c>\\/<a>.html\":\"<c>\\/<a>\"}'),
('encrypt_key','');


DROP TABLE IF EXISTS `akmall_shipping_carrier`;
CREATE TABLE `akmall_shipping_carrier` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `tracking_url` varchar(255) NOT NULL DEFAULT '',
  `service_tel` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_shipping_method`;
CREATE TABLE `akmall_shipping_method` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `instruction` varchar(240) NOT NULL DEFAULT '',
  `seq` tinyint(2) unsigned NOT NULL DEFAULT '99',
  `enable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_shipping_method` VALUES
('1','普通快递','{\"0\":{\"type\":\"fixed\",\"area\":\"0\",\"charges\":\"0\"}}','全国范围免邮','1','1');


DROP TABLE IF EXISTS `akmall_user`;
CREATE TABLE `akmall_user` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(16) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `mobile` char(11) NOT NULL DEFAULT '',
  `avatar` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `email_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `mobile_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_user` VALUES
('1','qiubo','d592ab1ec0350cc4aa23c77df2a3eda7','alex.qiubo@qq.com','','','0','0','0');


DROP TABLE IF EXISTS `akmall_user_account`;
CREATE TABLE `akmall_user_account` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `balance` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `points` int(10) unsigned NOT NULL DEFAULT '0',
  `exp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `akmall_user_account` VALUES
('1','0.00','0','0');


DROP TABLE IF EXISTS `akmall_user_account_log`;
CREATE TABLE `akmall_user_account_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `admin_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `points` int(10) unsigned NOT NULL DEFAULT '0',
  `exp` int(10) unsigned NOT NULL DEFAULT '0',
  `cause` varchar(255) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_user_consignee`;
CREATE TABLE `akmall_user_consignee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `receiver` varchar(20) NOT NULL DEFAULT '',
  `province` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `city` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `borough` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `address` varchar(240) NOT NULL DEFAULT '',
  `zip` char(6) NOT NULL DEFAULT '',
  `mobile` char(11) NOT NULL DEFAULT '',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_user_consignee` VALUES
('1','1','111','2','1','4','111','725004','18368182313','0');


DROP TABLE IF EXISTS `akmall_user_favorite`;
CREATE TABLE `akmall_user_favorite` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goods_id` mediumint(8) unsigned NOT NULL,
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`goods_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_user_group`;
CREATE TABLE `akmall_user_group` (
  `group_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(60) NOT NULL,
  `min_exp` int(10) unsigned NOT NULL DEFAULT '0',
  `discount_rate` tinyint(3) unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `akmall_user_group` VALUES
('1','初级会员','0','100'),
('2','中级会员','2000','100'),
('3','高级会员','7000','100');


DROP TABLE IF EXISTS `akmall_user_oauth`;
CREATE TABLE `akmall_user_oauth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `party` char(10) NOT NULL DEFAULT '',
  `oauth_key` char(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `akmall_user_profile`;
CREATE TABLE `akmall_user_profile` (
  `user_id` mediumint(8) unsigned NOT NULL,
  `nickname` varchar(30) NOT NULL DEFAULT '',
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `birth_year` smallint(4) unsigned NOT NULL DEFAULT '0',
  `birth_month` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `birth_day` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `qq` varchar(15) NOT NULL DEFAULT '',
  `signature` varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `akmall_user_profile` VALUES
('1','','0','0','0','0','','');


DROP TABLE IF EXISTS `akmall_user_record`;
CREATE TABLE `akmall_user_record` (
  `user_id` mediumint(8) unsigned NOT NULL,
  `created_date` int(10) unsigned NOT NULL DEFAULT '0',
  `created_ip` char(15) NOT NULL DEFAULT '0.0.0.0',
  `last_date` int(10) unsigned NOT NULL DEFAULT '0',
  `last_ip` char(15) NOT NULL DEFAULT '0.0.0.0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `akmall_user_record` VALUES
('1','1516629375','127.0.0.1','1516629410','127.0.0.1');


DROP TABLE IF EXISTS `akmall_visitor_stats`;
CREATE TABLE `akmall_visitor_stats` (
  `sessid` char(32) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '0.0.0.0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `pv` smallint(5) unsigned NOT NULL DEFAULT '1',
  `referrer` varchar(80) NOT NULL DEFAULT '',
  `browser` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `platform` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `area` char(10) NOT NULL DEFAULT '',
  KEY `sessid` (`sessid`) USING BTREE,
  KEY `ip` (`ip`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `akmall_visitor_stats` VALUES
('450844b0e544cb5654e6a7e0d5b0b739','117.37.146.126','1516204800','61','shop.lauao.test','2','2','陕西省西安市'),
('e49e43e4e71a7b253d056255e401c019','1.84.246.99','1516550400','134','shop.lauao.test','2','2','陕西省西安市');


