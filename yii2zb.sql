/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 5.6.50-log : Database - zb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`zb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `zb`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) values 
(1,'admin','f6VUYMeeqvsvms3V4vmMhjgsnmU2X8s_','$2y$13$UF/SFvvGo6kMj9l5/AvituwijMJW8LPB0pcQqElPOHi.1B3XnMHQG',NULL,'czc@czc.com',10,1533263079,1627953730);

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `fk_auth_item_295_00` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values 
('admin','1',1535077899);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `fk_auth_rule_2971_00` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values 
('/*',2,NULL,NULL,NULL,1535077629,1535077629),
('/admin/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/assignment/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/assignment/assign',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/assignment/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/assignment/revoke',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/assignment/view',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/default/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/default/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/menu/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/menu/create',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/menu/delete',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/menu/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/menu/update',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/menu/view',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/permission/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/permission/assign',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/permission/create',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/permission/delete',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/permission/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/permission/remove',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/permission/update',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/permission/view',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/role/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/role/assign',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/role/create',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/role/delete',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/role/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/role/remove',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/role/update',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/role/view',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/route/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/route/assign',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/route/create',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/route/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/route/refresh',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/route/remove',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/rule/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/rule/create',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/rule/delete',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/rule/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/rule/update',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/rule/view',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/activate',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/change-password',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/delete',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/login',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/logout',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/request-password-reset',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/reset-password',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/signup',2,NULL,NULL,NULL,1535077666,1535077666),
('/admin/user/view',2,NULL,NULL,NULL,1535077666,1535077666),
('/black/*',2,NULL,NULL,NULL,1535100792,1535100792),
('/black/create',2,NULL,NULL,NULL,1535100792,1535100792),
('/black/delete',2,NULL,NULL,NULL,1535100792,1535100792),
('/black/index',2,NULL,NULL,NULL,1535100791,1535100791),
('/black/update',2,NULL,NULL,NULL,1535100792,1535100792),
('/black/view',2,NULL,NULL,NULL,1535100792,1535100792),
('/debug/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/debug/default/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/debug/default/db-explain',2,NULL,NULL,NULL,1535077666,1535077666),
('/debug/default/download-mail',2,NULL,NULL,NULL,1535077666,1535077666),
('/debug/default/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/debug/default/toolbar',2,NULL,NULL,NULL,1535077666,1535077666),
('/debug/default/view',2,NULL,NULL,NULL,1535077666,1535077666),
('/debug/user/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/debug/user/reset-identity',2,NULL,NULL,NULL,1535077666,1535077666),
('/debug/user/set-identity',2,NULL,NULL,NULL,1535077666,1535077666),
('/favorite/*',2,NULL,NULL,NULL,1535100570,1535100570),
('/favorite/create',2,NULL,NULL,NULL,1535100570,1535100570),
('/favorite/delete',2,NULL,NULL,NULL,1535100570,1535100570),
('/favorite/index',2,NULL,NULL,NULL,1535100570,1535100570),
('/favorite/update',2,NULL,NULL,NULL,1535100570,1535100570),
('/favorite/view',2,NULL,NULL,NULL,1535100570,1535100570),
('/gii/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/gii/default/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/gii/default/action',2,NULL,NULL,NULL,1535077666,1535077666),
('/gii/default/diff',2,NULL,NULL,NULL,1535077666,1535077666),
('/gii/default/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/gii/default/preview',2,NULL,NULL,NULL,1535077666,1535077666),
('/gii/default/view',2,NULL,NULL,NULL,1535077666,1535077666),
('/invite-code-type/*',2,NULL,NULL,NULL,1537318992,1537318992),
('/invite-code-type/create',2,NULL,NULL,NULL,1537318992,1537318992),
('/invite-code-type/delete',2,NULL,NULL,NULL,1537318992,1537318992),
('/invite-code-type/index',2,NULL,NULL,NULL,1537318992,1537318992),
('/invite-code-type/update',2,NULL,NULL,NULL,1537318992,1537318992),
('/invite-code-type/view',2,NULL,NULL,NULL,1537318992,1537318992),
('/invite-code/*',2,NULL,NULL,NULL,1535335689,1535335689),
('/invite-code/create',2,NULL,NULL,NULL,1535335689,1535335689),
('/invite-code/delete',2,NULL,NULL,NULL,1535335689,1535335689),
('/invite-code/index',2,NULL,NULL,NULL,1535335689,1535335689),
('/invite-code/update',2,NULL,NULL,NULL,1535335689,1535335689),
('/invite-code/view',2,NULL,NULL,NULL,1535335689,1535335689),
('/settings/*',2,NULL,NULL,NULL,1535505000,1535505000),
('/settings/default/*',2,NULL,NULL,NULL,1535505000,1535505000),
('/settings/default/create',2,NULL,NULL,NULL,1535505000,1535505000),
('/settings/default/delete',2,NULL,NULL,NULL,1535505000,1535505000),
('/settings/default/index',2,NULL,NULL,NULL,1535504999,1535504999),
('/settings/default/toggle',2,NULL,NULL,NULL,1535504999,1535504999),
('/settings/default/update',2,NULL,NULL,NULL,1535505000,1535505000),
('/settings/default/view',2,NULL,NULL,NULL,1535504999,1535504999),
('/site/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/site/change-password',2,NULL,NULL,NULL,1535088226,1535088226),
('/site/error',2,NULL,NULL,NULL,1535077666,1535077666),
('/site/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/site/login',2,NULL,NULL,NULL,1535077666,1535077666),
('/site/logout',2,NULL,NULL,NULL,1535077666,1535077666),
('/user/*',2,NULL,NULL,NULL,1535077666,1535077666),
('/user/create',2,NULL,NULL,NULL,1535077666,1535077666),
('/user/delete',2,NULL,NULL,NULL,1535077666,1535077666),
('/user/index',2,NULL,NULL,NULL,1535077666,1535077666),
('/user/update',2,NULL,NULL,NULL,1535077666,1535077666),
('/user/view',2,NULL,NULL,NULL,1535077666,1535077666),
('/zb-lists/*',2,NULL,NULL,NULL,1535101633,1535101633),
('/zb-lists/create',2,NULL,NULL,NULL,1535101633,1535101633),
('/zb-lists/delete',2,NULL,NULL,NULL,1535101633,1535101633),
('/zb-lists/index',2,NULL,NULL,NULL,1535101633,1535101633),
('/zb-lists/update',2,NULL,NULL,NULL,1535101633,1535101633),
('/zb-lists/view',2,NULL,NULL,NULL,1535101633,1535101633),
('/zb-plants/*',2,NULL,NULL,NULL,1535101634,1535101634),
('/zb-plants/create',2,NULL,NULL,NULL,1535101634,1535101634),
('/zb-plants/delete',2,NULL,NULL,NULL,1535101634,1535101634),
('/zb-plants/index',2,NULL,NULL,NULL,1535101633,1535101633),
('/zb-plants/update',2,NULL,NULL,NULL,1535101634,1535101634),
('/zb-plants/view',2,NULL,NULL,NULL,1535101634,1535101634),
('admin',1,NULL,NULL,NULL,1535077855,1535077855);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `fk_auth_item_3002_00` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_auth_item_3002_01` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values 
('admin','/*');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_rule` */

/*Table structure for table `black` */

DROP TABLE IF EXISTS `black`;

CREATE TABLE `black` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `black` */

/*Table structure for table `favorite` */

DROP TABLE IF EXISTS `favorite`;

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `xianlu` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `favorite` */

/*Table structure for table `invite_code` */

DROP TABLE IF EXISTS `invite_code`;

CREATE TABLE `invite_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(32) NOT NULL COMMENT '邀请码',
  `status` tinyint(4) NOT NULL COMMENT '邀请码是否过期，0为没过期，1为已过期',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '邀请码类型',
  PRIMARY KEY (`id`),
  KEY `invite_code_id_type` (`type`),
  CONSTRAINT `fk_invite_code_type_3146_00` FOREIGN KEY (`type`) REFERENCES `invite_code_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `invite_code` */

/*Table structure for table `invite_code_type` */

DROP TABLE IF EXISTS `invite_code_type`;

CREATE TABLE `invite_code_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '类型名称',
  `duration` int(11) NOT NULL COMMENT '天数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `invite_code_type` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `fk_menu_3182_00` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`parent`,`route`,`order`,`data`) values 
(1,'权限相关',NULL,NULL,10,'{\\\"icon\\\":\\\"gears\\\"}'),
(2,'权限分配',1,'/admin/assignment/index',NULL,'{\\\"icon\\\":\\\"arrows-alt\\\"}'),
(3,'权限管理',1,'/admin/permission/index',NULL,'{\\\"icon\\\":\\\"sitemap\\\"}'),
(4,'菜单管理',1,'/admin/menu/index',NULL,'{\\\"icon\\\":\\\"tasks\\\"}'),
(5,'规则管理',1,'/admin/rule/index',NULL,'{\\\"icon\\\":\\\"plug\\\"}'),
(6,'角色管理',1,'/admin/role/index',NULL,'{\\\"icon\\\":\\\"user-circle\\\"}'),
(7,'路由管理',1,'/admin/route/index',NULL,'{\\\"icon\\\":\\\"link\\\"}'),
(8,'用户管理',NULL,'/user/index',1,'{\\\"icon\\\":\\\"user-o\\\"}'),
(9,'收藏管理',NULL,'/favorite/index',2,'{\\\"icon\\\":\\\"star\\\"}'),
(10,'黑名单管理',NULL,'/black/index',3,'{\\\"icon\\\":\\\"close\\\"}'),
(11,'平台管理',NULL,'/zb-plants/index',4,'{\\\"icon\\\":\\\"youtube-play\\\"}'),
(12,'主播管理',NULL,'/zb-lists/index',5,'{\\\"icon\\\":\\\"video-camera\\\"}'),
(13,'邀请码管理',NULL,'/invite-code/index',6,'{\\\"icon\\\":\\\"envelope\\\"}'),
(14,'设置',NULL,'/settings/default/index',7,'{\\\"icon\\\":\\\"cog\\\"}'),
(15,'邀请码类型管理',NULL,'/invite-code-type/index',6,NULL);

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text,
  `active` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_unique_key_section` (`section`,`key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `settings` */

insert  into `settings`(`id`,`type`,`section`,`key`,`value`,`active`,`created`,`modified`) values 
(1,'integer','global','days','31',1,'2018-08-29 09:11:03','2018-08-29 09:11:50'),
(2,'integer','global','free_time','900',1,'2018-08-31 17:16:53',NULL),
(3,'integer','global','default_xianlu','1',1,'2021-08-03 09:21:19',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `type` tinyint(4) DEFAULT '0',
  `expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`,`type`,`expire_at`) values 
(1,'admin','XXKLNub83SRd74-zP3594h_bVHXFdNPb','$2y$13$wLEuTYvfniihclZ07r8xZO4D7iJsK5KF8NH/nkt.LgmbB7JixtfA2',NULL,'admin@admin.com',10,1627282011,1627282011,0,'2100-01-01 15:01:00');

/*Table structure for table `zb_lists` */

DROP TABLE IF EXISTS `zb_lists`;

CREATE TABLE `zb_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plant_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `img` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plant_id` (`plant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=343 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `zb_plants` */

DROP TABLE IF EXISTS `zb_plants`;

CREATE TABLE `zb_plants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(50) NOT NULL,
  `xinimg` varchar(500) NOT NULL,
  `title` varchar(200) NOT NULL,
  `xianlu` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=398 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
