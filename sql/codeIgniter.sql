-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `codeIgniter`
--

-- --------------------------------------------------------

--
-- 表的结构 `xg_admin_users`
--

DROP TABLE IF EXISTS `xg_admin_users`;
CREATE TABLE IF NOT EXISTS `xg_admin_users` (
  `admin_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_ip` varchar(64) DEFAULT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  `del_flg` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `xg_admin_users`
--

INSERT INTO `xg_admin_users` (`admin_id`, `user_name`, `password`, `email`, `login_time`, `login_ip`, `created_time`, `updated_time`, `del_flg`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'demo@xgeek.net', '2013-09-16 07:15:29', '127.0.0.1', '2013-09-13 10:33:55', '2013-09-13 10:33:58', 0);