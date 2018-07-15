/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 100132
Source Host           : localhost:3306
Source Database       : gen

Target Server Type    : MYSQL
Target Server Version : 100132
File Encoding         : 65001

Date: 2018-07-15 22:19:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cate
-- ----------------------------
DROP TABLE IF EXISTS `cate`;
CREATE TABLE `cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cate
-- ----------------------------
INSERT INTO `cate` VALUES ('1', '分类1', '0', '2018-06-24 20:59:39', '2018-07-14 11:16:44', '2018-07-14 11:16:44');
INSERT INTO `cate` VALUES ('2', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:16:47', '2018-07-14 11:16:47');
INSERT INTO `cate` VALUES ('3', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:16:49', '2018-07-14 11:16:49');
INSERT INTO `cate` VALUES ('4', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:16:51', '2018-07-14 11:16:51');
INSERT INTO `cate` VALUES ('5', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:16:53', '2018-07-14 11:16:53');
INSERT INTO `cate` VALUES ('6', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:16:59', '2018-07-14 11:16:59');
INSERT INTO `cate` VALUES ('7', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:19', '2018-07-14 11:17:19');
INSERT INTO `cate` VALUES ('8', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:22', '2018-07-14 11:17:22');
INSERT INTO `cate` VALUES ('9', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:16', '2018-07-14 11:17:16');
INSERT INTO `cate` VALUES ('10', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:14', '2018-07-14 11:17:14');
INSERT INTO `cate` VALUES ('11', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:52', '2018-07-14 11:17:52');
INSERT INTO `cate` VALUES ('12', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:10', '2018-07-14 11:17:10');
INSERT INTO `cate` VALUES ('13', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:12', '2018-07-14 11:17:12');
INSERT INTO `cate` VALUES ('14', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:05', '2018-07-14 11:17:05');
INSERT INTO `cate` VALUES ('15', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:03', '2018-07-14 11:17:03');
INSERT INTO `cate` VALUES ('16', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:08', '2018-07-14 11:17:08');
INSERT INTO `cate` VALUES ('17', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:02', '2018-07-14 11:17:02');
INSERT INTO `cate` VALUES ('18', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:25', '2018-07-14 11:17:25');
INSERT INTO `cate` VALUES ('19', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:28', '2018-07-14 11:17:28');
INSERT INTO `cate` VALUES ('20', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:33', '2018-07-14 11:17:33');
INSERT INTO `cate` VALUES ('21', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:31', '2018-07-14 11:17:31');
INSERT INTO `cate` VALUES ('22', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:38', '2018-07-14 11:17:38');
INSERT INTO `cate` VALUES ('23', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:36', '2018-07-14 11:17:36');
INSERT INTO `cate` VALUES ('24', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:50', '2018-07-14 11:17:50');
INSERT INTO `cate` VALUES ('25', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:49', '2018-07-14 11:17:49');
INSERT INTO `cate` VALUES ('26', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:46', '2018-07-14 11:17:46');
INSERT INTO `cate` VALUES ('27', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:44', '2018-07-14 11:17:44');
INSERT INTO `cate` VALUES ('28', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:43', '2018-07-14 11:17:43');
INSERT INTO `cate` VALUES ('29', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:40', '2018-07-14 11:17:40');
INSERT INTO `cate` VALUES ('30', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:17:59', '2018-07-14 11:17:59');
INSERT INTO `cate` VALUES ('31', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:18:02', '2018-07-14 11:18:02');
INSERT INTO `cate` VALUES ('32', '分类2', '0', '2018-07-14 14:26:15', '2018-07-14 11:18:03', '2018-07-14 11:18:03');
INSERT INTO `cate` VALUES ('33', null, null, '2018-07-14 09:42:24', '2018-07-14 11:16:39', '2018-07-14 11:16:39');
INSERT INTO `cate` VALUES ('34', 'asdf', null, '2018-07-14 09:49:56', '2018-07-14 11:19:08', '2018-07-14 11:19:08');
INSERT INTO `cate` VALUES ('35', '呵呵', null, '2018-07-14 09:51:15', '2018-07-15 06:44:59', '2018-07-15 06:44:59');
INSERT INTO `cate` VALUES ('36', 'asdf', null, '2018-07-14 09:51:27', '2018-07-15 06:45:01', '2018-07-15 06:45:01');
INSERT INTO `cate` VALUES ('40', 'asdf', null, '2018-07-14 09:59:42', '2018-07-15 06:45:03', '2018-07-15 06:45:03');
INSERT INTO `cate` VALUES ('41', 'asdf', null, '2018-07-14 10:03:26', '2018-07-15 06:45:11', '2018-07-15 06:45:11');
INSERT INTO `cate` VALUES ('42', 'adsfasdf', null, '2018-07-14 10:03:54', '2018-07-15 06:45:09', '2018-07-15 06:45:09');
INSERT INTO `cate` VALUES ('43', 'asdfas', null, '2018-07-14 10:04:13', '2018-07-14 13:32:26', '2018-07-14 13:32:26');
INSERT INTO `cate` VALUES ('44', 'asdf', null, '2018-07-14 10:06:26', '2018-07-15 06:45:07', '2018-07-15 06:45:07');
INSERT INTO `cate` VALUES ('45', 'asdfasdf', null, '2018-07-14 10:06:54', '2018-07-14 11:16:33', '2018-07-14 11:16:33');
INSERT INTO `cate` VALUES ('46', 'asdfasdf', null, '2018-07-14 10:07:00', '2018-07-15 06:45:05', '2018-07-15 06:45:05');
INSERT INTO `cate` VALUES ('47', 'asdfasdf', null, '2018-07-14 10:07:36', '2018-07-14 11:16:30', '2018-07-14 11:16:30');
INSERT INTO `cate` VALUES ('48', '1111', null, '2018-07-14 10:09:32', '2018-07-14 11:15:53', '2018-07-14 11:15:53');
INSERT INTO `cate` VALUES ('49', 'asdfasdfasdf', null, '2018-07-14 10:10:14', '2018-07-14 11:16:27', '2018-07-14 11:16:27');
INSERT INTO `cate` VALUES ('50', 'asdf', null, '2018-07-14 10:17:24', '2018-07-14 11:15:55', '2018-07-14 11:15:55');
INSERT INTO `cate` VALUES ('51', 'asdfasdf', null, '2018-07-14 10:28:26', '2018-07-14 11:15:48', '2018-07-14 11:15:48');
INSERT INTO `cate` VALUES ('52', '新建文章', null, '2018-07-14 10:33:31', '2018-07-14 11:14:52', '2018-07-14 11:14:52');
INSERT INTO `cate` VALUES ('53', '新建文章分类', null, '2018-07-14 10:33:41', '2018-07-14 11:14:50', '2018-07-14 11:14:50');
INSERT INTO `cate` VALUES ('54', '真的是新文章', null, '2018-07-14 10:34:28', '2018-07-14 11:14:10', '2018-07-14 11:14:10');
INSERT INTO `cate` VALUES ('55', null, null, '2018-07-14 10:40:58', '2018-07-14 11:14:05', '2018-07-14 11:14:05');
INSERT INTO `cate` VALUES ('56', '很好！', null, '2018-07-14 11:19:17', '2018-07-14 13:22:05', null);
INSERT INTO `cate` VALUES ('57', '李洋你好笨啊', null, '2018-07-14 11:19:25', '2018-07-14 12:30:58', '2018-07-14 12:30:58');
INSERT INTO `cate` VALUES ('58', '呵呵， 嗯哼', null, '2018-07-14 11:20:11', '2018-07-14 12:31:02', '2018-07-14 12:31:02');
INSERT INTO `cate` VALUES ('59', '诶呀我去。 可以', null, '2018-07-14 13:31:11', '2018-07-14 13:31:11', null);
INSERT INTO `cate` VALUES ('60', '再来一个', null, '2018-07-14 13:31:21', '2018-07-14 13:31:21', null);
INSERT INTO `cate` VALUES ('61', '今天怎么了？', null, '2018-07-14 13:31:30', '2018-07-14 13:31:30', null);
INSERT INTO `cate` VALUES ('62', '我感觉还可以啊', null, '2018-07-14 13:31:38', '2018-07-14 13:31:38', null);
INSERT INTO `cate` VALUES ('63', '不错', null, '2018-07-14 13:31:44', '2018-07-14 13:31:44', null);
INSERT INTO `cate` VALUES ('64', '一切正常', null, '2018-07-14 13:31:52', '2018-07-14 13:31:52', null);
INSERT INTO `cate` VALUES ('65', '李洋还是辣么二', null, '2018-07-14 13:32:01', '2018-07-14 13:32:01', null);
INSERT INTO `cate` VALUES ('66', '连续在家呆了3天真是无聊啊', null, '2018-07-14 13:32:15', '2018-07-14 13:37:24', null);
INSERT INTO `cate` VALUES ('67', '复写laravel的错误处理真是有点麻烦的啊！！', null, '2018-07-14 14:39:02', '2018-07-14 14:39:02', null);
INSERT INTO `cate` VALUES ('68', null, null, '2018-07-14 14:52:47', '2018-07-14 14:52:55', '2018-07-14 14:52:55');
INSERT INTO `cate` VALUES ('69', null, null, '2018-07-14 14:52:49', '2018-07-14 14:52:53', '2018-07-14 14:52:53');
INSERT INTO `cate` VALUES ('70', null, null, '2018-07-14 14:53:10', '2018-07-14 14:55:54', '2018-07-14 14:55:54');
INSERT INTO `cate` VALUES ('71', null, null, '2018-07-14 14:53:36', '2018-07-14 14:55:53', '2018-07-14 14:55:53');
INSERT INTO `cate` VALUES ('72', null, null, '2018-07-14 14:53:41', '2018-07-14 14:55:51', '2018-07-14 14:55:51');
INSERT INTO `cate` VALUES ('73', '名称啊名称', null, '2018-07-14 14:55:47', '2018-07-14 14:55:47', null);
INSERT INTO `cate` VALUES ('74', '诶呀我勒个去', null, '2018-07-15 06:30:08', '2018-07-15 06:30:08', null);
INSERT INTO `cate` VALUES ('75', '呵呵', null, '2018-07-15 06:45:35', '2018-07-15 06:45:35', null);

-- ----------------------------
-- Table structure for gen_default_value
-- ----------------------------
DROP TABLE IF EXISTS `gen_default_value`;
CREATE TABLE `gen_default_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  `is_default` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of gen_default_value
-- ----------------------------

-- ----------------------------
-- Table structure for gen_field
-- ----------------------------
DROP TABLE IF EXISTS `gen_field`;
CREATE TABLE `gen_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gen_table_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `lable` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT '',
  `show_type` varchar(255) NOT NULL DEFAULT '',
  `search` tinyint(4) NOT NULL DEFAULT '1',
  `index` tinyint(4) NOT NULL DEFAULT '1',
  `show` tinyint(4) NOT NULL DEFAULT '1',
  `create` tinyint(4) NOT NULL DEFAULT '1',
  `is_ref` tinyint(4) NOT NULL DEFAULT '0',
  `ref_class` varchar(255) NOT NULL DEFAULT '',
  `ref_method` varchar(255) NOT NULL DEFAULT '',
  `ref_type` varchar(255) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of gen_field
-- ----------------------------
INSERT INTO `gen_field` VALUES ('1', '1', 'id', 'id', 'integer', 'integer', '1', '1', '1', '1', '0', '', '', '', '2018-07-15 09:28:30', '2018-07-15 09:54:04');
INSERT INTO `gen_field` VALUES ('2', '1', 'name', 'name', 'string', 'string', '1', '1', '1', '1', '0', '', '', '', '2018-07-15 09:28:30', '2018-07-15 09:54:04');
INSERT INTO `gen_field` VALUES ('3', '1', 'cate', 'cate', 'integer', 'integer', '1', '1', '1', '1', '0', '', '', '', '2018-07-15 09:28:30', '2018-07-15 09:54:04');
INSERT INTO `gen_field` VALUES ('4', '1', 'created_at', 'created_at', 'datetime', 'datetime', '1', '1', '1', '1', '0', '', '', '', '2018-07-15 09:28:30', '2018-07-15 11:38:16');
INSERT INTO `gen_field` VALUES ('5', '1', 'updated_at', 'updated_at', 'datetime', 'datetime', '1', '1', '1', '1', '0', '', '', '', '2018-07-15 09:28:30', '2018-07-15 09:54:04');
INSERT INTO `gen_field` VALUES ('6', '1', 'deleted_at', 'deleted_at', 'datetime', 'datetime', '1', '1', '1', '1', '0', '', '', '', '2018-07-15 09:28:30', '2018-07-15 09:54:04');
INSERT INTO `gen_field` VALUES ('7', '1', 'cate_id', 'cate_id', 'integer', 'integer', '1', '1', '1', '1', '0', '', '', '', '2018-07-15 11:17:46', '2018-07-15 11:38:16');

-- ----------------------------
-- Table structure for gen_field_rule
-- ----------------------------
DROP TABLE IF EXISTS `gen_field_rule`;
CREATE TABLE `gen_field_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) DEFAULT NULL,
  `rule` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of gen_field_rule
-- ----------------------------
INSERT INTO `gen_field_rule` VALUES ('1', '1', 'required', '此项必须填写', '2018-07-15 09:32:37', '2018-07-15 09:32:37');
INSERT INTO `gen_field_rule` VALUES ('2', '2', 'required', '此项必须填写', '2018-07-15 09:44:29', '2018-07-15 09:44:29');
INSERT INTO `gen_field_rule` VALUES ('3', '3', 'required', '此项必须填写', '2018-07-15 09:44:29', '2018-07-15 09:44:29');
INSERT INTO `gen_field_rule` VALUES ('4', '4', 'required', '此项必须填写', '2018-07-15 09:44:29', '2018-07-15 09:44:29');
INSERT INTO `gen_field_rule` VALUES ('5', '5', 'required', '此项必须填写', '2018-07-15 09:44:29', '2018-07-15 09:44:29');
INSERT INTO `gen_field_rule` VALUES ('6', '6', 'required', '此项必须填写', '2018-07-15 09:44:29', '2018-07-15 09:44:29');
INSERT INTO `gen_field_rule` VALUES ('7', '7', 'required', '此项必须填写', '2018-07-15 11:17:46', '2018-07-15 11:17:46');
INSERT INTO `gen_field_rule` VALUES ('8', '1', 'min:10', '最小为10', '2018-07-15 11:38:16', '2018-07-15 11:38:16');
INSERT INTO `gen_field_rule` VALUES ('9', '2', 'min:10', '最小为10', '2018-07-15 11:38:16', '2018-07-15 11:38:16');
INSERT INTO `gen_field_rule` VALUES ('10', '7', 'min:10', '最小为10', '2018-07-15 11:38:16', '2018-07-15 11:38:16');
INSERT INTO `gen_field_rule` VALUES ('11', '4', 'min:10', '最小为10', '2018-07-15 11:38:16', '2018-07-15 11:38:16');
INSERT INTO `gen_field_rule` VALUES ('12', '5', 'min:10', '最小为10', '2018-07-15 11:38:16', '2018-07-15 11:38:16');
INSERT INTO `gen_field_rule` VALUES ('13', '6', 'min:10', '最小为10', '2018-07-15 11:38:16', '2018-07-15 11:38:16');

-- ----------------------------
-- Table structure for gen_table
-- ----------------------------
DROP TABLE IF EXISTS `gen_table`;
CREATE TABLE `gen_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `controller_name` varchar(255) DEFAULT NULL,
  `model_name` varchar(255) DEFAULT NULL,
  `view_name` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `is_closure_table` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of gen_table
-- ----------------------------
INSERT INTO `gen_table` VALUES ('1', 'cate', 'cateController', 'Cate', 'cate', null, '0', '2018-07-15 09:21:15', '2018-07-15 09:21:15');

-- ----------------------------
-- Table structure for template
-- ----------------------------
DROP TABLE IF EXISTS `template`;
CREATE TABLE `template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of template
-- ----------------------------
