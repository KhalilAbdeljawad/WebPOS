/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : abayat

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2018-05-23 06:44:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bill`
-- ----------------------------
DROP TABLE IF EXISTS `bill`;
CREATE TABLE `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_date` date NOT NULL,
  `_time` time NOT NULL,
  `user` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `after_discount` decimal(10,2) DEFAULT NULL,
  `paid` decimal(10,2) NOT NULL,
  `remainder` decimal(10,2) DEFAULT NULL,
  `status` set('suspended','done') NOT NULL DEFAULT 'done',
  PRIMARY KEY (`id`),
  KEY `bill_employee_fk` (`user`),
  CONSTRAINT `bill_employee_fk` FOREIGN KEY (`user`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bill
-- ----------------------------
INSERT INTO `bill` VALUES ('169', '2017-01-05', '17:51:35', '3', '99.00', '0.00', '99.00', '99.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('170', '2017-01-05', '17:51:53', '3', '0.00', '0.00', '66.00', '66.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('171', '2017-01-06', '15:11:49', '3', '99.00', '0.00', '99.00', '99.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('172', '2017-01-06', '21:38:15', '3', '33.00', '0.00', '33.00', '33.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('173', '2017-01-07', '12:00:39', '3', '0.00', '0.00', '477.00', '477.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('174', '2017-01-07', '12:08:40', '3', '0.00', '0.00', '477.00', '477.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('175', '2017-01-07', '12:33:54', '3', '777.00', '10.00', '699.30', '699.30', '0.00', 'done');
INSERT INTO `bill` VALUES ('176', '2017-01-07', '12:57:18', '3', '453.00', '0.00', '453.00', '453.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('177', '2017-01-19', '20:23:10', '3', '2317.00', '0.00', '2317.00', '2317.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('178', '2017-01-19', '20:24:09', '3', '970.00', '0.00', '970.00', '970.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('179', '2017-01-19', '20:24:10', '3', '1081.00', '0.00', '1081.00', '1081.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('180', '2017-01-19', '20:24:32', '3', '1081.00', '0.00', '1081.00', '1081.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('181', '2017-01-19', '20:25:39', '3', '671.00', '0.00', '671.00', '671.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('182', '2017-03-30', '15:56:40', '3', '605.00', '0.00', '605.00', '605.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('183', '2018-05-21', '10:07:50', '3', '671.00', '0.00', '671.00', '671.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('184', '2018-05-21', '10:08:10', '3', '460.00', '0.00', '460.00', '460.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('185', '2018-05-21', '12:43:31', '3', '395.00', '78.00', '317.00', '317.00', '0.00', 'done');
INSERT INTO `bill` VALUES ('186', '2018-05-21', '13:03:48', '3', '222.00', '50.00', '172.00', '172.00', '0.00', 'done');

-- ----------------------------
-- Table structure for `bill_element`
-- ----------------------------
DROP TABLE IF EXISTS `bill_element`;
CREATE TABLE `bill_element` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill` int(11) NOT NULL,
  `item` char(6) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`,`bill`),
  KEY `bill_element_fk` (`bill`),
  KEY `bill_element_item_fk` (`item`),
  CONSTRAINT `bill_element_fk` FOREIGN KEY (`bill`) REFERENCES `bill` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bill_element
-- ----------------------------
INSERT INTO `bill_element` VALUES ('1', '169', '22', '33.00', '3');
INSERT INTO `bill_element` VALUES ('2', '170', '22', '33.00', '0');
INSERT INTO `bill_element` VALUES ('3', '171', '22', '33.00', '3');
INSERT INTO `bill_element` VALUES ('4', '172', '22', '33.00', '1');
INSERT INTO `bill_element` VALUES ('5', '172', '55', '222.00', '0');
INSERT INTO `bill_element` VALUES ('6', '173', '22', '33.00', '0');
INSERT INTO `bill_element` VALUES ('7', '173', '55', '222.00', '0');
INSERT INTO `bill_element` VALUES ('8', '174', '22', '33.00', '0');
INSERT INTO `bill_element` VALUES ('9', '174', '55', '222.00', '0');
INSERT INTO `bill_element` VALUES ('10', '175', '147', '150.00', '2');
INSERT INTO `bill_element` VALUES ('11', '175', '22', '33.00', '1');
INSERT INTO `bill_element` VALUES ('12', '175', '55', '222.00', '2');
INSERT INTO `bill_element` VALUES ('13', '176', '22', '33.00', '1');
INSERT INTO `bill_element` VALUES ('14', '176', '55', '222.00', '1');
INSERT INTO `bill_element` VALUES ('15', '176', '99', '66.00', '3');
INSERT INTO `bill_element` VALUES ('16', '177', '666', '140.00', '1');
INSERT INTO `bill_element` VALUES ('17', '177', '58', '160.00', '2');
INSERT INTO `bill_element` VALUES ('18', '177', '47', '111.00', '2');
INSERT INTO `bill_element` VALUES ('19', '177', '82', '110.00', '1');
INSERT INTO `bill_element` VALUES ('20', '177', '89', '100.00', '1');
INSERT INTO `bill_element` VALUES ('21', '177', '46', '100.00', '1');
INSERT INTO `bill_element` VALUES ('22', '177', '53', '100.00', '1');
INSERT INTO `bill_element` VALUES ('23', '177', '6554', '210.00', '1');
INSERT INTO `bill_element` VALUES ('24', '177', '544', '200.00', '1');
INSERT INTO `bill_element` VALUES ('25', '177', '5478', '120.00', '1');
INSERT INTO `bill_element` VALUES ('26', '177', '5654', '110.00', '1');
INSERT INTO `bill_element` VALUES ('27', '177', '111', '110.00', '3');
INSERT INTO `bill_element` VALUES ('28', '177', '14', '11.00', '1');
INSERT INTO `bill_element` VALUES ('29', '177', '55', '222.00', '1');
INSERT INTO `bill_element` VALUES ('30', '177', '789', '22.00', '1');
INSERT INTO `bill_element` VALUES ('31', '178', '666', '140.00', '1');
INSERT INTO `bill_element` VALUES ('32', '178', '58', '160.00', '2');
INSERT INTO `bill_element` VALUES ('33', '178', '47', '111.00', '0');
INSERT INTO `bill_element` VALUES ('34', '178', '82', '110.00', '1');
INSERT INTO `bill_element` VALUES ('35', '178', '89', '100.00', '1');
INSERT INTO `bill_element` VALUES ('36', '178', '46', '100.00', '2');
INSERT INTO `bill_element` VALUES ('37', '178', '53', '100.00', '1');
INSERT INTO `bill_element` VALUES ('38', '179', '666', '140.00', '1');
INSERT INTO `bill_element` VALUES ('39', '179', '58', '160.00', '2');
INSERT INTO `bill_element` VALUES ('40', '179', '47', '111.00', '1');
INSERT INTO `bill_element` VALUES ('41', '179', '82', '110.00', '1');
INSERT INTO `bill_element` VALUES ('42', '179', '89', '100.00', '1');
INSERT INTO `bill_element` VALUES ('43', '179', '46', '100.00', '2');
INSERT INTO `bill_element` VALUES ('44', '179', '53', '100.00', '1');
INSERT INTO `bill_element` VALUES ('45', '180', '666', '140.00', '1');
INSERT INTO `bill_element` VALUES ('46', '180', '58', '160.00', '2');
INSERT INTO `bill_element` VALUES ('47', '180', '47', '111.00', '1');
INSERT INTO `bill_element` VALUES ('48', '180', '82', '110.00', '1');
INSERT INTO `bill_element` VALUES ('49', '180', '89', '100.00', '1');
INSERT INTO `bill_element` VALUES ('50', '180', '46', '100.00', '2');
INSERT INTO `bill_element` VALUES ('51', '180', '53', '100.00', '1');
INSERT INTO `bill_element` VALUES ('52', '181', '666', '140.00', '1');
INSERT INTO `bill_element` VALUES ('53', '181', '58', '160.00', '2');
INSERT INTO `bill_element` VALUES ('54', '181', '47', '111.00', '1');
INSERT INTO `bill_element` VALUES ('55', '181', '46', '100.00', '1');
INSERT INTO `bill_element` VALUES ('56', '182', '111', '110.00', '4');
INSERT INTO `bill_element` VALUES ('57', '182', '22', '33.00', '5');
INSERT INTO `bill_element` VALUES ('58', '183', '666', '140.00', '1');
INSERT INTO `bill_element` VALUES ('59', '183', '58', '160.00', '2');
INSERT INTO `bill_element` VALUES ('60', '183', '47', '111.00', '1');
INSERT INTO `bill_element` VALUES ('61', '183', '46', '100.00', '1');
INSERT INTO `bill_element` VALUES ('62', '184', '666', '140.00', '1');
INSERT INTO `bill_element` VALUES ('63', '184', '58', '160.00', '2');
INSERT INTO `bill_element` VALUES ('64', '185', '666', '140.00', '1');
INSERT INTO `bill_element` VALUES ('65', '185', '22', '33.00', '1');
INSERT INTO `bill_element` VALUES ('66', '185', '55', '222.00', '1');
INSERT INTO `bill_element` VALUES ('67', '186', '55', '222.00', '1');

-- ----------------------------
-- Table structure for `employee`
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(65) DEFAULT NULL,
  `employee_email` varchar(45) DEFAULT NULL,
  `employee_username` char(30) DEFAULT NULL,
  `employee_pwd` char(34) NOT NULL COMMENT 'pwd',
  `priv` enum('manager','user') DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('1', 'أحمد', null, 'ahmed', 'ahmed', 'user');
INSERT INTO `employee` VALUES ('3', 'المدير', null, 'admin', 'admin', 'manager');

-- ----------------------------
-- Table structure for `fees`
-- ----------------------------
DROP TABLE IF EXISTS `fees`;
CREATE TABLE `fees` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `fee_text` varchar(500) NOT NULL,
  `fee_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`fee_id`),
  KEY `userfk` (`user_id`),
  CONSTRAINT `userfk` FOREIGN KEY (`user_id`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fees
-- ----------------------------
INSERT INTO `fees` VALUES ('20', '2017-01-09', '1', 'غذاء', '5.50');
INSERT INTO `fees` VALUES ('23', '2017-01-17', '1', 'غذاء', '5.50');
INSERT INTO `fees` VALUES ('24', '2017-05-01', '1', 'غذاء', '5.50');
INSERT INTO `fees` VALUES ('25', '2017-05-01', '1', 'غذاء', '5.50');
INSERT INTO `fees` VALUES ('26', '2017-05-01', '1', 'غذاء', '5.50');
INSERT INTO `fees` VALUES ('27', '2017-05-01', '1', 'غذاء', '5.51');
INSERT INTO `fees` VALUES ('28', '2017-05-01', '1', 'غذاء', '5.50');
INSERT INTO `fees` VALUES ('29', '2017-05-01', '1', 'غذاء', '0.00');
INSERT INTO `fees` VALUES ('30', '2017-05-01', '3', 'توصيل', '44.00');

-- ----------------------------
-- Table structure for `item`
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(6) NOT NULL,
  `prev_code` char(6) DEFAULT NULL,
  `name_` int(11) NOT NULL,
  `item_date` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `pprice_ae` decimal(10,2) DEFAULT NULL,
  `pprice_ly` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sizes` varchar(20) NOT NULL,
  `quantity` tinyint(4) DEFAULT NULL,
  `room` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`code`),
  KEY `room_fk` (`room`),
  KEY `name_fk` (`name_`),
  CONSTRAINT `name_fk` FOREIGN KEY (`name_`) REFERENCES `names` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `room_fk` FOREIGN KEY (`room`) REFERENCES `room` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES ('1', 'ABC', null, '1', '0000-00-00', null, null, null, '150.00', '56', '-33', '1', null);
INSERT INTO `item` VALUES ('2', 'def', null, '1', '0000-00-00', null, null, null, '200.00', '58', '13', '2', null);
INSERT INTO `item` VALUES ('3', 'asdfsf', null, '2', '0000-00-00', null, null, null, '135.00', '60', '17', '2', null);
INSERT INTO `item` VALUES ('4', '666', null, '2', '0000-00-00', null, null, null, '140.00', '54', '16', '2', null);
INSERT INTO `item` VALUES ('5', '58', null, '2', '0000-00-00', null, null, null, '160.00', '54', '14', '2', null);
INSERT INTO `item` VALUES ('6', '58', null, '2', '0000-00-00', null, null, null, '147.00', '55', '20', '2', null);
INSERT INTO `item` VALUES ('7', '47', null, '2', '0000-00-00', null, null, null, '111.00', '55', '10', '2', null);
INSERT INTO `item` VALUES ('8', '82', null, '2', '0000-00-00', null, null, null, '110.00', '55', '18', '2', null);
INSERT INTO `item` VALUES ('9', '89', null, '2', '0000-00-00', null, null, null, '100.00', '55', '18', '2', null);
INSERT INTO `item` VALUES ('10', '46', null, '2', '0000-00-00', null, null, null, '100.00', '55', '19', '2', null);
INSERT INTO `item` VALUES ('11', '53', null, '2', '0000-00-00', null, null, null, '100.00', '55', '20', '2', null);
INSERT INTO `item` VALUES ('12', '47', null, '2', '0000-00-00', null, null, null, '100.00', '55', '14', '2', null);
INSERT INTO `item` VALUES ('13', '6554', null, '2', '0000-00-00', null, null, null, '210.00', '56,66', '20', '1', null);
INSERT INTO `item` VALUES ('14', '544', null, '1', '0000-00-00', null, null, null, '200.00', '55', '19', '2', null);
INSERT INTO `item` VALUES ('15', '5478', null, '2', '0000-00-00', null, null, null, '120.00', '56', '18', '2', null);
INSERT INTO `item` VALUES ('16', '5654', null, '1', '0000-00-00', null, null, null, '110.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('17', '111', null, '1', '0000-00-00', null, null, null, '110.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('18', '111', null, '1', '0000-00-00', null, null, null, '110.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('19', '111', null, '1', '0000-00-00', null, null, null, '110.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('20', '111', null, '1', '0000-00-00', null, null, null, '110.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('25', '14', null, '1', '0000-00-00', null, null, null, '11.00', '11', '20', '2', null);
INSERT INTO `item` VALUES ('27', '55', null, '1', '0000-00-00', null, null, null, '222.00', '66', '20', '2', null);
INSERT INTO `item` VALUES ('28', '789', null, '1', '0000-00-00', null, null, null, '22.00', '33', '20', '2', null);
INSERT INTO `item` VALUES ('29', '963', null, '1', '0000-00-00', null, null, null, '22.00', '65', '20', '2', null);
INSERT INTO `item` VALUES ('30', '123', null, '1', '0000-00-00', null, null, null, '45.00', '55', '20', '2', null);
INSERT INTO `item` VALUES ('31', '123', null, '1', '0000-00-00', null, null, null, '45.00', '55', '20', '2', null);
INSERT INTO `item` VALUES ('32', '12666', null, '1', '0000-00-00', null, null, null, '45.00', '55', '19', '2', null);
INSERT INTO `item` VALUES ('33', '525', null, '1', '0000-00-00', null, null, null, '220.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('34', '7888', null, '1', '0000-00-00', null, null, null, '220.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('35', '7888', null, '1', '0000-00-00', null, null, null, '220.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('36', '7888', null, '1', '0000-00-00', null, null, null, '220.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('37', '7888', null, '1', '0000-00-00', null, null, null, '220.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('38', '7888', null, '1', '0000-00-00', null, null, null, '220.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('39', '7888', null, '1', '0000-00-00', null, null, null, '220.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('41', '25', null, '2', '0000-00-00', null, null, null, '245.00', '56', '20', '2', null);
INSERT INTO `item` VALUES ('42', '1111', '2222', '2', '0000-00-00', '', null, null, '120.00', '56,66', '20', '2', null);
INSERT INTO `item` VALUES ('44', '147', '145', '1', '0000-00-00', null, null, null, '150.00', '56,66', '20', '2', null);
INSERT INTO `item` VALUES ('45', '123', '444', '1', '0000-00-00', null, null, null, '120.00', '55', '20', '2', null);
INSERT INTO `item` VALUES ('46', '566', '33', '1', '0000-00-00', null, null, null, '150.00', '55', '11', '2', null);
INSERT INTO `item` VALUES ('47', '23', '333', '1', '0000-00-00', null, null, null, '450.00', '55,66,65', '13', '2', null);
INSERT INTO `item` VALUES ('50', '99', '99', '1', '0000-00-00', null, null, null, '66.00', '66', '20', '2', null);
INSERT INTO `item` VALUES ('52', '22', '22', '1', '0000-00-00', null, null, null, '33.00', '33', '13', '2', null);
INSERT INTO `item` VALUES ('54', '123', '098u', '1', '0000-00-00', null, null, null, '456.00', '55,66,65', '10', '2', null);
INSERT INTO `item` VALUES ('56', '0699', null, '2', '0000-00-00', null, null, null, '680.00', '56,66', '20', '1', null);

-- ----------------------------
-- Table structure for `names`
-- ----------------------------
DROP TABLE IF EXISTS `names`;
CREATE TABLE `names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of names
-- ----------------------------
INSERT INTO `names` VALUES ('1', 'عباية عملية');
INSERT INTO `names` VALUES ('2', 'عباية مناسبة');

-- ----------------------------
-- Table structure for `room`
-- ----------------------------
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of room
-- ----------------------------
INSERT INTO `room` VALUES ('1', 'u1');
INSERT INTO `room` VALUES ('2', 'u2');
DROP TRIGGER IF EXISTS `setDateTime`;
DELIMITER ;;
CREATE TRIGGER `setDateTime` BEFORE INSERT ON `bill` FOR EACH ROW BEGIN
SET NEW._date = curdate();
SET NEW._time = curtime();
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `update_item_at_insert`;
DELIMITER ;;
CREATE TRIGGER `update_item_at_insert` AFTER INSERT ON `bill_element` FOR EACH ROW BEGIN

UPDATE item SET quantity = quantity - NEW.quantity WHERE id = NEW.item; 

END
;;
DELIMITER ;
