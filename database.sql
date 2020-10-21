-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 02, 2020 at 03:34 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'nemosofts@gmail.com', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `bid` int(11) NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `banner_sort_info` varchar(500) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `banner_songs` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_live`
--

CREATE TABLE `tbl_live` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `total_views` int(11) NOT NULL DEFAULT '0',
  `video_type` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `tv_pay` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `onesignal_app_id` varchar(255) NOT NULL,
  `onesignal_rest_key` varchar(255) NOT NULL,
  `publisher_id` varchar(500) NOT NULL,
  `interstital_ad` varchar(500) NOT NULL,
  `interstital_ad_id` varchar(500) NOT NULL,
  `interstital_ad_click` varchar(500) NOT NULL,
  `banner_ad` varchar(500) NOT NULL,
  `banner_ad_id` varchar(500) NOT NULL,
  `facebook_interstital_ad` varchar(255) NOT NULL,
  `facebook_interstital_ad_id` varchar(255) NOT NULL,
  `facebook_interstital_ad_click` varchar(255) NOT NULL,
  `facebook_banner_ad` varchar(255) NOT NULL,
  `facebook_banner_ad_id` varchar(255) NOT NULL,
  `facebook_native_ad` varchar(255) NOT NULL,
  `facebook_native_ad_id` varchar(255) NOT NULL,
  `facebook_native_ad_click` varchar(255) NOT NULL,
  `admob_nathive_ad` varchar(255) NOT NULL,
  `admob_native_ad_id` varchar(255) NOT NULL,
  `admob_native_ad_click` varchar(255) NOT NULL,
  `banner_ad_dialog` varchar(500) NOT NULL,
  `company` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `purchase_code` varchar(255) NOT NULL,
  `nemosofts_key` varchar(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `subscription_id` varchar(255) NOT NULL,
  `merchant_key` varchar(255) NOT NULL,
  `subscription_days` varchar(255) NOT NULL,
  `in_app` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `app_name`, `app_logo`, `onesignal_app_id`, `onesignal_rest_key`, `publisher_id`, `interstital_ad`, `interstital_ad_id`, `interstital_ad_click`, `banner_ad`, `banner_ad_id`, `facebook_interstital_ad`, `facebook_interstital_ad_id`, `facebook_interstital_ad_click`, `facebook_banner_ad`, `facebook_banner_ad_id`, `facebook_native_ad`, `facebook_native_ad_id`, `facebook_native_ad_click`, `admob_nathive_ad`, `admob_native_ad_id`, `admob_native_ad_click`, `banner_ad_dialog`, `company`, `email`, `website`, `contact`, `purchase_code`, `nemosofts_key`, `package_name`, `subscription_id`, `merchant_key`, `subscription_days`, `in_app`, `status`) VALUES
(1, 'Android Live TV', 'app_icon.png', 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'ca-app-pub-3940256099942544', 'true', 'ca-app-pub-3940256099942544/1033173712', '10', 'true', 'ca-app-pub-3940256099942544/6300978111', 'false', '', '10', 'false', '', 'false', '', '10', 'true', 'ca-app-pub-3940256099942544/2247696110', '6', 'false', 'nemosofts', 'thivakaran829@gmail.com', 'https://www.nemosoftscom/', '+00 020456089', 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx', '7sbfm9qa2t-e6rzmjvrwm-bc24d9ynew', 'nemosofts.live.tv.app.new', 'onlinetv1234', '02587753396168028277', '30', 'true', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_live`
--
ALTER TABLE `tbl_live`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_live`
--
ALTER TABLE `tbl_live`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;