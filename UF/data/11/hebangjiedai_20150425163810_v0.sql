/* This file is created by DBReback 1429951090 */ 
 /* 数据表结构 `lzh_ad`*/ 
 DROP TABLE IF EXISTS `lzh_ad`;/* DBReback Separation */ 
 CREATE TABLE `lzh_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(5000) NOT NULL,
  `start_time` int(10) NOT NULL,
  `end_time` int(10) NOT NULL,
  `add_time` int(10) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `ad_type` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `lzh_ad` */
 INSERT INTO `lzh_ad` VALUES ('1','<h2><img style=\"margin: 0px; float: none;\" alt=\"\" src=\"/UF/Uploads/Article/20150424230205.png\" /></h2>','1357660800','1391097600','1357715233','首页LOGO图片（推荐LOGO图片大小：220*65像素）','0');/* DBReback Separation */
 /* 插入数据 `lzh_ad` */
 INSERT INTO `lzh_ad` VALUES ('2','','1357660800','1391097600','1357715437','首页顶部中间广告条（尺寸大小：485*65像素）','0');/* DBReback Separation */
 /* 插入数据 `lzh_ad` */
 INSERT INTO `lzh_ad` VALUES ('3','<img style=\"height: 82px; width: 307px; float: none; margin: 0px;\" alt=\"\" src=\"/UF/Uploads/Article/20140312181036.gif\" />','1357660800','1522339200','1357715509','首页顶部联系电话图片（推荐尺寸大小：225*65像素）','0');/* DBReback Separation */
 /* 插入数据 `lzh_ad` */
 INSERT INTO `lzh_ad` VALUES ('4','a:3:{i:0;a:3:{s:3:\"img\";s:35:\"UF/Uploads/Ad/20150424230542142.jpg\";s:4:\"info\";s:0:\"\";s:3:\"url\";s:0:\"\";}i:1;a:3:{s:3:\"img\";s:35:\"UF/Uploads/Ad/20150424230532396.jpg\";s:4:\"info\";s:0:\"\";s:3:\"url\";s:0:\"\";}i:2;a:3:{s:3:\"img\";s:35:\"UF/Uploads/Ad/20140427145953825.jpg\";s:4:\"info\";s:0:\"\";s:3:\"url\";s:0:\"\";}}','1357660800','1391097600','1357715551','首页幻灯片展示','1');/* DBReback Separation */
 /* 插入数据 `lzh_ad` */
 INSERT INTO `lzh_ad` VALUES ('6','<img style=\"margin: 0px; width: 980px; float: none; height: 320px\" alt=\"\" src=\"/UF/Uploads/Article/20130812220516.jpg\" />','1365436800','1397750400','1367025431','顶部滑动图片','0');/* DBReback Separation */
 /* 插入数据 `lzh_ad` */
 INSERT INTO `lzh_ad` VALUES ('5','<img style=\"margin: 0px; float: none\" alt=\"\" src=\"/UF/Uploads/Article/20131104142419.jpg\" />','1357660800','1393516800','1357716501','内页中上部大广告位','0');/* DBReback Separation */
 /* 插入数据 `lzh_ad` */
 INSERT INTO `lzh_ad` VALUES ('7','a:2:{i:0;a:3:{s:3:\"img\";s:35:\"UF/Uploads/Ad/20140623145226374.jpg\";s:4:\"info\";s:0:\"\";s:3:\"url\";s:0:\"\";}i:1;a:3:{s:3:\"img\";s:35:\"UF/Uploads/Ad/20140623145230878.jpg\";s:4:\"info\";s:0:\"\";s:3:\"url\";s:0:\"\";}}','1384185600','1478880000','1384250443','积分商城','1');/* DBReback Separation */
 /* 插入数据 `lzh_ad` */
 INSERT INTO `lzh_ad` VALUES ('8','<h2>联系我们</h2><p><span class=\"le\"><img width=\"13\" height=\"13\" style=\"height: 13px; width: 13px; float: none; margin: 0px;\" src=\"/UF/Uploads/Article/20140503152613.jpg\" /></span>菏泽市中华路金鼎凤凰城A栋417</p><p><span class=\"le\"><img width=\"13\" height=\"12\" style=\"height: 12px; width: 13px; float: none; margin: 0px;\" src=\"/UF/Uploads/Article/20140503152657.jpg\" /></span>400-5000-600</p><p><span class=\"le\"><img width=\"13\" height=\"13\" style=\"height: 13px; width: 13px; float: none; margin: 0px;\" src=\"/UF/Uploads/Article/20140503152736.jpg\" /></span>E-mail:3490766@qq.com</p>','0','0','1399102061','首页底部之联系我们','0');/* DBReback Separation */
 /* 插入数据 `lzh_ad` */
 INSERT INTO `lzh_ad` VALUES ('9','<h2>客服电话</h2><p><strong>400-050-0207</strong></p><br /><p>9:00-21:00</p>','0','0','1399102260','首页底部之客服电话','0');/* DBReback Separation */