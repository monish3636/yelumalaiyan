-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 01, 2014 at 12:52 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

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
(24, '4801a0eeec002ae2d16247c0799b7f65', 'LG', '649866515edf661bb321ec7bf0ba3415', 1, 0, 61, 0);

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
('5f74f3fe8867bbd2f1d7ec96664ff956', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:30.0) Gecko/20100101 Firefox/30.0', 1401626910, 'a:115:{s:9:"user_data";s:0:"";s:2:"id";s:1:"3";s:4:"guid";s:36:"61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4";s:8:"username";s:5:"admin";s:8:"password";s:32:"21232f297a57a5a743894a0e4a801fc3";s:10:"first_name";s:5:"admin";s:9:"last_name";s:5:"admin";s:7:"address";s:5:"slvpg";s:3:"sex";s:4:"Male";s:5:"blood";s:0:"";s:3:"age";s:2:"23";s:4:"city";s:9:"bangalore";s:5:"state";s:7:"karnada";s:3:"zip";s:6:"676809";s:7:"country";s:5:"india";s:5:"email";s:20:"jibi344443@yahoo.com";s:5:"phone";s:10:"7795398584";s:5:"image";s:2:"10";s:3:"dob";s:9:"654739200";s:13:"active_status";s:1:"1";s:10:"created_by";s:2:"99";s:10:"deleted_by";s:1:"0";s:13:"delete_status";s:1:"0";s:9:"user_type";s:1:"2";s:14:"default_branch";s:1:"2";s:7:"Setting";a:2:{s:6:"Branch";s:1:"1";s:6:"Depart";s:1:"0";}s:9:"branch_id";s:36:"BE4CB6FB-276C-457A-9D0F-D7948222EBB3";s:9:"items_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:5:"items";i:5;}s:5:"items";s:2:"On";s:9:"users_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:5:"users";i:5;}s:5:"users";s:2:"On";s:10:"brands_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:6:"brands";i:5;}s:6:"brands";s:2:"On";s:17:"items_setting_per";a:4:{s:6:"access";i:1;s:4:"read";i:1;s:3:"set";i:1;s:13:"items_setting";i:3;}s:13:"items_setting";s:2:"On";s:13:"item_code_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:9:"item_code";i:5;}s:9:"item_code";s:2:"On";s:9:"taxes_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:5:"taxes";i:5;}s:5:"taxes";s:2:"On";s:17:"tax_commodity_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:13:"tax_commodity";i:5;}s:13:"tax_commodity";s:2:"On";s:18:"items_category_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:14:"items_category";i:5;}s:14:"items_category";s:2:"On";s:13:"tax_types_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:9:"tax_types";i:5;}s:9:"tax_types";s:2:"On";s:14:"taxes_area_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:10:"taxes_area";i:5;}s:10:"taxes_area";s:2:"On";s:13:"suppliers_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:9:"suppliers";i:5;}s:9:"suppliers";s:2:"On";s:21:"suppliers_x_items_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:17:"suppliers_x_items";i:5;}s:17:"suppliers_x_items";s:2:"On";s:13:"customers_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:9:"customers";i:5;}s:9:"customers";s:2:"On";s:21:"customer_category_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:17:"customer_category";i:5;}s:17:"customer_category";s:2:"On";s:15:"user_groups_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:11:"user_groups";i:5;}s:11:"user_groups";s:2:"On";s:12:"branches_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:8:"branches";i:5;}s:8:"branches";s:2:"On";s:18:"purchase_order_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:14:"purchase_order";i:6;}s:14:"purchase_order";s:2:"On";s:26:"customers_payment_type_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:22:"customers_payment_type";i:5;}s:22:"customers_payment_type";s:2:"On";s:20:"items_department_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:16:"items_department";i:5;}s:16:"items_department";s:2:"On";s:22:"suppliers_category_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:18:"suppliers_category";i:5;}s:18:"suppliers_category";s:2:"On";s:25:"purchase_order_cancel_per";a:3:{s:6:"access";i:1;s:3:"add";i:1;s:21:"purchase_order_cancel";i:2;}s:21:"purchase_order_cancel";s:2:"On";s:24:"goods_receiving_note_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:20:"goods_receiving_note";i:6;}s:20:"goods_receiving_note";s:2:"On";s:14:"direct_grn_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:10:"direct_grn";i:6;}s:10:"direct_grn";s:2:"On";s:20:"purchase_invoice_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:16:"purchase_invoice";i:6;}s:16:"purchase_invoice";s:2:"On";s:18:"direct_invoice_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:14:"direct_invoice";i:6;}s:14:"direct_invoice";s:2:"On";s:20:"supplier_payment_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:16:"supplier_payment";i:6;}s:16:"supplier_payment";s:2:"On";s:18:"stock_transfer_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:14:"stock_transfer";i:6;}s:14:"stock_transfer";s:2:"On";s:17:"opening_stock_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:13:"opening_stock";i:6;}s:13:"opening_stock";s:2:"On";s:16:"damage_stock_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:12:"damage_stock";i:6;}s:12:"damage_stock";s:2:"On";s:19:"sales_quotation_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:15:"sales_quotation";i:6;}s:15:"sales_quotation";s:2:"On";s:15:"sales_order_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:11:"sales_order";i:6;}s:11:"sales_order";s:2:"On";s:23:"sales_delivery_note_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:19:"sales_delivery_note";i:6;}s:19:"sales_delivery_note";s:2:"On";s:25:"direct_sales_delivery_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:21:"direct_sales_delivery";i:6;}s:21:"direct_sales_delivery";s:2:"On";s:16:"direct_sales_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:12:"direct_sales";i:6;}s:12:"direct_sales";s:2:"On";s:19:"purchase_return_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:15:"purchase_return";i:6;}s:15:"purchase_return";s:2:"On";s:14:"sales_bill_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:10:"sales_bill";i:6;}s:10:"sales_bill";s:2:"On";s:16:"sales_return_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:12:"sales_return";i:6;}s:12:"sales_return";s:2:"On";s:20:"customer_payment_per";a:7:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:7:"approve";i:1;s:6:"delete";i:1;s:16:"customer_payment";i:6;}s:16:"customer_payment";s:2:"On";s:19:"receiving_stock_per";a:3:{s:6:"access";i:1;s:4:"read";i:1;s:15:"receiving_stock";i:2;}s:15:"receiving_stock";s:2:"On";s:10:"module_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:6:"module";i:5;}s:6:"module";s:2:"On";s:19:"module_category_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:15:"module_category";i:5;}s:15:"module_category";s:2:"On";s:12:"language_per";a:6:{s:6:"access";i:1;s:4:"read";i:1;s:3:"add";i:1;s:4:"edit";i:1;s:6:"delete";i:1;s:8:"language";i:5;}s:8:"language";s:2:"On";s:11:"Posnic_User";s:5:"admin";s:10:"data_limit";i:20;s:13:"price_tag_per";a:4:{s:6:"access";i:1;s:4:"read";i:1;s:3:"set";i:1;s:9:"price_tag";i:3;}s:9:"price_tag";s:2:"On";}');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `guid`, `branch_id`, `first_name`, `title`, `last_name`, `address`, `address2`, `bday`, `mday`, `city`, `state`, `zip`, `country`, `payment`, `credit_limit`, `cdays`, `month_credit_bal`, `category_id`, `comments`, `company_name`, `email`, `phone`, `account_number`, `bank_name`, `bank_location`, `website`, `cst`, `gst`, `tax_no`, `created_by`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(3, '0f7c80352b128f9a45d25e42d1ebd19e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'jibi', '1', 'gopi', 'sdsd', '', 0, 0, 'sdgsd', 'sdgsd', '44236', 'sdgsdg', '62913143b64724f3f2e19b611c0c52a1', 1, 0, '0', 'b0913b800960821c61b9e7426cc3f1b8', '0', 'rtweytwy', 'jibi344443@yahoo.com', '457457', '', '', '', 'wtyweyy', '', '', '', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, 'compan', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'gopi', '1', 'papu', '78979', '', 1368316800, 1368403200, 'HSR Layout', '79879', '686509', 'india', 'caf6d38b8e02db86b3d41fd23a6439bb', 1200, 7987, '7987', 'b0913b800960821c61b9e7426cc3f1b8', '0', 'posnic', 'jibi@yahoo.com', '7795398584', 'ACT446546', '78979', '78979', 'www.posnic.com', '97987', '7987', '9878979', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '63aba6eb627ce1811191c2d22399191d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'Sridhar', '1', 'bala', '789789', '', 1390435200, 1390435200, '798', '798', '98798', '789', '22b29efa97369324e345614ab68b773f', 89, 89, '89', 'fe29e56d1e12ecaa33cff3242d8b8390', '0', 'posnic', 'sridharkalaibala@gmail.com', '798798', '78789khkjhk', 'Fedaral', 'bangalore', 'www.posnic.com', 'Tuy66876', '687687', '687687', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(8, '5315c17449a7324783c45ae3632f7487', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'Sridhar', '1', 'bala', 'bangalore', '', 508204800, 1436918400, 'BDA', 'karnataka', '87979', 'india', 'cb22f3b1c17a6b1df9d2090e945f0364', 78978, 78, '7879', 'b0913b800960821c61b9e7426cc3f1b8', '0', 'posnic', 'sridharkalaibala@gmail.com', '789879879', 'ACT789798', 'IDBI', 'HSR Layout', 'www.posnic.com', '7987987', '789798', '797897', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(9, 'ee6958cdd55bbe2225e4fec2cb6cc6ce', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8908', '1', '89080', 'iuyi', '', 0, 0, 'yiuy', 'uiyi', 'yiuyi', 'uiyui', '22b29efa97369324e345614ab68b773f', 0, 0, '', 'fe29e56d1e12ecaa33cff3242d8b8390', '0', '9809', 'jibi344443@yahoo.com', '89080', '', '', '', '890809', '', '', '', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(10, '98697027e52b1c4acc39d1e8e4dd2504', '649866515edf661bb321ec7bf0ba3415', 'jibi', '1', 'gopi', 'afsaf', '', 1401062400, 1401062400, 'fasf', 'af', 'asfasf', 'asf', '9f420fb73af2e79a50bad7178f1a0676', 0, 0, '', '7ac97c7d20603a3f20ab26c22fa0ff61', '0', '23523', 'jibi344443@yahoo.com', '5523', '', '', '', '5235235', '', '', '', 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `customer_payable`
--

INSERT INTO `customer_payable` (`id`, `invoice_id`, `customer_id`, `amount`, `paid_amount`, `payment_status`, `branch_id`, `guid`) VALUES
(74, 'de3a8068fb7f8e0320b0a3e8f0689214', '63aba6eb627ce1811191c2d22399191d', '1672.696', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ca7c4c7f76fab9b4b456a1d3a2a7d1b2'),
(75, '00f230a2898e6c193b03fabfcbabd990', '63aba6eb627ce1811191c2d22399191d', '6131.212', '1001.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a8ea84f9bcd49b7d6377abfda6b74fd2'),
(76, '40fda2a053bc4aaaae18999220c22ea0', '63aba6eb627ce1811191c2d22399191d', '6131.212', '6000.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3683b8421c7215cd9658c1dd47b13fe0'),
(77, 'b5d62f25fd6c8f6a87173f34a02b6f4c', '63aba6eb627ce1811191c2d22399191d', '605.399', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'dfd0c29a2d67f1190949d7c089cf9b1f'),
(78, 'fd3e2ba52f6808ac804cfe979039d689', '0f7c80352b128f9a45d25e42d1ebd19e', '677048.240', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '35c44e09c468a379a75af9410d2b4605'),
(79, 'f54bec3b68ee6458812ec9c7f1d1502c', 'compan', '109.956', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '73f243429a1a3a742479abc781c30070'),
(80, '70755725d483266efd65c820410eb6fc', '0f7c80352b128f9a45d25e42d1ebd19e', '10.996', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e07a6d3b722ed01d5f593932c6371598'),
(81, '95d2c8fcfd25baa213c0910da9029e91', '98697027e52b1c4acc39d1e8e4dd2504', '3198.720', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '633093afde8912c776db525d7ec3d1ac'),
(82, '1190ddb11e06995104cdd8f569c3525a', '0f7c80352b128f9a45d25e42d1ebd19e', '109.956', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '8c80ccac8cd62e500fe98cfd9f7264b7'),
(83, '62245c40fad9bd6a1acead37243d0b02', '98697027e52b1c4acc39d1e8e4dd2504', '1099.560', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7dfe9d525ed83b53b3eb4d991c001c54'),
(84, '667a901118c7eba0cb686b6dbbca1b48', '98697027e52b1c4acc39d1e8e4dd2504', '120.952', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'c7554d9c3c97868100f8147c45e011f0'),
(85, 'fc157016310c6314cc8b3b69c34d730e', '98697027e52b1c4acc39d1e8e4dd2504', '120.952', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'f53fedf76bdff10ad2166cf1a8f16499'),
(86, '3e5da3bef33d39601471491f84c8fc5d', '5315c17449a7324783c45ae3632f7487', '351.859', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd65e5ec1f240ca8d1b30d2c35508b592'),
(87, 'f7eaddf775032b21d6aa5a4273d3044b', '98697027e52b1c4acc39d1e8e4dd2504', '120.952', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'd88ba3cf09e6e18aa469cd5e3f1c9e61'),
(88, '5403d8f2393351e07e15c7575b0867f8', '98697027e52b1c4acc39d1e8e4dd2504', '120.952', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'f25fa7b70faff3a930134de3af9effd4'),
(89, '000169a36d898572de9444f7c07279e0', '5315c17449a7324783c45ae3632f7487', '351.859', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3deb9f2906d00845070f4e5163bd1e73'),
(90, '21b7680aaee5d3a0372318010c277191', '5315c17449a7324783c45ae3632f7487', '351.859', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'fea09a29b84f54f2a9f98735508ed206'),
(91, 'c1dcba4814bababded50e7582a0f41ca', '5315c17449a7324783c45ae3632f7487', '351.859', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'fbd75c304d50e2e47837da6eca02cd7e'),
(92, '7f9f4229d08269b40d706b8c2999eb93', '0f7c80352b128f9a45d25e42d1ebd19e', '3198.720', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'dfd1c317122aecc5126cab4bde0f0eb1'),
(93, 'f7f5e074b91d026df32d1dcaee2f5eeb', '0f7c80352b128f9a45d25e42d1ebd19e', '3550.579', '2364.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7f389c8d80a668ed4e916b46c49229e1');

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
-- Table structure for table `delivery_note_x_items`
--

CREATE TABLE IF NOT EXISTS `delivery_note_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) NOT NULL,
  `delivery_note` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quty` decimal(55,0) NOT NULL,
  `free` decimal(55,0) NOT NULL,
  `active` int(255) NOT NULL,
  `active_status` int(255) NOT NULL,
  `delete_status` int(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `direct_grn`
--

INSERT INTO `direct_grn` (`id`, `guid`, `supplier_id`, `grn_no`, `grn_date`, `discount`, `discount_amt`, `freight`, `round_amt`, `total_items`, `total_amt`, `total_item_amt`, `remark`, `note`, `invoice_status`, `active_status`, `delete_status`, `order_status`, `branch_id`, `added_by`, `deleted_by`) VALUES
(9, '745cf3775bfd5f59ed23c4e1563d856c', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'POSNIC-D-GRN-1016', 1401494400, '', '0', '', '', '2', '306000.000', '306000', 'asfasfas', 'asfd', 1, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'None'),
(10, 'c674c4c8fc02178646bb56e9f9bfa52d', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'POSNIC-D-GRN-1017', 1401494400, '', '0', '', '', '2', '3060.000', '3060', 'fafsas', 'af', 1, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `direct_grn_items`
--

CREATE TABLE IF NOT EXISTS `direct_grn_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) DEFAULT NULL,
  `order_id` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quty` varchar(100) NOT NULL,
  `received_quty` decimal(55,0) NOT NULL DEFAULT '0',
  `received_free` decimal(55,0) NOT NULL DEFAULT '0',
  `free` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `sell` varchar(100) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL DEFAULT '0',
  `discount_per` decimal(55,0) NOT NULL DEFAULT '0',
  `discount_amount` decimal(55,0) NOT NULL,
  `tax` decimal(55,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `direct_grn_items`
--

INSERT INTO `direct_grn_items` (`id`, `guid`, `order_id`, `item`, `quty`, `received_quty`, `received_free`, `free`, `cost`, `sell`, `mrp`, `amount`, `discount_per`, `discount_amount`, `tax`) VALUES
(26, 'a6eec3dbabca471dd6203cff11bad6aa', '745cf3775bfd5f59ed23c4e1563d856c', '151d15a3cef2622d279cd93bd50ede93', '1000', '0', '0', '0', '100', '110', '120', '100000', '0', '0', '2000'),
(27, 'fd3a497ca307e10b70ea50398b025292', '745cf3775bfd5f59ed23c4e1563d856c', '2e708d983475eb0324d6f9b55ee4b8e0', '1000', '0', '0', '0', '200', '210', '210', '200000', '0', '0', '4000'),
(28, 'f4e318d7206b0b19ef5cabe732e9c6db', 'c674c4c8fc02178646bb56e9f9bfa52d', '151d15a3cef2622d279cd93bd50ede93', '10', '0', '0', '0', '100', '110', '120', '1000', '0', '0', '20'),
(29, '0d45ae570db5d7b292dff2ab65126678', 'c674c4c8fc02178646bb56e9f9bfa52d', '2e708d983475eb0324d6f9b55ee4b8e0', '10', '0', '0', '0', '200', '210', '210', '2000', '0', '0', '40');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `direct_invoice`
--

INSERT INTO `direct_invoice` (`id`, `guid`, `supplier_id`, `invoice_no`, `invoice_date`, `discount`, `discount_amt`, `freight`, `round_amt`, `total_items`, `total_amt`, `total_item_amt`, `remark`, `note`, `invoice_status`, `active_status`, `delete_status`, `order_status`, `branch_id`, `added_by`, `deleted_by`) VALUES
(51, '5c09178ec43f1486b7424f2d55077aab', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'D-INV-1015', 1401494400, '', '0', '', '', '1', '1122.000', '1122', 'fsafasf', 'dsad', 0, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `direct_invoice_items`
--

CREATE TABLE IF NOT EXISTS `direct_invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) DEFAULT NULL,
  `order_id` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quty` varchar(100) NOT NULL,
  `received_quty` decimal(55,0) NOT NULL DEFAULT '0',
  `received_free` decimal(55,0) NOT NULL DEFAULT '0',
  `free` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `sell` varchar(100) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL DEFAULT '0',
  `discount_per` decimal(55,0) NOT NULL DEFAULT '0',
  `discount_amount` decimal(55,0) NOT NULL,
  `tax` decimal(55,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=171 ;

--
-- Dumping data for table `direct_invoice_items`
--

INSERT INTO `direct_invoice_items` (`id`, `guid`, `order_id`, `item`, `quty`, `received_quty`, `received_free`, `free`, `cost`, `sell`, `mrp`, `amount`, `discount_per`, `discount_amount`, `tax`) VALUES
(170, '3e6d2500a676b06daef1f6f61d0115b5', '5c09178ec43f1486b7424f2d55077aab', '151d15a3cef2622d279cd93bd50ede93', '11', '0', '0', '0', '100', '110', '120', '1100', '0', '0', '22');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `direct_sales`
--

INSERT INTO `direct_sales` (`id`, `guid`, `customer_id`, `exp_date`, `code`, `date`, `discount`, `discount_amt`, `customer_discount`, `customer_discount_amount`, `freight`, `round_amt`, `total_items`, `total_amt`, `total_item_amt`, `remark`, `note`, `active_status`, `delete_status`, `order_status`, `receipt_status`, `received_status`, `expire_status`, `branch_id`, `added_by`, `deleted_by`) VALUES
(4, '053a38c92588449ab46a0ff6f0165bf3', '98697027e52b1c4acc39d1e8e4dd2504', 0, 'DS-13', 1401408000, '0.000', '0.000', '2.000', '2.468', '', '', '1', '120.952', '123.420', 'aga', 'dfa', 1, 0, 1, 1, 0, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '571787da5dc8a3bbd4ce331366ad8e04', '5315c17449a7324783c45ae3632f7487', 0, 'DS-14', 1401408000, '0.000', '0.000', '2.000', '7.181', '', '', '2', '351.859', '359.040', 'sdgsdgsd', 'sdfs', 1, 0, 1, 1, 0, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(6, 'f61b875c99a09e18c86b9dd83bb46b73', '0f7c80352b128f9a45d25e42d1ebd19e', 0, 'DS-15', 1401408000, '0.000', '0.000', '2.000', '65.280', '', '', '2', '3198.720', '3264.000', 'dfsdgs', 'sdf', 1, 0, 1, 1, 0, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '659fd31868afb1428f014e11fe3aeab0', '0f7c80352b128f9a45d25e42d1ebd19e', 0, 'DS-16', 1401408000, '0.000', '0.000', '2.000', '72.461', '', '', '2', '3550.579', '3623.040', 'asfasf', 'asfas', 1, 0, 1, 1, 0, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

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
-- Table structure for table `direct_sales_delivery_x_items`
--

CREATE TABLE IF NOT EXISTS `direct_sales_delivery_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) DEFAULT NULL,
  `direct_sales_delivery_id` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quty` varchar(100) NOT NULL,
  `price` decimal(55,3) NOT NULL,
  `discount` decimal(10,3) NOT NULL,
  `stock_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `direct_sales_x_items`
--

CREATE TABLE IF NOT EXISTS `direct_sales_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) DEFAULT NULL,
  `direct_sales_id` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quty` varchar(100) NOT NULL,
  `price` decimal(55,3) NOT NULL,
  `discount` decimal(10,3) NOT NULL,
  `stock_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=225 ;

--
-- Dumping data for table `direct_sales_x_items`
--

INSERT INTO `direct_sales_x_items` (`id`, `guid`, `direct_sales_id`, `item`, `quty`, `price`, `discount`, `stock_id`) VALUES
(221, 'c8ed362351531dc7151927e1b396e94d', 'f61b875c99a09e18c86b9dd83bb46b73', '151d15a3cef2622d279cd93bd50ede93', '100', '110.000', '0.000', 'b13a8380e7ef570088ab8df340347122'),
(222, 'f008ec000fbf1d7da0341dbd67d440f2', 'f61b875c99a09e18c86b9dd83bb46b73', '2e708d983475eb0324d6f9b55ee4b8e0', '100', '210.000', '0.000', '6ac7a005fc6343eb5301af357850fbfb'),
(223, '7d852e2187ebb77c539c0b93b6faf6e7', '659fd31868afb1428f014e11fe3aeab0', '151d15a3cef2622d279cd93bd50ede93', '111', '110.000', '0.000', 'b13a8380e7ef570088ab8df340347122'),
(224, '71cb6066ebbf11b786b961ce57563517', '659fd31868afb1428f014e11fe3aeab0', '2e708d983475eb0324d6f9b55ee4b8e0', '111', '210.000', '0.000', '6ac7a005fc6343eb5301af357850fbfb');

-- --------------------------------------------------------

--
-- Table structure for table `grn`
--

CREATE TABLE IF NOT EXISTS `grn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `grn`
--

INSERT INTO `grn` (`id`, `guid`, `branch_id`, `po`, `grn_no`, `date`, `note`, `remark`, `grn_status`, `invoice_status`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(2, '6588a83749b9206cb9969f9a06485510', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '4ac1ea24f51703b864047ba930e72dc1', 'GRN-1784', 1401494400, 'fsdasf', 'asfasf', 1, 1, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `grn_x_items`
--

CREATE TABLE IF NOT EXISTS `grn_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) NOT NULL,
  `grn` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quty` decimal(55,0) NOT NULL,
  `free` decimal(55,0) NOT NULL,
  `active` int(255) NOT NULL,
  `active_status` int(255) NOT NULL,
  `delete_status` int(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `grn_x_items`
--

INSERT INTO `grn_x_items` (`id`, `guid`, `branch_id`, `grn`, `item`, `quty`, `free`, `active`, `active_status`, `delete_status`, `added_by`) VALUES
(91, 'c1f8464d204c2416259d46709aceffaf', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '6588a83749b9206cb9969f9a06485510', '151d15a3cef2622d279cd93bd50ede93', '100', '0', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(92, '1e6c9fca0315bad56e1fcbcedb21aa9d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '6588a83749b9206cb9969f9a06485510', '2e708d983475eb0324d6f9b55ee4b8e0', '100', '0', 0, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

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
  `cost_price` decimal(65,0) NOT NULL,
  `mrp` decimal(65,0) NOT NULL,
  `tax_Inclusive` int(11) NOT NULL,
  `brand_id` varchar(100) NOT NULL,
  `item_type_id` varchar(100) NOT NULL,
  `selling_price` decimal(65,0) NOT NULL,
  `discount` decimal(65,3) NOT NULL,
  `start_date` int(20) NOT NULL,
  `end_date` int(20) NOT NULL,
  `tax_id` varchar(255) NOT NULL,
  `tax_area_id` varchar(100) NOT NULL,
  `upc_ean_code` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `uom` int(10) NOT NULL,
  `no_of_unit` decimal(11,0) NOT NULL DEFAULT '0',
  `deleted_by` varchar(255) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) DEFAULT NULL,
  `code_status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `guid`, `code`, `ean_upc_code`, `barcode`, `category_id`, `depart_id`, `branch_id`, `supplier_id`, `name`, `description`, `cost_price`, `mrp`, `tax_Inclusive`, `brand_id`, `item_type_id`, `selling_price`, `discount`, `start_date`, `end_date`, `tax_id`, `tax_area_id`, `upc_ean_code`, `location`, `uom`, `no_of_unit`, `deleted_by`, `active_status`, `delete_status`, `added_by`, `code_status`, `image`) VALUES
(29, '151d15a3cef2622d279cd93bd50ede93', '123', '', '8989', '0f1208f8b8d972183bb16bb0443ddb5e', '4a70944370a2a575487e2ad0a5adae9d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 1', '', '100', '120', 1, 'cfd8b485f99e561408192c594f8c2e92', '', '110', '0.000', 0, 0, '5dad9a40f3b35cd3b573fcd3d481ea0b', '85127b2d6897986a9175a142f154cd1a', '', '', 1, '10', NULL, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, ''),
(30, '2e708d983475eb0324d6f9b55ee4b8e0', '124', '', '645252', '0f1208f8b8d972183bb16bb0443ddb5e', '44490e4607304eaaf6f9acaf170ff290', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'Item 2', '', '200', '210', 1, 'cfd8b485f99e561408192c594f8c2e92', '', '210', '0.000', 0, 0, '5dad9a40f3b35cd3b573fcd3d481ea0b', '85127b2d6897986a9175a142f154cd1a', '', '', 1, '10', NULL, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `items_category`
--

INSERT INTO `items_category` (`id`, `guid`, `category_name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '0f1208f8b8d972183bb16bb0443ddb5e', 'balls', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(2, '4a70944370a2a575487e2ad0a5adae9d', 'pen', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(3, '44490e4607304eaaf6f9acaf170ff290', 'book', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, '37bc41880fa0ca0de0fa2e9f37480ba0', 'Goodnight', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '7d964715c57d2df50df0a9d380c9da22', 'vicks', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, '5c3437e9dedbcacead642b41b4a1f214', 'weakily', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '544f4c88a4008a5e58fc3fe5104afea9', 'Box', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, 'f1cbc6905e17586f09094db931bcf75e', 'soap', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(9, '981cbacdb1bd664698bf1803878909b6', 'CD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(10, '402581a70ab59a35c0393cf2310b6f88', 'DVD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(11, '24f1b9183166e5a887c2f882a00dd529', 'sasi12', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(12, 'a571815faaa09a1e6d575c9a5cf92548', 'sasi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(13, '7fa9f5c245fc8ffccbeb3c0437155078', 'mobile phone', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(14, '78eef480d989be7ba6f2a1e1ac515b59', 'jibi gopi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(15, 'b9111f1e4151d408bd01589304eaa23a', 'saaaaaaaaaaaaaaaaa', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(16, '22aa2ef40f166e8d1261c5bb88a4220b', 'oxford', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '7c9888196685a12a83eecf9c0d05a525', NULL),
(17, '2f559b0d9737f2e40407db3e6c998513', 'category 1', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(18, '0a61072caf2d6fc1f515c26f21a71acb', 'category 2', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(19, '5ace409a4f06999ff48ba89307e82e00', 'category 3', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(20, 'eb9540b2b14d24fad7d1406a8baeb35a', 'home', '649866515edf661bb321ec7bf0ba3415', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `items_department`
--

INSERT INTO `items_department` (`id`, `guid`, `department_name`, `branch_id`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '0f1208f8b8d972183bb16bb0443ddb5e', 'Non Veg', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(2, '4a70944370a2a575487e2ad0a5adae9d', 'Vegitable', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(3, '44490e4607304eaaf6f9acaf170ff290', 'Fruits', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, '37bc41880fa0ca0de0fa2e9f37480ba0', 'Medicine', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '7d964715c57d2df50df0a9d380c9da22', 'vicks', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, '5c3437e9dedbcacead642b41b4a1f214', 'weakily', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(7, '544f4c88a4008a5e58fc3fe5104afea9', 'Box', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(8, 'f1cbc6905e17586f09094db931bcf75e', 'soap', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(9, '981cbacdb1bd664698bf1803878909b6', 'CD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(10, '402581a70ab59a35c0393cf2310b6f88', 'DVD', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
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
(21, 'ca6aba89b9e14391b3edc42207c26bef', 'Department 1', '649866515edf661bb321ec7bf0ba3415', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

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
  `sales` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `items_setting`
--

INSERT INTO `items_setting` (`id`, `guid`, `item_id`, `branch_id`, `min_q`, `max_q`, `sales`, `purchase`, `sales_return`, `purchase_return`, `allow_negative`, `tax_inclusive`, `updated_by`, `set`, `added_by`, `active`, `delete_status`, `active_status`) VALUES
(8, '8fd2f0b26e43692112039645d71f1577', 'c3216f7d74d4adcf50901b8559d9a3bc', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '0', '1000', 1, 1, 1, 1, 1, 0, '', 1, '', 0, 1, 0),
(9, '44d9cc0a561f2bd92a2a21e64d5c3c87', 'abc049b9d095c27843b114f02ac5f640', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '10', '10000', 1, 1, 1, 1, 1, 0, '', 1, '', 0, 1, 0),
(10, '467eba091599ff4e3b669dfd7c36f15e', 'ef92a1dc9701ac89a655927183a78d87', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 0, 1, 0, '', 1, '', 1, 0, 0),
(11, '854e42db7afcc7526ae3356c86f6b571', '23b6fb71c13f7a53235835584c0a600f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 0, 1, 0, '', 1, '', 1, 0, 0),
(12, '467eba091599ff4e3b6699fd7c36f15e', 'abyyc049b9d095c27843b114f02ac5f640', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 1, 0, '', 1, '', 1, 0, 0),
(13, '86b3c04f58ec4a778f284a3e13e28a2b', 'bbd6c9542b588e703bf706c30e204777', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 0, 1, 0, 1, 0, '', 1, '', 1, 0, 0),
(14, '8f28441d473f1b088b4688ed4ceb4f69', 'c709663a0324fb6175b807eb730de052', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '0', '0', 1, 1, 1, 1, 1, 0, '', 1, '', 0, 1, 0),
(15, 'd64ae1825d95015b3c71146a6d45d026', '1844a38365bda6feea716ed97859fd31', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 0, 1, 0, 1, 0, '', 1, '', 1, 1, 0),
(16, '1bac78b33d524480614fed9f2997b0ab', '73f2dab62a83cece967625cad014230d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '212', '12', 0, 1, 0, 1, 0, 1, '', 1, '', 0, 1, 0),
(17, '6f087cf2822b3aacef87b43d01713f61', '9d8439c7f35923f2397af1b7edadc670', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 1, 0, '', 1, '', 1, 0, 0),
(18, '5e04d2d6eafb5bb9626139aae2942042', '68fac0f3c2306caadf9779dd6eb0a568', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 0, 0, 0, 0, 0, '', 1, NULL, 1, 0, 1),
(19, '18a6de9884194399839e9d7de9c5f775', 'c82ea2b2b93a10eca382fc23aa2f5d5e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 0, 0, 0, 0, 0, '', 1, NULL, 1, 0, 1),
(20, 'b44c3333b130577e42dabcd268aaf46a', '9c8a34bd8413ff097231dcd035284e1b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(21, '7beae522d6dd4d5e6cebffd01e8598db', '000b7493bfbd3e7be55732d5275b43ba', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(22, '267cfb9e9337e63a8d87214413a9656c', '47e94298a89b3cf89e5e09cde7f4b1b1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(23, '7d0e303ada389bd65ccf6c117966c3ef', '1733d0bbbbd635f34421ddc030579885', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(24, '4b1e63e719f32a90e980dca65b1eeade', 'c2757704eb875d850950bd5bff8cc845', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 0, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(25, '66fdec0625d580aae31eb7357dc16ca8', '96d4396bdfee017b1cf08c3b54bac4a5', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', '', '', 0, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(26, '385ad07e8efff1c0730393058273200a', 'd930df107ecce7ea74902efd74d8dc5c', '649866515edf661bb321ec7bf0ba3415', '', '', 0, 1, 1, 1, 0, 0, '', 0, NULL, 1, 0, 1),
(27, '6a8ab8c8c013c3e5c30b9295f33c9c39', '151d15a3cef2622d279cd93bd50ede93', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 1, NULL, 1, 0, 1),
(28, '844c62f7e5b6683b2ee8c601adf8e354', '2e708d983475eb0324d6f9b55ee4b8e0', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '', 1, 1, 1, 1, 0, 0, '', 1, NULL, 1, 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=163 ;

--
-- Dumping data for table `master_data`
--

INSERT INTO `master_data` (`id`, `guid`, `key`, `prefix`, `value2`, `max`, `branch_id`) VALUES
(144, 'ed37ee6ec13eb174e584504b599dcc79', 'purchase_order', 'POSNIC-GRN-10', 1, 5, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(145, 'd8f21c13259bb3d3cff8a68b1c7d6440', 'grn', 'GRN-178', 1, 5, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(146, 'ba26cb198ae3ee8840fd8c86f7e2fe6c', 'direct_grn', 'POSNIC-D-GRN-10', 1, 18, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(147, 'b15cf29431b6f569ada42694c8e19506', 'purchase_invoice', 'INV-101', 1, 104, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(148, 'f0c07baf6902275a2adae960b2e132e2', 'direct_invoice', 'D-INV-101', 1, 6, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(149, 'ebcf83397dafb2dcd2fb03c220a83c2d', 'purchase_return', 'PR-101', 1, 9, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(150, 'ec409b7ec6ec0f89aaa9474e4378d091', 'sales', 'S-1', 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(151, '6daa5de6eee798a15c0a68e2ce443dae', 'sales_quotation', 'S-1', 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(152, '1cd0d4fad14db0368c204534aa8dcbd4', 'sales_order', 'SO-1', 1, 4, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(153, 'c8d99d87c1df39124399b0703f891b73', 'sales_delivery_note', 'SDN-1', 1, 4, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(154, '30c76b30f4186fe164b1c2469f2f7dc0', 'direct_sales_delivery', 'DDN-1', 1, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(155, 'ffbca780fe7e706f2c0bd3ec8ac6b54b', 'direct_sales', 'DS-1', 1, 7, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(156, '68ea5b8ad570decd3be1ea2f910a057c', 'sales_bill', 'SB-1', 1, 18, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(157, '955665754ee457319308e9cab89815f3', 'sales_return', 'SR-10', 1, 8, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(158, '547b2cc364b6ef8c649d9cd6eadeb45b', 'supplier_payment', 'IN-1', 1, 6, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(159, 'dfa1060f31848435f55b9ae27fb96f8d', 'customer_payment', 'CP-1', 1, 20, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(160, '22917fe9f3b86582576bc7af10458f04', 'opening_stock', 'OS', 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(161, '7594c41b83dd90ba55c09dea3f5b1bf0', 'damage_stock', 'DS-1', 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3'),
(162, '9bc95905cd71fbc1059d1ece4e268c22', 'stock_transfer', 'ST-1', 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

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
(50, '2bcf89342d4e55e266173635cf9e91fc', 'module', '46492bca275b05cbf2db53040ca5b7e8', 1, 102, 0, '0', '0', 1, 0),
(51, '46492bca275b05cbf2db53040ca5b7e8635cf9e91fc', 'module_category', '46492bca275b05cbf2db53040ca5b7e8', 1, 102, 0, '0', '0', 1, 0),
(52, '48512ae7d57b1396273f76fe6ed341a235cf9e91fc', 'language', '8512ae7d57b1396273f76fe6ed341a23', 1, 102, 0, '0', '0', 1, 0),
(53, '410ae239e28e6b6c72a457dcda7762d0', 'price_tag', '80B0F0FD-B148-4C02-AF787C7-7463D856714', 1, 1, 0, '102', '0', 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

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
(14, '8512ae7d57b1396273f76fe6ed341a23', 'language', 0, 11, 1, '', 0, '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

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
(89, '410ae239e28e6410ae239e28e6b6c72a457dcda7762d0', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '410ae239e28e6b6c72a457dcda7762d0', 1, 0, '0', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=367 ;

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
(366, '649866515edf661bb321ec7bf0ba3415', 'c2de177458bcb272143e5e3be265777a', '410ae239e28e6b6c72a457dcda7762d0', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `guid`, `code`, `branch_id`, `type`, `payment_date`, `invoice_id`, `return_id`, `supplier_id`, `payable_id`, `customer_id`, `amount`, `memo`, `added_by`, `added_date`, `delete_status`, `deleted_by`) VALUES
(53, 'aee6c38d9e5a188217a00591d7d223d5', 'CP-114', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'credit', 1401494400, 'f7f5e074b91d026df32d1dcaee2f5eeb', '88be5ada3869df045251529781c34226', '', '', '0f7c80352b128f9a45d25e42d1ebd19e', '0.000', 'asdas', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1401408000, 0, ''),
(54, '6969d6cfe912b406919eed4a83337e09', 'IN-14', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'debit', 1401494400, '8f82b921449d817c0feb0b8736e24041', '', 'ceab8c7d14f12aaeec1dc19b3d81212a', '673d1edf8eaf1efdbb946720bbcc548b', '', '100.000', 'asfasf', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1401408000, 0, ''),
(55, '35d8c246ae0ecaad95d9e26bcbbd8d74', 'CP-115', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'credit', 1401494400, 'f7f5e074b91d026df32d1dcaee2f5eeb', '88be5ada3869df045251529781c34226', '', '', '0f7c80352b128f9a45d25e42d1ebd19e', '0.000', 'asfasf', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1401408000, 0, ''),
(56, 'd2e06cf665808336bd4eb995ad3d640f', 'CP-116', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'credit', 1401494400, 'f7f5e074b91d026df32d1dcaee2f5eeb', '', '', '7f389c8d80a668ed4e916b46c49229e1', '0f7c80352b128f9a45d25e42d1ebd19e', '10.000', 'afasf', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1401408000, 0, ''),
(57, 'c1736b2d365c7782d97955e9265dc1af', 'IN-15', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'debit', 1401494400, '3b878cd646c30a3271c580399892e73a', 'dae9a4aef1c08dbd0bb5a261d063e8d4', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '', '1190.000', 'asdas', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1401408000, 0, ''),
(58, '72913b614d3d211c78d0ef1704a635e4', 'CP-117', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'credit', 1402012800, 'f7f5e074b91d026df32d1dcaee2f5eeb', '', '', '7f389c8d80a668ed4e916b46c49229e1', '0f7c80352b128f9a45d25e42d1ebd19e', '1000.000', 'asfasfa', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1401408000, 0, ''),
(59, 'd4b42822672612a14da4bd599c2e4ada', 'CP-118', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'credit', 1401494400, 'f7f5e074b91d026df32d1dcaee2f5eeb', '13a42ff94a3d02616e6aa79c06d1375d', '', '', '0f7c80352b128f9a45d25e42d1ebd19e', '100.000', 'afafa', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1401408000, 0, ''),
(60, 'a8798dd74dd017efeeb9c19c7fb250b1', 'CP-119', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'credit', 1401580800, 'f7f5e074b91d026df32d1dcaee2f5eeb', '13a42ff94a3d02616e6aa79c06d1375d', '', '', '0f7c80352b128f9a45d25e42d1ebd19e', '1000.000', 'asfasfa', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 1401408000, 0, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `purchase_invoice`
--

INSERT INTO `purchase_invoice` (`id`, `guid`, `invoice`, `date`, `direct_invoice_id`, `grn`, `po`, `supplier_id`, `remark`, `note`, `branch_id`, `added_by`) VALUES
(13, '8f82b921449d817c0feb0b8736e24041', 'INV-101101', 1401494400, '', '6588a83749b9206cb9969f9a06485510', '4ac1ea24f51703b864047ba930e72dc1', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'afafaf', 'af', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(14, 'f55a241a9d94d98677f9e187f4c99ece', 'INV-101102', 1401494400, '', '745cf3775bfd5f59ed23c4e1563d856c', 'non', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'afaf', 'af', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(15, '8f82b921448f82b921449d812b9214498f82b921449d81d81', 'D-INV-1015', 1401494400, '5c09178ec43f1486b7424f2d55077aab', '', '', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'fsafasf', 'dsad', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(16, '3b878cd646c30a3271c580399892e73a', 'INV-101103', 1401494400, '', 'c674c4c8fc02178646bb56e9f9bfa52d', 'non', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'afasfasf', 'af', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice_items`
--

CREATE TABLE IF NOT EXISTS `purchase_invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) NOT NULL,
  `invoice_id` varchar(200) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quty` varchar(100) NOT NULL,
  `free` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `sell` varchar(100) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` int(39) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `deleted_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `guid`, `supplier_id`, `exp_date`, `po_no`, `po_date`, `discount`, `discount_amt`, `freight`, `round_amt`, `total_items`, `total_amt`, `total_item_amt`, `remark`, `note`, `order_cancel`, `active_status`, `delete_status`, `order_status`, `grn_status`, `received_status`, `expire_status`, `branch_id`, `added_by`, `deleted_by`) VALUES
(34, '4ac1ea24f51703b864047ba930e72dc1', 'ceab8c7d14f12aaeec1dc19b3d81212a', 1401494400, 'POSNIC-GRN-104', 1401494400, '', '', '', '', '2', '30600.000', '30600.000', 'fsafsaf', 'sa', 0, 1, 0, 1, 1, 0, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE IF NOT EXISTS `purchase_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) DEFAULT NULL,
  `order_id` varchar(200) NOT NULL,
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
  `active` int(11) NOT NULL DEFAULT '1',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `deleted_by` varchar(200) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=179 ;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `guid`, `order_id`, `branch_id`, `item`, `quty`, `received_quty`, `received_free`, `free`, `cost`, `sell`, `mrp`, `amount`, `discount_per`, `discount_amount`, `tax`, `date`, `active`, `active_status`, `delete_status`, `deleted_by`, `added_by`) VALUES
(177, '54dc54dc3bbcecf71dbce38922ccbdbb', '4ac1ea24f51703b864047ba930e72dc1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', '100', '100', '0', '0', '100', '110', '120', '10000', '0', '0', '200', 0, 1, 1, 0, '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(178, '9c6badee9c2f7d30be9c3a80527e7a99', '4ac1ea24f51703b864047ba930e72dc1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2e708d983475eb0324d6f9b55ee4b8e0', '100', '100', '0', '0', '200', '210', '210', '20000', '0', '0', '400', 0, 1, 1, 0, '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `purchase_return`
--

INSERT INTO `purchase_return` (`id`, `guid`, `purchase_invoice_id`, `code`, `date`, `remark`, `note`, `no_items`, `total_amount`, `paid_amount`, `payment_status`, `active_status`, `delete_status`, `stock_status`, `branch_id`, `deleted_by`, `added_by`) VALUES
(5, '77c173586132469c3df8febd78343f58', '8f82b921449d817c0feb0b8736e24041', 'PR-1015', 1401580800, 'sdgsd', 'sdfsd', 2, '2244.000', '0.000', 0, 0, 1, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, 'e25014a3d77394c050c70cab9e291d84', 'f55a241a9d94d98677f9e187f4c99ece', 'PR-1016', 1401494400, 'sdgsdg', 'sdg', 1, '1122.000', '100.000', 0, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(7, 'dae9a4aef1c08dbd0bb5a261d063e8d4', '3b878cd646c30a3271c580399892e73a', 'PR-1017', 1401494400, 'asfas', 'asf', 2, '3060.000', '1190.000', 0, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(8, '35850a846dba7b9fdbaa661beb699913', '8f82b921448f82b921449d812b9214498f82b921449d81d81', 'PR-1018', 1401494400, 'asfasf', 'as', 1, '1122.000', '1000.000', 0, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `purchase_return_x_items`
--

INSERT INTO `purchase_return_x_items` (`id`, `guid`, `purchase_return_id`, `stocks_history_id`, `item`, `quty`, `cost`, `sell`, `discount_per`, `discount_amount`, `tax`, `amount`) VALUES
(7, '7e9787fed50eb2a77492f20076e85ea8', '77c173586132469c3df8febd78343f58', 'ce4a1b7c2d95de743cf74cf4d7d54599', '151d15a3cef2622d279cd93bd50ede93', 11, '100.000', '0.000', '0.000', '0.000', '22.000', '1100.000'),
(8, '012df93075a8313cdb34bcdf735432c4', 'e25014a3d77394c050c70cab9e291d84', 'b65b39b92697891c020e159e5cff1c31', '2e708d983475eb0324d6f9b55ee4b8e0', 11, '100.000', '0.000', '0.000', '0.000', '22.000', '1100.000'),
(9, '71b11d14622026a44a2be17d84a1d4b5', 'e25014a3d77394c050c70cab9e291d84', '157dc216c5abe4ba79b989d7aea22667', '151d15a3cef2622d279cd93bd50ede93', 11, '100.000', '0.000', '0.000', '0.000', '22.000', '1100.000'),
(10, '59a657f8d373ad016020f1ef260b31e7', 'dae9a4aef1c08dbd0bb5a261d063e8d4', '4d4f7d4199c730cbd1c48e60880e956a', '151d15a3cef2622d279cd93bd50ede93', 10, '100.000', '0.000', '0.000', '0.000', '20.000', '1000.000'),
(11, '080a444d77d1da89cc265b02139d84a6', 'dae9a4aef1c08dbd0bb5a261d063e8d4', 'd90b28a19cd1a971236b87842f1f0778', '2e708d983475eb0324d6f9b55ee4b8e0', 10, '200.000', '0.000', '0.000', '0.000', '40.000', '2000.000'),
(12, 'a03b7c10162476b8e51845badf90b8e2', '35850a846dba7b9fdbaa661beb699913', 'a27408e45922573dc6ada05eab250de5', '151d15a3cef2622d279cd93bd50ede93', 11, '100.000', '0.000', '0.000', '0.000', '22.000', '1122.000');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `sales_bill`
--

INSERT INTO `sales_bill` (`id`, `guid`, `invoice`, `date`, `so`, `sdn`, `direct_sales_id`, `customer_id`, `remark`, `note`, `branch_id`, `added_by`) VALUES
(18, '7f9f4229d08269b40d706b8c2999eb93', '0', 1401494400, 'non', 'non', 'f61b875c99a09e18c86b9dd83bb46b73', '0f7c80352b128f9a45d25e42d1ebd19e', 'sdgsdg', 'vgdsfg', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(19, 'f7f5e074b91d026df32d1dcaee2f5eeb', 'SB-117', 1401494400, 'non', 'non', '659fd31868afb1428f014e11fe3aeab0', '0f7c80352b128f9a45d25e42d1ebd19e', 'asfas', 'saf', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

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
  `customer_discount` decimal(30,3) NOT NULL,
  `customer_discount_amount` decimal(30,3) NOT NULL,
  `note` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
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
-- Table structure for table `sales_order_x_items`
--

CREATE TABLE IF NOT EXISTS `sales_order_x_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(200) DEFAULT NULL,
  `sales_order_id` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `quty` varchar(100) NOT NULL,
  `delivered_quty` int(11) NOT NULL,
  `price` decimal(55,3) NOT NULL,
  `discount` decimal(10,3) NOT NULL,
  `stock_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sales_order_x_items`
--

INSERT INTO `sales_order_x_items` (`id`, `guid`, `sales_order_id`, `item`, `quty`, `delivered_quty`, `price`, `discount`, `stock_id`) VALUES
(5, '38c886178cb93a5e842d2bc9b1c05111', '5cf2e51869b90a1980fc5bb5e2c2cc52', '151d15a3cef2622d279cd93bd50ede93', '100', 100, '110.000', '0.000', '0f7a35e11a59b740423f62f86caf4575');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `sales_return`
--

INSERT INTO `sales_return` (`id`, `guid`, `sales_bill_id`, `code`, `date`, `remark`, `note`, `no_items`, `total_amount`, `paid_amount`, `payment_status`, `active_status`, `delete_status`, `stock_status`, `branch_id`, `deleted_by`, `added_by`) VALUES
(39, '13a42ff94a3d02616e6aa79c06d1375d', 'f7f5e074b91d026df32d1dcaee2f5eeb', 'SR-105', 1401408000, 'sdgsdg', 'sdg', 2, '2501.040', '2089.000', 0, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(40, '88be5ada3869df045251529781c34226', 'f7f5e074b91d026df32d1dcaee2f5eeb', 'SR-106', 1401408000, 'asfas', 'asf', 2, '3264.000', '3264.000', 0, 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(41, 'bf5e9b5138080c62b7ab83b89faf6a60', 'f7f5e074b91d026df32d1dcaee2f5eeb', 'SR-107', 1401494400, 'asafas', 'asasf', 2, '3623.040', '0.000', 0, 1, 0, 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `sales_return_x_items`
--

INSERT INTO `sales_return_x_items` (`id`, `guid`, `sales_return_id`, `item`, `quty`, `sell`, `tax`, `amount`) VALUES
(48, '48ad852ebc97259145843fe467c4e3ac', '13a42ff94a3d02616e6aa79c06d1375d', '151d15a3cef2622d279cd93bd50ede93', 11, '11.000', '2.420', '121.000'),
(49, 'c3218e9607f0831574eba1fba8eb7ac1', '13a42ff94a3d02616e6aa79c06d1375d', '2e708d983475eb0324d6f9b55ee4b8e0', 111, '21.000', '46.620', '2331.000'),
(50, 'c3a51c7725dabd7a8a61f9d0d9c3c686', '88be5ada3869df045251529781c34226', '151d15a3cef2622d279cd93bd50ede93', 100, '11.000', '22.000', '1100.000'),
(51, '669dd5bf3177efe75d68653616221abf', '88be5ada3869df045251529781c34226', '2e708d983475eb0324d6f9b55ee4b8e0', 100, '21.000', '42.000', '2100.000'),
(52, '451944f791dad4a68ee1f857a861bcd7', 'bf5e9b5138080c62b7ab83b89faf6a60', '151d15a3cef2622d279cd93bd50ede93', 111, '11.000', '24.420', '1245.420'),
(53, '3777f93f9249374cbbb24624fbe0bcb2', 'bf5e9b5138080c62b7ab83b89faf6a60', '2e708d983475eb0324d6f9b55ee4b8e0', 111, '21.000', '46.620', '2377.620');

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
  `active` int(11) NOT NULL DEFAULT '1',
  `active_status` int(11) NOT NULL DEFAULT '1',
  `delete_status` int(11) NOT NULL DEFAULT '0',
  `added_by` varchar(255) NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `guid`, `branch_id`, `item`, `quty`, `price`, `active`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(35, '925e699e342f2edb3e1663ff92c2eb6c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', '1021', '110.000', 1, 1, 0, '', ''),
(36, 'a3790aff42f465330652d7e407480db6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2e708d983475eb0324d6f9b55ee4b8e0', '4254', '210.000', 1, 1, 0, '', ''),
(37, 'f2616e9da828168c16d1c972f10f5986', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9d8439c7f35923f2397af1b7edadc670', '78789', '676.000', 1, 1, 0, '', ''),
(38, '05ea636a8d0d190b5ac0c5a65ed7fa5d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', '1021', '110.000', 1, 1, 0, '', ''),
(39, '3854e0c04335fa69c505d2d661b0232b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'c3216f7d74d4adcf50901b8559d9a3bc', '89', '60.000', 1, 1, 0, '', ''),
(40, '64671b448f1dfb459c9a1ac1d889dc09', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', '1021', '110.000', 1, 1, 0, '', ''),
(41, '6c9b9b5f54c1ba20ff400412cf62dda3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', '989', '110.000', 1, 1, 0, '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `stocks_history`
--

INSERT INTO `stocks_history` (`id`, `guid`, `stock_id`, `branch_id`, `item_id`, `supplier_id`, `invoice_id`, `grn_id`, `po_id`, `added_by`, `cost`, `quty`, `price`, `date`) VALUES
(32, 'ce4a1b7c2d95de743cf74cf4d7d54599', '64671b448f1dfb459c9a1ac1d889dc09', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '6588a83749b9206cb9969f9a06485510', '4ac1ea24f51703b864047ba930e72dc1', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '200.000', 100, '210.000', 1401408000),
(33, 'b65b39b92697891c020e159e5cff1c31', 'a3790aff42f465330652d7e407480db6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2e708d983475eb0324d6f9b55ee4b8e0', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '6588a83749b9206cb9969f9a06485510', '4ac1ea24f51703b864047ba930e72dc1', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '200.000', 100, '210.000', 1401408000),
(34, '157dc216c5abe4ba79b989d7aea22667', '6c9b9b5f54c1ba20ff400412cf62dda3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '745cf3775bfd5f59ed23c4e1563d856c', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '100.000', 1000, '110.000', 1401408000),
(35, '64070b4a1c30ff6a90e7051127027002', 'a3790aff42f465330652d7e407480db6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2e708d983475eb0324d6f9b55ee4b8e0', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', '745cf3775bfd5f59ed23c4e1563d856c', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '200.000', 1000, '210.000', 1401408000),
(36, 'a27408e45922573dc6ada05eab250de5', '6c9b9b5f54c1ba20ff400412cf62dda3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', 'ceab8c7d14f12aaeec1dc19b3d81212a', '5c09178ec43f1486b7424f2d55077aab', '', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '100.000', 11, '110.000', 1401408000),
(37, '4d4f7d4199c730cbd1c48e60880e956a', '6c9b9b5f54c1ba20ff400412cf62dda3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '151d15a3cef2622d279cd93bd50ede93', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'c674c4c8fc02178646bb56e9f9bfa52d', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '100.000', 10, '110.000', 1401408000),
(38, 'd90b28a19cd1a971236b87842f1f0778', 'a3790aff42f465330652d7e407480db6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '2e708d983475eb0324d6f9b55ee4b8e0', 'ceab8c7d14f12aaeec1dc19b3d81212a', '', 'c674c4c8fc02178646bb56e9f9bfa52d', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '200.000', 10, '210.000', 1401408000);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `stock_transfer`
--

INSERT INTO `stock_transfer` (`id`, `guid`, `destination`, `code`, `date`, `remark`, `note`, `no_items`, `total_amount`, `active_status`, `delete_status`, `stock_status`, `branch_id`, `deleted_by`, `added_by`) VALUES
(25, 'f4206a8912721c53b84894ee83a02900', '', 'OS18', 1400112000, 'bxcbxc', 'xcvbx', 1, '45450.000', 1, 0, 1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(26, '063c5a4037dab38c58120c140d340eb1', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'OS19', 1400198400, 'xcvbxcbb', 'xcv', 1, '45900.000', 1, 0, 1, '2307d083b4dc2d6476b05c96ef69a99b', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(27, '0aff4fd1c570b2dfe1dda47624569740', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ST-125', 1400457600, 'asdas', 'dasd', 1, '504.900', 1, 0, 0, '2307d083b4dc2d6476b05c96ef69a99b', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(28, 'd312f8e2b7015433b1df3da0cf0936de', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ST-125', 1400457600, 'asdas', 'dasd', 1, '504.900', 0, 1, 0, '2307d083b4dc2d6476b05c96ef69a99b', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(29, '589b86d731658273e259e6a6c465d00d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ST-125', 1400457600, 'asdas', 'dasd', 1, '504.900', 0, 1, 0, '2307d083b4dc2d6476b05c96ef69a99b', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(30, '05eda624a50c419b395443e28522915b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ST-125', 1400457600, 'asdas', 'dasd', 1, '504.900', 1, 0, 0, '2307d083b4dc2d6476b05c96ef69a99b', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(31, '30a903e7fb4b9f8c1ca260e045c891cb', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ST-126', 1400544000, 'sfasfa', 'asdfa', 1, '4590.000', 0, 1, 0, '2307d083b4dc2d6476b05c96ef69a99b', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(32, '055a591dd283ec3ecfdaad48a0af9756', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ST-126', 1400544000, 'sfasfaqwqe', 'asdfa', 1, '4590.000', 1, 0, 1, '2307d083b4dc2d6476b05c96ef69a99b', '', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `guid`, `company_name`, `first_name`, `last_name`, `category`, `email`, `phone`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `comments`, `account_number`, `credit_days`, `credit_limit`, `monthly_credit_bal`, `bank_name`, `bank_location`, `cst_no`, `gst_no`, `tex_reg_no`, `active_status`, `delete_status`, `deleted_by`, `website`, `branch_id`, `added_by`) VALUES
(1, 'ceab8c7d14f12aaeec1dc19b3d81212a', 'JK', 'Jayesh1', 'gopi', '', 'julibeth34@yahoo.in', '7795390584', 'ewrter', 'wertwe', 'ewrtwe', 'reter', 'rterter', 'rtertre', 'sdfsdfsd', 'ew43643', '0', '0', '0', '', '', '', '', '', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'sfgedtrere', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, '7988d76f85fb01646eb9d9b01530c460', 'iouoi', 'Manu', 'km', 'b0913b800960821c61b9e7426cc3f1b8', '', '', '', 'uyiuyi', '', '', '', '', 'uouu', 'uoiuo', '0', '0', '0', '', '', '', '', '', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'oiuoiu', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(3, 'c76d55c21f9d4f577b26fba515a8066f', 'uytuy', 'Nijan', 'xjhk', '', 'jhkjhj@kjhkj.com', '7878797989', 'yiuy', 'iyiuy', 'iuyiuy', 'iuyiuy', 'iyiuy', 'iuyi', 'tutuyt', 'uytuy', '0', '0', '0', '', '', '', '', '', 1, 0, '', 'tuytuy', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(4, '6148f274388f64b43123c3598c3fcf81', 'yutu', 'Kiran', 'yutuy', 'b0913b800960821c61b9e7426cc3f1b8', '', '', '', 'uytuyt', '', '', '', '', 'uytuy', 'uytuyt', '0', '0', '0', '', '', '', '', '', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'uytu', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', ''),
(5, '2a4e7a8de41c967c9097b2e4a1a0e662', 'Champ', 'kumar', 'sasi', 'b0913b800960821c61b9e7426cc3f1b8', 'afsfasfa@fdsag.sdfgsd', '25235623', '', '', '', '', '', '', '', '', '0', '0', '0', '', '', '', '', '', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(6, 'ab4b9cd0dc050345b7ab8365bd10b934', 'zdafas', 'asga', '0', '', '', '', '', '', '', '', '', '', 'asga', '26', '4326', '236', '26', '263', '26', '26', '26', '263', 1, 0, '', 'asga', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(7, '223eecbb705cc68d67fdfa9a10509784', '', 'dfghd', 'dsgsdg', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '', '', '', '', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(8, '4d6d2651564e45b6b1ef0d1fe570e034', 'oiuoi', 'uoiu', 'oiuoi', '', 'jibi@yahoo.com', '98098098', 'uoiuoi', '', 'uoiu', 'oiuoi', 'uou', 'oiuoi', 'uoiuoi', '809', '908', '98', '980', '098', '09809', '8098', '098', '00', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'uoiuoiuoi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(9, '95749f66abfe71f2ee99482280456d9e', '', 'sdgsd', '', '', 'jibi@yahoo.com', '346346346', '', '', '', '', '', '', '', '', '0', '0', '0', '', '', '', '', '', 1, 0, '', '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(10, 'e91054c7db987e18f232ffa506f49394', 'uoiu', 'monish', 'km', 'b0913b800960821c61b9e7426cc3f1b8', 'monis@yahoo.com', '8798798', '43636436', '', 'uoiu', 'oiu', 'oiuoi', 'uoi', 'oiuiouoi', '987', '7897', '98798', '798', '7987', '897', '98798', '798', '7987', 1, 0, '', 'uiuoi', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(11, '2852a4761247d450ccb765bd550c52e9', 'assfa', 'asfasfa', 'asfa', 'bbb619417f5a8add548cdd6af3b7c71a', 'jibi@yahoo.com', '34634634', 'asfas', '', '', '', '', '', '', '', '0', '0', '0', '', '', '', '', '', 1, 0, '', 'fasfasf', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(12, '7e73f4535f0840c37dc6908b461129a9', '', '235623', '', 'b0913b800960821c61b9e7426cc3f1b8', 'jibu@iyiu.cuoiuio', '234634', '', '', 'dfgfdg', 'sdag', 'sdag', 'asdg', '', '', '0', '0', '0', '', '', '', '', '', 1, 0, NULL, '', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `suppliers_category`
--

INSERT INTO `suppliers_category` (`id`, `guid`, `branch_id`, `category_name`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '7879977979777987', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'C-123', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, 'b07822de514011f2e7ffc12692033acb', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'C-1233', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(3, 'b0913b800960821c61b9e7426cc3f1b8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'Web sales1', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(4, 'bbb619417f5a8add548cdd6af3b7c71a', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'dsgsdgs', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(5, '50dd8794a73be791efc0f38b018a14ef', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'fgfgh', 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(6, 'd6ca613468ccc418994b923933d9de4f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'dsfsdgsdgs', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `suppliers_x_items`
--

INSERT INTO `suppliers_x_items` (`id`, `guid`, `branch_id`, `supplier_id`, `item_id`, `cost`, `quty`, `price`, `mrp`, `discount`, `active_status`, `delete_status`, `item_active`, `active`, `deactive_item`, `item_delete`, `added_by`, `deleted_by`) VALUES
(90, '564058293ccfe916218495ddeeca91af', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '95749f66abfe71f2ee99482280456d9e', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '898', '60', '70', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(91, '460dd0914dcdb5ef542f58cb159fa2f8', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '95749f66abfe71f2ee99482280456d9e', 'abc049b9d095c27843b114f02ac5f640', '56', '1000', '75', '78', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(92, '3fef83c32216828aa38bde866d920e1b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ab4b9cd0dc050345b7ab8365bd10b934', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '78', '60', '70', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(93, '2c8bb0198196de48da522aafd6b8ffec', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ab4b9cd0dc050345b7ab8365bd10b934', 'abc049b9d095c27843b114f02ac5f640', '56', '89', '75', '78', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(94, '52e147dbb43181e2912044c572d3bd8d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ab4b9cd0dc050345b7ab8365bd10b934', 'abyyc049b9d095c27843b114f02ac5f640', '56', '89', '75', '78', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(95, '43ed5f2e7ca513a3f8828424f16cc5d2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ab4b9cd0dc050345b7ab8365bd10b934', '23b6fb71c13f7a53235835584c0a600f', '45', '89', '48', '49', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(96, 'cad7cbb88465aaaf841a0823c6f087bd', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ab4b9cd0dc050345b7ab8365bd10b934', 'ef92a1dc9701ac89a655927183a78d87', '12', '89', '15', '16', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(97, '65ea4c7c04c00e05cd8fb93ba0515595', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ab4b9cd0dc050345b7ab8365bd10b934', '9d8439c7f35923f2397af1b7edadc670', '45', '89', '676', '967', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(98, '289b3c286932a1e99558dd06c8c3fb2d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7988d76f85fb01646eb9d9b01530c460', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '89', '60', '70', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(99, 'da66d87794f815c637fa5f5f9d057650', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ab4b9cd0dc050345b7ab8365bd10b934', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '88', '60', '70', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(100, 'f0755ca636f0cc7ce14979c3cf1ce751', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ab4b9cd0dc050345b7ab8365bd10b934', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '78', '60', '70', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(101, 'd227b20f47f52a1e155d5585ed3231ee', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ab4b9cd0dc050345b7ab8365bd10b934', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '89', '60', '70', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(102, '7c81723818d9a4cf7378f4d206ab3268', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ab4b9cd0dc050345b7ab8365bd10b934', 'abc049b9d095c27843b114f02ac5f640', '56', '89', '75', '78', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(103, 'd5c59c54d4e70b1c3498c3ae901e0d68', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '6148f274388f64b43123c3598c3fcf81', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '78', '60', '70', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(104, '60848e911ea8133d90e08201f041c41f', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'c76d55c21f9d4f577b26fba515a8066f', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '90', '60', '70', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(112, 'cb719fa8212effa9598a41c80812a55e', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e91054c7db987e18f232ffa506f49394', 'c3216f7d74d4adcf50901b8559d9a3bc', '90.899', '0', '92.909', '98.000', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(113, '3d1d696943278577e8db87f2768e5251', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e91054c7db987e18f232ffa506f49394', 'abc049b9d095c27843b114f02ac5f640', '56', '0', '75', '78', '', 1, 0, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', ''),
(114, 'e867134cac9363ab141b88634b5a4cd5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e91054c7db987e18f232ffa506f49394', '9d8439c7f35923f2397af1b7edadc670', '45', '0', '676', '967', '', 0, 1, 1, 0, 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(115, 'e867134cac9363ab149363ab141b88634b5a4cd5', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e91054c7db987e18f232ffa506f49394', '68fac0f3c2306caadf9779dd6eb0a568', '68', '0', '69', '89', '', 1, 0, 0, 1, 0, 0, NULL, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(116, '2b4cd764195ea94d9c7f64b1b8c0aaff', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'c3216f7d74d4adcf50901b8559d9a3bc', '45', '0', '60', '70', '', 1, 0, 0, 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(117, '7740eac3b03118a1f7c959d284f69a24', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e91054c7db987e18f232ffa506f49394', 'c709663a0324fb6175b807eb730de052', '12', '0', '30', '34', '', 1, 0, 0, 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(118, '3fb36923716285ae562b22c4a7962cad', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e91054c7db987e18f232ffa506f49394', 'abyyc049b9d095c27843b114f02ac5f640', '56', '0', '75', '78', '', 1, 0, 0, 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(119, '917ad7f57a85fdd62b85c0180080288b', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e91054c7db987e18f232ffa506f49394', '9d8439c7f35923f2397af1b7edadc670', '45', '0', '76', '87', '', 1, 0, 0, 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(120, NULL, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e91054c7db987e18f232ffa506f49394', 'c82ea2b2b93a10eca382fc23aa2f5d5e', '0', '', '30', '0', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(121, '21254cdd45918004746dd702b66a4dda', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e91054c7db987e18f232ffa506f49394', 'cb719fa8212effa9598a41c80812a55e', '44', '0', '66', '77', '', 1, 0, 0, 1, 0, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL),
(122, '92a86264e5f5a4c2ff2a57b5aca2efb3', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'e91054c7db987e18f232ffa506f49394', '9c8a34bd8413ff097231dcd035284e1b', '12', '', '14', '15', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(123, '892f9f39498d7239b742ce72c8e48c6d', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'c76d55c21f9d4f577b26fba515a8066f', '000b7493bfbd3e7be55732d5275b43ba', '879', '', '787', '787', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(124, 'b5b5313cb724c9cf11e3f40e05a2ff60', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'c76d55c21f9d4f577b26fba515a8066f', '47e94298a89b3cf89e5e09cde7f4b1b1', '42', '', '5235', '352', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(125, '7a2a814a17743d64d3e4fdccccc9f30c', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '1733d0bbbbd635f34421ddc030579885', '235', '', '235235', '23523', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(126, 'f642108093fc97c60e18a1739344e5b2', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'c2757704eb875d850950bd5bff8cc845', '32542', '', '235', '35235', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(127, '41fdd9225b1d00800e3c1cc8fdaad552', 'BE4CB6FB-9D0F-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '96d4396bdfee017b1cf08c3b54bac4a5', '13', '', '14', '15', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(128, 'bd9ea478e249beee755c36db73bebb51', '649866515edf661bb321ec7bf0ba3415', 'ceab8c7d14f12aaeec1dc19b3d81212a', 'd930df107ecce7ea74902efd74d8dc5c', '10', '', '14', '15', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(129, 'd65729e459a97c03f4a746fcd5b9debf', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '151d15a3cef2622d279cd93bd50ede93', '100', '', '110', '120', '', 1, 0, 0, 1, 0, 0, NULL, NULL),
(130, '41a7ceff8a3e06a68d25b48ae559a8b6', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ceab8c7d14f12aaeec1dc19b3d81212a', '2e708d983475eb0324d6f9b55ee4b8e0', '200', '', '210', '210', '', 1, 0, 0, 1, 0, 0, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `supplier_payable`
--

INSERT INTO `supplier_payable` (`id`, `invoice_id`, `supplier_id`, `amount`, `paid_amount`, `payment_status`, `branch_id`, `guid`) VALUES
(70, '1fe8e17b45d319d29b51a550fdcc5189', 'e91054c7db987e18f232ffa506f49394', '12869.815', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '31703fb1f5e686252aac3fa238943d10'),
(71, 'ae6e03d1a3eb5a4a9e9ec6a7876ca486', 'e91054c7db987e18f232ffa506f49394', '26377.078', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '31703fb1f5e686252aac3fa238943d10e686252aac3fa238943d10'),
(72, '6884ef831670ce6763513cb06a9cb7ec', 'e91054c7db987e18f232ffa506f49394', '8898.102', '97879.122', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '31703fb1f5e6862531703fb1f5e686252aac3fa238943d10'),
(73, '7426a6fc2562fef9f209621700390c23', 'e91054c7db987e18f232ffa506f49394', '10000.000', '2010.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '31703fb131703fb1f5e686252aac3fa238943d10a238943d10'),
(74, 'e08f89ab5a053803b6fd901f6a131c07', 'ceab8c7d14f12aaeec1dc19b3d81212a', '3029.400', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '3374b67bd012ee2c0529061a3857e0a5'),
(75, '6b9114c5fbd269729f59ad51c312d0fa', 'ceab8c7d14f12aaeec1dc19b3d81212a', '9180.000', '2011.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '89f32e4731425a6528ca4cb346c18bc3'),
(76, '8b75f9a88d4dc7fd3b9c82ceefca2d82', 'ceab8c7d14f12aaeec1dc19b3d81212a', '10200.000', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '69b11a263d6b9055a58726d6aadf5ccd'),
(77, 'e899e0107e9ca37b280f63733742d06a', 'ceab8c7d14f12aaeec1dc19b3d81212a', '306000.000', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '759c8494b4c09e9c7040efd9bfe423aa'),
(78, 'b69920cf9b656b19aff39ea768714b4c', 'ceab8c7d14f12aaeec1dc19b3d81212a', '30600.000', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '56a22bc651a491bdcc5ca9f77a29b08e'),
(79, '8f82b921449d817c0feb0b8736e24041', 'ceab8c7d14f12aaeec1dc19b3d81212a', '30600.000', '100.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '673d1edf8eaf1efdbb946720bbcc548b'),
(80, 'f55a241a9d94d98677f9e187f4c99ece', 'ceab8c7d14f12aaeec1dc19b3d81212a', '306000.000', '0.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'ed6b6af374d3096812a20b419414eb3f'),
(81, '3b878cd646c30a3271c580399892e73a', 'ceab8c7d14f12aaeec1dc19b3d81212a', '3060.000', '1000.000', 0, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'cecaa2b92142cf998a3aa26ec25d57f0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `guid`, `value`, `branch_id`, `type`, `active_status`, `delete_status`, `added_by`, `deleted_by`) VALUES
(1, '2ba78d7500ac92e84953cbe019741703', '51', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '9583a13924a8e28cc35fec0650a891af', 0, 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
(2, '81757ff8617e8582c3647d14a4291233', '10', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '58f48b85eaa9afb4fb023de77e2c60c4', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4'),
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
(14, 'd6c454509e7e12bc453410346d4b3cb4', '5', '649866515edf661bb321ec7bf0ba3415', '2d612f01de6b7e581f3cd383b7b3e47f', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
(11, '2d612f01de6b7e581f3cd383b7b3e47f', 'Vat', '649866515edf661bb321ec7bf0ba3415', 1, 0, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `guid`, `username`, `password`, `first_name`, `last_name`, `address`, `sex`, `blood`, `age`, `city`, `state`, `zip`, `country`, `email`, `phone`, `image`, `dob`, `active_status`, `created_by`, `deleted_by`, `delete_status`, `user_type`, `default_branch`) VALUES
(3, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'slvpg', 'Male', '', 23, 'bangalore', 'karnada', '676809', 'india', 'jibi344443@yahoo.com', '7795398584', '10', '654739200', 1, '99', '0', 0, 2, '2'),
(50, 'a2da554fc03881e96b50685f3d60de70', 'sridhar', '64684ef5cc9e46a7fc3a5308d23a6ebc', 'sridhar', 'bala', '980', 'Male', '90', 89, '980', '098', '980', '980', 'sridhar@yahoo.com', '980908', '', '1396051200', 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL, 0, 1, ''),
(51, '7c9888196685a12a83eecf9c0d05a525', 'monishp', '095747216da7caa0bb51502854665b83', 'monish ', ' km ', 'kanjirathukal ', 'Male', 'ab', 34, 'bangalore', 'karnadaka', '123', 'india', 'kmonish90@gmail.com', '7795386766', '', '889056000', 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL, 0, 1, ''),
(52, 'ac991f07eccd6170455788eaa69532c1', 'US-102', '21232f297a57a5a743894a0e4a801fc3', 'jibi', 'gopi', 'fafa', 'Male', '', 6, 'afa', 'faf', 'asfa', 'faf', 'jibi343@yahoo.com', '2352', '', '1401062400', 1, '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', NULL, 0, 1, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `users_x_branches`
--

INSERT INTO `users_x_branches` (`id`, `branch_id`, `user_id`, `user_delete`, `user_active`, `deleted_by`, `admin`) VALUES
(1, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, 1, '0', 101),
(51, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 'a2da554fc03881e96b50685f3d60de70', 0, 0, NULL, 1),
(52, 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', '7c9888196685a12a83eecf9c0d05a525', 0, 1, NULL, 1),
(53, '2307d083b4dc2d6476b05c96ef69a99b', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, 1, NULL, 1),
(54, '649866515edf661bb321ec7bf0ba3415', '61F8FC7E-CB3F-4CC5-9EF2-4ED38DC992B4', 0, 1, NULL, 1),
(55, '649866515edf661bb321ec7bf0ba3415', 'ac991f07eccd6170455788eaa69532c1', 0, 1, NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Dumping data for table `users_x_user_groups`
--

INSERT INTO `users_x_user_groups` (`id`, `user_group_id`, `user_id`, `branch_id`, `active_status`, `delete_status`) VALUES
(155, 'b6d767d2f8ed5d21a44b0e5886680cb9', 'a2da554fc03881e96b50685f3d60de70', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0),
(157, 'b6d767d2f8ed5d21a44b0e5886680cb9', '7c9888196685a12a83eecf9c0d05a525', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0),
(158, '37693cfc748049e45d87b8c7d8b9aacd', '7c9888196685a12a83eecf9c0d05a525', 'BE4CB6FB-276C-457A-9D0F-D7948222EBB3', 1, 0),
(159, 'c2de177458bcb272143e5e3be265777a', 'ac991f07eccd6170455788eaa69532c1', '649866515edf661bb321ec7bf0ba3415', 1, 0);

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
