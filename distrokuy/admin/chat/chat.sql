/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50557
Source Host           : localhost:3306
Source Database       : chat

Target Server Type    : MYSQL
Target Server Version : 50557
File Encoding         : 65001

Date: 2018-02-08 07:48:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `alamat`
-- ----------------------------
DROP TABLE IF EXISTS `alamat`;
CREATE TABLE `alamat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8_bin NOT NULL,
  `alamat` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of alamat
-- ----------------------------
INSERT INTO `alamat` VALUES ('1', 'user 1', 'user 1');
INSERT INTO `alamat` VALUES ('2', 'user 2', 'user 2');
INSERT INTO `alamat` VALUES ('3', 'user 3', 'user 3');
INSERT INTO `alamat` VALUES ('5', 'user 4', 'user 4');

-- ----------------------------
-- Table structure for `chat`
-- ----------------------------
DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `isi_chat` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of chat
-- ----------------------------
INSERT INTO `chat` VALUES ('1', 'gg', 'ff');
INSERT INTO `chat` VALUES ('2', 'bb', 'bb');
INSERT INTO `chat` VALUES ('3', 'hh', 'hh');
INSERT INTO `chat` VALUES ('4', 'hh', 'hhb');
INSERT INTO `chat` VALUES ('5', 'ff', 'ff');
INSERT INTO `chat` VALUES ('6', 'ff', 'oo');
INSERT INTO `chat` VALUES ('7', 'ff', 'gg');
INSERT INTO `chat` VALUES ('8', 'asd', 'asd');
INSERT INTO `chat` VALUES ('9', 'b', 'b');
INSERT INTO `chat` VALUES ('10', 'bb', 'gg');
INSERT INTO `chat` VALUES ('11', 'vv', 'vv');
INSERT INTO `chat` VALUES ('12', 'ad', 'ad');
INSERT INTO `chat` VALUES ('13', 'll', 'll');
INSERT INTO `chat` VALUES ('14', 'll', 'llkoko');
INSERT INTO `chat` VALUES ('15', 'll', 'llkokoasd');
INSERT INTO `chat` VALUES ('16', 'tes', 'tes');
INSERT INTO `chat` VALUES ('17', 'tes', 'asdasdad');
INSERT INTO `chat` VALUES ('18', 'joko', 'widodo');
INSERT INTO `chat` VALUES ('19', 'joko', 'saya presiden');
INSERT INTO `chat` VALUES ('20', 'joko', 'ok sudah selesai');
