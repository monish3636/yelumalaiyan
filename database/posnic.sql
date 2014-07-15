-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2014 at 11:30 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `posnic`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(40) NOT NULL,
  `country` varchar(50) NOT NULL,
  `website` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_location` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `tax_cst` varchar(100) NOT NULL,
  `tax_gst` varchar(100) NOT NULL,
  `tax_reg` varchar(255) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `guid`, `code`, `store_name`, `address`, `city`, `state`, `zip`, `country`, `website`, `phone`, `email`, `fax`, `bank_name`, `bank_location`, `account_number`, `tax_cst`, `tax_gst`, `tax_reg`, `active_status`, `delete_status`, `deleted_by`) VALUES
(1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'BRC-102', 'PIZZA HUT', 'sgsdg', 'sdgsd', 'ssdag', 'sdag', 'sdagdsagasd', 'asdgsadgsda', '90890890', 'jibigopi007@gmail.com', '436436346', '', '', '', '', '', '', 1, 0, ''),
(2, 'BE4CB6FB-9D0F2307d083b4dc2d647', 'BRC-103', 'K F C', '', '', '', '', '', '', '0980980980', '', '', '', '', '', '', '', '', 1, 0, ''),
(5, '649866515edf661bb321ec7bf0ba3415', 'BCH-1010', 'Kottayam', '133', 'kottayam', 'kerala', '686509', 'india', '', '88898989', 'jibi344443@yahoo.com', '', '', '', '', '', '', '', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branches_x_payment_modes`
--

CREATE TABLE IF NOT EXISTS `branches_x_payment_modes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` varchar(255) DEFAULT NULL,
  `pay_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `guid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` int(100) NOT NULL,
  `deleted_by` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `guid`, `name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'cfd8b485f99e561408192c594f8c2e92', 'LG', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 61),
(2, '1642d900f6768119e3dd75bbf8ed0fc2', 'Nokia', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, 61),
(3, '11d08dc2db3920364304c6ed1192b5ba', 'THOSHIBA', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, 61),
(4, '0a1db6b7e58b53971b12790f10e27d60', 'Samsung', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 0, 61),
(5, '90642ff56db4789380d00acae0f053fd', 'AXE1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(6, 'd270d314cf6ccee8c618495e9feba4ff', 'Mentos', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 61),
(7, 'a85e2c85b10bd213c8b876acfa8aa7a5', 'Silverex', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(8, '6a3fba30105e2894ff21a1bef6443300', 'LG', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(9, 'db336d9ef0d8a4b64a17cef1a0b91c6e', 'Notng', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 61),
(10, '99cb6ba01684b50fa56b573351b11b84', 'sasi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 61, 61),
(11, 'f2e56b486bcd555842563ec7b58c62c3', 'Onida1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 61),
(12, '8974ee8c5efa331e1a241d5134d8a1d6', 'monish', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 61, 61),
(13, '4d0e175adce4c2a647de47e0f75bb5e8', 'sasi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 61, 61),
(14, '36840ac524c7bfbe92498f06c0ed35f8', 'dasdasf', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, 61, 0),
(15, '4363cdfeb27784549d2d4f5e4782177e', 'sdsgsg', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(16, 'd7f081c1498b201c98be6e29536b5e51', 'Samsung1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(17, '9287313f27fdacb23e712e95cb16ef35', 'sdfgsd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 61, 61),
(18, '82aaba1ac1310efc57ef159f97cf7d00', 'noki', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 61, 61),
(19, 'b75afe85b7eac44cbdae6094b67645aa', 'LG', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(20, 'a3b7bcbfe5771bf8333408e95b5f7e85', 'Brands', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(21, '5f88cfa9500bc70b9fd172182d528c73', 'brands 1', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(22, 'fb27c6720ef3b22ada9fa07edbf9bf53', 'brands 2', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(23, 'd00f4af34c53902b94fb87279f46c8e1', 'brands 3', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(24, '4801a0eeec002ae2d16247c0799b7f65', 'LG', '649866515edf661bb321ec7bf0ba3415', 1, 0, 61, 0),
(25, 'd51c7ac8c967290c2fe813a5a59ec147', 'asfasf', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(26, '7d8391e3542c6fc2607a0f9cad8898bd', 'sdgsdgs', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(27, 'ac30452fe7c91f89d2672bd783610b68', 'dsfgsd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 61, 0),
(28, 'c5c707b4d60443c00ca7f0df61664da2', 'my_test_category', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, 0),
(29, '6555d596a18df9e006f39e989289216b', 'Office', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, 0),
(30, 'fba4c0784fcd1caec0b1abf3702369e3', 'Home', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, 0),
(31, '096d500eb0488f6387bcc1c7b0d6893a', 'laptop', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` varchar(65000) NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('2348b12cb5144aebd8e52058ad03a1c7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0', 1405423064, 'a:131:{s:9:"user_data";s:0:"";s:2:"id";s:1:"3";s:4:"guid";s:36:"61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4";s:8:"username";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:10:"first_name";s:5:"admin";s:9:"last_name";s:5:"admin";s:7:"address";s:5:"slvpg";s:3:"sex";s:4:"Male";s:5:"blood";s:0:"";s:3:"age";s:2:"23";s:4:"city";s:9:"bangalore";s:5:"state";s:7:"karnada";s:3:"zip";s:6:"676809";s:7:"country";s:5:"india";s:5:"email";s:20:"jibi344443@yahoo.com";s:5:"phone";s:10:"7795398584";s:5:"image";s:0:"";s:3:"dob";s:9:"654739200";s:13:"active_status";s:1:"1";s:10:"created_by";s:2:"99";s:10:"deleted_by";s:1:"0";s:13:"delete_status";s:1:"0";s:9:"user_type";s:1:"2";s:14:"default_branch";s:1:"2";s:7:"Setting";a:2:{s:6:"Branch";s:1:"1";s:6:"Depart";s:1:"0";}s:9:"branch_id";s:36:"BE4CB6FB-276C-457A-9D0F-D7948222EBB3";s:9:"users_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:5:"users";i:5;}s:5:"users";s:2:"On";s:10:"brands_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:6:"brands";i:5;}s:6:"brands";s:2:"On";s:17:"items_setting_per";a:4:{s:6:"access";i:1;s:4:"read";i:1;s:3:"set";i:1;s:13:"items_setting";i:3;}s:13:"items_setting";s:2:"On";s:13:"item_code_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:9:"item_code";i:5;}s:9:"item_code";s:2:"On";s:9:"taxes_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:5:"taxes";i:5;}s:5:"taxes";s:2:"On";s:14:"taxes_area_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:10:"taxes_area";i:5;}s:10:"taxes_area";s:2:"On";s:18:"items_category_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:14:"items_category";i:5;}s:14:"items_category";s:2:"On";s:17:"tax_commodity_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:13:"tax_commodity";i:5;}s:13:"tax_commodity";s:2:"On";s:13:"tax_types_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:9:"tax_types";i:5;}s:9:"tax_types";s:2:"On";s:9:"items_per";a:8:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:6:"import";i:1;s:6:"export";i:1;s:5:"items";i:7;}s:5:"items";s:2:"On";s:13:"suppliers_per";a:8:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:6:"import";i:1;s:6:"export";i:1;s:9:"suppliers";i:7;}s:9:"suppliers";s:2:"On";s:21:"suppliers_x_items_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:17:"suppliers_x_items";i:5;}s:17:"suppliers_x_items";s:2:"On";s:13:"customers_per";a:8:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:6:"import";i:1;s:6:"export";i:1;s:9:"customers";i:7;}s:9:"customers";s:2:"On";s:21:"customer_category_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:17:"customer_category";i:5;}s:17:"customer_category";s:2:"On";s:15:"user_groups_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:11:"user_groups";i:5;}s:11:"user_groups";s:2:"On";s:12:"branches_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:8:"branches";i:5;}s:8:"branches";s:2:"On";s:26:"customers_payment_type_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:22:"customers_payment_type";i:5;}s:22:"customers_payment_type";s:2:"On";s:18:"purchase_order_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:14:"purchase_order";i:6;}s:14:"purchase_order";s:2:"On";s:20:"items_department_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:16:"items_department";i:5;}s:16:"items_department";s:2:"On";s:22:"suppliers_category_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:18:"suppliers_category";i:5;}s:18:"suppliers_category";s:2:"On";s:24:"goods_receiving_note_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:20:"goods_receiving_note";i:6;}s:20:"goods_receiving_note";s:2:"On";s:14:"direct_grn_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:10:"direct_grn";i:6;}s:10:"direct_grn";s:2:"On";s:20:"purchase_invoice_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:16:"purchase_invoice";i:6;}s:16:"purchase_invoice";s:2:"On";s:18:"direct_invoice_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:14:"direct_invoice";i:6;}s:14:"direct_invoice";s:2:"On";s:20:"supplier_payment_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:16:"supplier_payment";i:6;}s:16:"supplier_payment";s:2:"On";s:25:"purchase_order_cancel_per";a:3:{s:6:"access";i:1;s:3:"add";i:1;s:21:"purchase_order_cancel";i:2;}s:21:"purchase_order_cancel";s:2:"On";s:18:"stock_transfer_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:14:"stock_transfer";i:6;}s:14:"stock_transfer";s:2:"On";s:17:"opening_stock_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:13:"opening_stock";i:6;}s:13:"opening_stock";s:2:"On";s:16:"damage_stock_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:12:"damage_stock";i:6;}s:12:"damage_stock";s:2:"On";s:19:"sales_quotation_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:15:"sales_quotation";i:6;}s:15:"sales_quotation";s:2:"On";s:15:"sales_order_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:11:"sales_order";i:6;}s:11:"sales_order";s:2:"On";s:14:"sales_bill_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:10:"sales_bill";i:6;}s:10:"sales_bill";s:2:"On";s:16:"direct_sales_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:12:"direct_sales";i:6;}s:12:"direct_sales";s:2:"On";s:25:"direct_sales_delivery_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:21:"direct_sales_delivery";i:6;}s:21:"direct_sales_delivery";s:2:"On";s:16:"sales_return_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:12:"sales_return";i:6;}s:12:"sales_return";s:2:"On";s:19:"purchase_return_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:15:"purchase_return";i:6;}s:15:"purchase_return";s:2:"On";s:23:"sales_delivery_note_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:19:"sales_delivery_note";i:6;}s:19:"sales_delivery_note";s:2:"On";s:20:"customer_payment_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:16:"customer_payment";i:6;}s:16:"customer_payment";s:2:"On";s:19:"receiving_stock_per";a:3:{s:6:"access";i:1;s:4:"read";i:1;s:15:"receiving_stock";i:2;}s:15:"receiving_stock";s:2:"On";s:12:"language_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:8:"language";i:5;}s:8:"language";s:2:"On";s:13:"price_tag_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:9:"price_tag";i:5;}s:9:"price_tag";s:2:"On";s:17:"decomposition_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:13:"decomposition";i:6;}s:13:"decomposition";s:2:"On";s:22:"decomposition_type_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:18:"decomposition_type";i:5;}s:18:"decomposition_type";s:2:"On";s:23:"decomposition_items_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:19:"decomposition_items";i:6;}s:19:"decomposition_items";s:2:"On";s:12:"item_kit_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:8:"item_kit";i:6;}s:8:"item_kit";s:2:"On";s:16:"kit_category_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:12:"kit_category";i:5;}s:12:"kit_category";s:2:"On";s:15:"stock_level_per";a:4:{s:6:"access";i:1;s:4:"read";i:1;s:4:"edit";i:1;s:11:"stock_level";i:3;}s:11:"stock_level";s:2:"On";s:18:"keyboard_sales_per";a:5:{s:6:"access";i:1;s:4:"read";i:1;s:4:"sale";i:1;s:6:"return";i:1;s:14:"keyboard_sales";i:4;}s:14:"keyboard_sales";s:2:"On";s:15:"touch_sales_per";a:5:{s:6:"access";i:1;s:4:"read";i:1;s:4:"sale";i:1;s:6:"return";i:1;s:11:"touch_sales";i:4;}s:11:"touch_sales";s:2:"On";s:19:"summary_reports_per";a:3:{s:6:"access";i:1;s:3:"get";i:1;s:15:"summary_reports";i:2;}s:15:"summary_reports";s:2:"On";s:20:"detailed_reports_per";a:3:{s:6:"access";i:1;s:3:"get";i:1;s:16:"detailed_reports";i:2;}s:16:"detailed_reports";s:2:"On";s:11:"Posnic_User";s:5:"admin";s:10:"data_limit";i:20;}');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `title` varchar(10) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `bday` int(20) NOT NULL,
  `mday` int(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `credit_limit` int(100) NOT NULL,
  `cdays` int(100) NOT NULL,
  `month_credit_bal` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `added_date` int(20) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_location` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `cst` varchar(50) NOT NULL,
  `gst` varchar(50) NOT NULL,
  `tax_no` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `guid`, `branch_id`, `first_name`, `title`, `last_name`, `address`, `address2`, `bday`, `mday`, `city`, `state`, `zip`, `country`, `payment`, `credit_limit`, `cdays`, `month_credit_bal`, `category_id`, `comments`, `added_date`, `company_name`, `email`, `phone`, `account_number`, `bank_name`, `bank_location`, `website`, `cst`, `gst`, `tax_no`, `created_by`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(3, '0f7c80352b128f9a45d25e42d1ebd19e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'jibi', '1', 'gopi', 'sdsd', '', 0, 0, 'sdgsd', 'sdgsd', '44236', 'sdgsdg', '62913143b64724f3f2e19b611c0c52a1', 1, 0, '0', 'b0913b800960821c61b9e7426cc3f1b8', '0', 1404432000, 'rtweytwy', 'jibi344443@yahoo.com', '457457', '', '', '', 'wtyweyy', '', '', '', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, 'compan', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gopi', '1', 'papu', '78979', '', 1368316800, 1368403200, 'HSR Layout', '79879', '686509', 'india', 'caf6d38b8e02db86b3d41fd23a6439bb', 1200, 7987, '7987', 'b0913b800960821c61b9e7426cc3f1b8', '0', 1404432000, 'posnic', 'jibi@yahoo.com', '7795398584', 'ACT446546', '78979', '78979', 'www.posnic.com', '97987', '7987', '9878979', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '63aba6eb627ce1811191c2d22399191d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'Sridhar', '1', 'bala', '789789', '', 1390435200, 1390435200, '798', '798', '98798', '789', '22b29efa97369324e345614ab68b773f', 89, 89, '89', 'fe29e56d1e12ecaa33cff3242d8b8390', '0', 1404432000, 'posnic', 'sridharkalaibala@gmail.com', '798798', '78789khkjhk', 'Fedaral', 'bangalore', 'www.posnic.com', 'Tuy66876', '687687', '687687', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(8, '5315c17449a7324783c45ae3632f7487', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'Sridhar', '1', 'bala', 'bangalore', '', 508204800, 1436918400, 'BDA', 'karnataka', '87979', 'india', 'cb22f3b1c17a6b1df9d2090e945f0364', 78978, 78, '7879', 'b0913b800960821c61b9e7426cc3f1b8', '0', 1404432000, 'posnic', 'sridharkalaibala@gmail.com', '789879879', 'ACT789798', 'IDBI', 'HSR Layout', 'www.posnic.com', '7987987', '789798', '797897', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(9, 'ee6958cdd55bbe2225e4fec2cb6cc6ce', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8908', '1', '89080', 'iuyi', '', 0, 0, 'yiuy', 'uiyi', 'yiuyi', 'uiyui', '22b29efa97369324e345614ab68b773f', 0, 0, '', 'fe29e56d1e12ecaa33cff3242d8b8390', '0', 1404432000, '9809', 'jibi344443@yahoo.com', '89080', '', '', '', '890809', '', '', '', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(10, '98697027e52b1c4acc39d1e8e4dd2504', '649866515edf661bb321ec7bf0ba3415', 'jibi', '1', 'gopi', 'afsaf', '', 1401062400, 1401062400, 'fasf', 'af', 'asfasf', 'asf', '9f420fb73af2e79a50bad7178f1a0676', 0, 0, '', '7ac97c7d20603a3f20ab26c22fa0ff61', '0', 1404432000, '23523', 'jibi344443@yahoo.com', '5523', '', '', '', '5235235', '', '', '', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(11, '25cc73542ad26a05d2018c8912407ee3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'kuar', '', 'kuar', 'bangalore', '', 0, 0, 'bnaglore', 'karnataka', '89789', 'india', '', 0, 0, '', '', '', 1404432000, 'posnic', 'kuamr@yahoo.com', '7897798798', '', '', '', 'posnic', '', '', '', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(12, '6fe8ac28528fd39161f9566886ab8ce3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'kumar', '', 'kumar', 'bangalore', '', 0, 0, 'bnaglore', 'karnataka', '89789', 'india', '', 0, 0, '', '', '', 1404432000, 'posnic', 'kuamar@posnic.com', '7798544799', '', '', '', 'posnic', '', '', '', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(13, '6aa1fa54a005541ce84a7a4cbdb95ed4', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'said', '', 'said', 'uoi', '', 0, 0, 'baghh', 'hhg', 'ghj', 'india', '', 0, 0, '', '', '', 1404432000, 'posnic', 'sethu@posnic.com', '1236547890', '', '', '', 'posnic', '', '', '', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(14, '8a9c8f8eba2c03b8e73f156e41fc6a52', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'VINOD', '', 'VINOD', 'asfasf', '', 0, 0, 'aswqr', 'r', 'wqwr', 'qwqwr', '', 0, 0, '', '', '', 1404432000, 'rqwr', 'vinod@posnic.com', '9449103322', '', '', '', 'qrqwr', '', '', '', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers_payment_type`
--

CREATE TABLE IF NOT EXISTS `customers_payment_type` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customers_payment_type`
--

INSERT INTO `customers_payment_type` (`id`, `guid`, `type`, `branch_id`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'C56A2A7E-E8DE-43FD-BF05-1970CE5EC269', 'credit', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 1, 0, '', ''),
(2, '2639721dea1f5cd1c5557f41b4e65d46', 'Credit Only', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(3, '493fc9015775b69fb7b0c549a03cfc8a', 'cheques', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(4, '22b29efa97369324e345614ab68b773f', 'sdfgsd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(5, '62913143b64724f3f2e19b611c0c52a1', 'dfgdf', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, 'caf6d38b8e02db86b3d41fd23a6439bb', 'Credit Only', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, 'cb22f3b1c17a6b1df9d2090e945f0364', 'Cash Only', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, '257bac051a8154a0463d55c7aeacdbb2', 'fafasfas', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(9, '9f420fb73af2e79a50bad7178f1a0676', 'cash', '649866515edf661bb321ec7bf0ba3415', 1, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers_x_branches`
--

CREATE TABLE IF NOT EXISTS `customers_x_branches` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `branch_name` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `customer_active` int(11) NOT NULL,
  `customer_delete` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_category`
--

CREATE TABLE IF NOT EXISTS `customer_category` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `category_name` varchar(100) NOT NULL,
  `discount` decimal(10,3) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `customer_category`
--

INSERT INTO `customer_category` (`id`, `guid`, `branch_id`, `category_name`, `discount`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '7879977979777987', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'C-123', '0.000', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, 'b07822de514011f2e7ffc12692033acb', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'C-1233', '1.000', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(3, 'b0913b800960821c61b9e7426cc3f1b8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'Web sales1', '2.000', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, 'bbb619417f5a8add548cdd6af3b7c71a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'dsgsdgs', '0.000', 1, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '50dd8794a73be791efc0f38b018a14ef', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'fgfgh', '0.000', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(6, 'fe29e56d1e12ecaa33cff3242d8b8390', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'retails1', '1.200', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(7, 'f1a986ddfd820fae3f4496b2fb06ed04', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'NRI', '1.300', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(8, '7ac97c7d20603a3f20ab26c22fa0ff61', '649866515edf661bb321ec7bf0ba3415', 'Cat1', '2.000', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_payable`
--

CREATE TABLE IF NOT EXISTS `customer_payable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `amount` decimal(55,3) NOT NULL,
  `paid_amount` decimal(55,3) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0',
  `branch_id` varchar(255) NOT NULL,
  `guid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=159 ;

--
-- Dumping data for table `customer_payable`
--

INSERT INTO `customer_payable` (`id`, `invoice_id`, `customer_id`, `amount`, `paid_amount`, `payment_status`, `branch_id`, `guid`) VALUES
(158, '5c94445dbd8049f731a60a74c2467bb3', '0f7c80352b128f9a45d25e42d1ebd19e', '1029.000', '1029.000', 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2eeec83f63011ae493df6a6165c7296a');

-- --------------------------------------------------------

--
-- Table structure for table `damage_stock`
--

CREATE TABLE IF NOT EXISTS `damage_stock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `remark` varchar(300) NOT NULL,
  `note` varchar(300) NOT NULL,
  `no_items` int(11) NOT NULL,
  `total_amount` decimal(30,3) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `stock_status` int(11) NOT NULL DEFAULT '0',
  `branch_id` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `damage_stock`
--

INSERT INTO `damage_stock` (`id`, `guid`, `code`, `date`, `remark`, `note`, `no_items`, `total_amount`, `active_status`, `delete_status`, `stock_status`, `branch_id`, `deleted_by`, `added_by`) VALUES
(34, '450ee7d2ef0887e6fde9456d39742687', 'DS-122', 1400198400, 'gsdgsdg', 'xdcfsd', 1, '504.900', 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(35, '65b17692b9ae489b0ec473e00714e7d6', 'DS-123', 1400198400, 'gsdg', 'sdfsd', 1, '4590.000', 0, 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(36, '12b0ae76b49f38ab9115ca796113b5ca', 'DS-124', 1400198400, 'asfas', 'sadsa', 2, '5790.000', 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `damage_stock_x_items`
--

CREATE TABLE IF NOT EXISTS `damage_stock_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `damage_stock_id` varchar(255) NOT NULL,
  `stocks_history_id` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quty` int(11) NOT NULL,
  `cost` decimal(30,3) NOT NULL,
  `sell` decimal(30,3) NOT NULL,
  `tax` decimal(30,3) NOT NULL,
  `amount` decimal(30,3) NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `damage_stock_x_items`
--

INSERT INTO `damage_stock_x_items` (`id`, `guid`, `damage_stock_id`, `stocks_history_id`, `item`, `quty`, `cost`, `sell`, `tax`, `amount`, `supplier_id`) VALUES
(42, '5dbcf39196d05414cb23aa5936447803', '450ee7d2ef0887e6fde9456d39742687', '52bb9dabaa6986843a2c91de88574923', '9d8439c7f35923f2397af1b7edadc670', 11, '45.000', '676.000', '9.900', '495.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(43, '031d4fccac6d2368adbc6c693b9669f7', '65b17692b9ae489b0ec473e00714e7d6', '9cff3c99cc56218f03b7e9a5975fa6ee', '9d8439c7f35923f2397af1b7edadc670', 100, '45.000', '676.000', '90.000', '4590.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(44, '579071c129a777c2ca2eb0624c9e8031', '12b0ae76b49f38ab9115ca796113b5ca', '0d69420b3511b6f936906639d9e6ccb1', 'ef92a1dc9701ac89a655927183a78d87', 100, '12.000', '15.000', '0.000', '1200.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(45, 'f05fab2228e99cab1752932f8f25b380', '12b0ae76b49f38ab9115ca796113b5ca', '9cff3c99cc56218f03b7e9a5975fa6ee', '9d8439c7f35923f2397af1b7edadc670', 100, '45.000', '676.000', '90.000', '4590.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(46, '977ee9fef758da35898759a4e8b68b9f', '05eda624a50c419b395443e28522915b', '9cff3c99cc56218f03b7e9a5975fa6ee', '9d8439c7f35923f2397af1b7edadc670', 11, '45.000', '676.000', '9.900', '495.000', 'ceab8c7d14f12aaeec1dc19b3d81212a');

-- --------------------------------------------------------

--
-- Table structure for table `decomposition`
--

CREATE TABLE IF NOT EXISTS `decomposition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `stock_id` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date` int(20) NOT NULL,
  `total_types` int(11) NOT NULL,
  `total_weight` decimal(30,5) NOT NULL,
  `total_amount` decimal(30,3) NOT NULL,
  `note` varchar(500) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `decomposition_status` int(11) NOT NULL DEFAULT '0',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `decomposition`
--

INSERT INTO `decomposition` (`id`, `guid`, `branch_id`, `item_id`, `stock_id`, `code`, `date`, `total_types`, `total_weight`, `total_amount`, `note`, `remark`, `decomposition_status`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(14, 'ce54d532d5d30fae1d3324ec2f1b3033', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '9bea95d3b0b896d6cf3174e6974c4661', 'DC-110', 1404345600, 2, '55.00000', '300.000', 'fdh', 'dfh', 1, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `decomposition_items`
--

CREATE TABLE IF NOT EXISTS `decomposition_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `price` decimal(30,3) NOT NULL,
  `tax_inclusive` int(11) NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `decomposition_items`
--

INSERT INTO `decomposition_items` (`id`, `guid`, `code`, `barcode`, `item_id`, `type_id`, `price`, `tax_inclusive`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(11, 'ada0bb484b3191f9925b1cb8f9d9ffbd', 'IT1', '', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '67da5b3c82e39d6a31a27af516b7e463', '15.000', 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(12, '0839917aa673e4c5f2362245cfdb8f6a', 'IT1', '', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'a4855abf42b8baa628ad889eabf8cbc6', '15.000', 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `decomposition_type`
--

CREATE TABLE IF NOT EXISTS `decomposition_type` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `type_name` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `formula` varchar(25) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `decomposition_type`
--

INSERT INTO `decomposition_type` (`id`, `guid`, `branch_id`, `type_name`, `value`, `formula`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(11, '67da5b3c82e39d6a31a27af516b7e463', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'DT-95', '500 Grm', '1/2', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(12, 'a4855abf42b8baa628ad889eabf8cbc6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'DT-67', '5 kg', '5/1', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `decomposition_x_items`
--

CREATE TABLE IF NOT EXISTS `decomposition_x_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `decomposition_id` varchar(255) NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `weight` decimal(30,5) NOT NULL,
  `formula` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(30,3) NOT NULL,
  `total` decimal(30,3) NOT NULL,
  `tax_inclusive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `decomposition_x_items`
--

INSERT INTO `decomposition_x_items` (`id`, `guid`, `decomposition_id`, `type_id`, `weight`, `formula`, `quantity`, `price`, `total`, `tax_inclusive`) VALUES
(19, '509bacc3662a52cdb577a5a450e53522', 'ce54d532d5d30fae1d3324ec2f1b3033', '67da5b3c82e39d6a31a27af516b7e463', '5.00000', '1/2', 10, '15.000', '150.000', 1),
(20, 'f356b7c7ebc0491ccb9aac6b9a412419', 'ce54d532d5d30fae1d3324ec2f1b3033', 'a4855abf42b8baa628ad889eabf8cbc6', '50.00000', '5/1', 10, '15.000', '150.000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `direct_grn`
--

CREATE TABLE IF NOT EXISTS `direct_grn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL DEFAULT 'non',
  `supplier_id` varchar(200) NOT NULL,
  `grn_no` varchar(200) NOT NULL,
  `grn_date` int(20) NOT NULL,
  `discount` varchar(200) NOT NULL,
  `discount_amt` varchar(200) NOT NULL,
  `freight` varchar(200) NOT NULL,
  `round_amt` varchar(200) NOT NULL,
  `total_items` varchar(200) NOT NULL,
  `total_amt` varchar(200) NOT NULL,
  `total_item_amt` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL DEFAULT 'None',
  `note` varchar(200) NOT NULL DEFAULT 'None',
  `invoice_status` int(11) NOT NULL DEFAULT '0',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `order_status` int(11) NOT NULL DEFAULT '0',
  `branch_id` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `deleted_by` varchar(200) NOT NULL DEFAULT 'None',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `direct_grn`
--

INSERT INTO `direct_grn` (`id`, `guid`, `supplier_id`, `grn_no`, `grn_date`, `discount`, `discount_amt`, `freight`, `round_amt`, `total_items`, `total_amt`, `total_item_amt`, `remark`, `note`, `invoice_status`, `active_status`, `delete_status`, `order_status`, `branch_id`, `added_by`, `deleted_by`) VALUES
(14, '050b4d660171b94a10131fb4f89f1410', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'POSNIC-D-GRN-1021', 1405189800, '', '0', '', '', '6', '143925.000', '143925', 'gsdgsdg', 'sdg', 1, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `direct_invoice`
--

CREATE TABLE IF NOT EXISTS `direct_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL DEFAULT 'non',
  `supplier_id` varchar(200) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `invoice_date` int(20) NOT NULL,
  `discount` varchar(200) NOT NULL,
  `discount_amt` varchar(200) NOT NULL,
  `freight` varchar(200) NOT NULL,
  `round_amt` varchar(200) NOT NULL,
  `total_items` varchar(200) NOT NULL,
  `total_amt` varchar(200) NOT NULL,
  `total_item_amt` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL DEFAULT 'None',
  `note` varchar(200) NOT NULL DEFAULT 'None',
  `invoice_status` int(11) NOT NULL DEFAULT '0',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `order_status` int(11) NOT NULL DEFAULT '0',
  `branch_id` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `deleted_by` varchar(200) NOT NULL DEFAULT 'None',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `direct_sales`
--

CREATE TABLE IF NOT EXISTS `direct_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `customer_id` varchar(200) NOT NULL,
  `exp_date` int(20) NOT NULL,
  `code` varchar(200) NOT NULL,
  `date` int(20) NOT NULL,
  `discount` decimal(30,3) NOT NULL,
  `discount_amt` decimal(30,3) NOT NULL,
  `customer_discount` decimal(30,3) NOT NULL,
  `customer_discount_amount` decimal(30,3) NOT NULL,
  `freight` varchar(200) NOT NULL,
  `round_amt` varchar(200) NOT NULL,
  `total_items` varchar(200) NOT NULL,
  `total_tax` decimal(30,3) NOT NULL,
  `total_discount` decimal(30,3) NOT NULL,
  `total_amt` varchar(200) NOT NULL,
  `total_item_amt` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `order_status` int(2) NOT NULL,
  `receipt_status` int(2) NOT NULL,
  `received_status` int(11) NOT NULL,
  `expire_status` int(11) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `deleted_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `direct_sales`
--

INSERT INTO `direct_sales` (`id`, `guid`, `customer_id`, `exp_date`, `code`, `date`, `discount`, `discount_amt`, `customer_discount`, `customer_discount_amount`, `freight`, `round_amt`, `total_items`, `total_tax`, `total_discount`, `total_amt`, `total_item_amt`, `remark`, `note`, `active_status`, `delete_status`, `order_status`, `receipt_status`, `received_status`, `expire_status`, `branch_id`, `added_by`, `deleted_by`) VALUES
(1, 'e18f2cfa7491b1659efac9291af244eb', '0f7c80352b128f9a45d25e42d1ebd19e', 0, 'DS-124', 1405189800, '0.000', '0.000', '2.000', '21.000', '', '', '2', '50.000', '0.000', '1029.000', '1050.000', 'sgs', 'sdf', 1, 0, 1, 1, 0, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `direct_sales_delivery`
--

CREATE TABLE IF NOT EXISTS `direct_sales_delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `customer_id` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `date` int(20) NOT NULL,
  `discount` decimal(30,3) NOT NULL,
  `discount_amt` decimal(30,3) NOT NULL,
  `customer_discount` decimal(30,3) NOT NULL,
  `customer_discount_amount` decimal(30,3) NOT NULL,
  `freight` varchar(200) NOT NULL,
  `round_amt` varchar(200) NOT NULL,
  `total_items` varchar(200) NOT NULL,
  `total_tax` decimal(30,3) NOT NULL,
  `total_discount` decimal(30,3) NOT NULL,
  `total_amt` varchar(200) NOT NULL,
  `total_item_amt` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `order_status` int(2) NOT NULL,
  `bill_status` int(2) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `deleted_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grn`
--

CREATE TABLE IF NOT EXISTS `grn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_amt` decimal(30,3) NOT NULL,
  `total_item_amt` decimal(30,3) NOT NULL,
  `total_amt` decimal(30,3) NOT NULL,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `grn_no` varchar(255) NOT NULL,
  `date` int(20) NOT NULL,
  `note` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `grn_status` int(11) NOT NULL,
  `invoice_status` int(11) NOT NULL DEFAULT '0',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `ean_upc_code` varchar(255) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `depart_id` varchar(255) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `cost_price` decimal(30,3) NOT NULL,
  `mrp` decimal(30,3) NOT NULL,
  `tax_Inclusive` int(11) NOT NULL,
  `brand_id` varchar(100) NOT NULL,
  `item_type_id` varchar(100) NOT NULL,
  `selling_price` decimal(30,3) NOT NULL,
  `discount` decimal(65,3) NOT NULL,
  `start_date` int(20) NOT NULL,
  `end_date` int(20) NOT NULL,
  `tax_id` varchar(255) NOT NULL,
  `tax_area_id` varchar(100) NOT NULL,
  `upc_ean_code` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `uom` int(10) NOT NULL,
  `no_of_unit` decimal(11,0) NOT NULL DEFAULT '0',
  `decomposition` int(11) NOT NULL DEFAULT '0',
  `weight` decimal(10,5) NOT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `decomposition_status` int(11) NOT NULL DEFAULT '0',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `code_status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=138 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `guid`, `code`, `ean_upc_code`, `barcode`, `category_id`, `depart_id`, `branch_id`, `supplier_id`, `name`, `description`, `cost_price`, `mrp`, `tax_Inclusive`, `brand_id`, `item_type_id`, `selling_price`, `discount`, `start_date`, `end_date`, `tax_id`, `tax_area_id`, `upc_ean_code`, `location`, `uom`, `no_of_unit`, `decomposition`, `weight`, `deleted_by`, `decomposition_status`, `active_status`, `delete_status`, `added_by`, `code_status`, `image`) VALUES
(113, 'bdcaa1e7afb246165cfe78c4dc1bbbba', '1452', '', '74897541', '235dac2fe87906abcd3fdda21291ec24', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 1', '', '25.000', '76.000', 1, '6555d596a18df9e006f39e989289216b', '', '50.000', '0.000', 1, 1, '4eeb244d4c7f6eb3e725c99f970aef8d', '7973b1abfb2466b4478c9d87476951cf', '', 'Block 1', 0, '1', 1, '10.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(114, '024477833686497e686ec4c62508bf4b', '1453', '', '74897542', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 2', '', '26.000', '78.000', 1, '6555d596a18df9e006f39e989289216b', '', '51.000', '0.000', 1, 1, '4eeb244d4c7f6eb3e725c99f970aef8d', '28aa802577d2ca603ca011f9a3147881', '', 'Block 1', 0, '1', 1, '10.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(115, '2f3fa40a2a3f42cceb2d65551f541f66', '1454', '', '74897543', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 3', '', '27.000', '79.000', 0, '6555d596a18df9e006f39e989289216b', '', '52.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(116, 'd968ea8d3272b5315f6bf14f3e37bc46', '1455', '', '74897544', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 4', '', '28.000', '80.000', 0, '6555d596a18df9e006f39e989289216b', '', '53.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(117, '3d2a7587a9bfca604f2d34ba21f00a53', '1456', '', '74897545', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 5', '', '29.000', '81.000', 0, '6555d596a18df9e006f39e989289216b', '', '54.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(118, '24127619c056a21da783938396bffbc2', '1457', '', '74897546', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 6', '', '30.000', '82.000', 0, '6555d596a18df9e006f39e989289216b', '', '55.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(119, '0b4de60eb9709fef115a9457fc89dc12', '1458', '', '74897547', 'a8a0d7795610ea425befe7a9b04a1f64', '0368e45727e937efeba16623c26405fa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 7', '', '31.000', '83.000', 0, 'fba4c0784fcd1caec0b1abf3702369e3', '', '56.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 2', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(120, '3a71ffd8ef1df9046d0cf06ac7b3f83d', '1459', '', '74897548', 'a8a0d7795610ea425befe7a9b04a1f64', '0368e45727e937efeba16623c26405fa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 8', '', '32.000', '84.000', 0, 'fba4c0784fcd1caec0b1abf3702369e3', '', '57.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block2', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(121, '34b399be4193d1cfd2b28bda5db95b64', '1460', '', '74897549', '235dac2fe87906abcd3fdda21291ec24', 'd37279463a27186bf29563697ed3ec62', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 9', '', '34.000', '85.000', 0, '6555d596a18df9e006f39e989289216b', '', '58.000', '0.000', 0, 0, 'b8feb6eba67530396bbe1df841e8c244', '', '', 'Block3', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(122, 'cee7c1386d78af6e1d14b156b3ebc2a5', '1461', '', '74897550', '44490e4607304eaaf6f9acaf170ff290', '544f4c88a4008a5e58fc3fe5104afea9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 10', '', '35.000', '86.000', 0, '6555d596a18df9e006f39e989289216b', '', '59.000', '0.000', 1, 1, 'b8feb6eba67530396bbe1df841e8c244', '', '', 'Block3', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(123, '9317f5c4845ac8eda6d772d0f2021e2b', '1462', '', '74897551', '235dac2fe87906abcd3fdda21291ec24', 'd37279463a27186bf29563697ed3ec62', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 11', '', '36.000', '87.000', 0, '6555d596a18df9e006f39e989289216b', '', '60.000', '0.000', 0, 0, 'b8feb6eba67530396bbe1df841e8c244', '', '', 'Block3', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(124, '4a7dd5b8657346e77dab76b389dd8b7a', '1463', '', '74897552', '235dac2fe87906abcd3fdda21291ec24', 'd37279463a27186bf29563697ed3ec62', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 12', '', '37.000', '88.000', 0, '6555d596a18df9e006f39e989289216b', '', '61.000', '0.000', 0, 0, 'b8feb6eba67530396bbe1df841e8c244', '', '', 'Block3', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(125, '5ab9f137aa8409a0fb264a26299edae9', '1464', '', '74977878', '235dac2fe87906abcd3fdda21291ec24', 'd37279463a27186bf29563697ed3ec62', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 13', '', '38.000', '89.000', 0, '6555d596a18df9e006f39e989289216b', '', '62.000', '0.000', 0, 0, 'b8feb6eba67530396bbe1df841e8c244', '', '', 'Block3', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(126, '249f873b9fb54d9dab988e9063be9c1c', '1465', '', '748975445', '235dac2fe87906abcd3fdda21291ec24', 'd37279463a27186bf29563697ed3ec62', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 14', '', '39.000', '90.000', 0, '6555d596a18df9e006f39e989289216b', '', '63.000', '0.000', 0, 0, 'b8feb6eba67530396bbe1df841e8c244', '', '', 'Block3', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(127, '06ebee4c2a2734014d614621d99212f9', '1467', '', '748975413', '235dac2fe87906abcd3fdda21291ec24', 'd37279463a27186bf29563697ed3ec62', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 15', '', '40.000', '91.000', 0, '096d500eb0488f6387bcc1c7b0d6893a', '', '64.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(128, '0e50c545deb40fa589f3ebbba7006fb1', '1468', '', '748975414', '235dac2fe87906abcd3fdda21291ec24', 'd37279463a27186bf29563697ed3ec62', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 16', '', '41.000', '92.000', 0, '096d500eb0488f6387bcc1c7b0d6893a', '', '65.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(129, 'c66a508b0de37847dba834c313dc90cc', '1469', '', '748975415', '235dac2fe87906abcd3fdda21291ec24', 'd37279463a27186bf29563697ed3ec62', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 17', '', '42.000', '93.000', 0, '096d500eb0488f6387bcc1c7b0d6893a', '', '66.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(130, '6e594d18b0abcfaa01c2cc0ca78d1507', '1470', '', '748975416', '235dac2fe87906abcd3fdda21291ec24', 'd37279463a27186bf29563697ed3ec62', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 18', '', '43.000', '94.000', 0, '096d500eb0488f6387bcc1c7b0d6893a', '', '67.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(131, '84b79865b0949c3ccba8433b630c92a3', '1471', '', '748975417', '22d5510c630239cb7c346b3b62c3996c', 'd37279463a27186bf29563697ed3ec62', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 19', '', '44.000', '95.000', 0, '6555d596a18df9e006f39e989289216b', '', '68.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(132, '8c36b1c586a5640d41ad63fcb0ff9188', '1472', '', '748975418', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 20', '', '45.000', '96.000', 0, '6555d596a18df9e006f39e989289216b', '', '69.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(133, '01940c91d372f9030aea277f05cfcd5a', '1473', '', '748975419', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 21', '', '46.000', '97.000', 0, '6555d596a18df9e006f39e989289216b', '', '70.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(134, 'fee79c4bb6164a437749a03959551a50', '1474', '', '748975420', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 22', '', '47.000', '98.000', 0, '6555d596a18df9e006f39e989289216b', '', '71.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(135, 'dee62896f3b700d22c025017542cb898', '1475', '', '748975421', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 23', '', '48.000', '99.000', 0, '6555d596a18df9e006f39e989289216b', '', '72.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(136, '289680fbf0f672f7d11441007a6d12fd', '1476', '', '7489754242', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 24', '', '49.000', '100.000', 0, '6555d596a18df9e006f39e989289216b', '', '73.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(137, '4e6524522752a7cb795710951cc65399', '1477', '', '748975423', 'b75a9e09a50599e77d0086f4dfbc89c0', '2e5159c6708e08533c692600d86543c3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 25', '', '50.000', '101.000', 0, '6555d596a18df9e006f39e989289216b', '', '74.000', '0.000', 0, 0, '4eeb244d4c7f6eb3e725c99f970aef8d', '', '', 'Block 1', 0, '1', 0, '0.00000', NULL, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `items_category`
--

CREATE TABLE IF NOT EXISTS `items_category` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `category_name` varchar(100) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `items_category`
--

INSERT INTO `items_category` (`id`, `guid`, `category_name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '0f1208f8b8d972183bb16bb0443ddb5e', 'balls', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(2, '4a70944370a2a575487e2ad0a5adae9d', 'pen', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(3, '44490e4607304eaaf6f9acaf170ff290', 'book', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, '37bc41880fa0ca0de0fa2e9f37480ba0', 'Goodnight', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '7d964715c57d2df50df0a9d380c9da22', 'vicks', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, '5c3437e9dedbcacead642b41b4a1f214', 'weakily', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '544f4c88a4008a5e58fc3fe5104afea9', 'Box', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, 'f1cbc6905e17586f09094db931bcf75e', 'soap', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(9, '981cbacdb1bd664698bf1803878909b6', 'CD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(10, '402581a70ab59a35c0393cf2310b6f88', 'DVD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(11, '24f1b9183166e5a887c2f882a00dd529', 'sasi12', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(12, 'a571815faaa09a1e6d575c9a5cf92548', 'sasi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(13, '7fa9f5c245fc8ffccbeb3c0437155078', 'mobile phone', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(14, '78eef480d989be7ba6f2a1e1ac515b59', 'jibi gopi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(15, 'b9111f1e4151d408bd01589304eaa23a', 'saaaaaaaaaaaaaaaaa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(16, '22aa2ef40f166e8d1261c5bb88a4220b', 'oxford', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '7c9888196685a12a83eecf9c0d05a525', NULL),
(17, '2f559b0d9737f2e40407db3e6c998513', 'category 1', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(18, '0a61072caf2d6fc1f515c26f21a71acb', 'category 2', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(19, '5ace409a4f06999ff48ba89307e82e00', 'category 3', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(20, 'eb9540b2b14d24fad7d1406a8baeb35a', 'home', '649866515edf661bb321ec7bf0ba3415', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(22, '70e201358ae1a4eb075a67a0d35009a8', 'my_test_category', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, NULL, NULL),
(23, 'b75a9e09a50599e77d0086f4dfbc89c0', 'Cello Griper', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, NULL, NULL),
(24, 'a8a0d7795610ea425befe7a9b04a1f64', 'Milma', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, NULL, NULL),
(25, '235dac2fe87906abcd3fdda21291ec24', 'Accer', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, NULL, NULL),
(26, '22d5510c630239cb7c346b3b62c3996c', 'Acer', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items_department`
--

CREATE TABLE IF NOT EXISTS `items_department` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `department_name` varchar(100) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `items_department`
--

INSERT INTO `items_department` (`id`, `guid`, `department_name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '0f1208f8b8d972183bb16bb0443ddb5e', 'Non Veg', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(2, '4a70944370a2a575487e2ad0a5adae9d', 'Vegitable', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(3, '44490e4607304eaaf6f9acaf170ff290', 'Fruits', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, '37bc41880fa0ca0de0fa2e9f37480ba0', 'Medicine', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '7d964715c57d2df50df0a9d380c9da22', 'vicks', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, '5c3437e9dedbcacead642b41b4a1f214', 'weakily', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '544f4c88a4008a5e58fc3fe5104afea9', 'Box', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, 'f1cbc6905e17586f09094db931bcf75e', 'soap', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(9, '981cbacdb1bd664698bf1803878909b6', 'CD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(10, '402581a70ab59a35c0393cf2310b6f88', 'DVD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(11, '24f1b9183166e5a887c2f882a00dd529', 'sasi12', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(12, 'a571815faaa09a1e6d575c9a5cf92548', 'sasi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(13, '7fa9f5c245fc8ffccbeb3c0437155078', 'mobile phone', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(14, '75bcc4188e278a5c4f6447588c70ead6', '123', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(15, '7d594b99662ecd1c1ced9db977f1f3bd', 'veg', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(16, 'c8f777cc66024bcfb022dad696bbff44', 'non veg', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(17, 'b4cad279b0cf9ba2f0a1931cacc1aa70', 'Department 1', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(18, '14fa688aeffe785a3a13dc2617b66556', 'Department 2', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(19, '59f4605d16c18ba221de58b5663704e4', 'Department 3', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(20, '5ec795d44888e98fbea3c71d9b7bc47c', 'Department 4', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(21, 'ca6aba89b9e14391b3edc42207c26bef', 'Department 1', '649866515edf661bb321ec7bf0ba3415', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(22, '9393959d98f57c169cce91f3cc47ff59', 'my_test_category', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, NULL, NULL),
(23, '2e5159c6708e08533c692600d86543c3', 'pen', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, NULL, NULL),
(24, '0368e45727e937efeba16623c26405fa', 'daily', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, NULL, NULL),
(25, 'd37279463a27186bf29563697ed3ec62', 'laptop', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items_setting`
--

CREATE TABLE IF NOT EXISTS `items_setting` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `item_id` varchar(100) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `min_q` varchar(50) NOT NULL,
  `max_q` varchar(50) NOT NULL,
  `sales` int(11) NOT NULL DEFAULT '1',
  `purchase` int(11) NOT NULL DEFAULT '1',
  `sales_return` int(11) NOT NULL DEFAULT '1',
  `purchase_return` int(11) NOT NULL DEFAULT '1',
  `allow_negative` int(11) NOT NULL,
  `tax_inclusive` int(11) NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `set` int(11) NOT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `active_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

--
-- Dumping data for table `items_setting`
--

INSERT INTO `items_setting` (`id`, `guid`, `item_id`, `branch_id`, `min_q`, `max_q`, `sales`, `purchase`, `sales_return`, `purchase_return`, `allow_negative`, `tax_inclusive`, `updated_by`, `set`, `added_by`, `active`, `delete_status`, `active_status`) VALUES
(111, 'a9456e58b29fee4467720bae3926c353', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(112, '561a0420bf973de5aa8718253dc7fb84', '024477833686497e686ec4c62508bf4b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(113, 'd9b5152db68a5daf1b0ec52994618cbc', '2f3fa40a2a3f42cceb2d65551f541f66', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(114, '66a6b235a05bb8f76d49008f22b4b6da', 'd968ea8d3272b5315f6bf14f3e37bc46', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(115, '67f9a5156de00413c9a8eddac910bb85', '3d2a7587a9bfca604f2d34ba21f00a53', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(116, '20b4ff535ee00633627390083d76e48e', '24127619c056a21da783938396bffbc2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(117, '7b4d34c5e163a8f39b19f4a277e4f107', '0b4de60eb9709fef115a9457fc89dc12', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(118, '36c5ded9c2bec0aaf4788c32e6132b1b', '3a71ffd8ef1df9046d0cf06ac7b3f83d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(119, '2a2981d818e3c5ef5a9dd731a2011704', '34b399be4193d1cfd2b28bda5db95b64', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(120, '62a2309e0f03be0ed4fc9d4371d1400a', 'cee7c1386d78af6e1d14b156b3ebc2a5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(121, '7105846ea3bd06d87583c67f027ea832', '9317f5c4845ac8eda6d772d0f2021e2b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(122, 'b2b904195c78442fcce4f4a86d5a926a', '4a7dd5b8657346e77dab76b389dd8b7a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(123, '23e277468e2d877c845088df1652359e', '5ab9f137aa8409a0fb264a26299edae9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(124, '773bb5b7b7fa30da2baa6a12c5343a68', '249f873b9fb54d9dab988e9063be9c1c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(125, '1b3ba8c1fd4d7a2af20db886e7114aa5', '06ebee4c2a2734014d614621d99212f9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(126, 'bbfab65a2d6a5a5b71667d36ac71154f', '0e50c545deb40fa589f3ebbba7006fb1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(127, 'cbb20b0b6427984210fcc665ef53380c', 'c66a508b0de37847dba834c313dc90cc', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(128, '28f08bf832fe9d20460d0ad6ff3b8bac', '6e594d18b0abcfaa01c2cc0ca78d1507', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(129, 'c1a43ec8ece4a2ddc16248fda9a881dd', '84b79865b0949c3ccba8433b630c92a3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(130, 'f53cab72c142c612c99fc7c2cbc632a9', '8c36b1c586a5640d41ad63fcb0ff9188', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(131, '6ded0ef4f008beb3eb50c74e10ee9f24', '01940c91d372f9030aea277f05cfcd5a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(132, '4b015605b2d01c6bb5f1aca4c07ba0a3', 'fee79c4bb6164a437749a03959551a50', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(133, 'be076c40c6b08d98bfe0fbb7d61c46ad', 'dee62896f3b700d22c025017542cb898', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(134, 'b82d48cd096aa0d43de8f4ea9be7d2d4', '289680fbf0f672f7d11441007a6d12fd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(135, '3f2a18ba36eff7916d56dc238895ea3c', '4e6524522752a7cb795710951cc65399', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_kit`
--

CREATE TABLE IF NOT EXISTS `item_kit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tax_id` varchar(255) NOT NULL,
  `tax_value` varchar(10) NOT NULL,
  `tax_type` varchar(10) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `no_of_items` int(11) NOT NULL,
  `item_total` decimal(30,3) NOT NULL,
  `kit_price` decimal(30,3) NOT NULL,
  `tax_inclusive` int(11) NOT NULL,
  `tax_amount` decimal(30,3) NOT NULL,
  `selling_price` decimal(30,3) NOT NULL,
  `note` varchar(500) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `kit_status` int(11) NOT NULL DEFAULT '0',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `item_kit`
--

INSERT INTO `item_kit` (`id`, `guid`, `code`, `barcode`, `name`, `tax_id`, `tax_value`, `tax_type`, `category_id`, `no_of_items`, `item_total`, `kit_price`, `tax_inclusive`, `tax_amount`, `selling_price`, `note`, `remark`, `active_status`, `kit_status`, `delete_status`, `added_by`, `deleted_by`, `branch_id`) VALUES
(12, '5a20f38e08ec86e84c052aaf894f3911', 'IK-0111', '12345678910', 'kit-123', '5dad9a40f3b35cd3b573fcd3d481ea0b', '2', 'Vat', '4a70944370a2a575487e2ad0a5adae9d', 2, '121.000', '125.000', 0, '2.500', '125.000', 'SDGSD', 'SGDGS', 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `item_kit_x_items`
--

CREATE TABLE IF NOT EXISTS `item_kit_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `item_kit_id` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `stock_id` varchar(255) NOT NULL,
  `quty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `item_kit_x_items`
--

INSERT INTO `item_kit_x_items` (`id`, `guid`, `item_kit_id`, `item_id`, `stock_id`, `quty`) VALUES
(20, '62179c961abc8db5f6a02c3498d5b92f', '5a20f38e08ec86e84c052aaf894f3911', '9317f5c4845ac8eda6d772d0f2021e2b', '794d587e8d5afbf85d2be3aeee57b673', 1),
(21, '4ba1e895daffdb4055a3b6294ce4162c', '5a20f38e08ec86e84c052aaf894f3911', '4a7dd5b8657346e77dab76b389dd8b7a', '83d1c6b3303d80271bda7a4a945b247a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_upc_ean_code`
--

CREATE TABLE IF NOT EXISTS `item_upc_ean_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `item_id` varchar(100) NOT NULL,
  `code` varchar(200) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kit_category`
--

CREATE TABLE IF NOT EXISTS `kit_category` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `category_name` varchar(100) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `kit_category`
--

INSERT INTO `kit_category` (`id`, `guid`, `category_name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '0f1208f8b8d972183bb16bb0443ddb5e', 'balls', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(2, '4a70944370a2a575487e2ad0a5adae9d', 'pen', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(3, '44490e4607304eaaf6f9acaf170ff290', 'book', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, '37bc41880fa0ca0de0fa2e9f37480ba0', 'Goodnight', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '7d964715c57d2df50df0a9d380c9da22', 'vicks', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, '5c3437e9dedbcacead642b41b4a1f214', 'weakily', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '544f4c88a4008a5e58fc3fe5104afea9', 'Box', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, 'f1cbc6905e17586f09094db931bcf75e', 'soap', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(9, '981cbacdb1bd664698bf1803878909b6', 'CD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(10, '402581a70ab59a35c0393cf2310b6f88', 'DVD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(11, '24f1b9183166e5a887c2f882a00dd529', 'sasi12', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(12, 'a571815faaa09a1e6d575c9a5cf92548', 'sasi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(13, '7fa9f5c245fc8ffccbeb3c0437155078', 'mobile phone', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(14, '78eef480d989be7ba6f2a1e1ac515b59', 'jibi gopi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(15, 'b9111f1e4151d408bd01589304eaa23a', 'saaaaaaaaaaaaaaaaa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(16, '22aa2ef40f166e8d1261c5bb88a4220b', 'oxford', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '7c9888196685a12a83eecf9c0d05a525', NULL),
(17, '2f559b0d9737f2e40407db3e6c998513', 'category 1', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(18, '0a61072caf2d6fc1f515c26f21a71acb', 'category 2', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(19, '5ace409a4f06999ff48ba89307e82e00', 'category 3', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(20, 'eb9540b2b14d24fad7d1406a8baeb35a', 'home', '649866515edf661bb321ec7bf0ba3415', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `in_english` varchar(255) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `language_name`, `in_english`, `active_status`, `delete_status`) VALUES
(1, 'English', 'english', 1, 0),
(2, 'മലയാളം', 'malayalam', 1, 0),
(7, ' தமிழ்மொழி', 'Tamil', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `master_data`
--

CREATE TABLE IF NOT EXISTS `master_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `key` varchar(255) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `value2` int(200) NOT NULL DEFAULT '1',
  `max` int(250) NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=168 ;

--
-- Dumping data for table `master_data`
--

INSERT INTO `master_data` (`id`, `guid`, `key`, `prefix`, `value2`, `max`, `branch_id`) VALUES
(144, 'ed37ee6ec13eb174e584504b599dcc79', 'purchase_order', 'POSNIC-GRN-10', 1, 13, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(145, 'd8f21c13259bb3d3cff8a68b1c7d6440', 'grn', 'GRN-178', 1, 10, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(146, 'ba26cb198ae3ee8840fd8c86f7e2fe6c', 'direct_grn', 'POSNIC-D-GRN-10', 1, 22, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(147, 'b15cf29431b6f569ada42694c8e19506', 'purchase_invoice', 'INV-101', 1, 110, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(148, 'f0c07baf6902275a2adae960b2e132e2', 'direct_invoice', 'D-INV-101', 1, 23, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(149, 'ebcf83397dafb2dcd2fb03c220a83c2d', 'purchase_return', 'PR-101', 1, 12, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(150, 'ec409b7ec6ec0f89aaa9474e4378d091', 'sales', 'S-1', 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(151, '6daa5de6eee798a15c0a68e2ce443dae', 'sales_quotation', 'S-1', 1, 6, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(152, '1cd0d4fad14db0368c204534aa8dcbd4', 'sales_order', 'SO-1', 1, 22, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(153, 'c8d99d87c1df39124399b0703f891b73', 'sales_delivery_note', 'SDN-1', 1, 19, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(154, '30c76b30f4186fe164b1c2469f2f7dc0', 'direct_sales_delivery', 'DDN-1', 1, 9, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(155, 'ffbca780fe7e706f2c0bd3ec8ac6b54b', 'direct_sales', 'DS-1', 1, 25, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(156, '68ea5b8ad570decd3be1ea2f910a057c', 'sales_bill', 'SB-1', 1, 33, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(157, '955665754ee457319308e9cab89815f3', 'sales_return', 'SR-10', 1, 14, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(158, '547b2cc364b6ef8c649d9cd6eadeb45b', 'supplier_payment', 'IN-1', 1, 9, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(159, 'dfa1060f31848435f55b9ae27fb96f8d', 'customer_payment', 'CP-1', 1, 22, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(160, '22917fe9f3b86582576bc7af10458f04', 'opening_stock', 'OS', 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(161, '7594c41b83dd90ba55c09dea3f5b1bf0', 'damage_stock', 'DS-1', 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(162, '9bc95905cd71fbc1059d1ece4e268c22', 'stock_transfer', 'ST-1', 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(163, '71fbc1059d1ece4e268c229d1ece4e268c22', 'decomposition', 'DC-1', 1, 11, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(164, 'de3894df66b3cf5a636e7ba255fb9ae5', 'decomposition_items', 'IT', 1, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(165, 'de3894df66b3cf5a636e7ba255fb9b3cf5a636e7ba255fb9ae5', 'item_kit', 'IK-01', 1, 12, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(166, '77ba257ba255fb9b3cf5a636e7ba255fb9asfasae5e57ba255asf325235fb9b3c', 'keyboard_sales', 'KS-12', 1, 27, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(167, 'bjksad897ejbhs5trkwe78900sdfnfowert7b', 'touch_sales', 'TS-12', 1, 41, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `module_name` varchar(200) NOT NULL,
  `cate_id` varchar(200) NOT NULL,
  `core` int(11) NOT NULL DEFAULT '1',
  `added_date` int(20) NOT NULL,
  `deleted_date` int(11) NOT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `guid`, `module_name`, `cate_id`, `core`, `added_date`, `deleted_date`, `added_by`, `deleted_by`, `active_status`, `delete_status`) VALUES
(1, '80B0F0FD-B148-4C02-AFC7-7463D856714A', 'items', '80B0F0FD-B148-4C02-AF787C7-7463D856714', 1, 1, 0, '102', '0', 1, 0),
(2, '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 'users', '80B0F0FD-B148-4C02-AFC7-7463D85671412', 1, 1, 0, '102', '0', 1, 0),
(3, 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 'brands', '80B0F0FD-B148-4C02-AF787C7-7463D856714', 1, 1, 0, '102', '0', 1, 0),
(4, '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 'items_setting', '80B0F0FD-B148-4C02-AF787C7-7463D856714', 1, 102, 0, '0', '0', 1, 0),
(5, '60715722-A689-412B-A13F-ECA29FF19523', 'item_code', '80B0F0FD-B148-4C02-AF787C7-7463D856714', 1, 102, 0, '0', '0', 1, 0),
(6, 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 'taxes', '80B0F0FD-B178748-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(7, 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 'tax_commodity', '80B0F0FD-B178748-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(8, 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 'items_category', '80B0F0FD-B148-4C02-AF787C7-7463D856714', 1, 102, 0, '0', '0', 1, 0),
(9, 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 'tax_types', '80B0F0FD-B178748-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(10, 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 'taxes_area', '80B0F0FD-B178748-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '1', 1, 0),
(11, 'D33AF5EF-570D-403D-B967-A5B658675B06', 'suppliers', '80B0F0FD-B148-4C02-AFC7-7463D8567j8huy7', 1, 102, 0, '0', '0', 1, 0),
(12, '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 'suppliers_x_items', '80B0F0FD-B148-4C02-AFC7-7463D8567j8huy7', 1, 102, 0, '0', '0', 1, 0),
(13, '5464B2EF-92D2-4430-B366-983D7590FFC4', 'customers', '9090B0F0FD-B148-4C02-AFC7-7463Dd8989856714A', 1, 102, 0, '0', '0', 1, 0),
(14, '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 'customer_category', '9090B0F0FD-B148-4C02-AFC7-7463Dd8989856714A', 1, 102, 0, '0', '0', 1, 0),
(15, 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 'user_groups', '80B0F0FD-B148-4C02-AFC7-7463D85671412', 1, 102, 0, '1', '1', 1, 0),
(16, '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 'branches', 'Iu878h0FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(17, '6D825F4C-44E0-4CF4-8FD2-A5FEA57E8FC1', 'purchase_order', '80B900F0FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(18, 'B299A7BB-7709-4B0B-966E-023F1CA77058', 'customers_payment_type', '9090B0F0FD-B148-4C02-AFC7-7463Dd8989856714A', 1, 102, 0, '0', '0', 1, 0),
(19, 'B499A7BB-8709-4B0B-966E-023F1CA77058', 'purchase_order', '80B900F0FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(21, 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 'items_department', '80B0F0FD-B148-4C02-AF787C7-7463D856714', 1, 102, 0, '0', '0', 1, 0),
(22, 'D33AF9080F-570D-403D-B967-A5B658675B0645', 'suppliers_category', '80B0F0FD-B148-4C02-AFC7-7463D8567j8huy7', 1, 102, 0, '0', '0', 1, 0),
(24, '7248797adf02e132ba3c51da343bbfd4', 'purchase_order_cancel', '80B900F0FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(25, 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 'goods_receiving_note', '80B900F0FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(26, 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 'direct_grn', '80B900F0FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(27, 'B499A7BB-7709-4B0B-966E-023F1CA77057', 'purchase_invoice', '80B900F0FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(28, '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 'direct_invoice', '80B900F0FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(29, 'ddaf13095cf7472c4df9ab7ef547311e', 'supplier_payment', 'ce373527a9a1981f3fea7bf414b6a529', 1, 102, 0, '0', '0', 1, 0),
(30, '5d6caaab9ffe66d750293aedae946da6', 'stock_transfer', 'fdf7b89447e93bce736d471aefc5fff4', 0, 102, 0, '0', '0', 1, 0),
(31, 'bcfc52307913f851ded416c9283a6826', 'opening_stock', 'fdf7b89447e93bce736d471aefc5fff4', 0, 102, 0, '0', '0', 1, 0),
(32, 'fe36bb26e7b7b0499d22f87ebeee343c', 'damage_stock', 'fdf7b89447e93bce736d471aefc5fff4', 0, 102, 0, '0', '0', 1, 0),
(33, '5ac1b200480113f66b9e38e2387b0840', 'sales_quotation', '4C020FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(34, '5ac1fe36bb26e7b7b049387b0840', 'sales_order', '4C020FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(35, '7227e29d3bb56bd7B148-4C02-AFCB148-4C02-AFC', 'sales_delivery_note', '4C020FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(36, '-B148-4C02-AFC7-7463D856714A63D856714A7b0840', 'direct_sales_delivery', '4C020FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(40, '5ac1fe4C020FD-B148-4C02-AFC7-7463D856714A7b0840', 'direct_sales', '4C020FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(41, 'd04f7130b0e16554b6f87751b3d7eaae', 'purchase_return', '80B900F0FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(46, '5ac1fe36bb26e7b7b5ac1fe36bb26e7b7b049387b0840', 'sales_bill', '4C020FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(47, '7227e29d3bb56bd72c032ca4a650f936', 'sales_return', '4C020FD-B148-4C02-AFC7-7463D856714A', 1, 102, 0, '0', '0', 1, 0),
(48, 'dd9a1981f3fea7bf472c4df99a1981f3fea7bf4', 'customer_payment', 'ce373527a9a1981f3fea7bf414b6a529', 1, 102, 0, '0', '0', 1, 0),
(49, '1a7222de13e61a10076e8b8bdfe52983', 'receiving_stock', 'fdf7b89447e93bce736d471aefc5fff4', 0, 102, 0, '0', '0', 1, 0),
(52, '48512ae7d57b1396273f76fe6ed341a235cf9e91fc', 'language', '8512ae7d57b1396273f76fe6ed341a23', 1, 102, 0, '0', '0', 1, 0),
(53, '410ae239e28e6b6c72a457dcda7762d0', 'price_tag', '80B0F0FD-B148-4C02-AF787C7-7463D856714', 1, 1, 0, '102', '0', 1, 0),
(54, '231dc2de177458bcb272143e5e3be265777a09f77', 'decomposition_type', '46cc3a21e3ef3c4f120188b6090dc7cc', 1, 102, 0, '0', '0', 1, 0),
(55, '231d4a8d535c5bd03690435ef8609f77', 'decomposition', '46cc3a21e3ef3c4f120188b6090dc7cc', 1, 102, 0, '0', '0', 1, 0),
(56, '2a627209c75ccb20753d28b94acaa201', 'decomposition_items', '46cc3a21e3ef3c4f120188b6090dc7cc', 1, 102, 0, '0', '0', 1, 0),
(58, '9f3984f41fc426d1c19ae6db4f53563f', 'kit_category', 'acfc05072c7dc1a3b8fa5df1cc522612', 1, 102, 0, '0', '0', 1, 0),
(60, 'b53bd1cdc1b7f0ab65aa10ab82660ae9', 'item_kit', 'acfc05072c7dc1a3b8fa5df1cc522612', 1, 102, 0, '0', '0', 1, 0),
(61, '8120dfc2774ab8d1ef39f2d226d99371', 'stock_level', 'fdf7b89447e93bce736d471aefc5fff4', 0, 102, 0, '0', '0', 1, 0),
(62, '736d6bb26e7b736d499d22f87eb736d', 'keyboard_sales', '4C020FD-B148-4C02-AFC7-7463D856714A', 0, 102, 0, '0', '0', 1, 0),
(63, 'eee7a61efbbde309d093bf4607c55a4e', 'touch_sales', '4C020FD-B148-4C02-AFC7-7463D856714A', 0, 102, 0, '0', '0', 1, 0),
(64, '383765d7c92f99d517339d045277ee20', 'summary_reports', '03fd6f32a6cc47f57ca20e78291e54d9', 0, 102, 0, '0', '0', 1, 0),
(65, 'b7436db270fab87fc70dee83fdde0771', 'detailed_reports', '03fd6f32a6cc47f57ca20e78291e54d9', 0, 102, 0, '0', '0', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `modules_category`
--

CREATE TABLE IF NOT EXISTS `modules_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `Category_name` varchar(100) NOT NULL,
  `no` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `core` int(11) NOT NULL DEFAULT '0',
  `icon_class` varchar(244) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) NOT NULL,
  `delete_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `modules_category`
--

INSERT INTO `modules_category` (`id`, `guid`, `Category_name`, `no`, `order`, `core`, `icon_class`, `delete_status`, `added_by`, `delete_by`) VALUES
(3, '80B0F0FD-B148-4C02-AFC7-7463D85671412', 'users', 0, 1, 1, '141241', 0, '', ''),
(4, '80B0F0FD-B148-4C02-AF787C7-7463D856714', 'items', 0, 3, 1, 'saasfa', 0, '', ''),
(5, '80B0F0FD-B178748-4C02-AFC7-7463D856714A', 'tax', 0, 2, 1, '', 0, '', ''),
(6, '9090B0F0FD-B148-4C02-AFC7-7463Dd8989856714A', 'customers', 0, 4, 1, '', 0, '', ''),
(7, '80B0F0FD-B148-4C02-AFC7-7463D8567j8huy7', 'suppliers', 0, 5, 1, '', 0, '', ''),
(8, '80B900F0FD-B148-4C02-AFC7-7463D856714A', 'purchase', 0, 6, 1, '', 0, '', ''),
(9, '4C020FD-B148-4C02-AFC7-7463D856714A', 'sales', 0, 7, 1, '', 0, '', ''),
(10, 'ce373527a9a1981f3fea7bf414b6a529', 'payments', 0, 8, 1, '', 0, '', ''),
(11, 'fdf7b89447e93bce736d471aefc5fff4', 'stock', 0, 9, 1, '', 0, '', ''),
(12, 'Iu878h0FD-B148-4C02-AFC7-7463D856714A', 'branches', 0, 10, 1, '', 0, '', ''),
(13, '46492bca275b05cbf2db53040ca5b7e8', 'module', 0, 11, 11, '', 0, '', ''),
(14, '8512ae7d57b1396273f76fe6ed341a23', 'language', 0, 11, 1, '', 0, '', ''),
(15, '46cc3a21e3ef3c4f120188b6090dc7cc', 'decomposition', 0, 3, 1, '', 0, '', ''),
(16, 'acfc05072c7dc1a3b8fa5df1cc522612', 'item_kit', 0, 3, 1, '', 0, '', ''),
(17, '03fd6f32a6cc47f57ca20e78291e54d9', 'report', 0, 15, 1, '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `modules_x_branches`
--

CREATE TABLE IF NOT EXISTS `modules_x_branches` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `module_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `modules_x_branches`
--

INSERT INTO `modules_x_branches` (`id`, `guid`, `branch_id`, `module_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 1, 0, '0', '0'),
(2, 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 1, 0, '0', '0'),
(3, '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 1, 0, '0', '0'),
(4, '60715722-A689-412B-A13F-ECA29FF19523', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '60715722-A689-412B-A13F-ECA29FF19523', 1, 0, '0', '0'),
(5, 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 1, 0, '0', '0'),
(6, 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 1, 0, '0', '0'),
(7, 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 1, 0, '0', '0'),
(8, 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 1, 0, '0', '0'),
(9, 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 1, 0, '0', '0'),
(10, '80B0F0FD-B148-4C02-AFC7-7463D856714A', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 1, 0, '0', '0'),
(11, '80B0F0FD-B148-4C02-AFC7-7463D856714A', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '80B0F0FD-B148-4C02-AFC7-7463D856714Ass', 1, 0, '0', '0'),
(12, 'D33AF5EF-570D-403D-B967-A5B658675B06', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'D33AF5EF-570D-403D-B967-A5B658675B06', 1, 0, '0', '0'),
(13, '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 1, 0, '0', '0'),
(14, '5464B2EF-92D2-4430-B366-983D7590FFC4', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '5464B2EF-92D2-4430-B366-983D7590FFC4', 1, 0, '0', '0'),
(15, '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 1, 0, '0', '0'),
(16, 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 1, 0, '0', '0'),
(17, '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 1, 0, '0', '0'),
(18, 'B299A7BB-7709-4B0B-966E-023F1CA77058', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 1, 0, '0', '0'),
(19, 'B499A7BB-8709-4B0B-966E-023F1CA77058', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 1, 0, '0', '0'),
(20, 'B499A7BB-77DFSS09-4B0B-966E-023F1CA77057', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 1, 0, '0', '0'),
(21, 'B499A7BB-77DFSS09-4B0B-966E-023F1CA77057', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'D33AF9080F-570D-403D-B967-A5B658675B0645', 1, 0, '0', '0'),
(22, '4C020FD-B148-4C02-AFC7-7463D856714A057', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4C020FD-B148-4C02-AFC7-7463D856714A', 1, 0, '0', '0'),
(23, 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 1, 0, '0', '0'),
(24, 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 1, 0, '0', '0'),
(25, 'B499A7BB-7709-4B0B-966E-023F1CA77057', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 1, 0, '0', '0'),
(26, '4B0B-D7948222EBB3-4B0B-4B0B-966E-023F', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 1, 0, '0', '0'),
(27, '4B0B-D7948222EBB3-4B0B-4B0B-966E-023F', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ddaf13095cf7472c4df9ab7ef547311e', 1, 0, '0', '0'),
(28, '7248797adf02e132ba3c51da343bbfd4-4B0B-4B0B-966E-023F', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7248797adf02e132ba3c51da343bbfd4', 1, 0, '0', '0'),
(29, '72487-5d6caaab9ffe66d750293aedae946da6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '5d6caaab9ffe66d750293aedae946da6', 1, 0, '0', '0'),
(30, '72487-5d6caaab9ffe66d750293aedae946da6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bcfc52307913f851ded416c9283a6826', 1, 0, '0', '0'),
(31, '72487-fe36bb26e7b7b0499d22f87ebeee343c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'fe36bb26e7b7b0499d22f87ebeee343c', 1, 0, '0', '0'),
(32, '72487-5d6caaab9ffe-B148-4C02-AFC7-7463D856714A63D856714A7b0840', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '5ac1b200480113f66b9e38e2387b0840', 1, 0, '0', '0'),
(33, '72-B148-4C02-AFC7-7463D856714A63D856714A7b0840da6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '5ac1fe36bb26e7b7b049387b0840', 1, 0, '0', '0'),
(34, '72487-5d6caaab9ffe66d750293aedae946da6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '5ac1fe36bb26e7b7b5ac1fe36bb26e7b7b049387b0840', 1, 0, '0', '0'),
(35, '-B148-4C02-AFC7-7463D856714A63D856714A7b0840fe66d750293aedae946da6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '5ac1fe4C020FD-B148-4C02-AFC7-7463D856714A7b0840', 1, 0, '0', '0'),
(36, '72487--B148-4C02-AFC7-7463D856714A63D856714A7b08406', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '-B148-4C02-AFC7-7463D856714A63D856714A7b0840', 1, 0, '0', '0'),
(37, '7247227e29d3bb56bd72c032ca4a650f936', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7227e29d3bb56bd72c032ca4a650f936', 1, 0, '0', '0'),
(38, '506e87d5b970aa58260e534531c867f20f936', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '506e87d5b970aa58260e534531c867f2', 1, 0, '0', '0'),
(39, 'd04f7130b0e16554b6f87751b3d7eaae936', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd04f7130b0e16554b6f87751b3d7eaae', 1, 0, '0', '0'),
(40, 'd04f7130b0e16554b6f87751b3d7eaae936', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7227e29d3bb56bd7B148-4C02-AFCB148-4C02-AFC', 1, 0, '0', '0'),
(41, 'dd9a1981f3fea7bf472c4df99a1981f3fea7bf47eaae936', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'dd9a1981f3fea7bf472c4df99a1981f3fea7bf4', 1, 0, '0', '0'),
(42, 'dd9a191a7222de13e61a10076e8b8bdfe52983', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1a7222de13e61a10076e8b8bdfe52983', 1, 0, '0', '0'),
(43, '2bcf89342d4e55e266173635cf9e91fc36', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2bcf89342d4e55e266173635cf9e91fc', 1, 0, '0', '0'),
(44, '246492bca275b05cbf2db53040ca5b7e8635cf9e91fc', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '46492bca275b05cbf2db53040ca5b7e8635cf9e91fc', 1, 0, '0', '0'),
(45, '24648512ae7d57b1396273f76fe6ed341a235cf9e91fc', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '48512ae7d57b1396273f76fe6ed341a235cf9e91fc', 1, 0, '0', '0'),
(46, 'a1f49d69ad4b7b3c017dda97082e1b5b', '649866515edf661bb321ec7bf0ba3415', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 1, 0, NULL, NULL),
(47, '8fe21e65517e67cedfbb9c18b773f58f', '649866515edf661bb321ec7bf0ba3415', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 1, 0, NULL, NULL),
(48, 'effbda4794b2f2558e397bcd3b524070', '649866515edf661bb321ec7bf0ba3415', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 1, 0, NULL, NULL),
(49, 'c8a1a580bad348cb9bb49c06a75fa9a7', '649866515edf661bb321ec7bf0ba3415', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 1, 0, NULL, NULL),
(50, 'ab1414b6a0b7859470b9af320e0bab5a', '649866515edf661bb321ec7bf0ba3415', '60715722-A689-412B-A13F-ECA29FF19523', 1, 0, NULL, NULL),
(51, 'f2c917630d8506f6930fd401a3402061', '649866515edf661bb321ec7bf0ba3415', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 1, 0, NULL, NULL),
(52, '8fc817589125cbc738a381af6913e131', '649866515edf661bb321ec7bf0ba3415', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 1, 0, NULL, NULL),
(53, 'ed7001677002f8e4029e433e4306420a', '649866515edf661bb321ec7bf0ba3415', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 1, 0, NULL, NULL),
(54, 'f56c0d11a1bc693e1d33632fb825e56b', '649866515edf661bb321ec7bf0ba3415', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 1, 0, NULL, NULL),
(55, '65c802c444c524a24509003fbdf264c8', '649866515edf661bb321ec7bf0ba3415', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 1, 0, NULL, NULL),
(56, 'df0c395687b2aa7981a5d29fafae6aac', '649866515edf661bb321ec7bf0ba3415', 'D33AF5EF-570D-403D-B967-A5B658675B06', 1, 0, NULL, NULL),
(57, '604028853300ef5df4df3c76aa4fa804', '649866515edf661bb321ec7bf0ba3415', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 1, 0, NULL, NULL),
(58, 'fdc8c46a93625879a998131bf4c39948', '649866515edf661bb321ec7bf0ba3415', '5464B2EF-92D2-4430-B366-983D7590FFC4', 1, 0, NULL, NULL),
(59, 'a9e7f3d8e639a79e28dde712c841c556', '649866515edf661bb321ec7bf0ba3415', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 1, 0, NULL, NULL),
(60, 'df4c94c18983ac2ad831c9a3fdd8ec9c', '649866515edf661bb321ec7bf0ba3415', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 1, 0, NULL, NULL),
(61, '9cff6ab761cd92bb398c28900282bd47', '649866515edf661bb321ec7bf0ba3415', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 1, 0, NULL, NULL),
(62, '44e91c124be06b9d511bd2d6429835ac', '649866515edf661bb321ec7bf0ba3415', '6D825F4C-44E0-4CF4-8FD2-A5FEA57E8FC1', 1, 0, NULL, NULL),
(63, '6dd491cc6a4c12621224f18757d70283', '649866515edf661bb321ec7bf0ba3415', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 1, 0, NULL, NULL),
(64, 'dd8bbafcdb2fe8508bc930007fd0325a', '649866515edf661bb321ec7bf0ba3415', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 1, 0, NULL, NULL),
(65, '3b0e3cab1d965ae030ee63bd0966ec06', '649866515edf661bb321ec7bf0ba3415', 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 1, 0, NULL, NULL),
(66, '94a2f178b1b6b1a887f5c38a746207a6', '649866515edf661bb321ec7bf0ba3415', 'D33AF9080F-570D-403D-B967-A5B658675B0645', 1, 0, NULL, NULL),
(67, '4be0835dd522e0b45f76e089fe57e2be', '649866515edf661bb321ec7bf0ba3415', '7248797adf02e132ba3c51da343bbfd4', 1, 0, NULL, NULL),
(68, 'b835e256686600df223d8784d8b7be1d', '649866515edf661bb321ec7bf0ba3415', 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 1, 0, NULL, NULL),
(69, '9374007136cf30c9a385fce77c3b9884', '649866515edf661bb321ec7bf0ba3415', 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 1, 0, NULL, NULL),
(70, 'c684347e4239c38c671af09dadf4c59f', '649866515edf661bb321ec7bf0ba3415', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 1, 0, NULL, NULL),
(71, 'fb24711c9b5f225bc3e4279287f827a7', '649866515edf661bb321ec7bf0ba3415', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 1, 0, NULL, NULL),
(72, 'f1beae61a310f0e2d173c7c6e38f14b5', '649866515edf661bb321ec7bf0ba3415', 'ddaf13095cf7472c4df9ab7ef547311e', 1, 0, NULL, NULL),
(73, '50ce735f3c1e25989178573e0a0ab007', '649866515edf661bb321ec7bf0ba3415', '5d6caaab9ffe66d750293aedae946da6', 1, 0, NULL, NULL),
(74, '19aa79e3c4de872696be08201dcc8237', '649866515edf661bb321ec7bf0ba3415', 'bcfc52307913f851ded416c9283a6826', 1, 0, NULL, NULL),
(75, '4a1a4600b7a713148a59dbcc0e823b2f', '649866515edf661bb321ec7bf0ba3415', 'fe36bb26e7b7b0499d22f87ebeee343c', 1, 0, NULL, NULL),
(76, '88c58e5fbcefb9ca010ac14a0673e840', '649866515edf661bb321ec7bf0ba3415', '5ac1b200480113f66b9e38e2387b0840', 1, 0, NULL, NULL),
(77, 'f99e4db0ed468376341c3eeac2759b59', '649866515edf661bb321ec7bf0ba3415', '5ac1fe36bb26e7b7b049387b0840', 1, 0, NULL, NULL),
(78, 'b506fd5d4a37d3343eb27194f7d9a190', '649866515edf661bb321ec7bf0ba3415', '7227e29d3bb56bd7B148-4C02-AFCB148-4C02-AFC', 1, 0, NULL, NULL),
(79, '1b306d1e5bd449798baa500bfd493bcc', '649866515edf661bb321ec7bf0ba3415', '-B148-4C02-AFC7-7463D856714A63D856714A7b0840', 1, 0, NULL, NULL),
(80, '5c559ff5f9e16e1e3c1d514390bffd34', '649866515edf661bb321ec7bf0ba3415', '5ac1fe4C020FD-B148-4C02-AFC7-7463D856714A7b0840', 1, 0, NULL, NULL),
(81, 'fd73db9c09433ebfa4da68efd6338a4e', '649866515edf661bb321ec7bf0ba3415', 'd04f7130b0e16554b6f87751b3d7eaae', 1, 0, NULL, NULL),
(82, 'f04b74ba1a216cecbe2885517de74111', '649866515edf661bb321ec7bf0ba3415', '5ac1fe36bb26e7b7b5ac1fe36bb26e7b7b049387b0840', 1, 0, NULL, NULL),
(83, 'a53e4391dbc21e81ce1651ab643d203e', '649866515edf661bb321ec7bf0ba3415', '7227e29d3bb56bd72c032ca4a650f936', 1, 0, NULL, NULL),
(84, '69f4487f3930370515a291f5d4aab2cf', '649866515edf661bb321ec7bf0ba3415', 'dd9a1981f3fea7bf472c4df99a1981f3fea7bf4', 1, 0, NULL, NULL),
(85, '792ebbe80bc3b7e51fe51dcaad764d4f', '649866515edf661bb321ec7bf0ba3415', '1a7222de13e61a10076e8b8bdfe52983', 1, 0, NULL, NULL),
(86, 'e15618ae80e865dfb8ba21fd64b9bd2c', '649866515edf661bb321ec7bf0ba3415', '2bcf89342d4e55e266173635cf9e91fc', 1, 0, NULL, NULL),
(87, '93e455976879074af606e9d9f8010e9c', '649866515edf661bb321ec7bf0ba3415', '46492bca275b05cbf2db53040ca5b7e8635cf9e91fc', 1, 0, NULL, NULL),
(88, '47b43c3fc755952505e4b5cbaf60e4d0', '649866515edf661bb321ec7bf0ba3415', '48512ae7d57b1396273f76fe6ed341a235cf9e91fc', 1, 0, NULL, NULL),
(89, '410ae239e28e6410ae239e28e6b6c72a457dcda7762d0', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '410ae239e28e6b6c72a457dcda7762d0', 1, 0, '0', '0'),
(90, '7248231d4a8d535c5bd03690435ef8609f77', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '231d4a8d535c5bd03690435ef8609f77', 1, 0, '0', '0'),
(91, '231dc2de231dc2de177458bcb272143e5e3be265777a09f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '231dc2de177458bcb272143e5e3be265777a09f77', 1, 0, '0', '0'),
(92, '2a627209c75980908hccb20753d28b94acaa201', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a627209c75ccb20753d28b94acaa201', 1, 0, '0', '0'),
(93, '2a627209c7598090b53bd1cdc1b7f0ab65aa10ab82660ae9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b53bd1cdc1b7f0ab65aa10ab82660ae9', 1, 0, '0', '0'),
(94, '2a9f3984f41fc426d1c19ae6db4f53563f9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9f3984f41fc426d1c19ae6db4f53563f', 1, 0, '0', '0'),
(95, '28120dfc2774ab8d1ef39f2d226d99371f9', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8120dfc2774ab8d1ef39f2d226d99371', 1, 0, '0', '0'),
(96, '28120dfc2736d6bb26e7b736d499d22f87eb736d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '736d6bb26e7b736d499d22f87eb736d', 1, 0, '0', '0'),
(97, '72eee7a61efbbde309d093bf4607c55a4e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'eee7a61efbbde309d093bf4607c55a4e', 1, 0, '0', '0'),
(98, '383765d7c92f99d517339d045277ee20tetwe', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '383765d7c92f99d517339d045277ee20', 1, 0, '0', '0'),
(99, 'b7436db270fab87fc70dee83fdde07714e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b7436db270fab87fc70dee83fdde0771', 1, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `modules_x_permissions`
--

CREATE TABLE IF NOT EXISTS `modules_x_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` varchar(200) NOT NULL,
  `user_group_id` varchar(200) NOT NULL,
  `module_id` varchar(200) NOT NULL,
  `permission` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=377 ;

--
-- Dumping data for table `modules_x_permissions`
--

INSERT INTO `modules_x_permissions` (`id`, `branch_id`, `user_group_id`, `module_id`, `permission`) VALUES
(1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 1111),
(2, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 1111),
(3, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 1111),
(4, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', '60715722-A689-412B-A13F-ECA29FF19523', 1111),
(5, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 1111),
(6, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 1111),
(7, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 1111),
(8, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 1111),
(9, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 1111),
(10, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 1111),
(11, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', '80B0F0FD-B148-4C02-AFC7-7463D856714Ass', 1111),
(12, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'D33AF5EF-570D-403D-B967-A5B658675B06', 1111),
(13, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 1111),
(14, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', '5464B2EF-92D2-4430-B366-983D7590FFC4', 1111),
(15, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 1111),
(16, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 1111),
(17, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 1111),
(18, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 1111),
(19, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 1111),
(20, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e732ced3463d06de0ca9a15b6153677', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 1111),
(21, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 1111),
(22, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 1111),
(23, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 1111),
(24, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '60715722-A689-412B-A13F-ECA29FF19523', 1111),
(25, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 1111),
(26, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 1111),
(27, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 1111),
(28, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 1111),
(29, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 1111),
(30, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 1111),
(31, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '80B0F0FD-B148-4C02-AFC7-7463D856714Ass', 1111),
(32, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'D33AF5EF-570D-403D-B967-A5B658675B06', 1111),
(33, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 1111),
(34, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '5464B2EF-92D2-4430-B366-983D7590FFC4', 1111),
(35, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 1111),
(36, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 1111),
(37, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 1111),
(38, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 1111),
(39, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 1111),
(40, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 1111),
(41, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 1111),
(42, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 1111),
(43, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 1111),
(44, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '60715722-A689-412B-A13F-ECA29FF19523', 1111),
(45, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 1111),
(46, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 1111),
(47, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 1111),
(48, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 1111),
(49, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 1111),
(50, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 1111),
(51, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '80B0F0FD-B148-4C02-AFC7-7463D856714Ass', 1111),
(52, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'D33AF5EF-570D-403D-B967-A5B658675B06', 1111),
(53, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 1111),
(54, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '5464B2EF-92D2-4430-B366-983D7590FFC4', 1111),
(55, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 1111),
(56, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 1111),
(57, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 1111),
(58, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 1111),
(59, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 1111),
(60, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 1111),
(61, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 1111),
(62, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 1111),
(63, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 1111),
(64, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '60715722-A689-412B-A13F-ECA29FF19523', 1111),
(65, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 1111),
(66, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 1111),
(67, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 1111),
(68, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 1111),
(69, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 1111),
(70, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 1111),
(71, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '80B0F0FD-B148-4C02-AFC7-7463D856714Ass', 1111),
(72, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'D33AF5EF-570D-403D-B967-A5B658675B06', 1111),
(73, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 1111),
(74, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '5464B2EF-92D2-4430-B366-983D7590FFC4', 1111),
(75, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 1111),
(76, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 1111),
(77, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 1111),
(78, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 1111),
(79, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 1111),
(80, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 1111),
(81, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 11111),
(82, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 11111),
(83, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 111),
(84, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '60715722-A689-412B-A13F-ECA29FF19523', 1111),
(85, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 1111),
(86, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 1111),
(87, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 1111),
(88, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 1111),
(89, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 1111),
(90, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 1111),
(91, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '80B0F0FD-B148-4C02-AFC7-7463D856714Ass', 0),
(92, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'D33AF5EF-570D-403D-B967-A5B658675B06', 0),
(93, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 0),
(94, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '5464B2EF-92D2-4430-B366-983D7590FFC4', 0),
(95, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 0),
(96, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 0),
(97, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 0),
(98, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 0),
(99, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 0),
(100, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 0),
(101, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 1111),
(102, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 1111),
(103, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 1111),
(104, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'D33AF9080F-570D-403D-B967-A5B658675B0645', 1111),
(105, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'D33AF9080F-570D-403D-B967-A5B658675B0645', 1111),
(106, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'D33AF9080F-570D-403D-B967-A5B658675B0645', 1111),
(107, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '4C020FD-B148-4C02-AFC7-7463D856714A', 1111),
(108, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '4C020FD-B148-4C02-AFC7-7463D856714A', 1111),
(109, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '4C020FD-B148-4C02-AFC7-7463D856714A', 1111),
(110, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 111),
(111, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 111),
(112, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 111),
(113, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 111),
(114, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 111),
(115, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 111),
(116, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 1111),
(117, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 111),
(118, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 111),
(119, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'ddaf13095cf7472c4df9ab7ef547311e', 1111),
(120, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '1ff1de774005f8da13f42943881c655f', 'ddaf13095cf7472c4df9ab7ef547311e', 111),
(121, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 111),
(122, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '7248797adf02e132ba3c51da343bbfd4', 1111),
(123, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7248797adf02e132ba3c51da343bbfd4', 'ddaf13095cf7472c4df9ab7ef547311e', 111),
(124, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '7248797adf02e132ba3c51da343bbfd4', 111),
(125, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '5d6caaab9ffe66d750293aedae946da6', 1111),
(126, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7248797adf02e132ba3c51da343bbfd4', '5d6caaab9ffe66d750293aedae946da6', 111),
(127, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', '5d6caaab9ffe66d750293aedae946da6', 111),
(128, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'bcfc52307913f851ded416c9283a6826', 1111),
(129, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7248797adf02e132ba3c51da343bbfd4', 'bcfc52307913f851ded416c9283a6826', 111),
(130, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '37693cfc748049e45d87b8c7d8b9aacd', 'bcfc52307913f851ded416c9283a6826', 111),
(131, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'fe36bb26e7b7b0499d22f87ebeee343c', 1111),
(132, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '5ac1b200480113f66b9e38e2387b0840', 1111),
(133, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '5ac1fe36bb26e7b7b049387b0840', 1111),
(134, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '5ac1fe36bb26e7b7b5ac1fe36bb26e7b7b049387b0840', 1111),
(135, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '5ac1fe4C020FD-B148-4C02-AFC7-7463D856714A7b0840', 1111),
(136, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '-B148-4C02-AFC7-7463D856714A63D856714A7b0840', 1111),
(137, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '7227e29d3bb56bd72c032ca4a650f936', 1111),
(138, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '506e87d5b970aa58260e534531c867f2', 1111),
(139, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'd04f7130b0e16554b6f87751b3d7eaae', 1111),
(140, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '7227e29d3bb56bd7B148-4C02-AFCB148-4C02-AFC', 1111),
(141, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', 'dd9a1981f3fea7bf472c4df99a1981f3fea7bf4', 1111),
(142, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8e296a067a37563370ded05f5a3bf3ec', '1a7222de13e61a10076e8b8bdfe52983', 1111),
(143, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'c4343269d4814ae9647f0e9029b56cc8', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 1),
(144, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '293c83cd3affe5549761849580a81c93', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 1),
(145, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 1),
(146, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 1),
(147, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 1),
(148, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '60715722-A689-412B-A13F-ECA29FF19523', 1),
(149, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 1),
(150, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 1),
(151, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 1),
(152, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 1),
(153, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 1),
(154, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 1),
(155, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'D33AF5EF-570D-403D-B967-A5B658675B06', 1),
(156, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 1),
(157, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '5464B2EF-92D2-4430-B366-983D7590FFC4', 1),
(158, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 1),
(159, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 1),
(160, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 1),
(161, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 1),
(162, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 1),
(163, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 1),
(164, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'D33AF9080F-570D-403D-B967-A5B658675B0645', 1),
(165, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 1),
(166, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 1),
(167, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 1),
(168, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 1),
(169, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'ddaf13095cf7472c4df9ab7ef547311e', 100001),
(170, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '7248797adf02e132ba3c51da343bbfd4', 1),
(171, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '5d6caaab9ffe66d750293aedae946da6', 1),
(172, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'bcfc52307913f851ded416c9283a6826', 1),
(173, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'fe36bb26e7b7b0499d22f87ebeee343c', 1),
(174, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '5ac1b200480113f66b9e38e2387b0840', 1),
(175, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '5ac1fe36bb26e7b7b049387b0840', 1),
(176, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '5ac1fe36bb26e7b7b5ac1fe36bb26e7b7b049387b0840', 1),
(177, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '5ac1fe4C020FD-B148-4C02-AFC7-7463D856714A7b0840', 1),
(178, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '-B148-4C02-AFC7-7463D856714A63D856714A7b0840', 100001),
(179, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', '7227e29d3bb56bd72c032ca4a650f936', 10001),
(180, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a4b555073510923a2c33c6a0b3827e8a', 'd04f7130b0e16554b6f87751b3d7eaae', 11001),
(223, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 0),
(224, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'D33AF9080F-570D-403D-B967-A5B658675B0645', 0),
(225, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 0),
(226, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 0),
(227, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 0),
(228, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'ddaf13095cf7472c4df9ab7ef547311e', 0),
(229, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '7248797adf02e132ba3c51da343bbfd4', 0),
(230, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '5d6caaab9ffe66d750293aedae946da6', 0),
(231, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'bcfc52307913f851ded416c9283a6826', 0),
(232, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'fe36bb26e7b7b0499d22f87ebeee343c', 0),
(233, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '5ac1b200480113f66b9e38e2387b0840', 0),
(234, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '5ac1fe36bb26e7b7b049387b0840', 0),
(235, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '5ac1fe36bb26e7b7b5ac1fe36bb26e7b7b049387b0840', 0),
(236, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '5ac1fe4C020FD-B148-4C02-AFC7-7463D856714A7b0840', 0),
(237, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '-B148-4C02-AFC7-7463D856714A63D856714A7b0840', 0),
(238, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '7227e29d3bb56bd72c032ca4a650f936', 0),
(239, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'd04f7130b0e16554b6f87751b3d7eaae', 0),
(240, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '7227e29d3bb56bd7B148-4C02-AFCB148-4C02-AFC', 0),
(241, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'dd9a1981f3fea7bf472c4df99a1981f3fea7bf4', 0),
(242, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b6d767d2f8ed5d21a44b0e5886680cb9', '1a7222de13e61a10076e8b8bdfe52983', 11),
(243, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 0),
(244, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 0),
(245, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 0),
(246, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '60715722-A689-412B-A13F-ECA29FF19523', 0),
(247, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 0),
(248, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 0),
(249, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 0),
(250, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 0),
(251, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 0),
(252, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 0),
(253, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'D33AF5EF-570D-403D-B967-A5B658675B06', 0),
(254, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 0),
(255, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '5464B2EF-92D2-4430-B366-983D7590FFC4', 0),
(256, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 0),
(257, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 0),
(258, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 0),
(259, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 0),
(260, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 0),
(261, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 0),
(262, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'D33AF9080F-570D-403D-B967-A5B658675B0645', 0),
(263, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 0),
(264, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 0),
(265, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 0),
(266, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 0),
(267, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'ddaf13095cf7472c4df9ab7ef547311e', 0),
(268, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '7248797adf02e132ba3c51da343bbfd4', 0),
(269, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '5d6caaab9ffe66d750293aedae946da6', 0),
(270, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'bcfc52307913f851ded416c9283a6826', 0),
(271, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'fe36bb26e7b7b0499d22f87ebeee343c', 0),
(272, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '5ac1b200480113f66b9e38e2387b0840', 0),
(273, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '5ac1fe36bb26e7b7b049387b0840', 0),
(274, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '5ac1fe36bb26e7b7b5ac1fe36bb26e7b7b049387b0840', 0),
(275, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '5ac1fe4C020FD-B148-4C02-AFC7-7463D856714A7b0840', 0),
(276, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '-B148-4C02-AFC7-7463D856714A63D856714A7b0840', 0),
(277, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '7227e29d3bb56bd72c032ca4a650f936', 0),
(278, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'd04f7130b0e16554b6f87751b3d7eaae', 0),
(279, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '7227e29d3bb56bd7B148-4C02-AFCB148-4C02-AFC', 0),
(280, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', 'dd9a1981f3fea7bf472c4df99a1981f3fea7bf4', 0),
(281, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gsgertyrweyerye', '1a7222de13e61a10076e8b8bdfe52983', 11),
(282, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 1),
(283, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 0),
(284, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 0),
(285, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '60715722-A689-412B-A13F-ECA29FF19523', 0),
(286, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 0),
(287, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 0),
(288, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 0),
(289, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 0),
(290, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 0),
(291, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 0),
(292, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'D33AF5EF-570D-403D-B967-A5B658675B06', 0),
(293, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 0),
(294, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '5464B2EF-92D2-4430-B366-983D7590FFC4', 0),
(295, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 0),
(296, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 0),
(297, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 0),
(298, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 0),
(299, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 0),
(300, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 0),
(301, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'D33AF9080F-570D-403D-B967-A5B658675B0645', 0),
(302, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 0),
(303, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 0),
(304, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 0),
(305, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 0),
(306, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'ddaf13095cf7472c4df9ab7ef547311e', 0),
(307, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '7248797adf02e132ba3c51da343bbfd4', 0),
(308, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '5d6caaab9ffe66d750293aedae946da6', 0),
(309, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'bcfc52307913f851ded416c9283a6826', 0),
(310, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'fe36bb26e7b7b0499d22f87ebeee343c', 0),
(311, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '5ac1b200480113f66b9e38e2387b0840', 0),
(312, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '5ac1fe36bb26e7b7b049387b0840', 0),
(313, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '5ac1fe36bb26e7b7b5ac1fe36bb26e7b7b049387b0840', 0),
(314, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '5ac1fe4C020FD-B148-4C02-AFC7-7463D856714A7b0840', 0),
(315, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '-B148-4C02-AFC7-7463D856714A63D856714A7b0840', 0),
(316, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '7227e29d3bb56bd72c032ca4a650f936', 0),
(317, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'd04f7130b0e16554b6f87751b3d7eaae', 0),
(318, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '7227e29d3bb56bd7B148-4C02-AFCB148-4C02-AFC', 0),
(319, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', 'dd9a1981f3fea7bf472c4df99a1981f3fea7bf4', 1),
(320, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54064aecaf5cc9c73baa1bee4e1621ef', '1a7222de13e61a10076e8b8bdfe52983', 1),
(321, 'BE446492bca275b05cbf2db53040ca5b7e8635cf9e91fc', '54064aecaf5cc9c73baa1bee4e1621ef', '46492bca275b05cbf2db53040ca5b7e8635cf9e91fc', 1),
(322, '2bcf89342d4e55e266173635cf9e91fc91fc', '54064aecaf5cc9c73baa1bee4e1621ef', '2bcf89342d4e55e266173635cf9e91fc', 1),
(323, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '80B0F0FD-B148-4C02-AFC7-7463D856714A', 11111),
(324, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '892367F9-98AC-47B2-B6B7-C9268EBFFE87', 11111),
(325, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'FF2CD316-E154-4A6E-8A7E-6514365242EE', 11111),
(326, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '92ECECEE-9484-4941-BA0F-28EC165E4FF8', 111),
(327, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '60715722-A689-412B-A13F-ECA29FF19523', 11111),
(328, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'FAECB8C6-1AFE-44E8-A654-087A43A93FFB', 11111),
(329, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'C0920814-A3DE-48A1-8825-928D32BE0B1E', 11111),
(330, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'CAB43E25-264E-47B7-84D8-1E41583CA69E', 11111),
(331, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'D6BC7342-1CF1-4EC6-816C-6D53F9A5191B', 11111),
(332, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'B3A03076-14E9-4C0A-9B13-4F8DF9D6145D', 11111),
(333, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'D33AF5EF-570D-403D-B967-A5B658675B06', 0),
(334, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '9252FCEE-011A-425A-BB41-E9D5A5E7792A', 0),
(335, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '5464B2EF-92D2-4430-B366-983D7590FFC4', 0),
(336, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '23B67A1A-0675-4DE9-98E3-7ACFA6637F25', 0),
(337, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'DA79AE6E-7D46-4BB4-AD47-CD37F5BBB615', 0),
(338, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '3AAFF903-73E6-4987-BFE1-8F24E268BDC9', 0),
(339, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '6D825F4C-44E0-4CF4-8FD2-A5FEA57E8FC1', 0),
(340, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'B299A7BB-7709-4B0B-966E-023F1CA77058', 0),
(341, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'B499A7BB-8709-4B0B-966E-023F1CA77058', 0),
(342, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'CAB43E25-264TYE-47B7-84D8-1E41583CA69E', 0),
(343, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'D33AF9080F-570D-403D-B967-A5B658675B0645', 0),
(344, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '7248797adf02e132ba3c51da343bbfd4', 0),
(345, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'B499A7TWV889-7H8FSG-8709-023F-4B0B-966E-023F1CA77058-023', 0),
(346, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'B499A7BB-8709-023F-4B0B-966E-023F1CA77058-023', 0),
(347, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'B499A7BB-7709-4B0B-966E-023F1CA77057', 0),
(348, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '4B0B-4B0B-7709-4B0B-966E-023F1CA-4B0B', 0),
(349, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'ddaf13095cf7472c4df9ab7ef547311e', 0),
(350, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '5d6caaab9ffe66d750293aedae946da6', 0),
(351, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'bcfc52307913f851ded416c9283a6826', 0),
(352, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'fe36bb26e7b7b0499d22f87ebeee343c', 0),
(353, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '5ac1b200480113f66b9e38e2387b0840', 0),
(354, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '5ac1fe36bb26e7b7b049387b0840', 0),
(355, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '7227e29d3bb56bd7B148-4C02-AFCB148-4C02-AFC', 0),
(356, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '-B148-4C02-AFC7-7463D856714A63D856714A7b0840', 0),
(357, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '5ac1fe4C020FD-B148-4C02-AFC7-7463D856714A7b0840', 0),
(358, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'd04f7130b0e16554b6f87751b3d7eaae', 0),
(359, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '5ac1fe36bb26e7b7b5ac1fe36bb26e7b7b049387b0840', 0),
(360, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '7227e29d3bb56bd72c032ca4a650f936', 0),
(361, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', 'dd9a1981f3fea7bf472c4df99a1981f3fea7bf4', 0),
(362, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '1a7222de13e61a10076e8b8bdfe52983', 0),
(363, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '2bcf89342d4e55e266173635cf9e91fc', 0),
(364, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '46492bca275b05cbf2db53040ca5b7e8635cf9e91fc', 0),
(365, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '48512ae7d57b1396273f76fe6ed341a235cf9e91fc', 0),
(366, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '410ae239e28e6b6c72a457dcda7762d0', 0),
(367, '649866515edf661bb321ec7bf0ba3415', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '231d4a8d535c5bd03690435ef8609f77', 0),
(368, '231dc2de177458bcb272143e5e3be265777a09f77415', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '231dc2de177458bcb272143e5e3be265777a09f77', 0),
(369, '231dc2de177458bcb272143e5e3be265777a09f77415', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2a627209c75ccb20753d28b94acaa201', 0),
(370, 'b53bd1cdc1b7f0ab65aa10ab82660ae977a09f77415', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'b53bd1cdc1b7f0ab65aa10ab82660ae9', 0),
(371, '9f3984f41fc426d1c19ae6db4f53563f15', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9f3984f41fc426d1c19ae6db4f53563f', 0),
(372, '98120dfc2774ab8d1ef39f2d226d99371dfhd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8120dfc2774ab8d1ef39f2d226d99371', 0),
(373, '98120dfc2774ab8d1ef39f2d226d99371dfhd', 'c2de177458bcb272143e5e3be265777a', '736d6bb26e7b736d499d22f87eb736d', 0),
(374, '98120dfc2774ab8d1ef39f2d226d99371dfhd', 'c2de177458bcb272143e5e3be265777a', 'eee7a61efbbde309d093bf4607c55a4e', 0),
(375, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'c2de177458bcb272143e5e3be265777a', '383765d7c92f99d517339d045277ee20', 0),
(376, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'c2de177458bcb272143e5e3be265777a', 'b7436db270fab87fc70dee83fdde0771', 0);

-- --------------------------------------------------------

--
-- Table structure for table `opening_stock`
--

CREATE TABLE IF NOT EXISTS `opening_stock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `remark` varchar(300) NOT NULL,
  `note` varchar(300) NOT NULL,
  `no_items` int(11) NOT NULL,
  `total_amount` decimal(30,3) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `stock_status` int(11) NOT NULL DEFAULT '0',
  `branch_id` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `opening_stock`
--

INSERT INTO `opening_stock` (`id`, `guid`, `code`, `date`, `remark`, `note`, `no_items`, `total_amount`, `active_status`, `delete_status`, `stock_status`, `branch_id`, `deleted_by`, `added_by`) VALUES
(25, 'f4206a8912721c53b84894ee83a02900', 'OS18', 1400112000, 'bxcbxc', 'xcvbx', 1, '45450.000', 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(26, '063c5a4037dab38c58120c140d340eb1', 'OS19', 1400198400, 'xcvbxcbb', 'xcv', 1, '45900.000', 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(27, '795824c2f99079b55823b8d6f388a550', 'OS20', 1400198400, 'safasf', 'asf', 4, '15642.000', 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `opening_stock_x_items`
--

CREATE TABLE IF NOT EXISTS `opening_stock_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `opening_stock_id` varchar(255) NOT NULL,
  `stock_id` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quty` int(11) NOT NULL,
  `cost` decimal(30,3) NOT NULL,
  `sell` decimal(30,3) NOT NULL,
  `discount_per` decimal(30,3) NOT NULL,
  `discount_amount` decimal(30,3) NOT NULL,
  `tax` decimal(30,3) NOT NULL,
  `amount` decimal(30,3) NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `opening_stock_x_items`
--

INSERT INTO `opening_stock_x_items` (`id`, `guid`, `opening_stock_id`, `stock_id`, `item`, `quty`, `cost`, `sell`, `discount_per`, `discount_amount`, `tax`, `amount`, `supplier_id`) VALUES
(38, '3c2e2d7e4f8642ff6d668017e8f5a116', 'f4206a8912721c53b84894ee83a02900', '', '9d8439c7f35923f2397af1b7edadc670', 1000, '45.000', '676.000', '1.000', '450.000', '900.000', '45000.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(39, '8671719b870ef46cff4f744c4b2f4392', '063c5a4037dab38c58120c140d340eb1', '', '9d8439c7f35923f2397af1b7edadc670', 1000, '45.000', '676.000', '0.000', '0.000', '900.000', '45000.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(40, 'a9dc73b348cb6ca3d6059951497d9d0c', '795824c2f99079b55823b8d6f388a550', '', 'c3216f7d74d4adcf50901b8559d9a3bc', 100, '45.000', '60.000', '1.000', '45.000', '2520.000', '4500.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(41, '2e0ead641065c8a91a1dd8ca204d8394', '795824c2f99079b55823b8d6f388a550', '', 'abc049b9d095c27843b114f02ac5f640', 100, '56.000', '75.000', '1.000', '56.000', '0.000', '5600.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(42, '1ec2eb002fec664d670a58e991de9f6c', '795824c2f99079b55823b8d6f388a550', '', 'ef92a1dc9701ac89a655927183a78d87', 100, '12.000', '15.000', '1.000', '12.000', '0.000', '1200.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(43, 'fd1a497f416a93fa64248f5b1864f1f4', '795824c2f99079b55823b8d6f388a550', '', '23b6fb71c13f7a53235835584c0a600f', 100, '45.000', '48.000', '1.000', '45.000', '0.000', '4500.000', 'ceab8c7d14f12aaeec1dc19b3d81212a');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `payment_date` int(20) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `return_id` varchar(255) NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  `payable_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `amount` decimal(55,3) NOT NULL,
  `memo` varchar(300) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `added_date` int(20) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `deleted_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `guid`, `code`, `branch_id`, `type`, `payment_date`, `invoice_id`, `return_id`, `supplier_id`, `payable_id`, `customer_id`, `amount`, `memo`, `added_by`, `added_date`, `delete_status`, `deleted_by`) VALUES
(100, '617b641789aef9c7bc397789dafc5c86', 'IN-16', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'debit', 1405189800, 'd5b164f4c2a831aae3b09964c8be1a50', '', 'ceab8c7d14f12aaeec1dc19b3d81212a', '54afd3b94f1f956d1c56a33766f3b3dd', '', '100000.000', 'jk', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1405189800, 0, ''),
(101, '374ac5e02bd10c73c97ac98007a3b131', 'IN-17', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'debit', 1405189800, 'd5b164f4c2a831aae3b09964c8be1a50', '', 'ceab8c7d14f12aaeec1dc19b3d81212a', '54afd3b94f1f956d1c56a33766f3b3dd', '', '43925.000', 'hjk', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1405189800, 0, ''),
(102, 'e39ad9845968ce7f755d7ff8c1447544', 'CP-121', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'credit', 1405189800, '5c94445dbd8049f731a60a74c2467bb3', '', '', '2eeec83f63011ae493df6a6165c7296a', '0f7c80352b128f9a45d25e42d1ebd19e', '1029.000', 'hjk', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1405189800, 0, ''),
(103, 'f4e3e738f97114efa0d4c855ced30596', 'IN-18', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'debit', 1405189800, 'd5b164f4c2a831aae3b09964c8be1a50', '4ccc5698e1537425e88bd025e85cd315', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '', '843.000', 'dsgsd', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1405189800, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `price_tag_designs`
--

CREATE TABLE IF NOT EXISTS `price_tag_designs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `design` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `box_width` varchar(11) NOT NULL,
  `box_height` varchar(11) NOT NULL,
  `label` varchar(255) NOT NULL DEFAULT '0',
  `left` varchar(255) NOT NULL DEFAULT '0',
  `top` varchar(255) NOT NULL,
  `bold` varchar(255) NOT NULL,
  `italic` varchar(50) NOT NULL,
  `under_line` varchar(50) NOT NULL,
  `size` varchar(20) NOT NULL,
  `color` varchar(100) NOT NULL DEFAULT '0,0,0',
  `width` varchar(20) NOT NULL,
  `height` varchar(20) NOT NULL,
  `transform` varchar(20) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `price_tag_designs`
--

INSERT INTO `price_tag_designs` (`id`, `design`, `image`, `box_width`, `box_height`, `label`, `left`, `top`, `bold`, `italic`, `under_line`, `size`, `color`, `width`, `height`, `transform`, `content`) VALUES
(21, 'GD1', '', '348', '150', 'label', '211.5', '92.80000305175781', '400', 'normal', 'none', '13', '51, 51, 51', '113', '25', '0', 'All Tax Is Inclusive'),
(22, 'GD1', '', '348', '150', 'store', '138.5', '66.80000305175781', '400', 'normal', 'none', '13', '0, 0, 0', '100', '41', '0', ''),
(23, 'GD1', '', '348', '150', 'product', '133.5', '29.800003051757812', '400', 'normal', 'none', '13', '0, 0, 0', '136', '41', '0', ''),
(24, 'GD1', '', '348', '150', 'price_label', '11.5', '19.800003051757812', '400', 'normal', 'none', '25', '0, 0, 0', '100', '58', '0', ''),
(25, 'GD1', '', '348', '150', 'barcode', '2.5', '64.80000305175781', '0', '0', '0', '0', '0,0,0', '0', '0', '0', ''),
(26, 'GD2', '1ebcce6fbac529e98b392f8a4fb98a66.jpg', '454', '220', 'store', '218', '150', '400', 'normal', 'none', '13', '0, 0, 0', '100', '41', '0', ''),
(27, 'GD2', '1ebcce6fbac529e98b392f8a4fb98a66.jpg', '454', '220', 'product', '201', '89', '400', 'normal', 'none', '13', '0, 0, 0', '136', '41', '0', ''),
(28, 'GD2', '1ebcce6fbac529e98b392f8a4fb98a66.jpg', '454', '220', 'price_label', '66', '11', '400', 'normal', 'none', '25', '0, 0, 0', '100', '58', '0', ''),
(29, 'GD2', '1ebcce6fbac529e98b392f8a4fb98a66.jpg', '454', '220', 'barcode', '49', '86', '0', '0', '0', '0', '0,0,0', '0', '0', '0', ''),
(30, '', 'dae11fb94926ab1c96e6a089013150c0.jpg', '454', '220', 'store', '245.5', '77.80000305175781', '400', 'normal', 'none', '13', '0, 0, 0', '100', '41', '0', ''),
(31, '', 'dae11fb94926ab1c96e6a089013150c0.jpg', '454', '220', 'product', '242.5', '127.80000305175781', '400', 'normal', 'none', '13', '0, 0, 0', '136', '41', '0', ''),
(32, '', 'dae11fb94926ab1c96e6a089013150c0.jpg', '454', '220', 'price_label', '52.5', '124.80000305175781', '400', 'normal', 'none', '25', '0, 0, 0', '100', '58', '0', ''),
(33, '', 'dae11fb94926ab1c96e6a089013150c0.jpg', '454', '220', 'barcode', '51.5', '28.800003051757812', '0', '0', '0', '0', '0,0,0', '0', '0', '0', ''),
(34, '122', 'dae11fb94926ab1c96e6a089013150c0.jpg', '454', '220', 'store', '245.5', '78.03334045410156', '400', 'normal', 'none', '13', '0, 0, 0', '100', '41', '0', ''),
(35, '122', 'dae11fb94926ab1c96e6a089013150c0.jpg', '454', '220', 'product', '242.5', '128.03334045410156', '400', 'normal', 'none', '13', '0, 0, 0', '136', '41', '0', ''),
(36, '122', 'dae11fb94926ab1c96e6a089013150c0.jpg', '454', '220', 'price_label', '52.5', '125.03334045410156', '400', 'normal', 'none', '25', '0, 0, 0', '100', '58', '0', ''),
(37, '122', 'dae11fb94926ab1c96e6a089013150c0.jpg', '454', '220', 'barcode', '51.5', '29.033340454101562', '0', '0', '0', '0', '0,0,0', '0', '0', '0', ''),
(42, 'GD-67', 'a979053f731ac4953911e62af7e51bc0.jpg', '454', '220', 'store', '286.5', '70.80000305175781', '400', 'normal', 'none', '13', '0, 0, 0', '100', '41', '0', ''),
(43, 'GD-67', 'a979053f731ac4953911e62af7e51bc0.jpg', '454', '220', 'product', '270.5', '136.8000030517578', '400', 'normal', 'none', '13', '0, 0, 0', '136', '41', '0', ''),
(44, 'GD-67', 'a979053f731ac4953911e62af7e51bc0.jpg', '454', '220', 'price_label', '45.5', '123.80000305175781', '400', 'normal', 'none', '25', '0, 0, 0', '100', '58', '0', ''),
(45, 'GD-67', 'a979053f731ac4953911e62af7e51bc0.jpg', '454', '220', 'barcode', '37.5', '30.800003051757812', '0', '0', '0', '0', '0,0,0', '0', '0', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice`
--

CREATE TABLE IF NOT EXISTS `purchase_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `date` int(20) NOT NULL,
  `direct_invoice_id` varchar(255) NOT NULL,
  `grn` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `purchase_invoice`
--

INSERT INTO `purchase_invoice` (`id`, `guid`, `invoice`, `date`, `direct_invoice_id`, `grn`, `po`, `supplier_id`, `remark`, `note`, `branch_id`, `added_by`) VALUES
(43, 'd5b164f4c2a831aae3b09964c8be1a50', 'INV-101109', 1405103400, '', '050b4d660171b94a10131fb4f89f1410', 'non', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'dfhdfh', 'dfh', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE IF NOT EXISTS `purchase_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) DEFAULT NULL,
  `order_id` varchar(200) NOT NULL,
  `grn_id` varchar(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quty` varchar(100) NOT NULL,
  `received_quty` decimal(55,0) NOT NULL,
  `received_free` decimal(10,0) NOT NULL,
  `free` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `sell` varchar(100) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `discount_per` decimal(55,0) NOT NULL,
  `discount_amount` decimal(55,0) NOT NULL,
  `tax` decimal(55,0) NOT NULL,
  `date` int(39) NOT NULL,
  `time` int(20) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `deleted_by` varchar(200) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=229 ;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `guid`, `order_id`, `grn_id`, `invoice_id`, `branch_id`, `item`, `quty`, `received_quty`, `received_free`, `free`, `cost`, `sell`, `mrp`, `amount`, `discount_per`, `discount_amount`, `tax`, `date`, `time`, `active`, `active_status`, `delete_status`, `deleted_by`, `added_by`) VALUES
(223, '70e63bbd7b9528c41f8b0ecb25cd9728', '050b4d660171b94a10131fb4f89f1410', '', 'd5b164f4c2a831aae3b09964c8be1a50', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '100', '0', '0', '100', '25', '50', '76', '2500', '0', '0', '125', 0, 1405265853, 1, 1, 0, '', ''),
(224, '3594c4c614ae72994664a1df0fb672f9', '050b4d660171b94a10131fb4f89f1410', '', 'd5b164f4c2a831aae3b09964c8be1a50', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', '1000', '0', '0', '0', '26', '51', '78', '26000', '0', '0', '1300', 0, 1405265853, 1, 1, 0, '', ''),
(225, '3dd84b590be2026d36bce1a76cc06cfc', '050b4d660171b94a10131fb4f89f1410', '', 'd5b164f4c2a831aae3b09964c8be1a50', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', '1000', '0', '0', '0', '27', '52', '79', '27000', '0', '0', '1350', 0, 1405265853, 1, 1, 0, '', ''),
(226, '3ddb08eca6dd3bce99b6c391065c69bb', '050b4d660171b94a10131fb4f89f1410', '', 'd5b164f4c2a831aae3b09964c8be1a50', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', '1000', '0', '0', '0', '28', '53', '80', '28000', '0', '0', '1400', 0, 1405265853, 1, 1, 0, '', ''),
(227, '33b67716469200c00258262f86b6e603', '050b4d660171b94a10131fb4f89f1410', '', 'd5b164f4c2a831aae3b09964c8be1a50', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', '1000', '0', '0', '0', '29', '54', '81', '29000', '0', '0', '1450', 0, 1405265853, 1, 1, 0, '', ''),
(228, 'ef8574a7d75dcf0a7ae9b2d269c02df7', '050b4d660171b94a10131fb4f89f1410', '', 'd5b164f4c2a831aae3b09964c8be1a50', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '24127619c056a21da783938396bffbc2', '1000', '0', '0', '0', '30', '55', '82', '30000', '0', '0', '1500', 0, 1405265853, 1, 1, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `supplier_id` varchar(200) NOT NULL,
  `exp_date` int(20) NOT NULL,
  `po_no` varchar(200) NOT NULL,
  `po_date` int(20) NOT NULL,
  `discount` varchar(200) NOT NULL,
  `discount_amt` varchar(200) NOT NULL,
  `freight` varchar(200) NOT NULL,
  `round_amt` varchar(200) NOT NULL,
  `total_items` varchar(200) NOT NULL,
  `total_amt` varchar(200) NOT NULL,
  `total_item_amt` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `order_cancel` int(11) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `order_status` int(11) NOT NULL,
  `grn_status` int(11) NOT NULL,
  `received_status` int(11) NOT NULL,
  `expire_status` int(11) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `deleted_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

CREATE TABLE IF NOT EXISTS `purchase_return` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `purchase_invoice_id` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `remark` varchar(300) NOT NULL,
  `note` varchar(300) NOT NULL,
  `no_items` int(11) NOT NULL,
  `total_amount` decimal(30,3) NOT NULL,
  `paid_amount` decimal(30,3) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `stock_status` int(11) NOT NULL DEFAULT '0',
  `branch_id` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `purchase_return`
--

INSERT INTO `purchase_return` (`id`, `guid`, `purchase_invoice_id`, `code`, `date`, `remark`, `note`, `no_items`, `total_amount`, `paid_amount`, `payment_status`, `active_status`, `delete_status`, `stock_status`, `branch_id`, `deleted_by`, `added_by`) VALUES
(1, '4ccc5698e1537425e88bd025e85cd315', 'd5b164f4c2a831aae3b09964c8be1a50', 'PR-10111', 1405276200, 'SDG', 'GSDG', 3, '843.000', '843.000', 0, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_x_items`
--

CREATE TABLE IF NOT EXISTS `purchase_return_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `purchase_return_id` varchar(255) NOT NULL,
  `stocks_history_id` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quty` int(11) NOT NULL,
  `cost` decimal(30,3) NOT NULL,
  `sell` decimal(30,3) NOT NULL,
  `discount_per` decimal(30,3) NOT NULL,
  `discount_amount` decimal(30,3) NOT NULL,
  `tax` decimal(30,3) NOT NULL,
  `amount` decimal(30,3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `purchase_return_x_items`
--

INSERT INTO `purchase_return_x_items` (`id`, `guid`, `purchase_return_id`, `stocks_history_id`, `item`, `quty`, `cost`, `sell`, `discount_per`, `discount_amount`, `tax`, `amount`) VALUES
(18, 'f5273d79baed832d459edf6a48869ed3', '4ccc5698e1537425e88bd025e85cd315', '76554f0159dc5b2da561f04a0b527f94', '024477833686497e686ec4c62508bf4b', 10, '26.000', '0.000', '0.000', '0.000', '13.000', '260.000'),
(19, '2d53ed14d0eb25e6a625f6f3e4a5969b', '4ccc5698e1537425e88bd025e85cd315', '5d2b04f546e6bb770c5fb8737ee997ac', '24127619c056a21da783938396bffbc2', 10, '30.000', '0.000', '0.000', '0.000', '15.000', '300.000'),
(20, '365d13381375503e219fe1d679fb3cef', '4ccc5698e1537425e88bd025e85cd315', 'e9fe68c00bce833fd827cdf66c57930a', '2f3fa40a2a3f42cceb2d65551f541f66', 10, '27.000', '0.000', '0.000', '0.000', '13.500', '270.000');

-- --------------------------------------------------------

--
-- Table structure for table `sales_bill`
--

CREATE TABLE IF NOT EXISTS `sales_bill` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `date` int(20) NOT NULL,
  `so` varchar(255) NOT NULL DEFAULT 'non',
  `sdn` varchar(255) NOT NULL DEFAULT 'non',
  `direct_sales_id` varchar(255) NOT NULL DEFAULT 'non',
  `customer_id` varchar(255) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `sales_bill`
--

INSERT INTO `sales_bill` (`id`, `guid`, `invoice`, `date`, `so`, `sdn`, `direct_sales_id`, `customer_id`, `remark`, `note`, `branch_id`, `added_by`) VALUES
(86, '5c94445dbd8049f731a60a74c2467bb3', 'SB-132', 1405189800, 'non', 'non', 'e18f2cfa7491b1659efac9291af244eb', '0f7c80352b128f9a45d25e42d1ebd19e', 'vcnc', 'cvb', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `sales_delivery_note`
--

CREATE TABLE IF NOT EXISTS `sales_delivery_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) NOT NULL,
  `so` varchar(255) NOT NULL,
  `sales_delivery_note_no` varchar(255) NOT NULL,
  `date` int(20) NOT NULL,
  `total_amount` decimal(20,3) NOT NULL,
  `total_tax` decimal(30,3) NOT NULL,
  `total_discount` decimal(30,3) NOT NULL,
  `customer_discount` decimal(30,3) NOT NULL,
  `customer_discount_amount` decimal(30,3) NOT NULL,
  `note` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `total_item_amt` decimal(30,3) NOT NULL,
  `total_amt` decimal(30,3) NOT NULL,
  `sales_delivery_note_status` int(11) NOT NULL,
  `bill_status` int(11) NOT NULL DEFAULT '0',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE IF NOT EXISTS `sales_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) DEFAULT NULL,
  `sales_order_id` varchar(200) NOT NULL,
  `direct_sales_id` varchar(255) NOT NULL,
  `delivery_note_id` varchar(255) NOT NULL,
  `direct_sales_delivery_id` varchar(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quty` varchar(100) NOT NULL,
  `delivered_quty` int(11) NOT NULL,
  `price` decimal(55,3) NOT NULL,
  `discount` decimal(10,3) NOT NULL,
  `tax` int(11) NOT NULL,
  `stock_id` varchar(200) NOT NULL,
  `time` int(20) NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `sales_items`
--

INSERT INTO `sales_items` (`id`, `guid`, `sales_order_id`, `direct_sales_id`, `delivery_note_id`, `direct_sales_delivery_id`, `invoice_id`, `item`, `quty`, `delivered_quty`, `price`, `discount`, `tax`, `stock_id`, `time`, `branch_id`) VALUES
(105, '1d61736b17cc7d532c3963de61ab0f48', '8f4cdb31459f23ddbdff550c351efc51', '', '8b128d99e8936a376255ce2499c850bf', '', 'd7ac77810d95f2ef3b56e66987ff2d53', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '100', 100, '50.000', '0.000', 5, '2bd13e5fcd7345b40d21dff327a0a6dc', 1405162926, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(106, '3c9c8382c8228b41127e657f30747ed2', '8f4cdb31459f23ddbdff550c351efc51', '', '8b128d99e8936a376255ce2499c850bf', '', 'd7ac77810d95f2ef3b56e66987ff2d53', 'ada0bb484b3191f9925b1cb8f9d9ffbd', '100', 100, '15.000', '0.000', 5, 'a9a57aac0c9c1912e643e86dd50cc172', 1405162926, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(107, '743e7b8f1cf06a9915386b8a0915ed3f', '8f4cdb31459f23ddbdff550c351efc51', '', '8b128d99e8936a376255ce2499c850bf', '', 'd7ac77810d95f2ef3b56e66987ff2d53', '5a20f38e08ec86e84c052aaf894f3911', '100', 100, '125.000', '0.000', 2, 'eb4f13dcb1bef5d8908095c7b0b4da8cabbffOIU', 1405162926, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(108, '7abc9b388a93b7932e5a47ef8e162ded', '', 'e18f2cfa7491b1659efac9291af244eb', '', '', '5c94445dbd8049f731a60a74c2467bb3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '10', 0, '50.000', '0.000', 5, '497fab5cbead27f6e9a6d6771d6ebc5c', 1405266671, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(109, '221e102540de22598029576d04a93c5c', '', 'e18f2cfa7491b1659efac9291af244eb', '', '', '5c94445dbd8049f731a60a74c2467bb3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '10', 0, '50.000', '0.000', 5, '9bea95d3b0b896d6cf3174e6974c4661', 1405266671, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE IF NOT EXISTS `sales_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `quotation_id` varchar(255) NOT NULL,
  `customer_id` varchar(200) NOT NULL,
  `exp_date` int(20) NOT NULL,
  `code` varchar(200) NOT NULL,
  `date` int(20) NOT NULL,
  `discount` decimal(30,3) NOT NULL,
  `discount_amt` decimal(30,3) NOT NULL,
  `customer_discount` decimal(30,3) NOT NULL,
  `customer_discount_amount` decimal(30,3) NOT NULL,
  `freight` varchar(200) NOT NULL,
  `round_amt` varchar(200) NOT NULL,
  `total_tax` decimal(30,3) NOT NULL,
  `total_discount` decimal(30,3) NOT NULL,
  `total_items` varchar(200) NOT NULL,
  `total_amt` varchar(200) NOT NULL,
  `total_item_amt` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `order_status` int(2) NOT NULL,
  `receipt_status` int(2) NOT NULL,
  `received_status` int(11) NOT NULL,
  `expire_status` int(11) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `deleted_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_quotation`
--

CREATE TABLE IF NOT EXISTS `sales_quotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `customer_id` varchar(200) NOT NULL,
  `exp_date` int(20) NOT NULL,
  `code` varchar(200) NOT NULL,
  `date` int(20) NOT NULL,
  `discount` decimal(30,3) NOT NULL,
  `discount_amt` decimal(30,3) NOT NULL,
  `customer_discount` decimal(20,3) NOT NULL,
  `customer_discount_amount` decimal(20,3) NOT NULL,
  `freight` decimal(30,3) NOT NULL,
  `round_amt` decimal(33,3) NOT NULL,
  `total_tax` decimal(30,3) NOT NULL,
  `total_discount` decimal(30,3) NOT NULL,
  `total_items` int(11) NOT NULL,
  `total_amt` decimal(30,3) NOT NULL,
  `total_item_amt` decimal(30,3) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `sales_order_status` int(2) NOT NULL DEFAULT '0',
  `quotation_cancel` int(2) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `quotation_status` int(2) NOT NULL,
  `order_status` int(2) NOT NULL,
  `expire_status` int(11) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `deleted_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_quotation_x_items`
--

CREATE TABLE IF NOT EXISTS `sales_quotation_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) DEFAULT NULL,
  `quotation_id` varchar(200) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quty` varchar(100) NOT NULL,
  `price` decimal(55,3) NOT NULL,
  `discount` decimal(10,3) NOT NULL,
  `stock_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return`
--

CREATE TABLE IF NOT EXISTS `sales_return` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `sales_bill_id` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `remark` varchar(300) NOT NULL,
  `note` varchar(300) NOT NULL,
  `no_items` int(11) NOT NULL,
  `total_amount` decimal(30,3) NOT NULL,
  `paid_amount` decimal(30,3) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `stock_status` int(11) NOT NULL DEFAULT '0',
  `branch_id` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sales_return`
--

INSERT INTO `sales_return` (`id`, `guid`, `sales_bill_id`, `code`, `date`, `remark`, `note`, `no_items`, `total_amount`, `paid_amount`, `payment_status`, `active_status`, `delete_status`, `stock_status`, `branch_id`, `deleted_by`, `added_by`) VALUES
(1, '49fb69e49450260870c6bf10a3ada098', 'd7ac77810d95f2ef3b56e66987ff2d53', 'SR-1013', 1405189800, 'sgsg', 'sdg', 2, '1775.000', '1775.000', 0, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_x_items`
--

CREATE TABLE IF NOT EXISTS `sales_return_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `sales_return_id` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quty` int(11) NOT NULL,
  `sell` decimal(30,3) NOT NULL,
  `tax` decimal(30,3) NOT NULL,
  `amount` decimal(30,3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sales_return_x_items`
--

INSERT INTO `sales_return_x_items` (`id`, `guid`, `sales_return_id`, `item`, `quty`, `sell`, `tax`, `amount`) VALUES
(1, 'b7e3e2db73932336a6fe940661d5f02d', '49fb69e49450260870c6bf10a3ada098', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 10, '50.000', '25.000', '500.000'),
(2, '4a4a33f549456100a9e5e5b3fb176a1f', '49fb69e49450260870c6bf10a3ada098', '5a20f38e08ec86e84c052aaf894f3911', 10, '125.000', '25.000', '1250.000');

-- --------------------------------------------------------

--
-- Table structure for table `sales_types`
--

CREATE TABLE IF NOT EXISTS `sales_types` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` int(100) NOT NULL,
  `deleted_by` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `sales_types`
--

INSERT INTO `sales_types` (`id`, `guid`, `name`, `branch_id`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, 'cfd8b485f99e561408192c594f8c2e92', 'LG', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 0, 61, 61),
(2, '1642d900f6768119e3dd75bbf8ed0fc2', 'Nokia', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 1, 0, 61),
(3, '11d08dc2db3920364304c6ed1192b5ba', 'THOSHIBA', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 1, 0, 0),
(4, '0a1db6b7e58b53971b12790f10e27d60', 'Samsung', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 1, 0, 61),
(5, '90642ff56db4789380d00acae0f053fd', 'AXE', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 1, 61, 0),
(6, 'd270d314cf6ccee8c618495e9feba4ff', 'Mentos', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 1, 61, 0),
(7, 'a85e2c85b10bd213c8b876acfa8aa7a5', 'Silverex', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 0, 61, 0),
(8, '6a3fba30105e2894ff21a1bef6443300', 'LG', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, 1, 61, 0),
(9, 'db336d9ef0d8a4b64a17cef1a0b91c6e', 'Notng', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 0, 61, 61),
(10, '99cb6ba01684b50fa56b573351b11b84', 'sasi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 0, 61, 61),
(11, 'f2e56b486bcd555842563ec7b58c62c3', 'Onida1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, 0, 61, 61);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `department`, `branch`) VALUES
(1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quty` decimal(55,0) NOT NULL,
  `price` decimal(30,3) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `guid`, `branch_id`, `item`, `quty`, `price`, `item_type`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(67, '9bea95d3b0b896d6cf3174e6974c4661', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '53', '50.000', '', 1, 1, 0, '', ''),
(68, 'a65f5498f6c2bb05633771725de1421a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', '1262', '51.000', '', 1, 1, 0, '', ''),
(69, '40003218a9a141cb7a939badc5a0054f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', '2030', '52.000', '', 1, 1, 0, '', ''),
(70, '3a9ea8be6e244d4195fbe80250623bc5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', '238', '53.000', '', 1, 1, 0, '', ''),
(71, '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', '3137', '54.000', '', 1, 1, 0, '', ''),
(72, '97d43ede67b93836ea6e87f108027806', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '24127619c056a21da783938396bffbc2', '13099', '55.000', '', 1, 1, 0, '', ''),
(73, '36f6803e57d6e101c95b9a3147f75603', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '0b4de60eb9709fef115a9457fc89dc12', '1999', '56.000', '', 1, 1, 0, '', ''),
(74, '29c565211fa8b3805f5636b697af5cd2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3a71ffd8ef1df9046d0cf06ac7b3f83d', '19999', '57.000', '', 1, 1, 0, '', ''),
(75, '5b386c317621c310dd7ea174c89ffb23', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '34b399be4193d1cfd2b28bda5db95b64', '1898', '58.000', '', 1, 1, 0, '', ''),
(76, '73aac88f11d151b6e00903e22eb1ebae', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'cee7c1386d78af6e1d14b156b3ebc2a5', '1010', '59.000', '', 1, 1, 0, '', ''),
(77, '794d587e8d5afbf85d2be3aeee57b673', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9317f5c4845ac8eda6d772d0f2021e2b', '1655', '60.000', '', 1, 1, 0, '', ''),
(78, '83d1c6b3303d80271bda7a4a945b247a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4a7dd5b8657346e77dab76b389dd8b7a', '19845', '61.000', '', 1, 1, 0, '', ''),
(79, '6d7ab8f3d679720ebfd7e15b94df4e8b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bd1f8aaafb24f6a5081ccf68d7ebb813', '38', '120.000', '', 1, 1, 0, '', ''),
(80, 'eb4f13dcb1bef5d95c7b0b4da8cabbff', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'aa0d3d8ed2828d7ed04a09c591dd92ba', '8', '150.000', '', 1, 1, 0, '', ''),
(81, 'eb4f13dcb1bef5d8908095c7b0b4da8cabbffOIU', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '5a20f38e08ec86e84c052aaf894f3911', '19', '125.000', 'kit', 1, 1, 0, '', ''),
(82, '2bd13e5fcd7345b40d21dff327a0a6dc', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '53', '50.000', '', 1, 1, 0, '', ''),
(83, 'a9a57aac0c9c1912e643e86dd50cc172', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ada0bb484b3191f9925b1cb8f9d9ffbd', '-300', '15.000', '', 1, 1, 0, '', ''),
(84, 'c9ef15f188da976e854606f831df8821', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '0839917aa673e4c5f2362245cfdb8f6a', '9', '15.000', '', 1, 1, 0, '', ''),
(85, '1e06c988e04ec892db9d72c31f8de2e7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '53', '50.000', '', 1, 1, 0, '', ''),
(86, 'c2d3e62b80d2d43fc48c9bd790994ac6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '53', '50.000', '', 1, 1, 0, '', ''),
(87, '281c9a7a9c9b56d1c49a210efdfe4318', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', '1262', '51.000', '', 1, 1, 0, '', ''),
(88, '119e6ce33cca59a6fca6085cb34ef7eb', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', '2030', '52.000', '', 1, 1, 0, '', ''),
(89, 'ccc0a71b31e26cac64ee0c4036e81396', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', '10', '54.000', '', 1, 1, 0, '', ''),
(90, '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '23', '50.000', '', 1, 1, 0, '', ''),
(91, '59d51d3ff7f340d8206b9b38fdfab77f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', '1262', '51.000', '', 1, 1, 0, '', ''),
(92, '69664449910bdf620256d362d4f0017b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', '2030', '52.000', '', 1, 1, 0, '', ''),
(93, '045f16f68f698000c7644aa5b519dbe3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'cee7c1386d78af6e1d14b156b3ebc2a5', '910', '59.000', '', 1, 1, 0, '', ''),
(94, '818aa6a6e29dae480fbbc4d50fef4fc0', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e6524522752a7cb795710951cc65399', '1000', '74.000', '', 1, 1, 0, '', ''),
(95, '91a91d0e5f35d8482a151b94e4861ec8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '01940c91d372f9030aea277f05cfcd5a', '1000', '70.000', '', 1, 1, 0, '', ''),
(96, 'eb0c21a0c2806b1f1a7607cc3ca0d037', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8c36b1c586a5640d41ad63fcb0ff9188', '1999', '69.000', '', 1, 1, 0, '', ''),
(97, '888adfa73c999bf556a52e63ef3d04a3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', '1000', '53.000', '', 1, 1, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `branch_name` varchar(100) NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `item_active` int(11) NOT NULL,
  `item_delete` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `guid`, `branch_id`, `branch_name`, `item_id`, `price`, `stock`, `active_status`, `delete_status`, `item_active`, `item_delete`) VALUES
(14, '', '3', 'Mcdonalds', '21', '12', '91', 1, 0, 1, 0),
(15, '', '3', 'Mcdonalds', '22', '20', '200', 1, 0, 1, 0),
(16, '', '3', 'Mcdonalds', '23', '14', '20', 1, 0, 1, 0),
(17, '', '3', 'Mcdonalds', '24', '25', '30', 1, 0, 1, 0),
(18, '', '3', 'Mcdonalds', '25', '20', '100', 1, 0, 1, 0),
(19, '', '3', 'Mcdonalds', '26', '28', '1000', 1, 0, 1, 0),
(20, '', '3', 'Mcdonalds', '27', '10', '2', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stocks_history`
--

CREATE TABLE IF NOT EXISTS `stocks_history` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `stock_id` varchar(255) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `item_id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `grn_id` varchar(255) NOT NULL,
  `po_id` varchar(255) NOT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `cost` decimal(30,3) NOT NULL,
  `quty` int(100) NOT NULL,
  `price` decimal(30,3) NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `stocks_history`
--

INSERT INTO `stocks_history` (`id`, `guid`, `stock_id`, `branch_id`, `item_id`, `supplier_id`, `invoice_id`, `grn_id`, `po_id`, `added_by`, `cost`, `quty`, `price`, `date`) VALUES
(42, '12c21758780d7a306bec9bdeadce1b55', 'e936569b783a9988135cae2dea389262', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'e0b3c9fe4c59d4725a7cb99486ca716a', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '100.000', 1000, '110.000', 1402099200),
(43, 'bbfaaf161b2dc0544863cca3116f90d6', '536575132862a9d405405cf1ab423423', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2e708d983475eb0324d6f9b55ee4b8e0', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'e0b3c9fe4c59d4725a7cb99486ca716a', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '200.000', 2000, '210.000', 1402099200),
(44, '909f86433296696ca1424e43fbaa8084', 'd0db5d08fad89b326a5a72b2623e8c0b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '66f68aa0d5bb75ccd9c1b24e188e3c90', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'e0b3c9fe4c59d4725a7cb99486ca716a', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '1000.000', 3000, '1100.000', 1402099200),
(45, 'b1f2e0348ed03494b7cd9f0e83284513', '37f1b2edc396a129a5fb901cb613ebab', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'fa3606d191453944626b3a93c1d45372', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'e0b3c9fe4c59d4725a7cb99486ca716a', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '2000.000', 5000, '2400.000', 1402099200),
(46, '870d20e9193b0d9658400dc734bf8277', '3db8ec802c1a03f67ec4aafc34f1a0e6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '5f2ec32ae8d6316005c76118a1501419', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'e0b3c9fe4c59d4725a7cb99486ca716a', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '40.000', 4000, '45.000', 1402099200),
(47, '684cdce82cf3a9e62c123b8ab827e754', '19bd97967601028049881f25d283647a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '142ec0296f7521ccf20fa611bb826c45', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'e0b3c9fe4c59d4725a7cb99486ca716a', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '1200.000', 6000, '1500.000', 1402099200),
(48, 'd4919fef3494b03aff12c6f32a446de1', 'd5d94c098ed68828b891de3dc8bb94a6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', 'ceab8c7d14f12aaeec1dc19b3d81212a', '15615f3b443d2ce12c79675badf15847', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '110.000', 10, '120.000', 1402099200),
(49, 'e6c5fe409abcc9d58ac660c3814212e3', '965f0ab15ad02314a6d4d2edcf863f12', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a834d45746ad71e5db788d8be2f358de', 'ceab8c7d14f12aaeec1dc19b3d81212a', '1d27e56ca098e1fd0cd5f4b783de37fa', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '100000.000', 100, '110000.000', 1402531200),
(50, 'cf5258c640d4e2f830963de4299bb1f5', '9bea95d3b0b896d6cf3174e6974c4661', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 10, '50.000', 1402704000),
(51, '81722589e603a7307b1702fa870b2b8d', 'a65f5498f6c2bb05633771725de1421a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 10, '51.000', 1402704000),
(52, '41172ca033d64c59b10074a687d2f4f6', '40003218a9a141cb7a939badc5a0054f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '27.000', 10, '52.000', 1402704000),
(53, '20c33745d0f5aff295d2054af4bf3af5', '3a9ea8be6e244d4195fbe80250623bc5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '28.000', 100, '53.000', 1402704000),
(54, '9b45a145037a7e42470cbadf2d23fbac', '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 1000, '54.000', 1402704000),
(55, 'ed5b9bb3b59230683fc3935b671b8624', '97d43ede67b93836ea6e87f108027806', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '24127619c056a21da783938396bffbc2', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '30.000', 1000, '55.000', 1402704000),
(56, 'efa592f90744643cbe9b77bbad3f3c03', '36f6803e57d6e101c95b9a3147f75603', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '0b4de60eb9709fef115a9457fc89dc12', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '31.000', 1000, '56.000', 1402704000),
(57, '109fbb08fb235c14d952236a3df3fa8e', '29c565211fa8b3805f5636b697af5cd2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3a71ffd8ef1df9046d0cf06ac7b3f83d', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '32.000', 10000, '57.000', 1402704000),
(58, '8f76963c107a1a418e04a060315cb2ec', '5b386c317621c310dd7ea174c89ffb23', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '34b399be4193d1cfd2b28bda5db95b64', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '34.000', 1000, '58.000', 1402704000),
(59, 'f53c8c42222b36eb8892f3f32007ff50', '73aac88f11d151b6e00903e22eb1ebae', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'cee7c1386d78af6e1d14b156b3ebc2a5', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '35.000', 1000, '59.000', 1402704000),
(60, '5ef93cd4c29f9e80d202f8727766a811', '794d587e8d5afbf85d2be3aeee57b673', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9317f5c4845ac8eda6d772d0f2021e2b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '36.000', 1000, '60.000', 1402704000),
(61, '3ac786c63d7b881a56a4b145c083b7d1', '83d1c6b3303d80271bda7a4a945b247a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4a7dd5b8657346e77dab76b389dd8b7a', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '37.000', 10000, '61.000', 1402704000),
(62, '72be61d99acba95ef3fd585ba6b99226', '9bea95d3b0b896d6cf3174e6974c4661', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 10, '50.000', 1402704000),
(63, '644548aa7422bd41dc8e7553364c9b2b', 'a65f5498f6c2bb05633771725de1421a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 10, '51.000', 1402704000),
(64, '034834c7204892d12ffc2e816f2e6eb8', '40003218a9a141cb7a939badc5a0054f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '27.000', 10, '52.000', 1402704000),
(65, '16acd7a86b81eb39defb6fa823d32744', '3a9ea8be6e244d4195fbe80250623bc5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '28.000', 100, '53.000', 1402704000),
(66, '32487e472b357407a991f79171d748d1', '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 1000, '54.000', 1402704000),
(67, '072d76dc7d9c03a1292dfaa1ac958bd3', '97d43ede67b93836ea6e87f108027806', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '24127619c056a21da783938396bffbc2', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '30.000', 1000, '55.000', 1402704000),
(68, '168c985ddae0f6e0cd80a48f00acb6e3', '36f6803e57d6e101c95b9a3147f75603', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '0b4de60eb9709fef115a9457fc89dc12', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '31.000', 1000, '56.000', 1402704000),
(69, '91ff9d455a0ac397e4f074b2fee84ab7', '29c565211fa8b3805f5636b697af5cd2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3a71ffd8ef1df9046d0cf06ac7b3f83d', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '32.000', 10000, '57.000', 1402704000),
(70, '659749de5f389d8cb3b1c99b40b1d526', '5b386c317621c310dd7ea174c89ffb23', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '34b399be4193d1cfd2b28bda5db95b64', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '34.000', 1000, '58.000', 1402704000),
(71, '956e25886088b7a388b30fe9e5403df4', '73aac88f11d151b6e00903e22eb1ebae', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'cee7c1386d78af6e1d14b156b3ebc2a5', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '35.000', 1000, '59.000', 1402704000),
(72, 'efb361ae8ce01aed165baaed417143af', '794d587e8d5afbf85d2be3aeee57b673', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9317f5c4845ac8eda6d772d0f2021e2b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '36.000', 1000, '60.000', 1402704000),
(73, '135e25afa29b08d2a34b5868511fd053', '83d1c6b3303d80271bda7a4a945b247a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4a7dd5b8657346e77dab76b389dd8b7a', 'ceab8c7d14f12aaeec1dc19b3d81212a', '31e5a144c9e583c3fc2883b6243ce128', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '37.000', 10000, '61.000', 1402704000),
(74, '7bc0c058ee1adfaeb0afef1243d108c4', '2bd13e5fcd7345b40d21dff327a0a6dc', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'b903d862c297cc5d6c9c3792f7274759', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 100, '60.000', 1403481600),
(75, '1dfbfa3676cdffcd4ff2f01eacc3d11e', '1e06c988e04ec892db9d72c31f8de2e7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 10, '50.000', 1404691200),
(76, '5913d33e37105f1a41321e5d50f47245', 'a65f5498f6c2bb05633771725de1421a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 10, '51.000', 1404691200),
(77, '376bbed3f1c8c778eed9531ecba12236', '40003218a9a141cb7a939badc5a0054f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '27.000', 10, '52.000', 1404691200),
(78, '461f78d750883b7051f7695a87fb535d', '3a9ea8be6e244d4195fbe80250623bc5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '28.000', 10, '53.000', 1404691200),
(79, '0d1cb3a25fde031bfdaaea115f9b23ad', '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 10, '54.000', 1404691200),
(80, '1483b05a8f22170cf40f8adbc302e8a5', '1e06c988e04ec892db9d72c31f8de2e7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 10, '50.000', 1404691200),
(81, '1ae2e32866ba6c01a2e6f60d9bb489da', 'a65f5498f6c2bb05633771725de1421a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 10, '51.000', 1404691200),
(82, 'b1ba3732cdce1f5b56e458b1cf9ba5a9', '40003218a9a141cb7a939badc5a0054f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '27.000', 10, '52.000', 1404691200),
(83, '80a239316e6bc75040950d78f2ca9f09', '3a9ea8be6e244d4195fbe80250623bc5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '28.000', 10, '53.000', 1404691200),
(84, '17f16cfede93630e65aaf105277f0854', '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 10, '54.000', 1404691200),
(85, '071cd07352c40ae2ea2345a13671ce1a', '1e06c988e04ec892db9d72c31f8de2e7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 10, '50.000', 1404691200),
(86, 'fb8a4607122362d116f35a90908d0377', 'a65f5498f6c2bb05633771725de1421a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 10, '51.000', 1404691200),
(87, 'bf586c37c5b923de940a35823ae6ad40', '40003218a9a141cb7a939badc5a0054f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '27.000', 10, '52.000', 1404691200),
(88, 'eea4f3c698d84fba75da1a66af924df0', '3a9ea8be6e244d4195fbe80250623bc5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '28.000', 10, '53.000', 1404691200),
(89, '8ec257460ed8d1009b99d2b6b42fb2a8', '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 10, '54.000', 1404691200),
(90, '148536ccc610d20d24c609062a2ad17f', '1e06c988e04ec892db9d72c31f8de2e7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 10, '50.000', 1404691200),
(91, '838bcc3f8a385d8d85d879d3db0877a0', 'a65f5498f6c2bb05633771725de1421a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 10, '51.000', 1404691200),
(92, '8a6535a6acaadb94c9efac25a5b55ebb', '40003218a9a141cb7a939badc5a0054f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '27.000', 10, '52.000', 1404691200),
(93, '51907691697d35332508bbc6724e7a71', '3a9ea8be6e244d4195fbe80250623bc5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '28.000', 10, '53.000', 1404691200),
(94, '6156ad19b9bafb3254d71c88ef2315a6', '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ee88db564857cd108e19c28f291d6575', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 10, '54.000', 1404691200),
(95, '004fa4eb6b7b3c6791a42f345af5c15b', 'c2d3e62b80d2d43fc48c9bd790994ac6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'fc10929c0f89f3a36792c5202d3af4e4', 'a0008e18bf5011ff4efd2a7511831c6e', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 10, '54.000', 1404777600),
(96, '19af5db83b3b5efb555f6a6e8a99d677', '281c9a7a9c9b56d1c49a210efdfe4318', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'fc10929c0f89f3a36792c5202d3af4e4', 'a0008e18bf5011ff4efd2a7511831c6e', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 10, '54.000', 1404777600),
(97, 'deed2f09c10f3242779958d4be80b19d', '119e6ce33cca59a6fca6085cb34ef7eb', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'fc10929c0f89f3a36792c5202d3af4e4', 'a0008e18bf5011ff4efd2a7511831c6e', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 10, '54.000', 1404777600),
(98, '7a5244f72e91d9a6ced30cccaf307879', 'ccc0a71b31e26cac64ee0c4036e81396', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'fc10929c0f89f3a36792c5202d3af4e4', 'a0008e18bf5011ff4efd2a7511831c6e', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 10, '54.000', 1404777600),
(99, 'ffbc92a3bdc72bc6b0697bf8a4931487', '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'fc10929c0f89f3a36792c5202d3af4e4', 'a0008e18bf5011ff4efd2a7511831c6e', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 10, '54.000', 1404777600),
(100, '6a2d2395184a75961b999b991b7fd5f6', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'c0e6451aedced5db41ec46fe87ae5e8c', '9b5e77bbd75e34e49668f55808f3610f', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 20, '50.000', 1404777600),
(101, 'aac0b1d1c191df84f7fb5548a8942c6a', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '109e88981ff35f03fed2cff8292d8587', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 10, '50.000', 1404777600),
(102, '8196f6991c424e13bd88882a40926cca', '59d51d3ff7f340d8206b9b38fdfab77f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '109e88981ff35f03fed2cff8292d8587', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 10, '51.000', 1404777600),
(103, '27a50cb38f605f12d1d93f1856663d49', '69664449910bdf620256d362d4f0017b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '109e88981ff35f03fed2cff8292d8587', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '27.000', 1010, '52.000', 1404777600),
(104, 'd365750798f6741dedd81e1637bc8862', '97d43ede67b93836ea6e87f108027806', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '24127619c056a21da783938396bffbc2', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '109e88981ff35f03fed2cff8292d8587', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '30.000', 10101, '55.000', 1404777600),
(105, '3dfa95b6afa3497338cb4d41599a0276', '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '109e88981ff35f03fed2cff8292d8587', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 10, '54.000', 1404777600),
(106, 'fb7f8e13dfb12033d7a46422112d34d3', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'edf0f6b0b27cfd3dc8e56161f90263bb', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 10, '50.000', 1404777600),
(107, '8943ad89380f24482829a18f87069d53', '59d51d3ff7f340d8206b9b38fdfab77f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'edf0f6b0b27cfd3dc8e56161f90263bb', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 10, '51.000', 1404777600),
(108, 'be9142ce2bc25109936195c72ee8ecd8', '69664449910bdf620256d362d4f0017b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'edf0f6b0b27cfd3dc8e56161f90263bb', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '27.000', 10, '52.000', 1404777600),
(109, '7288d6c2dc9796dd9d8378ddef794429', '045f16f68f698000c7644aa5b519dbe3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'cee7c1386d78af6e1d14b156b3ebc2a5', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'edf0f6b0b27cfd3dc8e56161f90263bb', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '35.000', 10, '59.000', 1404777600),
(110, '728087f1065147b0c4379995b087f8de', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'e86335a7f71cbe24e2e180bfc4dad2e9', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 34, '50.000', 1404777600),
(111, 'b9c130d19dfe015f34ec5f5f0890508d', '59d51d3ff7f340d8206b9b38fdfab77f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'e86335a7f71cbe24e2e180bfc4dad2e9', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 22, '51.000', 1404777600),
(112, '7d7d54eaa2d3ab060417a0d7cefbc648', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '397b0227c3ace434f489387e1dace9e5', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 100, '50.000', 1404777600),
(113, '599ef9ddb32db732c65cf69f04add39f', '59d51d3ff7f340d8206b9b38fdfab77f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '397b0227c3ace434f489387e1dace9e5', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 100, '51.000', 1404777600),
(114, '468541dcc977d065d900aea605513926', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '114157a7e63e4de7390ecda7b53be16f', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 10, '50.000', 1404777600),
(115, '31de5812b2eb4928131b7618a75c778a', '59d51d3ff7f340d8206b9b38fdfab77f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '114157a7e63e4de7390ecda7b53be16f', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 10, '51.000', 1404777600),
(116, 'a54dba511279de18b2ab040c53889f10', '59d51d3ff7f340d8206b9b38fdfab77f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'f915bc22ab605438260147aa679bf2a4', 'a2909016e7b28ec3be117dc92100f2d3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 10, '51.000', 1404777600),
(117, 'd5affad6f4a5fb6df44e9b68d4777654', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '68a226c647a78cb9e1659e97a63bedcb', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 100, '50.000', 1404777600),
(118, 'aac722fa42ad6109c3babc5aa36024ad', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'e4b05b9cf040cf5755124bccd5dadb5d', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 100, '50.000', 1404777600),
(119, '84952b38a8491fa6ecc98eff3a53a846', '59d51d3ff7f340d8206b9b38fdfab77f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'e4b05b9cf040cf5755124bccd5dadb5d', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 100, '51.000', 1404777600),
(120, '3cab2bf3af39427148419839fba95741', '69664449910bdf620256d362d4f0017b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'd452af31fd308e00ad348e35ee9537a5', 'ff3268b3392c3bcaaa8a0ae8dc460720', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '27.000', 10, '52.000', 1404777600),
(121, 'afff9fb32232ba83fa4bcf9c94498085', '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', 'ceab8c7d14f12aaeec1dc19b3d81212a', '953acf9959541442ca94210631d0b562', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 78, '54.000', 1404777600),
(122, '98fb2bf5cd123c8525ac73a74705a5ac', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '953acf9959541442ca94210631d0b562', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 89, '50.000', 1404777600),
(123, '8398d1a25e761bd3ad07a9b10339d7d4', '83d1c6b3303d80271bda7a4a945b247a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4a7dd5b8657346e77dab76b389dd8b7a', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'db1e0df61ab0e84da014352f22e4ac4b', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '37.000', 100, '61.000', 1404864000),
(124, '951e304072b24d335ed4ab727afc0dab', '045f16f68f698000c7644aa5b519dbe3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'cee7c1386d78af6e1d14b156b3ebc2a5', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'ad53aafb80caa59c532d444f35a1a03d', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '35.000', 1000, '59.000', 1404864000),
(125, 'a5aa45ec6bac4984a31fcf5b6292a5da', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '15fe3eaf782874f6b92a697119cbb050', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 100, '50.000', 1404864000),
(126, '6474d5142f5ac9aefdd681c78aa27b3e', '818aa6a6e29dae480fbbc4d50fef4fc0', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4e6524522752a7cb795710951cc65399', 'ceab8c7d14f12aaeec1dc19b3d81212a', '15fe3eaf782874f6b92a697119cbb050', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '50.000', 1000, '74.000', 1404864000),
(127, '132ba593d386415782968cf832a8d2dc', '91a91d0e5f35d8482a151b94e4861ec8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '01940c91d372f9030aea277f05cfcd5a', 'ceab8c7d14f12aaeec1dc19b3d81212a', '15fe3eaf782874f6b92a697119cbb050', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '46.000', 1000, '70.000', 1404864000),
(128, 'ad841f7ba236299acc85add47c339053', 'eb0c21a0c2806b1f1a7607cc3ca0d037', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8c36b1c586a5640d41ad63fcb0ff9188', 'ceab8c7d14f12aaeec1dc19b3d81212a', '15fe3eaf782874f6b92a697119cbb050', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '45.000', 1999, '69.000', 1404864000),
(129, '3cb9ab5dec02cc8ea30e6f297da375b0', '497fab5cbead27f6e9a6d6771d6ebc5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'bdcaa1e7afb246165cfe78c4dc1bbbba', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '050b4d660171b94a10131fb4f89f1410', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '25.000', 100, '50.000', 1405189800),
(130, '76554f0159dc5b2da561f04a0b527f94', '59d51d3ff7f340d8206b9b38fdfab77f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '024477833686497e686ec4c62508bf4b', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '050b4d660171b94a10131fb4f89f1410', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '26.000', 1000, '51.000', 1405189800),
(131, 'e9fe68c00bce833fd827cdf66c57930a', '69664449910bdf620256d362d4f0017b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2f3fa40a2a3f42cceb2d65551f541f66', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '050b4d660171b94a10131fb4f89f1410', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '27.000', 1000, '52.000', 1405189800),
(132, '124d05be2da9eedcf5804caf2e34a30b', '888adfa73c999bf556a52e63ef3d04a3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd968ea8d3272b5315f6bf14f3e37bc46', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '050b4d660171b94a10131fb4f89f1410', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '28.000', 1000, '53.000', 1405189800),
(133, '983aa839d76d34613d3572393588bd92', '9fc3895496088d5170664e937a42a191', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3d2a7587a9bfca604f2d34ba21f00a53', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '050b4d660171b94a10131fb4f89f1410', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '29.000', 1000, '54.000', 1405189800),
(134, '5d2b04f546e6bb770c5fb8737ee997ac', '97d43ede67b93836ea6e87f108027806', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '24127619c056a21da783938396bffbc2', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '050b4d660171b94a10131fb4f89f1410', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '30.000', 1000, '55.000', 1405189800);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer`
--

CREATE TABLE IF NOT EXISTS `stock_transfer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `remark` varchar(300) NOT NULL,
  `note` varchar(300) NOT NULL,
  `no_items` int(11) NOT NULL,
  `total_amount` decimal(30,3) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `stock_status` int(11) NOT NULL DEFAULT '0',
  `branch_id` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer_x_items`
--

CREATE TABLE IF NOT EXISTS `stock_transfer_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) NOT NULL,
  `stock_transfer_id` varchar(255) NOT NULL,
  `stocks_history_id` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quty` int(11) NOT NULL,
  `cost` decimal(30,3) NOT NULL,
  `sell` decimal(30,3) NOT NULL,
  `discount_per` decimal(30,3) NOT NULL,
  `discount_amount` decimal(30,3) NOT NULL,
  `tax` decimal(30,3) NOT NULL,
  `amount` decimal(30,3) NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `stock_transfer_x_items`
--

INSERT INTO `stock_transfer_x_items` (`id`, `guid`, `stock_transfer_id`, `stocks_history_id`, `item`, `quty`, `cost`, `sell`, `discount_per`, `discount_amount`, `tax`, `amount`, `supplier_id`) VALUES
(38, '3c2e2d7e4f8642ff6d668017e8f5a116', 'f4206a8912721c53b84894ee83a02900', '', '9d8439c7f35923f2397af1b7edadc670', 1000, '45.000', '676.000', '1.000', '450.000', '900.000', '45000.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(39, '8671719b870ef46cff4f744c4b2f4392', '063c5a4037dab38c58120c140d340eb1', '', '9d8439c7f35923f2397af1b7edadc670', 1000, '45.000', '676.000', '0.000', '0.000', '900.000', '45000.000', 'ceab8c7d14f12aaeec1dc19b3d81212a'),
(40, 'e5fa6e21ac5579b4801053e6232911c9', '055a591dd283ec3ecfdaad48a0af9756', '9cff3c99cc56218f03b7e9a5975fa6ee', '9d8439c7f35923f2397af1b7edadc670', 100, '45.000', '676.000', '0.000', '0.000', '90.000', '4590.000', 'ceab8c7d14f12aaeec1dc19b3d81212a');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `company_name` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `added_date` int(20) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `credit_days` decimal(65,0) NOT NULL,
  `credit_limit` decimal(65,0) NOT NULL,
  `monthly_credit_bal` decimal(65,0) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_location` varchar(200) NOT NULL,
  `cst_no` varchar(200) NOT NULL,
  `gst_no` varchar(200) NOT NULL,
  `tex_reg_no` varchar(200) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `deleted_by` varchar(255) DEFAULT NULL,
  `website` varchar(100) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `guid`, `company_name`, `first_name`, `last_name`, `category`, `email`, `phone`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `comments`, `added_date`, `account_number`, `credit_days`, `credit_limit`, `monthly_credit_bal`, `bank_name`, `bank_location`, `cst_no`, `gst_no`, `tex_reg_no`, `active_status`, `delete_status`, `deleted_by`, `website`, `branch_id`, `added_by`) VALUES
(1, 'ceab8c7d14f12aaeec1dc19b3d81212a', 'JK', 'Jayesh1', 'gopi', '', 'julibeth34@yahoo.in', '7795390584', 'ewrter', 'wertwe', 'ewrtwe', 'reter', 'rterter', 'rtertre', 'sdfsdfsd', 1404432000, 'ew43643', '0', '0', '0', '', '', '', '', '', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'sfgedtrere', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, '7988d76f85fb01646eb9d9b01530c460', 'iouoi', 'Manu', 'km', 'b0913b800960821c61b9e7426cc3f1b8', '', '', '', 'uyiuyi', '', '', '', '', 'uouu', 1404432000, 'uoiuo', '0', '0', '0', '', '', '', '', '', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'oiuoiu', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(3, 'c76d55c21f9d4f577b26fba515a8066f', 'uytuy', 'Nijan', 'xjhk', '', 'jhkjhj@kjhkj.com', '7878797989', 'yiuy', 'iyiuy', 'iuyiuy', 'iuyiuy', 'iyiuy', 'iuyi', 'tutuyt', 1404432000, 'uytuy', '0', '0', '0', '', '', '', '', '', 1, 0, '', 'tuytuy', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(4, '6148f274388f64b43123c3598c3fcf81', 'yutu', 'Kiran', 'yutuy', 'b0913b800960821c61b9e7426cc3f1b8', '', '', '', 'uytuyt', '', '', '', '', 'uytuy', 1404432000, 'uytuyt', '0', '0', '0', '', '', '', '', '', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'uytu', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(5, '2a4e7a8de41c967c9097b2e4a1a0e662', 'Champ', 'kumar', 'sasi', 'b0913b800960821c61b9e7426cc3f1b8', 'afsfasfa@fdsag.sdfgsd', '25235623', '', '', '', '', '', '', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, 'ab4b9cd0dc050345b7ab8365bd10b934', 'zdafas', 'asga', '0', '', '', '', '', '', '', '', '', '', 'asga', 1404432000, '26', '4326', '236', '26', '263', '26', '26', '26', '263', 1, 0, '', 'asga', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(7, '223eecbb705cc68d67fdfa9a10509784', '', 'dfghd', 'dsgsdg', '', '', '', '', '', '', '', '', '', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(8, '4d6d2651564e45b6b1ef0d1fe570e034', 'oiuoi', 'uoiu', 'oiuoi', '', 'jibi@yahoo.com', '98098098', 'uoiuoi', '', 'uoiu', 'oiuoi', 'uou', 'oiuoi', 'uoiuoi', 1404432000, '809', '908', '98', '980', '098', '09809', '8098', '098', '00', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'uoiuoiuoi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(9, '95749f66abfe71f2ee99482280456d9e', '', 'sdgsd', '', '', 'jibi@yahoo.com', '346346346', '', '', '', '', '', '', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 1, 0, '', '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(10, 'e91054c7db987e18f232ffa506f49394', 'uoiu', 'monish', 'km', 'b0913b800960821c61b9e7426cc3f1b8', 'monis@yahoo.com', '8798798', '43636436', '', 'uoiu', 'oiu', 'oiuoi', 'uoi', 'oiuiouoi', 1404432000, '987', '7897', '98798', '798', '7987', '897', '98798', '798', '7987', 1, 0, '', 'uiuoi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(11, '2852a4761247d450ccb765bd550c52e9', 'assfa', 'asfasfa', 'asfa', 'bbb619417f5a8add548cdd6af3b7c71a', 'jibi@yahoo.com', '34634634', 'asfas', '', '', '', '', '', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 1, 0, '', 'fasfasf', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(12, '7e73f4535f0840c37dc6908b461129a9', '', '235623', '', 'b0913b800960821c61b9e7426cc3f1b8', 'jibu@iyiu.cuoiuio', '234634', '', '', 'dfgfdg', 'sdag', 'sdag', 'asdg', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 1, 0, NULL, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(13, '8fe8c6d5fdd7b24aa85f0d7cc98b1ea5', 'posnic', 'kumar', 'kumar', '', 'kuamar@posnic.com', '7798544799', 'bangalore', '', 'bnaglore', 'karnataka', '89789', 'india', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 1, 0, NULL, 'posnic', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(14, '91fc6c809d24775bd1a71c75bc462185', 'posnic', 'said', 'said', '', 'sethu@posnic.com', '1236547890', 'uoi', '', 'baghh', 'hhg', 'ghj', 'india', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 1, 0, NULL, 'posnic', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(15, 'f7d469e47947046cfbadbc5a76af9ab5', 'rqwr', 'VINOD', 'VINOD', '', 'vinod@posnic.com', '9449103322', 'asfasf', '', 'aswqr', 'r', 'wqwr', 'qwqwr', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 1, 0, NULL, 'qrqwr', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(16, '4bb8aa5bf4ecfe04d6f403499588ef85', 'posnic', 'kumarasf', 'kumarasf', '03e3c381fd7f77ce7adb0106ece353b7', 'kua1mar@posnic.com', '7798554799', 'bangalore', '', 'bnaglore', 'karnataka', '89789', 'india', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 1, 0, NULL, 'posnic', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(17, '6de125d7996dff72e82387d50a15d7a2', 'posnic', 'saidasf', 'saidasf', '316df1ae29521d322e0663e9a0029395', 'seth1u@posnic.com', '1286547890', 'uoi', '', 'baghh', 'hhg', 'ghj', 'india', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 1, 0, NULL, 'posnic', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(18, '01dd6e7498a5e045342560bfc7a526aa', 'rqwr', 'VINODfasf', 'VINODfasf', '89cecde34c3eaf07a42c0ef4742427a8', 'vinod1@posnic.com', '9449183322', 'asfasf', '', 'aswqr', 'r', 'wqwr', 'qwqwr', '', 1404432000, '', '0', '0', '0', '', '', '', '', '', 1, 0, NULL, 'qrqwr', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_category`
--

CREATE TABLE IF NOT EXISTS `suppliers_category` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `category_name` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `suppliers_category`
--

INSERT INTO `suppliers_category` (`id`, `guid`, `branch_id`, `category_name`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '7879977979777987', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'C-123', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, 'b07822de514011f2e7ffc12692033acb', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'C-1233', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(3, 'b0913b800960821c61b9e7426cc3f1b8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'Web sales1', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, 'bbb619417f5a8add548cdd6af3b7c71a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'dsgsdgs', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '50dd8794a73be791efc0f38b018a14ef', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'fgfgh', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(6, 'd6ca613468ccc418994b923933d9de4f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'dsfsdgsdgs', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '03e3c381fd7f77ce7adb0106ece353b7', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'sadfas', 1, 0, NULL, NULL),
(8, '316df1ae29521d322e0663e9a0029395', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'asf', 1, 0, NULL, NULL),
(9, '89cecde34c3eaf07a42c0ef4742427a8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'asfas', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_x_branches`
--

CREATE TABLE IF NOT EXISTS `suppliers_x_branches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `branch_name` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `supplier_active` int(11) NOT NULL,
  `supplier_delete` int(11) NOT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `item_status` int(11) NOT NULL,
  `item_delete` int(11) NOT NULL,
  `item_deleted_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_x_items`
--

CREATE TABLE IF NOT EXISTS `suppliers_x_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `quty` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `item_active` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `deactive_item` int(11) NOT NULL,
  `item_delete` int(11) NOT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `suppliers_x_items`
--

INSERT INTO `suppliers_x_items` (`id`, `guid`, `branch_id`, `supplier_id`, `item_id`, `cost`, `quty`, `price`, `mrp`, `discount`, `active_status`, `delete_status`, `item_active`, `active`, `deactive_item`, `item_delete`, `added_by`, `deleted_by`) VALUES
(188, '2d85d8f014cb895cf78ea5f6333a4fc4', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'bd7d112720cd35ac1ae35eed5fcfe26f', '25', '', '76', '50', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(189, 'e517cfe9cfe3406b4e3fdf50628e3a89', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '9c0fb85febb9ad9def99c6ee21c7b663', '26', '', '78', '51', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(190, '3c3585ef69bc7d8752061e383a240540', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '083b751487b302db96f40049e4ef0f48', '27', '', '79', '52', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(191, 'd00fa43cdad5e309972c78f653aa194b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'c8bc5f865391c85453533e9783cee3f8', '28', '', '80', '53', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(192, '1c9d7875cb8d567ede3d695b6e6cf079', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '0e8cc111c81762b85a64089336772f9a', '29', '', '81', '54', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(193, 'b58ad1bcccadde724f546198c8ec0701', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'b04b9c799f070e193a6a1a10c9024780', '30', '', '82', '55', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(194, '7ee88e4c609691c81d392d87c55491a0', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'b3c5766d4bdf2857cdf848bc3a313378', '31', '', '83', '56', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(195, 'db5f1098b56385a979f030368e63bdf1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'dcec176cf283f96ec2b1c1a777d89831', '32', '', '84', '57', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(196, '6a1169618be264acdcd15dc9a1386901', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'a055aeeaa71449136daad23f39c8469e', '34', '', '85', '58', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(197, '79b5981009666e1d8ee74e1536d13588', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'db97141f9586522e5fa0122df6914e5b', '35', '', '86', '59', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(198, '8ce77e1a3b395386252d45b444480606', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'c33e5a7be2d694b468a4f0e055752fdf', '36', '', '87', '60', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(199, '844cd491d26449b57849b9a6582ac67b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'd015ae867d29f37242f8058e642ca544', '37', '', '88', '61', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(200, '4eef58751028174d795439f435d8c816', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'b0ab325b8e3fad1a1aaf49bf40087766', '38', '', '89', '62', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(201, 'a685cacc16efcc33860182639c23f217', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '0559008f96ca6111faf1acc0e690e0d2', '39', '', '90', '63', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(202, '518d1bcb7a66c03bd92009dcd588bb46', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '5742f1de5919be18b659d5bc8ed05297', '40', '', '91', '64', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(203, 'de982698f36632e71c781eebcf938374', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'e38bcb69b840763e821e65d5b1efe5fe', '41', '', '92', '65', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(204, '9adc189f8e7a71aebe1f848d9f62daa3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '58a4854b80e9c201399e47a89e33ffe4', '42', '', '93', '66', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(205, '3236ad7859d0a2e2bf1da0d3a32be285', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'f92abee7bb20b757a979d34e5c383f90', '43', '', '94', '67', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(206, 'ddd9869be27fbc95afb44788d7f821f3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'c68037c21f29eda45af2b7f8cd42e7c0', '44', '', '95', '68', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(207, '358bdda4c5286f4930f332411d588a8e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '527ffc43eb19863a46963ffae83294dd', '45', '', '96', '69', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(208, 'ec6d6af27bfb66714c93d10cadc85e73', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '407ee824e53b08e525a12000a188090e', '46', '', '97', '70', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(209, 'bad71306d5df5e020f97ac097a521775', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '635fe3dcd470dbd6f59330c3284120f9', '47', '', '98', '71', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(210, '409b800be67793e6199bee5ecca68594', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'f378f3a77c28f16abe26f1255ab4d894', '48', '', '99', '72', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(211, '18117df74a6059d10f504164900d5657', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'b903d5c4300808ca41b3278c7c2093e7', '49', '', '100', '73', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(212, '0768c9eb1c375e532f430f96e1f4aa57', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'c64cab80abd8a5c5b82fbde36ca1a215', '50', '', '101', '74', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(213, 'a7c3dbc43ae4ebf3aecc14f566fdead4', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '25', '', '50', '76', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(214, '56113b7e78a7be069ecb269942a01a5c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '024477833686497e686ec4c62508bf4b', '26', '', '51', '78', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(215, '01bdcfbda192e0cd47b208594dbb3568', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '2f3fa40a2a3f42cceb2d65551f541f66', '27', '', '52', '79', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(216, 'a8457490475fc8fb4a10367be58541bd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'd968ea8d3272b5315f6bf14f3e37bc46', '28', '', '53', '80', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(217, '3ab460bb02a77f90d4c0c903e749bfa0', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '3d2a7587a9bfca604f2d34ba21f00a53', '29', '', '54', '81', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(218, '75d6db30f63d314c7699f94c4e2586bd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '24127619c056a21da783938396bffbc2', '30', '', '55', '82', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(219, '68d11b09979d950404b74e3151265ef0', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '0b4de60eb9709fef115a9457fc89dc12', '31', '', '56', '83', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(220, 'fb81c7b7ff10326788f40e7d4d357140', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '3a71ffd8ef1df9046d0cf06ac7b3f83d', '32', '', '57', '84', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(221, 'f90fc08b50ed41da3f5d9b554f861276', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '34b399be4193d1cfd2b28bda5db95b64', '34', '', '58', '85', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(222, 'd1aafcdff7fa3b1543056b75dd1978d8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'cee7c1386d78af6e1d14b156b3ebc2a5', '35', '', '59', '86', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(223, 'bde246b769cc5c550b6b318f3dba6cdd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '9317f5c4845ac8eda6d772d0f2021e2b', '36', '', '60', '87', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(224, 'ba634537db8ed9415000c91b4b64cf44', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '4a7dd5b8657346e77dab76b389dd8b7a', '37', '', '61', '88', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(225, '469520ca2b4e9f256f10d9906b2fb3ea', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '5ab9f137aa8409a0fb264a26299edae9', '38', '', '62', '89', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(226, 'c7e4a7cf27bfe9cb608b6aefeff1046b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '249f873b9fb54d9dab988e9063be9c1c', '39', '', '63', '90', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(227, 'db2bfc57d4717004e4ee8269baa0df7a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '06ebee4c2a2734014d614621d99212f9', '40', '', '64', '91', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(228, '0044b9258d68b0e3577eb3172aae8326', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '0e50c545deb40fa589f3ebbba7006fb1', '41', '', '65', '92', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(229, 'bb42e62d3c7e335246bcef6de5c72199', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'c66a508b0de37847dba834c313dc90cc', '42', '', '66', '93', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(230, 'd6c55643cf9d798d3fe91ae8bc7294c5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '6e594d18b0abcfaa01c2cc0ca78d1507', '43', '', '67', '94', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(231, '7b6d60e6efa4e93fdea6c66f2f59c34e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '84b79865b0949c3ccba8433b630c92a3', '44', '', '68', '95', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(232, '2e04830b3e28cf0d460cad304991ca31', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '8c36b1c586a5640d41ad63fcb0ff9188', '45', '', '69', '96', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(233, '610d0054b005d03808d09c3541ce1015', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '01940c91d372f9030aea277f05cfcd5a', '46', '', '70', '97', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(234, 'f6c120dd1ee7a52f250f5c7dafd203ce', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'fee79c4bb6164a437749a03959551a50', '47', '', '71', '98', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(235, '26a8a50e8cd911fb142e16aba2895087', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'dee62896f3b700d22c025017542cb898', '48', '', '72', '99', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(236, '2f85c9fef37cf50569bf56a9b513cc52', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '289680fbf0f672f7d11441007a6d12fd', '49', '', '73', '100', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(237, 'e908a8843cd9030f73b3b5e8347d4f1d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '4e6524522752a7cb795710951cc65399', '50', '', '74', '101', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(238, '806644518a25c27727a0c39e03154794', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7988d76f85fb01646eb9d9b01530c460', 'bdcaa1e7afb246165cfe78c4dc1bbbba', '25.000', '10', '50.000', '76.000', '', 1, 0, 0, 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(239, 'feaf240572b827513f444b9a41f5d7ac', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7988d76f85fb01646eb9d9b01530c460', '024477833686497e686ec4c62508bf4b', '26.000', '10', '51.000', '78.000', '', 1, 0, 0, 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_contacts`
--

CREATE TABLE IF NOT EXISTS `supplier_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `supplier_contacts`
--

INSERT INTO `supplier_contacts` (`id`, `guid`, `supplier`, `address`, `city`, `state`, `country`, `zip`, `email`, `phone`) VALUES
(1, '', 'ab4b9cd0dc050345b7ab8365bd10b934', 'dsgsd', 'ewtwe', 'wet', 'we', 'wet', 'jibi@yahoo.com', '773252'),
(2, '', 'ab4b9cd0dc050345b7ab8365bd10b934', 'fssdf', 'sfs', 'gsdds', 'gsgs', 'sdgsd', 'jibi@yahoo.com', '436346'),
(3, '', '223eecbb705cc68d67fdfa9a10509784', '', '', '', '', '', 'jibi@yahoo.com', '4563636'),
(4, '', '4d6d2651564e45b6b1ef0d1fe570e034', 'uoiuoi', 'uoiu', 'oiuoi', 'oiuoi', 'uou', 'jibi@yahoo.com', '98098098'),
(5, 'cea0bfb749c5d43e80f40bb65aac4861', '95749f66abfe71f2ee99482280456d9e', '', '', '', '', '', 'jibi@yahoo.com', '346346346'),
(35, '3b9ebf46a8ee2d8f53b903e449451176', 'e91054c7db987e18f232ffa506f49394', '43636436', 'uoiu', 'oiu', 'uoi', 'oiuoi', 'monis@yahoo.com', '8798798'),
(36, 'b990cf0458de84ff483f5d15982fb074', 'e91054c7db987e18f232ffa506f49394', 'asfasr32', '2353', '235', '231523', '2352', 'monis@yahoo.com', '342532512'),
(37, 'da4ebc4d9456e0c8e9dcf2c894f3c722', 'e91054c7db987e18f232ffa506f49394', '532534', '23463246', '6', '3463', '3246234', 'monish23@yahoo.com', '2535345'),
(38, 'd83ea3c708bbf1eff615903b01591ee0', 'e91054c7db987e18f232ffa506f49394', 'wreqtwqe', 'dsgfsd', 'ewtwe', '87687687', '9879879', 'monish@yahoo.com', '868768768'),
(40, 'f4812a96f7d9c42d87e66752e42b7756', '2852a4761247d450ccb765bd550c52e9', 'asfas', '', '', '', '', 'jibi@yahoo.com', '34634634'),
(41, 'eda3ecfe7f29fcfade997f32e8abac22', '6148f274388f64b43123c3598c3fcf81', '', '', '', '', '', '', ''),
(43, '9d68fdadffc031d22c2bf191922fea57', '7988d76f85fb01646eb9d9b01530c460', '', '', '', '', '', '', ''),
(44, '37bca3c862241326dc562462270162a0', '7e73f4535f0840c37dc6908b461129a9', '', 'dfgfdg', 'sdag', 'asdg', 'sdag', 'jibu@iyiu.cuoiuio', '234634'),
(45, '3dbe3447dbb55fdcb364f19cda706eac', '7e73f4535f0840c37dc6908b461129a9', '', 'gsdg', 'sdag', 'gdsag', 'sdag', 'jibu@iyiu.cuoiuio', 'weqtweewe'),
(46, '3d44ff1c7682e8008dd14e19232ec555', '2a4e7a8de41c967c9097b2e4a1a0e662', '', '', '', '', '', 'afsfasfa@fdsag.sdfgsd', '25235623');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payable`
--

CREATE TABLE IF NOT EXISTS `supplier_payable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(255) NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  `amount` decimal(55,3) NOT NULL,
  `paid_amount` decimal(55,3) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0',
  `branch_id` varchar(255) NOT NULL,
  `guid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `supplier_payable`
--

INSERT INTO `supplier_payable` (`id`, `invoice_id`, `supplier_id`, `amount`, `paid_amount`, `payment_status`, `branch_id`, `guid`) VALUES
(98, 'd5b164f4c2a831aae3b09964c8be1a50', 'ceab8c7d14f12aaeec1dc19b3d81212a', '143925.000', '143925.000', 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '54afd3b94f1f956d1c56a33766f3b3dd');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `value` varchar(100) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `guid`, `value`, `branch_id`, `type`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '2ba78d7500ac92e84953cbe019741703', '51', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, '81757ff8617e8582c3647d14a4291233', '10', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '58f48b85eaa9afb4fb023de77e2c60c4', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(3, '4d24f165c31f73d0244244fefc770ff8', '56', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(4, '681401b2984eac4f8fb8e26ca609cb3f', '45', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '2e32d79a754f2d48abcffe09ba276ed1', '23', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '58f48b85eaa9afb4fb023de77e2c60c4', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, '6a1975bfa7b8d6fc9ed428cd2b4d6a6e', '56', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '58f48b85eaa9afb4fb023de77e2c60c4', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(7, '8ecdb55b2931da3d861bfe66f9e1afa4', '8798', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4f9a30691955022263017ccddcae1f9d', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, '5dad9a40f3b35cd3b573fcd3d481ea0b', '2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(9, '4eeb244d4c7f6eb3e725c99f970aef8d', '5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(10, 'd8bb722ea46cec6fcc9f88a213401f87', 'safas', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(11, '94f8ababe49f9a0f6270f2ddb96e6291', '67', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 1, 0, '7c9888196685a12a83eecf9c0d05a525', NULL),
(12, '722cd6b7d27eb0ce93c8685a2c426c4d', '5', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 'ff9fc7bb46cf6d765d3f647c9acf3d9c', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(13, '3bd8ee71ad402856e20a0ad069e3d32d', '2', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', '01fc209013ae06f62b4af21088294b45', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(14, 'd6c454509e7e12bc453410346d4b3cb4', '5', '649866515edf661bb321ec7bf0ba3415', '2d612f01de6b7e581f3cd383b7b3e47f', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(23, '83f44fc34e40e186b83a773157aefaee', '500', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 1, 0, NULL, NULL),
(24, 'e975f6767d18140feb3b370bc932b6b3', '500', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '79fb74b70c43bc1aa63397540bad4dff', 1, 0, NULL, NULL),
(25, 'b8feb6eba67530396bbe1df841e8c244', '25', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 1, 0, NULL, NULL),
(26, 'd0d36ee276e1cf6deda047300cb186e2', '5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '79fb74b70c43bc1aa63397540bad4dff', 1, 0, NULL, NULL),
(27, '2afe6b9eea4bff5fa6b6bdc3bdc1dd0c', '501', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '79fb74b70c43bc1aa63397540bad4dff', 1, 0, NULL, NULL),
(28, 'bd7d271a7add87602663c952f185f6d2', '5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'db4dd71b403ab32d0d732bbd9974433a', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taxes_area`
--

CREATE TABLE IF NOT EXISTS `taxes_area` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `taxes_area`
--

INSERT INTO `taxes_area` (`id`, `guid`, `name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(2, '2d81a2d79b828aa9e3d109184961925a', 'Kerala', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(3, 'eceb529a54922e9bd0ba3d305f9520ef', 'Karanada', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(4, '60800ab1992c2df5952c54bbf19f5601', 'Poona', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(5, '9248a89e16bcf4ad98a5c50c68ca1870', 'Tamil Nad', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, 'e0c7c85f03312c7855f7052f5d5cef62', 'Gova', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(7, '1c1e20bd4d0cab963f5580b76eba6abe', 'A P', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, '22bd7f0bf66b60cfc7bda6374d873fcf', 'Rajandhan', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(9, '810cae8bb4bfd17574f57308d3bf0062', 'Colombo', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(10, '85127b2d6897986a9175a142f154cd1a', 'kerala121', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(11, '7973b1abfb2466b4478c9d87476951cf', 'kerala121t', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(12, '28aa802577d2ca603ca011f9a3147881', 'sdafsd dsgfds', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(13, '974cc19e629b993ced7f7267d9fbb526', 'Area 1', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(14, '35df27055dd4a46148b656ee0a048b86', 'Area 2', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(15, '87857edae131c42d5a9f7969ff4a921f', 'kerala', '649866515edf661bb321ec7bf0ba3415', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tax_commodity`
--

CREATE TABLE IF NOT EXISTS `tax_commodity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `schedule` varchar(100) NOT NULL,
  `tax_area` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `part` varchar(100) NOT NULL,
  `code` varchar(200) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tax_commodity`
--

INSERT INTO `tax_commodity` (`id`, `guid`, `branch_id`, `schedule`, `tax_area`, `description`, `part`, `code`, `tax`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(4, '4f160e2434fe0e0b01da625b4e31461c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'simple', '2d81a2d79b828aa9e3d109184961925a', 'south', 'Pasd', 'TND-123', '81757ff8617e8582c3647d14a4291233', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, 'd7226f693d76b072f1fdf50f3089339a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'simple', '60800ab1992c2df5952c54bbf19f5601', 'North', 'Pasd', 'TND-124', '81757ff8617e8582c3647d14a4291233', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(6, 'd6e06e9618dc0c161df0150adb2743ea', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'Uttyty', '11', 'North', 'uiyi', 'TND-127', '4d24f165c31f73d0244244fefc770ff8', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '472a82e9f2fd7f3b26512c87bc2c5e5a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '9248a89e16bcf4ad98a5c50c68ca1870', 'wqtwe', 'yuiyiu', 'TD', '2ba78d7500ac92e84953cbe019741703', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(8, '55bb0f5d16605855dcca760300f469ae', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '90890', '22bd7f0bf66b60cfc7bda6374d873fcf', '53265236', '809', '8908', '2ba78d7500ac92e84953cbe019741703', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tax_types`
--

CREATE TABLE IF NOT EXISTS `tax_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tax_types`
--

INSERT INTO `tax_types` (`id`, `guid`, `type`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '9583a13924a8e28cc35fec0650a891af', 'Vat', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, '58f48b85eaa9afb4fb023de77e2c60c4', 'Normal', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(3, '65cfd0dbcc7053600d5da1f688b78c06', 'sasi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(4, 'db4dd71b403ab32d0d732bbd9974433a', 'test1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(5, 'ed1318118fb9ca6592cb0117d1d5a529', 'asfas', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, '4f9a30691955022263017ccddcae1f9d', 'Vat', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '3acdb4df97f5635b08d72b343a438c80', 'Sales Tax', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, 'd2567c03492d4abc80011e6829067a16', 'Income Tax', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(9, 'ff9fc7bb46cf6d765d3f647c9acf3d9c', 'Vat ', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(10, '01fc209013ae06f62b4af21088294b45', 'Vat 2', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(11, '2d612f01de6b7e581f3cd383b7b3e47f', 'Vat', '649866515edf661bb321ec7bf0ba3415', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(12, '79fb74b70c43bc1aa63397540bad4dff', 'vat1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `blood` varchar(10) NOT NULL,
  `age` int(2) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `image` varchar(50) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `active_status` int(10) NOT NULL DEFAULT '1',
  `created_by` varchar(100) NOT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `delete_status` int(10) NOT NULL DEFAULT '0',
  `user_type` int(11) NOT NULL DEFAULT '1',
  `default_branch` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `guid`, `username`, `password`, `first_name`, `last_name`, `address`, `sex`, `blood`, `age`, `city`, `state`, `zip`, `country`, `email`, `phone`, `image`, `dob`, `active_status`, `created_by`, `deleted_by`, `delete_status`, `user_type`, `default_branch`) VALUES
(3, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'slvpg', 'Male', '', 23, 'bangalore', 'karnada', '676809', 'india', 'jibi344443@yahoo.com', '7795398584', '', '654739200', 1, '99', '0', 0, 2, '2'),
(50, 'a2da554fc03881e96b50685f3d60de70', 'sridhar', '64684ef5cc9e46a7fc3a5308d23a6ebc', 'sridhar', 'bala', '980', 'Male', '90', 89, '980', '098', '980', '980', 'sridhar@yahoo.com', '980908', '', '1396051200', 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL, 0, 1, ''),
(51, '7c9888196685a12a83eecf9c0d05a525', 'monishp', '095747216da7caa0bb51502854665b83', 'monish ', ' km ', 'kanjirathukal ', 'Male', 'ab', 34, 'bangalore', 'karnadaka', '123', 'india', 'kmonish90@gmail.com', '7795386766', '', '889056000', 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL, 0, 1, ''),
(52, 'ac991f07eccd6170455788eaa69532c1', 'US-102', '21232f297a57a5a743894a0e4a801fc3', 'jibi', 'gopi', 'fafa', 'Male', '', 6, 'afa', 'faf', 'asfa', 'faf', 'jibi343@yahoo.com', '2352', '', '1401062400', 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL, 0, 1, ''),
(53, 'c66cbb31661b723fa74b68ce0f864163', 'USD-1009', '21232f297a57a5a743894a0e4a801fc3', 'kumar', 'km', 'saas', 'Male', '', 78, 'asoiu', '98', '980', '809', 'kumar@yahho.com', '890809', '', '1402704000', 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL, 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_x_branches`
--

CREATE TABLE IF NOT EXISTS `users_x_branches` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `user_active` int(11) NOT NULL DEFAULT '1',
  `deleted_by` varchar(255) DEFAULT NULL,
  `admin` int(101) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `users_x_branches`
--

INSERT INTO `users_x_branches` (`id`, `branch_id`, `user_id`, `user_delete`, `user_active`, `deleted_by`, `admin`) VALUES
(1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, 1, '0', 101),
(51, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a2da554fc03881e96b50685f3d60de70', 0, 0, NULL, 1),
(52, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7c9888196685a12a83eecf9c0d05a525', 0, 1, NULL, 1),
(53, '2307d083b4dc2d6476b05c96ef69a99b', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, 1, NULL, 1),
(54, '649866515edf661bb321ec7bf0ba3415', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, 1, NULL, 1),
(55, '649866515edf661bb321ec7bf0ba3415', 'ac991f07eccd6170455788eaa69532c1', 0, 1, NULL, 1),
(56, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'c66cbb31661b723fa74b68ce0f864163', 0, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_x_user_groups`
--

CREATE TABLE IF NOT EXISTS `users_x_user_groups` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `users_x_user_groups`
--

INSERT INTO `users_x_user_groups` (`id`, `user_group_id`, `user_id`, `branch_id`, `active_status`, `delete_status`) VALUES
(155, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'a2da554fc03881e96b50685f3d60de70', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0),
(157, 'b6d767d2f8ed5d21a44b0e5886680cb9', '7c9888196685a12a83eecf9c0d05a525', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0),
(158, '37693cfc748049e45d87b8c7d8b9aacd', '7c9888196685a12a83eecf9c0d05a525', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0),
(159, 'c2de177458bcb272143e5e3be265777a', 'ac991f07eccd6170455788eaa69532c1', '649866515edf661bb321ec7bf0ba3415', 1, 0),
(160, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'c66cbb31661b723fa74b68ce0f864163', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0),
(161, '37693cfc748049e45d87b8c7d8b9aacd', 'c66cbb31661b723fa74b68ce0f864163', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `group_name` varchar(100) NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `guid`, `group_name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(22, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'Art', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '', ''),
(23, '37693cfc748049e45d87b8c7d8b9aacd', 'sales', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '', ''),
(24, '1ff1de774005f8da13f42943881c655f', 'stock', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '', ''),
(25, '8e296a067a37563370ded05f5a3bf3ec', 'Manager', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '', ''),
(26, '4e732ced3463d06de0ca9a15b6153677', 'Account', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '', ''),
(27, 'gsgertyrweyerye', 'dadfa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(28, '3970ef3167e3cfa93451845ddab39191', 'dadfaqwq', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(29, '54678a783206b2720b83b0d12390f4d4', 'dadfaqwqwq', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(32, '293c83cd3affe5549761849580a81c93', 'stocks keeper', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(33, 'a4b555073510923a2c33c6a0b3827e8a', 'stock keeper', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(34, '4b6b158cd09cb72af1da51b5f20fa1be', 'jibi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(35, '54064aecaf5cc9c73baa1bee4e1621ef', 'moni', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(36, 'c2de177458bcb272143e5e3be265777a', 'Stocker', '649866515edf661bb321ec7bf0ba3415', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
