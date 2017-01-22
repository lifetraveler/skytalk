/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50173
Source Host           : localhost:3306
Source Database       : u632335946_main

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-01-22 17:37:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `lt_res_music`
-- ----------------------------
DROP TABLE IF EXISTS `lt_res_music`;
CREATE TABLE `lt_res_music` (
  `Resource_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Resource_No` varchar(50) NOT NULL,
  `Resource_Prop` varchar(20) DEFAULT NULL,
  `Resourse_Type` varchar(10) DEFAULT NULL,
  `Resourse_Title` varchar(50) DEFAULT NULL,
  `Resourse_Desc` varchar(200) DEFAULT NULL,
  `Resourse_Comment` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`Resource_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lt_res_music
-- ----------------------------
INSERT INTO `lt_res_music` VALUES ('1', '307536905', '1', '1', '500首不大火但很好听的华语歌', '500首不大火但很好听的华语歌', null);
INSERT INTO `lt_res_music` VALUES ('2', '359939184', '1', '1', 'skytalk第一期 伤心回忆', 'skytalk第一期 伤心回忆', null);
INSERT INTO `lt_res_music` VALUES ('3', '11661203', '1', '1', '163music--我喜欢的音乐', '163music--我喜欢的音乐', null);
INSERT INTO `lt_res_music` VALUES ('4', '526739723', '1', '1', '梦呓', '梦呓', null);

-- ----------------------------
-- Table structure for `lt_sys_user`
-- ----------------------------
DROP TABLE IF EXISTS `lt_sys_user`;
CREATE TABLE `lt_sys_user` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_NAME` varchar(20) NOT NULL,
  `USER_PWD` varchar(1000) NOT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lt_sys_user
-- ----------------------------
INSERT INTO `lt_sys_user` VALUES ('1', '卡莉斯塔', '123');

-- ----------------------------
-- Table structure for `lt_talk_main`
-- ----------------------------
DROP TABLE IF EXISTS `lt_talk_main`;
CREATE TABLE `lt_talk_main` (
  `M_Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Type_fk` varchar(10) DEFAULT NULL,
  `M_Title` varchar(50) DEFAULT NULL,
  `M_Content` text,
  `M_Createdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `M_Userid_FK` int(11) NOT NULL,
  `M_Memorydate` datetime DEFAULT NULL,
  PRIMARY KEY (`M_Id`),
  KEY `FK_USER_ID` (`M_Userid_FK`),
  CONSTRAINT `FK_USER_ID` FOREIGN KEY (`M_Userid_FK`) REFERENCES `lt_sys_user` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lt_talk_main
-- ----------------------------
INSERT INTO `lt_talk_main` VALUES ('1', '1', 'landing guy', 'magic', '2017-01-18 16:55:32', '1', '2017-01-22 16:06:12');
INSERT INTO `lt_talk_main` VALUES ('2', '2', '世界末日去旅行', '世界末日去旅行，time waits for no one，真希望时间永远停留在这里。不知道下一次来这个无名山上，是否还能找到这块石头，这些留言是不是已经被藏地圣雪所覆盖，如果可以穿越时空就好了，遇到曾经的自己。', '2017-01-22 16:06:21', '1', '2012-06-25 00:00:00');
INSERT INTO `lt_talk_main` VALUES ('3', '2', '联系', '跟她联系，不会再让情绪去反复无常，不在去痛不欲生，接受失去，拥抱现在。嗯，跟她联系，问问近况，寒暄几句，就是如此而已。', '2017-01-22 16:06:25', '1', '2014-12-31 00:00:00');
INSERT INTO `lt_talk_main` VALUES ('4', '2', '从未变过', '那些美丽的，感动的，甚至痛苦的，心碎的瞬间，最近总是不经意的闪现在我眼前，那种感觉从未变过。', '2017-01-22 16:06:28', '1', '2015-04-03 00:00:00');
INSERT INTO `lt_talk_main` VALUES ('5', '2', '我若浮萍', '都结婚了。以前得知这些消息的时候，以为自己会很在意，但是心如死水。而在很久以后，忽然想起那些美丽的瞬间，凌晨3点出去漫步，逆光看着她的样子，她在海边跟我打闹的情景，枕边人头发散在耳边，温柔耳语，在车站耐心的等候着我晚点的列车，在机场送别时肆意而流的泪水，这一切，终将化为了一幅幅定格的记忆照片，我不知道时间会不会让他变旧，别人的尘埃落定，我若浮萍。', '2017-01-22 16:06:31', '1', '2015-04-04 00:00:00');
INSERT INTO `lt_talk_main` VALUES ('6', '2', '何必在乎过去', '何必在乎过去， 何必让过去历历涌上心头， 过去都已过去， 别让回忆占据你的天空。', '2017-01-22 16:06:34', '1', '2016-04-05 00:00:00');
INSERT INTO `lt_talk_main` VALUES ('7', '2', '世界上最没用的东西是什么？(转载知乎)', '旧手机的充电器\r\n                暗恋时的独角戏\r\n                情人节后的鲜花\r\n                单身狗的第二杯半价\r\n\r\n                政客上任的许诺\r\n                渴望理解的诉说\r\n                花前月下的誓言\r\n                回忆里微笑的脸\r\n\r\n                过期的悔恨\r\n                懦弱的容忍\r\n                寒假前的作息表\r\n                满街的宣传口号\r\n\r\n                天赋不足的认真\r\n                无疾而终的情深\r\n                所谓寂寞空虚冷\r\n                不可说与人知的疼\r\n\r\n                失败后的借口\r\n                酒桌上的朋友\r\n                年轻时为你写的诗\r\n                心血来潮时的雄心壮志\r\n\r\n                收藏夹里的心灵鸡汤\r\n                总结汇报的官样文章\r\n                额度不够的信用卡\r\n                还有我这百无一用的回答', '2017-01-22 16:06:36', '1', '2016-04-09 00:00:00');
