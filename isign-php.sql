-- Adminer 4.7.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE TABLE `cmf_admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父菜单id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '菜单类型;1:有界面可访问菜单,2:无界面可访问菜单,0:只作为菜单',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态;1:显示,0:不显示',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `app` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '应用名',
  `controller` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '控制器名',
  `action` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '操作名称',
  `param` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '额外参数',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '菜单图标',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parentid` (`parent_id`),
  KEY `model` (`controller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='后台菜单表';

INSERT INTO `cmf_admin_menu` (`id`, `parent_id`, `type`, `status`, `list_order`, `app`, `controller`, `action`, `param`, `name`, `icon`, `remark`) VALUES
(1,	0,	0,	1,	20,	'admin',	'Plugin',	'default',	'',	'插件管理',	'cloud',	'插件管理'),
(2,	1,	1,	1,	10000,	'admin',	'Hook',	'index',	'',	'钩子管理',	'',	'钩子管理'),
(3,	2,	1,	0,	10000,	'admin',	'Hook',	'plugins',	'',	'钩子插件管理',	'',	'钩子插件管理'),
(4,	2,	2,	0,	10000,	'admin',	'Hook',	'pluginListOrder',	'',	'钩子插件排序',	'',	'钩子插件排序'),
(5,	2,	1,	0,	10000,	'admin',	'Hook',	'sync',	'',	'同步钩子',	'',	'同步钩子'),
(6,	0,	0,	1,	0,	'admin',	'Setting',	'default',	'',	'设置',	'cogs',	'系统设置入口'),
(7,	6,	1,	1,	50,	'admin',	'Link',	'index',	'',	'友情链接',	'',	'友情链接管理'),
(8,	7,	1,	0,	10000,	'admin',	'Link',	'add',	'',	'添加友情链接',	'',	'添加友情链接'),
(9,	7,	2,	0,	10000,	'admin',	'Link',	'addPost',	'',	'添加友情链接提交保存',	'',	'添加友情链接提交保存'),
(10,	7,	1,	0,	10000,	'admin',	'Link',	'edit',	'',	'编辑友情链接',	'',	'编辑友情链接'),
(11,	7,	2,	0,	10000,	'admin',	'Link',	'editPost',	'',	'编辑友情链接提交保存',	'',	'编辑友情链接提交保存'),
(12,	7,	2,	0,	10000,	'admin',	'Link',	'delete',	'',	'删除友情链接',	'',	'删除友情链接'),
(13,	7,	2,	0,	10000,	'admin',	'Link',	'listOrder',	'',	'友情链接排序',	'',	'友情链接排序'),
(14,	7,	2,	0,	10000,	'admin',	'Link',	'toggle',	'',	'友情链接显示隐藏',	'',	'友情链接显示隐藏'),
(15,	6,	1,	0,	10,	'admin',	'Mailer',	'index',	'',	'邮箱配置',	'',	'邮箱配置'),
(16,	15,	2,	0,	10000,	'admin',	'Mailer',	'indexPost',	'',	'邮箱配置提交保存',	'',	'邮箱配置提交保存'),
(17,	15,	1,	0,	10000,	'admin',	'Mailer',	'template',	'',	'邮件模板',	'',	'邮件模板'),
(18,	15,	2,	0,	10000,	'admin',	'Mailer',	'templatePost',	'',	'邮件模板提交',	'',	'邮件模板提交'),
(19,	15,	1,	0,	10000,	'admin',	'Mailer',	'test',	'',	'邮件发送测试',	'',	'邮件发送测试'),
(20,	6,	1,	1,	10000,	'admin',	'Menu',	'index',	'',	'后台菜单',	'',	'后台菜单管理'),
(21,	20,	1,	0,	10000,	'admin',	'Menu',	'lists',	'',	'所有菜单',	'',	'后台所有菜单列表'),
(22,	20,	1,	0,	10000,	'admin',	'Menu',	'add',	'',	'后台菜单添加',	'',	'后台菜单添加'),
(23,	20,	2,	0,	10000,	'admin',	'Menu',	'addPost',	'',	'后台菜单添加提交保存',	'',	'后台菜单添加提交保存'),
(24,	20,	1,	0,	10000,	'admin',	'Menu',	'edit',	'',	'后台菜单编辑',	'',	'后台菜单编辑'),
(25,	20,	2,	0,	10000,	'admin',	'Menu',	'editPost',	'',	'后台菜单编辑提交保存',	'',	'后台菜单编辑提交保存'),
(26,	20,	2,	0,	10000,	'admin',	'Menu',	'delete',	'',	'后台菜单删除',	'',	'后台菜单删除'),
(27,	20,	2,	0,	10000,	'admin',	'Menu',	'listOrder',	'',	'后台菜单排序',	'',	'后台菜单排序'),
(28,	20,	1,	0,	10000,	'admin',	'Menu',	'getActions',	'',	'导入新后台菜单',	'',	'导入新后台菜单'),
(29,	6,	1,	0,	30,	'admin',	'Nav',	'index',	'',	'导航管理',	'',	'导航管理'),
(30,	29,	1,	0,	10000,	'admin',	'Nav',	'add',	'',	'添加导航',	'',	'添加导航'),
(31,	29,	2,	0,	10000,	'admin',	'Nav',	'addPost',	'',	'添加导航提交保存',	'',	'添加导航提交保存'),
(32,	29,	1,	0,	10000,	'admin',	'Nav',	'edit',	'',	'编辑导航',	'',	'编辑导航'),
(33,	29,	2,	0,	10000,	'admin',	'Nav',	'editPost',	'',	'编辑导航提交保存',	'',	'编辑导航提交保存'),
(34,	29,	2,	0,	10000,	'admin',	'Nav',	'delete',	'',	'删除导航',	'',	'删除导航'),
(35,	29,	1,	0,	10000,	'admin',	'NavMenu',	'index',	'',	'导航菜单',	'',	'导航菜单'),
(36,	35,	1,	0,	10000,	'admin',	'NavMenu',	'add',	'',	'添加导航菜单',	'',	'添加导航菜单'),
(37,	35,	2,	0,	10000,	'admin',	'NavMenu',	'addPost',	'',	'添加导航菜单提交保存',	'',	'添加导航菜单提交保存'),
(38,	35,	1,	0,	10000,	'admin',	'NavMenu',	'edit',	'',	'编辑导航菜单',	'',	'编辑导航菜单'),
(39,	35,	2,	0,	10000,	'admin',	'NavMenu',	'editPost',	'',	'编辑导航菜单提交保存',	'',	'编辑导航菜单提交保存'),
(40,	35,	2,	0,	10000,	'admin',	'NavMenu',	'delete',	'',	'删除导航菜单',	'',	'删除导航菜单'),
(41,	35,	2,	0,	10000,	'admin',	'NavMenu',	'listOrder',	'',	'导航菜单排序',	'',	'导航菜单排序'),
(42,	1,	1,	1,	10000,	'admin',	'Plugin',	'index',	'',	'插件列表',	'',	'插件列表'),
(43,	42,	2,	0,	10000,	'admin',	'Plugin',	'toggle',	'',	'插件启用禁用',	'',	'插件启用禁用'),
(44,	42,	1,	0,	10000,	'admin',	'Plugin',	'setting',	'',	'插件设置',	'',	'插件设置'),
(45,	42,	2,	0,	10000,	'admin',	'Plugin',	'settingPost',	'',	'插件设置提交',	'',	'插件设置提交'),
(46,	42,	2,	0,	10000,	'admin',	'Plugin',	'install',	'',	'插件安装',	'',	'插件安装'),
(47,	42,	2,	0,	10000,	'admin',	'Plugin',	'update',	'',	'插件更新',	'',	'插件更新'),
(48,	42,	2,	0,	10000,	'admin',	'Plugin',	'uninstall',	'',	'卸载插件',	'',	'卸载插件'),
(49,	109,	0,	1,	10000,	'admin',	'User',	'default',	'',	'管理组',	'',	'管理组'),
(50,	49,	1,	1,	10000,	'admin',	'Rbac',	'index',	'',	'角色管理',	'',	'角色管理'),
(51,	50,	1,	0,	10000,	'admin',	'Rbac',	'roleAdd',	'',	'添加角色',	'',	'添加角色'),
(52,	50,	2,	0,	10000,	'admin',	'Rbac',	'roleAddPost',	'',	'添加角色提交',	'',	'添加角色提交'),
(53,	50,	1,	0,	10000,	'admin',	'Rbac',	'roleEdit',	'',	'编辑角色',	'',	'编辑角色'),
(54,	50,	2,	0,	10000,	'admin',	'Rbac',	'roleEditPost',	'',	'编辑角色提交',	'',	'编辑角色提交'),
(55,	50,	2,	0,	10000,	'admin',	'Rbac',	'roleDelete',	'',	'删除角色',	'',	'删除角色'),
(56,	50,	1,	0,	10000,	'admin',	'Rbac',	'authorize',	'',	'设置角色权限',	'',	'设置角色权限'),
(57,	50,	2,	0,	10000,	'admin',	'Rbac',	'authorizePost',	'',	'角色授权提交',	'',	'角色授权提交'),
(58,	0,	1,	0,	10000,	'admin',	'RecycleBin',	'index',	'',	'回收站',	'',	'回收站'),
(59,	58,	2,	0,	10000,	'admin',	'RecycleBin',	'restore',	'',	'回收站还原',	'',	'回收站还原'),
(60,	58,	2,	0,	10000,	'admin',	'RecycleBin',	'delete',	'',	'回收站彻底删除',	'',	'回收站彻底删除'),
(61,	6,	1,	0,	10000,	'admin',	'Route',	'index',	'',	'URL美化',	'',	'URL规则管理'),
(62,	61,	1,	0,	10000,	'admin',	'Route',	'add',	'',	'添加路由规则',	'',	'添加路由规则'),
(63,	61,	2,	0,	10000,	'admin',	'Route',	'addPost',	'',	'添加路由规则提交',	'',	'添加路由规则提交'),
(64,	61,	1,	0,	10000,	'admin',	'Route',	'edit',	'',	'路由规则编辑',	'',	'路由规则编辑'),
(65,	61,	2,	0,	10000,	'admin',	'Route',	'editPost',	'',	'路由规则编辑提交',	'',	'路由规则编辑提交'),
(66,	61,	2,	0,	10000,	'admin',	'Route',	'delete',	'',	'路由规则删除',	'',	'路由规则删除'),
(67,	61,	2,	0,	10000,	'admin',	'Route',	'ban',	'',	'路由规则禁用',	'',	'路由规则禁用'),
(68,	61,	2,	0,	10000,	'admin',	'Route',	'open',	'',	'路由规则启用',	'',	'路由规则启用'),
(69,	61,	2,	0,	10000,	'admin',	'Route',	'listOrder',	'',	'路由规则排序',	'',	'路由规则排序'),
(70,	61,	1,	0,	10000,	'admin',	'Route',	'select',	'',	'选择URL',	'',	'选择URL'),
(71,	6,	1,	1,	0,	'admin',	'Setting',	'site',	'',	'网站信息',	'',	'网站信息'),
(72,	71,	2,	0,	10000,	'admin',	'Setting',	'sitePost',	'',	'网站信息设置提交',	'',	'网站信息设置提交'),
(73,	6,	1,	0,	10000,	'admin',	'Setting',	'password',	'',	'密码修改',	'',	'密码修改'),
(74,	73,	2,	0,	10000,	'admin',	'Setting',	'passwordPost',	'',	'密码修改提交',	'',	'密码修改提交'),
(75,	6,	1,	1,	10000,	'admin',	'Setting',	'upload',	'',	'上传设置',	'',	'上传设置'),
(76,	75,	2,	0,	10000,	'admin',	'Setting',	'uploadPost',	'',	'上传设置提交',	'',	'上传设置提交'),
(77,	6,	1,	0,	10000,	'admin',	'Setting',	'clearCache',	'',	'清除缓存',	'',	'清除缓存'),
(78,	6,	1,	0,	40,	'admin',	'Slide',	'index',	'',	'幻灯片管理',	'',	'幻灯片管理'),
(79,	78,	1,	0,	10000,	'admin',	'Slide',	'add',	'',	'添加幻灯片',	'',	'添加幻灯片'),
(80,	78,	2,	0,	10000,	'admin',	'Slide',	'addPost',	'',	'添加幻灯片提交',	'',	'添加幻灯片提交'),
(81,	78,	1,	0,	10000,	'admin',	'Slide',	'edit',	'',	'编辑幻灯片',	'',	'编辑幻灯片'),
(82,	78,	2,	0,	10000,	'admin',	'Slide',	'editPost',	'',	'编辑幻灯片提交',	'',	'编辑幻灯片提交'),
(83,	78,	2,	0,	10000,	'admin',	'Slide',	'delete',	'',	'删除幻灯片',	'',	'删除幻灯片'),
(84,	78,	1,	0,	10000,	'admin',	'SlideItem',	'index',	'',	'幻灯片页面列表',	'',	'幻灯片页面列表'),
(85,	84,	1,	0,	10000,	'admin',	'SlideItem',	'add',	'',	'幻灯片页面添加',	'',	'幻灯片页面添加'),
(86,	84,	2,	0,	10000,	'admin',	'SlideItem',	'addPost',	'',	'幻灯片页面添加提交',	'',	'幻灯片页面添加提交'),
(87,	84,	1,	0,	10000,	'admin',	'SlideItem',	'edit',	'',	'幻灯片页面编辑',	'',	'幻灯片页面编辑'),
(88,	84,	2,	0,	10000,	'admin',	'SlideItem',	'editPost',	'',	'幻灯片页面编辑提交',	'',	'幻灯片页面编辑提交'),
(89,	84,	2,	0,	10000,	'admin',	'SlideItem',	'delete',	'',	'幻灯片页面删除',	'',	'幻灯片页面删除'),
(90,	84,	2,	0,	10000,	'admin',	'SlideItem',	'ban',	'',	'幻灯片页面隐藏',	'',	'幻灯片页面隐藏'),
(91,	84,	2,	0,	10000,	'admin',	'SlideItem',	'cancelBan',	'',	'幻灯片页面显示',	'',	'幻灯片页面显示'),
(92,	84,	2,	0,	10000,	'admin',	'SlideItem',	'listOrder',	'',	'幻灯片页面排序',	'',	'幻灯片页面排序'),
(93,	6,	1,	1,	10000,	'admin',	'Storage',	'index',	'',	'文件存储',	'',	'文件存储'),
(94,	93,	2,	0,	10000,	'admin',	'Storage',	'settingPost',	'',	'文件存储设置提交',	'',	'文件存储设置提交'),
(95,	6,	1,	0,	20,	'admin',	'Theme',	'index',	'',	'模板管理',	'',	'模板管理'),
(96,	95,	1,	0,	10000,	'admin',	'Theme',	'install',	'',	'安装模板',	'',	'安装模板'),
(97,	95,	2,	0,	10000,	'admin',	'Theme',	'uninstall',	'',	'卸载模板',	'',	'卸载模板'),
(98,	95,	2,	0,	10000,	'admin',	'Theme',	'installTheme',	'',	'模板安装',	'',	'模板安装'),
(99,	95,	2,	0,	10000,	'admin',	'Theme',	'update',	'',	'模板更新',	'',	'模板更新'),
(100,	95,	2,	0,	10000,	'admin',	'Theme',	'active',	'',	'启用模板',	'',	'启用模板'),
(101,	95,	1,	0,	10000,	'admin',	'Theme',	'files',	'',	'模板文件列表',	'',	'启用模板'),
(102,	95,	1,	0,	10000,	'admin',	'Theme',	'fileSetting',	'',	'模板文件设置',	'',	'模板文件设置'),
(103,	95,	1,	0,	10000,	'admin',	'Theme',	'fileArrayData',	'',	'模板文件数组数据列表',	'',	'模板文件数组数据列表'),
(104,	95,	2,	0,	10000,	'admin',	'Theme',	'fileArrayDataEdit',	'',	'模板文件数组数据添加编辑',	'',	'模板文件数组数据添加编辑'),
(105,	95,	2,	0,	10000,	'admin',	'Theme',	'fileArrayDataEditPost',	'',	'模板文件数组数据添加编辑提交保存',	'',	'模板文件数组数据添加编辑提交保存'),
(106,	95,	2,	0,	10000,	'admin',	'Theme',	'fileArrayDataDelete',	'',	'模板文件数组数据删除',	'',	'模板文件数组数据删除'),
(107,	95,	2,	0,	10000,	'admin',	'Theme',	'settingPost',	'',	'模板文件编辑提交保存',	'',	'模板文件编辑提交保存'),
(108,	95,	1,	0,	10000,	'admin',	'Theme',	'dataSource',	'',	'模板文件设置数据源',	'',	'模板文件设置数据源'),
(109,	0,	0,	1,	10,	'user',	'AdminIndex',	'default',	'',	'用户管理',	'group',	'用户管理'),
(110,	49,	1,	1,	10000,	'admin',	'User',	'index',	'',	'管理员',	'',	'管理员管理'),
(111,	110,	1,	0,	10000,	'admin',	'User',	'add',	'',	'管理员添加',	'',	'管理员添加'),
(112,	110,	2,	0,	10000,	'admin',	'User',	'addPost',	'',	'管理员添加提交',	'',	'管理员添加提交'),
(113,	110,	1,	0,	10000,	'admin',	'User',	'edit',	'',	'管理员编辑',	'',	'管理员编辑'),
(114,	110,	2,	0,	10000,	'admin',	'User',	'editPost',	'',	'管理员编辑提交',	'',	'管理员编辑提交'),
(115,	110,	1,	0,	10000,	'admin',	'User',	'userInfo',	'',	'个人信息',	'',	'管理员个人信息修改'),
(116,	110,	2,	0,	10000,	'admin',	'User',	'userInfoPost',	'',	'管理员个人信息修改提交',	'',	'管理员个人信息修改提交'),
(117,	110,	2,	0,	10000,	'admin',	'User',	'delete',	'',	'管理员删除',	'',	'管理员删除'),
(118,	110,	2,	0,	10000,	'admin',	'User',	'ban',	'',	'停用管理员',	'',	'停用管理员'),
(119,	110,	2,	0,	10000,	'admin',	'User',	'cancelBan',	'',	'启用管理员',	'',	'启用管理员'),
(120,	0,	0,	1,	30,	'portal',	'AdminIndex',	'default',	'',	'门户管理',	'th',	'门户管理'),
(121,	120,	1,	1,	10000,	'portal',	'AdminArticle',	'index',	'',	'文章管理',	'',	'文章列表'),
(122,	121,	1,	0,	10000,	'portal',	'AdminArticle',	'add',	'',	'添加文章',	'',	'添加文章'),
(123,	121,	2,	0,	10000,	'portal',	'AdminArticle',	'addPost',	'',	'添加文章提交',	'',	'添加文章提交'),
(124,	121,	1,	0,	10000,	'portal',	'AdminArticle',	'edit',	'',	'编辑文章',	'',	'编辑文章'),
(125,	121,	2,	0,	10000,	'portal',	'AdminArticle',	'editPost',	'',	'编辑文章提交',	'',	'编辑文章提交'),
(126,	121,	2,	0,	10000,	'portal',	'AdminArticle',	'delete',	'',	'文章删除',	'',	'文章删除'),
(127,	121,	2,	0,	10000,	'portal',	'AdminArticle',	'publish',	'',	'文章发布',	'',	'文章发布'),
(128,	121,	2,	0,	10000,	'portal',	'AdminArticle',	'top',	'',	'文章置顶',	'',	'文章置顶'),
(129,	121,	2,	0,	10000,	'portal',	'AdminArticle',	'recommend',	'',	'文章推荐',	'',	'文章推荐'),
(130,	121,	2,	0,	10000,	'portal',	'AdminArticle',	'listOrder',	'',	'文章排序',	'',	'文章排序'),
(131,	120,	1,	1,	10000,	'portal',	'AdminCategory',	'index',	'',	'分类管理',	'',	'文章分类列表'),
(132,	131,	1,	0,	10000,	'portal',	'AdminCategory',	'add',	'',	'添加文章分类',	'',	'添加文章分类'),
(133,	131,	2,	0,	10000,	'portal',	'AdminCategory',	'addPost',	'',	'添加文章分类提交',	'',	'添加文章分类提交'),
(134,	131,	1,	0,	10000,	'portal',	'AdminCategory',	'edit',	'',	'编辑文章分类',	'',	'编辑文章分类'),
(135,	131,	2,	0,	10000,	'portal',	'AdminCategory',	'editPost',	'',	'编辑文章分类提交',	'',	'编辑文章分类提交'),
(136,	131,	1,	0,	10000,	'portal',	'AdminCategory',	'select',	'',	'文章分类选择对话框',	'',	'文章分类选择对话框'),
(137,	131,	2,	0,	10000,	'portal',	'AdminCategory',	'listOrder',	'',	'文章分类排序',	'',	'文章分类排序'),
(138,	131,	2,	0,	10000,	'portal',	'AdminCategory',	'delete',	'',	'删除文章分类',	'',	'删除文章分类'),
(139,	120,	1,	1,	10000,	'portal',	'AdminPage',	'index',	'',	'页面管理',	'',	'页面管理'),
(140,	139,	1,	0,	10000,	'portal',	'AdminPage',	'add',	'',	'添加页面',	'',	'添加页面'),
(141,	139,	2,	0,	10000,	'portal',	'AdminPage',	'addPost',	'',	'添加页面提交',	'',	'添加页面提交'),
(142,	139,	1,	0,	10000,	'portal',	'AdminPage',	'edit',	'',	'编辑页面',	'',	'编辑页面'),
(143,	139,	2,	0,	10000,	'portal',	'AdminPage',	'editPost',	'',	'编辑页面提交',	'',	'编辑页面提交'),
(144,	139,	2,	0,	10000,	'portal',	'AdminPage',	'delete',	'',	'删除页面',	'',	'删除页面'),
(145,	120,	1,	1,	10000,	'portal',	'AdminTag',	'index',	'',	'文章标签',	'',	'文章标签'),
(146,	145,	1,	0,	10000,	'portal',	'AdminTag',	'add',	'',	'添加文章标签',	'',	'添加文章标签'),
(147,	145,	2,	0,	10000,	'portal',	'AdminTag',	'addPost',	'',	'添加文章标签提交',	'',	'添加文章标签提交'),
(148,	145,	2,	0,	10000,	'portal',	'AdminTag',	'upStatus',	'',	'更新标签状态',	'',	'更新标签状态'),
(149,	145,	2,	0,	10000,	'portal',	'AdminTag',	'delete',	'',	'删除文章标签',	'',	'删除文章标签'),
(150,	0,	1,	0,	10000,	'user',	'AdminAsset',	'index',	'',	'资源管理',	'file',	'资源管理列表'),
(151,	150,	2,	0,	10000,	'user',	'AdminAsset',	'delete',	'',	'删除文件',	'',	'删除文件'),
(152,	109,	0,	1,	10000,	'user',	'AdminIndex',	'default1',	'',	'用户组',	'',	'用户组'),
(153,	152,	1,	1,	10000,	'user',	'AdminIndex',	'index',	'',	'本站用户',	'',	'本站用户'),
(154,	153,	2,	0,	10000,	'user',	'AdminIndex',	'ban',	'',	'本站用户拉黑',	'',	'本站用户拉黑'),
(155,	153,	2,	0,	10000,	'user',	'AdminIndex',	'cancelBan',	'',	'本站用户启用',	'',	'本站用户启用'),
(156,	152,	1,	1,	10000,	'user',	'AdminOauth',	'index',	'',	'第三方用户',	'',	'第三方用户'),
(157,	156,	2,	0,	10000,	'user',	'AdminOauth',	'delete',	'',	'删除第三方用户绑定',	'',	'删除第三方用户绑定'),
(158,	6,	1,	0,	10000,	'user',	'AdminUserAction',	'index',	'',	'用户操作管理',	'',	'用户操作管理'),
(159,	158,	1,	0,	10000,	'user',	'AdminUserAction',	'edit',	'',	'编辑用户操作',	'',	'编辑用户操作'),
(160,	158,	2,	0,	10000,	'user',	'AdminUserAction',	'editPost',	'',	'编辑用户操作提交',	'',	'编辑用户操作提交'),
(161,	158,	1,	0,	10000,	'user',	'AdminUserAction',	'sync',	'',	'同步用户操作',	'',	'同步用户操作'),
(162,	0,	1,	1,	40,	'Admin',	'Members',	'default',	'',	'会员管理',	'arrows',	''),
(163,	162,	1,	1,	10000,	'Admin',	'Members',	'index',	'',	'会员列表',	'',	''),
(164,	6,	1,	1,	10000,	'Admin',	'Systems',	'index',	'',	'公共配置',	'',	''),
(165,	0,	1,	1,	60,	'Admin',	'Download',	'default',	'',	'下载管理',	'download',	''),
(166,	165,	1,	1,	10000,	'Admin',	'Download',	'index',	'',	'下载列表',	'',	''),
(167,	162,	1,	1,	10000,	'Admin',	'members',	'charge',	'',	'充值记录',	'',	''),
(168,	165,	1,	1,	10000,	'Admin',	'Download',	'charge',	'',	'手动添加下载数',	'',	''),
(169,	0,	0,	1,	50,	'Admin',	'App',	'default',	'',	'应用管理',	'android',	''),
(170,	169,	1,	1,	10000,	'Admin',	'App',	'index',	'',	'应用列表',	'',	''),
(171,	109,	1,	1,	10000,	'User',	'admin_index',	'auth_info_manage',	'',	'认证信息管理',	'',	''),
(172,	0,	1,	1,	10000,	'Admin',	'Certificate',	'index',	'',	'证书管理',	'certificate',	''),
(173,	0,	1,	1,	10000,	'Admin',	'Report',	'index',	'',	'举报管理',	'envelope-open-o',	''),
(174,	165,	1,	1,	10000,	'admin',	'Download',	'supindex',	'',	'超级签名下载次数',	'',	''),
(175,	165,	1,	1,	10000,	'admin',	'Download',	'sup_add_charge',	'',	'手动添加超级签名次数',	'',	'');

CREATE TABLE `cmf_asset` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `file_size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小,单位B',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:可用,0:不可用',
  `download_times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `file_key` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件惟一码',
  `filename` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件名',
  `file_path` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件路径,相对于upload目录,可以为url',
  `file_md5` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件md5值',
  `file_sha1` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `suffix` varchar(10) NOT NULL DEFAULT '' COMMENT '文件后缀名,不包括点',
  `more` text COMMENT '其它详细信息,JSON格式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='资源表';

INSERT INTO `cmf_asset` (`id`, `user_id`, `file_size`, `create_time`, `status`, `download_times`, `file_key`, `filename`, `file_path`, `file_md5`, `file_sha1`, `suffix`, `more`) VALUES
(1,	8888,	26597,	1570892106,	1,	0,	'c48d5a97da1826a0fcca22fe7bb9f6bbfb56e5393ed5f7e297fca6145cac35d7',	'QQ图片20191010190515.jpg',	'default/20191012/053ad1cd982ad2d33cf4df6ba7ef1a29.jpg',	'c48d5a97da1826a0fcca22fe7bb9f6bb',	'9cb9a9bbdfd03c22d518653f23d17a5024ba2286',	'jpg',	NULL);

CREATE TABLE `cmf_auth_access` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL COMMENT '角色',
  `rule_name` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `type` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '权限规则分类,请加应用前缀,如admin_',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `rule_name` (`rule_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='权限授权表';


CREATE TABLE `cmf_auth_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `app` varchar(15) NOT NULL COMMENT '规则所属module',
  `type` varchar(30) NOT NULL DEFAULT '' COMMENT '权限规则分类，请加应用前缀,如admin_',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `param` varchar(100) NOT NULL DEFAULT '' COMMENT '额外url参数',
  `title` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '规则描述',
  `condition` varchar(200) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE,
  KEY `module` (`app`,`status`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='权限规则表';

INSERT INTO `cmf_auth_rule` (`id`, `status`, `app`, `type`, `name`, `param`, `title`, `condition`) VALUES
(1,	1,	'admin',	'admin_url',	'admin/Hook/index',	'',	'钩子管理',	''),
(2,	1,	'admin',	'admin_url',	'admin/Hook/plugins',	'',	'钩子插件管理',	''),
(3,	1,	'admin',	'admin_url',	'admin/Hook/pluginListOrder',	'',	'钩子插件排序',	''),
(4,	1,	'admin',	'admin_url',	'admin/Hook/sync',	'',	'同步钩子',	''),
(5,	1,	'admin',	'admin_url',	'admin/Link/index',	'',	'友情链接',	''),
(6,	1,	'admin',	'admin_url',	'admin/Link/add',	'',	'添加友情链接',	''),
(7,	1,	'admin',	'admin_url',	'admin/Link/addPost',	'',	'添加友情链接提交保存',	''),
(8,	1,	'admin',	'admin_url',	'admin/Link/edit',	'',	'编辑友情链接',	''),
(9,	1,	'admin',	'admin_url',	'admin/Link/editPost',	'',	'编辑友情链接提交保存',	''),
(10,	1,	'admin',	'admin_url',	'admin/Link/delete',	'',	'删除友情链接',	''),
(11,	1,	'admin',	'admin_url',	'admin/Link/listOrder',	'',	'友情链接排序',	''),
(12,	1,	'admin',	'admin_url',	'admin/Link/toggle',	'',	'友情链接显示隐藏',	''),
(13,	1,	'admin',	'admin_url',	'admin/Mailer/index',	'',	'邮箱配置',	''),
(14,	1,	'admin',	'admin_url',	'admin/Mailer/indexPost',	'',	'邮箱配置提交保存',	''),
(15,	1,	'admin',	'admin_url',	'admin/Mailer/template',	'',	'邮件模板',	''),
(16,	1,	'admin',	'admin_url',	'admin/Mailer/templatePost',	'',	'邮件模板提交',	''),
(17,	1,	'admin',	'admin_url',	'admin/Mailer/test',	'',	'邮件发送测试',	''),
(18,	1,	'admin',	'admin_url',	'admin/Menu/index',	'',	'后台菜单',	''),
(19,	1,	'admin',	'admin_url',	'admin/Menu/lists',	'',	'所有菜单',	''),
(20,	1,	'admin',	'admin_url',	'admin/Menu/add',	'',	'后台菜单添加',	''),
(21,	1,	'admin',	'admin_url',	'admin/Menu/addPost',	'',	'后台菜单添加提交保存',	''),
(22,	1,	'admin',	'admin_url',	'admin/Menu/edit',	'',	'后台菜单编辑',	''),
(23,	1,	'admin',	'admin_url',	'admin/Menu/editPost',	'',	'后台菜单编辑提交保存',	''),
(24,	1,	'admin',	'admin_url',	'admin/Menu/delete',	'',	'后台菜单删除',	''),
(25,	1,	'admin',	'admin_url',	'admin/Menu/listOrder',	'',	'后台菜单排序',	''),
(26,	1,	'admin',	'admin_url',	'admin/Menu/getActions',	'',	'导入新后台菜单',	''),
(27,	1,	'admin',	'admin_url',	'admin/Nav/index',	'',	'导航管理',	''),
(28,	1,	'admin',	'admin_url',	'admin/Nav/add',	'',	'添加导航',	''),
(29,	1,	'admin',	'admin_url',	'admin/Nav/addPost',	'',	'添加导航提交保存',	''),
(30,	1,	'admin',	'admin_url',	'admin/Nav/edit',	'',	'编辑导航',	''),
(31,	1,	'admin',	'admin_url',	'admin/Nav/editPost',	'',	'编辑导航提交保存',	''),
(32,	1,	'admin',	'admin_url',	'admin/Nav/delete',	'',	'删除导航',	''),
(33,	1,	'admin',	'admin_url',	'admin/NavMenu/index',	'',	'导航菜单',	''),
(34,	1,	'admin',	'admin_url',	'admin/NavMenu/add',	'',	'添加导航菜单',	''),
(35,	1,	'admin',	'admin_url',	'admin/NavMenu/addPost',	'',	'添加导航菜单提交保存',	''),
(36,	1,	'admin',	'admin_url',	'admin/NavMenu/edit',	'',	'编辑导航菜单',	''),
(37,	1,	'admin',	'admin_url',	'admin/NavMenu/editPost',	'',	'编辑导航菜单提交保存',	''),
(38,	1,	'admin',	'admin_url',	'admin/NavMenu/delete',	'',	'删除导航菜单',	''),
(39,	1,	'admin',	'admin_url',	'admin/NavMenu/listOrder',	'',	'导航菜单排序',	''),
(40,	1,	'admin',	'admin_url',	'admin/Plugin/default',	'',	'插件管理',	''),
(41,	1,	'admin',	'admin_url',	'admin/Plugin/index',	'',	'插件列表',	''),
(42,	1,	'admin',	'admin_url',	'admin/Plugin/toggle',	'',	'插件启用禁用',	''),
(43,	1,	'admin',	'admin_url',	'admin/Plugin/setting',	'',	'插件设置',	''),
(44,	1,	'admin',	'admin_url',	'admin/Plugin/settingPost',	'',	'插件设置提交',	''),
(45,	1,	'admin',	'admin_url',	'admin/Plugin/install',	'',	'插件安装',	''),
(46,	1,	'admin',	'admin_url',	'admin/Plugin/update',	'',	'插件更新',	''),
(47,	1,	'admin',	'admin_url',	'admin/Plugin/uninstall',	'',	'卸载插件',	''),
(48,	1,	'admin',	'admin_url',	'admin/Rbac/index',	'',	'角色管理',	''),
(49,	1,	'admin',	'admin_url',	'admin/Rbac/roleAdd',	'',	'添加角色',	''),
(50,	1,	'admin',	'admin_url',	'admin/Rbac/roleAddPost',	'',	'添加角色提交',	''),
(51,	1,	'admin',	'admin_url',	'admin/Rbac/roleEdit',	'',	'编辑角色',	''),
(52,	1,	'admin',	'admin_url',	'admin/Rbac/roleEditPost',	'',	'编辑角色提交',	''),
(53,	1,	'admin',	'admin_url',	'admin/Rbac/roleDelete',	'',	'删除角色',	''),
(54,	1,	'admin',	'admin_url',	'admin/Rbac/authorize',	'',	'设置角色权限',	''),
(55,	1,	'admin',	'admin_url',	'admin/Rbac/authorizePost',	'',	'角色授权提交',	''),
(56,	1,	'admin',	'admin_url',	'admin/RecycleBin/index',	'',	'回收站',	''),
(57,	1,	'admin',	'admin_url',	'admin/RecycleBin/restore',	'',	'回收站还原',	''),
(58,	1,	'admin',	'admin_url',	'admin/RecycleBin/delete',	'',	'回收站彻底删除',	''),
(59,	1,	'admin',	'admin_url',	'admin/Route/index',	'',	'URL美化',	''),
(60,	1,	'admin',	'admin_url',	'admin/Route/add',	'',	'添加路由规则',	''),
(61,	1,	'admin',	'admin_url',	'admin/Route/addPost',	'',	'添加路由规则提交',	''),
(62,	1,	'admin',	'admin_url',	'admin/Route/edit',	'',	'路由规则编辑',	''),
(63,	1,	'admin',	'admin_url',	'admin/Route/editPost',	'',	'路由规则编辑提交',	''),
(64,	1,	'admin',	'admin_url',	'admin/Route/delete',	'',	'路由规则删除',	''),
(65,	1,	'admin',	'admin_url',	'admin/Route/ban',	'',	'路由规则禁用',	''),
(66,	1,	'admin',	'admin_url',	'admin/Route/open',	'',	'路由规则启用',	''),
(67,	1,	'admin',	'admin_url',	'admin/Route/listOrder',	'',	'路由规则排序',	''),
(68,	1,	'admin',	'admin_url',	'admin/Route/select',	'',	'选择URL',	''),
(69,	1,	'admin',	'admin_url',	'admin/Setting/default',	'',	'设置',	''),
(70,	1,	'admin',	'admin_url',	'admin/Setting/site',	'',	'网站信息',	''),
(71,	1,	'admin',	'admin_url',	'admin/Setting/sitePost',	'',	'网站信息设置提交',	''),
(72,	1,	'admin',	'admin_url',	'admin/Setting/password',	'',	'密码修改',	''),
(73,	1,	'admin',	'admin_url',	'admin/Setting/passwordPost',	'',	'密码修改提交',	''),
(74,	1,	'admin',	'admin_url',	'admin/Setting/upload',	'',	'上传设置',	''),
(75,	1,	'admin',	'admin_url',	'admin/Setting/uploadPost',	'',	'上传设置提交',	''),
(76,	1,	'admin',	'admin_url',	'admin/Setting/clearCache',	'',	'清除缓存',	''),
(77,	1,	'admin',	'admin_url',	'admin/Slide/index',	'',	'幻灯片管理',	''),
(78,	1,	'admin',	'admin_url',	'admin/Slide/add',	'',	'添加幻灯片',	''),
(79,	1,	'admin',	'admin_url',	'admin/Slide/addPost',	'',	'添加幻灯片提交',	''),
(80,	1,	'admin',	'admin_url',	'admin/Slide/edit',	'',	'编辑幻灯片',	''),
(81,	1,	'admin',	'admin_url',	'admin/Slide/editPost',	'',	'编辑幻灯片提交',	''),
(82,	1,	'admin',	'admin_url',	'admin/Slide/delete',	'',	'删除幻灯片',	''),
(83,	1,	'admin',	'admin_url',	'admin/SlideItem/index',	'',	'幻灯片页面列表',	''),
(84,	1,	'admin',	'admin_url',	'admin/SlideItem/add',	'',	'幻灯片页面添加',	''),
(85,	1,	'admin',	'admin_url',	'admin/SlideItem/addPost',	'',	'幻灯片页面添加提交',	''),
(86,	1,	'admin',	'admin_url',	'admin/SlideItem/edit',	'',	'幻灯片页面编辑',	''),
(87,	1,	'admin',	'admin_url',	'admin/SlideItem/editPost',	'',	'幻灯片页面编辑提交',	''),
(88,	1,	'admin',	'admin_url',	'admin/SlideItem/delete',	'',	'幻灯片页面删除',	''),
(89,	1,	'admin',	'admin_url',	'admin/SlideItem/ban',	'',	'幻灯片页面隐藏',	''),
(90,	1,	'admin',	'admin_url',	'admin/SlideItem/cancelBan',	'',	'幻灯片页面显示',	''),
(91,	1,	'admin',	'admin_url',	'admin/SlideItem/listOrder',	'',	'幻灯片页面排序',	''),
(92,	1,	'admin',	'admin_url',	'admin/Storage/index',	'',	'文件存储',	''),
(93,	1,	'admin',	'admin_url',	'admin/Storage/settingPost',	'',	'文件存储设置提交',	''),
(94,	1,	'admin',	'admin_url',	'admin/Theme/index',	'',	'模板管理',	''),
(95,	1,	'admin',	'admin_url',	'admin/Theme/install',	'',	'安装模板',	''),
(96,	1,	'admin',	'admin_url',	'admin/Theme/uninstall',	'',	'卸载模板',	''),
(97,	1,	'admin',	'admin_url',	'admin/Theme/installTheme',	'',	'模板安装',	''),
(98,	1,	'admin',	'admin_url',	'admin/Theme/update',	'',	'模板更新',	''),
(99,	1,	'admin',	'admin_url',	'admin/Theme/active',	'',	'启用模板',	''),
(100,	1,	'admin',	'admin_url',	'admin/Theme/files',	'',	'模板文件列表',	''),
(101,	1,	'admin',	'admin_url',	'admin/Theme/fileSetting',	'',	'模板文件设置',	''),
(102,	1,	'admin',	'admin_url',	'admin/Theme/fileArrayData',	'',	'模板文件数组数据列表',	''),
(103,	1,	'admin',	'admin_url',	'admin/Theme/fileArrayDataEdit',	'',	'模板文件数组数据添加编辑',	''),
(104,	1,	'admin',	'admin_url',	'admin/Theme/fileArrayDataEditPost',	'',	'模板文件数组数据添加编辑提交保存',	''),
(105,	1,	'admin',	'admin_url',	'admin/Theme/fileArrayDataDelete',	'',	'模板文件数组数据删除',	''),
(106,	1,	'admin',	'admin_url',	'admin/Theme/settingPost',	'',	'模板文件编辑提交保存',	''),
(107,	1,	'admin',	'admin_url',	'admin/Theme/dataSource',	'',	'模板文件设置数据源',	''),
(108,	1,	'admin',	'admin_url',	'admin/User/default',	'',	'管理组',	''),
(109,	1,	'admin',	'admin_url',	'admin/User/index',	'',	'管理员',	''),
(110,	1,	'admin',	'admin_url',	'admin/User/add',	'',	'管理员添加',	''),
(111,	1,	'admin',	'admin_url',	'admin/User/addPost',	'',	'管理员添加提交',	''),
(112,	1,	'admin',	'admin_url',	'admin/User/edit',	'',	'管理员编辑',	''),
(113,	1,	'admin',	'admin_url',	'admin/User/editPost',	'',	'管理员编辑提交',	''),
(114,	1,	'admin',	'admin_url',	'admin/User/userInfo',	'',	'个人信息',	''),
(115,	1,	'admin',	'admin_url',	'admin/User/userInfoPost',	'',	'管理员个人信息修改提交',	''),
(116,	1,	'admin',	'admin_url',	'admin/User/delete',	'',	'管理员删除',	''),
(117,	1,	'admin',	'admin_url',	'admin/User/ban',	'',	'停用管理员',	''),
(118,	1,	'admin',	'admin_url',	'admin/User/cancelBan',	'',	'启用管理员',	''),
(119,	1,	'portal',	'admin_url',	'portal/AdminArticle/index',	'',	'文章管理',	''),
(120,	1,	'portal',	'admin_url',	'portal/AdminArticle/add',	'',	'添加文章',	''),
(121,	1,	'portal',	'admin_url',	'portal/AdminArticle/addPost',	'',	'添加文章提交',	''),
(122,	1,	'portal',	'admin_url',	'portal/AdminArticle/edit',	'',	'编辑文章',	''),
(123,	1,	'portal',	'admin_url',	'portal/AdminArticle/editPost',	'',	'编辑文章提交',	''),
(124,	1,	'portal',	'admin_url',	'portal/AdminArticle/delete',	'',	'文章删除',	''),
(125,	1,	'portal',	'admin_url',	'portal/AdminArticle/publish',	'',	'文章发布',	''),
(126,	1,	'portal',	'admin_url',	'portal/AdminArticle/top',	'',	'文章置顶',	''),
(127,	1,	'portal',	'admin_url',	'portal/AdminArticle/recommend',	'',	'文章推荐',	''),
(128,	1,	'portal',	'admin_url',	'portal/AdminArticle/listOrder',	'',	'文章排序',	''),
(129,	1,	'portal',	'admin_url',	'portal/AdminCategory/index',	'',	'分类管理',	''),
(130,	1,	'portal',	'admin_url',	'portal/AdminCategory/add',	'',	'添加文章分类',	''),
(131,	1,	'portal',	'admin_url',	'portal/AdminCategory/addPost',	'',	'添加文章分类提交',	''),
(132,	1,	'portal',	'admin_url',	'portal/AdminCategory/edit',	'',	'编辑文章分类',	''),
(133,	1,	'portal',	'admin_url',	'portal/AdminCategory/editPost',	'',	'编辑文章分类提交',	''),
(134,	1,	'portal',	'admin_url',	'portal/AdminCategory/select',	'',	'文章分类选择对话框',	''),
(135,	1,	'portal',	'admin_url',	'portal/AdminCategory/listOrder',	'',	'文章分类排序',	''),
(136,	1,	'portal',	'admin_url',	'portal/AdminCategory/delete',	'',	'删除文章分类',	''),
(137,	1,	'portal',	'admin_url',	'portal/AdminIndex/default',	'',	'门户管理',	''),
(138,	1,	'portal',	'admin_url',	'portal/AdminPage/index',	'',	'页面管理',	''),
(139,	1,	'portal',	'admin_url',	'portal/AdminPage/add',	'',	'添加页面',	''),
(140,	1,	'portal',	'admin_url',	'portal/AdminPage/addPost',	'',	'添加页面提交',	''),
(141,	1,	'portal',	'admin_url',	'portal/AdminPage/edit',	'',	'编辑页面',	''),
(142,	1,	'portal',	'admin_url',	'portal/AdminPage/editPost',	'',	'编辑页面提交',	''),
(143,	1,	'portal',	'admin_url',	'portal/AdminPage/delete',	'',	'删除页面',	''),
(144,	1,	'portal',	'admin_url',	'portal/AdminTag/index',	'',	'文章标签',	''),
(145,	1,	'portal',	'admin_url',	'portal/AdminTag/add',	'',	'添加文章标签',	''),
(146,	1,	'portal',	'admin_url',	'portal/AdminTag/addPost',	'',	'添加文章标签提交',	''),
(147,	1,	'portal',	'admin_url',	'portal/AdminTag/upStatus',	'',	'更新标签状态',	''),
(148,	1,	'portal',	'admin_url',	'portal/AdminTag/delete',	'',	'删除文章标签',	''),
(149,	1,	'user',	'admin_url',	'user/AdminAsset/index',	'',	'资源管理',	''),
(150,	1,	'user',	'admin_url',	'user/AdminAsset/delete',	'',	'删除文件',	''),
(151,	1,	'user',	'admin_url',	'user/AdminIndex/default',	'',	'用户管理',	''),
(152,	1,	'user',	'admin_url',	'user/AdminIndex/default1',	'',	'用户组',	''),
(153,	1,	'user',	'admin_url',	'user/AdminIndex/index',	'',	'本站用户',	''),
(154,	1,	'user',	'admin_url',	'user/AdminIndex/ban',	'',	'本站用户拉黑',	''),
(155,	1,	'user',	'admin_url',	'user/AdminIndex/cancelBan',	'',	'本站用户启用',	''),
(156,	1,	'user',	'admin_url',	'user/AdminOauth/index',	'',	'第三方用户',	''),
(157,	1,	'user',	'admin_url',	'user/AdminOauth/delete',	'',	'删除第三方用户绑定',	''),
(158,	1,	'user',	'admin_url',	'user/AdminUserAction/index',	'',	'用户操作管理',	''),
(159,	1,	'user',	'admin_url',	'user/AdminUserAction/edit',	'',	'编辑用户操作',	''),
(160,	1,	'user',	'admin_url',	'user/AdminUserAction/editPost',	'',	'编辑用户操作提交',	''),
(161,	1,	'user',	'admin_url',	'user/AdminUserAction/sync',	'',	'同步用户操作',	''),
(162,	1,	'Admin',	'admin_url',	'Admin/Members/default',	'',	'会员管理',	''),
(163,	1,	'Admin',	'admin_url',	'Admin/Members/index',	'',	'会员列表',	''),
(164,	1,	'Admin',	'admin_url',	'Admin/Systems/index',	'',	'公共配置',	''),
(165,	1,	'Admin',	'admin_url',	'Admin/Download/default',	'',	'下载管理',	''),
(166,	1,	'Admin',	'admin_url',	'Admin/Download/index',	'',	'下载列表',	''),
(167,	1,	'Admin',	'admin_url',	'Admin/members/charge',	'',	'充值记录',	''),
(168,	1,	'Admin',	'admin_url',	'Admin/Download/charge',	'',	'手动添加下载数',	''),
(169,	1,	'Admin',	'admin_url',	'Admin/App/default',	'',	'应用管理',	''),
(170,	1,	'Admin',	'admin_url',	'Admin/App/index',	'',	'应用列表',	''),
(171,	1,	'User',	'admin_url',	'User/admin_index/auth_info_manage',	'',	'认证信息管理',	''),
(172,	1,	'Admin',	'admin_url',	'Admin/Certificate/index',	'',	'证书管理',	''),
(173,	1,	'Admin',	'admin_url',	'Admin/Report/index',	'',	'举报管理',	''),
(174,	1,	'admin',	'admin_url',	'admin/Download/supindex',	'',	'超级签名下载次数',	''),
(175,	1,	'admin',	'admin_url',	'admin/Download/sup_add_charge',	'',	'手动添加超级签名次数',	'');

CREATE TABLE `cmf_charge` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) DEFAULT NULL COMMENT '用户id',
  `download` varchar(100) DEFAULT NULL COMMENT '手动添加下载数',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


CREATE TABLE `cmf_charge_log` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) DEFAULT NULL COMMENT '订单号：创建订单时生成',
  `trade_id` varchar(50) DEFAULT NULL COMMENT '支付商家订单ID，支付成功后由支付商家返回',
  `trade_time` int(11) DEFAULT NULL COMMENT '支付成功的时间',
  `uid` int(100) DEFAULT NULL COMMENT '充值用户id',
  `download_id` int(100) DEFAULT NULL,
  `download_download` varchar(100) DEFAULT NULL COMMENT '下载次数',
  `d_gift` varchar(10) DEFAULT NULL COMMENT '赠送次数',
  `download_coin` varchar(100) DEFAULT NULL COMMENT '购买金额',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `subject` varchar(255) DEFAULT NULL COMMENT '订单名称',
  `body` varchar(255) DEFAULT NULL COMMENT '订单描述',
  `type` varchar(255) DEFAULT NULL COMMENT '充值类型',
  `status` int(2) DEFAULT '1' COMMENT '1充值成功 2充值失败 3订单未支付 4订单支付失败 5订单支付成功',
  `goods_type` int(1) NOT NULL DEFAULT '1' COMMENT '1普通下载，2超级签名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


CREATE TABLE `cmf_comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '被回复的评论id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发表评论的用户id',
  `to_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '被评论的用户id',
  `object_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论内容 id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论时间',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:已审核,0:未审核',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '评论类型；1实名评论',
  `table_name` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '评论内容所在表，不带表前缀',
  `full_name` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '评论者昵称',
  `email` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '评论者邮箱',
  `path` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '层级关系',
  `url` text CHARACTER SET utf8 COMMENT '原文地址',
  `content` text CHARACTER SET utf8 COMMENT '评论内容',
  `more` text CHARACTER SET utf8 COMMENT '扩展属性',
  PRIMARY KEY (`id`),
  KEY `comment_post_ID` (`object_id`),
  KEY `comment_approved_date_gmt` (`status`),
  KEY `comment_parent` (`parent_id`),
  KEY `table_id_status` (`table_name`,`object_id`,`status`),
  KEY `createtime` (`create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='评论表';


CREATE TABLE `cmf_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '系统设置',
  `code` varchar(255) CHARACTER SET gbk DEFAULT NULL COMMENT '配置名称',
  `title` varchar(255) CHARACTER SET gbk DEFAULT NULL COMMENT '标题',
  `group_id` varchar(50) CHARACTER SET gbk DEFAULT NULL COMMENT '分组名称',
  `val` text CHARACTER SET gbk COMMENT '配置值',
  `type` tinyint(1) NOT NULL COMMENT '类型',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `value_scope` varchar(50) CHARACTER SET gbk DEFAULT NULL COMMENT '值的范围',
  `title_scope` varchar(255) CHARACTER SET gbk DEFAULT NULL COMMENT '对应value_scope的中文解释',
  `desc` varchar(255) CHARACTER SET gbk DEFAULT NULL COMMENT '描述',
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `cmf_config` (`id`, `code`, `title`, `group_id`, `val`, `type`, `sort`, `value_scope`, `title_scope`, `desc`, `status`) VALUES
(239,	'system_message',	'系统公告',	'手机端设置',	'严禁上传色情、反动、非法博彩类APP，违反该规则的 App 将被删除，屡次上传者将被封禁账号, 并上报给有关部门',	0,	0,	'',	'',	'手机端设置',	1),
(241,	'system_sms',	'短信开启',	'手机端设置',	'1',	4,	0,	'0,1',	'是,否',	'是否开启短信功能',	1),
(242,	'system_sms_key',	'短信key值',	'手机端设置',	'',	0,	0,	'',	'',	'短信key值',	1),
(243,	'system_sms_id',	'短信id',	'手机端设置',	'',	0,	0,	'',	'',	'短信id',	1),
(244,	'system_sms_ip',	'短信发送IP限制',	'手机端设置',	'1',	4,	0,	'0,1',	'限制,不限制',	'短信发送IP限制',	1),
(245,	'system_sms_sum',	'短信发送每天限制条数',	'手机端设置',	'10',	0,	0,	'',	'',	'短信发送每天限制条数',	1),
(246,	'system_parsing',	'软件包解析地址',	'软件包解析地址',	'https://192.168.0.107:1234/upload',	0,	0,	'',	'',	'软件包解析地址',	0),
(247,	'app_file_max_size',	'APP文件上传的最大限制',	'上传设置',	'120',	0,	0,	'',	'',	'',	1),
(248,	'service_qq',	'客服QQ',	'手机端设置',	'925890424',	0,	0,	'',	'',	'',	1),
(249,	'new_reg_give_count',	'新注册赠送下载数量',	'手机端设置',	'50',	0,	0,	'',	'',	'',	1),
(250,	'app_key_shield',	'app名称',	'关键词屏蔽',	'次货,二狗',	1,	0,	'',	'',	'app名称关键词屏蔽',	1),
(251,	'ipa_name',	'包名关键词',	'关键词屏蔽',	'',	1,	0,	'',	'',	'包名关键词屏蔽',	1),
(252,	'ali_save_access_key',	'阿里云存储key',	'存储配置',	'LTAI4FriwHNuARS4AWKdheuL',	0,	0,	NULL,	NULL,	NULL,	1),
(253,	'ali_save_access_secret',	'阿里云存储Secret',	'存储配置',	'wAQEQRcUVxUglld5S8EwkBk2QRBbir',	0,	0,	NULL,	NULL,	NULL,	1),
(254,	'ali_save_upload_url',	'阿里云存储上传地址',	'存储配置',	'http://oss-accelerate.aliyuncs.com',	0,	0,	NULL,	NULL,	NULL,	1),
(255,	'ali_save_down_url',	'阿里云存储下载地址',	'存储配置',	'https://xinfenfa.oss-accelerate.aliyuncs.com',	0,	0,	NULL,	NULL,	NULL,	1),
(256,	'ali_save_bucket',	'阿里云存储空间',	'存储配置',	'xinfenfa',	0,	0,	NULL,	NULL,	NULL,	1),
(257,	'system_type',	'短信发送方式',	'手机端设置',	'1',	4,	0,	'0,1',	'互亿无线,阿里云',	'',	1),
(258,	'aliyun_access_key_id',	'阿里云短信账号',	'短信配置',	'LTAI4Fg6uXYAiZcfwa2YhCZk',	0,	0,	NULL,	NULL,	NULL,	1),
(259,	'aliyun_access_secret',	'阿里云短信密钥',	'短信配置',	'A3kxznCAWjIH7ZVRW0hreEL5EhBYs2',	0,	0,	NULL,	NULL,	NULL,	1),
(260,	'aliyun_sms_tpl_id',	'阿里云短信模板ID',	'短信配置',	'SMS_148805148',	0,	0,	NULL,	NULL,	NULL,	1),
(261,	'aliyun_sms_sign',	'阿里云短信签名',	'短信配置',	'美度分发',	0,	0,	NULL,	NULL,	NULL,	1),
(262,	'down_max_num',	'并发最大下载数',	'超级签名下载配置',	'10000',	0,	0,	NULL,	NULL,	'并发最大下载数',	1),
(263,	'down_cancel_time',	'取消下载时长',	'超级签名下载配置',	'60',	0,	0,	NULL,	NULL,	'点击取消下载取消下载状态 秒',	1);

CREATE TABLE `cmf_download` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `coin` varchar(255) DEFAULT NULL COMMENT '金额',
  `download` int(11) DEFAULT NULL COMMENT '购买下载次数',
  `gift` int(11) DEFAULT NULL COMMENT '购买赠送下载次数：大于0有效',
  `recommend` smallint(2) DEFAULT NULL COMMENT '推荐购买状态：0-不推荐；1-推荐',
  `status` smallint(2) DEFAULT NULL COMMENT '下载购买状态：0-不显示；1-显示',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `cmf_download` (`id`, `coin`, `download`, `gift`, `recommend`, `status`, `addtime`) VALUES
(1,	'30',	1000,	0,	1,	1,	1571057968),
(2,	'10000',	300,	100,	1,	1,	1571057987),
(3,	'500',	20000,	200,	0,	1,	1571058011),
(4,	'1000',	45000,	500,	1,	1,	1571058034);

CREATE TABLE `cmf_downloading` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `appid` int(255) DEFAULT NULL,
  `addtime` int(32) DEFAULT NULL COMMENT '时间',
  `num` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='正在下载表';


CREATE TABLE `cmf_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '钩子类型(1:系统钩子;2:应用钩子;3:模板钩子)',
  `once` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否只允许一个插件运行(0:多个;1:一个)',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `hook` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子',
  `app` varchar(15) NOT NULL DEFAULT '' COMMENT '应用名(只有应用钩子才用)',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统钩子表';

INSERT INTO `cmf_hook` (`id`, `type`, `once`, `name`, `hook`, `app`, `description`) VALUES
(1,	1,	0,	'应用初始化',	'app_init',	'cmf',	'应用初始化'),
(2,	1,	0,	'应用开始',	'app_begin',	'cmf',	'应用开始'),
(3,	1,	0,	'模块初始化',	'module_init',	'cmf',	'模块初始化'),
(4,	1,	0,	'控制器开始',	'action_begin',	'cmf',	'控制器开始'),
(5,	1,	0,	'视图输出过滤',	'view_filter',	'cmf',	'视图输出过滤'),
(6,	1,	0,	'应用结束',	'app_end',	'cmf',	'应用结束'),
(7,	1,	0,	'日志write方法',	'log_write',	'cmf',	'日志write方法'),
(8,	1,	0,	'输出结束',	'response_end',	'cmf',	'输出结束'),
(9,	1,	0,	'后台控制器初始化',	'admin_init',	'cmf',	'后台控制器初始化'),
(10,	1,	0,	'前台控制器初始化',	'home_init',	'cmf',	'前台控制器初始化'),
(11,	1,	1,	'发送手机验证码',	'send_mobile_verification_code',	'cmf',	'发送手机验证码'),
(12,	3,	0,	'模板 body标签开始',	'body_start',	'',	'模板 body标签开始'),
(13,	3,	0,	'模板 head标签结束前',	'before_head_end',	'',	'模板 head标签结束前'),
(14,	3,	0,	'模板底部开始',	'footer_start',	'',	'模板底部开始'),
(15,	3,	0,	'模板底部开始之前',	'before_footer',	'',	'模板底部开始之前'),
(16,	3,	0,	'模板底部结束之前',	'before_footer_end',	'',	'模板底部结束之前'),
(17,	3,	0,	'模板 body 标签结束之前',	'before_body_end',	'',	'模板 body 标签结束之前'),
(18,	3,	0,	'模板左边栏开始',	'left_sidebar_start',	'',	'模板左边栏开始'),
(19,	3,	0,	'模板左边栏结束之前',	'before_left_sidebar_end',	'',	'模板左边栏结束之前'),
(20,	3,	0,	'模板右边栏开始',	'right_sidebar_start',	'',	'模板右边栏开始'),
(21,	3,	0,	'模板右边栏结束之前',	'before_right_sidebar_end',	'',	'模板右边栏结束之前'),
(22,	3,	1,	'评论区',	'comment',	'',	'评论区'),
(23,	3,	1,	'留言区',	'guestbook',	'',	'留言区'),
(24,	2,	0,	'后台首页仪表盘',	'admin_dashboard',	'admin',	'后台首页仪表盘'),
(25,	4,	0,	'后台模板 head标签结束前',	'admin_before_head_end',	'',	'后台模板 head标签结束前'),
(26,	4,	0,	'后台模板 body 标签结束之前',	'admin_before_body_end',	'',	'后台模板 body 标签结束之前'),
(27,	2,	0,	'后台登录页面',	'admin_login',	'admin',	'后台登录页面'),
(28,	1,	1,	'前台模板切换',	'switch_theme',	'cmf',	'前台模板切换'),
(29,	3,	0,	'主要内容之后',	'after_content',	'',	'主要内容之后'),
(30,	2,	0,	'文章显示之前',	'portal_before_assign_article',	'portal',	'文章显示之前'),
(31,	2,	0,	'后台文章保存之后',	'portal_admin_after_save_article',	'portal',	'后台文章保存之后');

CREATE TABLE `cmf_hook_plugin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `hook` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子名',
  `plugin` varchar(30) NOT NULL DEFAULT '' COMMENT '插件',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统钩子插件表';

INSERT INTO `cmf_hook_plugin` (`id`, `list_order`, `status`, `hook`, `plugin`) VALUES
(1,	10000,	1,	'send_mobile_verification_code',	'MobileCodeDemo');

CREATE TABLE `cmf_ios_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `team_id` varchar(255) NOT NULL,
  `iss` varchar(255) NOT NULL,
  `kid` varchar(255) NOT NULL,
  `tid` varchar(255) NOT NULL,
  `p12_pwd` varchar(255) NOT NULL,
  `p12_file` varchar(255) NOT NULL,
  `p8_file` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0私有1共有',
  `status` tinyint(1) NOT NULL COMMENT '0未启用1启用',
  `total_count` int(11) NOT NULL,
  `limit_count` int(11) NOT NULL,
  `mark` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `cmf_ios_udid_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `app_id` int(11) NOT NULL COMMENT '对应的应用ID',
  `udid` varchar(100) NOT NULL COMMENT 'UDID',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `device` varchar(50) NOT NULL COMMENT '设备',
  `certificate` int(11) NOT NULL COMMENT '证书ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `cmf_link` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:显示;0:不显示',
  `rating` int(11) NOT NULL DEFAULT '0' COMMENT '友情链接评级',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '友情链接描述',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '友情链接地址',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '友情链接名称',
  `image` varchar(100) NOT NULL DEFAULT '' COMMENT '友情链接图标',
  `target` varchar(10) NOT NULL DEFAULT '' COMMENT '友情链接打开方式',
  `rel` varchar(50) NOT NULL DEFAULT '' COMMENT '链接与网站的关系',
  PRIMARY KEY (`id`),
  KEY `link_visible` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='友情链接表';


CREATE TABLE `cmf_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_main` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否为主导航;1:是;0:不是',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '导航位置名称',
  `remark` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='前台导航位置表';

INSERT INTO `cmf_nav` (`id`, `is_main`, `name`, `remark`) VALUES
(1,	1,	'主导航',	'主导航'),
(2,	0,	'底部导航',	'');

CREATE TABLE `cmf_nav_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_id` int(11) NOT NULL COMMENT '导航 id',
  `parent_id` int(11) NOT NULL COMMENT '父 id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:显示;0:隐藏',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `target` varchar(10) NOT NULL DEFAULT '' COMMENT '打开方式',
  `href` varchar(100) NOT NULL DEFAULT '' COMMENT '链接',
  `icon` varchar(20) NOT NULL DEFAULT '' COMMENT '图标',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '层级关系',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='前台导航菜单表';

INSERT INTO `cmf_nav_menu` (`id`, `nav_id`, `parent_id`, `status`, `list_order`, `name`, `target`, `href`, `icon`, `path`) VALUES
(1,	1,	0,	1,	0,	'首页',	'',	'home',	'',	'0-1');

CREATE TABLE `cmf_option` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `autoload` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否自动加载;1:自动加载;0:不自动加载',
  `option_name` varchar(64) NOT NULL DEFAULT '' COMMENT '配置名',
  `option_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '配置值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='全站配置表';

INSERT INTO `cmf_option` (`id`, `autoload`, `option_name`, `option_value`) VALUES
(7,	1,	'site_info',	'{\"site_name\":\"isign\\u8d85\\u7ea7\\u7b7e\\u540d\",\"site_seo_title\":\"\\u79fb\\u52a8\\u5e94\\u7528\\u5185\\u6d4b|\\u514d\\u8d39App\\u5e94\\u7528\\u5206\\u53d1\\u6258\\u7ba1|iOS\\u8bc1\\u4e66\\u7b7e\\u540d|\\u7f51\\u9875\\u5c01\\u5305\",\"site_seo_keywords\":\"\\u9b54\\u7b7e,\\u4f01\\u4e1a\\u7b7e\\u540d,\\u7b7e\\u540d,APP\\u7b7e\\u540d,\\u7b7e\\u540d,\\u4f01\\u4e1a\\u7b7e\\u540d,\\u4f01\\u4e1a\\u8d26\\u53f7,app\\u4f01\\u4e1a\\u7b7e\\u540d,\\u8d85\\u7ea7VIP\\u7b7e\\u540d,\\u5185\\u6d4b\\u5206\\u53d1\\u6258\\u7ba1,app\\u5185\\u6d4b,app\\u6258\\u7ba1\\u5206\\u53d1,app\\u6d4b\\u8bd5,\\u5185\\u6d4b,android\\u5185\\u6d4b,beta test,Beta app,testflight,\\u514d\\u8d39\\u5185\\u6d4b,app\\u4e0b\\u8f7d,\\u5185\\u6d4bSDK,udid\\u83b7\\u53d6\\uff0cpgy,\\u5b89\\u5353\\u5185\\u6d4b,\\u5185\\u6d4b,\\u4f01\\u4e1a\\u7b7e\\u540d,APP\\u4f01\\u4e1a\\u7b7e\\u540d,\\u84b2\\u516c\\u82f1\\u4f01\\u4e1a\\u7b7e\\u540d,\\u4f01\\u4e1a\\u8bc1\\u4e66,\\u4f01\\u4e1a\\u8bc1\\u4e66,\\u4f01\\u4e1a\\u8bc1\\u4e66\\u7b7e\\u540d,apple\\u4f01\\u4e1a\\u7b7e\\u540d,\\u4f01\\u4e1a\\u7b7e\\u540d,\\u4f01\\u4e1a\\u7b7e\\u540d,\\u4f01\\u4e1a\\u8d26\\u53f7, \\u4f01\\u4e1a\\u7b7e\\u540d, \\u4f01\\u4e1a\\u8d26\\u53f7, apple\\u4f01\\u4e1a\\u8d26\\u53f7, apple \\u4f01\\u4e1a\\u8d26\\u53f7, apple\\u4f01\\u4e1a\\u8bc1\\u4e66, apple \\u4f01\\u4e1a\\u8bc1\\u4e66, \\u4f01\\u4e1a\\u8d26\\u53f7, \\u4f01\\u4e1a\\u5206\\u53d1, \\u4f01\\u4e1a\\u5206\\u53d1, \\u4f01\\u4e1a\\u5206\\u53d1\",\"site_seo_description\":\"\\u4e00\\u53e3\\u9752\\u79d1\\u6280-\\u9b54\\u7b7e\\u4e13\\u4e1a\\u5e94\\u7528\\u5206\\u53d1\\u5185\\u6d4b\\u7b7e\\u540d\\u670d\\u52a1\\u5546\\uff0c\\u63d0\\u4f9b\\u4e00\\u7ad9\\u5f0f\\u5e94\\u7528\\u4f01\\u4e1a\\u7b7e\\u540d\\uff0c\\u8d85\\u7ea7VIP\\u7b7e\\u540d\\uff0c\\u626b\\u7801\\u4e0b\\u8f7d\\u5b89\\u88c5\\uff0c\\u5e94\\u7528\\u6258\\u7ba1\\uff0c\\u7f51\\u9875\\u5c01\\u88c5\\uff0c\\u5e94\\u7528\\u5ba1\\u6838\\u4e0a\\u67b6\\u7b49\\u670d\\u52a1\\u3002\\u4e13\\u4e1a\\u6280\\u672f\\u56e2\\u961f\\u4e3a\\u4f60\\u5e94\\u7528\\u5206\\u53d1\\u5185\\u6d4b\\u4fdd\\u9a7e\\u62a4\\u822a\\uff0c\\u89e3\\u51b3\\u5f00\\u53d1\\u8005app\\u5185\\u6d4b\\u5206\\u53d1\\u6258\\u7ba1\\u65f6\\u7e41\\u6742\\u4f4e\\u6548\\u7684\\u95ee\\u9898\",\"site_icp\":\"\",\"site_admin_email\":\"\",\"site_analytics\":\"\",\"urlmode\":\"1\",\"html_suffix\":\"\"}'),
(8,	1,	'storage',	'{\"storages\":{\"Qiniu\":{\"name\":\"\\u4e03\\u725b\\u4e91\\u5b58\\u50a8\",\"driver\":\"\\\\plugins\\\\qiniu\\\\lib\\\\Qiniu\"}},\"type\":\"Local\"}'),
(9,	1,	'cmf_settings',	'{\"open_registration\":\"1\",\"banned_usernames\":\"\"}'),
(10,	1,	'cdn_settings',	'{\"cdn_static_root\":\"\"}'),
(11,	1,	'admin_settings',	'{\"admin_password\":\"\",\"admin_style\":\"flatadmin\"}'),
(12,	1,	'upload_setting',	'{\"max_files\":\"20\",\"chunk_size\":\"512\",\"file_types\":{\"image\":{\"upload_max_filesize\":\"10240\",\"extensions\":\"jpg,jpeg,png,gif,bmp4\"},\"video\":{\"upload_max_filesize\":\"10240\",\"extensions\":\"mp4,avi,wmv,rm,rmvb,mkv\"},\"audio\":{\"upload_max_filesize\":\"10240\",\"extensions\":\"mp3,wma,wav\"},\"file\":{\"upload_max_filesize\":\"10240\",\"extensions\":\"txt,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar\"}}}');

CREATE TABLE `cmf_plugin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '插件类型;1:网站;8:微信',
  `has_admin` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台管理,0:没有;1:有',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:开启;0:禁用',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插件安装时间',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '插件标识名,英文字母(惟一)',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '插件名称',
  `demo_url` varchar(50) NOT NULL DEFAULT '' COMMENT '演示地址，带协议',
  `hooks` varchar(255) NOT NULL DEFAULT '' COMMENT '实现的钩子;以“,”分隔',
  `author` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '插件作者',
  `author_url` varchar(50) NOT NULL DEFAULT '' COMMENT '作者网站链接',
  `version` varchar(20) NOT NULL DEFAULT '' COMMENT '插件版本号',
  `description` varchar(255) NOT NULL COMMENT '插件描述',
  `config` text COMMENT '插件配置',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='插件表';

INSERT INTO `cmf_plugin` (`id`, `type`, `has_admin`, `status`, `create_time`, `name`, `title`, `demo_url`, `hooks`, `author`, `author_url`, `version`, `description`, `config`) VALUES
(14,	1,	0,	1,	0,	'Qiniu',	'七牛云存储',	'',	'',	'ThinkCMF',	'',	'1.0',	'七牛云存储',	'{\"accessKey\":\"6mFajponpNew0DhPajv9jgzGnbfGK4GWXRgNNfNY\",\"secretKey\":\"XVDXCtraFxA3yv0upuquNb7rzdOFBBmUlDqNlZ8F\",\"protocol\":\"http\",\"domain\":\"api2.meidulm.com\",\"bucket\":\"fenfale\",\"style_separator\":\"!\",\"styles_watermark\":\"watermark\",\"styles_avatar\":\"avatar\",\"styles_thumbnail120x120\":\"thumbnail120x120\",\"styles_thumbnail300x300\":\"thumbnail300x300\",\"styles_thumbnail640x640\":\"thumbnail640x640\",\"styles_thumbnail1080x1080\":\"thumbnail1080x1080\"}'),
(15,	1,	0,	1,	0,	'MobileCodeDemo',	'手机验证码演示插件',	'',	'',	'ThinkCMF',	'',	'1.0',	'手机验证码演示插件',	'{\"account_sid\":\"\",\"auth_token\":\"\",\"app_id\":\"\",\"template_id\":\"\",\"expire_minute\":\"30\"}');

CREATE TABLE `cmf_portal_category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '分类父id',
  `post_count` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '分类文章数',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:发布,0:不发布',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `description` varchar(255) NOT NULL COMMENT '分类描述',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '分类层级关系路径',
  `seo_title` varchar(100) NOT NULL DEFAULT '',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '',
  `seo_description` varchar(255) NOT NULL DEFAULT '',
  `list_tpl` varchar(50) NOT NULL DEFAULT '' COMMENT '分类列表模板',
  `one_tpl` varchar(50) NOT NULL DEFAULT '' COMMENT '分类文章页模板',
  `more` text COMMENT '扩展属性',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='portal应用 文章分类表';

INSERT INTO `cmf_portal_category` (`id`, `parent_id`, `post_count`, `status`, `delete_time`, `list_order`, `name`, `description`, `path`, `seo_title`, `seo_keywords`, `seo_description`, `list_tpl`, `one_tpl`, `more`) VALUES
(1,	0,	0,	1,	0,	10000,	'充值协议',	'充值协议',	'0-1',	'',	'',	'',	'list',	'article',	'{\"thumbnail\":\"\"}'),
(2,	0,	0,	1,	0,	10000,	'法律法规',	'法律法规',	'0-2',	'',	'',	'',	'list',	'article',	'{\"thumbnail\":\"\"}');

CREATE TABLE `cmf_portal_category_post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文章id',
  `category_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:发布;0:不发布',
  PRIMARY KEY (`id`),
  KEY `term_taxonomy_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='portal应用 分类文章对应表';

INSERT INTO `cmf_portal_category_post` (`id`, `post_id`, `category_id`, `list_order`, `status`) VALUES
(1,	1,	1,	10000,	1),
(2,	2,	2,	10000,	1);

CREATE TABLE `cmf_portal_post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `post_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型,1:文章;2:页面',
  `post_format` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '内容格式;1:html;2:md',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '发表者用户id',
  `post_status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:已发布;0:未发布;',
  `comment_status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '评论状态;1:允许;0:不允许',
  `is_top` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶;1:置顶;0:不置顶',
  `recommended` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐;1:推荐;0:不推荐',
  `post_hits` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '查看数',
  `post_like` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数',
  `comment_count` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `published_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `post_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'post标题',
  `post_keywords` varchar(150) NOT NULL DEFAULT '' COMMENT 'seo keywords',
  `post_excerpt` varchar(500) NOT NULL DEFAULT '' COMMENT 'post摘要',
  `post_source` varchar(150) NOT NULL DEFAULT '' COMMENT '转载文章的来源',
  `post_content` text COMMENT '文章内容',
  `post_content_filtered` text COMMENT '处理过的文章内容',
  `more` text COMMENT '扩展属性,如缩略图;格式为json',
  PRIMARY KEY (`id`),
  KEY `type_status_date` (`post_type`,`post_status`,`create_time`,`id`),
  KEY `post_parent` (`parent_id`),
  KEY `post_author` (`user_id`),
  KEY `post_date` (`create_time`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='portal应用 文章表';

INSERT INTO `cmf_portal_post` (`id`, `parent_id`, `post_type`, `post_format`, `user_id`, `post_status`, `comment_status`, `is_top`, `recommended`, `post_hits`, `post_like`, `comment_count`, `create_time`, `update_time`, `published_time`, `delete_time`, `post_title`, `post_keywords`, `post_excerpt`, `post_source`, `post_content`, `post_content_filtered`, `more`) VALUES
(1,	0,	1,	1,	1,	1,	1,	0,	0,	42,	3,	0,	1567478956,	1567478995,	1567478940,	0,	'超级签名充值协议',	'超级签名充值协议',	'',	'',	'&lt;p&gt;超级签名充值协议&lt;/p&gt;',	NULL,	'{\"thumbnail\":\"\",\"template\":\"\"}'),
(2,	0,	1,	1,	1,	1,	1,	0,	0,	4,	0,	0,	1567668866,	1570020090,	1567668780,	0,	'法律法规',	'法律法规',	'',	'',	'\n&lt;p style=&quot;margin-top:20px;margin-right:0;margin-bottom:15px;margin-left:0;text-align:center;background:white;border:none;padding:0;padding:0 0 15px 0&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size:36px;font-family:微软雅黑;color:#333333&quot;&gt;多肉应用审核规范&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-top:20px;margin-right:0;margin-bottom:20px;margin-left:0;text-align:left;line-height:50px;background:white&quot;&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;目录（Contents）&lt;/span&gt;&lt;/p&gt;\n&lt;ul class=&quot; list-paddingleft-2&quot; style=&quot;list-style-type: disc;&quot;&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑&quot;&gt;&lt;span style=&quot;color:#57B99D&quot;&gt;1&lt;/span&gt;&lt;span style=&quot;color:#57B99D&quot;&gt;、条款（&lt;/span&gt;&lt;span style=&quot;color:#57B99D&quot;&gt;Terms and Conditions&lt;/span&gt;&lt;span style=&quot;color:#57B99D&quot;&gt;）&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑&quot;&gt;&lt;span style=&quot;color:#57B99D&quot;&gt;2&lt;/span&gt;&lt;span style=&quot;color:#57B99D&quot;&gt;、应用功能（&lt;/span&gt;&lt;span style=&quot;color:#57B99D&quot;&gt;Functionality&lt;/span&gt;&lt;span style=&quot;color:#57B99D&quot;&gt;）&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size: 14px; font-family: 微软雅黑; color: rgb(87, 185, 157);&quot;&gt;3、应用展示（App Properties）和广告（AD）&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size: 14px; font-family: 微软雅黑; color: rgb(87, 185, 157);&quot;&gt;4、应用内容（Contents of App）&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size: 14px; font-family: 微软雅黑; color: rgb(87, 185, 157);&quot;&gt;5、损坏设备（Damage to Device）&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size: 14px; font-family: 微软雅黑; color: rgb(87, 185, 157);&quot;&gt;6、法律要求（Legal Requirements）&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size: 14px; font-family: 微软雅黑; color: rgb(87, 185, 157);&quot;&gt;7、应用视频预览审核（Video Demo Review）&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p style=&quot;margin-top:10px;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;line-height:50px;background:white&quot;&gt;&lt;a name=&quot;01&quot; href=&quot;&quot;&gt;&lt;/a&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;1&lt;/span&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;、概述（Overview）&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;多肉是国内领先的应用内测分发平台，我们希望为全球的开发者提供一个能够有效提高应用内测分发效率的平台。我们很高兴您参与到多肉内测分发开发者行列中来，我们愿与开发者一起学习、交流与成长，并不断更好的为您提供方便、快捷的应用分发测试服务，共同打造良好的开发者生态圈！ 这个文档会及时更新并完善，请每位多肉开发者密切关注。我们的每一次修改将根据最新法律法规，以保证开发者及用户的合法权益为基准，做到公平对待所有开发者，努力营造积极、健康的移动互联网应用环境。我们期望得到优质、可靠、健康的应用，希望您也如我们一样，所以开发者们需要了解，多肉内测分发平台收录应用的一些原则：&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-top:10px;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;line-height:50px;background:white&quot;&gt;&lt;a name=&quot;02&quot; href=&quot;&quot;&gt;&lt;/a&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;2&lt;/span&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;、应用功能（Functionality）&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;2.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用功能存在问题&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.1.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用强制或诱导修改系统默认设置&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.1.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用功能需要依赖于第三方应用才能实现&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.1.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用需要登录，但应用内不提供注册通道，请在完善资料处填写测试账号。&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.1.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;注册账号功能不可用，应用审核时尝试3次都无法成功注册&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.1.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用登录账号功能不可用，应用审核时尝试3次都无法成功登录&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.1.6 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用需要其他硬件设备支持，审核人员无法进行测试&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;2.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用描述和实际功能不符&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.2.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在欺骗用户下载使用的行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;2.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;申请危险权限或权限和功能不符&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.3.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用申请的权限和其实际功能不符&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.3.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用实际功能不需常驻通知栏却常驻通知栏&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.3.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用无法关闭常驻通知提示&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.3.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用实际功能不需开机启动却开机启动&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.3.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用在安装或者运行前强制重启设备&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;2.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用功能存在使用限制&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.4.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用功能仅供部分用户使用，比如限制用户的地域或仅供组织内部使用等，请在应用介绍内说明具体限制范围&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;2.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用存在恶意行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.5.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在恶意行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.5.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用未经用户许可发送短信，建议使用返回验证码等方式&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.5.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在病毒&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.5.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在吸费行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.5.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用消耗过多的网络流量&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.5.6 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用未经用户许可拨打电话&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.5.7 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用修改主叫号码，主要功能用于欺骗被叫用户&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;2.5.8 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用未运行，但是仍会启动GPS、蓝牙等系统功能&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-top:10px;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;line-height:50px;background:white&quot;&gt;&lt;a name=&quot;03&quot; href=&quot;&quot;&gt;&lt;/a&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;3&lt;/span&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;、应用展示和广告（App Properties &amp;amp; AD）&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;3.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用展示内容存在问题&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.1.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用内容存在侵权行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.1.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用名称包含非法内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.1.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用名称存在侵权行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.1.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用介绍或更新说明包含非法内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.1.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用介绍或更新说明中包含侵权内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.1.6 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;简介中使用了极限词或虚假承诺等违反新广告法的内容（如“最”“第一”“唯一”“NO.1”“必备”“免费送”“100%” “全球”“顶尖”“首”等）；&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.1.7 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;简介中包含违规内容（如侵权、色情、恐怖暴力、反动等）&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;3.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用展示的图片资源存在问题&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.2.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用截图和应用实际的界面不符&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.2.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用截图模糊不清，无法分辨截图内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.2.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用截图存在非法内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.2.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用截图存在侵权行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.2.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用截图的通知栏中包含与应用功能无关内容，请仅保留手机系统自带的信号、运营商信息等提示&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.2.6 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用展示的ICON和安装到设备上的ICON不一致，请您自行对比应用在页面展示和手机端展示的ICON&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.2.7 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用ICON存在非法内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.2.8 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用ICON存在侵权行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;3.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;广告相关&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用未经用户许可或默认勾选创建桌面快捷方式&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用未经用户许可默认安装或默认勾选安装第三方应用&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用未经用户许可修改系统默认设置&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在诱导用户点击广告的行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在通知栏广告&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.6 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用多次发现存在通知栏广告行为，将不再收录&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.7 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在强制积分墙，在启动时强制要求换取积分才能使用&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.8 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在强制积分墙，在使用时强制要求换取积分&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.9 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用具有诱导用户赚取积分兑换货币或奖品的功能&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.10 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;暂不收录：赚取积分以兑换话费、现金等奖品的应用&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.11 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在抢占锁屏的行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.12 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用广告存在模仿系统通知或警告的行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.13 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用的主要目的是展示广告或者市场营销&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.14 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用使用过程中频繁弹出悬浮窗广告，中断用户操作，影响用户体验&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.15 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用包含空广告栏位&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;3.3.16 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用广告中包含不良或违法信息&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-top:10px;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;line-height:50px;background:white&quot;&gt;&lt;a name=&quot;04&quot; href=&quot;&quot;&gt;&lt;/a&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;4&lt;/span&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;、应用内容（Contents of App）&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;4.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用存在暴力内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.1.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;任何带有诽谤、人身攻击或者侮辱个人或者团体的应用&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.1.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在人类或动物被杀、被虐待、被伤害等图片或内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.1.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用过分描述暴力或虐待儿童&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.1.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用对武器进行过于逼真的表述（如不能涉及武器的制造工艺和参数等），并鼓励违法或滥用武器&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;4.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用存在色情内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.2.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用包含色情内容或者过分展现性器官，但又不是旨在艺术审美或情感&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.2.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用中存在允许用户提交色情内容，如允许用户发布色情照片、文字等&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.2.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;情趣用品商城类应用禁止存在社区、论坛等允许用户发布帖子、信息和评论帖子等功能和模块，请您将以上模块进行删除&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.2.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用介绍、应用截图、描述语等含有色情内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;4.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用存在非法金钱交易或内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.3.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用具有现金或者流通货币赌博功能&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;4.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;政治问题&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.4.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用不能包含对国家领导人诽谤、人身攻击或者侮辱性的内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.4.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用包含反政府、反社会内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.4.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;存在政治错误的应用&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;4.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;用户使用感受&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.5.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;多肉内测平台暂不收录：游戏类应用，包括单机游戏、网络游戏或H5游戏的应用&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.5.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;多肉内测平台暂不收录：彩票类应用，含有购买彩票、代购彩票等彩票交易功能的应用&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.5.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;多肉内测平台暂不收录：主要功能需要获取Root权限后才可使用的应&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.5.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用设计的功能不能为主要是令用户厌恶、恐惧&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.5.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用不能具有易引起用户不适或者比较粗俗的内容，如对血腥和色情场面的过分展现&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.5.6 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用中所有的“敌人”角色，都不能针对任何一个现实的种族、文化、政府或公司，以及任何一个真实的个体&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.5.7 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用中涉及的宗教内容都应该是翻译准确和使用恰当的，并且不存在误导行为。使用这些内容的目的应该是教育意义的而不是煽动性的&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.5.8 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;存在针对某一宗教、文化或种族的诽谤、侮辱或攻击的内容，或有可能让这部分群体人们造成情感伤害的内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;4.6 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用内抽奖相关功能及内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.6.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用中的竞赛和抽奖活动必须由该应用开发者来发起&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.6.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;竞赛和抽奖活动必须在应用的用户协议中有清晰详细的描述，且这些竞赛或抽奖活动和多肉应用内测专家无关，多肉应用内测专家不承担任何相关法律责任&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;4.7 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;开发者行为不当&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.7.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;开发者对已经明确版权归属的应用私自进行破解、汉化、反编译或重新打包，应用将被驳回且开发者将被取消多肉账户&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;4.7.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;开发者提交的应用存在问题或开发者自身原因，开发者应主动申请驳回、删除或下架&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-top:10px;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;line-height:50px;background:white&quot;&gt;&lt;a name=&quot;05&quot; href=&quot;&quot;&gt;&lt;/a&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;5&lt;/span&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;、损坏设备（Damage to Device）&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;5.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;用户运行该应用有可能损坏设备&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;5.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用如会迅速消耗电量或者造成设备过热&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;5.2.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用未启动，但不断使用GPS等功能导致用户电量迅速消耗&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;5.2.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用未启动，但会长时间占用CPU、内存等导致设备过热&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-top:10px;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;line-height:50px;background:white&quot;&gt;&lt;a name=&quot;06&quot; href=&quot;&quot;&gt;&lt;/a&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;6&lt;/span&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;、法律要求（Legal Requirements）&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;6.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;违反国家法律法规&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.1.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用都必须遵守当地的所有法律法规，开发者都有义务熟悉并遵守相关的法律法规&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;6.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用允许共享违法的文件或内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.2.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用怂恿或鼓励犯罪或暴力行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.2.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用鼓励酒驾或公布没有经过交通管理部门允许的酒驾检测点数据&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.2.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用过度宣传酒精或者危险物品（如毒药、爆炸物等），或者鼓励未成年人消费香烟和酒精饮料&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;6.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用存在侵犯版权行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.3.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用为破解、盗版或未获得版权所有者授权的应用&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.3.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;单本图书类应用请提供版权证明 ，书城类应用请提供免责声明，以上文件均需以附件形式发送到审核邮箱：190646521@qq.com。&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;6.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;应用存在欺诈行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.4.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用存在欺骗、伪造或者误导用户的行为&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;6.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;隐私保护&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.5.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用未提示用户或未经用户授权情况下不得搜集、传输或者使用用户的位置信息&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.5.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用未经用户许可且在用户不知情的情况下不得传输和使用用户的隐私数据，如通讯录、照片和短信记录等&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.5.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用不得强制要求用户共享其个人信息，如邮件地址或生日等信息&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.5.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用不得搜集未成年人信息数据&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;6.5.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;开发者的应用会窃取用户密码或者其他用户个人数据的将被取消多肉账户&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-top:10px;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;line-height:50px;background:white&quot;&gt;&lt;a name=&quot;07&quot; href=&quot;&quot;&gt;&lt;/a&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;7&lt;/span&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;、应用视频预览审核（Video Demo Review）&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:25px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;7.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#333333&quot;&gt;视频内容存在问题&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;7.1.1 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用视频内容过于简单，未突出应用特点，宣传价值较小&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;7.1.2 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用视频中，操作演示过快，请放慢演示&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;7.1.3 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用视频内容与应用功能或介绍信息不符&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;7.1.4 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用视频存在侵权内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;7.1.5 &lt;/span&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;应用视频存在色情、血腥暴力、政治、赌博等内容&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-top:10px;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;line-height:50px;background:white&quot;&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;8&lt;/span&gt;&lt;span style=&quot;font-size:24px;font-family:微软雅黑;color:#333333&quot;&gt;、提交之后：&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin-bottom:10px;text-align:left;line-height:28px;background:white&quot;&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑;color:#878F92&quot;&gt;在您将应用上传至多肉内测分发平台后，您的应用随时会进入审核流程，还请您密切关注您应用的审核状态，并谨记以下几点：&lt;/span&gt;&lt;/p&gt;\n&lt;ul type=&quot;disc&quot; class=&quot; list-paddingleft-2&quot;&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑&quot;&gt;(1) &lt;/span&gt;&lt;span style=&quot;font-size:      14px;font-family:微软雅黑&quot;&gt;时间安排：多肉审核团队将会全年全日无休，按照《多肉应用审核规范》检查您的应用。&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑&quot;&gt;(2) &lt;/span&gt;&lt;span style=&quot;font-size:      14px;font-family:微软雅黑&quot;&gt;状态更新：若您的应用被下架，您可在「应用管理」中查看到下架状态，或收到多肉的短信和邮件通知。&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑&quot;&gt;(3) &lt;/span&gt;&lt;span style=&quot;font-size:      14px;font-family:微软雅黑&quot;&gt;应用下架：我们的目标是公平、持续地遵循这些准则，但是金无足赤、人无完人。如果您的应用被下架，但您存在疑问，或希望提供其他信息，请您前往多肉「应用管理」中心，点击申诉可直接与我们联系。或以邮件的形式联系我方申诉邮箱：190646521@qq.com，邮件内容需包含您的多肉账号信息（无需提供密码），方便我们查询具体情况，我们的审核团队会尽快与您取得联络。&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑&quot;&gt;(4) &lt;/span&gt;&lt;span style=&quot;font-size:      14px;font-family:微软雅黑&quot;&gt;下架反馈：多肉愿与开发者积极交流，请您配合我方审核要求提供有效材料信息接受应用重审，若您的应用确实存在误封情况，我们会第一时间为您恢复应用上架，同时也可帮助我们改进多肉应用审核流程。&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;li&gt;&lt;p&gt;&lt;span style=&quot;font-size:14px;font-family:微软雅黑&quot;&gt;(5) &lt;/span&gt;&lt;span style=&quot;font-size:      14px;font-family:微软雅黑&quot;&gt;游戏审核：多肉为更好的服务广大开发者，保障开发者和我方的利益，多肉现支持合规的游戏类应用分发，需附有该应用的游戏文网文，软件著作权登记证，ICP 许可证等相关文件。当审核判定应用为游戏类应用时，将在您的「应用管理」及邮箱中提供补充相关文件的说明，点击链接上传相关文件即可。多肉审核团队将尽快对您的游戏应用和资质证明进行审核。一旦通过审核，您的游戏应用将自动恢复上架，之后您可以继续上传您的更新版本。&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;\n&lt;/ul&gt;\n',	NULL,	'{\"thumbnail\":\"\",\"template\":\"\"}');

CREATE TABLE `cmf_portal_tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:发布,0:不发布',
  `recommended` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐;1:推荐;0:不推荐',
  `post_count` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '标签文章数',
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标签名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='portal应用 文章标签表';

INSERT INTO `cmf_portal_tag` (`id`, `status`, `recommended`, `post_count`, `name`) VALUES
(1,	1,	0,	0,	'超级签名充值协议'),
(2,	1,	0,	0,	'法律法规');

CREATE TABLE `cmf_portal_tag_post` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '标签 id',
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文章 id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:发布;0:不发布',
  PRIMARY KEY (`id`),
  KEY `term_taxonomy_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='portal应用 标签文章对应表';

INSERT INTO `cmf_portal_tag_post` (`id`, `tag_id`, `post_id`, `status`) VALUES
(1,	1,	1,	1),
(2,	2,	2,	1);

CREATE TABLE `cmf_recycle_bin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT '0' COMMENT '删除内容 id',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `table_name` varchar(60) DEFAULT '' COMMENT '删除内容所在表名',
  `name` varchar(255) DEFAULT '' COMMENT '删除内容名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT=' 回收站';


CREATE TABLE `cmf_report_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL COMMENT '举报人邮箱',
  `reason` varchar(50) NOT NULL COMMENT '原因',
  `content` varchar(255) NOT NULL COMMENT '描述内容',
  `app_id` int(11) NOT NULL COMMENT '举报的应用ID',
  `file` varchar(255) NOT NULL COMMENT '证据文件',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `cmf_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父角色ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态;0:禁用;1:正常',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `list_order` float NOT NULL DEFAULT '0' COMMENT '排序',
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `parentId` (`parent_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色表';

INSERT INTO `cmf_role` (`id`, `parent_id`, `status`, `create_time`, `update_time`, `list_order`, `name`, `remark`) VALUES
(1,	0,	1,	1329633709,	1329633709,	0,	'超级管理员',	'拥有网站最高管理员权限！'),
(2,	0,	1,	1329633709,	1329633709,	0,	'普通管理员',	'权限由最高管理员分配！');

CREATE TABLE `cmf_role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色 id',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`),
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户角色对应表';

INSERT INTO `cmf_role_user` (`id`, `role_id`, `user_id`) VALUES
(11,	2,	8);

CREATE TABLE `cmf_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '路由id',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态;1:启用,0:不启用',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'URL规则类型;1:用户自定义;2:别名添加',
  `full_url` varchar(255) NOT NULL DEFAULT '' COMMENT '完整url',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '实际显示的url',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='url路由表';

INSERT INTO `cmf_route` (`id`, `list_order`, `status`, `type`, `full_url`, `url`) VALUES
(1,	5000,	1,	2,	'portal/List/index?id=1',	'充值协议'),
(2,	4999,	1,	2,	'portal/Article/index?cid=1',	'充值协议/:id'),
(3,	5000,	1,	2,	'portal/List/index?id=2',	'法律法规'),
(4,	4999,	1,	2,	'portal/Article/index?cid=2',	'法律法规/:id');

CREATE TABLE `cmf_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:显示,0不显示',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `name` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '幻灯片分类',
  `remark` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '分类备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='幻灯片表';


CREATE TABLE `cmf_slide_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slide_id` int(11) NOT NULL DEFAULT '0' COMMENT '幻灯片id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:显示;0:隐藏',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '幻灯片名称',
  `image` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '幻灯片图片',
  `url` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '幻灯片链接',
  `target` varchar(10) NOT NULL DEFAULT '' COMMENT '友情链接打开方式',
  `description` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '幻灯片描述',
  `content` text CHARACTER SET utf8 COMMENT '幻灯片内容',
  `more` text COMMENT '链接打开方式',
  PRIMARY KEY (`id`),
  KEY `slide_cid` (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='幻灯片子项表';


CREATE TABLE `cmf_super_download_log` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `uid` int(32) NOT NULL COMMENT '上传app用户ID',
  `app_id` int(32) NOT NULL COMMENT 'appid',
  `cid` int(32) NOT NULL COMMENT '证书ID',
  `udid` varchar(50) NOT NULL,
  `device` varchar(50) NOT NULL COMMENT '设备',
  `type` int(1) NOT NULL COMMENT '1公有，2私有',
  `ip` varchar(50) NOT NULL COMMENT '下载IP地址',
  `addtime` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='超级签名下载使用下载池记录';


CREATE TABLE `cmf_super_num` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) DEFAULT NULL COMMENT '1公有，2私有',
  `num` int(32) DEFAULT NULL COMMENT '次数',
  `coin` varchar(255) DEFAULT NULL COMMENT '金额',
  `gift` int(32) DEFAULT '0' COMMENT '赠送次数',
  `orderno` int(11) DEFAULT NULL COMMENT '排序',
  `addtime` int(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cmf_super_num` (`id`, `type`, `num`, `coin`, `gift`, `orderno`, `addtime`) VALUES
(1,	1,	10,	'160',	0,	1,	1570927842),
(2,	1,	100,	'1500',	0,	2,	1570927852),
(3,	1,	1000,	'14000',	0,	3,	1570927875),
(4,	1,	10000,	'130000',	0,	4,	1570927894),
(5,	2,	10,	'25',	0,	1,	1570927904),
(6,	2,	100,	'250',	0,	2,	1570927915),
(7,	2,	1000,	'2400',	0,	3,	1570927926),
(8,	2,	5000,	'9000',	0,	4,	1570927966),
(9,	2,	10000,	'14000',	0,	5,	1570928009);

CREATE TABLE `cmf_super_signature_ipa` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `appid` int(32) NOT NULL COMMENT '原始文件ipaid',
  `supurl` varchar(255) NOT NULL COMMENT '生成的ipa',
  `udid` varchar(50) NOT NULL COMMENT 'udid',
  `addtime` int(32) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `cmf_sup_charge_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(32) DEFAULT NULL COMMENT '用户ID',
  `num` int(32) DEFAULT NULL COMMENT '次数',
  `type` int(1) DEFAULT NULL COMMENT '1公有，2私有',
  `addtime` int(32) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='手动添加超级签名下载记录';


CREATE TABLE `cmf_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后升级时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '模板状态,1:正在使用;0:未使用',
  `is_compiled` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为已编译模板',
  `theme` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '主题目录名，用于主题的维一标识',
  `name` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '主题名称',
  `version` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '主题版本号',
  `demo_url` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '演示地址，带协议',
  `thumbnail` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '缩略图',
  `author` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '主题作者',
  `author_url` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '作者网站链接',
  `lang` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '支持语言',
  `keywords` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '主题关键字',
  `description` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '主题描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `cmf_theme` (`id`, `create_time`, `update_time`, `status`, `is_compiled`, `theme`, `name`, `version`, `demo_url`, `thumbnail`, `author`, `author_url`, `lang`, `keywords`, `description`) VALUES
(19,	0,	0,	0,	0,	'simpleboot3',	'simpleboot3',	'1.0.2',	'http://demo.thinkcmf.com',	'',	'ThinkCMF',	'http://www.thinkcmf.com',	'zh-cn',	'ThinkCMF模板',	'ThinkCMF默认模板');

CREATE TABLE `cmf_theme_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_public` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否公共的模板文件',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `theme` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '模板名称',
  `name` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '模板文件名',
  `action` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '操作',
  `file` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '模板文件，相对于模板根目录，如Portal/index.html',
  `description` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '模板文件描述',
  `more` text CHARACTER SET utf8 COMMENT '模板更多配置,用户自己后台设置的',
  `config_more` text CHARACTER SET utf8 COMMENT '模板更多配置,来源模板的配置文件',
  `draft_more` text CHARACTER SET utf8 COMMENT '模板更多配置,用户临时保存的配置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `cmf_theme_file` (`id`, `is_public`, `list_order`, `theme`, `name`, `action`, `file`, `description`, `more`, `config_more`, `draft_more`) VALUES
(105,	0,	10,	'simpleboot3',	'文章页',	'portal/Article/index',	'portal/article',	'文章页模板文件',	'{\"vars\":{\"hot_articles_category_id\":{\"title\":\"Hot Articles\\u5206\\u7c7bID\",\"name\":\"hot_articles_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}',	'{\"vars\":{\"hot_articles_category_id\":{\"title\":\"Hot Articles\\u5206\\u7c7bID\",\"name\":\"hot_articles_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}',	NULL),
(106,	0,	10,	'simpleboot3',	'联系我们页',	'portal/Page/index',	'portal/contact',	'联系我们页模板文件',	'{\"vars\":{\"baidu_map_info_window_text\":{\"title\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57\",\"name\":\"baidu_map_info_window_text\",\"value\":\"ThinkCMF<br\\/><span class=\'\'>\\u5730\\u5740\\uff1a\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def2601\\u53f7<\\/span>\",\"type\":\"text\",\"tip\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57,\\u652f\\u6301\\u7b80\\u5355html\\u4ee3\\u7801\",\"rule\":[]},\"company_location\":{\"title\":\"\\u516c\\u53f8\\u5750\\u6807\",\"value\":\"\",\"type\":\"location\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_cn\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\",\"value\":\"\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def0001\\u53f7\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_en\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"NO.0001 Xie Tu Road, Shanghai China\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"email\":{\"title\":\"\\u516c\\u53f8\\u90ae\\u7bb1\",\"value\":\"catman@thinkcmf.com\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_cn\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\",\"value\":\"021 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_en\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"+8621 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"qq\":{\"title\":\"\\u8054\\u7cfbQQ\",\"value\":\"478519726\",\"type\":\"text\",\"tip\":\"\\u591a\\u4e2a QQ\\u4ee5\\u82f1\\u6587\\u9017\\u53f7\\u9694\\u5f00\",\"rule\":{\"require\":true}}}}',	'{\"vars\":{\"baidu_map_info_window_text\":{\"title\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57\",\"name\":\"baidu_map_info_window_text\",\"value\":\"ThinkCMF<br\\/><span class=\'\'>\\u5730\\u5740\\uff1a\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def2601\\u53f7<\\/span>\",\"type\":\"text\",\"tip\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57,\\u652f\\u6301\\u7b80\\u5355html\\u4ee3\\u7801\",\"rule\":[]},\"company_location\":{\"title\":\"\\u516c\\u53f8\\u5750\\u6807\",\"value\":\"\",\"type\":\"location\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_cn\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\",\"value\":\"\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def0001\\u53f7\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_en\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"NO.0001 Xie Tu Road, Shanghai China\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"email\":{\"title\":\"\\u516c\\u53f8\\u90ae\\u7bb1\",\"value\":\"catman@thinkcmf.com\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_cn\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\",\"value\":\"021 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_en\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"+8621 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"qq\":{\"title\":\"\\u8054\\u7cfbQQ\",\"value\":\"478519726\",\"type\":\"text\",\"tip\":\"\\u591a\\u4e2a QQ\\u4ee5\\u82f1\\u6587\\u9017\\u53f7\\u9694\\u5f00\",\"rule\":{\"require\":true}}}}',	NULL),
(107,	0,	5,	'simpleboot3',	'首页',	'portal/Index/index',	'portal/index',	'首页模板文件',	'{\"vars\":{\"top_slide\":{\"title\":\"\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"admin\\/Slide\\/index\",\"multi\":false},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"tip\":\"\",\"rule\":{\"require\":true}}}}',	'{\"vars\":{\"top_slide\":{\"title\":\"\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"admin\\/Slide\\/index\",\"multi\":false},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"tip\":\"\",\"rule\":{\"require\":true}}}}',	NULL),
(108,	0,	10,	'simpleboot3',	'文章列表页',	'portal/List/index',	'portal/list',	'文章列表模板文件',	'{\"vars\":[],\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}',	'{\"vars\":[],\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}',	NULL),
(109,	0,	10,	'simpleboot3',	'单页面',	'portal/Page/index',	'portal/page',	'单页面模板文件',	'{\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}',	'{\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}',	NULL),
(110,	0,	10,	'simpleboot3',	'搜索页面',	'portal/search/index',	'portal/search',	'搜索模板文件',	'{\"vars\":{\"varName1\":{\"title\":\"\\u70ed\\u95e8\\u641c\\u7d22\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\\u8fd9\\u662f\\u4e00\\u4e2atext\",\"rule\":{\"require\":true}}}}',	'{\"vars\":{\"varName1\":{\"title\":\"\\u70ed\\u95e8\\u641c\\u7d22\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\\u8fd9\\u662f\\u4e00\\u4e2atext\",\"rule\":{\"require\":true}}}}',	NULL),
(111,	1,	0,	'97013266',	'模板全局配置',	'public/Config',	'public/config',	'模板全局配置文件',	'{\"vars\":{\"enable_mobile\":{\"title\":\"\\u624b\\u673a\\u6ce8\\u518c\",\"value\":1,\"type\":\"select\",\"options\":{\"1\":\"\\u5f00\\u542f\",\"0\":\"\\u5173\\u95ed\"},\"tip\":\"\"}}}',	'{\"vars\":{\"enable_mobile\":{\"title\":\"\\u624b\\u673a\\u6ce8\\u518c\",\"value\":1,\"type\":\"select\",\"options\":{\"1\":\"\\u5f00\\u542f\",\"0\":\"\\u5173\\u95ed\"},\"tip\":\"\"}}}',	NULL),
(112,	1,	1,	'simpleboot3',	'导航条',	'public/Nav',	'public/nav',	'导航条模板文件',	'{\"vars\":{\"company_name\":{\"title\":\"\\u516c\\u53f8\\u540d\\u79f0\",\"name\":\"company_name\",\"value\":\"ThinkCMF\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}',	'{\"vars\":{\"company_name\":{\"title\":\"\\u516c\\u53f8\\u540d\\u79f0\",\"name\":\"company_name\",\"value\":\"ThinkCMF\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}',	NULL),
(113,	0,	10,	'97013266',	'文章页',	'portal/Article/index',	'portal/article',	'文章页模板文件',	'{\"vars\":{\"hot_articles_category_id\":{\"title\":\"Hot Articles\\u5206\\u7c7bID\",\"name\":\"hot_articles_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}',	'{\"vars\":{\"hot_articles_category_id\":{\"title\":\"Hot Articles\\u5206\\u7c7bID\",\"name\":\"hot_articles_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}',	NULL),
(114,	0,	10,	'97013266',	'联系我们页',	'portal/Page/index',	'portal/contact',	'联系我们页模板文件',	'{\"vars\":{\"baidu_map_info_window_text\":{\"title\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57\",\"name\":\"baidu_map_info_window_text\",\"value\":\"ThinkCMF<br\\/><span class=\'\'>\\u5730\\u5740\\uff1a\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def2601\\u53f7<\\/span>\",\"type\":\"text\",\"tip\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57,\\u652f\\u6301\\u7b80\\u5355html\\u4ee3\\u7801\",\"rule\":[]},\"company_location\":{\"title\":\"\\u516c\\u53f8\\u5750\\u6807\",\"value\":\"\",\"type\":\"location\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_cn\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\",\"value\":\"\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def0001\\u53f7\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_en\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"NO.0001 Xie Tu Road, Shanghai China\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"email\":{\"title\":\"\\u516c\\u53f8\\u90ae\\u7bb1\",\"value\":\"catman@thinkcmf.com\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_cn\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\",\"value\":\"021 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_en\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"+8621 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"qq\":{\"title\":\"\\u8054\\u7cfbQQ\",\"value\":\"478519726\",\"type\":\"text\",\"tip\":\"\\u591a\\u4e2a QQ\\u4ee5\\u82f1\\u6587\\u9017\\u53f7\\u9694\\u5f00\",\"rule\":{\"require\":true}}}}',	'{\"vars\":{\"baidu_map_info_window_text\":{\"title\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57\",\"name\":\"baidu_map_info_window_text\",\"value\":\"ThinkCMF<br\\/><span class=\'\'>\\u5730\\u5740\\uff1a\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def2601\\u53f7<\\/span>\",\"type\":\"text\",\"tip\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57,\\u652f\\u6301\\u7b80\\u5355html\\u4ee3\\u7801\",\"rule\":[]},\"company_location\":{\"title\":\"\\u516c\\u53f8\\u5750\\u6807\",\"value\":\"\",\"type\":\"location\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_cn\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\",\"value\":\"\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def0001\\u53f7\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_en\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"NO.0001 Xie Tu Road, Shanghai China\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"email\":{\"title\":\"\\u516c\\u53f8\\u90ae\\u7bb1\",\"value\":\"catman@thinkcmf.com\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_cn\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\",\"value\":\"021 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_en\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"+8621 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"qq\":{\"title\":\"\\u8054\\u7cfbQQ\",\"value\":\"478519726\",\"type\":\"text\",\"tip\":\"\\u591a\\u4e2a QQ\\u4ee5\\u82f1\\u6587\\u9017\\u53f7\\u9694\\u5f00\",\"rule\":{\"require\":true}}}}',	NULL),
(115,	0,	5,	'97013266',	'首页',	'portal/Index/index',	'portal/index',	'首页模板文件',	'{\"vars\":{\"top_slide\":{\"title\":\"\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"admin\\/Slide\\/index\",\"multi\":false},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"tip\":\"\",\"rule\":{\"require\":true}}}}',	'{\"vars\":{\"top_slide\":{\"title\":\"\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"admin\\/Slide\\/index\",\"multi\":false},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"tip\":\"\",\"rule\":{\"require\":true}}}}',	NULL),
(116,	0,	10,	'97013266',	'文章列表页',	'portal/List/index',	'portal/list',	'文章列表模板文件',	'{\"vars\":[],\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}',	'{\"vars\":[],\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}',	NULL),
(117,	0,	10,	'97013266',	'单页面',	'portal/Page/index',	'portal/page',	'单页面模板文件',	'{\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}',	'{\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}',	NULL),
(118,	0,	10,	'97013266',	'搜索页面',	'portal/search/index',	'portal/search',	'搜索模板文件',	'{\"vars\":{\"varName1\":{\"title\":\"\\u70ed\\u95e8\\u641c\\u7d22\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\\u8fd9\\u662f\\u4e00\\u4e2atext\",\"rule\":{\"require\":true}}}}',	'{\"vars\":{\"varName1\":{\"title\":\"\\u70ed\\u95e8\\u641c\\u7d22\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\\u8fd9\\u662f\\u4e00\\u4e2atext\",\"rule\":{\"require\":true}}}}',	NULL),
(119,	1,	1,	'97013266',	'导航条',	'public/Nav',	'public/nav',	'导航条模板文件',	'{\"vars\":{\"company_name\":{\"title\":\"\\u516c\\u53f8\\u540d\\u79f0\",\"name\":\"company_name\",\"value\":\"ThinkCMF\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}',	'{\"vars\":{\"company_name\":{\"title\":\"\\u516c\\u53f8\\u540d\\u79f0\",\"name\":\"company_name\",\"value\":\"ThinkCMF\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}',	NULL);

CREATE TABLE `cmf_third_party_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '本站用户id',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `expire_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'access_token过期时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '绑定时间',
  `login_times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:正常;0:禁用',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `third_party` varchar(20) NOT NULL DEFAULT '' COMMENT '第三方惟一码',
  `app_id` varchar(64) NOT NULL DEFAULT '' COMMENT '第三方应用 id',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `access_token` varchar(512) NOT NULL DEFAULT '' COMMENT '第三方授权码',
  `openid` varchar(40) NOT NULL DEFAULT '' COMMENT '第三方用户id',
  `union_id` varchar(64) NOT NULL DEFAULT '' COMMENT '第三方用户多个产品中的惟一 id,(如:微信平台)',
  `more` text COMMENT '扩展信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='第三方用户表';


CREATE TABLE `cmf_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '用户类型;1:admin;2:会员',
  `sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '性别;0:保密,1:男,2:女',
  `birthday` int(11) NOT NULL DEFAULT '0' COMMENT '生日',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `coin` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '金币',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `user_status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态;0:禁用,1:正常,2:未验证',
  `user_login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码;cmf_password加密',
  `user_nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `user_email` varchar(100) NOT NULL DEFAULT '' COMMENT '用户登录邮箱',
  `user_url` varchar(100) NOT NULL DEFAULT '' COMMENT '用户个人网址',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  `signature` varchar(255) NOT NULL DEFAULT '' COMMENT '个性签名',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '' COMMENT '激活码',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '用户手机号',
  `more` text COMMENT '扩展属性',
  `accessKey` varchar(255) DEFAULT NULL COMMENT '七牛 ak密钥',
  `secretKey` varchar(255) DEFAULT NULL COMMENT '七牛sk密钥',
  `bucket` varchar(255) DEFAULT NULL COMMENT '七牛储存名称',
  `valid_time` int(100) DEFAULT '1' COMMENT '有效时间',
  `domain` varchar(255) DEFAULT NULL COMMENT '七牛储存外链默认域名',
  `downloads` varchar(255) DEFAULT '0' COMMENT '总下载数',
  `sup_down_prive` varchar(32) NOT NULL DEFAULT '0' COMMENT '超级签名私有',
  `sup_down_public` varchar(32) NOT NULL DEFAULT '0' COMMENT '超级签名公有',
  PRIMARY KEY (`id`),
  KEY `user_login` (`user_login`),
  KEY `user_nickname` (`user_nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

INSERT INTO `cmf_user` (`id`, `user_type`, `sex`, `birthday`, `last_login_time`, `score`, `coin`, `create_time`, `user_status`, `user_login`, `user_pass`, `user_nickname`, `user_email`, `user_url`, `avatar`, `signature`, `last_login_ip`, `user_activation_key`, `mobile`, `more`, `accessKey`, `secretKey`, `bucket`, `valid_time`, `domain`, `downloads`, `sup_down_prive`, `sup_down_public`) VALUES
(1,	1,	0,	-28800,	1587720331,	0,	0,	1513673890,	1,	'admin',	'###5c79e0908ee01e87a42c0a6398b99ee1',	'admin',	'123456@qq.com',	'https://app.fvlrung.com',	'http://api2.meidulm.com/default/20191012/053ad1cd982ad2d33cf4df6ba7ef1a29.jpg',	'奇偶猫 www.xydai.cn\r\n',	'168.63.148.41',	'',	'',	NULL,	'H-ZQeU6VnHvhNNrrsBcc7L3_fkZJjZTiRE8njXzg',	'84f28-hG5IzFiE3Hge1Bk7EjUIUZI8xE-4Macpe4',	'clientapp',	1,	'p6fwhxlcm.bkt.clouddn.com',	'88888',	'0',	'0');

CREATE TABLE `cmf_user_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '更改积分，可以为负',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '更改金币，可以为负',
  `reward_number` int(11) NOT NULL DEFAULT '0' COMMENT '奖励次数',
  `cycle_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '周期类型;0:不限;1:按天;2:按小时;3:永久',
  `cycle_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '周期时间值',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户操作名称',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '用户操作名称',
  `app` varchar(50) NOT NULL DEFAULT '' COMMENT '操作所在应用名或插件名等',
  `url` text COMMENT '执行操作的url',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户操作表';


CREATE TABLE `cmf_user_action_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '访问次数',
  `last_visit_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后访问时间',
  `object` varchar(100) NOT NULL DEFAULT '' COMMENT '访问对象的id,格式:不带前缀的表名+id;如posts1表示xx_posts表里id为1的记录',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '操作名称;格式:应用名+控制器+操作名,也可自己定义格式只要不发生冲突且惟一;',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT '用户ip',
  PRIMARY KEY (`id`),
  KEY `user_object_action` (`user_id`,`object`,`action`),
  KEY `user_object_action_ip` (`user_id`,`object`,`action`,`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='访问记录表';


CREATE TABLE `cmf_user_auth_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `user_real_name` varchar(50) NOT NULL COMMENT '用户真实姓名',
  `card_number` varchar(50) NOT NULL COMMENT '身份证号码',
  `card_img1` varchar(255) NOT NULL COMMENT '身份证正面',
  `card_img2` varchar(255) NOT NULL COMMENT '身份证反面',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态0审核中,1审核通过,2拒绝',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `cmf_user_favorite` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户 id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '收藏内容的标题',
  `url` varchar(255) CHARACTER SET utf8 DEFAULT '' COMMENT '收藏内容的原文地址，不带域名',
  `description` varchar(500) CHARACTER SET utf8 DEFAULT '' COMMENT '收藏内容的描述',
  `table_name` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '收藏实体以前所在表,不带前缀',
  `object_id` int(10) unsigned DEFAULT '0' COMMENT '收藏内容原来的主键id',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '收藏时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户收藏表';

INSERT INTO `cmf_user_favorite` (`id`, `user_id`, `title`, `url`, `description`, `table_name`, `object_id`, `create_time`) VALUES
(1,	48,	'超级签名充值协议',	'{\"action\":\"portal\\/Article\\/index\",\"param\":{\"id\":1}}',	'超级签名充值协议',	'portal_post',	1,	1567479065);

CREATE TABLE `cmf_user_link_log` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `uid` int(32) NOT NULL,
  `appid` int(32) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '1失效',
  `addtime` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户生成链接记录';

INSERT INTO `cmf_user_link_log` (`id`, `uid`, `appid`, `code`, `status`, `addtime`) VALUES
(1,	8889,	1,	'e7ad374874b760d58234298c27b9357a',	0,	1571552263),
(2,	8889,	23,	'9680c123c7fad3ad161fac06a1c6a783',	0,	1572141657);

CREATE TABLE `cmf_user_login_attempt` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login_attempts` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '尝试次数',
  `attempt_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '尝试登录时间',
  `locked_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '锁定时间',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT '用户 ip',
  `account` varchar(100) NOT NULL DEFAULT '' COMMENT '用户账号,手机号,邮箱或用户名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='用户登录尝试表';


CREATE TABLE `cmf_user_posted` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL COMMENT '七牛上传文件的地址',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `name` varchar(255) DEFAULT NULL COMMENT '文件名称',
  `uid` int(100) DEFAULT NULL COMMENT '用户id',
  `way` int(2) DEFAULT '0' COMMENT '0公开 1密码安装 2邀请安装',
  `instructions` varchar(255) DEFAULT NULL COMMENT '版本更新说明',
  `introduce` varchar(255) DEFAULT NULL COMMENT '应用介绍',
  `version` varchar(255) DEFAULT NULL COMMENT '版本号',
  `big` varchar(255) DEFAULT NULL COMMENT '文件大小  单位MB',
  `build` varchar(255) DEFAULT NULL COMMENT '编译版本号',
  `bundle` varchar(255) DEFAULT NULL COMMENT '文件包名',
  `endtime` int(11) DEFAULT NULL COMMENT '结束时间',
  `type` varchar(100) DEFAULT NULL COMMENT '0 android 1 ios 类型',
  `img` longtext COMMENT '???????base64',
  `er_img` varchar(255) DEFAULT NULL COMMENT '二维码图片路径',
  `er_logo` varchar(255) DEFAULT '' COMMENT '二维码标识',
  `posted_id` int(100) DEFAULT NULL COMMENT '合并id ',
  `url_name` varchar(100) DEFAULT '0' COMMENT '文件原文件名',
  `status` int(2) DEFAULT '1' COMMENT '状态：1正常，2审核中，3已删除，4官方删除',
  `super_sign_count` int(11) NOT NULL COMMENT '个人证书剩余设备数',
  `public_super_sign_count` int(11) NOT NULL COMMENT '证书池剩余设备数',
  `is_open_super_sign` tinyint(1) NOT NULL DEFAULT '0',
  `download_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1超级签名公有，2私有',
  `only_download` int(1) NOT NULL DEFAULT '0' COMMENT '是否开启唯一下载1',
  `test_type` int(1) NOT NULL DEFAULT '0' COMMENT '1内测，2企业',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


CREATE TABLE `cmf_user_posted_log` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL COMMENT '用户id',
  `posted_id` int(100) DEFAULT NULL COMMENT '文件包id',
  `creattime` int(11) DEFAULT NULL COMMENT '下载时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


CREATE TABLE `cmf_user_score_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户 id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '用户操作名称',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '更改积分，可以为负',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '更改金币，可以为负',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户操作积分等奖励日志表';


CREATE TABLE `cmf_user_token` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户id',
  `expire_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT ' 过期时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `token` varchar(64) NOT NULL DEFAULT '' COMMENT 'token',
  `device_type` varchar(10) NOT NULL DEFAULT '' COMMENT '设备类型;mobile,android,iphone,ipad,web,pc,mac,wxapp',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户客户端登录 token 表';

INSERT INTO `cmf_user_token` (`id`, `user_id`, `expire_time`, `create_time`, `token`, `device_type`) VALUES
(3,	1,	1603272331,	1587720331,	'c7efd15e6486184b478913541e6f28118299d4a9c421c2564c62d45d5d0c8d6e',	'web'),
(4,	8,	1531376937,	1515824937,	'3661aca8bd2b6c9785b55b9f7df036f034f2ea74e0965c1b290859e5e35354ea',	'web');

CREATE TABLE `cmf_valid_time` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `mun` int(100) DEFAULT '1' COMMENT '有效时间 天',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `cmf_valid_time` (`id`, `mun`, `addtime`) VALUES
(1,	30,	NULL);

CREATE TABLE `cmf_verification_code` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '当天已经发送成功的次数',
  `send_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后发送成功时间',
  `expire_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '验证码过期时间',
  `code` varchar(8) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '最后发送成功的验证码',
  `account` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '手机号或者邮箱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='手机邮箱数字验证码表';

INSERT INTO `cmf_verification_code` (`id`, `count`, `send_time`, `expire_time`, `code`, `account`) VALUES
(1,	1,	1571551119,	1571552919,	'872515',	'17685942287'),
(2,	1,	1571560346,	1571562146,	'808909',	'18607308027'),
(3,	1,	1572016740,	1572018540,	'990287',	'17615571665'),
(4,	1,	1572096723,	1572098523,	'740264',	'13225036743');

-- 2020-04-24 10:13:05
