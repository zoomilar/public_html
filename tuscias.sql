-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Darbinė stotis: localhost
-- Atlikimo laikas:  2015 m. Sausio 23 d.  11:51
-- Serverio versija: 5.1.52
-- PHP versija: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Duombazė: `tuscias`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_additional_htmlblob_users`
--

CREATE TABLE IF NOT EXISTS `cms_additional_htmlblob_users` (
  `additional_htmlblob_users_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `htmlblob_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`additional_htmlblob_users_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_additional_htmlblob_users`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_additional_htmlblob_users_seq`
--

CREATE TABLE IF NOT EXISTS `cms_additional_htmlblob_users_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_additional_htmlblob_users_seq`
--

INSERT INTO `cms_additional_htmlblob_users_seq` (`id`) VALUES
(0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_additional_users`
--

CREATE TABLE IF NOT EXISTS `cms_additional_users` (
  `additional_users_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`additional_users_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_additional_users`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_additional_users_seq`
--

CREATE TABLE IF NOT EXISTS `cms_additional_users_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_additional_users_seq`
--

INSERT INTO `cms_additional_users_seq` (`id`) VALUES
(0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_adminlog`
--

CREATE TABLE IF NOT EXISTS `cms_adminlog` (
  `timestamp` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `ip_addr` varchar(40) DEFAULT NULL,
  KEY `cms_index_adminlog1` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_adminlog`
--

INSERT INTO `cms_adminlog` (`timestamp`, `user_id`, `username`, `item_id`, `item_name`, `action`, `ip_addr`) VALUES
(1417253941, 1, 'admin', -1, 'Admin Log', 'Cleared', '78.158.8.27'),
(1417257362, 1, 'admin', -1, 'Global Settings', 'Edited', '78.158.8.27'),
(1417361907, 0, '', -1, 'Automated Task Succeeded', 'GatherNotificationsTask', ''),
(1417361907, 0, '', -1, 'Automated Task Succeeded', 'PruneAdminlogTask', ''),
(1417361907, 0, '', -1, 'Cache Cleaned', 'Cache directory cleaned. 7 files removed', ''),
(1417361907, 0, '', -1, 'Automated Task Succeeded', 'CGSmartImage_ClearCacheTask', ''),
(1417693137, 0, '', -1, 'Automated Task Succeeded', 'PruneAdminlogTask', ''),
(1417693137, 0, '', -1, 'Cache Cleaned', 'Cache directory cleaned. 60 files removed', ''),
(1417693137, 0, '', -1, 'Automated Task Succeeded', 'CGSmartImage_ClearCacheTask', ''),
(1417698810, 1, 'admin', 1, 'Admin Username: admin', 'Logged In', '84.240.5.186'),
(1418125754, 0, '', -1, 'Automated Task Succeeded', 'GatherNotificationsTask', ''),
(1418125754, 0, '', -1, 'Automated Task Succeeded', 'PruneAdminlogTask', ''),
(1418125754, 0, '', -1, 'Cache Cleaned', 'Cache directory cleaned. 61 files removed', ''),
(1418125754, 0, '', -1, 'Automated Task Succeeded', 'CGSmartImage_ClearCacheTask', ''),
(1418209007, 0, '', -1, 'Automated Task Succeeded', 'GatherNotificationsTask', ''),
(1418209011, 1, 'admin', 1, 'Admin Username: admin', 'Logged In', '78.158.8.27'),
(1418209037, 1, 'admin', -1, 'Core', 'Activated module News', '78.158.8.27'),
(1418209073, 1, 'admin', 9, 'News category: 9', ' Category deleted', '78.158.8.27'),
(1418209078, 1, 'admin', 10, 'News category: 10', ' Category deleted', '78.158.8.27'),
(1418209083, 1, 'admin', 11, 'News category: 11', ' Category deleted', '78.158.8.27'),
(1418209088, 1, 'admin', 12, 'News category: 12', ' Category deleted', '78.158.8.27'),
(1418209093, 1, 'admin', 14, 'News category: 14', ' Category deleted', '78.158.8.27'),
(1418209098, 1, 'admin', 15, 'News category: 15', ' Category deleted', '78.158.8.27'),
(1418209103, 1, 'admin', 16, 'News category: 16', ' Category deleted', '78.158.8.27'),
(1418209108, 1, 'admin', 17, 'News category: 17', ' Category deleted', '78.158.8.27'),
(1418209148, 1, 'admin', 82, 'News: 82', 'Article added', '78.158.8.27'),
(1418209174, 1, 'admin', 83, 'News: 83', 'Article added', '78.158.8.27'),
(1418209182, 1, 'admin', 0, 'News custom: admin_deletefielddef', 'Field definition deleted', '78.158.8.27'),
(1418209205, 1, 'admin', 84, 'News: 84', 'Article added', '78.158.8.27'),
(1418209236, 1, 'admin', 85, 'News: 85', 'Article added', '78.158.8.27'),
(1418209258, 1, 'admin', 86, 'News: 86', 'Article added', '78.158.8.27'),
(1418209330, 1, 'admin', -1, 'Core', 'Deactivated module News', '78.158.8.27'),
(1418209338, 1, 'admin', -1, 'Core', 'Activated module Gallery', '78.158.8.27'),
(1418209386, 1, 'admin', -1, 'Core', 'Deactivated module Gallery', '78.158.8.27'),
(1418209394, 1, 'admin', -1, 'Core', 'Activated module Products', '78.158.8.27'),
(1418209712, 1, 'admin', -1, 'Core', 'Deactivated module Products', '78.158.8.27'),
(1418209737, 1, 'admin', -1, 'Cataloger', 'Modulio versija 0.11.3 įdiegta.', '78.158.8.27'),
(1418209737, 1, 'admin', -1, 'Cataloger', 'Installed version 0.11.3', '78.158.8.27'),
(1418209805, 1, 'admin', -1, 'Core', 'Deactivated module Cataloger', '78.158.8.27'),
(1418212696, 1, 'admin', -1, 'Automated Task Succeeded', 'GatherNotificationsTask', '78.158.8.27'),
(1418212696, 1, 'admin', -1, 'Automated Task Succeeded', 'PruneAdminlogTask', '78.158.8.27'),
(1418212696, 1, 'admin', -1, 'Cache Cleaned', 'Cache directory cleaned. 0 files removed', '78.158.8.27'),
(1418212696, 1, 'admin', -1, 'Automated Task Succeeded', 'CGSmartImage_ClearCacheTask', '78.158.8.27'),
(1418212715, 1, 'admin', 3, 'Content Item: Pagrindinius meniu', 'Edited', '78.158.8.27');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_admin_bookmarks`
--

CREATE TABLE IF NOT EXISTS `cms_admin_bookmarks` (
  `bookmark_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bookmark_id`),
  KEY `cms_index_admin_bookmarks_by_user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_admin_bookmarks`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_admin_bookmarks_seq`
--

CREATE TABLE IF NOT EXISTS `cms_admin_bookmarks_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_admin_bookmarks_seq`
--

INSERT INTO `cms_admin_bookmarks_seq` (`id`) VALUES
(0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_admin_recent_pages`
--

CREATE TABLE IF NOT EXISTS `cms_admin_recent_pages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `access_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_admin_recent_pages`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_admin_recent_pages_seq`
--

CREATE TABLE IF NOT EXISTS `cms_admin_recent_pages_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_admin_recent_pages_seq`
--

INSERT INTO `cms_admin_recent_pages_seq` (`id`) VALUES
(0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_content`
--

CREATE TABLE IF NOT EXISTS `cms_content` (
  `content_id` int(11) NOT NULL,
  `content_name` varchar(255) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL,
  `hierarchy` varchar(255) DEFAULT NULL,
  `default_content` tinyint(4) DEFAULT NULL,
  `menu_text` varchar(255) DEFAULT NULL,
  `content_alias` varchar(255) DEFAULT NULL,
  `show_in_menu` tinyint(4) DEFAULT NULL,
  `collapsed` tinyint(4) DEFAULT NULL,
  `markup` varchar(25) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `cachable` tinyint(4) DEFAULT NULL,
  `id_hierarchy` varchar(255) DEFAULT NULL,
  `hierarchy_path` text,
  `prop_names` text,
  `metadata` text,
  `titleattribute` varchar(255) DEFAULT NULL,
  `tabindex` varchar(10) DEFAULT NULL,
  `accesskey` varchar(5) DEFAULT NULL,
  `last_modified_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `secure` tinyint(4) DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `cms_index_content_by_content_alias_active` (`content_alias`,`active`),
  KEY `cms_index_content_by_default_content` (`default_content`),
  KEY `cms_index_content_by_parent_id` (`parent_id`),
  KEY `cms_index_content_by_hierarchy` (`hierarchy`),
  KEY `cms_index_content_by_idhier` (`content_id`,`hierarchy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_content`
--

INSERT INTO `cms_content` (`content_id`, `content_name`, `type`, `owner_id`, `parent_id`, `template_id`, `item_order`, `hierarchy`, `default_content`, `menu_text`, `content_alias`, `show_in_menu`, `collapsed`, `markup`, `active`, `cachable`, `id_hierarchy`, `hierarchy_path`, `prop_names`, `metadata`, `titleattribute`, `tabindex`, `accesskey`, `last_modified_by`, `create_date`, `modified_date`, `secure`, `page_url`) VALUES
(1, 'Titulinis', 'content', 1, -1, 26, 1, '00001', 1, 'Titulinis', 'lt', 1, NULL, 'html', 1, 1, '1', 'lt', 'content_en,searchable,extra1,extra2,extra3,pagedata,disable_wysiwyg,image,thumbnail,target', '', '', '', '', 1, '2014-11-03 11:55:59', '2014-11-03 11:55:59', 0, ''),
(2, 'Viršutinis meniu', 'sectionheader', 1, 1, -1, 1, '00001.00001', 0, 'Viršutinis meniu', 'virstu', 1, NULL, 'html', 1, 1, '1.2', 'lt/virstu', 'content_en,searchable,extra1,extra2,extra3', '{* Add code here that should appear in the metadata section of all new pages *}', '', '', '', 1, '2014-11-29 11:26:17', '2014-11-29 11:26:17', 0, ''),
(3, 'Pagrindinius meniu', 'sectionheader', 1, 1, -1, 2, '00001.00002', 0, 'Pagrindinis meniu', 'pagrindinis-meniu', 1, NULL, 'html', 1, 1, '1.3', 'lt/pagrindinis-meniu', 'content_en,searchable,extra1,extra2,extra3', '{* Add code here that should appear in the metadata section of all new pages *}', '', '', '', 1, '2014-11-29 11:26:42', '2014-12-10 13:58:35', 0, ''),
(4, 'Home', 'content', 1, -1, 26, 2, '00002', 0, 'Home', 'en', 1, NULL, 'html', 1, 1, '4', 'en', 'content_en,searchable,extra1,extra2,extra3,pagedata,disable_wysiwyg,filepicker_block,gallery,target', '{* Add code here that should appear in the metadata section of all new pages *}', '', '', '', 1, '2014-11-29 11:27:11', '2014-11-29 11:28:10', 0, ''),
(5, 'Top meniu', 'sectionheader', 1, 4, -1, 1, '00002.00001', 0, 'Top meniu', 'top-meniu', 1, NULL, 'html', 1, 1, '4.5', 'en/top-meniu', 'content_en,searchable,extra1,extra2,extra3', '{* Add code here that should appear in the metadata section of all new pages *}', '', '', '', 1, '2014-11-29 11:27:35', '2014-11-29 11:27:35', 0, ''),
(6, 'Main meniu', 'sectionheader', 1, 4, -1, 2, '00002.00002', 0, 'Main meniu', 'mai', 1, NULL, 'html', 1, 1, '4.6', 'en/mai', 'content_en,searchable,extra1,extra2,extra3', '{* Add code here that should appear in the metadata section of all new pages *}', '', '', '', 1, '2014-11-29 11:27:49', '2014-11-29 11:27:49', 0, '');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_content_props`
--

CREATE TABLE IF NOT EXISTS `cms_content_props` (
  `content_id` int(11) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `prop_name` varchar(255) DEFAULT NULL,
  `param1` varchar(255) DEFAULT NULL,
  `param2` varchar(255) DEFAULT NULL,
  `param3` varchar(255) DEFAULT NULL,
  `content` text,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  KEY `cms_index_content_props_by_content_id` (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_content_props`
--

INSERT INTO `cms_content_props` (`content_id`, `type`, `prop_name`, `param1`, `param2`, `param3`, `content`, `create_date`, `modified_date`) VALUES
(1, 'string', 'content_en', NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'string', 'searchable', NULL, NULL, NULL, '1', NULL, NULL),
(1, 'string', 'extra1', NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'string', 'extra2', NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'string', 'extra3', NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'string', 'pagedata', NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'string', 'disable_wysiwyg', NULL, NULL, NULL, '0', NULL, NULL),
(1, 'string', 'image', NULL, NULL, NULL, '-1', NULL, NULL),
(1, 'string', 'thumbnail', NULL, NULL, NULL, '-1', NULL, NULL),
(1, 'string', 'target', NULL, NULL, NULL, '', NULL, NULL),
(2, 'string', 'content_en', NULL, NULL, NULL, '<!-- Add code here that should appear in the content block of all new pages -->', NULL, '2014-11-29 11:26:17'),
(2, 'string', 'searchable', NULL, NULL, NULL, '1', NULL, '2014-11-29 11:26:17'),
(2, 'string', 'extra1', NULL, NULL, NULL, '', NULL, '2014-11-29 11:26:17'),
(2, 'string', 'extra2', NULL, NULL, NULL, '', NULL, '2014-11-29 11:26:17'),
(2, 'string', 'extra3', NULL, NULL, NULL, '', NULL, '2014-11-29 11:26:17'),
(3, 'string', 'content_en', NULL, NULL, NULL, '<!-- Add code here that should appear in the content block of all new pages -->', NULL, '2014-11-29 11:26:42'),
(3, 'string', 'searchable', NULL, NULL, NULL, '1', NULL, '2014-11-29 11:26:42'),
(3, 'string', 'extra1', NULL, NULL, NULL, '', NULL, '2014-12-10 13:58:35'),
(3, 'string', 'extra2', NULL, NULL, NULL, '', NULL, '2014-12-10 13:58:35'),
(3, 'string', 'extra3', NULL, NULL, NULL, '', NULL, '2014-12-10 13:58:35'),
(4, 'string', 'content_en', NULL, NULL, NULL, '<!-- Add code here that should appear in the content block of all new pages -->', NULL, '2014-11-29 11:28:10'),
(4, 'string', 'searchable', NULL, NULL, NULL, '1', NULL, '2014-11-29 11:28:10'),
(4, 'string', 'extra1', NULL, NULL, NULL, '', NULL, '2014-11-29 11:28:10'),
(4, 'string', 'extra2', NULL, NULL, NULL, '', NULL, '2014-11-29 11:28:10'),
(4, 'string', 'extra3', NULL, NULL, NULL, '', NULL, '2014-11-29 11:28:10'),
(4, 'string', 'pagedata', NULL, NULL, NULL, '', NULL, '2014-11-29 11:28:10'),
(4, 'string', 'disable_wysiwyg', NULL, NULL, NULL, '0', NULL, '2014-11-29 11:28:10'),
(4, 'string', 'filepicker_block', NULL, NULL, NULL, '', NULL, '2014-11-29 11:28:10'),
(4, 'string', 'gallery', NULL, NULL, NULL, '', NULL, '2014-11-29 11:28:10'),
(4, 'string', 'target', NULL, NULL, NULL, '', NULL, '2014-11-29 11:28:10'),
(5, 'string', 'content_en', NULL, NULL, NULL, '<!-- Add code here that should appear in the content block of all new pages -->', NULL, '2014-11-29 11:27:35'),
(5, 'string', 'searchable', NULL, NULL, NULL, '1', NULL, '2014-11-29 11:27:35'),
(5, 'string', 'extra1', NULL, NULL, NULL, '', NULL, '2014-11-29 11:27:35'),
(5, 'string', 'extra2', NULL, NULL, NULL, '', NULL, '2014-11-29 11:27:35'),
(5, 'string', 'extra3', NULL, NULL, NULL, '', NULL, '2014-11-29 11:27:35'),
(6, 'string', 'content_en', NULL, NULL, NULL, '<!-- Add code here that should appear in the content block of all new pages -->', NULL, '2014-11-29 11:27:49'),
(6, 'string', 'searchable', NULL, NULL, NULL, '1', NULL, '2014-11-29 11:27:49'),
(6, 'string', 'extra1', NULL, NULL, NULL, '', NULL, '2014-11-29 11:27:49'),
(6, 'string', 'extra2', NULL, NULL, NULL, '', NULL, '2014-11-29 11:27:49'),
(6, 'string', 'extra3', NULL, NULL, NULL, '', NULL, '2014-11-29 11:27:49');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_content_props_seq`
--

CREATE TABLE IF NOT EXISTS `cms_content_props_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_content_props_seq`
--

INSERT INTO `cms_content_props_seq` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_content_seq`
--

CREATE TABLE IF NOT EXISTS `cms_content_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_content_seq`
--

INSERT INTO `cms_content_seq` (`id`) VALUES
(6);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_crossref`
--

CREATE TABLE IF NOT EXISTS `cms_crossref` (
  `child_type` varchar(100) DEFAULT NULL,
  `child_id` int(11) DEFAULT NULL,
  `parent_type` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  KEY `cms_index_crossref_by_child_type_child_id` (`child_type`,`child_id`),
  KEY `cms_index_crossref_by_parent_type_parent_id` (`parent_type`,`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_crossref`
--

INSERT INTO `cms_crossref` (`child_type`, `child_id`, `parent_type`, `parent_id`, `create_date`, `modified_date`) VALUES
('global_content', 1, 'template', 15, '2009-05-10 16:57:24', '2009-05-10 16:57:24'),
('global_content', 1, 'template', 16, '2009-05-09 17:04:30', '2009-05-09 17:04:30'),
('global_content', 1, 'template', 20, '2009-05-09 23:57:31', '2009-05-09 23:57:31'),
('global_content', 1, 'template', 18, '2009-05-09 17:19:20', '2009-05-09 17:19:20'),
('global_content', 1, 'template', 17, '2009-05-09 21:20:18', '2009-05-09 21:20:18'),
('global_content', 1, 'template', 21, '2009-05-10 16:59:13', '2009-05-10 16:59:13'),
('global_content', 1, 'template', 22, '2009-05-11 02:01:23', '2009-05-11 02:01:23');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_css`
--

CREATE TABLE IF NOT EXISTS `cms_css` (
  `css_id` int(11) NOT NULL,
  `css_name` varchar(255) DEFAULT NULL,
  `css_text` text,
  `media_type` varchar(255) DEFAULT NULL,
  `media_query` text,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`css_id`),
  KEY `cms_index_css_by_css_name` (`css_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_css`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_css_assoc`
--

CREATE TABLE IF NOT EXISTS `cms_css_assoc` (
  `assoc_to_id` int(11) DEFAULT NULL,
  `assoc_css_id` int(11) DEFAULT NULL,
  `assoc_type` varchar(80) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `assoc_order` int(11) DEFAULT NULL,
  KEY `cms_index_css_assoc_by_assoc_to_id` (`assoc_to_id`),
  KEY `cms_index_css_assoc_by_assoc_css_id` (`assoc_css_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_css_assoc`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_css_seq`
--

CREATE TABLE IF NOT EXISTS `cms_css_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_css_seq`
--

INSERT INTO `cms_css_seq` (`id`) VALUES
(53);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_events`
--

CREATE TABLE IF NOT EXISTS `cms_events` (
  `originator` varchar(200) NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `cms_originator` (`originator`),
  KEY `cms_event_name` (`event_name`),
  KEY `cms_event_id` (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_events`
--

INSERT INTO `cms_events` (`originator`, `event_name`, `event_id`) VALUES
('Core', 'LoginPost', 1),
('Core', 'LogoutPost', 2),
('Core', 'AddUserPre', 3),
('Core', 'AddUserPost', 4),
('Core', 'EditUserPre', 5),
('Core', 'EditUserPost', 6),
('Core', 'DeleteUserPre', 7),
('Core', 'DeleteUserPost', 8),
('Core', 'AddGroupPre', 9),
('Core', 'AddGroupPost', 10),
('Core', 'EditGroupPre', 11),
('Core', 'EditGroupPost', 12),
('Core', 'DeleteGroupPre', 13),
('Core', 'DeleteGroupPost', 14),
('Core', 'AddStylesheetPre', 15),
('Core', 'AddStylesheetPost', 16),
('Core', 'EditStylesheetPre', 17),
('Core', 'EditStylesheetPost', 18),
('Core', 'DeleteStylesheetPre', 19),
('Core', 'DeleteStylesheetPost', 20),
('Core', 'AddTemplatePre', 21),
('Core', 'AddTemplatePost', 22),
('Core', 'EditTemplatePre', 23),
('Core', 'EditTemplatePost', 24),
('Core', 'DeleteTemplatePre', 25),
('Core', 'DeleteTemplatePost', 26),
('Core', 'TemplatePreCompile', 27),
('Core', 'TemplatePostCompile', 28),
('Core', 'AddGlobalContentPre', 29),
('Core', 'AddGlobalContentPost', 30),
('Core', 'EditGlobalContentPre', 31),
('Core', 'EditGlobalContentPost', 32),
('Core', 'DeleteGlobalContentPre', 33),
('Core', 'DeleteGlobalContentPost', 34),
('Core', 'GlobalContentPreCompile', 35),
('Core', 'GlobalContentPostCompile', 36),
('Core', 'ContentEditPre', 37),
('Core', 'ContentEditPost', 38),
('Core', 'ContentDeletePre', 39),
('Core', 'ContentDeletePost', 40),
('Core', 'AddUserDefinedTagPre', 41),
('Core', 'AddUserDefinedTagPost', 42),
('Core', 'EditUserDefinedTagPre', 43),
('Core', 'EditUserDefinedTagPost', 44),
('Core', 'DeleteUserDefinedTagPre', 45),
('Core', 'DeleteUserDefinedTagPost', 46),
('Core', 'ModuleInstalled', 47),
('Core', 'ModuleUninstalled', 48),
('Core', 'ModuleUpgraded', 49),
('Core', 'ContentStylesheet', 50),
('Core', 'ContentPreCompile', 51),
('Core', 'ContentPostCompile', 52),
('Core', 'ContentPostRender', 53),
('Core', 'SmartyPreCompile', 54),
('Core', 'SmartyPostCompile', 55),
('Core', 'ChangeGroupAssignPre', 56),
('Core', 'ChangeGroupAssignPost', 57),
('Core', 'StylesheetPreCompile', 58),
('Core', 'StylesheetPostCompile', 59),
('Core', 'LoginFailed', 60),
('FileManager', 'OnFileUploaded', 61),
('News', 'NewsArticleAdded', 62),
('News', 'NewsArticleEdited', 63),
('News', 'NewsArticleDeleted', 64),
('News', 'NewsCategoryAdded', 65),
('News', 'NewsCategoryEdited', 66),
('News', 'NewsCategoryDeleted', 67),
('Search', 'SearchInitiated', 68),
('Search', 'SearchCompleted', 69),
('Search', 'SearchItemAdded', 70),
('Search', 'SearchItemDeleted', 71),
('Search', 'SearchAllItemsDeleted', 72),
('CGEcommerceBase', 'CartItemAddPre', 92),
('CGEcommerceBase', 'CartAdjusted', 93),
('CGEcommerceBase', 'CartItemAdded', 94),
('CGEcommerceBase', 'OrderCreated', 95),
('CGEcommerceBase', 'OrderUpdated', 96),
('CGEcommerceBase', 'OrderDeleted', 97),
('FrontEndUsers', 'OnLogin', 98),
('FrontEndUsers', 'OnLogout', 99),
('FrontEndUsers', 'OnExpireUser', 100),
('FrontEndUsers', 'OnCreateUser', 101),
('FrontEndUsers', 'OnDeleteUser', 102),
('FrontEndUsers', 'OnUpdateUser', 103),
('FrontEndUsers', 'OnCreateGroup', 104),
('FrontEndUsers', 'OnUpdateGroup', 105),
('FrontEndUsers', 'OnDeleteGroup', 106),
('FrontEndUsers', ' OnRefreshUser', 107),
('Filelists', 'OnFilelistsPreferenceChange', 108),
('Languages', 'OnLanguagesPreferenceChange', 109);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_events_seq`
--

CREATE TABLE IF NOT EXISTS `cms_events_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_events_seq`
--

INSERT INTO `cms_events_seq` (`id`) VALUES
(109);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_event_handlers`
--

CREATE TABLE IF NOT EXISTS `cms_event_handlers` (
  `event_id` int(11) DEFAULT NULL,
  `tag_name` varchar(255) DEFAULT NULL,
  `module_name` varchar(160) DEFAULT NULL,
  `removable` int(11) DEFAULT NULL,
  `handler_order` int(11) DEFAULT NULL,
  `handler_id` int(11) NOT NULL,
  PRIMARY KEY (`handler_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_event_handlers`
--

INSERT INTO `cms_event_handlers` (`event_id`, `tag_name`, `module_name`, `removable`, `handler_order`, `handler_id`) VALUES
(38, NULL, 'MenuManager', 0, 1, 1),
(40, NULL, 'MenuManager', 0, 1, 2),
(38, NULL, 'Search', 0, 2, 3),
(40, NULL, 'Search', 0, 2, 4),
(22, NULL, 'Search', 0, 1, 5),
(24, NULL, 'Search', 0, 1, 6),
(26, NULL, 'Search', 0, 1, 7),
(30, NULL, 'Search', 0, 1, 8),
(32, NULL, 'Search', 0, 1, 9),
(34, NULL, 'Search', 0, 1, 10),
(48, NULL, 'Search', 0, 1, 11),
(53, NULL, 'CGExtensions', 0, 1, 12),
(53, NULL, 'TinyMCE', 0, 2, 17),
(53, NULL, 'Gallery', 0, 3, 18),
(38, NULL, 'AdvancedContent', 0, 3, 20),
(53, NULL, 'FrontEndUsers', 0, 4, 21),
(96, NULL, 'Products', 0, 1, 22);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_event_handler_seq`
--

CREATE TABLE IF NOT EXISTS `cms_event_handler_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_event_handler_seq`
--

INSERT INTO `cms_event_handler_seq` (`id`) VALUES
(22);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_groups`
--

CREATE TABLE IF NOT EXISTS `cms_groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(25) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_groups`
--

INSERT INTO `cms_groups` (`group_id`, `group_name`, `active`, `create_date`, `modified_date`) VALUES
(1, 'Admin', 1, '2006-07-25 21:22:32', '2006-07-25 21:22:32'),
(2, 'Editor', 1, '2006-07-25 21:22:32', '2006-07-25 21:22:32');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_groups_seq`
--

CREATE TABLE IF NOT EXISTS `cms_groups_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_groups_seq`
--

INSERT INTO `cms_groups_seq` (`id`) VALUES
(3);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_group_perms`
--

CREATE TABLE IF NOT EXISTS `cms_group_perms` (
  `group_perm_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`group_perm_id`),
  KEY `cms_index_group_perms_by_group_id_permission_id` (`group_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_group_perms`
--

INSERT INTO `cms_group_perms` (`group_perm_id`, `group_id`, `permission_id`, `create_date`, `modified_date`) VALUES
(197, 2, 50, '2013-04-05 10:57:47', '2013-04-05 10:57:47'),
(195, 2, 59, '2013-04-05 10:57:47', '2013-04-05 10:57:47'),
(194, 2, 44, '2013-04-05 10:57:47', '2013-04-05 10:57:47'),
(193, 2, 73, '2013-04-05 10:57:47', '2013-04-05 10:57:47');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_group_perms_seq`
--

CREATE TABLE IF NOT EXISTS `cms_group_perms_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_group_perms_seq`
--

INSERT INTO `cms_group_perms_seq` (`id`) VALUES
(204);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_htmlblobs`
--

CREATE TABLE IF NOT EXISTS `cms_htmlblobs` (
  `htmlblob_id` int(11) NOT NULL,
  `htmlblob_name` varchar(255) DEFAULT NULL,
  `html` text,
  `description` text,
  `use_wysiwyg` tinyint(4) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`htmlblob_id`),
  KEY `cms_index_htmlblobs_by_htmlblob_name` (`htmlblob_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_htmlblobs`
--

INSERT INTO `cms_htmlblobs` (`htmlblob_id`, `htmlblob_name`, `html`, `description`, `use_wysiwyg`, `owner`, `create_date`, `modified_date`) VALUES
(56, 'footer_lt', '&copy; 2014. Visos teisės saugomos', '', 1, 1, '2014-04-29 14:40:05', '2014-07-30 13:30:38'),
(66, 'karjera_lt', '<strong>Dsum dolor sit amet</strong>\r\n            <br />\r\n			Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis\r\n            <br />\r\n            <br />\r\n            <ul>\r\n            	<li><a href="#">Darbas ANIONAS įmonėse</a></li>\r\n                <li><a href="#">Sveikata ir sauga</a></li>\r\n                <li><a href="#">Šiuo metu reikalingi</a></li>\r\n            </ul>', '', 1, 1, '2014-07-30 09:59:56', '2014-07-30 09:59:56'),
(67, 'uzklausa_lt', '<h3 class="f_14">Klauskite mūsų!</h3>\r\n<p>Jeigu iškilo neaiškumų, turite papildomų klausimų apie produktą, ar norite pasikonsultuoti su specialistais, užpildykite kairėje esančią anketą ir su Jumis bus susisiekta!</p>', '', 1, 1, '2014-10-14 16:30:33', '2014-10-22 15:26:51'),
(68, 'uzklausa_en', '<p>Contact Us!</p>\r\n<p>If You have any questions about the product or any questions in general, please contact us and we will try to help You!</p>', '', 1, 4, '2014-11-20 10:12:30', '2014-11-20 10:12:30');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_htmlblobs_seq`
--

CREATE TABLE IF NOT EXISTS `cms_htmlblobs_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_htmlblobs_seq`
--

INSERT INTO `cms_htmlblobs_seq` (`id`) VALUES
(68);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_karjera`
--

CREATE TABLE IF NOT EXISTS `cms_karjera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `ID` (`id`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `id_3` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_karjera`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_kontaktai`
--

CREATE TABLE IF NOT EXISTS `cms_kontaktai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `ID` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_kontaktai`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_modules`
--

CREATE TABLE IF NOT EXISTS `cms_modules` (
  `module_name` varchar(160) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `admin_only` tinyint(4) DEFAULT '0',
  `active` tinyint(4) DEFAULT NULL,
  `allow_fe_lazyload` tinyint(4) DEFAULT NULL,
  `allow_admin_lazyload` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`module_name`),
  KEY `cms_index_modules_by_module_name` (`module_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_modules`
--

INSERT INTO `cms_modules` (`module_name`, `status`, `version`, `admin_only`, `active`, `allow_fe_lazyload`, `allow_admin_lazyload`) VALUES
('CMSMailer', 'installed', '1.73.13', 0, 1, 0, 0),
('CMSPrinting', 'installed', '1.0.3', 0, 0, 0, 1),
('FileManager', 'installed', '1.4.3', 0, 1, 1, 0),
('MenuManager', 'installed', '1.8.4', 0, 1, 0, 0),
('MicroTiny', 'installed', '1.2.5', 0, 0, 1, 1),
('ModuleManager', 'installed', '1.5.5', 1, 0, 0, 1),
('News', 'installed', '2.12.10', 0, 0, 1, 1),
('Search', 'installed', '1.7.7', 0, 0, 1, 1),
('ThemeManager', 'installed', '1.1.7', 1, 0, 0, 1),
('TemplateExternalizer', 'installed', '2.0.8', 0, 1, 0, 0),
('CGExtensions', 'installed', '1.31.4', 0, 1, 0, 0),
('JQueryTools', 'installed', '1.2.4', 0, 1, 0, 0),
('CGSmartImage', 'installed', '1.10.1', 0, 1, 0, 0),
('Titulinis', 'installed', '1.6', 0, 0, 0, 0),
('TinyMCE', 'installed', '2.9.12', 0, 1, 0, 0),
('AComments', 'installed', '1.1.1', 0, 0, 0, 0),
('CGEcommerceBase', 'installed', '1.3.11', 0, 0, 0, 0),
('TxForm', 'installed', '1.0', 0, 0, 0, 0),
('Gallery', 'installed', '1.6.1', 0, 0, 0, 0),
('Products', 'installed', '2.18.4', 0, 0, 0, 1),
('AdvancedContent', 'installed', '0.9.4.3', 0, 0, 1, 1),
('ECB', 'installed', '1.5', 0, 0, 1, 0),
('GBFilePicker', 'installed', '1.3.3', 0, 0, 0, 0),
('CGSimpleSmarty', 'installed', '1.5.3', 0, 1, 0, 0),
('FrontEndUsers', 'installed', '1.20', 0, 1, 0, 1),
('Filelists', 'installed', '0.9', 0, 0, 0, 0),
('Languages', 'installed', '1.8', 0, 1, 0, 0),
('Cataloger', 'installed', '0.11.3', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_acomments`
--

CREATE TABLE IF NOT EXISTS `cms_module_acomments` (
  `comment_id` int(11) NOT NULL,
  `comment_data` text,
  `comment_date` datetime DEFAULT NULL,
  `comment_author` varchar(255) DEFAULT NULL,
  `author_email` varchar(255) DEFAULT NULL,
  `author_website` varchar(255) DEFAULT NULL,
  `page_id` varchar(255) DEFAULT NULL,
  `module_name` varchar(50) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `comment_title` varchar(255) DEFAULT NULL,
  `trackback` tinyint(4) DEFAULT NULL,
  `editor` tinyint(4) DEFAULT NULL,
  `author_notify` tinyint(4) DEFAULT NULL,
  `notified` tinyint(4) DEFAULT NULL,
  `ip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_acomments`
--

INSERT INTO `cms_module_acomments` (`comment_id`, `comment_data`, `comment_date`, `comment_author`, `author_email`, `author_website`, `page_id`, `module_name`, `active`, `create_date`, `modified_date`, `comment_title`, `trackback`, `editor`, `author_notify`, `notified`, `ip`) VALUES
(1, 'sdfsadf', '2013-02-28 16:34:50', 'dsfsadf', '', '', '4', 'Products', 1, '2013-02-28 16:34:50', '2013-02-28 16:34:50', '', NULL, NULL, 0, 1, '82.135.244.184'),
(2, 'gdfgdsg', '2013-02-28 16:42:30', 'sdfgdsfg', '', '', '4', 'Products', 1, '2013-02-28 16:42:30', '2013-02-28 16:42:30', '', NULL, NULL, 0, 1, '82.135.244.184'),
(3, 'hjkh', '2013-04-03 11:46:39', 'hjkh', '', '', '1', 'Products', 1, '2013-04-03 11:46:39', '2013-04-03 11:46:39', '', NULL, NULL, 0, 1, '82.135.244.184');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_acomments_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_acomments_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_acomments_seq`
--

INSERT INTO `cms_module_acomments_seq` (`id`) VALUES
(4);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_AdvancedContent_blockdisplay`
--

CREATE TABLE IF NOT EXISTS `cms_module_AdvancedContent_blockdisplay` (
  `user_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `item_id` text,
  `item_display` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_AdvancedContent_blockdisplay`
--

INSERT INTO `cms_module_AdvancedContent_blockdisplay` (`user_id`, `content_id`, `template_id`, `item_id`, `item_display`) VALUES
(1, 248, 45, 'gamintojas3', 0),
(1, 248, 45, 'galleryname', 0),
(1, 248, 45, 'pagephoto', 1),
(1, 248, 45, 'test10', 1),
(1, 248, 45, 'filepicker_block', 1),
(1, 293, 47, 'content_en', 1),
(1, 249, 46, 'content_en', 1),
(1, 249, 46, 'desine', 1),
(1, 248, 46, 'content_en', 1),
(1, 250, 46, 'content_en', 1),
(1, 250, 46, 'desine', 1),
(1, 292, 46, 'content_en', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_AdvancedContent_groupdisplay`
--

CREATE TABLE IF NOT EXISTS `cms_module_AdvancedContent_groupdisplay` (
  `user_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `item_id` text,
  `item_display` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_AdvancedContent_groupdisplay`
--

INSERT INTO `cms_module_AdvancedContent_groupdisplay` (`user_id`, `content_id`, `template_id`, `item_id`, `item_display`) VALUES
(1, 248, 45, 'main_savybes', 0),
(1, 248, 45, 'main_pirma_juosta', 0),
(1, 248, 45, 'main_gamintojai', 0),
(1, 248, 45, 'main_nuotrauk_galerija', 1),
(1, 248, 45, 'main_savyb_s', 1),
(1, 248, 45, 'main_ketvirta_juosta', 1),
(1, 248, 45, 'main_vir_utinis_paveiksliukas', 1),
(1, 248, 45, 'main_penkta_juosta', 1),
(1, 248, 45, 'main_spalvos', 1),
(1, 248, 45, 'main_paskutin_juosta', 1),
(1, 249, 45, 'main_vir_utinis_paveiksliukas', 1),
(1, 249, 45, 'main_pirma_juosta', 1),
(1, 249, 45, 'main_gamintojai', 1),
(1, 249, 45, 'main_spalvos', 1),
(1, 250, 45, 'main_savyb_s', 1),
(1, 250, 45, 'main_spalvos', 1),
(1, 250, 45, 'main_pirma_juosta', 1),
(1, 292, 45, 'main_pirma_juosta', 1),
(1, 249, 45, 'main_nuotrauk_galerija', 1),
(1, 250, 45, 'main_vir_utinis_paveiksliukas', 1),
(1, 249, 45, 'main_savyb_s', 1),
(1, 249, 45, 'main_ketvirta_juosta', 1),
(1, 249, 45, 'main_penkta_juosta', 1),
(1, 249, 45, 'main_paskutin_juosta', 1),
(1, 292, 45, 'main_vir_utinis_paveiksliukas', 0),
(1, 250, 45, 'main_nuotrauk_galerija', 1),
(1, 292, 45, 'main_nuotrauk_galerija', 1),
(1, 250, 45, 'main_gamintojai', 1),
(1, 250, 45, 'main_ketvirta_juosta', 1),
(1, 250, 45, 'main_penkta_juosta', 1),
(1, 250, 45, 'main_paskutin_juosta', 1),
(1, 292, 45, 'main_gamintojai', 0),
(1, 292, 45, 'main_savyb_s', 1),
(1, 292, 45, 'main_ketvirta_juosta', 1),
(1, 292, 45, 'main_penkta_juosta', 1),
(1, 292, 45, 'main_spalvos', 1),
(1, 292, 45, 'main_paskutin_juosta', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_AdvancedContent_messagedisplay`
--

CREATE TABLE IF NOT EXISTS `cms_module_AdvancedContent_messagedisplay` (
  `user_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `item_id` text,
  `item_display` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_AdvancedContent_messagedisplay`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_AdvancedContent_multi_inputs`
--

CREATE TABLE IF NOT EXISTS `cms_module_AdvancedContent_multi_inputs` (
  `input_id` varchar(64) NOT NULL,
  `input_fields` text,
  PRIMARY KEY (`input_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_AdvancedContent_multi_inputs`
--

INSERT INTO `cms_module_AdvancedContent_multi_inputs` (`input_id`, `input_fields`) VALUES
('SampleInput', '\n{content block="module_select" label="Select a module" block_type="dropdown" items="|News|Menu" values="|News|MenuManager"}\n{content block="module_params" label="Enter module parameters here" block_type="text" oneline=true size="56"}');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_AdvancedContent_multi_input_tpl_assocs`
--

CREATE TABLE IF NOT EXISTS `cms_module_AdvancedContent_multi_input_tpl_assocs` (
  `input_id` varchar(64) DEFAULT NULL,
  `tpl_name` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_AdvancedContent_multi_input_tpl_assocs`
--

INSERT INTO `cms_module_AdvancedContent_multi_input_tpl_assocs` (`input_id`, `tpl_name`) VALUES
('SampleInput', 'multi_input_SampleTemplate');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_catalog_attr`
--

CREATE TABLE IF NOT EXISTS `cms_module_catalog_attr` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `attribute` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `alias` varchar(60) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `defaultval` text,
  `field_type` varchar(25) DEFAULT 'text',
  `select_values` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_catalog_attr`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_catalog_attr_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_catalog_attr_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `cms_module_catalog_attr_seq`
--

INSERT INTO `cms_module_catalog_attr_seq` (`id`) VALUES
(9);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_catalog_template`
--

CREATE TABLE IF NOT EXISTS `cms_module_catalog_template` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `template` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_catalog_template`
--

INSERT INTO `cms_module_catalog_template` (`id`, `type_id`, `title`, `template`) VALUES
(1, 2, 'Category-CSS-based', '<h1>{$title}</h1>\r{section name=numimg loop=$image_url_array}<img src="{$image_url_array[numimg]}" alt="{$title}" title="{$title}" />{/section}\r{$notes}\r<div class="category_items">\r   {if $hasnav == 1}\r<div class="catnav">{$prev}{$navstr}{$next}</div>\r	{/if}\r    {section name=numloop loop=$items}\r        <div class="category_item"><a href="{$items[numloop].link}"><img src="{$items[numloop].image}" title="{$items[numloop].title}" alt="{$items[numloop].title}"/></a><br /><a href="{$items[numloop].link}">{$items[numloop].title}</a></div>\r    {/section}\r    {if $hasnav == 1}\r{* \rThe number that is without a link (a href) have a <span class="nolink" ) have a look in source code-html\r*}\r<div class="catnav">{$prev}{$navstr}{$next}</div>\r	{/if}\r</div>\r'),
(6, 1, 'Item-CSS-based', '<div class="catalog_item">\r<p>{$title}</p>\r<div class="item_images"><img id="item_image" name="item_image"  src="{$image_1_url}" alt="{$title}" title="{$title}" />\r<div class="item_thumbnails">{section name=ind loop=$image_url_array}\r<a href="javascript:repl(''{$image_url_array[ind]}'')"><img src="{$image_thumb_url_array[ind]}" title="{$title}" alt="{$title}" /></a>\r{/section}</div></div>\r{section name=at loop=$attrlist}\r<div class="item_attribute_name">{$attrlist[at].name}:</div><div class="item_attribute_val">{eval var=$attrlist[at].key}</div>\r{/section}\r{literal}\r<script type="text/javascript">\rfunction repl(img)\r   {\r   document.item_image.src=img;\r   }\r</script>\r{/literal}\r{if $file_count > 0}\r<ul class="files">{section name=ind loop=$file_name_array}\r<li><a href="{$file_url_array[ind]}">{$file_name_array[ind]}</a></li>\r{/section}\r</ul>\r{/if}\r\r</div>\r');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_catalog_template_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_catalog_template_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `cms_module_catalog_template_seq`
--

INSERT INTO `cms_module_catalog_template_seq` (`id`) VALUES
(8);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_catalog_template_type`
--

CREATE TABLE IF NOT EXISTS `cms_module_catalog_template_type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_catalog_template_type`
--

INSERT INTO `cms_module_catalog_template_type` (`type_id`, `name`) VALUES
(1, 'Aktoriaus puslapis'),
(2, 'Aktorių sarašo puslapis'),
(3, 'Spausdinamas katalogas'),
(4, 'Item Comparison'),
(5, 'Savybių sąra&scaron;as');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_cge_assocdata`
--

CREATE TABLE IF NOT EXISTS `cms_module_cge_assocdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key1` varchar(255) DEFAULT NULL,
  `key2` varchar(255) DEFAULT NULL,
  `key3` varchar(255) DEFAULT NULL,
  `key4` varchar(255) DEFAULT NULL,
  `data` text,
  `type` varchar(20) DEFAULT NULL,
  `expiry` varchar(20) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_cge_assocdata`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_cge_countries`
--

CREATE TABLE IF NOT EXISTS `cms_module_cge_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `sorting` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=239 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_cge_countries`
--

INSERT INTO `cms_module_cge_countries` (`id`, `code`, `name`, `sorting`) VALUES
(1, 'AF', 'Afghanistan', 0),
(2, 'AL', 'Albania', 0),
(3, 'DZ', 'Algeria', 0),
(4, 'AS', 'American Samoa', 0),
(5, 'AD', 'Andorra', 0),
(6, 'AO', 'Angola', 0),
(7, 'AI', 'Anguilla', 0),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 0),
(10, 'AR', 'Argentina', 0),
(11, 'AM', 'Armenia', 0),
(12, 'AW', 'Aruba', 0),
(13, 'AU', 'Australia', 0),
(14, 'AT', 'Austria', 0),
(15, 'AZ', 'Azerbaijan', 0),
(16, 'BS', 'Bahamas', 0),
(17, 'BH', 'Bahrain', 0),
(18, 'BD', 'Bangladesh', 0),
(19, 'BB', 'Barbados', 0),
(20, 'BY', 'Belarus', 0),
(21, 'BE', 'Belgium', 0),
(22, 'BZ', 'Belize', 0),
(23, 'BJ', 'Benin', 0),
(24, 'BM', 'Bermuda', 0),
(25, 'BT', 'Bhutan', 0),
(26, 'BO', 'Bolivia', 0),
(27, 'BA', 'Bosnia And Herzegowina', 0),
(28, 'BW', 'Botswana', 0),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 0),
(31, 'IO', 'British Indian Ocean Territory', 0),
(32, 'BN', 'Brunei Darussalam', 0),
(33, 'BG', 'Bulgaria', 0),
(34, 'BF', 'Burkina Faso', 0),
(35, 'BI', 'Burundi', 0),
(36, 'KH', 'Cambodia', 0),
(37, 'CM', 'Cameroon', 0),
(38, 'CA', 'Canada', 0),
(39, 'CV', 'Cape Verde', 0),
(40, 'KY', 'Cayman Islands', 0),
(41, 'CF', 'Central African Republic', 0),
(42, 'TD', 'Chad', 0),
(43, 'CL', 'Chile', 0),
(44, 'CN', 'China', 0),
(45, 'CX', 'Christmas Island', 0),
(46, 'CC', 'Cocos (Keeling) Islands', 0),
(47, 'CO', 'Colombia', 0),
(48, 'KM', 'Comoros', 0),
(49, 'CG', 'Congo', 0),
(50, 'CK', 'Cook Islands', 0),
(51, 'CR', 'Costa Rica', 0),
(52, 'CI', 'Cote D''Ivoire', 0),
(53, 'HR', 'Croatia (Local Name: Hrvatska)', 0),
(54, 'CU', 'Cuba', 0),
(55, 'CY', 'Cyprus', 0),
(56, 'CZ', 'Czech Republic', 0),
(57, 'DK', 'Denmark', 0),
(58, 'DJ', 'Djibouti', 0),
(59, 'DM', 'Dominica', 0),
(60, 'DO', 'Dominican Republic', 0),
(61, 'TP', 'East Timor', 0),
(62, 'EC', 'Ecuador', 0),
(63, 'EG', 'Egypt', 0),
(64, 'SV', 'El Salvador', 0),
(65, 'GQ', 'Equatorial Guinea', 0),
(66, 'ER', 'Eritrea', 0),
(67, 'EE', 'Estonia', 0),
(68, 'ET', 'Ethiopia', 0),
(69, 'FK', 'Falkland Islands (Malvinas)', 0),
(70, 'FO', 'Faroe Islands', 0),
(71, 'FJ', 'Fiji', 0),
(72, 'FI', 'Finland', 0),
(73, 'FR', 'France', 0),
(74, 'GF', 'French Guiana', 0),
(75, 'PF', 'French Polynesia', 0),
(76, 'TF', 'French Southern Territories', 0),
(77, 'GA', 'Gabon', 0),
(78, 'GM', 'Gambia', 0),
(79, 'GE', 'Georgia', 0),
(80, 'DE', 'Germany', 0),
(81, 'GH', 'Ghana', 0),
(82, 'GI', 'Gibraltar', 0),
(83, 'GR', 'Greece', 0),
(84, 'GL', 'Greenland', 0),
(85, 'GD', 'Grenada', 0),
(86, 'GP', 'Guadeloupe', 0),
(87, 'GU', 'Guam', 0),
(88, 'GT', 'Guatemala', 0),
(89, 'GN', 'Guinea', 0),
(90, 'GW', 'Guinea-Bissau', 0),
(91, 'GY', 'Guyana', 0),
(92, 'HT', 'Haiti', 0),
(93, 'HM', 'Heard And Mc Donald Islands', 0),
(94, 'VA', 'Holy See (Vatican City State)', 0),
(95, 'HN', 'Honduras', 0),
(96, 'HK', 'Hong Kong', 0),
(97, 'HU', 'Hungary', 0),
(98, 'IS', 'Icel And', 0),
(99, 'IN', 'India', 0),
(100, 'ID', 'Indonesia', 0),
(101, 'IR', 'Iran (Islamic Republic Of)', 0),
(102, 'IQ', 'Iraq', 0),
(103, 'IE', 'Ireland', 0),
(104, 'IL', 'Israel', 0),
(105, 'IT', 'Italy', 0),
(106, 'JM', 'Jamaica', 0),
(107, 'JP', 'Japan', 0),
(108, 'JO', 'Jordan', 0),
(109, 'KZ', 'Kazakhstan', 0),
(110, 'KE', 'Kenya', 0),
(111, 'KI', 'Kiribati', 0),
(112, 'KP', 'Korea', 0),
(113, 'KR', 'Korea', 0),
(114, 'KW', 'Kuwait', 0),
(115, 'KG', 'Kyrgyzstan', 0),
(116, 'LA', 'Lao People''S Dem Republic', 0),
(117, 'LV', 'Latvia', 0),
(118, 'LB', 'Lebanon', 0),
(119, 'LS', 'Lesotho', 0),
(120, 'LR', 'Liberia', 0),
(121, 'LY', 'Libyan Arab Jamahiriya', 0),
(122, 'LI', 'Liechtenstein', 0),
(123, 'LT', 'Lithuania', 0),
(124, 'LU', 'Luxembourg', 0),
(125, 'MO', 'Macau', 0),
(126, 'MK', 'Macedonia', 0),
(127, 'MG', 'Madagascar', 0),
(128, 'MW', 'Malawi', 0),
(129, 'MY', 'Malaysia', 0),
(130, 'MV', 'Maldives', 0),
(131, 'ML', 'Mali', 0),
(132, 'MT', 'Malta', 0),
(133, 'MH', 'Marshall Islands', 0),
(134, 'MQ', 'Martinique', 0),
(135, 'MR', 'Mauritania', 0),
(136, 'MU', 'Mauritius', 0),
(137, 'YT', 'Mayotte', 0),
(138, 'MX', 'Mexico', 0),
(139, 'FM', 'Micronesia', 0),
(140, 'MD', 'Moldova', 0),
(141, 'MC', 'Monaco', 0),
(142, 'MN', 'Mongolia', 0),
(143, 'MS', 'Montserrat', 0),
(144, 'MA', 'Morocco', 0),
(145, 'MZ', 'Mozambique', 0),
(146, 'MM', 'Myanmar', 0),
(147, 'NA', 'Namibia', 0),
(148, 'NR', 'Nauru', 0),
(149, 'NP', 'Nepal', 0),
(150, 'NL', 'Netherlands', 0),
(151, 'AN', 'Netherlands Ant Illes', 0),
(152, 'NC', 'New Caledonia', 0),
(153, 'NZ', 'New Zealand', 0),
(154, 'NI', 'Nicaragua', 0),
(155, 'NE', 'Niger', 0),
(156, 'NG', 'Nigeria', 0),
(157, 'NU', 'Niue', 0),
(158, 'NF', 'Norfolk Island', 0),
(159, 'MP', 'Northern Mariana Islands', 0),
(160, 'NO', 'Norway', 0),
(161, 'OM', 'Oman', 0),
(162, 'PK', 'Pakistan', 0),
(163, 'PW', 'Palau', 0),
(164, 'PA', 'Panama', 0),
(165, 'PG', 'Papua New Guinea', 0),
(166, 'PY', 'Paraguay', 0),
(167, 'PE', 'Peru', 0),
(168, 'PH', 'Philippines', 0),
(169, 'PN', 'Pitcairn', 0),
(170, 'PL', 'Poland', 0),
(171, 'PT', 'Portugal', 0),
(172, 'PR', 'Puerto Rico', 0),
(173, 'QA', 'Qatar', 0),
(174, 'RE', 'Reunion', 0),
(175, 'RO', 'Romania', 0),
(176, 'RU', 'Russian Federation', 0),
(177, 'RW', 'Rwanda', 0),
(178, 'KN', 'Saint K Itts And Nevis', 0),
(179, 'LC', 'Saint Lucia', 0),
(180, 'VC', 'Saint Vincent', 0),
(181, 'WS', 'Samoa', 0),
(182, 'SM', 'San Marino', 0),
(183, 'ST', 'Sao Tome And Principe', 0),
(184, 'SA', 'Saudi Arabia', 0),
(185, 'SN', 'Senegal', 0),
(186, 'SC', 'Seychelles', 0),
(187, 'SL', 'Sierra Leone', 0),
(188, 'SG', 'Singapore', 0),
(189, 'SK', 'Slovakia (Slovak Republic)', 0),
(190, 'SI', 'Slovenia', 0),
(191, 'SB', 'Solomon Islands', 0),
(192, 'SO', 'Somalia', 0),
(193, 'ZA', 'South Africa', 0),
(194, 'GS', 'South Georgia', 0),
(195, 'ES', 'Spain', 0),
(196, 'LK', 'Sri Lanka', 0),
(197, 'SH', 'St. Helena', 0),
(198, 'PM', 'St. Pierre And Miquelon', 0),
(199, 'SD', 'Sudan', 0),
(200, 'SR', 'Suriname', 0),
(201, 'SJ', 'Svalbard', 0),
(202, 'SZ', 'Sw Aziland', 0),
(203, 'SE', 'Sweden', 0),
(204, 'CH', 'Switzerland', 0),
(205, 'SY', 'Syrian Arab Republic', 0),
(206, 'TW', 'Taiwan', 0),
(207, 'TJ', 'Tajikistan', 0),
(208, 'TZ', 'Tanzania', 0),
(209, 'TH', 'Thailand', 0),
(210, 'TG', 'Togo', 0),
(211, 'TK', 'Tokelau', 0),
(212, 'TO', 'Tonga', 0),
(213, 'TT', 'Trinidad And Tobago', 0),
(214, 'TN', 'Tunisia', 0),
(215, 'TR', 'Turkey', 0),
(216, 'TM', 'Turkmenistan', 0),
(217, 'TC', 'Turks And Caicos Islands', 0),
(218, 'TV', 'Tuvalu', 0),
(219, 'UG', 'Uganda', 0),
(220, 'UA', 'Ukraine', 0),
(221, 'AE', 'United Arab Emirates', 0),
(222, 'GB', 'United Kingdom', 0),
(223, 'US', 'United States', 0),
(224, 'UM', 'United States Minor Is.', 0),
(225, 'UY', 'Uruguay', 0),
(226, 'UZ', 'Uzbekistan', 0),
(227, 'VU', 'Vanuatu', 0),
(228, 'VE', 'Venezuela', 0),
(229, 'VN', 'Viet Nam', 0),
(230, 'VG', 'Virgin Islands (British)', 0),
(231, 'VI', 'Virgin Islands (U.S.)', 0),
(232, 'WF', 'Wallis And Futuna Islands', 0),
(233, 'EH', 'Western Sahara', 0),
(234, 'YE', 'Yemen', 0),
(235, 'YU', 'Yugoslavia', 0),
(236, 'ZR', 'Zaire', 0),
(237, 'ZM', 'Zambia', 0),
(238, 'ZW', 'Zimbabwe', 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_cge_states`
--

CREATE TABLE IF NOT EXISTS `cms_module_cge_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `sorting` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_cge_states`
--

INSERT INTO `cms_module_cge_states` (`id`, `code`, `name`, `sorting`) VALUES
(1, 'AL', 'Alabama', 0),
(2, 'AK', 'Alaska', 0),
(3, 'AS', 'American Samoa', 0),
(4, 'AZ', 'Arizona', 0),
(5, 'AR', 'Arkansas', 0),
(6, 'CA', 'California', 0),
(7, 'CO', 'Colorado', 0),
(8, 'CT', 'Connecticut', 0),
(9, 'DE', 'Delaware', 0),
(10, 'DC', 'District of Columbia', 0),
(11, 'FM', 'Fed. States of Micronesia', 0),
(12, 'FL', 'Florida', 0),
(13, 'GA', 'Georgia', 0),
(14, 'GU', 'Guam', 0),
(15, 'HI', 'Hawaii', 0),
(16, 'ID', 'Idaho', 0),
(17, 'IL', 'Illinois', 0),
(18, 'IN', 'Indiana', 0),
(19, 'IA', 'Iowa', 0),
(20, 'KS', 'Kansas', 0),
(21, 'KY', 'Kentucky', 0),
(22, 'LA', 'Louisiana', 0),
(23, 'ME', 'Maine', 0),
(24, 'MH', 'Marshall Islands', 0),
(25, 'MD', 'Maryland', 0),
(26, 'MA', 'Massachusetts', 0),
(27, 'MI', 'Michigan', 0),
(28, 'MN', 'Minnesota', 0),
(29, 'MS', 'Mississippi', 0),
(30, 'MO', 'Missouri', 0),
(31, 'MT', 'Montana', 0),
(32, 'NE', 'Nebraska', 0),
(33, 'NV', 'Nevada', 0),
(34, 'NH', 'New Hampshire', 0),
(35, 'NJ', 'New Jersey', 0),
(36, 'NM', 'New Mexico', 0),
(37, 'NY', 'New York', 0),
(38, 'NC', 'North Carolina', 0),
(39, 'ND', 'North Dakota', 0),
(40, 'MP', 'Northern Mariana Is.', 0),
(41, 'OH', 'Ohio', 0),
(42, 'OK', 'Oklahoma', 0),
(43, 'OR', 'Oregon', 0),
(44, 'PW', 'Palau', 0),
(45, 'PA', 'Pennsylvania', 0),
(46, 'PR', 'Puerto Rico', 0),
(47, 'RI', 'Rhode Island', 0),
(48, 'SC', 'South Carolina', 0),
(49, 'SD', 'South Dakota', 0),
(50, 'TN', 'Tennessee', 0),
(51, 'TX', 'Texas', 0),
(52, 'UT', 'Utah', 0),
(53, 'VT', 'Vermont', 0),
(54, 'VA', 'Virginia', 0),
(55, 'VI', 'Virgin Islands', 0),
(56, 'WA', 'Washington', 0),
(57, 'WV', 'West Virginia', 0),
(58, 'WI', 'Wisconsin', 0),
(59, 'WY', 'Wyoming', 0),
(60, 'AB', 'Alberta', 0),
(61, 'BC', 'British Columbia', 0),
(62, 'MB', 'Manitoba', 0),
(63, 'NB', 'New Brunswick', 0),
(64, 'NU', 'Nunavut', 0),
(65, 'NL', 'Newfoundland', 0),
(66, 'NT', 'Northwest Territories', 0),
(67, 'NS', 'Nova Scotia', 0),
(68, 'ON', 'Ontario', 0),
(69, 'PE', 'Prince Edward Island', 0),
(70, 'QC', 'Quebec', 0),
(71, 'SK', 'Saskatchewan', 0),
(72, 'YT', 'Yukon', 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_deps`
--

CREATE TABLE IF NOT EXISTS `cms_module_deps` (
  `parent_module` varchar(25) DEFAULT NULL,
  `child_module` varchar(25) DEFAULT NULL,
  `minimum_version` varchar(25) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_deps`
--

INSERT INTO `cms_module_deps` (`parent_module`, `child_module`, `minimum_version`, `create_date`, `modified_date`) VALUES
('FileManager', 'MicroTiny', '1.4.2', '2013-02-19 12:33:23', '2013-02-19 12:33:23'),
('CGExtensions', 'JQueryTools', '1.31', '2013-02-11 11:36:31', '2013-02-11 11:36:31'),
('CGExtensions', 'CGSmartImage', '1.31', '2013-02-19 13:02:46', '2013-02-19 13:02:46'),
('CGExtensions', 'CGEcommerceBase', '1.26.6', '2013-02-28 17:30:52', '2013-02-28 17:30:52'),
('CGExtensions', 'ECB', '1.31', '2014-03-30 18:56:00', '2014-03-30 18:56:00'),
('CMSMailer', 'FrontEndUsers', '1.73.9', '2014-07-29 14:40:48', '2014-07-29 14:40:48'),
('CGExtensions', 'FrontEndUsers', '1.31', '2014-07-29 14:40:48', '2014-07-29 14:40:48'),
('CGExtensions', 'Products', '1.24', '2014-07-30 08:32:25', '2014-07-30 08:32:25'),
('CGSimpleSmarty', 'Products', '1.4.4', '2014-07-30 08:32:25', '2014-07-30 08:32:25'),
('JQueryTools', 'Products', '1.0.11', '2014-07-30 08:32:25', '2014-07-30 08:32:25'),
('FrontEndUsers', 'Filelists', '1.0', '2014-10-14 13:21:04', '2014-10-14 13:21:04');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_belongs`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_belongs` (
  `userid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`userid`,`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_belongs`
--

INSERT INTO `cms_module_feusers_belongs` (`userid`, `groupid`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_dropdowns`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_dropdowns` (
  `order_id` int(11) DEFAULT NULL,
  `option_name` varchar(40) DEFAULT NULL,
  `option_text` varchar(255) DEFAULT NULL,
  `control_name` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_dropdowns`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_grouppropmap`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_grouppropmap` (
  `name` varchar(40) NOT NULL,
  `group_id` int(11) NOT NULL,
  `sort_key` int(11) DEFAULT NULL,
  `required` int(11) DEFAULT NULL,
  `lostunflag` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_grouppropmap`
--

INSERT INTO `cms_module_feusers_grouppropmap` (`name`, `group_id`, `sort_key`, `required`, `lostunflag`) VALUES
('vardas', 1, 0, 1, -1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_groups`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_groups` (
  `id` int(11) NOT NULL,
  `groupname` varchar(32) DEFAULT NULL,
  `groupdesc` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_groups`
--

INSERT INTO `cms_module_feusers_groups` (`id`, `groupname`, `groupdesc`) VALUES
(1, 'Pirma grupė', 'Pirma grupė');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_groups_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_groups_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_groups_seq`
--

INSERT INTO `cms_module_feusers_groups_seq` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_history`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_history` (
  `userid` int(11) DEFAULT NULL,
  `sessionid` varchar(32) DEFAULT NULL,
  `action` varchar(32) DEFAULT NULL,
  `refdate` datetime DEFAULT NULL,
  `ipaddress` varchar(20) DEFAULT NULL,
  KEY `idx_refdate` (`userid`,`refdate`,`action`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_history`
--

INSERT INTO `cms_module_feusers_history` (`userid`, `sessionid`, `action`, `refdate`, `ipaddress`) VALUES
(1, 'pe6po05h3t6s01t1opjdcm9ti2', 'login', '2014-07-29 15:46:43', '84.240.5.186'),
(1, 'pe6po05h3t6s01t1opjdcm9ti2', 'logout', '2014-07-29 15:47:10', '84.240.5.186'),
(1, 'pe6po05h3t6s01t1opjdcm9ti2', 'login', '2014-07-29 15:48:47', '84.240.5.186'),
(1, 'pe6po05h3t6s01t1opjdcm9ti2', 'logout', '2014-07-29 15:51:21', '84.240.5.186'),
(1, 'pe6po05h3t6s01t1opjdcm9ti2', 'login', '2014-07-29 15:51:36', '84.240.5.186'),
(1, 'pe6po05h3t6s01t1opjdcm9ti2', 'logout', '2014-07-29 15:51:45', '84.240.5.186'),
(1, 'pe6po05h3t6s01t1opjdcm9ti2', 'login', '2014-07-29 15:56:28', '84.240.5.186'),
(1, 'pe6po05h3t6s01t1opjdcm9ti2', 'logout', '2014-07-29 16:00:01', '84.240.5.186'),
(1, '383u87klmv4362ide9q8ltfib0', 'login', '2014-07-30 08:38:38', '84.240.5.186'),
(1, '383u87klmv4362ide9q8ltfib0', 'logout', '2014-07-30 08:40:52', '84.240.5.186'),
(1, '383u87klmv4362ide9q8ltfib0', 'login', '2014-07-30 08:47:35', '84.240.5.186'),
(1, '383u87klmv4362ide9q8ltfib0', 'logout', '2014-07-30 08:47:53', '84.240.5.186');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_loggedin`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_loggedin` (
  `sessionid` varchar(255) DEFAULT NULL,
  `lastused` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_loggedin`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_propdefn`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_propdefn` (
  `name` varchar(40) NOT NULL,
  `prompt` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `maxlength` int(11) DEFAULT NULL,
  `attribs` varchar(255) DEFAULT NULL,
  `force_unique` tinyint(4) DEFAULT NULL,
  `encrypt` tinyint(4) DEFAULT NULL,
  `extra` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_propdefn`
--

INSERT INTO `cms_module_feusers_propdefn` (`name`, `prompt`, `type`, `length`, `maxlength`, `attribs`, `force_unique`, `encrypt`, `extra`) VALUES
('vardas', 'Vardas', '0', 80, 255, 'a:0:{}', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_properties`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_properties` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `data` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_properties`
--

INSERT INTO `cms_module_feusers_properties` (`id`, `userid`, `title`, `data`) VALUES
(1, 1, 'vardas', 'Laurynas');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_properties_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_properties_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_properties_seq`
--

INSERT INTO `cms_module_feusers_properties_seq` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_tempcode`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_tempcode` (
  `userid` int(11) NOT NULL,
  `code` varchar(25) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_tempcode`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_users`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_users` (
  `id` int(11) NOT NULL,
  `username` varchar(80) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_username` (`username`),
  KEY `idx_expires` (`expires`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_users`
--

INSERT INTO `cms_module_feusers_users` (`id`, `username`, `password`, `createdate`, `expires`) VALUES
(1, 'l.slionskis@texus.lt', 'c3aa1d58d90ef333516a3406d6fd7401', '2014-07-29 15:08:04', '2019-07-29 23:59:59');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_feusers_users_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_feusers_users_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `cms_module_feusers_users_seq`
--

INSERT INTO `cms_module_feusers_users_seq` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_filelists`
--

CREATE TABLE IF NOT EXISTS `cms_module_filelists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cr_date` datetime NOT NULL,
  `date` date NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `short_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) NOT NULL,
  `deleted` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenum_sent` tinyint(4) NOT NULL,
  `date_end` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `needs_registration` tinyint(4) NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_nr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cooking_course` text COLLATE utf8_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `active` (`active`,`deleted`,`user_id`),
  KEY `needs_registration` (`needs_registration`),
  KEY `google_id` (`google_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_filelists`
--

INSERT INTO `cms_module_filelists` (`id`, `filename`, `cr_date`, `date`, `detail`, `short_desc`, `keywords`, `active`, `deleted`, `user_id`, `file`, `prenum_sent`, `date_end`, `time_start`, `time_end`, `needs_registration`, `location`, `file2`, `google_id`, `user_name`, `user_email`, `user_nr`, `cooking_course`, `file_size`) VALUES
(18, 'Testinis', '2014-10-14 15:03:31', '2014-10-14', '', '', 'fdSDF', 1, 0, 0, '', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '20', 'images/files/file_pdf.png', '', '', '', '', '', '31,36 KB'),
(19, 'Raktas', '2014-10-14 15:41:40', '2014-10-14', '', '', 'sdasd', 1, 0, 0, '', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '12', 'images/files/file_2d.png', '', '', '', '', '', '132,8 KB'),
(20, 'Data test', '2014-10-14 15:53:13', '2014-10-14', '', '', 'sadas', 1, 0, 0, '', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '2', 'images/files/file_3d.png', '', '', '', '', '', ''),
(21, 'Data test', '2014-10-14 15:53:55', '2014-10-14', '', '', 'sadas', 1, 0, 0, '', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '2', 'images/files/file_jpg.png', '', '', '', '', '', '84,46 KB'),
(22, 'Glass Scale Gratings 2015', '2014-11-18 08:37:47', '2014-11-18', '', '', 'glass scale gratings, 2015, scales, glass, linear scales, glass plates, discs, reticles', 1, 0, 0, '', 0, '0000-00-00', '00:00:00', '00:00:00', 0, '', 'images/files/file_pdf.png', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_filelists_cats`
--

CREATE TABLE IF NOT EXISTS `cms_module_filelists_cats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `filelist_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`,`filelist_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_filelists_cats`
--

INSERT INTO `cms_module_filelists_cats` (`id`, `cat_id`, `filelist_id`) VALUES
(44, 466, 18),
(45, 466, 19),
(43, 466, 21),
(46, 466, 20),
(53, 507, 22),
(52, 461, 22),
(54, 498, 22);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_filelists_prenum`
--

CREATE TABLE IF NOT EXISTS `cms_module_filelists_prenum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_filelists_prenum`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_filelists_registration`
--

CREATE TABLE IF NOT EXISTS `cms_module_filelists_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filelist_id` int(11) NOT NULL,
  `cr_date` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `workplace` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `questions` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fecent_id` (`filelist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_filelists_registration`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_filelists_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_filelists_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `cms_module_filelists_seq`
--

INSERT INTO `cms_module_filelists_seq` (`id`) VALUES
(0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_gallery`
--

CREATE TABLE IF NOT EXISTS `cms_module_gallery` (
  `fileid` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `filedate` datetime DEFAULT NULL,
  `fileorder` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `defaultfile` int(11) DEFAULT NULL,
  `galleryid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`fileid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=420 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_gallery`
--

INSERT INTO `cms_module_gallery` (`fileid`, `filename`, `filepath`, `filedate`, `fileorder`, `active`, `defaultfile`, `galleryid`, `title`, `comment`) VALUES
(1, '', '', '2013-04-16 14:58:48', -1, 1, 0, 0, 'Galerija', 'Thank you for installing the Gallery module. If you have uploaded some images to the ''uploads/images/Gallery'' folder, you will see them below. You can edit titles, descriptions and thumbnail sizes in the admin section. Check out all the other features this module offers in the Module Help.');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_gallery_fielddefs`
--

CREATE TABLE IF NOT EXISTS `cms_module_gallery_fielddefs` (
  `fieldid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `properties` varchar(255) DEFAULT NULL,
  `dirfield` tinyint(4) DEFAULT NULL,
  `sortorder` int(11) DEFAULT NULL,
  `public` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`fieldid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_gallery_fielddefs`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_gallery_fieldvals`
--

CREATE TABLE IF NOT EXISTS `cms_module_gallery_fieldvals` (
  `fileid` int(11) NOT NULL,
  `fieldid` int(11) NOT NULL,
  `value` text,
  PRIMARY KEY (`fileid`,`fieldid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_gallery_fieldvals`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_gallery_props`
--

CREATE TABLE IF NOT EXISTS `cms_module_gallery_props` (
  `fileid` int(11) NOT NULL,
  `templateid` int(11) DEFAULT NULL,
  `hideparentlink` int(11) DEFAULT NULL,
  `feugroups` varchar(255) DEFAULT NULL,
  `editors` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fileid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_gallery_props`
--

INSERT INTO `cms_module_gallery_props` (`fileid`, `templateid`, `hideparentlink`, `feugroups`, `editors`) VALUES
(1, 0, 1, NULL, ''),
(2, 3, 1, NULL, '1'),
(10, 0, 0, NULL, ''),
(11, 0, 0, NULL, '1'),
(13, 6, 0, NULL, '1'),
(30, 6, 0, NULL, '1'),
(47, 8, 0, NULL, '1'),
(49, 6, 0, NULL, '1'),
(58, 0, 0, NULL, '1'),
(62, 6, 0, NULL, '1'),
(72, 0, 0, NULL, '1'),
(76, 6, 0, NULL, '1'),
(85, 0, 0, NULL, '1'),
(92, 0, 0, NULL, '1'),
(99, 0, 0, NULL, '1'),
(102, 6, 0, NULL, '1'),
(153, 0, 0, NULL, '1'),
(156, 0, 0, NULL, '1'),
(159, 6, 0, NULL, '1'),
(169, 6, 0, NULL, '1'),
(223, 0, 0, NULL, '1'),
(224, 0, 0, NULL, '1'),
(230, 0, 0, NULL, '1'),
(236, 0, 0, NULL, '1'),
(254, 0, 0, NULL, '1'),
(265, 0, 0, NULL, '1'),
(269, 6, 0, NULL, '1'),
(298, 0, 0, NULL, '1'),
(308, 0, 0, NULL, '1'),
(315, 0, 0, NULL, '1'),
(365, 0, 0, NULL, '1'),
(383, 0, 0, NULL, '1'),
(389, 0, 0, NULL, '1'),
(395, 0, 0, NULL, '1');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_gallery_templateprops`
--

CREATE TABLE IF NOT EXISTS `cms_module_gallery_templateprops` (
  `templateid` int(11) NOT NULL AUTO_INCREMENT,
  `template` varchar(255) DEFAULT NULL,
  `version` varchar(20) DEFAULT NULL,
  `about` text,
  `thumbwidth` int(11) DEFAULT NULL,
  `thumbheight` int(11) DEFAULT NULL,
  `resizemethod` varchar(10) DEFAULT NULL,
  `maxnumber` int(11) DEFAULT NULL,
  `sortitems` varchar(255) DEFAULT NULL,
  `visible` int(11) DEFAULT NULL,
  PRIMARY KEY (`templateid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_gallery_templateprops`
--

INSERT INTO `cms_module_gallery_templateprops` (`templateid`, `template`, `version`, `about`, `thumbwidth`, `thumbheight`, `resizemethod`, `maxnumber`, `sortitems`, `visible`) VALUES
(3, 'Fancybox', '1.3.4-3', '<p>This Gallerytemplate uses the Fancybox system version 1.3.4</p>\r\n<p>Documentation for extra options can be found at <a href="http://www.fancybox.net/" target="_blank">www.fancybox.net</a></p>\r\n<p>Files that come with Fancybox are stored in <em>modules/Gallery/templates/fancybox/</em></p>\r\n<p>Fancybox was built using the <a href="http://jquery.com/">jQuery library</a>. Licensed under both <a href="http://docs.jquery.com/Licensing">MIT and GPL licenses</a></p>', NULL, NULL, NULL, NULL, 'n-isdir/s+file', 1),
(6, 'prettyPhoto', '3.1.4-1', '<p>This Gallerytemplate uses the prettyPhoto system version 3.1.4</p>\r\n<p>Documentation for extra options can be found at <a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/" target="_blank">www.no-margin-for-errors.com</a></p>\r\n<p>Files that come with prettyPhoto are stored in <em>modules/Gallery/templates/prettyphoto/</em></p>\r\n<p>prettyPhoto was built using the <a href="http://jquery.com/">jQuery library</a>. It is released under the <a href="http://www.gnu.org/licenses/gpl-2.0.html">GPLv2</a> or <a href="http://creativecommons.org/licenses/by/2.5/">Creative Commons 2.5</a> license.</p>', NULL, NULL, NULL, NULL, 'n-isdir/s+file', 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_languages`
--

CREATE TABLE IF NOT EXISTS `cms_module_languages` (
  `languages_id` int(11) NOT NULL,
  `description` varchar(80) DEFAULT NULL,
  `explanation` text,
  PRIMARY KEY (`languages_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_languages`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_languages_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_languages_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `cms_module_languages_seq`
--

INSERT INTO `cms_module_languages_seq` (`id`) VALUES
(0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_languages_vars`
--

CREATE TABLE IF NOT EXISTS `cms_module_languages_vars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `system_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cr_date` datetime NOT NULL,
  `up_date` datetime NOT NULL,
  `files` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value_lt` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_languages_vars`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_news`
--

CREATE TABLE IF NOT EXISTS `cms_module_news` (
  `news_id` int(11) NOT NULL,
  `news_category_id` int(11) DEFAULT NULL,
  `news_title` varchar(255) DEFAULT NULL,
  `news_data` text,
  `news_date` datetime DEFAULT NULL,
  `summary` text,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `news_extra` varchar(255) DEFAULT NULL,
  `news_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`news_id`),
  KEY `cms_news_postdate` (`news_date`),
  KEY `cms_news_daterange` (`start_time`,`end_time`),
  KEY `cms_news_author` (`author_id`),
  KEY `cms_news_hier` (`news_category_id`),
  KEY `cms_news_url` (`news_url`),
  KEY `cms_news_startenddate` (`start_time`,`end_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_news`
--

INSERT INTO `cms_module_news` (`news_id`, `news_category_id`, `news_title`, `news_data`, `news_date`, `summary`, `start_time`, `end_time`, `status`, `icon`, `create_date`, `modified_date`, `author_id`, `news_extra`, `news_url`) VALUES
(82, 8, 'Lorem ipsum dolor sit amet', '<p>Lorem ipsum dolor sit amet, eu solet petentium disputationi per, ei sumo errem expetenda quo. Eum minim moderatius eloquentiam ad, ut quo consul option. Sea liber aliquip splendide ut, zril detracto per et, te sit tation copiosae. Vitae munere ei eum. Pri oportere indoctum at.</p>\r\n<p>Lorem ipsum dolor sit amet, eu solet petentium disputationi per, ei sumo errem expetenda quo. Eum minim moderatius eloquentiam ad, ut quo consul option. Sea liber aliquip splendide ut, zril detracto per et, te sit tation copiosae. Vitae munere ei eum. Pri oportere indoctum at.</p>\r\n<p>Lorem ipsum dolor sit amet, eu solet petentium disputationi per, ei sumo errem expetenda quo. Eum minim moderatius eloquentiam ad, ut quo consul option. Sea liber aliquip splendide ut, zril detracto per et, te sit tation copiosae. Vitae munere ei eum. Pri oportere indoctum at.</p>\r\n<p> </p>', '2014-12-10 12:58:35', 'Lorem ipsum dolor sit amet, eu solet petentium disputationi per, ei sumo errem expetenda quo. Eum minim moderatius eloquentiam ad, ut quo consul option. Sea liber aliquip splendide ut, zril detracto per et, te sit tation copiosae. Vitae munere ei eum. Pri oportere indoctum at.', NULL, NULL, 'published', NULL, '2014-12-10 12:59:08', '2014-12-10 12:59:08', 1, '', ''),
(83, 8, 'An has erat tempor dicunt', '<p>An has erat tempor dicunt, an nec quaeque dolores, no mea audiam regione expetenda. Feugiat legimus dolores vel in, per feugait conceptam an. Labitur commune corrumpit quo ea, ferri ornatus oportere sed ad. Ex malorum numquam eam, mea sint novum mazim ad, tation dolorem nominati ad ius. No molestiae deseruisse sed, eu eam movet singulis cotidieque. Nonumy nostrum eam an, nec ne viris splendide forensibus. Ei possit accusata eam, ne nam mediocrem definiebas reprehendunt.</p>\r\n<p>An has erat tempor dicunt, an nec quaeque dolores, no mea audiam regione expetenda. Feugiat legimus dolores vel in, per feugait conceptam an. Labitur commune corrumpit quo ea, ferri ornatus oportere sed ad. Ex malorum numquam eam, mea sint novum mazim ad, tation dolorem nominati ad ius. No molestiae deseruisse sed, eu eam movet singulis cotidieque. Nonumy nostrum eam an, nec ne viris splendide forensibus. Ei possit accusata eam, ne nam mediocrem definiebas reprehendunt.</p>\r\n<p>An has erat tempor dicunt, an nec quaeque dolores, no mea audiam regione expetenda. Feugiat legimus dolores vel in, per feugait conceptam an. Labitur commune corrumpit quo ea, ferri ornatus oportere sed ad. Ex malorum numquam eam, mea sint novum mazim ad, tation dolorem nominati ad ius. No molestiae deseruisse sed, eu eam movet singulis cotidieque. Nonumy nostrum eam an, nec ne viris splendide forensibus. Ei possit accusata eam, ne nam mediocrem definiebas reprehendunt.</p>', '2014-12-10 12:59:14', 'An has erat tempor dicunt, an nec quaeque dolores, no mea audiam regione expetenda. Feugiat legimus dolores vel in, per feugait conceptam an. Labitur commune corrumpit quo ea, ferri ornatus oportere sed ad. Ex malorum numquam eam, mea sint novum mazim ad, tation dolorem nominati ad ius. No molestiae deseruisse sed, eu eam movet singulis cotidieque. Nonumy nostrum eam an, nec ne viris splendide forensibus. Ei possit accusata eam, ne nam mediocrem definiebas reprehendunt.', NULL, NULL, 'published', NULL, '2014-12-10 12:59:34', '2014-12-10 12:59:34', 1, '', ''),
(84, 8, 'Ad cum ullum detraxit', '<p>Ad cum ullum detraxit theophrastus, nam case quaestio pertinacia eu. Eum at idque error persecuti, epicuri eligendi explicari te mea. Erant feugiat corpora quo ut. Eum malorum legendos ad, tota labitur minimum vix cu, ea omittam gubergren scribentur vis. Stet dicant definitionem ea vim, at nec magna admodum definiebas.</p>\r\n<p>Ad cum ullum detraxit theophrastus, nam case quaestio pertinacia eu. Eum at idque error persecuti, epicuri eligendi explicari te mea. Erant feugiat corpora quo ut. Eum malorum legendos ad, tota labitur minimum vix cu, ea omittam gubergren scribentur vis. Stet dicant definitionem ea vim, at nec magna admodum definiebas.</p>\r\n<p>Ad cum ullum detraxit theophrastus, nam case quaestio pertinacia eu. Eum at idque error persecuti, epicuri eligendi explicari te mea. Erant feugiat corpora quo ut. Eum malorum legendos ad, tota labitur minimum vix cu, ea omittam gubergren scribentur vis. Stet dicant definitionem ea vim, at nec magna admodum definiebas.</p>\r\n<p>Ad cum ullum detraxit theophrastus, nam case quaestio pertinacia eu. Eum at idque error persecuti, epicuri eligendi explicari te mea. Erant feugiat corpora quo ut. Eum malorum legendos ad, tota labitur minimum vix cu, ea omittam gubergren scribentur vis. Stet dicant definitionem ea vim, at nec magna admodum definiebas.</p>', '2014-12-10 12:59:49', 'Ad cum ullum detraxit theophrastus, nam case quaestio pertinacia eu. Eum at idque error persecuti, epicuri eligendi explicari te mea. Erant feugiat corpora quo ut. Eum malorum legendos ad, tota labitur minimum vix cu, ea omittam gubergren scribentur vis. Stet dicant definitionem ea vim, at nec magna admodum definiebas.', NULL, NULL, 'published', NULL, '2014-12-10 13:00:05', '2014-12-10 13:00:05', 1, '', ''),
(85, 8, 'Harum labores omnesque pri no', '<p>Harum labores omnesque pri no. Ne pri amet simul molestiae, unum causae intellegat no duo, modo affert facilisi nam ut. Agam liber cum in, cum solum iuvaret at, sea atqui veniam maiorum in. Vis ex quis eruditi abhorreant, nec integre mandamus et, adipisci pertinax persequeris pro no.</p>\r\n<p>Harum labores omnesque pri no. Ne pri amet simul molestiae, unum causae intellegat no duo, modo affert facilisi nam ut. Agam liber cum in, cum solum iuvaret at, sea atqui veniam maiorum in. Vis ex quis eruditi abhorreant, nec integre mandamus et, adipisci pertinax persequeris pro no.</p>\r\n<p>Harum labores omnesque pri no. Ne pri amet simul molestiae, unum causae intellegat no duo, modo affert facilisi nam ut. Agam liber cum in, cum solum iuvaret at, sea atqui veniam maiorum in. Vis ex quis eruditi abhorreant, nec integre mandamus et, adipisci pertinax persequeris pro no.</p>', '2014-12-10 13:00:15', 'Harum labores omnesque pri no. Ne pri amet simul molestiae, unum causae intellegat no duo, modo affert facilisi nam ut. Agam liber cum in, cum solum iuvaret at, sea atqui veniam maiorum in. Vis ex quis eruditi abhorreant, nec integre mandamus et, adipisci pertinax persequeris pro no.', NULL, NULL, 'published', NULL, '2014-12-10 13:00:36', '2014-12-10 13:00:36', 1, '', ''),
(86, 8, 'Nusquam liberavisse ullamcorper cum ut', '<p>Nusquam liberavisse ullamcorper cum ut, his ut dicam indoctum definitionem. Ad per consetetur comprehensam. Quando essent efficiendi vel ex, pri cetero fierent volutpat no, mei facilis admodum cu. Ne pri postea suscipiantur. Vide prompta eu quo. His omnes vivendum ea, per te maluisset principes definiebas, decore fastidii indoctum ea vel.</p>\r\n<p>Nusquam liberavisse ullamcorper cum ut, his ut dicam indoctum definitionem. Ad per consetetur comprehensam. Quando essent efficiendi vel ex, pri cetero fierent volutpat no, mei facilis admodum cu. Ne pri postea suscipiantur. Vide prompta eu quo. His omnes vivendum ea, per te maluisset principes definiebas, decore fastidii indoctum ea vel.</p>\r\n<p>Nusquam liberavisse ullamcorper cum ut, his ut dicam indoctum definitionem. Ad per consetetur comprehensam. Quando essent efficiendi vel ex, pri cetero fierent volutpat no, mei facilis admodum cu. Ne pri postea suscipiantur. Vide prompta eu quo. His omnes vivendum ea, per te maluisset principes definiebas, decore fastidii indoctum ea vel.</p>', '2014-12-10 13:00:43', 'Nusquam liberavisse ullamcorper cum ut, his ut dicam indoctum definitionem. Ad per consetetur comprehensam. Quando essent efficiendi vel ex, pri cetero fierent volutpat no, mei facilis admodum cu. Ne pri postea suscipiantur. Vide prompta eu quo. His omnes vivendum ea, per te maluisset principes definiebas, decore fastidii indoctum ea vel.', NULL, NULL, 'published', NULL, '2014-12-10 13:00:58', '2014-12-10 13:00:58', 1, '', '');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_news_categories`
--

CREATE TABLE IF NOT EXISTS `cms_module_news_categories` (
  `news_category_id` int(11) NOT NULL,
  `news_category_name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `hierarchy` varchar(255) DEFAULT NULL,
  `long_name` text,
  `create_date` time DEFAULT NULL,
  `modified_date` time DEFAULT NULL,
  PRIMARY KEY (`news_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_news_categories`
--

INSERT INTO `cms_module_news_categories` (`news_category_id`, `news_category_name`, `parent_id`, `hierarchy`, `long_name`, `create_date`, `modified_date`) VALUES
(8, 'lt', -1, '00008', 'lt', '16:59:55', '16:59:55'),
(13, 'en', -1, '00013', 'en', '07:33:13', '07:33:13');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_news_categories_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_news_categories_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_news_categories_seq`
--

INSERT INTO `cms_module_news_categories_seq` (`id`) VALUES
(17);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_news_fielddefs`
--

CREATE TABLE IF NOT EXISTS `cms_module_news_fielddefs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `max_length` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL,
  `public` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_news_fielddefs`
--

INSERT INTO `cms_module_news_fielddefs` (`id`, `name`, `type`, `max_length`, `create_date`, `modified_date`, `item_order`, `public`) VALUES
(1, 'Nuotrauka', 'file', 255, '2013-07-17 16:58:29', '2014-03-29 23:18:24', 2, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_news_fieldvals`
--

CREATE TABLE IF NOT EXISTS `cms_module_news_fieldvals` (
  `news_id` int(11) NOT NULL,
  `fielddef_id` int(11) NOT NULL,
  `value` text,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`news_id`,`fielddef_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_news_fieldvals`
--

INSERT INTO `cms_module_news_fieldvals` (`news_id`, `fielddef_id`, `value`, `create_date`, `modified_date`) VALUES
(82, 1, 'Koala.jpg', '2014-12-10 12:59:08', '2014-12-10 12:59:08'),
(85, 1, 'Chrysanthemum.jpg', '2014-12-10 13:00:36', '2014-12-10 13:00:36');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_news_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_news_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_news_seq`
--

INSERT INTO `cms_module_news_seq` (`id`) VALUES
(86);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_nms_mails`
--

CREATE TABLE IF NOT EXISTS `cms_module_nms_mails` (
  `jobid` int(11) NOT NULL,
  `messageid` int(11) NOT NULL,
  `email` varchar(125) NOT NULL,
  `uniqueid` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `senddate` int(11) DEFAULT NULL,
  `extra` text,
  PRIMARY KEY (`jobid`,`messageid`,`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_nms_mails`
--

INSERT INTO `cms_module_nms_mails` (`jobid`, `messageid`, `email`, `uniqueid`, `username`, `status`, `senddate`, `extra`) VALUES
(2, 1, 'l.slionskis@gmail.com', 'a2030bf1a6a004385d5eb34d077ec635', 'test', 'sent', 1361359011, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products`
--

CREATE TABLE IF NOT EXISTS `cms_module_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) DEFAULT NULL,
  `details` text,
  `price` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `taxable` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `sku` varchar(25) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_name` (`product_name`),
  KEY `products_status` (`status`),
  KEY `products_price` (`price`),
  KEY `products_dates` (`create_date`,`modified_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_attribsets`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_attribsets` (
  `attrib_set_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attrib_set_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`attrib_set_id`,`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_attribsets`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_attributes`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_attributes` (
  `attrib_id` int(11) NOT NULL AUTO_INCREMENT,
  `attrib_set_id` int(11) NOT NULL,
  `attrib_text` varchar(255) NOT NULL,
  `attrib_adjustment` varchar(50) DEFAULT NULL,
  `sku` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`attrib_id`,`attrib_set_id`,`attrib_text`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_attributes`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_categories`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_cat_name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_categories`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_category_fields`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_category_fields` (
  `category_id` int(11) DEFAULT NULL,
  `field_type` varchar(20) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_prompt` varchar(255) DEFAULT NULL,
  `field_value` text,
  `field_order` int(11) DEFAULT NULL,
  KEY `products_cat_fld_name` (`category_id`,`field_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_category_fields`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_fielddefs`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_fielddefs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `prompt` varchar(255) DEFAULT NULL,
  `prompts` text,
  `type` varchar(50) DEFAULT NULL,
  `max_length` int(11) DEFAULT NULL,
  `options` text,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL,
  `public` int(11) DEFAULT NULL,
  `optionslng` text,
  `requ_lang` int(4) DEFAULT NULL,
  `group` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_flddef_name` (`name`),
  KEY `products_flddef_type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_fielddefs`
--

INSERT INTO `cms_module_products_fielddefs` (`id`, `name`, `prompt`, `prompts`, `type`, `max_length`, `options`, `create_date`, `modified_date`, `item_order`, `public`, `optionslng`, `requ_lang`, `group`) VALUES
(20, 'pavadinimas', 'Pavadinimas', 'a:1:{s:2:"lt";s:11:"Pavadinimas";}', 'textbox', 255, '', '2014-07-30 08:38:27', '2014-07-30 08:43:48', 0, 1, NULL, 1, ''),
(57, 'nuotrauka1', 'Nuotrauka', 'a:1:{s:2:"lt";s:9:"Nuotrauka";}', 'image', 255, '', '2014-07-30 08:42:25', '2014-07-30 08:43:36', 1, 1, NULL, 0, ''),
(77, 'aprasymas', 'Aprašymas', 'a:2:{s:2:"lt";s:10:"Aprašymas";s:2:"en";s:0:"";}', 'textarea', 255, '', '2014-08-12 14:12:50', '2014-11-17 13:10:12', 2, 1, NULL, 0, ''),
(83, 'technical', 'Techniniai duomenys', 'a:2:{s:2:"lt";s:19:"Techniniai duomenys";s:2:"en";s:0:"";}', 'textarea_multi', 255, '', '2014-08-25 14:26:36', '2014-11-17 13:10:01', 3, 1, NULL, 0, '');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_fieldtohier`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_fieldtohier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `hier_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`,`hier_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=557 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_fieldtohier`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_fieldvals`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_fieldvals` (
  `product_id` int(11) DEFAULT NULL,
  `fielddef_id` int(11) DEFAULT NULL,
  `value` text,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `value_20` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value_57` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value_77` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value_83` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_fieldvals`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_hierarchy`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_hierarchy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `parent_id` int(11) DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL,
  `hierarchy` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `long_name` text,
  `description` text,
  `extra1` text,
  `extra2` varchar(255) DEFAULT NULL,
  `name2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `image2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `redirect_to` int(11) NOT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `show_hier_page` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_hier_parent` (`parent_id`),
  KEY `products_hier_hierarchy` (`hierarchy`),
  KEY `show_hier_page` (`show_hier_page`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_hierarchy`
--

INSERT INTO `cms_module_products_hierarchy` (`id`, `name`, `parent_id`, `item_order`, `hierarchy`, `image`, `long_name`, `description`, `extra1`, `extra2`, `name2`, `image2`, `description2`, `redirect_to`, `file`, `show_hier_page`) VALUES
(1, 'a:2:{s:2:"lt";s:12:"Kategorija 1";s:2:"en";s:0:"";}', -1, 1, '00001', '', 'Kategorija 1', 'a:2:{s:2:"lt";s:0:"";s:2:"en";s:0:"";}', 'a:2:{s:2:"lt";s:0:"";s:2:"en";s:0:"";}', '', 'N;', '', 'N;', -1, '', 0),
(2, 'a:2:{s:2:"lt";s:12:"Kategorija 2";s:2:"en";s:0:"";}', -1, 1, '00001', '', 'Kategorija 2', 'a:2:{s:2:"lt";s:0:"";s:2:"en";s:0:"";}', 'a:2:{s:2:"lt";s:0:"";s:2:"en";s:0:"";}', '', 'N;', '', 'N;', -1, '', 0),
(3, 'a:2:{s:2:"lt";s:12:"Kategorija 3";s:2:"en";s:0:"";}', -1, 2, '00002', '', 'Kategorija 3', 'a:2:{s:2:"lt";s:0:"";s:2:"en";s:0:"";}', 'a:2:{s:2:"lt";s:0:"";s:2:"en";s:0:"";}', '', 'N;', '', 'N;', -1, '', 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_hierarchy_linknames`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_hierarchy_linknames` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hier_id` bigint(20) NOT NULL,
  `lang` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hier_id` (`hier_id`,`lang`,`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_hierarchy_linknames`
--

INSERT INTO `cms_module_products_hierarchy_linknames` (`id`, `hier_id`, `lang`, `alias`) VALUES
(1, 1, 'lt', 'kategorija-1'),
(2, 1, 'en', ''),
(3, 2, 'lt', 'kategorija-2'),
(4, 2, 'en', ''),
(5, 3, 'lt', 'kategorija-3'),
(6, 3, 'en', '');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_hierordering`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_hierordering` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hier_id` (`hier_id`,`product_id`,`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_hierordering`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_images_temp`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_images_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`,`field_id`,`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_images_temp`
--

INSERT INTO `cms_module_products_images_temp` (`id`, `product_id`, `field_id`, `value`, `ordering`) VALUES
(21, '75a80a635cd42024d9bf6de04018ae35', 57, '/uploads/Products/product_75a80a635cd42024d9bf6de04018ae35/l18t_1412059480.jpg', 0),
(36, '4563c1dfccd26aa2a02134e88bdce111', 57, '/uploads/Products/product_4563c1dfccd26aa2a02134e88bdce111/a58-ak58_1412079931.jpg', 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_prodtohier`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_prodtohier` (
  `product_id` int(11) NOT NULL,
  `hierarchy_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`hierarchy_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_prodtohier`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_product_categories`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_product_categories` (
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  KEY `products_prod_cat` (`product_id`,`category_id`),
  KEY `products_cat_prod` (`category_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_product_categories`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_products_taglist`
--

CREATE TABLE IF NOT EXISTS `cms_module_products_taglist` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Sukurta duomenų kopija lentelei `cms_module_products_taglist`
--

INSERT INTO `cms_module_products_taglist` (`id`, `name`, `value`) VALUES
(6, 'uber', 'a:2:{i:8;s:2:"16";i:13;s:2:"14";}'),
(9, 'tera', 'a:1:{i:13;s:2:"14";}'),
(14, 'super', 'a:4:{i:1;s:2:"16";i:7;s:2:"14";i:8;s:2:"15";i:9;s:2:"17";}'),
(15, 'fupper', 'a:6:{i:0;s:2:"16";i:3;i:18;i:4;s:2:"14";i:5;s:2:"15";i:6;s:2:"17";i:7;s:2:"20";}');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_search_index`
--

CREATE TABLE IF NOT EXISTS `cms_module_search_index` (
  `item_id` int(11) DEFAULT NULL,
  `word` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  KEY `cms_index_search_count` (`count`),
  KEY `cms_index_search_index` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_search_index`
--

INSERT INTO `cms_module_search_index` (`item_id`, `word`, `count`) VALUES
(1, 'navigation', 1),
(1, 'news', 1),
(3, 'navigation', 1),
(3, 'news', 1),
(5, 'navigation', 1),
(5, 'news', 1),
(35, 'navigation', 1),
(35, 'news', 1),
(37, 'navigation', 1),
(37, 'news', 1),
(39, 'content', 1),
(39, 'management', 1),
(39, 'system', 1),
(39, 'way', 1),
(39, 'meant', 1),
(41, 'horizontal', 1),
(41, 'ruler', 1),
(41, 'hidden', 1),
(41, 'visual', 1),
(41, 'browsers', 1),
(41, 'css', 1),
(41, 'navigation', 2),
(41, 'sub', 1),
(41, 'news', 1),
(2837, 'texus', 1),
(1613, 'projektai', 1),
(1645, 'fgvdfg', 1),
(1627, 'html', 1),
(1627, 'min', 1),
(1627, 'width', 1),
(1627, '1068px', 1),
(1627, 'projektai', 1),
(1627, 'atgal', 1),
(1627, 'projekto', 1),
(1627, 'pavadinimas', 1),
(1627, 'slėpti', 1),
(1627, 'filtrą', 1),
(1627, 'veikla', 2),
(1627, 'vedinimas', 5),
(1627, 'plotas', 2),
(1627, '1000', 5),
(1627, 'metai', 2),
(1627, '2013', 1),
(1627, 'paskirtis', 2),
(1627, 'prekybos', 2),
(1627, 'statusas', 2),
(1627, 'vykdomi', 1),
(1627, '&nbsp', 1),
(1627, 'filtruoti', 1),
(1627, 'senesni', 2),
(1627, 'rangovas', 1),
(1627, 'snow', 1),
(1627, 'arena', 1),
(1627, 'miestas', 1),
(1627, 'druskininkai', 1),
(1627, '2012', 1),
(1627, '100', 1),
(1627, 'pastato', 1),
(1627, 'centras', 1),
(1627, 'atlikta', 1),
(1627, 'vykdomas', 1),
(1627, 'atliktų', 1),
(1627, 'darbų', 1),
(1627, 'aprašymas', 1),
(1627, 'lorem', 1),
(1627, 'ipsum', 1),
(1627, 'dolor', 2),
(1627, 'sit', 1),
(1627, 'amet', 1),
(1627, 'consectetur', 1),
(1627, 'adipisicing', 1),
(1627, 'elit', 1),
(1627, 'sed', 1),
(1627, 'eiusmod', 1),
(1627, 'tempor', 1),
(1627, 'incididunt', 1),
(1627, 'labore', 1),
(1627, 'dolore', 2),
(1627, 'magna', 1),
(1627, 'aliqua', 1),
(1627, 'enim', 1),
(1627, 'minim', 1),
(1627, 'veniam', 1),
(1627, 'quis', 1),
(1627, 'nostrud', 1),
(1627, 'exercitation', 1),
(1627, 'ullamco', 1),
(1627, 'laboris', 1),
(1627, 'nisi', 1),
(1627, 'aliquip', 1),
(1627, 'commodo', 1),
(1627, 'consequat', 1),
(1627, 'duis', 1),
(1627, 'aute', 1),
(1627, 'irure', 1),
(1627, 'reprehenderit', 1),
(1627, 'voluptate', 1),
(1627, 'velit', 1),
(1627, 'esse', 1),
(1627, 'cillum', 1),
(1642, 'atgal', 1),
(1642, '1068px', 1),
(1642, 'width', 1),
(1642, 'min', 1),
(1642, 'html', 1),
(1637, 'atgal', 1),
(1637, '1068px', 1),
(1637, 'width', 1),
(1637, 'min', 1),
(1637, 'html', 1),
(1648, 'aaa', 1),
(3265, 'dell’acquisto', 1),
(2913, 'help', 1),
(2913, 'offers', 1),
(2913, 'gallery', 2),
(2913, 'module', 3),
(2913, 'uploaded', 1),
(2913, 'images', 2),
(2913, 'uploads', 1),
(2913, 'folder', 1),
(2913, 'will', 1),
(2913, 'see', 1),
(2913, 'can', 1),
(2913, 'edit', 1),
(2913, 'titles', 1),
(2913, 'descriptions', 1),
(2913, 'thumbnail', 1),
(2913, 'sizes', 1),
(2913, 'admin', 1),
(2913, 'section', 1),
(2913, 'check', 1),
(2913, 'features', 1),
(2913, 'installing', 1),
(2913, 'galerija', 1),
(2913, 'thank', 1),
(3265, 'risponde', 1),
(3265, 'iveco', 14),
(3265, 'nuovo', 1),
(3265, 'veicolo', 5),
(3265, 'alternativa', 1),
(3265, 'valida', 2),
(3265, 'ad440s43t_p_hr', 1),
(3265, 'ad440s40t_p', 1),
(3265, 'ad260s43y_ps', 1),
(3265, 'ml75e17p', 1),
(3265, 'ml75ei7', 2),
(3265, 'p_1', 1),
(3265, 'ml80e18', 3),
(3265, 'ml80e18fp', 1),
(3265, 'ml80e18p', 1),
(3265, 'fp_1', 2),
(3265, 'ml80e21', 2),
(3265, 'ml80e21fp', 1),
(3265, 'ml80e21p', 1),
(3265, 'ml90e18', 3),
(3265, 'ml90e18fp', 1),
(3265, 'ml90e18p', 1),
(3265, 'ml90e21', 1),
(3265, 'ml100e18', 1),
(3265, 'ml100e18_k', 1),
(3265, 'ml100e21', 1),
(3265, 'ml100e21_k', 1),
(3265, 'ml120e18', 2),
(3265, 'ml120e18_1', 1),
(3265, 'ml120e18_k', 1),
(3265, 'ml120e18fp', 1),
(3265, 'ml120e18p', 1),
(3265, 'ml120e24', 1),
(3265, 'ml120e24fp', 1),
(3265, 'ml120e24p', 1),
(3265, 'ml150e18', 1),
(3265, 'ml150e18p', 1),
(3265, 'ml180e24', 1),
(3265, 'ml180e24p', 1),
(3265, 'mli20e24', 1),
(3265, 'mli50e18', 1),
(3265, 'mli80e24_p_', 1),
(3265, 'stralis', 2),
(3265, 'ad190s35', 1),
(3265, 'ad190s43', 1),
(2857, 'savybės', 1),
(2480, 'prekes', 2),
(2480, 'pateikiame', 1),
(2480, 'iš', 1),
(2480, 'karto', 1),
(2480, 'pristatome', 1),
(2480, 'bet', 2),
(2480, 'kurią', 2),
(2480, 'vietą', 2),
(2480, 'salone', 1),
(2480, 'turime', 1),
(2480, 'didelius', 1),
(2480, 'kiekius', 1),
(2480, 'visų', 1),
(2480, 'spalvų', 1),
(2480, 'formų', 1),
(2480, 'prekių', 1),
(2480, 'todėl', 1),
(2480, 'iškart', 1),
(2480, 'galėsime', 1),
(2480, 'įvykdyti', 1),
(2480, 'jūsų', 1),
(2480, 'užsakymą', 1),
(2480, 'jums', 2),
(2480, 'pageidaujant', 1),
(2480, 'atvešime', 1),
(2480, 'reikiamą', 1),
(3265, 'contatterà', 1),
(3265, 'esperto', 1),
(3265, 'nostro', 2),
(3265, 'recapito', 1),
(3265, 'tuo', 2),
(3265, 'lasciaci', 1),
(3265, 'informazioni', 1),
(3265, 'richiesta', 1),
(3265, '2em', 1),
(3265, 'height', 1),
(3265, 'line', 1),
(3265, 'content', 1),
(3265, 'article', 1),
(3265, 'none', 1),
(3265, 'display', 1),
(3265, 'iframe', 1),
(3265, 'mp4downloader_btnforiframe', 1),
(3265, 'boxes', 2),
(3265, 'vendita', 1),
(3265, '​una', 1),
(3265, 'subtitlehtml', 1),
(3265, 'consegna', 3),
(3265, 'pronta', 3),
(3265, 'usati', 3),
(3265, 'industriali', 1),
(3265, 'commerciali', 1),
(3265, 'veicoli', 6),
(3265, 'plus', 11),
(3265, 'usato', 18),
(3265, '​iveco', 1),
(3265, 'pagetitlehtml', 1),
(3265, 'presto', 1),
(3265, 'più', 2),
(3265, 'risponderà', 1),
(3265, 'incaricato', 1),
(3265, 'contattato', 1),
(3265, 'averci', 1),
(3265, 'grazie', 1),
(3265, 'errore', 1),
(3265, 'verificato', 1),
(3265, 'invia', 1),
(3265, 'obbligatori', 1),
(3265, 'campi', 1),
(3265, 'informativa', 2),
(3265, 'privacy', 2),
(3265, 'post', 1),
(3265, 'servizi', 1),
(3265, 'used', 1),
(3265, 'sito', 1),
(3265, 'vai', 1),
(3265, 'rateale', 1),
(3265, 'leasing', 1),
(3265, 'finanziamenti', 1),
(3265, 'raggiungerci', 1),
(3265, 'storia', 1),
(3265, 'siamo', 1),
(3265, 'chi', 1),
(3265, 'cc7c814cd319', 4),
(3265, '37b2', 4),
(3265, '8089', 4),
(3265, '69d6', 4),
(3265, 'd4b3a69c', 4),
(3265, 'correlation', 4),
(3265, 'safe', 4),
(3265, 'registered', 4),
(3265, 'found', 4),
(3265, 'could', 4),
(3265, 'type', 4),
(3265, 'ml75e17', 1),
(3265, 'ml75e15p', 1),
(3265, 'ml75e15_1', 1),
(3265, 'ml75e15', 1),
(3265, 'ml65ei5', 1),
(3265, 'ml65e15p', 1),
(3265, 'ml65e15', 1),
(3265, 'mod_65c15', 1),
(3265, 'medi', 2),
(3265, 'medium', 2),
(3265, 'ml65e13', 2),
(3265, 'ml65e13p', 1),
(3265, 'momento', 1),
(3265, 'accreditate', 1),
(3265, 'delle', 2),
(3265, 'dei', 2),
(3265, 'specialisti', 1),
(3265, 'agli', 1),
(3265, 'rivolgendosi', 1),
(3265, 'garanzia', 4),
(3265, 'può', 1),
(3265, 'richiedere', 1),
(3265, 'cliente', 1),
(3265, 'controlli', 2),
(3265, 'attenti', 1),
(3265, 'rigorosi', 1),
(3265, 'proporre', 1),
(3265, 'clienti', 2),
(3265, 'prodotto', 2),
(3265, 'sicuro', 1),
(3265, 'assolutamente', 1),
(3447, '#page', 1),
(3636, 'tiekia', 1),
(3636, 'koordinatines', 1),
(3636, 'mašinas', 1),
(3569, 'susisieksime', 1),
(3569, 'jumis', 1),
(3569, 'mes', 1),
(3569, 'formą', 1),
(3569, 'karjeros', 1),
(3569, 'šią', 1),
(3569, 'užpildykite', 1),
(3569, 'prašome', 1),
(3569, 'narių', 1),
(3569, 'komandos', 1),
(3569, 'naujų', 1),
(3569, 'ieško', 1),
(3569, 'nuolatos', 1),
(3569, 'įmonė', 1),
(3569, 'mūsų', 1),
(4634, 'haba', 1),
(4634, 'swedbank', 1),
(4634, 'cbvi', 1),
(4634, 'swift', 2),
(4634, '8032', 2),
(4634, '0112', 2),
(4521, 'susisieksime', 1),
(4839, 'užsiduotą', 1),
(3636, 'kompanijas', 1),
(4296, 'mus', 1),
(4296, 'kreipkitės', 1),
(4296, 'nedvejokite', 1),
(4296, 'pagalbos', 1),
(4441, 'parsisiųsti', 2),
(4426, 'parsisiųsti', 2),
(4905, 'teritory', 4),
(4905, 'operating', 4),
(4426, 'gratings', 1),
(4426, 'scale', 1),
(4426, 'glass', 1),
(4426, '2014', 1),
(4848, 'panaudojimo', 2),
(5063, 'reticles', 1),
(4848, 'užtikrina', 1),
(4848, 'koeficientą', 2),
(4848, 'aukštesnį', 2),
(4848, 'užtikrinant', 1),
(4848, 'būdu', 1),
(4848, 'tokiu', 1),
(4848, 'naudai', 1),
(4848, 'vartotojo', 1),
(4751, 'sek', 1),
(4751, '±0', 1),
(4751, 'rastrinio', 1),
(4751, 'disko', 1),
(3617, 'partneriai', 4),
(4442, 'parsisiųsti', 2),
(4751, 'naujas', 3),
(4751, 'Čia', 1),
(4751, 'produktą', 1),
(3265, 'autocarro', 1),
(3265, 'mod_59', 1),
(3265, 'mod_50c13', 2),
(3265, 'mod_49', 2),
(3265, 'mod_35s13', 1),
(3265, 'mod_35s11', 1),
(3265, 'affidabile', 1),
(3265, 'sottoposti', 2),
(3265, 'tutto', 1),
(3265, 'massima', 1),
(3265, 'scelta', 1),
(3265, 'opzioni', 1),
(3265, 'finanziamento', 2),
(3265, 'garanzie', 1),
(3265, 'riconosciute', 1),
(3265, 'dalla', 1),
(3265, 'rete', 3),
(3265, 'ufficiale', 1),
(3265, 'sono', 2),
(3265, 'disponibili', 1),
(3265, 'presso', 1),
(3265, 'centri', 2),
(3265, 'concessionarie', 3),
(3265, 'disponibilità', 1),
(3265, 'offerte', 1),
(3265, 'possono', 1),
(3265, 'essere', 2),
(3265, 'verificate', 1),
(3265, 'via', 1),
(3265, 'web', 13),
(3265, 'marchio', 1),
(3265, 'vengono', 1),
(3265, 'identificati', 1),
(3265, 'recente', 1),
(3265, 'immatricolazione', 1),
(3265, 'pochi', 1),
(3265, 'chilometri', 1),
(2837, 'pilna', 1),
(2837, 'svetainės', 1),
(2837, 'versija', 1),
(3265, 'textcenter', 1),
(3265, 'qualità', 1),
(3265, 'mezzi', 1),
(3265, 'offerta', 1),
(3265, 'un’articolata', 1),
(3265, 'con', 6),
(3265, 'esigenza', 1),
(3265, 'questa', 1),
(4521, 'jumis', 1),
(4521, 'mes', 1),
(4634, '0600', 2),
(4634, '7044', 2),
(4634, 'lt96', 2),
(4634, 'iban', 2),
(4634, 'sąskaita', 2),
(4634, 'bankas', 1),
(4634, 'seb', 1),
(4634, 'lt100179515', 1),
(4634, 'mokėtojo', 1),
(3265, 'imported', 4),
(3265, 'displayed', 4),
(3265, 'cannot', 4),
(3265, 'page', 4),
(3265, 'control', 4),
(3265, 'form', 4),
(3265, 'error', 4),
(3265, 'part', 8),
(3265, 'mondo', 1),
(3265, 'iscriviti', 1),
(3265, 'novità', 1),
(3265, 'ultime', 1),
(3265, 'sulle', 1),
(3265, 'aggiornato', 1),
(3265, 'sempre', 1),
(3265, '​tieniti', 1),
(3265, 'newsletter', 1),
(3265, 'cerca', 2),
(3265, 'bus', 1),
(3265, 'concessionario', 1),
(3265, 'trova', 1),
(3265, 'trakker', 1),
(3265, 'eurocargo', 1),
(3636, 'detalių', 1),
(4442, 'pavadinimas', 1),
(3265, 'daily', 1),
(3265, 'new', 3),
(3265, 'seleziona', 1),
(3265, 'disponibile', 1),
(3265, 'verifica', 1),
(3265, 'preciso', 1),
(3265, 'mente', 1),
(3265, 'nostra', 1),
(3265, 'mod_35s9', 1),
(3265, 'come', 2),
(3265, 'marketing', 1),
(3265, 'finalità', 1),
(3265, 'trattati', 1),
(3265, 'siano', 1),
(3265, 'dati', 1),
(3265, 'miei', 1),
(3265, 'che', 2),
(3265, 'accetto', 1),
(3265, 'migliore', 1),
(3265, 'soluzione', 1),
(3265, 'capire', 1),
(3265, 'mod_35c15', 1),
(3265, 'mod_35c13', 3),
(3265, 'mod_35c11', 3),
(3265, 'cabinato', 5),
(3265, 'mod_35c9', 1),
(3265, 'furgone', 10),
(3265, 'mod_29l9v', 1),
(3265, 'doppia', 3),
(3265, 'cabina', 3),
(3265, 'mod_29l9', 1),
(3265, 'leggeri', 1),
(3265, 'mp720e48ht', 1),
(3265, 'mp720e44ht', 1),
(3265, 'mp720e42_ht', 1),
(3265, 'mp720e37_42_47ht', 1),
(3265, 'mp410e44h', 1),
(3265, 'mp410e42_h_', 1),
(3265, 'mp410e38h', 1),
(3265, 'mp410e37_h', 1),
(3265, 'mp380e_42h', 1),
(3265, 'mp380e44h', 1),
(3265, 'mp380e38h', 1),
(3265, 'mp380e37_h', 1),
(3265, 'eurotrakker', 1),
(3265, 'mp440e43t_p_m16', 1),
(3265, 'mp440e43t_p_eurotr', 1),
(3265, 'mp440e42t_p', 1),
(3265, 'aiutarti', 1),
(3265, 'per', 7),
(3636, 'kitus', 1),
(4838, 'skatinimas', 2),
(4838, 'Įmonės', 2),
(4838, 'optimistiškai', 1),
(4838, 'nuteikia', 1),
(4838, 'rezultatai', 1),
(4838, 'pirmieji', 1),
(4838, 'įvykdyti', 1),
(4838, 'sėkmingai', 1),
(4838, 'bus', 1),
(4838, 'įsipareigojimai', 1),
(4838, 'šie', 1),
(4838, 'tikimės', 1),
(4838, 'jau', 1),
(4838, 'esamas', 1),
(4838, 'išplėsti', 1),
(4838, 'segmentus', 1),
(4838, 'vartotojų', 1),
(4838, 'arba', 1),
(4838, 'sektorius', 1),
(4838, 'ūkio', 1),
(4838, 'šalis', 1),
(4838, 'rinkas', 2),
(4838, 'naujas', 2),
(4838, 'produkciją', 1),
(4838, 'pagamintą', 1),
(4838, 'savo', 1),
(4838, 'eksportuoti', 1),
(4838, 'įgyvendinimo', 1),
(4838, 'įsipareigojo', 1),
(4838, 'rodikliuose', 1),
(4838, 'stebėsenos', 1),
(4838, 'projekto', 2),
(4838, 'plėtimas', 1),
(4838, 'užduotis', 1),
(4838, 'pagrindinė', 1),
(4838, 'kurio', 1),
(4838, 'įkurtas', 1),
(4838, '–', 1),
(4838, 'struktūroje', 1),
(4838, 'organizacinėje', 1),
(4838, 'atsispindėjo', 1),
(4838, 'eksportą', 1),
(4838, 'plėsti', 1),
(4838, 'siekis', 1),
(4838, 'poreikius', 1),
(4838, 'rinkos', 1),
(4838, 'atitinkančius', 1),
(4838, 'geriau', 1),
(4838, 'produktus', 1),
(4838, 'lazerinę', 1),
(4838, 'technologiją', 1),
(4838, 'metalinių', 1),
(4838, 'pavyzdžiui', 1),
(4838, 'procesus', 1),
(4838, 'technologinius', 1),
(4838, 'kurti', 2),
(4838, 'specialistus', 1),
(4838, 'paskatino', 1),
(4838, 'tai', 1),
(4838, 'poreikiais', 1),
(4838, 'naujais', 1),
(4838, 'naujovėmis', 1),
(4838, 'betarpiškai', 1),
(4442, 'gratings', 1),
(4442, 'scale', 1),
(4442, 'glass', 1),
(4442, 'nuotraukos', 4),
(4442, 'produktų', 4),
(4495, 'diametro', 1),
(4495, '200', 1),
(4495, 'diskus', 1),
(4495, 'apvalius', 1),
(4495, 'ilgio', 1),
(4495, 'iki', 2),
(4495, '3400', 1),
(4495, 'skales', 1),
(4495, 'linijines', 1),
(4495, 'kaip', 1),
(4495, 'pateikiame', 1),
(4495, 'aptikimo', 1),
(4495, 'sistemas', 1),
(4495, 'individualias', 1),
(4495, 'sukurtų', 1),
(4296, 'reikia', 1),
(4296, 'jums', 2),
(4296, 'pagelbėti', 1),
(4296, 'jeigu', 1),
(4296, 'susidūrėte', 1),
(3636, 'garso', 1),
(5063, 'discs', 1),
(4943, '495', 1),
(4942, 'possible', 1),
(4942, 'soon', 1),
(4942, 'help', 1),
(4942, 'best', 1),
(4942, 'will', 1),
(4833, '„umega“', 1),
(4833, 'aurida“', 1),
(4636, 'žengti', 1),
(4636, 'pirmyn', 1),
(4947, '507', 1),
(4947, 'parsisiųsti', 4),
(4441, 'pavadinimas', 1),
(4441, 'gratings', 1),
(4441, 'scale', 1),
(3707, 'šią', 1),
(3707, 'užpildykite', 1),
(3707, 'norėtumėte', 1),
(3707, 'mūsų įmone', 1),
(3707, 'susidomėjote', 1),
(3707, 'jeigu', 1),
(3707, 'partnerių', 1),
(3707, 'naujų', 1),
(3636, 'pasaulinio', 1),
(3636, 'atstovauja', 1),
(3636, 'šalyse', 1),
(4495, 'kad', 1),
(3424, 'dsum', 1),
(3424, 'dolor', 1),
(3424, 'sit', 1),
(3424, 'amet', 1),
(3424, 'consectetur', 1),
(3424, 'adipisicing', 1),
(3424, 'elit', 1),
(3424, 'sed', 1),
(3424, 'eiusmod', 1),
(3424, 'tempor', 1),
(3424, 'incididunt', 1),
(3424, 'labore', 1),
(3424, 'dolore', 1),
(3424, 'magna', 1),
(3424, 'aliqua', 1),
(3424, 'enim', 1),
(3424, 'minim', 1),
(3424, 'veniam', 1),
(3424, 'quis', 1),
(3424, 'darbas', 1),
(3424, 'anionas', 1),
(3424, 'įmonėse', 1),
(3424, 'sveikata', 1),
(3424, 'sauga', 1),
(3424, 'Šiuo', 1),
(3424, 'metu', 1),
(3424, 'reikalingi', 1),
(3636, 'baltijos', 1),
(3636, 'specialius', 1),
(3636, 'turinčius', 1),
(4838, 'susipažinti', 1),
(3636, 'sukurti', 1),
(3636, 'serijiškumui', 1),
(3636, 'užsakymų', 1),
(3265, 'mp440e38t_p', 1),
(3265, 'mp260e43y_ps_cab_lunga_1', 1),
(3265, 'mp260e43y_ps', 1),
(3265, 'mp190e42', 1),
(3265, '1998', 1),
(3265, 'presidia', 1),
(3265, 'flusso', 1),
(3265, 'nel', 1),
(3265, 'mezzogiorno', 1),
(3265, 'leggi', 1),
(3265, 'schede', 1),
(3265, 'tecniche', 1),
(3265, 'eurostar', 1),
(3265, 'ld440e48t', 1),
(3265, 'ld440e48t_p_m16', 1),
(3265, 'ld440e48t_p', 1),
(3265, 'ld440e47t_p_m16', 1),
(3265, 'ld440e43t_p_m16', 1),
(3265, 'ld440e43t_p', 1),
(3265, 'ld440e42t_p', 1),
(3265, 'ld260e48y_ps', 1),
(3265, 'ld260e43y_ps', 1),
(3265, 'ld240e42ps', 1),
(3265, 'ld190e42_p', 1),
(3265, 'eurotech', 1),
(3265, 'mh190e27_m16', 1),
(3265, 'mh190e31', 1),
(3265, 'mh190e35', 1),
(3265, 'mh190e35_fp_cm', 1),
(3265, 'mh260e27y_ps', 1),
(3265, 'mh260e35y_ps_m16', 1),
(3265, 'mh260e35y_ps_m16_cl', 1),
(3265, 'mh440e35t_p', 1),
(3265, 'mp190e40_p_m16', 1),
(3265, 'mp190e40', 1),
(3636, 'nedideliam', 1),
(3636, 'esant', 1),
(3265, 'hai', 1),
(3265, 'gamma', 1),
(3265, 'già', 2),
(3265, '​conosci', 1),
(3265, 'tutte', 1),
(3265, 'vedi', 1),
(3265, 'at720t48t', 1),
(3265, 'at440s43t_p_1', 1),
(3265, 'lt_1', 1),
(3265, 'at440s40t_fp', 1),
(3265, 'at410t38', 1),
(3265, 'at260s43y_ps_1', 1),
(3265, 'at190s43p_1', 1),
(3265, 'as440s48t_p', 1),
(3265, 'as440s43t_p', 1),
(3265, 'as440s43t_fp_lt', 1),
(3265, 'as260s48y_pt', 1),
(3265, 'as260s43y_pt', 1),
(3636, 'net', 1),
(3636, 'keisti', 1),
(3636, 'užsakovų', 1),
(3636, 'reaguoti', 1),
(3636, 'lanksčiai', 1),
(3636, 'bet', 1),
(3636, 'sertifikatus', 1),
(3636, 'kalibravimo', 1),
(3636, 'patiekti', 1),
(3636, 'kokybę', 1),
(3636, 'aukštą', 1),
(4942, 'right', 1),
(3581, '444', 1),
(3581, 'servisas', 4),
(3265, 'as190s48_p', 1),
(3265, 'as190s43_p', 1),
(3265, 'ad720t48t', 1),
(4495, 'tam', 1),
(4495, 'elektroniką', 1),
(4495, 'įrenginį', 1),
(4495, 'skanavimo', 1),
(4838, 'klientais', 1),
(4771, '470', 1),
(4771, 'Įvykiai', 4),
(3265, 'dal', 1),
(3265, 'operativa', 1),
(3265, 'dirette', 1),
(3265, 'trattative', 1),
(3265, 'alle', 1),
(3265, 'grandi', 1),
(3265, 'rapporto', 1),
(3265, 'particolare', 1),
(3265, 'tutta', 1),
(3265, 'dedicata', 1),
(3265, 'coordina', 1),
(3265, 'attività', 2),
(3265, 'sede', 2),
(3265, 'bari', 2),
(3265, 'modugno', 1),
(3265, 'piacenza', 2),
(3265, 'gestite', 1),
(3265, 'direttamente', 1),
(3265, 'sedi', 1),
(3265, 'due', 1),
(3265, 'attraverso', 1),
(3265, 'italia', 1),
(3265, 'opera', 1),
(3265, 'specifici', 1),
(3265, 'usufruiscono', 1),
(3265, 'funzionanti', 1),
(3265, 'perfettamente', 1),
(3265, 'dichiarati', 1),
(3265, 'standard', 1),
(3265, 'soddisfare', 1),
(3265, 'marca', 1),
(3265, 'qualsiasi', 1),
(3265, 'mesi', 1),
(3265, 'radiatore', 1),
(3265, 'dell’acqua', 1),
(3265, 'pompa', 1),
(3265, 'scatola', 1),
(3265, 'alloggiamento', 1),
(3265, 'trasmissione', 1),
(3265, 'corpo', 1),
(3265, 'sospensioni', 1),
(3265, 'ponte', 1),
(3265, 'cambio', 2),
(3265, 'motore', 1),
(3265, 'componenti', 1),
(3265, 'principali', 2),
(3265, 'tutti', 1),
(3265, 'copre', 1),
(3265, '​la', 1),
(3265, 'morecontenthtml', 1),
(3265, 'documentazione', 1),
(3265, 'trasparenza', 1),
(3265, 'provenienza', 1),
(3265, 'della', 3),
(3265, 'certezza', 1),
(3265, 'del', 3),
(3265, 'l’affidabilità', 1),
(3265, 'assicura', 1),
(3265, 'acquistare', 1),
(3265, 'anni', 1),
(3265, 'superiore', 1),
(3265, 'non', 1),
(3265, 'anzianità', 1),
(3504, 'produktai', 4),
(4451, 'lithuania', 2),
(4451, 'įrenginiai', 2),
(4451, 'metrologiniai', 2),
(4451, 'preciziniai', 2),
(4452, 'titulinis', 2),
(4636, '                                                  ', 1),
(4636, 'žingsniu', 1),
(4549, '463', 1),
(4549, 'įmonę', 4),
(4549, 'apie', 4),
(3447, 'background', 3),
(3447, 'url', 1),
(3447, 'uploads', 1),
(3447, 'center', 2),
(3447, 'repeat', 1),
(3447, 'size', 1),
(3447, 'cover', 1),
(3447, 'attachment', 1),
(3447, 'fixed', 1),
(3636, 'tik', 1),
(3636, 'užtikrinti', 1),
(3636, 'galimybę', 1),
(3636, 'sudaro', 1),
(3636, 'jai', 1),
(3636, 'tai', 1),
(3636, 'specialistus', 1),
(3636, 'kvalifikacijos', 1),
(3636, 'pasiruošusi', 1),
(3636, 'kontrolei', 1),
(3636, 'įrangą', 1),
(3636, 'reikalingą', 1),
(3636, 'tam', 1),
(3636, 'visą', 1),
(3636, 'susikūrusi', 1),
(3636, 'gamybai', 1),
(3636, 'procesus', 1),
(3636, 'technologinius', 1),
(3636, 'visus', 1),
(3636, 'įsisavinusi', 1),
(3729, '            ', 1),
(3729, '                                                                     ', 1),
(3636, 'liniuotės', 1),
(5003, 'service', 1),
(5003, 'provide', 1),
(5003, 'consult', 1),
(5003, 'addition', 1),
(5003, 'software', 1),
(3729, '   ', 1),
(3729, '             ', 1),
(3729, 'grupė', 4),
(3729, 'precizika', 4),
(4636, 'sėkmingu', 1),
(4636, 'sparčiu', 1),
(4636, 'pat', 1),
(4636, 'tokiu', 1),
(4636, 'linkime', 1),
(4636, 'bei', 1),
(4636, 'kelią', 1),
(4636, 'ilgą', 1),
(4636, 'tokį', 1),
(4636, 'nuėjus', 1),
(4636, 'rezultatus', 1),
(4636, 'sveikiname', 1),
(4636, 'visą', 1),
(4636, 'darbuotojų', 1),
(4632, 'haba', 1),
(4632, 'swedbank', 1),
(4632, 'cbvi', 1),
(4632, 'swift', 2),
(4632, '8032', 2),
(4632, '0112', 2),
(4632, '0600', 2),
(4632, '7044', 2),
(4632, 'lt96', 2),
(4632, 'iban', 2),
(4632, 'sąskaita', 2),
(4632, 'bankas', 1),
(4632, 'seb', 1),
(4632, 'lt100179515', 1),
(4833, '„panevėžio', 1),
(4833, 'metrology”', 1),
(4833, '„precizika', 1),
(4833, 'uab', 3),
(4833, 'sektorius', 1),
(4833, 'gamybos', 1),
(4833, 'mašinų', 1),
(4833, 'elektronikos', 1),
(4833, '2012“', 1),
(4833, 'įmonė', 1),
(4833, '“sėkmingai', 1),
(4206, 'teritorija', 4),
(4206, 'veiklos', 4),
(4833, 'dirbanti', 1),
(4642, 'servisas', 4),
(4642, 'kmm', 4),
(4638, '  ', 1),
(4638, 'video', 4),
(3732, 'teritorija', 4),
(3523, 'naujienos', 1),
(4942, 'form', 1),
(4942, 'fill', 1),
(4942, 'problems', 1),
(4942, 'nesklandumus', 4),
(4942, 'apie', 4),
(4942, 'pranešk', 4),
(4296, 'problemomis', 1),
(4296, 'pasiruošę', 1),
(4296, 'visada', 1),
(4296, 'specialistai', 1),
(4296, 'metrology“', 1),
(4296, '„precizika', 1),
(4296, 'todėl', 1),
(4296, 'klientams', 1),
(4296, 'savo', 1),
(4296, 'servisą', 1),
(4296, 'kokybę', 1),
(4296, 'aukščiausią', 1),
(3707, 'ieško', 1),
(3707, 'plečiasi', 1),
(3707, 'nuolat', 1),
(3707, 'metrology', 1),
(3707, 'precizika', 1),
(3707, 'partneriu', 5),
(3732, 'veiklos', 4),
(3636, 'limbai', 1),
(3636, 'kodinės', 1),
(3636, 'inkrementinės', 1),
(3636, 'rastrinės', 1),
(3636, 'stiklinės', 1),
(3636, 'įtaisai', 1),
(3636, 'rodmenų', 1),
(3636, 'šių', 2),
(3636, 'tiekiami', 1),
(3636, 'gaminiai', 1),
(3636, 'fotoelektriniai', 1),
(3636, 'magnetiniai', 1),
(3636, 'keitikliai', 1),
(3569, 'karjera', 4),
(4553, 'linear', 1),
(4542, 'projektai', 4),
(4542, 'Įgyvendinti', 4),
(3636, 'įmonės', 1),
(3636, 'pagrindiniai', 1),
(3636, 'efektyvumą', 1),
(3636, 'didinti', 1),
(3636, 'patikimumą', 1),
(3636, 'parametrus', 2),
(3636, 'techninius', 1),
(3636, 'gerinti', 1),
(3636, 'siekiami', 1),
(3636, 'kuriais', 1),
(3636, 'tyrimams', 1),
(3636, 'moksliniams', 1),
(3636, 'vystymui', 1),
(3636, 'procesų', 1),
(4632, 'mokėtojo', 1),
(3636, 'technologinių', 1),
(3552, 'naujienos', 4),
(3552, 'produktų', 4),
(4833, 'metais', 1),
(4833, 'veiklą', 1),
(4833, 'sėkmingą', 1),
(4833, 'už', 1),
(4833, 'įmonėms', 1),
(4833, 'atrinktoms', 1),
(4833, 'komisijos', 1),
(4833, 'vertinimo', 1),
(4833, 'įteikė', 1),
(4833, 'apdovanojimus', 1),
(4833, 'gedvilas', 1),
(4833, 'vydas', 1),
(3574, 'naujienos', 4),
(3574, 'Įmonės', 4),
(3636, 'gaminių', 6),
(3636, 'skiriama', 1),
(3636, 'investicijų', 1),
(3636, 'bei', 1),
(3636, 'dėmesio', 1),
(3636, 'daug', 1),
(3636, 'kainą', 1),
(3636, 'optimalią', 1),
(3636, 'ekonomiškai', 1),
(3636, 'už', 1),
(3636, 'laiku', 1),
(3636, 'sutartu', 1),
(3636, 'gaminius', 2),
(3636, 'patarnavimus', 1),
(3636, 'aukštos', 2),
(3577, 'parodos', 4),
(3636, 'tiekti', 1),
(3636, 'nuosekliai', 1),
(3636, 'poreikius', 2),
(3636, 'vartotojų', 1),
(3636, 'tenkinti', 1),
(3636, 'maksimaliai', 1),
(3636, 'tikslas', 1),
(3636, 'Įmonės', 1),
(3636, 'reikalavimus', 2),
(4426, 'catalogue', 1),
(4426, 'general', 1),
(4426, 'katalogai', 4),
(3644, 'projektai', 4),
(3644, 'Įgyvendinti', 4),
(3617, '462', 1),
(3733, '442', 1),
(3733, 'partneriai', 4),
(3636, '2008', 1),
(3636, '9001', 1),
(3636, 'iso', 1),
(3636, 'vykdo', 2),
(3636, 'sistemą', 1),
(3636, 'vadybos', 1),
(3636, 'kokybės', 3),
(3636, 'sertifikuotą', 1),
(3636, 'pagal', 1),
(3636, 'dirba', 1),
(3636, 'įmonė', 1),
(3636, 'metų', 1),
(3636, '2000', 1),
(3636, 'nuo', 1),
(3636, 'srityje', 1),
(3636, 'parametrų', 2),
(3636, 'geometrinių', 2),
(3636, 'įmonėms', 1),
(3636, 'paramą', 1),
(3636, 'teikia', 1),
(3636, 'patirtį', 1),
(3636, 'didelę', 1),
(3636, 'Įmonė', 2),
(3636, 'tiekėja', 1),
(3636, 'rastrų', 1),
(3636, 'sistemų', 1),
(3636, 'matavimo', 6),
(3636, 'poslinkių', 3),
(3636, 'kampinių', 3),
(3636, 'linijinių', 3),
(3636, 'pripažinta', 1),
(3636, 'mastu', 1),
(3636, 'pasauliniu', 1),
(3636, 'yra', 6),
(3636, 'tradicijas', 1),
(3636, 'pramonėje', 1),
(3636, 'diegimo', 1),
(3636, 'gamybos', 2),
(3636, 'kūrimo', 1),
(3636, 'įrenginių', 1),
(3636, 'metrologinių', 1),
(3636, 'precizinių', 1),
(3636, 'siekiančias', 1),
(3636, 'šimtmečio', 1),
(3636, 'pusę', 1),
(3636, 'beveik', 1),
(3636, 'gilias', 1),
(3636, 'turi', 3),
(3636, 'metrology', 2),
(3636, '„precizika', 2),
(3636, 'uab', 2),
(3636, 'įmonę', 4),
(3636, 'apie', 4),
(3636, 'prietaisus', 1),
(3636, 'juos', 1),
(3636, 'instaliuoja', 1),
(3636, 'atlieka', 1),
(3636, 'serviso', 1),
(3636, 'darbus', 1),
(3636, 'moko', 1),
(3636, 'vartotojus', 1),
(3636, 'koordinatinių', 1),
(3636, 'mašinų', 1),
(3636, 'modernizaciją', 1),
(4838, 'skalių', 2),
(4838, 'potencialiais', 1),
(4838, 'ryšius', 1),
(4838, 'naujus', 5),
(4838, 'užmegzti', 1),
(4838, 'leido', 1),
(4838, 'dalyvavimas', 1),
(4838, 'minėtose', 1),
(4838, 'dalyvauti', 1),
(4838, 'sudėtinga', 1),
(4838, 'buvę', 1),
(4838, 'būtų', 1),
(4838, 'įmonei', 1),
(4838, 'pagalbos', 1),
(4838, 'minėtos', 1),
(4838, 'veiklą', 1),
(4838, 'rinką', 2),
(4838, 'šią', 1),
(4838, 'įėjimo', 1),
(4838, 'intensyvią', 1),
(4838, 'vykdo', 1),
(4838, 'skyrius', 2),
(4838, 'komercijos', 2),
(4838, 'įmonės', 3),
(4838, 'kurioje', 1),
(4838, 'naujų', 1),
(4838, 'perspektyviausių', 1),
(4838, 'iš', 1),
(4838, 'viena', 1),
(4838, 'brazilija', 1),
(4838, 'vartotojai', 1),
(4838, 'specialistai', 1),
(4838, 'žymiausi', 1),
(4838, 'susirenka', 1),
(4838, 'naujovės', 1),
(4838, 'srities', 2),
(4838, 'technikos', 1),
(4838, 'šios', 2),
(4838, 'demonstruojamos', 1),
(4838, 'kuriose', 1),
(4838, 'parodų', 1),
(4838, 'pasaulyje', 1),
(4838, 'priemonių', 1),
(4838, 'automatizacijos', 1),
(4838, 'sistemų', 2),
(4838, 'matavimo', 2),
(4838, 'svarbiausių', 1),
(4838, 'didžiausių', 1),
(4838, 'vienos', 1),
(4838, 'jos', 1),
(4838, 'kad', 2),
(4838, 'tuo', 1),
(4838, 'svarbios', 1),
(4838, 'yra', 3),
(4838, 'parodos', 1),
(4838, 'brazilijoje', 1),
(4838, 'paule', 1),
(4838, 'san', 1),
(4838, 'feimafe', 1),
(4838, 'bei', 2),
(4838, 'vokietijoje', 1),
(4838, 'niurnberge', 2),
(4838, '2013', 2),
(4839, 'pasiekti', 1),
(4839, 'būdu', 1),
(4839, 'optimaliu', 1),
(4839, 'padėjęs', 1),
(4839, 'tyrimus', 1),
(4839, 'technologijų', 1),
(4839, 'lazerinių', 1),
(4839, 'reikiamus', 1),
(4839, 'atlikęs', 1),
(4839, 'kvalifikuotai', 1),
(4839, 'centras', 1),
(4839, 'mokslų', 1),
(4839, 'fizinių', 1),
(4839, 'suteikė', 1),
(4839, 'pagalbą', 1),
(4839, 'didelę', 1),
(4839, 'poreikius', 1),
(4839, 'jų', 1),
(4839, 'tenkinti', 1),
(4839, 'geriau', 1),
(4839, 'leis', 1),
(4839, 'klientams', 1),
(4839, 'tiekimą', 1),
(4839, 'konstrukcijų', 1),
(4839, 'įvairių', 1),
(4839, 'kompleksinį', 1),
(4839, 'užtikrins', 1),
(4839, 'nomenklatūrą', 1),
(4839, 'plėsti', 1),
(4839, 'skalių', 2),
(4839, 'ją', 1),
(4839, 'prielaidas', 1),
(4839, 'sudarys', 1),
(4839, 'sukūrimas', 1),
(4839, 'jos', 1),
(4839, 'technologiją', 1),
(4839, 'pramoninę', 1),
(4839, 'suskurti', 1),
(4839, 'siekiama', 1),
(4839, 'jais', 1),
(4839, 'tęsiami', 1),
(4839, 'intensyviai', 1),
(4839, 'yra', 1),
(4839, 'poreikis', 1),
(4839, 'darbai', 1),
(4839, 'procesų', 1),
(4839, 'fotolitografinių', 1),
(4839, 'atkrenta', 1),
(4839, 'nes', 1),
(4839, 'aspektais', 1),
(4839, 'gamtosauginiu', 1),
(4839, 'ekonominiu', 1),
(4839, 'techniniu', 1),
(4839, 'technologija', 1),
(4839, 'perspektyvi', 1),
(4839, 'metodu', 1),
(4839, 'lazeriniu', 1),
(4839, 'juostų', 1),
(4839, 'metalinių', 1),
(4839, 'elementus', 1),
(4839, 'rastrinius', 1),
(4839, 'precizinius', 1),
(4839, 'formuoti', 1),
(4839, 'galimybė', 1),
(4839, 'principinė', 1),
(4839, 'įrodyta', 1),
(4839, 'tai', 2),
(4839, 'kad', 1),
(4839, 'sudaro', 1),
(4839, 'svarbą', 1),
(4839, 'rezultatų', 1),
(4839, 'gautų', 1),
(4839, 'Šių', 1),
(4839, 'charakteristikos', 1),
(4839, 'metrologinės', 1),
(4839, 'pavyzdys', 1),
(4839, 'ištirtos', 1),
(4839, 'ilgio', 1),
(4839, '100', 1),
(4839, 'kokybės', 1),
(4839, 'reikiamos', 1),
(4839, 'pagamintas', 1),
(4839, 'aprašymas', 1),
(4839, 'specifikacija', 1),
(4839, 'įrangos', 1),
(4839, 'paruošta', 1),
(4839, 'rezultatais', 1),
(4839, 'tyrimų', 2),
(4839, 'gautais', 1),
(4839, 'remiantis', 1),
(4839, 'optimizacija', 1),
(4839, 'parametrų', 1),
(4839, 'tyrimai', 3),
(4839, 'proceso', 2),
(4839, 'technologinio', 1),
(4839, 'lazeriu', 1),
(4839, 'juostos', 1),
(4839, 'metalo', 1),
(4839, 'ant', 2),
(4839, 'formavimo', 1),
(4839, 'elementų', 1),
(4839, 'rastrinių', 1),
(4839, 'atlikti', 1),
(4839, 'kuriuo', 1),
(4839, 'maketas', 1),
(4839, 'sudarytas', 1),
(4839, 'schemos', 1),
(4839, 'optinės', 1),
(4839, 'lazerio', 1),
(4839, 'iš', 1),
(4839, 'sukurtas', 1),
(4839, 'vykdant', 1),
(4839, 'lt“', 1),
(4839, '„inočekiai', 1),
(4839, '–', 1),
(4839, 'priemonę', 1),
(4839, 'programos', 1),
(4839, 'augimo', 1),
(4840, 'vykdytas', 1),
(4840, 'užbaigtas', 1),
(4840, 'kasparaitis@precizika', 1),
(4840, '236', 1),
(4840, 'tel', 1),
(4840, 'direktorius', 1),
(4840, 'inžinerijos', 1),
(4840, 'albinas', 1),
(4840, 'kasparaitis', 1),
(4840, 'teirautis', 1),
(4840, 'informacijos', 1),
(4840, 'daugiau', 1),
(4840, 'produktą', 1),
(4840, 'turintį', 1),
(4840, 'rinkoje', 1),
(4840, 'perspektyvą', 1),
(4840, 'didelę', 1),
(4840, 'tenkinantį', 1),
(4840, 'vartotojų', 1),
(4840, 'paruošti', 1),
(4840, 'rinkai', 1),
(4840, 'realizuoti', 1),
(4840, 'pilniau', 1),
(4840, 'laiką', 1),
(4840, 'per', 1),
(4840, 'trumpesnį', 1),
(4840, 'įgalino', 1),
(4840, 'parama', 1),
(4840, 'vyriausybės', 1),
(4840, 'fondų', 1),
(4840, 'struktūrinių', 1),
(4840, 'apimtis', 1),
(4840, 'technologijų', 1),
(4840, 'aukštųjų', 1),
(4840, 'pačiu', 1),
(4840, 'tuo', 1),
(4840, 'išplėsta', 1),
(4840, 'bus', 1),
(4840, 'gamybą', 1),
(4840, 'serijinę', 1),
(4840, 'paruošus', 1),
(4840, 'veiklą', 1),
(4840, 'marketingo', 2),
(4840, 'atlikus', 1),
(4840, 'ateityje', 1),
(4840, 'artimiausioje', 1),
(4840, 'poreikius', 2),
(4840, 'klientų', 1),
(4840, 'tenkinti', 1),
(4840, 'kompleksiškai', 1),
(4840, 'geriau', 2),
(4840, 'leidžianti', 1),
(4840, 'konkurencingumą', 1),
(4840, 'sustiprino', 1),
(4840, 'nomenklatūrą', 1),
(4840, 'gaminių', 1),
(4840, 'įmonės', 2),
(4840, 'išplėtė', 1),
(4840, 'gaminys', 1),
(4840, 'naujas', 1),
(4840, 'modifikacijas', 1),
(4840, 'aprėpianti', 1),
(4840, 'gama', 1),
(4840, 'precizinių', 1),
(4840, 'testuota', 1),
(4840, 'pagaminta', 1),
(4840, 'kalibravimo', 1),
(4840, 'sukurta', 1),
(4840, 'keitiklių', 3),
(4840, 'absoliučiųjų', 2),
(4840, 'bei', 2),
(4840, 'procesų', 2),
(4840, 'technologinių', 2),
(4840, 'gamybos', 2),
(4840, 'limbų', 2),
(4841, 'gauta', 1),
(4841, 'padėjęs', 1),
(4841, 'tyrimus', 1),
(4841, 'technologijų', 1),
(4841, 'lazerinių', 1),
(4841, 'atlikęs', 1),
(4841, 'kvalifikuotai', 1),
(4841, 'operatyviai', 1),
(4841, 'centras', 1),
(4841, 'mokslų', 1),
(4841, 'technologijos', 1),
(4841, 'fizinių', 1),
(4841, 'suteikė', 1),
(4841, 'pagalbą', 1),
(4841, 'didelę', 1),
(4841, 'tikslai', 2),
(4841, 'numatyti', 2),
(4841, 'pasiekti', 3),
(4841, 'programą', 2),
(4841, 'atliktas', 2),
(4841, 'darbas', 2),
(4841, 'plėsti', 1),
(4841, 'ją', 1),
(4841, 'prielaidas', 1),
(4841, 'sudaryti', 1),
(4841, 'įsitvirtinti', 1),
(4841, 'rinkoje', 1),
(4841, 'geriau', 1),
(4841, 'dėka', 1),
(4841, 'priemones', 1),
(4841, 'matavimo', 1),
(4841, 'informatyvias', 1),
(4841, 'kartos', 1),
(4841, 'naujos', 1),
(4841, 'kuriančių', 1),
(4841, 'tenkinti', 1),
(4841, 'išaugusius', 1),
(4841, 'tikslas', 1),
(4841, 'pagrindinis', 1),
(4841, 'pasiektas', 1),
(4841, 'reikalavimus', 2),
(4841, 'klientų', 2),
(4841, 'svarbių', 1),
(4841, 'įmonei', 2),
(4841, 'labai', 1),
(4841, 'pavyzdžiai', 1),
(4841, 'pagaminti', 1),
(4841, 'sistema', 1),
(4841, 'rastro', 1),
(4841, 'išilginio', 1),
(4841, 'optinė', 1),
(4841, 'papildoma', 1),
(4841, 'įrenginį', 1),
(4841, 'veikiantį', 1),
(4841, 'integruota', 1),
(4841, 'skalių', 2),
(4841, 'išilgai', 1),
(4841, 'rastrinius', 1),
(4841, 'elementus', 1),
(4841, 'kraštais', 1),
(4841, 'tiksliais', 1),
(4841, 'ryškiais', 1),
(4841, 'ilgus', 1),
(4841, 'siaurus', 1),
(4841, 'abliuoti', 1),
(4841, 'lazeriu', 1),
(4841, 'leidžianti', 1),
(4841, 'technologija', 1),
(4841, 'sukurta', 2),
(4841, 'tyrimai', 1),
(4841, 'moksliniai', 1),
(4841, 'atlikti', 1),
(4841, 'vykdant', 1),
(4841, 'lt“', 1),
(4841, '„inočekiai', 1),
(4841, '–', 2),
(4841, 'priemonę', 1),
(4841, 'programos', 1),
(4841, 'veiksmų', 1),
(4841, 'augimo', 1),
(4841, 'ekonomikos', 1),
(4841, 'pagal', 4),
(4841, 'parama', 1),
(4841, 'fondo', 1),
(4841, 'plėtros', 1),
(4841, 'regioninės', 1),
(4841, 'europos', 1),
(4843, 'prie', 1),
(4843, 'prisideda', 1),
(4843, 'pat', 1),
(4843, 'taip', 1),
(4843, 'vykdymui', 1),
(4843, 'jos', 1),
(4843, 'sąlygas', 1),
(4843, 'geresnes', 1),
(4843, 'žymiai', 1),
(4843, 'sudaro', 1),
(4843, 'skatina', 1),
(4843, 'ją', 1),
(4843, 'veikla', 2),
(4843, 'inovacine', 2),
(4843, 'vykdoma', 2),
(4843, 'siejasi', 2),
(4843, 'tiesiogiai', 2),
(4843, 'tikslus', 2),
(4843, 'ilgalaikius', 2),
(4843, 'atitinka', 2),
(4843, 'eksportą', 1),
(4843, 'rinkoje', 1),
(4843, 'tarptautinėje', 1),
(4843, 'konkurencingumą', 2),
(4843, 'padidinti', 1),
(4843, 'pačiu', 1),
(4843, 'tuo', 1),
(4843, 'kokybę', 1),
(4843, 'parametrus', 1),
(4843, 'jų', 1),
(4843, 'techninius', 1),
(4843, 'įvertinti', 1),
(4843, 'objektyviai', 1),
(4843, 'nomenklatūrą', 1),
(4843, 'gaminamų', 1),
(4843, 'išplėsti', 2),
(4843, 'sistemas', 1),
(4843, 'naujas', 1),
(4843, 'kurti', 1),
(4843, 'tirti', 1),
(4843, 'laiką', 1),
(4843, 'trumpesnį', 1),
(4843, 'per', 1),
(4843, 'racionaliau', 1),
(4843, 'leis', 1),
(4843, 'įgyvendinimas', 1),
(4843, 'testavimą', 1),
(4843, 'bei', 2),
(4843, 'kūrimą', 1),
(4843, 'prototipų', 1),
(4843, 'limbais', 1),
(4843, 'parametrų', 1),
(4843, 'įvairių', 1),
(4843, 'mokslinius', 1),
(4843, 'taikomuosius', 1),
(4843, 'keitiklių', 2),
(4843, 'modifikacijų', 2),
(4843, 'naujų', 2),
(4843, 'tyrimus', 2),
(4843, 'mechatroninių', 1),
(4843, 'schemų', 1),
(4843, 'sąveikos', 1),
(4843, 'optoelektroninių', 1),
(4843, 'rastrinės', 1),
(4843, 'optimalių', 1),
(4843, 'darbus', 1),
(4843, 'tiriamuosius', 1),
(4843, 'modeliavimo', 1),
(4843, 'veiklas', 1),
(4843, 'šias', 1),
(4843, 'aprėpiančią', 1),
(4843, 'kūrimui', 1),
(4843, 'inovatyvių', 1),
(4843, 'skirtą', 1),
(4843, 'bazę', 1),
(4843, 'mttp', 2),
(4843, 'vystyti', 1),
(4843, 'plėsti', 1),
(4843, 'tikslas', 1),
(4843, 'lėšų', 1),
(4843, 'įmonės', 5),
(4843, 'skiriama', 1),
(4843, 'proc', 2),
(4843, 'kurių', 1),
(4843, '925', 1),
(4843, '706', 1),
(4843, 'suma', 1),
(4843, 'išlaidų', 1),
(4843, 'finansuoti', 1),
(4843, 'tinkamų', 1),
(4843, 'nustatyta', 1),
(4843, 'biudžete', 1),
(4843, '„intelektas', 1),
(4843, 'programos', 3),
(4844, 'šaltinių', 1),
(4844, 'išorinių', 1),
(4844, 'įgyti', 1),
(4844, 'žinias', 1),
(4844, 'reikiamas', 1),
(4844, 'galimybes', 1),
(4844, 'sudaro', 1),
(4844, 'pat', 1),
(4844, 'taip', 1),
(4844, 'įgyvendinimą', 2),
(4844, 'paspartins', 2),
(4844, 'mąstą', 2),
(4844, 'kokybę', 2),
(4844, 'parama', 2),
(4844, 'gauta', 2),
(4844, 'sąlygos', 1),
(4844, 'montavimo', 1),
(4844, 'aplinkai', 1),
(4844, 'darbo', 1),
(4844, 'reikalavimai', 1),
(4844, 'supaprastėti', 1),
(4844, 'gali', 1),
(4844, 'prailgintas', 1),
(4844, 'žymiai', 1),
(4844, 'antruoju', 1),
(4844, 'laikas', 2),
(4844, 'tarnavimo', 2),
(4844, 'originalo', 1),
(4844, 'elemento', 1),
(4844, 'gamybos', 1),
(4844, 'brangaus', 1),
(4844, 'labai', 1),
(4844, 'pailgės', 1),
(4844, 'esminiai', 1),
(4844, 'dėka', 1),
(4844, 'pasiekiama', 1),
(4844, 'bus', 2),
(4844, 'atveju', 2),
(4844, 'pirmuoju', 1),
(4844, 'vartotojams', 1),
(4844, 'gamintojams', 1),
(4844, 'tiek', 2),
(4844, 'naudą', 1),
(4844, 'didelę', 2),
(4844, 'parametrus', 1),
(4844, 'atspindžio', 1),
(4844, 'šviesos', 1),
(4844, 'pagerins', 3),
(4844, 'poveikiams', 1),
(4844, 'aplinkos', 1),
(4844, 'cheminiam', 1),
(4844, 'mechaniniam', 1),
(4844, 'atsparumą', 1),
(4844, 'jų', 4),
(4844, 'padidins', 1),
(4844, 'savybių', 1),
(4844, 'naujų', 1),
(4844, 'skalėms', 1),
(4844, 'suteiks', 2),
(4844, 'padengimas', 1),
(4844, 'deimantinis', 1),
(4844, 'kad', 2),
(4844, 'tikimasi', 1),
(4844, 'skalės', 1),
(4844, 'pasižyminčios', 1),
(4844, 'savybėmis', 1),
(4844, 'naujomis', 1),
(4844, 'tai', 4),
(4844, 'sukūrimui', 1),
(4844, 'danga', 1),
(4844, 'deimantine', 1),
(4844, 'skalių', 4),
(4844, 'produkto', 1),
(4844, 'naujo', 1),
(4844, 'reikalingos', 1),
(4844, 'kurios', 1),
(4844, 'žinioms', 1),
(4844, 'naujoms', 1),
(4844, 'gauti', 1),
(4844, 'reikalingas', 1),
(4844, 'veiklas', 1),
(4844, 'įgyvendinti', 1),
(4844, 'ruošiantis', 1),
(4844, 'studiją', 1),
(4844, 'galimybių', 1),
(4844, 'techninių', 1),
(4844, 'parengti', 1),
(4844, 'tikslas', 1),
(4844, 'lėšų', 1),
(4844, 'įmonės', 2),
(4844, 'skiriama', 1),
(4844, 'proc', 2),
(4844, 'kurių', 1),
(4844, '352', 1),
(4844, '185', 1),
(4844, 'suma', 1),
(4844, 'išlaidų', 1),
(4844, 'finansuoti', 1),
(4844, 'tinkamų', 1),
(4844, 'didžiausia', 1),
(4844, 'nustatyta', 1),
(4844, 'biudžete', 1),
(4844, '„idėja', 1),
(4844, 'priemonę', 1),
(4844, 'programos', 3),
(4844, 'veiksmų', 2),
(4844, 'augimo', 2),
(4844, 'ekonomikos', 2),
(4844, 'strategiją', 1),
(4844, 'panaudojimo', 1),
(4844, 'paramos', 1),
(4844, 'struktūrinės', 1),
(4844, 'metų', 1),
(4844, '2013', 1),
(4844, '2007', 1),
(4844, 'lietuvos', 2),
(4844, 'pagal', 1),
(4844, 'įgyvendinamas', 1),
(4844, 'projektas', 2),
(4844, '027', 1),
(4844, 'Ūm', 1),
(4844, 'vp2', 1),
(4844, 'projekto', 6),
(4844, 'dangomis', 1),
(4844, 'anglies', 4),
(4844, 'tipo', 4),
(4844, 'deimantinio', 4),
(4844, 'skales', 3),
(4844, 'matavimo', 4),
(4844, 'naujas', 3),
(4840, 'kodinių', 1),
(4840, 'sukūrimui', 3),
(4840, 'naujo', 1),
(4840, 'skirti', 1),
(4840, 'tyrimai', 1),
(4840, 'moksliniai', 1),
(4840, 'atlikti', 1),
(4840, 'buvo', 1),
(4840, 'etapus', 1),
(4840, 'technologinės', 1),
(4840, 'tyrimų', 1),
(4840, 'mokslinių', 1),
(4840, 'tris', 2),
(4840, 'aprėpė', 1),
(4840, 'projektas', 2),
(4840, 'Ūm', 1),
(4838, '2012', 1),
(4838, 'drives', 2),
(4838, 'ipc', 2),
(4838, 'sps', 2),
(4838, 'plėtimui', 1),
(4838, 'verslo', 1),
(4838, 'svarbiose', 1),
(4838, 'tarptautinėse', 1),
(4838, 'parodose', 4),
(4838, 'labai', 1),
(4838, 'devyniose', 1),
(4838, 'dalyvavo', 1),
(4840, '025', 1),
(4840, 'vp2', 1),
(4840, 'sukūrimas“', 3),
(4840, 'galimybėmis', 4),
(4840, 'diagnostikos', 4),
(4840, 'keitiklio', 5),
(4840, 'kampo', 5),
(4840, 'precizinio', 3),
(4840, 'gebos', 4),
(4840, 'skiriamosios', 4),
(4840, 'aukštos', 4),
(4840, '“absoliučiojo', 1),
(4840, 'projektą', 2),
(4840, 'remiamą', 1),
(4840, 'lėšomis', 2),
(4840, 'respublikos', 2),
(4840, 'lietuvos', 2),
(4840, 'fondo', 2),
(4840, 'plėtros', 3),
(4840, 'regioninės', 2),
(4840, 'europos', 2),
(4840, 'dalies', 2),
(4839, 'veiksmų', 1),
(4839, 'ekonomikos', 1),
(4839, 'pagal', 1),
(4839, 'parama', 1),
(4839, 'fondo', 1),
(4839, 'plėtros', 1),
(4839, 'regioninės', 1),
(4839, 'dalinė', 1),
(4839, 'europos', 1),
(4839, 'gauta', 1),
(4839, 'buvo', 1),
(4839, 'kuriam', 1),
(4839, '004', 1),
(4839, 'Ūm', 1),
(4839, 'vp2', 1),
(4841, 'dalinė', 1),
(4841, 'buvo', 2),
(4841, 'kuriam', 1),
(4841, '022', 1),
(4841, 'Ūm', 1),
(4841, 'vp2', 1),
(4841, 'tyrimai“', 3),
(4841, 'spindulių', 3),
(4841, 'lazerio', 3),
(4841, 'formavimo', 4),
(4841, 'elementų', 3),
(4840, 'iš', 2),
(4840, 'vykdytą', 1),
(4840, 'metus', 2),
(4840, 'užbaigė', 1),
(4840, 'sėkmingai', 2),
(4843, 'priemonę', 1),
(4843, 'veiksmų', 2),
(4843, 'augimo', 2),
(4843, 'ekonomikos', 2),
(4843, 'strategiją', 1),
(4843, 'panaudojimo', 1),
(4843, 'paramos', 1),
(4843, 'struktūrinės', 1),
(4843, '2013', 1),
(4843, 'metų', 1),
(4843, '2007', 1),
(4843, 'lietuvos', 2),
(4843, 'pagal', 1),
(4843, 'įgyvendinamas', 1),
(4843, 'projektas', 4),
(4843, '027', 1),
(4843, 'Ūm', 1),
(4843, 'vp2', 1),
(4843, 'projekto', 5),
(4843, 'vystymas', 1),
(4843, 'bazės', 3),
(4843, 'technologinės', 3),
(4843, 'tyrimų', 3),
(4843, 'mokslinių', 3),
(4843, 'kūrimo', 3),
(4844, 'kokybiškai', 4),
(4844, 'sukurti', 3),
(4844, 'siekiant', 3),
(4844, 'atlikimui', 3),
(4844, 'veiklų', 3),
(4844, 'tyrimų', 3),
(4844, 'mokslinių', 3),
(4844, '„pasirengimas', 3),
(4844, 'projektą', 1),
(4844, 'finansuojamą', 1),
(4844, 'lėšomis', 1),
(4844, 'fondo', 2),
(4844, 'plėtros', 2),
(4844, 'regioninės', 2),
(4844, 'sąjungos', 2),
(4844, 'europos', 4),
(4844, 'dalies', 1),
(4844, 'iš', 5),
(4844, 'įgyvendina', 1),
(4844, 'rugpjūčio', 1),
(4844, '2011', 1),
(4844, 'iki', 2),
(4844, 'mėn', 2),
(4844, 'rugsėjo', 1),
(4844, '2010', 1),
(4844, 'nuo', 1),
(4844, 'metrology', 1),
(4844, 'precizika', 1),
(4844, 'uab', 1),
(4845, 'vykdoma', 1),
(4845, 'siejasi', 1),
(4845, 'tiesiogiai', 1),
(4845, 'tikslus', 1),
(4845, 'ilgalaikius', 1),
(4845, 'sąnaudų', 1),
(4845, 'pačiu', 1),
(4845, 'tikslumo', 1),
(4845, 'gamybos', 2),
(4845, 'nedidinant', 1),
(4845, 'metodais', 1),
(4845, 'matematiniais', 1),
(4845, 'tikslumą', 1),
(4845, 'sistemos', 1),
(4845, 'tokios', 1),
(4845, 'naudojamos', 1),
(4845, 'kuriuose', 1),
(4845, 'įrenginių', 1),
(4845, 'įgalins', 1),
(4845, 'atžvilgiu', 1),
(4845, 'ašims', 1),
(4845, 'dviem', 1),
(4845, 'minėtoms', 1),
(4845, 'statmenos', 1),
(4845, 'posūkius', 1),
(4845, 'kampinius', 1),
(4845, 'bei', 2),
(4845, 'judesiui', 1),
(4845, 'pagrindiniam', 1),
(4845, 'statmena', 1),
(4845, 'poslinkius', 1),
(4845, 'mažus', 2),
(4845, 'bet', 1),
(4845, 'kryptimi', 2),
(4845, 'ašies', 2),
(4845, 'judesio', 2),
(4845, 'pagrindinio', 1),
(4845, 'kryptį', 1),
(4845, 'dydį', 1),
(4845, 'poslinkio', 1),
(4845, 'apie', 2),
(4845, 'tik', 1),
(4845, 'informaciją', 2),
(4845, 'teikiančias', 1),
(4845, 'sistemas', 1),
(4845, 'poslinkių', 1),
(4845, 'linijinių', 1),
(4845, 'naujas', 1),
(4845, 'sukurti', 1),
(4845, 'leis', 1),
(4845, 'Šios', 1),
(4845, 'tendenciją', 1),
(4845, 'kūrimo', 1),
(4845, 'sistemų', 1),
(4845, 'pasaulinę', 1),
(4845, 'atitinka', 2),
(4845, 'tai', 2),
(4845, 'sukūrimui', 1),
(4845, 'kokybiškai', 2),
(4845, 'produkto', 1),
(4845, 'vertės', 1),
(4845, 'pridėtinės', 1),
(4845, 'aukštos', 1),
(4845, 'skirtos', 1),
(4845, 'veiklos', 1),
(4845, 'mttp', 1),
(4845, 'atliekamos', 1),
(4845, 'yra', 1),
(4845, 'tikslu', 1),
(4845, 'tuo', 2),
(4845, 'rinkoje', 2),
(4845, 'tarptautinėje', 2),
(4845, 'konkurencingumą', 3),
(4845, 'padidinti', 3),
(4845, 'asortimentą', 2),
(4845, 'skalių', 2),
(4845, 'rastrinių', 2),
(4845, 'gaminamų', 2),
(4845, 'išplėsti', 2),
(4845, 'tikslas', 2),
(4845, ' projekto', 1),
(4845, 'lėšų', 1),
(4845, 'įmonės', 4),
(4845, 'skiriama', 1),
(4845, 'proc', 2),
(4845, 'kurių', 1),
(4845, '932', 1),
(4845, '980', 1),
(4845, 'suma', 1),
(4845, 'išlaidų', 1),
(4845, 'finansuoti', 1),
(4845, 'tinkamų', 1),
(4845, 'didžiausia', 1),
(4845, 'nustatyta', 1),
(4845, 'biudžete', 1),
(4845, '„intelektas', 1),
(4845, 'priemonę', 1),
(4845, 'programos', 3),
(4845, 'veiksmų', 2),
(4845, 'augimo', 2),
(4845, 'ekonomikos', 2),
(4845, 'strategiją', 1),
(4845, 'panaudojimo', 1),
(4845, 'paramos', 1),
(4845, 'struktūrinės', 1),
(4845, 'metų', 1),
(4845, '2013', 1),
(4845, '2007', 1),
(4845, 'lietuvos', 2),
(4845, 'pagal', 1),
(4845, 'įgyvendinamas', 1),
(4845, 'projektas', 3),
(4845, '002', 1),
(4845, 'Ūm', 1),
(4845, 'vp2', 1),
(4845, 'projekto', 4),
(4846, 'aplinkai', 1),
(4846, 'eksploatavimo', 1),
(4846, 'reikalavimai', 2),
(4846, 'sumažės', 1),
(4846, 'pat', 1),
(4846, 'taip', 1),
(4846, 'dėka', 1),
(4846, 'gradientai', 1),
(4846, 'temperatūriniai', 1),
(4846, 'laiko', 1),
(4846, 'erdvės', 1),
(4846, 'virpesiai', 1),
(4846, 'pamato', 1),
(4846, 'kaip', 1),
(4846, 'trikdžiams', 1),
(4846, 'išoriniams', 1),
(4846, 'tokiems', 1),
(4846, 'veikiant', 1),
(4846, 'tikslumas', 1),
(4846, 'patikimumas', 1),
(4846, 'įrenginių', 2),
(4846, 'gaminamų', 1),
(4846, 'padidės', 1),
(4846, 'gaus', 1),
(4846, 'vartotojas', 1),
(4846, 'apimtis', 1),
(4846, 'eksporto', 1),
(4846, 'pačiu', 1),
(4846, 'tuo', 1),
(4846, 'sąlygomis', 1),
(4846, 'aplinkos', 2),
(4846, 'sudėtingomis', 1),
(4846, 'darbui', 1),
(4846, 'skirtų', 1),
(4846, 'sistemų', 1),
(4846, 'ypač', 1),
(4846, 'nomenklatūrą', 1),
(4846, 'gaminių', 1),
(4846, 'išplėsti', 1),
(4846, 'jam', 1),
(4846, 'leis', 1),
(4846, 'nes', 2),
(4846, 'vykdytojui', 2),
(4846, 'naudą', 3),
(4846, 'didelę', 3),
(4846, 'duos', 2),
(4846, 'sistema', 2),
(4846, 'kuriama', 2),
(4846, 'kūrimui', 1),
(4846, 'produktų', 1),
(4846, 'naujų', 1),
(4846, 'sąlygas', 1),
(4846, 'palankias', 1),
(4846, 'sudaryti', 1),
(4846, 'potencialą', 1),
(4846, 'intelektualinį', 1),
(4846, 'turimą', 1),
(4846, 'išnaudoti', 1),
(4846, 'efektyviai', 1),
(4846, 'sistemą', 1),
(4846, 'kokybiškai', 1),
(4846, 'produktą', 1),
(4846, 'naują', 2),
(4846, 'sukurti', 1),
(4846, 'siekiama', 1),
(4846, 'projektu', 1),
(4846, 'sukūrimui', 2),
(4846, 'produkto', 3),
(4846, 'vertės', 1),
(4846, 'pridėtinės', 1),
(4846, 'aukštos', 1),
(4846, 'naujo', 2),
(4846, 'skirtas', 1),
(4846, 'veiklas', 1),
(4846, 'mttp', 1),
(4846, 'atliekant', 1),
(4846, 'rinkoje', 1),
(4846, 'tarptautinėje', 1),
(4846, 'konkurencingumą', 2),
(4846, 'padidinti', 2),
(4846, 'tikslas', 1),
(4846, 'lėšų', 1),
(4846, 'įmonės', 3),
(4846, 'skiriama', 1),
(4846, 'proc', 2),
(4846, 'kurių', 1),
(4846, '493', 1),
(4846, '312', 1),
(4846, 'suma', 1),
(4846, 'išlaidų', 1),
(4846, 'finansuoti', 1),
(4846, 'tinkamų', 1),
(4846, 'nustatyta', 1),
(4846, 'biudžete', 1),
(4846, '„intelektas', 1),
(4846, 'priemonę', 1),
(4846, 'programos', 3),
(4846, 'veiksmų', 2),
(4846, 'augimo', 2),
(4846, 'ekonomikos', 2),
(4846, 'strategiją', 1),
(4846, 'panaudojimo', 1),
(4846, 'paramos', 1),
(4846, 'struktūrinės', 1),
(4846, 'metų', 1),
(4846, '2013', 1),
(4846, '2007', 1),
(4846, 'lietuvos', 2),
(4846, 'pagal', 1),
(4846, 'įgyvendinamas', 1),
(4846, 'projektas', 2),
(4846, '001', 1),
(4846, 'Ūm', 1),
(4846, 'vp2', 1),
(4846, 'projekto', 6),
(4846, 'sukūrimas', 1),
(4846, 'sistemos', 4),
(4846, 'poslinkių', 4),
(4846, 'linijinių', 4),
(4846, 'termostabilumo', 1),
(4846, 'bei', 2),
(4846, 'vibracijoms', 1),
(4846, 'atsparumo', 1),
(4846, 'tikslumo', 1),
(4846, 'matavimo', 9),
(4846, 'padidinto', 1),
(4846, '„naujos', 3),
(4846, 'projektą', 2),
(4846, 'finansuojamą', 1),
(4846, 'lėšomis', 1),
(4846, 'fondo', 2),
(4846, 'plėtros', 2),
(4846, 'regioninės', 2),
(4846, 'sąjungos', 2),
(4846, 'europos', 4),
(4846, 'dalies', 1),
(4846, 'iš', 4),
(4846, 'įgyvendina', 1),
(4846, 'spalio', 1),
(4846, '2011', 1),
(4846, 'iki', 2),
(4846, 'mėn', 2),
(4846, 'rugsėjo', 1),
(4846, '2009', 1),
(4846, 'nuo', 1),
(4846, 'metrology', 1),
(4846, 'precizika', 1),
(4846, 'uab', 1),
(4847, 'kalibravimo', 1),
(4847, 'gamybos', 3),
(4847, 'sistemų', 2),
(4847, 'precizinių', 1),
(4847, 'aukštosiomis', 1),
(4847, 'turimomis', 1),
(4847, 'įmonėje', 1),
(4847, 'pagrįstą', 1),
(4847, 'produktą', 1),
(4847, 'naują', 1),
(4847, 'turintį', 1),
(4847, 'rinkoje', 1),
(4847, 'pasaulinėje', 1),
(4847, 'perspektyvas', 1),
(4847, 'geras', 1),
(4847, 'numatoma', 1),
(4847, 'išdavoje', 1),
(4847, 'pasiruošė', 1),
(4847, 'įmonė', 1),
(4847, 'dėka', 1),
(4847, 'vgtu', 1),
(4847, 'įgyvendinimo', 1),
(4847, 'ktu', 1),
(4847, 'įstaigomis', 1),
(4847, 'mokslo', 2),
(4847, 'bendradarbiavimo', 1),
(4847, 'šaltiniai', 1),
(4847, 'finansavimo', 1),
(4847, 'galimi', 1),
(4847, 'trukmės', 1),
(4847, 'laiko', 1),
(4847, 'resursai', 1),
(4847, 'finansų', 1),
(4847, 'žmonių', 1),
(4847, 'reikalingi', 1),
(4847, 'įgyvendinimui', 1),
(4847, 'įvertintos', 1),
(4847, 'veiklos', 1),
(4847, 'būsimos', 1),
(4847, 'kuriame', 1),
(4847, 'planas', 1),
(4847, 'išteklių', 1),
(4847, 'sudarytas', 1),
(4847, 'technologinės', 1),
(4847, 'funkcionalumui', 1),
(4847, 'reikalavimai', 1),
(4847, 'naujumas', 1),
(4847, 'produktas', 1),
(4847, 'naujas', 1),
(4847, 'apibrėžtas', 1),
(4847, 'principai', 1),
(4847, 'naujos', 1),
(4847, 'teoriniai', 1),
(4847, 'išnagrinėti', 1),
(4847, 'gyvybingumą', 1),
(4847, 'technologinį', 1),
(4847, 'pagrindžiant', 1),
(4847, 'galimybės', 2),
(4847, 'eksporto', 3),
(4847, 'pagrįstos', 1),
(4847, 'išnagrinėtos', 2),
(4847, 'poreikis', 2),
(4847, 'jų', 4),
(4847, 'įvertintas', 1),
(4847, 'charakteristikos', 1),
(4847, 'apibrėžtos', 2),
(4847, 'analizė', 1),
(4847, 'rinkos', 1),
(4847, 'konkurentų', 1),
(4847, 'atlikta', 1),
(4847, 'analizę', 1),
(4847, 'gyvybingumo', 1),
(4847, 'konkurencinio', 1),
(4847, 'vykdant', 1),
(4847, 'sumažinimui', 1),
(4847, 'rizikos', 1),
(4847, 'kūrimo', 4),
(4847, 'būsimo', 2),
(4847, 'bei', 2),
(4847, 'vykdymui', 2),
(4847, 'prielaidos', 1),
(4847, 'sudaromos', 1),
(4847, 'projektu', 1),
(4847, 'veikla', 1),
(4847, 'inovacine', 1),
(4847, 'ilgalaike', 1),
(4847, 'siejasi', 1),
(4847, 'tiesiogiai', 1),
(4847, 'tikslus', 1),
(4847, 'ilgalaikius', 1),
(4847, 'atitinka', 1),
(4847, 'gauti', 1),
(4847, 'žinioms', 1),
(4847, 'sukūrimo', 1),
(4847, 'sistemos', 2),
(4847, 'mechatroninės', 1),
(4847, 'produkto', 6),
(4847, 'naujo', 3),
(4847, 'reikalingas', 1),
(4847, 'veiklas', 1),
(4847, 'įgyvendinti', 1),
(4847, 'ruošiantis', 1),
(4847, 'studiją', 1),
(4847, 'galimybių', 1),
(4847, 'techninių', 1),
(4847, 'parengti', 1),
(4847, 'tikslas', 1),
(4847, 'lėšų', 1),
(4847, 'įmonės', 6),
(4847, 'skiriama', 1),
(4847, 'proc', 2),
(4847, 'kurių', 2),
(4847, '430', 1),
(4847, '180', 1),
(4847, 'suma', 1),
(4847, 'išlaidų', 1),
(4847, 'finansuoti', 1),
(4847, 'tinkamų', 1),
(4847, '„idėja', 1),
(4847, 'priemonę', 1),
(4847, 'programos', 1),
(4847, 'veiksmų', 1),
(4847, 'augimo', 1),
(4847, 'ekonomikos', 1),
(4847, 'strategiją', 1),
(4847, 'panaudojimo', 1),
(4847, 'paramos', 1),
(4847, 'struktūrinės', 1),
(4847, 'metų', 1),
(4847, '2013', 1),
(4847, '2007', 1),
(4847, 'lietuvos', 3),
(4847, 'pagal', 1),
(4849, 'įvertinant', 1),
(4849, 'sukurimui', 1),
(4849, 'pasiruoš', 1),
(4849, 'įmonė', 1),
(4849, 'dėka', 1),
(4849, 'įgyvendinimo', 1),
(4849, 'projekto', 1),
(4849, 'bei', 1),
(4849, 'palyginimas', 1),
(4849, 'ypatumų', 1),
(4849, 'konstrukcijų', 1),
(4849, 'keitiklių', 1),
(4849, 'gamintojų', 1),
(4849, 'įvairių', 1),
(4849, 'principų', 1),
(4849, 'formavimo', 1),
(4849, 'signalų', 1),
(4849, 'analizė', 3),
(4849, 'technologijos', 1),
(4849, 'gamybos', 1),
(4849, 'jų', 1),
(4849, 'tipų', 1),
(4849, 'skalių', 1),
(4849, 'kodinių', 2),
(4849, 'apskritų', 1),
(4849, 'atliekama', 1),
(4849, 'reikalavimai', 1),
(4849, 'kokybiniai', 1),
(4849, 'techniniai', 1),
(4849, 'problematika', 1),
(4849, 'produkto', 1),
(4849, 'nagrinėjami', 1),
(4849, 'potencialas', 1),
(4849, 'tendencijos', 1),
(4849, 'kitimo', 1),
(4849, 'būklė', 1),
(4849, 'vartotojų', 1),
(4849, 'tikslinės', 1),
(4849, 'nustatoma', 1),
(4849, 'tirimas', 1),
(4849, 'rinkos', 2),
(4849, 'galimos', 1),
(4849, 'atliekamas', 1),
(4849, 'projektą', 1),
(4849, 'Įgyvendinant', 1),
(4849, 'studija', 2),
(4849, 'galimybių', 4),
(4849, 'sukurimo', 2),
(4849, 'keitiklio', 3),
(4849, 'poslinkių', 3),
(4849, 'kampinių', 3),
(4849, 'absoliučiojo', 3),
(4849, 'naujo', 3),
(4849, 'yra', 1),
(4849, 'tikslas', 2),
(4849, 'kuriuo', 1),
(4849, 'projektas', 1),
(4849, 'finansuojamas', 1),
(4849, 'dalies', 1),
(4849, 'iš', 1),
(4848, 'parodymų', 1),
(4848, 'įtakoti', 1),
(4848, 'neleidžiantis', 1),
(4848, 'prietaisas', 1),
(4848, 'konkurencingas', 1),
(4848, 'naujos', 1),
(4848, 'pagamintas', 1),
(4848, 'sukurtas', 1),
(4848, 'buvo', 1),
(4848, 'metu', 1),
(4848, '355', 1),
(4848, 'numeris', 1),
(4848, 'sukūrimas“', 3),
(4848, 'grobstymo', 3),
(4848, 'energijos', 6),
(4848, 'nuo', 3),
(4848, 'apsaugančio', 3),
(4848, 'prietaiso', 3),
(4848, 'apskaitos', 4),
(4848, 'elektros', 9),
(4848, 'komercinio', 3),
(4848, 'kartos', 4),
(4848, '„naujos', 3),
(4848, 'pavadinimas', 1),
(4848, 'metrology“', 1),
(4848, '„precizika', 1),
(4848, 'uab', 1),
(4848, 'vykdytojas', 1),
(4848, 'projekto', 4),
(4852, 'fotoninius', 1),
(4852, 'trimačius', 1),
(4852, 'formuojant', 1),
(4852, 'pademonstruotos', 1),
(4852, 'galimybės', 1),
(4852, 'technologijos', 1),
(4852, 'sukurtos', 1),
(4852, 'įspaudimui', 1),
(4852, 'trimačiam', 1),
(4852, 'ją', 1),
(4852, 'pritaikant', 1),
(4852, 'nanoįspaudimo', 1),
(4852, 'patobulinta', 1),
(4852, 'projektą', 1),
(4852, 'vykdant', 1),
(4852, 'gamybai', 2),
(4852, 'nanostruktūrų', 2),
(4852, 'trimačių', 2),
(4852, 'precizinei', 2),
(4852, 'įrenginiai', 2),
(4852, 'technologiniai', 2),
(4852, 'reikalingi', 2),
(4852, 'visi', 2),
(4852, 'technologija', 3),
(4852, 'baigtinė', 2),
(4852, 'sukurta', 2),
(4852, 'institutu', 1),
(4852, 'elektronikos', 1),
(4852, 'fizikinės', 1),
(4852, 'ktu', 1),
(4852, 'instruments', 1),
(4852, 'sentech', 1),
(4852, 'technology', 1),
(4852, 'microresist', 1),
(4852, 'vokietija', 3),
(4852, 'Šilerio', 1),
(4852, 'fridricho', 1),
(4852, 'jenos', 1),
(4852, 'suomija', 1),
(4852, 'heptagon', 1),
(4852, 'produktionsforschungs', 1),
(4852, 'profactor', 1),
(4852, 'universitetu', 2),
(4852, 'keplerio', 1),
(4852, 'džono', 1),
(4852, 'linco', 1),
(4852, 'austrija', 3),
(4852, 'gmbh', 4),
(4852, 'evg', 1),
(4852, 'thallner', 1),
(4852, 'kartu', 1),
(4850, 'institucija', 1),
(4850, 'mokslo', 1),
(4850, 'bendradarbiaujama', 1),
(4850, 'metu', 1),
(4850, 'procesus', 2),
(4850, 'produkto', 1),
(4850, 'naujo', 1),
(4850, 'apibrėžti', 1),
(4850, 'leis', 1),
(4850, 'rezultatai', 1),
(4850, 'kitos', 2),
(4850, 'dangų', 2),
(4850, 'fotorezistų', 2),
(4850, 'tyrimai', 4),
(4850, 'procesų', 2),
(4850, 'eksponavimo', 2),
(4850, 'veiklos', 2),
(4850, 'tyrimų', 3),
(4850, 'mokslinių', 2),
(4850, 'taikomųjų', 2),
(4850, 'atliekamos', 2),
(4850, 'Įgyvendinant', 2),
(4850, 'veiklas', 1),
(4850, 'plėtros', 1),
(4850, 'technologinės', 1),
(4850, 'tyrimus', 1),
(4850, 'mokslinius', 1),
(4850, 'plėtoti', 1),
(4850, 'potencialą', 1),
(4850, 'sustiprins', 1),
(4850, 'bet', 1),
(4850, 'rinkose', 1),
(4850, 'užsienio', 1),
(4850, 'šalies', 1),
(4850, 'konkurencingumą', 1),
(4850, 'įmonės', 3),
(4850, 'padidins', 1),
(4850, 'tik', 1),
(4850, 'projektas', 1),
(4850, 'metrology', 1),
(4850, 'Šis', 1),
(4850, 'atstovai', 1),
(4850, 'pramonės', 1),
(4850, 'mašinų', 1),
(4850, 'rinka', 1),
(4850, 'tikslinė', 1),
(4850, 'produktų', 2),
(4850, 'sukurtų', 1),
(4850, 'pagrindinė', 1),
(4850, 'pritaikoma', 2),
(4850, 'komerciškai', 1),
(4850, 'parametrais', 1),
(4850, 'kokybiniais', 1),
(4850, 'savo', 1),
(4850, 'nauja', 3),
(4850, 'bus', 6),
(4850, 'technologija', 3),
(4850, 'Ši', 1),
(4850, 'technologiją', 1),
(4850, 'naują', 1),
(4850, 'sukurti', 1),
(4850, 'tikslo', 1),
(4850, 'šio', 1),
(4850, 'siekia', 1),
(4850, 'įmonė', 1),
(4850, 'projektą', 3),
(4850, 'finansuojamą', 1),
(4850, 'dalies', 1);
INSERT INTO `cms_module_search_index` (`item_id`, `word`, `count`) VALUES
(4850, 'iš', 1),
(4850, 'lėšomis', 1),
(4850, 'paramos', 1),
(4853, 'gaus', 1),
(4853, 'produktus', 1),
(4853, 'vertės', 1),
(4853, 'pridėtinės', 1),
(4853, 'aukštos', 1),
(4853, 'gamins', 1),
(4853, 'ratą', 1),
(4853, 'praplės', 1),
(4853, 'užsakymus', 1),
(4853, 'gaunamus', 1),
(4853, 'įgyvendinti', 1),
(4853, 'efektyviau', 1),
(4853, 'galės', 1),
(4853, 'įmonė', 1),
(4853, 'paslaugos', 1),
(4853, 'naujos', 1),
(4853, 'kokybiškai', 1),
(4853, 'dėl', 1),
(4853, 'konkurencingumą', 2),
(4853, 'gyvybingumą', 2),
(4853, 'stiprins', 2),
(4853, 'verslumą', 2),
(4853, 'padidins', 2),
(4853, 'tai', 2),
(4853, 'pageidavimus', 1),
(4853, 'užsakovų', 1),
(4853, 'išpildant', 1),
(4853, 'tiksliai', 1),
(4853, 'įmonėje', 1),
(4853, 'originalus', 1),
(4853, 'gaminti', 1),
(4853, 'paslaugą', 1),
(4853, 'pasiūlyti', 1),
(4853, 'klientams', 1),
(4853, 'galima', 1),
(4853, 'kokybė', 1),
(4853, 'produkcijos', 1),
(4853, 'gaminamos', 1),
(4853, 'įmonės', 6),
(4853, 'pagerinta', 1),
(4853, 'ženkliai', 1),
(4853, 'bus', 2),
(4853, 'įrenginį', 1),
(4853, 'technologiją', 1),
(4853, 'sukūrus', 1),
(4853, 'resursų', 1),
(4853, 'finansinių', 1),
(4853, 'intelektualinių', 1),
(4853, 'didelių', 1),
(4853, 'labai', 1),
(4853, 'reikalauja', 1),
(4853, 'įrenginio', 1),
(4853, 'tokio', 1),
(4853, 'gamybai', 1),
(4853, 'stambiaserijinei', 1),
(4853, 'tolimesnei', 1),
(4853, 'pavyzdys', 1),
(4853, 'kaip', 1),
(4853, 'naudojami', 1),
(4853, 'kurie', 1),
(4853, 'nuo', 1),
(4853, 'prasideda', 1),
(4853, 'procesas', 1),
(4853, 'rinkoje', 1),
(4853, 'tarptautinėje', 1),
(4853, 'paklausiausios', 1),
(4853, 'yra', 1),
(4853, 'šiuo', 1),
(4853, 'kurios', 1),
(4853, 'procesą', 1),
(4853, 'pilną', 1),
(4853, 'užtikrinti', 1),
(4853, 'vietoje', 1),
(4853, 'bei', 1),
(4853, 'poreikius', 1),
(4853, 'klientų', 2),
(4853, 'reaguoti', 1),
(4853, 'operatyviai', 1),
(4853, 'leis', 2),
(4853, 'kuri', 2),
(4853, 'įranga', 1),
(4853, 'technologija', 1),
(4853, 'sukurta', 1),
(4853, 'metu', 2),
(4853, '0038', 1),
(4853, 'erpf', 1),
(4853, 'bpd2004', 1),
(4836, 'precizinių', 1),
(4836, 'gebos', 1),
(4836, 'skiriamosios', 1),
(4836, 'aukštos', 1),
(4836, 'absoliučiųjų', 1),
(4836, 'už', 1),
(4836, 'grupėje', 1),
(4836, 'pramonės', 1),
(4836, 'įrengimų', 1),
(4836, 'mašinų', 1),
(4836, 'medalį', 2),
(4836, 'aukso', 2),
(4836, '2013', 3),
(4836, 'gaminys', 3),
(4836, 'metų', 3),
(4836, 'lietuvos', 3),
(4836, 'pelnė', 2),
(4836, 'metrology“', 2),
(4835, 'inovatyvaus', 1),
(4835, 'nugalėtoju', 2),
(4835, '2013', 4),
(4835, 'prizas', 4),
(4835, 'inovacijŲ', 2),
(4835, 'konkurso', 2),
(4835, 'nacionalinio', 2),
(4835, 'tapo', 2),
(4835, 'komparatorius', 2),
(4835, 'kalibravimo', 2),
(4835, 'keitiklių', 2),
(4835, 'kampo', 2),
(4835, 'limbų', 2),
(4835, 'precizinis', 2),
(4835, 'produktas', 1),
(4835, 'metrology', 1),
(4835, 'precizika', 1),
(4835, 'uab', 1),
(4835, 'Įmonės', 1),
(4833, 'pirmininkas', 1),
(4833, 'seimo', 1),
(4833, 'dargis', 1),
(4833, 'robertas', 1),
(4833, 'prezidentas', 1),
(4833, 'lpk', 1),
(4833, 'grupėse', 1),
(4833, 'įmonių', 1),
(4833, 'mažų', 1),
(4833, 'vidutinių', 1),
(4833, 'didelių', 1),
(4833, '–', 2),
(4833, 'Šventiniame', 1),
(4833, 'trijose', 1),
(4833, 'piliečiams', 1),
(4833, 'bei', 1),
(4833, 'nusipelniusiems', 1),
(4833, 'lyderiams', 1),
(4833, 'verslo', 1),
(4833, 'šalies', 1),
(4833, 'apdovanojimai', 2),
(4833, 'nominacijų', 2),
(4833, 'įmonės“', 2),
(4833, 'dirbančios', 2),
(4833, '„sėkmingai', 2),
(4833, 'prizo“', 2),
(4833, '„inovacijų', 2),
(4833, 'vileišio“', 2),
(4833, '„petro', 2),
(4833, 'įteikti', 2),
(4833, 'žmones', 3),
(4833, 'nusipelniusius', 3),
(4833, 'pagerbė', 3),
(4833, 'renginyje', 4),
(4833, 'kalėdiniame', 1),
(4833, 'šventiniame', 1),
(4833, 'konfederacija', 1),
(4833, 'pramonininkų', 1),
(4833, 'filharmonijoje', 1),
(4833, 'nacionalinėje', 1),
(4834, '„elektrėnų', 1),
(4834, 'savivaldybę', 1),
(4834, 'elektrėnų', 1),
(4834, 'reikmėms“', 1),
(4834, 'rekonstrukcija', 1),
(4834, 'pastato', 1),
(4834, 'fabriko', 1),
(4834, 'saldainių', 1),
(4834, 'senojo', 1),
(4834, '„uab', 1),
(4834, '„rūta“', 2),
(4834, 'uab', 2),
(4834, 'ldk“', 1),
(4834, 'lietuva', 1),
(4834, 'istorinė', 1),
(4834, '„virtuali', 1),
(4834, 'universitetą', 1),
(4834, 'vilniaus', 1),
(4834, 'miestelyje“', 1),
(4834, 'debeikių', 1),
(4834, 'įkūrimas', 1),
(4834, 'asmenims', 1),
(4834, 'amžiaus', 1),
(4834, 'senyvo', 1),
(4834, 'namų', 2),
(4834, 'gyvenimo', 2),
(4834, '„savarankiško', 1),
(4834, 'centrą', 1),
(4834, 'paslaugų', 1),
(4834, 'socialinių', 1),
(4834, 'rajono', 2),
(4834, 'anykščių', 2),
(4834, 'rinką“', 1),
(4834, 'darbo', 2),
(4834, 'integracija', 1),
(4834, 'dvaras“', 1),
(4834, '„meikštų', 2),
(4834, 'všĮ', 1),
(4834, 'poreikiams“', 2),
(4834, 'viešiesiems', 2),
(4834, 'pritaikymas', 3),
(4834, 'dalių', 2),
(4834, 'memorialinės', 2),
(4834, 'reprezentacinės', 2),
(4834, 'muziejinės', 2),
(4834, 'sodybos', 2),
(4834, 'dvaro', 3),
(4834, '„užutrakio', 2),
(4834, 'direkciją', 1),
(4834, 'parko', 1),
(4834, 'nacionalinio', 1),
(4834, 'istorinio', 1),
(4834, 'trakų', 1),
(4834, 'kūrimas“', 1),
(4834, 'įtvarų', 1),
(4834, 'ortopedinių', 1),
(4834, '„megztų', 1),
(4834, 'technika“', 1),
(4834, '„ortopedijos', 1),
(4834, 'iškeliavo', 10),
(4834, 'apdovanota', 1),
(4834, '2012“', 10),
(4834, 'burėmis', 1),
(4834, 'sakė', 1),
(4834, 'pristatymo', 1),
(4834, 'ekonomiką“', 1),
(4834, 'modernią', 1),
(4834, 'vystyti', 1),
(4834, 'siekiant', 1),
(4834, 'svarbios', 1),
(4834, 'labai', 1),
(4834, 'yra', 1),
(4834, 'institucijos', 1),
(4834, 'valdžios', 1),
(4834, 'organizacijos', 1),
(4834, 'vyriausybinės', 1),
(4834, 'pasiektas', 1),
(4834, 'sėkmingai', 1),
(4834, 'būti', 1),
(4834, 'gali', 1),
(4834, 'rezultatas', 1),
(4834, 'siekiamas', 1),
(4834, 'jėgomis', 1),
(4834, 'bendromis', 1),
(4834, '„tik', 1),
(4834, 'svarbą', 1),
(4834, 'bendradarbiavimo', 1),
(4834, 'institucijų', 1),
(4834, 'skirtingų', 1),
(4834, 'išskyrė', 1),
(4834, 'olandijos', 1),
(4834, 'iš', 1),
(4834, 'svečias', 1),
(4834, 'awards', 1),
(4834, 'cities', 1),
(4834, '„world', 1),
(4834, 'konkurse', 1),
(4834, 'pasauliniame', 1),
(4834, 'nugalėjo', 1),
(4834, 'projektas', 1),
(4834, 'metais', 1),
(4834, 'šiais', 1),
(4834, 'apdovanojimai', 1),
(4834, 'awards”', 1),
(4834, '„regiostars', 1),
(4834, 'komisijos', 1),
(4834, 'prestižiniai', 1),
(4834, '–', 3),
(4834, 'įvertinimų', 1),
(4834, 'kurio', 1),
(4834, 'tarp', 1),
(4834, 'projektą', 11),
(4834, 'pripažintą', 1),
(4834, 'mastu', 1),
(4834, 'naujovišką', 1),
(4834, 'pristatė', 1),
(4834, 'jis', 1),
(4834, 'vermast', 2),
(4834, 'anton', 2),
(4834, 'frans', 2),
(4834, 'vykdytojas', 1),
(4834, 'projekto', 1),
(4834, 'city“', 2),
(4834, 'smart', 3),
(4834, '„amsterdam', 2),
(4834, 'atvyko', 1),
(4834, 'apdovanojimus', 1),
(4834, 'šiuos', 1),
(4834, 'specialiai', 1),
(4834, 'girdauskienė', 1),
(4834, 'elista', 1),
(4834, 'vadovė', 1),
(4834, 'skyriaus', 1),
(4834, 'turizmo', 4),
(4834, '„kiveda“', 1),
(4834, 'organizatoriaus', 1),
(4834, 'kelionių', 1),
(4834, 'kiškis', 1),
(4834, 'inesis', 1),
(4834, 'administravimo', 1),
(4834, 'sąjungos', 1),
(4834, 'europos', 7),
(4834, 'aplinkos', 1),
(4834, 'augustinienė', 1),
(4834, 'vida', 1),
(4834, 'pirmininkė', 1),
(4834, 'tarybos', 1),
(4834, 'atstovų', 1),
(4834, 'organizacijų', 1),
(4834, 'pacientų', 2),
(4834, 'Žakaitienė', 1),
(4834, 'roma', 1),
(4834, 'direktorė', 1),
(4834, 'asociacijos', 1),
(4834, 'savivaldybių', 1),
(4834, 'paškevičius', 1),
(4834, 'raimondas', 1),
(4834, 'departamento', 2),
(4834, 'koordinavimo', 1),
(4834, 'ministerijos', 2),
(4834, 'mokslo', 1),
(4834, 'Švietimo', 1),
(4834, 'katkevičius', 1),
(4834, 'aurelijus', 1),
(4834, 'redaktorius', 1),
(4834, 'vyriausiasis', 1),
(4834, 'klasės“', 1),
(4834, '„verslo', 1),
(4834, 'arlauskas', 1),
(4834, 'danas', 1),
(4834, 'generalinis', 1),
(4834, 'konfederacijos', 1),
(4834, 'darbdavių', 1),
(4834, 'verslo', 1),
(4834, 'vilys', 1),
(4834, 'mantas', 1),
(4834, 'direktorius', 4),
(4834, 'centro', 1),
(4834, 'inovacijų', 1),
(4834, 'sudarė', 1),
(4834, 'pat', 2),
(4834, 'taip', 2),
(4834, 'komisiją', 1),
(4834, 'kaušpėdo', 1),
(4834, 'algirdo', 1),
(4834, 'architekto', 1),
(4834, 'vadovaujama', 1),
(4834, 'komisija', 1),
(4834, 'kompetentinga', 1),
(4834, 'atrinko', 1),
(4834, 'balsavimui', 1),
(4834, 'viešam', 1),
(4834, 'delfi', 1),
(4834, 'portale', 1),
(4834, 'naujienų', 1),
(4834, 'esparama', 2),
(4834, 'www', 2),
(4834, 'svetainėje', 1),
(4834, 'paramos', 4),
(4834, 'struktūrinės', 2),
(4834, 'balsuojama', 1),
(4834, 'projektus', 2),
(4834, 'jaunimui', 2),
(4834, 'dirbti', 2),
(4834, 'galimybę', 2),
(4834, 'verslą', 2),
(4834, 'pažangų', 2),
(4834, 'kelius', 2),
(4834, 'atvertus', 2),
(4834, 'laisvalaikį', 2),
(4834, 'turiningą', 2),
(4830, 'sukurtas', 1),
(4830, 'šiam', 1),
(4830, 'specialiai', 1),
(4830, 'įteiktas', 1),
(4830, 'nugalėtojui', 1),
(4830, 'kitaip“', 1),
(4830, 'kurk', 1),
(4830, 'inovacijos', 1),
(4830, '„atviros', 1),
(4830, 'konferencijos', 1),
(4830, 'organizuojamos', 1),
(4830, 'tarptautinės', 1),
(4830, 'kasmetinės', 1),
(4830, 'apdovanotas', 1),
(4830, 'nugalėtojas', 1),
(4830, 'paraiškų', 1),
(4830, 'gavo', 1),
(4830, 'komisija', 1),
(4830, 'viso', 1),
(4830, 'paslaugos', 1),
(4830, 'produkto', 1),
(4830, 'sukurto', 1),
(4830, 'rezultatus', 1),
(4830, 'veiklos', 1),
(4830, 'inovatyvios', 1),
(4830, 'vykdytos', 1),
(4830, 'projekto', 1),
(4830, 'intensyvumą', 1),
(4830, 'bendradarbiavimo', 1),
(4830, 'atsižvelgiant', 1),
(4830, 'vertinamos', 1),
(4830, 'jos', 1),
(4830, 'organizacijos', 1),
(4830, 'kitos', 1),
(4830, 'asociacijos', 1),
(4830, 'institucijos', 1),
(4830, 'studijų', 1),
(4830, 'įstaigos', 1),
(4830, 'įmonės', 1),
(4830, 'asmenys', 1),
(4830, 'juridiniai', 1),
(4830, 'visi', 1),
(4830, 'pateikti', 1),
(4830, 'galėjo', 1),
(4830, 'konkursui', 2),
(4830, 'paraiškas', 1),
(4830, 'versle', 1),
(4830, 'diegimą', 1),
(4830, 'kūrimą', 1),
(4830, 'pat', 1),
(4830, 'projektus', 1),
(4830, 'bendrus', 1),
(4830, 'populiarinti', 1),
(4830, 'bendradarbiavimą', 1),
(4830, 'bet', 1),
(4830, 'inovacijų', 2),
(4830, 'metų', 1),
(4830, 'geriausią', 1),
(4830, 'išrinkti', 1),
(4830, 'tik', 1),
(4830, 'konkursu', 1),
(4830, 'sprendimais', 1),
(4830, 'inovatyviais', 1),
(4830, 'konkuruoti', 1),
(4830, 'galėtų', 1),
(4830, 'lietuva', 1),
(4830, 'dėmesio', 1),
(4830, 'skiriama', 1),
(4830, 'darbui', 1),
(4830, 'bendram', 1),
(4830, 'todėl', 1),
(4830, 'netekti', 1),
(4830, 'gali', 1),
(4830, 'šalis', 1),
(4830, 'pranašumo', 1),
(4830, 'šio', 1),
(4830, 'bėgant', 1),
(4830, 'laikui', 1),
(4830, 'tačiau', 1),
(4830, 'sąnaudos', 1),
(4830, 'jėgos', 1),
(4830, 'darbo', 1),
(4830, 'nedidelės', 1),
(4830, 'pranašumas', 1),
(4830, 'konkurencinis', 1),
(4830, 'metu', 3),
(4830, 'Šiuo', 1),
(4830, 'rinkoje', 1),
(4830, 'pasaulio', 1),
(4830, 'besikeičiančioje', 1),
(4830, 'nuolat', 1),
(4830, 'konkurencingumą', 2),
(4830, 'šalies', 1),
(4830, 'didinti', 1),
(4830, 'siekiama', 2),
(4830, 'taip', 2),
(4830, 'pajėgumus', 1),
(4830, 'konsoliduoti', 1),
(4830, 'inovacijas', 1),
(4830, 'diegti', 1),
(4830, 'subjektus', 1),
(4830, 'skatinti', 2),
(4830, 'priemonių', 1),
(4830, 'taikomų', 1),
(4830, 'iš', 2),
(4830, 'viena', 1),
(4830, '2012“', 1),
(4830, 'konkursas', 1),
(4830, 'direktorius', 1),
(4830, 'generalinis', 1),
(4830, 'laimėjusios', 1),
(4830, 'sako', 1),
(4830, 'infrastruktūrą“', 1),
(4830, 'metrologinę', 1),
(4830, 'lietuvos', 5),
(4830, 'reikšmės', 1),
(4830, 'didelės', 1),
(4830, 'šiandien', 1),
(4830, 'jau', 1),
(4830, 'projektas', 1),
(4830, 'šis', 1),
(4830, 'kad', 2),
(4830, 'neabejojame', 1),
(4830, 'žinių', 1),
(4830, 'nepakako', 1),
(4830, 'specialistams', 1),
(4830, 'kuriose', 1),
(4830, 'srityse', 1),
(4830, 'tose', 1),
(4830, 'sistemas', 1),
(4830, 'procesus', 1),
(4830, 'naujus', 1),
(4830, 'tyrimus', 1),
(4830, 'atliekant', 1),
(4830, 'pasiteisino', 1),
(4830, 'visiškai', 1),
(4830, 'šį', 2),
(4830, 'įgyvendinant', 1),
(4830, 'svarbi', 1),
(4830, 'itin', 1),
(4830, 'partnerystė', 2),
(4830, '„verslo', 2),
(4830, 'paklaidą', 1),
(4830, 'padėtį', 1),
(4830, 'mazgo', 1),
(4830, 'judančio', 1),
(4830, 'dydį', 1),
(4830, 'poslinkio', 1),
(4830, 'parametrus', 1),
(4830, 'judesio', 2),
(4830, 'tiesaus', 2),
(4830, 'apie', 1),
(4830, 'informaciją', 1),
(4830, 'visą', 1),
(4830, 'teikiančios', 1),
(4830, 'skalės', 1),
(4830, 'linijinės', 1),
(4830, 'naudoti', 1),
(4830, 'pradėtos', 1),
(4830, 'sukurtos', 1),
(4830, 'buvo', 6),
(4830, 'kuriant', 3),
(4830, 'taigi', 1),
(4830, 'poslinkis', 1),
(4830, 'jų', 1),
(4830, 'matuojamas', 1),
(4830, 'būti', 1),
(4830, 'turi', 2),
(4830, 'valdyti', 1),
(4830, 'kuriems', 1),
(4830, 'mazgų', 1),
(4830, 'sistemų', 1),
(4830, 'judančių', 1),
(4830, 'daug', 2),
(4830, 'yra', 3),
(4830, 'kuriuose', 1),
(4830, 'įrenginių', 1),
(4830, 'daugelyje', 1),
(4830, 'nanotechnologijos', 1),
(4830, 'centruose', 1),
(4830, 'apdirbimo', 1),
(4830, 'medžiagų', 1),
(4830, 'kitų', 2),
(4830, 'metalo', 1),
(4830, 'automatiniuose', 1),
(4830, 'pavyzdžiui', 1),
(4830, 'įrenginiuose', 1),
(4830, 'technologiniuose', 1),
(4830, 'reikalingas', 1),
(4830, 'tikslumas', 1),
(4830, 'toks', 1),
(4830, 'poslinkį', 1),
(4830, 'kampinį', 1),
(4830, 'linijinį', 1),
(4830, 'išmatuoti', 1),
(4830, 'tiksliai', 2),
(4830, 'labai', 1),
(4830, 'reikia', 1),
(4830, 'kai', 1),
(4830, 'naudojama', 1),
(4830, 'sistema', 1),
(4830, 'Šanino', 1),
(4830, 'andrejaus', 1),
(4830, 'direktoriaus', 1),
(4830, 'generalinio', 1),
(4830, 'pasak', 1),
(4830, 'centru', 1),
(4830, 'mokslų', 2),
(4830, 'fizinių', 1),
(4830, 'technikos', 1),
(4830, 'gedimino', 1),
(4830, 'vilniaus', 1),
(4830, 'universitetu', 3),
(4830, 'technologijos', 2),
(4830, 'kauno', 1),
(4830, 'bendradarbiaudama', 2),
(4830, 'įgyvendino', 1),
(4830, 'projektą', 3),
(4830, 'laimėtoja', 1),
(4830, 'konkurso', 3),
(4830, 'sistemą', 2),
(4830, 'poslinkių', 2),
(4830, 'technologijų', 2),
(4830, 'gamybos', 3),
(4830, 'matų', 2),
(4830, 'linijinių', 2),
(4830, 'sukūrusi', 1),
(4830, 'laimėjo', 3),
(4830, 'metais', 2),
(4830, 'šiais', 2),
(4830, 'konkursą', 5),
(4830, 'partnerystės', 4),
(4830, 'mokslo', 14),
(4830, 'verslo', 13),
(4830, 'organizuojamą', 2),
(4830, 'apdovanojimas', 1),
(4830, 'ministerijos', 5),
(4830, 'Ūkio', 5),
(4830, '–', 2),
(4830, 'prietaisui', 1),
(4830, 'matavimo', 6),
(4830, 'metrology“', 5),
(4830, '„precizika', 5),
(4830, 'uab', 6),
(4830, 'inovatyviam', 1),
(4829, 'com', 1),
(4829, 'hexagonmetrology', 1),
(4829, 'www', 1),
(4829, 'apsilankykite', 1),
(4829, 'informacijos', 1),
(4829, 'gauti', 1),
(4829, 'norėdami', 1),
(4829, 'įmonėse', 1),
(4829, 'efektyvumą', 1),
(4829, 'padidinti', 1),
(4829, 'kokybę', 1),
(4829, 'gerinti', 1),
(4829, 'procesus', 2),
(4829, 'gamybos', 2),
(4829, 'kontroliuoti', 1),
(4829, 'visiškai', 1),
(4829, 'gebėjimą', 1),
(4829, 'klientų', 1),
(4829, 'mūsų', 2),
(4829, 'stipriname', 1),
(4829, 'pasaulyje', 1),
(4829, 'visame', 1),
(4829, 'partnerių', 1),
(4829, 'pardavimo', 1),
(4829, '100', 1),
(4829, 'centrų', 1),
(4829, 'precizinių', 1),
(4829, 'demonstravimo', 1),
(4829, 'serviso', 1),
(4829, 'padalinių', 1),
(4829, 'gamybinių', 1),
(4829, 'daugiau', 3),
(4829, 'kontrolės', 1),
(4829, 'galutinės', 1),
(4829, 'surinkimo', 1),
(4829, 'iki', 1),
(4829, 'nuo', 1),
(4829, 'eigoje', 1),
(4829, 'ciklo', 1),
(4829, 'gyvavimo', 1),
(4829, 'gaminio', 1),
(4829, 'viso', 1),
(4829, 'gaminį', 1),
(4829, 'informaciją', 1),
(4829, 'naujausią', 1),
(4829, 'klientams', 2),
(4829, 'teikiame', 1),
(4829, 'pramonėje', 1),
(4829, 'medicinos', 1),
(4829, 'energetikos', 1),
(4829, 'aviacijos', 1),
(4829, 'automobilių', 1),
(4829, 'šakoms', 1),
(4829, 'pramoninės', 1),
(4829, 'tokioms', 1),
(4829, 'asortimentą', 1),
(4829, 'paslaugų', 1),
(4829, 'platų', 1),
(4829, 'siūlo', 1),
(4829, 'šakas', 1),
(4829, 'svarbias', 1),
(4829, 'labai', 1),
(4829, 'jiems', 1),
(4829, 'kurias', 1),
(4829, 'kai', 1),
(4829, 'įranga', 1),
(4829, 'metrologinę', 2),
(4829, 'tiekiant', 2),
(4829, 'pirmavimą', 2),
(4829, 'technologinį', 2),
(4829, 'pabrėžia', 2),
(4829, 'srityje', 2),
(4829, 'pramonės', 3),
(4829, 'veiklą', 1),
(4829, 'metų', 1),
(4829, '200', 1),
(4829, 'beveik', 1),
(4829, 'sėkmingą', 1),
(4829, 'reklamuodamas', 1),
(4829, 'ženklų', 1),
(4829, 'produktų', 3),
(4829, 'kitų', 1),
(4829, 'likti', 1),
(4829, 'pačiu', 1),
(4829, 'tuo', 1),
(4829, 'rinkoje', 1),
(4829, 'metrologijos', 3),
(4829, 'buvimą', 1),
(4829, 'bendrovės', 2),
(4829, 'apie', 3),
(4829, 'pabrėžti', 1),
(4829, 'elementas', 1),
(4829, 'pagrindinis', 1),
(4829, 'naudojamas', 1),
(4829, 'bus', 1),
(4829, 'prekinis', 3),
(4829, 'naujas', 3),
(4829, 'dabar', 1),
(4829, 'strategiją', 1),
(4829, 'perpozicionavo', 1),
(4829, 'kompanija', 4),
(4829, 'pastangų', 1),
(4829, 'keitimo', 1),
(4829, 'dalį', 1),
(4829, 'kaip', 5),
(4829, 'veiksmais', 1),
(4829, 'bendrais', 1),
(4829, 'siekiais', 1),
(4829, 'srityse', 2),
(4829, 'technologijų', 2),
(4829, 'vizualizavimo', 2),
(4829, 'matavimo', 2),
(4829, 'projektavimo', 3),
(4829, 'tiekėja', 2),
(4829, 'pasaulio', 3),
(4829, 'pirmaujanti', 2),
(4829, 'bendrove', 1),
(4829, 'pagrindine', 1),
(4829, 'ryšius', 1),
(4829, 'atspindi', 1),
(4829, 'tiksliau', 1),
(4827, 'įmonėje', 1),
(4827, 'specialistas', 1),
(4827, 'patyręs', 1),
(4827, 'pakankamai', 1),
(4827, 'yra', 1),
(4827, 'jis', 2),
(4827, 'pareigas', 1),
(4827, 'vadovo', 1),
(4827, 'skyriaus', 1),
(4827, 'sistemų', 1),
(4827, 'matavimo', 1),
(4827, 'ėjęs', 1),
(4827, 'anksčiau', 1),
(4827, 'Šaninas', 2),
(4827, 'andrejus', 2),
(4827, 'paskirtas', 2),
(4827, 'direktoriumi', 2),
(4827, 'generaliniu', 2),
(4827, 'uab', 4),
(4827, 'Įmonės', 2),
(4827, 'tai', 1),
(4827, 'už', 1),
(4827, 'jums', 2),
(4827, 'dėkoju', 1),
(4827, 'nuoširdžiai', 2),
(4827, 'įmonių', 2),
(4827, 'mūsų', 4),
(4827, 'tarp', 2),
(4827, 'bendradarbiavimą', 2),
(4827, 'naudingą', 1),
(4827, 'malonų', 1),
(4827, 'jumis', 1),
(4827, 'susitikimus', 1),
(4827, 'asmeninius', 1),
(4827, 'prisiminsiu', 1),
(4827, 'visuomet', 1),
(4827, 'malonumu', 1),
(4827, 'konsultantu', 1),
(4827, 'būdamas', 1),
(4827, 'veikloje', 1),
(4827, 'įmonės', 2),
(4827, 'šios', 1),
(4827, 'dalyvausiu', 1),
(4827, 'toliau', 2),
(4827, 'tačiau', 1),
(4827, 'pareigų', 1),
(4827, 'direktoriaus', 2),
(4827, 'generalinio', 2),
(4827, 'metrology', 5),
(4827, 'precizika', 5),
(4827, 'iš', 1),
(4827, 'pasitraukti', 1),
(4827, 'nutariau', 1),
(4827, 'mėnesio', 1),
(4827, 'liepos', 1),
(4827, '2011', 1),
(4827, 'nuo', 1),
(4827, 'priežasčių', 1),
(4827, 'asmeninių', 1),
(4827, 'dėl', 1),
(4827, 'partneriai', 1),
(4827, 'verslo', 1),
(4827, 'kolegos', 1),
(4827, 'bičiuliai', 1),
(4827, 'gerbiamieji', 1),
(4826, 'vytautu', 1),
(4826, 'vgtu', 1),
(4826, 'kartų', 1),
(4826, 'kasparaičiui', 1),
(4826, 'albinui', 1),
(4826, 'habil', 3),
(4826, 'prof', 3),
(4826, 'brakauskui', 1),
(4826, 'marceliui', 1),
(4826, 'darbuotojams', 1),
(4826, 'įmonės', 1),
(4826, 'taikymas', 1),
(4826, 'sukūrimas', 1),
(4826, 'tyrimas', 1),
(4826, 'mechatroninės', 1),
(4826, 'prercizinės', 1),
(4826, '„', 1),
(4826, 'ciklą', 1),
(4826, 'darbų', 1),
(4826, 'mokslinių', 1),
(4826, 'metodikos', 1),
(4826, 'sistemos', 2),
(4826, 'kalibravimo', 2),
(4826, 'linijinių', 1),
(4826, 'lazerinės', 1),
(4826, 'tikslios', 1),
(4826, 'ypač', 1),
(4826, 'etalonu', 1),
(4826, 'mato', 1),
(4826, 'ilgio', 1),
(4826, 'pirminiu', 1),
(4826, 'susietos', 1),
(4826, 'įdiegimą', 1),
(4826, 'technologijų', 1),
(4826, 'gamybos', 1),
(4826, 'sistemų', 1),
(4826, 'fotoelektrinių', 1),
(4826, 'rastrinių', 1),
(4826, 'lazerinių', 1),
(4826, 'inovatyvių', 1),
(4826, 'gamyboje', 1),
(4826, 'keitiklių', 1),
(4826, 'matavimo', 3),
(4826, 'skalių', 3),
(4826, 'sukūrimą', 3),
(4826, 'galimybių', 1),
(4826, 'naujų', 1),
(4826, 'diegimą', 1),
(4826, 'kūrimą', 1),
(4826, 'žinių', 1),
(4826, 'veiklą', 1),
(4826, 'inovatyvią', 1),
(4826, 'kompleksinę', 1),
(4826, 'nuolatinę', 1),
(4826, 'už', 2),
(4826, 'įvertinta', 1),
(4826, 'apdovanojimu', 1),
(4826, 'aikštu', 1),
(4826, 'Šiuo', 1),
(4826, 'nautraukas', 1),
(4826, 'žiūr', 1),
(4826, 'grybauskaitė', 2),
(4826, 'dalia', 2),
(4826, 'prezidentė', 2),
(4826, 'respublikos', 2),
(4826, 'lietuvos', 4),
(4826, 'įteikė', 2),
(4826, 'barakauskui', 1),
(4826, 'algimantui', 2),
(4826, 'daktarui', 1),
(4826, 'direktoriui', 1),
(4826, 'generaliniam', 1),
(4826, '2010', 4),
(4826, 'įmonė', 5),
(4826, 'ekonomikos', 4),
(4826, '„Žinių', 2),
(4826, 'prizą', 2),
(4825, 'precizika', 3),
(4825, 'pirmyn', 1),
(4825, 'žengti', 1),
(4825, 'žingsniu', 1),
(4825, 'sėkmingu', 1),
(4825, 'sparčiu', 1),
(4825, 'pat', 1),
(4825, 'tokiu', 1),
(4825, 'linkime', 1),
(4825, 'bei', 1),
(4825, 'kelią', 1),
(4825, 'ilgą', 1),
(4825, 'tokį', 1),
(4825, 'nuėjus', 1),
(4825, 'komandą', 1),
(4825, 'darbuotojų', 1),
(4825, 'visą', 1),
(4825, 'sveikiname', 1),
(4825, 'rezultatus', 1),
(4825, 'veiklos', 1),
(4825, 'už', 1),
(4825, 'premijas', 1),
(4825, 'technikos', 1),
(4825, 'mokslo', 1),
(4825, 'lietuvos', 1),
(4825, 'darbuotojai', 1),
(4825, 'pripažinimą', 1),
(4825, 'institucijų', 1),
(4825, 'valstybės', 2),
(4825, 'klientų', 1),
(4825, 'pelnė', 1),
(4825, 'produktai', 1),
(4825, 'Įmonės', 1),
(4825, 'poreikius', 1),
(4825, 'vartotojų', 1),
(4825, 'tenkinti', 1),
(4825, 'geriau', 1),
(4825, 'taip', 1),
(4825, 'tobulėti', 1),
(4825, 'nuolat', 1),
(4825, 'produktus', 1),
(4825, 'technologijų', 1),
(4825, 'aukštųjų', 1),
(4825, 'technologijas', 1),
(4825, 'aukštąsias', 1),
(4825, 'kurti', 1),
(4825, 'dabar', 1),
(4825, 'liko', 1),
(4825, 'visada', 1),
(4825, 'tikslas', 1),
(4825, 'pagrindinis', 1),
(4825, 'vardas', 1),
(4825, 'statusas', 1),
(4825, 'įmonės', 1),
(4825, 'keitėsi', 1),
(4825, 'pokyčių', 1),
(4822, 'aktualiais', 1),
(4822, 'įmonei', 1),
(4822, 'kitais', 1),
(4822, 'ruošimu', 1),
(4822, 'specialistų', 1),
(4822, 'kūrimu', 1),
(4822, 'produktų', 1),
(4822, 'naujų', 1),
(4822, 'domėjosi', 1),
(4822, 'produkcija', 1),
(4822, 'įmonės', 1),
(4822, 'svečiai', 1),
(4822, 'garbingi', 1),
(4822, 'galinienė', 2),
(4822, 'nijolė', 2),
(4822, 'ponia', 2),
(4822, 'vadovė', 2),
(4822, 'skyriaus', 2),
(4822, 'ekonomikos', 2),
(4822, 'ambasados', 2),
(4822, 'ruigrok', 2),
(4822, 'annemieke', 2),
(4822, 'ambasadorė', 2),
(4822, 'karalystės', 2),
(4822, 'nyderlandų', 2),
(4822, 'susipažino', 2),
(4822, 'veikla', 2),
(4822, 'darbo', 1),
(4822, 'lankėsi', 2),
(4822, 'metrology', 1),
(4822, '„precizika', 1),
(4822, 'uab', 1),
(4822, '2008', 1),
(4822, 'vasario', 1),
(4822, 'įmonėje', 1),
(4822, 'svečių', 2),
(4822, 'Įmonėje', 1),
(4822, 'garbingų', 2),
(4822, 'klausimais', 1),
(4821, 'laimėtoja', 2),
(4821, 'medalio', 2),
(4821, '–', 2),
(4821, 'sistema“', 2),
(4821, 'institutais', 1),
(4821, 'tyrimų', 1),
(4821, 'mokslinių', 1),
(4821, 'universitetais', 1),
(4821, 'technikos', 1),
(4821, 'bendradarbiaujant', 1),
(4821, 'pasiektas', 1),
(4821, 'įvertinimas', 1),
(4821, 'rezultatų', 1),
(4821, 'darbo', 1),
(4821, 'kolektyvo', 1),
(4821, 'gražus', 1),
(4821, 'laimėjimas', 1),
(4821, 'Šis', 1),
(4821, 'medalį', 1),
(4821, 'aukso', 3),
(4821, 'apdovanojimą', 2),
(4821, '2007', 1),
(4821, 'konkurso', 2),
(4821, 'ilgio', 4),
(4821, 'kalibravimo', 4),
(4821, 'sistema', 2),
(4821, 'laimėjo', 2),
(4821, 'garbingiausią', 2),
(4821, '„precizinė', 4),
(4821, 'gaminama', 2),
(4837, 'klientams', 1),
(4837, 'mūsų', 1),
(4837, 'pranešame', 1),
(4837, 'naujieną', 1),
(4837, 'malonią', 1),
(4837, 'Šią', 1),
(4837, 'laimėjimu', 1),
(4837, 'šiuo', 1),
(4837, 'džiaugiamės', 1),
(4837, 'metodus', 1),
(4837, 'vadybos', 1),
(4837, 'efektyvius', 1),
(4837, 'naujus', 1),
(4837, 'taikant', 1),
(4837, 'produktus', 1),
(4837, 'naujas', 1),
(4553, 'rotary', 1),
(4553, 'exhibiting', 1),
(4553, 'will', 1),
(4553, 'see', 1),
(4553, 'hope', 1),
(4553, 'and we', 1),
(4553, 'year''s', 1),
(4553, 'excited', 1),
(4553, 'visit us anytime', 1),
(4553, 'come', 1),
(4553, 'can', 1),
(4553, 'convenience', 1),
(4553, 'logo', 1),
(4553, 'marked', 1),
(4553, '4a ', 1),
(4553, '544', 1),
(4553, 'stand', 2),
(4553, 'help', 1),
(4553, 'map', 1),
(4553, 'easily', 1),
(4553, 'find', 2),
(4553, 'able', 1),
(4553, 'should', 1),
(4553, 'hall', 2),
(4296, 'užtikrinti', 1),
(4296, 'yra', 2),
(4296, 'svarbiausia', 1),
(4296, 'įmonei', 1),
(4521, 'formą', 1),
(4521, 'karjeros', 1),
(4521, 'šią', 1),
(4521, 'užpildykite', 1),
(4521, 'prašome', 1),
(4521, 'narių', 1),
(4521, 'komandos', 1),
(4521, 'naujų', 1),
(4521, 'ieško', 1),
(4521, 'nuolatos', 1),
(4521, 'įmonė', 1),
(4521, 'mūsų', 1),
(4521, 'karjera', 4),
(3707, 'tapti', 5),
(3707, 'noriu', 4),
(3707, 'anketą', 1),
(3707, 'mes', 1),
(3707, 'pasistengsime', 1),
(3707, 'jums', 1),
(3707, 'kuo', 1),
(3707, 'greičiau', 1),
(3707, 'atsakyti', 1),
(4441, 'glass', 1),
(4441, 'brosiūros', 4),
(4632, 'pvm', 1),
(4632, '210017950', 1),
(4632, 'kodas', 2),
(4632, 'Įmonės', 1),
(4632, ' lietuva', 1),
(4632, 'vilnius', 1),
(4632, '09120', 1),
(4632, '139', 1),
(4632, 'Žirmūnų', 1),
(4632, 'adresas', 1),
(4632, 'support@precizika', 1),
(4632, 'aptarnavimo', 1),
(4632, 'marketing@precizika', 1),
(4632, 'marketingo', 1),
(4632, 'Įranga', 1),
(4632, 'matavimo', 1),
(4634, 'pvm', 1),
(4634, '210017950', 1),
(4634, 'kodas', 2),
(4634, 'Įmonės', 1),
(4634, 'lietuva', 1),
(4634, 'vilnius', 1),
(4634, '09120', 1),
(4634, '139', 1),
(4634, 'Žirmūnų', 1),
(4634, 'adresas', 1),
(4634, 'support@precizika', 1),
(4634, 'aptarnavimo', 1),
(4634, 'marketing@precizika', 1),
(4634, 'marketingo', 1),
(4634, 'Įranga', 1),
(4634, 'matavimo', 1),
(4634, '3608', 1),
(4634, 'rastrai', 1),
(4634, 'keitikliai', 1),
(4634, '3683', 1),
(4634, 'sales@precizika', 1),
(4634, 'skyrius', 3),
(4634, 'pardavimų', 1),
(4634, '3609', 1),
(4634, 'fax', 1),
(4634, '3600', 1),
(4634, '236', 4),
(4634, '370', 4),
(4553, 'germany', 2),
(4553, 'gratings', 1),
(4553, 'scale', 1),
(4553, 'glass', 1),
(4553, 'well', 1),
(4553, 'encoders', 1),
(4553, ' in', 1),
(4553, 'our stand', 1),
(4553, 'tasks', 1),
(4553, 'solutions', 1),
(4553, 'right', 1),
(4553, 'search', 1),
(4553, 'platform', 1),
(4553, 'perfect', 1),
(4553, 'offer', 1),
(4553, 'conference', 1),
(4553, 'adjoining', 1),
(4553, 'fair', 1),
(4553, 'trade', 1),
(4553, 'nuremberg', 1),
(4553, 'november', 1),
(4553, 'industry', 1),
(4553, 'within', 1),
(4553, 'innovations', 1),
(4821, 'metrology', 2),
(4821, '„precizika', 2),
(4821, 'uab', 2),
(4821, 'jog', 1),
(4821, 'pranešti', 1),
(4821, 'galėdami', 1),
(4821, 'didžiuojamės', 1),
(4821, 'džiaugiamės', 1),
(4821, 'konkursą', 1),
(4821, 'gaminio', 2),
(4821, 'metų', 2),
(4751, 'spauskite', 1),
(4636, 'komandą', 1),
(4636, 'veiklos', 1),
(4636, 'už', 1),
(4636, 'premijas', 1),
(4636, 'technikos', 1),
(4636, 'mokslo', 1),
(4636, 'lietuvos', 1),
(4636, 'darbuotojai', 1),
(4636, 'pripažinimą', 1),
(4636, 'institucijų', 1),
(4636, 'valstybės', 2),
(4636, 'klientų', 1),
(4636, 'pelnė', 1),
(4636, 'produktai', 1),
(4636, 'Įmonės', 1),
(4636, 'poreikius', 1),
(4636, 'vartotojų', 1),
(4636, 'tenkinti', 1),
(4636, 'geriau', 1),
(4636, 'taip', 1),
(4636, 'tobulėti', 1),
(4636, 'nuolat', 1),
(4636, 'produktus', 1),
(4636, 'technologijų', 1),
(4636, 'aukštųjų', 1),
(4636, 'technologijas', 1),
(4636, 'aukštąsias', 1),
(4636, 'kurti', 1),
(4636, 'dabar', 1),
(4636, 'liko', 1),
(4636, 'visada', 1),
(4636, 'tikslas', 1),
(4636, 'pagrindinis', 1),
(4636, 'vardas', 1),
(4636, 'statusas', 1),
(4636, 'įmonės', 1),
(4636, 'keitėsi', 1),
(4636, 'pokyčių', 1),
(4636, 'organizacinių', 1),
(4636, 'įvykių', 1),
(4636, 'daug', 1),
(4636, 'buvo', 2),
(4636, 'laiką', 1),
(4636, 'praėjusį', 1),
(4636, 'per', 1),
(4636, 'biuras', 1),
(4636, 'konstravimo', 1),
(4636, 'specialus', 1),
(4636, '–', 2),
(4636, 'pirmtakas', 1),
(4636, '„precizika“', 1),
(4636, 'metrology“', 1),
(4636, '„precizika', 1),
(4636, 'dabartinių įmonių', 1),
(4636, 'veiklą', 1),
(4636, 'pradėjo', 1),
(3729, '                     ', 1),
(3729, '     ', 1),
(3729, '                                              ', 1),
(3729, '                                           ', 1),
(3729, '  ', 1),
(4636, 'mėnesį', 1),
(4636, 'rugsėjo', 1),
(4636, '1960', 1),
(4636, 'kai', 1),
(4636, 'dienos', 1),
(4636, 'tos', 1),
(4636, 'nuo', 1),
(4636, 'penktas dešimtmetis', 1),
(4636, 'baigėsi', 1),
(4838, 'laikotarpyje', 1),
(4838, 'metų', 1),
(4838, 'pusantrų', 1),
(4838, 'įmonė', 2),
(4838, 'dėka', 1),
(4838, 'paramos', 1),
(4838, 'finansinės', 2),
(4838, 'gautos', 1),
(4838, 'parama', 1),
(4838, 'plėtros', 1),
(4839, 'tyrimai“', 1),
(4839, 'sukūrimo', 3),
(4839, 'technologijos', 4),
(4839, 'lazerinės', 3),
(4839, 'skalės', 4),
(4839, 'rastrinės', 3),
(4839, 'metalinės', 3),
(4840, 'metrology“', 2),
(4840, '„precizika', 2),
(4840, 'uab', 2),
(4841, 'rastrinių', 4),
(4841, 'ilgų', 3),
(4841, '„siaurų', 3),
(4841, 'projektą', 2),
(4841, 'įvykdė', 1),
(4841, 'metrology“', 1),
(4841, '„precizika', 1),
(4841, 'uab', 1),
(4843, 'sistemų', 6),
(4843, 'matavimo', 6),
(4843, '„inovatyvių', 3),
(4843, 'projektą', 1),
(4843, 'finansuojamą', 1),
(4843, 'lėšomis', 1),
(4843, 'fondo', 2),
(4843, 'plėtros', 5),
(4843, 'regioninės', 2),
(4843, 'sąjungos', 2),
(4843, 'europos', 4),
(4843, 'dalies', 1),
(4843, 'iš', 4),
(4845, 'inovacine', 1),
(4845, 'sukūrimas', 1),
(4845, 'skalės', 5),
(4845, 'matavimo', 7),
(4845, 'naujos', 4),
(4845, '„kokybiškai', 3),
(4845, 'projektą', 1),
(4845, 'finansuojamą', 1),
(4845, 'lėšomis', 1),
(4845, 'fondo', 2),
(4845, 'plėtros', 2),
(4845, 'regioninės', 2),
(4845, 'sąjungos', 1),
(4845, 'europos', 3),
(4845, 'dalies', 1),
(4845, 'iš', 4),
(4845, 'įgyvendina', 1),
(4845, 'gruodžio', 1),
(4845, '2011', 1),
(4845, 'iki', 2),
(4845, 'mėn', 2),
(4845, 'rugpjūčio', 1),
(4845, '2009', 1),
(4845, 'nuo', 1),
(4845, 'metrology', 1),
(4845, 'precizika', 1),
(4845, 'uab', 1),
(4853, 'sukūrimas', 4),
(4853, 'technologijos', 3),
(4853, 'gamybos', 11),
(4853, 'originalų', 9),
(4853, 'skalių', 12),
(4853, 'kodinių', 8),
(4853, 'pavadinimas', 1),
(4853, 'metrology“', 1),
(4853, '„precizika', 1),
(4853, 'uab', 1),
(4853, 'vykdytojas', 1),
(4853, 'projekto', 3),
(4852, 'vykdomas', 1),
(4852, 'buvo', 1),
(4852, 'nanoprint', 1),
(4852, 'nanostructures', 1),
(4852, 'dimensional', 1),
(4852, 'novel', 1),
(4852, 'lithography', 1),
(4852, 'nanoimprint', 1),
(4852, '5112667', 3),
(4850, 'Įgyvendindama', 1),
(4850, '0019', 1),
(4850, 'erpf', 1),
(4850, 'bpd2004', 1),
(4850, 'sukūrimas', 3),
(4850, 'technologijos', 4),
(4850, 'gamybos', 6),
(4850, 'skalių', 6),
(4850, 'rastrinių', 6),
(4850, 'metalinių', 6),
(4850, 'naujos', 3),
(4850, 'pavadinimas', 1),
(4850, 'metrology“', 1),
(4850, '„precizika', 2),
(4850, 'uab', 2),
(4850, 'vykdytojas', 1),
(4850, 'projekto', 4),
(4849, 'lėšomis', 1),
(4849, 'paramos', 1),
(4849, 'plėtra', 1),
(4849, 'technologinė', 1),
(4849, 'tyrimai', 1),
(4849, 'moksliniai', 1),
(4849, 'skirti', 1),
(4849, 'augimui', 1),
(4849, 'konkurencingumui', 1),
(4849, 'Ūkio', 1),
(4849, 'prioritetas', 1),
(4849, 'programos', 1),
(4849, 'augimo', 1),
(4849, 'ekonomikos', 2),
(4849, 'programa', 2),
(4849, 'veiksmų', 3),
(4847, 'technologijomis', 1),
(4847, 'įgyvendintas', 1),
(4847, 'projektas', 2),
(4847, '026', 1),
(4847, 'Ūm', 1),
(4847, 'vp2', 1),
(4847, 'projekto', 5),
(4847, 'sistemą', 3),
(4847, 'mechatroninę', 3),
(4847, 'matavimo', 5),
(4847, 'pozicionavimo', 4),
(4847, 'skyros', 4),
(4847, 'aukštos', 4),
(4847, 'sukurti', 2),
(4847, 'siekiant', 1),
(4847, 'atlikimui', 1),
(4847, 'veiklų', 4),
(4847, 'tyrimų', 2),
(4847, 'mokslinių', 2),
(4847, '„pasirengimas', 1),
(4847, 'projektą', 1),
(4847, 'finansuojamą', 1),
(4847, 'lėšomis', 1),
(4847, 'fondo', 2),
(4847, 'plėtros', 2),
(4847, 'regioninės', 2),
(4847, 'sąjungos', 2),
(4847, 'europos', 4),
(4847, 'dalies', 1),
(4847, 'iš', 4),
(4847, 'įgyvendino', 1),
(4847, 'spalio', 1),
(4847, '2010', 1),
(4847, 'iki', 3),
(4847, 'mėn', 2),
(4847, 'lapkričio', 1),
(4847, '2009', 1),
(4847, 'nuo', 1),
(4847, 'metrology', 1),
(4847, 'precizika', 1),
(4847, 'uab', 1),
(4837, 'technologijas', 1),
(4837, 'inovatyvius', 1),
(4837, 'gamyboje', 1),
(4837, 'įsisavinant', 1),
(4837, 'kuriant', 1),
(4837, 'įvertinimas', 1),
(4632, '3608', 1),
(4632, 'rastrai', 1),
(4632, 'keitikliai', 1),
(4632, '3683', 1),
(4632, 'sales@precizika', 1),
(4632, 'skyrius', 3),
(4632, 'pardavimų', 1),
(4632, '3609 ', 1),
(4632, 'fax', 1),
(4632, '3600', 1),
(4632, '236', 4),
(4632, '370', 4),
(4632, 'tel', 3),
(4632, 'info@precizika', 1),
(4632, 'paštas', 4),
(4632, 'informacija', 1),
(4632, 'bendra', 1),
(4632, 'kontaktai', 4),
(4837, 'pastangų', 1),
(4837, 'kolektyvo', 1),
(4837, 'įmonės', 1),
(4837, 'viso', 1),
(4837, 'garbingas', 1),
(4837, 'tai', 1),
(4837, 'įmonė', 1),
(5073, 'englis', 2),
(5073, 'new', 2),
(5072, 'projects', 4),
(5070, 'news', 4),
(5069, 'news', 4),
(5073, 'test', 2),
(5073, 'adsad', 1),
(5073, 'asdsad', 1),
(5073, 'jpg', 1),
(5073, 'sample_b', 1),
(5066, 'deserve', 1),
(5066, 'expect', 1),
(5066, 'support they', 1),
(5066, 'provide', 1),
(5066, 'customers', 1),
(5066, 'products', 1),
(5066, 'quality', 1),
(5066, 'best possible', 1),
(5066, 'and constantly bring', 1),
(5066, 'evolve', 1),
(5066, 'we continue', 1),
(5066, 'year', 1),
(4903, 'results', 1),
(4903, 'best', 1),
(4903, 'finally', 1),
(4903, 'cooperation', 1),
(4903, 'lasting', 1),
(4903, 'long', 1),
(4903, 'leads', 1),
(4903, 'attention', 1),
(4903, 'human', 1),
(4903, 'sincere', 1),
(4903, 'attitude', 1),
(4903, 'sure', 1),
(4903, 'customers', 1),
(4903, 'inquiry', 1),
(4903, 'every', 1),
(4903, 'attentive', 1),
(4903, 'personnel', 1),
(4903, 'users', 1),
(4903, 'trains', 1),
(4903, 'installation', 1),
(4903, 'executes', 1),
(4903, 'suppliers', 1),
(4903, 'companies', 1),
(4903, 'known', 1),
(4903, 'worldwide', 1),
(4903, 'represents', 1),
(4903, 'components', 1),
(4903, 'parts', 1),
(4903, 'mechanical', 1),
(4903, 'displacement', 1),
(4903, 'rotary', 1),
(4903, 'gratings', 1),
(4903, 'glass', 1),
(4903, 'angular', 1),
(4903, 'linear', 2),
(4903, 'main', 1),
(4903, 'basis', 1),
(4903, 'timely', 1),
(4903, 'demands', 1),
(4903, 'customer', 1),
(4903, 'services', 2),
(4903, 'products', 2),
(4903, 'quality', 1),
(4751, 'šį', 1),
(4903, 'high', 1),
(4903, 'consistently', 1),
(4903, 'goal', 1),
(4903, 'company''s', 2),
(4903, '9001', 1),
(4903, '2003', 1),
(4903, '9002', 1),
(4903, 'iso', 2),
(4903, 'requirements', 1),
(4903, 'meet', 2),
(4903, 'fully', 1),
(4903, 'certified', 1),
(4903, 'process', 1),
(4903, '2000', 1),
(4903, 'manufacturing', 1),
(4903, 'scale', 2),
(4903, 'optical', 1),
(4903, 'development', 1),
(4903, 'well', 1),
(4903, 'factories', 1),
(4903, 'automate', 1),
(4903, 'systems', 2),
(4903, 'technology', 2),
(4903, 'measuring', 3),
(4903, 'supply', 2),
(4903, 'years', 1),
(4903, 'fifty', 1),
(4903, 'involved', 1),
(4903, 'workforce', 1),
(4903, 'equipment', 2),
(4903, 'metrological', 1),
(4903, 'production', 2),
(4903, 'design', 1),
(4903, 'leadership', 1),
(4903, 'traditions', 1),
(5003, 'tools', 1),
(5003, 'machines', 1),
(5003, 'coordinate', 1),
(5003, 'equipment', 1),
(5003, 'geometric', 1),
(5003, 'special', 1),
(5003, '200', 1),
(5003, 'diameters', 1),
(5003, 'shaped', 1),
(5003, 'disco', 1),
(5003, 'length', 1),
(5003, '3400', 1),
(5003, 'scales', 2),
(5003, 'system', 1),
(5003, 'detection', 1),
(5003, 'measuring', 4),
(5003, 'customized', 1),
(5003, 'create', 1),
(5003, 'electronics', 1),
(5003, 'unit', 1),
(5003, 'scanning', 1),
(5003, 'provides', 1),
(5003, 'user', 1),
(5003, 'applications', 1),
(5003, 'intended', 1),
(5003, 'configurations', 2),
(5003, 'variety', 1),
(5003, 'available', 2),
(5003, 'gratings', 3),
(5003, 'scale', 2),
(5003, 'glass', 3),
(5003, 'needs', 1),
(5003, 'personal', 1),
(5003, 'satisfy', 1),
(5003, 'can', 1),
(5003, 'range', 1),
(5003, 'wide', 1),
(5003, 'compatible', 1),
(5003, 'devices', 1),
(4925, '473', 1),
(4925, 'company', 4),
(4903, 'old', 1),
(4903, 'history', 1),
(4903, 'proud', 1),
(4903, 'sharpe', 1),
(4751, 'apie', 1),
(4903, '&amp', 1),
(4903, 'brown', 1),
(4903, 'venture', 1),
(4903, 'joint', 1),
(4903, 'american', 1),
(4903, 'lithuanian', 1),
(4903, 'former', 1),
(4751, 'informacijos', 1),
(4903, 'name', 1),
(4903, 'new', 1),
(4903, 'metrology', 3),
(5066, ' year', 1),
(5066, 'industry', 1),
(5066, 'working', 1),
(5066, 'of experience', 1),
(5066, 'state', 1),
(5066, 'can', 1),
(5066, 'pride', 1),
(5066, 'great', 1),
(5066, 'heritage', 1),
(5066, 'company''s', 1),
(5066, 'proud', 1),
(5066, 'experience', 5),
(4938, 'produktas', 2),
(4938, 'naujas', 2),
(4938, 'Čia', 1),
(4827, 'įmonei', 1),
(4827, 'algimantas', 1),
(4827, 'marcelis', 1),
(4827, 'barakauskas', 1),
(4827, 'naujas', 2),
(4827, 'generalinis', 2),
(4827, 'direktorius', 2),
(4829, 'ženklas', 4),
(4829, 'atnaujintas', 1),
(4829, 'pagrindu', 2),
(4829, 'strategijos', 1),
(4827, 'jūsų', 1),
(4827, 'asmeniškai', 1),
(4827, 'sėkmės', 2),
(4827, 'linkiu', 1),
(4827, 'aš', 1),
(4827, 'tęs', 1),
(4827, 'verslą', 1),
(4827, 'plės', 1),
(4444, 'pavadinimas', 1),
(4444, 'gratings', 1),
(4444, 'scale', 1),
(4444, 'glass', 1),
(4444, 'prezentacijos', 4),
(4751, 'detalesnės', 1),
(4751, 'norite', 1),
(4751, ' jei', 1),
(4751, 'periodas', 1),
(4553, 'trends', 1),
(4553, 'products', 1),
(4553, 'inform', 1),
(4553, 'world', 1),
(4553, 'around', 1),
(4553, 'technology', 1),
(4553, 'suppliers', 1),
(4634, 'tel', 3),
(4901, 'device', 2),
(4901, 'measuring', 2),
(4888, 'metrology', 1),
(4888, 'precizika', 1),
(4888, 'changed', 1),
(4888, 'name', 1),
(4888, 'ownership', 1),
(4888, '100%', 1),
(4901, 'circumference', 1),
(4901, '5310a', 1),
(4901, 'processing', 2),
(4901, 'gear', 2),
(4901, '3e12', 1),
(4901, 'universal', 1),
(4901, '3e153', 1),
(4901, 'machine', 5),
(4903, 'precizika', 4),
(4903, 'company', 5),
(4445, 'pavadinimas', 1),
(4445, 'gratings', 1),
(4445, 'scale', 1),
(4445, 'glass', 1),
(4445, 'video', 2),
(4445, 'video_atsisiusti', 2),
(4839, '„kodinės', 1),
(4839, 'projektą', 2),
(4839, 'įvykdė', 1),
(4839, 'metrology“', 1),
(4839, '„precizika', 1),
(4839, 'uab', 1),
(4839, 'keliu', 2),
(4839, 'progreso', 2),
(4839, 'žingsnis', 2),
(4839, 'svarbus', 2),
(4839, 'labai', 3),
(4839, 'bet', 2),
(4839, 'nedidelis', 2),
(4839, 'Žengtas', 2),
(4837, '„inovatyvi', 1),
(4837, 'kategorijoje', 1),
(4837, 'nugalėtoja', 4),
(4837, '2007', 1),
(4837, 'prizas', 4),
(4837, '„inovacijų', 4),
(4837, 'konkurso', 4),
(4901, 'grinding', 2),
(4901, 'circular', 2),
(4901, 'first', 5),
(4901, 'founded', 1),
(4901, 'history', 4),
(5066, 'years', 6),
(4904, '  ', 1),
(4904, '                                           ', 1),
(4904, '                                              ', 1),
(4904, '     ', 1),
(4904, '                     ', 1),
(5059, '510', 1),
(4296, 'mūsų', 1),
(4296, 'pagalba', 5),
(4296, 'mes', 1),
(4296, 'padėsime', 1),
(4495, 'pateikia', 1),
(4495, 'vartotojas', 1),
(4495, 'kuriose', 1),
(4495, 'aplikacijose', 1),
(4495, 'naudojami', 1),
(4495, 'jie', 1),
(4495, 'rastrus', 2),
(4495, 'konfiguracijų', 1),
(4495, 'įvairių', 1),
(4495, 'gaminame', 1),
(4495, 'rastrai', 1),
(4495, 'plačiau', 3),
(4495, 'poreikius', 1),
(4495, 'jūsų', 1),
(4495, 'įvairius', 1),
(4495, 'patenkinti', 1),
(4495, 'galime', 1),
(4495, 'todėl', 1),
(4495, 'pasirinkimą', 1),
(4495, 'keitiklių', 1),
(4495, 'platų', 1),
(4495, 'turime', 1),
(4495, 'įtaisai', 1),
(4495, 'rodmenų', 1),
(4495, 'šių', 1),
(4495, 'parduodami', 1),
(4495, 'pat', 1),
(4495, 'taip', 1),
(4495, 'matavimo', 4),
(4495, 'poslinkių', 2),
(4495, 'kampinių', 1),
(4495, 'linijinių', 1),
(4495, 'magnetiniai', 1),
(4495, 'fotoelektriniai', 1),
(4495, 'gaminami', 1),
(4495, 'yra', 2),
(4495, 'įmonėje', 1),
(4495, 'metrology', 1),
(4495, 'precizika', 1),
(4495, 'uab', 1),
(4495, 'keitikliai', 2),
(4495, 'produktai', 4),
(4837, 'nacionalinio', 2),
(4837, 'tapo', 2),
(4837, 'metrology', 1),
(4837, '„precizika', 4),
(4837, 'uab', 4),
(4506, 'testinis', 1),
(4506, 'fdsdf', 1),
(4514, 'naujienlaiškiai', 4),
(4444, 'parsisiųsti', 2),
(4445, 'parsisiųsti', 2),
(4507, 'sdasd', 1),
(4507, 'raktas', 1),
(4505, 'sadas', 1),
(4505, 'test', 1),
(4505, 'data', 1),
(4508, 'sadas', 1),
(4508, 'test', 1),
(4508, 'data', 1),
(4553, 'meet', 1),
(4553, 'automation', 3),
(4553, 'electric', 2),
(4553, 'exhibition', 6),
(4553, 'leading', 1),
(4553, 'europe’s', 1),
(4553, '2014', 3),
(4553, 'drives', 4),
(4553, 'ipc', 4),
(4553, 'sps', 4),
(4553, 'attending', 1),
(4553, 'metrology', 3),
(4553, 'precizika', 3),
(4551, 'susisiekta', 1),
(4551, 'bus', 1),
(4551, 'jumis', 1),
(4551, 'esančią anketą', 1),
(4551, 'kairėje', 1),
(4551, 'užpildykite', 1),
(4551, 'specialistais', 1),
(4551, 'pasikonsultuoti', 1),
(4551, 'norite', 1),
(4551, 'produktą', 1),
(4551, 'apie', 1),
(4551, 'klausimų', 1),
(4551, 'papildomų', 1),
(4551, 'turite', 1),
(4551, 'neaiškumų', 1),
(4551, 'iškilo', 1),
(4551, 'jeigu', 1),
(4551, 'mūsų', 1),
(4551, 'klauskite', 1),
(4452, 'united', 2),
(4452, 'states', 2),
(4836, '„precizika', 2),
(4836, 'uab', 2),
(4836, 'Įmonė', 1),
(4821, '„lietuvos', 2),
(4821, 'surengė', 1),
(4821, 'kartą', 1),
(4821, 'vienuoliktą', 1),
(4821, 'jau', 1),
(4821, 'konfederacija', 1),
(4838, 'fondo', 1),
(4838, 'regioninės', 1),
(4838, 'europos', 1),
(4838, 'dalinė', 1),
(4838, 'gauta', 1),
(4838, 'buvo', 2),
(4838, 'kuriam', 1),
(4838, '123', 1),
(4838, 'Ūm', 1),
(4838, 'vp2', 1),
(4838, 'skatinimas“', 1),
(4838, 'rinkose', 3),
(4838, 'užsienio', 3),
(4838, 'pardavimų', 4),
(4838, '„Įmonės', 1),
(4838, 'projektą', 1),
(4838, 'įvykdė', 1),
(4838, 'metrology“', 1),
(4838, '„precizika', 1),
(4838, 'uab', 1),
(4838, 'keliu', 2),
(4838, 'eksporto', 4),
(4838, 'plėtimo', 2),
(4838, 'rinkų', 4),
(4495, 'kitokias', 1),
(4495, 'specialias', 1),
(4495, 'geometrines', 1),
(4495, 'konfiguracijas', 1),
(4495, 'įranga', 1),
(4495, 'parduodame', 1),
(4495, 'mašinas', 1),
(4495, 'konsultuojame', 1),
(4495, 'atliekame', 1),
(4495, 'jų', 1),
(4495, 'servisą', 1),
(4838, 'nomenklatūros', 2),
(4888, 'group', 1),
(4888, 'hexagon', 1),
(4888, 'purchased', 1),
(4888, 'company', 1),
(4888, 'usa', 1),
(4888, 'sharpe', 1),
(4888, '&amp', 1),
(4888, 'brown', 1),
(4888, 'venture', 1),
(4888, 'joint', 1),
(4888, 'established', 1),
(4888, 'development ', 1),
(4888, 'encoders', 1),
(4888, 'prize', 1),
(4888, 'science', 1),
(4888, 'national', 1),
(4888, '178', 1),
(4888, 'inspection', 1),
(4888, 'new', 1),
(4888, 'developed', 1),
(4888, '140k', 1),
(4888, 'coordinate', 1),
(4888, 'precision', 1),
(4888, 'high', 1),
(4888, 'production', 1),
(4888, 'serial', 1),
(4888, 'rotary', 1),
(4888, 'beginning', 1),
(4888, 'encoder', 3),
(4888, 'linear', 1),
(4888, '20a', 1),
(4888, 'device', 2),
(4888, 'measuring', 2),
(4888, 'circumference', 1),
(4888, '5310a', 1),
(4888, 'processing', 2),
(4888, 'gear', 2),
(4888, '3e12', 1),
(4888, 'universal', 1),
(4888, '3e153', 1),
(4888, 'machine', 5),
(4888, 'grinding', 2),
(4888, 'circular', 2),
(4888, 'first', 5),
(4888, 'founded', 1),
(4636, 'patirtis', 5),
(4636, 'metų', 5),
(4634, 'info@precizika', 1),
(4634, 'paštas', 4),
(4634, 'informacija', 1),
(4634, 'bendra', 1),
(4634, 'kontaktai', 4),
(4938, 'rasite', 1),
(4938, 'informacijos', 1),
(4938, 'daugiau', 1),
(4938, 'biss', 1),
(4938, 'arba', 1),
(4938, 'ssi', 1),
(4938, 'sąsaja', 1),
(4938, 'rezoliucija', 1),
(4938, 'μm', 2),
(4938, '±1', 1),
(4938, '±3', 1),
(4938, 'temperatūroje', 1),
(4938, '20°c', 1),
(4938, 'metre', 1),
(4938, 'ilgio', 1),
(4938, 'kuriame', 1),
(4938, 'bet', 1),
(4938, 'klaida', 1),
(4938, 'poslinkio', 1),
(4938, '3240', 1),
(4938, 'iki', 2),
(4938, 'nuo', 1),
(4838, 'gaminių', 2),
(4838, 'žengti', 2),
(4838, 'postūmis', 2),
(4829, 'kūrimo', 2),
(4829, 'ženklo', 3),
(4829, 'prekinio', 3),
(4829, 'logotipo', 1),
(4829, 'kompanijos', 5),
(4829, 'suformuotas', 1),
(4829, 'kuris', 1),
(4829, 'ženklą', 3),
(4829, 'prekės', 3),
(4829, 'korporacijos', 3),
(4829, 'naują', 3),
(4829, 'savo', 3),
(4829, 'pristatė', 1),
(4829, 'bendrovė', 1),
(4829, 'akcijomis', 1),
(4829, 'padalinys', 1),
(4829, 'kad', 1),
(4825, 'organizacinių', 1),
(4825, 'daug', 1),
(4825, 'įvykių', 1),
(4825, 'buvo', 2),
(4825, 'laiką', 1),
(4825, 'per', 1),
(4825, 'praėjusį', 1),
(4825, 'biuras', 1),
(4825, 'konstravimo', 1),
(4822, 'vizitas', 2),
(4904, '                                                                     ', 1),
(4904, '            ', 1),
(4904, '             ', 1),
(4904, '   ', 1),
(4904, 'group', 4),
(4904, 'precizika', 4),
(5003, 'readout', 1),
(5003, 'digital', 1),
(5003, 'sell', 2),
(5003, 'also', 1),
(5003, 'rotary', 1),
(5003, 'linear', 2),
(5003, 'as magnetic', 1),
(5003, 'well', 1),
(5003, 'photoelectric as', 1),
(5003, 'manufacturing', 1),
(5003, 'specializes', 1),
(5003, 'metrology', 1),
(5003, 'precizika', 1),
(5003, 'uab', 1),
(5003, 'encoders', 3),
(5003, 'products', 5),
(4827, 'vadovas', 1),
(4827, 'geras', 1),
(4827, 'bus', 1),
(4827, 'kad', 1),
(4827, 'tikiuosi', 1),
(4827, 'metų', 1),
(4827, 'apie', 1),
(4827, 'jau', 1),
(4827, 'dirbantis', 1),
(4826, 'Žinių', 2),
(4826, 'vardą', 1),
(4826, 'riterio', 1),
(4826, 'profesijos', 1),
(4826, 'suteikė', 1),
(4826, 'konfederacija', 1),
(4826, 'pramoninikų', 1),
(4826, 'zakui', 1),
(4826, 'gintautui', 1),
(4826, 'inž', 1),
(4826, 'vadovui', 1),
(4826, 'skyriaus', 1),
(4826, 'rastrų', 1),
(4826, 'premija', 1),
(4826, 'mokslo', 1),
(4826, '2009', 1),
(4826, 'suteikta', 1),
(4826, 'kaušiniu', 1),
(4826, 'sauliumi', 1),
(4826, 'ktu', 1),
(4826, 'giniočiu', 1),
(4825, 'metų', 2),
(4825, 'metrology', 3),
(4825, 'specialus', 1),
(4825, '–', 2),
(4825, 'pirmtakas', 2),
(4825, '„precizika“', 1),
(4825, 'metrology“', 1),
(4825, '„precizika', 1),
(4825, 'įmonių', 1),
(4825, 'dabartinių', 1),
(4825, 'veiklą', 2),
(4825, 'mėnesį', 2),
(4825, 'pradėjo', 2),
(4825, 'rugsėjo', 2),
(4825, '1960', 2),
(4825, 'kai', 2),
(4825, 'dienos', 2),
(4825, 'tos', 2),
(4825, 'nuo', 2),
(4825, 'dešimtmetis', 2),
(4825, 'penktas', 2),
(4825, 'baigėsi', 2),
(4830, 'laboratorija', 1),
(4830, '„biok“', 1),
(4830, 'gamintoja', 1),
(4830, 'kosmetikos', 1),
(4830, 'pernai', 1),
(4830, 'kartą', 1),
(4830, 'antrąjį', 1),
(4830, 'organizuoja', 1),
(4830, 'ministerija', 1),
(4830, 'diplomas', 1),
(4830, 'bei', 1),
(4830, 'prizas', 1),
(4829, 'prekinį', 2),
(4829, 'pristato', 2),
(4829, 'įrangą', 1),
(4829, 'duomenis', 1),
(4829, 'atkurti', 1),
(4829, 'pat', 1),
(4829, 'taip', 1),
(4829, 'objektus', 1),
(4829, 'pozicionuoti', 1),
(4829, 'matuoti', 1),
(4829, 'projektuoti', 1),
(4829, 'galimybę', 1),
(4829, 'suteikia', 1),
(4829, 'taikymas', 1),
(4829, 'kurių', 1),
(4829, '–', 1),
(4829, 'hexa', 1),
(4829, 'kodą', 1),
(4829, 'pagal', 1),
(4829, 'biržoje', 1),
(4829, 'popierių', 1),
(4829, 'vertybinių', 1),
(4829, 'skandinavijos', 1),
(4829, 'pranešti', 1),
(4829, 'jums', 1),
(4829, 'norime', 1),
(4829, 'mes', 3),
(4938, 'ilgiai', 1),
(4938, 'matavimo', 1),
(4938, 'produktą', 2),
(4938, 'naująjį', 1),
(4938, 'apie', 2),
(4938, 'trumpai', 1),
(4938, 'lk24', 4),
(4938, 'keitiklį', 2),
(4938, 'absoliutinį', 2),
(4751, 'brūkšnių', 1),
(4751, 'kamp', 1),
(4751, 'paklaida', 1),
(4751, 'poslinkio', 1),
(4751, '1vpp', 1),
(4751, '11μapp', 1),
(4751, 'htl', 2),
(4751, 'ttl', 2),
(4751, 'įtampa', 1),
(4751, 'maitinimo', 1),
(4751, 'lygis', 1),
(4751, 'signalų', 1),
(4751, 'išėjimo', 1),
(4751, '108000', 1),
(4751, 'iki', 1),
(4751, '100', 1),
(4751, 'nuo', 1),
(4751, 'apsisukimą', 2),
(4751, 'veleno', 3),
(4751, 'vieną', 2),
(4751, 'per', 2),
(4751, 'skaičius', 1),
(4751, 'impulsų', 1),
(4751, 'inkrementinis', 1),
(4751, 'tipas', 1),
(4751, 'signalo', 1),
(4751, 'išvesties', 1),
(4751, 'keitiklio', 1),
(4751, 'skersmuo', 1),
(4751, 'aprašymas', 1),
(4751, 'specifikacijų', 1),
(4751, 'trumpas', 1),
(4751, 'modelis', 1),
(4751, 'keitiklių', 1),
(4751, 'fotoelektrinių', 1),
(4751, 'kampinių', 1),
(4751, 'naujausias', 1),
(4751, 'tai', 1),
(4751, 'a58h1', 3),
(4938, 'linijinį', 2),
(4938, 'naują', 2),
(4938, 'visiškai', 1),
(4938, 'siūlo', 2),
(4938, 'metrology', 2),
(4938, 'precizika', 2),
(4751, '58mm', 1),
(4751, 'kampinis', 1),
(4751, 'fotoelektrinis', 1),
(4751, 'keitiklis', 1),
(4751, 'išorine', 1),
(4751, 'mova', 1),
(4751, 'produktas', 2),
(4829, 'todėl', 1),
(4829, 'šalyse', 1),
(4829, 'baltijos', 1),
(4829, 'atstovas', 1),
(4829, 'metrology', 11),
(4829, 'hexagon', 14),
(4829, 'oficialus', 1),
(4829, 'yra', 3),
(4829, 'metrology“', 1),
(4829, '„precizika', 1),
(4829, 'uab', 1),
(4830, '„ecodenta“', 1),
(4830, 'pastą', 1),
(4830, 'dantų', 1),
(4830, 'lietuvišką', 1),
(4830, 'ekologišką', 1),
(4830, 'pirmąją', 1),
(4830, 'pristatė', 1),
(4830, 'rinkai', 1),
(4830, 'sukūrė', 1),
(4830, 'sveikatos', 1),
(4830, 'Įmonė', 1),
(4821, 'pramonininkų', 1),
(4821, 'lietuvos', 2),
(4770, 'visi', 4),
(4830, 'kuri', 1),
(4830, 'pagaminta', 1),
(4830, 'naudojant', 1),
(4830, 'pažangų', 1),
(4830, 'kalcio', 1),
(4830, 'kompleksą', 1),
(4830, '„kalident“', 1),
(4830, 'natūralias', 1),
(4830, 'sudedamąsias', 1),
(4830, 'dalis', 1),
(4830, 'daugiau', 1),
(4830, 'informacijos', 1),
(4830, 'rūta', 1),
(4830, 'mikėnienė', 1),
(4830, 'viešųjų', 1),
(4830, 'ryšių', 1),
(4830, 'protokolo', 1),
(4830, 'skyrius', 1),
(4830, 'tel', 1),
(4830, '706', 1),
(4830, '704', 1),
(4830, 'ruta', 1),
(4830, 'mikeniene@ukmin', 1),
(4830, 'ūkio', 1),
(4830, 'partnerystĖ', 2),
(4830, '2012', 2),
(4834, 'suteiktas', 2),
(4834, 'šilumą', 2),
(4834, 'tobulėti', 2),
(4834, 'galimybes', 4),
(4834, 'aplinką', 2),
(4834, 'jaukią', 2),
(4834, 'inovacijas', 2),
(4834, 'nominacijose', 1),
(4834, 'varžėsi', 1),
(4834, 'kurie', 1),
(4834, 'rankas', 1),
(4834, 'iniciatorių', 1),
(4834, 'projektų', 1),
(4834, 'finansuojamų', 1),
(4834, 'fondų', 1),
(4834, 'struktūrinių', 1),
(4834, 'metų', 2),
(4834, '2007–2013', 1),
(4834, 'nukeliavo', 1),
(4834, 'keliavo', 1),
(4834, 'nugalėtojai', 1),
(4834, 'nominacijų', 1),
(4834, 'devynių', 1),
(4834, 'paskelbti', 1),
(4834, 'ceremonijoje', 1),
(4834, 'statulėlės', 1),
(4834, 'apdovanojimų', 2),
(4834, 'burių', 3),
(4834, 'atiteko', 1),
(4834, 'kuriems', 1),
(4834, 'nugalėtojus', 1),
(4834, 'išrinko', 1),
(4834, 'jie', 1),
(4834, 'būtent', 1),
(4834, 'balsų', 1),
(4834, 'gyventojų', 1),
(4834, 'aktyvių', 1),
(4834, 'tūkstančių', 1),
(4834, 'virš', 1),
(4834, 'sulaukta', 1),
(4834, 'metu', 2),
(4834, 'rinkimų', 1),
(4834, 'viešų', 1),
(4834, 'finansuoti', 2),
(4834, 'už', 32),
(4834, 'patraukliausi', 2),
(4834, 'sėkmingiausi', 2),
(4834, 'apdovanoti', 2),
(4834, 'buvo', 4),
(4834, 'burėmis“', 2),
(4834, 'filharmonijoje', 1),
(4834, 'nacionalinėje', 1),
(4834, 'lietuvos', 5),
(4834, 'ketvirtadienį', 1),
(4834, 'projektai', 3),
(4834, 'geriausi', 3),
(4834, 'įvertinti', 1),
(4834, 'apdovanojimuose', 1),
(4834, '2012”', 6),
(4834, 'burės', 14),
(4834, '„europos', 16),
(4833, 'skaityti', 1),
(4833, 'lietuvos', 2),
(4833, 'gruodžio', 1),
(4833, '2012', 2),
(4833, 'daugiau', 1),
(4833, 'pramonininkai', 2),
(4834, 'savarankiškų', 1),
(4834, 'įkūrimas“', 1),
(4834, '„precizika', 1),
(4834, 'metrology“', 1),
(4834, '„naujos', 1),
(4834, 'padidinto', 1),
(4834, 'matavimo', 2),
(4834, 'tikslumo', 1),
(4834, 'atsparumo', 1),
(4834, 'vibracijoms', 1),
(4834, 'bei', 1),
(4834, 'termostabilumo', 1),
(4834, 'linijinių', 1),
(4834, 'poslinkių', 1),
(4834, 'sistemos', 1),
(4834, 'sukūrimas“', 1),
(4834, 'Šeimos', 1),
(4834, 'santykių', 1),
(4834, 'institutą', 1),
(4834, '„vaikų', 1),
(4834, 'nuo', 1),
(4834, 'užimtumo', 1),
(4834, 'įtraukimo', 1),
(4834, 'rinką', 1),
(4834, 'galimybių', 1),
(4834, 'didinimas', 1),
(4834, 'naujas', 1),
(4834, 'specialistų', 1),
(4834, 'veiklos', 1),
(4834, 'modelis“', 1),
(4834, 'piliečių', 1),
(4834, 'simpatijas', 1),
(4834, 'trakus', 1),
(4834, 'kontaktinis', 1),
(4834, 'asmuo', 1),
(4834, 'kristina', 1),
(4834, 'aidietienė', 1),
(4834, 'valdymo', 1),
(4834, 'departamentas', 1),
(4834, 'veiksmų', 1),
(4834, 'programų', 1),
(4834, 'viešinimo', 1),
(4834, 'skyrius', 1),
(4834, 'tel', 1),
(4834, '219', 1),
(4834, 'Šaltinis', 1),
(4834, 'bures', 1),
(4834, '2012', 3),
(4834, 'daugiau', 1),
(4835, 'produkto', 1),
(4835, 'kategorijoje', 1),
(4835, 'apdovanotas', 1),
(4835, 'inovacijų', 3),
(4835, 'prizu', 1),
(4836, 'kampo', 1),
(4836, 'keitiklių', 1),
(4836, 'diagnostikos', 1),
(4836, 'galimybėmis', 1),
(4836, 'gamą', 1),
(4837, 'metrology“', 3),
(4837, '2007“', 3),
(4839, 'tikslą', 1),
(4839, 'kodinės', 2),
(4840, 'remiamas', 1),
(4840, '„absoliučiojo', 2),
(4841, 'optimaliu', 1),
(4841, 'būdu', 1),
(4841, 'užsiduotą', 1),
(4841, 'tikslą', 1),
(4843, 'įgyvendina', 1),
(4843, 'liepos', 1),
(4843, '2011', 1),
(4843, 'iki', 3),
(4843, 'mėn', 2),
(4843, 'sausio', 1),
(4843, '2009', 1),
(4843, 'nuo', 1),
(4843, 'metrology', 3),
(4843, 'precizika', 3),
(4843, 'uab', 3),
(4843, 'prioriteto', 2),
(4843, 'uždavinio', 1),
(4843, 'nacionalinės', 1),
(4843, 'lisabonos', 1),
(4843, 'strategijos', 1),
(4843, 'įgyvendinimo', 2),
(4843, '„skatinti', 1),
(4843, 'įmonių', 1),
(4843, 'vystymas“', 2),
(4844, 'turinčių', 1),
(4844, 'patirtį', 1),
(4844, 'dangų', 1),
(4844, 'užnešimo', 1),
(4844, 'technologijų', 1),
(4844, 'srityje', 1),
(4844, 'atitinka', 1),
(4844, 'strateginius', 1),
(4844, 'veiklos', 1),
(4844, 'planus', 1),
(4844, 'prisideda', 1),
(4844, 'prie', 1),
(4844, 'prioriteto', 2),
(4844, 'uždavinio', 1),
(4844, 'bei', 1),
(4844, 'nacionalinės', 1),
(4844, 'lisabonos', 1),
(4844, 'strategijos', 1),
(4844, 'įgyvendinimo', 2),
(4844, '„skatinti', 1),
(4844, 'įmonių', 1),
(4844, 'konkurencingumą', 1),
(4844, 'dangomis“', 2),
(4845, 'veikla', 1);
INSERT INTO `cms_module_search_index` (`item_id`, `word`, `count`) VALUES
(4845, 'leidžia', 1),
(4845, 'efektyviai', 1),
(4845, 'išnaudoti', 1),
(4845, 'turimą', 1),
(4845, 'intelektualinį', 1),
(4845, 'potencialą', 1),
(4845, 'prisideda', 1),
(4845, 'prie', 1),
(4845, 'prioriteto', 2),
(4845, 'uždavinio', 1),
(4845, 'nacionalinės', 1),
(4845, 'lisabonos', 1),
(4845, 'strategijos', 1),
(4845, 'įgyvendinimo', 2),
(4845, '„skatinti', 1),
(4845, 'įmonių', 1),
(4845, 'sukūrimas“', 2),
(4846, 'Įgyvendinant', 1),
(4846, 'parengta', 1),
(4846, 'techninių', 1),
(4846, 'galimybių', 1),
(4846, 'studija', 1),
(4846, 'skirta', 1),
(4846, 'nagrinėjama', 1),
(4846, 'problematika', 1),
(4846, 'techniniai', 1),
(4846, 'kokybiniai', 1),
(4846, 'atliekami', 1),
(4846, 'optoelektroninės', 1),
(4846, 'schemos', 1),
(4846, 'rastrinės', 1),
(4846, 'skalės', 1),
(4846, 'geometrijos', 1),
(4846, 'temperatūrinių', 1),
(4846, 'deformacijų', 1),
(4846, 'kiti', 1),
(4846, 'tyrimai', 1),
(4846, 'atitinka', 1),
(4846, 'strateginius', 1),
(4846, 'veiklos', 1),
(4846, 'planus', 1),
(4846, 'prisideda', 1),
(4846, 'prie', 1),
(4846, 'prioriteto', 2),
(4846, 'uždavinio', 1),
(4846, 'nacionalinės', 1),
(4846, 'lisabonos', 1),
(4846, 'strategijos', 1),
(4846, 'įgyvendinimo', 2),
(4846, '„skatinti', 1),
(4846, 'įmonių', 1),
(4846, 'sukūrimas“', 2),
(4847, 'turima', 1),
(4847, 'tokių', 1),
(4847, 'patirtimi', 1),
(4847, 'tai', 1),
(4847, 'leis', 2),
(4847, 'išplėsti', 2),
(4847, 'aukštųjų', 2),
(4847, 'technologijų', 2),
(4847, 'produktų', 2),
(4847, 'nomenklatūrą', 2),
(4847, 'padidinti', 2),
(4847, 'apimtis', 2),
(4847, 'atliekant', 1),
(4847, 'tyrimus', 1),
(4847, 'bus', 1),
(4847, 'panaudoti', 1),
(4847, 'minėtų', 1),
(4847, 'įstaigų', 1),
(4847, 'jau', 1),
(4847, 'turimi', 1),
(4847, 'tyrimo', 1),
(4847, 'rezultatai', 1),
(4847, 'mokslinis', 1),
(4847, 'potencialas', 1),
(4847, 'patirtis', 1),
(4847, 'naujiems', 1),
(4847, 'tyrimams', 1),
(4847, 'atlikti', 1),
(4847, 'planuojama', 2),
(4847, 'kurti', 2),
(4849, 'įmonės', 1),
(4849, 'technologines', 1),
(4849, 'galimybes', 1),
(4849, 'techninės', 2),
(4849, 'studijos', 2),
(4849, 'skirtos', 2),
(4849, 'kokybiškai', 2),
(4849, 'naujos', 2),
(4849, 'matavimo', 2),
(4849, 'sistemos', 2),
(4849, 'sukūrimui', 2),
(4849, 'parengimas', 2),
(4850, 'tai', 2),
(4850, 'sudarys', 2),
(4850, 'sąlygos', 1),
(4850, 'klasterizacijos', 1),
(4850, 'šiame', 1),
(4850, 'sektoriuje', 1),
(4850, 'palankią', 1),
(4850, 'aplinką', 1),
(4850, 'naujų', 1),
(4850, 'technologijų', 1),
(4850, 'kūrimui', 1),
(4850, 'pasiekimai', 1),
(4850, 'prisidės', 1),
(4850, 'prie', 1),
(4850, 'konkurencingumo', 1),
(4850, 'didinimo', 1),
(4850, 'nes', 1),
(4850, 'sukurta', 1),
(4850, 'gamyboje', 1),
(4852, '2004', 3),
(4852, 'coop', 3),
(4852, 'projektas', 4),
(4852, '6bp', 3),
(4852, 'pavadinimas', 1),
(4852, 'konsorciumas', 1),
(4852, 'tarptautinis', 1),
(4852, 'vykdytojas', 1),
(4852, 'projekto', 2),
(4852, 'kristalus', 1),
(4852, 'kurių', 1),
(4852, 'optinės', 1),
(4852, 'savybės', 1),
(4852, 'labai', 1),
(4852, 'priklauso', 1),
(4852, 'nuo', 1),
(4852, 'gamybos', 1),
(4852, 'proceso', 1),
(4852, 'kokybės', 1),
(4853, 'masto', 1),
(4853, 'ekonomijos', 1),
(4853, 'efektą', 1),
(4853, 'visa', 1),
(4853, 'turės', 1),
(4853, 'įtakos', 1),
(4853, 'internacionalizavimo', 1),
(4853, 'skatinimui', 1),
(4888, 'istorija', 4),
(4858, 'dešra', 1),
(4858, 'arkliukas', 1),
(4858, 'batmanas', 1),
(4858, 'barnis', 1),
(4858, 'raketa', 1),
(4901, '20a', 1),
(4901, 'linear', 1),
(4901, 'encoder', 3),
(4901, 'beginning', 1),
(4901, 'rotary', 1),
(4901, 'serial', 1),
(4901, 'production', 1),
(4901, 'high', 1),
(4901, 'precision', 1),
(4901, 'coordinate', 1),
(4901, '140k', 1),
(4901, 'developed', 1),
(4901, 'new', 1),
(4901, 'inspection', 1),
(4901, '178', 1),
(4901, 'national', 1),
(4901, 'science', 1),
(4901, 'prize', 1),
(4901, 'encoders', 1),
(4901, 'development', 1),
(4901, 'established', 1),
(4901, 'joint', 1),
(4901, 'venture', 1),
(4901, 'brown', 1),
(4901, '&amp', 1),
(4901, 'sharpe', 1),
(4901, 'usa', 1),
(4901, 'company', 1),
(4901, 'purchased', 1),
(4901, 'hexagon', 1),
(4901, 'group', 1),
(4901, '100%', 1),
(4901, 'ownership', 1),
(4901, 'name', 1),
(4901, 'changed', 1),
(4901, 'precizika', 1),
(4901, 'metrology', 1),
(4905, '442', 1),
(4906, 'video', 4),
(4906, '  ', 1),
(5010, 'account ', 2),
(5010, 'bank', 1),
(5010, 'seb', 1),
(5010, 'lt100179515', 1),
(5010, 'payer', 1),
(5010, 'vat', 1),
(5010, '210017950', 1),
(5010, 'code', 2),
(5010, 'company', 1),
(5010, ' lietuva', 1),
(5010, 'vilnius', 1),
(4939, 'contact', 1),
(4939, 'will', 1),
(4939, 'form', 1),
(4939, 'fill', 1),
(4939, 'please', 1),
(4939, 'employees', 1),
(4939, 'new', 1),
(4939, 'looking', 1),
(4939, 'constantly', 1),
(4939, 'career', 4),
(4909, 'accomplished', 4),
(4909, 'projects', 4),
(4909, '453', 1),
(5010, '09120', 1),
(5010, '139', 1),
(5010, 'Žirmūnų', 1),
(5010, 'address', 1),
(5010, 'support@precizika', 1),
(5010, 'support', 1),
(5010, 'marketing@precizika', 1),
(5010, 'marketing', 1),
(5010, 'equipment', 1),
(5010, 'measuring', 1),
(5010, '3608', 1),
(5010, 'scales', 1),
(5010, 'glass', 1),
(5010, 'encoders', 1),
(5010, '3683', 1),
(5010, 'sales@precizika', 1),
(5010, 'department', 3),
(5010, 'sales', 1),
(5010, '3609 ', 1),
(5010, 'fax', 1),
(5010, '3600', 1),
(5010, '236', 4),
(5010, '370', 4),
(5010, 'tel', 3),
(5010, 'info@precizika', 1),
(5010, 'mail', 4),
(5010, 'information', 1),
(5010, 'general', 1),
(5010, 'contacts', 4),
(4936, '485', 1),
(4936, 'events', 4),
(5075, 'events', 4),
(5069, 'product', 4),
(5070, 'company', 4),
(5071, 'exhibitions', 4),
(5072, 'accomplished', 4),
(4938, 'jpg', 1),
(4938, 'img_0091', 1),
(4937, '491', 1),
(4937, 'service', 4),
(4945, 'parsisiuntimai', 4),
(4945, 'visi', 4),
(5063, 'plates', 1),
(5063, 'linear', 1),
(5063, 'scales', 2),
(5063, '2015', 2),
(5063, 'gratings', 2),
(5063, 'scale', 2),
(5063, 'glass', 4),
(4941, 'immediately', 1),
(4941, 'contact', 1),
(4941, 'hesitate', 1),
(4941, 'help', 1),
(4941, 'able', 1),
(4941, 'willing', 1),
(4941, 'always', 1),
(4941, 'metrology"specialists', 1),
(4941, 'precizika', 1),
(4941, 'customers', 1),
(4941, 'service', 1),
(4941, 'quality', 1),
(4941, 'best', 1),
(4941, 'guarantee', 1),
(4941, 'important', 1),
(4941, 'support', 5),
(4920, 'contact', 4),
(4920, 'jeigu', 1),
(4920, 'susidūrėte', 1),
(4920, 'nesklandumais', 1),
(4920, 'užpildykite', 1),
(4920, 'šią', 1),
(4920, 'formą', 1),
(4920, 'dešinėje', 1),
(4920, 'mes', 1),
(4920, 'pasistengsime', 1),
(4920, 'kuo', 1),
(4920, 'greičiau', 1),
(4920, 'padėti', 1),
(4921, 'cmm', 4),
(4921, 'service', 4),
(4943, 'downloads', 4),
(5012, '2015', 1),
(5012, 'gratings', 1),
(5012, 'scale', 1),
(5012, 'glass', 1),
(5012, 'brochures', 4),
(4924, 'catalogues', 4),
(4924, 'general', 1),
(4924, 'catalogue', 1),
(4924, '2014', 1),
(4924, 'glass', 1),
(4924, 'scale', 1),
(4924, 'gratings', 1),
(4924, 'parsisiųsti', 2),
(4926, 'product', 4),
(4926, 'photos', 4),
(4926, 'glass', 1),
(4926, 'scale', 1),
(4926, 'gratings', 1),
(4926, 'pavadinimas', 1),
(4926, 'parsisiųsti', 2),
(5062, 'newsletters', 4),
(4928, 'presentations', 4),
(4928, 'glass', 1),
(4928, 'scale', 1),
(4928, 'gratings', 1),
(4928, 'pavadinimas', 1),
(4928, 'parsisiųsti', 2),
(5005, 'pavadinimas', 1),
(5005, 'gratings', 1),
(5005, 'scale', 1),
(5005, 'glass', 1),
(5005, 'video', 4),
(5013, 'downloads', 4),
(5012, 'parsisiųsti', 2),
(5012, 'guide', 1),
(5012, 'selection', 1),
(5012, 'encoder', 1),
(5012, 'linear', 1),
(5012, 'rotary', 1),
(5011, 'help', 1),
(5011, 'try', 1),
(5011, 'will', 1),
(5011, 'please', 1),
(5011, 'general', 1),
(5011, 'product', 1),
(5011, 'questions', 2),
(5011, 'contact', 2),
(5010, 'haba', 1),
(5010, 'swedbank', 1),
(5010, 'cbvi', 1),
(5010, 'swift', 2),
(5010, '8032', 2),
(5010, '0112', 2),
(5010, '0600', 2),
(5010, '7044', 2),
(5010, 'lt96', 2),
(5010, 'iban', 2),
(5009, 'opportunities', 1),
(5009, 'know', 1),
(5009, 'let', 1),
(5009, 'will', 1),
(5009, 'form', 1),
(5009, 'fill', 1),
(5009, 'please', 1),
(5009, 'interested', 1),
(5009, 'people', 1),
(5009, 'new', 1),
(5009, 'looking', 1),
(5009, 'constantly', 1),
(5009, 'career', 5),
(5006, 'partners', 4),
(5007, 'contact', 1),
(5007, 'will', 1),
(5007, 'right', 1),
(5007, 'form', 1),
(5007, 'fill', 1),
(5007, 'know', 1),
(5007, 'like', 1),
(5007, 'would', 1),
(5007, 'company', 1),
(5007, 'interested', 1),
(5007, 'partners', 1),
(5007, 'business', 1),
(5007, 'new', 1),
(5007, 'looking', 1),
(5007, 'expanding', 1),
(5007, 'always', 1),
(5007, 'metrology', 1),
(5007, 'precizika', 1),
(5007, 'partner', 5),
(5007, 'become', 5),
(5077, 'home', 4),
(5008, '506', 1),
(5008, 'list', 4),
(5008, 'partner', 4),
(5006, '503', 1),
(5005, 'parsisiųsti', 2),
(5004, 'haba', 1),
(5004, 'swedbank', 1),
(5004, 'cbvi', 1),
(5004, 'swift', 2),
(5004, '8032', 2),
(5004, '0112', 2),
(5004, '0600', 2),
(5004, '7044', 2),
(5004, 'lt96', 2),
(5004, 'iban', 2),
(5004, 'account ', 2),
(5004, 'bank', 1),
(5004, 'seb', 1),
(5004, 'lt100179515', 1),
(5004, 'payer', 1),
(5004, 'vat', 1),
(5004, '210017950', 1),
(5004, 'code', 2),
(5004, 'company', 1),
(5004, 'lietuva', 1),
(5004, 'vilnius', 1),
(5004, '09120', 1),
(5004, '139', 1),
(5004, 'Žirmūnų', 1),
(5004, 'address', 1),
(5004, 'support@precizika', 1),
(5004, 'support', 1),
(5004, 'marketing@precizika', 1),
(5004, 'marketing', 1),
(5004, 'equipment', 1),
(5004, 'measuring', 1),
(5004, '3608', 1),
(5004, 'scales', 1),
(5004, 'glass', 1),
(5004, 'encoders', 1),
(5004, '3683', 1),
(5004, 'sales@precizika', 1),
(5004, 'department', 3),
(5004, 'sales', 1),
(5004, '3609', 1),
(5004, 'fax', 1),
(5004, '3600', 1),
(5004, '236', 4),
(5004, '370', 4),
(5004, 'tel', 3),
(5004, 'info@precizika', 1),
(5004, 'mail', 4),
(5004, 'information', 1),
(5004, 'general', 1),
(5004, 'contacts', 4),
(4935, 'operating', 4),
(4935, 'teritory', 4),
(5059, 'nerodomi', 4),
(5056, 'produktai', 4);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_search_items`
--

CREATE TABLE IF NOT EXISTS `cms_module_search_items` (
  `id` int(11) NOT NULL,
  `module_name` varchar(100) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `extra_attr` varchar(100) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_name` (`module_name`),
  KEY `content_id` (`content_id`),
  KEY `extra_attr` (`extra_attr`),
  KEY `cms_index_search_items` (`module_name`,`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_search_items`
--

INSERT INTO `cms_module_search_items` (`id`, `module_name`, `content_id`, `extra_attr`, `expires`) VALUES
(1, 'Search', 15, 'template', NULL),
(3, 'Search', 16, 'template', NULL),
(5, 'Search', 17, 'template', NULL),
(129, 'Search', 28, 'template', NULL),
(2341, 'Search', 24, 'template', NULL),
(51, 'Search', 26, 'template', NULL),
(2480, 'Search', 27, 'template', NULL),
(30, 'Search', 19, 'template', NULL),
(2837, 'Search', 25, 'template', NULL),
(4451, 'Search', 15, 'content', NULL),
(35, 'Search', 21, 'template', NULL),
(37, 'Search', 20, 'template', NULL),
(39, 'Search', 23, 'template', NULL),
(41, 'Search', 18, 'template', NULL),
(144, 'Search', 29, 'template', NULL),
(174, 'Search', 30, 'template', NULL),
(1720, 'Search', 39, 'template', NULL),
(1613, 'Search', 32, 'template', NULL),
(267, 'Search', 31, 'template', NULL),
(3504, 'Search', 437, 'content', NULL),
(4521, 'Search', 433, 'content', NULL),
(4549, 'Search', 264, 'content', NULL),
(2256, 'Search', 42, 'template', NULL),
(3617, 'Search', 399, 'content', NULL),
(3581, 'Search', 434, 'content', NULL),
(2257, 'Search', 43, 'template', NULL),
(2286, 'Search', 41, 'template', NULL),
(1627, 'Search', 33, 'template', NULL),
(1637, 'Search', 34, 'template', NULL),
(1642, 'Search', 35, 'template', NULL),
(1645, 'Search', 36, 'template', NULL),
(1648, 'Search', 37, 'template', NULL),
(1653, 'Search', 38, 'template', NULL),
(4751, 'News', 78, 'article', NULL),
(4634, 'Search', 243, 'content', NULL),
(4925, 'Search', 472, 'content', NULL),
(2859, 'Search', 48, 'template', NULL),
(2857, 'Search', 45, 'template', NULL),
(3265, 'Search', 46, 'template', NULL),
(2905, 'Search', 47, 'template', NULL),
(2906, 'Search', 49, 'template', NULL),
(2913, 'Gallery', 1, 'gallery', NULL),
(4858, 'Gallery', 395, 'gallery', NULL),
(2927, 'Search', 50, 'template', NULL),
(4838, 'News', 32, 'article', NULL),
(5077, 'Search', 4, 'content', NULL),
(3424, 'Search', 66, 'global_content', NULL),
(4452, 'Search', 430, 'content', NULL),
(3729, 'Search', 431, 'content', NULL),
(4495, 'Search', 432, 'content', NULL),
(3447, 'Search', 52, 'template', NULL),
(4771, 'Search', 435, 'content', NULL),
(4636, 'Search', 438, 'content', NULL),
(4888, 'Search', 439, 'content', NULL),
(4206, 'Search', 440, 'content', NULL),
(4638, 'Search', 441, 'content', NULL),
(3732, 'Search', 442, 'content', NULL),
(3523, 'Search', 53, 'template', NULL),
(4942, 'Search', 443, 'content', NULL),
(4296, 'Search', 444, 'content', NULL),
(3569, 'Search', 447, 'content', NULL),
(4542, 'Search', 448, 'content', NULL),
(4632, 'Search', 449, 'content', NULL),
(3552, 'Search', 450, 'content', NULL),
(3574, 'Search', 451, 'content', NULL),
(3577, 'Search', 452, 'content', NULL),
(3644, 'Search', 453, 'content', NULL),
(3636, 'Search', 463, 'content', NULL),
(3733, 'Search', 455, 'content', NULL),
(4833, 'News', 67, 'article', NULL),
(4441, 'Search', 461, 'content', NULL),
(4947, 'Search', 459, 'content', NULL),
(4426, 'Search', 460, 'content', NULL),
(3707, 'Search', 462, 'content', NULL),
(4839, 'News', 52, 'article', NULL),
(4840, 'News', 53, 'article', NULL),
(4841, 'News', 54, 'article', NULL),
(4843, 'News', 55, 'article', NULL),
(4844, 'News', 56, 'article', NULL),
(4845, 'News', 57, 'article', NULL),
(4846, 'News', 58, 'article', NULL),
(4847, 'News', 59, 'article', NULL),
(4849, 'News', 60, 'article', NULL),
(4848, 'News', 61, 'article', NULL),
(4852, 'News', 62, 'article', NULL),
(4850, 'News', 63, 'article', NULL),
(4853, 'News', 64, 'article', NULL),
(4836, 'News', 65, 'article', NULL),
(4835, 'News', 66, 'article', NULL),
(4834, 'News', 68, 'article', NULL),
(4830, 'News', 69, 'article', NULL),
(4829, 'News', 70, 'article', NULL),
(4827, 'News', 71, 'article', NULL),
(4826, 'News', 72, 'article', NULL),
(4825, 'News', 73, 'article', NULL),
(4822, 'News', 74, 'article', NULL),
(4821, 'News', 75, 'article', NULL),
(4837, 'News', 76, 'article', NULL),
(4553, 'News', 77, 'article', NULL),
(4903, 'Search', 473, 'content', NULL),
(4442, 'Search', 465, 'content', NULL),
(4514, 'Search', 466, 'content', NULL),
(4444, 'Search', 467, 'content', NULL),
(4445, 'Search', 468, 'content', NULL),
(4425, 'Search', 54, 'template', NULL),
(4506, 'Filelists', 18, 'Filelist', NULL),
(4507, 'Filelists', 19, 'Filelist', NULL),
(4505, 'Filelists', 21, 'Filelist', NULL),
(4508, 'Filelists', 20, 'Filelist', NULL),
(4551, 'Search', 67, 'global_content', NULL),
(4642, 'Search', 469, 'content', NULL),
(4938, 'News', 80, 'article', NULL),
(4770, 'Search', 470, 'content', NULL),
(5003, 'Search', 474, 'content', NULL),
(4904, 'Search', 475, 'content', NULL),
(5066, 'Search', 476, 'content', NULL),
(4901, 'Search', 477, 'content', NULL),
(4905, 'Search', 478, 'content', NULL),
(4906, 'Search', 479, 'content', NULL),
(5010, 'Search', 483, 'content', NULL),
(4939, 'Search', 481, 'content', NULL),
(4909, 'Search', 482, 'content', NULL),
(4936, 'Search', 484, 'content', NULL),
(5075, 'Search', 485, 'content', NULL),
(5069, 'Search', 486, 'content', NULL),
(5070, 'Search', 487, 'content', NULL),
(5071, 'Search', 488, 'content', NULL),
(5072, 'Search', 489, 'content', NULL),
(4937, 'Search', 490, 'content', NULL),
(4941, 'Search', 491, 'content', NULL),
(4920, 'Search', 492, 'content', NULL),
(4921, 'Search', 493, 'content', NULL),
(4943, 'Search', 494, 'content', NULL),
(5012, 'Search', 495, 'content', NULL),
(4924, 'Search', 496, 'content', NULL),
(4926, 'Search', 497, 'content', NULL),
(5062, 'Search', 498, 'content', NULL),
(4928, 'Search', 499, 'content', NULL),
(5005, 'Search', 500, 'content', NULL),
(5009, 'Search', 501, 'content', NULL),
(5006, 'Search', 502, 'content', NULL),
(5007, 'Search', 503, 'content', NULL),
(5008, 'Search', 504, 'content', NULL),
(5004, 'Search', 505, 'content', NULL),
(4935, 'Search', 506, 'content', NULL),
(5063, 'Filelists', 22, 'Filelist', NULL),
(4945, 'Search', 507, 'content', NULL),
(5011, 'Search', 68, 'global_content', NULL),
(5013, 'Search', 508, 'content', NULL),
(5059, 'Search', 509, 'content', NULL),
(5056, 'Search', 510, 'content', NULL),
(5073, 'News', 81, 'article', NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_search_items_seq`
--

CREATE TABLE IF NOT EXISTS `cms_module_search_items_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_search_items_seq`
--

INSERT INTO `cms_module_search_items_seq` (`id`) VALUES
(5077);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_search_words`
--

CREATE TABLE IF NOT EXISTS `cms_module_search_words` (
  `word` varchar(255) NOT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_search_words`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_smarty_plugins`
--

CREATE TABLE IF NOT EXISTS `cms_module_smarty_plugins` (
  `sig` varchar(80) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `module` varchar(160) DEFAULT NULL,
  `type` varchar(40) DEFAULT NULL,
  `callback` varchar(255) DEFAULT NULL,
  `available` int(11) DEFAULT NULL,
  `cachable` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`sig`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_smarty_plugins`
--

INSERT INTO `cms_module_smarty_plugins` (`sig`, `name`, `module`, `type`, `callback`, `available`, `cachable`) VALUES
('0ff348646fe3bcea8ba9d0726a73f801', 'AdvancedContent', 'AdvancedContent', 'function', 's:15:"function_plugin";', 1, 0),
('036907504b8755bb9af4be9c039c9805', 'ECB', 'ECB', 'function', 's:15:"function_plugin";', 1, 0),
('a13f88201fd98d2fbb219f4bb4d4d75e', 'FileManager', 'FileManager', 'function', 's:15:"function_plugin";', 1, 0),
('d077ec0a46ac7ac76f7ebb22bf223dd5', 'MenuManager', 'MenuManager', 'function', 's:15:"function_plugin";', 1, 0),
('0d66b5f48afdb3ab28b1b00f23e3251f', 'menu', 'MenuManager', 'function', 's:15:"function_plugin";', 1, 1),
('042ecc80bd5585fce43393f9d3f434b6', 'cms_breadcrumbs', 'MenuManager', 'function', 's:22:"smarty_cms_breadcrumbs";', 1, 1),
('6db731a58353c03d0b79fe4e4adacdbd', 'News', 'News', 'function', 's:15:"function_plugin";', 1, 0),
('1ec62e1e885cc0fd80237da2d5ea8778', 'news', 'News', 'function', 's:15:"function_plugin";', 1, 1),
('3b1d879c3b8b61ae7c94d6de99ca72e9', 'NMS', 'NMS', 'function', 's:15:"function_plugin";', 1, 0),
('5d6058f76d2b48bca625bb702fb3c077', 'Products', 'Products', 'function', 's:15:"function_plugin";', 1, 0),
('bb0d76390dd2c0ab4e365e2e49d534b0', 'Search', 'Search', 'function', 's:15:"function_plugin";', 1, 0),
('f3114372c8995dd5974b0306430a3ce3', 'search', 'Search', 'function', 's:15:"function_plugin";', 1, 1),
('f6e43872aac4a496d83f8adbd0eb4d3d', 'FrontEndUsers', 'FrontEndUsers', 'function', 's:15:"function_plugin";', 1, 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_module_templates`
--

CREATE TABLE IF NOT EXISTS `cms_module_templates` (
  `module_name` varchar(160) DEFAULT NULL,
  `template_name` varchar(160) DEFAULT NULL,
  `content` text,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  KEY `cms_index_module_templates_by_module_name_template_name` (`module_name`,`template_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_module_templates`
--

INSERT INTO `cms_module_templates` (`module_name`, `template_name`, `content`, `create_date`, `modified_date`) VALUES
('CMSPrinting', 'linktemplate', '{if isset($imgsrc)}\n{capture assign=''image''}\n  <img src="{$imgsrc}" title="{$linktext}" alt="{$linktext}" {if isset($imgclass) && $imgclass!=''''}class="{$imgclass}"{/if} />\n{/capture}\n<a href="{$href}" class="{$class}" {$target} {if isset($more)}{$more}{/if} rel="nofollow">{$image}</a>\n{else}\n<a href="{$href}" class="{$class}" {$target} {if isset($more)}{$more}{/if} rel="nofollow">{$linktext}</a>\n{/if}\n', '2013-02-11 09:15:24', '2014-07-30 13:30:05'),
('CMSPrinting', 'printtemplate', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"\n"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">\n  <head>\n    <title>Printing {title}</title>\n    <meta name="robots" content="noindex" />\n    <base href="{$rooturl}" />\n    <meta name="Generator" content="CMS Made Simple - Copyright (C) 2004-12 Ted Kulp. All rights reserved." />\n    <meta http-equiv="Content-Type" content="text/html; charset={$encoding}" />\n\n    {cms_stylesheet media=''print'' templateid=$templateid}\n\n    {if $overridestylesheet!=''''}\n    <style type="text/css">\n    {$overridestylesheet}\n    </style>\n    {/if}\n    \n  </head>\n  <body style="background-color: white; color: black; background-image: none; text-align: left;">	\n    {$content}\n        \n    {$printscript}\n  </body>\n</html>\n', '2013-02-11 09:15:24', '2014-07-30 13:30:05'),
('Cataloger', 'catalog_7', '<div class="item">\r<p>{$title}</p>\r<table><tr><td><img id="item_image" name="item_image"  src="{$image_1_url}" title="{$title}" alt="{$title}" /></td>\r<td>{section name=ind loop=$image_url_array}\r<a href="javascript:repl(''{$image_url_array[ind]}'')"><img src="{$image_thumb_url_array[ind]}" title="{$title}" alt="{$title}" /></a>\r{/section}</td></tr></table>\r{section name=at loop=$attrlist}\r<p><strong>{$attrlist[at].name}</strong>: {eval var=$attrlist[at].key}</p>\r{/section}\r{literal}\r<script type="text/javascript">\rfunction repl(img)\r   {\r   document.item_image.src=img;\r   }\r</script>\r{/literal}\r</div>\r', '2014-12-10 13:08:57', '2014-12-10 13:08:57'),
('Cataloger', 'catalog_8', '{assign var="cols" value="3"}<h1>{$title}</h1>\r{$notes}\r<table style="border: solid 1px black;">\r<tr>\r    {section name=numloop loop=$items}\r        <td style="width: 200px;"><a href="{$items[numloop].link}"><img src="{$items[numloop].image}" title="{$items[numloop].title}" alt="{$items[numloop].title}"/></a><br /><a href="{$items[numloop].link}">{$items[numloop].title}</a><br />Category: {$items[numloop].cat}<br />\r{foreach from=$attrlist item=attr key=k}\r{$attr}: {$items[numloop][$k]}\r<br />\r{/foreach}\r</td>\r        {if not ($smarty.section.numloop.rownum mod $cols)}\r                {if not $smarty.section.numloop.last}\r                        </tr><tr>\r                {/if}\r        {/if}\r        {if $smarty.section.numloop.last}\r                {math equation = "n - a % n" n=$cols a=$items|@count assign="cells"}\r                {if $cells ne $cols}\r                {section name=pad loop=$cells}\r                        <td style="width: 200px;">&nbsp;</td>\r                {/section}\r                {/if}\r                </tr>\r        {/if}\r   {/section}\r</table>\r{$copyright}', '2014-12-10 13:08:57', '2014-12-10 13:08:57'),
('News', 'formSample', '{* original form template *}\n{if isset($error)}\n  <h3><font color="red">{$error}</font></h3>\n{else}\n  {if isset($message)}\n    <h3>{$message}</h3>\n  {/if}\n{/if}\n{$startform}\n	<div class="pageoverflow">\n		<p class="pagetext">*{$titletext}:</p>\n		<p class="pageinput">{$inputtitle}</p>\n	</div>\n	<div class="pageoverflow">\n		<p class="pagetext">{$categorytext}:</p>\n		<p class="pageinput">{$inputcategory}</p>\n	</div>\n{if !isset($hide_summary_field) or $hide_summary_field == 0}\n	<div class="pageoverflow">\n		<p class="pagetext">{$summarytext}:</p>\n		<p class="pageinput">{$inputsummary}</p>\n	</div>\n{/if}\n	<div class="pageoverflow">\n		<p class="pagetext">*{$contenttext}:</p>\n		<p class="pageinput">{$inputcontent}</p>\n	</div>\n	<div class="pageoverflow">\n		<p class="pagetext">{$extratext}:</p>\n		<p class="pageinput">{$inputextra}</p>\n	</div>\n	<div class="pageoverflow">\n		<p class="pagetext">{$startdatetext}:</p>\n		<p class="pageinput">{html_select_date prefix=$startdateprefix time=$startdate end_year="+15"} {html_select_time prefix=$startdateprefix time=$startdate}</p>\n	</div>\n	<div class="pageoverflow">\n		<p class="pagetext">{$enddatetext}:</p>\n		<p class="pageinput">{html_select_date prefix=$enddateprefix time=$enddate end_year="+15"} {html_select_time prefix=$enddateprefix time=$enddate}</p>\n	</div>\n	{if isset($customfields)}\n	   {foreach from=$customfields item=''onefield''}\n	      <div class="pageoverflow">\n		<p class="pagetext">{$onefield->name}:</p>\n		<p class="pageinput">{$onefield->field}</p>\n	      </div>\n	   {/foreach}\n	{/if}\n	<div class="pageoverflow">\n		<p class="pagetext">&nbsp;</p>\n		<p class="pageinput">{$hidden}{$submit}{$cancel}</p>\n	</div>\n{$endform}\n', '2013-02-11 09:15:25', '2014-07-30 13:30:05'),
('News', 'browsecatSample', '{if $count > 0}\n<ul class="list1">\n{foreach from=$cats item=node}\n{if $node.depth > $node.prevdepth}\n{repeat string="<ul>" times=$node.depth-$node.prevdepth}\n{elseif $node.depth < $node.prevdepth}\n{repeat string="</li></ul>" times=$node.prevdepth-$node.depth}\n</li>\n{elseif $node.index > 0}</li>\n{/if}\n<li class="newscategory">\n{if $node.count > 0}\n	<a href="{$node.url}">{$node.news_category_name}</a> ({$node.count}){else}<span>{$node.news_category_name} (0)</span>{/if}\n{/foreach}\n{repeat string="</li></ul>" times=$node.depth-1}</li>\n</ul>\n{/if}', '2013-02-11 09:15:25', '2014-07-30 13:30:05'),
('News', 'email_template', 'A new news article has been posted to your website.  The details are as follows:\r\nTitle:      {$title}\r\nIP Address: {$ipaddress}\r\nSummary:    {$summary|strip_tags}\r\nPost Date:  {$postdate|date_format}\r\nStart Date: {$startdate|date_format}\r\nEnd Date:   {$enddate|date_format}\r\n', '2013-02-11 09:15:25', '2014-09-29 13:27:18'),
('Search', 'displaysearch', '{$startform}\n<div class="search_block">\n	<input type="submit" value="" />\n	<input type="text" id="{$search_actionid}searchinput" name="{$search_actionid}searchinput" value="{$searchtext}" />\n</div>\n{$endform}', '2013-02-11 09:15:25', '2014-07-30 13:30:05'),
('Search', 'displayresult', '<h3>{#jusu_ieskoma_fraze#} &quot;{$phrase}&quot;</h3>\n{assign var="show_prods" value=0}\n{assign var="productlist" value=""}\n{capture name="sr_page" assign="sr_page"}\n	{if $itemcount > 0}\n		<ul>\n		  {foreach from=$results item=entry}\n		  {if $entry->module == ''Products''}\n			{assign var="show_prods" value=1}\n			{if $productlist==""}\n				{assign var="productlist" value=$entry->modulerecord}\n			{else}\n				{assign var="productlist" value="`$productlist`,`$entry->modulerecord`"}\n			{/if}\n		  {/if}\n		  <li><a href="{$entry->url}">{$entry->urltxt}</a></li>\n		  {* \n			 You can also instantiate custom behaviour on a module by module basis by looking at\n			 the $entry->module and $entry->modulerecord fields in $entry \n			  ie: {if $entry->module == ''News''}{News action=''detail'' article_id=$entry->modulerecord detailpage=''News''} \n		  *}\n		  \n		  {/foreach}\n		</ul>\n	{else}\n	  <p><strong>{$noresultsfound}</strong></p>\n	{/if}\n{/capture}\n{if $show_prods==1}\n	{Products detailpage=$smarty.config.detail_products productlist=$productlist}\n{else}\n	{$sr_page}\n{/if}\n\n', '2013-02-11 09:15:25', '2014-07-30 13:30:05'),
('CGExtensions', 'cg_errormsg', '{* original template for displaying frontend errors *}\n<div class="{$cg_errorclass}">{$cg_errormsg}</div>', '2013-02-11 11:33:50', '2014-07-30 13:30:05'),
('CGExtensions', 'sortablelists_Sample', '{* sortable list template *}\n\n{*\n This template provides one example of using javascript in a CMS module template.  The javascript is left here as an example of how one can interact with smarty in javascript.  You may infact want to put most of these functions into a seperate .js file and include it somewhere in your head section.\n\n You are free to modify this javascript and this template.  However, the php driver scripts look for a field named in the smarty variable {$selectarea_prefix}, and expect that to be a comma seperated list of values.\n *}\n\n{literal}\n<script type=''text/javascript''>\nvar allowduplicates = {/literal}{$allowduplicates};{literal}\nvar selectlist = {/literal}"{$selectarea_prefix}_selectlist";{literal}\nvar masterlist = {/literal}"{$selectarea_prefix}_masterlist";{literal}\nvar addbtn = {/literal}"{$selectarea_prefix}_add";{literal}\nvar rembtn = {/literal}"{$selectarea_prefix}_remove";{literal}\nvar upbtn = {/literal}"{$selectarea_prefix}_up";{literal}\nvar downbtn = {/literal}"{$selectarea_prefix}_down";{literal}\nvar valuefld = {/literal}"{$selectarea_prefix}";{literal}\nvar max_selected = {/literal}{$max_selected};{literal}\n\nfunction selectarea_update_value()\n{\n  var sel_elem = document.getElementById(selectlist);\n  var val_elem = document.getElementById(valuefld);\n  var sel_idx = sel_elem.selectedIndex;\n  var opts = sel_elem.getElementsByTagName(''option'');\n  var tmp = new Array();\n  for( i = 0; i < opts.length; i++ )\n    {\n      tmp[tmp.length] = opts[i].value;\n    }\n  var str = tmp.join('','');\n  val_elem.value = str;  \n}\n\nfunction selectarea_handle_down()\n{\n  var sel_elem = document.getElementById(selectlist);\n  var sel_idx = sel_elem.selectedIndex;\n  var opts = sel_elem.getElementsByTagName(''option'');\n  for( var i = opts.length - 2; i >= 0; i-- )\n    {\n      var opt = opts[i];\n      if( opt.selected )\n        {\n           var nextopt = opts[i+1];\n           opt = sel_elem.removeChild(opt);\n           nextopt = sel_elem.replaceChild(opt,nextopt);\n           sel_elem.insertBefore(nextopt,opt);\n        }\n    }\n  selectarea_update_value();\n}\n\nfunction selectarea_handle_up()\n{\n  var sel_elem = document.getElementById(selectlist);\n  var sel_idx = sel_elem.selectedIndex;\n  var opts = sel_elem.getElementsByTagName(''option'');\n  if( sel_idx > 0 )\n    {\n      for( var i = 1; i < opts.length; i++ )\n        {\n          var opt = opts[i];\n          if( opt.selected )\n            {\n              sel_elem.removeChild(opt);\n               sel_elem.insertBefore(opt, opts[i-1]);\n            }\n        }\n    }\n  selectarea_update_value();\n}\n\nfunction selectarea_handle_remove()\n{\n  var sel_elem = document.getElementById(selectlist);\n  var sel_idx = sel_elem.selectedIndex;\n  if( sel_idx >= 0 )\n    {\n      var val = sel_elem.options[sel_idx].value;\n      sel_elem.remove(sel_idx);\n    }\n  selectarea_update_value();\n}\n\nfunction selectarea_handle_add()\n{\n  var mas_elem = document.getElementById(masterlist);\n  var mas_idx = mas_elem.selectedIndex;\n  var sel_elem = document.getElementById(selectlist);\n  var opts = sel_elem.getElementsByTagName(''option'');\n  if( opts.length >= max_selected && max_selected > 0) return;\n  if( mas_idx >= 0 )\n    {\n      var newOpt = document.createElement(''option'');\n      newOpt.text = mas_elem.options[mas_idx].text;\n      newOpt.value = mas_elem.options[mas_idx].value;\n      if( allowduplicates == 0 )\n        {\n          for( var i = 0; i < opts.length; i++ )\n          {\n            if( opts[i].value == newOpt.value ) return;\n          }\n        }\n      sel_elem.add(newOpt,null);\n    }\n  selectarea_update_value();\n}\n\n\nfunction selectarea_handle_select()\n{\n  var sel_elem = document.getElementById(selectlist);\n  var sel_idx = sel_elem.selectedIndex;\n  var mas_elem = document.getElementById(masterlist);\n  var mas_idx = mas_elem.selectedIndex;\n  addbtn.disabled = (mas_idx >= 0);\n  rembtn.disabled = (sel_idx >= 0);\n  addbtn.disabled = (sel_idx >= 0);\n  downbtn.disabled = (sel_idx >= 0);\n}\n\n</script>\n{/literal}\n\n <table>\n   <tr>\n     <td>\n      {* left column - for the selected items *}\n      {$label_left}<br/>\n      <select id="{$selectarea_prefix}_selectlist" size="10" onchange="selectarea_handle_select();">\n        {html_options options=$selectarea_selected}\n      </select><br/>\n     </td>\n     <td>\n      {* center column - for the add/delete buttons *}\n      <input type="submit" id="{$selectarea_prefix}_add" value="&lt;&lt;" onclick="selectarea_handle_add(); return false;"/><br/>\n      <input type="submit" id="{$selectarea_prefix}_remove" value="&gt;&gt;" onclick="selectarea_handle_remove(); return false;"/><br/>\n      <input type="submit" id="{$selectarea_prefix}_up" value="{$upstr}" onclick="selectarea_handle_up(); return false;"/><br/>\n      <input type="submit" id="{$selectarea_prefix}_down" value="{$downstr}" onclick="selectarea_handle_down(); return false;"/><br/>\n     </td>\n     <td>\n      {* right column - for the master list *}\n      {$label_right}<br/>\n      <select id="{$selectarea_prefix}_masterlist" size="10" onchange="selectarea_handle_select();">\n        {html_options options=$selectarea_masterlist}\n      </select>\n     </td>\n   </tr>\n </table>\n <div><input type="hidden" id="{$selectarea_prefix}" name="{$selectarea_prefix}" value="{$selectarea_selected_str}" /></div>\n', '2013-02-11 11:33:50', '2014-07-30 13:30:05'),
('MenuManager', 'lang', '<div class="langs_drop">\n    <ul class="drop">\n        {assign var=kiekkalbu value=$nodelist|@count}\n        {foreach from=$nodelist item=node name=langu}\n            {if $node->depth==1}\n                <li class="{if ($node->current == true) || ($node->parent) } selected{assign var=kalba value=$node->alias}{assign var=kalba2 value=$node->menutext}{/if}"><a href="/{$node->alias}/">{$node->menutext}</a></li>\n            {/if}\n        {/foreach}\n    </ul>\n    <a href="#">{$kalba2}</a>\n</div>\n', '2013-02-11 14:21:23', '2014-10-14 17:03:36'),
('MenuManager', 'mainmenu', '<ul class="main_menu">\n	{foreach from=$nodelist item=node name=pagr key=key}\n		{if $node->depth==2}\n			<li class="{if ($node->current == true) || ($node->parent) }selected{/if}">\n				<a href="{$node->alias}.html"><span>{$node->menutext}</span></a>\n				{capture assign="parent_alias"}{$node->alias}.html{/capture}\n				{menu childrenof=$node->id template="mainmenu2" number_of_levels="1"}\n			</li>\n		{/if}\n	{/foreach}\n</ul>', '2013-02-11 14:41:25', '2014-07-30 13:30:05'),
('News', 'summarytitle_page', '<div class="bottom_carusel_container">\n    <a href="#" class="bottom_carusel_back"><span></span></a>\n    <a href="#" class="bottom_carusel_next"><span></span></a>\n    <div class="cycle-slideshow bottom_carusel" \n        data-cycle-fx="carousel" \n        data-cycle-timeout="200000"\n        data-cycle-slides="> div"\n        data-cycle-pause-on-hover="true"\n        data-cycle-prev=".bottom_carusel_next "\n        data-cycle-next=".bottom_carusel_back"\n        data-cycle-log="false"\n        data-cycle-carousel-visible="3"\n        >\n        {foreach from=$items item=entry}\n            <div>\n            	{capture assign="image_url"}{$entry->file_location}/{$entry->fields.Nuotrauka->value}{/capture}\n                {capture assign="image_url_2"}{$entry->file_location}/{$entry->fields.Fonine_nuotrauka->value}{/capture}\n                <div class="bg" style="background-image:url({CGSmartImage src=$image_url_2 filter_croptofit=''427,262'' quality=100 notag=1})"><div></div></div>\n                <div class="cont">\n                	{if $entry->fields.Nuotrauka->value !=''''}\n                    	<img src="{CGSmartImage src=$image_url filter_croptofit=''115,115'' quality=100 notag=1}" width="115" height="115" class="photo" alt=""/>\n                    {/if}\n                    <div class="descr">\n                        <h2>{$entry->title|@truncate:80}</h2>\n                        {$entry->summary|@truncate:150}\n                    </div>\n                    \n                </div>\n                <a href="{$entry->link}" class="more_marker">\n                    <span>{#placiau#}</span>\n                </a>\n            </div>\n            \n        {/foreach}\n    </div>\n</div>', '2013-02-20 11:38:51', '2014-11-26 09:52:28'),
('Products', 'byhierarchy_top', '<div class="categries_drops">\n	{assign var="cat_page" value=0}\n	{foreach from=$hierdata key=''key'' item=''item''}\n		{if $active_hierarchy == $item.id}\n			{assign var="cat_page" value=1}\n		{/if}\n		{if (isset($active_hierarchy) and $item.id == $active_hierarchy) || $item.id|in_array:$hierarchy_tree}\n			{assign var="parent" value=$item.id}\n		{/if}\n		<div{if (isset($active_hierarchy) and $item.id == $active_hierarchy) || $item.id|in_array:$hierarchy_tree} class="selected"{/if}>\n			{*<pre>\n			{$item|@print_r}\n			</pre>*}\n			<a href="{$item.url}">\n				{if $item.id == 2}\n					<img src="images/icons/ico_5.png" alt="" />\n					<img class="h" src="images/icons/ico_5_h.png" alt="" />\n				{elseif $item.id == 1}\n					<img src="images/icons/ico_4.png" alt="" />\n					<img class="h" src="images/icons/ico_4_h.png" alt="" />\n				{else}\n					<img src="images/icons/ico_3.png" alt="" />\n					<img class="h" src="images/icons/ico_3_h.png" alt="" />\n				{/if}\n				<span>{$item.name.$kalba}</span>\n			</a>\n			<div class="sub_drop_container">\n				{if $item.image != ''''}\n					{CGSmartImage src="`$hierarchy_image_location`/`$item.image`" filter_croptofit=''425,233,c,1'' quality=100 class="ilustration"}\n				{/if}\n				<div class="cont">\n					{if isset($item.children) }\n						{Products action="hierarchy" hierarchytemplate="inner1" parent=$item.id}\n					{/if}\n					<div class="descrs">\n						<h2>{$item.name.$kalba}</h2>\n						<div>\n							{$item.description.$kalba}\n						</div>\n						<br />\n						{if $item.file}\n							<div>\n								<a href="{$hierarchy_image_location}/{$item.file}" target="_blank" class="ext_button yellow f_13">\n									<i class="ico left"><i style="background-image:url({root_url}/images/icons/ico_10.png)"></i></i>\n									<span>{#download#}</span>\n								</a>\n							</div>\n						{/if}\n					</div>\n				</div>\n			</div>\n		</div>\n\n\n\n	  {*<li {if isset($active_hierarchy) and $item.id == $active_hierarchy} class="active"{/if}>\n	  {if $item.count gt 0}\n		 <a href="{$item.url}">{$item.name} ({$item.count})</a>\n	  {else}\n		 {$item.name} ({$item.count})\n	  {/if}\n	  \n	  {if isset($item.children) }\n		{include file=$smarty.template hierdata=$item.children hdepth=$hdepth+1}\n	  {/if}\n	  \n	  </li>*}\n\n	{/foreach}\n</div>', '2014-08-04 14:19:26', '2014-11-03 08:43:54'),
('CGEcommerceBase', 'lineitem_desc_template', '{* product summary template *}\n{* used for summarizing products in view cart form page *}\n{strip}\n{if isset($product_obj)}\n{$product_obj->get_name()}&nbsp;\n{foreach from=$meta->attributes item=''attrib''}\n  {$attrib->name}&nbsp;{if $attrib->adjustment != 0}{$currencysymbol}({$attrib->adjustment|number_format:2}){/if}&nbsp;\n{/foreach}\n{/if}\n{/strip}', '2013-02-28 17:30:52', '2013-05-31 11:20:34'),
('AComments', 'default_display', '<script type="text/javascript">\n	var bad_comment = ''{#bad_comment#}'';\n</script>\n<div id="comments">\n\n{if $items}\n<ul class="comment_list">\n{/if}\n{foreach from=$items item=entry}\n	<li>{if $entry->comment_title}<strong>{$entry->comment_title}</strong><br />{/if}\n	{if $entry->comment_author}\n		{if $entry->author_website}<a href="{$entry->author_website}" target="_blank">{$entry->comment_author}</a> - \n		{else}{$entry->comment_author} - \n		{/if}\n	{else if $entry->author_website}<a href="{$entry->author_website}" target="_blank">{$entry->author_website}</a> - \n	{/if}\n	{$entry->date|date_format:"%Y-%m-%d %H:%M:%S"}<br />\n	{$entry->comment_data}\n	</li>\n{/foreach}\n{if $items}\n</ul>\n{/if}\n\n{if FALSE == $errormessage}\n{*startExpandCollapse id="name" title="$addacomment"*}\n{else}\n{$errormessage}\n{/if}\n{*<h3>{$addacomment}</h3>*}\n\n{$startform}\n{*<form id="{$id}moduleform_1" method="post" action="{$returnurl}" class="cms_form">*}\n{$image}\n\n<table class="comment_box" width="100%" border="0" cellspacing="0" cellpadding="0">\n	{*<tr>\n		<td>{$titletxt}:</td>\n		<td>{$inputtitle}</td>\n	</tr>*}\n	<tr>\n		<td>{#jusu_vardas#}(*):</td>\n		<td>{$inputyourname}</td>\n	</tr>\n	<tr>\n	{*	<td>{$emailtxt}:</td>\n		<td>{$inputemail}</td>\n	</tr>\n	<tr>\n		<td>{$notifytxt}:</td>\n		<td>{$inputnotify}</td>\n	</tr>\n	<tr>\n		<td>{$websitetxt}:</td>\n		<td>{$inputwebsite}</td>\n	</tr>*}\n	<tr>\n		<td>{#comentaras#}(*):</td>\n		<td>{$inputcomment}</td>\n	</tr>\n{if $spamprotect}\n	<tr>\n		<td>{$entercodetxt}:</td>\n		<td>{$spamprotectimage}<br />{$inputentercode}</td>\n	</tr>\n{/if}\n	<tr>\n		<td>&nbsp;</td>\n		<td><div class="submit_comment">{$submit}</div></td>\n	</tr>\n</table>\n\n{*</form>*}\n{$endform}\n{if FALSE == $errormessage}\n{*stopExpandCollapse*} \n{/if}\n\n{if $trackback == 1}\n<span class="trackback"><a href="{$trackbackurl}" rel="nofollow">Trackback-URL</a></span>\n<!--\n<rdf:RDF\n	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n	xmlns:dc="http://purl.org/dc/elements/1.1/"\n	xmlns:trackback="{$trackbackurl}">\n<rdf:Description\n	rdf:about="{$redirecturl}"\n	dc:title="{$pagetitle}"\n	dc:identifier="{$redirecturl}"\n	trackback:ping="{$trackbackurl}" />\n</rdf:RDF>\n-->\n{/if}\n\n</div>', '2013-02-28 15:56:53', '2013-05-31 11:20:35'),
('News', 'summarypagrindinis', '\n<div class="news_list">\n{foreach from=$items item=entry}\n	<div>\n		<a href="{$entry->moreurl}" class="ph">\n			{if $entry->fields.Nuotrauka->_data.value}\n				{capture assign="image_url"}{root_url}/uploads/news/id{$entry->id}/{$entry->fields.Nuotrauka->_data.value}{/capture}\n			{else}\n				{capture assign="image_url"}{root_url}/images/default_image.png{/capture}\n			{/if}\n		\n			<img src="{CGSmartImage src=$image_url filter_croptofit=''180,180,c,1'' noautoscale=''false'' notag=1}" width="180" height="180" alt=""/>\n			{if $entry->extra}<span>{$entry->extra}</span>{/if}\n		</a>\n		<div class="cont">\n			<span class="date">{$entry->postdate|date_format:''%Y. %m. %d''}</span>\n			<strong class="title">{$entry->title}</strong>\n			{eval var=$entry->summary}\n			<div class="act">\n				<a href="{$entry->moreurl}">{#placiau#}</a>\n			</div>\n		</div>	\n	</div>\n{/foreach}\n</div>\n\n\n\n{if $pagecount > 1}\n	<div class="pagination_container">\n		<dl class="pagination">\n			{if $pagenumber > 1}\n				<dt class="back">{$firstpage}</dt><dt class="back">{$prevpage}</dt>\n			{/if}\n			<dt><a>{#pagetext#}&nbsp;{$pagenumber}&nbsp;{#oftext#}&nbsp;{$pagecount}</a></dt>\n			{if $pagenumber < $pagecount}\n				<dt class="next">{$nextpage}</dt><dt class="next">{$lastpage}</dt>\n			{/if}\n		</dl>\n	</div>\n{/if}\n\n\n', '2013-03-04 11:10:46', '2014-07-30 13:30:05'),
('MenuManager', 'topmenu', '<ul class="main_menu">\r\n    {foreach from=$nodelist item=node name=topm}\r\n		{if $node->depth==2}\r\n            <li class="{if ($node->current == true) || ($node->parent) }selected{/if}">\r\n            	<a href="{$node->alias}.html">\r\n					{$node->menutext}\r\n				</a>  \r\n				{*menu childrenof=$node->id template="mainmenu2" number_of_levels="1"*}			\r\n            </li>\r\n			\r\n    	{/if}\r\n	{/foreach}\r\n</ul>', '2013-05-27 11:37:23', '2014-07-30 14:24:30'),
('MenuManager', 'dropd', '<div class="main_menu_second_level">\n    {foreach from=$nodelist item=node name=langu}\n        {if $node->depth==1}\n            <div class="{if ($node->current == true) || ($node->parent) }selected {/if}{if $node->children_exist}has_submenu{/if}">\n                <a href="{$node->url}">\n                    <span>{$node->menutext}</span>\n                </a>\n                {menu childrenof=$node->id template="dropd2" number_of_levels="1"}\n            </div>\n        {/if}\n    {/foreach}\n</div>', '2013-05-27 16:18:18', '2014-07-30 13:30:05'),
('News', 'detailpagrindinis', '<h1 class="main_title">\r\n	{title} /\r\n	{$entry->postdate|date_format:''%Y&nbsp;%m&nbsp;%d''} \r\n    {$entry->title|cms_escape:htmlall}\r\n</h1>\r\n{eval var=$entry->content}\r\n{assign var="active_news" value=$entry->id}\r\n{literal}\r\n<style>\r\n	.current_news_item{\r\n		display:block !important\r\n	}\r\n	.news_item_list,\r\n	.section > .main_title{\r\n		display:none !important\r\n	}\r\n</style>\r\n{/literal}', '2013-03-04 11:11:02', '2014-08-14 16:54:58'),
('Gallery', 'Fancybox', '							<div class="inner-galery colum-1">\n								{foreach from=$images item=image}\n								<a class="fancy" rel="gallery" href="{$image->file}" title=""><img src="{CGSmartImage src=$image->file filter_croptofit=''226,169,1,c'' noautoscale=''false'' notag=1}" alt="" /></a>\n								{/foreach}\n							</div>', '2013-04-16 14:58:49', '2014-07-26 13:24:17'),
('Products', 'search_Sample', '{* search template *}\n{* valid fields are:\n   {$actionid}cd_submit    - (string) for a submit button\n   {$actionid}cd_cancel    - (string) for a cancel button\n   {$actionid}cd_prodname  - (string) for text field to search against product name\n   {$actionid}cd_proddesc  - (string) for text field to search against product description.\n   {$actionid}cd_prodprice - (select) for price searching.\n     options must be of type string with high low limits separated by a :\n     i.e:   1000:2000\n     a special value of -1 can be used to indicate any price.\n   {$actionid}cd_prodprice_min - (string) for minimum price value\n   {$actionid}cd_prodprice_max - (string) for minimum price value\n     note: it is possible to specify only one of prodprice_min or prodprice_max\n     if either prodprice_min or prodprice_max is specified, prodprice is ignored.\n   {$actionid}cd_allany    - (int) to indicate wether all of the \n     conditions much match, or if any one of them may.\n   {$actionid}cd_prodvalue - (array) field values.\n   {$actionid}cd_prodvalue_<fldname>_min - Minimum value to search for for in the <fldname> field.\n   {$actionid}cd_prodvalue_<fldname>_max - Maximum value to search for for in the <fldname> field.\n*}\n\n<div id="prod_searchform">\n{$formstart}\n\n<div class="row">\n  <p class="row_prompt">{$mod->Lang(''search_expr'')}:</p>\n  <p class="row_input">\n    <select name="{$actionid}cd_allany">\n      <option value="0">{$mod->Lang(''all'')}</option>\n      <option value="1">{$mod->Lang(''any'')}</option>\n    </select>\n  </p>\n</div>\n\n<div class="row">\n  <p class="row_prompt">{$mod->Lang(''search_name'')}:</p>\n  <p class="row_input">\n    <input type="text" name="{$actionid}cd_prodname" size="40" maxlength="255"/>\n  </p>\n</div>\n\n<div class="row">\n  <p class="row_prompt">{$mod->Lang(''search_description'')}:</p>\n  <p class="row_input">\n    <input type="text" name="{$actionid}cd_proddesc" size="40" maxlength="255"/>\n  </p>\n</div>\n\n<div class="row">\n  <p class="row_prompt">{$mod->Lang(''search_price'')}:</p>\n  <p class="row_input">\n    <select name="{$actionid}cd_prodprice">\n      <option value="-1">{$mod->Lang(''any'')}</option>\n      <option value="0:99.99">Less Than $100</option>\n      <option value="100:999.99">$100 to $1000</option>\n      <option value="1000:9999.99">$1000 to $10000</option>\n      <option value="10000:9999999">Greater than $10000</option>\n    </select>\n  </p>\n</div>\n\n{if isset($searchprops)}\n{foreach from=$searchprops key=''fldname'' item=''obj''}\n<div class="row">\n  <p class="row_prompt">{$obj->prompt}:</p>\n  <p class="row_input">\n    {if $obj->type == ''text''}\n      <input type="text" name="{$actionid}cd_prodvalue[{$fldname}]" size="40" maxlength="40"/>\n    {else if $obj->type == ''dropdown''}\n      <select name="{$actionid}cd_prodvalue[{$fldname}]">\n      {html_options options=$obj->options}\n      </select>\n    {/if}\n  </p>\n</div>\n{/foreach}\n{/if}\n\n<div class="row">\n  <p class="row_prompt"></p>\n  <p class="row_input">\n    <input type="submit" name="{$actionid}cd_submit" value="{$mod->Lang(''submit'')}"/>\n    <input type="submit" name="{$actionid}cd_cancel" value="{$mod->Lang(''cancel'')}"/>\n  </p>\n</div>\n\n\n{$formend}\n</div>{* prod_searchform *}', '2014-07-30 08:32:25', '2014-07-30 13:30:05'),
('AdvancedContent', 'multi_input_SampleTemplate', '<div class="pageoverflow">\r\n<p>\r\n{foreach from=$inputs item=elm}\r\n	{$elm->GetProperty(''label'')}:&nbsp;{$elm->GetInput()}&nbsp;\r\n{/foreach}\r\n</p>\r\n</div>', '2014-03-30 18:41:47', '2014-04-24 19:05:25'),
('Gallery', 'prettyPhoto', '{if !$gallery_inserted}\n	<script src="{root_url}/js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>\n    <link rel="stylesheet" type="text/css" href="{root_url}/js/fancybox/jquery.fancybox.css" />\n	{literal}\n	<script type="text/javascript">\n	$(document).ready(function() {\n		$(".fancybox").fancybox({helpers : {media : {},overlay: {locked: false}}});\n\n	});	\n	</script>\n	{/literal}\n{/if}	\n	{assign var="gallery_inserted" value=1}\n	\n\n                                <div class="slider_2_container">\n								{if $images|@count > 8}\n                                    <a href="#" class="slider_2_back back_id_1"><span><span></span></span></a>\n                                    <a href="#" class="slider_2_next next_id_1"><span><span></span></span></a>\n								{/if}	\n                                    <div class="cycle-slideshow slider_2" \n                                    data-cycle-fx="scrollHorz" \n                                    data-cycle-log="false" \n                                    data-cycle-slides="> div"\n                                    data-cycle-timeout="30000"\n                                    data-cycle-pause-on-hover="true"\n                                    data-cycle-prev=".back_id_1"\n                                    data-cycle-next=".next_id_1"\n                                    data-cycle-auto-height="container"\n                                    data-cycle-speed="200"\n                                    data-cycle-swipe="true"\n                                    >\n                                        <div>\n                                        	<ul class="colors_list">\n												{assign var="imgnum" value=0}\n												{foreach from=$images item=image}\n												{assign var="imgnum" value=$imgnum+1}\n												{if $imgnum > 8}\n													{assign var="imgnum" value=1}\n													</ul></div><div><ul class="colors_list">\n												{/if}\n												\n												\n												\n													<li>\n														<a target="_blank" class="{if $user_agent != "mob" || ($user_agent == "mob" && $desktop_session)}fancybox{/if}" rel="gallcol{$galleryid}" href="{$image->file}" style="background-image:url(''{CGSmartImage src=$image->file filter_croptofit=''80,80,1,c'' noautoscale=''false'' notag=1}'')"></a>\n													</li>\n												{/foreach}			\n                                            </ul>\n                                        </div>\n\n                                    </div>\n                                    <div class="slider_2_pagination_place">\n                                        <span class="slider_2_pagination"></span>\n                                    </div>\n                                </div>', '2013-04-16 14:58:49', '2014-04-29 10:38:35'),
('MenuManager', 'side_meniu', '{if $nodelist|@count}\r\n<div id="sidebar">\r\n    <ul class="side_menu">\r\n        {foreach from=$nodelist item=node name=sida}\r\n            {if $node->depth==1}\r\n                <li class="{if ($node->current == true) || ($node->parent)}selected{/if}">\r\n                    <a href="{$node->alias}.html">{$node->menutext}</a>\r\n                    {*menu childrenof=$node->id template="side_meniu2" number_of_levels="1"*}\r\n                </li>						\r\n            {/if}\r\n        {/foreach}\r\n	</ul>\r\n</div>\r\n{/if}\r\n', '2013-07-05 16:23:20', '2014-07-30 15:47:41'),
('Products', 'summary_titlepage', '    <div class="index_blocks_gallery">\n    	<div id="wrapper">\n        	<a href="#" class="carousel_back"></a>\n            <a href="#" class="carousel_next"></a>\n            <div id="inner">\n                <div id="carousel">\n					{foreach from=$items item="entry"}\n					{capture assign="image_url"}{if $entry->fields.nuotrauka1->value}{root_url}/uploads/Products/product_{$entry->id}/{$entry->fields.nuotrauka1->value}{else}{root_url}/images/no-image.png{/if}{/capture}\n					\n                    <div style="background-image:url({CGSmartImage src=$image_url filter_croptofit=''673,673'' quality=100 notag=1})">					\n                    	<a href="{$entry->detail_url}">\n                        	<span class="cont">\n                            	<h2>{$entry->fields.pavadinimas->value.$kalba}</h2>\n                                <span class="descr">\n                                {$entry->fields.projekto_nr->prompts.$kalba}: {$entry->fields.projekto_nr->value}\n                                <br />\n                                {$entry->fields.laivas->prompts.$kalba}: {$entry->fields.laivas->value}\n                                <br />\n                                {$entry->fields.laivo_tipas->prompts.$kalba}: {$entry->fields.laivo_tipas->value}\n                                <br />\n                                {$entry->fields.savininkas->prompts.$kalba}: {$entry->fields.savininkas->value}\n                                <br />\n                                {$entry->fields.uostas->prompts.$kalba}: {$entry->fields.uostas->value}\n                                <br />\n                                {$entry->fields.projekto_metai->prompts.$kalba}: {$entry->fields.projekto_metai->value}\n                                <br />\n                                {$entry->fields.atlikti_darbai->prompts.$kalba}: {$entry->fields.atlikti_darbai->value.$kalba}\n                                </span>\n                            </span>\n                        </a>\n                    </div>						\n					{/foreach}\n				</div>\n			</div>\n		</div>\n	</div>	', '2014-07-30 09:27:30', '2014-07-30 13:30:05'),
('MenuManager', 'side_meniu2', '{if $nodelist|@count}\n							<ul class="side_menu">\n							{foreach from=$nodelist item=node name=sida}\n						{if $node->depth==1}\n							<li class="{if ($node->current == true) || ($node->parent)}selected{/if}">\n								<a  href="{$node->alias}.html">{$node->menutext}</a>\n							</li>						\n						{/if}\n					{/foreach}\n							</ul>\n{/if}\n                ', '2014-07-27 12:26:56', '2014-07-30 13:30:05'),
('News', 'summarylist_page', '<div class="cycle-slideshow news_anounce"\r\n    data-cycle-fx="scrollHorz" \r\n    data-cycle-timeout="3000"\r\n    data-cycle-log="false"\r\n    data-cycle-slides="> div"\r\n    data-cycle-auto-height="container"\r\n    data-cycle-pager=".news_anounce_pagination"\r\n    data-cycle-pause-on-hover="true">\r\n    {foreach from=$items item=entry name=''news''}\r\n        <div>\r\n            <div class="date">{$entry->postdate|date_format:"%Y. %m. %d"}</div>\r\n            <a href="{$entry->moreurl}" class="title">{$entry->title}</a>\r\n            <div>\r\n                {$entry->summary|truncate:130}\r\n            </div>\r\n        </div>\r\n    {/foreach}\r\n</div>\r\n						\r\n', '2013-08-19 09:50:48', '2014-09-29 13:24:31'),
('MenuManager', 'mainmenu2', '	<div class="submenu_container">\n		<div class="container section">\n			<ul>\n		{foreach from=$nodelist item=node2 name=pagr}\n			<li class="{if ($node2->current == true) || ($node2->parent) }selected{/if}">\n				<a href="{$node2->alias}.html">{$node2->menutext}</a>\n				{*menu childrenof=$node2->id template="mainmenu3" number_of_levels="1"*}\n			</li>\n		{/foreach}\n			</ul>\n			<div class="submenu_custom_contenbt">\n				{MeniuAdd alias=$parent_alias}\n			</div>			\n		</div>\n</div>', '2014-03-29 18:50:41', '2014-07-30 13:30:05'),
('Products', 'categorylist_Sample', '<div class="products_category_list">\n{foreach from=$categorylist item=''obj''}\n  <div class="products_category">\n    {* category fields are available as an array in $obj->fields *}\n    {* i.e: $obj->fields.fieldname.field_value *}\n    {if isset($obj->fields)}\n    {foreach from=$obj->fields key=''field_name'' item=''fielddata''}\n      <div class="products_category_field">\n        {$fielddata.field_prompt} = {$fielddata.field_value}\n      </div>\n    {/foreach}\n    {/if}\n    {if isset($obj->detail_url)}\n      <a href="{$obj->detail_url}">Details For {$obj->name}</a>&nbsp;&nbsp;\n    {/if}\n    <a href="{$obj->summary_url}">Products Matching {$obj->name}</a>({$obj->count})\n  </div>\n{/foreach}\n</div>\n', '2014-07-30 08:32:25', '2014-07-30 13:30:05'),
('FrontEndUsers', 'feusers_loginform', '{*\n{if $error}\n  {$error}<br>\n{/if}\n<p><label for="{$feuactionid}feu_input_username">{$prompt_username}:</label>&nbsp;{$input_username}<br/></p>\n<p><label for="{$feuactionid}feu_input_password">{$prompt_password}:</label>&nbsp;{$input_password}</p>\n{if isset($captcha)}<p>\n  <label for="{$feuactionid}input_captcha">{$captcha_title}:</label>&nbsp;{$input_captcha}<br/>{$captcha}</p>\n{/if}\n{if isset($input_rememberme)}<p>{$input_rememberme}&nbsp;<label for="{$feuactionid}feu_rememberme">{$prompt_rememberme}</input></p>{/if}\n<p><input type="submit" name="{$feuactionid}submit" value="{$mod->Lang(''login'')}"/></p>\n<p><a href="{$url_forgot}" title="{$mod->Lang(''info_forgotpw'')}">{$mod->Lang(''forgotpw'')}</a>&nbsp;\n<a href="{$url_lostun}" title="{$mod->Lang(''info_lostun'')}">{$mod->Lang(''lostusername'')}</a></p>\n</div>\n*}\n\n<div class="login_block">\n	{$startform}\n		{$input_username}\n		{$input_password}\n		<input type="submit" name="{$feuactionid}submit" value=""/>\n		{if $error}\n			<div class="error f_12">\n				{$error}\n			</div>\n		{/if}\n	{$endform}\n</div>', '2014-07-29 14:40:48', '2014-07-30 13:30:05'),
('FrontEndUsers', 'feusers_logoutform', '{* logout form template *}\n{*\n{if isset($message)}<div class="message">{$message}</div>{/if}\n<p>{$prompt_loggedin}&nbsp;{$username}</p> \n<p><a href="{$url_changesettings}" title="{$mod->Lang(''info_changesettings'')}">{$mod->Lang(''prompt_changesettings'')}</p>\n<p><a href="{$url_logout}" title="{$mod->Lang(''info_logout'')}">{$mod->Lang(''logout'')}</a></p>\n\n*}\n\n<div class="login_block">\n	{$startform}\n		<a href="{$url_logout}" class="ext_button brown f_12">\n			<span>{#do_logout#}</span>\n		</a>\n	{$endform}\n</div>\n', '2014-07-29 14:40:48', '2014-07-30 13:30:05'),
('MenuManager', 'mainmenu3', '<div class="level-2 footer">\n        <ul class="content">\n			{*}<li class="category"><span class="title"><span>Leggeri (3,3 - 7,0 t)</span></span><ul>{*}\n		{foreach from=$nodelist item=node3 name=pagr}\n			<li class="item {if ($node3->current == true) || ($node3->parent) }selected{/if}">\n			{menu childrenof=$node3->id template="mainmenu3_sublink" number_of_levels="1" assign="sublink"}\n				<a href="{if $sublink}{$sublink}{else}{$node3->alias}.html{/if}">\n				{if $node3->img}\n				<img src="{CGSmartImage src=$node3->img filter_croptofit=''105,80,c,1'' noautoscale=''false'' notag=1}">\n				{else}\n				<img src="{CGSmartImage src="/common/publishingimages/blank.jpg" filter_croptofit=''105,80,c,1'' noautoscale=''false'' notag=1}">\n				{/if}\n				<span>{$node3->menutext}</span></a>\n				{*menu childrenof=$node->id template="mainmenu3" number_of_levels="1"*}\n			</li>\n		{/foreach}\n		 {*}</ul>{*}\n		</ul>\n</div>', '2014-07-27 11:40:42', '2014-07-30 13:30:05'),
('MenuManager', 'bottommenu', '<nav class="flt-right">\n  {foreach from=$nodelist item=node name=pagr}\n		{if $node->depth==2}            \n			{if ($node->current == true) || ($node->parent) }{assign var="active_level" value=6}{/if}\n            	<a href="{$node->alias}.html">{$node->menutext}</a>  \n    	{/if}\n	{/foreach}\n</nav>', '2014-07-27 14:43:36', '2014-07-30 13:30:05'),
('FrontEndUsers', 'feusers_changesettingsform', '<!-- change settings template -->\n{$title}\n{if isset($message) && $message != ''''}\n  {if isset($error) && $error != ''''}\n    <p><font color="red">{$message}</font></p>\n  {else}\n    <p>{$message}</p>\n  {/if}\n{/if}\n{$startform}\n {if $controlcount > 0}\n  <center>\n  <table width="75%">\n     {foreach from=$controls item=control}\n  <tr>\n     <td>{if isset($control->hidden)}{$control->hidden}{/if}<font color="{$control->color}">{$control->prompt}{$control->marker}</font></td>\n     <td>\n       {if isset($control->image)}{$control->image}<br/>{/if}\n       {$control->control}{$control->addtext|default:''''}\n       {if isset($control->control2)}{$control->prompt2}&nbsp;{$control->control2}<br/>{/if}\n     </td>\n  </tr>\n {/foreach}\n  </table>\n  </center>\n {/if}\n {$hidden|default:''''}{$hidden2|default:''''}{$submit}\n{$endform}\n<!-- change settings template -->\n', '2014-07-29 14:40:48', '2014-07-30 13:30:05'),
('FrontEndUsers', 'feusers_forgotpasswordform', '<!-- forgot password template -->\n{$startform}\n{$title}\n{if !empty($message) }\n  {if !empty($error) }\n    <p><font color="red">{$message}</font></p>\n  {else}\n    <p>{$message}</p>\n  {/if}\n{/if}\n<p>{$lostpw_message}</p>\n<p>{$prompt_username}&nbsp;{$input_username}</p>\n{if isset($captcha)}\n<div>{$captcha_title}<br/>{$captcha}<br/>{$input_captcha}</div>\n{/if}\n<p>{$hidden}{$submit}&nbsp{$cancel}</p>\n{$endform}\n<!-- forgot password template --> \n', '2014-07-29 14:40:48', '2014-07-30 13:30:05'),
('FrontEndUsers', 'feusers_forgotpasswordemailform', '{* forgot password email template *}\n<p>{$message_forgotpwemail}</p>\n<p>{$prompt_code}&nbsp;{$data_code}</p>\n<p>{$prompt_link}&nbsp;{$data_link}<p>\n\n\n', '2014-07-29 14:40:48', '2014-07-30 13:30:05'),
('FrontEndUsers', 'feusers_forgotpasswordverifyform', '<!-- forgot password verification template -->\n{$startform}\n{$title}\n{if !empty($message)}\n  {if !empty($error) }\n    <p><font color="red">{$message}</font></p>\n  {else}\n    <p>{$message}</p>\n  {/if}\n{/if}\n<p>{$prompt_username}&nbsp;{$input_username}</p>\n<p>{$prompt_code}&nbsp;{$input_code}</p>\n<p>{$prompt_password}&nbsp;{$input_password}</p>\n<p>{$prompt_repeatpassword}&nbsp;{$input_repeatpassword}</p>\n<p>{$hidden}{$submit}</p>\n{$endform}\n<!-- forgot password verification template -->\n', '2014-07-29 14:40:48', '2014-07-30 13:30:05'),
('FrontEndUsers', 'feusers_lostunform', '{* lost username confirm template form *}\n<h4>{$title}</h4>\n{if isset($message)}<h5 class="error">{$message}</h5>{/if}\n{if $controlcount > 0}\n  {$startform}{$hidden}\n    <div class="pagerow">\n      <div class="page_prompt">{$prompt_password}</div>\n      <div class="page_input">{$input_password}</div>\n    </div>\n    {foreach from=$controls item=''entry''}\n       <div class="pagerow">\n          <div class="page_prompt">{$entry->hidden}{$entry->prompt}</div\n          <div class="page_input">{$entry->control}{$entry->addtext}</div>\n       </div>\n    {/foreach}\n    <div class="pagerow">{$submit}{$cancel}</div>\n    <div class="pagerow">\n       {$captcha_title}{$input_captcha}{$captcha}\n    </div>\n  {$endform}\n{/if}', '2014-07-29 14:40:48', '2014-07-30 13:30:05'),
('FrontEndUsers', 'feusers_lostunform_confirm', '{* lost username confirm template form *}\n<p>{$premsg}</p>\n<p>{$prompt_yourusernameis}: <strong>{$username}</strong>.</p>\n<p>{$postmsg}</p>', '2014-07-29 14:40:48', '2014-07-30 13:30:05'),
('FrontEndUsers', 'notification_template', '{* this template defines how notification emails will be sent *}\n{* the same template is used for all notification events so you may need \n   to throw in some logic here to display all of the information you want\n   in each email. *}\n{* all smarty variables can be used in this template, including functions\n   from customcontent for frontend generated events *}\n{* I encourage you to use the {get_template_vars} smarty plugin and the\n   print_r smarty modifier to see what variables are available *}\n\n{get_template_vars}', '2014-07-29 14:40:48', '2014-07-30 13:30:05'),
('FrontEndUsers', 'feusers_viewuser', '{* view user template *}\n<p>{$feu->Lang(''id'')}:&nbsp;{$userinfo.id}</p>\n<p>{$feu->Lang(''username'')}:&nbsp;{$userinfo.username}</p>\n<p>{$feu->Lang(''email'')}:&nbsp;<a href="mailto:{$email_address}">{$email_address}</p>\n<p>{$feu->Lang(''expires'')}:&nbsp;{$userinfo.expires}</p>\n{foreach from=$user_properties item=''entry''}\n{if $entry.type != 0}\n<p>{$entry.prompt}:&nbsp;{$entry.data}</p>\n{/if}\n{/foreach}\n', '2014-07-29 14:40:48', '2014-07-30 13:30:05'),
('FrontEndUsers', 'feusers_resetsession', '{* reset session template *}\n{* NOTE: this template requires jquery be available in any page that it is used on *}\n\n<p><a href="javascript:;" name="feu_manual_reset">Click Here To Confirm Login Status</a></p>{* safe to remove this *}\n\n{* style information for the modal window and the mask... these can be removed and placed in a CMSMS stylesheet *}\n{literal}\n<style type="text/css">\n#feu_modal {\n  background-color: #fff;\n  border: 1px solid #00f;\n  padding: 2px;\n  margin:  2px;\n}\n#feu_mask {\n  background-color: #000;\n}\n#feu_modal .title {\n  background-color: #00f;\n  color:  #fff;\n  padding: 0px;\n}\n</style>\n{/literal}\n\n{capture assign=''feu_theform''}{strip}\n{* the reset-session form, a simple form to display a message with a title to the user with two options... okay, and cancel... the name of these buttons is important, as well the strip tag is important *}\n<form action="javascript:;">\n<p class="title">{$mod->Lang(''title_reset_session'')}</p>\n<p class="row">{$mod->Lang(''msg_reset_session'')}</p>\n<p class="row">\n  <input type="submit" name="feu_ok" value="{$mod->Lang(''ok'')}"/>\n  <input type="submit" name="feu_cancel" value="{$mod->Lang(''cancel'')}"/>\n</p>\n</form>\n{/strip}{/capture}\n\n{literal}\n<script type="text/javascript">\n//<![CDATA[\n// the timer interval (how often you want to display the dialog to your users\nvar timer_interval = {/literal}{$session_timeout}{literal} - 30;\n\n// a function to hide the modal dialog -- you can modify this function\nfunction feu_close_modal()\n{\n   jQuery(''#feu_modal'').fadeOut(2000);\n   jQuery(''#feu_mask'').fadeOut(1000);\n}\n\n// a function to display the modal dialog... you can modify this function\nfunction feu_open_modal()\n{\n  var maskHeight = jQuery(document).height();\n  var maskWidth = jQuery(document).width();\n\n  // set the mask size to fill up the whole screen\n  jQuery(''#feu_mask'').css({''width'':maskWidth,''height'':maskHeight});\n\n  // transition effect\n  jQuery(''#feu_mask'').fadeIn(1000);\n  jQuery(''#feu_mask'').fadeTo("slow",0.8);\n\n  // get the top left corner of the popup\n  var winHeight = jQuery(window).height();\n  var winWidth = jQuery(window).width();\n\n  var popupHeight = jQuery(''#feu_modal'').height();\n  var popupWidth  = jQuery(''#feu_modal'').width();\n\n  var top = winHeight/2 - popupHeight/2;\n  var left = winWidth/2 - popupWidth/2;\n  // set the popup window to center\n  jQuery(''#feu_modal'').css({''top'':top,''left'':left});\n\n  // transition effect\n  jQuery(''#feu_modal'').fadeIn(2000);\n}\n\nfunction feu_user_cancelled()\n{\n  // a callback function that may be customized to allow displaying a message to the user\n  // to indicate that they may be logged out at any time.\n  alert(''You have chosen to disregard the session warning, you may continue to browse this site however some functionality may be unavailable to you until you login again'');\n}\n\n// *\n// * do not modify below here unless you are an experienced jquery programmer *\n// *\n\nif( timer_interval <= 0 )\n  {\n     timer_interval = 0;\n  }\nvar dialogcontents = ''{/literal}{$feu_theform}{literal}'';\n\n\n// we have jQuery\njQuery(document).ready(function(){\n  // create a new id for our stuff\n  jQuery(''body'').append(''<div id="feu_body"></div>'');\n  \n  // create the mask and append it to the dom\n  jQuery(''#feu_body'').append(''<div id="feu_mask"></div>'');\n\n  // create the modal dialog and append it to the DOM\n  jQuery(''#feu_body'').append(''<div id="feu_modal">''+dialogcontents+''</div>'');\n  \n  // and a junk div\n  jQuery(''#feu_body'').append(''<div id="feu_junk" style="display: none;"></div>'');\n\n  // handle click events\n  jQuery(''#feu_modal input[name=feu_ok]'').click(function(e){\n    e.preventDefault();\n\n    // do the ajax request\n    var url = ''{/literal}{$reset_url}{literal}'';\n    var url = url.replace(/amp;/g,'''');\n    jQuery(''#feu_junk'').load(url);\n\n    // and done.\n    feu_close_modal();\n   });\n  jQuery(''#feu_modal input[name=feu_cancel]'').click(function(e){\n    e.preventDefault();\n    feu_close_modal();\n    feu_user_cancelled();\n  });\n  jQuery(''a[name=feu_manual_reset]'').click(function(e){\n    e.preventDefault();\n    feu_open_modal();\n  });\n\n  // create our timer\n  if( timer_interval > 0 )\n     {\n        setTimeout(feu_open_modal,timer_interval * 1000);\n     }\n\n});\n//]]>\n</script>\n{/literal}\n\n{* required css *}\n{literal}\n<style type="text/css">\n#feu_modal {\n  position: absolute;\n  z-index: 9999;\n  display: none;\n}\n#feu_mask {\n  top: 0;\n  left: 0;\n  position: absolute;\n  z-index: 9000;\n  display: none;\n}\n</style>\n{/literal}', '2014-07-29 14:40:48', '2014-07-30 13:30:05');
INSERT INTO `cms_module_templates` (`module_name`, `template_name`, `content`, `create_date`, `modified_date`) VALUES
('Cataloger', 'catalog_1', '<h1>{$title}</h1>\r{section name=numimg loop=$image_url_array}<img src="{$image_url_array[numimg]}" alt="{$title}" title="{$title}" />{/section}\r{$notes}\r<div class="category_items">\r   {if $hasnav == 1}\r<div class="catnav">{$prev}{$navstr}{$next}</div>\r	{/if}\r    {section name=numloop loop=$items}\r        <div class="category_item"><a href="{$items[numloop].link}"><img src="{$items[numloop].image}" title="{$items[numloop].title}" alt="{$items[numloop].title}"/></a><br /><a href="{$items[numloop].link}">{$items[numloop].title}</a></div>\r    {/section}\r    {if $hasnav == 1}\r{* \rThe number that is without a link (a href) have a <span class="nolink" ) have a look in source code-html\r*}\r<div class="catnav">{$prev}{$navstr}{$next}</div>\r	{/if}\r</div>\r', '2014-12-10 13:08:57', '2014-12-10 13:08:57'),
('Cataloger', 'catalog_2', '{assign var="cols" value="3"}<h1>{$title}</h1>\r{section name=numimg loop=$image_url_array}<img src="{$image_url_array[numimg]}" title="{$title}" alt="{$title}" />{/section}\r{$notes}\r<table style="border: solid 1px black;">\r<tr>\r    {section name=numloop loop=$items}\r        <td style="width: 200px;"><a href="{$items[numloop].link}"><img src="{$items[numloop].image}" title="{$items[numloop].title}" alt="{$items[numloop].title}"/></a><br /><a href="{$items[numloop].link}">{$items[numloop].title}</a></td>\r        {if not ($smarty.section.numloop.rownum mod $cols)}\r                {if not $smarty.section.numloop.last}\r                        </tr><tr>\r                {/if}\r        {/if}\r        {if $smarty.section.numloop.last}\r                {math equation = "n - a % n" n=$cols a=$items|@count assign="cells"}\r                {if $cells ne $cols}\r                {section name=pad loop=$cells}\r                        <td style="width: 200px;">&nbsp;</td>\r                {/section}\r                {/if}\r                </tr>\r        {/if}\r    {/section}\n    {if $hasnav == 1}\r<tr><td{if $cols gt 1} colspan="{$cols}"{/if} style="border-top: solid 1px black;">{$prev}{$navstr}{$next}</td></tr>\n	{/if}\r</table>\r', '2014-12-10 13:08:57', '2014-12-10 13:08:57'),
('Cataloger', 'catalog_3', '<div class="item_comparison">\r<table>\r	<tr>\r		<th></th>\r		{section name=at loop=$attrlist}\r			<th>{$attrlist[at]->attr}</th>\r		{/section}\r	</tr>\r	{foreach from=$items item=ti}\r		<tr>\r			<td>\r				<a href="{$ti.link}">\r				<img src="{$image_root}?i={$ti.alias}_t_1_50_1.jpg" /></a><br />\r				{$ti.title}\r			</td>\r			{section name=at loop=$attrlist}\r				<td>\r					{assign var=attrkey value=`$attrlist[at]->safe`}{$ti[$attrkey]}\r				</td>\r			{/section}\r		</tr>\r	{/foreach}\r</table>\r</div>\r', '2014-12-10 13:08:57', '2014-12-10 13:08:57'),
('Cataloger', 'catalog_4', '<div class="feature_items">\r    {section name=numloop loop=$items}\r        <div class="feature_item"><a href="{$items[numloop].link}"><img src="{$items[numloop].image}" title="{$items[numloop].title}" alt="{$items[numloop].title}"/></a><br /><a href="{$items[numloop].link}">{$items[numloop].title}</a></div>\r    {/section}\r</div>\r', '2014-12-10 13:08:57', '2014-12-10 13:08:57'),
('Cataloger', 'catalog_5', '{assign var="cols" value="1"}\r<table style="border: solid 1px black;">\r<tr>\r    {section name=numloop loop=$items}\r        <td style="width: 200px;"><a href="{$items[numloop].link}"><img src="{$items[numloop].image}" title="{$items[numloop].title}" alt="{$items[numloop].title}"/></a><br /><a href="{$items[numloop].link}">{$items[numloop].title}</a></td>\r        {if not ($smarty.section.numloop.rownum mod $cols)}\r                {if not $smarty.section.numloop.last}\r                        </tr><tr>\r                {/if}\r        {/if}\r        {if $smarty.section.numloop.last}\r                {math equation = "n - a % n" n=$cols a=$items|@count assign="cells"}\r                {if $cells ne $cols}\r                {section name=pad loop=$cells}\r                        <td style="width: 200px;">&nbsp;</td>\r                {/section}\r                {/if}\r                </tr>\r        {/if}\r    {/section}\n</table>\r', '2014-12-10 13:08:57', '2014-12-10 13:08:57'),
('Products', 'byhierarchy_inner1', '<ul>\n{foreach from=$hierdata key=''key2'' item=''item2''}\n	<li {if (isset($active_hierarchy) and $item2.id == $active_hierarchy) || $item2.id|in_array:$hierarchy_tree}class="selected"{assign var="parent2" value=$item2.id}{assign var="parent2_extra" value=$item2.extra1.$kalba}{/if}>\n		<a href="{$item2.url}">{$item2.name.$kalba}</a>\n	</li>\n{/foreach}\n</ul>\n', '2014-08-04 14:54:41', '2014-11-20 16:02:18'),
('Cataloger', 'catalog_6', '<div class="catalog_item">\r<p>{$title}</p>\r<div class="item_images"><img id="item_image" name="item_image"  src="{$image_1_url}" alt="{$title}" title="{$title}" />\r<div class="item_thumbnails">{section name=ind loop=$image_url_array}\r<a href="javascript:repl(''{$image_url_array[ind]}'')"><img src="{$image_thumb_url_array[ind]}" title="{$title}" alt="{$title}" /></a>\r{/section}</div></div>\r{section name=at loop=$attrlist}\r<div class="item_attribute_name">{$attrlist[at].name}:</div><div class="item_attribute_val">{eval var=$attrlist[at].key}</div>\r{/section}\r{literal}\r<script type="text/javascript">\rfunction repl(img)\r   {\r   document.item_image.src=img;\r   }\r</script>\r{/literal}\r{if $file_count > 0}\r<ul class="files">{section name=ind loop=$file_name_array}\r<li><a href="{$file_url_array[ind]}">{$file_name_array[ind]}</a></li>\r{/section}\r</ul>\r{/if}\r\r</div>\r', '2014-12-10 13:08:57', '2014-12-10 13:08:57'),
('Products', 'byhierarchy_side_menu', '{if $hierarchy_item.image != ''''}\n	<div class="side_menu_photo">{* filter_croptofit=''278,201,c,1'' *}\n		<a href="{if $back_link!=''''}{$back_link}{else}{$hierarchy_item.url}{/if}">\n			{CGSmartImage src="`$hierarchy_image_location`/`$hierarchy_item.image`" filter_resize=''w,278'' max_height=''201'' quality=100}\n		</a>\n	</div>\n{/if}\n\n{if $active_hierarchy == $parent2 && $parent2_extra == 1}\n	{assign var="dont_show_shi" value="1"}\n	{assign var="inner_parent" value=$parent2}\n{else}\n	{assign var="dont_show_shi" value="0"}\n{/if}\n\n{if !$dont_show_shi}\n	<ul class="side_menu">\n		{foreach from=$hierdata key=''key'' item=''item2''}\n			<li {if (isset($active_hierarchy) and $item2.id == $active_hierarchy) || $item2.id|in_array:$hierarchy_tree}class="selected"{/if}>\n				<a href="{$item2.url}">{$item2.name.$kalba}</a>\n				{if (isset($active_hierarchy) and $item2.id == $active_hierarchy) && is_array($item2.children) && $item2.children|@count > 0}\n					{assign var="inner_parent" value=$item2.id}\n				{/if}\n			</li>\n		{/foreach}\n	</ul>\n{/if}', '2014-08-05 17:04:26', '2014-11-20 16:07:00'),
('Products', 'byhierarchy_other_cats', '\n<div class="products_carusel_container">\n	{if $hierdata|@count > 7}\n		<a href="#" class="products_carusel_back"><span></span></a>\n		<a href="#" class="products_carusel_next"><span></span></a>\n	{/if}\n	<div class="cycle-slideshow products_carusel" \n		data-cycle-fx="carousel" \n		data-cycle-timeout="200000"\n		data-cycle-slides="> div"\n		data-cycle-pause-on-hover="true"\n		data-cycle-log="false"\n		data-cycle-prev=".products_carusel_next"\n		data-cycle-next=".products_carusel_back"\n		data-cycle-carousel-visible="{if $hierdata|@count<8}{$hierdata|@count}{else}8{/if}"\n		>\n		{foreach from=$hierdata key=''key'' item=''item2''}\n			<div>\n				<a href="{$item2.url}" style="{if $item2.image != ''''}background-image:url({CGSmartImage src="`$hierarchy_image_location`/`$item2.image`" filter_croptofit=''80,80,c,1'' quality=100 notag=1}){/if}">\n					<span>{$item2.name.$kalba}</span>\n				</a>\n			</div>\n		{/foreach}\n	</div>\n</div>', '2014-08-05 17:12:42', '2014-11-12 19:42:04'),
('Products', 'summary_main', '{Products action="hierarchy" hierarchytemplate="other_cats" parent=$parent}\n{if $show_hier_page}\n	<h1>{$hier_page_info.name.$kalba}</h1>\n	<div>\n		{$hier_page_info.description.$kalba}\n	</div>\n{elseif $inner_parent > 0}\n	{Products action="hierarchy" hierarchytemplate="high_level" parent=$inner_parent}\n{else}\n	{assign var="show_76" value=0}\n	{capture assign="the_list"}\n		{foreach from=$items item=entry}\n			\n			<div class="is_item \n				{if $entry->fields.technical_detail->value_full|is_array && $entry->fields.technical_detail->value_full|count > 0}\n					{foreach from=$entry->fields.technical_detail->value_full item=''class_i''}\n						{$class_i.$kalba|replace:'' '':''''} \n					{/foreach}\n					{assign var="show_76" value=1}\n				{/if}\n				"\n				>\n				<a href="{$entry->detail_url}">\n					\n					{if $entry->fields.nuotrauka1->value|is_array && $entry->fields.nuotrauka1->value|@count > 0}\n						<span class="photo" style="background-image:url({CGSmartImage src="`$entry->fields.nuotrauka1->value[0]`" filter_resizetofit=''464,147,#ffffff'' quality=100 notag="1"})"></span>\n					{/if}\n					<span class="title"><span>{$entry->fields.pavadinimas->value.$kalba}</span></span>\n				</a>\n			</div>\n		{/foreach}\n	{/capture}\n\n	{if $show_76}\n		{Products action="get_field" fieldid=76}\n	{/if}\n	<div class="product_blocks isotope">\n		{$the_list}\n	</div>\n	<br/>\n	<br/>\n	{if isset($pagecount) && $pagecount gt 1}\n		<div class="pagination_container">\n			<ul class="pagination">\n				{foreach from=$pages_array item="itm"}\n					<li class="{$itm.class}">\n						{$itm.link}\n					</li>\n				{/foreach}\n			</ul>\n		</div>\n	{/if}\n{/if}', '2014-08-06 12:13:32', '2014-11-20 16:06:59'),
('Products', 'detail_main', '{capture assign="whole_page"}\n	<div class="product_card">\n		{if $entry->fields.nuotrauka1->value|is_array && $entry->fields.nuotrauka1->value|@count > 0}\n			<div class="product_left_coll">\n				<div class="custom_product_slider_container">\n					<a href="#" class="custom_product_slider_back"><span></span></a>\n					<a href="#" class="custom_product_slider_next"><span></span></a>\n					<div class="cycle-slideshow custom_product_slider" \n						data-cycle-fx="scrollHorz" \n						data-cycle-timeout="2000"\n						data-cycle-slides="> div"\n						data-cycle-pager=".index_slider_pagination > span"\n						data-cycle-pause-on-hover="true"\n						data-cycle-log="false"\n						data-cycle-prev=".custom_product_slider_back"\n						data-cycle-next=".custom_product_slider_next"\n						>\n						{foreach from=$entry->fields.nuotrauka1->value item="image"} {* filter_croptofit=''420,303,c,1'' *}\n							<div style="background-image: url({CGSmartImage src="`$image`" filter_resize=''w,420'' max_height=''303'' quality=100 notag="1"})">\n								<a href="{if $image}{$image}{else}javascript:void(0);{/if}" class="fancy"></a>\n							</div>\n						{/foreach}\n					</div>\n					<div class="custom_product_slider_pagination">\n						<span></span>\n					</div>\n				</div>\n			</div>\n		{/if}\n		<div class="product_right_coll">\n			<h1>{$entry->fields.pavadinimas->value.$kalba}</h1>\n			<div class="cco">\n				{$entry->fields.aprasymas->value.$kalba}\n				{*\n				\n				!!!!!! DARIAU, jei tau lieps padaryti, kad rodytu tik tuos fieldus, kurie priskirti prie produkto hierarchijos, prasuk cikla per $entry->fields ir isvesk tik tuos kuriu id yra masyve $entry->filter_fields !!!!!!\n				<pre>\n				{$entry->filter_fields|@print_r}\n				</pre>\n				*}\n			</div>\n			<br>\n			{if $entry->fields.technical_detail->value_full|is_array && $entry->fields.technical_detail->value_full|@count > 0}\n				<ul class="labels">\n					{foreach from=$entry->fields.technical_detail->value_full item="icon"}\n						<li>\n							<a href="{if $url_path}{$url_path}#{$icon.$kalba|replace:'' '':''''}{else}javascript:void(0);{/if}" title="{$icon.$kalba}"><img src="{$entry->field_file_location}/{$icon.file}" alt=""></a>\n						</li>\n					{/foreach}\n				</ul> \n			{/if}\n		</div>\n	</div>\n	<br>\n	{if $entry->fields.technical->value[$kalba][''v'']|@count > 1}\n		<div class="product_descriptions">\n			{foreach from=$entry->fields.technical->value[$kalba][''v''] key="dat_key" item="dat"}\n				{if $dat_key !== ''nm''}\n					<div>\n						<h2>{$dat}</h2>\n						<div class="cont">\n							<div>\n								{$entry->fields.technical->value[$kalba][''t''][$dat_key]}\n							</div>\n						</div>\n					</div>\n				{/if}\n			{/foreach}\n		</div>\n	{/if}\n	\n	<br>\n	<br>\n	<div class="contact_card">\n		<div class="contact_card_left_coll">\n			<h2 class="f_14 uppercase">{#susisiekite#}</h2>\n			{TxForm form=4}\n		</div>\n		<div class="contact_card_right_coll">\n			<div>\n				{global_content name="uzklausa_`$kalba`"}\n			</div>\n		</div>\n	</div> \n{/capture}\n{Products summarytemplate="top_inside" hierarchyid=$entry->hierarchy_id session_filter=1 exclude_prod=$entry->id}\n{$whole_page}\n', '2014-08-12 14:06:18', '2014-11-12 19:43:06'),
('Products', 'byhierarchy_high_level', '{*\n<div class="is_item \n	\n	\n	<ul class="side_menu">\n		{foreach from=$hierdata key=''key'' item=''item2''}\n			<li {if (isset($active_hierarchy) and $item2.id == $active_hierarchy) || $item2.id|in_array:$hierarchy_tree}class="selected"{/if}>\n				<a href="{$item2.url}">{$item2.name.$kalba}</a>\n				{if ((isset($active_hierarchy) and $item2.id == $active_hierarchy) || $item2.id|in_array:$hierarchy_tree) && is_array($item2.children) && $item2.children|@count > 0}\n					{assign var="inner_parent" value=$item2.id}\n				{/if}\n			</li>\n		{/foreach}\n	</ul>\n	\n	\n</div>*}\n<div class="product_blocks">\n	{foreach from=$hierdata key=''key'' item=''item2''}\n		<div class="is_item">\n			<a href="{$item2.url}">\n				{if $item2.image != ''''}\n					<span class="photo" style="background-image:url({CGSmartImage src="`$hierarchy_image_location`/`$item2.image`" filter_resizetofit=''464,147,#ffffff'' quality=100 notag="1"})"></span>\n				{/if}\n				<span class="title"><span>{$item2.name.$kalba}</span></span>\n			</a>\n		</div>\n	{/foreach}\n</div>', '2014-11-12 11:54:37', '2014-11-12 13:44:33'),
('Products', 'summary_top_inside', '{if $items|is_array && $items|@count > 0}\n	<div class="products_carusel_container">\n		{if $items|@count > 7}\n			<a href="#" class="products_carusel_back"><span></span></a>\n			<a href="#" class="products_carusel_next"><span></span></a>\n		{/if}\n		<div class="cycle-slideshow products_carusel" \n			data-cycle-fx="carousel" \n			data-cycle-timeout="200000"\n			data-cycle-slides="> div"\n			data-cycle-pause-on-hover="true"\n			data-cycle-log="false"\n			data-cycle-prev=".products_carusel_next"\n			data-cycle-next=".products_carusel_back"\n			data-cycle-carousel-visible="8"\n			>\n			{foreach from=$items item=entry}\n				<div>\n					{if $entry->fields.nuotrauka1->value|is_array && $entry->fields.nuotrauka1->value|@count > 0}{* filter_croptofit=''80,80,c,1'' *}\n						<a href="{$entry->detail_url}" style="background-image:url({CGSmartImage src="`$entry->fields.nuotrauka1->value[0]`" filter_resize=''w,80'' max_height=''80'' quality=100 notag="1"})">\n							<span>{$entry->fields.pavadinimas->value.$kalba}</span>\n						</a>\n					{else}\n						<a href="#">\n							<span>{$entry->fields.pavadinimas->value.$kalba}</span>\n						</a>\n					{/if}\n				</div>\n			{/foreach}\n		</div>\n	</div>\n{/if}', '2014-08-14 12:31:53', '2014-11-12 19:43:47');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_permissions`
--

CREATE TABLE IF NOT EXISTS `cms_permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(255) DEFAULT NULL,
  `permission_text` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_permissions`
--

INSERT INTO `cms_permissions` (`permission_id`, `permission_name`, `permission_text`, `create_date`, `modified_date`) VALUES
(1, 'Add Pages', 'Add Pages', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(2, 'Add Groups', 'Add Groups', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(4, 'Add Templates', 'Add Templates', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(5, 'Add Users', 'Add Users', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(6, 'Modify Any Page', 'Modify Any Page', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(7, 'Modify Groups', 'Modify Groups', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(8, 'Modify Group Assignments', 'Modify Group Assignments', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(9, 'Modify Permissions', 'Modify Permissions for Groups', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(11, 'Modify Templates', 'Modify Templates', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(12, 'Modify Users', 'Modify Users', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(13, 'Remove Pages', 'Remove Pages', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(14, 'Remove Groups', 'Remove Groups', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(16, 'Remove Templates', 'Remove Templates', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(17, 'Remove Users', 'Remove Users', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(18, 'Modify Modules', 'Modify Modules', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(20, 'Modify Files', 'Modify Files', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(21, 'Modify Site Preferences', 'Modify Site Preferences', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(22, 'Modify Stylesheets', 'Modify Stylesheets', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(23, 'Add Stylesheets', 'Add Stylesheets', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(24, 'Remove Stylesheets', 'Remove Stylesheets', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(25, 'Add Stylesheet Assoc', 'Add Stylesheet Associations', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(26, 'Modify Stylesheet Assoc', 'Modify Stylesheet Associations', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(27, 'Remove Stylesheet Assoc', 'Remove Stylesheet Associations', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(28, 'Modify User-defined Tags', 'Modify User defined Tags', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(29, 'Clear Admin Log', 'Clear Admin Log', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(30, 'Add Global Content Blocks', 'Add Global Content Blocks', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(31, 'Modify Global Content Blocks', 'Modify Global Content Blocks', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(32, 'Remove Global Content Blocks', 'Remove Global Content Blocks', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(35, 'Modify Events', 'Modify Events', '2006-01-27 20:06:58', '2006-01-27 20:06:58'),
(36, 'View Tag Help', 'View Tag Help', '2006-01-27 20:06:58', '2006-01-27 20:06:58'),
(44, 'Manage All Content', 'Manage All Content', '2009-05-06 15:04:11', '2009-05-06 15:04:11'),
(46, 'Reorder Content', 'Reorder Content', '2009-05-06 15:04:11', '2009-05-06 15:04:11'),
(47, 'Use FileManager Advanced', 'Sudėtingesnis naudojimasis Bylų valdymo moduliu', '2013-02-11 09:15:24', '2013-02-11 09:15:24'),
(48, 'Manage Menu', 'Manage Menu', '2013-02-11 09:15:25', '2013-02-11 09:15:25'),
(59, 'MicroTiny View HTML Source', 'MicroTiny View HTML Source', '2013-02-19 12:33:23', '2013-02-19 12:33:23'),
(50, 'Modify News', 'Modify News', '2013-02-11 09:15:25', '2013-02-11 09:15:25'),
(51, 'Approve News', 'Approve News For Frontend Display', '2013-02-11 09:15:25', '2013-02-11 09:15:25'),
(52, 'Delete News', 'Delete News Articles', '2013-02-11 09:15:25', '2013-02-11 09:15:25'),
(53, 'Manage Themes', 'Manage Themes', '2013-02-11 09:15:26', '2013-02-11 09:15:26'),
(54, 'Template Externalizer', 'Template Externalizer', '2013-02-11 11:26:34', '2013-02-11 11:26:34'),
(60, 'Titulinis Use', 'Titulinis Use', '2013-02-19 13:59:11', '2013-02-19 13:59:11'),
(61, 'Titulinis Edit', 'Titulinis Edit', '2013-02-19 13:59:11', '2013-02-19 13:59:11'),
(62, 'Titulinis More', 'Titulinis More', '2013-02-19 13:59:11', '2013-02-19 13:59:11'),
(63, 'Titulinis Add', 'Titulinis Add', '2013-02-19 13:59:11', '2013-02-19 13:59:11'),
(64, 'Titulinis Special', 'Titulinis Special', '2013-02-19 13:59:11', '2013-02-19 13:59:11'),
(65, 'Titulinis Delete', 'Titulinis Delete', '2013-02-19 13:59:11', '2013-02-19 13:59:11'),
(73, 'allowadvancedprofile', 'Allow usage of advanced profile in TinyMCE', '2013-02-21 15:25:38', '2013-02-21 15:25:38'),
(75, 'Manage AComments', 'Manage AComments', '2013-02-28 15:56:53', '2013-02-28 15:56:53'),
(76, 'TxForm Use', 'TxForm Use', '2013-03-29 10:42:20', '2013-03-29 10:42:20'),
(77, 'TxForm Edit', 'TxForm Edit', '2013-03-29 10:42:20', '2013-03-29 10:42:20'),
(78, 'TxForm More', 'TxForm More', '2013-03-29 10:42:20', '2013-03-29 10:42:20'),
(79, 'TxForm Add', 'TxForm Add', '2013-03-29 10:42:20', '2013-03-29 10:42:20'),
(80, 'TxForm Special', 'TxForm Special', '2013-03-29 10:42:20', '2013-03-29 10:42:20'),
(81, 'TxForm Delete', 'TxForm Delete', '2013-03-29 10:42:20', '2013-03-29 10:42:20'),
(82, 'Use Gallery', 'Use Gallery', '2013-04-16 14:58:49', '2013-04-16 14:58:49'),
(83, 'Gallery - Add subgalleries', 'Gallery - Add subgalleries', '2013-04-16 14:58:49', '2013-04-16 14:58:49'),
(84, 'Gallery - Edit all galleries', 'Gallery - Edit all galleries', '2013-04-16 14:58:49', '2013-04-16 14:58:49'),
(94, 'Manage AdvancedContent Preferences', 'Manage AdvancedContent Preferences', '2014-03-30 18:41:47', '2014-03-30 18:41:47'),
(95, 'Manage All AdvancedContent Blocks', 'Manage All AdvancedContent Blocks', '2014-03-30 18:41:47', '2014-03-30 18:41:47'),
(96, 'Manage AdvancedContent Options', 'Manage AdvancedContent Options', '2014-03-30 18:41:47', '2014-03-30 18:41:47'),
(97, 'Manage AdvancedContent MultiInputs', 'Manage AdvancedContent MultiInputs', '2014-03-30 18:41:47', '2014-03-30 18:41:47'),
(98, 'Manage AdvancedContent MultiInput Templates', 'Manage AdvancedContent MultiInput Templates', '2014-03-30 18:41:47', '2014-03-30 18:41:47'),
(99, 'Use Extended Content Blocks', 'Use Extended Content Blocks', '2014-03-30 18:56:00', '2014-03-30 18:56:00'),
(100, 'Manage GBFilePicker', 'Manage GBFilePicker', '2014-03-30 19:03:03', '2014-03-30 19:03:03'),
(101, 'Use GBFilePicker', 'Use GBFilePicker', '2014-03-30 19:03:03', '2014-03-30 19:03:03'),
(115, 'Modify Products', 'Modify Products', '2014-07-30 08:32:25', '2014-07-30 08:32:25'),
(114, 'Modify FrontEndUserProps', 'Modify FrontEndUser Properties', '2014-07-29 14:40:48', '2014-07-29 14:40:48'),
(116, 'Use Filelists', 'Use Filelists', '2014-10-14 13:21:03', '2014-10-14 13:21:03'),
(117, 'Set Filelists Prefs', 'Set Filelists Prefs', '2014-10-14 13:21:03', '2014-10-14 13:21:03'),
(118, 'Use Languages', 'Use Languages', '2014-11-24 14:18:15', '2014-11-24 14:18:15'),
(119, 'Set Languages Prefs', 'Set Languages Prefs', '2014-11-24 14:18:15', '2014-11-24 14:18:15'),
(120, 'Modify Catalog Settings', 'Modify Catalog Settings', '2014-12-10 13:08:57', '2014-12-10 13:08:57');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_permissions_seq`
--

CREATE TABLE IF NOT EXISTS `cms_permissions_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_permissions_seq`
--

INSERT INTO `cms_permissions_seq` (`id`) VALUES
(120);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_prod_uzklausa`
--

CREATE TABLE IF NOT EXISTS `cms_prod_uzklausa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `ID` (`id`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `id_3` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Sukurta duomenų kopija lentelei `cms_prod_uzklausa`
--

INSERT INTO `cms_prod_uzklausa` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_routes`
--

CREATE TABLE IF NOT EXISTS `cms_routes` (
  `term` varchar(255) NOT NULL,
  `key1` varchar(50) NOT NULL,
  `key2` varchar(50) DEFAULT NULL,
  `key3` varchar(50) DEFAULT NULL,
  `data` text,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`term`,`key1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_routes`
--

INSERT INTO `cms_routes` (`term`, `key1`, `key2`, `key3`, `data`, `created`) VALUES
('/[nN]ews\\/(?P<articleid>[0-9]+)\\/(?P<returnid>[0-9]+)\\/(?P<junk>.*?)\\/d,(?P<detailtemplate>.*?)$/', 'News', NULL, NULL, 'O:8:"CmsRoute":2:{s:15:"\0CmsRoute\0_data";a:4:{s:4:"term";s:97:"/[nN]ews\\/(?P<articleid>[0-9]+)\\/(?P<returnid>[0-9]+)\\/(?P<junk>.*?)\\/d,(?P<detailtemplate>.*?)$/";s:8:"absolute";b:0;s:4:"key1";s:4:"News";s:4:"key2";N;}s:18:"\0CmsRoute\0_results";N;}', '2014-11-29 11:25:52'),
('/[nN]ews\\/(?P<articleid>[0-9]+)\\/(?P<returnid>[0-9]+)\\/(?P<junk>.*?)$/', 'News', NULL, NULL, 'O:8:"CmsRoute":2:{s:15:"\0CmsRoute\0_data";a:4:{s:4:"term";s:70:"/[nN]ews\\/(?P<articleid>[0-9]+)\\/(?P<returnid>[0-9]+)\\/(?P<junk>.*?)$/";s:8:"absolute";b:0;s:4:"key1";s:4:"News";s:4:"key2";N;}s:18:"\0CmsRoute\0_results";N;}', '2014-11-29 11:25:52'),
('/[nN]ews\\/(?P<articleid>[0-9]+)\\/(?P<returnid>[0-9]+)$/', 'News', NULL, NULL, 'O:8:"CmsRoute":2:{s:15:"\0CmsRoute\0_data";a:4:{s:4:"term";s:55:"/[nN]ews\\/(?P<articleid>[0-9]+)\\/(?P<returnid>[0-9]+)$/";s:8:"absolute";b:0;s:4:"key1";s:4:"News";s:4:"key2";N;}s:18:"\0CmsRoute\0_results";N;}', '2014-11-29 11:25:52'),
('/[nN]ews\\/(?P<articleid>[0-9]+)$/', 'News', NULL, NULL, 'O:8:"CmsRoute":2:{s:15:"\0CmsRoute\0_data";a:4:{s:4:"term";s:33:"/[nN]ews\\/(?P<articleid>[0-9]+)$/";s:8:"absolute";b:0;s:4:"key1";s:4:"News";s:4:"key2";N;}s:18:"\0CmsRoute\0_results";N;}', '2014-11-29 11:25:52');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_siteprefs`
--

CREATE TABLE IF NOT EXISTS `cms_siteprefs` (
  `sitepref_name` varchar(255) NOT NULL,
  `sitepref_value` text,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sitepref_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_siteprefs`
--

INSERT INTO `cms_siteprefs` (`sitepref_name`, `sitepref_value`, `create_date`, `modified_date`) VALUES
('enablesitedownmessage', '0', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
('sitedownmessage', '<p>Site is currently down for maintenance.</p>', '2006-07-25 21:22:33', '2014-07-30 13:30:05'),
('sitedownmessagetemplate', '-1', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
('useadvancedcss', '1', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
('metadata', '', '2006-07-25 21:22:33', '2013-11-23 19:59:54'),
('xmlmodulerepository', '', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
('logintheme', 'OneEleven', '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
('global_umask', '022', NULL, NULL),
('frontendlang', 'lt_LT', NULL, NULL),
('frontendwysiwyg', '-1', NULL, NULL),
('nogcbwysiwyg', '0', NULL, NULL),
('urlcheckversion', '', NULL, NULL),
('defaultdateformat', '', NULL, NULL),
('css_max_age', '0', NULL, NULL),
('backendwysiwyg', '-1', NULL, NULL),
('disablesafemodewarning', '0', NULL, NULL),
('allowparamcheckwarnings', '0', NULL, NULL),
('enablenotifications', '1', NULL, NULL),
('page_active', '1', NULL, NULL),
('page_showinmenu', '1', NULL, NULL),
('page_cachable', '1', NULL, NULL),
('page_metadata', '{* Add code here that should appear in the metadata section of all new pages *}', NULL, '2014-07-30 13:30:05'),
('defaultpagecontent', '<!-- Add code here that should appear in the content block of all new pages -->', NULL, '2014-07-30 13:30:05'),
('default_parent_page', '-1', NULL, NULL),
('additional_editors', '', NULL, NULL),
('page_searchable', '1', NULL, NULL),
('page_extra1', '', NULL, NULL),
('page_extra2', '', NULL, NULL),
('page_extra3', '', NULL, NULL),
('sitedownexcludes', '', NULL, NULL),
('clear_vc_cache', '0', NULL, NULL),
('sitename', 'T', NULL, NULL),
('sitemask', '7N*btu6MYDE8BFRG', NULL, NULL),
('CMSMailer_mapi_pref_username', '', NULL, NULL),
('CMSMailer_mapi_pref_smtpauth', '0', NULL, NULL),
('CMSMailer_mapi_pref_timeout', '1000', NULL, NULL),
('CMSMailer_mapi_pref_sendmail', '/usr/sbin/sendmail', NULL, NULL),
('CMSMailer_mapi_pref_fromuser', 'Texus', NULL, NULL),
('CMSMailer_mapi_pref_from', 'info@texus.lt', NULL, NULL),
('CMSMailer_mapi_pref_port', '25', NULL, NULL),
('CMSMailer_mapi_pref_host', 'localhost', NULL, NULL),
('CMSPrinting_mapi_pref_overridestyle', '/*\nYou can put css stuff here, which will be inserted in the header after calling the cmsms-stylesheets.\nProvided you don''t remove the {$overridestylesheet} in PrintTemplate, of course.\n\nAny suggestions for default content in this stylesheet?\n\nHave fun!\n*/', NULL, NULL),
('FileManager_mapi_pref_iconsize', '32px', NULL, NULL),
('FileManager_mapi_pref_uploadboxes', '5', NULL, NULL),
('FileManager_mapi_pref_showhiddenfiles', '0', NULL, NULL),
('ModuleManager_mapi_pref_module_repository', 'http://www.cmsmadesimple.org/ModuleRepository/request/v2/', NULL, NULL),
('News_mapi_pref_default_summary_template_contents', '<!-- Start News Display Template -->\n{* This section shows a clickable list of your News categories. *}\n<ul class="list1">\n{foreach from=$cats item=node}\n{if $node.depth > $node.prevdepth}\n{repeat string="<ul>" times=$node.depth-$node.prevdepth}\n{elseif $node.depth < $node.prevdepth}\n{repeat string="</li></ul>" times=$node.prevdepth-$node.depth}\n</li>\n{elseif $node.index > 0}</li>\n{/if}\n<li{if $node.index == 0} class="firstnewscat"{/if}>\n{if $node.count > 0}\n	<a href="{$node.url}">{$node.news_category_name}</a>{else}<span>{$node.news_category_name} </span>{/if}\n{/foreach}\n{repeat string="</li></ul>" times=$node.depth-1}</li>\n</ul>\n\n{* this displays the category name if you''re browsing by category *}\n{if $category_name}\n<h1>{$category_name}</h1>\n{/if}\n\n{* if you don''t want category browsing on your summary page, remove this line and everything above it *}\n\n{if $pagecount > 1}\n  <p>\n{if $pagenumber > 1}\n{$firstpage}&nbsp;{$prevpage}&nbsp;\n{/if}\n{$pagetext}&nbsp;{$pagenumber}&nbsp;{$oftext}&nbsp;{$pagecount}\n{if $pagenumber < $pagecount}\n&nbsp;{$nextpage}&nbsp;{$lastpage}\n{/if}\n</p>\n{/if}\n{foreach from=$items item=entry}\n<div class="NewsSummary">\n\n{if $entry->postdate}\n	<div class="NewsSummaryPostdate">\n		{$entry->postdate|cms_date_format}\n	</div>\n{/if}\n\n<div class="NewsSummaryLink">\n<a href="{$entry->moreurl}" title="{$entry->title|cms_escape:htmlall}">{$entry->title|cms_escape}</a>\n</div>\n\n<div class="NewsSummaryCategory">\n	{$category_label} {$entry->category}\n</div>\n\n{if $entry->author}\n	<div class="NewsSummaryAuthor">\n		{$author_label} {$entry->author}\n	</div>\n{/if}\n\n{if $entry->summary}\n	<div class="NewsSummarySummary">\n		{eval var=$entry->summary}\n	</div>\n\n	<div class="NewsSummaryMorelink">\n		[{$entry->morelink}]\n	</div>\n\n{else if $entry->content}\n\n	<div class="NewsSummaryContent">\n		{eval var=$entry->content}\n	</div>\n{/if}\n\n{if isset($entry->extra)}\n    <div class="NewsSummaryExtra">\n        {eval var=$entry->extra}\n	{* {cms_module module=''Uploads'' mode=''simpleurl'' upload_id=$entry->extravalue} *}\n    </div>\n{/if}\n{if isset($entry->fields)}\n  {foreach from=$entry->fields item=''field''}\n     <div class="NewsSummaryField">\n        {if $field->type == ''file''}\n          <img src="{$entry->file_location}/{$field->value}"/>\n        {else}\n          {$field->name}:&nbsp;{eval var=$field->value}\n        {/if}\n     </div>\n  {/foreach}\n{/if}\n\n</div>\n{/foreach}\n<!-- End News Display Template -->\n', NULL, NULL),
('News_mapi_pref_current_summary_template', 'pagrindinis', NULL, NULL),
('News_mapi_pref_default_detail_template_contents', '{* News module entry object reference:\n   ------------------------------\n   In previous versions of News the ''object'' returned in $entry was quite simple, and a <pre>{$entry|@print_r}</pre> would output all of the available data\n   This has changed in News 2.12, the object is not quite as ''simple'' as it was in previous versions, and that method will no longer work.  Hence, below\n   you will find a referennce to the available data.\n\n   ====\n   news_article Object Reference\n   ====\n\n     Members:\n     --\n     Members can be displayed by the following syntax: {$entry->membername} or assigned to another smarty variable using {assign var=''foo'' value=$entry->membername}.\n\n     The following members are available in the entry array:\n   \n     id (integer)           = The unique article id.\n     author_id (integer)    = The userid of the author who created the article.  This value may be negative to indicate an FEU userid.\n     title (string)         = The title of the article.\n     summary (text)         = The summary text (may be empty or unset).\n     extra (string)         = The "extra" data associated with the article (may be empty or unset).\n     news_url (string)      = The url segment associated with this article (may be empty or unset).\n     postdate (string)      = A string representing the news article post date.  You may filter this through cms_date_format for different display possibilities.\n     startdate (string)     = A string representing the date the article should begin to appear.  (may be empty or unset)\n     enddate (string)       = A string representing the date the article should stop appearing on the site (may be empty or unset).\n     category_id (integer)  = The unique id of the hierarchy level where this article resides (may be empty or unset)\n     status (string)        = either ''draft'' or ''published'' indicating the status of this article.\n     author (string)        = The username of the original author of the article.  If the article was created by frontend submission, this will attempt to retrieve the username from the FEU module.\n     authorname (string)    = The full name of the original author of the website. Only applicable if article was created by an administrator and that information exists in the administrators profile.\n     category (string)      = The name of the category that this article is associated with.\n     canonical (string)     = A full URL (prettified) to this articles detail view using defaults if necessary.\n     fields (associative)   = An associative array of field objects, representing the fields, and their values for this article.  See the information below on the field object definition.   In past versions of News this was a simple array, now it is an associative one.\n     customfieldsbyname     = (deprecated) - A synonym for the ''fields'' member\n     fieldsbyname           = (deprecated) - A synonym for the ''fields'' member\n     useexp (integer)       = A flag indicating wether this article is using the expiry information.\n     file_location (string) = A url containing the location where files attached the article are stored... the field value should be appended to this url.\n     \n\n   ====\n   news_field Object Reference\n   ====\n   The news_field object contains data about the fields and their values that are associated with a particular news article.\n\n     Members:\n     --------\n     id (integer)  = The id of the field definition\n     name (string) = The name of the field\n     type (string) = The type of field\n     max_length (integer) = The maximum length of the field (applicable only to text fields)\n     item_order (integer) = The order of the field\n     public (integer) = A flag indicating wether the field is public or not\n     value (mixed)    = The value of the field.\n\n\n   ====\n   Below, you will find the normal detail template information.  Modify this template as desired.\n*}\n\n{* set a canonical variable that can be used in the head section if process_whole_template is false in the config.php *}\n{if isset($entry->canonical)}\n  {assign var=''canonical'' value=$entry->canonical}\n{/if}\n\n{if $entry->postdate}\n	<div id="NewsPostDetailDate">\n		{$entry->postdate|cms_date_format}\n	</div>\n{/if}\n<h3 id="NewsPostDetailTitle">{$entry->title|cms_escape:htmlall}</h3>\n\n<hr id="NewsPostDetailHorizRule" />\n\n{if $entry->summary}\n	<div id="NewsPostDetailSummary">\n		<strong>\n			{eval var=$entry->summary}\n		</strong>\n	</div>\n{/if}\n\n{if $entry->category}\n	<div id="NewsPostDetailCategory">\n		{$category_label} {$entry->category}\n	</div>\n{/if}\n{if $entry->author}\n	<div id="NewsPostDetailAuthor">\n		{$author_label} {$entry->author}\n	</div>\n{/if}\n\n<div id="NewsPostDetailContent">\n	{eval var=$entry->content}\n</div>\n\n{if $entry->extra}\n	<div id="NewsPostDetailExtra">\n		{$extra_label} {$entry->extra}\n	</div>\n{/if}\n\n{if $return_url != ""}\n<div id="NewsPostDetailReturnLink">{$return_url}{if $category_name != ''''} - {$category_link}{/if}</div>\n{/if}\n\n{if isset($entry->fields)}\n  {foreach from=$entry->fields item=''field''}\n     <div class="NewsDetailField">\n        {if $field->type == ''file''}\n	  {* this template assumes that every file uploaded is an image of some sort, because News doesn''t distinguish *}\n          <img src="{$entry->file_location}/{$field->value}"/>\n        {else}\n          {$field->name}:&nbsp;{eval var=$field->value}\n        {/if}\n     </div>\n  {/foreach}\n{/if}\n', NULL, NULL),
('News_mapi_pref_current_detail_template', 'pagrindinis', NULL, NULL),
('News_mapi_pref_default_form_template_contents', '{* original form template *}\n{if isset($error)}\n  <h3><font color="red">{$error}</font></h3>\n{else}\n  {if isset($message)}\n    <h3>{$message}</h3>\n  {/if}\n{/if}\n{$startform}\n	<div class="pageoverflow">\n		<p class="pagetext">*{$titletext}:</p>\n		<p class="pageinput">{$inputtitle}</p>\n	</div>\n	<div class="pageoverflow">\n		<p class="pagetext">{$categorytext}:</p>\n		<p class="pageinput">{$inputcategory}</p>\n	</div>\n{if !isset($hide_summary_field) or $hide_summary_field == 0}\n	<div class="pageoverflow">\n		<p class="pagetext">{$summarytext}:</p>\n		<p class="pageinput">{$inputsummary}</p>\n	</div>\n{/if}\n	<div class="pageoverflow">\n		<p class="pagetext">*{$contenttext}:</p>\n		<p class="pageinput">{$inputcontent}</p>\n	</div>\n	<div class="pageoverflow">\n		<p class="pagetext">{$extratext}:</p>\n		<p class="pageinput">{$inputextra}</p>\n	</div>\n	<div class="pageoverflow">\n		<p class="pagetext">{$startdatetext}:</p>\n		<p class="pageinput">{html_select_date prefix=$startdateprefix time=$startdate end_year="+15"} {html_select_time prefix=$startdateprefix time=$startdate}</p>\n	</div>\n	<div class="pageoverflow">\n		<p class="pagetext">{$enddatetext}:</p>\n		<p class="pageinput">{html_select_date prefix=$enddateprefix time=$enddate end_year="+15"} {html_select_time prefix=$enddateprefix time=$enddate}</p>\n	</div>\n	{if isset($customfields)}\n	   {foreach from=$customfields item=''onefield''}\n	      <div class="pageoverflow">\n		<p class="pagetext">{$onefield->name}:</p>\n		<p class="pageinput">{$onefield->field}</p>\n	      </div>\n	   {/foreach}\n	{/if}\n	<div class="pageoverflow">\n		<p class="pagetext">&nbsp;</p>\n		<p class="pageinput">{$hidden}{$submit}{$cancel}</p>\n	</div>\n{$endform}\n', NULL, NULL),
('News_mapi_pref_current_form_template', 'Sample', NULL, NULL),
('News_mapi_pref_default_browsecat_template_contents', '{if $count > 0}\n<ul class="list1">\n{foreach from=$cats item=node}\n{if $node.depth > $node.prevdepth}\n{repeat string="<ul>" times=$node.depth-$node.prevdepth}\n{elseif $node.depth < $node.prevdepth}\n{repeat string="</li></ul>" times=$node.prevdepth-$node.depth}\n</li>\n{elseif $node.index > 0}</li>\n{/if}\n<li class="newscategory">\n{if $node.count > 0}\n	<a href="{$node.url}">{$node.news_category_name}</a> ({$node.count}){else}<span>{$node.news_category_name} (0)</span>{/if}\n{/foreach}\n{repeat string="</li></ul>" times=$node.depth-1}</li>\n</ul>\n{/if}', NULL, NULL),
('News_mapi_pref_current_browsecat_template', 'Sample', NULL, NULL),
('News_mapi_pref_email_subject', 'Naujas Naujienų straipsnis', NULL, NULL),
('News_mapi_pref_allowed_upload_types', 'gif,png,jpeg,jpg', NULL, NULL),
('News_mapi_pref_auto_create_thumbnails', 'gif,png,jpeg,jpg', NULL, NULL),
('Search_mapi_pref_stopwords', 'i, me, my, myself, we, our, ours, ourselves, you, your, yours, yourself, yourselves, he, him, his, himself, she, her, hers, herself, it, its, itself, they, them, their, theirs, themselves, what, which, who, whom, this, that, these, those, am, is, are, was, were, be, been, being, have, has, had, having, do, does, did, doing, a, an, the, and, but, if, or, because, as, until, while, of, at, by, for, with, about, against, between, into, through, during, before, after, above, below, to, from, up, down, in, out, on, off, over, under, again, further, then, once, here, there, when, where, why, how, all, any, both, each, few, more, most, other, some, such, no, nor, not, only, own, same, so, than, too, very', NULL, NULL),
('Search_mapi_pref_usestemming', 'false', NULL, NULL),
('Search_mapi_pref_searchtext', '', NULL, NULL),
('__NOTIFICATIONS__', 'a:1:{i:0;O:8:"stdClass":4:{s:8:"priority";i:2;s:4:"html";s:62:"There have not been any records added in the Languages module!";s:4:"name";s:9:"Languages";s:12:"friendlyname";s:14:"Kalbų modulis";}}', NULL, NULL),
('PruneAdminlog_lastexecute', '1418212696', NULL, NULL),
('pseudocron_lastrun', '1418212696', NULL, NULL),
('cms_is_uptodate', '0', NULL, NULL),
('lastcmsversioncheck', '1417298395', NULL, NULL),
('TemplateExternalizer_mapi_pref_dev_mode', '1', NULL, NULL),
('TemplateExternalizer_mapi_pref_timeout', '0', NULL, NULL),
('TemplateExternalizer_mapi_pref_chmod', '0777', NULL, NULL),
('TemplateExternalizer_mapi_pref_cache_path', 'templates', NULL, NULL),
('TemplateExternalizer_mapi_pref_stylesheet_extension', 'css', NULL, NULL),
('TemplateExternalizer_mapi_pref_template_extension', 'tpl', NULL, NULL),
('CGExtensions_mapi_pref_cache_autoclean_last', '1418212696', NULL, NULL),
('CGExtensions_mapi_pref_imageextensions', 'jpg,png,gif', NULL, NULL),
('CGExtensions_mapi_pref_thumbnailsize', '75', NULL, NULL),
('CGExtensions_mapi_pref_watermark_text', 'Fototechnika', NULL, NULL),
('CGExtensions_mapi_pref_watermark_textsize', '12', NULL, NULL),
('CGExtensions_mapi_pref_watermark_angle', '0', NULL, NULL),
('CGExtensions_mapi_pref_watermark_font', 'ARIAL.TTF', NULL, NULL),
('CGExtensions_mapi_pref_watermark_bgcolor', '#FFFFFF', NULL, NULL),
('CGExtensions_mapi_pref_watermark_textcolor', '#000000', NULL, NULL),
('CGExtensions_mapi_pref_watermark_transparent', '1', NULL, NULL),
('CGExtensions_mapi_pref_dflt_sortablelist_template_content', '{* sortable list template *}\n\n{*\n This template provides one example of using javascript in a CMS module template.  The javascript is left here as an example of how one can interact with smarty in javascript.  You may infact want to put most of these functions into a seperate .js file and include it somewhere in your head section.\n\n You are free to modify this javascript and this template.  However, the php driver scripts look for a field named in the smarty variable {$selectarea_prefix}, and expect that to be a comma seperated list of values.\n *}\n\n{literal}\n<script type=''text/javascript''>\nvar allowduplicates = {/literal}{$allowduplicates};{literal}\nvar selectlist = {/literal}"{$selectarea_prefix}_selectlist";{literal}\nvar masterlist = {/literal}"{$selectarea_prefix}_masterlist";{literal}\nvar addbtn = {/literal}"{$selectarea_prefix}_add";{literal}\nvar rembtn = {/literal}"{$selectarea_prefix}_remove";{literal}\nvar upbtn = {/literal}"{$selectarea_prefix}_up";{literal}\nvar downbtn = {/literal}"{$selectarea_prefix}_down";{literal}\nvar valuefld = {/literal}"{$selectarea_prefix}";{literal}\nvar max_selected = {/literal}{$max_selected};{literal}\n\nfunction selectarea_update_value()\n{\n  var sel_elem = document.getElementById(selectlist);\n  var val_elem = document.getElementById(valuefld);\n  var sel_idx = sel_elem.selectedIndex;\n  var opts = sel_elem.getElementsByTagName(''option'');\n  var tmp = new Array();\n  for( i = 0; i < opts.length; i++ )\n    {\n      tmp[tmp.length] = opts[i].value;\n    }\n  var str = tmp.join('','');\n  val_elem.value = str;  \n}\n\nfunction selectarea_handle_down()\n{\n  var sel_elem = document.getElementById(selectlist);\n  var sel_idx = sel_elem.selectedIndex;\n  var opts = sel_elem.getElementsByTagName(''option'');\n  for( var i = opts.length - 2; i >= 0; i-- )\n    {\n      var opt = opts[i];\n      if( opt.selected )\n        {\n           var nextopt = opts[i+1];\n           opt = sel_elem.removeChild(opt);\n           nextopt = sel_elem.replaceChild(opt,nextopt);\n           sel_elem.insertBefore(nextopt,opt);\n        }\n    }\n  selectarea_update_value();\n}\n\nfunction selectarea_handle_up()\n{\n  var sel_elem = document.getElementById(selectlist);\n  var sel_idx = sel_elem.selectedIndex;\n  var opts = sel_elem.getElementsByTagName(''option'');\n  if( sel_idx > 0 )\n    {\n      for( var i = 1; i < opts.length; i++ )\n        {\n          var opt = opts[i];\n          if( opt.selected )\n            {\n              sel_elem.removeChild(opt);\n               sel_elem.insertBefore(opt, opts[i-1]);\n            }\n        }\n    }\n  selectarea_update_value();\n}\n\nfunction selectarea_handle_remove()\n{\n  var sel_elem = document.getElementById(selectlist);\n  var sel_idx = sel_elem.selectedIndex;\n  if( sel_idx >= 0 )\n    {\n      var val = sel_elem.options[sel_idx].value;\n      sel_elem.remove(sel_idx);\n    }\n  selectarea_update_value();\n}\n\nfunction selectarea_handle_add()\n{\n  var mas_elem = document.getElementById(masterlist);\n  var mas_idx = mas_elem.selectedIndex;\n  var sel_elem = document.getElementById(selectlist);\n  var opts = sel_elem.getElementsByTagName(''option'');\n  if( opts.length >= max_selected && max_selected > 0) return;\n  if( mas_idx >= 0 )\n    {\n      var newOpt = document.createElement(''option'');\n      newOpt.text = mas_elem.options[mas_idx].text;\n      newOpt.value = mas_elem.options[mas_idx].value;\n      if( allowduplicates == 0 )\n        {\n          for( var i = 0; i < opts.length; i++ )\n          {\n            if( opts[i].value == newOpt.value ) return;\n          }\n        }\n      sel_elem.add(newOpt,null);\n    }\n  selectarea_update_value();\n}\n\n\nfunction selectarea_handle_select()\n{\n  var sel_elem = document.getElementById(selectlist);\n  var sel_idx = sel_elem.selectedIndex;\n  var mas_elem = document.getElementById(masterlist);\n  var mas_idx = mas_elem.selectedIndex;\n  addbtn.disabled = (mas_idx >= 0);\n  rembtn.disabled = (sel_idx >= 0);\n  addbtn.disabled = (sel_idx >= 0);\n  downbtn.disabled = (sel_idx >= 0);\n}\n\n</script>\n{/literal}\n\n <table>\n   <tr>\n     <td>\n      {* left column - for the selected items *}\n      {$label_left}<br/>\n      <select id="{$selectarea_prefix}_selectlist" size="10" onchange="selectarea_handle_select();">\n        {html_options options=$selectarea_selected}\n      </select><br/>\n     </td>\n     <td>\n      {* center column - for the add/delete buttons *}\n      <input type="submit" id="{$selectarea_prefix}_add" value="&lt;&lt;" onclick="selectarea_handle_add(); return false;"/><br/>\n      <input type="submit" id="{$selectarea_prefix}_remove" value="&gt;&gt;" onclick="selectarea_handle_remove(); return false;"/><br/>\n      <input type="submit" id="{$selectarea_prefix}_up" value="{$upstr}" onclick="selectarea_handle_up(); return false;"/><br/>\n      <input type="submit" id="{$selectarea_prefix}_down" value="{$downstr}" onclick="selectarea_handle_down(); return false;"/><br/>\n     </td>\n     <td>\n      {* right column - for the master list *}\n      {$label_right}<br/>\n      <select id="{$selectarea_prefix}_masterlist" size="10" onchange="selectarea_handle_select();">\n        {html_options options=$selectarea_masterlist}\n      </select>\n     </td>\n   </tr>\n </table>\n <div><input type="hidden" id="{$selectarea_prefix}" name="{$selectarea_prefix}" value="{$selectarea_selected_str}" /></div>\n', NULL, NULL),
('CGExtensions_mapi_pref_dflt_sortablelist_template', 'Sample', NULL, NULL),
('mail_is_set', '1', NULL, NULL),
('CMSMailer_mapi_pref_mailer', 'mail', NULL, NULL),
('CGSmartImage_mapi_pref_aliases', 'a:1:{i:0;a:2:{s:4:"name";s:13:"std_thumbnail";s:7:"options";s:39:"filter_watermark=1 width=150 height=150";}}', NULL, NULL),
('CGSmartImage_mapi_pref_cache_path', 'uploads/_CGSmartImage', NULL, NULL),
('CGSmartImage_mapi_pref_embed_mode', 'smart', NULL, NULL),
('CGSmartImage_mapi_pref_embed_size', '32', NULL, NULL),
('CGSmartImage_mapi_pref_embed_type', 'png,jpg,gif', NULL, NULL),
('CGSmartImage_mapi_pref_image_url_prefix', 'http://factum.w4.texus.lt', NULL, NULL),
('CGSmartImage_mapi_pref_image_url_hascachedir', '0', NULL, NULL),
('CGSmartImage_mapi_pref_cache_age', '10', NULL, NULL),
('Titulinis_mapi_pref_allow_add', '1', NULL, NULL),
('TinyMCE_mapi_pref_advanced_toolbar2', 'bold,italic,underline,strikethrough,advhr,separator,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,customdropdown,cmslinker,link,unlink,anchor,image,charmap,cleanup,separator,forecolor,backcolor,separator,code,spellchecker,fullscreen,help', NULL, NULL),
('TinyMCE_mapi_pref_forcedrootblock', 'false', NULL, NULL),
('TinyMCE_mapi_pref_customdropdown', 'Insert CMS version info|{cms_version} {cms_versionname}\n---|---\nInsert Smarty {literal} around selection|{literal}|{/literal}', NULL, NULL),
('TinyMCE_mapi_pref_allowupload', '0', NULL, NULL),
('TinyMCE_mapi_pref_showtogglebutton', '1', NULL, NULL),
('TinyMCE_mapi_pref_advanced_toolbar1', 'cut,paste,pastetext,pasteword,copy,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,styleselect,formatselect,fontselect,fontsizeselect,youtube,media', NULL, NULL),
('TinyMCE_mapi_pref_toolbar3', '', NULL, NULL),
('TinyMCE_mapi_pref_allow_tables', '1', NULL, NULL),
('TinyMCE_mapi_pref_toolbar2', 'bold,italic,underline,strikethrough,advhr,separator,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,customdropdown,cmslinker,link,unlink,anchor,image,charmap,cleanup,separator,forecolor,backcolor,separator,code,spellchecker,fullscreen,help', NULL, NULL),
('TinyMCE_mapi_pref_advanced_toolbar3', '', NULL, NULL),
('TinyMCE_mapi_pref_advanced_allow_tables', '1', NULL, NULL),
('TinyMCE_mapi_pref_advanced_allowupload', '0', NULL, NULL),
('TinyMCE_mapi_pref_advanced_showtogglebutton', '1', NULL, NULL),
('TinyMCE_mapi_pref_front_toolbar1', 'cut,paste,pastetext,pasteword,copy,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,styleselect,formatselect,fontselect,fontsizeselect,youtube', NULL, NULL),
('TinyMCE_mapi_pref_front_toolbar2', 'bold,italic,underline,strikethrough,advhr,separator,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,cmslinker,link,unlink,anchor,image,charmap,cleanup,separator,forecolor,backcolor,separator,code,spellchecker,fullscreen,help', NULL, NULL),
('TinyMCE_mapi_pref_front_toolbar3', '', NULL, NULL),
('TinyMCE_mapi_pref_front_allow_tables', '0', NULL, NULL),
('TinyMCE_mapi_pref_front_showtogglebutton', '1', NULL, NULL),
('TinyMCE_mapi_pref_plugins', 'youtube,paste,spellchecker,advlink,inlinepopups,contextmenu,advimage,media', NULL, NULL),
('TinyMCE_mapi_pref_newlinestyle', 'p', NULL, NULL),
('TinyMCE_mapi_pref_usehtml5scheme', '0', NULL, NULL),
('TinyMCE_mapi_pref_usecompression', '0', NULL, NULL),
('TinyMCE_mapi_pref_entityencoding', 'raw', NULL, NULL),
('TinyMCE_mapi_pref_bodycss', '', NULL, NULL),
('TinyMCE_mapi_pref_editor_height_unit', 'px', NULL, NULL),
('TinyMCE_mapi_pref_show_path', '1', NULL, NULL),
('TinyMCE_mapi_pref_striptags', 'true', NULL, NULL),
('TinyMCE_mapi_pref_imagebrowserstyle', 'both', NULL, NULL),
('TinyMCE_mapi_pref_allowscaling', '0', NULL, NULL),
('TinyMCE_mapi_pref_scalingwidth', '800', NULL, NULL),
('TinyMCE_mapi_pref_scalingheight', '600', NULL, NULL),
('TinyMCE_mapi_pref_filepickerstyle', 'both', NULL, NULL),
('TinyMCE_mapi_pref_fpwidth', '700', NULL, NULL),
('TinyMCE_mapi_pref_fpheight', '500', NULL, NULL),
('TinyMCE_mapi_pref_toolbar1', 'cut,paste,pastetext,pasteword,copy,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,styleselect,formatselect,fontselect,fontsizeselect,youtube,media', NULL, NULL),
('TinyMCE_mapi_pref_skin', 'default', NULL, NULL),
('TinyMCE_mapi_pref_source_formatting', '1', NULL, NULL),
('TinyMCE_mapi_pref_editor_width', '800', NULL, NULL),
('TinyMCE_mapi_pref_editor_width_auto', '1', NULL, NULL),
('TinyMCE_mapi_pref_editor_width_unit', 'px', NULL, NULL),
('TinyMCE_mapi_pref_editor_height', '400', NULL, NULL),
('TinyMCE_mapi_pref_editor_height_auto', '1', NULL, NULL),
('TinyMCE_mapi_pref_extraconfig', '', NULL, NULL),
('TinyMCE_mapi_pref_forcecleanpaste', '1', NULL, NULL),
('TinyMCE_mapi_pref_startenabled', '1', NULL, NULL),
('TinyMCE_mapi_pref_loadcmslinker', '1', NULL, NULL),
('TinyMCE_mapi_pref_cmslinkerstyle', 'selflink', NULL, NULL),
('TinyMCE_mapi_pref_cmslinkeradds', '', NULL, NULL),
('TinyMCE_mapi_pref_usestaticconfig', '0', NULL, NULL),
('TinyMCE_mapi_pref_ignoremodifyfiles', '0', NULL, NULL),
('TinyMCE_mapi_pref_dropdownblockformats', 'h1,h2,h3,h4,h5,h6,blockquote,dt,dd,code,samp', NULL, NULL),
('Search_mapi_pref_savephrases', 'false', NULL, NULL),
('Search_mapi_pref_alpharesults', 'false', NULL, NULL),
('Search_mapi_pref_resultpage', '-1', NULL, NULL),
('AComments_mapi_pref_moderate', '', NULL, NULL),
('AComments_mapi_pref_spamprotect', '', NULL, NULL),
('AComments_mapi_pref_disable_html', '1', NULL, NULL),
('AComments_mapi_pref_akismet_check', '0', NULL, NULL),
('AComments_mapi_pref_enable_trackbacks', '0', NULL, NULL),
('AComments_mapi_pref_enable_trackback_backlink_check', '0', NULL, NULL),
('AComments_mapi_pref_enable_cookie_support', '0', NULL, NULL),
('CGEcommerceBase_mapi_pref_currency_symbol', 'Lt', NULL, NULL),
('CGEcommerceBase_mapi_pref_currency_code', 'LT', NULL, NULL),
('CGEcommerceBase_mapi_pref_weight_units', 'kg', NULL, NULL),
('CGEcommerceBase_mapi_pref_length_units', 'cm', NULL, NULL),
('__listcontent_timelock__', '1416471527', NULL, NULL),
('CGEcommerceBase_mapi_pref_cart_module', 'Cart', NULL, NULL),
('TxForm_mapi_pref_allow_add', '1', NULL, NULL),
('TinyMCE_mapi_pref_module_plugins', '', NULL, NULL),
('TinyMCE_mapi_pref_showfilemanagement', '1', NULL, NULL),
('TinyMCE_mapi_pref_restrictdirs', '0', NULL, NULL),
('TinyMCE_mapi_pref_advanced_showfilemanagement', '1', NULL, NULL),
('use_smartycache', '0', NULL, NULL),
('use_smartycompilecheck', '1', NULL, NULL),
('smarty_cachemodules', 'never', NULL, NULL),
('smarty_cacheudt', 'never', NULL, NULL);
INSERT INTO `cms_siteprefs` (`sitepref_name`, `sitepref_value`, `create_date`, `modified_date`) VALUES
('Gallery_mapi_pref_default_template_contents', '<div class="gallery">\r\n{if !empty($module_message)}<h4>{$module_message|escape}</h4>{/if}\r\n{if !empty($gallerytitle)}<h3>{$gallerytitle}</h3>{/if}\r\n{if !empty($gallerycomment)}<div class="gallerycomment">{$gallerycomment}</div>{/if}\r\n<p>{$imagecount}</p>\r\n<div class="pagenavigation">\r\n{if $pages > 1}\r\n<div class="prevpage">{$prevpage}</div>\r\n<div class="nextpage">{$nextpage}</div>\r\n{/if}\r\n{if !$hideparentlink && !empty($parentlink)}<div class="parentlink">{$parentlink}</div>{/if}\r\n{if $pages > 1}<div class="pagelinks">{$pagelinks}</div>{/if}\r\n</div>\r\n\r\n{foreach from=$images item=image}\r\n	<div class="img">\r\n	{if $image->isdir}\r\n		<a href="{$image->file}" title="{$image->titlename}"><img src="{$image->thumb|escape:''url''|replace:''%2F'':''/''}" alt="{$image->titlename}" /></a><br />\r\n		{$image->titlename}\r\n	{else}\r\n   <a class="group" href="{$image->file|escape:''url''|replace:''%2F'':''/''}" title="{$image->comment}" rel="prettyPhoto[{$galleryid}]"><img src="{$image->thumb|escape:''url''|replace:''%2F'':''/''}" alt="{$image->titlename}" /></a>\r\n	{/if}\r\n	</div>\r\n{/foreach}\r\n<div class="galleryclear">&nbsp;</div>\r\n</div>\r\n\r\n\r\n{*----------.gallery .img {\r\n	height: 120px;\r\n	/*width: 120px;   Adjust as you see fit */\r\n	float: left;\r\n	margin: 10px;\r\n	text-align: center;\r\n}\r\n\r\n.gallery .img a {\r\n	display: inline-block;\r\n	border: 2px solid #ddd;\r\n	padding: 1px;\r\n}\r\n\r\n.gallery .img a:hover {\r\n	border-color: #999;\r\n}\r\n\r\n.gallery img {\r\n	border: none;\r\n}\r\n\r\n.gallery .pagenavigation {\r\n	height: 50px;\r\n}\r\n\r\n.gallery .prevpage a, .gallery .prevpage em {\r\n	display: block;\r\n	width: 50px;\r\n	height: 39px;\r\n	float: left;\r\n	margin: 0;\r\n	text-indent: -1000px;\r\n	background: url(../../images/previous.png) transparent no-repeat 0 0;\r\n	overflow: hidden;\r\n}\r\n\r\n.gallery .nextpage a, .gallery .nextpage em {\r\n	display: block;\r\n	width: 50px;\r\n	height: 39px;\r\n	float: left;\r\n	margin: 0 6px 0 0;\r\n	text-indent: -1000px;\r\n	background: url(../../images/next.png) transparent no-repeat 0 0;\r\n	overflow: hidden;\r\n}\r\n\r\n.gallery .parentlink a {\r\n	display: block;\r\n	width: 50px;\r\n	height: 39px;\r\n	float: left;\r\n	text-indent: -1000px;\r\n	background: url(../../images/uppage.png) transparent no-repeat 0 0;\r\n	overflow: hidden;\r\n}\r\n\r\n.gallery .pagenavigation a:hover {\r\n	background-position: 0 -40px;\r\n}\r\n\r\n.gallery .prevpage em, .gallery .nextpage em {\r\n	background-position: 0 -80px;\r\n}\r\n\r\n.gallery .pagelinks {\r\n	float: right;\r\n	border-right: 2px solid #666;\r\n}\r\n\r\n.gallery .pagelinks a, .gallery .pagelinks em {\r\n	margin-top: 6px;\r\n	padding: 0 6px;\r\n	border-left: 2px solid #666;\r\n	text-align: center;\r\n	font: bold 11px verdana; color: #666;\r\n}\r\n\r\n.gallery .pagelinks em {\r\n	color: #000;\r\n}\r\n\r\n.galleryclear {\r\n	clear: both;\r\n}\r\n\r\n\r\n/* PRETTYPHOTO  -  version 3.1.4 */\r\n\r\ndiv.pp_default .pp_top,div.pp_default .pp_top .pp_middle,div.pp_default .pp_top .pp_left,div.pp_default .pp_top .pp_right,div.pp_default .pp_bottom,div.pp_default .pp_bottom .pp_left,div.pp_default .pp_bottom .pp_middle,div.pp_default .pp_bottom .pp_right{height:13px}\r\ndiv.pp_default .pp_top .pp_left{background:url(../prettyphoto/images/default/sprite.png) -78px -93px no-repeat}\r\ndiv.pp_default .pp_top .pp_middle{background:url(../prettyphoto/images/default/sprite_x.png) top left repeat-x}\r\ndiv.pp_default .pp_top .pp_right{background:url(../prettyphoto/images/default/sprite.png) -112px -93px no-repeat}\r\ndiv.pp_default .pp_content .ppt{color:#f8f8f8}\r\ndiv.pp_default .pp_content_container .pp_left{background:url(../prettyphoto/images/default/sprite_y.png) -7px 0 repeat-y;padding-left:13px}\r\ndiv.pp_default .pp_content_container .pp_right{background:url(../prettyphoto/images/default/sprite_y.png) top right repeat-y;padding-right:13px}\r\ndiv.pp_default .pp_next:hover{background:url(../prettyphoto/images/default/sprite_next.png) center right no-repeat;cursor:pointer}\r\ndiv.pp_default .pp_previous:hover{background:url(../prettyphoto/images/default/sprite_prev.png) center left no-repeat;cursor:pointer}\r\ndiv.pp_default .pp_expand{background:url(../prettyphoto/images/default/sprite.png) 0 -29px no-repeat;cursor:pointer;width:28px;height:28px}\r\ndiv.pp_default .pp_expand:hover{background:url(../prettyphoto/images/default/sprite.png) 0 -56px no-repeat;cursor:pointer}\r\ndiv.pp_default .pp_contract{background:url(../prettyphoto/images/default/sprite.png) 0 -84px no-repeat;cursor:pointer;width:28px;height:28px}\r\ndiv.pp_default .pp_contract:hover{background:url(../prettyphoto/images/default/sprite.png) 0 -113px no-repeat;cursor:pointer}\r\ndiv.pp_default .pp_close{width:30px;height:30px;background:url(../prettyphoto/images/default/sprite.png) 2px 1px no-repeat;cursor:pointer}\r\ndiv.pp_default .pp_gallery ul li a{background:url(../prettyphoto/images/default/default_thumb.png) center center #f8f8f8;border:1px solid #aaa}\r\ndiv.pp_default .pp_social{margin-top:7px}\r\ndiv.pp_default .pp_gallery a.pp_arrow_previous,div.pp_default .pp_gallery a.pp_arrow_next{position:static;left:auto}\r\ndiv.pp_default .pp_nav .pp_play,div.pp_default .pp_nav .pp_pause{background:url(../prettyphoto/images/default/sprite.png) -51px 1px no-repeat;height:30px;width:30px}\r\ndiv.pp_default .pp_nav .pp_pause{background-position:-51px -29px}\r\ndiv.pp_default a.pp_arrow_previous,div.pp_default a.pp_arrow_next{background:url(../prettyphoto/images/default/sprite.png) -31px -3px no-repeat;height:20px;width:20px;margin:4px 0 0}\r\ndiv.pp_default a.pp_arrow_next{left:52px;background-position:-82px -3px}\r\ndiv.pp_default .pp_content_container .pp_details{margin-top:5px}\r\ndiv.pp_default .pp_nav{clear:none;height:30px;width:110px;position:relative}\r\ndiv.pp_default .pp_nav .currentTextHolder{font-family:Georgia;font-style:italic;color:#999;font-size:11px;left:75px;line-height:25px;position:absolute;top:2px;margin:0;padding:0 0 0 10px}\r\ndiv.pp_default .pp_close:hover,div.pp_default .pp_nav .pp_play:hover,div.pp_default .pp_nav .pp_pause:hover,div.pp_default .pp_arrow_next:hover,div.pp_default .pp_arrow_previous:hover{opacity:0.7}\r\ndiv.pp_default .pp_description{font-size:11px;font-weight:700;line-height:14px;margin:5px 50px 5px 0}\r\ndiv.pp_default .pp_bottom .pp_left{background:url(../prettyphoto/images/default/sprite.png) -78px -127px no-repeat}\r\ndiv.pp_default .pp_bottom .pp_middle{background:url(../prettyphoto/images/default/sprite_x.png) bottom left repeat-x}\r\ndiv.pp_default .pp_bottom .pp_right{background:url(../prettyphoto/images/default/sprite.png) -112px -127px no-repeat}\r\ndiv.pp_default .pp_loaderIcon{background:url(../prettyphoto/images/default/loader.gif) center center no-repeat}\r\ndiv.light_rounded .pp_top .pp_left{background:url(../prettyphoto/images/light_rounded/sprite.png) -88px -53px no-repeat}\r\ndiv.light_rounded .pp_top .pp_right{background:url(../prettyphoto/images/light_rounded/sprite.png) -110px -53px no-repeat}\r\ndiv.light_rounded .pp_next:hover{background:url(../prettyphoto/images/light_rounded/btnNext.png) center right no-repeat;cursor:pointer}\r\ndiv.light_rounded .pp_previous:hover{background:url(../prettyphoto/images/light_rounded/btnPrevious.png) center left no-repeat;cursor:pointer}\r\ndiv.light_rounded .pp_expand{background:url(../prettyphoto/images/light_rounded/sprite.png) -31px -26px no-repeat;cursor:pointer}\r\ndiv.light_rounded .pp_expand:hover{background:url(../prettyphoto/images/light_rounded/sprite.png) -31px -47px no-repeat;cursor:pointer}\r\ndiv.light_rounded .pp_contract{background:url(../prettyphoto/images/light_rounded/sprite.png) 0 -26px no-repeat;cursor:pointer}\r\ndiv.light_rounded .pp_contract:hover{background:url(../prettyphoto/images/light_rounded/sprite.png) 0 -47px no-repeat;cursor:pointer}\r\ndiv.light_rounded .pp_close{width:75px;height:22px;background:url(../prettyphoto/images/light_rounded/sprite.png) -1px -1px no-repeat;cursor:pointer}\r\ndiv.light_rounded .pp_nav .pp_play{background:url(../prettyphoto/images/light_rounded/sprite.png) -1px -100px no-repeat;height:15px;width:14px}\r\ndiv.light_rounded .pp_nav .pp_pause{background:url(../prettyphoto/images/light_rounded/sprite.png) -24px -100px no-repeat;height:15px;width:14px}\r\ndiv.light_rounded .pp_arrow_previous{background:url(../prettyphoto/images/light_rounded/sprite.png) 0 -71px no-repeat}\r\ndiv.light_rounded .pp_arrow_next{background:url(../prettyphoto/images/light_rounded/sprite.png) -22px -71px no-repeat}\r\ndiv.light_rounded .pp_bottom .pp_left{background:url(../prettyphoto/images/light_rounded/sprite.png) -88px -80px no-repeat}\r\ndiv.light_rounded .pp_bottom .pp_right{background:url(../prettyphoto/images/light_rounded/sprite.png) -110px -80px no-repeat}\r\ndiv.dark_rounded .pp_top .pp_left{background:url(../prettyphoto/images/dark_rounded/sprite.png) -88px -53px no-repeat}\r\ndiv.dark_rounded .pp_top .pp_right{background:url(../prettyphoto/images/dark_rounded/sprite.png) -110px -53px no-repeat}\r\ndiv.dark_rounded .pp_content_container .pp_left{background:url(../prettyphoto/images/dark_rounded/contentPattern.png) top left repeat-y}\r\ndiv.dark_rounded .pp_content_container .pp_right{background:url(../prettyphoto/images/dark_rounded/contentPattern.png) top right repeat-y}\r\ndiv.dark_rounded .pp_next:hover{background:url(../prettyphoto/images/dark_rounded/btnNext.png) center right no-repeat;cursor:pointer}\r\ndiv.dark_rounded .pp_previous:hover{background:url(../prettyphoto/images/dark_rounded/btnPrevious.png) center left no-repeat;cursor:pointer}\r\ndiv.dark_rounded .pp_expand{background:url(../prettyphoto/images/dark_rounded/sprite.png) -31px -26px no-repeat;cursor:pointer}\r\ndiv.dark_rounded .pp_expand:hover{background:url(../prettyphoto/images/dark_rounded/sprite.png) -31px -47px no-repeat;cursor:pointer}\r\ndiv.dark_rounded .pp_contract{background:url(../prettyphoto/images/dark_rounded/sprite.png) 0 -26px no-repeat;cursor:pointer}\r\ndiv.dark_rounded .pp_contract:hover{background:url(../prettyphoto/images/dark_rounded/sprite.png) 0 -47px no-repeat;cursor:pointer}\r\ndiv.dark_rounded .pp_close{width:75px;height:22px;background:url(../prettyphoto/images/dark_rounded/sprite.png) -1px -1px no-repeat;cursor:pointer}\r\ndiv.dark_rounded .pp_description{margin-right:85px;color:#fff}\r\ndiv.dark_rounded .pp_nav .pp_play{background:url(../prettyphoto/images/dark_rounded/sprite.png) -1px -100px no-repeat;height:15px;width:14px}\r\ndiv.dark_rounded .pp_nav .pp_pause{background:url(../prettyphoto/images/dark_rounded/sprite.png) -24px -100px no-repeat;height:15px;width:14px}\r\ndiv.dark_rounded .pp_arrow_previous{background:url(../prettyphoto/images/dark_rounded/sprite.png) 0 -71px no-repeat}\r\ndiv.dark_rounded .pp_arrow_next{background:url(../prettyphoto/images/dark_rounded/sprite.png) -22px -71px no-repeat}\r\ndiv.dark_rounded .pp_bottom .pp_left{background:url(../prettyphoto/images/dark_rounded/sprite.png) -88px -80px no-repeat}\r\ndiv.dark_rounded .pp_bottom .pp_right{background:url(../prettyphoto/images/dark_rounded/sprite.png) -110px -80px no-repeat}\r\ndiv.dark_rounded .pp_loaderIcon{background:url(../prettyphoto/images/dark_rounded/loader.gif) center center no-repeat}\r\ndiv.dark_square .pp_left,div.dark_square .pp_middle,div.dark_square .pp_right,div.dark_square .pp_content{background:#000}\r\ndiv.dark_square .pp_description{color:#fff;margin:0 85px 0 0}\r\ndiv.dark_square .pp_loaderIcon{background:url(../prettyphoto/images/dark_square/loader.gif) center center no-repeat}\r\ndiv.dark_square .pp_expand{background:url(../prettyphoto/images/dark_square/sprite.png) -31px -26px no-repeat;cursor:pointer}\r\ndiv.dark_square .pp_expand:hover{background:url(../prettyphoto/images/dark_square/sprite.png) -31px -47px no-repeat;cursor:pointer}\r\ndiv.dark_square .pp_contract{background:url(../prettyphoto/images/dark_square/sprite.png) 0 -26px no-repeat;cursor:pointer}\r\ndiv.dark_square .pp_contract:hover{background:url(../prettyphoto/images/dark_square/sprite.png) 0 -47px no-repeat;cursor:pointer}\r\ndiv.dark_square .pp_close{width:75px;height:22px;background:url(../prettyphoto/images/dark_square/sprite.png) -1px -1px no-repeat;cursor:pointer}\r\ndiv.dark_square .pp_nav{clear:none}\r\ndiv.dark_square .pp_nav .pp_play{background:url(../prettyphoto/images/dark_square/sprite.png) -1px -100px no-repeat;height:15px;width:14px}\r\ndiv.dark_square .pp_nav .pp_pause{background:url(../prettyphoto/images/dark_square/sprite.png) -24px -100px no-repeat;height:15px;width:14px}\r\ndiv.dark_square .pp_arrow_previous{background:url(../prettyphoto/images/dark_square/sprite.png) 0 -71px no-repeat}\r\ndiv.dark_square .pp_arrow_next{background:url(../prettyphoto/images/dark_square/sprite.png) -22px -71px no-repeat}\r\ndiv.dark_square .pp_next:hover{background:url(../prettyphoto/images/dark_square/btnNext.png) center right no-repeat;cursor:pointer}\r\ndiv.dark_square .pp_previous:hover{background:url(../prettyphoto/images/dark_square/btnPrevious.png) center left no-repeat;cursor:pointer}\r\ndiv.light_square .pp_expand{background:url(../prettyphoto/images/light_square/sprite.png) -31px -26px no-repeat;cursor:pointer}\r\ndiv.light_square .pp_expand:hover{background:url(../prettyphoto/images/light_square/sprite.png) -31px -47px no-repeat;cursor:pointer}\r\ndiv.light_square .pp_contract{background:url(../prettyphoto/images/light_square/sprite.png) 0 -26px no-repeat;cursor:pointer}\r\ndiv.light_square .pp_contract:hover{background:url(../prettyphoto/images/light_square/sprite.png) 0 -47px no-repeat;cursor:pointer}\r\ndiv.light_square .pp_close{width:75px;height:22px;background:url(../prettyphoto/images/light_square/sprite.png) -1px -1px no-repeat;cursor:pointer}\r\ndiv.light_square .pp_nav .pp_play{background:url(../prettyphoto/images/light_square/sprite.png) -1px -100px no-repeat;height:15px;width:14px}\r\ndiv.light_square .pp_nav .pp_pause{background:url(../prettyphoto/images/light_square/sprite.png) -24px -100px no-repeat;height:15px;width:14px}\r\ndiv.light_square .pp_arrow_previous{background:url(../prettyphoto/images/light_square/sprite.png) 0 -71px no-repeat}\r\ndiv.light_square .pp_arrow_next{background:url(../prettyphoto/images/light_square/sprite.png) -22px -71px no-repeat}\r\ndiv.light_square .pp_next:hover{background:url(../prettyphoto/images/light_square/btnNext.png) center right no-repeat;cursor:pointer}\r\ndiv.light_square .pp_previous:hover{background:url(../prettyphoto/images/light_square/btnPrevious.png) center left no-repeat;cursor:pointer}\r\ndiv.facebook .pp_top .pp_left{background:url(../prettyphoto/images/facebook/sprite.png) -88px -53px no-repeat}\r\ndiv.facebook .pp_top .pp_middle{background:url(../prettyphoto/images/facebook/contentPatternTop.png) top left repeat-x}\r\ndiv.facebook .pp_top .pp_right{background:url(../prettyphoto/images/facebook/sprite.png) -110px -53px no-repeat}\r\ndiv.facebook .pp_content_container .pp_left{background:url(../prettyphoto/images/facebook/contentPatternLeft.png) top left repeat-y}\r\ndiv.facebook .pp_content_container .pp_right{background:url(../prettyphoto/images/facebook/contentPatternRight.png) top right repeat-y}\r\ndiv.facebook .pp_expand{background:url(../prettyphoto/images/facebook/sprite.png) -31px -26px no-repeat;cursor:pointer}\r\ndiv.facebook .pp_expand:hover{background:url(../prettyphoto/images/facebook/sprite.png) -31px -47px no-repeat;cursor:pointer}\r\ndiv.facebook .pp_contract{background:url(../prettyphoto/images/facebook/sprite.png) 0 -26px no-repeat;cursor:pointer}\r\ndiv.facebook .pp_contract:hover{background:url(../prettyphoto/images/facebook/sprite.png) 0 -47px no-repeat;cursor:pointer}\r\ndiv.facebook .pp_close{width:22px;height:22px;background:url(../prettyphoto/images/facebook/sprite.png) -1px -1px no-repeat;cursor:pointer}\r\ndiv.facebook .pp_description{margin:0 37px 0 0}\r\ndiv.facebook .pp_loaderIcon{background:url(../prettyphoto/images/facebook/loader.gif) center center no-repeat}\r\ndiv.facebook .pp_arrow_previous{background:url(../prettyphoto/images/facebook/sprite.png) 0 -71px no-repeat;height:22px;margin-top:0;width:22px}\r\ndiv.facebook .pp_arrow_previous.disabled{background-position:0 -96px;cursor:default}\r\ndiv.facebook .pp_arrow_next{background:url(../prettyphoto/images/facebook/sprite.png) -32px -71px no-repeat;height:22px;margin-top:0;width:22px}\r\ndiv.facebook .pp_arrow_next.disabled{background-position:-32px -96px;cursor:default}\r\ndiv.facebook .pp_nav{margin-top:0}\r\ndiv.facebook .pp_nav p{font-size:15px;padding:0 3px 0 4px}\r\ndiv.facebook .pp_nav .pp_play{background:url(../prettyphoto/images/facebook/sprite.png) -1px -123px no-repeat;height:22px;width:22px}\r\ndiv.facebook .pp_nav .pp_pause{background:url(../prettyphoto/images/facebook/sprite.png) -32px -123px no-repeat;height:22px;width:22px}\r\ndiv.facebook .pp_next:hover{background:url(../prettyphoto/images/facebook/btnNext.png) center right no-repeat;cursor:pointer}\r\ndiv.facebook .pp_previous:hover{background:url(../prettyphoto/images/facebook/btnPrevious.png) center left no-repeat;cursor:pointer}\r\ndiv.facebook .pp_bottom .pp_left{background:url(../prettyphoto/images/facebook/sprite.png) -88px -80px no-repeat}\r\ndiv.facebook .pp_bottom .pp_middle{background:url(../prettyphoto/images/facebook/contentPatternBottom.png) top left repeat-x}\r\ndiv.facebook .pp_bottom .pp_right{background:url(../prettyphoto/images/facebook/sprite.png) -110px -80px no-repeat}\r\ndiv.pp_pic_holder a:focus{outline:none}\r\ndiv.pp_overlay{background:#000;display:none;left:0;position:absolute;top:0;width:100%;z-index:9500}\r\ndiv.pp_pic_holder{display:none;position:absolute;width:100px;z-index:10000}\r\n.pp_content{height:40px;min-width:40px}\r\n* html .pp_content{width:40px}\r\n.pp_content_container{position:relative;text-align:left;width:100%}\r\n.pp_content_container .pp_left{padding-left:20px}\r\n.pp_content_container .pp_right{padding-right:20px}\r\n.pp_content_container .pp_details{float:left;margin:10px 0 2px}\r\n.pp_description{display:none;margin:0}\r\n.pp_social{float:left;margin:0}\r\n.pp_social .facebook{float:left;margin-left:5px;width:55px;overflow:hidden}\r\n.pp_social .twitter{float:left}\r\n.pp_nav{clear:right;float:left;margin:3px 10px 0 0}\r\n.pp_nav p{float:left;white-space:nowrap;margin:2px 4px}\r\n.pp_nav .pp_play,.pp_nav .pp_pause{float:left;margin-right:4px;text-indent:-10000px}\r\na.pp_arrow_previous,a.pp_arrow_next{display:block;float:left;height:15px;margin-top:3px;overflow:hidden;text-indent:-10000px;width:14px}\r\n.pp_hoverContainer{position:absolute;top:0;width:100%;z-index:2000}\r\n.pp_gallery{display:none;left:50%;margin-top:-50px;position:absolute;z-index:10000}\r\n.pp_gallery div{float:left;overflow:hidden;position:relative}\r\n.pp_gallery ul{float:left;height:35px;position:relative;white-space:nowrap;margin:0 0 0 5px;padding:0}\r\n.pp_gallery ul a{border:1px rgba(0,0,0,0.5) solid;display:block;float:left;height:33px;overflow:hidden}\r\n.pp_gallery ul a img{border:0}\r\n.pp_gallery li{display:block;float:left;margin:0 5px 0 0;padding:0}\r\n.pp_gallery li.default a{background:url(../prettyphoto/images/facebook/default_thumbnail.gif) 0 0 no-repeat;display:block;height:33px;width:50px}\r\n.pp_gallery .pp_arrow_previous,.pp_gallery .pp_arrow_next{margin-top:7px!important}\r\na.pp_next{background:url(../prettyphoto/images/light_rounded/btnNext.png) 10000px 10000px no-repeat;display:block;float:right;height:100%;text-indent:-10000px;width:49%}\r\na.pp_previous{background:url(../prettyphoto/images/light_rounded/btnNext.png) 10000px 10000px no-repeat;display:block;float:left;height:100%;text-indent:-10000px;width:49%}\r\na.pp_expand,a.pp_contract{cursor:pointer;display:none;height:20px;position:absolute;right:30px;text-indent:-10000px;top:10px;width:20px;z-index:20000}\r\na.pp_close{position:absolute;right:0;top:0;display:block;line-height:22px;text-indent:-10000px}\r\n.pp_loaderIcon{display:block;height:24px;left:50%;position:absolute;top:50%;width:24px;margin:-12px 0 0 -12px}\r\n#pp_full_res{line-height:1!important}\r\n#pp_full_res .pp_inline{text-align:left}\r\n#pp_full_res .pp_inline p{margin:0 0 15px}\r\ndiv.ppt{color:#fff;display:none;font-size:17px;z-index:9999;margin:0 0 5px 15px}\r\ndiv.pp_default .pp_content,div.light_rounded .pp_content{background-color:#fff}\r\ndiv.pp_default #pp_full_res .pp_inline,div.light_rounded .pp_content .ppt,div.light_rounded #pp_full_res .pp_inline,div.light_square .pp_content .ppt,div.light_square #pp_full_res .pp_inline,div.facebook .pp_content .ppt,div.facebook #pp_full_res .pp_inline{color:#000}\r\ndiv.pp_default .pp_gallery ul li a:hover,div.pp_default .pp_gallery ul li.selected a,.pp_gallery ul a:hover,.pp_gallery li.selected a{border-color:#fff}\r\ndiv.pp_default .pp_details,div.light_rounded .pp_details,div.dark_rounded .pp_details,div.dark_square .pp_details,div.light_square .pp_details,div.facebook .pp_details{position:relative}\r\ndiv.light_rounded .pp_top .pp_middle,div.light_rounded .pp_content_container .pp_left,div.light_rounded .pp_content_container .pp_right,div.light_rounded .pp_bottom .pp_middle,div.light_square .pp_left,div.light_square .pp_middle,div.light_square .pp_right,div.light_square .pp_content,div.facebook .pp_content{background:#fff}\r\ndiv.light_rounded .pp_description,div.light_square .pp_description{margin-right:85px}\r\ndiv.light_rounded .pp_gallery a.pp_arrow_previous,div.light_rounded .pp_gallery a.pp_arrow_next,div.dark_rounded .pp_gallery a.pp_arrow_previous,div.dark_rounded .pp_gallery a.pp_arrow_next,div.dark_square .pp_gallery a.pp_arrow_previous,div.dark_square .pp_gallery a.pp_arrow_next,div.light_square .pp_gallery a.pp_arrow_previous,div.light_square .pp_gallery a.pp_arrow_next{margin-top:12px!important}\r\ndiv.light_rounded .pp_arrow_previous.disabled,div.dark_rounded .pp_arrow_previous.disabled,div.dark_square .pp_arrow_previous.disabled,div.light_square .pp_arrow_previous.disabled{background-position:0 -87px;cursor:default}\r\ndiv.light_rounded .pp_arrow_next.disabled,div.dark_rounded .pp_arrow_next.disabled,div.dark_square .pp_arrow_next.disabled,div.light_square .pp_arrow_next.disabled{background-position:-22px -87px;cursor:default}\r\ndiv.light_rounded .pp_loaderIcon,div.light_square .pp_loaderIcon{background:url(../prettyphoto/images/light_rounded/loader.gif) center center no-repeat}\r\ndiv.dark_rounded .pp_top .pp_middle,div.dark_rounded .pp_content,div.dark_rounded .pp_bottom .pp_middle{background:url(../prettyphoto/images/dark_rounded/contentPattern.png) top left repeat}\r\ndiv.dark_rounded .currentTextHolder,div.dark_square .currentTextHolder{color:#c4c4c4}\r\ndiv.dark_rounded #pp_full_res .pp_inline,div.dark_square #pp_full_res .pp_inline{color:#fff}\r\n.pp_top,.pp_bottom{height:20px;position:relative}\r\n* html .pp_top,* html .pp_bottom{padding:0 20px}\r\n.pp_top .pp_left,.pp_bottom .pp_left{height:20px;left:0;position:absolute;width:20px}\r\n.pp_top .pp_middle,.pp_bottom .pp_middle{height:20px;left:20px;position:absolute;right:20px}\r\n* html .pp_top .pp_middle,* html .pp_bottom .pp_middle{left:0;position:static}\r\n.pp_top .pp_right,.pp_bottom .pp_right{height:20px;left:auto;position:absolute;right:0;top:0;width:20px}\r\n.pp_fade,.pp_gallery li.default a img{display:none}{*----------<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>\r\n<script type="text/javascript" src="modules/Gallery/templates/prettyphoto/jquery.prettyPhoto.js"></script>\r\n\r\n<script type="text/javascript" charset="utf-8">\r\n$(document).ready(function(){\r\n	$("a[rel^=''prettyPhoto'']").prettyPhoto({\r\n			animation_speed: ''fast'',\r\n			slideshow: 5000,\r\n			autoplay_slideshow: false,\r\n			show_title: true,\r\n			allow_resize: true,\r\n			counter_separator_label: ''/'',\r\n			theme: ''pp_default'', /* light_rounded / dark_rounded / light_square / dark_square / facebook */\r\n			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */\r\n			overlay_gallery: true,\r\n			keyboard_shortcuts: true\r\n	});\r\n});\r\n</script>*}', NULL, NULL),
('Gallery_mapi_pref_current_template', 'Fancybox', NULL, NULL),
('Gallery_mapi_pref_singleimg_template', 'prettyPhoto', NULL, NULL),
('Gallery_mapi_pref_singleimg_template_html', '<a class="group" href="{$image->file|escape:''url''|replace:''%2F'':''/''}" title="{$image->title}" rel="prettyPhoto"><img src="{$image->thumb|escape:''url''|replace:''%2F'':''/''}" alt="{$image->title}" /></a>', NULL, NULL),
('Gallery_mapi_pref_urlprefix', 'gallery', NULL, NULL),
('Gallery_mapi_pref_allowed_extensions', 'jpg,jpeg,gif,png', NULL, NULL),
('Gallery_mapi_pref_maximagewidth', '1366', NULL, NULL),
('Gallery_mapi_pref_maximageheight', '768', NULL, NULL),
('Gallery_mapi_pref_imagejpgquality', '100', NULL, NULL),
('Gallery_mapi_pref_thumbjpgquality', '100', NULL, NULL),
('Gallery_mapi_pref_use_permissions', '0', NULL, NULL),
('Gallery_mapi_pref_newgalleries_active', '1', NULL, NULL),
('Gallery_mapi_pref_use_comment_wysiwyg', '0', NULL, NULL),
('Gallery_mapi_pref_editdirdates', '0', NULL, NULL),
('Gallery_mapi_pref_editfiledates', '0', NULL, NULL),
('Gallery_mapi_pref_fe_folderpath', 'modules/Gallery/images/folder.png', NULL, NULL),
('Gallery_mapi_pref_be_folderpath', 'modules/Gallery/images/foldersmall.png', NULL, NULL),
('thumbnail_width', '96', NULL, NULL),
('thumbnail_height', '96', NULL, NULL),
('searchmodule', 'Search', NULL, NULL),
('AdvancedContent_mapi_pref_default_multi_input_tpl', 'multi_input_SampleTemplate', NULL, NULL),
('News_mapi_pref_formsubmit_emailaddress', '', NULL, NULL),
('GBFilePicker_mapi_pref_restrict_users_diraccess', '0', NULL, NULL),
('GBFilePicker_mapi_pref_show_filemanagement', '0', NULL, NULL),
('GBFilePicker_mapi_pref_show_thumbfiles', '0', NULL, NULL),
('GBFilePicker_mapi_pref_allow_scaling', '1', NULL, NULL),
('GBFilePicker_mapi_pref_scaling_width', '', NULL, NULL),
('GBFilePicker_mapi_pref_scaling_height', '', NULL, NULL),
('GBFilePicker_mapi_pref_create_thumbs', '1', NULL, NULL),
('GBFilePicker_mapi_pref_allow_upscaling', '0', NULL, NULL),
('GBFilePicker_mapi_pref_use_mimetype', '0', NULL, NULL),
('GBFilePicker_mapi_pref_feu_access', '', NULL, NULL),
('CMSMailer_mapi_pref_password', '', NULL, NULL),
('CMSMailer_mapi_pref_charset', 'utf-8', NULL, NULL),
('News_mapi_pref_hide_summary_field', '0', NULL, NULL),
('CGSmartImage_mapi_pref_croptofit_default_loc', 'c', NULL, NULL),
('CGSmartImage_mapi_pref_clearcache_lastrun', '1418212696', NULL, NULL),
('News_mapi_pref_article_category', '', NULL, NULL),
('News_mapi_pref_article_sortby', 'news_date DESC', NULL, NULL),
('News_mapi_pref_article_pagelimit', '25', NULL, NULL),
('FrontEndUsers_mapi_pref_min_passwordlength', '6', NULL, NULL),
('News_mapi_pref_default_category', '8', NULL, NULL),
('FrontEndUsers_mapi_pref_max_passwordlength', '40', NULL, NULL),
('FrontEndUsers_mapi_pref_min_usernamelength', '4', NULL, NULL),
('FrontEndUsers_mapi_pref_max_usernamelength', '40', NULL, NULL),
('FrontEndUsers_mapi_pref_user_session_expires', '36000', NULL, NULL),
('FrontEndUsers_mapi_pref_cookie_keepalive', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_default_group', '1', NULL, NULL),
('FrontEndUsers_mapi_pref_required_field_marker', '*', NULL, NULL),
('FrontEndUsers_mapi_pref_required_field_color', 'blue', NULL, NULL),
('FrontEndUsers_mapi_pref_require_onegroup', '1', NULL, NULL),
('FrontEndUsers_mapi_pref_hidden_field_marker', '!', NULL, NULL),
('FrontEndUsers_mapi_pref_hidden_field_color', 'green', NULL, NULL),
('FrontEndUsers_mapi_pref_pageid_forgotpasswd', '', NULL, NULL),
('FrontEndUsers_mapi_pref_pageid_changesettings', '', NULL, NULL),
('FrontEndUsers_mapi_pref_pageid_login', '{if $kalba == ''lt''}399{else if $kalba == ''en''}15{/if}', NULL, NULL),
('FrontEndUsers_mapi_pref_pageid_logout', '15', NULL, NULL),
('FrontEndUsers_mapi_pref_pageid_afterverify', '', NULL, NULL),
('FrontEndUsers_mapi_pref_allow_duplicate_emails', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_username_is_email', '1', NULL, NULL),
('FrontEndUsers_mapi_pref_passwordfldlength', '40', NULL, NULL),
('FrontEndUsers_mapi_pref_usernamefldlength', '40', NULL, NULL),
('FrontEndUsers_mapi_pref_allow_repeated_logins', '1', NULL, NULL),
('FrontEndUsers_mapi_pref_image_destination_path', 'feusers', NULL, NULL),
('FrontEndUsers_mapi_pref_allowed_image_extensions', '.gif,.png,.jpg', NULL, NULL),
('FrontEndUsers_mapi_pref_usecookiestoremember', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_cookiename', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_notification_subject', 'FEU Event Notification', NULL, NULL),
('FrontEndUsers_mapi_pref_expireage_months', '520', NULL, NULL),
('FrontEndUsers_mapi_pref_pwsalt', 'd106b', NULL, NULL),
('FrontEndUsers_mapi_pref_expireusers_lastrun', '1417004996', NULL, NULL),
('FrontEndUsers_mapi_pref_auto_create_unknown', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_auth_module', '__BUILTIN__', NULL, NULL),
('FrontEndUsers_mapi_pref_use_randomusername', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_notification_address', '', NULL, NULL),
('FrontEndUsers_mapi_pref_feusers_specific_permissions', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_forcelogout_times', '', NULL, NULL),
('FrontEndUsers_mapi_pref_forcelogout_sessionage', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_expireusers_interval', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_pagetype_action', 'redirect', NULL, NULL),
('FrontEndUsers_mapi_pref_pagetype_redirectto', '15', NULL, NULL),
('FrontEndUsers_mapi_pref_support_lostun', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_allow_changeusername', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_support_lostpw', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_allow_duplicate_reminders', '0', NULL, NULL),
('FrontEndUsers_mapi_pref_signin_button', 'Prisijungti', NULL, NULL),
('FrontEndUsers_mapi_pref_secure_field_marker', '^^', NULL, NULL),
('FrontEndUsers_mapi_pref_secure_field_color', 'yellow', NULL, NULL),
('FrontEndUsers_mapi_pref_pageidforgotpasswd', '', NULL, NULL),
('FrontEndUsers_mapi_pref_pageid_afterchangesettings', '', NULL, NULL),
('News_mapi_pref_allow_summary_wysiwyg', '0', NULL, NULL),
('News_mapi_pref_expired_searchable', '1', NULL, NULL),
('News_mapi_pref_expired_viewable', '1', NULL, NULL),
('News_mapi_pref_expiry_interval', '180', NULL, NULL),
('News_mapi_pref_fesubmit_status', 'draft', NULL, NULL),
('News_mapi_pref_fesubmit_redirect', '', NULL, NULL),
('News_mapi_pref_detail_returnid', '-1', NULL, NULL),
('Products_mapi_pref_products_pref_newsummary_template', '{if isset($catformstart)}\r\n{$catformstart}\r\n{$catdropdown}{$catbutton}\r\n{$catformend}\r\n{/if}\r\n\r\n{if isset($pagecount) && $pagecount gt 1}\r\n{$firstlink}&nbsp;{$prevlink}&nbsp;&nbsp;{$pagetext} {$curpage} {$oftext} {$pagecount}&nbsp;&nbsp;{$nextlink}&nbsp;{$lastlink}\r\n{/if}\r\n\r\n{foreach from=$items item=entry}\r\n   {* \r\n     the summary template has access to custom fields via the $entry->fields hash\r\n     and to categories via the $entry->categories array of objects.  Also\r\n     attribute information is available via $entry->attributes.\r\n     you should use the get_template_vars and the print_r modifier to see\r\n     what is available\r\n    *}\r\n  <div class="ProductDirectoryItem">\r\n     <a href="{$entry->detail_url}">{$entry->product_name}</a>&nbsp;({$entry->weight}{$weight_units})&nbsp;&nbsp;{$currency_symbol}{$entry->price}\r\n     {if isset($entry->categories)}\r\n       Categories:&nbsp;\r\n       {foreach from=$entry->categories item=''category''}\r\n         {$category->name},&nbsp;\r\n       {/foreach}\r\n       <br/>\r\n     {/if}     \r\n  </div>\r\n\r\n  {* include the cart \r\n  {cge_have_module m=''CGEcommerceBase'' assign=''tmp''}\r\n  {if $tmp}\r\n  <div>\r\n  {cgecomm_form_addtocart product=$entry->id} \r\n  </div>\r\n  {/if}\r\n  *}\r\n\r\n{/foreach}\r\n', NULL, NULL),
('Products_mapi_pref_products_pref_dfltsummary_template', 'main', NULL, NULL),
('Products_mapi_pref_products_pref_newdetail_template', '{* this is a sample product detail template *}\r\n{assign var=''products'' value=$mod}\r\n<div class="ProductDirectoryItem">\r\n\r\n{if is_array($entry->breadcrumb)}\r\nBreadcrumb:  {'' >> ''|implode:$entry->breadcrumb}<br/>\r\n{/if}\r\n\r\nName: <a name="product_name" style="text-decoration: none;">{$entry->product_name}</a><br />\r\nFile Location: {$entry->file_location}<br/>\r\n\r\n\r\n{if $entry->weight ne ''''}\r\nWeight {$weight_units}: {$entry->weight}<br />\r\n{/if}\r\n\r\nBreadcrumb: {$entry->breadcrumb}\r\n\r\n{if $entry->details ne ''''}\r\nDetails:<br />\r\n{$entry->details}<br />\r\n{/if}\r\n\r\n{* uncomment the following line if the Promotions module is installed *}\r\n{* promo_get_prod_discount product_id=$entry->id assign=''foo'' *}\r\n{if isset($foo.promo_id)}\r\n<span style="color: red;">Discount:  {$currency_symbol}{$foo.discount|number_format:2} ({$foo.percentage|number_format:2}%)</span><br/>\r\n{if $entry->price ne ''''}\r\nPrice {$currency_symbol}: {$entry->price * $foo.decimal|number_format:2}<br />\r\n{/if}\r\n{elseif $entry->price ne ''''}\r\nPrice {$currency_symbol}: {$entry->price}<br />\r\n{/if}\r\n\r\n{* accessing all of the fields in a list *}\r\n{if count($entry->fields)}\r\n  <h4>Custom Fields</h4>\r\n  {foreach from=$entry->fields key=''name'' item=''field''}\r\n     <div class="product_detail_field"><p>\r\n       {$mod->Lang(''name'')}: {$name}<br/>\r\n       {$mod->lang(''type'')}: {$field->type}<br/>\r\n       {$mod->lang(''value'')}: {$field->value}<br/>\r\n       {if $field->type == ''image'' && isset($field->thumbnail)}\r\n         <img src="{$entry->file_location}/{$field->thumbnail}" alt="{$field->value}"/>\r\n       {/if}\r\n     </p></div>\r\n  {/foreach}\r\n{/if}\r\n\r\n{* print out attributes *}\r\n{if isset($entry->attribs_full)}\r\n  <h4>Attributes</h4>\r\n  {foreach from=$entry->attributes key=''name'' item=''attribset''}\r\n     <h6>{$name}</h6>\r\n     <div class="product_detail_field"><p>\r\n       {foreach from=$attribset key=''label'' item=''attribute''}\r\n         {$label} ({$attribute.sku}): {$attribute.attrib_adjustment}<br/>\r\n       {/foreach}\r\n     </p></div>\r\n  {/foreach}\r\n{/if}\r\n\r\n{* print out the categories *}\r\n{if isset($entry->categories)}\r\n  <h4>Categories</h4>\r\n  {foreach from=$entry->categories item=''category''}\r\n    <div class="product_detail_category"><p>\r\n      {$mod->Lang(''id'')}: {$category->id}<br/>\r\n      {$mod->Lang(''name'')}: {$category->name}<br/>\r\n      {* if there are data fields associated with this category, display them too *}\r\n      {if isset($category->data) && count($category->data)}\r\n        <div class="product_detail_category_fields">\r\n        <strong>{$mod->Lang(''data'')}</strong><br/>\r\n        {foreach from=$category->data item=''onedataitem''}\r\n           <div class="product_detail_category_onefield">\r\n           {if $onedataitem.field_type == ''image''}\r\n             <a href="{$category->file_location}/{$onedataitem.field_value}"><img src="{$category->file_location}/thumb_{$onedataitem.field_value}" alt="thumb" /></a>\r\n           {elseif $onedataitem.field_type == ''file''}\r\n             <a href="{$category->file_location}/{$onedataitem.field_value}">{$onedataitem.field_value}</a>\r\n           {else}\r\n             <strong>{$onedataitem.field_prompt}</strong>: {$onedataitem.field_value}<br/>\r\n           {/if}\r\n           </div>\r\n        {/foreach}\r\n        </div>\r\n      {/if}\r\n    </p></div> \r\n  {/foreach}\r\n{/if}\r\n\r\n{* include the cart *}\r\n{* NOTE:\r\n   If you have added a custom field with the alias ''stock'' you could use the following expression to handle out of stock items\r\n   {cge_have_module m=''CGEcommerceBase'' assign=''tmp''}\r\n   {if $tmp}\r\n     {if $entry.fields.stock->value le 0}\r\n       <p>Note: This item is currently out of stock, however we are expecting a new shipment shortly.  Please check back again soon.</p>\r\n     {else}\r\n       <div>\r\n       {cgecomm_form_addtocart product=$entry->id} \r\n       </div>\r\n     {/if}\r\n   {/if}\r\n*}\r\n{cge_have_module m=''CGEcommerceBase'' assign=''tmp''}\r\n{if $tmp}\r\n<div>\r\n{cgecomm_form_addtocart product=$entry->id} \r\n</div>\r\n{/if}\r\n\r\n{* create a link back to the top of the page *}\r\n{anchor anchor=''product_name'' text=$products->Lang(''return_to_top'') title=$products->Lang(''return_to_top'')}\r\n\r\n</div>\r\n', NULL, NULL),
('Products_mapi_pref_products_pref_dfltdetail_template', 'main', NULL, NULL),
('Products_mapi_pref_products_pref_newbyhierarchy_template', '{* hierarchy report template *}\r\n{if !isset($hdepth) && isset($hierarchy_item)}\r\n<h3>Hierarchy Data for {$hierarchy_item.name} ({$hierarchy_item.id})</h3>\r\n{/if}\r\n\r\n{if !isset($hdepth)}{assign var=''hdepth'' value=''0''}{/if}\r\n{*\r\n // create a nested set of unordered lists \r\n // if the active_hierarchy smarty variable exists\r\n // and matches the current hierarchy id\r\n // the active class will be given\r\n // to the ul.  You may want to modify your summary template\r\n // to set this variable\r\n*}\r\n<ul class="products_hierarchy_level{$hdepth}">\r\n{foreach from=$hierdata key=''key'' item=''item''}\r\n{strip}\r\n  <li {if isset($active_hierarchy) and $item.id == $active_hierarchy} class="active"{/if}>\r\n  {if $item.count gt 0}\r\n     <a href="{$item.url}">{$item.name} ({$item.count})</a>\r\n  {else}\r\n     {$item.name} ({$item.count})\r\n  {/if}\r\n  \r\n  {if isset($item.children) }\r\n    {* there are children call this template again *}\r\n    {include file=$smarty.template hierdata=$item.children hdepth=$hdepth+1}\r\n  {/if}\r\n  \r\n  </li>\r\n{/strip}\r\n{/foreach}\r\n</ul>\r\n', NULL, NULL),
('Products_mapi_pref_products_pref_dfltbyhierarchy_template', 'top', NULL, NULL),
('Products_mapi_pref_products_pref_newcategorylist_template', '<div class="products_category_list">\r\n{foreach from=$categorylist item=''obj''}\r\n  <div class="products_category">\r\n    {* category fields are available as an array in $obj->fields *}\r\n    {* i.e: $obj->fields.fieldname.field_value *}\r\n    {if isset($obj->fields)}\r\n    {foreach from=$obj->fields key=''field_name'' item=''fielddata''}\r\n      <div class="products_category_field">\r\n        {$fielddata.field_prompt} = {$fielddata.field_value}\r\n      </div>\r\n    {/foreach}\r\n    {/if}\r\n    {if isset($obj->detail_url)}\r\n      <a href="{$obj->detail_url}">Details For {$obj->name}</a>&nbsp;&nbsp;\r\n    {/if}\r\n    <a href="{$obj->summary_url}">Products Matching {$obj->name}</a>({$obj->count})\r\n  </div>\r\n{/foreach}\r\n</div>\r\n', NULL, NULL),
('Products_mapi_pref_products_pref_dfltcategorylist_template', 'Sample', NULL, NULL),
('Products_mapi_pref_products_pref_newsearch_template', '{* search template *}\r\n{* valid fields are:\r\n   {$actionid}cd_submit    - (string) for a submit button\r\n   {$actionid}cd_cancel    - (string) for a cancel button\r\n   {$actionid}cd_prodname  - (string) for text field to search against product name\r\n   {$actionid}cd_proddesc  - (string) for text field to search against product description.\r\n   {$actionid}cd_prodprice - (select) for price searching.\r\n     options must be of type string with high low limits separated by a :\r\n     i.e:   1000:2000\r\n     a special value of -1 can be used to indicate any price.\r\n   {$actionid}cd_prodprice_min - (string) for minimum price value\r\n   {$actionid}cd_prodprice_max - (string) for minimum price value\r\n     note: it is possible to specify only one of prodprice_min or prodprice_max\r\n     if either prodprice_min or prodprice_max is specified, prodprice is ignored.\r\n   {$actionid}cd_allany    - (int) to indicate wether all of the \r\n     conditions much match, or if any one of them may.\r\n   {$actionid}cd_prodvalue - (array) field values.\r\n   {$actionid}cd_prodvalue_<fldname>_min - Minimum value to search for for in the <fldname> field.\r\n   {$actionid}cd_prodvalue_<fldname>_max - Maximum value to search for for in the <fldname> field.\r\n*}\r\n\r\n<div id="prod_searchform">\r\n{$formstart}\r\n\r\n<div class="row">\r\n  <p class="row_prompt">{$mod->Lang(''search_expr'')}:</p>\r\n  <p class="row_input">\r\n    <select name="{$actionid}cd_allany">\r\n      <option value="0">{$mod->Lang(''all'')}</option>\r\n      <option value="1">{$mod->Lang(''any'')}</option>\r\n    </select>\r\n  </p>\r\n</div>\r\n\r\n<div class="row">\r\n  <p class="row_prompt">{$mod->Lang(''search_name'')}:</p>\r\n  <p class="row_input">\r\n    <input type="text" name="{$actionid}cd_prodname" size="40" maxlength="255"/>\r\n  </p>\r\n</div>\r\n\r\n<div class="row">\r\n  <p class="row_prompt">{$mod->Lang(''search_description'')}:</p>\r\n  <p class="row_input">\r\n    <input type="text" name="{$actionid}cd_proddesc" size="40" maxlength="255"/>\r\n  </p>\r\n</div>\r\n\r\n<div class="row">\r\n  <p class="row_prompt">{$mod->Lang(''search_price'')}:</p>\r\n  <p class="row_input">\r\n    <select name="{$actionid}cd_prodprice">\r\n      <option value="-1">{$mod->Lang(''any'')}</option>\r\n      <option value="0:99.99">Less Than $100</option>\r\n      <option value="100:999.99">$100 to $1000</option>\r\n      <option value="1000:9999.99">$1000 to $10000</option>\r\n      <option value="10000:9999999">Greater than $10000</option>\r\n    </select>\r\n  </p>\r\n</div>\r\n\r\n{if isset($searchprops)}\r\n{foreach from=$searchprops key=''fldname'' item=''obj''}\r\n<div class="row">\r\n  <p class="row_prompt">{$obj->prompt}:</p>\r\n  <p class="row_input">\r\n    {if $obj->type == ''text''}\r\n      <input type="text" name="{$actionid}cd_prodvalue[{$fldname}]" size="40" maxlength="40"/>\r\n    {else if $obj->type == ''dropdown''}\r\n      <select name="{$actionid}cd_prodvalue[{$fldname}]">\r\n      {html_options options=$obj->options}\r\n      </select>\r\n    {/if}\r\n  </p>\r\n</div>\r\n{/foreach}\r\n{/if}\r\n\r\n<div class="row">\r\n  <p class="row_prompt"></p>\r\n  <p class="row_input">\r\n    <input type="submit" name="{$actionid}cd_submit" value="{$mod->Lang(''submit'')}"/>\r\n    <input type="submit" name="{$actionid}cd_cancel" value="{$mod->Lang(''cancel'')}"/>\r\n  </p>\r\n</div>\r\n\r\n\r\n{$formend}\r\n</div>{* prod_searchform *}', NULL, NULL),
('Products_mapi_pref_products_pref_dfltsearch_template', 'Sample', NULL, NULL),
('Products_mapi_pref_products_currencysymbol', '$', NULL, NULL),
('Products_mapi_pref_products_weightunits', 'kg', NULL, NULL),
('Products_mapi_pref_allowed_imagetypes', 'jpg,jpeg,gif,png', NULL, NULL),
('Products_mapi_pref_allowed_filetypes', 'pdf,doc,txt,jpg,jpeg,gif,png', NULL, NULL),
('Products_mapi_pref_autothumbnail', '1', NULL, NULL),
('Products_mapi_pref_deleteproductfiles', '1', NULL, NULL),
('Products_mapi_pref_default_taxable', '1', NULL, NULL),
('Products_mapi_pref_default_status', 'published', NULL, NULL),
('Products_mapi_pref_detailpage', '-1', NULL, NULL),
('Products_mapi_pref_hierpage', '-1', NULL, NULL),
('Products_mapi_pref_prettyhierurls', '0', NULL, NULL),
('Products_mapi_pref_sortorder', 'asc', NULL, NULL),
('Products_mapi_pref_summary_newdefault', '0', NULL, NULL),
('Products_mapi_pref_summary_pagelimit', '12', NULL, NULL),
('Products_mapi_pref_sortby', 'order_hierarchy', NULL, NULL),
('Products_mapi_pref_products_lengthunits', 'in', NULL, NULL),
('Products_mapi_pref_auto_thumbnail_size', '75', NULL, NULL),
('Products_mapi_pref_autopreviewimg', '0', NULL, NULL),
('Products_mapi_pref_auto_previewimg_size', '150', NULL, NULL),
('Products_mapi_pref_autowatermark', 'none', NULL, NULL),
('Products_mapi_pref_kalbos', 'lt,en', NULL, NULL),
('Products_mapi_pref_curency_field_lt', '', NULL, NULL),
('Products_mapi_pref_pvm_field_lt', '', NULL, NULL),
('Products_mapi_pref_summary_page_field_lt', '437', NULL, NULL),
('Products_mapi_pref_summary_page_names_field_lt', 'Produktai', NULL, NULL),
('Products_mapi_pref_price_field', '', NULL, NULL),
('Products_mapi_pref_akcija_field', '', NULL, NULL),
('Products_mapi_pref_laukeliu_grupes', 'Filter', NULL, NULL),
('Products_mapi_pref_pavadinimas_field', 'pavadinimas', NULL, NULL),
('Products_mapi_pref_use_detailpage_for_search', '0', NULL, NULL),
('Products_mapi_pref_usehierpathurls', '0', NULL, NULL),
('Products_mapi_pref_prodnotfound', 'domsg', NULL, NULL),
('Products_mapi_pref_prodnotfoundmsg', 'The requested item could not be found', NULL, NULL),
('Products_mapi_pref_prodnotfoundpage', '-1', NULL, NULL),
('Products_mapi_pref_skurequired', '0', NULL, NULL),
('Products_mapi_pref_detail_page_field_lt', '437', NULL, NULL),
('Products_mapi_pref_detail_page_names_field_lt', 'Produktas', NULL, NULL),
('Products_mapi_pref_curency_field_en', '', NULL, NULL),
('Products_mapi_pref_pvm_field_en', '', NULL, NULL),
('Products_mapi_pref_summary_page_field_en', '510', NULL, NULL),
('Products_mapi_pref_summary_page_names_field_en', 'Products', NULL, NULL),
('Products_mapi_pref_detail_page_field_en', '510', NULL, NULL),
('Products_mapi_pref_detail_page_names_field_en', 'Product', NULL, NULL),
('Products_mapi_pref_empty_fields', 'pasirinkite,choose', NULL, NULL),
('MenuManager_mapi_pref_default_template', 'topmenu', NULL, NULL),
('CGSmartImage_mapi_pref_responsive', '0', NULL, NULL),
('CGSmartImage_mapi_pref_responsive_breakpoints', '', NULL, NULL),
('Filelists_mapi_pref_allow_add', '1', NULL, NULL),
('Filelists_mapi_pref_kalbos', 'lt,en', NULL, NULL),
('Filelists_mapi_pref_pg_field_lt', '459', NULL, NULL),
('Filelists_mapi_pref_admin_email', '', NULL, NULL),
('Filelists_mapi_pref_calendar_mail', '', NULL, NULL),
('Filelists_mapi_pref_calendar_pass', '', NULL, NULL),
('Filelists_mapi_pref_pg_field_en', '494', NULL, NULL),
('Languages_mapi_pref_allow_add', '0', NULL, NULL),
('Languages_mapi_pref_launguage_list', 'lt,en', NULL, NULL),
('Languages_mapi_pref_main_language', 'lt', NULL, NULL),
('Cataloger_mapi_pref_item_image_count', '10', NULL, NULL),
('Cataloger_mapi_pref_item_file_count', '0', NULL, NULL),
('Cataloger_mapi_pref_item_file_types', 'pdf,swf,flv,doc,odt,ods,xls', NULL, NULL),
('Cataloger_mapi_pref_category_image_count', '1', NULL, NULL),
('Cataloger_mapi_pref_item_image_size_hero', '400', NULL, NULL),
('Cataloger_mapi_pref_item_image_size_thumbnail', '70', NULL, NULL),
('Cataloger_mapi_pref_category_image_size_hero', '400', NULL, NULL),
('Cataloger_mapi_pref_category_image_size_thumbnail', '90', NULL, NULL),
('Cataloger_mapi_pref_item_image_size_category', '70', NULL, NULL),
('Cataloger_mapi_pref_item_image_size_catalog', '100', NULL, NULL),
('Cataloger_mapi_pref_force_aspect_ratio', '0', NULL, NULL),
('Cataloger_mapi_pref_image_aspect_ratio', '4:3', NULL, NULL),
('Cataloger_mapi_pref_category_recurse', 'mixed_one', NULL, NULL),
('Cataloger_mapi_pref_category_sort_order', 'natural', NULL, NULL),
('Cataloger_mapi_pref_category_items_per_page', '1000', NULL, NULL),
('Cataloger_mapi_pref_show_extant', '1', NULL, NULL),
('Cataloger_mapi_pref_flush_cats', '0', NULL, NULL),
('Cataloger_mapi_pref_image_upload_path', '/images/catalog_src', NULL, NULL),
('Cataloger_mapi_pref_file_upload_path', '/catalogerfiles', NULL, NULL),
('Cataloger_mapi_pref_image_proc_path', '/images/catalog', NULL, NULL),
('Cataloger_mapi_pref_show_missing', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_templates`
--

CREATE TABLE IF NOT EXISTS `cms_templates` (
  `template_id` int(11) NOT NULL,
  `template_name` varchar(160) DEFAULT NULL,
  `template_content` text,
  `stylesheet` text,
  `encoding` varchar(25) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `default_template` tinyint(4) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`template_id`),
  KEY `cms_index_templates_by_template_name` (`template_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_templates`
--

INSERT INTO `cms_templates` (`template_id`, `template_name`, `template_content`, `stylesheet`, `encoding`, `active`, `default_template`, `create_date`, `modified_date`) VALUES
(25, 'footer', '{*}\n        {#sukurta#}:  <a href="http://www.texus.lt" target="_blank">Texus</a>\n    	{global_content name="footer_$kalba"}	\n{*}		', '', '', 1, 0, '2013-02-11 13:33:26', '2014-11-29 12:26:38'),
(26, 'titulinis', '{assign var="titulinis" value=1}\n\n{cms_include tpl="header"}\n{*}\n{Titulinis kategorija="foto" kalba=$kalba}\n{News summarytemplate="title_page" detailpage=$smarty.config.mews_inside_page category="`$kalba` *"}\n{Titulinis kategorija="blokai" kalba=$kalba}\n{*}\n\n{cms_include tpl="footer"}\n \n', '', '', 1, 0, '2013-02-11 13:33:40', '2014-11-29 12:26:38'),
(46, 'vidinis', '{assign var="vidinis" value=1}	\n{cms_include tpl="header"}\n\n<div class="path_block">\n    <div class="go_back_place fr">\n        <a href="#" class="go_back">{#atgal#}</a>\n    </div>\n    <ul class="path">\n        <li>{Breadcrumbs delimiter="</li><li>"}</li>\n    </ul>\n</div>\n<div class="section">\n	<h1 class="main_title">{title}</h1>\n    {menu template="side_meniu" start_level=4 number_of_levels="1" assign="leftmenu"}\n    {$leftmenu}\n    <div id="mainbar">\n    	{content_module block="filepicker_block" module="GBFilePicker" label="Puslapio foninis paveiksliukas" allow_scaling="false" mode="browser" dir="images/pages/" assign="page_background_image"}\n    	{content}\n		{content block="gallery" label="Galerija" oneline="1" assign="gallery"}\n		{if $gallery}\n			{Gallery dir=$gallery}\n		{/if}\n		\n		{if $show_map == 1}\n			{$kalba|mapc:"1":"100%,300px":"54.725956, 25.295587":0:0:$smarty.config.zemelapis:$smarty.config.zemelapis2}\n		{/if}\n    </div>\n</div>\n{if $page_background_image}\n    {literal}\n        <style>\n            #page{\n                background:url(/uploads/{/literal}{$page_background_image}{literal}) center center no-repeat;\n                background-size:cover;\n                background-attachment:fixed\n            }\n        </style>\n    {/literal}\n{/if}				\n{cms_include tpl="footer"}', '', '', 1, 1, '2014-03-30 21:56:49', '2014-11-11 16:55:45'),
(24, 'header', '{process_pagedata}\n{capture assign="kalbumeniu"}\n    {menu template="lang" number_of_levels="1"}\n{/capture}\n{if $kalba != ''''}\n	{config_load file="../../tmp/languages/`$kalba`.conf" section = "strings" scope="global"}\n{/if}\n\n<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<!--[if lt IE 7]>      <html xmlns="http://www.w3.org/1999/xhtml" class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->\n<!--[if IE 7]>         <html xmlns="http://www.w3.org/1999/xhtml" class="lt-ie9 lt-ie8"> <![endif]-->\n<!--[if IE 8]>         <html xmlns="http://www.w3.org/1999/xhtml" class="lt-ie9"> <![endif]-->\n<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->\n<html xmlns="http://www.w3.org/1999/xhtml">\n<head>\n    <title>{title} - {sitename}</title>\n    <base href="{root_url}"/>\n    {metadata}\n\n{*}\n    <script src="/js/plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>\n    <script src="/js/plugins/fancybox/helpers/jquery.fancybox-media.js" type="text/javascript"></script>\n    <link rel="stylesheet" type="text/css" href="js/plugins/fancybox/jquery.fancybox.css" />\n    <script src="/js/plugins/fancybox/launch.js" type="text/javascript"></script>\n    <script type="text/javascript">\n        var user_name = ''{#user_name#}'';\n        var user_pass = ''{#user_pass#}'';\n    </script>\n{*}\n</head>\n\n<body>\n        	{*}\n				<a href="/{if $kalba !="lt"}{$kalba}/{/if}" class="logo"></a>\n            	{$kalbumeniu}\n                {menu template="topmenu" start_element=$smarty.config.topmenu number_of_levels="2"}\n				{Products action="hierarchy"}\n			{*}', '', '', 1, 0, '2013-02-11 13:27:59', '2014-11-29 12:26:38'),
(48, 'tuscias', '{content}', '', '', 1, 0, '2014-04-25 21:57:31', '2014-07-30 13:30:38'),
(52, 'products', '{assign var="vidinis" value=1}	\n{cms_include tpl="header"}\n{*}\n    <ul class="path">\n        <li>{cms_selflink page=$kalba menu=1}</li><li>{products_hierarchy_breadcrumb delim="</li><li>" hierarchyid=$active_hierarchy kalba=$kalba last_no_link=1}</li>\n    </ul>\n{*}\n{*}\n	{if $cat_page == 1}\n		{Products action="hierarchy" hierarchytemplate="cat_page" parent=$parent}\n	{else}\n		<div id="sidebar">\n			{if $its_a_f_product > 0}\n				{Products action="hierarchy" hierarchytemplate="side_menu" parent=$parent}\n			{else}\n				{Products action="hierarchy" hierarchytemplate="side_menu" parent=$parent2}\n			{/if}\n			</br>\n			{Products action="filter"}\n		</div>\n		<div id="mainbar">\n			{content}\n		</div>\n	{/if}\n{*}	\n{cms_include tpl="footer"}', '', '', 1, 0, '2014-08-05 14:00:53', '2014-11-29 12:26:38');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_templates_seq`
--

CREATE TABLE IF NOT EXISTS `cms_templates_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_templates_seq`
--

INSERT INTO `cms_templates_seq` (`id`) VALUES
(54);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_test`
--

CREATE TABLE IF NOT EXISTS `cms_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `ID` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_test`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_testt`
--

CREATE TABLE IF NOT EXISTS `cms_testt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `ID` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_testt`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_tx_form`
--

CREATE TABLE IF NOT EXISTS `cms_tx_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(255) DEFAULT NULL,
  `formid` varchar(255) DEFAULT NULL,
  `formname` varchar(255) DEFAULT NULL,
  `formalias` varchar(255) DEFAULT NULL,
  `formtpl` varchar(255) DEFAULT NULL,
  `sendbyemail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `storedb` tinyint(1) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Sukurta duomenų kopija lentelei `cms_tx_form`
--

INSERT INTO `cms_tx_form` (`id`, `userid`, `formid`, `formname`, `formalias`, `formtpl`, `sendbyemail`, `storedb`) VALUES
(1, 1, '1', 'Užklausa', 'uzklausa', 'uzklausa', 'vytautas.p@gmail.com', 0),
(4, 1, '4', 'Produkto užklausa', 'prod_uzklausa', 'prod_uzklausa', 'aqua3man@gmail.com', 1),
(5, 4, '5', 'Karjera', 'karjera', 'karjera', 'a.rudzianskas@precizika.lt', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_tx_n_titulinis`
--

CREATE TABLE IF NOT EXISTS `cms_tx_n_titulinis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `antraste` varchar(255) DEFAULT NULL,
  `pavadinimas` varchar(255) NOT NULL,
  `tekstas` text,
  `nuoroda` varchar(255) DEFAULT NULL,
  `tipas` varchar(199) NOT NULL,
  `kalba` varchar(255) DEFAULT NULL,
  `eiliskumas` int(5) DEFAULT NULL,
  `nerodyti` tinyint(1) DEFAULT '0',
  `del` tinyint(1) DEFAULT '0',
  `kategorija` varchar(255) DEFAULT NULL,
  `paveiksliukas` varchar(244) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Sukurta duomenų kopija lentelei `cms_tx_n_titulinis`
--

INSERT INTO `cms_tx_n_titulinis` (`id`, `antraste`, `pavadinimas`, `tekstas`, `nuoroda`, `tipas`, `kalba`, `eiliskumas`, `nerodyti`, `del`, `kategorija`, `paveiksliukas`) VALUES
(1, NULL, '', NULL, NULL, '', NULL, NULL, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_userplugins`
--

CREATE TABLE IF NOT EXISTS `cms_userplugins` (
  `userplugin_id` int(11) NOT NULL,
  `userplugin_name` varchar(255) DEFAULT NULL,
  `code` text,
  `description` text,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`userplugin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_userplugins`
--

INSERT INTO `cms_userplugins` (`userplugin_id`, `userplugin_name`, `code`, `description`, `create_date`, `modified_date`) VALUES
(1, 'user_agent', '//Code to show the user''s user agent information.\necho $_SERVER["HTTP_USER_AGENT"];', 'Code to show the users user agent information', '2006-07-25 21:22:33', '2014-07-30 13:30:38'),
(2, 'custom_copyright', '//set start to date your site was published\n$startCopyRight=''2004'';\n\n// check if start year is this year\nif(date(''Y'') == $startCopyRight){\n// it was, just print this year\n    echo $startCopyRight;\n}else{\n// it wasnt, print startyear and this year delimited with a dash\n    echo $startCopyRight.''-''. date(''Y'');\n}', 'Code to output copyright information', '2006-07-25 21:22:33', '2014-07-30 13:30:38');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_userplugins_seq`
--

CREATE TABLE IF NOT EXISTS `cms_userplugins_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_userplugins_seq`
--

INSERT INTO `cms_userplugins_seq` (`id`) VALUES
(2);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_userprefs`
--

CREATE TABLE IF NOT EXISTS `cms_userprefs` (
  `user_id` int(11) NOT NULL,
  `preference` varchar(50) NOT NULL,
  `value` text,
  `type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`preference`),
  KEY `cms_index_userprefs_by_user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_userprefs`
--

INSERT INTO `cms_userprefs` (`user_id`, `preference`, `value`, `type`) VALUES
(1, 'use_wysiwyg', '1', NULL),
(1, 'default_cms_language', 'lt_LT', NULL),
(1, 'date_format_string', '%x %X', NULL),
(1, 'admintheme', 'OneEleven', NULL),
(1, 'bookmarks', '1', NULL),
(1, 'recent', 'on', NULL),
(1, 'indent', '1', NULL),
(1, 'ajax', '0', NULL),
(1, 'paging', '0', NULL),
(1, 'hide_help_links', '0', NULL),
(1, 'wysiwyg', 'TinyMCE', NULL),
(1, 'collapse', '0=1.173=1.264=1.436=1.434=1.399=1.459=1.435=1.15=1.430=1.471=1.472=1.484=1.490=1.494=1.502=1.509=1.1=1.4=1.', NULL),
(1, 'gcb_wysiwyg', '1', NULL),
(1, 'syntaxhighlighter', '-1', NULL),
(1, 'enablenotifications', '1', NULL),
(1, 'default_parent', '-1', NULL),
(1, 'homepage', '', NULL),
(1, 'listtemplates_pagelimit', '20', NULL),
(1, 'liststylesheets_pagelimit', '20', NULL),
(1, 'listgcbs_pagelimit', '20', NULL),
(1, 'ignoredmodules', '', NULL),
(1, 'filemanager_cwd', 'uploads/pdf', NULL),
(1, 'products_sel_hierarchy', '', NULL),
(1, 'products_sel_children', '0', NULL),
(1, 'products_sel_pagelimit', '25', NULL),
(1, 'products_sel_sortby', 'create_date', NULL),
(1, 'products_sel_sortorder', 'desc', NULL),
(1, 'products_sel_customfields', '', NULL),
(1, 'products_sel_categories', '', NULL),
(1, 'products_sel_excludecats', '0', NULL),
(4, 'wysiwyg', 'TinyMCE', NULL),
(4, 'default_cms_language', 'lt_LT', NULL),
(4, 'admintheme', 'OneEleven', NULL),
(4, 'bookmarks', '1', NULL),
(4, 'recent', 'on', NULL),
(4, 'collapse', '15=1.173=1.399=1.436=1.0=1.471=1.472=1.484=1.490=1.494=1.502=1.264=1.434=1.459=1.430=1.', NULL),
(4, 'filemanager_cwd', 'uploads/TxForm', NULL),
(4, 'products_sel_hierarchy', '', NULL),
(4, 'products_sel_children', '0', NULL),
(4, 'products_sel_pagelimit', '25', NULL),
(4, 'products_sel_sortby', 'create_date', NULL),
(4, 'products_sel_sortorder', 'desc', NULL),
(4, 'products_sel_customfields', '', NULL),
(4, 'products_sel_categories', '', NULL),
(4, 'products_sel_excludecats', '0', NULL),
(4, 'products_sel_search_box', '', NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_users`
--

CREATE TABLE IF NOT EXISTS `cms_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `admin_access` tinyint(4) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_users`
--

INSERT INTO `cms_users` (`user_id`, `username`, `password`, `admin_access`, `first_name`, `last_name`, `email`, `active`, `create_date`, `modified_date`) VALUES
(1, 'admin', 'baf788be51d48746a4b2e464c446ae37', 1, '', '', 'info@texus.lt', 1, '2006-07-25 21:22:33', '2009-05-13 07:43:16'),
(4, 'clientusr', '961698f45132707576c08add97e2287c', 1, 'Precizika', '', '', 1, '2014-09-01 13:08:49', '2014-11-29 11:32:57');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_users_seq`
--

CREATE TABLE IF NOT EXISTS `cms_users_seq` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_users_seq`
--

INSERT INTO `cms_users_seq` (`id`) VALUES
(4);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_user_groups`
--

CREATE TABLE IF NOT EXISTS `cms_user_groups` (
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_user_groups`
--

INSERT INTO `cms_user_groups` (`group_id`, `user_id`, `create_date`, `modified_date`) VALUES
(1, 1, '2006-07-25 21:22:33', '2006-07-25 21:22:33'),
(1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_uzklausa`
--

CREATE TABLE IF NOT EXISTS `cms_uzklausa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vardas` varchar(255) NOT NULL,
  `telefonas` varchar(255) NOT NULL,
  `el_pastas` varchar(255) NOT NULL,
  `zinute` text NOT NULL,
  UNIQUE KEY `ID` (`id`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `id_3` (`id`),
  UNIQUE KEY `id_4` (`id`),
  UNIQUE KEY `id_5` (`id`),
  UNIQUE KEY `id_6` (`id`),
  UNIQUE KEY `id_7` (`id`),
  UNIQUE KEY `id_8` (`id`),
  UNIQUE KEY `id_9` (`id`),
  UNIQUE KEY `id_10` (`id`),
  UNIQUE KEY `id_11` (`id`),
  UNIQUE KEY `id_12` (`id`),
  UNIQUE KEY `id_13` (`id`),
  UNIQUE KEY `id_14` (`id`),
  UNIQUE KEY `id_15` (`id`),
  UNIQUE KEY `id_16` (`id`),
  UNIQUE KEY `id_17` (`id`),
  UNIQUE KEY `id_18` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `cms_uzklausa`
--


-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `cms_version`
--

CREATE TABLE IF NOT EXISTS `cms_version` (
  `version` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `cms_version`
--

INSERT INTO `cms_version` (`version`) VALUES
(36);
