/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : idea

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-09-21 17:35:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pro_idea`
-- ----------------------------
DROP TABLE IF EXISTS `pro_idea`;
CREATE TABLE `pro_idea` (
  `id` char(18) NOT NULL COMMENT 'id',
  `title` varchar(55) DEFAULT NULL COMMENT '标题',
  `content` mediumtext NOT NULL COMMENT '内容',
  `uid` char(18) NOT NULL,
  `pid` char(18) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uid` (`uid`) USING BTREE,
  KEY `idx_create_time` (`create_time`) USING BTREE,
  KEY `idx_pid` (`pid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pro_idea
-- ----------------------------
INSERT INTO `pro_idea` VALUES ('237245b976ea1a50a0', 'hello', 'hello,我有一个很好的idea', '165395b9719c0e7b08', '0', '1536650913', '1536650913', null);
INSERT INTO `pro_idea` VALUES ('648165b9777052af80', 'this another idea', '123', '165395b9719c0e7b08', '0', '1536653061', '1536654128', null);
INSERT INTO `pro_idea` VALUES ('616245ba357ccb5658', '123', '321', '165395b9719c0e7b08', '0', '1537431500', '1537431500', null);
INSERT INTO `pro_idea` VALUES ('131885ba3588e53020', '123', '321', '165395b9719c0e7b08', '0', '1537431694', '1537431694', null);
INSERT INTO `pro_idea` VALUES ('627095ba35fdc468e8', '超级帝国战争游戏', '一个帝国战争的游戏,玩家在开始时分为很多个阵营,每个阵营一开始有一个城池,然后通过抢夺地盘来获得资源,获得战争的胜利', '165395b9719c0e7b08', '0', '1537433564', '1537433564', null);
INSERT INTO `pro_idea` VALUES ('968385ba3606a89f08', 'hello,这是一个用来发表灵感的地方', '这是一个发表灵感的地方,希望各位朋友能够在这儿畅所欲言,把自己的所有的奇思妙想都说出来,无论什么方面,无论什么东西,只要你想到了,就告诉我们', '165395b9719c0e7b08', '0', '1537433706', '1537433706', null);
INSERT INTO `pro_idea` VALUES ('957595ba36081737a8', '111111111', '111111111', '165395b9719c0e7b08', '0', '1537433729', '1537433729', null);
INSERT INTO `pro_idea` VALUES ('363535ba36fed1d8a8', '123', '123', '165395b9719c0e7b08', '0', '1537437677', '1537437677', null);
INSERT INTO `pro_idea` VALUES ('126555ba3708fa9ad8', '123', '1223123', '165395b9719c0e7b08', '0', '1537437839', '1537437839', null);
INSERT INTO `pro_idea` VALUES ('517095ba3709784918', '123', '1223123', '165395b9719c0e7b08', '0', '1537437847', '1537437847', null);
INSERT INTO `pro_idea` VALUES ('976485ba370b25dc00', '123', '1223123', '165395b9719c0e7b08', '0', '1537437874', '1537437874', null);
INSERT INTO `pro_idea` VALUES ('301795ba370bb43a08', '123', '1223123', '165395b9719c0e7b08', '976135ba370d6da430', '1537437883', '1537437883', null);
INSERT INTO `pro_idea` VALUES ('976135ba370d6da430', '123', '1223123123333', '165395b9719c0e7b08', '0', '1537437910', '1537437910', null);
INSERT INTO `pro_idea` VALUES ('861435ba4b414c5440', '123333', '321111', '165395b9719c0e7b08', '0', '1537520660', '1537520660', null);
INSERT INTO `pro_idea` VALUES ('118895ba4b4ec3b150', '123333', '12311111111', '165395b9719c0e7b08', '0', '1537520876', '1537520876', null);
INSERT INTO `pro_idea` VALUES ('633025ba4b5653fb88', '123333333', '13222222213213', '165395b9719c0e7b08', '0', '1537520997', '1537520997', null);
INSERT INTO `pro_idea` VALUES ('674915ba4b805de2b0', '123333', '1233333', '165395b9719c0e7b08', '0', '1537521669', '1537521669', null);

-- ----------------------------
-- Table structure for `pro_product_article`
-- ----------------------------
DROP TABLE IF EXISTS `pro_product_article`;
CREATE TABLE `pro_product_article` (
  `id` char(32) NOT NULL,
  `content` varchar(255) NOT NULL COMMENT '发表的内容',
  `user_id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pro_product_article
-- ----------------------------

-- ----------------------------
-- Table structure for `pro_user`
-- ----------------------------
DROP TABLE IF EXISTS `pro_user`;
CREATE TABLE `pro_user` (
  `id` char(18) NOT NULL,
  `openid` char(28) DEFAULT NULL,
  `nickname` varchar(55) DEFAULT '',
  `avatar` char(130) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `session_key` char(24) DEFAULT NULL,
  `password` varchar(55) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_openid` (`openid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pro_user
-- ----------------------------
INSERT INTO `pro_user` VALUES ('165395b9719c0e7b08', 'ovLuV5EU51d_wSR2noALkGMrALts', 'Alex', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq4HZFL7WFI9V8K81YFdFQlL3KgehicQVLFoibfHW8wDHde4Hjia6xTjgYOo4j5mjgactptaEO9jA2eg/132', null, 'brDuGzZDpz/D6ziZpALXvQ==', null, '1536629184', '1537522160', null);

-- ----------------------------
-- Table structure for `pro_user_feelings`
-- ----------------------------
DROP TABLE IF EXISTS `pro_user_feelings`;
CREATE TABLE `pro_user_feelings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feelings` int(11) NOT NULL DEFAULT '0' COMMENT '灵感值',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pro_user_feelings
-- ----------------------------

-- ----------------------------
-- Table structure for `pro_user_get_log`
-- ----------------------------
DROP TABLE IF EXISTS `pro_user_get_log`;
CREATE TABLE `pro_user_get_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '6为灵感值领取',
  `create_time` int(11) DEFAULT NULL,
  `month_day` int(8) NOT NULL COMMENT '更新的月份和天',
  `delete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pro_user_get_log
-- ----------------------------
