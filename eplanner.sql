/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : eplanner

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-06-19 11:09:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `audit_trail`
-- ----------------------------
DROP TABLE IF EXISTS `audit_trail`;
CREATE TABLE `audit_trail` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `action` varchar(50) NOT NULL,
  `objective` varchar(200) NOT NULL,
  `ip_address` varchar(150) NOT NULL,
  `originated_by` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of audit_trail
-- ----------------------------
INSERT INTO `audit_trail` VALUES ('1', 'Deletion', 'objective 1', 'root@localhost', 'Daniel ', 'Daniel ', '2020-06-17 11:24:27');
INSERT INTO `audit_trail` VALUES ('2', 'Updation', 'Test all R34 Themostats responsivenes', 'root@localhost', '', 'Daniel ', '2020-06-17 12:06:21');
INSERT INTO `audit_trail` VALUES ('3', 'Updation', 'Test all R34 Themostats responsiveness', 'root@localhost', '', 'Daniel ', '2020-06-17 12:12:55');

-- ----------------------------
-- Table structure for `branch`
-- ----------------------------
DROP TABLE IF EXISTS `branch`;
CREATE TABLE `branch` (
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of branch
-- ----------------------------
INSERT INTO `branch` VALUES (' Headquarters');
INSERT INTO `branch` VALUES ('Borrowdale depot');
INSERT INTO `branch` VALUES ('Kuwadzana depot');
INSERT INTO `branch` VALUES ('Mabelreign depot');
INSERT INTO `branch` VALUES ('Makoni depot');
INSERT INTO `branch` VALUES ('Waynne st depot');

-- ----------------------------
-- Table structure for `branch_plan`
-- ----------------------------
DROP TABLE IF EXISTS `branch_plan`;
CREATE TABLE `branch_plan` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `branch` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `deadline` date NOT NULL,
  `priority` int(3) NOT NULL,
  `status` int(3) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `priority_fk` (`priority`),
  KEY `status_fk` (`status`),
  KEY `user_fk` (`created_by`),
  KEY `branch_fk` (`branch`),
  CONSTRAINT `branch_fk` FOREIGN KEY (`branch`) REFERENCES `branch` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `priority_fk` FOREIGN KEY (`priority`) REFERENCES `task_priority` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `status_fk` FOREIGN KEY (`status`) REFERENCES `task_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`firstname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of branch_plan
-- ----------------------------
INSERT INTO `branch_plan` VALUES ('1', 'Borrowdale Depot', 'Testing amending effect', '2020-06-17', '0', '1', '2020-06-19 10:57:43', 'Denyaar');

-- ----------------------------
-- Table structure for `daily_plan`
-- ----------------------------
DROP TABLE IF EXISTS `daily_plan`;
CREATE TABLE `daily_plan` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `weekly_okr` int(21) NOT NULL,
  `target` varchar(200) NOT NULL,
  `priority` int(3) NOT NULL,
  `status` int(3) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`,`created_by`),
  KEY `id` (`id`),
  KEY `dt_weekly_okr_fk` (`weekly_okr`),
  KEY `dt_user_fk` (`created_by`),
  KEY `dt_priority_fk` (`priority`),
  KEY `dt_status_fk` (`status`),
  CONSTRAINT `dt_priority_fk` FOREIGN KEY (`priority`) REFERENCES `task_priority` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dt_status_fk` FOREIGN KEY (`status`) REFERENCES `task_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dt_user_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`firstname`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dt_weekly_okr_fk` FOREIGN KEY (`weekly_okr`) REFERENCES `weekly_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of daily_plan
-- ----------------------------
INSERT INTO `daily_plan` VALUES ('3', '8', 'testing', '1', '-1', '2020-06-17 14:13:25', '2020-06-17 14:13:25', 'tendai');
INSERT INTO `daily_plan` VALUES ('5', '8', 'testing', '1', '-1', '2020-06-17 14:17:34', '2020-06-17 14:17:34', 'tendai');
INSERT INTO `daily_plan` VALUES ('6', '8', 'testing and fitting', '1', '-1', '2020-06-19 08:22:26', '2020-06-19 08:22:26', 'Audrey');
INSERT INTO `daily_plan` VALUES ('7', '8', 'testing and fitting', '1', '-1', '2020-06-19 08:23:00', '2020-06-19 08:23:00', 'Audrey');
INSERT INTO `daily_plan` VALUES ('8', '8', 'testing and fitting', '1', '-1', '2020-06-19 08:25:26', '2020-06-19 08:25:26', 'Audrey');
INSERT INTO `daily_plan` VALUES ('9', '8', 'testing', '0', '-1', '2020-06-19 08:25:47', '2020-06-19 08:25:47', 'Audrey');
INSERT INTO `daily_plan` VALUES ('11', '8', 'testing triggers', '1', '-1', '2020-06-19 08:42:54', '2020-06-19 08:42:54', 'tendai');

-- ----------------------------
-- Table structure for `daily_timeline`
-- ----------------------------
DROP TABLE IF EXISTS `daily_timeline`;
CREATE TABLE `daily_timeline` (
  `daily_okr` int(21) NOT NULL,
  `8:00-10:00` varchar(200) DEFAULT 'Not Set',
  `10:30-12:00` varchar(200) DEFAULT 'Not Set',
  `12:00-13:00` varchar(200) DEFAULT 'Not Set',
  `14:00-16:30` varchar(200) DEFAULT 'Not Set',
  PRIMARY KEY (`daily_okr`),
  CONSTRAINT `dt_weekly_ork_fk` FOREIGN KEY (`daily_okr`) REFERENCES `daily_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of daily_timeline
-- ----------------------------
INSERT INTO `daily_timeline` VALUES ('5', 'Kumwa tea', 'Kuona muskina', 'Mmm kungogara', 'Kumwa doro');
INSERT INTO `daily_timeline` VALUES ('8', 'Kumwa tea', 'Www', 'Ght', 'Tyhinh');
INSERT INTO `daily_timeline` VALUES ('9', 'Gjwri', 'Aeifji', 'Dsivsjdi', 'Divajd');
INSERT INTO `daily_timeline` VALUES ('11', 'Sfkos', 'Adodko', 'Akdovksdo', 'Osdokso');

-- ----------------------------
-- Table structure for `failed_login`
-- ----------------------------
DROP TABLE IF EXISTS `failed_login`;
CREATE TABLE `failed_login` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of failed_login
-- ----------------------------
INSERT INTO `failed_login` VALUES ('1', 'slatesjnr@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '2020-06-08 13:06:32');
INSERT INTO `failed_login` VALUES ('2', 'slatesjnr@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:06:56');
INSERT INTO `failed_login` VALUES ('3', 'sma@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:08:22');
INSERT INTO `failed_login` VALUES ('4', 'sma@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:09:03');
INSERT INTO `failed_login` VALUES ('5', 'slatesjnr@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:10:10');
INSERT INTO `failed_login` VALUES ('6', 'slatesjnr@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:12:48');
INSERT INTO `failed_login` VALUES ('7', 'slatesjnr@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:13:03');
INSERT INTO `failed_login` VALUES ('8', 'employee@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:20:42');
INSERT INTO `failed_login` VALUES ('9', 'employee@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:23:24');
INSERT INTO `failed_login` VALUES ('10', 'slatesjnr@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:23:54');
INSERT INTO `failed_login` VALUES ('11', 'slatesjnr@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:25:51');
INSERT INTO `failed_login` VALUES ('12', 'slatesjnr@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:26:38');
INSERT INTO `failed_login` VALUES ('13', 'employee@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-06-08 13:27:41');
INSERT INTO `failed_login` VALUES ('14', 'slatesjnr@gmail.com', '12345', '2020-06-10 13:29:58');
INSERT INTO `failed_login` VALUES ('15', 'slatesjnr@gmail.com', '12345', '2020-06-10 13:30:08');
INSERT INTO `failed_login` VALUES ('16', 'slatesjnr@gmail.com', '1234', '2020-06-10 13:30:15');
INSERT INTO `failed_login` VALUES ('17', 'supervisor@gmail.com', 'psocha01', '2020-06-18 13:34:58');
INSERT INTO `failed_login` VALUES ('18', 'slatesjnr@gmail.com', '12345', '2020-06-19 08:25:58');

-- ----------------------------
-- Table structure for `inventory`
-- ----------------------------
DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `reorder_cap` int(21) NOT NULL,
  `quantity` int(21) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inventory
-- ----------------------------
INSERT INTO `inventory` VALUES ('1', 'GFCI', '30', '5', '2020-06-08 15:28:03');
INSERT INTO `inventory` VALUES ('2', '45HV MCB unit', '50', '1', '2020-06-08 15:28:32');

-- ----------------------------
-- Table structure for `leave_form`
-- ----------------------------
DROP TABLE IF EXISTS `leave_form`;
CREATE TABLE `leave_form` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of leave_form
-- ----------------------------
INSERT INTO `leave_form` VALUES ('2', 'maternity', '2020-06-18', '2020-06-22', 'Accepted', 'tendai', '2020-06-17 14:57:08');

-- ----------------------------
-- Table structure for `report_frequency`
-- ----------------------------
DROP TABLE IF EXISTS `report_frequency`;
CREATE TABLE `report_frequency` (
  `reference` int(11) NOT NULL,
  `frequency` varchar(100) NOT NULL,
  PRIMARY KEY (`frequency`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of report_frequency
-- ----------------------------
INSERT INTO `report_frequency` VALUES ('1', 'daily');
INSERT INTO `report_frequency` VALUES ('30', 'monthly');
INSERT INTO `report_frequency` VALUES ('7', 'weekly');

-- ----------------------------
-- Table structure for `report_subject`
-- ----------------------------
DROP TABLE IF EXISTS `report_subject`;
CREATE TABLE `report_subject` (
  `subject` varchar(100) NOT NULL,
  PRIMARY KEY (`subject`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of report_subject
-- ----------------------------
INSERT INTO `report_subject` VALUES ('plans & okr\'s');

-- ----------------------------
-- Table structure for `requisition`
-- ----------------------------
DROP TABLE IF EXISTS `requisition`;
CREATE TABLE `requisition` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `item` varchar(50) NOT NULL,
  `quantity` int(21) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '-1',
  `created_by` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of requisition
-- ----------------------------
INSERT INTO `requisition` VALUES ('1', 'transformer', '1', 'borrowdale depot', '0', 'system', '2020-06-10 13:40:32');
INSERT INTO `requisition` VALUES ('3', 'various items', '6', 'borrowdale depot', '-1', 'system', '2020-06-10 13:42:10');
INSERT INTO `requisition` VALUES ('7', 'GFCI', '5', 'Borrowdale depot', '-1', 'employee@gmail.com', '2020-06-10 16:53:24');
INSERT INTO `requisition` VALUES ('8', 'GFCI', '6', 'Borrowdale depot', '-1', 'employee@gmail.com', '2020-06-10 16:55:20');
INSERT INTO `requisition` VALUES ('9', 'GFCI', '7', 'Borrowdale depot', '-1', 'employee@gmail.com', '2020-06-10 16:56:59');
INSERT INTO `requisition` VALUES ('10', 'GFCI', '8', 'Borrowdale depot', '1', 'employee@gmail.com', '2020-06-10 16:57:10');
INSERT INTO `requisition` VALUES ('11', 'GFCI', '45', 'Borrowdale depot', '0', 'employee@gmail.com', '2020-06-10 17:04:36');
INSERT INTO `requisition` VALUES ('12', 'GFCI', '10', 'Borrowdale depot', '0', 'employee@gmail.com', '2020-06-10 17:05:24');

-- ----------------------------
-- Table structure for `task_priority`
-- ----------------------------
DROP TABLE IF EXISTS `task_priority`;
CREATE TABLE `task_priority` (
  `id` int(21) NOT NULL,
  `level` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of task_priority
-- ----------------------------
INSERT INTO `task_priority` VALUES ('0', 'High');
INSERT INTO `task_priority` VALUES ('1', 'Normal');
INSERT INTO `task_priority` VALUES ('2', 'Low');

-- ----------------------------
-- Table structure for `task_status`
-- ----------------------------
DROP TABLE IF EXISTS `task_status`;
CREATE TABLE `task_status` (
  `id` int(21) NOT NULL,
  `state` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of task_status
-- ----------------------------
INSERT INTO `task_status` VALUES ('-1', 'New');
INSERT INTO `task_status` VALUES ('0', 'Commited');
INSERT INTO `task_status` VALUES ('1', 'Done');
INSERT INTO `task_status` VALUES ('2', 'Postponed');
INSERT INTO `task_status` VALUES ('3', 'Delayed');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `mobile_phone` int(11) DEFAULT NULL,
  `access_level` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `time_in` datetime DEFAULT NULL,
  `logged` varchar(0) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `firstname` (`firstname`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('13', 'tendai', 'mupezeni', '12345', '772539455', 'employee', 'employee@gmail.com', 'Borrowdale depot', '2020-06-19 00:00:00', '', '2020-06-08 13:37:05');
INSERT INTO `user` VALUES ('21', 'Denyaar', 'Mupenzeni', '12345', '772353401', 'admin', 'admin@gmail.com', 'HQ', '2020-06-19 00:00:00', '', '2020-06-10 17:43:50');
INSERT INTO `user` VALUES ('34', 'Daniel ', 'Chipezvezve', '12345', '771356445', 'supervisor', 'supervisor@gmail.com', 'Borrowdale depot', '2020-06-19 00:00:00', '', '2020-06-17 09:26:01');
INSERT INTO `user` VALUES ('35', 'Audrey', 'Musonza', '12345', null, 'employee', 'employee1@gmail.com', 'Borrowdale depot', '2020-06-18 00:00:00', '', '2020-06-18 15:12:41');

-- ----------------------------
-- Table structure for `weekly_plan`
-- ----------------------------
DROP TABLE IF EXISTS `weekly_plan`;
CREATE TABLE `weekly_plan` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `branch_okr` int(21) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `objective` varchar(200) NOT NULL,
  `deadline` date NOT NULL,
  `priority` int(3) NOT NULL,
  `decision` int(3) NOT NULL DEFAULT '-1',
  `status` int(3) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wp_user_fk` (`created_by`),
  KEY `wp_priority_fk` (`priority`),
  KEY `wp_status_fk` (`status`),
  KEY `wp_okr_fk` (`branch_okr`),
  KEY `wp_branch_fk` (`branch`),
  KEY `wp_decision_fk` (`decision`),
  CONSTRAINT `wp_branch_fk` FOREIGN KEY (`branch`) REFERENCES `branch` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wp_okr_fk` FOREIGN KEY (`branch_okr`) REFERENCES `branch_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wp_priority_fk` FOREIGN KEY (`priority`) REFERENCES `task_priority` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wp_status_fk` FOREIGN KEY (`status`) REFERENCES `task_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wp_user_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`firstname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of weekly_plan
-- ----------------------------
INSERT INTO `weekly_plan` VALUES ('8', '1', 'Borrowdale depot', 'Test all R34 Themostats responsiveness', '2020-06-19', '1', '-1', '0', '2020-06-17 10:37:35', 'Daniel ');
INSERT INTO `weekly_plan` VALUES ('9', '1', 'Mabelreign depot', 'servicing of all transformers', '2020-06-22', '1', '1', '1', '2020-06-17 09:52:31', 'Daniel ');
INSERT INTO `weekly_plan` VALUES ('10', '1', 'Makoni depot', 'servicing of all transformers', '2020-06-22', '1', '-1', '-1', '2020-06-16 09:52:53', 'Daniel ');
DROP TRIGGER IF EXISTS `after_daily_plan_insert`;
DELIMITER ;;
CREATE TRIGGER `after_daily_plan_insert` AFTER INSERT ON `daily_plan` FOR EACH ROW BEGIN
													
													UPDATE weekly_plan SET weekly_plan.status = 0 WHERE id = (SELECT weekly_okr FROM daily_plan ORDER BY date_created DESC LIMIT 1);
							END
;;
DELIMITER ;
