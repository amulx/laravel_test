/*
Navicat MySQL Data Transfer

Source Server         : mysql5.6
Source Server Version : 50631
Source Host           : localhost:3306
Source Database       : ysp_for_hyd

Target Server Type    : MYSQL
Target Server Version : 50631
File Encoding         : 65001

Date: 2016-11-08 17:56:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ysp_admin
-- ----------------------------
DROP TABLE IF EXISTS `ysp_admin`;
CREATE TABLE `ysp_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `disabled` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'ok' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理员';

-- ----------------------------
-- Records of ysp_admin
-- ----------------------------

-- ----------------------------
-- Table structure for ysp_apps
-- ----------------------------
DROP TABLE IF EXISTS `ysp_apps`;
CREATE TABLE `ysp_apps` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增长',
  `app_id` varchar(60) NOT NULL COMMENT 'appid',
  `app_secret` varchar(100) NOT NULL COMMENT '密钥',
  `app_name` varchar(200) NOT NULL COMMENT 'app名称',
  `app_desc` text COMMENT '描述',
  `status` tinyint(2) DEFAULT '0' COMMENT '生效状态',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_id` (`app_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='应用表';

-- ----------------------------
-- Records of ysp_apps
-- ----------------------------
INSERT INTO `ysp_apps` VALUES ('2', '111', '111', 'test', 'test', '1', '0', '0');

-- ----------------------------
-- Table structure for ysp_demand
-- ----------------------------
DROP TABLE IF EXISTS `ysp_demand`;
CREATE TABLE `ysp_demand` (
  `demand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(16) DEFAULT NULL COMMENT '订单编号',
  `user_id` int(10) unsigned NOT NULL COMMENT '用户编号',
  `line_id` int(20) DEFAULT NULL COMMENT '线路id',
  `express_id` int(11) DEFAULT NULL,
  `transport_id` varchar(55) DEFAULT NULL,
  `demand_name` varchar(255) NOT NULL COMMENT '货物名称',
  `demand_num` varchar(255) NOT NULL COMMENT '数量',
  `value` varchar(255) NOT NULL COMMENT '保价',
  `length` varchar(255) NOT NULL COMMENT '长',
  `width` varchar(255) NOT NULL COMMENT '宽',
  `height` varchar(255) NOT NULL COMMENT '高',
  `weight` varchar(255) NOT NULL COMMENT '货物总重量',
  `volume` varchar(50) DEFAULT NULL COMMENT '货物总体积',
  `packing` varchar(50) DEFAULT NULL COMMENT '货物包装',
  `send_time` datetime NOT NULL COMMENT '寄件时间',
  `t_company` varchar(255) NOT NULL COMMENT '收寄单位名称',
  `t_name` varchar(255) NOT NULL COMMENT '收件人姓名',
  `t_mobile` varchar(255) NOT NULL COMMENT '收件人联系方式',
  `t_province` varchar(20) NOT NULL COMMENT '省',
  `t_city` varchar(20) NOT NULL COMMENT '城市',
  `t_area` varchar(50) DEFAULT NULL,
  `t_town` varchar(50) DEFAULT NULL,
  `t_addr` varchar(20) NOT NULL COMMENT '详细地址',
  `total_fee` double(20,2) DEFAULT NULL COMMENT '总价格',
  `remarks` varchar(255) DEFAULT NULL COMMENT '备注',
  `created_at` int(10) NOT NULL,
  `updated_at` int(10) NOT NULL,
  PRIMARY KEY (`demand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysp_demand
-- ----------------------------

-- ----------------------------
-- Table structure for ysp_express
-- ----------------------------
DROP TABLE IF EXISTS `ysp_express`;
CREATE TABLE `ysp_express` (
  `express_id` int(11) NOT NULL AUTO_INCREMENT,
  `express_name` varchar(55) DEFAULT NULL,
  `charge_person` varchar(55) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `first_weight` varchar(55) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`express_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysp_express
-- ----------------------------
INSERT INTO `ysp_express` VALUES ('1', '顺丰', '顺丰负责人', '18146645003', '30', null, null);
INSERT INTO `ysp_express` VALUES ('2', '德邦', '德邦负责人', '18146645002', '31', null, null);
INSERT INTO `ysp_express` VALUES ('3', '圆通', '圆通负责人', '18146645001', '28', null, null);

-- ----------------------------
-- Table structure for ysp_heavy_price
-- ----------------------------
DROP TABLE IF EXISTS `ysp_heavy_price`;
CREATE TABLE `ysp_heavy_price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `express_id` int(11) DEFAULT NULL COMMENT '物流服务商编号',
  `line_id` int(11) DEFAULT NULL COMMENT '线路编号',
  `calculate_a` varchar(20) DEFAULT NULL COMMENT '首重计价（30kg）',
  `continued_a` varchar(20) DEFAULT NULL COMMENT '续重计价（30）',
  `calculate_b` varchar(25) DEFAULT NULL COMMENT '首重计价',
  `continued_b` varchar(25) DEFAULT NULL,
  `calculate_c` varchar(25) DEFAULT NULL,
  `continued_c` varchar(25) DEFAULT NULL,
  `valid_time` varchar(20) DEFAULT NULL COMMENT '时效',
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysp_heavy_price
-- ----------------------------
INSERT INTO `ysp_heavy_price` VALUES ('1', '1', '1', '23', '6', '55', '12', '65', '21', '两到三天', null, null);
INSERT INTO `ysp_heavy_price` VALUES ('2', '2', '1', '23.5', '5', '56', '45', '4', '45', null, null, null);
INSERT INTO `ysp_heavy_price` VALUES ('3', '3', '1', '45', '4', '43', '34', '34', '\'', null, null, null);

-- ----------------------------
-- Table structure for ysp_light_price
-- ----------------------------
DROP TABLE IF EXISTS `ysp_light_price`;
CREATE TABLE `ysp_light_price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `express_id` int(11) DEFAULT NULL COMMENT '物流服务商编号',
  `line_id` int(11) DEFAULT NULL COMMENT '线路编号',
  `calculate_a` varchar(20) DEFAULT NULL COMMENT '首重计价（30kg）',
  `continued_a` varchar(20) DEFAULT NULL COMMENT '续重计价（30）',
  `calculate_b` varchar(25) DEFAULT NULL COMMENT '首重计价',
  `continued_b` varchar(25) DEFAULT NULL,
  `calculate_c` varchar(25) DEFAULT NULL,
  `continued_c` varchar(25) DEFAULT NULL,
  `valid_time` varchar(20) DEFAULT NULL COMMENT '时效',
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysp_light_price
-- ----------------------------
INSERT INTO `ysp_light_price` VALUES ('1', '1', '1', '34', '9', '23', '11', '34', '22', '四到五天', null, null);

-- ----------------------------
-- Table structure for ysp_line
-- ----------------------------
DROP TABLE IF EXISTS `ysp_line`;
CREATE TABLE `ysp_line` (
  `line_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '线路id',
  `f_provice` varchar(50) DEFAULT NULL COMMENT '始发省份',
  `f_city` varchar(50) DEFAULT NULL COMMENT '始发城市',
  `f_area` varchar(25) DEFAULT NULL,
  `f_town` varchar(25) DEFAULT NULL,
  `f_addr` varchar(255) DEFAULT NULL,
  `t_provice` varchar(50) DEFAULT NULL COMMENT '到达省份',
  `t_city` varchar(50) DEFAULT NULL COMMENT '到达城市',
  `t_area` varchar(25) DEFAULT NULL,
  `t_town` varchar(25) DEFAULT NULL,
  `t_addr` varchar(255) DEFAULT NULL,
  `express_collection` varchar(255) DEFAULT NULL,
  `created_at` int(10) DEFAULT NULL COMMENT '入库时间',
  `updated_at` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`line_id`),
  KEY `line_id` (`line_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysp_line
-- ----------------------------
INSERT INTO `ysp_line` VALUES ('1', '广东省', '广州市', '天河区', '五山街道', '中公教育大厦', '江西省', '南昌市', '南昌县', '某某街道', '具体的地址', '1,2,3', null, null);

-- ----------------------------
-- Table structure for ysp_users
-- ----------------------------
DROP TABLE IF EXISTS `ysp_users`;
CREATE TABLE `ysp_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `login_account` varchar(30) DEFAULT NULL COMMENT '登录名',
  `login_password` varchar(64) DEFAULT NULL COMMENT '登录密码',
  `charge_person` varchar(30) DEFAULT NULL COMMENT '负责人',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `disabled` varchar(5) DEFAULT NULL COMMENT '状态',
  `province` varchar(20) DEFAULT NULL,
  `city` varchar(20) NOT NULL,
  `area` varchar(20) DEFAULT NULL,
  `town` varchar(20) DEFAULT NULL,
  `addr` varchar(20) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ysp_users
-- ----------------------------
INSERT INTO `ysp_users` VALUES ('1', '232', '23', 'sdf', '18979580510', '1', '广东省', '广州市', '天河区', '五山街道', '中公教育大厦', null, null);
