/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : point

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-12 16:32:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(64) DEFAULT NULL COMMENT '类型',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `front` varchar(500) DEFAULT NULL COMMENT '简介',
  `content` text COMMENT '内容',
  `addtime` datetime DEFAULT NULL,
  `click` int(11) DEFAULT '0' COMMENT '点击次数',
  `picture` varchar(255) DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '2', '测试', '我的简介', '<p>测试article</p>', '2018-05-12 16:04:25', '12', '/uploads/20180512\\f7ca97ed5671153c6773610fefa4bf87.jpg');
INSERT INTO `article` VALUES ('2', '1', 'JIFEN攻略', 'JIFEN攻略JIFEN攻略', '<p>DSA都JIFEN攻略JIFEN攻略WFF</p>', '2018-05-12 15:57:43', '3', '/uploads/20180512\\9cfe77f9a8ad01258a094b02c71b8e05.jpg');

-- ----------------------------
-- Table structure for article_type
-- ----------------------------
DROP TABLE IF EXISTS `article_type`;
CREATE TABLE `article_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '类名',
  `picture` varchar(255) DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_type
-- ----------------------------
INSERT INTO `article_type` VALUES ('1', '积分攻略', '/uploads/20180512\\71a4c124c7a4be434bffd764e0475817.jpg');
INSERT INTO `article_type` VALUES ('2', '优惠活动', '/uploads/20180512\\9bc8c58ae2fa997b0137cfc60a131663.jpg');

-- ----------------------------
-- Table structure for bank
-- ----------------------------
DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(500) DEFAULT NULL COMMENT '图片',
  `bankname` varchar(32) DEFAULT NULL COMMENT '银行名称',
  `zy_radio` decimal(10,2) DEFAULT NULL COMMENT '专员 每1w积分兑现金额',
  `jl_radio` decimal(10,2) DEFAULT NULL,
  `hz_radio` decimal(10,2) DEFAULT NULL,
  `yhj_radio` decimal(10,2) DEFAULT NULL,
  `remark` varchar(1000) DEFAULT NULL COMMENT '描述',
  `step` text COMMENT '兑换步骤',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bank
-- ----------------------------
INSERT INTO `bank` VALUES ('1', '/uploads/20180609\\fd1d719ee6042b08343b1b98d32a0cd3.png', '建设银行', '14.00', '15.00', '16.00', '17.00', '<p>打撒无无无</p>', '<p>测试建设银行</p>');
INSERT INTO `bank` VALUES ('2', '/uploads/20180609\\db571952cc06904413a5654ae29b77fb.png', '工商银行', '18.00', '19.00', '20.00', '21.00', '<p>3三大</p>', '<p>wad</p>');
INSERT INTO `bank` VALUES ('3', '/uploads/20180609\\9c1e55d6a8e17bb9243064f108774731.png', '招商银行', '12.00', '13.00', '17.00', '19.00', '<p>POIWAL</p>', '<p>UNKAL</p>');
INSERT INTO `bank` VALUES ('4', '/uploads/20180609\\b0d8b7b36f3322913a421d3edcc2a51d.png', '农业银行', '13.00', '14.00', '15.00', '16.00', '<p>豆腐干地方</p>', '<p>的法官沟通</p>');
INSERT INTO `bank` VALUES ('5', '/uploads/20180609\\4b5bee56c30e99e524ca072f482a0a1f.png', '中国银行', '10.00', '11.00', '16.00', '18.00', '<p>发的说说</p>', '<p>阿瑟</p>');
INSERT INTO `bank` VALUES ('11', '/uploads/20180609\\b0d8b7b36f3322913a421d3edcc2a51d.png', '儿童', '9.00', '10.00', '11.00', '12.00', '和查询积分：使用银行预留手机号编辑短信“CXJF”发送到95533或关注“中国建设银行”公众号，绑定信用卡，回复“积分”', '热');
INSERT INTO `bank` VALUES ('12', '/uploads/20180609\\b0d8b7b36f3322913a421d3edcc2a51d.png', '有阿', '1.00', '2.00', '4.00', '5.00', '绕太阳', ' 的');
INSERT INTO `bank` VALUES ('13', '/uploads/20180609\\b0d8b7b36f3322913a421d3edcc2a51d.png', '房贷首付', '110.00', '111.00', '112.00', '113.00', '是', '我虽然');
INSERT INTO `bank` VALUES ('10', '/uploads/20180609\\b0d8b7b36f3322913a421d3edcc2a51d.png', '拒绝', '6.00', '7.00', '8.00', '9.00', '个', '个');
INSERT INTO `bank` VALUES ('14', '/uploads/20180609\\b0d8b7b36f3322913a421d3edcc2a51d.png', '对方是个', '111.00', '112.00', '113.00', '444.00', '太容易', '请问');
INSERT INTO `bank` VALUES ('15', '/uploads/20180609\\b0d8b7b36f3322913a421d3edcc2a51d.png', '的撒', '1111.00', '1111.00', '1111.00', '1111.00', '无法', '阿');
INSERT INTO `bank` VALUES ('16', '/uploads/20180609\\b0d8b7b36f3322913a421d3edcc2a51d.png', '啊实打实', '333.00', '333.00', '333.00', '333.00', '托付给', '阿萨大');

-- ----------------------------
-- Table structure for comlog
-- ----------------------------
DROP TABLE IF EXISTS `comlog`;
CREATE TABLE `comlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL COMMENT '金额',
  `addtime` date DEFAULT NULL,
  `remark` varchar(1000) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comlog
-- ----------------------------
INSERT INTO `comlog` VALUES ('1', '5', '10.00', '2018-05-10', '测试');
INSERT INTO `comlog` VALUES ('2', '5', '20.00', '2018-05-10', '诶我去三大');
INSERT INTO `comlog` VALUES ('3', '5', '10.00', '2018-05-12', '您的下级用户t02兑换积分获得佣金');
INSERT INTO `comlog` VALUES ('4', '5', '30.00', '2018-05-15', '1');
INSERT INTO `comlog` VALUES ('5', '5', '300.00', '2018-05-15', '2');
INSERT INTO `comlog` VALUES ('6', '5', '12.00', '2018-05-15', '3');
INSERT INTO `comlog` VALUES ('7', '5', '32.00', '2018-05-15', '4');
INSERT INTO `comlog` VALUES ('8', '5', '65.00', '2018-05-15', '5');
INSERT INTO `comlog` VALUES ('9', '5', '5.00', '2018-05-15', '6');
INSERT INTO `comlog` VALUES ('10', '5', '75.00', '2018-05-15', '7');
INSERT INTO `comlog` VALUES ('11', '5', '8.00', '2018-05-15', '8');
INSERT INTO `comlog` VALUES ('12', '5', '5.00', '2018-05-15', '9');
INSERT INTO `comlog` VALUES ('13', '5', '66.00', '2018-05-15', '10');
INSERT INTO `comlog` VALUES ('14', '5', '36.00', '2018-05-15', '11');
INSERT INTO `comlog` VALUES ('15', '4', '10.00', '2018-05-16', '您的下级用户t02兑换积分获得佣金');
INSERT INTO `comlog` VALUES ('16', '4', '10.00', '2018-05-16', '您的下级用户t02兑换积分获得佣金');
INSERT INTO `comlog` VALUES ('17', '4', '1.00', '2018-05-16', '您的直接推荐用户at升级获得佣金');
INSERT INTO `comlog` VALUES ('18', '4', '0.00', '2018-05-16', '您的直接推荐用户at升级获得佣金');
INSERT INTO `comlog` VALUES ('19', '4', '0.00', '2018-05-16', '您的直接推荐用户at升级获得佣金');
INSERT INTO `comlog` VALUES ('20', '4', '0.00', '2018-05-16', '您的直接推荐用户at升级获得佣金');
INSERT INTO `comlog` VALUES ('21', '4', '0.00', '2018-05-16', '您的直接推荐用户at升级获得佣金');
INSERT INTO `comlog` VALUES ('22', '4', '0.00', '2018-05-16', '您的直接推荐用户at升级获得佣金');
INSERT INTO `comlog` VALUES ('23', '4', '150.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('24', '4', '90.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('25', '4', '90.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('26', '4', '120.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('27', '4', '120.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('28', '6', '90.00', '2018-05-16', '您的间接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('29', '4', '120.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('30', '6', '90.00', '2018-05-16', '您的间接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('31', '4', '160.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('32', '6', '120.00', '2018-05-16', '您的间接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('33', '4', '160.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('34', '6', '40.00', '2018-05-16', '您的间接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('35', '4', '160.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('36', '6', '40.00', '2018-05-16', '您的间接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('37', '4', '120.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('38', '6', '30.00', '2018-05-16', '您的间接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('39', '4', '160.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('40', '6', '40.00', '2018-05-16', '您的间接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('41', '4', '80.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('42', '6', '40.00', '2018-05-16', '您的间接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('43', '4', '280.00', '2018-05-16', '您的直接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('44', '6', '140.00', '2018-05-16', '您的间接推荐用户t02升级获得佣金');
INSERT INTO `comlog` VALUES ('45', '10', '30.00', '2018-05-28', '用户188兑换积分获得金额');
INSERT INTO `comlog` VALUES ('46', '5', '2.00', '2018-05-28', '您的下级用户188兑换积分获得佣金');
INSERT INTO `comlog` VALUES ('47', '10', '30.00', '2018-05-28', '用户188兑换积分获得金额');
INSERT INTO `comlog` VALUES ('48', '5', '2.00', '2018-05-28', '您的下级用户188兑换积分获得佣金');
INSERT INTO `comlog` VALUES ('49', '10', '29.00', '2018-05-28', '用户188兑换积分获得金额');
INSERT INTO `comlog` VALUES ('50', '5', '2.00', '2018-05-28', '您的下级用户188兑换积分获得佣金');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', 'withdraw_min', '100', '最低提现额度');
INSERT INTO `config` VALUES ('2', 'withdraw_fee', '100', '提现手续费');
INSERT INTO `config` VALUES ('3', 'erweima', '/uploads/20180528\\97ba73ab1b96f3766b9881a8f39a0c40.png', '网站二维码');
INSERT INTO `config` VALUES ('4', 'tplCode', 'SMS_127150414', '短信模板tplCode');
INSERT INTO `config` VALUES ('5', 'accessKeyId', 'LTAIN2NZSOBAdOkR', '短信accessKeyId');
INSERT INTO `config` VALUES ('6', 'accessKeySecret', 'nUrxgARFqmRYkNHCKJhZ9oMwasoFk7', '短信accessKeySecret');
INSERT INTO `config` VALUES ('7', 'signName', '验证码', '短信签名');
INSERT INTO `config` VALUES ('8', 'MCHID', '1489037672', '微信MCHID');
INSERT INTO `config` VALUES ('9', 'KEY', 'GOkQU8WRJB9817AEjrmCuHKNYYLm75d8', '微信KEY');
INSERT INTO `config` VALUES ('10', 'APPSECRET', '4247301715d8a534688bb39ebb878354', '微信APPSECRET');
INSERT INTO `config` VALUES ('11', 'APPID', 'wxda449a3ea330db75', '微信APPID');

-- ----------------------------
-- Table structure for exchange
-- ----------------------------
DROP TABLE IF EXISTS `exchange`;
CREATE TABLE `exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) DEFAULT NULL COMMENT '兑换需要的积分数',
  `name` varchar(100) DEFAULT NULL COMMENT '兑换商品名称',
  `click` varchar(100) DEFAULT NULL COMMENT '兑换规则',
  `bankid` int(11) DEFAULT NULL COMMENT '银行ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exchange
-- ----------------------------
INSERT INTO `exchange` VALUES ('1', '10000', '建行兑换', '', '2');
INSERT INTO `exchange` VALUES ('2', '1000', '建行兑换22', '3', '1');
INSERT INTO `exchange` VALUES ('4', '100000', 'ds', '3', '1');

-- ----------------------------
-- Table structure for horn
-- ----------------------------
DROP TABLE IF EXISTS `horn`;
CREATE TABLE `horn` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '喇叭内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of horn
-- ----------------------------
INSERT INTO `horn` VALUES ('2', '李**成功升级成为经理');
INSERT INTO `horn` VALUES ('3', '王XX成功升级成为经理');

-- ----------------------------
-- Table structure for interest
-- ----------------------------
DROP TABLE IF EXISTS `interest`;
CREATE TABLE `interest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(10) DEFAULT NULL COMMENT '会员等级（zy,jl,hz,yhj）',
  `bewriter` varchar(1000) DEFAULT NULL COMMENT '简介',
  `content` text COMMENT '权益',
  `tjj` tinyint(4) DEFAULT NULL COMMENT '推荐奖比例（%）',
  `sjfy` tinyint(4) DEFAULT NULL COMMENT '直接推荐会员升级返佣（%）',
  `jjsjfy` tinyint(4) DEFAULT NULL COMMENT '间接推荐会员升级返佣',
  `team` decimal(4,2) DEFAULT NULL COMMENT '团队分红',
  `up` decimal(4,0) DEFAULT NULL COMMENT '升级所需要的缴费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of interest
-- ----------------------------
INSERT INTO `interest` VALUES ('1', 'zy', '免费试用', 'wda', null, '20', '10', null, '100');
INSERT INTO `interest` VALUES ('7', 'jl', '<p>qwe</p>', '<p>qwe</p>', null, '30', null, null, '200');
INSERT INTO `interest` VALUES ('3', 'hz', null, null, null, '40', '30', null, '300');
INSERT INTO `interest` VALUES ('5', 'yhj', '<p>100</p>', '<p>1000000000</p>', '10', '50', '40', '10.00', '400');

-- ----------------------------
-- Table structure for jcb_sys_action_role
-- ----------------------------
DROP TABLE IF EXISTS `jcb_sys_action_role`;
CREATE TABLE `jcb_sys_action_role` (
  `roleid` bigint(20) NOT NULL,
  `action` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jcb_sys_action_role
-- ----------------------------
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|article|index');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|article|data');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|article|add');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|article|del');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|article|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|article|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|articletype|index');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|articletype|data');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|articletype|add');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|articletype|del');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|articletype|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|articletype|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|index|index');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|index|pwd');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|member|index');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|member|data');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|member|add');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|member|del');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|member|modfiy');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|member|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|menu|index');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|menu|menu_data');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|menu|menu_set');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|menu|menu_del');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|menu|menu_add');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|role|action_set');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|role|index');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|role|role_data');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|role|add');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|role|del');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|role|modify');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|role|set_menu');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|role|menu_data');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|system|index');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|system|save');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|system|args');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|system|add_args');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|system|modify');
INSERT INTO `jcb_sys_action_role` VALUES ('3', 'admin|system|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|article|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|article|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|article|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|article|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|article|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|article|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|articletype|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|articletype|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|articletype|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|articletype|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|articletype|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|articletype|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|bank|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|bank|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|bank|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|bank|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|bank|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|bank|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|comlog|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|comlog|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|comlog|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|config|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|config|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|config|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|config|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|config|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|config|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|databackup|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|databackup|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|databackup|export');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|databackup|repair');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|databackup|optimize');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|databackup|importlist');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|databackup|datalist');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|databackup|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|databackup|import');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|exchange|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|exchange|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|exchange|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|exchange|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|exchange|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|exchange|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|horn|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|horn|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|horn|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|horn|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|index|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|index|main');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|index|pwd');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|index|clearcache');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|interest|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|interest|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|interest|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|interest|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|interest|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|interest|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|member|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|member|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|member|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|member|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|member|modfiy');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|member|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|menu|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|menu|menu_data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|menu|menu_set');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|menu|menu_del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|menu|menu_add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|notice|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|notice|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|notice|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|notice|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|notice|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|notice|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|order|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|order|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|order|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|role|action_set');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|role|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|role|role_data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|role|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|role|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|role|modify');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|role|set_menu');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|role|menu_data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|sowing|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|sowing|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|sowing|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|sowing|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|sowing|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|system|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|system|save');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|system|args');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|system|add_args');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|system|modify');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|system|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|user|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|user|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|user|add');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|user|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|user|edit');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|user|modify_field');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|withdraw|index');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|withdraw|data');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|withdraw|del');
INSERT INTO `jcb_sys_action_role` VALUES ('1', 'admin|withdraw|status');

-- ----------------------------
-- Table structure for jcb_sys_config
-- ----------------------------
DROP TABLE IF EXISTS `jcb_sys_config`;
CREATE TABLE `jcb_sys_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0',
  `key` varchar(255) DEFAULT NULL,
  `val` varchar(255) DEFAULT NULL,
  `ctype` varchar(255) DEFAULT NULL COMMENT '1 文本框  2数值框 ',
  `sort` int(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `cmark` varchar(255) DEFAULT NULL,
  `item` varchar(3000) DEFAULT NULL,
  `allowempty` tinyint(4) DEFAULT '1' COMMENT '1 为空 0 不为空',
  `issys` tinyint(4) DEFAULT '0' COMMENT '1 系统默认 不能删除',
  `ishide` tinyint(4) DEFAULT '0' COMMENT '0 显示 1隐藏',
  `ishead` tinyint(255) DEFAULT '0' COMMENT '0 否 1是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jcb_sys_config
-- ----------------------------
INSERT INTO `jcb_sys_config` VALUES ('1', '0', '', '', '0', '0', '基础设置', '', '', '0', '1', '0', '1');
INSERT INTO `jcb_sys_config` VALUES ('2', '0', '', '', '0', '0', '其它参数', '', '1', '1', '0', '0', '1');
INSERT INTO `jcb_sys_config` VALUES ('3', '1', 'title', '后台管理系统', '1', '0', '后台名称', '', '1', '1', '1', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('4', '1', 'name', '开放式系统', '1', '0', '系统名称', '系统显示名称', '上海|北京|天京', '1', '1', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('5', '1', 'name_en', 'JCB ADMIN', '1', '0', '系统英文', '系统显示英文名称', '', '1', '1', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('6', '1', 'company', '金诚宝科技有限公司', '1', '0', '公司名称', '公司名称', '', '1', '1', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('7', '1', 'copyright', 'CopyRight © 2010-2018 JCB ADMIN All Rights Reserved.', '1', '0', '系统版权', '系统版 权', '', '1', '1', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('8', '1', 'url', 'www.jcbweb.cn', '1', '0', '网址', '系统网址', '', '1', '1', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('9', '1', 'page_num', '12', '2', '0', '每页显示数', '表格中每页显示的数量', '', '1', '1', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('10', '2', 'area', '北京', '3', '0', '选择题', '请选择', '上海|北京|天京', '1', '0', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('11', '2', 'kaiguan', '0', '4', '0', '开关题', '请指定', '', '1', '0', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('19', '0', '', '', '0', '0', '前台参数', '', '', '1', '0', '0', '1');
INSERT INTO `jcb_sys_config` VALUES ('20', '19', 'front_notice', '没有什么内容', '5', '0', '前台显示', '前台显示文字', '', '1', '0', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('22', '1', 'defaulturl', '/admin/index/main', '1', '0', '默认网址', '进入后台时的默认网址 此tab不可删除', '', '1', '1', '0', '0');
INSERT INTO `jcb_sys_config` VALUES ('23', '1', 'uploadtype', 'jpg,png,gif,jpeg', '1', '0', '允许上传类型', '输入允许上传的文件类型  请用,分隔', '', '1', '1', '0', '0');

-- ----------------------------
-- Table structure for jcb_sys_ico
-- ----------------------------
DROP TABLE IF EXISTS `jcb_sys_ico`;
CREATE TABLE `jcb_sys_ico` (
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jcb_sys_ico
-- ----------------------------
INSERT INTO `jcb_sys_ico` VALUES ('主页', '#xe68e;', '1');
INSERT INTO `jcb_sys_ico` VALUES ('赞', '#xe6c6;', '2');
INSERT INTO `jcb_sys_ico` VALUES ('踩', '#xe6c5;', '3');
INSERT INTO `jcb_sys_ico` VALUES ('男', '#xe662;', '4');
INSERT INTO `jcb_sys_ico` VALUES ('女', '#xe661;', '5');
INSERT INTO `jcb_sys_ico` VALUES ('相机-空心', '#xe660;', '6');
INSERT INTO `jcb_sys_ico` VALUES ('菜单-水平', '#xe65f;', '7');
INSERT INTO `jcb_sys_ico` VALUES ('菜单-竖直', '#xe671;', '8');
INSERT INTO `jcb_sys_ico` VALUES ('菜单-水平', '#xe65f;', '9');
INSERT INTO `jcb_sys_ico` VALUES ('菜单-竖直', '#xe671;', '10');
INSERT INTO `jcb_sys_ico` VALUES ('返回', '#xe65c;', '11');
INSERT INTO `jcb_sys_ico` VALUES ('Hot', '#xe756;', '12');
INSERT INTO `jcb_sys_ico` VALUES ('404', '#xe61c;', '13');
INSERT INTO `jcb_sys_ico` VALUES ('21cake_list', '#xe60a;', '14');
INSERT INTO `jcb_sys_ico` VALUES ('emw_代码', '#xe64e;', '15');
INSERT INTO `jcb_sys_ico` VALUES ('font-strikethrough', '#xe64f;', '16');
INSERT INTO `jcb_sys_ico` VALUES ('help', '#xe607;', '17');
INSERT INTO `jcb_sys_ico` VALUES ('html', '#xe64b;', '18');
INSERT INTO `jcb_sys_ico` VALUES ('icon_树', '#xe62e;', '19');
INSERT INTO `jcb_sys_ico` VALUES ('loading', '#xe63d;', '20');
INSERT INTO `jcb_sys_ico` VALUES ('loading', '#xe63e;', '21');
INSERT INTO `jcb_sys_ico` VALUES ('star', '#xe600;', '22');
INSERT INTO `jcb_sys_ico` VALUES ('tab', '#xe62a;', '23');
INSERT INTO `jcb_sys_ico` VALUES ('top', '#xe604;', '24');
INSERT INTO `jcb_sys_ico` VALUES ('unlink', '#xe64d;', '25');
INSERT INTO `jcb_sys_ico` VALUES ('报表', '#xe629;', '26');
INSERT INTO `jcb_sys_ico` VALUES ('编辑', '#xe642;', '27');
INSERT INTO `jcb_sys_ico` VALUES ('编辑_文字', '#xe639;', '28');
INSERT INTO `jcb_sys_ico` VALUES ('表单', '#xe63c;', '29');
INSERT INTO `jcb_sys_ico` VALUES ('表格', '#xe62d;', '30');
INSERT INTO `jcb_sys_ico` VALUES ('表情', '#xe60c;', '31');
INSERT INTO `jcb_sys_ico` VALUES ('表情', '#xe650;', '32');
INSERT INTO `jcb_sys_ico` VALUES ('播放', '#xe652;', '33');
INSERT INTO `jcb_sys_ico` VALUES ('播放暂停', '#xe651;', '34');
INSERT INTO `jcb_sys_ico` VALUES ('布局', '#xe632;', '35');
INSERT INTO `jcb_sys_ico` VALUES ('窗口', '#xe638;', '36');
INSERT INTO `jcb_sys_ico` VALUES ('错-', '#x1007;', '37');
INSERT INTO `jcb_sys_ico` VALUES ('代码1', '#xe635;', '38');
INSERT INTO `jcb_sys_ico` VALUES ('单选框-候选', '#xe63f;', '39');
INSERT INTO `jcb_sys_ico` VALUES ('单选框-选中', '#xe643;', '40');
INSERT INTO `jcb_sys_ico` VALUES ('等级', '#xe735;', '41');
INSERT INTO `jcb_sys_ico` VALUES ('对', '#xe605;', '42');
INSERT INTO `jcb_sys_ico` VALUES ('对勾', '#xe618;', '43');
INSERT INTO `jcb_sys_ico` VALUES ('对话', '#xe611;', '44');
INSERT INTO `jcb_sys_ico` VALUES ('发布', '#xe609;', '45');
INSERT INTO `jcb_sys_ico` VALUES ('分享', '#xe641;', '46');
INSERT INTO `jcb_sys_ico` VALUES ('工具', '#xe631;', '47');
INSERT INTO `jcb_sys_ico` VALUES ('勾选框（未打勾）', '#xe626;', '48');
INSERT INTO `jcb_sys_ico` VALUES ('勾选框（已打勾）', '#xe627;', '49');
INSERT INTO `jcb_sys_ico` VALUES ('购物车1', '#xe698;', '50');
INSERT INTO `jcb_sys_ico` VALUES ('购物车2', '#xe657;', '51');
INSERT INTO `jcb_sys_ico` VALUES ('关于', '#xe60b;', '52');
INSERT INTO `jcb_sys_ico` VALUES ('好友请求', '#xe612;', '53');
INSERT INTO `jcb_sys_ico` VALUES ('换肤2', '#xe61b;', '54');
INSERT INTO `jcb_sys_ico` VALUES ('记录', '#xe60e;', '55');
INSERT INTO `jcb_sys_ico` VALUES ('加粗', '#xe62b;', '56');
INSERT INTO `jcb_sys_ico` VALUES ('检验', '#xe6b2;', '57');
INSERT INTO `jcb_sys_ico` VALUES ('金额-美元', '#xe659;', '58');
INSERT INTO `jcb_sys_ico` VALUES ('金额-人民币', '#xe65e;', '59');
INSERT INTO `jcb_sys_ico` VALUES ('进水', '#xe636;', '60');
INSERT INTO `jcb_sys_ico` VALUES ('居中对齐', '#xe647;', '61');
INSERT INTO `jcb_sys_ico` VALUES ('客服', '#xe606;', '62');
INSERT INTO `jcb_sys_ico` VALUES ('哭脸', '#xe69c;', '63');
INSERT INTO `jcb_sys_ico` VALUES ('喇叭', '#xe645;', '64');
INSERT INTO `jcb_sys_ico` VALUES ('链接', '#xe64c;', '65');
INSERT INTO `jcb_sys_ico` VALUES ('聊天 对话 IM 沟通', '#xe63a;', '66');
INSERT INTO `jcb_sys_ico` VALUES ('轮播组图', '#xe634;', '67');
INSERT INTO `jcb_sys_ico` VALUES ('么么直播－翻页', '#xe633;', '68');
INSERT INTO `jcb_sys_ico` VALUES ('日期', '#xe637;', '69');
INSERT INTO `jcb_sys_ico` VALUES ('三角', '#xe623;', '70');
INSERT INTO `jcb_sys_ico` VALUES ('三角', '#xe625;', '71');
INSERT INTO `jcb_sys_ico` VALUES ('删除', '#xe640;', '72');
INSERT INTO `jcb_sys_ico` VALUES ('上传', '#xe62f;', '73');
INSERT INTO `jcb_sys_ico` VALUES ('上传-空心', '#xe681;', '74');
INSERT INTO `jcb_sys_ico` VALUES ('上传-实心', '#xe67c;', '75');
INSERT INTO `jcb_sys_ico` VALUES ('上一页', '#xe65a;', '76');
INSERT INTO `jcb_sys_ico` VALUES ('设置', '#xe614;', '77');
INSERT INTO `jcb_sys_ico` VALUES ('设置', '#xe620;', '78');
INSERT INTO `jcb_sys_ico` VALUES ('视频', '#xe6ed;', '79');
INSERT INTO `jcb_sys_ico` VALUES ('手机', '#xe63b;', '80');
INSERT INTO `jcb_sys_ico` VALUES ('刷新', '#x1002;', '81');
INSERT INTO `jcb_sys_ico` VALUES ('搜索', '#xe615;', '82');
INSERT INTO `jcb_sys_ico` VALUES ('添加', '#xe61f;', '83');
INSERT INTO `jcb_sys_ico` VALUES ('添加', '#xe654;', '84');
INSERT INTO `jcb_sys_ico` VALUES ('添加', '#xe608;', '85');
INSERT INTO `jcb_sys_ico` VALUES ('图表', '#xe62c;', '86');
INSERT INTO `jcb_sys_ico` VALUES ('图片', '#xe60d;', '87');
INSERT INTO `jcb_sys_ico` VALUES ('图片', '#xe64a;', '88');
INSERT INTO `jcb_sys_ico` VALUES ('位置', '#xe715;', '89');
INSERT INTO `jcb_sys_ico` VALUES ('文档', '#xe705;', '90');
INSERT INTO `jcb_sys_ico` VALUES ('文件', '#xe621;', '91');
INSERT INTO `jcb_sys_ico` VALUES ('文件', '#xe61d;', '92');
INSERT INTO `jcb_sys_ico` VALUES ('文件夹', '#xe7a0;', '93');
INSERT INTO `jcb_sys_ico` VALUES ('文件夹', '#xe622;', '94');
INSERT INTO `jcb_sys_ico` VALUES ('文件夹_反', '#xe624;', '95');
INSERT INTO `jcb_sys_ico` VALUES ('文件下载', '#xe61e;', '96');
INSERT INTO `jcb_sys_ico` VALUES ('我的好友', '#xe613;', '97');
INSERT INTO `jcb_sys_ico` VALUES ('下一页', '#xe65b;', '98');
INSERT INTO `jcb_sys_ico` VALUES ('下载', '#xe601;', '99');
INSERT INTO `jcb_sys_ico` VALUES ('向上', '#xe619;', '100');
INSERT INTO `jcb_sys_ico` VALUES ('向下', '#xe61a;', '101');
INSERT INTO `jcb_sys_ico` VALUES ('笑脸', '#xe6af;', '102');
INSERT INTO `jcb_sys_ico` VALUES ('斜体', '#xe644;', '103');
INSERT INTO `jcb_sys_ico` VALUES ('星级', '#xe658;', '104');
INSERT INTO `jcb_sys_ico` VALUES ('选择模版48', '#xe630;', '105');
INSERT INTO `jcb_sys_ico` VALUES ('音乐', '#xe6fc;', '106');
INSERT INTO `jcb_sys_ico` VALUES ('引擎', '#xe628;', '107');
INSERT INTO `jcb_sys_ico` VALUES ('隐身-im', '#xe60f;', '108');
INSERT INTO `jcb_sys_ico` VALUES ('应用', '#xe857;', '109');
INSERT INTO `jcb_sys_ico` VALUES ('右对齐', '#xe648;', '110');
INSERT INTO `jcb_sys_ico` VALUES ('右右', '#xe602;', '111');
INSERT INTO `jcb_sys_ico` VALUES ('语音', '#xe688;', '112');
INSERT INTO `jcb_sys_ico` VALUES ('圆点', '#xe617;', '113');
INSERT INTO `jcb_sys_ico` VALUES ('阅卷错号', '#x1006;', '114');
INSERT INTO `jcb_sys_ico` VALUES ('在线', '#xe610;', '115');
INSERT INTO `jcb_sys_ico` VALUES ('正确', '#x1005;', '116');
INSERT INTO `jcb_sys_ico` VALUES ('正确', '#xe616;', '117');
INSERT INTO `jcb_sys_ico` VALUES ('字体-下划线', '#xe646;', '118');
INSERT INTO `jcb_sys_ico` VALUES ('左对齐', '#xe649;', '119');
INSERT INTO `jcb_sys_ico` VALUES ('左左', '#xe603;', '120');

-- ----------------------------
-- Table structure for jcb_sys_member
-- ----------------------------
DROP TABLE IF EXISTS `jcb_sys_member`;
CREATE TABLE `jcb_sys_member` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `cstatus` tinyint(4) DEFAULT '1',
  `roleid` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of jcb_sys_member
-- ----------------------------
INSERT INTO `jcb_sys_member` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', '管理员', '/uploads/20171230\\e5038d874b758fa3b84a444b144e8b09.png', '1', '1');
INSERT INTO `jcb_sys_member` VALUES ('2', '123456', 'e10adc3949ba59abbe56e057f20f883e', '管理员', '/uploads/20171230\\e5038d874b758fa3b84a444b144e8b09.png', '1', '1');

-- ----------------------------
-- Table structure for jcb_sys_member_menu
-- ----------------------------
DROP TABLE IF EXISTS `jcb_sys_member_menu`;
CREATE TABLE `jcb_sys_member_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `module` varchar(20) DEFAULT NULL,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `url` char(255) DEFAULT NULL COMMENT '链接地址',
  `icon` varchar(64) DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `type` varchar(40) DEFAULT NULL COMMENT 'nav,auth',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='后台菜单';

-- ----------------------------
-- Records of jcb_sys_member_menu
-- ----------------------------
INSERT INTO `jcb_sys_member_menu` VALUES ('13', 'member', '0', '个人资料', '', 'fa-users fa-lg', '1', 'nav');
INSERT INTO `jcb_sys_member_menu` VALUES ('14', 'member', '13', '我的资料', 'member/account/profile', '', '1', 'nav');
INSERT INTO `jcb_sys_member_menu` VALUES ('15', 'member', '13', '修改密码', 'member/account/password', '', '2', 'nav');
INSERT INTO `jcb_sys_member_menu` VALUES ('19', 'member', '0', '我的订单', '', 'fa-credit-card fa-lg', '0', 'nav');
INSERT INTO `jcb_sys_member_menu` VALUES ('20', 'member', '13', '地址簿', 'member/account/address', '', '3', 'nav');
INSERT INTO `jcb_sys_member_menu` VALUES ('21', 'member', '19', '订单管理', 'member/order_member/index', '', '1', 'nav');
INSERT INTO `jcb_sys_member_menu` VALUES ('22', 'member', '21', '订单详情', 'member/order_member/show_order', '', '1', 'auth');
INSERT INTO `jcb_sys_member_menu` VALUES ('23', 'member', '21', '订单历史', 'member/order_member/history', '', '0', 'auth');
INSERT INTO `jcb_sys_member_menu` VALUES ('25', 'member', '20', '新增', 'member/account/add_address', '', '0', 'auth');
INSERT INTO `jcb_sys_member_menu` VALUES ('26', 'member', '20', '编辑', 'member/account/edit_address', '', '0', 'auth');
INSERT INTO `jcb_sys_member_menu` VALUES ('27', 'member', '20', '删除', 'member/account/del_address', '', '0', 'auth');
INSERT INTO `jcb_sys_member_menu` VALUES ('28', 'member', '21', '取消订单', 'member/order_member/cancel', '', '0', 'auth');

-- ----------------------------
-- Table structure for jcb_sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `jcb_sys_menu`;
CREATE TABLE `jcb_sys_menu` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sort` bigint(255) DEFAULT NULL,
  `istop` tinyint(255) DEFAULT '0',
  `isshow` tinyint(255) DEFAULT '0',
  `ico` varchar(255) DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jcb_sys_menu
-- ----------------------------
INSERT INTO `jcb_sys_menu` VALUES ('1', '0', '系统设置', '9', '1', '1', '&#xe614;', '');
INSERT INTO `jcb_sys_menu` VALUES ('2', '1', '菜单设置', '1', '1', '1', '&#xe647;', '/admin/menu/index');
INSERT INTO `jcb_sys_menu` VALUES ('3', '1', '角色列表', '2', '1', '1', '&#xe62a;', '/admin/role/index');
INSERT INTO `jcb_sys_menu` VALUES ('4', '0', '金诚宝', '0', '1', '0', '&#xe609;', 'http://www.jcbweb.cn');
INSERT INTO `jcb_sys_menu` VALUES ('5', '1', '后台用户', '3', '1', '1', '&#xe612;', '/admin/member/index');
INSERT INTO `jcb_sys_menu` VALUES ('6', '1', '参数设置', '5', '1', '0', '&#xe631;', '/admin/system/index');
INSERT INTO `jcb_sys_menu` VALUES ('7', '1', '参数命名', '4', '1', '1', '&#xe620;', '/admin/system/args');
INSERT INTO `jcb_sys_menu` VALUES ('14', '1', '备份还原', '7', '1', '1', '&#xe681;', '/admin/databackup/index');
INSERT INTO `jcb_sys_menu` VALUES ('15', '0', '订单管理', '4', '0', '1', '&#xe60a;', '/admin/order/index');
INSERT INTO `jcb_sys_menu` VALUES ('16', '0', '用户管理', '2', '0', '1', '&#xe857;', '/admin/user/index');
INSERT INTO `jcb_sys_menu` VALUES ('17', '0', '新闻管理', '3', '0', '1', '&#xe6ed;', '/admin/article/index');
INSERT INTO `jcb_sys_menu` VALUES ('18', '0', '提现列表', '6', '0', '1', '&#xe600;', '/admin/withdraw/index');
INSERT INTO `jcb_sys_menu` VALUES ('19', '0', '公告', '8', '0', '1', '&#xe756;', '/admin/notice/index');
INSERT INTO `jcb_sys_menu` VALUES ('20', '0', '新闻类型', '3', '0', '1', '&#xe604;', '/admin/articleType/index');
INSERT INTO `jcb_sys_menu` VALUES ('21', '0', '银行管理', '9', '0', '1', '&#xe622;', '/admin/bank/index');
INSERT INTO `jcb_sys_menu` VALUES ('22', '0', '佣金明细', '9', '0', '1', '&#xe629;', '/admin/comlog/index');
INSERT INTO `jcb_sys_menu` VALUES ('23', '0', '兑换积分设置', '9', '0', '1', '&#xe620;', '/admin/exchange/index');
INSERT INTO `jcb_sys_menu` VALUES ('24', '0', '会员等级', '9', '0', '1', '&#xe735;', '/admin/interest/index');
INSERT INTO `jcb_sys_menu` VALUES ('25', '0', '系统配置', '0', '0', '1', '&#xe631;', '/admin/config/edit');
INSERT INTO `jcb_sys_menu` VALUES ('26', '0', '前台小喇叭', '0', '0', '1', '&#xe688;', '/admin/horn/index');
INSERT INTO `jcb_sys_menu` VALUES ('27', '0', '轮播图', '0', '0', '1', '&#xe64a;', '/admin/sowing/index');

-- ----------------------------
-- Table structure for jcb_sys_menu_role
-- ----------------------------
DROP TABLE IF EXISTS `jcb_sys_menu_role`;
CREATE TABLE `jcb_sys_menu_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) DEFAULT NULL,
  `cstatus` tinyint(255) DEFAULT NULL,
  `sort` int(255) DEFAULT NULL,
  `roleval` varchar(2000) DEFAULT NULL COMMENT '菜单值',
  `cmark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jcb_sys_menu_role
-- ----------------------------
INSERT INTO `jcb_sys_menu_role` VALUES ('1', '超级管理', '1', '1', '1,2,3,4,5,9,10,11,12,19,17,8,18,6,14,15,16,7,20,25,24,23,22,21,26,27', '超级管理员拥有超级管理员权限');
INSERT INTO `jcb_sys_menu_role` VALUES ('3', '普通会员', '1', '0', ',18,1,4,17,2,9,3,10,8,7,5,19,12,6', '这是普通会员只有普通会员权限');

-- ----------------------------
-- Table structure for jcb_user
-- ----------------------------
DROP TABLE IF EXISTS `jcb_user`;
CREATE TABLE `jcb_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `mobile` varchar(13) NOT NULL COMMENT '手机号',
  `nickname` varchar(500) NOT NULL COMMENT '昵称',
  `avator` varchar(500) DEFAULT NULL COMMENT '头像',
  `sex` tinyint(4) DEFAULT '1' COMMENT '性别',
  `pwd` char(32) NOT NULL COMMENT '密码',
  `securepwd` char(32) NOT NULL COMMENT '资金密码',
  `coin` decimal(65,2) DEFAULT '0.00' COMMENT '可用LM',
  `lockcoin` decimal(65,2) DEFAULT '0.00' COMMENT '锁定LM',
  `pid` bigint(20) NOT NULL COMMENT '上级ID',
  `farmernum` int(11) NOT NULL DEFAULT '0' COMMENT '果农数量',
  `idauth` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否实名制标记',
  `state` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `teamline` bigint(20) DEFAULT NULL COMMENT '团队ID',
  `regtime` datetime DEFAULT NULL COMMENT '注册时间',
  `logintime` datetime DEFAULT NULL COMMENT '登陆时间',
  `isnew` tinyint(4) unsigned zerofill DEFAULT '0000' COMMENT '0 未充值过 1 充值过',
  `settletime` datetime DEFAULT NULL,
  `pickall` datetime DEFAULT NULL,
  `farmergift` int(11) DEFAULT '0' COMMENT '新用户赠送果农名额',
  `num1` bigint(255) DEFAULT '0' COMMENT '下级',
  `num2` bigint(255) DEFAULT '0' COMMENT '下下级',
  `num3` bigint(255) DEFAULT '0' COMMENT '下下下级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jcb_user
-- ----------------------------

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES ('1', '测试', '测一测功能');
INSERT INTO `notice` VALUES ('2', '管理员', '<p>我的公告请</p>');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) DEFAULT NULL COMMENT '兑换码',
  `bankid` int(11) DEFAULT NULL COMMENT '银行ID',
  `num` int(11) DEFAULT NULL COMMENT '总数量',
  `amount` decimal(10,2) DEFAULT NULL COMMENT '总金额',
  `addtime` datetime DEFAULT NULL COMMENT '添加时间',
  `status` tinyint(4) DEFAULT NULL COMMENT '1交易中 2成功 3失败',
  `user_id` int(11) DEFAULT NULL,
  `mark` varchar(1000) DEFAULT NULL COMMENT '备注',
  `picture` varchar(255) DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('1', 'd6s1a52623', '2', '10', '100.00', '2018-05-10 14:14:53', '2', '5', '大', null);
INSERT INTO `order` VALUES ('2', '10dwadawdfawdafa', '3', '10', '100.00', '2018-05-11 16:23:46', '3', '5', '10000', '/uploads/20180511\\4ad0452d923df978579b8648cffca5a8.jpg');
INSERT INTO `order` VALUES ('3', 'da6s2da61sd3a216', '1', '10', '99999999.99', '2018-05-11 16:26:25', '2', '5', '', null);
INSERT INTO `order` VALUES ('4', '6s5sad65+', '2', '1000', '1000000.00', '2018-05-11 16:27:37', '2', '5', '10', '/uploads/20180511\\953a62155164510a4d4a27b41b010dcc.jpg');
INSERT INTO `order` VALUES ('5', 'wwsdasdsadas', '1', null, null, '2018-05-15 13:38:35', '2', '5', null, null);
INSERT INTO `order` VALUES ('6', 'wwdaddaaaaaaaaaaa', '1', null, null, '2018-05-15 13:38:39', '2', '5', null, null);
INSERT INTO `order` VALUES ('7', 'vvvvvvvvvvvvvvvv', '1', null, null, '2018-05-15 13:38:41', '2', '5', null, null);
INSERT INTO `order` VALUES ('11', 'sadaw', '1', '20000', '29.00', '2018-05-28 15:38:50', '2', '10', '', null);

-- ----------------------------
-- Table structure for paylog
-- ----------------------------
DROP TABLE IF EXISTS `paylog`;
CREATE TABLE `paylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ordernum` varchar(50) DEFAULT NULL,
  `pay` decimal(6,0) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of paylog
-- ----------------------------

-- ----------------------------
-- Table structure for sowing
-- ----------------------------
DROP TABLE IF EXISTS `sowing`;
CREATE TABLE `sowing` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) NOT NULL COMMENT '轮播图',
  `position` tinyint(4) NOT NULL DEFAULT '1' COMMENT '轮播图显示的位置 1 首页和百科 2 个人中心 3我的分享码码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sowing
-- ----------------------------
INSERT INTO `sowing` VALUES ('1', '/uploads/20180528\\990a22c3dfaf584f11bcc3264843a178.jpg', '3');
INSERT INTO `sowing` VALUES ('6', '/uploads/20180528\\edebd0df2fb9d1559bf739e33867aec7.jpg', '1');
INSERT INTO `sowing` VALUES ('7', '/uploads/20180528\\af381552ffea01f05d02e5571ad62869.jpg', '2');
INSERT INTO `sowing` VALUES ('8', '/uploads/20180528\\2862146a80343a884ddfe746348bdcca.jpg', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `invite_one` varchar(11) DEFAULT NULL COMMENT '直接邀请人',
  `invite_two` varchar(11) DEFAULT NULL COMMENT '间接邀请人',
  `balance` decimal(10,2) DEFAULT '0.00' COMMENT '余额',
  `addtime` datetime DEFAULT NULL COMMENT '注册时间',
  `team` varchar(32) DEFAULT NULL COMMENT '团队标识',
  `profit` decimal(10,2) DEFAULT '0.00' COMMENT '累计收益，（不会减少）',
  `lock_balance` decimal(10,2) DEFAULT '0.00' COMMENT '锁定的金额',
  `grade` varchar(10) DEFAULT '' COMMENT '等级(zy jl hz yhj)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('4', 'at', 'e10adc3949ba59abbe56e057f20f883e', '18883313377', null, null, '280.00', '2018-05-09 17:05:11', '4', '0.00', '0.00', 'hz');
INSERT INTO `user` VALUES ('5', 't02', 'e10adc3949ba59abbe56e057f20f883e', '13366622333', '4', '6', '4.00', '2018-05-10 09:53:36', '0', '4.00', '0.00', 'hz');
INSERT INTO `user` VALUES ('6', 'KL', 'e10adc3949ba59abbe56e057f20f883e', '13452533748', '5', '4', '140.00', '2018-05-14 09:41:36', '5', '140.00', '0.00', 'jl');
INSERT INTO `user` VALUES ('7', 'JW', 'e10adc3949ba59abbe56e057f20f883e', '13368323623', '5', '4', '0.00', '2018-05-14 09:44:40', '5', '0.00', '0.00', 'zy');
INSERT INTO `user` VALUES ('8', 'ds', 'e10adc3949ba59abbe56e057f20f883e', '13333222233', '0', null, '0.00', '2018-05-14 15:24:21', '0', '0.00', '0.00', 'zy');
INSERT INTO `user` VALUES ('9', '1', 'e10adc3949ba59abbe56e057f20f883e', '15223366699', '', null, '0.00', '2018-05-14 17:59:58', '0', '0.00', '0.00', 'zy');
INSERT INTO `user` VALUES ('10', '188', 'e10adc3949ba59abbe56e057f20f883e', '18883313376', '5', '4', '59.00', '2018-05-16 16:18:52', '4', '59.00', '0.00', 'jl');
INSERT INTO `user` VALUES ('12', '1887', '', '213', '4', '5', '10.00', '2018-05-28 14:48:54', null, '0.00', '0.00', 'zy');

-- ----------------------------
-- Table structure for withdraw
-- ----------------------------
DROP TABLE IF EXISTS `withdraw`;
CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL COMMENT '提现金额',
  `bank` varchar(32) DEFAULT NULL COMMENT '开户行',
  `branch` varchar(255) DEFAULT NULL COMMENT '支行名称',
  `name` varchar(10) DEFAULT NULL COMMENT '户名',
  `idnum` varchar(50) DEFAULT NULL COMMENT '卡号',
  `addtime` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '是否审核 0未审核 1成功 2失败',
  `withdraw_fee` decimal(4,2) DEFAULT NULL COMMENT '手续费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of withdraw
-- ----------------------------
INSERT INTO `withdraw` VALUES ('5', '5', '100.00', '建设银行', '1', '1', '6212221315556320123', '2018-05-10 17:02:53', '2', '2.00');
INSERT INTO `withdraw` VALUES ('6', '5', '1.00', '建设银行', '1', '1', '1', '2018-05-10 17:04:16', '1', '2.00');
INSERT INTO `withdraw` VALUES ('7', '5', '20.00', '招商银行', '挨打的无', '我', '13456789789789789', '2018-05-12 14:52:20', '2', '1.00');
INSERT INTO `withdraw` VALUES ('8', '5', '10.00', null, null, null, null, '2018-05-15 16:28:11', '0', null);
INSERT INTO `withdraw` VALUES ('9', '5', '20.00', null, null, null, null, '2018-05-15 16:28:14', '0', null);
INSERT INTO `withdraw` VALUES ('10', '5', '30.00', null, null, null, null, '2018-05-15 16:28:16', '0', null);
INSERT INTO `withdraw` VALUES ('11', '5', '33.00', null, null, null, null, '2018-05-15 16:28:19', '0', null);
INSERT INTO `withdraw` VALUES ('12', '5', '32.00', null, null, null, null, '2018-05-15 16:28:22', '0', null);
INSERT INTO `withdraw` VALUES ('13', '5', '11.00', null, null, null, null, '2018-05-15 16:28:23', '0', null);
INSERT INTO `withdraw` VALUES ('14', '5', '22.00', null, null, null, null, '2018-05-15 16:28:26', '0', null);
INSERT INTO `withdraw` VALUES ('15', '5', '55.00', null, null, null, null, '2018-05-15 16:28:27', '0', null);
INSERT INTO `withdraw` VALUES ('16', '5', '33.00', null, null, null, null, '2018-05-15 16:28:29', '0', null);
INSERT INTO `withdraw` VALUES ('17', '5', '35.00', null, null, null, null, '2018-05-15 17:02:16', '0', null);
INSERT INTO `withdraw` VALUES ('18', '5', '53.00', null, null, null, null, '2018-05-15 17:02:19', '0', null);
