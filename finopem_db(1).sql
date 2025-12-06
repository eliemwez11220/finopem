-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2025 at 05:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finopem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) UNSIGNED NOT NULL,
  `address_token` varchar(75) NOT NULL,
  `address_home_code` varchar(10) NOT NULL,
  `address_area_name` varchar(75) DEFAULT NULL,
  `address_street_name` varchar(75) DEFAULT NULL,
  `address_status` varchar(25) DEFAULT NULL,
  `address_type` varchar(75) DEFAULT NULL,
  `address_notes` text DEFAULT NULL,
  `address_created_at` datetime DEFAULT NULL,
  `address_updated_at` datetime DEFAULT NULL,
  `address_deleted_at` datetime DEFAULT NULL,
  `address_parent_id` int(11) UNSIGNED DEFAULT NULL,
  `address_district_id` int(10) UNSIGNED DEFAULT NULL,
  `address_municipality_id` int(10) UNSIGNED DEFAULT NULL,
  `address_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address_token`, `address_home_code`, `address_area_name`, `address_street_name`, `address_status`, `address_type`, `address_notes`, `address_created_at`, `address_updated_at`, `address_deleted_at`, `address_parent_id`, `address_district_id`, `address_municipality_id`, `address_school_id`) VALUES
(1, '241115tN5WkvBLYiL7Vs0AcHoBWI4hEb6Cjsr03lNlti2ThfJbQpJJFD1731675927', '1154', ' psaro', 'Juge', 'actif', NULL, NULL, '2024-11-15 15:05:27', '2025-10-08 12:00:07', NULL, 7, 1, 1, 1),
(2, '241115rOTjn3tToAUPdecK7wHWGG6iJUdQf9ZyJaH0i8a90UjY45Erjn1731676723', '515', 'Mwela', 'Aviateurs', 'actif', NULL, NULL, '2024-11-15 15:18:43', '2025-10-08 11:59:31', NULL, 8, 2, 1, 1),
(3, '250225Q06L1n18DPJ3uPmUzK9u5AYezEtiyDpICLfIp8O3eJuKaQ8JzO1740496570', '001', 'Biayi', 'des ecoles', 'actif', NULL, NULL, '2025-02-25 17:16:10', NULL, NULL, 9, 3, 3, 9),
(4, '250529RDjRgyUN03UcHUZUnIoCWoUSstF5Jkd8zQn0NJefdN1fF9oNVy1748508341', '36A', 'CHAUSSEE KASENGA', 'LA VALEE', 'actif', NULL, NULL, '2025-05-29 10:45:41', NULL, NULL, 10, 4, 4, 1),
(5, '250917S7vNiSIF78BLkrOmCib0UCMpkU4yI3Zy1tJmYfC71l7zqJGcPw1758117905', '11540', 'Munua psaro', 'Juge local', 'actif', NULL, NULL, '2025-09-17 16:05:05', NULL, NULL, 4, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `address_city`
--

CREATE TABLE `address_city` (
  `city_id` int(11) UNSIGNED NOT NULL,
  `city_token` varchar(75) NOT NULL,
  `city_code` varchar(10) NOT NULL,
  `city_name` varchar(75) DEFAULT NULL,
  `city_shortname` varchar(75) DEFAULT NULL,
  `city_status` varchar(25) DEFAULT NULL,
  `city_type` varchar(75) DEFAULT NULL,
  `city_notes` text DEFAULT NULL,
  `city_created_at` datetime DEFAULT NULL,
  `city_updated_at` datetime DEFAULT NULL,
  `city_deleted_at` datetime DEFAULT NULL,
  `city_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `address_district`
--

CREATE TABLE `address_district` (
  `district_id` int(11) UNSIGNED NOT NULL,
  `district_token` varchar(75) NOT NULL,
  `district_code` varchar(10) NOT NULL,
  `district_name` varchar(75) DEFAULT NULL,
  `district_shortname` varchar(75) DEFAULT NULL,
  `district_status` varchar(25) DEFAULT NULL,
  `district_type` varchar(75) DEFAULT NULL,
  `district_notes` text DEFAULT NULL,
  `district_created_at` datetime DEFAULT NULL,
  `district_updated_at` datetime DEFAULT NULL,
  `district_deleted_at` datetime DEFAULT NULL,
  `district_municipality_id` int(11) UNSIGNED DEFAULT NULL,
  `district_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address_district`
--

INSERT INTO `address_district` (`district_id`, `district_token`, `district_code`, `district_name`, `district_shortname`, `district_status`, `district_type`, `district_notes`, `district_created_at`, `district_updated_at`, `district_deleted_at`, `district_municipality_id`, `district_school_id`) VALUES
(1, '241115neKsW3zTiGEkCesJPz1sW7nnpPS0E0POrB3yEZf9VJimke2S6c1731675869', '249744', 'Golf plateau 1', NULL, 'actif', NULL, NULL, '2024-11-15 15:04:28', NULL, NULL, 1, 1),
(2, '2411154p1QItniNfnJMynkoSltbbzRGJlqOQu2E1pm6f8p3C2J3NieGa1731675927', '243721', 'Golf Meteo 1', NULL, 'inactif', NULL, '', '2024-11-15 15:05:27', '2025-10-08 11:32:01', NULL, 1, 1),
(3, '250225M1CqVuQysAckN6UtvGY1QcH9C0fqaaIc7N6GlUI9S9UatsVS8K1740496570', '259024', 'Kalubwe', NULL, 'actif', NULL, NULL, '2025-02-25 17:16:10', NULL, NULL, 2, 1),
(4, '250529cmNHerkFqWwDrz6UI5JS0rezB4Ncw91ZwSPVlbsRkasGHYBMwo1748508341', '252668', 'MUKALA', NULL, 'actif', NULL, NULL, '2025-05-29 10:45:41', NULL, NULL, 2, 1),
(5, '251008NJBQfPdKjYvh3OaVsjopwgSOIithpu5Yw8McyMofl564dY70TE1759915620', '250217', 'ZAMBIA', NULL, 'actif', NULL, '', '2025-10-08 11:27:00', '2025-10-08 11:31:30', NULL, 4, 1),
(6, '251008pUpjwt3IQOSAeJLbNWoUOwDfsCj4Mm7SapoCFJJQD4bh6s89CP1759915975', '257708', 'NSOKO NJANJA', NULL, 'actif', NULL, '', '2025-10-08 11:32:55', NULL, NULL, 5, 1),
(7, '251009YkAJNyG5ToKpap0DBfwKzQEvHY8CSLZ6lih6QRIBL92vzyU2HG1760016729', '256625', 'NAVIUNDU', NULL, 'actif', NULL, '', '2025-10-09 15:32:09', NULL, NULL, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `address_municipality`
--

CREATE TABLE `address_municipality` (
  `municipality_id` int(11) UNSIGNED NOT NULL,
  `municipality_token` varchar(75) NOT NULL,
  `municipality_code` varchar(10) NOT NULL,
  `municipality_name` varchar(75) DEFAULT NULL,
  `municipality_shortname` varchar(75) DEFAULT NULL,
  `municipality_status` varchar(25) DEFAULT NULL,
  `municipality_type` varchar(75) DEFAULT NULL,
  `municipality_notes` text DEFAULT NULL,
  `municipality_created_at` datetime DEFAULT NULL,
  `municipality_updated_at` datetime DEFAULT NULL,
  `municipality_deleted_at` datetime DEFAULT NULL,
  `municipality_city_id` int(11) UNSIGNED DEFAULT NULL,
  `municipality_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address_municipality`
--

INSERT INTO `address_municipality` (`municipality_id`, `municipality_token`, `municipality_code`, `municipality_name`, `municipality_shortname`, `municipality_status`, `municipality_type`, `municipality_notes`, `municipality_created_at`, `municipality_updated_at`, `municipality_deleted_at`, `municipality_city_id`, `municipality_school_id`) VALUES
(1, '241115qOpDvFpdeEBdcJJkergU79dYaR9S1aR4rvhO5MFQ41wOveFoQi1731676723', '244932', 'Annexe', NULL, 'actif', NULL, NULL, '2024-11-15 15:18:43', '2025-10-08 10:32:21', NULL, NULL, 1),
(2, '2411153T9ifuaHwv6Iu2IYzhOLlkwzBbFP0m66pNpjw7W9qKVCzIiJu61731680529', '246539', 'LUBUMBASHI', NULL, 'actif', NULL, NULL, '2024-11-15 16:22:09', '2025-10-08 10:31:05', NULL, NULL, 1),
(3, '250225iTprrkmIdLSkWPaojtUI9imvyjeRBOwEMJjJFDiTU5B8zsZK5w1740496570', '259039', 'Lubumbashi', NULL, 'actif', NULL, NULL, '2025-02-25 17:16:10', NULL, NULL, NULL, 9),
(4, '250529VpJttm19z8tkk5F5eEEugqLQRHUrNddngOQ3IMW1rC80mabkAF1748508341', '251464', 'RUASHI', NULL, 'actif', NULL, NULL, '2025-05-29 10:45:41', NULL, NULL, NULL, 1),
(5, '251008UQEmcRCuLSljT8FDz6cA1m1kc6FRWKqOe0ZJtlM3tHcA7CB38f1759912576', '257447', 'Kamalondo', NULL, 'actif', NULL, NULL, '2025-10-08 10:36:16', NULL, NULL, NULL, 1),
(6, '2510090IDoFkTCJVpd6IoW10gYiu3nrkPVEcHHmIokez6UFCbH9H9ZIi1760016714', '258053', 'ANNEXE', NULL, 'actif', NULL, NULL, '2025-10-09 15:31:54', NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `agent_uid` varchar(75) NOT NULL,
  `agent_code` varchar(75) NOT NULL,
  `agent_firstname` varchar(25) NOT NULL,
  `agent_surname` varchar(25) NOT NULL,
  `agent_lastname` varchar(25) NOT NULL,
  `agent_social_number` varchar(75) DEFAULT NULL,
  `agent_childrens` int(11) DEFAULT NULL,
  `agent_partner_name` varchar(25) DEFAULT NULL,
  `agent_family_number` int(11) DEFAULT NULL,
  `agent_languages` varchar(75) DEFAULT NULL,
  `agent_gender` varchar(25) DEFAULT NULL,
  `agent_card_id` varchar(75) DEFAULT NULL,
  `agent_type` varchar(75) DEFAULT NULL,
  `agent_card_validity` date DEFAULT NULL,
  `agent_email` varchar(25) DEFAULT NULL,
  `agent_phone` varchar(25) DEFAULT NULL,
  `agent_date_birthday` date DEFAULT NULL,
  `agent_place_birthday` varchar(75) NOT NULL,
  `agent_title` varchar(100) DEFAULT NULL,
  `agent_status` varchar(20) NOT NULL,
  `agent_about` text DEFAULT NULL,
  `agent_address` text DEFAULT NULL,
  `agent_city` varchar(75) DEFAULT NULL,
  `agent_region` varchar(75) DEFAULT NULL,
  `agent_country` varchar(75) DEFAULT NULL,
  `agent_picture` varchar(75) DEFAULT NULL,
  `agent_weight` varchar(75) DEFAULT NULL,
  `agent_civility_status` varchar(75) DEFAULT NULL,
  `agent_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `agent_updated_at` datetime DEFAULT NULL,
  `agent_deleted_at` datetime DEFAULT NULL,
  `agent_created_by` varchar(75) DEFAULT NULL,
  `agent_updated_by` varchar(75) DEFAULT NULL,
  `agent_deleted_by` varchar(75) DEFAULT NULL,
  `agent_company_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`agent_uid`, `agent_code`, `agent_firstname`, `agent_surname`, `agent_lastname`, `agent_social_number`, `agent_childrens`, `agent_partner_name`, `agent_family_number`, `agent_languages`, `agent_gender`, `agent_card_id`, `agent_type`, `agent_card_validity`, `agent_email`, `agent_phone`, `agent_date_birthday`, `agent_place_birthday`, `agent_title`, `agent_status`, `agent_about`, `agent_address`, `agent_city`, `agent_region`, `agent_country`, `agent_picture`, `agent_weight`, `agent_civility_status`, `agent_created_at`, `agent_updated_at`, `agent_deleted_at`, `agent_created_by`, `agent_updated_by`, `agent_deleted_by`, `agent_company_uid`) VALUES
('202211081667917427YLms0OAfEf5OFziPlRSVZ7F8tQLEUnOTtNYg3IbRKP04bqpYhN', '2229149', 'kazadi', 'jeancy', 'kazadi', NULL, NULL, NULL, NULL, NULL, 'homme', 'A21219010', 'employees', '2023-11-08', 'kazadi.jeancy@majenge.com', '+243853743930', '2000-11-03', 'Kolwezi', 'Administratif', 'actif', NULL, 'LUBUMBASHI RDC', 'Lubumbashi', 'Katanga', 'congolese', NULL, NULL, 'single', '2022-11-10 01:33:10', '2025-09-01 11:34:54', NULL, '2021111916373536148JO3eRFZ2HBgj8fJUiKyNtfKPGEOKtANFrVlLeyhJCtHvu6Yvu', NULL, NULL, '1'),
('202211081667917728tU0ADGOIgsjKdH6vHQ1wiLBoit9uS1N1yeBm2lS0SD2bMwN3OL', '2238006', 'Kasongo', 'judas', 'Ilunga', '18082024', 1, 'Many lao', NULL, 'EN', 'homme', 'CD002131', 'employees', '2023-12-10', 'judas@majenge.com', '+2439783743930', '2000-08-18', 'Kolwezi', 'Menuisier', 'actif', 'CONGOLAIS DE PERE ET DE MERE', '11220, Trecaz One Way, Lualaba, RDC', 'Lubumbashi', 'Haut-Katanga', 'congolese', '1747826644_3eaf2204db3769972a3f.png', NULL, 'single', '2022-11-10 01:42:59', '2025-05-21 11:27:16', NULL, '2021111916373536148JO3eRFZ2HBgj8fJUiKyNtfKPGEOKtANFrVlLeyhJCtHvu6Yvu', NULL, NULL, '1'),
('202211081667922392Y5gQTR7bDjayQbGgws8BRoK6rtg6RLYQ8IHQnGhFTMftzJUdMq', '2210384', 'Luvungu', 'Rodriguez', 'Mbeya', '1825002', 2, 'Eliane Mbosso', 3, 'KI', 'homme', '227151515151', 'trainees', '2023-05-20', 'roriguezmb02@gmail.com', '+243994415955', '1992-02-20', 'Lubumbashi', 'Chauffeur', 'actif', 'RAS', '11220, Trecaz One Way, Lualaba, RDC', 'Kolwezi', 'Lualaba', 'congolese', NULL, NULL, 'single', '2022-11-11 15:09:06', '2025-05-28 08:18:18', NULL, '202211111668152069f0L1nqGkmwWCElBMuBWKaJF0qaJyrVo27lQrPPAZ3EJiP5JgZ5', NULL, NULL, '1'),
('202211111668172402z0DEmBVyzUTBJeLHC6nvuZvVFsYHWBCqPCHdm4BREetBW3h06y', '2282151', 'SWAGGER', 'BOBLY', 'BOB', NULL, NULL, NULL, NULL, NULL, 'femme', 'YE20044', 'expatriates', '2023-11-11', 'bobly@gmail.com', '+243978939393', '2004-11-10', 'LIKASI', NULL, 'actif', NULL, NULL, NULL, NULL, 'congolese', NULL, NULL, 'single', '2022-11-11 15:13:22', NULL, NULL, '202211111668152069f0L1nqGkmwWCElBMuBWKaJF0qaJyrVo27lQrPPAZ3EJiP5JgZ5', NULL, NULL, '1'),
('202212071670419272IudrGNbLb4FjutsOAMvoYWc12uua4YDzqEpTdZnbYuYWHLlLg3', '2209181', 'Rubuz', 'Emmanuel', 'Kabuik', '', 0, 'Jeannette KET', 0, 'ES', 'homme', '478483983', 'expatriates', '2023-02-12', 'rubukab@gmail.com', '09980900112', '2000-12-12', 'LIKASI', 'DEV', 'actif', 'Informaticien de gestion', '25 des rosiers, bel-air, lushi, hk', 'LUSHI', 'KATANGA', 'congolese', '1750427840_828d6671ce518956be59.png', NULL, 'divorced', '2022-12-07 15:21:12', '2025-06-20 14:11:03', NULL, '2021111916373536148JO3eRFZ2HBgj8fJUiKyNtfKPGEOKtANFrVlLeyhJCtHvu6Yvu', NULL, NULL, '1'),
('202212131670933834u6UTYimcar9bL26G2DJuMtbCNl603zQSNIwnPrb61naPbbwTDt', '2255451', 'Chipeng', 'ELIAS', 'Rubuz', '536327622', 0, 'CHELLA', NULL, 'french', 'homme', '652367278287', 'expatriates', '2022-12-30', '', '637383938912', '2004-12-10', 'LIK', NULL, 'actif', '', '', NULL, NULL, 'congolese', '1670933834_1ebb064b81c2b5d8729b.jpg', NULL, 'married', '2022-12-13 14:17:13', NULL, NULL, '2021111916373536148JO3eRFZ2HBgj8fJUiKyNtfKPGEOKtANFrVlLeyhJCtHvu6Yvu', NULL, NULL, '1'),
('250621E3c9GJ7BPTm59CeLAgzkBUoTvzlNtv04GRjev1Ugrdf4gpQVpZ1750488031', '250146', 'Kasongo', 'Kenneth', 'mwepu', '', 0, '', 0, 'FR', 'homme', NULL, 'employees', NULL, 'alph@gmail.io', '8585333025', '0000-00-00', '', 'Professeur', 'actif', 'ras', '250 hkkk', 'lbb', 'GGGHH', 'congolese', NULL, NULL, 'single', '2025-06-21 06:40:31', '2025-09-01 11:33:47', NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `agents_attendances`
--

CREATE TABLE `agents_attendances` (
  `attendance_id` int(11) NOT NULL,
  `attendance_token` varchar(75) DEFAULT NULL,
  `attendance_employe_id` varchar(75) NOT NULL,
  `attendance_company_uid` varchar(75) NOT NULL,
  `attendance_type` varchar(10) DEFAULT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` varchar(10) DEFAULT NULL,
  `attendance_in_time` time DEFAULT NULL,
  `attendance_out_time` time DEFAULT NULL,
  `attendance_hours` int(11) DEFAULT NULL,
  `attendance_created_at` datetime DEFAULT current_timestamp(),
  `attendance_updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `attendance_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agents_attendances`
--

INSERT INTO `agents_attendances` (`attendance_id`, `attendance_token`, `attendance_employe_id`, `attendance_company_uid`, `attendance_type`, `attendance_date`, `attendance_status`, `attendance_in_time`, `attendance_out_time`, `attendance_hours`, `attendance_created_at`, `attendance_updated_at`, `attendance_notes`) VALUES
(9, '250830JSIhuq4hBLcIOmzEWOW6gsHd2ENCMDkEWCS7Agqt41Pvb2v8a21756542555', '202212071670425617FR3afaeYHDSzQqzDi3nDZLu9fiTS0kCrpPo1I5V4MYpeiRiC8f', '1', 'entry', '2025-08-30', 'P', '10:27:59', NULL, NULL, '2025-08-30 10:29:15', '2025-08-30 10:29:15', ''),
(10, '250830bu1g4zmhSoos3CkYl8e2MJNmoC9pkOHpuAe37GZ49te4Kb0SAT1756542624', '202212071670425617FR3afaeYHDSzQqzDi3nDZLu9fiTS0kCrpPo1I5V4MYpeiRiC8f', '1', 'overtime', '2025-08-30', '130', NULL, NULL, 6, '2025-08-30 10:30:24', '2025-08-30 10:30:24', '');

-- --------------------------------------------------------

--
-- Table structure for table `agents_contracts`
--

CREATE TABLE `agents_contracts` (
  `contract_uid` varchar(75) NOT NULL,
  `contract_code` varchar(75) NOT NULL,
  `contract_email_service` varchar(25) DEFAULT NULL,
  `contract_phone_service` varchar(25) DEFAULT NULL,
  `contract_date` date DEFAULT NULL,
  `contract_place` varchar(75) NOT NULL,
  `contract_type` varchar(75) NOT NULL,
  `contract_status` varchar(20) NOT NULL,
  `contract_profile` varchar(75) NOT NULL,
  `contract_agent_uid` varchar(75) DEFAULT NULL,
  `contract_service_uid` varchar(75) DEFAULT NULL,
  `contract_category_uid` varchar(75) DEFAULT NULL,
  `contract_position_uid` varchar(75) DEFAULT NULL,
  `contract_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `contract_updated_at` datetime DEFAULT NULL,
  `contract_deleted_at` datetime DEFAULT NULL,
  `contract_created_by` varchar(75) DEFAULT NULL,
  `contract_updated_by` varchar(75) DEFAULT NULL,
  `contract_deleted_by` varchar(75) DEFAULT NULL,
  `contract_holidays_number` int(11) DEFAULT NULL,
  `contract_working_number` int(11) DEFAULT NULL,
  `contract_cost_day` decimal(10,2) DEFAULT NULL,
  `contract_cost_location` decimal(10,2) DEFAULT NULL,
  `contract_cost_transport` decimal(10,2) DEFAULT NULL,
  `contract_cost_hospital` decimal(10,2) DEFAULT NULL,
  `contract_cost_salary` decimal(10,2) DEFAULT NULL,
  `contract_cost_exchange` decimal(10,2) DEFAULT NULL,
  `contract_salary_rate` decimal(10,2) DEFAULT NULL,
  `contract_salary` decimal(10,2) DEFAULT NULL,
  `contract_smig` decimal(10,2) DEFAULT NULL,
  `contract_smag` decimal(10,2) DEFAULT NULL,
  `contract_notes` text DEFAULT NULL,
  `contract_start_date` date DEFAULT NULL,
  `contract_end_date` date DEFAULT NULL,
  `contract_company_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `agents_contracts`
--

INSERT INTO `agents_contracts` (`contract_uid`, `contract_code`, `contract_email_service`, `contract_phone_service`, `contract_date`, `contract_place`, `contract_type`, `contract_status`, `contract_profile`, `contract_agent_uid`, `contract_service_uid`, `contract_category_uid`, `contract_position_uid`, `contract_created_at`, `contract_updated_at`, `contract_deleted_at`, `contract_created_by`, `contract_updated_by`, `contract_deleted_by`, `contract_holidays_number`, `contract_working_number`, `contract_cost_day`, `contract_cost_location`, `contract_cost_transport`, `contract_cost_hospital`, `contract_cost_salary`, `contract_cost_exchange`, `contract_salary_rate`, `contract_salary`, `contract_smig`, `contract_smag`, `contract_notes`, `contract_start_date`, `contract_end_date`, `contract_company_uid`) VALUES
('202212071670425617FR3afaeYHDSzQqzDi3nDZLu9fiTS0kCrpPo1I5V4MYpeiRiC8f', '2290393', 'rubuz@trecaz.org', '0998909000', '2024-12-07', 'Likasi', 'CDD', 'actif', 'national', '202211081667917427YLms0OAfEf5OFziPlRSVZ7F8tQLEUnOTtNYg3IbRKP04bqpYhN', '202202261645863649KeGTHiF6ViCSUMwwRmRhEjAhJHrJWPJDTQBDgAb6e42DozcjYR', '202112091639056117oPJwBZZ3JYp9jObUUFKd4Jvc8KimohUnvK7g1lB53IbLtu4WIl', '202106241624564515HCg0UKi2dhCw5Q', '2022-12-07 17:06:57', '2025-07-26 11:50:06', NULL, '2021111916373536148JO3eRFZ2HBgj8fJUiKyNtfKPGEOKtANFrVlLeyhJCtHvu6Yvu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000.00, NULL, NULL, 'RAS', '2024-12-07', '2025-12-07', '1'),
('202212131670934033lJTgY8kHAhoh9Q0SewqYiOu12zp03O48ThYWtg5Ld37FODTscG', '2252876', '', '', '2022-12-10', 'KOLWEZI', 'CDD', 'actif', 'expatrie', '202212131670933834u6UTYimcar9bL26G2DJuMtbCNl603zQSNIwnPrb61naPbbwTDt', '202112091639058387rCvBnUelSaAracei4cwTmjaG0QArBRMChKKaQsEEVcVqADCq6J', '202112121639309158DSDg9Dun30j9qq6RU0fzdUk2SryRej2RGgzFQf5mZLOj4gG5rr', '202105131620895997bh7lPOB4nZgFkH', '2022-12-13 14:20:33', NULL, NULL, '2021111916373536148JO3eRFZ2HBgj8fJUiKyNtfKPGEOKtANFrVlLeyhJCtHvu6Yvu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2022-12-12', '2023-12-30', '1'),
('250524tImRpVs6BLzsejyrdj7J6aVAgT5MqDCha7zLWQTIquerD6ehFc1748088797', '252226', 'rubuz@ditotase.com', '+243858533285', '2025-05-20', 'Kinshasa', 'CDD', 'actif', '', '202211081667922392Y5gQTR7bDjayQbGgws8BRoK6rtg6RLYQ8IHQnGhFTMftzJUdMq', '202202261645863649KeGTHiF6ViCSUMwwRmRhEjAhJHrJWPJDTQBDgAb6e42DozcjYR', '202112091639056030Zy4zUzERrA7QD6DGJ3BZgo2tqYNzZuegqCkoaMYEWUeKAdZZIB', '202106241624564533bfMdKS0qlT7Z74', '2025-05-24 12:13:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1500.00, NULL, NULL, '', '2025-05-05', '2027-05-05', '1'),
('250621wMnKFbbepuFBIyotCjlTHu2GwLKhnlYtUcmKKgTs27rabCcKCO1750493197', '252612', '', '', '0000-00-00', '', 'Stage', 'actif', '', '250621E3c9GJ7BPTm59CeLAgzkBUoTvzlNtv04GRjev1Ugrdf4gpQVpZ1750488031', NULL, '250527r6e9Ecpqt4F79epVNv0iyfs4CzQRacBKrnO0svBfHydo6Kf8C51748341334', NULL, '2025-06-21 08:06:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, '', '2025-06-23', '0000-00-00', '1'),
('250726uHNEGPw9P9f43m5IgoaL95NmKGLBupBnfroghcwoSofQfnOGT41753521675', '251738', '', '', '0000-00-00', '', 'CDI', 'actif', '', '202212071670419272IudrGNbLb4FjutsOAMvoYWc12uua4YDzqEpTdZnbYuYWHLlLg3', NULL, '202112091639056030Zy4zUzERrA7QD6DGJ3BZgo2tqYNzZuegqCkoaMYEWUeKAdZZIB', NULL, '2025-07-26 11:21:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, '', '2025-05-01', '0000-00-00', '1'),
('250726uJuS8RL2pnqiWFJvbL4YQ5696E5pYnJBBc9kwMjKjv51oHVFk61753521655', '258274', '', '', '0000-00-00', '', 'CDI', 'actif', '', '202211081667917728tU0ADGOIgsjKdH6vHQ1wiLBoit9uS1N1yeBm2lS0SD2bMwN3OL', NULL, '202112091639056117oPJwBZZ3JYp9jObUUFKd4Jvc8KimohUnvK7g1lB53IbLtu4WIl', NULL, '2025-07-26 11:20:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, '', '2025-05-01', '0000-00-00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `agents_payroll_payments`
--

CREATE TABLE `agents_payroll_payments` (
  `payment_uid` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_period` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_agent_uid` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_code` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_status` varchar(75) DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `payment_notes` text DEFAULT NULL,
  `payment_work_days` int(11) DEFAULT NULL,
  `payment_hospital_days` int(11) DEFAULT NULL,
  `payment_off_days` int(11) DEFAULT NULL,
  `payment_leave_days` int(11) DEFAULT NULL,
  `payment_leave_hospital` int(11) DEFAULT NULL,
  `payment_total_hours` int(11) DEFAULT NULL,
  `payment_overtime_130` int(11) DEFAULT NULL,
  `payment_overtime_160` int(11) DEFAULT NULL,
  `payment_overtime_200` int(11) DEFAULT NULL,
  `payment_night_days` int(11) DEFAULT NULL,
  `payment_amount_bonus` decimal(10,0) DEFAULT NULL,
  `payment_amount_deductions` decimal(10,0) DEFAULT NULL,
  `payment_amount_allocation` decimal(10,0) DEFAULT NULL,
  `payment_amount_regular` decimal(10,0) DEFAULT NULL,
  `payment_amount_gratification` decimal(10,0) DEFAULT NULL,
  `payment_bonus_label` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_created_at` datetime DEFAULT current_timestamp(),
  `payment_updated_at` datetime DEFAULT NULL,
  `payment_company_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `agents_payroll_payments`
--

INSERT INTO `agents_payroll_payments` (`payment_uid`, `payment_date`, `payment_period`, `payment_agent_uid`, `payment_code`, `payment_status`, `payment_amount`, `payment_notes`, `payment_work_days`, `payment_hospital_days`, `payment_off_days`, `payment_leave_days`, `payment_leave_hospital`, `payment_total_hours`, `payment_overtime_130`, `payment_overtime_160`, `payment_overtime_200`, `payment_night_days`, `payment_amount_bonus`, `payment_amount_deductions`, `payment_amount_allocation`, `payment_amount_regular`, `payment_amount_gratification`, `payment_bonus_label`, `payment_created_at`, `payment_updated_at`, `payment_company_uid`) VALUES
('250830F0QIlcAS3cb46nbwMtW1oMaZ2UqGo6BHptLfemtQb66bwOuNgk1756542671', '2025-08-30', '8', '202212071670425617FR3afaeYHDSzQqzDi3nDZLu9fiTS0kCrpPo1I5V4MYpeiRiC8f', '258909', 'pending', 0.00, '', 1, NULL, 0, 18, 1, NULL, 6, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2025-08-30 10:31:11', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `agents_payroll_requests`
--

CREATE TABLE `agents_payroll_requests` (
  `request_uid` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `request_code` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `request_date` date DEFAULT NULL,
  `request_amount` decimal(20,2) NOT NULL DEFAULT 0.00,
  `request_salary` decimal(20,2) DEFAULT NULL,
  `request_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `request_notes` text DEFAULT NULL,
  `request_period` int(11) DEFAULT NULL,
  `request_created_at` datetime NOT NULL,
  `request_updated_at` datetime DEFAULT NULL,
  `request_deleted_at` datetime DEFAULT NULL,
  `request_agent_uid` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `request_company_uid` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Gestion des classifications';

--
-- Dumping data for table `agents_payroll_requests`
--

INSERT INTO `agents_payroll_requests` (`request_uid`, `request_code`, `request_date`, `request_amount`, `request_salary`, `request_status`, `request_notes`, `request_period`, `request_created_at`, `request_updated_at`, `request_deleted_at`, `request_agent_uid`, `request_company_uid`) VALUES
('2506212E93fGUcIfJJbzQoPBVBO3bwTAe5EjudHCmNleDbGCprnvaDol1750499069', '254552', '2025-06-21', 50.00, NULL, 'actif', 'Traitements', 7, '2025-06-21 09:44:29', '2025-08-26 15:07:47', NULL, '250621wMnKFbbepuFBIyotCjlTHu2GwLKhnlYtUcmKKgTs27rabCcKCO1750493197', '1'),
('250621Jyp3RoWjbjdLWQDGkFrhIYy89DmKbtY1QgFADvJDnIhgeiSMMS1750500707', '256086', '2025-06-21', 100000.00, NULL, 'rejected', 'gggg', 6, '2025-06-21 10:11:47', '2025-06-21 10:29:18', NULL, '250524tImRpVs6BLzsejyrdj7J6aVAgT5MqDCha7zLWQTIquerD6ehFc1748088797', '1'),
('250621nf06sZ3FcDzlR1dF9kO1LJ9uLW3wa99FcjWpPMwdDJaGqMIltp1750500066', '257120', '2025-06-21', 20000.00, NULL, 'cancel', 'SA', 6, '2025-06-21 10:01:06', '2025-07-26 13:21:36', NULL, '202212071670425617FR3afaeYHDSzQqzDi3nDZLu9fiTS0kCrpPo1I5V4MYpeiRiC8f', '1'),
('25062394VYOhsE6hhcQRLfiuRji1NB9CuejVYL1waemgKB8KH9L70MBe1750677835', '250777', '2025-06-23', 75000.00, NULL, 'actif', 'CARBURANT', 6, '2025-06-23 11:23:55', NULL, NULL, '250621wMnKFbbepuFBIyotCjlTHu2GwLKhnlYtUcmKKgTs27rabCcKCO1750493197', '1'),
('250826GzCnuhSuuOt4fY8TMWMkThdddp6FP88U4HDGa6CLMqhHCQoOYa1756214221', '253240', '2025-08-26', 20.00, NULL, 'actif', 'Famille', 7, '2025-08-26 15:17:01', NULL, NULL, '250726uJuS8RL2pnqiWFJvbL4YQ5696E5pYnJBBc9kwMjKjv51oHVFk61753521655', '1'),
('250826qIlUaQZKgv9GqvbeHJEEUEm3wCdz7fGib58D821pQhUcIhIVIa1756213915', '256020', '2025-08-26', 80.00, NULL, 'actif', 'Transport', 7, '2025-08-26 15:11:55', NULL, NULL, '250726uJuS8RL2pnqiWFJvbL4YQ5696E5pYnJBBc9kwMjKjv51oHVFk61753521655', '1');

-- --------------------------------------------------------

--
-- Table structure for table `agents_services`
--

CREATE TABLE `agents_services` (
  `service_uid` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `service_code` varchar(25) DEFAULT NULL,
  `service_name` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `service_type` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `service_phone` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_email` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_responsable` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `service_created_by` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_updated_at` datetime DEFAULT NULL,
  `service_updated_by` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_deleted_at` datetime DEFAULT NULL,
  `service_deleted_by` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_dep_uid` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `service_company_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Gérer tous les services offerts';

--
-- Dumping data for table `agents_services`
--

INSERT INTO `agents_services` (`service_uid`, `service_code`, `service_name`, `service_type`, `service_status`, `service_phone`, `service_email`, `service_responsable`, `service_description`, `service_created_at`, `service_created_by`, `service_updated_at`, `service_updated_by`, `service_deleted_at`, `service_deleted_by`, `service_dep_uid`, `service_company_uid`) VALUES
('202112081638964872FUYlqatpYKfDdkbLZPGcWwMbBMwTIl2ZzKvG0u8uEeifnEEthf', NULL, 'Indiction employées', 'section', 'actif', '84948299348', 'munongo@gmail.com', 'Munongo Benge', 'Apprendre une nouvelle compétence n\'est pas une tâche aisée cependant avec nous, vous y arriverai facilement et plus rapidement possible grâce à notre expertise avec des formateurs expérimentés. Nous vous encourageons de renforcer vos capacités professionnelles par l\'apprentissage de nouvelles technologies de l\'information et de la communication. Découvrez des outils numériques adaptés à votre activité professionnelle. \r\n\r\nNous sommes flexibles en ce qui concerne le timing celà dépend généralement à votre emploi du temps pour suivre nos formations. Plusieurs outils d\'apprentissage sont proposés pour vous !', '2021-12-08 01:01:12', 'Eduschool Enterprise - ', '2022-11-10 16:30:43', 'Élie Mwez Rubuz', NULL, NULL, '202112071638896019e4mBcJWWo4ZwO8COs3JNlz8W1mwoHONoA8locK3RT4DagjAzPk', '250514LD0pJumKPydZySYcp7Mw75PmhhA7yHc0sYpjmLDmcZIahyaMmQ1747228456'),
('202112091639058387rCvBnUelSaAracei4cwTmjaG0QArBRMChKKaQsEEVcVqADCq6J', NULL, 'Nettoyage batiments', 'service', 'actif', '+24385853234', 'manga@yahoo.fr', 'Manga Nyundo', 'Ecrire un article du blog nécessite des compétences en langues et une bonne connaissance en rédaction d\'articles du web.\r\nAujourd\'hui nous vous facilitons la tâche en nous confiant vos projets de rédaction de contenus pour le web sur votre blog à mondre coût. Nos experts en rédaction sont disponibles pour vous apporter leurs expertises en la matière.', '2021-12-09 02:59:47', 'Elie Mwez Rubuz - sysadmin', '2022-11-10 16:29:36', 'Élie Mwez Rubuz', NULL, NULL, '202112021638468212Y7MykZpUpYBhyqtRVDHHM5UzNJucZ8QpyL4JeMCDL4z8GnN2tR', '250514LD0pJumKPydZySYcp7Mw75PmhhA7yHc0sYpjmLDmcZIahyaMmQ1747228456'),
('202202261645863649KeGTHiF6ViCSUMwwRmRhEjAhJHrJWPJDTQBDgAb6e42DozcjYR', NULL, 'Entretien Equipements', 'service', 'actif', '+243858590902', 'kazadi.jeancy@kamoa.com', 'kazadi Jérôme', 'Profiter de nos conseils d\'experts et nos astuces en matière d\'utilisation des outils numériques, la sécurité de matériels et outils, la transformation digitale de votre entreprise, les nouvelles technologies de l\'information et de la communication. Grâce à notre expertise, vous allez pouvoir gagner en temps et en productivité pour vous aider à progresser efficacement.', '2022-02-26 10:20:49', 'Elie Mwez Rubuz - sysadmin', '2022-11-10 16:28:00', 'Élie Mwez Rubuz', NULL, NULL, '202112021638468212Y7MykZpUpYBhyqtRVDHHM5UzNJucZ8QpyL4JeMCDL4z8GnN2tR', '250514LD0pJumKPydZySYcp7Mw75PmhhA7yHc0sYpjmLDmcZIahyaMmQ1747228456'),
('202211111668173831eZ0fTORPqDwV3Fm9FUNvb8JcGE5sUf82RbH6y6038Ejy36RTHc', 'EXM', 'Extraction des minerais', '250514LD0pJumKPydZySYcp7Mw75PmhhA7yHc0sYpjmLDmcZIahyaMmQ1747228456', 'actif', '09788302021', 'ilunga.kas@kamoacopper.com', 'Ilunga Kasongo', '', '2022-11-11 15:37:11', 'M Vivien MUMBA - Super Admin', '2025-05-27 04:01:25', 'Luvungu-chris', NULL, NULL, '250527VhzbqZjiBU65HI4iCwYbUNfkMsAjbyusiDlekCdt4JAjYgMnsU1748357788', '250514LD0pJumKPydZySYcp7Mw75PmhhA7yHc0sYpjmLDmcZIahyaMmQ1747228456'),
('2505279OTg2IE3ncgtFhyRuLbojvjcmCjCM9YzvB3EC3ZFJ8V4m4lTGP1748362232', 'MM', 'Maintenance', '250514LD0pJumKPydZySYcp7Mw75PmhhA7yHc0sYpjmLDmcZIahyaMmQ1747228456', 'actif', NULL, NULL, 'Mwamba kas', 'RAS', '2025-05-27 04:10:32', 'M Vivien MUMBA - Super Admin', NULL, NULL, NULL, NULL, '250527VhzbqZjiBU65HI4iCwYbUNfkMsAjbyusiDlekCdt4JAjYgMnsU1748357788', '250514LD0pJumKPydZySYcp7Mw75PmhhA7yHc0sYpjmLDmcZIahyaMmQ1747228456');

-- --------------------------------------------------------

--
-- Table structure for table `agents_types`
--

CREATE TABLE `agents_types` (
  `category_uid` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_code` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_name` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_cost_day` decimal(20,2) DEFAULT NULL,
  `category_cost_salary` decimal(20,2) DEFAULT NULL,
  `category_cost_transport` decimal(20,2) DEFAULT NULL,
  `category_cost_hospital` decimal(20,2) DEFAULT NULL,
  `category_cost_location` decimal(20,2) DEFAULT NULL,
  `category_cost_exchange` decimal(20,2) DEFAULT NULL,
  `category_currency` varchar(25) DEFAULT NULL,
  `category_tension` int(11) NOT NULL,
  `category_classe` int(11) DEFAULT NULL,
  `category_level` int(11) DEFAULT NULL,
  `category_type` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_hours_working` int(11) DEFAULT NULL,
  `category_number_holidays` int(11) NOT NULL DEFAULT 0,
  `category_number_working` int(11) NOT NULL DEFAULT 0,
  `category_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `category_created_by` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_updated_at` datetime DEFAULT NULL,
  `category_updated_by` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_deleted_at` datetime DEFAULT NULL,
  `category_deleted_by` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_company_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Gérer les categories des articles et des cours';

--
-- Dumping data for table `agents_types`
--

INSERT INTO `agents_types` (`category_uid`, `category_code`, `category_name`, `category_cost_day`, `category_cost_salary`, `category_cost_transport`, `category_cost_hospital`, `category_cost_location`, `category_cost_exchange`, `category_currency`, `category_tension`, `category_classe`, `category_level`, `category_type`, `category_status`, `category_hours_working`, `category_number_holidays`, `category_number_working`, `category_description`, `category_created_at`, `category_created_by`, `category_updated_at`, `category_updated_by`, `category_deleted_at`, `category_deleted_by`, `category_company_uid`) VALUES
('202112091639056030Zy4zUzERrA7QD6DGJ3BZgo2tqYNzZuegqCkoaMYEWUeKAdZZIB', 'AxA', 'Agent Administratif', 10.00, 270.00, 5.00, 0.00, 20.00, 2850.00, 'usd', 366, 2, 1, 'agent', 'actif', 8, 27, 27, '', '2021-12-09 02:20:30', 'Elie Mwez Rubuz - ', '2025-07-26 10:48:40', ' - ', NULL, NULL, '1'),
('202112091639056117oPJwBZZ3JYp9jObUUFKd4Jvc8KimohUnvK7g1lB53IbLtu4WIl', 'DxG', 'Directeurs Generaux', 30.00, 2160.00, 10.00, 0.00, 8.00, 2850.00, 'usd', 1000, 5, 4, 'cadre', 'actif', 8, 72, 20, '', '2021-12-09 02:21:57', 'Elie Mwez Rubuz - ', '2025-07-26 12:48:55', ' - ', NULL, NULL, '1'),
('250527r6e9Ecpqt4F79epVNv0iyfs4CzQRacBKrnO0svBfHydo6Kf8C51748341334', 'STG', 'Stagiaire', 5.00, 135.00, 2.00, 0.00, 0.00, 2850.00, 'usd', 100, 1, 0, 'ouvrier', 'actif', 8, 27, 27, '', '2025-05-27 10:22:14', ' - ', '2025-07-26 10:46:55', ' - ', NULL, NULL, '1'),
('250528QwYZJuF4KzK8vvMtB76ZzbNGKVMvqCtjyhjDp3A0l5CyZpnUjL1748424118', 'TxS', 'Travailleur spécialisé', 4.00, 208.00, 2.00, NULL, 30.00, 2850.00, 'usd', 133, 3, 0, 'cadre', 'actif', 8, 52, 26, 'RAS', '2025-05-28 09:21:58', 'M Vivien MUMBA - Super Admin', '2025-07-26 10:49:04', ' - ', NULL, NULL, '1'),
('250528Tmve7tuP5B7CUar0EudK422YNMMaY3tyvMJq0WW3OzqrduN9gE1748425646', 'TxQ', 'Travailleur Qualifié', 8.00, 288.00, 3.00, NULL, 40.00, 2850.00, 'usd', 237, 4, 2, 'agent', 'actif', 8, 36, 26, '', '2025-05-28 09:47:26', 'M Vivien MUMBA - Super Admin', '2025-07-26 10:49:41', ' - ', NULL, NULL, '1'),
('250621m2WAfz08IEQWpbMb1LO9IB5gpHNSEL2wpI7bYgsOahrRR8Q2hL1750491451', 'CxDEC', 'Consultant', 10.00, 260.00, 3.00, NULL, 0.00, 0.00, 'usd', 120, 2, 3, 'agent', 'actif', 7, 26, 25, '', '2025-06-21 07:37:31', ' - ', '2025-07-26 10:47:33', ' - ', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `category_token` varchar(75) NOT NULL,
  `category_code` varchar(10) NOT NULL,
  `category_name` varchar(75) DEFAULT NULL,
  `category_shortname` varchar(75) DEFAULT NULL,
  `category_status` varchar(25) DEFAULT NULL,
  `category_type` varchar(75) DEFAULT NULL,
  `category_notes` text DEFAULT NULL,
  `category_created_at` datetime DEFAULT NULL,
  `category_updated_at` datetime DEFAULT NULL,
  `category_deleted_at` datetime DEFAULT NULL,
  `category_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classe_id` int(11) UNSIGNED NOT NULL,
  `classe_token` varchar(75) NOT NULL,
  `classe_code` varchar(10) NOT NULL,
  `classe_name` varchar(75) DEFAULT NULL,
  `classe_shortname` varchar(75) DEFAULT NULL,
  `classe_subname` varchar(75) DEFAULT NULL,
  `classe_total_places` int(10) DEFAULT NULL,
  `classe_status` varchar(25) DEFAULT NULL,
  `classe_type` varchar(75) DEFAULT NULL,
  `classe_notes` text DEFAULT NULL,
  `classe_created_at` datetime DEFAULT NULL,
  `classe_updated_at` datetime DEFAULT NULL,
  `classe_deleted_at` datetime DEFAULT NULL,
  `classe_school_id` int(11) UNSIGNED DEFAULT NULL,
  `classe_option_id` int(11) UNSIGNED DEFAULT NULL,
  `classe_degree_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classe_id`, `classe_token`, `classe_code`, `classe_name`, `classe_shortname`, `classe_subname`, `classe_total_places`, `classe_status`, `classe_type`, `classe_notes`, `classe_created_at`, `classe_updated_at`, `classe_deleted_at`, `classe_school_id`, `classe_option_id`, `classe_degree_id`) VALUES
(1, '240722hwN4MU8KeM0l8wPwM7S1Uvwe1PhuMII16GSZda8DQOlNDfO2iN1721656426', '241940', '1-1-A', '1ere a mat', 'A', 30, 'actif', 'general', '', '2024-07-22 13:53:46', NULL, NULL, 1, 1, 1),
(2, '2407220lcKcSAMfm9FsItIrjfB75VGj5DAkGVUPyokKS5DMLaNF0zT831721656447', '242480', '1-1-', '1ere mat', NULL, 30, 'actif', 'general', '', '2024-07-22 13:54:07', '2024-07-26 14:24:35', NULL, 1, 1, 1),
(3, '24072268Drwct2zW91bYs3S4cJlqIjmUrk59IMMLHdpd2SwCFTmWNfVU1721656685', '240162', '1-1-B', '1ere B mat', 'B', 45, 'actif', 'general', '', '2024-07-22 13:58:05', '2024-10-30 14:45:25', NULL, 1, 1, 1),
(4, '2407265d2GngfssibjfKyT1o2mrwddBJd9b47tLTfWvf0rZSk9FNWpst1722008380', '242436', '2-2-A', '2eme Prim', 'A', 25, 'actif', 'general', 'Classe de recrutement', '2024-07-26 15:39:40', NULL, NULL, 1, 2, 2),
(5, '24100447ZqGkhaJgFRWpTYDH9rFS8kBiOWwVZiQdLzn9VaPDdReJ5UzY1728030408', '247894', '3-4-A', '3eme delete', 'A', 12, 'actif', 'general', '', '2024-10-04 10:26:48', NULL, NULL, 1, 4, 3),
(7, '241115voJNbyPVPDNwn7lU2g0TQ2uYF9NmC6B8zLTJWSaEmfERGkDc561731668457', '241325', '1-2-', '1ERE PRIM', NULL, 100, 'actif', 'general', '', '2024-11-15 13:00:57', NULL, NULL, 1, 2, 1),
(8, '241115nz4doV5JOimUS3D1rCtmINUykiVdB0OhYjG2Gk3r5vc7Sg3D6Y1731668478', '246076', '3-2-', '3EME PRIM', NULL, 100, 'actif', 'general', '', '2024-11-15 13:01:18', NULL, NULL, 1, 2, 3),
(9, '250225dPaBckBCuYBHTfZ2e64qKB7NKQCKyrEVieQ1Hu8ZVqAD3np35d1740495770', '252164', '6-6-', '1ere MAT', NULL, 15, 'actif', 'general', '', '2025-02-25 17:02:50', NULL, NULL, 9, 6, 6),
(10, '2506095hti7qDG8Q8HLDaYJ11ikwI27gLr1tKICm9iSBB2EBshPNvC3L1749469132', '257287', '7-7-', '4eme PEDA', NULL, 25, 'actif', 'general', '', '2025-06-09 13:38:52', NULL, NULL, 1, 7, 7),
(11, '250916soWRIMJ3VaBrDiKvj4A8S2p1I7SIqHaMbO1VgaZ74u5H5nrhoz1758033412', '256570', '8-8-', '1ERE SCIENCE', NULL, 50, 'actif', 'general', '', '2025-09-16 16:36:52', NULL, NULL, 10, 8, 8),
(12, '251009Jy5MDdBqlH9avuEyqlKqaWeQ1jnEY0Vh9pluGKCQVNWmL4Pc3j1760016531', '253757', '9-9-', '1ERE SCIENCE', NULL, 25, 'actif', 'general', '', '2025-10-09 15:28:51', NULL, NULL, 4, 9, 9);

-- --------------------------------------------------------

--
-- Table structure for table `classes_degrees`
--

CREATE TABLE `classes_degrees` (
  `degree_id` int(11) UNSIGNED NOT NULL,
  `degree_token` varchar(75) NOT NULL,
  `degree_code` varchar(10) NOT NULL,
  `degree_name` varchar(75) DEFAULT NULL,
  `degree_shortname` varchar(75) DEFAULT NULL,
  `degree_status` varchar(25) DEFAULT NULL,
  `degree_type` varchar(75) DEFAULT NULL,
  `degree_notes` text DEFAULT NULL,
  `degree_created_at` datetime DEFAULT NULL,
  `degree_updated_at` datetime DEFAULT NULL,
  `degree_deleted_at` datetime DEFAULT NULL,
  `degree_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes_degrees`
--

INSERT INTO `classes_degrees` (`degree_id`, `degree_token`, `degree_code`, `degree_name`, `degree_shortname`, `degree_status`, `degree_type`, `degree_notes`, `degree_created_at`, `degree_updated_at`, `degree_deleted_at`, `degree_school_id`) VALUES
(1, '240722vCa62sPNDprkFUQOJbOocgya6ACrrtW558KCeK6ZaKg2BvYH4r1721656149', '1', 'Premiere', '1ere', 'actif', NULL, NULL, '2024-07-22 13:49:09', '2024-07-26 14:27:46', NULL, 1),
(2, '240726CNTRge0OPRgRq3rAbAfM5ZzD6hvfmqv0Ny3KIuVsITHCgMgpfF1722003978', '2', 'deuxieme', '2eme', 'actif', NULL, NULL, '2024-07-26 14:26:18', NULL, NULL, 1),
(3, '241004PuH0PG1MQYWGizPW1VHEZ1ldkLv910fwLlL55hkKH0YMLJNdf91728030378', '3', 'Troisieme', '3eme', 'actif', NULL, NULL, '2024-10-04 10:26:18', NULL, NULL, 1),
(6, '250225gyTp48hOTciwHtZHPquGvGL3K3r4c51iTDpKMRlnWytjJl7sEP1740495323', '1', 'Premier', '1er', 'actif', NULL, NULL, '2025-02-25 16:55:23', NULL, NULL, 9),
(7, '250609ZCu884YcMhsn5uJiUrDnZD25AFv91yaDp5VzP97p0JJlKh08Up1749469110', '4', 'quatrieme ', '4eme', 'actif', NULL, NULL, '2025-06-09 13:38:30', NULL, NULL, 1),
(8, '250916Aum4qUQuHiQSQVacEjObCboqiRe7QvWlHewntdBVHvkBZkbLg21758033358', '1', 'PREMIER', '1ER', 'actif', NULL, NULL, '2025-09-16 16:35:58', NULL, NULL, 10),
(9, '251009G4e43kHi2I6u4if4Gz3mSHpR2nP0myJGLlDaMr0Mcm55R5DVtZ1760016491', '1', '1ER', 'PREMIER', 'actif', NULL, NULL, '2025-10-09 15:28:11', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `classes_options`
--

CREATE TABLE `classes_options` (
  `option_id` int(11) UNSIGNED NOT NULL,
  `option_token` varchar(75) NOT NULL,
  `option_code` varchar(10) NOT NULL,
  `option_name` varchar(75) DEFAULT NULL,
  `option_shortname` varchar(75) DEFAULT NULL,
  `option_status` varchar(25) DEFAULT NULL,
  `option_type` varchar(75) DEFAULT NULL,
  `option_notes` text DEFAULT NULL,
  `option_created_at` datetime DEFAULT NULL,
  `option_updated_at` datetime DEFAULT NULL,
  `option_deleted_at` datetime DEFAULT NULL,
  `option_section_id` int(11) UNSIGNED DEFAULT NULL,
  `option_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes_options`
--

INSERT INTO `classes_options` (`option_id`, `option_token`, `option_code`, `option_name`, `option_shortname`, `option_status`, `option_type`, `option_notes`, `option_created_at`, `option_updated_at`, `option_deleted_at`, `option_section_id`, `option_school_id`) VALUES
(1, '240722GvpDnvfK3N1ar3TiroKm9E1wr9wEnUTlVSO8ziSkckhhK70eHN1721655929', 'COMPTA', 'comptabilite', NULL, 'actif', NULL, NULL, '2024-07-22 13:45:29', '2025-11-30 11:26:01', NULL, 1, 1),
(2, '240722QbYYgK1PkKyF65iIuDNbZcEEK3ZPU0dV9Bh8QpzNqGq1IeCh2M1721655938', 'CSI', 'Conception des systemes d\'information', NULL, 'actif', NULL, NULL, '2024-07-22 13:45:38', '2025-11-30 11:28:07', NULL, 2, 1),
(3, '241004SdWZ0EpYQwR3sjtUVBBRHwcJWTh67CmhpE51uqTqP9NTq1vfyN1728029520', '240553', 'Creche', NULL, 'actif', NULL, NULL, '2024-10-04 10:12:00', NULL, NULL, 4, 1),
(4, '241004CViiftqRHg6Jpu9edtocDJsW3SJBnmvTfsPja8VgU8NSOZtk2W1728030339', '240083', 'Option delete', NULL, 'actif', NULL, NULL, '2024-10-04 10:25:39', NULL, NULL, 5, 1),
(6, '250225GAayYbv8pTFgwjVmD23bctR756Mv15r8iAle7O8OwhWy79ugyl1740495229', '255456', 'Maternelle', NULL, 'actif', NULL, NULL, '2025-02-25 16:53:49', NULL, NULL, 6, 9),
(7, '250609JyhlgLL5njzpWgcDCl7smGFfj955LwJCLqkUGr8OjGcawiqt1n1749469080', 'DREP', 'Droit economique & prive', NULL, 'actif', NULL, NULL, '2025-06-09 13:38:00', '2025-11-30 11:26:42', NULL, 3, 1),
(8, '2509163aDR2CC6dCsdjB2tiJiuTS8ch3mEiEMUwf13ACs174KFhTCuec1758033336', '253807', 'SCIENCES', NULL, 'actif', NULL, NULL, '2025-09-16 16:35:36', NULL, NULL, 8, 10),
(9, '2510098ueDS0qmsF73tSuybV2jOgKHThqjsSTj7HOPSn2b58jASK0Zbi1760016474', '255163', 'SCIENCES', NULL, 'actif', NULL, NULL, '2025-10-09 15:27:54', NULL, NULL, 9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `classes_teachers`
--

CREATE TABLE `classes_teachers` (
  `classeteacher_id` int(11) UNSIGNED NOT NULL,
  `classeteacher_token` varchar(75) NOT NULL,
  `classeteacher_code` varchar(10) NOT NULL,
  `classeteacher_status` varchar(25) DEFAULT NULL,
  `classeteacher_type` varchar(75) DEFAULT NULL,
  `classeteacher_notes` text DEFAULT NULL,
  `classeteacher_created_at` datetime DEFAULT NULL,
  `classeteacher_updated_at` datetime DEFAULT NULL,
  `classeteacher_deleted_at` datetime DEFAULT NULL,
  `classeteacher_teacher_id` int(11) UNSIGNED DEFAULT NULL,
  `classeteacher_classe_id` int(11) UNSIGNED DEFAULT NULL,
  `classeteacher_year_id` int(11) DEFAULT NULL,
  `classeteacher_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes_teachers`
--

INSERT INTO `classes_teachers` (`classeteacher_id`, `classeteacher_token`, `classeteacher_code`, `classeteacher_status`, `classeteacher_type`, `classeteacher_notes`, `classeteacher_created_at`, `classeteacher_updated_at`, `classeteacher_deleted_at`, `classeteacher_teacher_id`, `classeteacher_classe_id`, `classeteacher_year_id`, `classeteacher_school_id`) VALUES
(1, '250606ZW9MHbw8yNiG8UeD2Bfc92tzRsAQaT2flerHpqsTIzZuZVYj2q1749214989', '252149', 'actif', NULL, '', '2025-06-06 15:03:09', NULL, NULL, 4, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(10) UNSIGNED NOT NULL,
  `contact_token` varchar(75) DEFAULT NULL,
  `contact_code` varchar(10) DEFAULT NULL,
  `contact_name` varchar(75) DEFAULT NULL,
  `contact_title` varchar(75) DEFAULT NULL,
  `contact_status` varchar(25) DEFAULT NULL,
  `contact_type` varchar(25) DEFAULT NULL,
  `contact_category` varchar(25) DEFAULT NULL,
  `contact_phone` varchar(75) DEFAULT NULL,
  `contact_email` varchar(75) DEFAULT NULL,
  `contact_notes` text DEFAULT NULL,
  `contact_address` varchar(100) DEFAULT NULL,
  `contact_created_at` datetime DEFAULT NULL,
  `contact_updated_at` datetime DEFAULT NULL,
  `contact_deleted_at` datetime DEFAULT NULL,
  `contact_school_id` int(11) UNSIGNED DEFAULT NULL,
  `contact_section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `contact_token`, `contact_code`, `contact_name`, `contact_title`, `contact_status`, `contact_type`, `contact_category`, `contact_phone`, `contact_email`, `contact_notes`, `contact_address`, `contact_created_at`, `contact_updated_at`, `contact_deleted_at`, `contact_school_id`, `contact_section_id`) VALUES
(209, '241031L4fz8Y33zt5nm0aph4rzfZwMbGRKzzH5qUMyV074v0NOEILPH31730387093', '245563', 'elie mwez', 'Developpeur', 'actif', NULL, NULL, '+243858533285', 'rubuz@ditotase.com', NULL, 'Lubumbashi', '2024-10-31 17:04:53', '2024-10-31 17:29:05', NULL, 1, 2),
(210, '241031ojW8jBuGe4DPNUwmQ3YkDAu3OD5ikrLsffiAH6icLHTPGqlqU91730387937', '242080', 'trecaz holding', 'agence digitale', 'actif', NULL, NULL, '+243977090011', 'contact@ditotase.com', NULL, '41, Mwepu, Bel-Air, Lubumbashi, RDC', '2024-10-31 17:18:57', '2024-10-31 17:24:39', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `contract_id` int(11) UNSIGNED NOT NULL,
  `contract_token` varchar(75) NOT NULL,
  `contract_code` varchar(10) NOT NULL,
  `contract_status` varchar(25) DEFAULT NULL,
  `contract_type` varchar(75) DEFAULT NULL,
  `contract_started_at` date DEFAULT NULL,
  `contract_closed_at` date DEFAULT NULL,
  `contract_salary_amount` decimal(10,2) DEFAULT NULL,
  `contract_transport_amount` decimal(10,2) DEFAULT NULL,
  `contract_housing_amount` decimal(10,2) DEFAULT NULL,
  `contract_family_allow_amount` decimal(10,2) DEFAULT NULL,
  `contract_fees_worker_amount` decimal(10,2) DEFAULT NULL,
  `contract_fees_employer_amount` decimal(10,2) DEFAULT NULL,
  `contract_taxes_worker_amount` decimal(10,2) DEFAULT NULL,
  `contract_training_worker_amount` decimal(10,2) DEFAULT NULL,
  `contract_training_employer_amount` decimal(10,2) DEFAULT NULL,
  `contract_taxes_jobs_amount` decimal(10,2) DEFAULT NULL,
  `contract_salary_type` enum('hourly','daily','weekly','monthly','yearly') NOT NULL DEFAULT 'daily',
  `contract_notes` text DEFAULT NULL,
  `contract_created_at` datetime DEFAULT NULL,
  `contract_updated_at` datetime DEFAULT NULL,
  `contract_deleted_at` datetime DEFAULT NULL,
  `contract_doc_resume` varchar(75) DEFAULT NULL,
  `contract_doc_letter` varchar(75) DEFAULT NULL,
  `contract_doc_identity` varchar(75) DEFAULT NULL,
  `contract_doc_education` varchar(75) DEFAULT NULL,
  `contract_employee_id` int(11) UNSIGNED DEFAULT NULL,
  `contract_category_id` int(11) UNSIGNED DEFAULT NULL,
  `contract_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) UNSIGNED NOT NULL,
  `course_token` varchar(75) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(75) DEFAULT NULL,
  `course_shortname` varchar(75) DEFAULT NULL,
  `course_status` varchar(25) DEFAULT NULL,
  `course_type` varchar(75) DEFAULT NULL,
  `course_notes` text DEFAULT NULL,
  `course_created_at` datetime DEFAULT NULL,
  `course_updated_at` datetime DEFAULT NULL,
  `course_deleted_at` datetime DEFAULT NULL,
  `course_branch_id` int(11) UNSIGNED DEFAULT NULL,
  `course_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_token`, `course_code`, `course_name`, `course_shortname`, `course_status`, `course_type`, `course_notes`, `course_created_at`, `course_updated_at`, `course_deleted_at`, `course_branch_id`, `course_school_id`) VALUES
(1, '250604mTsKr390mhZQi9Z4oRPrKtsKgl3neyWPjOKSsGwkwBPDrN2FN21749048059', '257705', 'Algebre', 'ALG', 'actif', 'beginner', 'ras', '2025-06-04 16:40:59', '2025-06-06 10:01:41', NULL, 1, 1),
(2, '250612wHGbqC9N3kWFR7szt7zFRF2VeB36LSvw1ZfgvKPy82hDpKq6fC1749730505', '254713', 'Problemes', 'PBM', 'actif', 'beginner', 'RAS', '2025-06-12 14:15:05', NULL, NULL, 1, 1),
(3, '2506128mQddM0nk7mvhyJ2Aqkd0KnEaUbShK5178elIBRD8TZmc7c79F1749730586', '252516', 'Geographie', 'GEO', 'actif', 'beginner', '', '2025-06-12 14:16:26', '2025-06-12 16:05:07', NULL, 4, 1),
(4, '250612GYBajsqpKFslGsEFFOnoUhqyyLzNuBFzgsOi6fWba76jlahtYQ1749736590', '254565', 'Histoire', 'HIST', 'actif', 'beginner', '', '2025-06-12 15:56:30', NULL, NULL, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_branchs`
--

CREATE TABLE `courses_branchs` (
  `branch_id` int(11) UNSIGNED NOT NULL,
  `branch_token` varchar(75) NOT NULL,
  `branch_code` varchar(10) NOT NULL,
  `branch_name` varchar(75) DEFAULT NULL,
  `branch_shortname` varchar(75) DEFAULT NULL,
  `branch_status` varchar(25) DEFAULT NULL,
  `branch_type` varchar(75) DEFAULT NULL,
  `branch_notes` text DEFAULT NULL,
  `branch_created_at` datetime DEFAULT NULL,
  `branch_updated_at` datetime DEFAULT NULL,
  `branch_deleted_at` datetime DEFAULT NULL,
  `branch_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses_branchs`
--

INSERT INTO `courses_branchs` (`branch_id`, `branch_token`, `branch_code`, `branch_name`, `branch_shortname`, `branch_status`, `branch_type`, `branch_notes`, `branch_created_at`, `branch_updated_at`, `branch_deleted_at`, `branch_school_id`) VALUES
(1, '250604HYICqnnG5KmNrhH3OvjTG9Z8arMVgdk3sGsKjfL2PCO3NGe67U1749044193', '257915', 'Mathematique', 'MATH', 'actif', 'scientifique', 'RAS', '2025-06-04 15:36:33', '2025-06-04 15:49:48', NULL, 1),
(3, '250604VeJPoj5028yLRgSnotu5PObWSyOMSQSNZm1oGjDwBUVYjcnrLd1749045198', '254507', 'Sciences', 'SCS', 'actif', 'scientifique', '', '2025-06-04 15:53:18', '2025-06-12 16:05:45', NULL, 1),
(4, '250612sYvbpWLEeHegFKHbo4ZQSV0lqlhnByvfPRTV2uUgUL6Zlia5FG1749736574', '256540', 'Litterature', 'LITT', 'actif', 'general', '', '2025-06-12 15:56:14', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_classedayhours`
--

CREATE TABLE `courses_classedayhours` (
  `dayhourclasse_id` int(11) UNSIGNED NOT NULL,
  `dayhourclasse_token` varchar(75) NOT NULL,
  `dayhourclasse_code` varchar(10) NOT NULL,
  `dayhourclasse_status` varchar(25) DEFAULT NULL,
  `dayhourclasse_type` varchar(75) DEFAULT NULL,
  `dayhourclasse_notes` text DEFAULT NULL,
  `dayhourclasse_created_at` datetime DEFAULT NULL,
  `dayhourclasse_updated_at` datetime DEFAULT NULL,
  `dayhourclasse_deleted_at` datetime DEFAULT NULL,
  `dayhourclasse_classe_id` int(11) UNSIGNED DEFAULT NULL,
  `dayhourclasse_workdayhour_id` int(11) UNSIGNED DEFAULT NULL,
  `dayhourclasse_course_id` int(11) UNSIGNED DEFAULT NULL,
  `dayhourclasse_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses_classes`
--

CREATE TABLE `courses_classes` (
  `courseclasse_id` int(11) UNSIGNED NOT NULL,
  `courseclasse_token` varchar(75) NOT NULL,
  `courseclasse_code` varchar(10) NOT NULL,
  `courseclasse_weekhours` int(11) DEFAULT NULL,
  `courseclasse_period_point` decimal(10,2) DEFAULT NULL,
  `courseclasse_maxima_id` int(75) DEFAULT NULL,
  `courseclasse_slip_place` int(11) DEFAULT NULL,
  `courseclasse_is_mandatory` varchar(75) DEFAULT NULL,
  `courseclasse_status` varchar(25) DEFAULT NULL,
  `courseclasse_type` varchar(75) DEFAULT NULL,
  `courseclasse_notes` text DEFAULT NULL,
  `courseclasse_created_at` datetime DEFAULT NULL,
  `courseclasse_updated_at` datetime DEFAULT NULL,
  `courseclasse_deleted_at` datetime DEFAULT NULL,
  `courseclasse_course_id` int(11) UNSIGNED DEFAULT NULL,
  `courseclasse_teacher_id` int(11) UNSIGNED DEFAULT NULL,
  `courseclasse_classe_id` int(11) UNSIGNED DEFAULT NULL,
  `courseclasse_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses_classes`
--

INSERT INTO `courses_classes` (`courseclasse_id`, `courseclasse_token`, `courseclasse_code`, `courseclasse_weekhours`, `courseclasse_period_point`, `courseclasse_maxima_id`, `courseclasse_slip_place`, `courseclasse_is_mandatory`, `courseclasse_status`, `courseclasse_type`, `courseclasse_notes`, `courseclasse_created_at`, `courseclasse_updated_at`, `courseclasse_deleted_at`, `courseclasse_course_id`, `courseclasse_teacher_id`, `courseclasse_classe_id`, `courseclasse_school_id`) VALUES
(1, '2506068k6Ln0aEP6rSET1ZA82Ks7PsqDiTznb6Nv78Y5o5WlUGWLSL7v1749209647', '253721', 12, 4.00, 2506164, 1, 'oui', 'actif', NULL, 'RAS', '2025-06-06 13:34:07', '2025-06-17 16:25:09', NULL, 1, 4, 7, 1),
(2, '250606WhzQbkqPmOwCp6ezhsMn6yM1dnmdzPC8b9rWPUUnvoZ91jbzd21749211386', '258425', 16, 4.00, 2, 2, 'oui', 'actif', NULL, 'RAS', '2025-06-06 14:03:06', '2025-06-16 16:02:24', NULL, 1, 1, 2, 1),
(5, '250612ZFjzrAnaH8kZMBJjFbyDvJPgr04ZpBdPsEh1P49ugYhPMbFG1h1749730633', '250387', 8, 4.00, 2, 3, 'oui', 'actif', NULL, '', '2025-06-12 14:17:13', '2025-06-16 16:02:30', NULL, 3, NULL, 2, 1),
(7, '250612ubmSjiqq92fbiepst7LlhtGDch2WT9gD6bS5FuqIc9sq4Vp0d01749736619', '254980', 18, 2.00, 2, 1, 'oui', 'actif', NULL, '', '2025-06-12 15:56:59', '2025-06-16 17:41:24', NULL, 4, NULL, 2, 1),
(8, '250616wYeDQ0e9gJJ1ENFs7NarT8bgIQ28zF0pJJ7opjYEnGHpySsiQz1750063326', '252857', 4, 2.00, 2506162, 1, 'oui', 'actif', NULL, '', '2025-06-16 10:42:06', '2025-06-17 16:21:05', NULL, 3, NULL, 7, 1),
(11, '250616Jk2HpWE0QPPbAjs3EFg3nJS2tW8KVsi1cvgCMPR4kY4qTzBt5M1750078177', '258063', 40, 2.00, 1, 3, 'oui', 'actif', NULL, '', '2025-06-16 14:49:37', NULL, NULL, 3, NULL, 10, 1),
(12, '250616VJdcOKUDcNgfJdQP28q8QFgcIupwfJnmCiFzUkYNO84TZSMnI71750080182', '257225', 40, 2.00, 1, 1, 'oui', 'actif', NULL, '', '2025-06-16 15:23:02', NULL, NULL, 4, NULL, 10, 1),
(13, '250616OdrznHCaD0OrzsTq9O2tzTHlZcrMbmiJpAEmwZ5GppSfdVSl0c1750080246', '253410', 80, 4.00, 250616, 1, 'oui', 'actif', NULL, '', '2025-06-16 15:24:06', '2025-06-16 16:01:23', NULL, 2, NULL, 10, 1),
(14, '250616hVeZBdIwSyEiEN4oBdlllfvsZfI8T0wiofoRW5rhu51WfBtErj1750080289', '255650', 80, 4.00, 250616, 1, 'oui', 'actif', NULL, '', '2025-06-16 15:24:49', '2025-06-16 16:00:22', NULL, 1, NULL, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_maximas`
--

CREATE TABLE `courses_maximas` (
  `maxima_id` int(11) NOT NULL,
  `maxima_token` varchar(75) NOT NULL,
  `maxima_code` varchar(10) NOT NULL,
  `maxima_name` varchar(75) DEFAULT NULL,
  `maxima_total_exam` decimal(10,2) DEFAULT NULL,
  `maxima_total_period` decimal(10,2) DEFAULT NULL,
  `maxima_status` varchar(25) DEFAULT NULL,
  `maxima_notes` text DEFAULT NULL,
  `maxima_created_at` datetime DEFAULT NULL,
  `maxima_updated_at` datetime DEFAULT NULL,
  `maxima_deleted_at` datetime DEFAULT NULL,
  `maxima_section_id` int(11) DEFAULT NULL,
  `maxima_school_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses_maximas`
--

INSERT INTO `courses_maximas` (`maxima_id`, `maxima_token`, `maxima_code`, `maxima_name`, `maxima_total_exam`, `maxima_total_period`, `maxima_status`, `maxima_notes`, `maxima_created_at`, `maxima_updated_at`, `maxima_deleted_at`, `maxima_section_id`, `maxima_school_id`) VALUES
(1, '2025JHJAKKJKSKLSL66220', '259490', 'MAXIMA', 40.00, 20.00, 'actif', NULL, '2025-06-16 14:49:37', NULL, NULL, 3, 1),
(2, '2025JHJAKKJKSKLSL662875665HJSHJD6255', '256093', 'GROUPE I', 40.00, 20.00, 'actif', '', '2025-06-16 14:49:12', '2025-06-17 16:19:16', NULL, 1, 1),
(250616, '', '257168', 'MAXIMA', 80.00, 40.00, 'actif', NULL, '2025-06-16 15:24:06', NULL, NULL, 3, 1),
(2506162, '250617MINYpgOTlvQszcghzLUVGEO76eRFM4GAjW06huimlYkps2TWaC1750169935', '253880', 'GROUPE I', 40.00, 20.00, 'actif', '', '2025-06-17 16:18:55', NULL, NULL, 2, 1),
(2506163, '2506171GV4FwI5d4k5s7D1boZOObm04iW2OVEEBP3Vs8u2JuLuMQSLos1750169973', '259082', 'GROUPE II', 60.00, 30.00, 'actif', '', '2025-06-17 16:19:33', NULL, NULL, 2, 1),
(2506164, '250617UhDnVBPh8FDtByABFmw9DJMJfiZm3lw2kiKvCfD9Iofcjc8ksh1750169989', '255602', 'GROUPE III', 80.00, 40.00, 'actif', '', '2025-06-17 16:19:49', NULL, NULL, 2, 1),
(2506165, '250617O8jo8kYYo1LV8kGFfDc8m0Jv4k7saYrq4HogHn9c39vMSCaT2r1750170036', '254562', 'GROUPE II', 80.00, 40.00, 'actif', '', '2025-06-17 16:20:36', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_periods`
--

CREATE TABLE `courses_periods` (
  `period_id` int(11) NOT NULL,
  `period_token` varchar(75) DEFAULT NULL,
  `period_code` varchar(75) DEFAULT NULL,
  `period_name` varchar(50) NOT NULL,
  `period_start_time` time NOT NULL,
  `period_end_time` time NOT NULL,
  `period_status` varchar(75) DEFAULT NULL,
  `period_notes` text DEFAULT NULL,
  `period_created_at` datetime DEFAULT NULL,
  `period_updated_at` datetime DEFAULT NULL,
  `period_deleted_at` datetime DEFAULT NULL,
  `period_year_id` int(11) DEFAULT NULL,
  `period_school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses_schedules`
--

CREATE TABLE `courses_schedules` (
  `schedule_id` int(11) NOT NULL,
  `schedule_token` varchar(75) DEFAULT NULL,
  `schedule_code` varchar(75) DEFAULT NULL,
  `schedule_course_classe_id` int(11) DEFAULT NULL,
  `schedule_teacher_id` int(11) NOT NULL,
  `schedule_course_id` int(11) NOT NULL,
  `schedule_classe_id` int(11) NOT NULL,
  `schedule_day_week` int(11) NOT NULL,
  `schedule_start_time` time NOT NULL,
  `schedule_end_time` time NOT NULL,
  `schedule_status` varchar(75) DEFAULT NULL,
  `schedule_notes` varchar(75) DEFAULT NULL,
  `schedule_created_at` datetime DEFAULT current_timestamp(),
  `schedule_updated_at` datetime DEFAULT NULL,
  `schedule_deleted_at` datetime DEFAULT NULL,
  `schedule_year_id` int(11) NOT NULL,
  `schedule_school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses_schedules`
--

INSERT INTO `courses_schedules` (`schedule_id`, `schedule_token`, `schedule_code`, `schedule_course_classe_id`, `schedule_teacher_id`, `schedule_course_id`, `schedule_classe_id`, `schedule_day_week`, `schedule_start_time`, `schedule_end_time`, `schedule_status`, `schedule_notes`, `schedule_created_at`, `schedule_updated_at`, `schedule_deleted_at`, `schedule_year_id`, `schedule_school_id`) VALUES
(1, '250609YMoH2N8Yh4LOpB5N2NZTVU2GKpnjmdOsh5RpenNk3jKOqN82KI1749460023', '253941', 1, 4, 1, 1, 1, '07:30:00', '08:15:00', 'actif', 'SALLE B', '2025-06-09 11:07:03', NULL, NULL, 2, 1),
(2, '250609tWjV3PAdBPnV8EhtDpMsgswLb7bSmo5vFSszP1lQRYJDZg1T471749460168', '253657', 1, 4, 1, 1, 2, '09:15:00', '10:00:00', 'actif', 'salle C', '2025-06-09 11:09:28', '2025-06-11 12:45:26', NULL, 2, 1),
(4, '250611TNqURJcZV8FPDIUwgBozMRz1FVAKftVQihMB3yR7cfygSKyjND1749641571', '257871', 2, 4, 1, 2, 1, '07:30:00', '08:15:00', 'actif', 'https://ditotase.com/training', '2025-06-11 13:32:51', '2025-08-11 15:33:32', NULL, 2, 1),
(5, '250616f60Ar8MIOFFWLFYsJRCpPwklwEU3KJFBS6JK5T5mGmtA2isQll1750064562', '256993', 8, 4, 3, 7, 1, '09:00:00', '09:45:00', 'actif', 'https://ditotase.com/services', '2025-06-16 11:02:42', '2025-08-11 15:37:30', NULL, 2, 1),
(6, '25061656Lc9TVwsPGtTOsKjOOAtL4TcnW1V7WJbajHFZ6q0qbgJIw34n1750064606', '259003', 8, 4, 3, 7, 3, '09:00:00', '10:00:00', 'actif', 'https://ditotase.com/solutions', '2025-06-16 11:03:26', '2025-08-11 15:37:46', NULL, 2, 1),
(7, '250616OgFoGr9UOdVwvuZ1ZcJt3QigIjKvw3uY6ywgoM00TauJU5rhy91750064871', '258580', 6, 1, 3, 10, 5, '07:30:00', '08:30:00', 'actif', 'salle b', '2025-06-16 11:07:51', NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_students_grades`
--

CREATE TABLE `courses_students_grades` (
  `grade_id` int(11) NOT NULL,
  `grade_token` varchar(75) NOT NULL,
  `grade_code` varchar(25) NOT NULL,
  `grade_total` decimal(5,2) NOT NULL,
  `grade_type` varchar(75) DEFAULT NULL,
  `grade_status` varchar(75) NOT NULL,
  `grade_notes` text DEFAULT NULL,
  `grade_created_at` datetime DEFAULT NULL,
  `grade_updated_at` datetime DEFAULT NULL,
  `grade_deleted_at` datetime DEFAULT NULL,
  `grade_annualperiod_id` int(11) DEFAULT NULL,
  `grade_student_id` int(11) NOT NULL,
  `grade_course_id` int(11) NOT NULL,
  `grade_year_id` int(11) NOT NULL,
  `grade_school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses_students_grades`
--

INSERT INTO `courses_students_grades` (`grade_id`, `grade_token`, `grade_code`, `grade_total`, `grade_type`, `grade_status`, `grade_notes`, `grade_created_at`, `grade_updated_at`, `grade_deleted_at`, `grade_annualperiod_id`, `grade_student_id`, `grade_course_id`, `grade_year_id`, `grade_school_id`) VALUES
(1, '250612QrtVz2hjuQcvaRGo0fnU9cmFd9DK34hssIWaN59d79mlbaUfW41749731495', '258309', 9.00, NULL, 'actif', '', '2025-06-16 17:39:41', '2025-06-16 17:39:41', NULL, 5, 1, 2, 2, 1),
(3, '250612jhysAlMpC8Sby6fBYt1VPJGWDAoivMR2JiFueLHIS5fKf4J5AC1749733265', '256416', 14.00, NULL, 'actif', '', '2025-06-16 17:39:52', '2025-06-16 17:39:52', NULL, 5, 6, 2, 2, 1),
(4, '25061275lB86AwzEyEQvjY92fvHpRphgPObScQRD7TRfLtQY7S5RgWlK1749733276', '253826', 12.00, NULL, 'actif', '', '2025-06-16 17:35:04', '2025-06-16 17:35:04', NULL, 9, 6, 5, 2, 1),
(5, '250612CZ4MFWe8aFUJDujrQan2i1mYDnJc2Aa75PUCJQypMiDMjCceqq1749737021', '253769', 35.00, NULL, 'actif', '', '2025-06-16 17:34:49', '2025-06-16 17:34:49', NULL, 9, 6, 7, 2, 1),
(6, '250616kC0g90rP5BffMDTT67OKt3QzFvUuy5mO8sMRoYotqPS5MLsnqQ1750066148', '257997', 18.00, NULL, 'actif', '', '2025-06-16 12:55:14', '2025-06-16 12:55:14', NULL, 14, 24, 6, 2, 1),
(7, '250616olp5YcMAt3JG7fJEcFuPCENC28DhFuYQNa0P6cOODc4mAlcLW71750066338', '257001', 14.00, NULL, 'actif', '', '2025-06-16 11:41:23', '2025-06-16 11:41:23', NULL, 15, 24, 6, 2, 1),
(8, '250616kmsjJ5iqbZdSqeTB3vgZ3YAy4fCGbhK8kvvtYjnSIWTUuqAzi61750066366', '258093', 20.00, NULL, 'actif', '', '2025-06-16 12:55:38', '2025-06-16 12:55:38', NULL, 16, 24, 6, 2, 1),
(9, '2506162nVSrLf99wl9ObVTw3NL2o3yf2eSSbLhIzGjfLsaYoi5mzPw6Q1750070347', '258107', 15.00, NULL, 'actif', '', '2025-06-16 12:39:07', NULL, NULL, 7, 6, 2, 2, 1),
(10, '250616RH3ftFdUqfT19YNcrFvkuUKjpg8LkI7mh0LZ3fu3UTmr1EZnq91750070356', '257750', 15.00, NULL, 'actif', '', '2025-06-16 12:39:16', NULL, NULL, 9, 6, 2, 2, 1),
(11, '2506163ZUtK6den2bP1pJ00ODimuknglg99TYLDi8BGLgpbbuOFNIyGY1750073266', '251076', 15.00, NULL, 'actif', '', '2025-06-16 13:27:46', NULL, NULL, 14, 24, 9, 2, 1),
(12, '250616AOHOElczq5E54RgYUBfQ7KvKJ1Crg4MRdj8BHDmnIADJHWVW1U1750073280', '258960', 13.00, NULL, 'actif', '', '2025-06-16 13:28:00', NULL, NULL, 15, 24, 9, 2, 1),
(13, '250616avsUTUtld1U4zAqgoWnAcJrECYWJe2qIGDvlimzq0PF2ewWqbV1750073306', '254825', 35.00, NULL, 'actif', '', '2025-06-16 13:29:31', '2025-06-16 13:29:31', NULL, 16, 24, 10, 2, 1),
(14, '250616NjfbF0h2VeqwYHFQBMqJDCt8ef2rhBOJ9jaGbGIasQsm9uP6gN1750073333', '255245', 30.00, NULL, 'actif', '', '2025-06-16 13:28:53', NULL, NULL, 14, 24, 10, 2, 1),
(15, '250616upyOG7BlGiygyM4S8RAF4o9Jy3eoeNbstLbk0ju2SFTeYOEBj61750080364', '253273', 18.00, NULL, 'actif', '', '2025-06-16 15:26:04', NULL, NULL, 14, 24, 11, 2, 1),
(16, '2506169Df2qS0G83PTmhAQvBlfqtSS2BRLCufz8B1wkwQOrmMFKldHWb1750080872', '250246', 15.00, NULL, 'actif', '', '2025-06-16 15:34:32', NULL, NULL, 15, 24, 11, 2, 1),
(17, '250616id2szla5UkBBnOkeLzEZFe0fifMqBV1FNtGFsocWlWe6ShTQ2Y1750080885', '258988', 35.00, NULL, 'actif', '', '2025-06-16 15:34:45', NULL, NULL, 16, 24, 11, 2, 1),
(18, '250616msC2e5kWCffVSANeMnzswhbkVdSALFWHvcADQJwMkbiWFTvlck1750080906', '254152', 12.00, NULL, 'actif', '', '2025-06-16 15:35:06', NULL, NULL, 14, 24, 12, 2, 1),
(19, '250616cwf0rlttsz8YAkw0M8OGoDkbmb6cuMCnq3qeKMvvyUsPeyP4AM1750080930', '251839', 14.00, NULL, 'actif', '', '2025-06-16 15:35:30', NULL, NULL, 15, 24, 12, 2, 1),
(20, '250616AYgoMntyYw216fGFDZSb2PopZk29ICSNRmKg7zKpzQ8dLtTBFU1750080977', '259931', 32.00, NULL, 'actif', 'ras', '2025-06-16 15:38:26', '2025-06-16 15:38:26', NULL, 14, 24, 13, 2, 1),
(21, '250616QOh8ceeroTqim5WGgSFSB3VeebHNEpo8SRKallssa6EK6pqZW01750080994', '259215', 25.00, NULL, 'actif', '', '2025-06-16 15:36:34', NULL, NULL, 15, 24, 13, 2, 1),
(22, '250617q6NaGzuNEIaTSy9LD1OHyWz3ADh1mWk3uNNsEAskqj5879pA3r1750166891', '251481', 20.00, NULL, 'actif', '', '2025-06-17 15:28:11', NULL, NULL, 10, 21, 1, 2, 1),
(23, '250617yV7tHWvZhFRm3kljhO09FyvmZLbcnaLI7NTu5uqFy4bZvhLy4z1750166903', '252364', 18.00, NULL, 'actif', '', '2025-06-17 15:28:23', NULL, NULL, 11, 21, 1, 2, 1),
(24, '250617232nMaram0FdkV6kfhqMgqDR42bSecZIr8NnhmsaapTSu88cID1750166915', '254381', 17.00, NULL, 'actif', '', '2025-06-17 15:28:35', NULL, NULL, 12, 21, 1, 2, 1),
(25, '2506170bshi7DdYMMRJtlFEViye5bOj2HTFP16BFfeS9HMJBLhOPW93g1750166933', '256378', 19.00, NULL, 'actif', '', '2025-06-17 15:28:53', NULL, NULL, 10, 21, 8, 2, 1),
(26, '250617dFzha6qdzEEE8CfI0CQM2OzLyIv1QaQMqT5k13OVLK2jPOZvQ61750166957', '259306', 38.00, NULL, 'actif', '', '2025-06-17 15:29:17', NULL, NULL, 12, 21, 8, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_teachers`
--

CREATE TABLE `courses_teachers` (
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `teacher_token` varchar(75) NOT NULL,
  `teacher_code` varchar(10) NOT NULL,
  `teacher_gender` varchar(75) NOT NULL,
  `teacher_firstname` varchar(75) DEFAULT NULL,
  `teacher_lastname` varchar(75) DEFAULT NULL,
  `teacher_surname` varchar(75) DEFAULT NULL,
  `teacher_speciality` varchar(75) DEFAULT NULL,
  `teacher_born_date` date DEFAULT NULL,
  `teacher_born_place` varchar(75) DEFAULT NULL,
  `teacher_address` varchar(75) DEFAULT NULL,
  `teacher_picture` varchar(95) NOT NULL,
  `teacher_phone` varchar(75) DEFAULT NULL,
  `teacher_email` varchar(75) DEFAULT NULL,
  `teacher_status` varchar(25) DEFAULT NULL,
  `teacher_type` varchar(75) DEFAULT NULL,
  `teacher_notes` text DEFAULT NULL,
  `teacher_created_at` datetime DEFAULT NULL,
  `teacher_updated_at` datetime DEFAULT NULL,
  `teacher_deleted_at` datetime DEFAULT NULL,
  `teacher_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses_teachers`
--

INSERT INTO `courses_teachers` (`teacher_id`, `teacher_token`, `teacher_code`, `teacher_gender`, `teacher_firstname`, `teacher_lastname`, `teacher_surname`, `teacher_speciality`, `teacher_born_date`, `teacher_born_place`, `teacher_address`, `teacher_picture`, `teacher_phone`, `teacher_email`, `teacher_status`, `teacher_type`, `teacher_notes`, `teacher_created_at`, `teacher_updated_at`, `teacher_deleted_at`, `teacher_school_id`) VALUES
(1, '250602b7zLpf3ZnAPkTR1i0RA13vLDI7PGirReUquT11L3Dl8LD28gtn1748869348', '232401', 'masculin', 'Mumba', 'kyankasa', 'vivien', 'informaticien', '1992-12-12', 'KIN', 'KALUBWE', '1749026969_b1ae5bd85469f1364c2c.jpg', '+243997276670', 'vivien.mumba@ditotase.com', 'actif', 'contractuel', '', '2025-06-02 15:02:28', '2025-06-04 10:51:50', NULL, 1),
(4, '2506049HS4dyYWY5k2IiZBydyfFLJpmmKt7Wov1FIftpN7IAHJn6ZYwV1749024210', '232402', 'masculin', 'Mwez', 'Rubuz', 'elie', 'INGENIEUR', '2000-12-12', 'likasi', '15200', '1749024210_427e5228a86452f66866.png', '+243858533285', 'rubuz@ditotase.com', 'actif', 'permanent', 'RAS', '2025-06-04 10:03:30', '2025-06-04 10:21:54', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_teachers_attribution`
--

CREATE TABLE `courses_teachers_attribution` (
  `attribution_id` int(11) UNSIGNED NOT NULL,
  `attribution_token` varchar(75) NOT NULL,
  `attribution_code` varchar(10) NOT NULL,
  `attribution_status` varchar(25) DEFAULT NULL,
  `attribution_type` varchar(75) DEFAULT NULL,
  `attribution_notes` text DEFAULT NULL,
  `attribution_created_at` datetime DEFAULT NULL,
  `attribution_updated_at` datetime DEFAULT NULL,
  `attribution_deleted_at` datetime DEFAULT NULL,
  `attribution_course_id` int(11) UNSIGNED DEFAULT NULL,
  `attribution_teacher_id` int(11) UNSIGNED DEFAULT NULL,
  `attribution_year_id` int(11) NOT NULL,
  `attribution_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses_teachers_attribution`
--

INSERT INTO `courses_teachers_attribution` (`attribution_id`, `attribution_token`, `attribution_code`, `attribution_status`, `attribution_type`, `attribution_notes`, `attribution_created_at`, `attribution_updated_at`, `attribution_deleted_at`, `attribution_course_id`, `attribution_teacher_id`, `attribution_year_id`, `attribution_school_id`) VALUES
(1, '250611zHA59eaVdz5Fgp6ewaa32lklhziaaYvw0MjBMRz5V5UpSqphoZ1749637367', '250051', 'actif', 'Permanent', 'https://ditotase.com/services', '2025-06-11 12:22:47', '2025-08-11 15:18:13', NULL, 2, 4, 2, 1),
(2, '250611vlykPCbRk76EPvheRkRWmbbqd2agAGzUgJcS4umUczoRIks9go1749637815', '257195', 'actif', 'Permanent', 'https://ditotase.com/training', '2025-06-11 12:30:15', '2025-08-11 15:17:59', NULL, 1, 1, 2, 1),
(3, '250616AzU9QuUMwV1aT5gVClAtsTtP10wufUTw9ZNg7CKlFmjrtz5u8O1750063418', '254690', 'actif', 'Permanent', '', '2025-06-16 10:43:38', '2025-06-16 11:07:08', NULL, 6, 1, 2, 1),
(4, '250616NGY8ZgpiIsGvVq8WE8ojJ6hlPlMnpRR2eZi0tsjdAK2g9GPYDY1750063430', '252371', 'actif', 'Temporaire', 'https://ditotase.com/solutions', '2025-06-16 10:43:50', '2025-08-11 15:18:22', NULL, 8, 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_teachers_availability`
--

CREATE TABLE `courses_teachers_availability` (
  `availability_id` int(11) NOT NULL,
  `availability_token` varchar(75) DEFAULT NULL,
  `availability_code` int(11) DEFAULT NULL,
  `availability_teacher_id` int(11) NOT NULL,
  `availability_day_week` int(11) NOT NULL,
  `availability_start_time` time NOT NULL,
  `availability_end_time` time NOT NULL,
  `availability_status` varchar(25) DEFAULT NULL,
  `availability_notes` text DEFAULT NULL,
  `availability_created_at` datetime DEFAULT current_timestamp(),
  `availability_updated_at` datetime DEFAULT NULL,
  `availability_deleted_at` datetime DEFAULT NULL,
  `availability_year_id` int(11) DEFAULT NULL,
  `availability_school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses_teachers_availability`
--

INSERT INTO `courses_teachers_availability` (`availability_id`, `availability_token`, `availability_code`, `availability_teacher_id`, `availability_day_week`, `availability_start_time`, `availability_end_time`, `availability_status`, `availability_notes`, `availability_created_at`, `availability_updated_at`, `availability_deleted_at`, `availability_year_id`, `availability_school_id`) VALUES
(2, '250611tibSmYJqLFDG7ouGpPnVaZyYLgpWfWRURfFV8tBE6rYStBqLMD1749629672', 251959, 4, 1, '08:30:00', '10:30:00', 'actif', 'dispo', '2025-06-11 10:14:32', NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_workdayhours`
--

CREATE TABLE `courses_workdayhours` (
  `workdayhour_id` int(11) UNSIGNED NOT NULL,
  `workdayhour_token` varchar(75) NOT NULL,
  `workdayhour_code` varchar(10) NOT NULL,
  `workdayhour_status` varchar(25) DEFAULT NULL,
  `workdayhour_type` varchar(75) DEFAULT NULL,
  `workdayhour_notes` text DEFAULT NULL,
  `workdayhour_created_at` datetime DEFAULT NULL,
  `workdayhour_updated_at` datetime DEFAULT NULL,
  `workdayhour_deleted_at` datetime DEFAULT NULL,
  `workdayhour_wday_id` int(11) UNSIGNED DEFAULT NULL,
  `workdayhour_whour_id` int(11) UNSIGNED DEFAULT NULL,
  `workdayhour_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses_workdays`
--

CREATE TABLE `courses_workdays` (
  `workday_id` int(11) UNSIGNED NOT NULL,
  `workday_token` varchar(75) NOT NULL,
  `workday_code` varchar(10) NOT NULL,
  `workday_name` varchar(75) DEFAULT NULL,
  `workday_shortname` varchar(75) DEFAULT NULL,
  `workday_status` varchar(25) DEFAULT NULL,
  `workday_type` varchar(75) DEFAULT NULL,
  `workday_notes` text DEFAULT NULL,
  `workday_created_at` datetime DEFAULT NULL,
  `workday_updated_at` datetime DEFAULT NULL,
  `workday_deleted_at` datetime DEFAULT NULL,
  `workday_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses_workhours`
--

CREATE TABLE `courses_workhours` (
  `workhour_id` int(11) UNSIGNED NOT NULL,
  `workhour_token` varchar(75) NOT NULL,
  `workhour_code` varchar(10) NOT NULL,
  `workhour_name` varchar(75) DEFAULT NULL,
  `workhour_beach` varchar(75) DEFAULT NULL,
  `workhour_status` varchar(25) DEFAULT NULL,
  `workhour_type` varchar(75) DEFAULT NULL,
  `workhour_notes` text DEFAULT NULL,
  `workhour_created_at` datetime DEFAULT NULL,
  `workhour_updated_at` datetime DEFAULT NULL,
  `workhour_deleted_at` datetime DEFAULT NULL,
  `workhour_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) UNSIGNED NOT NULL,
  `customer_token` varchar(75) NOT NULL,
  `customer_code` varchar(10) NOT NULL,
  `customer_name` varchar(75) DEFAULT NULL,
  `customer_firstname` varchar(75) NOT NULL,
  `customer_lastname` varchar(75) NOT NULL,
  `customer_phone` varchar(15) DEFAULT NULL,
  `customer_email` varchar(75) DEFAULT NULL,
  `customer_address` varchar(75) DEFAULT NULL,
  `customer_city` varchar(50) DEFAULT NULL,
  `customer_province` varchar(50) DEFAULT NULL,
  `customer_country` varchar(50) DEFAULT NULL,
  `customer_category` varchar(75) NOT NULL,
  `customer_status` varchar(25) DEFAULT NULL,
  `customer_type` varchar(75) DEFAULT NULL,
  `customer_notes` text DEFAULT NULL,
  `customer_created_at` datetime DEFAULT NULL,
  `customer_updated_at` datetime DEFAULT NULL,
  `customer_deleted_at` datetime DEFAULT NULL,
  `customer_password` varchar(75) DEFAULT NULL,
  `customer_double_auth` varchar(75) DEFAULT NULL,
  `customer_oauth_login` varchar(75) DEFAULT NULL,
  `customer_oauth_provider` varchar(75) DEFAULT NULL,
  `customer_session_status` varchar(75) DEFAULT NULL,
  `customer_session_count` int(11) DEFAULT NULL,
  `customer_gender` varchar(75) DEFAULT NULL,
  `customer_language` varchar(75) DEFAULT NULL,
  `customer_trying_login` int(11) DEFAULT NULL,
  `customer_password_expire` int(11) DEFAULT NULL,
  `customer_old_password` varchar(75) DEFAULT NULL,
  `customer_picture` varchar(75) DEFAULT NULL,
  `customer_avatar` varchar(75) DEFAULT NULL,
  `customer_lastlogin_at` datetime DEFAULT NULL,
  `customer_lastlogout_at` datetime DEFAULT NULL,
  `customer_changepass_at` datetime DEFAULT NULL,
  `customer_resetpass_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_token`, `customer_code`, `customer_name`, `customer_firstname`, `customer_lastname`, `customer_phone`, `customer_email`, `customer_address`, `customer_city`, `customer_province`, `customer_country`, `customer_category`, `customer_status`, `customer_type`, `customer_notes`, `customer_created_at`, `customer_updated_at`, `customer_deleted_at`, `customer_password`, `customer_double_auth`, `customer_oauth_login`, `customer_oauth_provider`, `customer_session_status`, `customer_session_count`, `customer_gender`, `customer_language`, `customer_trying_login`, `customer_password_expire`, `customer_old_password`, `customer_picture`, `customer_avatar`, `customer_lastlogin_at`, `customer_lastlogout_at`, `customer_changepass_at`, `customer_resetpass_at`) VALUES
(1, '240722MD2P89Vh8o4RIBE90p0Y1AyqO7qe4iSThkCzpTlrqjPPA0ZSrU1721648221', '246523', 'elie mwez rubuz', 'Rubuz', 'RBZ', '+243858533285', 'rubuz@ditotase.com', '43 Avenue Mwepu, Lubumbashi, Haut-Katanga, RDC', 'LUBUMBASHI', 'HAUT-KATANGA', 'RDC', 'company', 'blocked', 'mixte', 'NOus sommes une coordination basee en RDC', '2024-07-22 11:37:01', '2024-09-20 12:52:05', NULL, '$2y$10$AdUlPVuURRC0ebBxRL/1jO/9iJVdqHHew.2wU/vQnYCuF2NW4PTxW', NULL, NULL, NULL, NULL, NULL, 'coordination', 'en', 0, 0, '$2y$10$vXfO3EeJfluFQY4rSWfkyO3Z.vQjXltvEtiiomlCIBvu5ioEHauLy', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '240918Z1hshYjKnFG76vc3ZfHQnlucvmG04t5AOzbVqgunEdMhLm8Pmg1726670794', '242964', 'Preegana Rubuz', '', '', '+243990085024', 'trecaz@ditotase.com', '11220, Trecaz City, Trecaz Way, Kolwezi, Lualaba, RDC', 'Kolwezi', NULL, NULL, 'enterprise', 'actif', 'company', 'Établissement Internationnal de formation en nouvelles technologies de l\'information et de la communication', '2024-09-18 14:46:34', NULL, NULL, '$2y$10$MSYYgSTvH4tOTrorlIlh9eY/F.o3lZ.vufWiC6uA7uVPK7EZnWdxW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, '$2y$10$bgVQfLuMCkAwKBXLrpONOOvjqs3hui4RribfUsDxpdFl4NXINOqwS', NULL, NULL, NULL, NULL, NULL, NULL),
(7, '240918g69DjIpZ0MIjrhAQq778qFrvosQ7zyekg34g6nBqkPOA5LDFch1726671345', '248354', 'Preegana Rubuz', 'Preegana', 'Rubuz', '+243821733330', 'ditotase@gmail.com', '11220, Trecaz City, Trecaz Way, Kolwezi, Lualaba, RDC', 'Kolwezi', NULL, NULL, 'enterprise', 'actif', 'company', 'Établissement Internationnal de formation en nouvelles technologies de l\'information et de la communication', '2024-09-18 14:55:45', NULL, NULL, '$2y$10$KsAI8LIDZ29v.Yujj5a5lO1txpDC.npWnG/kHTc3IoWVK4Ao7iymG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '250225nju5KrvAcrJbZgvs0YlAWngHPFc2VK5agkNQOQlHYvuoTuR4Sa1740494849', '258924', 'Preefina Rubuz', 'Preefina Rubuz', '', '+243821733333', 'eliemwez.rubuz@gmail.com', '43 Avenue Mwepu, Lubumbashi, Katanga, RDC', 'Lubumbashi', NULL, NULL, 'enterprise', 'actif', 'company', 'Centre de formation', '2025-02-25 16:47:29', NULL, NULL, '$2y$10$YfH/zA5LGmuZZYNJ7Gk3EuVc06khjxhIPHxIfAIZnOTXj2KETK9Ny', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '$2y$10$cbuZJ5fECtwCZ88YSgfqVe1NVcqpnNfV.OaUDkr.GIHeGgn71o5re', NULL, NULL, NULL, NULL, NULL, NULL),
(10, '250916SU3pbOTG8K6ucF3H7uP5dASfWVVEuKqA5wGuB5tPYvtAv6vS6V1758033130', '250591', 'chifia jess', 'chifia jess', '', '0858533285', 'ditotase.business@gmail.com', '4512 LUMUMBA HAUT-KATANGA RDC', 'LUBUMBASHI', NULL, NULL, 'company', 'actif', 'company', '', '2025-09-16 16:32:10', NULL, NULL, '$2y$10$ZtSvTMkHXmMvgydhz980QetgFLP2yXLaQIYdUFwGxmkdParsqj1Qu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '2509163HcqtHGz63Eb8M0yg7409DdrlBIEJfJ4svHMjqH7Dda8wozCoa1758033820', '255145', 'ELIAS', 'ELIAS', '', '08525822526', '', 'DSDSDSFD', '', NULL, NULL, 'complex-school', 'actif', 'company', '', '2025-09-16 16:43:40', NULL, NULL, '$2y$10$til91kUz3pJ8pGHm3cjnbu6HUiT6WD6TedAhyouWXb7cGtH1CsJMW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers_passwords`
--

CREATE TABLE `customers_passwords` (
  `password_id` int(11) UNSIGNED NOT NULL,
  `password_token` varchar(75) NOT NULL,
  `password_code` varchar(10) NOT NULL,
  `password_device` varchar(10) NOT NULL,
  `password_platform` varchar(10) NOT NULL,
  `password_time` varchar(10) NOT NULL,
  `password_ipaddress` varchar(75) DEFAULT NULL,
  `password_status` varchar(25) DEFAULT NULL,
  `password_type` varchar(75) DEFAULT NULL,
  `password_notes` text DEFAULT NULL,
  `password_created_at` datetime DEFAULT NULL,
  `password_created_by` varchar(75) DEFAULT NULL,
  `password_reseted_at` datetime DEFAULT NULL,
  `password_reseted_by` varchar(75) DEFAULT NULL,
  `password_deleted_at` datetime DEFAULT NULL,
  `password_customer_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers_passwords`
--

INSERT INTO `customers_passwords` (`password_id`, `password_token`, `password_code`, `password_device`, `password_platform`, `password_time`, `password_ipaddress`, `password_status`, `password_type`, `password_notes`, `password_created_at`, `password_created_by`, `password_reseted_at`, `password_reseted_by`, `password_deleted_at`, `password_customer_id`) VALUES
(240911, 'GI6onhaowr0z9l8HBbVt1mSz8EBimLao4lGi8I8P7cbgEGrzWddNBFsULYq815VhVSycL31GRDi', '04141', 'Firefox 12', 'Linux', '', '127.0.0.1', 'inactif', 'reset', 'Successfully reseted', '2024-09-18 10:47:26', NULL, '2024-09-18 10:56:27', 'elie mwez', NULL, 1),
(240912, '2409182DQA4SqcB8DAZtTHjEpuaYkzsKrZtSfARlQBeIgyP9tc9SPs3I1726657277', '242879', 'Firefox 12', 'Linux', '', '127.0.0.1', 'actif', 'change', 'Successfully password changed', '2024-09-18 11:01:17', NULL, '2024-09-18 11:01:17', 'elie mwez', NULL, 1),
(240913, 'JKR0LleJfIQau8tAWLtWOSONOwON1M3JgRJ8jPBHnvEQW1l1CJQcFehKef4BfzWtB9uG1aAY9qT', '33706', 'Firefox 13', 'Linux', '', '127.0.0.1', 'inactif', 'reset', 'Successfully reseted', '2024-09-18 15:41:13', NULL, '2024-09-18 15:41:32', '', NULL, 2),
(240914, '240918m5wvPQNAeTBUsZeYpjEU3JpBuzdPY4MHaCW1Od2doZa345idCc1726674112', '242487', 'Firefox 13', 'Linux', '', '127.0.0.1', 'actif', 'change', 'Successfully password changed', '2024-09-18 15:41:51', NULL, '2024-09-18 15:41:51', '', NULL, 2),
(24092040, '240920avnVRwfVjaU0lFvm79uB3Be26ocYenSqjDr6go18WAHvk28YuC1726835222', '244402', 'Firefox 13', 'Linux', '', '127.0.0.1', 'actif', 'change', 'Successfully password changed', '2024-09-20 12:27:02', NULL, '2024-09-20 12:27:02', 'System', NULL, 1),
(24092041, 'EHVUCQ98HQDwC0B1nJfE1syduHvJ2q1kfN67F5eZREUUKpPCPwRFr8AdTwEk4N6JUl6EShojrho', '93444', 'Firefox 14', 'Linux', '', '127.0.0.1', 'inactif', 'reset', 'Successfully reseted', '2025-09-20 09:39:17', NULL, '2025-09-20 09:46:02', 'Preefina Rubuz', NULL, 8),
(24092043, '250920P7vc0CK4KDU7Mkbaa8jCP4eNej1DfAf698Rs1vS3FyP5ZTJTjw1758354379', '252175', 'Firefox 14', 'Linux', '', '127.0.0.1', 'actif', 'change', 'Successfully password changed', '2025-09-20 09:46:19', NULL, '2025-09-20 09:46:19', 'Preefina Rubuz', NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) UNSIGNED NOT NULL,
  `department_token` varchar(75) NOT NULL,
  `department_code` varchar(10) NOT NULL,
  `department_name` varchar(75) DEFAULT NULL,
  `department_shortname` varchar(75) DEFAULT NULL,
  `department_status` varchar(25) DEFAULT NULL,
  `department_type` varchar(75) DEFAULT NULL,
  `department_notes` text DEFAULT NULL,
  `department_created_at` datetime DEFAULT NULL,
  `department_updated_at` datetime DEFAULT NULL,
  `department_deleted_at` datetime DEFAULT NULL,
  `department_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_behavior_positives`
--

CREATE TABLE `disciplinary_behavior_positives` (
  `positive_id` int(11) NOT NULL,
  `positive_token` varchar(75) NOT NULL,
  `positive_status` varchar(75) NOT NULL,
  `positive_type` int(11) NOT NULL,
  `positive_date` date NOT NULL,
  `positive_notes` text DEFAULT NULL,
  `positive_actions` text DEFAULT NULL,
  `positive_created_at` datetime DEFAULT NULL,
  `positive_updated_at` datetime DEFAULT NULL,
  `positive_deleted_at` datetime DEFAULT NULL,
  `positive_teacher_id` int(11) NOT NULL,
  `positive_student_id` int(11) NOT NULL,
  `positive_year_id` int(11) NOT NULL,
  `positive_school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_incidents`
--

CREATE TABLE `disciplinary_incidents` (
  `incident_id` int(11) NOT NULL,
  `incident_token` varchar(75) NOT NULL,
  `incident_type` varchar(75) NOT NULL,
  `incident_status` varchar(75) NOT NULL,
  `incident_date` date NOT NULL,
  `incident_gravity` enum('leger','moyen','grave') NOT NULL,
  `incident_notes` text DEFAULT NULL,
  `incident_actions` text DEFAULT NULL,
  `incident_description` text DEFAULT NULL,
  `incident_created_at` datetime DEFAULT NULL,
  `incident_updated_at` datetime DEFAULT NULL,
  `incident_deleted_at` datetime DEFAULT NULL,
  `incident_student_id` varchar(75) NOT NULL,
  `incident_teacher_id` int(11) DEFAULT NULL,
  `incident_year_id` varchar(75) NOT NULL,
  `incident_school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disciplinary_incidents`
--

INSERT INTO `disciplinary_incidents` (`incident_id`, `incident_token`, `incident_type`, `incident_status`, `incident_date`, `incident_gravity`, `incident_notes`, `incident_actions`, `incident_description`, `incident_created_at`, `incident_updated_at`, `incident_deleted_at`, `incident_student_id`, `incident_teacher_id`, `incident_year_id`, `incident_school_id`) VALUES
(1, '250619qtCVsjYwLuh2Ucp38THppLLfYJkkJ9IIZbbi9iP6GyMtYLeTtE1750341069', 'Bavardage excessif', '', '2025-06-17', 'grave', 'Incident frequente ok', 'Renvoi de l\'eleve ok', 'Tripotement des autres eleves ok', '2025-06-19 15:51:09', '2025-06-19 16:41:13', NULL, '21', 1, '2', 1),
(2, '250619s0YzUUZoEPDRFzikOVhAmvQ0EaDWYQRsCEVuU5F0WsmrGR4mS41750341162', 'Violence et Bagare', '', '2025-06-19', 'moyen', '', 'isolement', 'C\'est complique avec cette fille', '2025-06-19 15:52:42', NULL, NULL, '20', 4, '2', 1),
(3, '250903dDIg6yCYpibUIlgrk6WenNfivEwekdi4onHjaAPiuLhskeVGN21756891011', 'Insolence', '', '2025-09-02', 'leger', '', 'hhhh', 'hhhh', '2025-09-03 11:16:51', NULL, NULL, '18', 1, '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_parents_notifications`
--

CREATE TABLE `disciplinary_parents_notifications` (
  `notification_id` int(11) NOT NULL,
  `notification_token` varchar(75) NOT NULL,
  `notification_send_date` date NOT NULL,
  `notification_canal` enum('email','sms','paper') NOT NULL,
  `notification_status` enum('send','cancel','pending') DEFAULT 'pending',
  `notification_notes` text DEFAULT NULL,
  `notification_created_at` datetime DEFAULT NULL,
  `notification_updated_at` datetime DEFAULT NULL,
  `notification_deleted_at` datetime DEFAULT NULL,
  `notification_student_id` int(11) NOT NULL,
  `notification_incident_id` int(11) DEFAULT NULL,
  `notification_sanction_id` int(11) DEFAULT NULL,
  `notification_year_id` int(11) NOT NULL,
  `notification_school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_sanctions`
--

CREATE TABLE `disciplinary_sanctions` (
  `sanction_id` int(11) NOT NULL,
  `sanction_token` varchar(75) NOT NULL,
  `sanction_type` varchar(75) NOT NULL,
  `sanction_status` varchar(75) NOT NULL,
  `sanction_date` date NOT NULL,
  `sanction_points` int(11) DEFAULT NULL,
  `sanction_timing` varchar(75) DEFAULT NULL,
  `sanction_notes` text DEFAULT NULL,
  `sanction_created_at` datetime DEFAULT NULL,
  `sanction_updated_at` datetime DEFAULT NULL,
  `sanction_deleted_at` datetime DEFAULT NULL,
  `sanction_incident_id` int(11) NOT NULL,
  `sanction_year_id` int(11) NOT NULL,
  `sanction_school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disciplinary_sanctions`
--

INSERT INTO `disciplinary_sanctions` (`sanction_id`, `sanction_token`, `sanction_type`, `sanction_status`, `sanction_date`, `sanction_points`, `sanction_timing`, `sanction_notes`, `sanction_created_at`, `sanction_updated_at`, `sanction_deleted_at`, `sanction_incident_id`, `sanction_year_id`, `sanction_school_id`) VALUES
(1, '250903QTwHJh0Dl8QQ9qSYuIJmcaA6nu1rC13Zo0wncq7ieCgC12ENYi1756891177', 'Observation orale', 'actif', '2025-09-03', 1, '10min', '', '2025-09-03 11:19:37', NULL, NULL, 3, 2, 1),
(2, '2509036NlISMy6r6mRdoYJnAEPvBFS4sTGqi2N5bwSYEr79JQh3n2iJj1756891597', 'Exclusion definitive des ecoles ditotase', 'actif', '2025-09-03', 0, '', '', '2025-09-03 11:26:37', NULL, NULL, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_students_evaluations`
--

CREATE TABLE `disciplinary_students_evaluations` (
  `evaluation_id` int(11) NOT NULL,
  `evaluation_token` varchar(75) NOT NULL,
  `evaluation_status` varchar(75) NOT NULL,
  `evaluation_total_points` int(11) DEFAULT 0,
  `evaluation_mention` varchar(75) DEFAULT NULL,
  `evaluation_date` date DEFAULT NULL,
  `evaluation_notes` text DEFAULT NULL,
  `evaluation_created_at` datetime DEFAULT NULL,
  `evaluation_updated_at` datetime DEFAULT NULL,
  `evaluation_deleted_at` datetime DEFAULT NULL,
  `evaluation_student_id` int(11) NOT NULL,
  `evaluation_period_id` int(11) DEFAULT NULL,
  `evaluation_year_id` int(11) NOT NULL,
  `evaluation_school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) UNSIGNED NOT NULL,
  `employee_token` varchar(75) NOT NULL,
  `employee_code` varchar(10) NOT NULL,
  `employee_firstname` varchar(75) DEFAULT NULL,
  `employee_lastname` varchar(75) DEFAULT NULL,
  `employee_othername` varchar(75) DEFAULT NULL,
  `employee_title` varchar(75) DEFAULT NULL,
  `employee_phone` varchar(15) DEFAULT NULL,
  `employee_email` varchar(75) DEFAULT NULL,
  `employee_address` varchar(75) DEFAULT NULL,
  `employee_city` varchar(50) DEFAULT NULL,
  `employee_province` varchar(50) DEFAULT NULL,
  `employee_country` varchar(50) DEFAULT NULL,
  `employee_status` varchar(25) DEFAULT NULL,
  `employee_type` varchar(75) DEFAULT NULL,
  `employee_notes` text DEFAULT NULL,
  `employee_created_at` datetime DEFAULT NULL,
  `employee_updated_at` datetime DEFAULT NULL,
  `employee_deleted_at` datetime DEFAULT NULL,
  `employee_service_id` int(11) UNSIGNED DEFAULT NULL,
  `employee_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exemptions`
--

CREATE TABLE `exemptions` (
  `exemption_id` int(11) UNSIGNED NOT NULL,
  `exemption_token` varchar(75) DEFAULT NULL,
  `exemption_code` int(10) DEFAULT NULL,
  `exemption_name` varchar(25) DEFAULT NULL,
  `exemption_cost_discount` decimal(10,2) DEFAULT NULL,
  `exemption_currency` varchar(25) DEFAULT NULL,
  `exemption_status` varchar(25) DEFAULT NULL,
  `exemption_type` varchar(75) DEFAULT NULL,
  `exemption_notes` text DEFAULT NULL,
  `exemption_created_at` datetime DEFAULT NULL,
  `exemption_updated_at` datetime DEFAULT NULL,
  `exemption_deleted_at` datetime DEFAULT NULL,
  `exemption_year_id` int(11) UNSIGNED DEFAULT NULL,
  `exemption_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exemptions`
--

INSERT INTO `exemptions` (`exemption_id`, `exemption_token`, `exemption_code`, `exemption_name`, `exemption_cost_discount`, `exemption_currency`, `exemption_status`, `exemption_type`, `exemption_notes`, `exemption_created_at`, `exemption_updated_at`, `exemption_deleted_at`, `exemption_year_id`, `exemption_school_id`) VALUES
(1, '240722NcLipKk2ruvOaDHMqWOQJf4yZsm7g1DwWMT1HeBCdNCG5eug4y1721657896', 249796, 'MINERVAL', 20.00, 'usd', 'actif', NULL, NULL, '2024-07-22 14:18:16', NULL, NULL, 2, 1),
(2, '240722BOlS033rbuFNtt1jV00L9mVrO02OTbkAGa9sPCFzy8mrJPZ0yT1721657915', 241165, 'FIP', 5000.00, 'cdf', 'actif', NULL, NULL, '2024-07-22 14:18:35', NULL, NULL, 2, 1),
(4, '241204aeIFJpouJ6EEowkrMYLWEzSoJ5LV3gIbkfjUcIAgFqBe5KlKD91733316676', 242650, 'Enfants prof', 5.00, 'usd', 'actif', NULL, NULL, '2024-12-04 14:51:16', '2024-12-04 14:55:59', NULL, 2, 1),
(5, '241204uRycTHgp58Qu1EFQeyqDdBaMyoPhIUsu80LQssFwElqZVQ7mIv1733317185', 242101, 'Devcembre', 5.00, 'usd', 'actif', NULL, NULL, '2024-12-04 14:59:45', NULL, NULL, 2, 1),
(6, '2412046Bt1zElPkJRaJMn75QljOW0NO8kQvRylztiJIBN7SE0d5T0UTS1733317993', 240422, 'Prise en charge', 5.00, 'usd', 'actif', NULL, NULL, '2024-12-04 15:13:13', NULL, NULL, 2, 1),
(7, '250128YGAWEZ79DHLI101Jar4T4ZPKTM7dmk1b5myp8JMJamU3UkzDDP1738074002', 256793, 'Frais Annuel', 30.00, 'usd', 'actif', NULL, NULL, '2025-01-28 16:20:02', '2025-01-28 16:25:29', NULL, 2, 1),
(8, '250609I5ZdugEkuLzdVmP46iP9Q99M2CjCPDJuazR9lSyaFbmt5nfmQc1749468954', 257561, 'Exo 1', 150.00, 'usd', 'actif', NULL, NULL, '2025-06-09 13:35:54', '2025-06-09 13:44:54', NULL, 2, 1),
(9, '250609TGWEPTDdaUhiJP0uPyecm4v5aDrNkEp7tUMnzRrL3OjujH8tuw1749468967', 251797, 'exo 2', 140.00, 'usd', 'actif', NULL, NULL, '2025-06-09 13:36:07', '2025-06-09 13:44:48', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exemptions_classes`
--

CREATE TABLE `exemptions_classes` (
  `exemptionclasse_id` int(11) UNSIGNED NOT NULL,
  `exemptionclasse_status` varchar(25) DEFAULT NULL,
  `exemptionclasse_notes` text DEFAULT NULL,
  `exemptionclasse_created_at` datetime DEFAULT NULL,
  `exemptionclasse_updated_at` datetime DEFAULT NULL,
  `exemptionclasse_deleted_at` datetime DEFAULT NULL,
  `exemptionclasse_classe_id` int(11) UNSIGNED DEFAULT NULL,
  `exemptionclasse_exemption_id` int(11) UNSIGNED DEFAULT NULL,
  `exemptionclasse_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exemptions_classes`
--

INSERT INTO `exemptions_classes` (`exemptionclasse_id`, `exemptionclasse_status`, `exemptionclasse_notes`, `exemptionclasse_created_at`, `exemptionclasse_updated_at`, `exemptionclasse_deleted_at`, `exemptionclasse_classe_id`, `exemptionclasse_exemption_id`, `exemptionclasse_school_id`) VALUES
(5, 'actif', 'Bourse accordée par classe', '2024-08-09 14:28:22', NULL, NULL, 1, 1, 1),
(7, 'actif', 'Bourse accordée par classe', '2024-08-09 14:28:22', NULL, NULL, 3, 1, 1),
(9, 'actif', 'Bourse accordée par classe', '2024-12-03 09:48:38', NULL, NULL, 1, 3, 1),
(10, 'actif', 'Bourse accordée par classe', '2024-12-03 09:48:38', NULL, NULL, 2, 3, 1),
(11, 'actif', 'Bourse accordée par classe', '2024-12-03 09:48:38', NULL, NULL, 3, 3, 1),
(12, 'actif', 'Bourse accordée par classe', '2024-12-03 09:48:38', NULL, NULL, 7, 3, 1),
(13, 'actif', 'Bourse accordée par classe', '2024-12-03 09:48:38', NULL, NULL, 4, 3, 1),
(14, 'actif', 'Bourse accordée par classe', '2024-12-03 09:48:38', NULL, NULL, 8, 3, 1),
(18, 'actif', 'Bourse accordée par classe', '2024-12-04 14:56:17', NULL, NULL, 7, 4, 1),
(30, 'actif', 'Bourse accordée par classe', '2024-12-04 15:02:10', NULL, NULL, 7, 5, 1),
(42, 'actif', 'Bourse accordée par classe', '2024-12-04 15:14:47', NULL, NULL, 7, 6, 1),
(43, 'actif', 'Bourse accordée par classe', '2024-12-04 15:14:47', NULL, NULL, 4, 6, 1),
(69, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:28', NULL, NULL, 1, 7, 1),
(70, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:28', NULL, NULL, 2, 7, 1),
(71, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:28', NULL, NULL, 3, 7, 1),
(72, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:28', NULL, NULL, 7, 7, 1),
(73, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:28', NULL, NULL, 4, 7, 1),
(74, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:28', NULL, NULL, 8, 7, 1),
(75, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:28', NULL, NULL, 10, 7, 1),
(76, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:42', NULL, NULL, 1, 2, 1),
(77, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:42', NULL, NULL, 2, 2, 1),
(78, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:42', NULL, NULL, 3, 2, 1),
(80, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:42', NULL, NULL, 4, 2, 1),
(82, 'actif', 'Bourse accordée par classe', '2025-06-09 13:41:42', NULL, NULL, 10, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exemptions_discounts`
--

CREATE TABLE `exemptions_discounts` (
  `feediscount_id` int(11) UNSIGNED NOT NULL,
  `feediscount_status` varchar(25) DEFAULT NULL,
  `feediscount_notes` text DEFAULT NULL,
  `feediscount_created_at` datetime DEFAULT NULL,
  `feediscount_updated_at` datetime DEFAULT NULL,
  `feediscount_deleted_at` datetime DEFAULT NULL,
  `feediscount_feedetail_id` int(11) UNSIGNED DEFAULT NULL,
  `feediscount_exemption_id` int(11) UNSIGNED DEFAULT NULL,
  `feediscount_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exemptions_discounts`
--

INSERT INTO `exemptions_discounts` (`feediscount_id`, `feediscount_status`, `feediscount_notes`, `feediscount_created_at`, `feediscount_updated_at`, `feediscount_deleted_at`, `feediscount_feedetail_id`, `feediscount_exemption_id`, `feediscount_school_id`) VALUES
(1, 'actif', 'Bourse accordée par classe', '2024-07-22 14:19:53', NULL, NULL, 7, 2, 1),
(13, 'actif', 'Bourse accordée par classe', '2024-07-22 14:20:22', NULL, NULL, 6, 1, 1),
(14, 'actif', 'Bourse accordée par classe', '2024-07-22 14:20:22', NULL, NULL, 1, 1, 1),
(15, 'actif', 'Bourse accordée par classe', '2024-07-22 14:20:22', NULL, NULL, 2, 1, 1),
(29, 'actif', 'Bourse accordée par classe', '2024-12-03 09:48:25', NULL, NULL, 1, 3, 1),
(30, 'actif', 'Bourse accordée par classe', '2024-12-03 09:48:25', NULL, NULL, 2, 3, 1),
(41, 'actif', 'Bourse accordée par classe', '2024-12-04 14:55:51', NULL, NULL, 14, 4, 1),
(77, 'actif', 'Bourse accordée par classe', '2024-12-04 15:02:21', NULL, NULL, 14, 5, 1),
(112, 'actif', 'Bourse accordée par classe', '2024-12-04 15:14:36', NULL, NULL, 13, 6, 1),
(113, 'actif', 'Bourse accordée par classe', '2024-12-04 15:14:36', NULL, NULL, 14, 6, 1),
(143, 'actif', 'Bourse accordée par classe', '2025-01-28 16:25:55', NULL, NULL, 19, 7, 1),
(176, 'actif', 'Bourse accordée par classe', '2025-06-09 13:36:30', NULL, NULL, 1, 8, 1),
(177, 'actif', 'Bourse accordée par classe', '2025-06-09 13:36:30', NULL, NULL, 2, 8, 1),
(197, 'actif', 'Bourse accordée par classe', '2025-06-09 13:36:45', NULL, NULL, 3, 9, 1),
(198, 'actif', 'Bourse accordée par classe', '2025-06-09 13:36:45', NULL, NULL, 4, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exemptions_students`
--

CREATE TABLE `exemptions_students` (
  `feestudent_id` int(11) UNSIGNED NOT NULL,
  `feestudent_status` varchar(25) DEFAULT NULL,
  `feestudent_notes` text DEFAULT NULL,
  `feestudent_created_at` datetime DEFAULT NULL,
  `feestudent_updated_at` datetime DEFAULT NULL,
  `feestudent_deleted_at` datetime DEFAULT NULL,
  `feestudent_inscription_id` int(11) UNSIGNED DEFAULT NULL,
  `feestudent_exemption_id` int(11) UNSIGNED DEFAULT NULL,
  `feestudent_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exemptions_students`
--

INSERT INTO `exemptions_students` (`feestudent_id`, `feestudent_status`, `feestudent_notes`, `feestudent_created_at`, `feestudent_updated_at`, `feestudent_deleted_at`, `feestudent_inscription_id`, `feestudent_exemption_id`, `feestudent_school_id`) VALUES
(9, 'actif', 'Accordee par la methode globale', '2024-08-09 14:58:24', NULL, NULL, 3, 1, 1),
(21, 'actif', 'Accordee par la methode globale', '2025-01-28 16:21:14', NULL, NULL, 9, 7, 1),
(26, 'actif', 'Accordee par la methode globale', '2025-01-28 16:21:14', NULL, NULL, 9, 1, 1),
(33, 'actif', 'Accordee par la methode globale', '2025-01-28 17:00:00', NULL, NULL, 13, 7, 1),
(38, 'actif', 'Accordee par la methode globale', '2025-01-28 17:00:00', NULL, NULL, 13, 1, 1),
(39, 'actif', 'Accordee par la methode globale', '2025-06-09 13:42:37', NULL, NULL, 24, 9, 1),
(40, 'actif', 'Accordee par la methode globale', '2025-06-09 13:42:37', NULL, NULL, 24, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `fee_id` int(11) UNSIGNED NOT NULL,
  `fee_token` varchar(75) NOT NULL,
  `fee_code` varchar(10) NOT NULL,
  `fee_name` varchar(75) DEFAULT NULL,
  `fee_status` varchar(25) DEFAULT NULL,
  `fee_type` varchar(75) DEFAULT NULL,
  `fee_total_payable` int(11) DEFAULT NULL,
  `fee_currency_payable` varchar(75) DEFAULT NULL,
  `fee_notes` text DEFAULT NULL,
  `fee_created_at` datetime DEFAULT NULL,
  `fee_updated_at` datetime DEFAULT NULL,
  `fee_deleted_at` datetime DEFAULT NULL,
  `fee_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`fee_id`, `fee_token`, `fee_code`, `fee_name`, `fee_status`, `fee_type`, `fee_total_payable`, `fee_currency_payable`, `fee_notes`, `fee_created_at`, `fee_updated_at`, `fee_deleted_at`, `fee_school_id`) VALUES
(1, '240722mffwgNWVsgQw7sqoUeoVsEKvMZkSEdYlTmtPhzpclfhzQOE4PG1721657583', '247490', 'Frais academiques', 'actif', 'monthly', 5, 'usd', NULL, '2024-07-22 14:13:03', '2025-11-30 11:41:40', NULL, 1),
(2, '240722Jfnoh0mI6a6Rvn3t0aKYuCGyGj3QZOC1RyL5HCJaGw61W9ON5v1721657734', '244941', 'FRAIS DE DEMARRAGE', 'actif', 'annual', 1, 'usd', NULL, '2024-07-22 14:15:34', NULL, NULL, 1),
(3, '240722HvkkfMuA82OvVucTU3GBpq94GuUFHssFK8r3iiBwpGnfTRhiPI1721657769', '244297', 'frais connexes', 'actif', 'installment', 3, 'cdf', NULL, '2024-07-22 14:16:09', '2025-11-30 11:44:19', NULL, 1),
(4, '240910jIWrHp8hg90AGWbFM743z2V6vhVkszRz2T8HGP18fTE91qOGjc1725963545', '243125', 'frais Administratif', 'actif', 'annual', 1, 'usd', NULL, '2024-09-10 10:19:05', '2025-11-30 11:45:30', NULL, 1),
(5, '241025tw0ok6Kphh7fAqMuIrLtEt2nrNds3wSQCDP0L5DPH3Tfmzb3rU1729860482', '242097', 'frais inscription', 'actif', 'annual', 4, 'usd', NULL, '2024-10-25 14:48:02', '2025-11-30 11:44:56', NULL, 1),
(6, '241025AKotbU6ehT72v6faAOJLNtz4C9OUNpMAnBVmstkNnGgffU95kQ1729860666', '244932', 'frais stage', 'actif', 'installment', 2, 'cdf', NULL, '2024-10-25 14:51:06', '2025-11-30 11:44:34', NULL, 1),
(9, '2501280Co6ONPtrjelQucVe0P4Mz3OBLcpAhqhZk3TRWmpydsThSQWUw1738073893', '253053', 'Frais Travaux Annuel ', 'actif', 'annual', 1, 'usd', NULL, '2025-01-28 16:18:13', '2025-01-28 16:24:47', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees_classes`
--

CREATE TABLE `fees_classes` (
  `feeclasse_id` int(11) UNSIGNED NOT NULL,
  `feeclasse_token` varchar(75) NOT NULL,
  `feeclasse_code` varchar(10) NOT NULL,
  `feeclasse_status` varchar(25) DEFAULT NULL,
  `feeclasse_notes` text DEFAULT NULL,
  `feeclasse_created_at` datetime DEFAULT NULL,
  `feeclasse_updated_at` datetime DEFAULT NULL,
  `feeclasse_deleted_at` datetime DEFAULT NULL,
  `feeclasse_feedetail_id` int(11) UNSIGNED DEFAULT NULL,
  `feeclasse_classe_id` int(11) UNSIGNED DEFAULT NULL,
  `feeclasse_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_classes`
--

INSERT INTO `fees_classes` (`feeclasse_id`, `feeclasse_token`, `feeclasse_code`, `feeclasse_status`, `feeclasse_notes`, `feeclasse_created_at`, `feeclasse_updated_at`, `feeclasse_deleted_at`, `feeclasse_feedetail_id`, `feeclasse_classe_id`, `feeclasse_school_id`) VALUES
(86, '241025aCz7KScfiT18BmVdW5bOSwmBRYfJZvaQ8qmSjjUboVseNnSu471729860994', '240113', 'actif', NULL, '2024-10-25 14:56:34', NULL, NULL, 17, 1, 1),
(87, '241025sMV5Pkzzez1LwUuhk6K3BvpmRt6WPgtVhTBucce5t6ZGlLVhDH1729860994', '241810', 'actif', NULL, '2024-10-25 14:56:34', NULL, NULL, 17, 2, 1),
(88, '241025phejs9eGa71dQicc7mYpW8R3nab08MWZYGehOhtr8mnOsgmHvv1729860994', '246615', 'actif', NULL, '2024-10-25 14:56:34', NULL, NULL, 17, 3, 1),
(89, '241025Ki5m1qrUqvhbhA8krbDmCFzWTgiOcakdt5uOwb140hBDkKkvFS1729860994', '246366', 'actif', NULL, '2024-10-25 14:56:34', NULL, NULL, 17, 4, 1),
(192, '250128yk5oU2c9elWWBrk3gZf5RKwucDFR09ALVsFu3Ej9U6gbLncnVZ1738076787', '252914', 'actif', NULL, '2025-01-28 17:06:27', NULL, NULL, 10, 1, 1),
(193, '250128Toh1lWjIGTapYCPV2wiIspeoWfbb01NWJ3NawNfYjvFbQMV1Ui1738076787', '252869', 'actif', NULL, '2025-01-28 17:06:27', NULL, NULL, 10, 2, 1),
(194, '250128cq3pqy0cs3jr87lBIekTbzy4ap9J2wVk5BJ1wa4YjSGfsvysaO1738076787', '255786', 'actif', NULL, '2025-01-28 17:06:27', NULL, NULL, 10, 3, 1),
(196, '2501283Jzian40zps4y43QsgiwDjfqRZ2W9dYJaNpOkLR9W6YOr76t831738076787', '257569', 'actif', NULL, '2025-01-28 17:06:27', NULL, NULL, 10, 4, 1),
(252, '250609asVMjpkrB8v9WFyqwAGjaTy6TNqKyRoclJeMLuy7rhMrIqwmG71749469206', '252383', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 1, 1, 1),
(253, '250609Zv2izK2NicCcNowP1pDsopBVpUoE8SDiqmIqEYqmiYUCZM8gOU1749469206', '255707', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 1, 2, 1),
(254, '250609hWnJhIl3Sdk6znN2kBDnoUpiDZhu0ry7W7MiYQDCvEidC3mvhn1749469206', '255828', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 1, 3, 1),
(256, '250609gss4iffJ3zdK4bKaU9KscJI1dGk5tCOiFZ9F3B2ilncA2jVONF1749469206', '259806', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 1, 4, 1),
(258, '250609ic3oYRFJhStppbzSUkDnefOdUHAYRjBR4DryiZc6DCBr57B2n81749469206', '258376', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 1, 10, 1),
(259, '250609eClo9ElSen2PewSC1ohBs49VSCUVvM9WuD7aHi2hPlzQO9lcF21749469206', '254560', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 2, 1, 1),
(260, '250609u8fOO2ArIDC7DybmUIGjYOTTHD2HiZk8pi0S1mP8Ce7TMsf10O1749469206', '257860', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 2, 2, 1),
(261, '250609KB8RGBkrLzY2jyAz7JW38AugFmcGV38E9RZ1D2zCUmKrL13j4F1749469206', '257988', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 2, 3, 1),
(263, '250609lzuqcFoNafUAm34T9d7NIpZsiH1NO6fw065DufHf25DOLYc4VV1749469206', '250657', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 2, 4, 1),
(265, '250609CWWOjGfBauYttBw56mEbIKdW2lPmEbLsuA0Oq0lw1EIN3EKWzf1749469206', '250362', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 2, 10, 1),
(266, '250609h0VYQcBMWeh7Ke2TcN0IT0D02j8vZVLW7Stf1j4nu4wqL5VfHh1749469206', '256461', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 3, 1, 1),
(267, '250609Kf6y0sGRamqhFd8yh3Tyn9DLG5mBtdHMFVgsd6WSCZc3oReuKy1749469206', '257997', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 3, 2, 1),
(268, '250609sL41WWUtAR6AJy9BdOZRtlNYfV6JHLnSSB0IDKlhyesnlhzFKN1749469206', '256584', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 3, 3, 1),
(270, '250609lirOdC704AQIVceYW0dQhnBdqkbbrmLoov3VAndC6CdpcgnaNz1749469206', '253043', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 3, 4, 1),
(272, '250609oFDSMwQ5ulHrs1GABZfQpa88hGhv0FOJmJpLWstHzlmQFw3Lou1749469206', '257160', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 3, 10, 1),
(273, '250609VaDEYDZMF7qyz0e1l4sFw4pcGAWqy8729ysEbH2czUfaiP0yvE1749469206', '253554', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 4, 1, 1),
(274, '250609zbCNi3sC26OLDeao3q0TsOpqnbGsoGQmgZh1Pj7cQg0djJUjdv1749469206', '255318', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 4, 2, 1),
(275, '2506096ENh8MZrta7kDCLNi0ia0h1S8cRPrLQDHeukD3inhEulUMue1S1749469206', '259914', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 4, 3, 1),
(277, '250609ot7qiTcKfKWcvZ62j7wjnN2IzGBDzh7dtc5FUib71j4vvZrBSY1749469206', '257948', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 4, 4, 1),
(279, '250609zeStWVy19vQvOKnndgJ0tBaTnJBcwC6K2cEcDCqf35oGr9raTf1749469206', '255344', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 4, 10, 1),
(280, '250609su94ce4MDVTkNlCU4HZeBM8CWttDMCUDyto8zymIG80Snwy5Sk1749469206', '258387', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 5, 1, 1),
(281, '250609kL1Gl6zERLaOVh3dPs9UIheom99v8ts08BP9s18KwMofZBeG5h1749469206', '255828', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 5, 2, 1),
(282, '250609Z9WpaqzocbOFyOKwfoY2FIwm6vNLpWhjbet4UOKg7LJV9yYJfo1749469206', '251419', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 5, 3, 1),
(284, '250609gMzEuh9OQea5rwE4DHZmyfQtciAynaFViH7b1Sm90jE9Bdcuva1749469206', '254641', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 5, 4, 1),
(286, '250609ZO0wmrc5oUQkymPtMkO1b03Ce8vhPV7TR0V4lVzNmD9vL3VEAw1749469206', '255954', 'actif', NULL, '2025-06-09 13:40:06', NULL, NULL, 5, 10, 1),
(287, '2506091nW2TZj0czk6aaDpe9Db17g0CgsdepjBgPu7CVswjrNNbGgpOd1749469216', '253924', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 11, 1, 1),
(288, '250609TDAckpegw4rDOtaGgK8ChkESp9GqKCH0Wy01rULzleBcN9tAfN1749469216', '256906', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 11, 2, 1),
(289, '250609vBksOalmHROZf9jEHDpUuCHWZorzNsNLqe048GouiiEMMWtLBI1749469216', '259381', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 11, 3, 1),
(290, '250609Qnk8bJwhy7n7vum3Gmsg5dkSuNapnVIvuzsCPM13ml3lBruHnj1749469216', '251358', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 11, 7, 1),
(291, '250609TSttuhb1DIbdDTJuJJUerTMa8Z7npVS11bZeZCrjdFPWN7BdgQ1749469216', '255603', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 11, 4, 1),
(293, '250609yQYlqnToUm5pTsty0mRTSbJOtJuDzpOuQ5aP2lK7YPrFKriSw31749469216', '255827', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 11, 10, 1),
(294, '250609NPWqakgMCK9TAtt7L9yzafgiOjI9arnvkZelNei37VZ2PR120d1749469216', '251137', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 12, 1, 1),
(295, '2506096v2SPHr3YGUFzHQAzFO6TnEY4v3AZhGnJAhbPTITeKpWm33vOH1749469216', '250059', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 12, 2, 1),
(296, '250609KMkVijac8YlVQRmpiFJqhjWfkrVR7FasSVM9jLZcrUy9VjHNFt1749469216', '255733', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 12, 3, 1),
(297, '250609PevUT1CCN5WGvTjCqpP65u56yQ6AZfMR8kL3dw1DmyAva4lKWR1749469216', '258410', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 12, 7, 1),
(298, '250609buUO07j1oryIvz8PzAc8M6clr82tWYmyMkEt1ohHDG5JdU8Pgq1749469216', '250088', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 12, 4, 1),
(300, '250609m0VqINN6nk8V1kjb9uREA5YVPjU21B2QygteFPMU01ckFzYjLt1749469216', '257099', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 12, 10, 1),
(301, '250609HbsqSeeolODtSc9mnMnwbeQ6t4RW0SjTjD1m6R7qk1mqdHCsOS1749469216', '256380', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 13, 1, 1),
(302, '250609y2rpsN5c0kkt8U1TKrpjzbPDFGnFdaZFnKMphg737yEIlVTJZk1749469216', '256888', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 13, 2, 1),
(303, '250609RpOGaqSp8dLPJY6ochTzCKiHflw1PHRBAgDLwSinf2FCyEodfS1749469216', '254666', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 13, 3, 1),
(304, '250609qmtHvfcfkoaKR2S82p42KEBCEKPbUJh9FYoWhsH2trwvoIt1kz1749469216', '256958', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 13, 7, 1),
(305, '2506097aJtpqQtFLHaJkkMkkBVZ2zzU0hFfF8Ok7QqEW7RYkZuyGTkls1749469216', '255112', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 13, 4, 1),
(307, '2506097EKVzACMLIZ1NGWnwHP4C20QE2qQN2Fm8TiUGTwPnivU5YW1kf1749469216', '258349', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 13, 10, 1),
(308, '250609CR7PdlOHK4q3kNiyzSgRcR4yutFN6EbhjNbdoDiDAtmhnWAZfH1749469216', '256368', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 14, 1, 1),
(309, '250609NHAYpKL0aLE7EIJZTWsk2gDNZ0vGfdBjTSqT34bzTBCHiUOBkv1749469216', '251540', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 14, 2, 1),
(310, '250609e85uf1mouYb0pO3HVUhu0fMerIOgHgKGLtYEg92NksiAYg7hDn1749469216', '258017', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 14, 3, 1),
(311, '2506095lW7CAT9GAqgtiQywZqlhJfNl6pLPawqGZe2TTNHbehr9aYWFg1749469216', '253939', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 14, 7, 1),
(312, '250609B8md81a4GrrbDbyUsNjyiSK3pk2F3LlN6gW0lLWwKRiD9sEfCF1749469216', '252342', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 14, 4, 1),
(314, '250609v6BIvNNKRgGVBOSQHs2hlZAoDno3eD2RQLVFIar5ns2HbwDnsf1749469216', '253099', 'actif', NULL, '2025-06-09 13:40:16', NULL, NULL, 14, 10, 1),
(318, '250609R1jDlowwm6CKfZ608rd50izl1rvTIwe0hkKCYLu5863D907egl1749469222', '256866', 'actif', NULL, '2025-06-09 13:40:22', NULL, NULL, 19, 7, 1),
(319, '250609jymVhQryUFFUwwVdsqrR2Oad8SEpTU9FBbN2b83gdo3fcWUAQ01749469222', '255786', 'actif', NULL, '2025-06-09 13:40:22', NULL, NULL, 19, 4, 1),
(320, '250609OAMhaPQrv0uOAOi3nJRelkOrZa97KMQj7K2H0gWSu9NPuETLQ91749469222', '250707', 'actif', NULL, '2025-06-09 13:40:22', NULL, NULL, 19, 8, 1),
(321, '250609GgediCtLLG60H0ybqOvnkRMUinDFJpYTgj5dgsCBQnksoWEnjw1749469222', '256513', 'actif', NULL, '2025-06-09 13:40:22', NULL, NULL, 19, 10, 1),
(322, '250609TtvPUser4Myuui2rpdjAhqJYdrlE1qLqKdEVwLbfJSzKvcJon01749469232', '257050', 'actif', NULL, '2025-06-09 13:40:32', NULL, NULL, 15, 1, 1),
(323, '250609OPEAknl9ROraU5f1qrK4dKTo6WeQ7zA9BbMCZJESIjGJ2HmgME1749469232', '258235', 'actif', NULL, '2025-06-09 13:40:32', NULL, NULL, 15, 2, 1),
(324, '250609wcbkQFQNJzDKPfFFMUuudySmiTnB7YIAuJtU6nA7j4RQKqSbTa1749469232', '253901', 'actif', NULL, '2025-06-09 13:40:32', NULL, NULL, 15, 3, 1),
(326, '250609b8SUKDFIDSgQCAh7izY6pS2CCH7IaSttK5QQj2rcyRuzRa52Oc1749469232', '258552', 'actif', NULL, '2025-06-09 13:40:32', NULL, NULL, 15, 4, 1),
(328, '250609rfNwUJBpBsjcTqFMb3sfI6c7kIkhTrDMTwoWOzwDwqiCNCpSRs1749469232', '255761', 'actif', NULL, '2025-06-09 13:40:32', NULL, NULL, 15, 10, 1),
(329, '250609rKtg7lFMUJ71yHfL0gc8FqohzSLl6Cr5qgHnvdQpVtFIS5S02s1749469232', '255901', 'actif', NULL, '2025-06-09 13:40:32', NULL, NULL, 16, 1, 1),
(330, '2506092DUrmRtYJonnLLiwjtPt3Au9TCFkribHzdkyhF2qoLhyaVgfAU1749469232', '250984', 'actif', NULL, '2025-06-09 13:40:32', NULL, NULL, 16, 2, 1),
(331, '250609qWd1DI5GjYeFhR43qT8QN8E6pEtnQ6Nn80uUTNgmSLCmEpku4w1749469232', '255376', 'actif', NULL, '2025-06-09 13:40:32', NULL, NULL, 16, 3, 1),
(333, '250609zECHuthLb4VBc8R9JNKUlP7cwLNGJ9UHgUoj1Pl7rNuyQUr1wD1749469232', '257672', 'actif', NULL, '2025-06-09 13:40:32', NULL, NULL, 16, 4, 1),
(335, '250609jgeKozeqQig9Lp9qQqIgBjDbyMnQK2oFP3LO92SttGRzV4emKm1749469232', '250815', 'actif', NULL, '2025-06-09 13:40:32', NULL, NULL, 16, 10, 1),
(336, '250609UV9rENb8y154LafMuzN4kqD7dsLVH8sVYNpB9ShjM85ewlFcWc1749469243', '259771', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 7, 1, 1),
(337, '250609jyp2amWhNT3Bn44YtcShob07jnPjdsK4ApVc3YLphQ7NNrTYPB1749469243', '254912', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 7, 2, 1),
(338, '250609oiTCGQsrrG8Mfb1kCpshN87LZBQUwUogHl4VA3oWRtuHY72qUb1749469243', '258178', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 7, 3, 1),
(342, '250609C1qZ9AZ9n0EzSPYz3WVbmg1P7GRjSznAQfbyLn9O27THvV7Pdj1749469243', '250705', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 7, 10, 1),
(343, '250609dQAw5wABMWc1vqTfL4ysTEZgTRpZ3y6vL8K7n8uLZynaLW0PZd1749469243', '256012', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 8, 1, 1),
(344, '250609irrgc6QZCDq2iDbWji8sRJSbRDliZkhz1MyeOCskKMKF8V97os1749469243', '256770', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 8, 2, 1),
(345, '250609z7HeWkVKBhvE5tIQqsTPEEtSKg1tO8aptN60QimRvoGadFHAKg1749469243', '256357', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 8, 3, 1),
(349, '250609Ql4kQdD4uMdUdsyFteHH4Plm5Ql04dJLEvYazAruWh0AQTqCDZ1749469243', '255140', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 8, 10, 1),
(350, '25060989V9yPu0taDik7jiAmVI4W9nnN7GiuMlLufEf86rGveWvWGcMC1749469243', '259616', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 9, 1, 1),
(351, '250609oM3nlkhyz5BmRotvCMl7i9p8iiy248fbFa5oFRJ90bPCD7cOn81749469243', '258911', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 9, 2, 1),
(352, '250609ZrVB2eq0w4sJaDdUScKyiG5pj1KtsMTufRvo7QMazk4dadJtpm1749469243', '251982', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 9, 3, 1),
(356, '250609qjh0OyHY64lTd1VC2O2Gci6ChF5y6zukvRU93B6Q8ThjRJqL0G1749469243', '251653', 'actif', NULL, '2025-06-09 13:40:43', NULL, NULL, 9, 10, 1),
(357, '250609ByzlcW3N4Dh6AIInwDFJjVUSK78HzRYDp0Auy6R36HiFf1hZG61749469249', '254398', 'actif', NULL, '2025-06-09 13:40:49', NULL, NULL, 6, 1, 1),
(358, '250609nwD1atGGjBhnoNqOsz9u1B8h7Lt5QSqkA6PBpISJNHVJpdPE9y1749469249', '256365', 'actif', NULL, '2025-06-09 13:40:49', NULL, NULL, 6, 2, 1),
(361, '250609plmVzaD3MiabuSotbrcsIz2N8bShaGTd0sB8cPLZmO41W7FOhP1749469249', '250996', 'actif', NULL, '2025-06-09 13:40:49', NULL, NULL, 6, 4, 1),
(363, '250609rsUNMsMdwGkRPSZLuuwyUc3AVrffMWC5AM8cEYj7iAEKnLZ0Kz1749469249', '250623', 'actif', NULL, '2025-06-09 13:40:49', NULL, NULL, 6, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees_details`
--

CREATE TABLE `fees_details` (
  `feedetail_id` int(11) UNSIGNED NOT NULL,
  `feedetail_token` varchar(75) NOT NULL,
  `feedetail_code` varchar(10) NOT NULL,
  `feedetail_name` varchar(75) DEFAULT NULL,
  `feedetail_subname` varchar(75) DEFAULT NULL,
  `feedetail_status` varchar(25) DEFAULT NULL,
  `feedetail_type` varchar(75) DEFAULT NULL,
  `feedetail_cost_payable` decimal(10,2) DEFAULT NULL,
  `feedetail_notes` text DEFAULT NULL,
  `feedetail_created_at` datetime DEFAULT NULL,
  `feedetail_updated_at` datetime DEFAULT NULL,
  `feedetail_deleted_at` datetime DEFAULT NULL,
  `feedetail_fee_id` int(11) UNSIGNED DEFAULT NULL,
  `feedetail_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_details`
--

INSERT INTO `fees_details` (`feedetail_id`, `feedetail_token`, `feedetail_code`, `feedetail_name`, `feedetail_subname`, `feedetail_status`, `feedetail_type`, `feedetail_cost_payable`, `feedetail_notes`, `feedetail_created_at`, `feedetail_updated_at`, `feedetail_deleted_at`, `feedetail_fee_id`, `feedetail_school_id`) VALUES
(1, '240722mEi28wooCUYk4lnkwJSzchjmD6hliw7DUroU8h6TqoLHgNhzdQ17216576811', '2447421', 'JANVIER', '', 'actif', NULL, 150.00, NULL, '2024-07-22 14:14:41', NULL, NULL, 1, 1),
(2, '240722Bi9oJukhk1WtKo5FPyM9juGvyf9Pv7JvtD8MOpkqzbVJsOdK1n17216576812', '2495972', 'FEVRIER', '', 'actif', NULL, 150.00, NULL, '2024-07-22 14:14:41', NULL, NULL, 1, 1),
(3, '2407221HUElitcYV85IoyHH2NW3hLgCfU8bCgALjqOhWOdRu42skPJWd17216576813', '2473703', 'MARS', '', 'actif', NULL, 140.00, NULL, '2024-07-22 14:14:41', NULL, NULL, 1, 1),
(4, '240722hcsuk7tiYLAc6hzgqGc5a96GaNZlZBHksBtq9AHKrdlVfyNGrF17216576814', '2454184', 'AVRIL', '', 'actif', NULL, 140.00, NULL, '2024-07-22 14:14:41', NULL, NULL, 1, 1),
(5, '240722pOBFDBmWlOMWjZKQUVDk3FRTmF3685MPwOPgY6YEj5w53IqUmB17216576815', '2475005', 'MAI', '', 'actif', NULL, 120.00, NULL, '2024-07-22 14:14:41', NULL, NULL, 1, 1),
(6, '240722LcH3Upzy8IowWn9fLT6gu5Hg5zjOvpBy0Om7L1hh8vMVhSefzD17216577451', '2456931', 'INSCRIPTION', '', 'actif', NULL, 100.00, NULL, '2024-07-22 14:15:45', NULL, NULL, 2, 1),
(7, '240722ysanwarnoeEdBQa3vz9YsHU27pYc81Sc0UF9waTbFhiQQkWUao17216578161', '2410231', 'FIP 1', '', 'actif', NULL, 20000.00, NULL, '2024-07-22 14:16:56', '2024-07-23 09:44:04', NULL, 3, 1),
(8, '240722WLmMRymkoZjiv18SbrdzCtcwfS1FEC3SSUIgL1leqiYIPAFR2Q17216578162', '2406752', 'FIP 2', '', 'actif', NULL, 20000.00, NULL, '2024-07-22 14:16:56', NULL, NULL, 3, 1),
(9, '240722KFTuNbsH5nK68wmPZMnMS8ufjgu0mIf87nK0G4LbVtisZDSVEm17216578163', '2496053', 'FIP 3', '', 'actif', NULL, 15000.00, NULL, '2024-07-22 14:16:56', NULL, NULL, 3, 1),
(10, '240910YmzENWrEHmsrDtN7iy7eJIkdAs4bapUbmDDph3Y839U96EHBHs17259635641', '2450761', 'Frais administratif', '', 'actif', NULL, 30.00, NULL, '2024-09-10 10:19:24', NULL, NULL, 4, 1),
(11, '241025MCtQSfrowf4uW8P2YnaZISeakcVHRlOGSqYcZTKN68er2UMgbb17298605711', '2433741', 'ECUSSON', 'ECSS', 'actif', NULL, 4.50, '1er Annuel', '2024-10-25 14:49:31', NULL, NULL, 5, 1),
(12, '241025VYEObSfa1iB5oZLoQ185T5n8DUHq940T8SoMtWVj6VSAhRe6cd17298605712', '2411622', 'TABLIER', 'TAB', 'actif', NULL, 5.50, '2ème Annuel', '2024-10-25 14:49:31', NULL, NULL, 5, 1),
(13, '241025sFNPBDNQjCq9GaJn5VBDdP51DwnWmhqAzGPKW63bNRAZRcC4Ny17298605713', '2496643', 'PULL D\'UNIFORME', 'PULL', 'actif', NULL, 10.00, '3ème Annuel', '2024-10-25 14:49:31', NULL, NULL, 5, 1),
(14, '241025MpOrplRcvITFGib0uIarzE4yMREyiILQ58AGQGoHHhOgRajPEV17298605714', '2461334', 'ACCESSOIRES', 'ACCESS', 'actif', NULL, 15.00, '4ème Annuel', '2024-10-25 14:49:31', NULL, NULL, 5, 1),
(15, '241025wlRDfuCW1nTFtEnyPuo9MJBQFnw5rypWLTwEzrZ3ahDCisZv3H17298607121', '2486811', '1ERE RECOLLECTION', 'RECO 1', 'actif', NULL, 30000.00, '1ère Tranche', '2024-10-25 14:51:52', NULL, NULL, 6, 1),
(16, '241025vn5EygIEzKbCB2lJN4TQiQIr9N0LRHEsIfcDgflfcBawk5hbr417298607122', '2495122', '2EME RECOLLECTION', 'RECO 2', 'actif', NULL, 20000.00, '2ème Tranche', '2024-10-25 14:51:52', NULL, NULL, 6, 1),
(17, '241025dSnPz4wgMkRyZD8nNPJENpbvoWGQi6PU257wAtHuYunnR8M0GU17298609731', '2495201', 'COURS SUPP', '', 'actif', NULL, 12000.00, 'Jour', '2024-10-25 14:56:13', NULL, NULL, 7, 1),
(18, '241028zPq7bi1A8rlKZEzauRQBmIiAb6vLpwYqEjLJFKG9zY8T7O6tpZ17301040461', '2404941', 'detail fees test', '', 'actif', NULL, 250.00, 'Annuel', '2024-10-28 10:27:26', NULL, NULL, 8, 1),
(19, '250128jn1yWNEDvHi8AhBKQLpVjtMDwjbMM7hVPyTb5Mv3PDtF0OhCQd17380739261', '2534731', 'Frais annuel', 'FAN', 'actif', NULL, 150.00, 'Annuel', '2025-01-28 16:18:46', NULL, NULL, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `finances_banks`
--

CREATE TABLE `finances_banks` (
  `bank_id` int(11) UNSIGNED NOT NULL,
  `bank_token` varchar(75) NOT NULL,
  `bank_code` varchar(10) NOT NULL,
  `bank_name` varchar(75) NOT NULL,
  `bank_phone` varchar(75) NOT NULL,
  `bank_email` varchar(75) NOT NULL,
  `bank_address` varchar(75) NOT NULL,
  `bank_account_number` varchar(75) NOT NULL,
  `bank_account_name` varchar(75) NOT NULL,
  `bank_account_code` varchar(75) NOT NULL,
  `bank_account_currency` varchar(25) DEFAULT NULL,
  `bank_init_amount` decimal(10,2) DEFAULT NULL,
  `bank_credit_amount` decimal(10,2) DEFAULT NULL,
  `bank_debit_amount` decimal(10,2) DEFAULT NULL,
  `bank_balance_amount` decimal(10,2) DEFAULT NULL,
  `bank_status` varchar(25) DEFAULT NULL,
  `bank_account_type` varchar(75) DEFAULT NULL,
  `bank_notes` text DEFAULT NULL,
  `bank_created_at` datetime DEFAULT NULL,
  `bank_updated_at` datetime DEFAULT NULL,
  `bank_deleted_at` datetime DEFAULT NULL,
  `bank_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finances_banks`
--

INSERT INTO `finances_banks` (`bank_id`, `bank_token`, `bank_code`, `bank_name`, `bank_phone`, `bank_email`, `bank_address`, `bank_account_number`, `bank_account_name`, `bank_account_code`, `bank_account_currency`, `bank_init_amount`, `bank_credit_amount`, `bank_debit_amount`, `bank_balance_amount`, `bank_status`, `bank_account_type`, `bank_notes`, `bank_created_at`, `bank_updated_at`, `bank_deleted_at`, `bank_school_id`) VALUES
(1, '240731DyYFi2og4OT5jU8yLWu5KfTLFJTE5Db5s3nGjZ8D7yUfGRbHar1722429779', '243117', 'UBA ORANGE', '+243858533285', 'contact@ditotase.com', '10 AV LOMAMI LUBUMBASHI RDC', '12520152120-55', 'ELIE MWEZ RBZ', '4520', 'cdf', 400000.00, 200000.00, 200000.00, NULL, 'inactif', 'epargne', 'Compte ouvert pour opérations diverses et autres', '2024-07-31 12:42:59', '2024-08-03 09:55:22', NULL, 1),
(2, '240731DoHEVVghf0mWG59aUHaEVDhWPzlKrD2YEHSgsBJKDEYAjr6aK71722431821', '249645', 'ECOBANK', '00243858533285', 'rubuz@ditotase.com', '10, AV LOMAMI, LUBUMBASHI, KATANGA - RDC', '12520152120-68', 'ELIE MWEZ RUBUZ', '4520', 'cdf', 0.00, 30000.00, 0.00, 30000.00, 'actif', 'epargne', 'Compte ouvert pour opérations diverses et perception de frais scolaires', '2024-07-31 13:17:01', '2025-11-29 12:20:14', NULL, 1),
(3, '2407312Q7kfa3jabBHHgdWKhysSWKcGV6RvAzYUq2F6LP808n5NlS1qD1722431988', '245391', 'UBA', '0858533285', 'contact@ditotase.com', '10 LOMAMI LUBUMBASHI KATANGA RDC', '12520152120-50', 'ELIE MWEZ', '4520', 'usd', 1400.00, 400.00, 1000.00, NULL, 'actif', 'courant', 'Compte ouvert pour opérations diverses', '2024-07-31 13:19:48', '2024-08-03 10:16:53', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `finances_cashbox`
--

CREATE TABLE `finances_cashbox` (
  `cashbox_id` int(11) UNSIGNED NOT NULL,
  `cashbox_token` varchar(75) NOT NULL,
  `cashbox_code` varchar(10) NOT NULL,
  `cashbox_name` varchar(75) DEFAULT NULL,
  `cashbox_currency` varchar(25) DEFAULT NULL,
  `cashbox_credit_amount` decimal(10,2) DEFAULT NULL,
  `cashbox_debit_amount` decimal(10,2) DEFAULT NULL,
  `cashbox_balance_amount` decimal(10,2) DEFAULT NULL,
  `cashbox_status` varchar(25) DEFAULT NULL,
  `cashbox_notes` text DEFAULT NULL,
  `cashbox_created_at` datetime DEFAULT NULL,
  `cashbox_updated_at` datetime DEFAULT NULL,
  `cashbox_deleted_at` datetime DEFAULT NULL,
  `cashbox_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finances_cashbox`
--

INSERT INTO `finances_cashbox` (`cashbox_id`, `cashbox_token`, `cashbox_code`, `cashbox_name`, `cashbox_currency`, `cashbox_credit_amount`, `cashbox_debit_amount`, `cashbox_balance_amount`, `cashbox_status`, `cashbox_notes`, `cashbox_created_at`, `cashbox_updated_at`, `cashbox_deleted_at`, `cashbox_school_id`) VALUES
(1, '240809HYs7kScJIdfiFEcz7UDZqnwaBHPtALPMEVarlivD3EMlvvQV511723215525', '249103', 'Dollars Américains(USD)', 'usd', 7914.92, 2590.00, 5074.92, 'actif', NULL, '2024-08-09 14:58:45', '2025-12-06 17:21:18', NULL, 1),
(2, '240816WR9zw6uKqGTNTiJgAAoEq4nS8Rg90GyNryZAROFziM4WOJ8Ekv1723815649', '249210', 'Francs Congolais(CDF)', 'cdf', 325000.00, 190000.00, 135000.00, 'actif', NULL, '2024-08-16 13:40:49', '2025-11-29 12:20:14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `finances_expenses`
--

CREATE TABLE `finances_expenses` (
  `expense_id` int(11) UNSIGNED NOT NULL,
  `expense_token` varchar(75) NOT NULL,
  `expense_code` varchar(10) NOT NULL,
  `expense_date` date DEFAULT NULL,
  `expense_requested_by` varchar(75) DEFAULT NULL,
  `expense_approved_by` varchar(75) DEFAULT NULL,
  `expense_type` varchar(25) DEFAULT NULL,
  `expense_category` varchar(25) DEFAULT NULL,
  `expense_usd_amount` decimal(10,2) DEFAULT NULL,
  `expense_cdf_amount` decimal(10,2) DEFAULT NULL,
  `expense_exchange` decimal(10,2) DEFAULT NULL,
  `expense_status` varchar(25) DEFAULT NULL,
  `expense_notes` text DEFAULT NULL,
  `expense_created_at` datetime DEFAULT NULL,
  `expense_updated_at` datetime DEFAULT NULL,
  `expense_deleted_at` datetime DEFAULT NULL,
  `expense_user_id` int(11) UNSIGNED DEFAULT NULL,
  `expense_cashbox_id` int(11) UNSIGNED DEFAULT NULL,
  `expense_year_id` int(11) UNSIGNED DEFAULT NULL,
  `expense_school_id` int(11) UNSIGNED DEFAULT NULL,
  `expense_section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finances_expenses`
--

INSERT INTO `finances_expenses` (`expense_id`, `expense_token`, `expense_code`, `expense_date`, `expense_requested_by`, `expense_approved_by`, `expense_type`, `expense_category`, `expense_usd_amount`, `expense_cdf_amount`, `expense_exchange`, `expense_status`, `expense_notes`, `expense_created_at`, `expense_updated_at`, `expense_deleted_at`, `expense_user_id`, `expense_cashbox_id`, `expense_year_id`, `expense_school_id`, `expense_section_id`) VALUES
(21, '241025pyR77DcATHC8zd4CLuLj70kqE5sROZYei5TNZS81gcWy6ZppOL1729859086', '249861', '2024-10-25', 'COM', 'COM', 'expense', 'outgoing', 300.00, 0.00, 2840.00, 'actif', 'RAPPORT', '2024-10-25 14:24:46', NULL, NULL, 1, 2, 2, 1, 2),
(24, '241025qusd1GwWS26rAgFghcHeZUDdewFCdwMFchZEnL07ic3GTnnqar1729859156', '246814', '2024-10-25', 'COM', 'COM', 'expense', 'outgoing', 120.00, 0.00, 2840.00, 'actif', 'REMISE ZERO', '2024-10-25 14:25:56', NULL, NULL, 1, 4, 2, 1, 2),
(25, '2410251acHETkIL7bJ0bevNOQsIj94Wn256pAg7g8YmN8chM94JSeOi51729859179', '240322', '2024-10-25', 'COM', 'COM', 'expense', 'outgoing', 2070.00, 0.00, 2840.00, 'actif', 'RAPPORT', '2024-10-25 14:26:19', NULL, NULL, 1, 1, 2, 1, 2),
(26, '241025l0j6lnheIVT8YjSU3eET5ZMvcRLnispFdCW1eHU9ROYnPC5IBU1729860189', '247026', '2024-10-25', 'com', 'com', 'expense', 'outgoing', 0.00, 190000.00, 2840.00, 'actif', 'Transport', '2024-10-25 14:43:09', NULL, NULL, 1, 3, 2, 1, 1),
(27, '250606nArEGSj9uyDDPqHMil2zmTJUoAZMomuuFYJew95iaZBATYsTRW1749220310', '253287', '2025-06-06', 'elie', 'elie', 'expense', 'outgoing', 100.00, 0.00, 2840.00, 'actif', 'transport', '2025-06-06 16:31:50', NULL, NULL, 7, 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `finances_transactions`
--

CREATE TABLE `finances_transactions` (
  `transaction_id` int(11) UNSIGNED NOT NULL,
  `transaction_token` varchar(75) NOT NULL,
  `transaction_code` varchar(10) NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `transaction_type` varchar(75) DEFAULT NULL,
  `transaction_currency` varchar(25) DEFAULT NULL,
  `transaction_amount` decimal(10,2) DEFAULT NULL,
  `transaction_exchange` decimal(10,2) DEFAULT NULL,
  `transaction_status` varchar(25) DEFAULT NULL,
  `transaction_attachment` varchar(150) DEFAULT NULL,
  `transaction_notes` text DEFAULT NULL,
  `transaction_created_at` datetime DEFAULT NULL,
  `transaction_updated_at` datetime DEFAULT NULL,
  `transaction_deleted_at` datetime DEFAULT NULL,
  `transaction_user_id` int(11) UNSIGNED DEFAULT NULL,
  `transaction_cashbox_id` int(11) UNSIGNED DEFAULT NULL,
  `transaction_bank_id` int(11) UNSIGNED DEFAULT NULL,
  `transaction_year_id` int(11) UNSIGNED DEFAULT NULL,
  `transaction_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finances_transactions`
--

INSERT INTO `finances_transactions` (`transaction_id`, `transaction_token`, `transaction_code`, `transaction_date`, `transaction_type`, `transaction_currency`, `transaction_amount`, `transaction_exchange`, `transaction_status`, `transaction_attachment`, `transaction_notes`, `transaction_created_at`, `transaction_updated_at`, `transaction_deleted_at`, `transaction_user_id`, `transaction_cashbox_id`, `transaction_bank_id`, `transaction_year_id`, `transaction_school_id`) VALUES
(1, '251129Gg3pL5ZZ2SgpyMFUwUgwWKgRwjsmpReB4EgU6tDqitG35kz7sK1764410957', '251732', NULL, 'cashbox', 'usd', 2000.00, 2840.00, 'actif', '1764410957_494c0062a7ac62b85158.pdf', '', '2025-11-29 12:09:17', NULL, NULL, 7, 1, 3, 2, 1),
(2, '251129elNnLUB0kmdYjtSU2OYv3IABLarIWzoBOTpAQ8vHRpjHQ0h3Lz1764411614', '259178', NULL, 'cashbox', 'cdf', 30000.00, 2840.00, 'actif', '1764410957_494c0062a7ac62b85158.pdf', '', '2025-11-29 12:20:14', NULL, NULL, 7, 2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `message_token` varchar(75) DEFAULT NULL,
  `message_code` varchar(10) DEFAULT NULL,
  `message_sender` varchar(75) DEFAULT NULL,
  `message_recipient` varchar(75) DEFAULT NULL,
  `message_status` varchar(25) DEFAULT NULL,
  `message_type` varchar(25) DEFAULT NULL,
  `message_category` varchar(25) DEFAULT NULL,
  `message_subject` varchar(100) DEFAULT NULL,
  `message_emergency` tinyint(1) NOT NULL DEFAULT 1,
  `message_body` text DEFAULT NULL,
  `message_attachment` varchar(100) DEFAULT NULL,
  `message_created_at` datetime DEFAULT NULL,
  `message_updated_at` datetime DEFAULT NULL,
  `message_deleted_at` datetime DEFAULT NULL,
  `message_school_id` int(11) UNSIGNED DEFAULT NULL,
  `message_section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message_token`, `message_code`, `message_sender`, `message_recipient`, `message_status`, `message_type`, `message_category`, `message_subject`, `message_emergency`, `message_body`, `message_attachment`, `message_created_at`, `message_updated_at`, `message_deleted_at`, `message_school_id`, `message_section_id`) VALUES
(1, '240814rCMvNWAmNNvyPpmISioUdtcrJJ484OfdSPWOok0khIvUWhmGvr1723645772', '244669', 'contact@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'parent', 'Eduschool Email sending v2', 1, 'Bonjour cher parent. Les inscriptions sont encours au sein de notre ecole', NULL, '2024-08-14 14:29:32', '2024-08-15 09:35:02', NULL, 1, NULL),
(2, '240814kCD2yKoGJrWOGwN3iZL46cenMy4rlEJFo1prm7RdcLFa0AkDJ11723646306', '248581', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'parent', 'Test 2 email avec attache', 1, 'Bonjour cher parent. Ceci est un test de notre email avec recu de paiement', '1723646306_b756348731ff045b72e4.pdf', '2024-08-14 14:38:26', NULL, NULL, 1, NULL),
(3, '240814rStPlCwIORrpIIQZgn6hnZ02N3RbYmfYQUgPlrZTUDOD3oUAgA1723648823', '242748', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'send', 'email', 'parent', 'Lorem Ipsum on Eduschool Application', 1, '<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p></div><div><p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div><p></p>\r\n<p><img style=\"width: 25%; float: left;\" src=\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAH0AfQDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9U6KKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAoooo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\" data-filename=\"ditotase.jpg\" class=\"note-float-left\">It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n</div>\r\n</div><p></p>', '1723648823_d3f0aab0ccb9af946f3e.pdf', '2024-08-14 15:20:23', NULL, NULL, 1, NULL);
INSERT INTO `messages` (`message_id`, `message_token`, `message_code`, `message_sender`, `message_recipient`, `message_status`, `message_type`, `message_category`, `message_subject`, `message_emergency`, `message_body`, `message_attachment`, `message_created_at`, `message_updated_at`, `message_deleted_at`, `message_school_id`, `message_section_id`) VALUES
(4, '240814YhKWl5hgdsKv9Pg2ck4mH4ikKmJwPCIDeY3Umfw7E0CkhlOKeo1723649401', '246899', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'send', 'email', 'parent', 'What is Lorem Ipsum', 1, '<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p></div><div><p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div><p></p>\r\n<p><img style=\"width: 25%; float: left;\" src=\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAH0AfQDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9U6KKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAoooo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\" data-filename=\"ditotase.jpg\" class=\"note-float-left\">It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n</div>\r\n</div><p><br></p><p></p>', '1723649401_9c4b29b74d8fd45f58d8.pdf', '2024-08-14 15:30:01', NULL, NULL, 1, NULL);
INSERT INTO `messages` (`message_id`, `message_token`, `message_code`, `message_sender`, `message_recipient`, `message_status`, `message_type`, `message_category`, `message_subject`, `message_emergency`, `message_body`, `message_attachment`, `message_created_at`, `message_updated_at`, `message_deleted_at`, `message_school_id`, `message_section_id`) VALUES
(5, '240814TiCenyTukrWf4pdFkKAHrvoyuk22uefbrekhprFG7pfuuAK8IR1723649416', '247044', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'parent', 'What is Lorem Ipsum', 1, '<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p></div><div><p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div><p></p>\r\n<p><img style=\"width: 25%; float: left;\" src=\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAH0AfQDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9U6KKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiqWpazZaRF5l5cxwL/ttyfoKALtFfKPxs/4KRfCL4PtPaf20uu6tFuBsNJxcyhgcFW2nYjD0kZTXw58XP+CvvjrxO01r4L0G10G0JZVutQczSsvZhGm1Ub2LSCvSoZdicRrGOnd6EOcUfsHf65p+mLuuryGAejOM/lXlHj79rz4UfDZ5Ytc8ZaVZXca7jazXcaTEeojJ3H8Aa/Bzx9+0r8Ufif5y+I/HGr3sEybJbWKb7NbyL/tRRBUb8VrzSvbpZC96s/u/zf8AkZOr2R+03jL/AIK9fCDQR/xKF1PxDk4AsbF1I9z5/lD8jXi3ij/gtHcfaWTQfAM1xbEcTXl+ls4P+4sco/8AHq/MKivShk2Ejum/V/5WIdSR92+If+Cv/wAWr6f/AIlOi6HYW/dLzzrhv++keMfpXHar/wAFSvjhqYIS60axJ729rKcf99ytXyHRXXHLsJHamieeXc+mrr/go98fLjOzxilv/wBc7CA/+hKarW//AAUU/aAgbL+PHnHpJp9qP/QYxXzdRWn1LDf8+4/chc0u59V6d/wU0+Oli4aTXLC9A/hns8D/AMcZa6rT/wDgrX8bLIoGtfDcyg/NutrnJH1+0Y/SviqioeAwr3pr7h88u5+jOh/8FnPFtlGo1HwJbX0n8TRap5S/98mBj+teveE/+CzHge8MEWu+Gda0+V+HkSCOSGP/AIEsm4/glfkRRXNPKMHLaNvRsaqSP3w8C/8ABSH4G+NyUTxlY6dIuNw1JmsgD6AzhN3/AAHNe/aB8SPDXie1iuNN1i1uYZRmORZBtceoPQ1/MjWx4Y8Z6/4KvWvPD2ualoV242tPpt3Jbuw9CUIJHtXnVMhg/wCFNr11/wAi1VfVH9PKSLIoZGDqe6nIp1fgr8MP+ClPxq+HU8S3Ws2/ieyXavk6lAFcKOu2SLaSxHdw/wBK+0vg/wD8FhvBmvtBaeONHvPDFw2d1wB9qthzx88YD5PvGAPWvGrZTiqOqjzLy/y3NVUiz9GKK4T4ffG7wV8UNKi1Dw54hsNTtZDtEttcJKm7uu5SRkdxnIrugQwBByD3FeQ04uzNBaKKKQBRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRUN1dw2MDzXEqwxKMl3OAKAJqyPEfi3SfCdhNearfQ2cESGR2kcDaoGSTnoAO5r5D/ap/wCClvgj4GyXeh6GT4m8VR5U2Vm4CwNz/rpMER9D8uGfp8oBzX5N/HX9qf4iftDanLN4p1uQaaX3x6PZs0dpHjoSuSXIPO5yxGTjA4r2cJldbFe8/dj3f6IzlUUT9Kf2iP8AgrX4R8Fy3Ok+ALU+LdSTKG6hkCWaHkZ87B344PyAqR/GK/N/4z/tefFL47T3C+I/Es8GmTZB0nTS1valTjKsAS0g4z+8ZsZOMV41RX1+Gy7D4bWMbvu/60OaU3IKKKK9MgKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigDZ8J+NNe8B6umqeHNZvtE1BOBcWE7RORkHaSp5U4GVOQe4r7g+Af/BWnxv4Ga30/x9p6+J9NXCtf2KrFdAc5Jj4jc9AApjx15r4Gorkr4WjiVarG/wCf3lKTjsf0U/Az9rn4c/H3Shc+G9ftp7hVBmtWbZNCScfPG2GXnIBIwccEivaVYOoZSGU8gjvX8veh69qXhnVbfU9H1C60rUrdt0N3ZTNFLGcYyrqQRwSOPWv0A/Zf/wCCsGv+DHtdE+J8B1fTchBrVpGBKgz1liGAwGeWjwQF+4xOa+UxeS1KfvUHzLt1/wCCdEaqe5+wtFcT8L/jF4U+MHhy01rwxq9rqdlcruR4JAwPqPqDwQeQeCARXbV8204uzNgooopAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFfOX7WH7aXg79mXw3I97ci+16dSLPS7ZgZp26cD+FQernge7EKdKdOVWShBXbE3bVnq3xV+MXhb4N+GLzXfE+q22m2Vqm93nfaB6D1JJ4CjJJIABJAr8f/ANrT/gph4u+MV7d6J4FuLnwx4XBKfbUOy8uh3wR/qVPt85xyy5KV86/H/wDaO8ZftGeLJNY8UX7fZUYmz0uFj9ntVP8AdH8Tnu55PThQFHltfa4HKYULVK2svwX+ZzSqN6ICSSSTknuaKKK+iMQooooAKKKKACiiigAooooAKKKKACiiigAr+ib9mTwtpWqfAXwPPdWUc0x0m1Bds5wIUxX87Nf0d/sqf8m++Bv+wVbf+ikr5XPvgp+rN6W7NDxn+zt8PPiBb+Tr/hbTdWjHKre2yTqp9QHBGa+aviV/wSc+D/jETS6Pa3fhm7kbeZdMuWQE+gR98aj2VBX27RXy1PEVqP8ADm18zoaT3Pxt+Jf/AAR88f8Ah9pJvCfiOw1uAMzeVqEL27qvYBk8wOfchB9K+Y/Gn7HPxm8BH/iafD/VpU3EBtNRb3gdyIS5Uf7wFf0XVXudPtr1Ss9vFMD1DoDXr0s6xMNJ2l/XkZOlFn8vd7Y3Om3ctreW8trcxNtkhnQo6H0KnkGoK/pL+IX7PHw/+KGnfYvEXhnT9SgGSi3NukojJGNyhgdp56jBr4p+NX/BHvwjrUE954A1W78OXmMpaOxurY4z1VzvyfUSYH9017FHO6M9KsXH8V/n+Bm6TWx+RVFezfGz9kP4ofASSeTxL4dkm0qE86vp2Z7UDjljgNGMnGZFXJ6Zrxmvfp1IVY81N3Rk01uFFFFaiPQfg18evGvwF8RLq/g/WJLFmZTcWUhL210AekkeRnuNwwwBOGGa/Yb9j/8A4KLeE/j9bW2h626eH/GCrhrC4kBE2BktC3HmDGSRwy4ORgbj+HFS2t1NY3UNzbTSW9xC4kimiYq6MDkMpHIIIyCK8vGZfSxiu9Jd/wDPuaRm4n9RcUqTxrJG4dGGQynIIp9fkx+xL/wU9uNDex8HfFe88y3JENt4ilOF9FFyeint5vQ8F8YZz+rGi63Z+INPivbGdZ4JACGU5r4PE4WrhJ8lRfPozqjJSV0X6KKK5CgooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKQkKCScAdSaCQoJJwB1Jr4Y/b7/b7sfgZpUvhPwnLFf+M7yM4GdyWaHjzZP/AGVO/U8dd6NGeImqdNXbE2krs2P24/2/dF/Z70mXQNAaLWPGd1EfJtA3yQg8CWYg5VPQDDPjAwMsv4t+OvHmvfErxRe+IfEupzatq9426W4mP5KoHCqOgUAADoKoeIPEOpeK9bvdY1i9m1HU72UzXF1cNueRz1JP+cdKz6/QcFgaeDhprJ7v+uhxym5BRRRXpkBRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAV/R3+yp/yb74G/7BVt/6KSv5xK/o7/ZU/wCTffA3/YKtv/RSV8rn3wU/Vm9LdnrFFFFfHHSFFFFABRRRQBn6xoNhr9q9vf20dxGwIO4c/nXwL+1B/wAEpfCnjqK81z4etH4V1wgv9lhT/QpmxwGiH3OgG6PGMklHNfoVRXRQxFXDy5qUrMTSe5/M/wDFX4PeLvgr4ml0Lxfo8+lXik+VIwzDcKP44nHDjkdORnBAORXGV/SV8Z/gB4N+Onhi50bxRo1tqEEoyDKnKtggMrDDKwycMpDDJwea/GH9r39gXxb+zbf3OraXHceIPBW4sLxU3T2a9hMFGCv/AE0UAcfMEyuftcDmsMTanU92X4P+uxyypuOqPlOiiiveMgr7J/Yk/wCCget/s+alZ+GvFVxPqngZ2EaSHMkumjsVHV4h3QcqOVzjY3xtRXPXoU8TB06iuhpuLuj+nPwP450j4heHrPWdFvYb6yuolljlgkDqysMhgw4IIOQR1roK/BP9in9t7XP2ZfEVvpWpzTah4FuZf31tks1kWPzSRDupJyyd+SMHO79yPAHj7RviT4Zsdc0O9hvrG7iWaOWBwysrDIII6g1+e43BTwc7S1T2f9dTsjJSR0lFFFecWFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUV86/tn/tXaN+zL8Nrq/ldbnXLoGDT9PVsPPKRwPZR1Zuw9WKg6U6cqslCCu2Ju2rPO/wBvz9uGw/Z58LtoOgyxX3jPUo2FtbZyIV5BmkA6ICCAP42BA4DFfxK8Q+IdS8Wa5faxrF7NqOqXsrTXF1O255HPUn/DoOgrQ8fePNb+Jvi/U/E3iK9e/wBX1CUyzSt0HYKo7KoAAHYACufr9EwOChg6dt5Pd/10OOcuZhRRRXpkBRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFf0d/sqf8m++Bv+wVbf8AopK/nEr+jv8AZU/5N98Df9gq2/8ARSV8rn3wU/Vm9LdnrFFFFfHHSFFFFABRRRQAVDBdxXMtxHG4Z7eQRSgfwsVVsf8AfLKfxqavKPg94s/t/wAcfEi2L7lh1RXj56qFMOR+EK/mK87EYyOHr0KD3qNpfKLl+h6GHwkq9CtXW1NJ/fJL9T1eqGtaHZeIbCWzvoEnhkUqQwz1q/RXonnn5Cft0/8ABNa88GXN942+F+ntc6U5aa78P2qZMfctbKO3fyh0/g4wg/Oev6jbu0hv7d4LiNZYnGGVhkGvy/8A+ChX/BOx7+a/+I3w2sN2osWn1PR7df8Aj87tLEo/5bdyv/LTqPnz5n1mW5rtRxD9H/n/AJnPOn1R+WVFK6NG7KylWU4KkYINJX15zhX1n+wr+23qn7Nniq30PW7mW58B3s2JFbLHTnY8yoOpjJ5dB/vLzlX+TKKwr0IYim6dRXTGm07o/p88K+KNP8Y6HaarplzFdWlzGsiSQuHVgRkEEcEEEEEcEGtevxk/4Jt/tu3Pwu8R2Pw48W3hfw1fSCLTLuZ+LSVjxCxP8DE/Kf4WOPutlP2UsryHULWK4gcSRSKGVh3FfnGLws8JVdOW3R90dsZKSuT0UUVxFBRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRUV1cx2dvJPMwSKNSzMewFAHH/F74paL8HvAeq+JtcvI7KysYGmeSQ9AB6dSegAHJJAGSQK/n2/aT/aC139o/4mX3ifVpJI7MM0WnWBbK2sGcge7t1Zu54GFCgfR3/BTX9rW4+LnxCuPAOh3bDwzoc+29MbfLdXSnGw+qx8jHGX3ZB2Ka+HK+5yjA+xh7eovee3kv+CctSd3ZBRRRX0RiFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFf0d/sqf8m++Bv8AsFW3/opK/nEr+jv9lT/k33wN/wBgq2/9FJXyuffBT9Wb0t2esUUUV8cdIUUUUAFFFFAFfUb1NN0+5u5eIreJpW+igk/yr5S/ZZ1+T/hZ2oxTvltStJWPvIHV8/lvr37416t/Yvwq8S3G7aXtDbg+8hEf/s9fJHwR1b+xvit4anLbQ90Lc/8AbQGP/wBmr8m4pzD6vnuXQvpF3fpKSj+SZ+pcNYD6xkmYTtrJWXrFOX5tH3dRRRX6yfloVFc20V3A8MyLJE4wysMgipaKAPy0/wCCjn/BP+S5lvviZ8PNPL3pzNquk2yc3Y6tNGo/5ajqy/8ALQcj5xiT8t6/qMvLOHULWS3uIxLDINrK3evyC/4KVfsNSeAdTvfiZ4KsC2izsZtYsYE/1LE5NyoH8P8AfA6ff6Fyv1uVZlth6z9H+n+Rz1IdUfnhRRRX1xzhX6+/8ExP20pPiFo3/CuvGGoGXxHpsQNrdXDZa9txgBi3eROA2eWBVvmO8j8gq2vBXjLV/h74r0vxHoV29jq2mzrPbzJ2I6gjurAlSp4IJB4NefjcJHGUnB79H5lxlyu5/TwDkUteGfsg/tGaZ+0d8I9K1+1dY78J5N5ab9zW86gb4yfYkEE4JVlbA3V7nX5vOEqcnCSs0di1CiiioGFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAV8Z/wDBSb9qhvgR8Km0jRLoR+Ktc3WtkVPzQ8DzJsf7CkY6/O8eQRmvrfxR4gtvC+g3mp3UiRQ28ZctIwVRgdyegr+eL9q/483f7RHxn1nxM8ztpUbm00uJsjbbKx2tggEFyS5B5G7bnCivZyvCfWq15L3Y6v8ARGdSXKjx9mLsWYlmJySTkk0lFFfoRxhRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAV/R3+yp/yb74G/7BVt/6KSv5xK/o7/ZU/wCTffA3/YKtv/RSV8rn3wU/Vm9LdnrFFFFfHHSFFFFABRRRQB4r+1hq32L4c21mrYa9vkUj1RVZj+oWvkzTb59M1G1vIv8AWW8qTL9VII/lX0B+2Dq3map4c0wN/qoZbll9d7BV/wDQG/Ovnav5j42xTq55U5X8Cil8lf8ANs/o/g7DKlktPmXxuTf32/JI/SG2uEu7aKeI7o5UDqfUEZFS1yHwi1b+2/hl4aut25vsUcTN6sg2H9VNdfX9JYWusTQp11tJJ/ern884mi8PXnRe8W19zsFFFFdRzBWb4i8P2XifSLnTb+BLi2nQoySKGBBGOh61pUUAfgr+3x+yDcfs0/EJtQ0m3kPgrWJmNo2CVs5jljAW/ukAsmecBhyULH5Wr+kr4/fBTQ/jv8ONW8Ma3aieC7hKArgOp6qykg4ZWAYHBwQOD0r+e741/CLWfgb8SdY8H62jG4spP3NzsKLdQn7kqjngjqMnDBlJypr73Ksd9Zh7Oo/eX4r+tzkqQ5XdHDUUUV7xkfT37AX7Tdx+z18ZLOC+u/K8Ka7IlrfCRgI4JM4jnJPQAnaxyBtYk52LX716ZqEWq2EF3A26OVQw9vav5dq/a3/glx+0zJ8W/hR/wi2tXZm8Q+HdlpI8jEvNFg+TKSepZVZTySWjZj94V8lneE2xMF5P9H+n3HRSl9k+5qKKK+ROgKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiqer6imk6Zc3cn3YULY9T2FAHwL/AMFZ/wBol/Avwyg8B6VcFNU8SF7eYoeUtVA8/wD76DLHg9RI5HK1+OVe2ftj/GmT46/H/wASa+lwLjS7aU6dpzKwZTbxM3zqR1DuXkHs4HavE6/R8uw31bDxi93q/wCvI4py5mFFFFeoQFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABX9Fv7Ndjcah+zl4HjtdQm0yf+yrYrPCiPj9ynBV1II/X0Ir+dKv6O/wBlT/k33wN/2Crb/wBFJXyfEEVOlCL638vxWp1YeThLmX+f5mb4t8UfFj4fb5zYaZ4q0peTc21s6zKPVkVuPqAw965fTf2wxkLqHhgj1e2u/wD2Vk/rX0lXnvj/AOBnhfx/5k89p/Z+pNz9usgEcn1cdH/EZ9xX4rmOV5zRvVynFv8AwTtL7pNN/f8AefeYDMsorWp5phV/iheP3xTS+77jmtN/au8G3mBcwanYN3MsCuv5qxP6V1Wm/HbwHquPK8SWsRPa5V4cf99gV8zeP/2efFHgjzLiGD+2tMXn7TZqSyj1ePqPqMgeteX1+e1uM8/yqr7HH0Y384tX9GnZ+quj7ylwhkeZ0/bYGtK3k07eqauvR2P0U03xNo+s4/s/VbK+z0+zXCSZ/ImtKvzZrZ03xnr+jY+wa3qNmB0EF06D8ga9Gh4kravhvmpfo1+pwVvD170MT98f1T/Q7z9prVv7T+LN/EDuWyghtgf+A7z+rmvKqtalqd1rF/Ne31xJdXczbpJpTlnPqTVWvyLMsX9fxtbFWtzyb9E3ovkj9Vy/C/UcHSw2/JFL5pav5s+xP2VtW+3/AAw+ylvmsb2WED0DYk/m5r2CSRIkLuwRB1ZjgCvzz0fxhrnh60mttL1e902CZg8iWk7RbjjGTtIqlfatfao++9vLi7b+9PKzn9TX6fl3HsMvwFHC+wc5QilfmstNuj6H5tj+B54/HVcT7dRjN3ta7136rqffOpfEXwto+ReeItMgYdUa7Td/3yDmuU1L9o7wDp2QNYa8cfw21tI36lQP1r4mq9o+iah4hv47LTLOe+u3+7FAhZvrx0HvWVTxDzKtLkw1CKb2+KT/AAa/I1p8BZfRjz4itJpekV+Kf5n1DqX7XfhyDIsdH1K7I7zeXEp/JmP6VhQftSeJPE1+tl4c8IRzXb/diaR7g/UhQuB79KreAP2T7m58u78WXn2WPg/2fZsGkPs8nQfRc/UV9C+GfCOjeDrAWejadBYQcbhEvzOfVmPLH3JNfWZdR4qzS1TGV/YU30UY8z+Vnb5u/kfL4+twzlt6eEo+3n3cpcq+d9fkreZyvhLTviHq2y78T6tZ6NGef7P0q3R3+jSPvA+i5+or5S/4KdfslL8W/h2fGPh+z3+KdBjaVBGhL3UOMyQ8cknG5evzDAxvJr7vqtqVhFqljPazruilUqRX6dl1N5a4ypzlJrrKTbf6K/ZJI/PcViHi5czhGK7RSSX6v5ts/l1or6Y/b+/Z1k/Z/wDjnfCzthD4c15pL6wCKFSJ8jzoQB0CsysABgLIg5wa+Z6/WqNWNenGpDZnjNWdgr2r9kD45z/AD46aD4hNx5Ok3EgsdTycKLd2GXPB+4wV+OSEI7mvFaKdSnGrB05bME7O5/ULomqx61pVtexEFJkDcdj3FXq+MP8Agl58eH+LHwFs9I1Ccy6x4fP9mzFz8zrGq+W/Uk5jKZY9WV6+z6/L61KVCpKnLdHcndXCiiisRhRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABXyz/wUY+Np+DX7OuuS2tx5Gr6mn2CxKvtfzpcqGU/3kXfIP+uVfU1fjr/wWB+Lh8R/E7w94JtZmNrpcDX9yqsCjSOTHECOoZQkp+kwr0cvofWMTCD23fyIm7RufntRRRX6UcQUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABX9Hf7Kn/Jvvgb/ALBVt/6KSv5xK/o7/ZU/5N98Df8AYKtv/RSV8rn3wU/Vm9LdnrFFFFfHHSFed+P/AIE+FvH3mTy2v9m6m3P26yARmPq69H/Hn3FeiUVxYvBYbH0nRxVNTi+jX9WfmjswuMxGCqKrhpuMu6/rX0Z8T+P/ANnzxR4H8y4jg/tnTFyftVkpLKPV4+q/UZHvXmNfpNXxn+0tqmjXnxCktNJsba3ks02XlzAgUzzHk7scHaMDPXO7PQV+D8WcJ4TJ6P1zDVLJtLkeur7PyXf7z9t4X4oxWbVvqmJp3aV+Zabd15+X3HktFFFflJ+nhV3R9Fv/ABBfx2Wm2c19dyfdhgQu3146D3qlX2d+zZqmjap8O4P7OsbaxvrZvs98IUAaRwOJGPU7hg898gdK+p4cyaGeYz6rOryaX2u3boul/wCrM+a4gzeeS4T6zCnz623slfq/L+rnnPgD9k+6uvLu/Fl39kj4P9n2bBpD7O/IH0XP1FfQ3hjwho3g2wFno2nQWEHG7y1+Zz6sx5Y+5JrYor+kMqyDL8nj/stP3v5nrJ/Pp6Ky8j+e8zz3H5tL/aanu/yrSK+XX1d2FFFFfRHgBRRRQB8gf8FLf2fz8ZfgLqF5p9sZtd0T/iYWYRSXdowd0YAGSXQuoXuxT0r8K6/qG1rTk1bSrq0cZEsZX6HtX86X7VXwrb4N/Hvxf4aSAW9gl21zYoqFUFvL86IueoTcY8+sZr6/I8RdSoP1X6nPVXU8mooor6w5z7A/4Jf/ABmb4YftEw6NPKU03xND9mYZAUTxBniYk/7JmQAdWkWv3RRxIiupyrDIPtX8wPhfxFeeEPE2ka7p7Kl/pd3De27OMgSRuHXI7jKiv6SPgp45s/iP8MPDviGwkMlpfWcVxEzcMUdAyEjsdrDivis8octWNZfa/Nf8D8jppPSx3FFFFfMm4UUUUAFFFFABRRRQAUUUUAFFFFABRRRQBS1m+XTNJu7puBFEzfpX85P7T/j4/E39oDx14hEiTQz6lJBBLGcrJDDiGNx/vJGrfjX7x/tZ+PW+G3wC8Y69E6pdWenTzQbzgNIsbMin6sFH41/OZX1mQ0tZ1X6fq/0Oeq9kFFFFfXnOFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAV/R3+yp/yb74G/wCwVbf+ikr+cSv6O/2VP+TffA3/AGCrb/0UlfK598FP1ZvS3Z6xRRRXxx0hRRRQByfxR8cRfD3wVqGrsVNyq+Vaxt/HM3Cj3A5J9lNfBVzcy3lzLcTyNLNK5kkkY5LMTkk+5NexftO/EH/hJ/GC6JaybtP0glG2nh5z98/8B4X2Ib1ryDT9PudWvoLOzgkubqdwkcMS5Z2PQAV/NHGmbPNcy+rUXeFL3VbrLq/v0Xp5n9FcH5Ussy/6xV0nU9536R6L7tX6+Q20tJr+5itraJ57iVgkcUalmdjwAAOprvfHPwO8SeAvD9lq99Ek1vKo+0CA7jaOTwr/AKfMOM8ehP0R8EvgZbfDy1TVNUVLrxFKvLdUtQeqp/terfgOM59WurWG9tpbe4iSeCVSkkUihldSMEEHqK+lyrgD22BlPHScasl7qX2f8Xdvqui89vncz469jjIwwUVKlF+8/wCb07JdH1flv+b1em/s/fED/hBfHcEdxLs0vUsWtzk/KpJ+Rz9GOM+jNW38cvgNN4Hml1rQ43n0B2zJEMs9oT2Pqnoe3Q+p8Xr84nRx3DWZRdRctSm7rs15PqmtPw3P0GFXB8RZfJU3eE1Z90/Ps09fx2P0morzX4A/EH/hPPAluLiXfqmnYtbrJ+ZsD5HP+8vf1DV6VX9V4HGUsww1PFUX7s1df5eq2fmfzHjcJUwOInhqq96Lt/wfnugoooruOIKKKKACvyI/4LI/DT+zPHXhLxlBbtsu4pdOuZh90YPmwrj1Ja4P4V+u9fGX/BVL4Znx1+zPqmoQW5nvNDkTUogDjaIz+8Y/SFpq9LLqvscVCXnb79CJq8WfhzRRRX6ScQV+1v8AwSU+Jf8Awl37O0ehzSO9zoV1NYkyNksoIkTH+yEmRB/uV+KVfoR/wRy8ejR/i14r8MSO+NSsob1AT8iiJzG/HqTPH/3z7V4ub0vaYRv+Wz/Q1pu0j9i6KKK/PjrCiiigAooooAKKKKACiiigAooooAKKKKAPhb/grt4zXQP2bW0ksc6zfW1mu3swk8/n/gNuw/GvxVr9QP8AgtJ4qmWbwD4fQg2081zdyDPIeFI1X9Lh/wAq/L+vv8mhyYRPu2/0/Q5Kj94KKKK9wyCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAK/o7/ZU/wCTffA3/YKtv/RSV/OJX9Hf7Kn/ACb74G/7BVt/6KSvlc++Cn6s3pbs9Yooor446QrjPi547T4eeB77Uwy/bXHkWiH+KZgcHHcAZY+y12dfI/x28RX/AMVPiZB4Z0KJ72LT2NtFHF0eb/lq5PQAYxk8DaT3r5TibNJZXgJOjrVn7sEt7vqvTf1sup9Rw5lkcyx0VV0pQ96be1l0frt6XfQ8f03Tb/xLq8VpZwy32oXcmFRfmd2PJJ/Ukn3Jr7H+DHwTs/hrYi8vBHeeIZkxLcAZWEHqkf8AVup+lWvg98GrD4Yab5smy812dMXF5jhB/wA8489F9+p6nsB6PXzXCnCUctSxuOV6z2W6j/nLz6dO59DxPxVLMW8Hgnait3/N/wDa+XXr2Ciiiv1A/Nhk0MdxE8UqLLE6lXRxlWB6gjuK+T/jr8ApPCbz6/4ehaXRSS9xary1p7j1T/0H6c19Z010WRGR1DKwwVIyCK+dzvI8NnmH9jXVpL4ZdU/8u66+tme/k2dYnJcR7ai7xfxR6Nf59n09Lo+IPgT8QP8AhAPHltLPJs0y+xa3eTwqk/K5/wB04OfTd619wda+WPjv+z+2gm48ReGrcvpnL3VjGMm39XQf3PUfw/Tp6r+zt8Qf+E28CxWtzJv1PStttNk/M6Y/dv8AiBj6qa+I4SnicmxVTIcerPWUH0fe3k9/LW+p9lxTDDZvhqed4HVfDNdV2v8Al56W0PU6KKK/WT8uCiiigArk/ir4TtPG/wAPtc0W+gF1aXdrJFLCw4kRlIZfxUkfjXWU10EiMrDKsMEU07O6A/mG8ZeGLrwT4u1vw9elWvNJvprGZk+6XicoSPYlax6+rv8Agpj8Nf8AhX37UWrXMSFbbXLWK/XCYRXXMLKD3P7pXP8A1096+Ua/UsPV9vRjU7o4GrOwV9DfsB+LH8I/tWeCpvtBgt7t57SYdpA0LlFP/bRYz+Ar55rrPhHr0fhb4reDNZlbZDp+tWd27E4AVJ0Y5/AGjEQ9pRnDumCdmmf0yRSCWJHHRlBp9Zfha5N54d06ZuWaBc/lWpX5Yd4UUUUAFFFFABRRRQAUUUUAFFFFABRRRQB+Lf8AwWA8RyX/AO0FoekdYbPSTdKc/wAUszoR/wCS618IV9ff8FTNUGpftT3CA5NrpUMJ9v30z/ycV8g1+lZdHlwlNeRxT+JhRRRXokBRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFf0d/sqf8m++Bv+wVbf+ikr+cSv2Q+CP/BSn4KfD/4UeFtAv/EcgvrHTreGdf7OvDskWJQy5EJBwQRkEivm86o1KsIKnFvV7K5tSaV7n6B0V8Z/8PW/gT/0Mcn/AILb3/4xR/w9b+BP/Qxyf+C29/8AjFfKfU8T/wA+5fczo5o9z6m+IOsahpnh6SDRYTca5fH7NZIP4XYcyMeyoMsSeOAO9ZHwo+Eun/DLSzgi81m4Gbu/Ycseu1c9Fz+fU9sfN5/4KsfAcuG/4SF9wBAb+zL3IH/fj2FL/wAPW/gT/wBDHJ/4Lb3/AOMV5kskqVMWsZVpSlKKtHR2jfdrzfV9kkut/RjmE6eFeEpu0ZO8u8rbJ+S7d22+lvsyivjP/h638Cf+hjk/8Ft7/wDGKP8Ah638Cf8AoY5P/Bbe/wDxivT+p4n/AJ9y+5nnc0e59mUV8Z/8PW/gT/0Mcn/gtvf/AIxR/wAPW/gT/wBDHJ/4Lb3/AOMUfU8T/wA+5fcw5o9z7Mor4z/4et/An/oY5P8AwW3v/wAYo/4et/An/oY5P/Bbe/8Axij6nif+fcvuYc0e59lkAggjIPavIL74eN8L/Hcfi/w5ERotzmLV9NiHEUbHmaMeinDFR0AOODgeJ/8AD1v4E/8AQxyf+C29/wDjFH/D1v4Ef9DHJ/4Lb3/4xXm43JKmNUHKlJTg7xlZ3i/8ns1s0ehg8wng3JRd4zVpR6Nf5rdPdM+y1YOoZSCpGQR3pa+Mk/4Ks/AeNQq+IXVQMADTL0AD/vxS/wDD1v4E/wDQxyf+C29/+MV6P1PE/wDPuX3M8/mj3PsyivjP/h638Cf+hjk/8Ft7/wDGKP8Ah638Cf8AoY5P/Bbe/wDxin9TxP8Az7l9zDmj3PsyivjP/h638Cf+hjk/8Ft7/wDGKP8Ah638Cf8AoY5P/Bbe/wDxij6nif8An3L7mHNHufL/APwWmtYofGXw4lRAJJY9R3Njk4Fpj+Z/OvzYr7U/4KVftN+Bf2lNX8DXvgrVG1Eaat6t2rWs8Pl+Z9n2f61Fzny36ZxjnrXxXX3eWQlTwkIzVnrv6s5Ju8nYKKKK9Qg/pd+DGuL4j+Geg6kpylzbrKv0YZH6Gu2rxH9iy/bUP2YPhxJI2+U6FYl2PdjbRkn8817dX5RUjyzcezO9BRRRWYwooooAKKKKACiiigAooooAKKKKAPwG/wCCj119o/a68YpnPkpbJ/5BRv8A2avmWvpD/golA0P7YHj5jnEr2rj6fZYh/Q1831+n4L/dqf8AhX5HDL4mFFFFdhIUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFAH9B37Bc3nfst+AD/d0eyX8rdB/SvoWvnT9gGIxfsteBAe+lWrc+8KGvouvyuv8Axp+r/M71sgooorAYUUUUAFFFFABRRRQAUUUUAFFFFAH4K/8ABTDT2sv2sNfkYYFza28o9wAU/mhr5Wr7R/4Kz2P2L9qO3wuPM0KFyfU/abn+mK+Lq/TMA74Wm/JHFP4mFFFFd5AUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFAH9C/wCwvbG3/Zc+HeRw+h2DD8baM175XlP7LGiHw38APA+lFSpstKtrYg9fkiRP/Za9Wr8pqvmqSfmzvWwUUUVkMKKKKACiiigAooooAKKKKACiiigD8gP+CzOgpY/EzwPqYUCW8tryInuVjMDD9ZW/Ovzrr9cP+CzfhIXXw38Ka+kJkmtNUSEyAf6uJ4pQxPsWSIflX5H1+hZRPmwcV2uvxOOp8QUUUV7JmFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABV3Q9Jn1/WtP0u2Gbm9uI7aIH++7BR+pFUq9V/ZV8MS+L/ANo34eadFgsusQ3jAjOUgPnsPxWIj8ayqT9nCU+yuNK7sf0PeArVLPwhpcaLtXyQ2PrXQVV0u2FpptrAowI4lXH4Var8pO8KKKKACiiigAooooAKKKKACiiigAooooA+U/8Agpb4Ffxr+yr4u8kKJrG2+3B2GdqwOs7fmsTD8a/Biv6Z/ir4atvF/wAPtc0m7iE9rdWzxyxEZDoQQy/iCRX81ninw7d+EPE2r6FfhRfaXeTWU4Q5Akjco2PbKmvssiqXpzp9nf7/APhjmqrVMy6KKK+pMAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAK+wf+CWXgMeL/ANqK01CSJ2i0SwluUlH3VlcrCFP1jkm/75NfH1fqt/wRk+HL2+g+MfGMysBe3aWcQdcDbAhO9T3Bad1PvHXlZnU9lhJvvp9//ANKavJH6e9KKKK/OTsCiiigAooooAKKKKACiiigAooooAKKKKAGSxrNE8bcqwKn8a/Ar/gov8MX+Gv7UXiErCsNnrUcepwBFwASDHJk92Mkbuf98etfvxX5sf8ABY34QtqvgTQPHdpAWk0a68q5ZcALBPtRmPqfMWAD/favZyit7LFJPaWn+X4mdRXifknRRRX6EcYUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFf0E/sFfCyT4T/s1+EdKuYXgvmtFnuY5Mb0mkJllQ/7ryOv0Ar8S/wBlr4Xv8YPj34O8Nm3FzZyXq3N6joWQ28X7yRW9A4XZk93Ff0Y6Lp66VpVraL0ijCn3Pevkc9rfBRXq/wAl+p0Uluy7RRRXyR0BRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABXnP7Qfw0svi38JfEfhq+UmC+s5YSyqCyBlI3Ln+IZ3D3Ar0amuodSrDKkYIpxbi01ugP5gPEvh6+8I+I9U0PU4vJ1HTbqWzuYwchZI3KsAe/IPNZtfcv/BVr4CN8OvjJb+NLC3K6V4iQR3DKp2pdRqACew3xhcDuYnPevhqv1DC11iaMaq6/n1OGS5XYKKKK6iQooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiitPwz4dv/ABf4j0vQtLh+0alqV1HaW0WcbpHYKoJ7DJHPak2krsD9Kv8Agjp8ETNP4i+JF/bkCQ/2dYM6kfu0IaVh2ZWfyxnsYWFfqtXlv7NXwk0/4KfB7w74X09AI7O1RGfYFMjYyzsB0Z2LOfdjXqVfmOMr/Wa8qvR7enQ7orlVgooorjKCiiigAooooAKKKKACiiigAooooAKKKKACiiigDwL9tX4A2v7QPwP1vQyka6kkRmsbhx/qZ0+aNs4JAzw2OdrOO9fz5anpt1o2pXen31vJaXtpK8E9vKu14pFJVlYdiCCCPav6iJI1ljZHAZGGCD3FfjB/wVR/Zib4afEWP4haNa7NE12QRXwjXCxXWPlk/wC2igg8feQknLivp8lxXJN4eT0e3r/wTCrG6ufBtFFFfaHMFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAV+gH/AASa/ZzPjr4h3nxG1S33aZopa0sNw4a4Zf3rjn+FGC8jB8091r4g+HngTVfid420bwtokPnanqlwtvECDtTPLO2ASFVQzMccBSa/oi/Zx+DGlfAr4UaF4W0qIpFZ26ozuAHkbqztjjczFmOOMscV89nGL9jR9jHeX5f8Hb7zanG7uenqoVQAMADAApaKK+FOoKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigArzn4+/B3R/jj8M9a8Lazb/aLa9gaPjG5T1DKSDhlYKynBwyg9q9GoqoycWpR3QH8zvxf+FusfBj4iaz4Q1yMreafMUWbbtW4iPMcq+zLg46g5B5BFcdX7Tf8FLf2OR8ZvBZ8Y+GbJW8X6NGzokafNdw8l4OOSTyydcNkcb2I/FplKsQQQRwQe1fo+AxixlJS+0t/68zinHlYlFFFekQFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFfTn7CH7KF1+0r8UIZtQtXPg3R5Vkv5CMJcydVtwe4PV8dF4ypdTWFatChTdSb0Q0ruyPsX/glJ+yX/AGJop+KniSzxqGpxAaXHKpzDanBD4P8AFIQGzz8gTB+dhX6ZdKz9C0S18PaVb6fZxrFBCoUKowK0K/NMTiJYmq6s+p2xXKrBRRRXMUFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUARXVtFeW8kEyCSKRSrKehFfjt/wU0/Yrm+HXiC8+J3hS0LaFfSeZq9tEv8AqJWP/HwMfwsTh/RiG5DNt/Y6sfxb4U07xpoN5pGqW0V3Z3UbRSRTIHVlYEEFTwQQSCDwQa7cJip4Sqqkfmu6JlHmVj+YSivqX9uj9jXUP2ZfG0moaXbyzeB9SmP2SU5f7HIcnyGY8lcAlGPJAIJJUlvlqv0ejWhiKaqU3oziaadmFFFFbiCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAoorZ8HeD9Y8feJ9N8PaBYy6lrGoSiG3tohyzdSSegUAEljgAAkkAE0m1FXYHRfBP4Oa98d/iLpnhHw9CWubpt09wULJawAgPK/sMgAcZYqo5Ir+gP9nH4B6B+z18N9M8M6HaiJYIx5sr4Mkrnlndu7MeSenYAAADzH9h79jvSP2aPAULTpHe+KL9Vm1C/wBnMj44Vc8hFyQoOOpJALGvqOvgMzx7xc+SHwL8fP8AyOuEOVXe4UUUV4hqFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQBx3xU+Fmg/F7wdqHhzxDYQ6hYXkRikimXIIP6jkAgggggEEEA1+EH7YP7Imv8A7LnjaSF4577wjeykadqjLkqeT5ExAwJAAcHgOASMEMqf0IVxHxb+EXh34zeDtQ8O+I9Og1CxvIjE8cy5BHUcjkEEAgggqQCCCAa9TA46eDn3i91+vqRKKkj+aOivoz9r/wDY08SfsveKpX8qfU/BtzKRZaqVyYs9Ip8DAf0bgOORg7lX5zr9BpVYV4KpTd0zjaadmFFFFbCCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKK2PCPhDWfHviOx0Dw/p0+q6vfSeVb2tuuWY9SSeiqACSxIAAJJABNJtRV2BB4c8Oan4u12x0bRrKbUdUvZRDb2sC7nkc9h/Mk8AAk8V+2H7BH7Cmmfs/eHI/EPiCGHUPGmoRA3FyRlYV4PkxZ6ICASerkAngKFb+wp+wPpH7P+iQ+IfEMcOq+M7yMeddFcpAp58qLIyEHcnBcjJwMKPtMAAAAYA7V8PmeZ/WL0aL938/+AdUIW1YAYFLRRXzpsFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFAHM/ED4eaH8TPDd7omvWEGoWN1EYpIp4w6sp7EHqK/Fr9tP/gnx4h/Z+1K+8R+FbafWPAx3TOq5km05epDd3iA5D9VGQ/Te37l1T1XSbXWrN7W8hWaFxyGHT3Fehg8bUwc+aGq6ruRKKkfy8UV+pH7Z/8AwS38+a98XfCiGG2mYtLcaBxHBKeuYTwIm/2ThDngpj5vzE1nRdQ8OardaZqtlcabqNq5jntLqIxyxMOoZTgg199hcZSxceam9eq6o5JRcdylRRRXaSFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFfSn7Kn7DPjf9pfUra9EEuheD9/7zVp4/mnUHkQKfvc8bz8ow33iu041a1OhBzqOyGk3ojyP4QfBjxZ8cvF0Hh3wjpj3125BmnbKwWqE48yV8HavX1J6KCcCv20/Y4/Yb8L/ALNPh5LqSJdU8U3Ua/bNTnjAd+h2KOdiAgEKD2BJJAI9O/Z+/Zr8Hfs7+ELbRPDWmxQbBuluCN0s0mOZHfqzH1PQYAAUAD1mvhcfmc8W+SGkPz9f8jqhBR1EAwKWiivENQooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigBGUOpVgGU8EHvXzL+1J+wj4D/aP06S4ubIaZ4ijj22+q2YCTx9wpOMOmc/I2R8zY2k5r6borSnUnSkpwdmhNX3P53/2i/2OfiF+zfqdwda019S8Pq+ItcsoyYcZwvmjkxMcjhvlJOFZsV4ZX9QGveGtN8TWMlpqVpHdQyKUZXUHgjBH5V+fH7TH/BJfw74ve71v4bXCeGNTbLnT1jzZSNyceWOYsnHKZUAcRk19bhM6jK0MSrPuv1Rzypfyn5DUV6N8YP2evH3wK1R7Txf4eubCHf5cWoRqZLSY842yjjJAJ2NhgOqivOa+nhONSPNB3RhawUUUVYBRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFXdF0TUfEep2+m6TYXWqajcNthtLKFppZDjOFRQSTgdhSbtqwKVbngzwPr/xE1+30Tw1pF1rWqTn5La0jLEDIBZj0VRkZZiAO5Ffaf7Of/BKXxt8R2t9T8e3J8K6O2GNjbMsl468/eflI+xGN56ghTX6l/BD9mPwF8BNBj03wxodrZ9GklC7nlYZ+Z3bLOeTgsTgcDA4rwcXnFGj7tL3pfh9/+RtGm3ufDX7JP/BKO1sPsXiX4rmLU7sbZY9DT5rWI5z+8/57HpkcJ94YkBBr9LNA8O6f4Z06Ky021jtbeJQirGoHAGAPyrRAwKWvjcRiauKlzVXf8kdCio7BRRRXKUFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAYXijwTonjPT57LWNNt763nQxyJNGGDqeqkHgg+h4r4e+PP/BJPwF46kuNR8FXEng7UnJby7RA9qxJ7wEgDjgCNkHPQ19/UV0UcRVw75qUrCaT3PwA+MX/BPf4x/CGaaQ+H28T6ch4udEDTSYzgAwkCTOOTtDAf3q+cbyyuNOu5rW7gltbmFikkMyFHRh1DKeQR6Gv6iLi1hu4zHPEkqHqrqCK8r+J/7Lfw1+L1oYfEvhbT9QIQokssCs8QPXY5G5PqpBr6Ghns1pWjfzX9f5GLpLofzi0V+wHxO/4I6eBNbE8/g/WdR8N3DLiKHzftNuh9SkuXb/v6K+XvH3/BJT4teGHmk0S/0rxBaIuUD+ZbTyH0CYdB+Mgr26Wa4Sr9q3r/AFYydOSPiCivYPFX7IPxm8GEDUvh3rLknGNOiW+I+vkF8fjXl+t+HtV8NXps9X0y80q7Aybe9geGQf8AAWANelCrTqfBJP0ZDTW5n0UUVqIKKKKACiiigAooAJIAGSewrvfDvwD+JXiswHSvAfiK7im+5cDTZVhP/bRlCAe5NRKcYK8nYLXOCor6n8D/APBNL45+NGPm6DZeH04Kvqd6rB/p5AlI/wCBYr6V+HP/AARkmmdJvGfjO4MbKN1tpVukBRv+ujmTcP8AgC159TMsJS3mn6a/kWoSfQ/MOvQ/hp+z38Rfi/NCPCfhHUtUt5SQt75XlWvBwR5z4TI9Ac+1ftb8Lf8AgnJ8F/hhLFcw+F7bU79Np+06iDdNuXkOvmlgjZ7oFr6R0vw5pmioFs7KKDAxkLz+deNWz1bUYff/AJL/ADNVS7s/Kb4I/wDBHnV9Ue3vviN4hFtBnc2naOCMjIIzNIufUFRGPZu9foZ8G/2VPhx8DdNFr4Y8N2dmxAEkyx7pJcHI3yNl3wScb2OO1ev0V89iMbXxP8SWnbobKKjsNRFjUKihVHQAYAp1FFcJQUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFAFeewtrpSJreKUHrvQGsi88BaBfIyS6XBtbrtXGfyrfooA8g8Qfsk/CTxRP5+qeA9C1C4/57XenQTOPxdCa4/Vf+CffwP1YEP4F0eEH/n3sYof1RRX0fRWyrVY/DJr5isj5Ouv+CYfwDu87/CKrn/nnczp/wCgyCq9v/wS1/Z/tmynhN2P/TS/un/9ClNfXNFa/W8R/wA/Jfexcq7HzBp3/BOD4Faa4aPwXYyEdp4/OH5OTXU2H7EHwTsChHw58NyMpyGbSLbIPrny817tRWbxFaW8397HZdjjdE+EHhDw7EsWnaHbWsS8COJAqj8BgV0Vp4f0yw/497C3i/3YxWhRWLbe4xFUIMKAo9AKWiikAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAf/2Q==\" data-filename=\"ditotase.jpg\" class=\"note-float-left\">It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n</div>\r\n</div><p><br></p><p></p>', '1723649401_9c4b29b74d8fd45f58d8.pdf', '2024-08-14 15:30:16', NULL, NULL, 1, NULL);
INSERT INTO `messages` (`message_id`, `message_token`, `message_code`, `message_sender`, `message_recipient`, `message_status`, `message_type`, `message_category`, `message_subject`, `message_emergency`, `message_body`, `message_attachment`, `message_created_at`, `message_updated_at`, `message_deleted_at`, `message_school_id`, `message_section_id`) VALUES
(6, '240814s9dYNM2PDmawhl7fCuSUuyWCujvySILeAEkbjcmDi0uQSFhIPV1723649421', '241305', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'What is Lorem Ipsum', 1, '<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p></div><div><p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div><p></p>\r\n<p><img style=\"width: 25%; float: left;\" src=\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAH0AfQDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9U6KKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAoooo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\" data-filename=\"ditotase.jpg\" class=\"note-float-left\">It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n</div>\r\n</div><p><br></p><p></p>', '1723649401_9c4b29b74d8fd45f58d8.pdf', '2024-08-14 15:30:21', NULL, NULL, 1, NULL),
(8, '2408154WKt3CfSLgiivVi7eGnsvrJOTZenpkv9nhfNGcgrbjJN5ZZP1K1723722577', '249822', 'contact@ditotase.com', '+243821733330', 'send', 'sms', 'parent', 'SMS', 1, 'Bonjour cher parent. Nous sommes ditotase, une ecole moderne ', NULL, '2024-08-15 11:49:37', '2024-08-15 11:49:37', NULL, 1, NULL),
(9, '2408150YeJ6WTqvO2d2ih7jA9F3zzfAG3FFZ63YHh0U0Ejz4jNClhuSc1723722656', '248056', 'contact@ditotase.com', '+243821733330', 'send', 'sms', 'parent', 'SMS', 1, 'Bonjour cher responsable. Le complexe scolaire Trecaz, tient a vous informer de la rentree scolaire 2025-2026 ', NULL, '2024-08-15 11:50:56', '2024-08-15 11:50:56', NULL, 1, NULL),
(10, '240815ImuJB3yfNwberSraDtZRJjmIY3UkMLBQ3LJD3hjpDMa0jTRWG81723722656', '242680', 'contact@ditotase.com', '+243858533285', 'send', 'sms', 'parent', 'SMS', 1, 'Bonjour cher responsable. Le complexe scolaire Trecaz, tient a vous informer de la rentree scolaire 2025-2026 ', NULL, '2024-08-15 11:50:56', '2024-08-15 11:50:56', NULL, 1, NULL),
(11, '240815d3AdvlNAHLFqnIKu7AGVbECb5KzahAdV2Sq52OON3u6Tg188oj1723722656', '245067', 'contact@ditotase.com', '+243990085024', 'send', 'sms', 'parent', 'SMS', 1, 'Bonjour cher responsable. Le complexe scolaire Trecaz, tient a vous informer de la rentree scolaire 2025-2026 ', NULL, '2024-08-15 11:50:56', '2024-08-15 11:50:56', NULL, 1, NULL),
(12, '240815KMr1dPJVbYNqcygheYn9cuhA1v0J0bYe7iZR1WvJ1DZL4jfsiW1723729289', '245953', 'contact@ditotase.com', '+243821733330', 'send', 'sms', 'parent', 'SMS', 1, 'Le message que je suis d’écrire actuellement servira de test pour voir le conteur des sms restant dans le pack de l’établissement concerné. Il est important de savoir que les messages sont payants et cela revient cher a l’école même aux parentsLe message que je suis d’écrire actuellement servira de test pour voir le conteur', NULL, '2024-08-15 13:41:29', '2024-08-15 13:41:29', NULL, 1, NULL),
(13, '240815MqTVNI4SjqfGTQKhhTNyhGjvHnTCL0rG86aTGCFhGzwZmQnKcu1723729339', '240237', 'contact@ditotase.com', '+243821733330', 'send', 'sms', 'parent', 'SMS', 1, 'Le message que je suis d’écrire actuellement servira de test pour voir le conteur des sms restant dans le pack de l’établissement concerné. Il est important de savoir que les messages sont payants et cela revient cher a l’école même aux parentsLe message que je suis d’écrire actuellement servira de test pour voir le conteur des sms restant dans le pack de l’établissement concerné. Il est important de savoir que les messages sont payants et cela revient cher a l’école même aux', NULL, '2024-08-15 13:42:19', '2024-08-15 13:42:19', NULL, 1, NULL),
(14, '240815wchUkeQQborzJyVLW0pr9LnuM91s7GLPfCGodERRdJM0UzKzM21723729339', '246915', 'contact@ditotase.com', '+243858533285', 'send', 'sms', 'parent', 'SMS', 1, 'Le message que je suis d’écrire actuellement servira de test pour voir le conteur des sms restant dans le pack de l’établissement concerné. Il est important de savoir que les messages sont payants et cela revient cher a l’école même aux parentsLe message que je suis d’écrire actuellement servira de test pour voir le conteur des sms restant dans le pack de l’établissement concerné. Il est important de savoir que les messages sont payants et cela revient cher a l’école même aux', NULL, '2024-08-15 13:42:19', '2024-08-15 13:42:19', NULL, 1, NULL),
(15, '240815owTZw5elqOmljFJliVT1UjMEiIc02CDR6PhFOhQowFs1tASvpo1723729339', '248585', 'contact@ditotase.com', '+243990085024', 'send', 'sms', 'parent', 'SMS', 1, 'Le message que je suis d’écrire actuellement servira de test pour voir le conteur des sms restant dans le pack de l’établissement concerné. Il est important de savoir que les messages sont payants et cela revient cher a l’école même aux parentsLe message que je suis d’écrire actuellement servira de test pour voir le conteur des sms restant dans le pack de l’établissement concerné. Il est important de savoir que les messages sont payants et cela revient cher a l’école même aux', NULL, '2024-08-15 13:42:19', '2024-08-15 13:42:19', NULL, 1, NULL),
(16, '240820h88UJ3buwSjZuYlow0fK6zvDUTsVE396VtYw3cElK1jUANdJEF1724145152', '246299', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'system', 'Remerciements', 1, '<blockquote class=\"blockquote\">Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année.Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </blockquote><p align=\"justify\"> Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </p>', NULL, '2024-08-20 09:12:32', '2024-08-20 09:12:38', NULL, 1, NULL),
(17, '2408205RvEee1OJ2gucHzH9jAQJNMwyS8e3fYOqTFcoFILgm4gUSWTk81724145158', '242240', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'system', 'Remerciements de l\'école complexe scolaire ditotase', 1, '<p>\n                                \n                                <blockquote class=\"blockquote\">Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année.Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </blockquote><p align=\"justify\"> Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </p>\n                                \n                                <hr/>\n                                <p>Cher utilisateur mvivien vous recevez ce message car vous etes agent de notre <b>école complexe scolaire ditotase pour l\'année 2023-2024</b></p> \n                                \n                                <p>Contacts école - <b>Téléphone: +243858533285 | E-mail: contact@ditotase.com</b></p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 20/08/2024 09:12:32 </li>\n                <li>Système: Linux via Firefox 128.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-20 09:12:38', NULL, NULL, NULL, NULL),
(18, '240820b5MNgAuKJZuZgl9HBOeZzD8fLgdsut8qogqFABIRK1nQTtrimz1724145158', '247257', 'contact@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Remerciements', 1, '<blockquote class=\"blockquote\">Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année.Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </blockquote><p align=\"justify\"> Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </p>', NULL, '2024-08-20 09:12:38', '2024-08-20 09:12:45', NULL, 1, NULL),
(19, '240820fC91C18eM20jzY6eRvrreo0DzRbPVBQiWL7Gu5eE9zD8S6nVem1724145165', '245764', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'system', 'Remerciements de l\'école complexe scolaire ditotase', 1, '<p>\n                                \n                                <blockquote class=\"blockquote\">Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année.Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </blockquote><p align=\"justify\"> Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </p>\n                                \n                                <hr/>\n                                <p>Cher utilisateur mrubuz vous recevez ce message car vous etes agent de notre <b>école complexe scolaire ditotase pour l\'année 2023-2024</b></p> \n                                \n                                <p>Contacts école - <b>Téléphone: +243858533285 | E-mail: contact@ditotase.com</b></p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 20/08/2024 09:12:38 </li>\n                <li>Système: Linux via Firefox 128.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-20 09:12:45', NULL, NULL, NULL, NULL),
(20, '240820WjOLa4sUDJHgQB2KplQMwrtQKA7fpaVyhk9gkGfLeuQJb4Ft4n1724145165', '247245', 'contact@ditotase.com', 'contact@ditotase.com', 'send', 'email', 'system', 'Remerciements', 1, '<blockquote class=\"blockquote\">Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année.Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </blockquote><p align=\"justify\"> Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </p>', NULL, '2024-08-20 09:12:45', '2024-08-20 09:12:50', NULL, 1, NULL),
(21, '240820YbzcLzYDpQtvcNOzId4PHfuBR70RVRaMAuck9IjAy7eStNUBjS1724145170', '241876', 'magschool@ditotase.com', 'contact@ditotase.com', 'actif', 'email', 'system', 'Remerciements de l\'école complexe scolaire ditotase', 1, '<p>\n                                \n                                <blockquote class=\"blockquote\">Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année.Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </blockquote><p align=\"justify\"> Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. Cher utilisateur, l’école vous remercie pour votre collaboration durant toute l’année. </p>\n                                \n                                <hr/>\n                                <p>Cher utilisateur trecaz vous recevez ce message car vous etes agent de notre <b>école complexe scolaire ditotase pour l\'année 2023-2024</b></p> \n                                \n                                <p>Contacts école - <b>Téléphone: +243858533285 | E-mail: contact@ditotase.com</b></p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 20/08/2024 09:12:45 </li>\n                <li>Système: Linux via Firefox 128.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-20 09:12:50', NULL, NULL, NULL, NULL),
(22, '240820AWrkdhcKTCWzoucZ6ebQN9KfR99QcaARSWHIyra6pPfWHW1KHz1724146201', '242411', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'system', '78495 - Votre code de réinitialisation du mot de passe oublié', 1, '<p><h5>Bonjour cher rubuz@ditotase.com Suite à votre demande de réinitialisation\r\n                            du mot de passe,  voici le code pour confirmer votre demande:</h5> <h3> 78495 </h3>\r\n                            Vous pouvez également suivre cliquer sur le lien ci-dessous pour confirmer la réinitialisation.\r\n                            </p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> \n            <a href=\"http://localhost/web/aschool-manager/verifyResetTokenLink/znwIFL4FwDapelzPMWcFrMMWbfjK0YVo9pHeuRaw5JZrIitcAyZh9Ju2p1KtzmAhaBebVw2THKMN2HhDHn7Fhm73r3f3sefrTM0WfnT6qfyAVOft4wCCTkSzkqyRMd1GmO4gmHCk4w9OQzOJB6j43oa6C0MbFun5zQ89BHHvi5Jgd9duWmAGb70sdOPiosQicF8nf6QQOCOshBIpNMy7weECfgpTDZe8uUvYfUishA7AbvbJ3RAhF4Kv6F\"\n               style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\n                 color: white!important;\n                 text-align:center!important;\n                 background: #ff7e17!important;\n                 text-transform: uppercase;\n                 text-decoration: none;\n                 word-wrap: break-word;\n                 white-space: normal;\n                 cursor: pointer;\n                 border: 0;\n                 box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\n                 transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\n                 border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\n                  border-radius: 100px!important\"> Réinitialiser</a></p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 20/08/2024 09:29:53 </li>\n                <li>Système: Linux via Firefox 128.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-20 09:30:01', NULL, NULL, NULL, NULL),
(23, '240820GAb3vaYsoOZgBnb6THSmpy9mkM0un2RGE73zWjrrUMCUa5cEL51724147173', '242622', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'system', 'Notification de changement du mot de passe appliqué', 1, '<p>Changement du mot de passe effectué avec succès. Heureux de vous revoir cher utilisateur!</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 20/08/2024 09:46:07 </li>\n                <li>Système: Linux via Firefox 128.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-20 09:46:13', NULL, NULL, NULL, NULL),
(24, '240820OKAQMDaelIGjBVtsv9UAgwUjbsLvtvsDouSE0pGlSRYTteLLAg1724154692', '241112', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'send', 'email', 'parent', 'test email', 1, '<p>juste un test<br></p>', NULL, '2024-08-20 11:51:32', '2024-08-20 11:51:49', NULL, 1, NULL),
(25, '240820KdhfHjudTUb53tQjEbtTlphCUFgC9GObbuRQoQWvdAZszg05Jw1724154709', '240022', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'parent', 'test email', 1, '<p>juste un test<br></p>', NULL, '2024-08-20 11:51:49', '2024-08-20 11:51:50', NULL, 1, NULL),
(26, '240820VRQp7bnt2ud0H1z5pnfnkAIdeZSZTkDRQAfbCzVeMw5ejhQUTh1724154710', '240647', 'contact@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'parent', 'test email', 1, '<p>juste un test<br></p>', NULL, '2024-08-20 11:51:50', '2024-08-20 11:51:50', NULL, 1, NULL),
(27, '240820TR8Wm7SQEldE56Tw7gc1Lu2SUBJC9uEOU6As5vr25v1rgi71QN1724154847', '242365', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'actif', 'email', 'parent', 'Reçu paiement frais [245280]', 1, '<h3>Perception frais élève - rumbu chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>245280</b> du 20/08/2024 11:53:14</b></p><h5><b>Elève : rumbu chipeng tresor</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>140,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>100,00$</td><td>20,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 240,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 240,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>school(241908)</br> <b class=\"small\">Tuesday 20-08-2024 à 11:53:53</b></span> <br><span class=\"small text-muted font-weight-bold\"> Eduschool v2.0</span>  </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-08-20 11:54:07', NULL, NULL, 1, NULL);
INSERT INTO `messages` (`message_id`, `message_token`, `message_code`, `message_sender`, `message_recipient`, `message_status`, `message_type`, `message_category`, `message_subject`, `message_emergency`, `message_body`, `message_attachment`, `message_created_at`, `message_updated_at`, `message_deleted_at`, `message_school_id`, `message_section_id`) VALUES
(28, '240820DtpfR1pzJC3gvsSARp8fkrZcH7HHb11sAkwHaiJlhuaSMofkl01724154950', '245612', 'magschool@ditotase.com', 'eliemwez.rubuz@gmail.com', 'actif', 'email', 'system', 'Frais payé de l\'élève rumbu chipeng', 1, '<p><h3>Perception frais élève - rumbu chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>240068</b> du 20/08/2024 11:55:27</b></p><h5><b>Elève : rumbu chipeng tresor</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>20,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 50,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 20,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =30,00</b></td></tr></tbody></table><p>Printed by : <span>school(241908)</br> <b class=\"small\">Tuesday 20-08-2024 à 11:55:41</b></span> <br><span class=\"small text-muted font-weight-bold\"> Eduschool v2.0</span>  </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 20/08/2024 11:55:41 </li>\n                <li>Système: Linux via Firefox 128.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-20 11:55:50', NULL, NULL, NULL, NULL),
(29, '240820r6ZMrqb8VmapsqqISCmSckl9ifkEhQZ5ODMgS5tEdjZ1i0vIJe1724154950', '248981', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'actif', 'email', 'parent', 'Reçu paiement frais [240068]', 1, '<h3>Perception frais élève - rumbu chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>240068</b> du 20/08/2024 11:55:27</b></p><h5><b>Elève : rumbu chipeng tresor</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>20,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 50,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 20,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =30,00</b></td></tr></tbody></table><p>Printed by : <span>school(241908)</br> <b class=\"small\">Tuesday 20-08-2024 à 11:55:41</b></span> <br><span class=\"small text-muted font-weight-bold\"> Eduschool v2.0</span>  </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-08-20 11:55:50', NULL, NULL, 1, NULL),
(30, '240822sLoutGeg36k7AsYBAElQSS6DlzPE13uafIiZBSRe7nP7blaLKb1724322125', '244837', 'magschool@ditotase.com', 'ditotase@gmail.com', 'actif', 'email', 'system', 'Modification de votre compte utilisateur', 1, '<p><p> Bonjour cher ditotase@gmail.com. Votre compte utilisateur a été modifié par votre administrateur \r\n                             pour de raison de sécurité liée à vos données.\r\n                            </p><p>Cher Trecaz Holding, votre compte a subi de modifications. Pour plus de détails, veuillez accèder à votre compte.\r\n                    Ce mail a été envoyé à l\'adresse suivante: ditotase@gmail.com. Si erreur, demander la suppression immédiate de votre compte.. En cas d\'une indication contraire, veuillez le signaler.\r\n                            </p>\r\n                                <br/> <br/> <hr>\r\n                             <p style=\"text-align:center!important;\">\r\n                                <a href=\"http://localhost/web/aschool-manager/auth\"\r\n                                style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\r\n                                  color: white!important;\r\n                                  text-align:center!important;\r\n                                  background: #ff7e17!important;\r\n                                  text-transform: uppercase;\r\n                                  text-decoration: none;\r\n                                  word-wrap: break-word;\r\n                                  white-space: normal;\r\n                                  cursor: pointer;\r\n                                  border: 0;\r\n                                  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\r\n                                  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\r\n                                  border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\r\n                                   border-radius: 100px!important\"> Se connecter à mon compte</a>\r\n                            </p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 22/08/2024 10:21:53 </li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-22 10:22:05', NULL, NULL, NULL, NULL),
(31, '240827R4oZ2iEyvDPf7Mjytw0WLCBIclzF1eB6KVNzAb9acpLK3wQqHO1724764647', '245734', 'magschool@ditotase.com', 'eliemwez.rubuz@gmail.com', 'actif', 'email', 'system', 'Frais payé de l\'élève chipeng Mukeng', 1, '<p><h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>244288</b> du 27/08/2024 13:17:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>50,00$</td><td>100,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 50,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 50,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 27-08-2024 à 13:17:16</b></span> <br><span class=\"small text-muted font-weight-bold\"> Eduschool v2.0</span>  </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 27/08/2024 13:17:16 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Chrome 128.0.0.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-27 13:17:27', NULL, NULL, NULL, NULL),
(32, '240827Ydy9SYSp71uTWPQmIQ9nlF2Yrrkz2scUeKgmhwqpO3UJaQWbna1724764647', '245107', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'actif', 'email', 'parent', 'Reçu paiement frais [244288]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>244288</b> du 27/08/2024 13:17:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>50,00$</td><td>100,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 50,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 50,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 27-08-2024 à 13:17:16</b></span> <br><span class=\"small text-muted font-weight-bold\"> Eduschool v2.0</span>  </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-08-27 13:17:27', NULL, NULL, 1, NULL),
(33, '240828W1Gk9vJnevBpELhtpbi0aVLE1GtMFtlr44i0ap9rSf4yKofYC71724834700', '240947', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'system', '85902 - Votre code de réinitialisation du mot de passe oublié', 1, '<p><h5>Bonjour cher eliemwez.rubuz@ditotase.com Suite à votre demande de réinitialisation\r\n                            du mot de passe,  voici le code pour confirmer votre demande:</h5> <h3> 85902 </h3>\r\n                            Vous pouvez également suivre cliquer sur le lien ci-dessous pour confirmer la réinitialisation.\r\n                            </p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> \n            <a href=\"http://localhost/web/aschool-manager/verifyResetTokenLink/JhdHscpgYdY5LGeF3c1Is4hVOGnpjIse6hcOHEFQgOLtc8HTlzMtnHQ80Rtng8SrHpcrEpM7aiVoJA3jBy8IAw5gnpLyI465FV1lZIGOLRNaINIFHJHjwDdlEGfOruCRwu4wRKZEqreZh3FfwfAHjZfDwc4MPAjDvw442yKDwfeSVeoa7P13h41uU8ZugpoANF1QOTUop3ryMhkBnABNjrehZRnrT4hNuot3LYmluaFF0mcPDDSbpdEe4F\"\n               style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\n                 color: white!important;\n                 text-align:center!important;\n                 background: #ff7e17!important;\n                 text-transform: uppercase;\n                 text-decoration: none;\n                 word-wrap: break-word;\n                 white-space: normal;\n                 cursor: pointer;\n                 border: 0;\n                 box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\n                 transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\n                 border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\n                  border-radius: 100px!important\"> Réinitialiser</a></p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/08/2024 08:44:55 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-28 08:45:00', NULL, NULL, NULL, NULL),
(34, '240828ZnD1efCV4mn5174GP6AA2Ysni9dPcPuQp1bETFfhMO5FeYPZw11724835103', '243672', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'system', '91251 - Votre code de réinitialisation du mot de passe oublié', 1, '<p><h5>Bonjour cher eliemwez.rubuz@ditotase.com Suite à votre demande de réinitialisation\r\n                            du mot de passe,  voici le code pour confirmer votre demande:</h5> <h3> 91251 </h3>\r\n                            Vous pouvez également suivre cliquer sur le lien ci-dessous pour confirmer la réinitialisation.\r\n                            </p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> \n            <a href=\"http://localhost/web/aschool-manager/verifyResetTokenLink/TbG1RtzTe8WbH188PBbkBtKcSV4Cj9GUOs1CqCelNNokLll62UhUeAlGtsZgEM2f0aF9RpErykjS47ReQVbrRImcDnV4dKjYOMoIdovfohi8zyVPOEYAiTm6eNNYqoIKIjmOV0jZPGuLGMnY4J8CtMr5Q6YyRSsf6TwbiBJUTU6H2fhSzKdJ1otfHFHNB1wc7BYnsEHsMibVlrBdQsdkG3qlVljHF1TKcWrRGIyMRtO7utqNvGlpvrya4D\"\n               style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\n                 color: white!important;\n                 text-align:center!important;\n                 background: #ff7e17!important;\n                 text-transform: uppercase;\n                 text-decoration: none;\n                 word-wrap: break-word;\n                 white-space: normal;\n                 cursor: pointer;\n                 border: 0;\n                 box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\n                 transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\n                 border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\n                  border-radius: 100px!important\"> Réinitialiser</a></p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/08/2024 08:51:38 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-28 08:51:43', NULL, NULL, NULL, NULL),
(35, '240828MDYKZHb8baovZoUmrS4QCuA6ul87eZYZNu4t46PRmDuBOYvR391724835960', '246384', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'system', '88041 - Votre code de réinitialisation du mot de passe oublié', 1, '<p><h5>Bonjour cher rubuz@ditotase.com Suite à votre demande de réinitialisation\r\n                            du mot de passe,  voici le code pour confirmer votre demande:</h5> <h3> 88041 </h3>\r\n                            Vous pouvez également suivre cliquer sur le lien ci-dessous pour confirmer la réinitialisation.\r\n                            </p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> \n            <a href=\"http://localhost/web/aschool-manager/verifyResetTokenLink/tOVz75jW0F2BeaysbKws2jhl9QVbdcZ3Q3uN84pFf7hPdjpTFgqrwBpmNKPrlYd1ephbOHVrCIOhP0Ba2BYTaCEkJJNR8ij9766C0t83l2TSgeVBPG4A2gCVziJpVtU830LH7AZoHuadUOlli7pzJK6EPsKIkFUlBOfgLuNeanLClPV5lTUNDHn15Qr1lucdRa5y1d8B0skbgmTf9tiAacv27scuo9l8yZaYPj2vQVDpRAhFaM4qw0hUhP\"\n               style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\n                 color: white!important;\n                 text-align:center!important;\n                 background: #ff7e17!important;\n                 text-transform: uppercase;\n                 text-decoration: none;\n                 word-wrap: break-word;\n                 white-space: normal;\n                 cursor: pointer;\n                 border: 0;\n                 box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\n                 transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\n                 border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\n                  border-radius: 100px!important\"> Réinitialiser</a></p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/08/2024 09:05:55 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-28 09:06:00', NULL, NULL, NULL, NULL),
(36, '240828Unmk9wHuHt2szGgYJWyRh2ctIFEd71aOqU5f4CL3DoNhKWVR0E1724836914', '248575', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'system', 'Notification de changement du mot de passe appliqué', 1, '<p>Changement du mot de passe effectué avec succès. Heureux de vous revoir cher utilisateur!</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/08/2024 09:21:48 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-28 09:21:54', NULL, NULL, NULL, NULL),
(37, '240828IOQzjYCydbIL3J3UDB5sg9KnOg6aurkgjQB7sNUHwhbydwJj7S1724838991', '240852', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'system', 'Compte vérouillé - Ouverture session', 1, '<p>Plusieurs tentatives d\'accès au compte de [eliemwez.rubuz@ditotase.com] ont été detectées sur [Firefox 129.0] dont l\'adresse IP utilisée est [127.0.0.1]</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/08/2024 09:56:23 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-28 09:56:31', NULL, NULL, NULL, NULL),
(38, '240828UwI8IeiHJ7i4scbh0TFBMM31Sfe0HIYDRg500GvlQpGCmtAt6N1724843277', '242977', 'magschool@ditotase.com', 'eliemwez.rubuz@gmail.com', 'actif', 'email', 'system', 'Frais payé de l\'élève kayind chipeng', 1, '<p><h3>Perception frais élève - kayind chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248826</b> du 28/08/2024 11:07:13</b></p><h5><b>Elève : kayind chipeng myriam</b></h5><h5> Classe: 1ere B Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>100,00$</td><td>40,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 15 000,00</b></td><td><b>$ 100,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 15 000,00</b></td><td><b>$ - 100,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 28-08-2024 à 11:07:46</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/08/2024 11:07:46 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-28 11:07:57', NULL, NULL, NULL, NULL),
(39, '240828aC4ooSJipKbo0C8ZHBVRPhyg4prLqo6DLz1eBpqFc0W1HjOuey1724843277', '243252', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'actif', 'email', 'parent', 'Reçu paiement frais [248826]', 1, '<h3>Perception frais élève - kayind chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248826</b> du 28/08/2024 11:07:13</b></p><h5><b>Elève : kayind chipeng myriam</b></h5><h5> Classe: 1ere B Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>100,00$</td><td>40,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 15 000,00</b></td><td><b>$ 100,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 15 000,00</b></td><td><b>$ - 100,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 28-08-2024 à 11:07:46</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-08-28 11:07:57', NULL, NULL, 1, NULL),
(40, '2408282zCJP9GTYW5YKy0zIwWKHGw6pB8zFeZgUjWwG8wZZTsVm5dHd11724846035', '244852', 'contact@ditotase.com', '+243977090011', 'send', 'sms', 'parent', 'SMS', 1, 'Bonjour cher parent rubuz. Nous sommes ravi de vous compter parmi nos parents', NULL, '2024-08-28 11:53:55', '2024-08-28 12:00:45', NULL, 1, NULL),
(41, '24082812P4Ew3unBb56ql1WFbFPZGtV0MLH3d6EsdNLiCrZHUwM5IpoV1724846035', '245239', 'DITOTASE', '+243977090011', 'actif', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Bonjour cher parent rubuz. Nous sommes ravi de vous compter parmi nos parents . Cher parent manyong melanie, vous recevez pour vos enfants inscrits à l\'école complexe scolaire ditotase en 2023-2024. Infoline: +243858533285', NULL, '2024-08-28 11:53:55', NULL, NULL, NULL, NULL),
(42, '240828aFZhzhMcVcKy5nGGBDQL1moEbOJAsTD0yJQqZoGYyZTTNc5TNs1724846101', '240832', 'contact@ditotase.com', '+243977090011', 'actif', 'sms', 'parent', 'SMS', 1, 'Bonjour cher parent rubuz. Nous sommes ravi de vous compter parmi nos parents', NULL, '2024-08-28 11:55:01', NULL, NULL, 1, NULL),
(43, '240828rMJUsrNoFazsFgctGImWSKUijvAGEQHNm3z2ikWHhE25n1wL4j1724846424', '241637', 'contact@ditotase.com', '+243977090011', 'send', 'sms', 'parent', 'SMS', 1, 'Bonjour cher parent rubuz. Nous sommes ravi de vous compter parmi nos parents', NULL, '2024-08-28 12:00:24', '2024-08-28 12:00:24', NULL, 1, NULL),
(44, '240828AiVjn7EA3VHkVkdyqDukf4HFDdRC8aablVD2bmsD2Bt1nThr391724846445', '243840', 'School DITOTASE', '+243977090011', 'actif', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Bonjour cher parent rubuz. Nous sommes ravi de vous compter parmi nos parents', NULL, '2024-08-28 12:00:45', NULL, NULL, NULL, NULL),
(45, '2408286U4n3p7FcUJmYDNoeIi4gEt8orUcQ7GJjcyZO5F1s7deWhbYAR1724846534', '243128', 'contact@ditotase.com', '+243858533285', 'send', 'sms', 'parent', 'SMS', 1, 'SMS API PARTNER ON DITOTASE SENDER', NULL, '2024-08-28 12:02:14', '2024-08-28 12:02:15', NULL, 1, NULL),
(46, '240828SW10tPbgdoErYWbSG8QE1r8878ujfrCJ6ePTbOtpJZPmEyP7Zq1724846534', '247130', 'DITOTASE', '+243858533285', 'actif', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'SMS API PARTNER ON DITOTASE SENDER . Cher parent kachak sarah, vous recevez pour vos enfants inscrits à l\'école complexe scolaire ditotase en 2023-2024. Infoline: +243858533285', NULL, '2024-08-28 12:02:14', NULL, NULL, NULL, NULL),
(47, '240828qUawCu8SYL3t80bWtMjSYmT4z9iSDP06fOhfSDDdBt3ub7mGch1724856774', '247567', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'system', 'Frais payé de l\'élève chipeng rumbu', 1, '<p><h3>Perception frais élève - chipeng rumbu pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>241483</b> du 28/08/2024 14:52:09</b></p><h5><b>Elève : chipeng rumbu MIke</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>110,00$</td><td>110,00$</td><td>0</td></tr><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>110,00$</td><td>10,00$</td><td>100,00$</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 15 000,00</b></td><td><b>$ 120,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 15 000,00</b></td><td><b>$ - 120,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 28-08-2024 à 14:52:49</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/08/2024 14:52:49 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-28 14:52:54', NULL, NULL, NULL, NULL),
(48, '240828LMp1i2cKdT109ko1kMFCmWwvSJBhKtFIFHAngtb8UlAcUgD8Qy1724856775', '240359', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [241483]', 1, '<h3>Perception frais élève - chipeng rumbu pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>241483</b> du 28/08/2024 14:52:09</b></p><h5><b>Elève : chipeng rumbu MIke</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>110,00$</td><td>110,00$</td><td>0</td></tr><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>110,00$</td><td>10,00$</td><td>100,00$</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 15 000,00</b></td><td><b>$ 120,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 15 000,00</b></td><td><b>$ - 120,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 28-08-2024 à 14:52:49</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-08-28 14:52:55', NULL, NULL, 1, NULL),
(49, '240828jfpZ6DPpmmkE84mBHQHcjw5w4BtQ7IdZ6NVDPzCWCYentcP75O1724857139', '245331', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'system', 'Frais payé de l\'élève Mataro Rubuz', 1, '<p><h3>Perception frais élève - Mataro Rubuz pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248509</b> du 28/08/2024 14:55:18</b></p><h5><b>Elève : Mataro Rubuz Suza</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 10 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 10 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 28-08-2024 à 14:58:54</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/08/2024 14:58:54 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-28 14:58:59', NULL, NULL, NULL, NULL),
(50, '240828jNSDw9Z10MEIDchrn825oGGDrMk7FSc1IJDHi2uEMlYc3erzdu1724857139', '248831', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [248509]', 1, '<h3>Perception frais élève - Mataro Rubuz pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248509</b> du 28/08/2024 14:55:18</b></p><h5><b>Elève : Mataro Rubuz Suza</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 10 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 10 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 28-08-2024 à 14:58:54</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-08-28 14:58:59', NULL, NULL, 1, NULL),
(51, '240828CKCpfgZp1VHRhbH755CWVW6fZ4fpm0Nv7nk5S2DdK8wBjQmAdP1724857827', '248994', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'system', 'Frais payé de l\'élève Mataro Rubuz', 1, '<p><h3>Perception frais élève - Mataro Rubuz pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248234</b> du 28/08/2024 15:10:15</b></p><h5><b>Elève : Mataro Rubuz Suza</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>117,61$</td><td>22,39$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 50 000,00</b></td><td><b>$ 100,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 117,61 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 28-08-2024 à 15:10:20</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/08/2024 15:10:20 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-28 15:10:27', NULL, NULL, NULL, NULL),
(52, '240828DRoNWO7RdIBiztskYvd3zvfkRO7t5g725RFGRG8mBylIpyM7uk1724857827', '249990', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [248234]', 1, '<h3>Perception frais élève - Mataro Rubuz pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248234</b> du 28/08/2024 15:10:15</b></p><h5><b>Elève : Mataro Rubuz Suza</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>117,61$</td><td>22,39$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 50 000,00</b></td><td><b>$ 100,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 117,61 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 28-08-2024 à 15:10:20</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-08-28 15:10:27', NULL, NULL, 1, NULL),
(53, '240828t9Kb69pDZnQugeKsoHwpf2BSKw51HB8AJoQOUPG5N0jkhCN3Tn1724858610', '243466', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'send', 'email', 'parent', 'Inscription encours 2025-2026', 1, 'Chers parents, ceci est un communique special d\'inscription encours de vos enfants<br>', NULL, '2024-08-28 15:23:30', '2024-08-28 15:23:39', NULL, 1, NULL),
(54, '240828Hwt3eudTrldK3QMY8bDZEnprbsiPrYUdKIMZphd3mWgnJL1KdY1724858619', '246597', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'parent', 'Inscription encours 2025-2026', 1, 'Chers parents, ceci est un communique special d\'inscription encours de vos enfants<br>', NULL, '2024-08-28 15:23:39', '2024-08-28 15:23:39', NULL, 1, NULL),
(55, '240828rSowc4mH9aEuGDoH4fyGvvMrGv1L15Btd28a1McTlGtpvoRksh1724858619', '240558', 'contact@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'parent', 'Inscription encours 2025-2026', 1, 'Chers parents, ceci est un communique special d\'inscription encours de vos enfants<br>', NULL, '2024-08-28 15:23:39', '2024-08-28 15:23:39', NULL, 1, NULL),
(56, '240828MPMm9yfvOc2kI1vKU9clROVw7cVyN3jRcWivCi6uRhqampkaPP1724858644', '249152', 'contact@ditotase.com', '+243821733330', 'actif', 'sms', 'parent', 'SMS', 1, 'Chers parents, ceci est un communique spécial d\'inscription encours de vos enfants', NULL, '2024-08-28 15:24:04', NULL, NULL, 1, NULL),
(57, '240828qhaF27utOd0vF7prYdyVSl3u7LOlTuV1l6Ympb9aP9HoUS3LNT1724858644', '246933', 'DITOTASE', '+243821733330', 'actif', 'sms', 'system', 'SMS Broadcast TO +243821733330', 1, 'Chers parents, ceci est un communique spécial d\'inscription encours de vos enfants . Cher parent kachak sarah, vous recevez pour vos enfants inscrits à l\'école complexe scolaire ditotase en 2023-2024. Infoline: +243858533285', NULL, '2024-08-28 15:24:04', NULL, NULL, NULL, NULL),
(58, '24082870khNpkbMKKuioYKTSC6hObsP0mZVmIvv4KBujoIREhGAS88031724858805', '243045', 'contact@ditotase.com', '+243821733330', 'send', 'sms', 'parent', 'SMS', 1, 'Chers parents, ceci est un communique spécial d\'inscription encours de vos enfants', NULL, '2024-08-28 15:26:45', '2024-08-28 15:26:45', NULL, 1, NULL),
(59, '2408288Zoe1wPjIjeEAjkqRwe5sKJ8dJpp33HJllzVLTlnvK07QRoHle1724858805', '242457', 'contact@ditotase.com', '+243858533285', 'send', 'sms', 'parent', 'SMS', 1, 'Chers parents, ceci est un communique spécial d\'inscription encours de vos enfants', NULL, '2024-08-28 15:26:45', '2024-08-28 15:26:46', NULL, 1, NULL),
(60, '240828bOinftQRO0KBZfUSmnC8HFoOvnha0cBz9zt8OddpreLLP3EWI71724858805', '245794', 'DITOTASE', '+243858533285', 'actif', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'Chers parents, ceci est un communique spécial d\'inscription encours de vos enfants . Cher parent kachak sarah, vous recevez pour vos enfants inscrits à l\'école complexe scolaire ditotase en 2023-2024. Infoline: +243858533285', NULL, '2024-08-28 15:26:45', NULL, NULL, NULL, NULL),
(61, '240828TYOVSsypsmCom5DSV5Cf1A4F91MuPP7V3GL3uLOZyO8PqNCDFJ1724858806', '248065', 'contact@ditotase.com', '+243977090011', 'send', 'sms', 'parent', 'SMS', 1, 'Chers parents, ceci est un communique spécial d\'inscription encours de vos enfants', NULL, '2024-08-28 15:26:46', '2024-08-28 15:26:46', NULL, 1, NULL),
(62, '240828eMMPFS7vPijWdq7SjvuALzmv7avfCcf1oQrM9MYkrLeHPfp4iD1724858806', '244223', 'DITOTASE', '+243977090011', 'actif', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Chers parents, ceci est un communique spécial d\'inscription encours de vos enfants . Cher parent manyong melanie, vous recevez pour vos enfants inscrits à l\'école complexe scolaire ditotase en 2023-2024. Infoline: +243858533285', NULL, '2024-08-28 15:26:46', NULL, NULL, NULL, NULL),
(63, '240828QSQs2datTs4wLKJtNns1ggkofZOPcQ9fLiN6AAzTUZhI6Yn9ov1724859210', '241189', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève Matand Kabwik', 1, '<p><h3>Perception frais élève - Matand Kabwik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>249600</b> du 28/08/2024 15:32:37</b></p><h5><b>Elève : Matand Kabwik consolate</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>130,00$</td><td>130,00$</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>100,00$</td><td>40,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 230,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 230,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 28-08-2024 à 15:33:24</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/08/2024 15:33:24 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-08-28 15:33:30', NULL, NULL, NULL, NULL),
(64, '2408280Otzk2vmjunLgnACIEPGnJlFdwu4I9ui4425EKFrZztBO4G4FI1724859210', '242081', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [249600]', 1, '<h3>Perception frais élève - Matand Kabwik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>249600</b> du 28/08/2024 15:32:37</b></p><h5><b>Elève : Matand Kabwik consolate</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>130,00$</td><td>130,00$</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>100,00$</td><td>40,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 230,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 230,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 28-08-2024 à 15:33:24</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-08-28 15:33:30', NULL, NULL, 1, NULL),
(65, '240828ErQPJL3SGPIg1EdE7GzUYyfmTQgHnLzNeANIpsGTnEMFMjjbQt1724860465', '244117', 'DITOTASE', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [249600]', 1, 'Cher parent, nous avons perçu en CDF=0 et USD=230 pour le compte de l\'élève:Matand Kabwik - ReçuID: 249600 Date: 2024-08-28. Infoline: +243858533285', NULL, '2024-08-28 15:54:25', '2024-08-28 15:54:25', NULL, 1, NULL),
(66, '240828UeViZGCW4ZBhdTiOsenSwS4DSDvsW6NcV726O5R4jNkEbIZZZj1724860465', '245254', 'DITOTASE', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Cher parent, nous avons perçu en CDF=0 et USD=230 pour le compte de l\'élève:Matand Kabwik - ReçuID: 249600 Date: 2024-08-28. Infoline: +243858533285', NULL, '2024-08-28 15:54:25', NULL, NULL, NULL, NULL),
(67, '240828r97Qt7yj4pr4bjkwZJ6UJjagqmmnhBewJzfJKGkUFbaPKU8EOJ1724860486', '245065', 'DITOTASE', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [249600]', 1, 'Cher parent, nous avons perçu en CDF=0 et USD=230 pour le compte de l\'élève:Matand Kabwik - ReçuID: 249600 Date: 2024-08-28. Infoline: +243858533285', NULL, '2024-08-28 15:54:46', '2024-08-28 15:54:47', NULL, 1, NULL),
(68, '2408281IGJTBQ3B3IBogJN3CpomIGKOKMJ8PIyZnwIuPPqAQhKNA4eGh1724860895', '243401', 'DITOTASE', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [248234]', 1, 'RECU No:248234 pour Mataro Rubuz 1ere a mat. CDF=50000 - USD=100. Date: 2024-08-28. Infoline: +243858533285', NULL, '2024-08-28 16:01:35', '2024-08-28 16:01:36', NULL, 1, NULL),
(69, '240828yMi8pEFHcrt1Khmk20hpaAbhbZYeJsp4P5qp9t1EHe7ESFQd1j1724860895', '249943', 'DITOTASE', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'RECU No:248234 pour Mataro Rubuz 1ere a mat. CDF=50000 - USD=100. Date: 2024-08-28. Infoline: +243858533285', NULL, '2024-08-28 16:01:35', NULL, NULL, NULL, NULL),
(70, '240910JOMZvmkdUNUrqdS4wR3QVQCiz8UCfys89ZhFyE3IHkLdP514kA1725962312', '242560', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [243684]', 1, '<h3>Perception frais élève - Matand Kabwik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>243684</b> du 10/09/2024 09:57:44</b></p><h5><b>Elève : Matand Kabwik consolate</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>110,00$</td><td>30,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 150,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 150,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 09:58:12</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 09:58:32', NULL, NULL, 1, NULL),
(71, '240910ClkFS0MN9VI6Ei9zsuYVyfJ2jkRMZJ7bSibFiOBB8vajApFtPH1725962312', '244028', 'CS MALKIA', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [243684]', 1, 'RECU No:243684 pour Matand Kabwik (1ere a mat). Montant=$ 110.00 (Frais scolaire - AVRIL). Infoline: +243858533285', NULL, '2024-09-10 09:58:32', '2024-09-10 09:58:52', NULL, 1, NULL),
(72, '240910ngEia2OmvThs5dIDGtfgEMnPDqhhkjI0vkeMzYonz6q9sNlmOd1725962312', '246157', 'CS MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'RECU No:243684 pour Matand Kabwik (1ere a mat). Montant=$ 110.00 (Frais scolaire - AVRIL). Infoline: +243858533285', NULL, '2024-09-10 09:58:32', NULL, NULL, NULL, NULL),
(73, '240910u3ERiSDmtZYOC9AOE1jKblkOByWtZRvWAwojfHjpRc1SOftDOj1725962408', '241441', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève Matand Kabwik', 1, '<p><h3>Perception frais élève - Matand Kabwik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>243699</b> du 10/09/2024 09:59:51</b></p><h5><b>Elève : Matand Kabwik consolate</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>30,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 150,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 150,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:00:00</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 10:00:00 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 10:00:08', NULL, NULL, NULL, NULL);
INSERT INTO `messages` (`message_id`, `message_token`, `message_code`, `message_sender`, `message_recipient`, `message_status`, `message_type`, `message_category`, `message_subject`, `message_emergency`, `message_body`, `message_attachment`, `message_created_at`, `message_updated_at`, `message_deleted_at`, `message_school_id`, `message_section_id`) VALUES
(74, '240910daAWYMBjB8KIoe7TVO7vpZKBhYVOkrRiaw9ET0TKYeOSVQPedM1725962408', '249294', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [243699]', 1, '<h3>Perception frais élève - Matand Kabwik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>243699</b> du 10/09/2024 09:59:51</b></p><h5><b>Elève : Matand Kabwik consolate</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>30,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 150,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 150,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:00:00</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 10:00:08', NULL, NULL, 1, NULL),
(75, '240910BeFkRjcAPjCQeye06fT5F3CFvFZCRIdNNjiiP7dpakWySfMloD1725962408', '247115', 'CS MALKIA', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [243699]', 1, 'RECU No:243699 pour Matand Kabwik (1ere a mat). Montant=$ 120.00 (Frais scolaire - MAI). Infoline: +243858533285', NULL, '2024-09-10 10:00:08', '2024-09-10 10:00:09', NULL, 1, NULL),
(76, '240910DHdv1D8tEwtBy1HywrsZrMUyTqgvgdt0iNHfRSBTS36iLo2c1Q1725962408', '248031', 'CS MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'RECU No:243699 pour Matand Kabwik (1ere a mat). Montant=$ 120.00 (Frais scolaire - MAI). Infoline: +243858533285', NULL, '2024-09-10 10:00:08', NULL, NULL, NULL, NULL),
(77, '240910glsUrQTCssfSQCh3pPAyHZPOiigEVgyEysnOg8hwWmIDufatlV1725962855', '245581', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève Mataro Rubuz', 1, '<p><h3>Perception frais élève - Mataro Rubuz pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>240930</b> du 10/09/2024 10:07:18</b></p><h5><b>Elève : Mataro Rubuz Suza</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>22,39$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 150,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 142,39 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =7,61</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:07:26</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 10:07:26 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 10:07:35', NULL, NULL, NULL, NULL),
(78, '240910Zssc02jOLyEngk5nvyoG1qo55NO2SL2hAgvRDNODoiM3pbIvR81725962855', '243677', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [240930]', 1, '<h3>Perception frais élève - Mataro Rubuz pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>240930</b> du 10/09/2024 10:07:18</b></p><h5><b>Elève : Mataro Rubuz Suza</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>22,39$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 150,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 142,39 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =7,61</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:07:26</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 10:07:35', NULL, NULL, 1, NULL),
(79, '2409108lwVkUocD3zhN9pT9iCdujZwQ7GTM0pPcYg7VRGMlwNEaWDt5Z1725962855', '242104', 'CS MALKIA', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [240930]', 1, 'RECU No:240930 pour Mataro Rubuz (1ere a mat). Montant=$ 142.39 (Frais scolaire - MAI). Infoline: +243858533285', NULL, '2024-09-10 10:07:35', '2024-09-10 10:07:36', NULL, 1, NULL),
(80, '240910VYMMWcQPZJUdrqpuQhwCk2GKTbqVBg6NW9bY5Ib8M9tD02eqYP1725962855', '242785', 'CS MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'RECU No:240930 pour Mataro Rubuz (1ere a mat). Montant=$ 142.39 (Frais scolaire - MAI). Infoline: +243858533285', NULL, '2024-09-10 10:07:35', NULL, NULL, NULL, NULL),
(81, '240910v4Hc6y71dGAG8yJ5Sl9A8vz7ONYhpBGhto8gIPgypudI1bsvl01725963106', '248803', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève Ketia Mwanabote', 1, '<p><h3>Perception frais élève - Ketia Mwanabote pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>245375</b> du 10/09/2024 10:11:01</b></p><h5><b>Elève : Ketia Mwanabote Kenia</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>100,00$</td><td>40,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 400,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 400,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:11:37</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 10:11:37 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 10:11:46', NULL, NULL, NULL, NULL),
(82, '240910ikYTp6tejJjR86LhyuT5Sk8URRBTTYTRPZQ8CPHOIgpHty1odK1725963106', '245462', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [245375]', 1, '<h3>Perception frais élève - Ketia Mwanabote pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>245375</b> du 10/09/2024 10:11:01</b></p><h5><b>Elève : Ketia Mwanabote Kenia</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>100,00$</td><td>40,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 400,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 400,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:11:37</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 10:11:46', NULL, NULL, 1, NULL),
(83, '2409106SiLWyjhIlwardAGAV9utyqKgdT7dI3K6ZoU6ct4deHOKFvlB81725963106', '247650', 'CS MALKIA', '+243858533285', 'send', 'sms', 'parent', 'Reçu paiement frais [245375]', 1, 'RECU No:245375 pour Ketia Mwanabote (2eme Prim). Montant=$ 400 (Frais scolaire - MARS). Infoline: +243858533285', NULL, '2024-09-10 10:11:46', '2024-09-10 10:11:47', NULL, 1, NULL),
(84, '240910PZZ2a9h0jT24Wa0piQ1CVmP9IKlwuoY3wcj6WqDETnv0m7Nc2E1725963106', '248150', 'CS MALKIA', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'RECU No:245375 pour Ketia Mwanabote (2eme Prim). Montant=$ 400 (Frais scolaire - MARS). Infoline: +243858533285', NULL, '2024-09-10 10:11:46', NULL, NULL, NULL, NULL),
(85, '240910eFCvW13bCrcYZuREanoIbm14dNL8GL9B34joJo3ocAhuQ8WQbS1725963182', '249845', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève Ketia Mwanabote', 1, '<p><h3>Perception frais élève - Ketia Mwanabote pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>242035</b> du 10/09/2024 10:12:52</b></p><h5><b>Elève : Ketia Mwanabote Kenia</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE DEMARRAGE INSCRIPTION</td>\r\n					<td>100,00$</td><td>100,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 100,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 100,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:12:55</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 10:12:55 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 10:13:02', NULL, NULL, NULL, NULL),
(86, '240910LFc8RkPtyuV5RqcPgjGmlEINPME2hg8fsDIOlD8vOFqwI2wgss1725963182', '247198', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [242035]', 1, '<h3>Perception frais élève - Ketia Mwanabote pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>242035</b> du 10/09/2024 10:12:52</b></p><h5><b>Elève : Ketia Mwanabote Kenia</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE DEMARRAGE INSCRIPTION</td>\r\n					<td>100,00$</td><td>100,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 100,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 100,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:12:55</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 10:13:02', NULL, NULL, 1, NULL),
(87, '240910mELOFdGN4WvvNiuOo4YIE0jHSWTVJBrkMShoiZ3tpwHph8Agft1725963182', '243288', 'CS MALKIA', '+243858533285', 'send', 'sms', 'parent', 'Reçu paiement frais [242035]', 1, 'RECU No:242035 pour Ketia Mwanabote (2eme Prim). Montant=$ 100 (FRAIS DE DEMARRAGE - INSCRIPTION). Infoline: +243858533285', NULL, '2024-09-10 10:13:02', '2024-09-10 10:13:03', NULL, 1, NULL),
(88, '240910YNc6gBmgEzPdT02n6va3jD1mm8YhWRIohggJhPYppQe8lKpIsu1725963182', '248627', 'CS MALKIA', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'RECU No:242035 pour Ketia Mwanabote (2eme Prim). Montant=$ 100 (FRAIS DE DEMARRAGE - INSCRIPTION). Infoline: +243858533285', NULL, '2024-09-10 10:13:02', NULL, NULL, NULL, NULL),
(89, '240910Bc9N2DIhO7b9okz6mzZVu1yZSULNzo6LCIq8vKl4ViVHLt0zv11725963385', '242501', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève Ketia Mwanabote', 1, '<p><h3>Perception frais élève - Ketia Mwanabote pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>241793</b> du 10/09/2024 10:15:46</b></p><h5><b>Elève : Ketia Mwanabote Kenia</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>140,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 300,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 300,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:16:19</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 10:16:19 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 10:16:25', NULL, NULL, NULL, NULL),
(90, '2409101j5lKBALOEYHAyLGJ2w029RjJozzMqtKHk243j6nPtWIZEsqFs1725963385', '245440', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [241793]', 1, '<h3>Perception frais élève - Ketia Mwanabote pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>241793</b> du 10/09/2024 10:15:46</b></p><h5><b>Elève : Ketia Mwanabote Kenia</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>140,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 300,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 300,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:16:19</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 10:16:25', NULL, NULL, 1, NULL),
(91, '240910R7o0829ekgRzBKCpyCl0WOzyibVugilIKJW6SfyfhZ21rrf0LI1725963385', '246899', 'CS MALKIA', '+243858533285', 'send', 'sms', 'parent', 'Reçu paiement frais [241793]', 1, 'RECU No:241793 pour Ketia Mwanabote (2eme Prim). Montant=$ 300 (Frais scolaire - MAI). Infoline: +243858533285', NULL, '2024-09-10 10:16:25', '2024-09-10 10:16:26', NULL, 1, NULL),
(92, '240910dSF42GiCfHWIYrs3eEdWojmwn7ZH1WkahfzSWFUm81fKIGnHww1725963385', '243738', 'CS MALKIA', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'RECU No:241793 pour Ketia Mwanabote (2eme Prim). Montant=$ 300 (Frais scolaire - MAI). Infoline: +243858533285', NULL, '2024-09-10 10:16:25', NULL, NULL, NULL, NULL),
(93, '240910I9GmwTcuOr59k8DAav27QFIESrSW1RfJKo0IWDGkCVeEvQvuWH1725963654', '240081', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Kabwuik', 1, '<p><h3>Perception frais élève - chipeng Kabwuik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>247959</b> du 10/09/2024 10:19:55</b></p><h5><b>Elève : chipeng Kabwuik Johnny</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Administratif Frais administratif</td>\r\n					<td>30,00$</td><td>30,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 30,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 30,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:20:48</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 10:20:48 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 10:20:54', NULL, NULL, NULL, NULL),
(94, '240910EawyTGDCjv2qVOdKCBGqOK9KMTnh3H50jREy8vgptaRzFMZfnt1725963654', '245351', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [247959]', 1, '<h3>Perception frais élève - chipeng Kabwuik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>247959</b> du 10/09/2024 10:19:55</b></p><h5><b>Elève : chipeng Kabwuik Johnny</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Administratif Frais administratif</td>\r\n					<td>30,00$</td><td>30,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 30,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 30,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:20:48</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 10:20:54', NULL, NULL, 1, NULL),
(95, '240910BvYfhgnic77OHdylVa8CuF1RnHPf07ySsw4n26h1G0O8cnRGdC1725963654', '245421', 'CS MALKIA', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [247959]', 1, 'RECU No:247959 pour chipeng Kabwuik (1ere mat). Montant=$ 30 (Frais administratif). Infoline: +243858533285', NULL, '2024-09-10 10:20:54', '2024-09-10 10:20:55', NULL, 1, NULL),
(96, '240910dkJIMGpQMQArQulC8Asl594eNee1bNviNt3bqIqpPr6288BEWV1725963654', '240995', 'CS MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'RECU No:247959 pour chipeng Kabwuik (1ere mat). Montant=$ 30 (Frais administratif). Infoline: +243858533285', NULL, '2024-09-10 10:20:54', NULL, NULL, NULL, NULL),
(97, '240910ddSlEeG4BANZiDUwHLd5wKTe2SDO5OoHIr0AK4dqoGSKUKB6om1725963714', '248641', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Kabwuik', 1, '<p><h3>Perception frais élève - chipeng Kabwuik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>246701</b> du 10/09/2024 10:21:32</b></p><h5><b>Elève : chipeng Kabwuik Johnny</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>20 000,00Fc</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 35 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 35 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:21:46</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 10:21:46 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 10:21:54', NULL, NULL, NULL, NULL),
(98, '240910tWzkCsQkLQ5gy3pkpjV260fmzaDLJ2MNjUvaelz3MEPbOuLDra1725963714', '240458', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [246701]', 1, '<h3>Perception frais élève - chipeng Kabwuik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>246701</b> du 10/09/2024 10:21:32</b></p><h5><b>Elève : chipeng Kabwuik Johnny</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>20 000,00Fc</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 35 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 35 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:21:46</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 10:21:54', NULL, NULL, 1, NULL),
(99, '240910FeGVDHH1bfpUSlvmAiKDck1MHsu3qn6LffprN8HGR06URpTi0R1725963714', '240717', 'CS MALKIA', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [246701]', 1, 'RECU No:246701 pour chipeng Kabwuik (1ere mat). Montant=Fc 35000 (FRAIS DE L\'ETAT - FIP 2). Infoline: +243858533285', NULL, '2024-09-10 10:21:54', '2024-09-10 10:21:55', NULL, 1, NULL),
(100, '240910WJ4yucDGV88E71bR4NeJEwNvR1SZ3nj3Cu668U9Z4pegyLZNjB1725963714', '243362', 'CS MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'RECU No:246701 pour chipeng Kabwuik (1ere mat). Montant=Fc 35000 (FRAIS DE L\'ETAT - FIP 2). Infoline: +243858533285', NULL, '2024-09-10 10:21:54', NULL, NULL, NULL, NULL),
(101, '240910NIypSmJ0j8gYnVMh0GItLBqYOjfBGGAdE2g87Zejdwu0Fl6AoN1725964932', '249346', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Kabwuik', 1, '<p><h3>Perception frais élève - chipeng Kabwuik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>241743</b> du 10/09/2024 10:41:23</b></p><h5><b>Elève : chipeng Kabwuik Johnny</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>110,00$</td><td>30,00$</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>30,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 300,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 300,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:41:49</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 10:41:49 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 10:42:12', NULL, NULL, NULL, NULL),
(102, '2409104LUjwkYddtF3aNqy0nJhsNBTeQbZvbIDQDdOz61HwGNzeVKokA1725964932', '243780', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [241743]', 1, '<h3>Perception frais élève - chipeng Kabwuik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>241743</b> du 10/09/2024 10:41:23</b></p><h5><b>Elève : chipeng Kabwuik Johnny</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>110,00$</td><td>30,00$</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>30,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 300,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 300,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:41:49</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 10:42:12', NULL, NULL, 1, NULL),
(103, '2409100kHhz4aqsSTQAkBzfRurpjfMEknfYsKP0L9zKIMUMrYTP7L2091725965009', '246921', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Kabwuik', 1, '<p><h3>Perception frais élève - chipeng Kabwuik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>241743</b> du 10/09/2024 10:41:23</b></p><h5><b>Elève : chipeng Kabwuik Johnny</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>110,00$</td><td>30,00$</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>30,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 300,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 300,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:43:22</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 10:43:22 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 10:43:29', NULL, NULL, NULL, NULL),
(104, '240910FLa6YMfpUntOw0F7wwoqEtsfunQjZrhP4JvQDKf6MmCdjwVh9e1725965009', '246983', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [241743]', 1, '<h3>Perception frais élève - chipeng Kabwuik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>241743</b> du 10/09/2024 10:41:23</b></p><h5><b>Elève : chipeng Kabwuik Johnny</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>110,00$</td><td>30,00$</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>30,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 300,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 300,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:43:22</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 10:43:29', NULL, NULL, 1, NULL),
(105, '240910IOMTowb2FslS1dQW4c1YEonDwsh0K65SSu72n31i7TDnRrlchs1725965862', '243151', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Kabwuik', 1, '<p><h3>Perception frais élève - chipeng Kabwuik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>241743</b> du 10/09/2024 10:41:23</b></p><h5><b>Elève : chipeng Kabwuik Johnny</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>110,00$</td><td>30,00$</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>30,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 300,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 300,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:57:36</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 10:57:36 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 10:57:42', NULL, NULL, NULL, NULL),
(106, '2409104NVRLIjlw01QkfnAcLY15DEnGAnSJqS22ppRv5rpySvASOkffb1725965862', '247246', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [241743]', 1, '<h3>Perception frais élève - chipeng Kabwuik pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>241743</b> du 10/09/2024 10:41:23</b></p><h5><b>Elève : chipeng Kabwuik Johnny</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>110,00$</td><td>30,00$</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>30,00$</td><td>0</td></tr><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>120,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 300,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 300,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 10:57:36</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 10:57:42', NULL, NULL, 1, NULL),
(107, '240910ScsD6rIPVNErP1wQt4LOFRNvkmmpTyGmnwRmDIRe24lRrvur3B1725965862', '241322', 'CS MALKIA', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [241743]', 1, 'RECU No:241743 pour chipeng Kabwuik (1ere mat). Montant=$ 300 (Frais scolaire - FRAIS DE L\'ETAT - FIP 2). Infoline: +243858533285', NULL, '2024-09-10 10:57:42', '2024-09-10 10:57:43', NULL, 1, NULL),
(108, '240910zevovc6PkPCzQLr4rkZSB7gL99cVqEbzPDuI3a9eTi9Co9QiJm1725965862', '249462', 'CS MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'RECU No:241743 pour chipeng Kabwuik (1ere mat). Montant=$ 300 (Frais scolaire - FRAIS DE L\'ETAT - FIP 2). Infoline: +243858533285', NULL, '2024-09-10 10:57:42', NULL, NULL, NULL, NULL),
(109, '240910kJNMhTLohBNFIZIyf0YDfyrGHwdfTj3EVJ8AYQ7eUNIgHcRQsZ1725966486', '247247', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Mukeng', 1, '<p><h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>242658</b> du 10/09/2024 11:07:41</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>100,00$</td><td>0</td></tr><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>100,00$</td><td>40,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 350,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 350,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:07:59</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 11:07:59 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 11:08:06', NULL, NULL, NULL, NULL),
(110, '240910UuOsyD8IgPlZOkSyao4PEiK9FR1qswjI95SjJkbwqYQteymQ3z1725966486', '247029', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [242658]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>242658</b> du 10/09/2024 11:07:41</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>100,00$</td><td>0</td></tr><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>100,00$</td><td>40,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 350,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 350,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:07:59</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 11:08:06', NULL, NULL, 1, NULL),
(111, '240910AcjJLTvZG10lBmGgRhtSpRC95n3H5gzqSCrrHFfOSRPWCuPkN61725966486', '243577', 'CS MALKIA', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [242658]', 1, 'RECU No:242658 pour chipeng Mukeng (1ere mat). Montant=$ 350 (Frais scolaire(MARS)). Infoline: +243858533285', NULL, '2024-09-10 11:08:06', '2024-09-10 11:08:07', NULL, 1, NULL),
(112, '240910sy3A3oSngGmH8tJfBdiqMfHbeUQLZJlUNgNjUimBd0L1YraUda1725966486', '240019', 'CS MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'RECU No:242658 pour chipeng Mukeng (1ere mat). Montant=$ 350 (Frais scolaire(MARS)). Infoline: +243858533285', NULL, '2024-09-10 11:08:06', NULL, NULL, NULL, NULL),
(113, '240910emM4CnRt9gaJW2OD8AgvNptI7q0PhyJGGucglPa3BdVk8GbDC61725966796', '243963', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Mukeng', 1, '<p><h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>245128</b> du 10/09/2024 11:13:05</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Administratif Frais administratif</td>\r\n					<td>30,00$</td><td>30,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 30,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 30,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:13:07</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 11:13:07 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 11:13:16', NULL, NULL, NULL, NULL),
(114, '240910Cb8qO8Q8TDndIrT182jCfGTWzivGJy7dYN5uwnHlJzcD5A5AcF1725966796', '248873', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [245128]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>245128</b> du 10/09/2024 11:13:05</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Administratif Frais administratif</td>\r\n					<td>30,00$</td><td>30,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 30,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 30,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:13:07</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 11:13:16', NULL, NULL, 1, NULL),
(115, '2409109g9IRvqG3cZQYniBqLq74zLIHGRqhCNMDhthkkJiCgjiaPmptB1725966796', '249931', 'CS MALKIA', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [245128]', 1, 'RECU No:245128 pour chipeng Mukeng (1ere mat). Montant=$ 30 (()). Infoline: +243858533285', NULL, '2024-09-10 11:13:16', '2024-09-10 11:13:16', NULL, 1, NULL);
INSERT INTO `messages` (`message_id`, `message_token`, `message_code`, `message_sender`, `message_recipient`, `message_status`, `message_type`, `message_category`, `message_subject`, `message_emergency`, `message_body`, `message_attachment`, `message_created_at`, `message_updated_at`, `message_deleted_at`, `message_school_id`, `message_section_id`) VALUES
(116, '240910DkOEpC446a1RKJyJzP6nGo2mOHIFM6IhAT2c5pZNJ94Z8TfyJ61725966796', '243257', 'CS MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'RECU No:245128 pour chipeng Mukeng (1ere mat). Montant=$ 30 (()). Infoline: +243858533285', NULL, '2024-09-10 11:13:16', NULL, NULL, NULL, NULL),
(117, '240910JzlOYyNZq2ld78jSeOMLvYhSvKblFeopv32147jfCPfaYGFRJO1725967117', '240602', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Mukeng', 1, '<p><h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248295</b> du 10/09/2024 11:18:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>10 000,00Fc</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 25 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 25 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:18:29</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 11:18:29 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 11:18:37', NULL, NULL, NULL, NULL),
(118, '240910O4cgyCEiNhd8zohIas5Z4bkWtne9Mcvyn0h1jCji3kBZCj4pkb1725967117', '247833', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [248295]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248295</b> du 10/09/2024 11:18:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>10 000,00Fc</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 25 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 25 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:18:29</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 11:18:37', NULL, NULL, 1, NULL),
(119, '2409104fzpg3I2SOYmjLz67VZEwJvmZhy8mFPsc6dlGItl4lRAKZU9261725967537', '241079', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Mukeng', 1, '<p><h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248295</b> du 10/09/2024 11:18:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>10 000,00Fc</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 25 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 25 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:25:28</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 11:25:28 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 11:25:37', NULL, NULL, NULL, NULL),
(120, '240910m4dNuy7bSik63YMYu8lwHfTYcOQIfYywBRQ894cvqsoqgka3kk1725967537', '246697', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [248295]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248295</b> du 10/09/2024 11:18:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>10 000,00Fc</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 25 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 25 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:25:28</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 11:25:37', NULL, NULL, 1, NULL),
(121, '240910LvmK4WafFdzyQzFuoCWoI2oyjM4p2h5JDHVtatPAbWneNCeRTJ1725967604', '245891', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Mukeng', 1, '<p><h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248295</b> du 10/09/2024 11:18:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>10 000,00Fc</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 25 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 25 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:26:37</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 11:26:37 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 11:26:44', NULL, NULL, NULL, NULL),
(122, '240910bQG3Ry6YwfU1VlvYbB8Qh0ycF6W1rqEEycp97lUY8obzhwMzED1725967604', '245471', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [248295]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248295</b> du 10/09/2024 11:18:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>10 000,00Fc</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 25 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 25 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:26:37</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 11:26:44', NULL, NULL, 1, NULL),
(123, '2409102jLpCbULqjWjwfuLTPeA57lJhEJ4abdkJOR9vq3DEyiHhVppke1725967690', '248608', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Mukeng', 1, '<p><h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248295</b> du 10/09/2024 11:18:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>10 000,00Fc</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 25 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 25 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:28:03</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 11:28:03 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 11:28:10', NULL, NULL, NULL, NULL),
(124, '240910rwJ7OMfZT4GoBPDahMOfewZjoVfeSqkUVkue225RcOGVKQF2a51725967690', '245446', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [248295]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248295</b> du 10/09/2024 11:18:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>10 000,00Fc</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 25 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 25 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:28:03</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 11:28:10', NULL, NULL, 1, NULL),
(125, '240910dZfbzO4yJo220Zb3vJuOAlpGAUJeW0nAttYk4myNjU8yTQTaZQ1725967764', '247483', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Mukeng', 1, '<p><h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248295</b> du 10/09/2024 11:18:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>10 000,00Fc</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 25 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 25 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:29:15</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 11:29:15 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 11:29:24', NULL, NULL, NULL, NULL),
(126, '240910r1jGwwnsYlJWvrDBRltDgH8542gFeQFNDmiBT5Y4yZZbzi5QIg1725967764', '240496', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [248295]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248295</b> du 10/09/2024 11:18:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 1</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>10 000,00Fc</td><td>10 000,00Fc</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 25 000,00</b></td><td><b>$ 0,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 25 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 10-09-2024 à 11:29:15</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-10 11:29:24', NULL, NULL, 1, NULL),
(127, '240910OQ0md4we8f5imzjrhjZSmlWcIrjrR8c2RfbSDJ6lLkovF3RtkU1725978919', '240965', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'system', 'Réinitialisation du mot de passe par un administrateur', 1, '<p><h3>Réinitialisation du mot de passe </h3>\r\n                            <p> Bonjour cher utilisateur Mumba vivien. Nous avons constaté que votre mot de passe a été réinitialisé par votre administrateur \r\n                             en date du 10/09/2024.<br/>\r\n                            Ne tenez pas compte de cette notification si c\'était vous-même.\r\n                            </p>\r\n                                <br/> <br/> <br/>\r\n                             <p style=\"text-align:center!important;\">\r\n                                <a href=\"http://localhost/web/aschool-manager/auth\"\r\n                                style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\r\n                                  color: white!important;\r\n                                  text-align:center!important;\r\n                                  background: #ff7e17!important;\r\n                                  text-transform: uppercase;\r\n                                  text-decoration: none;\r\n                                  word-wrap: break-word;\r\n                                  white-space: normal;\r\n                                  cursor: pointer;\r\n                                  border: 0;\r\n                                  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\r\n                                  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\r\n                                  border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\r\n                                   border-radius: 100px!important\"> Accèder à mon compte pour le sécuriser</a>\r\n                            </p><hr> <br/> <br/></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 10/09/2024 14:35:01 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-10 14:35:19', NULL, NULL, NULL, NULL),
(128, '240912vdGDbtOpe7D1tz2ECUPrVO8OSpgR7Hvjg3aTLJR4aBGH3WUwr51726125993', '244903', 'magschool@ditotase.com', 'eliemwez.rubuz@gmail.com', 'send', 'email', 'system', 'Frais payé de l\'élève kayind chipeng', 1, '<p><h3>Perception frais élève - kayind chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>242198</b> du 12/09/2024 07:25:23</b></p><h5><b>Elève : kayind chipeng myriam</b></h5><h5> Classe: 1ere B Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>20 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 3</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 20 000,00</b></td><td><b>$ 10,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 35 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 13 400,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Thursday 12-09-2024 à 07:26:26</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr> \n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 12/09/2024 07:26:26 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 129.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-09-12 07:26:33', NULL, NULL, NULL, NULL),
(129, '24091246RucnJOBagDOY341ad8E6turqp0Rr2Zo0uHhm0i13zrQUhkTa1726125993', '246887', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'actif', 'email', 'parent', 'Reçu paiement frais [242198]', 1, '<h3>Perception frais élève - kayind chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>242198</b> du 12/09/2024 07:25:23</b></p><h5><b>Elève : kayind chipeng myriam</b></h5><h5> Classe: 1ere B Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE L\'ETAT FIP 2</td>\r\n					<td>20 000,00Fc</td><td>20 000,00Fc</td><td>0</td></tr><tr> <td>FRAIS DE L\'ETAT FIP 3</td>\r\n					<td>15 000,00Fc</td><td>15 000,00Fc</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 20 000,00</b></td><td><b>$ 10,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 35 000,00</b></td><td><b>$ - 0,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 13 400,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Thursday 12-09-2024 à 07:26:26</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-12 07:26:33', NULL, NULL, 1, NULL),
(130, '240912HAjmNv5Lphjyutkh9ogvCCn6P6Aq4Z7WpzHpW1fioWTSPvMRKM1726125993', '243033', 'CS MALKIA', '+243821733330', 'send', 'sms', 'parent', 'Reçu paiement frais [242198]', 1, 'Reçu No:242198 pour kayind chipeng (1ere B Maternelle). Montant=Fc 35000 (FRAIS DE L\'ETAT(FIP 3)). Infoline: +243858533285', NULL, '2024-09-12 07:26:33', '2024-09-12 07:26:34', NULL, 1, NULL),
(131, '240912sYgoCWNE6CGATyGzCTRFL5lzc0KpeID4zkBp9spuyP0amlZhTA1726125993', '249814', 'CS MALKIA', '+243821733330', 'send', 'sms', 'system', 'SMS Broadcast TO +243821733330', 1, 'Reçu No:242198 pour kayind chipeng (1ere B Maternelle). Montant=Fc 35000 (FRAIS DE L\'ETAT(FIP 3)). Infoline: +243858533285', NULL, '2024-09-12 07:26:33', NULL, NULL, NULL, NULL),
(132, '240916zPPglUIHaEr5TkDBCH3w5OelkZtF5D3l5DqZ2MCIf6wY0pKopQ1726499903', '246504', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [248897]', 1, '<h3>Perception frais élève - chipeng rumbu pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>248897</b> du 16/09/2024 15:18:01</b></p><h5><b>Elève : chipeng rumbu MIke</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>110,00$</td><td>100,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 100,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 100,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Monday 16-09-2024 à 15:18:03</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-16 15:18:23', NULL, NULL, 1, NULL),
(133, '2409163a4NvFQ4DSLpbFcu1MYfAQH4uifAnA44Y98pmTpcF7tArEFlaM1726499903', '246058', 'CS MALKIA', '+243858533285', 'send', 'sms', 'parent', 'Reçu paiement frais [248897]', 1, 'Reçu No:248897 pour chipeng rumbu (1ere a mat). Montant=$ 100 (Frais scolaire(FEVRIER)). Infoline: +243858533285', NULL, '2024-09-16 15:18:23', '2024-09-16 15:18:43', NULL, 1, NULL),
(134, '240916Tf9rpMyo99hFTWnsY5ZOTmFdKnkBzqSzcKI8YndylgyjHr8eAn1726499903', '240010', 'CS MALKIA', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'Reçu No:248897 pour chipeng rumbu (1ere a mat). Montant=$ 100 (Frais scolaire(FEVRIER)). Infoline: +243858533285', NULL, '2024-09-16 15:18:23', NULL, NULL, NULL, NULL),
(135, '240919nY3U0TUBjEjtJwHMuUguOjJ86NShWbotMTgGud0A8yeVhCCFdp1726750528', '244136', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [240097]', 1, '<h3>Perception frais élève - chipeng rumbu pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école School DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>240097</b> du 19/09/2024 12:55:10</b></p><h5><b>Elève : chipeng rumbu MIke</b></h5><h5> Classe: 1ere A Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>140,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 100 000,00</b></td><td><b>$ 110,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 140,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =5,21</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Thursday 19-09-2024 à 12:55:28</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-19 12:55:28', NULL, NULL, 1, NULL),
(136, '240919kF96ACYJ6eJB4E4QOo7zuabRgUu2krYjBi3mRflPcsQtWuvwsQ1726750528', '240402', 'CS MALKIA', '+243858533285', 'send', 'sms', 'parent', 'Reçu paiement frais [240097]', 1, 'Reçu No:240097 pour chipeng rumbu (1ere a mat). Montant=$ 140 (Frais scolaire(MARS)). Infoline: +243858533285', NULL, '2024-09-19 12:55:28', '2024-09-19 12:55:29', NULL, 1, NULL),
(137, '2409198uRZIIAmH9hIhN1ycnJ9ZDcgZDhKBLAVOb93W7BEGLnGyWvbbC1726750528', '244297', 'CS MALKIA', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'Reçu No:240097 pour chipeng rumbu (1ere a mat). Montant=$ 140 (Frais scolaire(MARS)). Infoline: +243858533285', NULL, '2024-09-19 12:55:28', NULL, NULL, NULL, NULL),
(138, '240921Yq66WNrMILDaqkBTAjv8EKTfn6yiL41LKBb2Aul5ScybbYE5VN1726917072', '246056', 'contact@ditotase.com', 'vivien.mumba@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [246479]', 1, '<h3>Perception frais élève - MUMBA MUMBA pour l\'année 2023-2024</h3><p>Cher parent dany mumba suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>246479</b> du 21/09/2024 13:10:56</b></p><h5><b>Elève : MUMBA MUMBA Vikyasoft</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Administratif Frais administratif</td>\r\n					<td>30,00$</td><td>30,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 50,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 30,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =20,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Saturday 21-09-2024 à 13:11:12</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-21 13:11:12', NULL, NULL, 1, NULL),
(139, '240921QTd5iautGpyOqnmBQ3iGLvw1Z4F2l2omdCQvJnTeMeJuMt47jC1726917072', '243913', 'CS MALKIA', '+243997276670', 'send', 'sms', 'parent', 'Reçu paiement frais [246479]', 1, 'Reçu No:246479 pour MUMBA MUMBA (2eme Prim). Montant=$ 30 (Administratif(Frais administratif)). Infoline: +243858533285', NULL, '2024-09-21 13:11:12', '2024-09-21 13:11:15', NULL, 1, NULL),
(140, '240921gIrRYuqMzcrMkagbhn1hu54BtNvuFPSZlVb6PKcdmhljCuIPGr1726917072', '241493', 'CS MALKIA', '+243997276670', 'send', 'sms', 'system', 'SMS Broadcast TO +243997276670', 1, 'Reçu No:246479 pour MUMBA MUMBA (2eme Prim). Montant=$ 30 (Administratif(Frais administratif)). Infoline: +243858533285', NULL, '2024-09-21 13:11:12', NULL, NULL, 1, NULL),
(141, '240921KHSFflJUg5ZNAF4SIwo7UwmDZEJRGMbWwI4vZVFOMU2eFyOvBz1726921907', '245800', 'contact@ditotase.com', 'vivien.mumba@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [245282]', 1, '<h3>Perception frais élève - MUMBA MUMBA pour l\'année 2023-2024</h3><p>Cher parent dany mumba suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>245282</b> du 21/09/2024 14:30:32</b></p><h5><b>Elève : MUMBA MUMBA Vikyasoft</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>140,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>45,21$</td><td>94,79$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 250 000,00</b></td><td><b>$ 410,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 485,21 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =12,82</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Saturday 21-09-2024 à 14:31:47</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-21 14:31:47', NULL, NULL, 1, NULL),
(142, '240921aWkSjK449PlWpE1zdVfqLaMYSZ5GyG3Te8Q7v4lCYK8yrTvYEt1726921907', '248091', 'CS MALKIA', '+243997276670', 'send', 'sms', 'parent', 'Reçu paiement frais [245282]', 1, 'Reçu No:245282 pour MUMBA MUMBA (2eme Prim). Montant=$ 485.21 (Frais scolaire(AVRIL)). Infoline: +243858533285', NULL, '2024-09-21 14:31:47', '2024-09-21 14:31:48', NULL, 1, NULL),
(143, '240921R99SIGNUiLKNpjQkYlMBtau8zLSAcn9E0Rnd9LY4YB8E748GtF1726921907', '244242', 'CS MALKIA', '+243997276670', 'send', 'sms', 'system', 'SMS Broadcast TO +243997276670', 1, 'Reçu No:245282 pour MUMBA MUMBA (2eme Prim). Montant=$ 485.21 (Frais scolaire(AVRIL)). Infoline: +243858533285', NULL, '2024-09-21 14:31:47', NULL, NULL, 1, NULL),
(144, '240925Fmoug1Ca4dIotZWs1JE7zNveRaZ7bE7jLH5y7Evre3Qg6pKer81727265572', '248257', 'contact@ditotase.com', '+243858533285', 'send', 'sms', 'parent', 'SMS', 1, 'Bonjour cher parent', NULL, '2024-09-25 13:59:32', '2024-09-25 13:59:33', NULL, 1, NULL),
(145, '240925qEjNe757fuMd3YnhEAmA6jsi28W40JkPQ4NhRQm2HjPgvsp5al1727265572', '247368', 'CS MALKIA', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'Bonjour cher parent. Infoline: +243858533285', NULL, '2024-09-25 13:59:32', NULL, NULL, 1, NULL),
(146, '240925jlWeCSIeg9JNF3im744p93h2ps2LNJo0o6ClbVgdtiteIEfgez1727273828', '243276', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [249903]', 1, '<h3>Perception frais élève - Manyong rubuz pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>249903</b> du 25/09/2024 16:15:38</b></p><h5><b>Elève : Manyong rubuz Preefina</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Administratif Frais administratif</td>\r\n					<td>30,00$</td><td>30,00$</td><td>0</td></tr><tr> <td>FRAIS DE DEMARRAGE INSCRIPTION</td>\r\n					<td>100,00$</td><td>100,00$</td><td>0</td></tr><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,56$</td><td>99,44$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 30 000,00</b></td><td><b>$ 460,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 470,56 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 25-09-2024 à 16:17:08</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-25 16:17:08', NULL, NULL, 1, NULL),
(147, '240925DsIOMUlMGt0uTeSQltT2j3RVtzOcIJopzNluWrRtgyebaRELd91727273828', '242409', 'CS MALKIA', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [249903] manyong melanie', 1, 'Cher parent, le reçu:249903 pour votre enfant: Manyong rubuz (CI24986)de la 2eme Primdont:Frais administratif=30 $INSCRIPTION=100 $JANVIER=150 $FEVRIER=150 $MARS=41 $Infoline:+243858533285', NULL, '2024-09-25 16:17:08', '2024-09-25 16:17:10', NULL, 1, NULL),
(148, '240925wD1ChhurTZ4aIWJz9LIaOumpV5FgdlVpmzpm3v5pQyuLnHWbiq1727273828', '244432', 'CS MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Cher parent, le reçu:249903 pour votre enfant: Manyong rubuz (CI24986)de la 2eme Primdont:Frais administratif=30 $INSCRIPTION=100 $JANVIER=150 $FEVRIER=150 $MARS=41 $Infoline:+243858533285', NULL, '2024-09-25 16:17:08', NULL, NULL, 1, NULL),
(149, '240925FydrsYBF3J4PpLsq3VfKTCT9rH0aknnckwJdlaBnH9BrtKpQau1727274798', '245488', 'contact@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'parent', 'Reçu paiement frais [240434]', 1, '<h3>Perception frais élève - Manyong rubuz pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>240434</b> du 25/09/2024 16:33:01</b></p><h5><b>Elève : Manyong rubuz Preefina</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>99,44$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>100,00$</td><td>40,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 200,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 199,44 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,56</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 25-09-2024 à 16:33:18</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-09-25 16:33:18', '2024-10-01 14:18:48', NULL, 1, NULL),
(150, '240925Mubqr2VPKKYrS4d0R3M29s80RNTiSJrj76wewnGjbAtKy9pLC51727274798', '245179', 'CS MALKIA', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [240434] manyong melanie', 1, 'Reçu:240434 de votre enfant: Manyong rubuz de la 2eme Prim. Dont: Frais scolaire(MARS)=99.44$\\n Frais scolaire(AVRIL)=100.00$\\n. Infoline:+243858533285', NULL, '2024-09-25 16:33:18', '2024-09-25 16:33:21', NULL, 1, NULL),
(151, '240925Iz2smJlspWwHjhAuIeKmFHogOozOPt6LzaQyz9zvHwS997DRoM1727274798', '249170', 'CS MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Reçu:240434 de votre enfant: Manyong rubuz de la 2eme Prim. Dont: Frais scolaire(MARS)=99.44$\\n Frais scolaire(AVRIL)=100.00$\\n. Infoline:+243858533285', NULL, '2024-09-25 16:33:18', NULL, NULL, 1, NULL),
(152, '241001hBfvuM7QsarYRfq0vpZdMuWZiGhjq84O2hTMFNjZrcAPpW4uEV1727776572', '242800', 'magschool@ditotase.com', 'vivien.mumba@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève Kasongo Kitala', 1, '<p><h3>Perception frais élève - Kasongo Kitala pour l\'année 2023-2024</h3><p>Cher parent dany mumba suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>245832</b> du 01/10/2024 11:46:08</b></p><h5><b>Elève : Kasongo Kitala Jean</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>130,00$</td><td>130,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 280,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 280,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 01-10-2024 à 11:56:06</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/10/2024 11:56:06 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 130.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-01 11:56:12', NULL, NULL, 1, NULL),
(153, '241001Fi00wUJbyjhLnfYqBLpKqNZLWE29uJKnnZK6reQedMLRiNV0cT1727776572', '245606', 'contact@ditotase.com', 'vivien.mumba@ditotase.com', 'actif', 'email', 'parent', 'Reçu paiement frais [245832]', 1, '<h3>Perception frais élève - Kasongo Kitala pour l\'année 2023-2024</h3><p>Cher parent dany mumba suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>245832</b> du 01/10/2024 11:46:08</b></p><h5><b>Elève : Kasongo Kitala Jean</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>130,00$</td><td>130,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 280,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 280,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 01-10-2024 à 11:56:06</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-10-01 11:56:12', NULL, NULL, 1, NULL),
(154, '241001PoOaTK9pmZkzFgH6HS4GqnS1iJH8t4BMc5vSlrEuOygVh05N3f1727776572', '242022', 'CS MALKIA', '+243997276670', 'send', 'sms', 'parent', 'Reçu paiement frais [245832] dany mumba', 1, 'Reçu:245832 de votre enfant: Kasongo Kitala(2eme Prim): Frais scolaire(JANVIER)=150.00$ - Frais scolaire(JANVIER)=130.00$ - Infos:+243858533285', NULL, '2024-10-01 11:56:12', '2024-10-01 11:56:14', NULL, 1, NULL),
(155, '2410014n9AwZIiugmYz8QnL0DH87UBomlAvMbTBczzhpwWNWwu0E9GBe1727776572', '247149', 'CS MALKIA', '+243997276670', 'send', 'sms', 'system', 'SMS Broadcast TO +243997276670', 1, 'Reçu:245832 de votre enfant: Kasongo Kitala(2eme Prim): Frais scolaire(JANVIER)=150.00$ - Frais scolaire(JANVIER)=130.00$ - Infos:+243858533285', NULL, '2024-10-01 11:56:12', NULL, NULL, 1, NULL),
(156, '241001OV6sWkDVSobzMOPO7HphWpu1gHTm9Pq94mijbHkAOjilUeE6OA1727777797', '246955', 'magschool@ditotase.com', 'eliemwez.rubuz@gmail.com', 'send', 'email', 'system', 'Frais payé de l\'élève kayind chipeng', 1, '<p><h3>Perception frais élève - kayind chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>246372</b> du 01/10/2024 12:16:12</b></p><h5><b>Elève : kayind chipeng myriam</b></h5><h5> Classe: 1ere B Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 40,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 40,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 01-10-2024 à 12:16:31</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/10/2024 12:16:31 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 130.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-01 12:16:37', NULL, NULL, 1, NULL),
(157, '241001HoZ4smhK9qN5Jdmq6nfsQelVDyRVztBkBPc4WlLvE1JTb7wUke1727777797', '240102', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'actif', 'email', 'parent', 'Reçu paiement frais [246372]', 1, '<h3>Perception frais élève - kayind chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>246372</b> du 01/10/2024 12:16:12</b></p><h5><b>Elève : kayind chipeng myriam</b></h5><h5> Classe: 1ere B Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 40,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 40,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 01-10-2024 à 12:16:31</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-10-01 12:16:37', NULL, NULL, 1, NULL),
(158, '241001WbRfe2wQ4PCEhQ2uKyQnJ65LFvW3sujb3PghJ9PCPn7yii9tcG1727777797', '242813', 'CS MALKIA', '+243821733330', 'send', 'sms', 'parent', 'Reçu paiement frais [246372] kachak sarah', 1, 'Reçu:246372 de votre enfant: kayind chipeng(1ere B Maternelle): Frais scolaire(MARS)=40.00$ - Infos:+243858533285', NULL, '2024-10-01 12:16:37', '2024-10-01 12:16:38', NULL, 1, NULL),
(159, '241001YFOdkm8KfzyulMADyKgf5G4a7Kr6dowrIirzOCbNmAJWsI8DDy1727777797', '242164', 'CS MALKIA', '+243821733330', 'send', 'sms', 'system', 'SMS Broadcast TO +243821733330', 1, 'Reçu:246372 de votre enfant: kayind chipeng(1ere B Maternelle): Frais scolaire(MARS)=40.00$ - Infos:+243858533285', NULL, '2024-10-01 12:16:37', NULL, NULL, 1, NULL);
INSERT INTO `messages` (`message_id`, `message_token`, `message_code`, `message_sender`, `message_recipient`, `message_status`, `message_type`, `message_category`, `message_subject`, `message_emergency`, `message_body`, `message_attachment`, `message_created_at`, `message_updated_at`, `message_deleted_at`, `message_school_id`, `message_section_id`) VALUES
(160, '241001ZJoyHgMH49zdeChHRbVYEboGuv7VsnG5gf7aGEkWRd62nmf7Rk1727783227', '247534', 'magschool@ditotase.com', 'eliemwez.rubuz@gmail.com', 'send', 'email', 'system', 'Frais payé de l\'élève kayind chipeng', 1, '<p><h3>Perception frais élève - kayind chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>249402</b> du 01/10/2024 13:46:53</b></p><h5><b>Elève : kayind chipeng myriam</b></h5><h5> Classe: 1ere B Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Administratif Frais administratif</td>\r\n					<td>30,00$</td><td>30,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 60,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 30,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =30,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 01-10-2024 à 13:46:57</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/10/2024 13:46:57 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 130.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-01 13:47:07', NULL, NULL, 1, NULL),
(161, '241001bkgf8wPQAh1D1VAlhkfmYC8oJUPUg1L9uKnvIEj2bKn6uyYiWQ1727783227', '246422', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'actif', 'email', 'parent', 'Reçu paiement frais [249402]', 1, '<h3>Perception frais élève - kayind chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>249402</b> du 01/10/2024 13:46:53</b></p><h5><b>Elève : kayind chipeng myriam</b></h5><h5> Classe: 1ere B Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Administratif Frais administratif</td>\r\n					<td>30,00$</td><td>30,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 60,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 30,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =30,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Tuesday 01-10-2024 à 13:46:57</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-10-01 13:47:07', NULL, NULL, 1, NULL),
(162, '241001bMDedC8OWpgpqozHyoWaFGgLzoIDUb1ljeAKyjON8HueVds0bg1727783227', '242620', 'CS MALKIA', '+243821733330', 'send', 'sms', 'parent', 'Reçu paiement frais [249402] kachak sarah', 1, 'Reçu:249402 de votre enfant: kayind chipeng(1ere B Maternelle): Frais administratif=30.00$ - Infos:+243858533285', NULL, '2024-10-01 13:47:07', '2024-10-01 13:47:09', NULL, 1, NULL),
(163, '241001ZoGEkdU6aD8Wl9qfhOiPKJDUZ2Yun8mvgVTCA1JkFHCjCe3sw11727783227', '242481', 'CS MALKIA', '+243821733330', 'send', 'sms', 'system', 'SMS Broadcast TO +243821733330', 1, 'Reçu:249402 de votre enfant: kayind chipeng(1ere B Maternelle): Frais administratif=30.00$ - Infos:+243858533285', NULL, '2024-10-01 13:47:07', NULL, NULL, 1, NULL),
(164, '2410014Km4dD1yo8R2vf9QRzjUAFiR0QGHZpdt1wEn6QdOeVLYHcjdLp1727785128', '247623', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Reçu paiement frais [240434] de l\'école CS DITOTASE', 1, '<p> <h3>Perception frais élève - Manyong rubuz pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>240434</b> du 25/09/2024 16:33:01</b></p><h5><b>Elève : Manyong rubuz Preefina</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>99,44$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>100,00$</td><td>40,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 200,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 199,44 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,56</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Wednesday 25-09-2024 à 16:33:18</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p> <hr/>\n                        <p>Cher parent, vous recevez ce message de la part de contact@ditotase.com car vous etes indiqué en tant que responsable direct des enfants inscrits à notre <b>école CS DITOTASE pour l\'année 2023-2024</b></p> \n                        <hr/>\n                        <p>Contacts école - <b>Téléphone: +243858533285 | E-mail: contact@ditotase.com</b></p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/10/2024 14:18:41 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 130.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-01 14:18:48', NULL, NULL, 1, NULL),
(165, '241002svykygdjsFJJY7LjtFBZUdpveMEgPORWy3vm7Jn1THgPLuLhDn1727863589', '249810', 'magschool@ditotase.com', 'contact@ditotase.com', 'send', 'email', 'system', 'Les identifiants de connexion', 1, '<p><h3>Les identifiants de connexion à votre espace de travail</h3>\r\n                            <p>Bonjour cher preegana chipeng. Un compte utilisateur a été créé par votre administrateur \r\n                            <b></b> pour accèder au système logiciel <b>Eduschool</b></p>.\r\n                            <p>Voici vos identifiants de connexion à l\'application <b>Eduschool</b>.\r\n                    <ul><li>Votre pseudo(login): <b>preegana</b></li>\r\n                    <li>Votre Téléphone: <b>+243858533200</b> </li>\r\n                    <li>Votre email: <b>contact@ditotase.com</b> </li>\r\n                    <li>Votre mot de passe est: <b>+243858533200</b></li>. \r\n                    </ul>\r\n                    Nous vous prions de garder secret ses informations, \r\n                    car votre sécurité en dépend! . En cas d\'une erreur, veuillez le signaler immediatement.\r\n                            </p>\r\n                                <br/> <br/> <br/>\r\n                             <p style=\"text-align:center!important;\">\r\n                                <a href=\"http://localhost/web/aschool-manager/auth\"\r\n                                style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\r\n                                  color: white!important;\r\n                                  text-align:center!important;\r\n                                  background: #ff7e17!important;\r\n                                  text-transform: uppercase;\r\n                                  text-decoration: none;\r\n                                  word-wrap: break-word;\r\n                                  white-space: normal;\r\n                                  cursor: pointer;\r\n                                  border: 0;\r\n                                  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\r\n                                  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\r\n                                  border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\r\n                                   border-radius: 100px!important\"> Accèder à mon compte</a>\r\n                            </p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 02/10/2024 12:06:22 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 130.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-02 12:06:29', NULL, NULL, 1, NULL),
(166, '241002tjFh0LEvnElfeK4TyB9fMm2bJo0B6l3jELItRROTqmvEaKDspr1727873486', '243464', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Magschool Access Root', 1, '<p>244078</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 02/10/2024 14:51:20 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 130.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-02 14:51:26', NULL, NULL, NULL, NULL),
(167, '241002Lm6VqKA7W3gA9GrNpPqJueUDf6hA6IJpNl2sI0IhBqkkNu6jLa1727874024', '249896', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Magschool Access Root', 1, '<p>245614</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 02/10/2024 15:00:19 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 130.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-02 15:00:24', NULL, NULL, NULL, NULL),
(168, '241022cSK46Mtqvb4lQZ6MZHqkc0Z6TnOnm4ki7QttOesZjmCYIqE6fN1729582734', '244923', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 22/10/2024 09:38:47 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-22 09:38:54', NULL, NULL, 1, NULL),
(169, '241022TpF1UBMlwahjhLt5Mw5rodOMV0U1WDUWm8dqWPEg0oYKn3fcmh1729583123', '247028', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 22/10/2024 09:45:13 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-22 09:45:23', NULL, NULL, 1, NULL),
(170, '241022R8DrP3aVY5j7mKEpb9QcNa9hDpZwBEqcd45KP1ueYqGZOi1JO21729583544', '240547', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 22/10/2024 09:52:13 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-22 09:52:24', NULL, NULL, 1, NULL),
(171, '241024iL5ZzVIMLlkDVqVCFccpkKBbSae1FtcRhuRUvRPbcpYRBmP3Sl1729769880', '241782', 'contact@ditotase.com', '+243977090011', 'send', 'sms', 'parent', 'SMS', 1, 'DREAM DIGITAL API ON MAGSCHOOL', NULL, '2024-10-24 13:38:00', '2024-10-24 13:40:03', NULL, 1, NULL),
(172, '241024GyniENzvvecqZdaPDIGtKO2COVwViffuep0i6n6LkvHJb3bzee1729769880', '242591', 'CS.MALKIA', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'DREAM DIGITAL API ON MAGSCHOOL. Infoline: +243858533285', NULL, '2024-10-24 13:38:00', NULL, NULL, 1, NULL),
(173, '241024IVFIwKKjuUH7TZ7yBcLhC8HQMkh9BYO8VVoWcz9FtomjjHak6I1729770003', '243890', 'CS DITOTASE', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'DREAM DIGITAL API ON MAGSCHOOL', NULL, '2024-10-24 13:40:03', NULL, NULL, 1, NULL),
(174, '241024iQp0dTVTH3lS2SDPDQF8GW2tayImvuNJ4HJRs72kzAN5iIu0FE1729770115', '243076', 'contact@ditotase.com', '+243858533285', 'send', 'sms', 'parent', 'SMS', 1, 'Salut elie Dream Digital Api', NULL, '2024-10-24 13:41:55', '2024-10-24 13:41:55', NULL, 1, NULL),
(175, '241024JIvuYYhP4lhcPnwT3PHWT6Dkc87M2AyYSgzoq6YK2K9qdYELdf1729770115', '247963', 'DITOTASE', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'Salut elie Dream Digital Api. Infoline: +243858533285', NULL, '2024-10-24 13:41:55', NULL, NULL, 1, NULL),
(176, '241024pVsEbI7Ad5o4yH8BDWHr0AakMFFBqflTDLr70C0U8AA6nAggHH1729772571', '248495', 'contact@ditotase.com', '+243858533285', 'send', 'sms', 'parent', 'SMS', 1, 'SMS VIA DREAM DIGITAL API', NULL, '2024-10-24 14:22:51', '2024-10-24 14:22:53', NULL, 1, NULL),
(177, '241024NWkDylzlirrqQgkV2a0aihjvwZktLbBb79CveC5RqRcsNwiuZR1729772571', '240242', 'DITOTASE', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'SMS VIA DREAM DIGITAL API. Infoline: +243858533285', NULL, '2024-10-24 14:22:51', NULL, NULL, 1, NULL),
(178, '2410240py0bTIvrinrJiWIG9qTksTrRZUM4eI2Sbjd1UUCmRQtaiRnWJ1729772685', '240370', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève chipeng Mukeng', 1, '<p><h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>247234</b> du 24/10/2024 14:24:00</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>140,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 180,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 180,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Thursday 24-10-2024 à 14:24:34</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 24/10/2024 14:24:34 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-24 14:24:45', NULL, NULL, 1, NULL),
(179, '2410248DLt2ANfKjqIUgllIEsEb7p5KtjqLyAdOvBC3zYKHYc5cVVbQU1729772685', '244384', 'contact@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'parent', 'Reçu paiement frais [247234]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>247234</b> du 24/10/2024 14:24:00</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>40,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>140,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 180,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 180,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Thursday 24-10-2024 à 14:24:34</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-10-24 14:24:45', NULL, NULL, 1, NULL),
(180, '241024DVVMzccOYDMO9ZI9MgBpt0edkmAcYmP4VdDZgfjLrPP9Plg4hh1729772685', '247913', 'DITOTASE', '+243977090011', 'send', 'sms', 'parent', 'Reçu paiement frais [247234] manyong melanie', 1, 'Reçu:247234 de votre enfant: chipeng Mukeng(1ere mat): Frais scolaire(MARS)=40.00$ - Frais scolaire(AVRIL)=140.00$ - Infos:+243858533285', NULL, '2024-10-24 14:24:45', '2024-10-24 14:24:47', NULL, 1, NULL),
(181, '241024EjqWNyBqICT4cPjSYGUifulfrn5smpIzyCykzw9SlM4ly2lZPi1729772685', '247507', 'DITOTASE', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Reçu:247234 de votre enfant: chipeng Mukeng(1ere mat): Frais scolaire(MARS)=40.00$ - Frais scolaire(AVRIL)=140.00$ - Infos:+243858533285', NULL, '2024-10-24 14:24:45', NULL, NULL, 1, NULL),
(182, '241024yd6uKlDzzv0k9vYbo5eneVJi6wG0YN71w6B2bGvElgqH6F8Auk1729772812', '242522', 'magschool@ditotase.com', 'vivien.mumba@ditotase.com', 'send', 'email', 'system', 'Frais payé de l\'élève MUMBA MUMBA', 1, '<p><h3>Perception frais élève - MUMBA MUMBA pour l\'année 2023-2024</h3><p>Cher parent dany mumba suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>249420</b> du 24/10/2024 14:26:27</b></p><h5><b>Elève : MUMBA MUMBA Vikyasoft</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE DEMARRAGE INSCRIPTION</td>\r\n					<td>100,00$</td><td>100,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>94,79$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 200,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 194,79 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =5,21</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Thursday 24-10-2024 à 14:26:39</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 24/10/2024 14:26:39 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-24 14:26:52', NULL, NULL, 1, NULL),
(183, '241024lyWzSLAZKuh5kwCJWH9cn49YRI8clPdm8q6RjAA4PzCmwe2UpM1729772812', '244134', 'contact@ditotase.com', 'vivien.mumba@ditotase.com', 'send', 'email', 'parent', 'Reçu paiement frais [249420]', 1, '<h3>Perception frais élève - MUMBA MUMBA pour l\'année 2023-2024</h3><p>Cher parent dany mumba suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>249420</b> du 24/10/2024 14:26:27</b></p><h5><b>Elève : MUMBA MUMBA Vikyasoft</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>FRAIS DE DEMARRAGE INSCRIPTION</td>\r\n					<td>100,00$</td><td>100,00$</td><td>0</td></tr><tr> <td>Frais scolaire AVRIL</td>\r\n					<td>140,00$</td><td>94,79$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 200,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 194,79 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =5,21</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Thursday 24-10-2024 à 14:26:39</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-10-24 14:26:52', NULL, NULL, 1, NULL),
(184, '241024G1A31KNAaUBU4Omlq8NC7gyV4Iohk96KblG27D7Bs0TWQ5A0TM1729772812', '242260', 'DITOTASE', '+243997276670', 'send', 'sms', 'parent', 'Reçu paiement frais [249420] dany mumba', 1, 'Reçu:249420 de votre enfant: MUMBA MUMBA(2eme Prim): INSCRIPTION=100.00$ - Frais scolaire(AVRIL)=94.79$ - Infos:+243858533285', NULL, '2024-10-24 14:26:52', '2024-10-24 14:26:58', NULL, 1, NULL),
(185, '241024IkavmYUEJiNqyIFuTQO7rcTAqC2m3ivlo12CrLMNgRzwrpniWY1729772812', '241208', 'DITOTASE', '+243997276670', 'send', 'sms', 'system', 'SMS Broadcast TO +243997276670', 1, 'Reçu:249420 de votre enfant: MUMBA MUMBA(2eme Prim): INSCRIPTION=100.00$ - Frais scolaire(AVRIL)=94.79$ - Infos:+243858533285', NULL, '2024-10-24 14:26:52', NULL, NULL, 1, NULL),
(186, '241024QSoyLdnUl7wnJSJuKdBSc7iIjzqbnEPiaszqm7fDpZkjEPQlM01729780906', '243071', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Feedback de l\'école complexe scolaire ditotase', 1, '<p><h3>Feedback de l\'agent Trecaz de l\'établissement complexe scolaire ditotase</h3> \n                <p>Contacts école - <b>Téléphone: +243858533285 | E-mail: contact@ditotase.com</b></p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 24/10/2024 16:41:40 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-24 16:41:46', NULL, NULL, 1, NULL),
(187, '241025Jg7lneE7uaSqKevhBhrJsNmL8ngS0R9LafoWCGs3u3QNkZhFyz1729867764', '240298', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Magschool Access Root', 1, '<p>245395</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 25/10/2024 16:49:18 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-25 16:49:24', NULL, NULL, NULL, NULL),
(188, '241025N8m9dn7hhnUNlRqGOH3O53Reonh2ZQAPIZMElWGej0SyfJY7Py1729867769', '247135', 'magschool@ditotase.com', 'mumbavivien@gmail.com', 'send', 'email', 'system', 'Magschool Access Root', 1, '<p>245395</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 25/10/2024 16:49:24 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-25 16:49:29', NULL, NULL, NULL, NULL),
(189, '241025Yj4qqasibkspBSEGFjhiVvnelFZlse5wyjMdBY0PSTVh1DlL781729867775', '243904', 'magschool@ditotase.com', 'ditotase@gmail.com', 'send', 'email', 'system', 'Magschool Access Root', 1, '<p>245395</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 25/10/2024 16:49:29 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-25 16:49:35', NULL, NULL, NULL, NULL),
(190, '241025NItOA2TnBt2IoJDRClGdsArrCnBLB21CSDCicLoC6Q6pKk7KSF1729867821', '245470', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Magschool Access Root', 1, '<p>241965</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 25/10/2024 16:50:14 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-25 16:50:21', NULL, NULL, NULL, NULL),
(191, '2410250dYJz4brZmmeqtjDufAwhKa9UDpedVNkWISnCsDLMw5d11EMSh1729868076', '244746', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Magschool Access Root', 1, '<p>243253</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 25/10/2024 16:54:32 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-25 16:54:36', NULL, NULL, NULL, NULL),
(192, '241026wmpoKMscGsbn53PqFO1eQwzPpjYaB4HWrwKUo06D83ZUkdKn8r1729926799', '244292', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Magschool Access Root', 1, '<p>240880</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 26/10/2024 09:13:14 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-26 09:13:19', NULL, NULL, NULL, NULL),
(193, '241026Hr0p0sr0I9ceC4J6K8pSySgYL4CG0vu0oovqAdtOQHv5MUzsmK1729926805', '249822', 'magschool@ditotase.com', 'mumbavivien@gmail.com', 'send', 'email', 'system', 'Magschool Access Root', 1, '<p>240880</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 26/10/2024 09:13:19 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-26 09:13:25', NULL, NULL, NULL, NULL),
(194, '2410260ZyBzGMrWkhSNijRpVetHlFLGWrQGdrVvJz0nD4s0vYspHTpu41729926810', '241208', 'magschool@ditotase.com', 'ditotase@gmail.com', 'send', 'email', 'system', 'Magschool Access Root', 1, '<p>240880</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 26/10/2024 09:13:25 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-26 09:13:30', NULL, NULL, NULL, NULL),
(195, '241027CBcj9iMp5Kr8bWO7hquOarBHy2dMjYJHpGiteszgFNev6LHYUc1730026519', '240420', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'send', 'email', 'parent', 'Reçu paiement frais [247060]', 1, '<h3>Perception frais élève - kayind chipeng pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>247060</b> du 27/10/2024 12:49:01</b></p><h5><b>Elève : kayind chipeng myriam</b></h5><h5> Classe: 1ere B Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Fournitures scolaires ECUSSON</td>\r\n					<td>4,50$</td><td>4,50$</td><td>0</td></tr><tr> <td>Fournitures scolaires TABLIER</td>\r\n					<td>5,50$</td><td>0,00$</td><td>5,50$</td></tr><tr> <td>Fournitures scolaires TABLIER</td>\r\n					<td>5,50$</td><td>5,00$</td><td>0,50$</td></tr><tr> <td>Fournitures scolaires TABLIER</td>\r\n					<td>5,50$</td><td>0,00$</td><td>0</td></tr><tr> <td>Fournitures scolaires PULL D\'UNIFORME</td>\r\n					<td>10,00$</td><td>10,00$</td><td>0</td></tr><tr> <td>Fournitures scolaires ACCESSOIRES</td>\r\n					<td>15,00$</td><td>15,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 40,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 34,50 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =6,76</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Sunday 27-10-2024 à 12:55:19</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-10-27 12:55:19', NULL, NULL, 1, NULL),
(196, '2410273cYENIqnGWN6G7NEH6OWvA7FA9vqeBRnmQ6QEe0n2ZGjrKz5Bf1730026519', '240673', 'DITOTASE', '+243821733330', 'send', 'sms', 'parent', 'Reçu paiement frais [247060] kachak sarah', 1, 'Reçu:247060 de votre enfant: kayind chipeng(1ere B Maternelle): Fournitures scolaires(ECUSSON)=4.50$ - Fournitures scolaires(TABLIER)=0.00$ - Fournitures scolaires(TABLIER)=5.00$ - Fournitures scolaires(TABLIER)=0.00$ - Fournitures scolaires(PULL D\'UNIFORME)=10.00$ - Fournitures scolaires(ACCESSOIRES)=15.00$ - Infos:+243858533285', NULL, '2024-10-27 12:55:19', '2024-10-27 12:55:19', NULL, 1, NULL),
(197, '241027kPhEFdn7wjMcgsHMKYsZQrDbvGLuqGrPJPB586z0dJvPm2NEdU1730026519', '246860', 'DITOTASE', '+243821733330', 'send', 'sms', 'system', 'SMS Broadcast TO +243821733330', 1, 'Reçu:247060 de votre enfant: kayind chipeng(1ere B Maternelle): Fournitures scolaires(ECUSSON)=4.50$ - Fournitures scolaires(TABLIER)=0.00$ - Fournitures scolaires(TABLIER)=5.00$ - Fournitures scolaires(TABLIER)=0.00$ - Fournitures scolaires(PULL D\'UNIFORME)=10.00$ - Fournitures scolaires(ACCESSOIRES)=15.00$ - Infos:+243858533285', NULL, '2024-10-27 12:55:19', NULL, NULL, 1, NULL),
(198, '2410305V5Gp2oPN8armQU6KTRg2M6Lp9C27ahOT82gDc828q4iu0YPeM1730286687', '243548', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Résultats de la premiere periode', 1, '<p>Vos résultats de la  premiere periode sont disponibles. Accéder au site internet de l\'école pour consulter la publication!</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 30/10/2024 13:11:19 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-30 13:11:27', NULL, NULL, 1, NULL),
(199, '241030CKnEg4Yn9wtsfJJhwZ3yEZnvfQ9IK0oMNbIVa8DABFSjFzYWcd1730286696', '240743', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'system', 'Résultats de la premiere periode', 1, '<p>Vos résultats de la  premiere periode sont disponibles. Accéder au site internet de l\'école pour consulter la publication!</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 30/10/2024 13:11:27 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-30 13:11:36', NULL, NULL, 1, NULL),
(200, '241031V2VyE3M4sKWPsonKeQ4dhUhCoZuorQhweT2JNICUHKAEpOzct21730368957', '240981', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Modification de votre compte utilisateur', 1, '<p><p>Cher Elie Mwez Rubuz, votre compte a subi de modifications. Pour plus de détails, veuillez accèder à votre compte.\r\n                    Ce mail a été envoyé à l\'adresse suivante: rubuz@ditotase.com. Si erreur, demander la suppression immédiate de votre compte.. En cas d\'une indication contraire, veuillez le signaler.\r\n                            </p>\r\n                                <br/> <br/> <hr>\r\n                             <p style=\"text-align:center!important;\">\r\n                                <a href=\"http://localhost/web/aschool-manager/auth\"\r\n                                style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\r\n                                  color: white!important;\r\n                                  text-align:center!important;\r\n                                  background: #ff7e17!important;\r\n                                  text-transform: uppercase;\r\n                                  text-decoration: none;\r\n                                  word-wrap: break-word;\r\n                                  white-space: normal;\r\n                                  cursor: pointer;\r\n                                  border: 0;\r\n                                  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\r\n                                  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\r\n                                  border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\r\n                                   border-radius: 100px!important\"> Se connecter à mon compte</a>\r\n                            </p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 31/10/2024 12:02:28 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-31 12:02:37', NULL, NULL, 1, NULL),
(201, '24103182rEBGf96VarHLIO8QRCDaERtO15iZlVD3bVcfh6guCrgzhIvV1730369626', '245509', 'DITOTASE', '+243821733330', 'send', 'email', 'system', 'SMS to Mwez Elie', 1, 'Magschool est une solution de gestion standard des ecoles en RDC. Test sms Agent', NULL, '2024-10-31 12:13:46', '2024-10-31 12:13:48', NULL, 1, NULL),
(202, '241031pSeUebYdaPkPYROYTfCwLGbUQfAGYvNn7qvMnzPoVEtIBABcrv1730369626', '243045', 'DITOTASE', '+243821733330', 'send', 'sms', 'system', 'SMS Broadcast TO +243821733330', 1, 'Magschool est une solution de gestion standard des ecoles en RDC. Test sms Agent', NULL, '2024-10-31 12:13:46', NULL, NULL, 1, NULL),
(203, '241031Sg852PwJGiLhE3fLW2I6VSnMgTNwBe9uSRlRDSvSWAf6IFAd8Z1730369628', '249511', 'DITOTASE', '+243997276670', 'send', 'email', 'system', 'SMS to Mumba vivien', 1, 'Magschool est une solution de gestion standard des ecoles en RDC. Test sms Agent', NULL, '2024-10-31 12:13:48', '2024-10-31 12:13:52', NULL, 1, NULL),
(204, '2410311wf1kefeOIC9YjPP9nUwHt40trcgFwOd5vj9hk4TsMz7TemoSp1730369628', '240685', 'DITOTASE', '+243997276670', 'send', 'sms', 'system', 'SMS Broadcast TO +243997276670', 1, 'Magschool est une solution de gestion standard des ecoles en RDC. Test sms Agent', NULL, '2024-10-31 12:13:48', NULL, NULL, 1, NULL),
(205, '241031WDkQwDLqccGrQdchIdDwVyfM7j0OflvRgCJQ42UwqtuL37B3u41730369632', '240265', 'DITOTASE', '+243858533285', 'send', 'email', 'system', 'SMS to Elie Mwez Rubuz', 1, 'Magschool est une solution de gestion standard des ecoles en RDC. Test sms Agent', NULL, '2024-10-31 12:13:52', '2024-10-31 12:13:55', NULL, 1, NULL),
(206, '241031wOUHSmaK9SnhGOGQB8PW1uIIuAtQgKiISLep2jNMInNb9MMAQ51730369632', '246828', 'DITOTASE', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'Magschool est une solution de gestion standard des ecoles en RDC. Test sms Agent', NULL, '2024-10-31 12:13:52', NULL, NULL, 1, NULL),
(207, '241031WQmWYpBIHS6pAZVWIGNffGsTb7mtQbO0MhZmTRSBewFesvlvFL1730369635', '248045', 'DITOTASE', '+243977090011', 'send', 'email', 'system', 'SMS to Trecaz Holding', 1, 'Magschool est une solution de gestion standard des ecoles en RDC. Test sms Agent', NULL, '2024-10-31 12:13:55', '2024-10-31 12:13:59', NULL, 1, NULL),
(208, '241031GcwJiJWttrfDHLyiuZEw6aa5CaAoiKBlu4zDN0AoBkEzeclFQ11730369635', '246245', 'DITOTASE', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Magschool est une solution de gestion standard des ecoles en RDC. Test sms Agent', NULL, '2024-10-31 12:13:55', NULL, NULL, 1, NULL),
(209, '241031pGhrzJCLQ6TeIfrKlibQZzJLrZ8T7zv6MZi08vTEymQ5IQwNz01730389975', '240207', 'DITOTASE', '+243977090011', 'send', 'sms', 'system', 'SMS TO trecaz holding', 1, 'Test broadcast', NULL, '2024-10-31 17:52:55', '2024-10-31 17:52:57', NULL, 1, 2),
(210, '241031O7F9eh8L9FAiQ4gkJ4yFLz5lr6qmMhAWNDoBJaFOUncL1BykRc1730389975', '242346', 'DITOTASE', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Test broadcast', NULL, '2024-10-31 17:52:55', NULL, NULL, 1, NULL),
(211, '241031f1HgdZ4u6hldNnfsWTphiuDgBmRHeZc7NjMpSaOc8aS8oZDZvw1730389977', '246155', 'DITOTASE', '+243858533285', 'send', 'sms', 'system', 'SMS TO elie mwez', 1, 'Test broadcast', NULL, '2024-10-31 17:52:57', '2024-10-31 17:52:58', NULL, 1, 2),
(212, '241031aIEtv5MrokfJAbVaIzz2ClYqfKh3skco5erom3fLgB3f0MyTZZ1730389977', '247430', 'DITOTASE', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'Test broadcast', NULL, '2024-10-31 17:52:57', NULL, NULL, 1, NULL),
(213, '241031S4tOpOtgwApOlyybv1PJtVikRnnrmInFqc5YSoB1wf1AQvYOVe1730390007', '249872', 'DITOTASE', '+243977090011', 'send', 'sms', 'system', 'SMS TO trecaz holding', 1, 'Test broadcast', NULL, '2024-10-31 17:53:27', '2024-10-31 17:53:30', NULL, 1, 2),
(214, '24103160R6pbezCC8LW6EIFg0Dd9ODNPnUb5114iSLkfFYHOhfE22jII1730390010', '240411', 'DITOTASE', '+243858533285', 'send', 'sms', 'system', 'SMS TO elie mwez', 1, 'Test broadcast', NULL, '2024-10-31 17:53:30', '2024-10-31 17:53:31', NULL, 1, 2),
(215, '2410319m0SuSn2vculGbKK54R3ijKordU1h16qEsvYbZp20fdv5hub891730390011', '241733', 'contact@ditotase.com', 'contact@ditotase.com', 'send', 'email', 'system', 'trecaz holding', 1, '<p>salut les amis<br></p>', NULL, '2024-10-31 17:53:31', '2024-10-31 17:53:36', NULL, 1, 2),
(216, '241031NBw6hNCU4oPLYpNU341u5ZZZIy3QWQrJf9Mo3muguKl72UYCZL1730390016', '240292', 'magschool@ditotase.com', 'contact@ditotase.com', 'send', 'email', 'system', 'Infos de l\'école complexe scolaire ditotase', 1, '<p>\n                                    \n                                    <p>salut les amis<br></p>\n                                    \n                                    <hr/>\n                                    <p>trecaz holding vous recevez ce message car vous etes agent de notre <b>école complexe scolaire ditotase pour l\'année 2023-2024</b></p> \n                                    \n                                    <p>Contacts école - <b>Téléphone: +243858533285 | E-mail: contact@ditotase.com</b></p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 31/10/2024 17:53:31 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-31 17:53:36', NULL, NULL, 1, NULL),
(217, '241031qYVMYDWPDhvA2ol4NiIWShMKy7eT3E4jY0vGMMsdebqviJkyqO1730390016', '244912', 'contact@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'elie mwez', 1, '<p>salut les amis<br></p>', NULL, '2024-10-31 17:53:36', '2024-10-31 17:53:42', NULL, 1, 2),
(218, '241031DEUbCUVueayYLUfy5dIVzNY21YpMFccBhfb36Hb4Bnp5zeIqL21730390022', '247371', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Infos de l\'école complexe scolaire ditotase', 1, '<p>\n                                    \n                                    <p>salut les amis<br></p>\n                                    \n                                    <hr/>\n                                    <p>elie mwez vous recevez ce message car vous etes agent de notre <b>école complexe scolaire ditotase pour l\'année 2023-2024</b></p> \n                                    \n                                    <p>Contacts école - <b>Téléphone: +243858533285 | E-mail: contact@ditotase.com</b></p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 31/10/2024 17:53:36 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-10-31 17:53:42', NULL, NULL, 1, NULL),
(219, '241101OQjmJP52Af7fkPcqv0GLKLyLmSLrjQvnq4Sbz9PpqztOp1ldCp1730457952', '244622', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/11/2024 12:45:44 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Opera 114.0.0.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-11-01 12:45:52', NULL, NULL, 1, NULL),
(220, '241101RQm7UeH0MHpy9s9FzadErB1UG9b0J6rfcp2z1nuRl7W70YujNw1730458026', '245084', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/11/2024 12:46:58 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Opera 114.0.0.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-11-01 12:47:06', NULL, NULL, 1, NULL),
(221, '241101wuSHesfDELFlkYr1mOrjGLQnHqKzirO1qOlE4T1kA4ny6E279f1730458170', '244312', 'magschool@ditotase.com', 'eliemwez.rubuz@gmail.com', 'send', 'email', 'system', 'Frais payé de l\'élève Kazadi Kazadi', 1, '<p><h3>Perception frais élève - Kazadi Kazadi pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>246817</b> du 01/11/2024 12:48:43</b></p><h5><b>Elève : Kazadi Kazadi John</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>70,42$</td><td>69,58$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 200 000,00</b></td><td><b>$ 350,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 370,42 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =50,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Friday 01-11-2024 à 12:49:24</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/11/2024 12:49:24 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Opera 114.0.0.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-11-01 12:49:30', NULL, NULL, 1, NULL);
INSERT INTO `messages` (`message_id`, `message_token`, `message_code`, `message_sender`, `message_recipient`, `message_status`, `message_type`, `message_category`, `message_subject`, `message_emergency`, `message_body`, `message_attachment`, `message_created_at`, `message_updated_at`, `message_deleted_at`, `message_school_id`, `message_section_id`) VALUES
(222, '241101oheA6whUgmpTSGFFoiH2eMAFuIPK9i8oK9F0VJzPLOebYsqpgH1730458170', '248361', 'contact@ditotase.com', 'eliemwez.rubuz@gmail.com', 'send', 'email', 'parent', 'Reçu paiement frais [246817]', 1, '<h3>Perception frais élève - Kazadi Kazadi pour l\'année 2023-2024</h3><p>Cher parent kachak sarah suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>246817</b> du 01/11/2024 12:48:43</b></p><h5><b>Elève : Kazadi Kazadi John</b></h5><h5> Classe: 2eme A Primaire</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire JANVIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire FEVRIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais scolaire MARS</td>\r\n					<td>140,00$</td><td>70,42$</td><td>69,58$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 200 000,00</b></td><td><b>$ 350,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 370,42 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =50,00</b></td></tr></tbody></table><p>Printed by : <span>Holding(241908)</br> <b class=\"small\">Friday 01-11-2024 à 12:49:24</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2024-11-01 12:49:30', NULL, NULL, 1, NULL),
(223, '241101H1EebROdMLjwuKb45tZj8vtuedLdLrzELUWuPp5KYsG4w9dS7u1730458170', '243309', 'DITOTASE', '+243821733330', 'send', 'sms', 'parent', 'Reçu paiement frais [246817] kachak sarah', 1, 'Reçu:246817 de votre enfant: Kazadi Kazadi(2eme Prim): Frais scolaire(JANVIER)=150.00$ - Frais scolaire(FEVRIER)=150.00$ - Frais scolaire(MARS)=70.42$ - Infos:+243858533285', NULL, '2024-11-01 12:49:30', '2024-11-01 12:49:41', NULL, 1, NULL),
(224, '241101SqzkdoKBLcv3O0K2QQHIqmQe20f9DUvLiCIyZYW0Fa4COJeFvf1730458170', '244073', 'DITOTASE', '+243821733330', 'send', 'sms', 'system', 'SMS Broadcast TO +243821733330', 1, 'Reçu:246817 de votre enfant: Kazadi Kazadi(2eme Prim): Frais scolaire(JANVIER)=150.00$ - Frais scolaire(FEVRIER)=150.00$ - Frais scolaire(MARS)=70.42$ - Infos:+243858533285', NULL, '2024-11-01 12:49:30', NULL, NULL, 1, NULL),
(225, '241101k8mlPqGaOdfdM2FkUdgH0fssSwIfSjHR47PncCDTvitIW6hGE71730458447', '246272', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Résultats de la premiere periode', 1, '<p>Vos résultats de la  premiere periode sont disponibles. Accéder au site internet de l\'école pour consulter la publication!</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/11/2024 12:53:57 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Opera 114.0.0.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-11-01 12:54:07', NULL, NULL, 1, NULL),
(226, '241101HmCcjDT3hapypOn5MGpGzlSwhodzgoHWQMrgbvcshVTjq16M5f1730458454', '249142', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'system', 'Résultats de la premiere periode', 1, '<p>Vos résultats de la  premiere periode sont disponibles. Accéder au site internet de l\'école pour consulter la publication!</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/11/2024 12:54:07 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Opera 114.0.0.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-11-01 12:54:14', NULL, NULL, 1, NULL),
(227, '241101QLvv4H5Qwrgc0wyT1p2UP8DyricWnWHc5MYWTIrnk6B9Z4LWq71730459677', '244094', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/11/2024 13:14:29 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Chrome 129.0.0.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-11-01 13:14:37', NULL, NULL, 1, NULL),
(228, '241101HaKgOKgfCcbWnaq1z9B4miwSLgWYFu061pBKo58EHTOO3etqY21730473802', '244010', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/11/2024 17:09:53 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 131.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-11-01 17:10:02', NULL, NULL, 1, NULL),
(229, '241104l0eqmbA2PVmuFCON4ipbsZYzykqdtjpmBqeUsVfNvJveNA7c6m1730710440', '246101', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 04/11/2024 10:53:49 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 132.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-11-04 10:54:00', NULL, NULL, 1, NULL),
(230, '241115tN2UsTZcFhWS8VyYCci9dPf19aezojPFstpvsI8NtDAKe3NggW1731675932', '241918', 'magschool@ditotase.com', 'manyong.kalaw@gmail.com', 'send', 'email', 'system', 'Inscription de l\'élève Ilunga Kelly [CID24158]', 1, '<p><h3>Confirmation d\'inscription de l\'élève Ilunga Kelly, Matricule: [CID24158]</h3>\r\n                                <p>Cher parent suite à la demande d\'inscription de votre enfant au sein de notre <b>école CS DITOTASE pour l\'année 2023-2024</b>,\r\n                                voici les identifiants d\'accès à son compte.</p>\r\n                                <p>Code accès parent: e242790e. Numéro matricule de l\'élève: CID24158 </p>\r\n                                <p>Nous vous prions de garder le code d\'accès dans un lieu secret à l\'abri de toute personne étrangère n\'ayant pas accès au dossier scolaire de votre enfant.</p></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 15/11/2024 15:05:27 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 132.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2024-11-15 15:05:32', NULL, NULL, 1, NULL),
(231, '241115ouDPasBPOuBBj3fvAwiGIuFd4eTeHqRkWbfEf3JHsLqCcKdv2r1731675932', '246983', 'contact@ditotase.com', 'manyong.kalaw@gmail.com', 'actif', 'email', 'parent', 'Inscription de l\'élève Ilunga Kelly [CID24158]', 1, '<h3>Confirmation d\'inscription de l\'élève Ilunga Kelly, Matricule: [CID24158]</h3>\r\n                                <p>Cher parent suite à la demande d\'inscription de votre enfant au sein de notre <b>école CS DITOTASE pour l\'année 2023-2024</b>,\r\n                                voici les identifiants d\'accès à son compte.</p>\r\n                                <p>Code accès parent: e242790e. Numéro matricule de l\'élève: CID24158 </p>\r\n                                <p>Nous vous prions de garder le code d\'accès dans un lieu secret à l\'abri de toute personne étrangère n\'ayant pas accès au dossier scolaire de votre enfant.</p>', NULL, '2024-11-15 15:05:32', NULL, NULL, 1, NULL),
(232, '2501286BOq1oA5O9eUlDdS9VAuCYhcZ49kCwEgZVqta5v2gWHqtaAR8s1738073478', '253324', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/01/2025 16:11:06 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 134.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-01-28 16:11:18', NULL, NULL, 1, NULL),
(233, '250128kpWbA4UwEA4MI3HrDQY999dIAzPJlLqRhESIsGknUiRUiSjISp1738073770', '255665', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/01/2025 16:15:59 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 134.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-01-28 16:16:10', NULL, NULL, 1, NULL),
(234, '250217NQnmaiooba39Pb6lWk7AracfZkAjaZm8pwJApAs1beWcmUvkk11739797151', '259302', 'contact@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'parent', 'Reçu paiement frais [252510]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>252510</b> du 17/02/2025 14:58:55</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>50,00$</td><td>70,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 50,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 50,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Agency(244430)</br> <b class=\"small\">Monday 17-02-2025 à 14:59:07</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2025-02-17 14:59:11', NULL, NULL, 1, NULL),
(235, '250217LTEEsZS3U0IHWjhpDwUYeS7RFdLdQrhR80Zwl4zKb4bdnpTr9V1739797222', '250903', 'contact@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'parent', 'Reçu paiement frais [252841]', 1, '<h3>Perception frais élève - chipeng Mukeng pour l\'année 2023-2024</h3><p>Cher parent manyong melanie suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>252841</b> du 17/02/2025 15:00:13</b></p><h5><b>Elève : chipeng Mukeng Aaron</b></h5><h5> Classe: 1ere  Maternelle</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais scolaire MAI</td>\r\n					<td>120,00$</td><td>70,00$</td><td>0</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 70,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 70,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Agency(244430)</br> <b class=\"small\">Monday 17-02-2025 à 15:00:18</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2025-02-17 15:00:22', NULL, NULL, 1, NULL),
(236, '250228m4WzanMiznRvKZVAmb9QJzDtcIO83s1ig7ys0iP3Y142ZZmKC71740747975', '254995', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/02/2025 15:06:05 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 135.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-02-28 15:06:15', NULL, NULL, 1, NULL),
(237, '250228UEKU0CFeBgBRay7iwUEJyq1uVChz1rLzV0L85Qi4S7R3QDs0dy1740749559', '253245', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 28/02/2025 15:32:28 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 135.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-02-28 15:32:39', NULL, NULL, 1, NULL),
(238, '250704McAlmfC0wsZHMHaNYQuC4aR65whrypbQKLNUKJ6FTvyIgcqubA1751633489', '254619', 'magschool@ditotase.com', 'mwez.rubuz@yahoo.com', 'send', 'email', 'system', 'Réseau Universitaire Identifiants', 1, '<p>Cher utilisateur chipeng rubuz de l\'établissement complexe scolaire ditotase, merci d\'avoir creer votre compte dans le système\r\n                                <b>Réseau Universitaire </b>. Votre nom d\'utilisateur est <b>202301</b>,\r\n                                l\'email de connexion est <b>mwez.rubuz@yahoo.com</b>, votre mot de passe: Trouvez-le dans le deuxième email qui vous a été envoyé.</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 04/07/2025 14:51:22 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 140.0</li>\n                <li>Application: Réseau Universitaire</li>\n             </ul>', NULL, '2025-07-04 14:51:29', NULL, NULL, NULL, NULL),
(239, '25070478rFjJFD2Pf0km2VdUiUZUtNY43ktbIRZe6bCVyMjONVn3ylIZ1751633495', '258651', 'magschool@ditotase.com', 'mwez.rubuz@yahoo.com', 'send', 'email', 'system', 'Réseau Universitaire Mot de passe', 1, '<p>Cher utilisateur chipeng rubuz de l\'établissement complexe scolaire ditotase, merci de vous compter parmi nos membres du système \r\n                                <b>Réseau Universitaire </b>. Votre mot de passe de connexion que vous avez defini est <b>p*04991*p</b></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 04/07/2025 14:51:29 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 140.0</li>\n                <li>Application: Réseau Universitaire</li>\n             </ul>', NULL, '2025-07-04 14:51:35', NULL, NULL, NULL, NULL),
(240, '250811I29WZw5DYhMebGl9SfboPNAua8YG5WmSOFe45gnvQRBGoZlIVR1754920195', '254553', 'magschool@ditotase.com', 'mwez.rubuz@outlook.com', 'send', 'email', 'system', 'Réseau Universitaire Identifiants', 1, '<p>Cher utilisateur Ilunga Ilunga de l\'établissement complexe scolaire ditotase, merci d\'avoir creer votre compte dans le système\r\n                                        <b>Réseau Universitaire </b>. Votre nom d\'utilisateur est <b>CID24158</b>,\r\n                                        l\'email de connexion est <b>mwez.rubuz@outlook.com</b>, votre mot de passe: Trouvez-le dans le deuxième email qui vous a été envoyé.</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 11/08/2025 15:49:50 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 141.0</li>\n                <li>Application: Réseau Universitaire</li>\n             </ul>', NULL, '2025-08-11 15:49:55', NULL, NULL, NULL, NULL),
(241, '250811PireCt3rTPnC3NA06gfnU4LeglkVl96weveBKzNAWTFtvPmVHK1754920201', '253810', 'magschool@ditotase.com', 'mwez.rubuz@outlook.com', 'send', 'email', 'system', 'Réseau Universitaire Mot de passe', 1, '<p>Cher utilisateur Ilunga Ilunga de l\'établissement complexe scolaire ditotase, merci de vous compter parmi nos membres du système \r\n                                        <b>Réseau Universitaire </b>. Votre mot de passe de connexion que vous avez defini est <b>p*04991*p</b></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 11/08/2025 15:49:55 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 141.0</li>\n                <li>Application: Réseau Universitaire</li>\n             </ul>', NULL, '2025-08-11 15:50:01', NULL, NULL, NULL, NULL),
(242, '250825t3ZMbhwpG72vMUcUQDlca7zypYnrJMtOUlfBvyNr1dEPH6lMtS1756135497', '252021', 'magschool@ditotase.com', 'elie.mwez@cisasarl.com', 'send', 'email', 'system', 'Magschool Credentials', 1, '<p>Cher(e) rumbu chipeng, votre compte utilisateur a été créé avec succès dans le système\r\n                                    de votre établissement <b>complexe scolaire ditotase </b>. Votre nom d\'utilisateur est <b>CI24129</b>,\r\n                                    l\'email de connexion est <b>elie.mwez@cisasarl.com</b>, votre mot de passe: Trouvez-le dans le deuxième email qui vous a été envoyé.</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 25/08/2025 17:24:50 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 141.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-08-25 17:24:57', NULL, NULL, NULL, NULL),
(243, '250825t6v4UkDc1NEv1zSW0Mhd0yqo0AICI4aiiNObQi8QTkoz3nuUV81756135504', '255241', 'magschool@ditotase.com', 'elie.mwez@cisasarl.com', 'send', 'email', 'system', 'Magschool Account Password', 1, '<p>Cher(e) rumbu chipeng, votre compte utilisateur a été créé avec succès dans le système\r\n                                    de votre établissement <b>complexe scolaire ditotase </b>. Votre mot de passe de connexion est <b>p*04991*p</b></p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 25/08/2025 17:24:57 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 141.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-08-25 17:25:04', NULL, NULL, NULL, NULL),
(244, '250830aDC3ZkOfu2CGVeeOuF4BWnuFR5w0ARQMTgUSYwRkivo8kcbl1f1756549487', '259252', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Backup database for Complexe Scolaire Ditotase</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 30/08/2025 12:24:35 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 142.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-08-30 12:24:47', NULL, NULL, 1, NULL),
(245, '250901OnDW1jLdfhjnnKwzAiCTFgiHtQnIkPpAem5OCK7quBKNWvDlVG1756711015', '252243', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Automatic database backup from Complexe Scolaire Ditotase by Ditotase Agency. Click the button below to download the backup file. Please keep this file safe and secure.</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> \n            <a href=\"http://localhost/web/aschool-manager/dbBackupRestore/autbackup-2025-09-01_09-16-46.sql\"\n               style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\n                 color: white!important;\n                 text-align:center!important;\n                 background: #ff7e17!important;\n                 text-transform: uppercase;\n                 text-decoration: none;\n                 word-wrap: break-word;\n                 white-space: normal;\n                 cursor: pointer;\n                 border: 0;\n                 box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\n                 transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\n                 border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\n                  border-radius: 100px!important\"> Restaurer</a></p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/09/2025 09:16:46 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 142.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-09-01 09:16:55', NULL, NULL, 1, NULL),
(246, '250901G9FwNikIwkqFwCefMSeoLSFLpRA2KQ6pBMgOh47Zw94BjjIoEv1756711295', '256425', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Automatic database backup from Complexe Scolaire Ditotase by Ditotase Agency. Click the button below to download the backup file. Please keep this file safe and secure.</p>\n            <hr> <br/>\n            <p style=\"text-align:center!important;\"> \n            <a href=\"/opt/lampp/htdocs/web/aschool-manager/writable/database/autbackup-2025-09-01_09-21-12.sql\"\n               style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\n                 color: white!important;\n                 text-align:center!important;\n                 background: #ff7e17!important;\n                 text-transform: uppercase;\n                 text-decoration: none;\n                 word-wrap: break-word;\n                 white-space: normal;\n                 cursor: pointer;\n                 border: 0;\n                 box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\n                 transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\n                 border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\n                  border-radius: 100px!important\"> Download</a></p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/09/2025 09:21:12 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 142.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-09-01 09:21:35', NULL, NULL, 1, NULL),
(247, '250901Ksld05ljjZsGBCnaSbsH3hs45mFLsObGuHD1j1RwtjqvjRQQ7g1756719146', '259386', 'magschool@ditotase.com', 'magschool@ditotase.com', 'send', 'email', 'system', 'Backup a_school_manager_db for Complexe Scolaire Ditotase', 1, '<p>Automatic database backup from <b>Complexe Scolaire Ditotase by Ditotase Agency</b>. Click the button below to download the backup file. Please keep this file safe and secure.</p>\n            <br/>\n            <p style=\"text-align:center!important;\"> \n            <a href=\"http://localhost/web/aschool-manager/dbBackupRestore/autbackup-2025-09-01_11-32-15.sql\"\n               style=\" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;\n                 color: white!important;\n                 text-align:center!important;\n                 background: #ff7e17!important;\n                 text-transform: uppercase;\n                 text-decoration: none;\n                 word-wrap: break-word;\n                 white-space: normal;\n                 cursor: pointer;\n                 border: 0;\n                 box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);\n                 transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,\n                 border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\n                  border-radius: 100px!important\"> Restore</a></p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 01/09/2025 11:32:15 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 142.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-09-01 11:32:26', NULL, NULL, 1, NULL),
(248, '250909UytMgUjQlWvAoZUsCnzjYD0m7IiBpKTwZ1wd1oFFl3VUcoLZTp1757422961', '254470', 'contact@ditotase.com', '+243977090011', 'send', 'sms', 'parent', 'SMS', 1, 'SLT ELIE', NULL, '2025-09-09 15:02:41', '2025-09-09 15:02:42', NULL, 1, 1),
(249, '250909iSkIRMByjo2ABBo0Zz4JTTCg6CcQqLPfHRMkcCwjtN86uEEEi61757422961', '251810', 'MAGSCHOOL', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'SLT ELIE. Infoline: +243858533285', NULL, '2025-09-09 15:02:41', NULL, NULL, 1, NULL),
(250, '2509091cAuLfabOEoyFe0CRgsiz4HNsv858ODoHjwYZ0c5E8YflZqm7J1757423055', '259840', 'contact@ditotase.com', '+243858533285', 'send', 'sms', 'parent', 'SMS', 1, 'DITOTASE SCHOOL AVEC API DREAM DIGITAL 2025', NULL, '2025-09-09 15:04:15', '2025-09-09 15:04:17', NULL, 1, 1),
(251, '250909jgRfqLJGyIMhEvw3TnSTika5CL9QRoH7sebLhgsVkjU5WsuCck1757423055', '251764', 'MAGSCHOOL', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'DITOTASE SCHOOL AVEC API DREAM DIGITAL 2025. Infoline: +243858533285', NULL, '2025-09-09 15:04:15', NULL, NULL, 1, NULL),
(252, '250916npD2jrWmRFFfwhFbyZDW37DuUVGroEQZhOgWR8TAd1OYvpPJJS1758011102', '251657', 'MAGSCHOOL', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Chers parents, Votre enfant RUBUZ CHIPENG ELIAS est inscrit en 4eme PEDA pour l\'année scolaire 2023-2024 . Matricule : CID25731', NULL, '2025-09-16 10:25:02', NULL, NULL, 1, NULL),
(253, '250916AKDpdLmGFotre49ivMbTe3YmU9jjGCL0U15M5iYptlnYvQzGCP1758012008', '258371', 'MAGSCHOOL', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'Chers parents, Votre enfant KAS KASMAY JESS est inscrit en 4eme PEDA pour l\'année scolaire 2023-2024 . Matricule : CSD232405', NULL, '2025-09-16 10:40:08', NULL, NULL, 1, NULL),
(254, '250916138YG5066VujfwlKVlu8CZCOmQ30CdcKKutgghTbN7iZZkRuV01758012015', '253096', 'magschool@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'send', 'email', 'system', 'Inscription de l\'élève KAS KASMAY JESS [CSD232405]', 1, '<p><h3>Confirmation d\'inscription de l\'élève KAS KASMAY JESS, Matricule: [CSD232405]</h3>\r\n                                <p>Cher parent suite à la demande d\'inscription de votre enfant au sein de notre <b>école CS DITOTASE pour l\'année 2023-2024</b>,\r\n                                voici les identifiants d\'accès à son compte.</p>\r\n                                <p>Code accès parent: e244540e. Numéro matricule de l\'élève: CSD232405 </p>\r\n                                <p>Nous vous prions de garder le code d\'accès dans un lieu secret à l\'abri de toute personne étrangère n\'ayant pas accès au dossier scolaire de votre enfant.</p></p>\n            <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 16/09/2025 10:40:10 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 142.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-09-16 10:40:15', NULL, NULL, 1, NULL),
(255, '250916c9f8OzK5j7doLajv4sYCbTvsrhnd6DCC4SfWUJoS3dD3Js6JPa1758012015', '256623', 'contact@ditotase.com', 'eliemwez.rubuz@ditotase.com', 'actif', 'email', 'parent', 'Inscription de l\'élève KAS KASMAY JESS [CSD232405]', 1, '<h3>Confirmation d\'inscription de l\'élève KAS KASMAY JESS, Matricule: [CSD232405]</h3>\r\n                                <p>Cher parent suite à la demande d\'inscription de votre enfant au sein de notre <b>école CS DITOTASE pour l\'année 2023-2024</b>,\r\n                                voici les identifiants d\'accès à son compte.</p>\r\n                                <p>Code accès parent: e244540e. Numéro matricule de l\'élève: CSD232405 </p>\r\n                                <p>Nous vous prions de garder le code d\'accès dans un lieu secret à l\'abri de toute personne étrangère n\'ayant pas accès au dossier scolaire de votre enfant.</p>', NULL, '2025-09-16 10:40:15', NULL, NULL, 1, NULL),
(256, '250916LsthqmnOrHhmAflmivArd19D2W2OgogjU6tHwcy5qGUZLAfTe11758031040', '252339', 'magschool@ditotase.com', 'elie.mwez@cisasarl.com', 'send', 'email', 'system', 'Magschool Credentials', 1, '<p>Cher(e) mboso , votre compte utilisateur a été créé avec succès dans le système\r\n                                    de votre établissement <b>complexe scolaire ditotase </b>. Votre nom d\'utilisateur est <b>CSD232402</b>,\r\n                                    l\'email de connexion est <b>elie.mwez@cisasarl.com</b>, votre mot de passe: Trouvez-le dans le deuxième email qui vous a été envoyé.</p>\n            <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 16/09/2025 15:57:14 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 142.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-09-16 15:57:20', NULL, NULL, NULL, NULL),
(257, '250916t5VAiPryKj0JyOLzes4iQ5AeRgs13Sj446icaStvwiOThg5NGP1758031046', '252709', 'magschool@ditotase.com', 'elie.mwez@cisasarl.com', 'send', 'email', 'system', 'Magschool Account Password', 1, '<p>Cher(e) mboso , votre compte utilisateur a été créé avec succès dans le système\r\n                                    de votre établissement <b>complexe scolaire ditotase </b>. Votre mot de passe de connexion est <b>p*04991*p</b></p>\n            <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 16/09/2025 15:57:20 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 142.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-09-16 15:57:26', NULL, NULL, NULL, NULL),
(258, '250916Tig8H9edpVE3H8fS7eIaOs9hiCa8qQdQqMTVNiAkN1T1QKY0ZT1758033136', '257512', 'magschool@ditotase.com', 'ditotase.business@gmail.com', 'send', 'email', 'system', 'Magschool Credentials', 1, '<p>Cher Responsable chifia jess de l\'établissement COLLEGE DITOTASE BUSINESS, merci d\'avoir configurer la fiche de votre présentation dans le système\r\n                            <b>Ditotase Magstore </b>. Votre nom d\'utilisateur est <b>s251331s</b>,\r\n                            l\'email de connexion est <b>ditotase.business@gmail.com</b>, votre mot de passe: Trouvez-le dans le deuxième email qui vous a été envoyé.</p>\n            <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 16/09/2025 16:32:10 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 142.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-09-16 16:32:16', NULL, NULL, NULL, NULL),
(259, '250916R2swdmRZR1SFY5d4rZ3rKRaIV7o28SbDkpqfjVGtNUbb07Vffe1758033142', '256759', 'magschool@ditotase.com', 'ditotase.business@gmail.com', 'send', 'email', 'system', 'Magschool Account Password', 1, '<p>Cher Responsable chifia jess de l\'établissement COLLEGE DITOTASE BUSINESS, merci d\'avoir configurer la fiche de votre présentation dans le système\r\n                            <b>Ditotase Magstore </b>. Votre mot de passe de connexion est <b>p*04991*pp</b></p>\n            <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 16/09/2025 16:32:16 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 142.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-09-16 16:32:22', NULL, NULL, NULL, NULL),
(260, '251008rdCh5RV4l6lTPHWN6IWSlWkYqmM9tnwZmeYYuNpzZ675PfBbBa1759929550', '259917', 'MAGSCHOOL', '+243858533285', 'send', 'sms', 'system', 'SMS Broadcast TO +243858533285', 1, 'Chers parents, votre enfant AFRICALOS BUSMAN  est inscrit en 3EME PRIM pour l\'annee scolaire 2023-2024. Matricule: CSD2324002', NULL, '2025-10-08 15:19:10', NULL, NULL, 1, 2),
(261, '251008fvhLBfdW8wwuA22QlUaO2Ku97yDSyIumtdV4hStAr6KURyMKfa1759929705', '259912', 'MAGSCHOOL', '+243977090011', 'send', 'sms', 'system', 'SMS Broadcast TO +243977090011', 1, 'Chers parents, votre enfant TRECAZ HOLDER  est inscrit en 1ERE PRIM pour l\'annee scolaire 2023-2024. Matricule: CSD2324003', NULL, '2025-10-08 15:21:45', NULL, NULL, 1, 2),
(262, '2510085yTgAT11wchCGH7YWd96e6Nc9eu0u5iNzQu3wLt6w5LnOl6Qef1759929712', '255954', 'magschool@ditotase.com', 'rubuz@ditotase.com', 'send', 'email', 'system', 'Inscription de l\'élève TRECAZ HOLDER  [CSD2324003]', 1, '<p><h3>Confirmation d\'inscription de l\'élève TRECAZ HOLDER , Matricule: [CSD2324003]</h3>\r\n                                <p>Cher parent suite à la demande d\'inscription de votre enfant au sein de notre <b>école CS DITOTASE pour l\'année 2023-2024</b>,\r\n                                voici les identifiants d\'accès à son compte.</p>\r\n                                <p>Code accès parent: e246719e. Numéro matricule de l\'élève: CSD2324003 </p>\r\n                                <p>Nous vous prions de garder le code d\'accès dans un lieu secret à l\'abri de toute personne étrangère n\'ayant pas accès au dossier scolaire de votre enfant.</p></p>\n            <br/>\n            <p style=\"text-align:center!important;\"> </p>\n            <br/><hr>\n            <p><b style=\"text-transform:uppercase;\">Où et quand celà s\'est produit:</b></p>\n             <ul>\n                <li>Date: 08/10/2025 15:21:47 </li>\n                <li>Lieu: Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa</li>\n                <li>Système: Linux via Firefox 143.0</li>\n                <li>Application: Ditotase Magschool</li>\n             </ul>', NULL, '2025-10-08 15:21:52', NULL, NULL, 1, 2),
(263, '25100849RnDIn3HmvuUybp9BprnFHyy90ZIoDuRrlO7ZaZ8FGBDsnHdQ1759929712', '251995', 'contact@ditotase.com', 'rubuz@ditotase.com', 'actif', 'email', 'parent', 'Inscription de l\'élève TRECAZ HOLDER  [CSD2324003]', 1, '<h3>Confirmation d\'inscription de l\'élève TRECAZ HOLDER , Matricule: [CSD2324003]</h3>\r\n                                <p>Cher parent suite à la demande d\'inscription de votre enfant au sein de notre <b>école CS DITOTASE pour l\'année 2023-2024</b>,\r\n                                voici les identifiants d\'accès à son compte.</p>\r\n                                <p>Code accès parent: e246719e. Numéro matricule de l\'élève: CSD2324003 </p>\r\n                                <p>Nous vous prions de garder le code d\'accès dans un lieu secret à l\'abri de toute personne étrangère n\'ayant pas accès au dossier scolaire de votre enfant.</p>', NULL, '2025-10-08 15:21:52', NULL, NULL, 1, 2),
(264, '251206e9toyWpjTOqnG2nwbcz6297hRWggDSqobIT8NJERwN0UiPOIw91765032290', '250588', 'MAGSCHOOL', '+243000000000', 'send', 'sms', 'system', 'SMS Broadcast TO +243000000000', 1, 'Chers parents, votre enfant KASONGO ILUNGA JOHN est inscrit en 1ERE PRIM pour l\'annee scolaire 2024-2025. Matricule: CSD2425005', NULL, '2025-12-06 16:44:50', NULL, NULL, 1, 2),
(265, '251206vamJ8FUEoDbJlPPkl9AeBjea4embvHg851ZYaa6tvipKtrefHB1765034824', '255016', 'contact@ditotase.com', '', 'send', 'email', 'parent', 'Reçu paiement frais [257872]', 1, '<h3>Perception frais élève - Kasongo ilunga pour l\'année 2024-2025</h3><p>Cher parent . suite à la perception de frais de votre enfant au sein de notre <b>école CS DITOTASE</b>, voici les details du paiement:</p><p style=\"border:2px solid black\"> <b> reçu n° <b>257872</b> du 06/12/2025 17:21:11</b></p><h5><b>Elève : Kasongo ilunga John</b></h5><h5> Classe: 2eme A Conception des systemes d\'information</h5><table border=\"1\" cellpadding=\"5\" cellspacing=\"0\"><thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead><tbody><tr> <td>Frais academiques JANVIER</td>\r\n					<td>150,00$</td><td>150,00$</td><td>0</td></tr><tr> <td>Frais academiques FEVRIER</td>\r\n					<td>150,00$</td><td>100,00$</td><td>50,00$</td></tr><tr><td><b>Montant</b></td><td colspan=\"2\"><b>En CDF</b> </td><td><b> En USD</b> </td></tr><tr><td><b>Déposé:</b></td><td colspan=\"2\"><b>Fc 0,00</b></td><td><b>$ 250,00</b></td></tr><tr><td><b>Perçu:</b></td><td colspan=\"2\"><b>Fc - 0,00</b></td><td><b>$ - 250,00 </b></td></tr><tr><td><b>Remis:</b></td><td colspan=\"2\"><b>Fc = 0,00</b></td><td><b>$ =0,00</b></td></tr></tbody></table><p>Printed by : <span>Agency(244430)</br> <b class=\"small\">Saturday 06-12-2025 à 17:27:04</b></span> <br> </p><p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>', NULL, '2025-12-06 17:27:04', NULL, NULL, 1, NULL),
(266, '251206fcSnJd6wDOjHvciZgDpZG7jiVsMV8818mw9NjUIS7m7VTHFaU01765034824', '252837', 'MAGSCHOOL', '+243000000000', 'send', 'sms', 'parent', 'Reçu paiement frais [257872] .', 1, 'Reçu:257872 de votre enfant: Kasongo ilunga(2eme Prim): Frais academiques(JANVIER)=150.00$ - Frais academiques(FEVRIER)=100.00$ - Infos:+243858533285', NULL, '2025-12-06 17:27:04', '2025-12-06 17:27:04', NULL, 1, NULL),
(267, '251206uniQaTkdEF27ve0wTDHCsdiIV07ciZWtVgRuhuN16KDqdEEhbY1765034824', '256154', 'MAGSCHOOL', '+243000000000', 'send', 'sms', 'system', 'SMS Broadcast TO +243000000000', 1, 'Reçu:257872 de votre enfant: Kasongo ilunga(2eme Prim): Frais academiques(JANVIER)=150.00$ - Frais academiques(FEVRIER)=100.00$ - Infos:+243858533285', NULL, '2025-12-06 17:27:04', NULL, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-05-24-194903', 'App\\Database\\Migrations\\Customers', 'default', 'App', 1723206263, 1),
(2, '2024-05-24-194904', 'App\\Database\\Migrations\\Schools', 'default', 'App', 1723206263, 1),
(3, '2024-05-24-202606', 'App\\Database\\Migrations\\Years', 'default', 'App', 1723206263, 1),
(4, '2024-05-24-210351', 'App\\Database\\Migrations\\Parents', 'default', 'App', 1723206263, 1),
(5, '2024-05-24-222344', 'App\\Database\\Migrations\\Sections', 'default', 'App', 1723206263, 1),
(6, '2024-05-24-222429', 'App\\Database\\Migrations\\ClassesOptions', 'default', 'App', 1723206263, 1),
(7, '2024-05-24-223519', 'App\\Database\\Migrations\\ClassesDegrees', 'default', 'App', 1723206263, 1),
(8, '2024-05-24-223532', 'App\\Database\\Migrations\\Classes', 'default', 'App', 1723206264, 1),
(9, '2024-05-25-004600', 'App\\Database\\Migrations\\Students', 'default', 'App', 1723206264, 1),
(10, '2024-05-25-200213', 'App\\Database\\Migrations\\StudentInscription', 'default', 'App', 1723206264, 1),
(11, '2024-05-31-213132', 'App\\Database\\Migrations\\Roles', 'default', 'App', 1723206264, 1),
(12, '2024-05-31-213149', 'App\\Database\\Migrations\\Users', 'default', 'App', 1723206264, 1),
(13, '2024-05-31-213202', 'App\\Database\\Migrations\\Privileges', 'default', 'App', 1723206264, 1),
(14, '2024-05-31-213212', 'App\\Database\\Migrations\\Passwords', 'default', 'App', 1723206264, 1),
(15, '2024-05-31-220347', 'App\\Database\\Migrations\\Userlogs', 'default', 'App', 1723206264, 1),
(16, '2024-05-31-222148', 'App\\Database\\Migrations\\UserSecurity', 'default', 'App', 1723206264, 1),
(17, '2024-05-31-224203', 'App\\Database\\Migrations\\UserActivity', 'default', 'App', 1723206264, 1),
(18, '2024-06-14-215614', 'App\\Database\\Migrations\\Fees', 'default', 'App', 1723206264, 1),
(19, '2024-06-14-215703', 'App\\Database\\Migrations\\Feesdetails', 'default', 'App', 1723206264, 1),
(20, '2024-06-14-215914', 'App\\Database\\Migrations\\Feesclasses', 'default', 'App', 1723206264, 1),
(21, '2024-06-14-220020', 'App\\Database\\Migrations\\Feesexemptions', 'default', 'App', 1723206264, 1),
(22, '2024-06-14-220155', 'App\\Database\\Migrations\\Feesdiscounts', 'default', 'App', 1723206264, 1),
(23, '2024-06-14-233018', 'App\\Database\\Migrations\\Feesexemptionsstudents', 'default', 'App', 1723206264, 1),
(24, '2024-06-14-233656', 'App\\Database\\Migrations\\Payments', 'default', 'App', 1723206264, 1),
(25, '2024-06-14-233708', 'App\\Database\\Migrations\\Paymentsdetails', 'default', 'App', 1723206264, 1),
(26, '2024-06-14-233852', 'App\\Database\\Migrations\\Paymentsexchanges', 'default', 'App', 1723206264, 1),
(27, '2024-06-15-004201', 'App\\Database\\Migrations\\Paymentsreports', 'default', 'App', 1723206264, 1),
(28, '2024-07-19-083039', 'App\\Database\\Migrations\\AccountsBanks', 'default', 'App', 1723206264, 1),
(29, '2024-07-19-090401', 'App\\Database\\Migrations\\Cashbox', 'default', 'App', 1723206264, 1),
(30, '2024-07-19-090448', 'App\\Database\\Migrations\\Transactions', 'default', 'App', 1723206264, 1),
(31, '2024-07-19-090928', 'App\\Database\\Migrations\\Expenses', 'default', 'App', 1723206264, 1),
(32, '2024-07-25-152638', 'App\\Database\\Migrations\\CreateSessionsTable', 'default', 'App', 1723206264, 1),
(33, '2024-08-08-115914', 'App\\Database\\Migrations\\Messages', 'default', 'App', 1723206264, 1),
(34, '2024-08-09-110059', 'App\\Database\\Migrations\\Exemptionsclasses', 'default', 'App', 1723213402, 2),
(35, '2024-08-15-151528', 'App\\Database\\Migrations\\Documents', 'default', 'App', 1723735235, 3),
(36, '2024-08-28-130847', 'App\\Database\\Migrations\\UsersSections', 'default', 'App', 1724850969, 4);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) UNSIGNED NOT NULL,
  `payment_token` varchar(75) NOT NULL,
  `payment_code` varchar(10) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_total_usd` decimal(10,2) DEFAULT NULL,
  `payment_total_cdf` decimal(10,2) DEFAULT NULL,
  `payment_fees_usd` decimal(10,2) DEFAULT NULL,
  `payment_fees_cdf` decimal(10,2) DEFAULT NULL,
  `payment_exemption_usd` decimal(10,2) DEFAULT NULL,
  `payment_exemption_cdf` decimal(10,2) DEFAULT NULL,
  `payment_exchange` decimal(10,2) DEFAULT NULL,
  `payment_status` varchar(25) DEFAULT NULL,
  `payment_type` varchar(75) DEFAULT NULL,
  `payment_notes` text DEFAULT NULL,
  `payment_created_at` datetime DEFAULT NULL,
  `payment_updated_at` datetime DEFAULT NULL,
  `payment_deleted_at` datetime DEFAULT NULL,
  `payment_year_id` int(11) UNSIGNED DEFAULT NULL,
  `payment_fee_id` int(11) UNSIGNED DEFAULT NULL,
  `payment_student_id` int(11) UNSIGNED DEFAULT NULL,
  `payment_school_id` int(11) UNSIGNED DEFAULT NULL,
  `payment_user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_token`, `payment_code`, `payment_date`, `payment_total_usd`, `payment_total_cdf`, `payment_fees_usd`, `payment_fees_cdf`, `payment_exemption_usd`, `payment_exemption_cdf`, `payment_exchange`, `payment_status`, `payment_type`, `payment_notes`, `payment_created_at`, `payment_updated_at`, `payment_deleted_at`, `payment_year_id`, `payment_fee_id`, `payment_student_id`, `payment_school_id`, `payment_user_id`) VALUES
(1, '240809jnPD9FS4BmVbD4AWZT7u2a88Ck7y2H9L0RnhTUWhlq1IMWSh521723215525', '241937', '2024-08-09', 0.00, 0.00, 300.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-09 14:58:45', '2024-08-09 15:00:20', NULL, 2, 1, 3, 1, 2),
(2, '240809dAQsyChqMTIWfmkCgUVOYcVSo1wvLDPPAVA4EFVRSed4twO4rF1723215662', '247313', '2024-08-09', 110.00, 0.00, 260.00, 0.00, 40.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-09 15:01:02', '2024-08-09 15:01:38', NULL, 2, 1, 3, 1, 2),
(3, '240816pL28pZCnMkasLS1rbIHTjhJwWCNBMmjeTOOotTHaaRtEGMkIGM1723813657', '247231', '2024-08-16', 210.00, 0.00, 380.00, 0.00, 20.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-16 13:07:37', '2024-08-16 13:19:27', NULL, 2, 2, 4, 1, 2),
(4, '240816jLVHbyLdArgRyvlN1H3C3BSsNp1Pf6GeqMeszSPUfpcyr12I4P1723815649', '248116', '2024-08-16', 188.03, -250000.00, 200.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-16 13:40:49', '2024-08-16 13:47:25', NULL, 2, 2, 6, 1, 1),
(5, '240816CEcaOozG2m1aeATLbLU144dOWTcJP2lnY4cKowMQw96RAfkTi31723816103', '245759', '2024-08-16', 0.00, 35000.00, 0.00, 35000.00, 0.00, 5000.00, 2840.00, 'actif', 'cash', '', '2024-08-16 13:48:23', '2024-08-16 13:48:29', NULL, 2, 3, 4, 1, 1),
(6, '240817l9aE55vSjHLqPiabnmb5PkGZj60UvVsflvBTfwavbJAqUNDYFe1723882834', '247274', '2024-08-17', 0.00, 25000.00, 0.00, 35000.00, 0.00, 5000.00, 2840.00, 'actif', 'cash', '', '2024-08-17 08:20:34', '2024-08-17 08:20:50', NULL, 2, 3, 7, 1, 1),
(7, '240817WYEmBTn0GDSwouF8sP5kNc0FnfOW3HHA3bvQHappbzphcLm6gC1723882886', '244066', '2024-08-17', 110.00, 0.00, 110.00, 0.00, 40.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-17 08:21:26', '2024-08-17 08:21:26', NULL, 2, 1, 3, 1, 1),
(8, '240819tMpjWyc66qtVyHs0GK1VkpJe0EqNLZgpc6urs8Ag6ZKDqGIWhf1724058640', '244529', '2024-08-19', 270.00, 0.00, 270.00, 0.00, 20.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-19 09:10:40', '2024-08-19 09:10:45', NULL, 2, 1, 4, 1, 1),
(9, '240819gGJ3K6ciMKQmNqmCLndU8WYGbVoHzrLng76UqeIddp8ZfNSPN41724059319', '247499', '2024-08-19', 480.00, 0.00, 480.00, 0.00, 60.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-19 09:21:59', '2024-08-19 09:22:21', NULL, 2, 1, 7, 1, 1),
(10, '240819hh1rmkCW3TKF5QQJnj9SFRqHj80EtJ0FYLa2aM5wDwPTACr3cp1724063053', '247530', '2024-08-19', 180.00, 0.00, 210.00, 0.00, 40.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-19 10:24:13', '2024-08-19 10:24:23', NULL, 2, 2, 2, 1, 1),
(11, '240820z2nk0eZrhpWV9MqAKz8BeECCgH6tDz9RUNQ3mYboEBz3u0uoZo1724154794', '245280', '2024-08-20', 240.00, 0.00, 260.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-20 11:53:14', '2024-08-20 11:53:35', NULL, 2, 1, 4, 1, 1),
(12, '240820TunMuFP2FtH3sBH5EfRzRNu4pT1G8cuF3Pcetjr548nTNk83W11724154927', '240068', '2024-08-20', 20.00, 0.00, 120.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-20 11:55:27', '2024-08-20 11:55:27', NULL, 2, 1, 4, 1, 1),
(13, '240827sGdF9T8OTjJL0yYeVgyI1bDlrE0KzqmeytF5uf7Q81acZo0Hnq1724764633', '244288', '2024-08-27', 50.00, 0.00, 150.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-27 13:17:13', '2024-08-27 13:17:13', NULL, 2, 1, 1, 1, 3),
(14, '240828Cbn0jvnQkZAqrpLacj5dd2jbDNNyG8gMBBZY3186r9gvBhbCZT1724843233', '248826', '2024-08-28', 100.00, 15000.00, 140.00, 15000.00, 0.00, 5000.00, 2840.00, 'actif', 'cash', '', '2024-08-28 11:07:13', '2024-08-28 11:07:44', NULL, 2, 3, 3, 1, 3),
(15, '2408289jFwZ1eaETSzFuVzzLIS49D8CIHtqG5j1EyKMn3BWLVPqPTqMa1724856729', '241483', '2024-08-28', 120.00, 15000.00, 220.00, 15000.00, 80.00, 5000.00, 2840.00, 'actif', 'cash', '', '2024-08-28 14:52:09', '2024-08-28 14:52:46', NULL, 2, 1, 9, 1, 1),
(16, '240828N44cQ7yzo8pb8gRGrKP58LFA3GBqizhMIrNEfr3rCMQtBs88li1724856918', '248509', '2024-08-28', 0.00, 10000.00, 0.00, 20000.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-28 14:55:18', '2024-08-28 14:55:18', NULL, 2, 3, 7, 1, 3),
(17, '240828EECRM1NydqkscDjmlcEwvnzpU5iC42IMGlinhhaBd3gAkivlUE1724857815', '248234', '2024-08-28', 117.61, 0.00, 140.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-28 15:10:15', '2024-08-28 15:10:15', NULL, 2, 1, 7, 1, 3),
(18, '2408280i7N29JzVWWSeLCzDlLv2DChDL5FOrPiw52LlpAq9lfWvDpOaR1724859157', '249600', '2024-08-28', 230.00, 0.00, 270.00, 0.00, 20.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-08-28 15:32:37', '2024-08-28 15:32:45', NULL, 2, 1, 2, 1, 3),
(19, '240910Rvk4zfBFGGDE596FMfkfFO33u2S4CRGUl7GdK0n1CSgRlFDFGO1725962264', '243684', '2024-09-10', 150.00, 0.00, 280.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 09:57:44', '2024-09-10 09:57:55', NULL, 2, 1, 2, 1, 1),
(20, '240910jpg9iPD5ncV38sSBSHi1SoMoHw9njqIWknSfNZql1jQkpd5KCv1725962391', '243699', '2024-09-10', 30.00, 0.00, 260.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 09:59:51', '2024-09-10 14:30:38', NULL, 2, 1, 2, 1, 1),
(21, '2409104bWHckjqVMP2etnrddWNdVPKU51U13mstlYokBgQtYVhCSokw91725962838', '240930', '2024-09-10', 142.39, 0.00, 260.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 10:07:18', '2024-09-10 10:07:23', NULL, 2, 1, 7, 1, 1),
(22, '240910pz1kNDBh4dSNtCu3zgtgW5nt6yMZS6MZ1ZJy2clymaKWtj03T51725963061', '245375', '2024-09-10', 400.00, 0.00, 440.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 10:11:01', '2024-09-10 10:11:09', NULL, 2, 1, 10, 1, 1),
(23, '240910jfRE88coaSDuRW6PEhLRn4eQDTqR8KVNFAkZdZF48iPkIeQgmC1725963172', '242035', '2024-09-10', 100.00, 0.00, 100.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 10:12:52', '2024-09-10 10:12:52', NULL, 2, 2, 10, 1, 3),
(24, '2409100NZJIPyKKcaPviguKFVbvPYQsT7U1cJRSQu2JgGOmOOUuICnrA1725963346', '241793', '2024-09-10', 300.00, 0.00, 400.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 10:15:46', '2024-09-10 10:16:16', NULL, 2, 1, 10, 1, 1),
(25, '2409103mDrNeb4QwaqcsYcE9LfZkdUSGPH6eMi2OIvP42iyGrKlq31qY1725963595', '247959', '2024-09-10', 30.00, 0.00, 30.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 10:19:55', '2024-09-10 10:19:55', NULL, 2, 4, 6, 1, 3),
(26, '2409109vLtwZR8dpcuaBEWoTnqZrw2Ivr1PRE0yl7VVlRtpUawrbGIYu1725963692', '246701', '2024-09-10', 0.00, 35000.00, 0.00, 35000.00, 0.00, 5000.00, 2840.00, 'actif', 'cash', '', '2024-09-10 10:21:32', '2024-09-10 10:21:43', NULL, 2, 3, 6, 1, 1),
(27, '2409100Yc0WflCcTAjAkmqP49ejKStHTuCUC22Qye8LNoo17f5aoeHC51725963793', '245827', '2024-09-10', 400.00, 0.00, 440.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 10:23:13', '2024-09-10 10:23:26', NULL, 2, 1, 6, 1, 1),
(28, '240910LeKI92VTJAU5Wu34tv845Vm2nQ9FQl0vNvEZs7y1Z04fYkGfEw1725964883', '241743', '2024-09-10', 300.00, 0.00, 540.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 10:41:23', '2024-09-10 10:41:42', NULL, 2, 1, 6, 1, 1),
(29, '240910rvqYFY0Z6P6ntsQdZvBhSybgyQjbCFhR3UGeOLaNV4d2WFEyb81725966461', '242658', '2024-09-10', 350.00, 0.00, 440.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 11:07:41', '2024-09-10 11:07:53', NULL, 2, 1, 1, 1, 1),
(30, '2409106FO3ryTcQozbfAnYzsjavqwSHSP31AupQhcLMHsnJbnqJIORsP1725966785', '245128', '2024-09-10', 30.00, 0.00, 30.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 11:13:05', '2024-09-10 11:13:05', NULL, 2, 4, 1, 1, 3),
(31, '240910mTUynQ6MjiGPwEWuDQyfemLhaysF3SYq8yZCD05NgcwC5h4ILV1725967093', '248295', '2024-09-10', 0.00, 25000.00, 0.00, 35000.00, 0.00, 5000.00, 2840.00, 'actif', 'cash', '', '2024-09-10 11:18:13', '2024-09-10 11:18:26', NULL, 2, 3, 1, 1, 1),
(33, '240910J5s7nk01G3OqF13nuQJkGalDI7ia62WwVwQeVbqM6VWgM1RiSc1725979574', '247277', '2024-09-10', 0.00, 0.00, 30.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-10 14:46:14', '2024-11-13 15:06:29', NULL, 2, 4, 10, 1, 2),
(34, '2409128lFzrqZ4awewz5VwaTCpgpK9QfdIz8MlyPYSir3HjBmGPCwnB71726125923', '242198', '2024-09-12', 0.00, 35000.00, 0.00, 35000.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-12 07:25:23', '2024-09-12 07:25:33', NULL, 2, 3, 3, 1, 1),
(35, '2409168nP9utPkzlQ9TPRw1e0AO3fwDV9qeMoPVmyAqY2yuPg7lVGfG71726499881', '248897', '2024-09-16', 100.00, 0.00, 110.00, 0.00, 40.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-16 15:18:01', '2024-09-16 15:18:01', NULL, 2, 1, 9, 1, 1),
(36, '240919zKGYWgwnvsrf0VIJYyb5rwajSyVT9T1WDsvCtomFslWeC8GosY1726750510', '240097', '2024-09-19', 140.00, 0.00, 140.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-19 12:55:10', '2024-09-19 12:55:10', NULL, 2, 1, 9, 1, 1),
(37, '240921UhvRmnfMk1QFLhfUALuQraZSPPH0TvvDpyMLZsWRz80OsLY2rj1726914189', '242062', '2024-09-21', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-21 12:23:09', NULL, NULL, 2, 4, 12, 1, 1),
(38, '240921nUcF4sQwnFD3e9f6oLIWOGk09yb1jHtJJ1UrGQNC6Y0t3lEgyt1726915701', '245341', '2024-09-20', -20.00, 0.00, 30.00, 0.00, 0.00, 0.00, 0.00, 'actif', 'cash', '', '2024-09-21 12:48:21', '2024-09-21 12:56:46', NULL, 2, 4, 12, 1, 1),
(39, '240921rRvip4AUirFztSr5F5A7HITObFpaVbMFLQn8K8NKrQmAqV8ff21726917056', '246479', '2024-09-20', 30.00, 0.00, 30.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-21 13:10:56', '2024-09-21 13:10:56', NULL, 2, 4, 12, 1, 1),
(40, '240921LEST4TgZPzobktQghksTF0rrfek0bCS1zKl0eYmZPOuv4Fp0PF1726921832', '245282', '2024-09-21', 485.21, 0.00, 580.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-21 14:30:32', '2024-09-21 14:31:45', NULL, 2, 1, 12, 1, 1),
(41, '240925rmd2GMJHhACzeZ0kSiGlLEnhRFlZTcL16uhN1evVjwK3USKA0v1727273738', '249903', '2024-09-25', 470.56, 0.00, 570.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-25 16:15:38', '2024-09-25 16:16:32', NULL, 2, 4, 14, 1, 1),
(42, '240925wOOM7M8WsfzD4pdCjwAnrKUH8RyltNqviBpCEjrBlnzcVgliON1727274781', '240434', '2024-09-25', 199.44, 0.00, 280.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-09-25 16:33:01', '2024-09-25 16:33:11', NULL, 2, 1, 14, 1, 1),
(43, '241001oy2RYKkfyrv5dp50KSFV331hIzoJrITgKeDravATmL8roT7G7i1727775968', '245832', '2024-10-01', 150.00, 0.00, 280.00, 0.00, 20.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-01 11:46:08', '2024-10-01 11:57:12', NULL, 2, 1, 15, 1, 1),
(44, '241001PihpAMQB9GRo1j15FiWd0PW12cslRZrOJEvJSncTMjVKvKg9pC1727777276', '249756', '2024-10-01', 100.00, 0.00, 150.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-01 12:07:56', '2024-10-01 12:07:56', NULL, 2, 1, 15, 1, 1),
(45, '241001oQNujCqoLydczKsMjPlP18l3HFyvkItKfJWjtfHyTszVJidR981727777731', '246750', '2024-10-01', 130.00, 0.00, 130.00, 0.00, 20.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-01 12:15:31', '2024-10-01 12:15:31', NULL, 2, 1, 8, 1, 1),
(46, '241001aCCNUmJGgYCE8wPAojLCslGvc2U7OS6Q9iFrMnr42DItbJsywS1727777772', '246372', '2024-10-01', 40.00, 0.00, 140.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-01 12:16:12', '2024-10-01 12:16:12', NULL, 2, 1, 3, 1, 1),
(47, '2410016hWlA2h7fLZRAqDAeyuvDgQZfwfqbokEKeEE5a20Dz0GOQtn7R1727783189', '249021', '2024-10-01', 30.00, 0.00, 30.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-01 13:46:29', '2024-10-01 13:46:29', NULL, 2, 4, 15, 1, 1),
(48, '2410016h9BEAR5aaMzHv01GSAcmPo5TqGjc9ufb8OI3J5FlnDf8AHmk61727783213', '249402', '2024-10-01', 30.00, 0.00, 30.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-01 13:46:53', '2024-10-01 13:46:53', NULL, 2, 4, 3, 1, 1),
(50, '241024a1GsdtcpFO3NTiAYuDMEiiUvY8NcbPh5DPqEubJTTcmvedqznO1729772640', '247234', '2024-10-24', 180.00, 0.00, 280.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-24 14:24:00', '2024-10-24 14:24:04', NULL, 2, 1, 1, 1, 1),
(51, '241024Arbfsw2H7gO8i4HDErFckuN5aBfEz3t85O10bezQyHj2Hm9ms31729772787', '249420', '2024-10-24', 194.79, 0.00, 240.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-24 14:26:27', '2024-10-24 14:26:36', NULL, 2, 2, 12, 1, 1),
(52, '241027kgqwisWc3hmYT9repfBLE4nRBooVyvjjVvWBqN234SrI1oZPW71730025893', '241011', '2024-10-27', 0.00, 62000.00, 0.00, 62000.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-27 12:44:53', '2024-10-27 12:45:29', NULL, 2, 7, 4, 1, 1),
(53, '241027rsZu2eFS08zzyTPObuezu0Bi69rMRHfNGQqpfVMs2JwRpbjZwA1730026059', '249419', '2024-10-27', 0.00, 50000.00, 0.00, 50000.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-27 12:47:39', '2024-10-27 12:47:49', NULL, 2, 6, 8, 1, 1),
(54, '241027DuHkRksCkeYtJ0uMsAeq2y3eLd5wsmVmynj49BpJqigdjL7ZhM1730026141', '247060', '2024-10-27', 35.00, -5000.00, 46.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-10-27 12:49:01', '2024-10-27 12:52:49', NULL, 2, 5, 3, 1, 1),
(55, '241101zMvg6fwfBdB9AVzEH57iWPnRji9PWvSsVVvtfBCmuZ5br5GCyM1730458123', '246817', '2024-11-01', 370.42, 0.00, 440.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-11-01 12:48:43', '2024-11-01 12:48:53', NULL, 2, 1, 18, 1, 1),
(56, '241111n0r478S3e48dJU70KGOlN1JLPlK3fv8lFbDZECt2SPtrSHS5m41731320699', '242670', '2024-11-11', 150.00, 0.00, 150.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-11-11 12:24:59', '2024-11-11 12:24:59', NULL, 2, 1, 13, 1, 1),
(57, '241113saQHPGzMerB0aIqauGUpFdc7TL6U97N4Tpf1yoQfbTpZIC2Vsn1731504407', '249736', '2024-11-13', 10.00, 0.00, 10.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-11-13 15:26:47', '2024-11-13 15:26:55', NULL, 2, 5, 15, 1, 2),
(58, '241113GCWni2lORckuG9MIAq3Z98phE4Idy4L2A0WaRs6IQr4coEqJRU1731507471', '248243', '2024-11-12', 0.00, 30000.00, 0.00, 30000.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-11-13 16:17:51', '2024-11-13 16:17:51', NULL, 2, 6, 18, 1, 2),
(59, '241113ZmhokdWePPwj8RofeK1zNqQn2f3RKWT5Pq3BnmMFk1FzVsLuuG1731507505', '248352', '2024-11-12', 100.00, 0.00, 100.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2024-11-13 16:18:25', '2024-11-13 16:18:25', NULL, 2, 2, 15, 1, 2),
(60, '250217cyO5SKkbbi0rnqpklAFPzqhfq4C1H0OsRFREU4dksDb57Jb7ez1739797135', '252510', '2025-02-14', 50.00, 0.00, 120.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2025-02-17 14:58:55', '2025-02-17 14:58:55', NULL, 2, 1, 1, 1, 7),
(61, '250217qcyvcUIldGp2zjvmGbFn4SQZlIleIcdD17By0Jpz7UFOf7T5k61739797213', '252841', '2025-02-17', 70.00, 0.00, 120.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2025-02-17 15:00:13', '2025-02-17 15:00:13', NULL, 2, 1, 1, 1, 7),
(62, '250929hTfhfrBRiJ0ue5fwe1Q9WtDN4vqzk27pvOwd2uDgcQOqfYiTHZ1759136180', '259675', '2025-09-29', 30.00, 0.00, 30.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2025-09-29 10:56:20', '2025-09-29 10:56:20', NULL, 2, 4, 4, 1, 7),
(63, '251206U3gazkg1ZZTgWzLio4RZtQRBMnc04gYcirhQ8YQjDggy9PVAaO1765034471', '257872', '2025-12-06', 250.00, 0.00, 300.00, 0.00, 0.00, 0.00, 2840.00, 'actif', 'cash', '', '2025-12-06 17:21:11', '2025-12-06 17:21:18', NULL, 1, 1, 35, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `payments_details`
--

CREATE TABLE `payments_details` (
  `paydetails_id` int(11) UNSIGNED NOT NULL,
  `paydetails_token` varchar(75) NOT NULL,
  `paydetails_code` varchar(10) DEFAULT NULL,
  `paydetails_name` varchar(75) DEFAULT NULL,
  `paydetails_fee_amount` decimal(10,2) DEFAULT NULL,
  `paydetails_paid_amount` decimal(10,2) DEFAULT NULL,
  `paydetails_usd_amount` decimal(10,2) DEFAULT NULL,
  `paydetails_cdf_amount` decimal(10,2) DEFAULT NULL,
  `paydetails_return_amount` decimal(10,2) DEFAULT NULL,
  `paydetails_status` varchar(25) DEFAULT NULL,
  `paydetails_type` varchar(75) DEFAULT NULL,
  `paydetails_notes` text DEFAULT NULL,
  `paydetails_created_at` datetime DEFAULT NULL,
  `paydetails_updated_at` datetime DEFAULT NULL,
  `paydetails_deleted_at` datetime DEFAULT NULL,
  `paydetails_fee_id` int(11) UNSIGNED DEFAULT NULL,
  `paydetails_school_id` int(11) UNSIGNED DEFAULT NULL,
  `paydetails_payment_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments_details`
--

INSERT INTO `payments_details` (`paydetails_id`, `paydetails_token`, `paydetails_code`, `paydetails_name`, `paydetails_fee_amount`, `paydetails_paid_amount`, `paydetails_usd_amount`, `paydetails_cdf_amount`, `paydetails_return_amount`, `paydetails_status`, `paydetails_type`, `paydetails_notes`, `paydetails_created_at`, `paydetails_updated_at`, `paydetails_deleted_at`, `paydetails_fee_id`, `paydetails_school_id`, `paydetails_payment_id`) VALUES
(1, '240809WhligsqDlvahzy1PdSykhUWMepzLlhglDAbBVCo99g3DegyWQG17232155251', '2402111', NULL, 150.00, 0.00, 0.00, 0.00, 0.00, 'cancel', 'balance', NULL, '2024-08-09 14:58:45', '2024-08-09 14:59:05', NULL, 1, 1, 1),
(2, '240809rhp00dh2YULmuWz2V8oSFw0BwzIsRB8Q8TzFjIAvmu1ioScYbw17232155711', '2421741', NULL, 150.00, 0.00, 0.00, 0.00, 0.00, 'cancel', 'balance', NULL, '2024-08-09 14:59:31', '2024-08-09 15:00:20', NULL, 1, 1, 1),
(3, '240809I3jNFECAFYSNV8kab1YtpCe32kVj4ArbP6D0iMf73OdstHrgkZ17232156621', '2443731', NULL, 150.00, 0.00, 0.00, 0.00, 0.00, 'cancel', 'balance', NULL, '2024-08-09 15:01:02', '2024-08-09 15:01:32', NULL, 1, 1, 2),
(4, '240809bJCYK9qnyiUzO5ubsipRtK6qd3FMsnueHPAW9Nbr2VW3D5SrFS17232156981', '2426861', NULL, 110.00, 110.00, 150.00, 0.00, 40.00, 'actif', 'balance', NULL, '2024-08-09 15:01:38', NULL, NULL, 1, 1, 2),
(5, '240816GgCDkUVCVIWyh4ojlfcpFh5NiY021Nkjnwm3jw0nR91z9KS6AU17238136576', '2473286', NULL, 100.00, 80.00, 80.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-08-16 13:07:37', NULL, NULL, 6, 1, 3),
(7, '240816ktDL6whS30g56vaJMpVHSpwV5dLkFkj4CvuM1FYkUC6bkUBWrC17238143671', '2458061', NULL, 130.00, 130.00, 150.00, 0.00, 20.00, 'actif', 'balance', NULL, '2024-08-16 13:19:27', NULL, NULL, 1, 1, 3),
(8, '240816VtUjz3hjscWkCcvPvCnrpzJefUYBP8JUArAGgOZLgBuV9GZQbj17238156496', '2424166', NULL, 100.00, 0.00, 0.00, 0.00, 0.00, 'cancel', 'deposit', NULL, '2024-08-16 13:40:49', '2024-08-16 13:41:17', NULL, 6, 1, 4),
(9, '240816RE4pmBTklTe6VD9Y0sqSO3fqoE2MqE4fyytngWr5Dy6O8dVVO217238160456', '2423926', NULL, 100.00, 100.00, 0.00, 300000.00, 5.63, 'actif', 'balance', NULL, '2024-08-16 13:47:25', NULL, NULL, 6, 1, 4),
(10, '240816Prb5wQBt5j58qcW9qw4FhYkP9NgseMgPq3a31PbVI8Rzuo1Ssl17238161037', '2435577', NULL, 15000.00, 15000.00, 0.00, 15000.00, 0.00, 'actif', 'balance', NULL, '2024-08-16 13:48:23', NULL, NULL, 7, 1, 5),
(11, '240816i4G0sD1rIWdj7CMK02RJe5VhLQFEWjKMBJOEwjzEDJAlOO26Zu17238161098', '2438248', NULL, 20000.00, 20000.00, 0.00, 20000.00, 0.00, 'actif', 'balance', NULL, '2024-08-16 13:48:29', NULL, NULL, 8, 1, 5),
(12, '240817ATIDPsrcNwJpT0jMukVzqy1w7WARo8IUQ9dUUA6YhNVktMp9NC17238828347', '2410927', NULL, 15000.00, 15000.00, 0.00, 15000.00, 0.00, 'actif', 'balance', NULL, '2024-08-17 08:20:34', NULL, NULL, 7, 1, 6),
(13, '2408170PYcv7FrbRk1M9y8dJse9B7bpjLBhCfMm1KjciAUU5cHpzk1wA17238828508', '2499228', NULL, 20000.00, 10000.00, 0.00, 10000.00, 0.00, 'actif', 'deposit', NULL, '2024-08-17 08:20:50', NULL, NULL, 8, 1, 6),
(14, '240817DHJbAYhFUoL6sMsl5QBmTKa9go4Psrfbllo5tGtgLH8eMsVWdn17238828862', '2437082', NULL, 110.00, 110.00, 120.00, 0.00, 10.00, 'actif', 'balance', NULL, '2024-08-17 08:21:26', NULL, NULL, 2, 1, 7),
(15, '240819QaYOiREtjoTNy9gHHVs3zZfVGBlreC0EhVG74UkI9vSweU6d4G17240586402', '2477632', NULL, 130.00, 130.00, 130.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-08-19 09:10:40', NULL, NULL, 2, 1, 8),
(16, '240819rscILzeMw8vyHzWVr1CA4JUCQj04m3YyPGqJgddqYLt7U7kip617240586453', '2408733', NULL, 140.00, 140.00, 140.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-08-19 09:10:45', NULL, NULL, 3, 1, 8),
(17, '240819Z12ZV1dT0GBe0ADvboIhQaBnDo1q676ZwB2u0vUiJQ50o9L6n917240593191', '2447671', NULL, 130.00, 130.00, 130.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-08-19 09:21:59', NULL, NULL, 1, 1, 9),
(18, '240819Iw9BJ7EeVwtV93ToUSeQYnIlyQqgqN7zHF5BEogyhCBF4ueZDW17240593252', '2489252', NULL, 130.00, 130.00, 130.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-08-19 09:22:05', NULL, NULL, 2, 1, 9),
(19, '240819W9zJJf691Ri8KEtoAyahkBQrikal5RjlgYlg8wcr15GmjKE6Fs17240593293', '2457663', NULL, 140.00, 140.00, 140.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-08-19 09:22:09', NULL, NULL, 3, 1, 9),
(20, '240819Zv1IpicI5MqouW0SulvIZrMYwhfSBOKjbpHbqPFei7kVZtQJMk17240593416', '2457406', NULL, 80.00, 80.00, 80.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-08-19 09:22:21', NULL, NULL, 6, 1, 9),
(21, '2408199ZfpIIl7Mse3D4WmvpjbQN10YAmwrYgUL1qbfts2Nzqz5elW8p17240630536', '2426116', NULL, 80.00, 50.00, 50.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-08-19 10:24:13', NULL, NULL, 6, 1, 10),
(22, '240819kKPGSBY91MqUlOhL8oeVIbroSDQVQMRlI5vg7di6q0W5c4yHzz17240630631', '2486811', NULL, 130.00, 130.00, 150.00, 0.00, 20.00, 'actif', 'balance', NULL, '2024-08-19 10:24:23', NULL, NULL, 1, 1, 10),
(23, '240820SkPDrD89uOg6YRgoq4RHjouQ377B7gipr4A8uKv2TlNw5lzsNk17241547944', '2402884', NULL, 140.00, 140.00, 140.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-08-20 11:53:14', NULL, NULL, 4, 1, 11),
(24, '240820OakDRU87EBzLTSzHnp5hELTOyoDn4N7jFqfNeP8Eel6pkhWUig17241548155', '2474155', NULL, 120.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-08-20 11:53:35', NULL, NULL, 5, 1, 11),
(25, '240820ybuFdNh5TqpvLrCbGdRCboeg4P0z88qq1pOdUv05jee1MTNqEB17241549275', '2486075', NULL, 120.00, 20.00, 50.00, 0.00, 30.00, 'actif', 'balance', NULL, '2024-08-20 11:55:27', NULL, NULL, 5, 1, 12),
(26, '240827Ev9EC1i93lUQBICwksT1roCoECq3EHOLRNJLHDC1q4TJeAot6g17247646331', '2474181', NULL, 150.00, 50.00, 50.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-08-27 13:17:13', NULL, NULL, 1, 1, 13),
(27, '2408285bLmwwD1IJMeHvI3JZdtIZ9uZtA9QB93CRMenQjmI9jyDoqj7p17248432337', '2425477', NULL, 15000.00, 15000.00, 0.00, 15000.00, 0.00, 'actif', 'balance', NULL, '2024-08-28 11:07:13', NULL, NULL, 7, 1, 14),
(28, '240828Z9VlBHRbG10FkRiNSkhT50SnsHOyHmZHtsVPPJKtm0H1ENDTn217248432643', '2481763', NULL, 140.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-08-28 11:07:44', NULL, NULL, 3, 1, 14),
(29, '240828679csF9VT7oIGz3onLfma2CvFlCy0YmD4QiIvSKCHv4TQ61RTG17248567291', '2463721', NULL, 110.00, 110.00, 110.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-08-28 14:52:09', NULL, NULL, 1, 1, 15),
(30, '240828YYWbHizvQAL0Cmda2vpiGKWcjLuBF5ZAOoUJvkN4en8TksIyL017248567512', '2440052', NULL, 110.00, 10.00, 10.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-08-28 14:52:31', NULL, NULL, 2, 1, 15),
(31, '240828TlJ9AOqjr3LAp72fDQMCrwiFjLBNFG9Oy95YkeuEC1gzBlhDog17248567667', '2470147', NULL, 15000.00, 15000.00, 0.00, 15000.00, 0.00, 'actif', 'balance', NULL, '2024-08-28 14:52:46', NULL, NULL, 7, 1, 15),
(32, '240828YSUoD7QH8pniDk0veFk8QubpSshUAK1IdvEWUvOpqLMlSTZFyY17248569188', '2487788', NULL, 20000.00, 10000.00, 0.00, 10000.00, 0.00, 'actif', 'balance', NULL, '2024-08-28 14:55:18', NULL, NULL, 8, 1, 16),
(33, '240828Mc6pzN4JspocrycMmcSHMGumK4DAQ2fh7U5QGhdKLNLCiKYIoB17248578154', '2427104', NULL, 140.00, 117.61, 100.00, 50000.00, 0.00, 'actif', 'deposit', NULL, '2024-08-28 15:10:15', NULL, NULL, 4, 1, 17),
(34, '240828O7ZA13hliMLBLC9qbJ7aM0gWKp6iBJyv50MD9IRf65rBktHJrI17248591572', '2493412', NULL, 130.00, 130.00, 130.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-08-28 15:32:37', NULL, NULL, 2, 1, 18),
(35, '240828hAmlV1Lfi90WTgwaLNwJ4iZHLsJmefF25S8DO8bjkjRkaeDJRI17248591653', '2485323', NULL, 140.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-08-28 15:32:45', NULL, NULL, 3, 1, 18),
(36, '240910NEmk8TBCFSJFJftsZmL1KQgUbrZNqahjqyQp3HA85QJR5q2MY617259622643', '2486773', NULL, 140.00, 40.00, 40.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 09:57:44', NULL, NULL, 3, 1, 19),
(37, '2409101pIvY215BMRSopvR0Hiu7pZ0da3GNZ5TA15lmyB8QifNDj6QLD17259622754', '2457894', NULL, 140.00, 110.00, 110.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-09-10 09:57:55', NULL, NULL, 4, 1, 19),
(38, '240910B3hgMLn02o1Yty5BOo9yerPYawkDKaHYws4Mdqt3CJ4lVYA3Pg17259623914', '2484084', NULL, 140.00, 30.00, 30.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 09:59:51', NULL, NULL, 4, 1, 20),
(39, '240910Q558wk7qf8kAgavHzLcNje5vjhmVI4yGv1EAPy4qKMCnoZ0KnZ17259623965', '2493765', NULL, 120.00, 0.00, 0.00, 0.00, 0.00, 'cancel', 'balance', NULL, '2024-09-10 09:59:56', '2024-09-10 14:30:38', NULL, 5, 1, 20),
(40, '240910lDPgbLcGzl1f5nMrUKKeIge27IbQdYnjzI1EyQa0A5NEgEQK8R17259628384', '2449914', NULL, 140.00, 22.39, 30.00, 0.00, 7.61, 'actif', 'balance', NULL, '2024-09-10 10:07:18', NULL, NULL, 4, 1, 21),
(41, '240910TgpyOyRvG4oolROJDmkhYEWq6O9nvWIb6s3vl0oNK5WBkOrvTm17259628435', '2421155', NULL, 120.00, 120.00, 120.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:07:23', NULL, NULL, 5, 1, 21),
(42, '240910ovGzFn5oZ0eQ95bH1jonS4CLAVByfzDDRyMyBhkVrlUnUCk7GS17259630611', '2420121', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:11:01', NULL, NULL, 1, 1, 22),
(43, '2409107K8bJsCrSwJ5sDRCpTvc8V3c0kDbP4qAfLyu23KJHT0IZEmlTq17259630642', '2480012', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:11:04', NULL, NULL, 2, 1, 22),
(44, '240910EHSVBqrResnh1giN8f065rl6wsp51mdQWZtQ7Fhre0Jg3VLJfL17259630693', '2485353', NULL, 140.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-09-10 10:11:09', NULL, NULL, 3, 1, 22),
(45, '240910tMRUbaIw6kSkuRw95N7IdlpUu3hWHW8CwRUh1cWAzUKdtNpSja17259631726', '2473546', NULL, 100.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:12:52', NULL, NULL, 6, 1, 23),
(46, '2409103ELpmRJJkeYM9ekZqiKRdfhrkLt1yo44zKzzQobHjGFaRBBagk17259633463', '2479143', NULL, 140.00, 40.00, 40.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:15:46', NULL, NULL, 3, 1, 24),
(47, '2409104sfuO9tK9cp4u9b5Fwh1C7KdN6q53ngGcjsKMoft1zdDIG3Lmo17259633534', '2413354', NULL, 140.00, 140.00, 140.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:15:53', NULL, NULL, 4, 1, 24),
(48, '2409100MDTr9izRoqE40W3yJhjrJQUcR5d8MNjwfDLoigg0WdrG6Un7R17259633765', '2411895', NULL, 120.00, 120.00, 120.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:16:16', NULL, NULL, 5, 1, 24),
(49, '240910vKJAplR4NP2vJyGi6dzpggirjw4S3DWL8llHSCR3LwLPlBuqkb172596359510', '24504610', NULL, 30.00, 30.00, 30.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:19:55', NULL, NULL, 10, 1, 25),
(50, '240910oYw37VKYd4iQCwGBMj9rF3ToNc5Gydu1qCGqZbYvTtbU2Kc5B517259636927', '2437527', NULL, 15000.00, 15000.00, 0.00, 15000.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:21:32', NULL, NULL, 7, 1, 26),
(51, '240910vInoUP62RyKHPVwc0fwrqjEDZIFiYsIeuQnMJ7ApU9jpYzEUQa17259637038', '2490238', NULL, 20000.00, 20000.00, 0.00, 20000.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:21:43', NULL, NULL, 8, 1, 26),
(52, '240910CCbLaYHrmcioTsYYK6hOLH8ywMbZiOlZPpP8ngzwRA8VYV1bMe17259637931', '2444701', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:23:13', NULL, NULL, 1, 1, 27),
(53, '240910O2t2bTLpFPiGVtDni0RsPppFHgKL5vfLQfcekPMkEui8PnPUDL17259637972', '2472092', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:23:17', NULL, NULL, 2, 1, 27),
(54, '2409102mFhn3trrigSECZLgnsp8q7KaKYamCurUMsJh6JQitkTC19jjY17259638063', '2416443', NULL, 140.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-09-10 10:23:26', NULL, NULL, 3, 1, 27),
(55, '240910NGaowB4piwvgaM6t2QNpoHB6JdaTcAc1TSgzzcyymQYuvSZKbT17259648833', '2429773', NULL, 140.00, 40.00, 40.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:41:23', NULL, NULL, 3, 1, 28),
(56, '240910g7fqtWtrSr9mQFkU818VU7vgmiBbKGA7F91P2WCCKm4FZ1GNVi17259648884', '2463614', NULL, 140.00, 110.00, 110.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-09-10 10:41:28', NULL, NULL, 4, 1, 28),
(57, '2409106VDdCnRceZBvgKLOBS0jKCrB5awVd0qySVGSJ0vvlbCSjoaGBM17259648964', '2476134', NULL, 140.00, 30.00, 30.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:41:36', NULL, NULL, 4, 1, 28),
(58, '2409107tZu49V8Uw06cVDp8aRq9knZIANYcEl2OjA8elMUrgY5Vvm00v17259649025', '2434035', NULL, 120.00, 120.00, 120.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 10:41:42', NULL, NULL, 5, 1, 28),
(59, '240910ORu6wqKA5MTvLO8zzB4JuwA9aqOFLjn3swvlTrWKcez5b1M9Us17259664611', '2403351', NULL, 150.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 11:07:41', NULL, NULL, 1, 1, 29),
(60, '240910lBiw33ZnRs7kjya7SDDJdm5jMf3BFv8hBvjNmDoVJbcMh342iy17259664642', '2453842', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 11:07:44', NULL, NULL, 2, 1, 29),
(61, '2409106MjIkhITNbBDYNhbSUJrAUgvL0rKRj96is3dZdBvYyd6hr2NH717259664733', '2462563', NULL, 140.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-09-10 11:07:53', NULL, NULL, 3, 1, 29),
(62, '240910egsBk1mdffVu6mIH5bneGYALB0AutFdWmrD1SOFNaI4KJPmngc172596678510', '24324910', NULL, 30.00, 30.00, 30.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 11:13:05', NULL, NULL, 10, 1, 30),
(63, '240910lzJQiGUyH3Ae2MytLn85ocybPTi3bK1QZ5an9WuTddMr1Ns6hQ17259670937', '2472537', NULL, 15000.00, 15000.00, 0.00, 15000.00, 0.00, 'actif', 'balance', NULL, '2024-09-10 11:18:13', NULL, NULL, 7, 1, 31),
(64, '240910QrfqipnefBSrrrLywn3zJwAeMUf94H66AH6PjEjl1YO6nGg8TM17259671068', '2469918', NULL, 20000.00, 10000.00, 0.00, 10000.00, 0.00, 'actif', 'deposit', NULL, '2024-09-10 11:18:26', NULL, NULL, 8, 1, 31),
(66, '240910T2rnFHm9cvd05etYjiI5F8u0UVNWMpgvRAkHLcHUwsTG3f1Ima172597957410', '24881710', NULL, 30.00, 0.00, 0.00, 0.00, 0.00, 'cancel', 'balance', NULL, '2024-09-10 14:46:14', '2024-11-13 15:06:29', NULL, 10, 1, 33),
(67, '240912CVufOKCCQeSWVkyChvbFP11wtZsqJIlSlhjq5m0EqjhIFkLC7l17261259238', '2405118', NULL, 20000.00, 20000.00, 0.00, 20000.00, 0.00, 'actif', 'balance', NULL, '2024-09-12 07:25:23', NULL, NULL, 8, 1, 34),
(68, '240912mSCjTO9IJGrRn4CJiAqp0DFcNA6uQoCIyhLW1pLteeGFYbubFF17261259339', '2431299', NULL, 15000.00, 15000.00, 10.00, 0.00, 13400.00, 'actif', 'balance', NULL, '2024-09-12 07:25:33', NULL, NULL, 9, 1, 34),
(69, '2409160UjI50IaobHaSlsop7sPMR1uB3FcRLfVvT1iIkbQyFs1E2hWm817264998812', '2443622', NULL, 110.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-16 15:18:01', NULL, NULL, 2, 1, 35),
(70, '240919PSLbVSNlojv6Ko1KD8ipPwnhe12lU5gQAp3RBdkKNyQuQsG5RQ17267505103', '2497833', NULL, 140.00, 140.00, 110.00, 100000.00, 5.21, 'actif', 'balance', NULL, '2024-09-19 12:55:10', NULL, NULL, 3, 1, 36),
(72, '240921bkNZ2ab19GUOrVlMOP3leKDF6Z5Fu54to53om3IDWtUrBHG3Ey172691705610', '24116610', NULL, 30.00, 30.00, 50.00, 0.00, 20.00, 'actif', 'balance', NULL, '2024-09-21 13:10:56', NULL, NULL, 10, 1, 39),
(73, '240921MNOGAzw7ynlnu74DmQJp9GmGJQpKYuwjzHYZyEtYhoIZkyDOmu17269218321', '2456571', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-21 14:30:32', NULL, NULL, 1, 1, 40),
(74, '240921mK6936ODFKJwIV4ncELk4ERdson7bpardTpwRVw1T8LLt5sVfM17269218352', '2476742', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-21 14:30:35', NULL, NULL, 2, 1, 40),
(75, '240921g0EhuoQNsT4V2Yr0rsqnWb9vCMCU4ZMjHCSBQ3sj8fFvyOKeD917269218523', '2464603', NULL, 140.00, 140.00, 100.00, 150000.00, 12.82, 'actif', 'balance', NULL, '2024-09-21 14:30:52', NULL, NULL, 3, 1, 40),
(76, '240921eVMpj5ns3Y0hzctLqPez7ZOFFHOklDiFZOsN0Ussc0I1B51VKv17269219054', '2484174', NULL, 140.00, 45.21, 10.00, 100000.00, 0.00, 'actif', 'deposit', NULL, '2024-09-21 14:31:45', NULL, NULL, 4, 1, 40),
(77, '240925e5bqwYGjGVUZTGYg1g0kFiR48T3mOV5Cet16D0bJiZQ7GyjCed172727373810', '24366710', NULL, 30.00, 30.00, 30.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-25 16:15:38', NULL, NULL, 10, 1, 41),
(78, '2409250sAmAuBbs450pU2joZQz8zUHlzfuDQsZ9N1HmvD0t0PPoBWoc217272737476', '2441356', NULL, 100.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-25 16:15:47', NULL, NULL, 6, 1, 41),
(79, '240925YTLuOYPYHO6HWJ8iYCYsiy3F3kMZVGsm6ADsyuaTGGcvEwvs2417272737711', '2448881', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-25 16:16:11', NULL, NULL, 1, 1, 41),
(80, '240925eu6hMvPG38D3Ndg2a4pZ8vhr02lnTrPscJAPOe25GcYPD8HfVW17272737782', '2412372', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-09-25 16:16:18', NULL, NULL, 2, 1, 41),
(81, '240925Oozw4YfjtMZJA89LN0Li83WS5IKNmn6OKbIZuQOvMJVIAcCVOi17272737923', '2475463', NULL, 140.00, 40.56, 30.00, 30000.00, 0.00, 'actif', 'deposit', NULL, '2024-09-25 16:16:32', NULL, NULL, 3, 1, 41),
(82, '240925rACWq655k7yUAAre0Y0CvMvAuFcUosECd4akz4UaW56QbTvb5k17272747813', '2402973', NULL, 140.00, 99.44, 100.00, 0.00, 0.56, 'actif', 'balance', NULL, '2024-09-25 16:33:01', NULL, NULL, 3, 1, 42),
(83, '240925PQC1yo7A485BvMiOqU1VlIfyjT3F6LCoUVs9cSrH3rZGaUDD9w17272747914', '2403104', NULL, 140.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-09-25 16:33:11', NULL, NULL, 4, 1, 42),
(84, '2410011q67PycrSBdntb5kwoSgAerelOVwsL314b794IYriByiMjfmKe17277759681', '2445051', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-10-01 11:46:08', NULL, NULL, 1, 1, 43),
(86, '241001VI5h5Q6siQzKneZFECzesHZfPvYupkSoNbDk1fQRbZ2c1LqhKo17277772762', '2489672', NULL, 150.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-10-01 12:07:56', NULL, NULL, 2, 1, 44),
(87, '241001cOSENhAAaZcrJ6ZWzWk8dEinDKns3JciJYa0Djq2sCU6KmAPmh17277777311', '2433501', NULL, 130.00, 130.00, 130.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-10-01 12:15:31', NULL, NULL, 1, 1, 45),
(88, '241001zIDbDVeEaYWzCRmBYQi3mVfpVlwk9nJHD3FZgQyIFV8HBuFuO017277777723', '2447243', NULL, 140.00, 40.00, 40.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-10-01 12:16:12', NULL, NULL, 3, 1, 46),
(89, '241001qqgLrgKqb6abLs015wl2MiRIuUewy9ZtDdDG32QS10qyWDYRUi172778318910', '24654110', NULL, 30.00, 30.00, 30.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-10-01 13:46:29', NULL, NULL, 10, 1, 47),
(90, '241001M4Yw1whyq9lMrC4JuSVMvd6eMa2hI4wnrdlitYpKR1iAwTAMy5172778321310', '24249810', NULL, 30.00, 30.00, 60.00, 0.00, 30.00, 'actif', 'balance', NULL, '2024-10-01 13:46:53', NULL, NULL, 10, 1, 48),
(94, '241024kzamAbfzO9VIoTLZAen7CDGJTgE8dbBctsbMMRJvjvHWdoLzR417297726403', '2439053', NULL, 140.00, 40.00, 40.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-10-24 14:24:00', NULL, NULL, 3, 1, 50),
(95, '241024jhU4qGgiRcTYRcjWPHS5d7M0c3otJPnkk5Tj3YHMLG3PmNzm4N17297726444', '2407494', NULL, 140.00, 140.00, 140.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-10-24 14:24:04', NULL, NULL, 4, 1, 50),
(96, '241024puOMeOjtTpZ22BSia7wC8IDeuRqG2VSgyKyYjV3M3QAl5WGded17297727876', '2444856', NULL, 100.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-10-24 14:26:27', NULL, NULL, 6, 1, 51),
(97, '241024QWcn9fNhq4fb7Dcv1AYACWDKRA2tfJQ4BZWQui6bf5tq5HRn4517297727964', '2445494', NULL, 140.00, 94.79, 100.00, 0.00, 5.21, 'actif', 'balance', NULL, '2024-10-24 14:26:36', NULL, NULL, 4, 1, 51),
(98, '241027nHRtIkkjPOp4w4u1YpjYzr9YsR4eIKEW3iecVGVKaZrp9m7zfz173002589317', '24008517', NULL, 12000.00, 12000.00, 0.00, 12000.00, 0.00, 'actif', 'balance', NULL, '2024-10-27 12:44:53', NULL, NULL, 17, 1, 52),
(99, '241027p2G0tSJJ98enTRpyo8dhmWLvYLfkA5AfAkzWGlWMJCiVGQCwiS173002591815', '24468415', NULL, 30000.00, 30000.00, 0.00, 30000.00, 0.00, 'actif', 'balance', NULL, '2024-10-27 12:45:18', NULL, NULL, 15, 1, 52),
(100, '241027mbWshoyfIY54RNc5Yd5ezQ9ckmWN1Sbo1eCDnGbsPNnR0UakF8173002592916', '24711716', NULL, 20000.00, 20000.00, 0.00, 30000.00, 10000.00, 'actif', 'balance', NULL, '2024-10-27 12:45:29', NULL, NULL, 16, 1, 52),
(101, '241027aLG6G88Bq20nWuWLRrkEq3LFkGbSbYFt8Ae1SWjuaYShOMqhd5173002605915', '24134015', NULL, 30000.00, 30000.00, 0.00, 30000.00, 0.00, 'actif', 'balance', NULL, '2024-10-27 12:47:39', NULL, NULL, 15, 1, 53),
(102, '2410274CKdt9CKISpa63IcsftFrhiRNKsIVYH7s1ULyE86877AkhBO0h173002606916', '24767116', NULL, 20000.00, 20000.00, 0.00, 20000.00, 0.00, 'actif', 'balance', NULL, '2024-10-27 12:47:49', NULL, NULL, 16, 1, 53),
(103, '2410278oi1d3ZqREeU4f80JQVwuncajMEsd30uJhICElcgKg792ubQUW173002614111', '24348511', NULL, 4.50, 4.50, 5.00, 0.00, 0.50, 'actif', 'balance', NULL, '2024-10-27 12:49:01', NULL, NULL, 11, 1, 54),
(104, '2410279ZAEsIFQkohwSeDzInTjqBZLmlIz5ySvWNSTyY9pnQwEZyt4fC173002616212', '24300312', NULL, 5.50, 0.00, 0.00, 0.00, 0.00, 'cancel', 'deposit', NULL, '2024-10-27 12:49:22', '2024-10-27 12:49:56', NULL, 12, 1, 54),
(105, '241027pbj4qr8C2HE3Nfvp2c2yw66nwtQpgKhCBYdWSUmKvrZytScFdL173002620712', '24496512', NULL, 5.50, 5.00, 5.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2024-10-27 12:50:07', NULL, NULL, 12, 1, 54),
(106, '241027awqeUMIv5pmBb9t6I6s8pWUrRNmtcCtpCauS1AA9q3ijAvvBUZ173002632012', '24964912', NULL, 5.50, 0.00, 0.00, 0.00, 1.26, 'cancel', 'balance', NULL, '2024-10-27 12:52:00', '2024-10-27 12:52:49', NULL, 12, 1, 54),
(107, '241027pkDUoAKsqZJRoY9HqPgjOWGeJiqi958b6LAcNFBteBfW26fipK173002635213', '24258713', NULL, 10.00, 10.00, 10.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-10-27 12:52:32', NULL, NULL, 13, 1, 54),
(108, '241027vIlf4sdbQqdsQyDvATero8mVcdqhN1qwwY0bHb7mTjB2rt8mkG173002635414', '24501714', NULL, 15.00, 15.00, 20.00, 0.00, 5.00, 'actif', 'balance', NULL, '2024-10-27 12:52:34', NULL, NULL, 14, 1, 54),
(109, '241101j2Mdf3dekLoMTLR3l0oY02YTwzegVA1l33G29MlIkTJYCIOrn617304581231', '2464311', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-11-01 12:48:43', NULL, NULL, 1, 1, 55),
(110, '241101jbWdOSVRjzIifBNHl4ZGz8hFkwHq4ES1BdLGFqmegcDSK3ykJJ17304581252', '2447392', NULL, 150.00, 150.00, 200.00, 0.00, 50.00, 'actif', 'balance', NULL, '2024-11-01 12:48:45', NULL, NULL, 2, 1, 55),
(111, '2411018GA8yL0Voo9ePSOr609awrf8IvqQgcTWIu3BpgqOV5HAm6kbsv17304581333', '2494103', NULL, 140.00, 70.42, 0.00, 200000.00, 0.00, 'actif', 'deposit', NULL, '2024-11-01 12:48:53', NULL, NULL, 3, 1, 55),
(112, '2411115IE3ohS9tPPC2dH8wAKllgGPS6UCBj09HDiTsd6Lycdia3FUv617313206991', '2495881', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-11-11 12:24:59', NULL, NULL, 1, 1, 56),
(113, '241113ufiTerT0eqDF78eac5c2kMoThBbZPRnrbycdwEhqdDF7kMjlGE173150440711', '24768811', NULL, 4.50, 4.50, 5.00, 0.00, 0.50, 'actif', 'balance', NULL, '2024-11-13 15:26:47', NULL, NULL, 11, 1, 57),
(114, '2411133I3PFroUh5Gzu0CHyy9hHy6SYb58bK4deoBejubU5ccbFGdGG4173150441512', '24180612', NULL, 5.50, 5.50, 10.00, 0.00, 4.50, 'actif', 'balance', NULL, '2024-11-13 15:26:55', NULL, NULL, 12, 1, 57),
(115, '241113vnkFE1B2MvRQPuLqAl8lBdNi1m09MhpAVMhDhChE9Pyzupulvi173150747115', '24785315', NULL, 30000.00, 30000.00, 0.00, 30000.00, 0.00, 'actif', 'balance', NULL, '2024-11-13 16:17:51', NULL, NULL, 15, 1, 58),
(116, '241113pgkJScCfjKluSmRrohUm0ZEmVTupbK4hryaM7NdmMyqPePpKNn17315075056', '2461156', NULL, 100.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'balance', NULL, '2024-11-13 16:18:25', NULL, NULL, 6, 1, 59),
(117, '250217V8f0N0kmYb4Dq7oSiFCLEzBDpsCcMyAP9u4OSuE2rgTEvaFL1S17397971355', '2594145', NULL, 120.00, 50.00, 50.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2025-02-17 14:58:55', NULL, NULL, 5, 1, 60),
(118, '250217ubhDT3zNYbCzG9qsBgpDqErivm0pppSsZ25DkZC1VvZCcw3icK17397972135', '2512105', NULL, 120.00, 70.00, 70.00, 0.00, 0.00, 'actif', 'balance', NULL, '2025-02-17 15:00:13', NULL, NULL, 5, 1, 61),
(119, '250929mgMZCVqwbnQ8PgOeUy7S1Y9mUrN16ZmTvHPKu9U9J0uAFp87nE175913618010', '25953310', NULL, 30.00, 30.00, 30.00, 0.00, 0.00, 'actif', 'balance', NULL, '2025-09-29 10:56:20', NULL, NULL, 10, 1, 62),
(120, '251206iDKTBhnRRN8lCT4Kif4L8DQKmfyTOozMImW9uDBIbag6Nd7NyG17650344711', '2595451', NULL, 150.00, 150.00, 150.00, 0.00, 0.00, 'actif', 'balance', NULL, '2025-12-06 17:21:11', NULL, NULL, 1, 1, 63),
(121, '251206tWbJmrY4Rkh7U0h6bwLrjk5Nvy8TrnUeaschcgap7Y5TJCcpZC17650344782', '2569812', NULL, 150.00, 100.00, 100.00, 0.00, 0.00, 'actif', 'deposit', NULL, '2025-12-06 17:21:18', NULL, NULL, 2, 1, 63);

-- --------------------------------------------------------

--
-- Table structure for table `payments_exchanges`
--

CREATE TABLE `payments_exchanges` (
  `exchange_id` int(11) UNSIGNED NOT NULL,
  `exchange_token` varchar(75) NOT NULL,
  `exchange_code` varchar(10) NOT NULL,
  `exchange_name` varchar(75) DEFAULT NULL,
  `exchange_value` decimal(10,2) DEFAULT NULL,
  `exchange_start_date` date DEFAULT NULL,
  `exchange_end_date` date DEFAULT NULL,
  `exchange_status` varchar(25) DEFAULT NULL,
  `exchange_type` varchar(75) DEFAULT NULL,
  `exchange_notes` text DEFAULT NULL,
  `exchange_created_at` datetime DEFAULT NULL,
  `exchange_updated_at` datetime DEFAULT NULL,
  `exchange_deleted_at` datetime DEFAULT NULL,
  `exchange_currency_id` varchar(75) DEFAULT NULL,
  `exchange_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments_exchanges`
--

INSERT INTO `payments_exchanges` (`exchange_id`, `exchange_token`, `exchange_code`, `exchange_name`, `exchange_value`, `exchange_start_date`, `exchange_end_date`, `exchange_status`, `exchange_type`, `exchange_notes`, `exchange_created_at`, `exchange_updated_at`, `exchange_deleted_at`, `exchange_currency_id`, `exchange_school_id`) VALUES
(1, '240809aRYgDVPV2AcQ6B8jlcYYj1wdIc1mb5ZJKy9tf3FGClh54rkyDS1723213751', '248966', 'Francs Congolais(CDF)', 2840.00, '2024-08-09', '0000-00-00', 'actif', NULL, NULL, '2024-08-09 14:29:11', NULL, NULL, 'cdf', 1),
(2, '250225l1nBN0boZMbhcrQe12GNgbokgEITcyS3TG8pCJcHmcyWdhGAib1740495798', '259035', 'Dollars Américains(USD)', 2850.00, '2025-02-25', '0000-00-00', 'actif', NULL, NULL, '2025-02-25 17:03:18', NULL, NULL, 'usd', 9);

-- --------------------------------------------------------

--
-- Table structure for table `payments_reports`
--

CREATE TABLE `payments_reports` (
  `report_id` int(11) UNSIGNED NOT NULL,
  `report_token` varchar(75) NOT NULL,
  `report_code` varchar(10) NOT NULL,
  `report_date` date DEFAULT NULL,
  `report_total_paid` decimal(10,2) DEFAULT NULL,
  `report_total_fees` decimal(10,2) DEFAULT NULL,
  `report_balance` decimal(10,2) DEFAULT NULL,
  `report_currency` varchar(25) DEFAULT NULL,
  `report_status` varchar(25) DEFAULT NULL,
  `report_type` varchar(75) DEFAULT NULL,
  `report_notes` text DEFAULT NULL,
  `report_created_at` datetime DEFAULT NULL,
  `report_updated_at` datetime DEFAULT NULL,
  `report_deleted_at` datetime DEFAULT NULL,
  `report_year_id` int(11) UNSIGNED DEFAULT NULL,
  `report_student_id` int(11) UNSIGNED DEFAULT NULL,
  `report_school_id` int(11) UNSIGNED DEFAULT NULL,
  `report_user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) UNSIGNED NOT NULL,
  `result_token` varchar(75) NOT NULL,
  `result_code` varchar(10) NOT NULL,
  `result_place` varchar(75) NOT NULL,
  `result_points_obtained` decimal(5,2) NOT NULL,
  `result_points_maximum` decimal(5,2) NOT NULL,
  `result_percentage` float(10,2) NOT NULL,
  `result_application` varchar(75) DEFAULT NULL,
  `result_decision` varchar(75) DEFAULT NULL,
  `result_status` varchar(25) DEFAULT NULL,
  `result_available` int(11) DEFAULT 0,
  `result_type` varchar(75) DEFAULT NULL,
  `result_notes` text DEFAULT NULL,
  `result_created_at` datetime DEFAULT NULL,
  `result_updated_at` datetime DEFAULT NULL,
  `result_deleted_at` datetime DEFAULT NULL,
  `result_annualperiod_id` int(11) UNSIGNED DEFAULT NULL,
  `result_student_id` int(11) UNSIGNED DEFAULT NULL,
  `result_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `result_token`, `result_code`, `result_place`, `result_points_obtained`, `result_points_maximum`, `result_percentage`, `result_application`, `result_decision`, `result_status`, `result_available`, `result_type`, `result_notes`, `result_created_at`, `result_updated_at`, `result_deleted_at`, `result_annualperiod_id`, `result_student_id`, `result_school_id`) VALUES
(1, '241027o3ZZnNdwnCWqyp57TfNTklTiqBVlsHBnpCfwUKHo6kUCCVNYPu1730033442', '242557', '15', 400.00, 800.00, 50.00, 'TB', NULL, 'published', 0, 'period', 'Veuillez vous référer a la comptabilité', '2024-10-27 14:50:42', '2025-02-25 13:16:07', NULL, 5, 9, 1),
(2, '241027gUsTP2W7gTCWIIeuROSmNrDwFwB0T8lClF1KUrpwAgEHblgpsk1730036130', '240386', '2', 500.00, 600.00, 83.33, 'B', NULL, 'published', 1, 'period', NULL, '2024-10-27 15:35:30', '2024-11-01 11:25:43', NULL, 5, 3, 1),
(3, '241027wUz42WpIPmAb6kiQnjgRzcGkbgphotaeWlrI80NuGeP8UkPiGG1730041190', '242291', '1', 400.00, 600.00, 66.67, 'AB', NULL, 'published', 1, 'period', 'Vérification effectuée', '2024-10-27 16:59:50', '2025-08-26 10:53:18', NULL, 5, 4, 1),
(4, '241027aggAGhCTNsfg36nY5JSiVzrqnmf6dzimtl2lgNt3w9cOnk9POw1730041437', '249363', '1', 800.00, 900.00, 88.89, 'MA', NULL, 'published', 1, 'period', 'Vérification effectuée', '2024-10-27 17:03:57', '2024-11-11 12:25:57', NULL, 10, 13, 1),
(5, '241028gIq0mbrutyiZe3YrkuprSvuSeKEYWOgNccrnc5J6r4i6np8BSf1730108494', '249319', '3', 600.00, 850.00, 70.59, 'B', NULL, 'published', 0, 'period', 'Veuillez vous référer a la comptabilité', '2024-10-28 11:41:34', '2025-02-25 13:15:42', NULL, 5, 2, 1),
(6, '241030qY8DPh83lgIr7owgkJ3oF74aQncNQudKRMMRWT8AwtcCCJgNch1730284548', '240604', '3', 650.00, 800.00, 81.25, 'E', NULL, 'published', 1, 'period', 'Vérification effectuée', '2024-10-30 12:35:48', '2024-11-11 12:23:24', NULL, 10, 14, 1),
(7, '241030EQOnp3Rwz1J28Ftw7sbO5MkTo3dBIspHDmv53DOQaKE1Z1Ic2P1730284851', '247341', '2', 0.00, 0.00, 85.75, 'B', NULL, 'published', 1, 'period', 'Vérification effectuée', '2024-10-30 12:40:51', '2024-11-11 12:23:24', NULL, 10, 15, 1),
(8, '241101Gao1Gt4iabA0wTw5HnlpYHNCCw2bdzIeDDlZD2T5JVJohJ67PO1730458376', '245895', '5', 750.00, 900.00, 83.33, 'B', NULL, 'published', 0, 'period', 'Veuillez vous référer a la comptabilité', '2024-11-01 12:52:56', '2024-11-11 12:23:24', NULL, 10, 18, 1),
(9, '241111QDNuop0P4kM38ttUt9OqjWK0fRY1WdPLOBg1yAthpySTv6brcR1731316595', '240026', '4', 760.00, 900.00, 84.44, 'B', NULL, 'published', 1, 'period', 'Vérification effectuée', '2024-11-11 11:16:35', '2024-11-11 12:23:24', NULL, 10, 12, 1),
(10, '2502250iZ0YfQhlB1LBiln4CdvlkeYLHnUnVanMyGdf1M3lcy45irs1j1740477401', '257050', '1', 450.00, 600.00, 75.00, 'TB', NULL, 'pending', 0, 'period', 'Veuillez vous référer a la comptabilité', '2025-02-25 11:56:41', '2025-02-25 13:13:35', NULL, 7, 9, 1),
(11, '250225cQ7qagoMq1yB5ztKcNlPLKaIGPU9iPwRcufs58MNI02pKvocNZ1740477468', '258105', '4', 350.00, 600.00, 58.33, 'B', NULL, 'actif', 0, 'period', 'Veuillez vous référer a la comptabilité', '2025-02-25 11:57:48', '2025-02-25 13:13:46', NULL, 7, 2, 1),
(12, '250225DJkTeoUzlCo4ou5YYoD0suuORbqRkpwIuDCKe0Lpp1M92vnBDa1740478404', '250169', '2', 400.00, 600.00, 66.67, 'TB', NULL, 'published', 1, 'period', 'Vérification effectuée', '2025-02-25 12:13:24', '2025-02-25 13:56:34', NULL, 7, 7, 1),
(13, '250225a607E63u1UARt035bSSTOCHlzDNL2YGz7nhNShWkm51R3PBs1Y1740478493', '252987', '3', 380.00, 600.00, 63.33, 'B', NULL, 'published', 1, 'period', 'Vérification effectuée', '2025-02-25 12:14:53', '2025-02-26 07:03:42', NULL, 7, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `results_annual_period`
--

CREATE TABLE `results_annual_period` (
  `annualperiod_id` int(11) UNSIGNED NOT NULL,
  `annualperiod_token` varchar(75) NOT NULL,
  `annualperiod_code` varchar(10) NOT NULL,
  `annualperiod_status` varchar(25) DEFAULT NULL,
  `annualperiod_type` varchar(75) DEFAULT NULL,
  `annualperiod_notes` text DEFAULT NULL,
  `annualperiod_created_at` datetime DEFAULT NULL,
  `annualperiod_updated_at` datetime DEFAULT NULL,
  `annualperiod_deleted_at` datetime DEFAULT NULL,
  `annualperiod_period_id` int(11) UNSIGNED DEFAULT NULL,
  `annualperiod_year_id` int(11) UNSIGNED DEFAULT NULL,
  `annualperiod_section_id` int(11) DEFAULT NULL,
  `annualperiod_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results_annual_period`
--

INSERT INTO `results_annual_period` (`annualperiod_id`, `annualperiod_token`, `annualperiod_code`, `annualperiod_status`, `annualperiod_type`, `annualperiod_notes`, `annualperiod_created_at`, `annualperiod_updated_at`, `annualperiod_deleted_at`, `annualperiod_period_id`, `annualperiod_year_id`, `annualperiod_section_id`, `annualperiod_school_id`) VALUES
(5, '241027S29TPFJCikqn5BqjBMTQG7NLvai3nKaSHGMpYUEISvPtOSwmZh1730031215', '244782', 'actif', NULL, NULL, '2024-10-27 14:13:35', NULL, NULL, 1, 2, 1, 1),
(7, '241027b7uSlQwacJZFka2J3p1Qzg2e9VRTrsD7B2UYTLKwj5Oh41wzmF1730031477', '244452', 'actif', NULL, NULL, '2024-10-27 14:17:57', NULL, NULL, 2, 2, 1, 1),
(9, '241027kZy9BEb5FlE0qYjoWjR4KLmmEe3rE1yj6C14TVazH5svpoUq221730031501', '245810', 'actif', NULL, NULL, '2024-10-27 14:18:21', NULL, NULL, 8, 2, 1, 1),
(10, '241027YpLFOe6gtIMAI6DKActNli1VprJ5rvzaQfdm8LqU4KcvwRwRgD1730031533', '242041', 'actif', NULL, NULL, '2024-10-27 14:18:53', NULL, NULL, 1, 2, 2, 1),
(11, '241027nvlCi8oYiiSG4BUeivjJtopbbq7qy7NPZ0e1zd5OORrKQdUiAe1730031539', '243730', 'actif', NULL, NULL, '2024-10-27 14:18:59', '2024-10-27 14:21:11', NULL, 2, 2, 2, 1),
(12, '241027fps2862HrYyLpjrkEtISKgL9QQVSUSOTkNRsr0vkkPU95TNzJR1730031562', '249746', 'actif', NULL, NULL, '2024-10-27 14:19:22', NULL, NULL, 8, 2, 2, 1),
(13, '250225v9eHLsRkHLVnre3FCOwIEDyjL19uRDpBs1dd6Cd8srnGIKAWDo1740478192', '254064', 'actif', NULL, NULL, '2025-02-25 12:09:52', NULL, NULL, 3, 2, 1, 1),
(14, '250616JEjdh1CMSLMENNe92OrrWcAsyCFsK1A1SLY7lI2yblGTUhG6TQ1750065787', '258276', 'actif', NULL, NULL, '2025-06-16 11:23:07', NULL, NULL, 1, 2, 3, 1),
(15, '250616H814nSd1g03ayRGB5nlVvFMudWfbboOssWB2DfC57ojtGznA4q1750065809', '252612', 'actif', NULL, NULL, '2025-06-16 11:23:29', NULL, NULL, 2, 2, 3, 1),
(16, '2506165Ik5vRZ9UBmIMy2YpJuhnJ8VPvvLn5DaMdJCQF3GhTKEA9ov4H1750065814', '252994', 'actif', NULL, NULL, '2025-06-16 11:23:34', NULL, NULL, 8, 2, 3, 1),
(17, '250616Iev6Id1GZC9RtKQbN8qkC4DLonZ7gfcWfL8bQkJJR3KBNzklMu1750065819', '257329', 'actif', NULL, NULL, '2025-06-16 11:23:39', NULL, NULL, 9, 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `results_criteria`
--

CREATE TABLE `results_criteria` (
  `criteria_id` int(11) UNSIGNED NOT NULL,
  `criteria_token` varchar(75) NOT NULL,
  `criteria_code` varchar(10) NOT NULL,
  `criteria_status` varchar(25) DEFAULT NULL,
  `criteria_type` varchar(75) DEFAULT NULL,
  `criteria_notes` text DEFAULT NULL,
  `criteria_created_at` datetime DEFAULT NULL,
  `criteria_updated_at` datetime DEFAULT NULL,
  `criteria_deleted_at` datetime DEFAULT NULL,
  `criteria_period_id` int(11) UNSIGNED DEFAULT 0,
  `criteria_classe_id` int(11) UNSIGNED DEFAULT NULL,
  `criteria_fee_id` int(11) UNSIGNED DEFAULT NULL,
  `criteria_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results_criteria`
--

INSERT INTO `results_criteria` (`criteria_id`, `criteria_token`, `criteria_code`, `criteria_status`, `criteria_type`, `criteria_notes`, `criteria_created_at`, `criteria_updated_at`, `criteria_deleted_at`, `criteria_period_id`, `criteria_classe_id`, `criteria_fee_id`, `criteria_school_id`) VALUES
(9, '2411111pQeaFOFOtRDVRdvKnd6t18sq3O1HsVqNlelU7i54kryF7J4Ot1731314430', '248564', 'actif', NULL, NULL, '2024-11-11 10:40:30', NULL, NULL, 10, 4, 1, 1),
(11, '241111faaDHjOk31GLsFF3ZPkoamtTydbDlvodFArlycI263udZZRlKn1731316480', '242576', 'inactif', NULL, NULL, '2024-11-11 11:14:40', '2024-11-11 12:25:49', NULL, 10, 4, 10, 1),
(13, '250225gY3uqTR9FKd91fjVvVgT1gtfZaRditT3IqA3aoacwDHMFgBLAW1740478302', '255647', 'actif', NULL, NULL, '2025-02-25 12:11:42', NULL, NULL, 5, 1, 1, 1),
(14, '250225SUfVgobeMs0ogmudOpiV4lJJGMQa35HZThcY9aGaJlqTucCisu1740478986', '257920', 'actif', NULL, NULL, '2025-02-25 12:23:06', NULL, NULL, 5, 1, 7, 1),
(15, '250225mJIZ9S72kBeCszngg8qOUVU47BTWLEF5B4lGUWSbfovo0ZQNAK1740480004', '253427', 'actif', NULL, NULL, '2025-02-25 12:40:04', NULL, NULL, 7, 1, 7, 1),
(16, '250225WE2eHt02CvASHUac6Ypn2FAT23wrfrrNygJ2EaSHHqAMS0UeR81740480099', '258596', 'actif', NULL, NULL, '2025-02-25 12:41:39', NULL, NULL, 7, 1, 1, 1),
(17, '250225BeZmubR4s2wKB0HdoQJnePZTEHHjlFZ9DskkfYAfuVlJIJ1EgK1740480259', '257097', 'actif', NULL, NULL, '2025-02-25 12:44:19', NULL, NULL, 7, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `results_period`
--

CREATE TABLE `results_period` (
  `period_id` int(11) UNSIGNED NOT NULL,
  `period_token` varchar(75) NOT NULL,
  `period_code` varchar(10) NOT NULL,
  `period_name` varchar(75) DEFAULT NULL,
  `period_shortname` varchar(75) DEFAULT NULL,
  `period_status` varchar(25) DEFAULT NULL,
  `period_type` varchar(75) DEFAULT NULL,
  `period_notes` text DEFAULT NULL,
  `period_created_at` datetime DEFAULT NULL,
  `period_updated_at` datetime DEFAULT NULL,
  `period_deleted_at` datetime DEFAULT NULL,
  `period_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results_period`
--

INSERT INTO `results_period` (`period_id`, `period_token`, `period_code`, `period_name`, `period_shortname`, `period_status`, `period_type`, `period_notes`, `period_created_at`, `period_updated_at`, `period_deleted_at`, `period_school_id`) VALUES
(1, '241026D2QWiDw46YrDAEvsvW2uSGuEdlZWQCBaDCm3URrpz4H3A59MQb1729931220', '1', 'premiere periode', 'p1', 'inactif', NULL, NULL, '2024-10-26 10:27:00', '2024-10-27 14:22:03', NULL, 1),
(2, '241026OEGS1ORTguYcOAVVe5l8wQvT4GfhiJT3w4mh0Lfr8VdSvd6RYI1729931917', '2', 'deuxieme periode', 'p2', 'actif', NULL, NULL, '2024-10-26 10:38:37', '2025-02-25 12:12:04', NULL, 1),
(3, '241026pBHcSkKZO4ReWNfOwNHpN7dzajEWUdIKsSq3n2kueZwp0d4f6p1729931941', '3', 'Troisieme periode', 'p3', 'inactif', NULL, NULL, '2024-10-26 10:39:01', '2025-02-25 12:09:03', NULL, 1),
(5, '241027hVYPYtgs1B5iOvAK5c6ZGIsJpHvErjh5Cr3PcfkNCAzMyUqUpD1730030725', '4', 'quatrieme periode', 'p4', 'inactif', NULL, NULL, '2024-10-27 14:05:25', NULL, NULL, 1),
(6, '241027UQqEfA0RNS8Z0fqNzkiu7U80tbpi9BLJpe1jFg2ghu8YAo5JdT1730030743', '5', 'cinqieme periode', 'p5', 'inactif', NULL, NULL, '2024-10-27 14:05:43', '2024-10-27 14:12:05', NULL, 1),
(7, '241027yCA1ANOdahvzI4HcPWeWvSS5KiLW6FNgO3gnaFrIJSslRZvr7E1730030787', '6', 'Sixieme periode', 'p6', 'inactif', NULL, NULL, '2024-10-27 14:06:27', NULL, NULL, 1),
(8, '2410271kfdytnNmlL2CAbZT9CVUFUdJt1FOrHPeiU3isD7GflnNNsD8e1730031010', '242351', 'examen 1', 'e1', 'inactif', NULL, NULL, '2024-10-27 14:10:10', '2024-10-27 14:21:57', NULL, 1),
(9, '241027ZrJjVzGQgJaJRSeTeBcln7H1NzRSW4KF2thfyNnbodSDD7z9M41730031046', '247639', 'examen 2', 'e2', 'inactif', NULL, NULL, '2024-10-27 14:10:46', NULL, NULL, 1),
(10, '2410278iK8u4ObjA0Z997sDHp64gujRsmJR5snStNEz6o6GGqq8JIlOQ1730031073', '249915', 'examen 3', 'e3', 'inactif', NULL, NULL, '2024-10-27 14:11:13', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(11) UNSIGNED NOT NULL,
  `school_token` varchar(75) NOT NULL,
  `school_code` varchar(10) NOT NULL,
  `school_antenna_code` varchar(25) DEFAULT NULL,
  `school_fullname` varchar(75) DEFAULT NULL,
  `school_shortname` varchar(75) DEFAULT NULL,
  `school_phone` varchar(15) DEFAULT NULL,
  `school_email` varchar(75) DEFAULT NULL,
  `school_slogan` varchar(75) DEFAULT NULL,
  `school_website` varchar(75) DEFAULT NULL,
  `school_address` varchar(75) DEFAULT NULL,
  `school_city` varchar(50) DEFAULT NULL,
  `school_province` varchar(50) DEFAULT NULL,
  `school_country` varchar(50) DEFAULT NULL,
  `school_ministry_decree` varchar(75) NOT NULL,
  `school_init_identify` varchar(3) DEFAULT NULL,
  `school_status` varchar(25) DEFAULT NULL,
  `school_type` varchar(75) DEFAULT NULL,
  `school_notes` text DEFAULT NULL,
  `school_created_at` datetime DEFAULT NULL,
  `school_updated_at` datetime DEFAULT NULL,
  `school_deleted_at` datetime DEFAULT NULL,
  `school_logo` varchar(75) DEFAULT NULL,
  `school_picture_cover` varchar(75) DEFAULT NULL,
  `school_manager_name` varchar(75) DEFAULT NULL,
  `school_sms_sender` varchar(25) DEFAULT NULL,
  `school_sms_number` int(10) DEFAULT NULL,
  `school_sms_sending` tinyint(1) DEFAULT 1,
  `school_customer_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school_token`, `school_code`, `school_antenna_code`, `school_fullname`, `school_shortname`, `school_phone`, `school_email`, `school_slogan`, `school_website`, `school_address`, `school_city`, `school_province`, `school_country`, `school_ministry_decree`, `school_init_identify`, `school_status`, `school_type`, `school_notes`, `school_created_at`, `school_updated_at`, `school_deleted_at`, `school_logo`, `school_picture_cover`, `school_manager_name`, `school_sms_sender`, `school_sms_number`, `school_sms_sending`, `school_customer_id`) VALUES
(1, '240722MD2P89Vh8o4RIBE90p0Y1AyqO7qe4iSThkCzpTlrqjPPA0ZSrU1721648221', '7-711924', '7101', 'Institut Superior ditotase', 'DITOTASE', '+243858533285', 'contact@ditotase.com', 'Because we believe', 'https://ditotase.com', '43 Avenue Mwepu, Lubumbashi, Haut-Katanga, RDC', 'LUBUMBASHI', 'HAUT-KATANGA', 'RDC', 'CABMIN/EPSP/2525/0024', 'ISD', 'actif', 'private-school-agreed', 'Nous sommes une école de formation de base', '2024-07-22 11:37:01', '2025-12-06 17:29:07', NULL, '1730457976_e2d1a4d4159aaed22614.png', '1723811082_9acdaa9b1226e2af4adb.jpg', 'elie mwez rubuz', 'MAGSCHOOL', 7, 1, 10),
(2, '240918Ge3bBuISVfL6JITcUvEC0489Ih0nFP1OJDhp0sCtEGWARrWTHv1726670794', '246966', NULL, 'college Trecaz', 'CTRECAZ', '+243977090011', 'trecaz@ditotase.com', NULL, NULL, '11220, Trecaz City, Trecaz Way, Kolwezi, Lualaba, RDC', 'Kolwezi', NULL, NULL, '', NULL, 'actif', 'private-school-agreed', 'Établissement Internationnal de formation en nouvelles technologies de l\'information et de la communication', '2024-09-18 14:46:34', NULL, NULL, NULL, NULL, 'Preegana Rubuz', NULL, NULL, 1, 1),
(4, '240918l5p8d8YUP8BBH8YZVNW76EPe7PFQHmI90JZvdtqWq829uDtomC1726671345', '244816', '', 'college Preegana', 'PREEGANA', '+243821733330', 'ditotase@ditotase.com', '', '', '11220, Trecaz City, Trecaz Way, Kolwezi, Lualaba, RDC', 'Kolwezi', '', '', '', 'CP', 'actif', 'private-school-agreed', 'Établissement Internationnal de formation en nouvelles technologies de l\'information et de la communication', '2024-09-18 14:55:45', '2025-10-09 15:34:35', NULL, NULL, NULL, 'Preegana Rubuz', 'MAGSCHOOL', 450, 0, 7),
(5, '240918NnFTD9p897dAgJCsAJ89gI9ee3i4epa1BvfDtazfQqpqA940gG1726671846', '248218', NULL, 'Lycee Preefina', 'PREEFINA', '+243990085024', '', NULL, NULL, '12120, Kinshasa, Gombe, RDC', NULL, NULL, NULL, '', NULL, 'actif', 'private-school-agreed', '', '2024-09-18 15:04:06', NULL, NULL, NULL, NULL, 'Preefina Rubuz', NULL, NULL, 1, 7),
(8, '240918JSzCP0b2lKKeUvtJK8aMlz8k4J9iyfsEvvL76Rhc7KNi3U8oY31726674401', '242938', NULL, 'CISA', 'CISA', '+243990085025', '', NULL, NULL, 'LUBUMBASHI', NULL, NULL, NULL, '', NULL, 'actif', 'community-school', '', '2024-09-18 15:46:41', NULL, NULL, NULL, NULL, 'CISA', NULL, NULL, 1, 1),
(9, '250225lnAWzIy4aia0THVEejwBHNRHJ0M4fc7f3T5AzW58DSfYrzsHEh1740494849', '252965', NULL, 'Ditotase Business school', 'DBS SCHOOL', '+243821733333', NULL, NULL, NULL, '43 Avenue Mwepu, Lubumbashi, Katanga, RDC', NULL, NULL, NULL, '', NULL, 'actif', 'private-school-agreed', 'Centre de formation', '2025-02-25 16:47:29', NULL, NULL, NULL, NULL, 'Preefina Rubuz', NULL, NULL, 1, 10),
(10, '250916n8Ly9BO71EuSkwkFIlTRK0KCA362wVyA93ajPKJYNas6aBziAg1758033130', '251331', NULL, 'COLLEGE DITOTASE BUSINESS', 'CDB', '0858533285', 'ditotase.business@gmail.com', 'toujours plus haut', '', '4512 LUMUMBA HAUT-KATANGA RDC', 'lushi', 'HK', 'DRC', '', 'CDB', 'actif', 'private-school-agreed', '', '2025-09-16 16:32:10', '2025-09-16 17:33:41', NULL, '1758033282_afc24ec4ee4e3a97391b.jpg', NULL, 'chifia jess', NULL, NULL, 1, 10),
(11, '250916p4ydM9EN5scppz40n6qkn06hwHKUb3D9zCuaS7tOGZGIV0NMAc1758033820', '253901', NULL, 'ELIAS SCHOOL', 'ES', '08525822526', '', NULL, NULL, 'DSDSDSFD', NULL, NULL, NULL, '', 'ES', 'actif', 'private-school-agreed', '', '2025-09-16 16:43:40', NULL, NULL, NULL, NULL, 'ELIAS', NULL, NULL, 1, 10),
(13, '250920VcK8DydZmSBVoeDCZooP0ELPQzNCE33QHcMUpCRamZyb7NyJUS1758355830', '7-52520', '45450', 'complexe scolaire chifia', 'cs chifia', '0821733333', 'chifia@exemple.com', 'ora labora', 'https://chifia.exemple.com', '10 mwepu lubumbashi rdc', 'likasi', 'katanga', 'rdc', 'd52825d/2025/8525', 'csc', 'actif', 'private-school-agreed', '', '2025-09-20 10:10:30', '2025-09-20 10:33:00', NULL, NULL, NULL, 'chifia', NULL, NULL, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) UNSIGNED NOT NULL,
  `section_token` varchar(75) NOT NULL,
  `section_code` varchar(10) NOT NULL,
  `section_name` varchar(75) DEFAULT NULL,
  `section_shortname` varchar(75) DEFAULT NULL,
  `section_status` varchar(25) DEFAULT NULL,
  `section_type` varchar(75) DEFAULT NULL,
  `section_notes` text DEFAULT NULL,
  `section_created_at` datetime DEFAULT NULL,
  `section_updated_at` datetime DEFAULT NULL,
  `section_deleted_at` datetime DEFAULT NULL,
  `section_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_token`, `section_code`, `section_name`, `section_shortname`, `section_status`, `section_type`, `section_notes`, `section_created_at`, `section_updated_at`, `section_deleted_at`, `section_school_id`) VALUES
(1, '2407221AFP3G4qIRjA1iFNjwTyY9CNzrI5URAtjKFbqPptVbemTH8tWi1721655861', 'SCOFI', 'sciences economiques &amp; financieres', NULL, 'actif', 'actif', NULL, '2024-07-22 13:44:21', '2025-11-30 11:11:29', NULL, 1),
(2, '240722ZEOOvwbovOW59EFMvlcEVPBrvISwDQzYOyIVUwa8Iq7JjGQLrL1721655872', 'SC INFO', 'sciences informatiques', NULL, 'actif', 'actif', NULL, '2024-07-22 13:44:32', '2025-11-30 11:11:21', NULL, 1),
(3, '240722JlJFuRiIBpVpAB2Js7qPGp0ptmcHJbc4T6IJJHVitTWaGVQEdD1721655883', 'DR', 'Faculté droits', NULL, 'actif', 'actif', NULL, '2024-07-22 13:44:43', '2025-11-30 11:13:20', NULL, 1),
(6, '2502259lkh3MMpvLZ0IjLeeSunVWQT5FN4byAfrArhrv2gFWlrJnQM4Z1740495206', '259788', 'Maternelle', NULL, 'actif', NULL, NULL, '2025-02-25 16:53:26', NULL, NULL, 9),
(7, '250225lCyntJabEDn0B9amdK6AqyeCqCzEWkLUP0eMly8n3GpSiChDNl1740495215', '254692', 'Primaire', NULL, 'actif', NULL, NULL, '2025-02-25 16:53:35', NULL, NULL, 9),
(8, '250916U3AaKRlZ8Rms46oZtcTJo5PYTWwo81Ha9KjzFp356vdMIaz51B1758033323', '252018', 'HUMANITES', NULL, 'actif', NULL, NULL, '2025-09-16 16:35:23', NULL, NULL, 10),
(9, '2510096rFeuBP4Btk8s731qinJQZsOZHChbwRWjE8UWz3NKGIT3ySbOU1760016461', '255311', 'HUMANITES', NULL, 'actif', 'inactif', NULL, '2025-10-09 15:27:41', NULL, NULL, 4),
(10, '251130egSl3pTnvOaHlQ7GRj4QIA67IqNefRH59Zb9ZyD4GKF2Ck6F0h1764493948', 'SPA', 'Sciences Politiques &amp; Administratives', NULL, 'actif', 'inactif', NULL, '2025-11-30 11:12:28', '2025-11-30 11:12:39', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) UNSIGNED NOT NULL,
  `student_token` varchar(75) NOT NULL,
  `student_code` varchar(10) NOT NULL,
  `student_security_code` varchar(10) DEFAULT NULL,
  `student_permanent_code` varchar(20) NOT NULL,
  `student_firstname` varchar(75) DEFAULT NULL,
  `student_lastname` varchar(75) DEFAULT NULL,
  `student_surname` varchar(75) DEFAULT NULL,
  `student_nationality` varchar(75) DEFAULT NULL,
  `student_address_number` varchar(75) DEFAULT NULL,
  `student_address_area` varchar(75) DEFAULT NULL,
  `student_address_street` varchar(75) DEFAULT NULL,
  `student_address_zone` varchar(75) DEFAULT NULL,
  `student_address_commune` varchar(75) DEFAULT NULL,
  `student_province` varchar(75) DEFAULT NULL,
  `student_territory` varchar(75) DEFAULT NULL,
  `student_sector` varchar(75) DEFAULT NULL,
  `student_grouping` varchar(75) DEFAULT NULL,
  `student_village` varchar(75) DEFAULT NULL,
  `student_district` varchar(75) DEFAULT NULL,
  `student_number` varchar(75) DEFAULT NULL,
  `student_gender` varchar(25) DEFAULT NULL,
  `student_email` varchar(75) DEFAULT NULL,
  `student_phone` varchar(75) DEFAULT NULL,
  `student_status` varchar(25) DEFAULT NULL,
  `student_type` varchar(75) DEFAULT NULL,
  `student_sernie_id` varchar(75) DEFAULT NULL,
  `student_birthday` date DEFAULT NULL,
  `student_born_place` varchar(75) DEFAULT NULL,
  `student_address` varchar(75) DEFAULT NULL,
  `student_confession` varchar(75) DEFAULT NULL,
  `student_documents` int(11) DEFAULT NULL,
  `student_notes` text DEFAULT NULL,
  `student_created_at` datetime DEFAULT NULL,
  `student_updated_at` datetime DEFAULT NULL,
  `student_deleted_at` datetime DEFAULT NULL,
  `student_picture` varchar(75) DEFAULT NULL,
  `student_school_id` int(11) UNSIGNED DEFAULT NULL,
  `student_parent_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_token`, `student_code`, `student_security_code`, `student_permanent_code`, `student_firstname`, `student_lastname`, `student_surname`, `student_nationality`, `student_address_number`, `student_address_area`, `student_address_street`, `student_address_zone`, `student_address_commune`, `student_province`, `student_territory`, `student_sector`, `student_grouping`, `student_village`, `student_district`, `student_number`, `student_gender`, `student_email`, `student_phone`, `student_status`, `student_type`, `student_sernie_id`, `student_birthday`, `student_born_place`, `student_address`, `student_confession`, `student_documents`, `student_notes`, `student_created_at`, `student_updated_at`, `student_deleted_at`, `student_picture`, `student_school_id`, `student_parent_id`) VALUES
(1, '240722m6dZ6iQeKfVuUH5ztI4atAyIcJfhcn9cHaaPqIfHgTAiW8VfHP1721658855', 'CI24599', NULL, '', 'chipeng', 'Mukeng', 'Aaron', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', '', '', 'actif', 'ordinaire', '', '2000-12-12', 'Lubumbashi', '45 Dilolo Ruashi Lubumbashi rdc', NULL, NULL, '', '2024-07-22 14:34:10', '2024-09-10 11:07:13', NULL, NULL, 1, 4),
(2, '240722dswtPNtPnkTz55VFT11S13HvFqFcMlraT8Bjz8h11r5ieyi7Io1721660175', 'CI24347', NULL, '', 'Matand', 'Kabwik', 'consolat', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', '', '', 'actif', 'ordinaire', '', '2000-12-12', 'likasi', '', NULL, NULL, '', '2024-07-22 14:56:15', '2024-09-26 12:47:59', NULL, NULL, 1, 4),
(3, '240722yN4f38Tw61WjvdtbREotp2M326RgaMwGenOVobeOcga2688m8d1721660208', 'CI24437', NULL, '', 'kayind', 'chipeng', 'myriam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feminin', NULL, NULL, 'actif', 'ordinaire', '', '0000-00-00', '', '', NULL, NULL, NULL, '2024-07-22 14:56:48', NULL, NULL, '1728032904_12c9b666ff0ad8582408.jpeg', 1, 1),
(4, '2407225Qk0TrNjAP9FubLYcEFocwuQDo7grT5vvzOv6yv285CuW14awf1721660236', 'CI24129', NULL, '', 'rumbu', 'chipeng', 'tresor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', NULL, NULL, 'actif', 'ordinaire', '', '0000-00-00', '', '', NULL, NULL, NULL, '2024-07-22 14:57:16', NULL, NULL, '1728033266_4691e1df612b3c8a317c.jpeg', 1, 1),
(5, '24072950OlnOWNQWNWQM3tcCOf5ZzcvSEtDObgk9rtQgsLuyIbgI82u61722259617', 'CI24509', NULL, '', 'manyong', 'kalaw', 'mialao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feminin', NULL, NULL, 'actif', 'ordinaire', '252500', '2020-12-12', 'Lubumbashi', 'Lac Kabamba 49 Kampemba lubumbashi', NULL, NULL, NULL, '2024-07-29 13:26:57', NULL, NULL, NULL, 1, 4),
(6, '240722m6dZ6iQeKfVuUH5ztI4atAyIcJfhcn9cHaaPqIfHgTAiW8VfHP1721658850', 'CI24589', NULL, '', 'chipeng', 'Kabwuik', 'Johnny', 'Congolaise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', '', '', 'actif', 'ordinaire', '5250055', '2000-12-12', 'Lubumbashi', '45 Dilolo Ruashi Lubumbashi rdc', NULL, NULL, '', '2024-07-22 14:34:10', '2025-06-13 18:11:58', NULL, NULL, 1, 4),
(7, '240722dswtPNtPnkTz55VFT11S13HvFqFcMlraT8Bjz8h11r5ieyi7Io1721660174', 'CI24345', NULL, '', 'Mataro', 'Rubuz', 'Suza', 'CONGOLAISE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feminin', '', '', 'actif', 'ordinaire', '', '2005-10-12', 'likasi', '', NULL, NULL, '', '2024-07-22 14:56:15', '2024-10-01 10:16:02', NULL, NULL, 1, 4),
(8, '240722yN4f38Tw61WjvdtbREotp2M326RgaMwGenOVobeOcga2688m8d1721660207', 'CI24337', NULL, '', 'kayind', 'Irung', 'Jeanine', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feminin', '', '', 'actif', 'ordinaire', '', '2000-02-05', '', '', NULL, NULL, '', '2024-07-22 14:56:48', '2024-07-29 13:49:23', NULL, NULL, 1, 3),
(9, '2407225Qk0TrNjAP9FubLYcEFocwuQDo7grT5vvzOv6yv285CuW14awf1721660237', 'CI24229', NULL, '', 'chipeng', 'rumbu', 'MIke', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', '', '', 'actif', 'ordinaire', '', '2000-12-12', 'likasi', '', NULL, NULL, '', '2024-07-22 14:57:16', '2024-07-29 13:48:02', NULL, NULL, 1, 3),
(10, '240815ZFviDZvLrQSVvvf79y0HHtBC3jKivoD4hkyRM06iQMlECYLkyE1723734229', 'SI24775', NULL, '', 'Ketia', 'Mwanabote', 'Kenia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feminin', NULL, NULL, 'actif', 'ordinaire', '53620', '2001-12-12', 'Kinshasa', '', 'methodiste', 3, 'Allergique au lait', '2024-08-15 15:03:49', NULL, NULL, NULL, 1, 3),
(12, '240921MpWrWkb3G7kF1irlsWswZ679UeGRSfOhsciQidiYpt19ef5LUR1726909236', 'CI24941', NULL, '', 'MUMBA', 'MUMBA', 'Vikyasoft', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', NULL, NULL, 'actif', 'ordinaire', '', '2000-12-12', 'Lubumbashi', '', 'catholique', 0, '', '2024-09-21 09:00:36', NULL, NULL, NULL, 1, 5),
(13, '240922GNsaj1L1O1aJwBgh5aOzrL6E72yONSF15JUqzauEZIIdPlsnwb1727007145', 'CI24434', NULL, '', 'rubuz', 'preegana', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', 'rubuz@ditotase.com', '', 'actif', 'ordinaire', '', '2024-12-08', 'lubumbashi', '', 'methodiste', 0, '', '2024-09-22 14:12:25', '2024-10-30 13:09:23', NULL, NULL, 1, 4),
(14, '240925TRjd76WKM49tQI0aW1eHonGKR9RtSbgNp8PGViopGPJkvv0IUS1727273724', 'CI24986', NULL, '', 'Manyong', 'rubuz', 'Preefina', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feminin', 'eliemwez.rubuz@ditotase.com', '', 'actif', 'ordinaire', '', '2000-01-01', 'lubumbashi', '', 'methodiste', 0, '', '2024-09-25 16:15:24', '2024-10-30 13:09:41', NULL, NULL, 1, 4),
(15, '241001VPST1tUDfrouNst3n7duUVfeOB6bVESVtwGR5OD4s4OqK6o2vO1727775838', 'CI24851', NULL, '', 'Kasongo', 'Kitala', 'Jean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', NULL, NULL, 'actif', 'ordinaire', '4500120', '2005-10-22', 'Kinshasa', '', 'catholique', 0, '', '2024-10-01 11:43:58', NULL, NULL, NULL, 1, 5),
(17, '2410048bVnJy6RY2Vi5VgWiYtuTWSUmMlvzKroYmIbyfzOlo7Qqbdglp1728030488', 'CID24297', NULL, '', 'delete eleve', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', NULL, NULL, 'actif', 'ordinaire', '', '0000-00-00', '', '', 'methodiste', 2, '', '2024-10-04 10:28:08', NULL, NULL, NULL, 1, 3),
(18, '2411014lVdYp0LNDU3tljAO4lpukam5jWyJDUnZSG0Z3o2htFK8Lt1wW1730458102', 'CID24145', NULL, '', 'Kazadi', 'Kazadi', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', NULL, NULL, 'actif', 'ordinaire', '', '0000-00-00', 'Lubumbashi', '', 'methodiste', 0, '', '2024-11-01 12:48:22', NULL, NULL, NULL, 1, 1),
(19, '241115uBHa4wY7MIFHPBKboB3baCJiAzL3RTOhYSzoeQ0yk87mPTOGPW1731675927', 'CID24158', NULL, '', 'Ilunga', 'Ilunga', 'Kelly', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', NULL, NULL, 'actif', 'ordinaire', '545200', '2000-12-12', 'Likasi', NULL, 'temoins', 0, 'Diabetique', '2024-11-15 15:05:27', NULL, NULL, NULL, 1, 7),
(20, '241115EjSresEIMKHrU5vFzJ1bnk9LO1iK3tfiqA3BC6rqd9r4ZkZUAy1731676723', 'CID24664', NULL, '', 'chilemb', 'rubuz', 'blessing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feminin', NULL, NULL, 'actif', 'ordinaire', '', '0000-00-00', '', NULL, 'catholique', 0, '', '2024-11-15 15:18:43', NULL, NULL, NULL, 1, 8),
(21, '241204Ob0s8g96NrljIvw9YnJlLqrw3sQTzeyC6FDwpuJUni7kalHeNn1733317075', 'CID24549', NULL, '', 'Chiband', 'Kazadi', 'Moise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', NULL, NULL, 'actif', 'ordinaire', '', '2000-10-01', 'Lubumbashi', NULL, 'methodiste', 0, '', '2024-12-04 14:57:55', NULL, NULL, NULL, 1, 8),
(22, '250225YPH4DqiyZLjH9MTHcQAjPE0smR5TF0JkvOk6SIIfYltNJ0VE9I1740496570', '202501', NULL, '', 'Chikez', 'Kabongo', 'Jean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', NULL, NULL, 'actif', 'ordinaire', '', '2000-12-12', 'Likasi', NULL, 'catholique', 0, '', '2025-02-25 17:16:10', NULL, NULL, NULL, 9, 9),
(23, '250529mJVlO4Oq4JSKbUnYIuno4fuwfGdwnSaDk6WsvasYAT3tRUlFBo1748508341', '202301', NULL, '', 'chipeng', 'rubuz', 'preegana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', NULL, NULL, 'actif', 'ordinaire', '', '2000-08-18', 'lubumbashi', NULL, 'methodiste', 0, '', '2025-05-29 10:45:41', NULL, NULL, NULL, 1, 10),
(24, '250609BHZ4bOr23aQmzZwrDtidioWI7gB4J4jjSTTCczRy5GCnYqgVrn1749469172', 'csd232401', NULL, '', 'MUMBA', 'VIVIEN', 'KYANKASA', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', '', '', 'actif', 'ordinaire', '', '0000-00-00', '', '', 'methodiste', 0, '', '2025-06-09 13:39:32', '2025-09-16 10:01:32', NULL, NULL, 1, 5),
(25, '250916OT7PAWvd43hbAzREcRmEQ2nTWAChZeRhK8BREk74u6vaidiFP01758008861', 'CSD232402', NULL, '', 'Katanga', 'Jess', 'eliane', 'Ivoirienne', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', '', '+243858533285', 'actif', 'ordinaire', '', '2000-12-12', 'Cote d\'ivoire', '', 'methodiste', 1, '', '2025-09-16 09:47:41', '2025-09-17 16:18:51', NULL, NULL, 1, 10),
(26, '250916ulLCRHWYEi4wz1iiBguJ8SwzJ7J7Fgz4Z5gDCVIuF42bYpmGeI1758011042', 'CSD232403', NULL, '', 'RUBUZ', 'CHIPENG', 'Elias', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', 'rubuz@ditotase.com', '+243977090011', 'actif', 'ordinaire', '', '2000-12-12', 'Kolwezi', NULL, 'methodiste', 0, '', '2025-09-16 10:24:02', NULL, NULL, NULL, 1, 4),
(27, '250916JPKvWbHndoI6kQHIFO5Gg6pE0UmMvH4HjRrUk2UPyKsQW8EjuM1758011102', 'csd232404', NULL, '', 'RUBUZ', 'CHIPENG', 'Elias', 'Congolaise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'masculin', 'rubuz@ditotase.com', '+243977090011', 'actif', 'ordinaire', '415556', '2000-12-12', 'Kolwezi', '', 'penthecotiste', 0, 'PAS DE SPORT', '2025-09-16 10:25:02', '2025-09-17 16:05:05', NULL, NULL, 1, 4),
(28, '250916diOod7ufyLZ5Cf0sEFEReDH054L3tHHAy8vfNdEwdrPy7a9v3e1758012008', 'CSD232405', NULL, '54250881258', 'KAS', 'KASMAY', 'JESS', 'congolaise', NULL, NULL, NULL, NULL, NULL, 'lualaba', 'kapanga', 'mwant yav', 'chiying', 'kalamb', NULL, NULL, 'feminin', 'eliemwez.rubuz@ditotase.com', '+243858533285', 'actif', 'ordinaire', '', '2001-12-12', 'likasi', '', 'penthecotiste', 0, '', '2025-09-16 10:40:08', '2025-09-18 09:48:15', NULL, NULL, 1, 3),
(30, '2510084GJc0EZvTARSLpLFA9KelyMLRN5pe0tZd74C03dCJm9jRDlpQb1759929550', 'CSD2324002', NULL, '', 'AFRICALOS', 'BUSMAN', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feminin', '', '+243858533285', 'actif', 'ordinaire', '', '0000-00-00', '', NULL, 'methodiste', 0, '', '2025-10-08 15:19:10', NULL, NULL, NULL, 1, 10),
(31, '2510080WMWn9zb4VwirsmbgRb88OzJsSeC0qPVNMCsEjoG2Glyk7PTKT1759929705', 'CSD2324003', NULL, '', 'TRECAZ', 'HOLDER', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feminin', 'rubuz@ditotase.com', '+243977090011', 'actif', 'ordinaire', '', '0000-00-00', '', NULL, 'kimbanguiste', 0, '', '2025-10-08 15:21:45', NULL, NULL, NULL, 1, 4),
(32, '251009YFSF6HyPG64G73kO3wnrqlhVNqBJft1B2tUkNTpCwOkb6l27Qw1760016702', 'CP2526001', NULL, '', 'ELIOS', 'KENDA', '', '', NULL, NULL, NULL, NULL, NULL, 'DD', 'DF', 'DSD', 'CHU', 'ASDSS', 'DDFD', NULL, 'masculin', '', '+243885582282', 'actif', 'ordinaire', '', '0000-00-00', '', '', 'methodiste', 0, '', '2025-10-09 15:31:42', '2025-10-09 15:33:03', NULL, NULL, 4, 11),
(33, '251009Bn4I1ioekZvo6N15zL1sLBYZ6Es9DMK1aY4dKgRmYlLp0RUfm91760017177', 'CP2526004', NULL, '', 'KONA', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'masculin', '', '+243885582282', 'actif', 'ordinaire', '', '0000-00-00', '', NULL, 'kimbanguiste', 0, '', '2025-10-09 15:39:37', NULL, NULL, NULL, 4, 11),
(34, '251009ilUSEAnwd1K4E88nsaCmkpRsMz31ROL8JJNtTNvVG8hJOLOUiW1760017354', 'CP2526002', NULL, '', 'LOP', 'LOP', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 'feminin', '', '+243885582282', 'actif', 'ordinaire', '', '0000-00-00', '', NULL, 'reveil', 0, '', '2025-10-09 15:42:34', NULL, NULL, NULL, 4, 11),
(35, '251206WyidqlzNrlwcnY630YBwlJHT8RkbeyDz2bE4RpIjMSOnfZYyWf1765032290', 'CSD2425005', NULL, '', 'Kasongo', 'ilunga', 'John', '', NULL, NULL, NULL, NULL, NULL, 'KATANGA', 'KAMBOVE', 'SANGA', 'SANGA', 'SUKENI', 'MWAPI SUKENI', NULL, 'masculin', '', '+243000000000', 'actif', 'ordinaire', '', '2000-12-12', 'Likasi', '', 'divers', 0, '', '2025-12-06 16:44:50', '2025-12-06 17:19:06', NULL, NULL, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `students_counters`
--

CREATE TABLE `students_counters` (
  `counter_id` int(11) NOT NULL,
  `counter_value` int(11) DEFAULT NULL,
  `counter_school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_counters`
--

INSERT INTO `students_counters` (`counter_id`, `counter_value`, `counter_school_id`) VALUES
(1, NULL, 1),
(2, NULL, 1),
(3, NULL, 1),
(4, 2, 4),
(5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_documents`
--

CREATE TABLE `students_documents` (
  `document_id` int(11) UNSIGNED NOT NULL,
  `document_token` varchar(75) NOT NULL,
  `document_name` varchar(75) NOT NULL,
  `document_number` varchar(75) NOT NULL,
  `document_code` varchar(10) NOT NULL,
  `document_delivery_date` date DEFAULT NULL,
  `document_validity_date` date DEFAULT NULL,
  `document_quantity` decimal(10,2) DEFAULT NULL,
  `document_status` varchar(25) DEFAULT NULL,
  `document_type` varchar(75) DEFAULT NULL,
  `document_notes` text DEFAULT NULL,
  `document_created_at` datetime DEFAULT NULL,
  `document_updated_at` datetime DEFAULT NULL,
  `document_deleted_at` datetime DEFAULT NULL,
  `document_student_id` int(11) UNSIGNED DEFAULT NULL,
  `document_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_documents`
--

INSERT INTO `students_documents` (`document_id`, `document_token`, `document_name`, `document_number`, `document_code`, `document_delivery_date`, `document_validity_date`, `document_quantity`, `document_status`, `document_type`, `document_notes`, `document_created_at`, `document_updated_at`, `document_deleted_at`, `document_student_id`, `document_school_id`) VALUES
(1, '240815dIcnLl3ecfmAiPzBWnHAjFaOb7L5V4iKsnP0WzPwiLHPDlIde117237352521', 'Bulletin 7eb', '7854952', '', '0000-00-00', '0000-00-00', 1.00, 'actif', 'document', 'ORIGINAL', '2024-08-15 15:20:52', '2024-08-16 09:13:27', NULL, 10, 1),
(2, '240815Fln6unDtNMGwIrMj6k8QCUsrmvvNslmgcMGnFSd6HaFiQfWbtl17237352522', 'rame papiers', '', '', NULL, NULL, 2.00, 'actif', 'divers', 'ras', '2024-08-15 15:20:52', NULL, NULL, 10, 1),
(3, '240815AdCshTJkieK7z4j9lPZALf5w07pvfYl6hCN17ysBrL4QYEf60717237352523', 'savon liquide', '', '', NULL, NULL, 3.00, 'actif', 'divers', 'ras', '2024-08-15 15:20:52', NULL, NULL, 10, 1),
(4, '240816Rp0I0O9kJhN43hlPGC9A2Y1LBeqbDla1OigcvIhIuToOWVzDVL17237972041', 'Bulletin 8eb', '5854000', '', '2022-08-16', '2025-08-16', 1.00, 'actif', 'document', 'Delivree par Trecaz School', '2024-08-16 08:33:24', '2024-08-16 09:09:51', NULL, 10, 1),
(6, '240816YPIsHSWObffO7SgNlTFw1dHyVhNOoNeH3JTpTuh9KO8ImTANWP17237975661', 'PAPAIER BRISTOL', '854205', '241402', '2023-08-16', '2025-08-16', 4.00, 'actif', 'divers', 'RAMES PAPIERS BRISTOL', '2024-08-16 08:39:26', '2024-08-16 09:06:40', NULL, 10, 1),
(7, '', 'FARDE', '244274', '', NULL, NULL, 1.00, 'actif', 'divers', 'RAS', NULL, '2024-09-19 12:35:07', NULL, 1, 1),
(10, '241004lD8l5lZiFLWrc23kmrL8vGElNKbj5uYF6UDszPheSrcHnDtSFN17280305351', 'rames', '', '244020', NULL, NULL, 2.00, 'actif', 'divers', 'Bristol', '2024-10-04 10:28:55', NULL, NULL, 17, 1),
(11, '241004j84cFkF7vFqYnnmLhrobL69Ak7BvpP3LSAw2ZnAeT5kkjphgA317280305352', 'savon', '', '247374', NULL, NULL, 2.00, 'actif', 'divers', 'Liquide', '2024-10-04 10:28:55', NULL, NULL, 17, 1),
(12, '', 'Telephone Portable', '240512', '', NULL, NULL, 1.00, 'actif', 'confusque', 'Tecno Camon 30', '2024-12-07 11:06:33', '2024-12-07 11:07:03', NULL, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students_inscriptions`
--

CREATE TABLE `students_inscriptions` (
  `inscription_id` int(11) UNSIGNED NOT NULL,
  `inscription_token` varchar(75) NOT NULL,
  `inscription_code` varchar(10) NOT NULL,
  `inscription_date` date DEFAULT NULL,
  `inscription_validation` date DEFAULT NULL,
  `inscription_status` varchar(25) DEFAULT NULL,
  `inscription_type` varchar(75) DEFAULT NULL,
  `inscription_origin_school` varchar(75) DEFAULT NULL,
  `inscription_document_name` varchar(75) DEFAULT NULL,
  `inscription_document_file` varchar(75) DEFAULT NULL,
  `inscription_notes` text DEFAULT NULL,
  `inscription_created_at` datetime DEFAULT NULL,
  `inscription_updated_at` datetime DEFAULT NULL,
  `inscription_deleted_at` datetime DEFAULT NULL,
  `inscription_school_id` int(11) UNSIGNED DEFAULT NULL,
  `inscription_classe_id` int(11) UNSIGNED DEFAULT NULL,
  `inscription_student_id` int(11) UNSIGNED DEFAULT NULL,
  `inscription_year_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_inscriptions`
--

INSERT INTO `students_inscriptions` (`inscription_id`, `inscription_token`, `inscription_code`, `inscription_date`, `inscription_validation`, `inscription_status`, `inscription_type`, `inscription_origin_school`, `inscription_document_name`, `inscription_document_file`, `inscription_notes`, `inscription_created_at`, `inscription_updated_at`, `inscription_deleted_at`, `inscription_school_id`, `inscription_classe_id`, `inscription_student_id`, `inscription_year_id`) VALUES
(1, '240722Ij62SS0dYQ8iRP04vhGgj7PfjvUGrz9JoR4j563FhsgOqzQrmB1721658850', '248195', '2024-07-22', '2024-09-10', 'actif', NULL, '', NULL, NULL, NULL, '2024-07-22 14:34:10', '2024-10-31 09:23:16', NULL, 1, 2, 1, 2),
(2, '240722hggfof8lBAuGlUeImwCIm6Pa7OqkISkncBvSUuBU0uvr2SlSYG1721660175', '241320', '2024-07-22', '2024-09-26', 'actif', NULL, '', NULL, NULL, NULL, '2024-07-22 14:56:15', '2024-09-26 12:47:59', NULL, 1, 1, 2, 2),
(3, '240722pwqgiD0T3w9eGVnth3eCfLcuQ1DRchYRuzJjwNGaqD4GrPQZwv1721660208', '241343', '2024-07-22', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2024-07-22 14:56:48', NULL, NULL, 1, 3, 3, 2),
(4, '24072219MM3kv0LgQIPNbVwLJRsSyOY3ifjgRd9K0LypEpcn0dbqMVMu1721660236', '245430', '2024-07-22', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2024-07-22 14:57:16', NULL, NULL, 1, 1, 4, 2),
(6, '240722Ij62SS0dYQ8iRP04vhGgj7PfjvUGrz9JoR4j563FhsgOqzQrmB1721658850', '248195', '2024-07-22', '2025-06-13', 'actif', NULL, '', NULL, NULL, NULL, '2024-07-22 14:34:10', '2025-06-13 18:11:58', NULL, 1, 2, 6, 2),
(7, '240722hggfof8lBAuGlUeImwCIm6Pa7OqkISkncBvSUuBU0uvr2SlSYG1721660175', '241320', '2024-07-22', '2024-10-01', 'actif', NULL, 'MALKIA', NULL, NULL, NULL, '2024-07-22 14:56:15', '2024-10-01 10:16:02', NULL, 1, 1, 7, 2),
(8, '240722pwqgiD0T3w9eGVnth3eCfLcuQ1DRchYRuzJjwNGaqD4GrPQZwv1721660208', '241343', '2024-07-22', '2024-07-29', 'actif', NULL, '', NULL, NULL, NULL, '2024-07-22 14:56:48', '2024-07-29 13:49:23', NULL, 1, 3, 8, 2),
(9, '24072219MM3kv0LgQIPNbVwLJRsSyOY3ifjgRd9K0LypEpcn0dbqMVMu1721660236', '245430', '2024-07-22', '2024-07-29', 'actif', NULL, '', NULL, NULL, NULL, '2024-07-22 14:57:16', '2024-07-29 13:48:02', NULL, 1, 1, 9, 2),
(10, '240815aMp8c1RRMVbR8eiSCOAN7IYIAFzQO2hktd8wYgqoVygdDj0k8S1723734229', '241168', '2024-08-15', NULL, 'inactif', NULL, 'Trecaz', NULL, NULL, NULL, '2024-08-15 15:03:49', '2024-10-25 15:53:49', NULL, 1, 4, 10, 2),
(12, '240921ePS9RjiTuCvLzQOvyrJIWiMIehm0fuiVrBHW0LCWhFttVJkytH1726909236', '243233', '2024-09-21', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2024-09-21 09:00:36', NULL, NULL, 1, 4, 12, 2),
(13, '240922ITtWLhsNgi4bPAO6u2EYv0jpA9sdKzq4Fc85YOF3DJ7KDPO8wz1727007145', '243746', '2024-09-22', '2024-10-30', 'actif', NULL, '', NULL, NULL, NULL, '2024-09-22 14:12:25', '2024-10-30 13:09:23', NULL, 1, 4, 13, 2),
(14, '240925ZzulDiBMKd9rpruEC3nhcVMNjSuHSOOlhFCUAjuen3SWmcz4mw1727273724', '243428', '2024-09-25', '2024-10-30', 'actif', NULL, '', NULL, NULL, NULL, '2024-09-25 16:15:24', '2024-10-30 13:09:41', NULL, 1, 4, 14, 2),
(15, '241001wrwptKpOD7na4ytfB81FblfcFYkh70iihGkp8tOe7L1BQ1iTkj1727775838', '247984', '2024-10-01', NULL, 'actif', NULL, 'Kipese', NULL, NULL, NULL, '2024-10-01 11:43:58', NULL, NULL, 1, 4, 15, 2),
(17, '241004ILOpz5OZpqyDAHiJvavQvrb5Hzb85DR50Agqq3oa4Jg7mRFVdf1728030488', '241157', '2024-10-04', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2024-10-04 10:28:08', NULL, NULL, 1, 5, 17, 2),
(18, '241101iIIYypJlLB1PiAWSdQKCIeRwgTCl3RJoKC4o7tqFINAaPau8b11730458102', '247557', '2024-11-01', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2024-11-01 12:48:22', NULL, NULL, 1, 4, 18, 2),
(19, '241115zugYpPbIZnU5mGvj2vHUfeaa8ibDoQ0NdtlogVfvBL77tNicEk1731675927', '242763', '2024-11-15', NULL, 'actif', NULL, 'TRECAZ', NULL, NULL, NULL, '2024-11-15 15:05:27', NULL, NULL, 1, 7, 19, 2),
(20, '241115oZcq8N6fTjBRrcy53G3DqfTtMOObJYpsd8EBwyqFAN0WeVLw341731676723', '240453', '2024-11-15', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2024-11-15 15:18:43', NULL, NULL, 1, 7, 20, 2),
(21, '241204JMZzIeltGEUtTSWs0vsWyJt03O9rfheSdaYkWQJ9VKSUlWjane1733317075', '243539', '2024-12-04', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2024-12-04 14:57:55', NULL, NULL, 1, 7, 21, 2),
(22, '250225BzuaIEH8yJSCshfPAozqK91PJSU1zJvOMOZFjVjclvfcLyK6qE1740496570', '257917', '2025-02-25', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2025-02-25 17:16:10', NULL, NULL, 9, 9, 22, 6),
(23, '2505295P2MvhMeedtMmVOk8IagT9ZJt8LifkCDDQviy0Domc1KQOFQ6h1748508341', '252530', '2025-05-29', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2025-05-29 10:45:41', NULL, NULL, 1, 1, 23, 2),
(24, '250609WbPhl4EVbAJh6vaTb5gAcBtWRMfzuAvsrC4mewoIiFskggZCrA1749469172', '251421', '2025-06-09', '2025-09-16', 'actif', NULL, '', NULL, NULL, NULL, '2025-06-09 13:39:32', '2025-09-16 10:01:32', NULL, 1, 10, 24, 2),
(25, '250916bImBoP5pBEn0Z2WEJzRynJOwB70u6e637aF71qlLTSrvuLqUAM1758008861', '257235', '2025-09-16', '2025-09-16', 'actif', NULL, 'MALKIA VILLE', NULL, NULL, NULL, '2025-09-16 09:47:41', '2025-09-17 16:18:51', NULL, 1, 10, 25, 2),
(26, '2509166Q0lTmYmHJErZUTWew4kAy5SGupZRZtmyMeLl1Wlzwe1Nj3Q0i1758011042', '255105', '2025-09-16', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2025-09-16 10:24:02', NULL, NULL, 1, 10, 26, 2),
(27, '250916DDz8zpabSgYZNhl6LeNiODwQ6sLNLa02asW9QAW3DULWNInFin1758011102', '258950', '2025-09-16', '2025-09-16', 'actif', NULL, 'MALKIA', NULL, NULL, NULL, '2025-09-16 10:25:02', '2025-09-17 16:05:05', NULL, 1, 10, 27, 2),
(28, '250916Y4ZJd1O8ECm499es4N8tkTT9FlZGw7WD3p5Fz4sMMmnrwmeUKG1758012008', '255781', '2025-09-16', '2025-09-18', 'actif', NULL, '', NULL, NULL, NULL, '2025-09-16 10:40:08', '2025-09-18 09:48:15', NULL, 1, 10, 28, 2),
(30, '251008iYyMWBpYBU3eRz0WhSpiL7ESVEjQU8I9EFlqC9aSRuGOoBFKDt1759929550', '251964', '2025-10-08', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2025-10-08 15:19:10', NULL, NULL, 1, 8, 30, 2),
(31, '251008GcujiWtDrlecMnBGFyRcSgqk8DmCrpsAYjiDdz94bQKFPgVmTg1759929705', '257837', '2025-10-08', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2025-10-08 15:21:45', NULL, NULL, 1, 7, 31, 2),
(32, '251009y0kQ632WK14uWSDspizVyR2bHUnr3EQp0ezJoRVO1PiZLEl3em1760016702', '252653', '2025-10-09', '2025-10-09', 'actif', NULL, '', NULL, NULL, NULL, '2025-10-09 15:31:42', '2025-10-09 15:33:03', NULL, 4, 12, 32, 10),
(33, '251009FIQQqYsgQMtEevwNynAHSwirdCGEcqrFBrzcZdY8glIVHj3MLJ1760017177', '251174', '2025-10-09', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2025-10-09 15:39:37', NULL, NULL, 4, 12, 33, 10),
(34, '251009n6ln3dzUKPTsiPzqLKwvH6QZ16a66ppHUlFBJU45rJF7KmYauV1760017354', '251286', '2025-10-09', NULL, 'actif', NULL, '', NULL, NULL, NULL, '2025-10-09 15:42:34', NULL, NULL, 4, 12, 34, 10),
(35, '251206hVQ0Qua8t5coriHsbAoe9BIFze5wFkzs90cqfsg76OzcEC8Id81765032290', '258681', '2025-12-06', '2025-12-06', 'actif', NULL, 'ISTM KOLWEZI', NULL, NULL, NULL, '2025-12-06 16:44:50', '2025-12-06 17:19:06', NULL, 1, 4, 35, 1),
(36, '251206LZsuSb8DczQNnnEoiVPhkmiTh3hpS378lRUsKgnzERIrfa9N9R1765034331', '254512', '2023-09-04', NULL, 'actif', 'parcours', '', NULL, NULL, NULL, '2025-12-06 17:18:51', NULL, NULL, 1, 7, 35, 4);

-- --------------------------------------------------------

--
-- Table structure for table `students_parents`
--

CREATE TABLE `students_parents` (
  `parent_id` int(11) UNSIGNED NOT NULL,
  `parent_token` varchar(75) NOT NULL,
  `parent_code` varchar(10) NOT NULL,
  `parent_father_name` varchar(75) DEFAULT NULL,
  `parent_mother_name` varchar(75) DEFAULT NULL,
  `parent_tutor_name` varchar(75) DEFAULT NULL,
  `parent_father_phone` varchar(15) DEFAULT NULL,
  `parent_mother_phone` varchar(15) DEFAULT NULL,
  `parent_tutor_phone` varchar(15) DEFAULT NULL,
  `parent_father_email` varchar(75) DEFAULT NULL,
  `parent_mother_email` varchar(75) DEFAULT NULL,
  `parent_tutor_email` varchar(75) DEFAULT NULL,
  `parent_tutor_job` varchar(75) DEFAULT NULL,
  `parent_father_job` varchar(50) DEFAULT NULL,
  `parent_mother_job` varchar(50) DEFAULT NULL,
  `parent_tutor_phone2` varchar(15) DEFAULT NULL,
  `parent_father_phone2` varchar(15) DEFAULT NULL,
  `parent_mother_phone2` varchar(15) DEFAULT NULL,
  `parent_primary_phone` varchar(50) DEFAULT NULL,
  `parent_primary_email` varchar(50) DEFAULT NULL,
  `parent_primary_address` varchar(75) DEFAULT NULL,
  `parent_status` varchar(25) DEFAULT NULL,
  `parent_type` varchar(75) DEFAULT NULL,
  `parent_emergency` varchar(75) DEFAULT NULL,
  `parent_notes` text DEFAULT NULL,
  `parent_created_at` datetime DEFAULT NULL,
  `parent_updated_at` datetime DEFAULT NULL,
  `parent_deleted_at` datetime DEFAULT NULL,
  `parent_father_image` varchar(75) DEFAULT NULL,
  `parent_mother_image` varchar(75) DEFAULT NULL,
  `parent_tutor_image` varchar(75) DEFAULT NULL,
  `parent_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_parents`
--

INSERT INTO `students_parents` (`parent_id`, `parent_token`, `parent_code`, `parent_father_name`, `parent_mother_name`, `parent_tutor_name`, `parent_father_phone`, `parent_mother_phone`, `parent_tutor_phone`, `parent_father_email`, `parent_mother_email`, `parent_tutor_email`, `parent_tutor_job`, `parent_father_job`, `parent_mother_job`, `parent_tutor_phone2`, `parent_father_phone2`, `parent_mother_phone2`, `parent_primary_phone`, `parent_primary_email`, `parent_primary_address`, `parent_status`, `parent_type`, `parent_emergency`, `parent_notes`, `parent_created_at`, `parent_updated_at`, `parent_deleted_at`, `parent_father_image`, `parent_mother_image`, `parent_tutor_image`, `parent_school_id`) VALUES
(1, '2407220HkqhdcmZ6BNKLlSeOSraiqIhmcAdf1meYHMudOs9o9L7WwP8Y1721658850', 'e244540e', 'Chipeng Kabwik', 'kachak sarah', 'kabongo jubile', '+243821733330', '+243821733330', '+243821733330', NULL, NULL, NULL, '', '', '', '+243821733330', '+243821733330', '+243821733330', '+243821733330', 'eliemwez.rubuz@gmail.com', '45 Dilolo Ruashi Lubumbashi rdc', 'actif', 'biologique', 'pere', 'PARENTS MODEL ', '2024-07-22 14:34:10', '2024-09-16 14:53:34', NULL, NULL, NULL, NULL, 1),
(3, '2407220HkqhdcmZ6BNKLlSeOSraiqIhmcAdf1meYHMudOs9o9L7WwP8Y1721658850', 'e244540e', 'ilunga jean', 'kachak sarah', 'kabongo jubile', '+243858533285', '+243858533285', '+243858533285', NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, '+243858533285', 'eliemwez.rubuz@ditotase.com', '45 Dilolo Ruashi Lubumbashi rdc', 'actif', 'biologique', 'pere', '', '2024-07-22 14:34:10', '2024-07-29 13:41:08', NULL, NULL, NULL, NULL, 1),
(4, '240729QHTYuJ6ikypBiNkpveeHoZYrM7fadfZ7d9nabhaVRhSVC40AAl1722259617', 'e246719e', 'rubuz emmanuel', 'manyong melanie', 'elie rubuz', '+243990085024', '+243990085024', '+243990085024', NULL, NULL, NULL, '', '', '', '', '', '', '+243977090011', 'rubuz@ditotase.com', 'Lac Kabamba 49 Kampemba lubumbashi', 'actif', 'biologique', 'mere', '', '2024-07-29 13:26:57', '2025-09-17 16:05:05', NULL, NULL, NULL, NULL, 1),
(5, '240921wR5o5dBgwOlBTADZZorEmogz8YziodgSgWJ6k9v7lFW3cAyd4j1726908885', '248815', 'Vivien Mumba', 'dany mumba', '', '+243997276670', '', '', NULL, NULL, NULL, '', 'Enseignant universitaire', 'caissiere', '', '', '', '+243997276670', 'vivien.mumba@ditotase.com', 'Lubumbashi, Haut-Katanga, RDC', 'actif', 'biologique', 'pere', NULL, '2024-09-21 08:54:45', NULL, NULL, NULL, NULL, NULL, 1),
(6, '241115y3Rll0u9YV3pNtGCNVk17RYuwthuhbfn31LZp6UDlir5UoiHFZ1731675868', 'e242976e', 'Ilunga kelly', 'Manyong melanie', 'Manyongo mia', '', '+243990085024', '', NULL, NULL, NULL, '', '', '', '', '', '', '+243990085024', 'manyong.kalaw@gmail.com', 'Voir Adresse configurer', 'actif', 'biologique', 'mere', NULL, '2024-11-15 15:04:28', NULL, NULL, NULL, NULL, NULL, 1),
(7, '241115HiDIaj4g3vg8bWNFSkG4BSZR1KCBh64RQ5nIE6hjULU5jntP9e1731675927', 'e242790e', 'Ilunga kelly', 'Manyong melanie', 'Manyongo mia', '', '+243990085024', '', NULL, NULL, NULL, '', '', '', '', '', '', '+243990085024', 'manyong.kalaw@gmail.com', '', 'actif', 'biologique', 'mere', '', '2024-11-15 15:05:27', '2024-11-15 16:22:09', NULL, NULL, NULL, NULL, 1),
(8, '241115q4S3Vd0Sv20UB0oBS3g2gWnNn4v27Ch8pL2SNTHcA0DbpEbSAp1731676723', 'e246392e', 'Kazadi aimelia', 'Sylvie Kazadi', 'Melanie Manyong', '', '', '+243990085024', NULL, NULL, NULL, '', '', '', '', '', '', '+243990085024', '', 'Voir Adresse configurer', 'actif', 'biologique', 'tuteur', NULL, '2024-11-15 15:18:43', NULL, NULL, NULL, NULL, NULL, 1),
(9, '250225PG7ujYcpuw2Ee0VrnNTSFO29cRH6hGoYcrkm2lNJFY5YtwF05k1740496570', 'e253950e', 'Chikez felly', 'manyanga jeanne', '', '+243858533285', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '+243858533285', '', 'Voir Adresse configurer', 'actif', 'biologique', 'pere', NULL, '2025-02-25 17:16:10', NULL, NULL, NULL, NULL, NULL, 9),
(10, '250529IbJ3Eh4MwySJaC57IeE1ae6Q51L3dTrEPwoMf8e8TH8jDF0nYC1748508341', 'e259682e', 'Rubuz JESS', 'Manyong JESS', 'JESS ELIANE', '+243858533285', '', '+243858533285', NULL, NULL, NULL, '', '', '', '', '', '', '+243858533285', '', 'Voir Adresse configurer', 'actif', 'biologique', 'tuteur', NULL, '2025-05-29 10:45:41', '2025-09-17 16:18:51', NULL, NULL, NULL, NULL, 1),
(11, '251009LTBTiwhH78zaaqWMJbNdN2Hhsj0WsVB6DG6d9AueRFRUvv7L931760016702', 'e254607e', 'DSSA', '', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '+243885582282', '', 'Voir Adresse configurer', 'actif', 'biologique', 'pere', NULL, '2025-10-09 15:31:42', NULL, NULL, NULL, NULL, NULL, 4),
(12, '251206wRTVMOEO6ovVm7euOsivFWdI3IHPLYbnjysthPCu7Ycd0GtJb71765032290', 'e251938e', 'aucun', '.', '', '', '', '', NULL, NULL, NULL, '', '', '', '', '', '', '+243000000000', '', 'Voir Adresse configurer', 'actif', 'biologique', 'pere', NULL, '2025-12-06 16:44:50', NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_token` varchar(75) NOT NULL,
  `user_code` varchar(10) NOT NULL,
  `user_firstname` varchar(75) DEFAULT NULL,
  `user_lastname` varchar(75) DEFAULT NULL,
  `user_name` varchar(75) DEFAULT NULL,
  `user_phone` varchar(75) DEFAULT NULL,
  `user_email` varchar(75) DEFAULT NULL,
  `user_double_auth` varchar(75) DEFAULT NULL,
  `user_oauth_login` varchar(75) DEFAULT NULL,
  `user_oauth_provider` varchar(75) DEFAULT NULL,
  `user_status` varchar(25) DEFAULT NULL,
  `user_type` varchar(75) DEFAULT NULL,
  `user_session_status` varchar(75) DEFAULT NULL,
  `user_session_count` int(11) DEFAULT NULL,
  `user_gender` varchar(75) DEFAULT NULL,
  `user_address` varchar(75) DEFAULT NULL,
  `user_language` varchar(75) DEFAULT NULL,
  `user_trying_login` int(11) DEFAULT NULL,
  `user_password_expire` int(11) DEFAULT NULL,
  `user_password` varchar(75) DEFAULT NULL,
  `user_old_password` varchar(75) DEFAULT NULL,
  `user_picture` varchar(75) DEFAULT NULL,
  `user_avatar` varchar(75) DEFAULT NULL,
  `user_notes` text DEFAULT NULL,
  `user_lastlogin_at` datetime DEFAULT NULL,
  `user_lastlogout_at` datetime DEFAULT NULL,
  `user_changepass_at` datetime DEFAULT NULL,
  `user_resetpass_at` datetime DEFAULT NULL,
  `user_created_at` datetime DEFAULT NULL,
  `user_updated_at` datetime DEFAULT NULL,
  `user_deleted_at` datetime DEFAULT NULL,
  `user_role_id` int(11) UNSIGNED DEFAULT NULL,
  `user_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_token`, `user_code`, `user_firstname`, `user_lastname`, `user_name`, `user_phone`, `user_email`, `user_double_auth`, `user_oauth_login`, `user_oauth_provider`, `user_status`, `user_type`, `user_session_status`, `user_session_count`, `user_gender`, `user_address`, `user_language`, `user_trying_login`, `user_password_expire`, `user_password`, `user_old_password`, `user_picture`, `user_avatar`, `user_notes`, `user_lastlogin_at`, `user_lastlogout_at`, `user_changepass_at`, `user_resetpass_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `user_role_id`, `user_school_id`) VALUES
(1, '240722FTzFhMc25V7D6UJwirUkNMLYepFwcrgKU8up5rSVLpoiA5Vbq81721648221', '241908', 'Trecaz', 'Holding', 'trecaz', '+243977090011', '', 'false', '2024080007', 'magschool', 'actif', 'sysadmin', 'online', 1, 'man', '43 Avenue Mwepu, Lubumbashi, Haut-Katanga, RDC', 'en', 5, NULL, '$2y$12$rJClBnjOD1Ws2tK3QQnawe42QdOhxE3Z9uAivZS5IX8ZjndjgzxQ6', NULL, '', '1721655698_1268c1903e470131b47c.jpeg', 'Compte Administrateur du Complexe Scolaire DITOTASE', NULL, NULL, NULL, NULL, '2024-07-22 11:37:01', '2024-11-04 12:15:08', NULL, 1, 1),
(2, '240805sTvKk9TPSznfPJ1ZZgnsgzRO07vdkJLvDBvcfJ8iIvEWOgrN5e1722851210', '246355', 'Elie Mwez', 'Rubuz', 'mrubuz', '+243858533285', 'rubuz@ditotase.com', 'false', 'u242384u', 'magschool', 'actif', 'agent', 'online', 0, 'woman', 'Lubumbashi, Katanga, RDC', 'fr', 5, 0, '$2y$12$3M7wRi7HGYlDIFj/R2.BN.U5wuIO1.k6yjSV3llpXD5C7eeOyl46i', '$2y$10$vBkQjaOqrhrbxf0p9IexxOy21DRQuYLm1Zx.OLUGLnIVZHylF6Ox2', '', '1722851210_9795bcde3aad3e41541c.png', '', NULL, NULL, NULL, NULL, '2024-08-05 09:46:50', '2025-09-19 15:27:03', NULL, 2, 1),
(3, '240805C2a7W3VWQZfFKzCLy9ecoHb64i4eBYPPSsMysf5B1ogIMr8nLk1722856205', '241787', 'Mumba', 'vivien', 'mvivien', '+243997276670', 'eliemwez.rubuz@ditotase.com', 'false', 'u247515u', 'magschool', 'actif', 'agent', 'online', 0, 'woman', 'lubumbashi', 'fr', 5, 0, '$2y$12$1HntsN6MMEeGMRVchhVoLOE7y3bEBID56Ax5BkGs5uD/Dm3HNe7Ze', '$2y$10$7pBORKnN0sRir/kLUlQf7u1YmLvsY3fIe4M53qD5TZRkN2e6P4rQG', '', '1722856205_e23ccb077bcb7fcfba62.png', '', NULL, NULL, NULL, NULL, '2024-08-05 11:10:05', '2024-10-27 16:36:29', NULL, 3, 1),
(4, '2409188znhfwDWAAT3V4DrhwvHJMb8jUSHqkfWbJVAYg8JLOeBKVqvtu1726671345', '247506', 'college Trecaz', 'Preegana Rubuz', 's244816s', '+243821733330', 'ditotase@ditotase.com', 'false', '2024901209', 'magschool', 'actif', 'root', 'online', 1, 'woman', '11220, Trecaz City, Trecaz Way, Kolwezi, Lualaba, RDC', 'fr', 5, 0, '$2y$10$mgFaeaK/PYJ0gXRReJiR6e75TiYrx8z/USKmJ5qL0WeuLYRBP7/Ji', '$2y$10$mlbsDTAb6Lp6WodT1RWWTOxfbCTBtulJjiKG5MYRuskFcaU5ubPgi', NULL, NULL, 'Établissement Internationnal de formation en nouvelles technologies de l\'information et de la communication', NULL, NULL, NULL, NULL, '2024-09-18 14:55:45', NULL, NULL, 4, 4),
(6, '2410223i2O9Ij4df4jW5ObPDuaLU6KrOD6Qg79boZIOi0nB87wimBi7q1729601283', '243158', 'Mwez', 'Elie', 'eliemwez', '+243821733330', 'eliemwez.rubuz@gmail.com', 'false', 'u248430u', 'magschool', 'actif', 'admin', 'online', 0, 'woman', 'Lubumbashi, Katanga, RDC', 'fr', 4, 0, '$2y$10$Xv1Z77Y9GKa46DqVIebNJulvG4mONVuZU/8KDOc0GLNA05EyNbyzm', '$2y$10$LIuooK6PtGZIzNFeD3m8kuDtDDlory2y3v3nTpcCzGxRapieqjSjy', 'public/uploads/images/1729601283_32d10334b41000ac607b.png', '1729601283_32d10334b41000ac607b.png', NULL, NULL, NULL, NULL, NULL, '2024-10-22 14:48:03', NULL, NULL, 1, 1),
(7, '241121M2nzT2PNf9DSrt38JSU76D72GzpMqgmuvC2bGqn0ymMkeTtl321732188421', '244430', 'Ditotase', 'Agency', 'ditotase', '+243990085024', 'contact@ditotase.com', 'false', 'u247940u', 'magschool', 'actif', 'sysadmin', 'online', 0, 'woman', 'Lubumbashi, RDC', 'fr', 5, 0, '$2y$12$rJClBnjOD1Ws2tK3QQnawe42QdOhxE3Z9uAivZS5IX8ZjndjgzxQ6', '$2y$10$HPsXlGDku3DJx2KR6Anv7OQ576dlp3t7VxXQxPNpq5SBRcNDychny', '1734696110_4dbd62336c46ce6fa187.png', '1734696110_4dbd62336c46ce6fa187.png', '', NULL, NULL, NULL, NULL, '2024-11-21 13:27:00', '2024-12-20 14:01:50', NULL, 1, 1),
(8, '2502252VjtVf6GV4WD2YHRenmWA1FVfNljMtghJGuqf9WA0H2JPVETO21740494849', '257077', 'Ditotase', 'Business', 'ditotase.business', '+243821733333', 'ditotase.business@gmail.com', 'false', '2025134902', 'magschool', 'actif', 'root', 'online', 0, 'woman', '43 Avenue Mwepu, Lubumbashi, Katanga, RDC', 'fr', 5, NULL, '$2y$10$IE9S4VakOHYR7zUse87ZGeAl6fvmKntZxbAdScMvmcalDFz5zdyaC', NULL, NULL, NULL, 'Centre de formation professionnelle', NULL, NULL, NULL, NULL, '2025-02-25 16:47:29', '2025-02-25 16:51:43', NULL, 5, 9),
(9, '2507041LH6w2zaOAGKpPH2nwwdpq4znOpDeo2Eb6zqz29hiKcDmBrtlY1751633482', '202301', 'chipeng', 'rubuz', 'chipeng', '0858533285', 'mwez.rubuz@yahoo.com', 'false', '202301', 'magschool', 'actif', 'student', 'online', 0, 'man', '', 'fr', 5, NULL, '$2y$10$UfYO1aor6qLGVfxGO4puM.axgae2svj427lz1xthPr61VmFT9MYOa', NULL, 'public/uploads/images/1751633879_ba67750db009b558c149.jpg', '1751633879_ba67750db009b558c149.jpg', 'Étudiant en Bac 3 Finances', NULL, NULL, NULL, NULL, '2025-07-04 14:51:22', '2025-07-04 14:57:59', NULL, 6, 1),
(10, '250811MM0BLYqbTv3fRnozEo6AUJKP2TAi9hVhccgrppjJUaKQh8bwIh1754920190', 'CID24158', 'Ilunga', 'Ilunga', 'Ilunga Ilunga', '0821733330', 'mwez.rubuz@outlook.com', 'false', 'CID24158', 'magschool', 'actif', 'student', 'online', 0, 'm', NULL, 'fr', 5, NULL, '$2y$10$W.SpEk88QSXOip6xgTLktOmDZ2MS.mFUDG/bftsv0b22QkEDEEbN6', NULL, NULL, NULL, 'Étudiant en première année', NULL, NULL, NULL, NULL, '2025-08-11 15:49:50', NULL, NULL, 6, 1),
(11, '250813ya9AWQLIz9cFpY1Moym24Yr42JAV7b2eCCnDpqLwETBBlnNYZO1755100156', '255171', 'MILINDI', 'HUGUETTE', 'milindi', '0858533200', NULL, 'false', '255171', 'inpp', 'actif', 'student', 'online', 1, 'woman', 'Golf Plateau Karavia', 'fr', 5, NULL, '$2y$10$iB9/fa.VFAzQu6anUdLL/.aZQOjEJvLsXaFhYWSYrqNo8veeP.a6K', NULL, 'public/uploads/images/1755100602_7d079ffec07386b0619f.jpg', '1755100602_7d079ffec07386b0619f.jpg', 'Concepteur des systèmes d\'information', NULL, NULL, NULL, NULL, '2025-08-13 17:49:16', '2025-08-13 17:56:42', NULL, 6, 1),
(14, '250825QvopsdoojOJEKknAFKBqUkaRQStcqk4ZsbmO0QuhQYEfMg5AvI1756135490', 'CI24129', 'rumbu', 'chipeng', 'rumbu', '0821733330', 'eliemwez@cisasarl.com', 'false', 'CI24129', 'magschool', 'actif', 'student', 'online', 0, 'man', '', 'fr', 5, NULL, '$2y$10$irfiq2C2W/FVYEzfDK2PuuLWejtjhnZJazr89RPldPLm1xDA4kXvq', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2025-08-25 17:24:50', '2025-08-26 10:37:54', NULL, 6, 1),
(15, '250916CV3lpPbDh2oHKUiSY0dyqQS3UrcfvoZK1OdCHBWhcC3tFBgVkb1758031034', 'CSD232402', 'mboso', '', 'CSD232402', '0858533285', 'elie.mwez@cisasarl.com', 'false', 'CSD232402', 'magschool', 'actif', 'student', 'online', 0, NULL, NULL, 'fr', 5, NULL, '$2y$10$qhXbYRaUgwPqP2MYpJ9rguY4MLFpO0dJjtf5ytTfn/XEET01w5BdO', NULL, NULL, NULL, 'Élève en architecture et administration', NULL, NULL, NULL, NULL, '2025-09-16 15:57:14', NULL, NULL, 6, 1),
(16, '250916JsbeR87Gsvy6Z6eVV8i46uBSlDrb9EwDKLrpLgwS89VAn9nCgt1758033130', '252263', 'COLLEGE DITOTASE BUSINESS', 'chifia jess', 's251331s', '0858533285', 'ditotase.business@gmail.com', 'false', '2025750009', 'magschool', 'actif', 'root', 'online', 0, 'woman', '4512 LUMUMBA HAUT-KATANGA RDC', 'fr', 5, NULL, '$2y$10$7NGn5vHhdaneWRe05jUQGOm9/7v/RZ9TERem6YGE2viqSv0QwpTc2', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2025-09-16 16:32:10', NULL, NULL, 7, 10),
(17, '250916bQJ8k1AYE3NRDI6VqSEsvFLiGaDtq6YD5yGcW6KhNrKLCvg2Mo1758033821', '252637', 'ELIAS SCHOOL', 'ELIAS', 's253901s', '08525822526', '', 'false', '2025781809', 'magschool', 'actif', 'root', 'online', 0, 'woman', 'DSDSDSFD', 'fr', 5, NULL, '$2y$10$FxkOoI6MznACnXT1nRNpju/jm6eMyaRvevRzp6cw2Pp5ifu4Yqz9.', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2025-09-16 16:43:41', NULL, NULL, 8, 11),
(18, '250920WiIhzs6FLhZm4dmvg4B8UbjgqRfCVOemwpEaoMipOHZuQzlomv1758355830', '255872', 'complexe scolaire chifia', 'chifia', 's7-52520s', '0821733333', '', 'false', '2025093309', 'magschool', 'actif', 'root', 'offline', NULL, 'woman', '10 mwepu lubumbashi rdc', 'fr', 5, NULL, '$2y$10$VEi2gTcgPkuPy30fESFb5.CWzOWm040F6DrQVkXmpeWnsbtq7sdnK', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2025-09-20 10:10:30', NULL, NULL, 9, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users_access`
--

CREATE TABLE `users_access` (
  `access_id` int(11) UNSIGNED NOT NULL,
  `access_token` varchar(75) NOT NULL,
  `access_code` varchar(10) NOT NULL,
  `access_name` varchar(75) DEFAULT NULL,
  `access_status` varchar(25) DEFAULT NULL,
  `access_type` varchar(75) DEFAULT NULL,
  `access_reading` varchar(75) DEFAULT NULL,
  `access_created` varchar(75) DEFAULT NULL,
  `access_updated` varchar(75) DEFAULT NULL,
  `access_deleted` varchar(75) DEFAULT NULL,
  `access_notes` text DEFAULT NULL,
  `access_created_at` datetime DEFAULT NULL,
  `access_updated_at` datetime DEFAULT NULL,
  `access_deleted_at` datetime DEFAULT NULL,
  `access_role_id` int(11) UNSIGNED DEFAULT NULL,
  `access_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_access`
--

INSERT INTO `users_access` (`access_id`, `access_token`, `access_code`, `access_name`, `access_status`, `access_type`, `access_reading`, `access_created`, `access_updated`, `access_deleted`, `access_notes`, `access_created_at`, `access_updated_at`, `access_deleted_at`, `access_role_id`, `access_school_id`) VALUES
(13, '241022wNOdj407k6crsKr1w7Rmp2IYQ6RlDzoALF5GEbuTTK4ykOKmiz1729601498', '', 'all', 'actif', 'fees', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:51:38', NULL, NULL, 3, 1),
(14, '2410224nHD7yiqCofilE1Li3zs6U5zIwHLSYco1Zzmwlc54qAnQurAuR1729601498', '', 'configfees', 'actif', 'fees', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:51:38', NULL, NULL, 3, 1),
(15, '24102254ZoqtrSCVB3qGlMwmjL8gWt9pGokO63lf95HB9QqM2OgijEtQ1729601498', '', 'classesfees', 'actif', 'fees', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:51:38', NULL, NULL, 3, 1),
(16, '241022hoLkFwZJiIrLOgwTQ0QkjsKBp1bwWBpwMMGiV5S8eBq9Od5Jtv1729601498', '', 'exemptions', 'actif', 'fees', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:51:38', NULL, NULL, 3, 1),
(17, '2410221YR1M3dRvvCcjI8pLguKKZMPUPmSfOqorv4mYPay2sDWHenRKB1729601498', '', 'scholarships', 'actif', 'fees', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:51:38', NULL, NULL, 3, 1),
(18, '2410220vbtEhaJ8vW0R1wFla4czZkl1oo3qru904PDUFWPVWrGTLiV4D1729601498', '', 'exchanges', 'actif', 'fees', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:51:38', NULL, NULL, 3, 1),
(19, '241022VZuEZK8Rrd8FMcc5lIoKg9T4TstZGer6yAlhzUGwYPY7nqpHvk1729601498', '', 'payments', 'actif', 'fees', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:51:38', NULL, NULL, 3, 1),
(20, '241022U3HgC7pbte7UTHbhl3uj069nR1mTIjniBUPkHLzuCqWYDq9Pi81729601498', '', 'bills', 'actif', 'fees', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:51:38', NULL, NULL, 3, 1),
(21, '241022DpfYOt1CMcUWF38KH55NIBodful9FMVZT875LzoGiYTYLuolTh1729601520', '', 'all', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(22, '241022yyJv2Q489C0QC2K2hsjZS1Qiz0iMU58dhF5elepEs5YRjnae7q1729601520', '', 'repparents', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(23, '241022M5rTC6maIur15vV5mvlIjARJpZwunzlkvT337JNdhuMzddLWN41729601520', '', 'repannuary', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(24, '241022OqhzsJuugeC7JUaoR5iycsBVdcFAOEZVwcJKC87CMJbD2S6RE31729601520', '', 'replisting', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(25, '24102234iILzYjlior1V3nWrfAAgn1Kl5Z1nw0bHLK6EWQ7BYhdtpyij1729601520', '', 'repstudents', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(26, '2410227wGwlCAkw7ryaUASCiw9mbhGsC14ltSsGSjzqLYojS6oADgnoN1729601520', '', 'reppayments', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(27, '241022NtymTdHAOp9L3m5MbgStIhBOzEZNUZ6E7u6luDhT0ilE6dDo8F1729601520', '', 'repcashbox', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(28, '241022csEtdwBMoH2Uy93UnZWjUlN9CcdFqEV4Rc3qScwz8bvl8NNq1o1729601520', '', 'reprecovery', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(29, '241022djRktv4u3mUZqg7KmrnO8ibI4CZDpeBvnnG4zPsGekBQLjd8kb1729601520', '', 'repfees', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(30, '241022ch5EWWqiMebaY0FZU3mKi6GvB5c1JfL0d7uvUl0ArvjDNOPsBI1729601520', '', 'repusersfees', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(31, '241022lgcB88CR25GpGnBEDcYcnWFRSuhfA1tBFRCkvLDKQZKhoEnJ1m1729601520', '', 'repbanking', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(32, '241022AIdVdbWDqnOvKV2CZahPRbOcicLfYDP6p7za8pRGmgIZP34Vzs1729601520', '', 'repyearly', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-10-22 14:52:00', NULL, NULL, 2, 1),
(33, '241022vMiBDVb4mAhTgi3LtYZhLhYAYfMi0Hqp7uAgk6EIIJ1B8bqY5l1729601553', '', 'all', 'actif', 'students', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:52:33', NULL, NULL, 3, 1),
(34, '241022zqUTTKuwJ4QYilWjercp8DPHGJoeLf57dd8QRrAWVvOy9wbEcE1729601553', '', 'inscription', 'actif', 'students', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:52:33', NULL, NULL, 3, 1),
(35, '241022ElDZwz9FEbBo3g4t8Pgdb0FzRs7s64eUt8ghUv8bDrvNhP04QA1729601553', '', 'basculement', 'actif', 'students', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:52:33', NULL, NULL, 3, 1),
(36, '241022CPQoCNRcjVHnYu88DaY5lraUHTPHIOLyic2WuNwnRRGIeynuuP1729601553', '', 'parents', 'actif', 'students', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:52:33', NULL, NULL, 3, 1),
(37, '241022n8ea27iRQFMEof8slj3KJIJDRnGkhaCnno0aplNYo3h899OMCp1729601553', '', 'registers', 'actif', 'students', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:52:33', NULL, NULL, 3, 1),
(38, '2410223Fjbhq4lS1g5McwJkS5ldZnaKZA8dAbc72WEBj4Uqa7B1PVnmD1729601553', '', 'parcours', 'actif', 'students', 'on', 'on', 'on', 'on', NULL, '2024-10-22 14:52:33', NULL, NULL, 3, 1),
(40, '241113HSCOMmanLnBaLU7SP79Mav1GZ2oMORVtvzpc4NEsIeOo8FkZ781731507947', '', 'timing', 'actif', 'teaching', 'on', 'on', 'on', 'on', NULL, '2024-11-13 16:25:47', NULL, NULL, 3, 1),
(41, '241113VyKuTsvIzdCvDaVBEKIgST4GLDjdHVPcVapzYhHhT1ymAcz5BR1731507947', '', 'encoding', 'actif', 'teaching', 'on', 'on', 'on', 'on', NULL, '2024-11-13 16:25:47', NULL, NULL, 3, 1),
(50, '241113rIjQU4RvSAaGNW04WncPoS4MYFOT0mqB3oQlVihHbOIdFhEeS41731508012', '', 'reppayments', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-11-13 16:26:52', NULL, NULL, 3, 1),
(51, '241113jKDlBLUI0JK5v6cBOOn9cztIm7HwvrjJsqTWPFELtVcDsykEoO1731508012', '', 'repcashbox', 'actif', 'reporting', 'on', NULL, NULL, NULL, NULL, '2024-11-13 16:26:52', NULL, NULL, 3, 1),
(57, '250919Hv9Tw9sj3NUATW4hbZB7bDRgS5h5PvI1bgcCKwHnjznmHrqdUO1758288400', '', 'all', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1),
(58, '250919P9J0nqRZbztSzneJ1aT3FYLSRh4OWt6Wbjpo4ugIjCPiTEfbrC1758288400', '', 'employees', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1),
(59, '250919ueufafCyfyaJoDmFKrR06eaR4kDGwn6HfqKAAhVnVwoO1ciMCk1758288400', '', 'salaries', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1),
(60, '250919MeI2sc48DCplNQ5AAdnjOVpnAp7qvyhAYFVPB7AogKEcwCsQhK1758288400', '', 'payslip', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1),
(61, '250919ZuZR8czqzVNsWEYFh9zce6KP9OoU1q3ye1j5IKbKCPiuDFwisq1758288400', '', 'categories', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1),
(62, '250919czmiSeTIOurIdA3NjInmf82rIZk1bb0c4abtNiotHeun6f8UsI1758288400', '', 'contracts', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1),
(63, '250919pkFIdqEKbVutUI1IR2dUGGulkH0nTDVt4FhKB7U5b7yDzhgQna1758288400', '', 'deductions', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1),
(64, '250919mz7Z3GIAq6NtHtd8FaPQQjguVuqcO23WepswtNJLRUPlbDSJGz1758288400', '', 'attendances', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1),
(65, '250919zFJPGqh7DenpCbiB0aCBd5szNSP7UV5BzZf1bH0OneqDfpsuFG1758288400', '', 'requests', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1),
(66, '250919oJbeZbNgQ3fUcnKIafFhMqdZitJBlHNh0qRRkoPNdryiw3ALjG1758288400', '', 'leaves', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1),
(67, '250919V4Ot3neMRBsUQJ7aszRuSmiWnPqfRQ4TaHVkPIYAebQ3hNSfYF1758288400', '', 'badges', 'actif', 'payroll', 'on', 'on', 'on', 'on', NULL, '2025-09-19 15:26:40', NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_activities`
--

CREATE TABLE `users_activities` (
  `activity_id` int(11) UNSIGNED NOT NULL,
  `activity_token` varchar(75) NOT NULL,
  `activity_code` varchar(10) NOT NULL,
  `activity_ipaddress` varchar(75) DEFAULT NULL,
  `activity_device` varchar(75) DEFAULT NULL,
  `activity_platform` varchar(10) NOT NULL,
  `activity_status` varchar(25) DEFAULT NULL,
  `activity_type` varchar(75) DEFAULT NULL,
  `activity_notes` text DEFAULT NULL,
  `activity_created_at` datetime DEFAULT NULL,
  `activity_created_by` varchar(75) DEFAULT NULL,
  `activity_deleted_at` datetime DEFAULT NULL,
  `activity_user_id` int(11) UNSIGNED DEFAULT NULL,
  `activity_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_activities`
--

INSERT INTO `users_activities` (`activity_id`, `activity_token`, `activity_code`, `activity_ipaddress`, `activity_device`, `activity_platform`, `activity_status`, `activity_type`, `activity_notes`, `activity_created_at`, `activity_created_by`, `activity_deleted_at`, `activity_user_id`, `activity_school_id`) VALUES
(1, '241104mw7QOgYuo5PonaA79CBmmSu5AnVBbahd2ii2onwccL19UcWQfR1730715308', '244051', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'update', NULL, '2024-11-04 12:15:08', 'Trecaz Holding', NULL, 1, 1),
(4, '241104qSsjYlu4SzpRSJ1nMZ9rUPTIctCfTROCZZ2cQAq0lRqvVTGJDr1730715884', '240838', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-04 12:24:44', 'Trecaz Holding', NULL, 1, 1),
(5, '241104qLcpji5cmYIIaeR8yNZmuhmcnsEnZysi0LSf9kIDofOdMgsmOH1730716357', '244278', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-04 12:32:37', 'Trecaz Holding', NULL, 1, 1),
(6, '241104blYfsmHkKpHEkWzhwpCmyiuaV67tZI8qqVcsjdt5mnr1PDc76Q1730717198', '247542', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-04 12:46:38', 'Trecaz Holding', NULL, 1, 1),
(7, '241106az2ZnH2uvUoWUTNMm0MO034eUA66qkHJyV3otfsEEFeO61YVVY1730889537', '247750', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-06 12:38:57', 'Trecaz Holding', NULL, 1, 1),
(8, '241106iLUe4mOIOjewjvARM8Fjta8sTHInSCIQ1Gp0TrlKlLwJCwNQLp1730903715', '240951', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-06 16:35:15', ' ', NULL, NULL, NULL),
(9, '2411067Znjf6ORiPEN3QhQ14PPMaR7K1gW1icT5yHFtnwCA7KF16OjUI1730903725', '242574', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-06 16:35:25', 'Trecaz Holding', NULL, 1, 1),
(10, '2411069sdM3BIPNnk0bGZBni2nB4YlNRFQI9MrUYTZouQntd4Kfogj131730905350', '241775', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-06 17:02:30', ' ', NULL, NULL, NULL),
(11, '241111E6QK09d5CAHrJi3e23BQMQyGOcSMSUHUuv806attAmqALRQD9h1731310829', '244001', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-11 09:40:29', 'Trecaz Holding', NULL, 1, 1),
(12, '241111KiSzi03lEnr96NNYMOjyAcf9SSEoqnZhDkSqduzksBm5sISeiK1731314376', '248630', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'deletecriteria', NULL, '2024-11-11 10:39:36', 'Trecaz Holding', NULL, 1, 1),
(13, '241111hw8UqO6W6eAf0myPaJ60CSYIZ1kAP4IFYR19Be6jdf042d7VOk1731314492', '249614', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'deletecriteria', NULL, '2024-11-11 10:41:32', 'Trecaz Holding', NULL, 1, 1),
(14, '241111678mJpg3TSZwdmZ4M0s6pQ9Up2fMuKEUVnrdBWJUy8bug4df1j1731316465', '242899', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'deletecriteria', NULL, '2024-11-11 11:14:25', 'Trecaz Holding', NULL, 1, 1),
(15, '241111Y2yjBV6I1HjhgtdHe8hD6ypjKjgDNsjiayk01n6e0QsYmnvLqr1731317540', '241566', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-11 11:32:20', ' ', NULL, NULL, NULL),
(16, '241111g47IZLKwDJ0n20vk0BhefCD8mCCUETgZ1GjC3yjdv3W2vKBMCw1731317552', '244802', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-11 11:32:32', 'Trecaz Holding', NULL, 1, 1),
(17, '2411111r9U0yTanHzmKmk1neWnCtQ0YI2ivoNl2YMWEujvP9mo1lRaHi1731318094', '249798', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-11 11:41:34', ' ', NULL, NULL, NULL),
(18, '241111wndFgeiRyK96eCISFnufTfmCnHQBEKttvF66Wi6EvgJMRCG9Te1731320138', '246680', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-11 12:15:38', 'Trecaz Holding', NULL, 1, 1),
(19, '241111uTPm4AKcNIN3OkFd5lCZZ1BWQLMD4LMoeO98zsZgzqfW3qhlS91731320165', '249988', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'deletecriteria', NULL, '2024-11-11 12:16:05', 'Trecaz Holding', NULL, 1, 1),
(20, '241111re4G3IzJJPl4BDosyaVeUcoV4LydHsqtADzt8hoKeSiv3CkutT1731329147', '244141', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-11 14:45:47', 'Trecaz Holding', NULL, 1, 1),
(21, '2411112KsO51HgrlyRZghr0qesa0Y6MawJb1U3dEKpfquFSaoCI2lems1731329865', '246030', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-11 14:57:45', 'Trecaz Holding', NULL, 1, 1),
(22, '241111OPwcEBWDIWhke8DHMBTffJ5TkZse5IUZhaMOKpKeuIKezv769c1731335511', '244095', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-11 16:31:51', 'Trecaz Holding', NULL, 1, 1),
(23, '241111EZuQmivUYLDDebswlqhO3DU4Wdmmrd47BnZJagfk0uuZKyHNaD1731335588', '246313', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-11 16:33:08', 'Trecaz Holding', NULL, 1, 1),
(24, '241112bvSmzo1JR6rWKQUHnfenl6IbWiY5yfGBn3rAJKbOoDhAdJLWDM1731398255', '240338', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-12 09:57:35', 'Trecaz Holding', NULL, 1, 1),
(25, '241112Okr48IbIVYV6VA81JPc1ZFWQvwJ03aiLrrIyP7W1vDVWwaslGg1731405255', '246183', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-12 11:54:15', 'Trecaz Holding', NULL, 1, 1),
(26, '2411124Hs7wnKmJcHbpFQtwwTzJg8IvyOQ3slon0FFkRYoIOcygq49Jb1731405266', '241722', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-12 11:54:26', ' ', NULL, NULL, NULL),
(27, '241112w43kMA2wP0yaNf0WCEBcljHKamZlk5sKk9NEmBRH1kzhhG52121731405481', '248812', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-12 11:58:01', 'Trecaz Holding', NULL, 1, 1),
(28, '241112TidNESwoyT956vhFjqnMlAePz0H3fdLrAhL3Na2EMhodyeULQ91731406244', '244669', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-12 12:10:44', 'Trecaz Holding', NULL, 1, 1),
(29, '241112OCZnNIizL6nQ51d5kB0NwRrJmMihDg5tDBnT9VeZFPG15N2igb1731406264', '244795', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-12 12:11:04', 'Trecaz Holding', NULL, 1, 1),
(30, '2411123b9NFDhP170So3V4HvqNd2nWc3mGJ865CZKbZprsPJn1MVDtf81731406726', '245080', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-12 12:18:46', ' ', NULL, NULL, NULL),
(31, '241113ZeiR3BN1ykd0j1TnZ6NOwmldtqnHOc2J5VJPUjmfPQFvkgk7pw1731483272', '242997', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-13 09:34:32', ' ', NULL, NULL, NULL),
(32, '241113PUKiYvBjBTagqIHl0A6g5cVKb4zqGVchE7Lhdw8BwYT9jmD3Bs1731503059', '246384', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-13 15:04:19', 'Elie Mwez Rubuz', NULL, 2, 1),
(33, '241113ddfiyzqAYrIiACY2ku4qTnhd00YmHZAz8uMvrC94JStJ2d7FV81731507796', '241095', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-13 16:23:16', 'Elie Mwez Rubuz', NULL, 2, 1),
(34, '241113hGPjVgnBzjQAJgJqw5eHozuqi1fRCy2elH4p1E9rd0qDP3Fv3p1731507807', '245315', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-13 16:23:27', 'Trecaz Holding', NULL, 1, 1),
(35, '241113aikBiwluUFNhvmR8sdcOcSEeqvvzLbkW7sLsGGeCEkMeDagFGU1731510485', '244522', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-13 17:08:05', 'Trecaz Holding', NULL, 1, 1),
(36, '241113KbBoyKrJ5OZRBG8shJgfqCKuZaJo6a1jDTrHUuNC6raN2L2iP41731510492', '241040', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-13 17:08:12', 'Elie Mwez Rubuz', NULL, 2, 1),
(37, '241113LrnoFHsTuFf3y27ZTapAwJaTEIjALUEKwyIfWQ2NIt9OijIQ9q1731512241', '243445', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-13 17:37:21', 'Elie Mwez Rubuz', NULL, 2, 1),
(38, '241115NZ8BqW46eWYcDgydLM4eYQmIYZMHiqzjaAYOu2lC7A8BOo0CN11731659569', '249014', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-15 10:32:49', ' ', NULL, NULL, NULL),
(39, '2411159ra8jpS8OR84drZ1oeQenTowQaaES5MDRbQ9jaSnFoz6cRaA581731659577', '246748', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-15 10:32:57', 'Trecaz Holding', NULL, 1, 1),
(40, '2411162tCddcifunNLHkAwUe8JccIlbC1pCuLLSUaWd5Ct88YOmnJ9WM1731748004', '245970', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-16 11:06:44', ' ', NULL, NULL, NULL),
(41, '241121auLpuVBvfKfszOFthDDhWfGqeEs6IqN8mO0KvtM3WdNGubZyzl1732188271', '247206', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 13:24:31', 'Trecaz Holding', NULL, 1, 1),
(42, '241121Y6RiER4SkBIBkqy3LOgOCEHb8Qo8PqGcVFTVKCjd08FoJjhvvw1732188502', '249763', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 13:28:22', 'Trecaz Holding', NULL, 1, 1),
(43, '241121Wlo5jr1aco4SmYlqe2ihKQKO0ET68vn98mUiCBFWTrWzWPNpui1732188513', '244812', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 13:28:33', 'Elie Mwez Rubuz', NULL, 2, 1),
(44, '2411218hj6TeG4Uo1JimafZfy99u50nWKjJIJ8t9WDaJNlqrUrNW8J7C1732188671', '247304', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 13:31:11', 'Elie Mwez Rubuz', NULL, 2, 1),
(45, '241121ebSHzrFQwEoYWClqa8er02QqvLWlejWyLe7L1ygAuzsrgRKPOM1732188683', '248720', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 13:31:23', 'Manyong Melanie', NULL, 7, 1),
(46, '241121OfzYdG4e7l8jPrg43FR1v9nWpUZzqDvCLs8eUaPkOPrKOTO4UQ1732189427', '243880', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 13:43:47', 'Manyong Melanie', NULL, 7, 1),
(47, '241121BSUugju5iMLuGGi2hGaz6vE2FMUHfHJAoydLvSpwaTfNy3NsOE1732189438', '247904', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 13:43:58', 'Trecaz Holding', NULL, 1, 1),
(48, '241121jm2wTbKTLypJppBDKqObvC1Y5Lpj84V5HMwo4dIqQNwbYw9KHt1732189477', '243710', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 13:44:37', 'Trecaz Holding', NULL, 1, 1),
(49, '241121RFHktlGZlJ6MfyFbRzpHwKU4B6O7Smmi7gYplf4nTfzQjTikzI1732189505', '244673', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 13:45:05', 'Manyong Melanie', NULL, 7, 1),
(50, '24112135WWC9ViG8eDIT9gByr2yHCHIh4CPkD2KQM4WM2zhyCm3JrWfJ1732189674', '244693', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 13:47:54', 'Manyong Melanie', NULL, 7, 1),
(51, '241121mmS42lcYOqGFg4Fagupb5R9dNiSZzfiBRrHHfkNcfKuI6WJ9rQ1732189684', '243347', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 13:48:04', 'Trecaz Holding', NULL, 1, 1),
(52, '241121yDudiJKGRge0BQmIYAVA3IK3oDVY5nvrJzd1DkLWinkYJZtRUv1732189766', '248316', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 13:49:26', 'Trecaz Holding', NULL, 1, 1),
(53, '2411216VIoYPqbnkcc0VKs6254vggap7IWJKShAkRBOjAGMApGIVUt291732189805', '246373', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 13:50:05', 'Manyong Melanie', NULL, 7, 1),
(54, '241121vJOrLqKhBtJQrVz255PsPrbNN3azuwUAHU5KApMZjskWE4YgvN1732189818', '242169', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 13:50:18', 'Manyong Melanie', NULL, 7, 1),
(55, '241121cNLOc29m5g4UkCeg2a32zOBCGINWr6VNRqdYuCF1uiF98ijC8w1732189826', '247405', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 13:50:26', 'Elie Mwez Rubuz', NULL, 2, 1),
(56, '241121pWg1SjV8hCFT9phSaS3tfcaTZfuivdMUhatYmBT027q5loETYt1732190324', '245386', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 13:58:44', 'Elie Mwez Rubuz', NULL, 2, 1),
(57, '241121zzDd7M23QeIBN2bL5TwJpAqyjrp2AgB8IF3wMC3MUevcJr5DvM1732190334', '242138', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 13:58:54', ' ', NULL, NULL, NULL),
(58, '241121GGwfTGfVh00oFV5TsBuUCNjoGGU8S14tLekg2QRVaH4avaRQ9Y1732190351', '243457', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 13:59:11', 'Elie Mwez Rubuz', NULL, 2, 1),
(59, '241121Az7N2jMos2EYgdZVVFH0amn8EM5uyRBawihHhh2U8wFAcIccpn1732191238', '249254', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 14:13:58', 'Elie Mwez Rubuz', NULL, 2, 1),
(60, '241121oeWGND1ru7ikOo90Ve3c3zilIObMVcsuA1o3JZUghGa3uVQFkH1732191259', '247485', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 14:14:19', 'Elie Mwez Rubuz', NULL, 2, 1),
(61, '241121a77Qpyl8Yy1ockCKs9yhe9tyDpbe1i6y2VpwqwhsJ83yC9t5801732191548', '242537', '::1', 'Chrome 129.0.0.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 14:19:08', ' ', NULL, NULL, NULL),
(62, '241121cec420wGcTDibdAGa3l1GdQzLAmDqVuT5L6gBn7rMwC0HCHAib1732191558', '244765', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 14:19:18', 'Elie Mwez Rubuz', NULL, 2, 1),
(63, '241121kowdAdWvGiHDUER6GZHdw69H013DCqLLomvKJMRW8VByUbJkkG1732191572', '245158', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 14:19:32', 'Elie Mwez Rubuz', NULL, 2, 1),
(64, '241121HvT0TZsIYuZeeRImIirP9BYMJy9dRgooJ0pLFcoAV3KNZFkA2r1732191586', '247907', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 14:19:46', 'Elie Mwez Rubuz', NULL, 2, 1),
(65, '2411218uD1agzuAO1LQgudaU35F9OsaJcR1sG6SSOEtpiBwRwBCstfLV1732191598', '248128', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 14:19:58', ' ', NULL, NULL, NULL),
(66, '241121yUQR25myZWbQo4qOPV8kMMJR9MNovFRerFqQmwDjgh0c4Ksjf61732191605', '246220', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 14:20:05', 'Elie Mwez Rubuz', NULL, 2, 1),
(67, '24112105DRLjzN6BTAnfsCCKGmT1ufdmZHDr9TYICuQEUVJI0nTljKMj1732192150', '240561', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 14:29:10', 'Elie Mwez Rubuz', NULL, 2, 1),
(68, '241121NI7RZNuWACeZJu3m95Me74VANYfyo4gz7bjKG4BtPemvYnVWFk1732192158', '245590', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 14:29:18', 'Mumba vivien', NULL, 3, 1),
(69, '241121dFdzGpJV61t9V8DbCjsTzIGrUf7ISTcQ1ASCyKrgwJqPUCsVqN1732192170', '242930', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 14:29:30', 'Mumba vivien', NULL, 3, 1),
(70, '241121NZwlGLH8C4OIePILo4TBjveojj5i8vE7O2AYqHTMkImi7oQY5E1732192192', '242309', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 14:29:52', 'Manyong Melanie', NULL, 7, 1),
(71, '2411211E3pTdGV5f0anqWTenzfTkRJUTjF2t24u27ykuUnCQarybv9PB1732192501', '243366', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 14:35:01', 'Manyong Melanie', NULL, 7, 1),
(72, '241121I8r5871bZLCPdvi7qBGyenLzGj0VndZ2cwVbjqmOejl7te95WV1732192512', '246480', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-21 14:35:12', 'Manyong Melanie', NULL, 7, 1),
(73, '241121khsYFmZEoJciNBHkv95lenvwZ2KbwRc2P6vba7FMNwYT4FKR9h1732195173', '240235', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-21 15:19:33', 'Manyong Melanie', NULL, 7, 1),
(74, '241125BDWgTCVtwdEPQvKaRV8fGoKwKo0bk7cYLWssTDDf9ejU7D4us81732522310', '242693', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-25 10:11:50', 'Trecaz Holding', NULL, 1, 1),
(75, '241125GMqOfjwk241sY0ZRkt44AzTBn6fLtdn1oygCLvm2alZr1kYsTm1732526187', '243229', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-25 11:16:27', 'Trecaz Holding', NULL, 1, 1),
(76, '241125arhAqaQLpaYb7ZhqCbPEy3YLNyK9gyoE5s0bRIO5ft88tYjY5P1732546343', '243778', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-25 16:52:23', 'Trecaz Holding', NULL, 1, 1),
(77, '24112562HQC7AflsldEiFV01OJeriDaprlHWIRoIgfqDSefmJsKQ5VRF1732546376', '242339', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-25 16:52:56', 'Trecaz Holding', NULL, 1, 1),
(78, '241126KS4Julkyg0TT6BslkvmD5gsaZru484Iz8nzHLitNlksKzJU6LD1732614895', '240441', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'login', NULL, '2024-11-26 11:54:55', 'Trecaz Holding', NULL, 1, 1),
(79, '241126OPBMKpE35BJHDF1WWof2iV6FWdhAt5EaQASbud97hrp2MqJQTQ1732618935', '241695', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'logout', NULL, '2024-11-26 13:02:15', 'Trecaz Holding', NULL, 1, 1),
(80, '241203aSKm3b1UjbWK0bWC8NWNbgiZzZyCHyfBUtaioqUl0Zfh3roMCG1733211739', '242995', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-03 09:42:19', 'Trecaz Holding', NULL, 1, 1),
(81, '241203oBKLOtamlJduvowHUjdc58TtGd2PbV2D9NSUlVy5nqMedpO2Zm1733212231', '249127', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'deleteexemption', NULL, '2024-12-03 09:50:31', 'Trecaz Holding', NULL, 1, 1),
(82, '241203eV0PVwgJFYglS4NJf469EYkZrstzHUqvKVfAK9zQVweeCejtTt1733214238', '243598', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-03 10:23:58', ' ', NULL, NULL, NULL),
(83, '241203S8yVasGHpoAP2YfP8qvLsT7lLDrzu2oyDviPs0r4n1bI87i2F91733214279', '249819', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-03 10:24:39', 'Trecaz Holding', NULL, 1, 1),
(84, '241203PPOUFd8QvAsk0LPPHhlIwbVBe57z2sYTzeHavslqeuquVrWe1T1733221061', '248182', '192.168.139.56', 'Chrome 102.0.0.0', 'Windows 10', 'actif', 'login', NULL, '2024-12-03 12:17:41', 'Trecaz Holding', NULL, 1, 1),
(85, '241203SbMs8ha6bAuneRsttw37RqZ3TaLYdIymy7wYde0HtI8NdhIi391733221061', '242194', '192.168.139.56', 'Chrome 102.0.0.0', 'Windows 10', 'actif', 'logout', NULL, '2024-12-03 12:17:41', ' ', NULL, NULL, NULL),
(86, '241203CfQkTBeqlB6jkIUbzkmBzgneMzG6A20RSQbhjUy36mK4dZyMET1733221121', '248750', '192.168.139.56', 'Chrome 102.0.0.0', 'Windows 10', 'actif', 'login', NULL, '2024-12-03 12:18:41', 'Elie Mwez Rubuz', NULL, 2, 1),
(87, '241203fV1cqdc7bOkVeaEiBZAbR8BlRMZYYBZYYULvPuNTkO6s1l0b001733221122', '248076', '192.168.139.56', 'Chrome 102.0.0.0', 'Windows 10', 'actif', 'logout', NULL, '2024-12-03 12:18:42', ' ', NULL, NULL, NULL),
(88, '241203HjcEkaDn5eN8EkldQdUoM7Fhz1sIQ5psb8i0oRITtP9yp3yND51733221637', '248945', '192.168.139.123', 'Edge 131.0.0.0', 'Android', 'actif', 'login', NULL, '2024-12-03 12:27:17', 'Trecaz Holding', NULL, 1, 1),
(89, '241203zyqcuum7JKiYbGyVdWcCkfcgaa6RvhIrw6oL7PSuJtQaQ1vhTW1733221638', '244686', '192.168.139.123', 'Edge 131.0.0.0', 'Android', 'actif', 'logout', NULL, '2024-12-03 12:27:18', ' ', NULL, NULL, NULL),
(90, '241203TBpdNGy8WVLO5UimkCksc5boVeEPPh3resm7TbnLjTMY3iz77p1733226350', '241844', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-03 13:45:50', 'Trecaz Holding', NULL, 1, 1),
(91, '241203ciJcR35R455DlaC8VSo9394eKYfeYhyYQjiUaA7KF7NcltAmCl1733226387', '246873', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-03 13:46:27', 'Trecaz Holding', NULL, 1, 1),
(92, '241203FUr8nKLMa2CRw5hmOwLHcibggVTJD5HnHSQME58EkusrgPZjT11733226456', '248836', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-03 13:47:36', 'Trecaz Holding', NULL, 1, 1),
(93, '241203D4BwO35TvFi1aPw7kaKLH7KWy4nbeBCOiy0QD3r4zEeJVKiyfK1733226463', '245117', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-03 13:47:43', ' ', NULL, NULL, NULL),
(94, '241203CLoY2FQk7UHYvq8eNU6nedn1Y9tePQ3J3uZD0COrRcGTstPc2V1733226481', '249090', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-03 13:48:01', 'Trecaz Holding', NULL, 1, 1),
(95, '241203J5YeiRwKPokwdOQWgWty5gBl0JBMzC2FyL87mr5T5bCJO9vdWM1733226767', '246853', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-03 13:52:47', 'Trecaz Holding', NULL, 1, 1),
(96, '241203BdVZeDrqKQPBSIY7JPBi7QJACyms5YNe2mV8ng4TziYCdPFVAP1733226780', '244605', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-03 13:53:00', 'Trecaz Holding', NULL, 1, 1),
(97, '2412038EsIGGPQcDLRPA5y0j5vdbdRoe1DGSzzMRKLZJt0H16lzD59yW1733235996', '242148', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-03 16:26:36', ' ', NULL, NULL, NULL),
(98, '241204PP5spuwiqL3RkMb1bcB7QNT9gLDkdjkE3nV105MhoNRP0Kpqgh1733299792', '241290', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-04 10:09:52', 'Trecaz Holding', NULL, 1, 1),
(99, '241204z10OWkCYOcepA9FAR8pqLezS3o6K9HIsyGUn7tg6NncoequPon1733307552', '241473', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-04 12:19:12', 'Trecaz Holding', NULL, 1, 1),
(100, '2412048bjAwPIuFVg3O2mi0Ac4WhfbUVqkZLIq7Bza8ZYUMFqUVuL1f31733318186', '243252', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-04 15:16:26', 'Trecaz Holding', NULL, 1, 1),
(101, '241204fS7NZq32QmmnWU28v2VeQATJE16wZA6oSzOKLhkFqarC14IBAd1733318202', '249618', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-04 15:16:42', 'Trecaz Holding', NULL, 1, 1),
(102, '241204OYlouKM9B6upnPTPccHkp5rySGgatqJz9dBTlCcwPfV4GDjI3v1733319154', '248145', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-04 15:32:34', ' ', NULL, NULL, NULL),
(103, '241204G4efrF9VvECuhb6JJbS7w4iTsZQ1y7ltPyYomftbhV2kqRdn3r1733324626', '249314', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-04 17:03:46', 'Trecaz Holding', NULL, 1, 1),
(104, '241207KpRbCscY2R5aSZ01qG8m76TbnruszIC6Qb5y37Y9kLZJ3hKTu61733557494', '244093', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-07 09:44:54', 'Trecaz Holding', NULL, 1, 1),
(105, '241207auovjFn0iykWtkFdUOaJK8vl2E8ev4t5VRLwZWrvY7chCNnJnF1733563123', '249270', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-07 11:18:43', 'Trecaz Holding', NULL, 1, 1),
(106, '241220ZlgCopla6A3ygTb0VYD1zKNckGTZ5JD25aD9TCPBbiu9ZGcnDn1734695913', '243786', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-20 13:58:33', 'Trecaz Holding', NULL, 1, 1),
(107, '241220S80sMdkqYakkndM7HPmgcfE10UEcVvu4vRj17WPitzWfGCtUe01734696123', '243419', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-20 14:02:03', 'Trecaz Holding', NULL, 1, 1),
(108, '2412202kyduVEYMztqv38YgRZ0BfP5Ff8b10enW6vAeSL2H8gOwKozr81734696132', '243019', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'login', NULL, '2024-12-20 14:02:12', 'Ditotase Agency', NULL, 7, 1),
(109, '241220lOyTrHHIwVk1G90H9Mg5uWmEJq0EU1AaT34ApUJrnbW2LYunEv1734702758', '242861', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'logout', NULL, '2024-12-20 15:52:38', 'Ditotase Agency', NULL, 7, 1),
(110, '250128fbKWwyWj0pZrmm7MpQIEZRyn6e1jizsFiRgRINuID6dGiFZckA1738073465', '258558', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'login', NULL, '2025-01-28 16:11:05', 'Trecaz Holding', NULL, 1, 1),
(111, '250128SWA0RrhP80Q8gqYfpfiBGt0vSDb5tp6j8NG9RypFNBML3Q8eyK1738073753', '256852', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'logout', NULL, '2025-01-28 16:15:53', ' ', NULL, NULL, NULL),
(112, '250128bIN84rehvuQffUNbvwodnVnNGpM9lRu2DgaBILP1FrvTGJtjOU1738073759', '250284', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'login', NULL, '2025-01-28 16:15:59', 'Trecaz Holding', NULL, 1, 1),
(113, '250128OUVK2jJlnkaBjQ0gIRKm2YqVN3IWWN46eb6sOy5WEyTlcCTlIy1738074118', '258372', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'logout', NULL, '2025-01-28 16:21:58', ' ', NULL, NULL, NULL),
(114, '250128ul2WoHH1tcUc5WJMdVZ1WjCOL7GOftgPucVgcFIeBLA889QFjj1738074756', '252074', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'logout', NULL, '2025-01-28 16:32:36', ' ', NULL, NULL, NULL),
(115, '250128b6sC8EtvGt29Ysd0FYdYhGjfq3lZHC8hQCV7hurflThBakvRWr1738075177', '254805', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'login', NULL, '2025-01-28 16:39:37', 'Trecaz Holding', NULL, 1, 1),
(116, '250128KfiJT2P5FvMJRdTLHY0NJpKz5VYDaPAk6gCE7j49vatJeGJNQS1738080596', '258185', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'logout', NULL, '2025-01-28 18:09:56', ' ', NULL, NULL, NULL),
(117, '250128vIhfiqNqGbFlVSHMLiOc1cIMbeMB7Z21i8DPwDOyR06ZscptSZ1738080603', '255361', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'login', NULL, '2025-01-28 18:10:03', 'Trecaz Holding', NULL, 1, 1),
(118, '250130lD72S8d7pBqp4sUDQDCGpwySoYMcJwmnRlfmgoCIHpujNz9v5B1738248954', '255283', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'login', NULL, '2025-01-30 16:55:54', 'Trecaz Holding', NULL, 1, 1),
(119, '250130IRcKeaDMSuoz35palM9OrfzfKRVMkF94FJyNFwM12rPP8RrJeD1738249039', '255850', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'logout', NULL, '2025-01-30 16:57:19', 'Trecaz Holding', NULL, 1, 1),
(120, '250210wklWwtPkYOcsfpvN0D5y4sbE9AtciG4lP8Z4kUnrs9yCdjTOr01739173707', '251658', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'login', NULL, '2025-02-10 09:48:27', 'Trecaz Holding', NULL, 1, 1),
(121, '250210M1I62s8AvcbJf99zZqr5eIpRJPlophNtdi9F990Z6PHEW19fsF1739174321', '257609', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-10 09:58:41', 'Trecaz Holding', NULL, 1, 1),
(122, '250217JtpfctaCrURO1PHGyjBZnOIEGoC53DpA6VrP0r0uEwoBRPVWuG1739796939', '257634', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'login', NULL, '2025-02-17 14:55:39', 'Ditotase Agency', NULL, 7, 1),
(123, '2502174wVckGw9gsl0dvrZQCzOWCrylsp1UwanGgdkZFUJ2IA6pA5nwV1739797190', '257016', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-17 14:59:50', 'Ditotase Agency', NULL, 7, 1),
(124, '250217aO0L8SV0EzukTfwPOvPbWI6tzGzAvJwSynZl5Ok5JY3vY39fQU1739797198', '253500', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'login', NULL, '2025-02-17 14:59:58', 'Ditotase Agency', NULL, 7, 1),
(125, '250225da2o5wThUorTbkVvfHIbTD5bm4ZDZhJvUsNANAsuD5GcMGMKYC1740477116', '256759', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'login', NULL, '2025-02-25 11:51:56', 'Trecaz Holding', NULL, 1, 1),
(126, '250225lfgmKwdOjCrHClCaqD6Umz8bmjBabv9oel9h1ttEUwU6jLf2oc1740477548', '258630', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-25 11:59:08', ' ', NULL, NULL, NULL),
(127, '2502253QdWUqpRzFSENcqeaA9SFJuVCSeAB8Nfgc9E6hiZV3SEGEYMaM1740481458', '252961', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-25 13:04:18', ' ', NULL, NULL, NULL),
(128, '2502254bBNRwjEuEeaiuukngzMc9MUiS4laHf7i3ZvFzuWWHNOHqwFih1740484761', '255257', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-25 13:59:21', ' ', NULL, NULL, NULL),
(129, '250225wPGZwD0vkiuTWKNFHLRKGH4satttoi8Z1eIa08y7e0Ej5nSWmk1740491456', '252858', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-25 15:50:56', 'Trecaz Holding', NULL, 1, 1),
(130, '250225qaeQ1vZgsVN6mV4t1dfdojVuFZWHFDNi2oHV73EfAgqAKA70FH1740494849', '252397', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'login', NULL, '2025-02-25 16:47:29', 'Ditotase Business school Preefina Rubuz', NULL, 8, 9),
(131, '250225BMt1KnqnTbgL1rLWFMHN6lFIMFfPH81nweTPHtvg4VQKoIrUDV1740495103', '252447', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'update', NULL, '2025-02-25 16:51:43', 'Ditotase Business school Preefina Rubuz', NULL, 8, 9),
(132, '250225dDgIBnFWwWbYOCH4srAyUTH0hzLGfHgnHc21Azae1yqM55AyGP1740496864', '257280', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-25 17:21:04', 'Ditotase Business school Preefina Rubuz', NULL, 8, 9),
(133, '250225q3ssvavFs3ySfpaaGIeikr6v2uab2Sa8kFA4YJMDUYS1QUqfDn1740497009', '253153', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-25 17:23:29', ' ', NULL, NULL, NULL),
(134, '250226IOd1VLKt735iRcj9ydYVLcfVVNlHZZZ0PWdRCk9QiSqAGCHIkF1740552235', '257189', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-26 08:43:55', ' ', NULL, NULL, NULL),
(135, '2502263HYzpLW1GG4C4IuTyelM4GsODYwdOdnoJlwBZwZ6AkEGeVo84h1740552272', '257694', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'login', NULL, '2025-02-26 08:44:32', 'Trecaz Holding', NULL, 1, 1),
(136, '2502266JyPVjSeFPC1LiJR7rggKuN7nTIin7hM5s7vVkZvzqO8d7iZC11740554036', '251929', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-26 09:13:56', 'Trecaz Holding', NULL, 1, 1),
(137, '250227iHAQKtjWDqW43kzCFBuOphi5EHHqSc8DJ5wsA3dmu6dWMUJPzZ1740659881', '253473', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-27 14:38:01', ' ', NULL, NULL, NULL),
(138, '250228B0Rk8cufvmMWkJaTgaJhU9sDqAgWYinC50CHkaiJd95qyUCkUt1740727790', '255619', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-28 09:29:50', ' ', NULL, NULL, NULL),
(139, '250228ePMdhl5BmV7wfWg6rUN7OFR89EvYUe9rlHqIcQdWDowt6OSjg41740743696', '258568', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-28 13:54:56', ' ', NULL, NULL, NULL),
(140, '250228VCe2kycuIVYaCSaOcySE9CuR6rlSrLhjEfVVIqNperjIskniwC1740747965', '257743', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'login', NULL, '2025-02-28 15:06:05', 'Ditotase Agency', NULL, 7, 1),
(141, '250228qo8va6OfaFJQDnqgifm1lAZ9f5awzAaTLBL5LhdyH6y8beJ4wr1740748195', '257870', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-28 15:09:55', 'Ditotase Agency', NULL, 7, 1),
(142, '250228RWTFNM3cUpbt4NwO7pszMYRi4AWorQeCnOn6qi6E9zTc79DFjN1740749539', '253396', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-28 15:32:19', ' ', NULL, NULL, NULL),
(143, '250228g34vUUbm1DEADptO5bNNEHCLrO8mr6YltnfR350lplPW8WMq0k1740749548', '251804', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'login', NULL, '2025-02-28 15:32:28', 'Ditotase Agency', NULL, 7, 1),
(144, '250228LLvJEYYimK8rV51DiC2sAJD0UnRdDj1OEbjlCTKEVs5ueYnlkG1740749599', '258171', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-02-28 15:33:19', 'Ditotase Agency', NULL, 7, 1),
(145, '250301KCynb044K6DHfAZQUzujOyVE99PFqj8B8QjDBDcph0kkU27DSe1740814777', '254618', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'logout', NULL, '2025-03-01 09:39:37', ' ', NULL, NULL, NULL),
(146, '250505UzO5QNIvRHYgtIWKOAob0rsWH1clriyjIqhDNTTOTwmq86jzwM1746448859', '253727', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'login', NULL, '2025-05-05 14:40:59', 'Trecaz Holding', NULL, 1, 1),
(147, '250529O9FzRy3Dao3dICaZzKnK9DRrb6Jcp8wY7Kh5Bien0r2UIiV7my1748507457', '250258', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'login', NULL, '2025-05-29 10:30:57', 'Ditotase Agency', NULL, 7, 1),
(148, '2505300vQ9fZBQsh0UpMR4zdduKqhbcpUgdTIFlOp1GUoAeClcForPdR1748594143', '257290', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'login', NULL, '2025-05-30 10:35:43', 'Ditotase Agency', NULL, 7, 1),
(149, '250530zvfEk5836z5EratNkgCf5Ku8jMBJa3vu15yoMa7kKbsUwG5Ldh1748616834', '259676', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'logout', NULL, '2025-05-30 16:53:54', 'Ditotase Agency', NULL, 7, 1),
(150, '250602O8JilRtGLv63ECmp28mtMgF1g1NOYJDbM32GCMUzczS4GrQh4U1748853315', '253786', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'login', NULL, '2025-06-02 10:35:15', 'Ditotase Agency', NULL, 7, 1),
(151, '250602JEkzBLhk4tPQRdl38J8y6riTkNmmMKgbZZV6Z2UiGfzfJTL6QI1748864368', '254729', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'logout', NULL, '2025-06-02 13:39:28', ' ', NULL, NULL, NULL),
(152, '250602Qf8ugBszUgt8FN7WDoQ9V0KCcNQGlqYY8La2M7TksVrA96zS3u1748864439', '252383', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'login', NULL, '2025-06-02 13:40:39', 'Ditotase Agency', NULL, 7, 1),
(153, '250602bHy919zIDscWwuFoOpr70py0qFIq90UPsTr41F1nVZYvoZMyIE1748870611', '253617', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'deleteteacher', NULL, '2025-06-02 15:23:31', 'Ditotase Agency', NULL, 7, 1),
(154, '250602mGZWO85LBhhLJMmlZRDf6BVqskshilSsRoK8QD0FigDkv9nUfr1748870620', '256563', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'deleteteacher', NULL, '2025-06-02 15:23:40', 'Ditotase Agency', NULL, 7, 1),
(155, '250602AH4RG4e3ofHDSg7YJM647LqVYRD9WsmzyAcWNltRZRZkcgADUs1748870670', '251416', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'logout', NULL, '2025-06-02 15:24:30', 'Ditotase Agency', NULL, 7, 1),
(156, '250603PIvwjv6tGpJctyq1MkjjicZfYTR51dSC4m1THbGDwPnlttTf0n1748938767', '257749', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'login', NULL, '2025-06-03 10:19:27', 'Ditotase Agency', NULL, 7, 1),
(157, '250603SmC5foKglEsFj03VoDf0aZ8irchL97CAzuLHBtjBezghyD5UY11748950594', '251319', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'logout', NULL, '2025-06-03 13:36:34', ' ', NULL, NULL, NULL),
(158, '250604DUtaPq5ma6NpAoEBB1ruZDQ7VEhaRbYIQP2MWop4IjOKsrr1m91749023445', '255021', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-04 09:50:45', 'Ditotase Agency', NULL, 7, 1),
(159, '250604AkfiaJpop4znvr2KtQh5AkL2dllk5G37rWRLDJLB4BftDKOkrW1749040495', '252705', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-04 14:34:55', ' ', NULL, NULL, NULL),
(160, '250604IozmRv4iTSFl5k6mKsLk8j9s21wirK0Cej02IoOLdQIRuZJHQ21749040513', '250271', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-04 14:35:13', 'Ditotase Agency', NULL, 7, 1),
(161, '250604VZZ84fdvvy2cRwaITSeCtKDwLcPNHNmT4ApPmtPo4qA10sT6iE1749047967', '257032', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'deletebranch', NULL, '2025-06-04 16:39:27', 'Ditotase Agency', NULL, 7, 1),
(162, '250604wc41BrOoFFvwSoFSmhJlOGkuasyqMPmsRWu2iST6Et0Q5D36HJ1749047987', '254872', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'deletecourse', NULL, '2025-06-04 16:39:47', 'Ditotase Agency', NULL, 7, 1),
(163, '250604tIpsORcMH0h5UH3yuZdCZqOPBi5g2U6Wbk5I5kzPUL6z6TlMFp1749048129', '253350', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-04 16:42:09', 'Ditotase Agency', NULL, 7, 1),
(164, '250606RIIuzAdcE5Q0iz6ALbhZEWgmYWAZZd7i3EY2kEWq15VrU3Lk6Y1749196874', '259745', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-06 10:01:14', 'Ditotase Agency', NULL, 7, 1),
(165, '250606idHzyFYYFRfEie4UCKg10FCu8etAovFE2HyD2BNURe7cdoOEmp1749208164', '257669', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-06 13:09:24', ' ', NULL, NULL, NULL),
(166, '250606uC2douH3ekgBrpAfSqvCJif13vO5Ed8RoqtFWk2LyAddBMmkIc1749208176', '257591', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-06 13:09:36', 'Ditotase Agency', NULL, 7, 1),
(167, '250606lOmHiY7bansFkkuGJ0T0Ml0hwihT5KTaOvaOE4ccSRbwYveAbF1749212767', '251041', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'deletecourseclasses', NULL, '2025-06-06 14:26:07', 'Ditotase Agency', NULL, 7, 1),
(168, '250606OD87owiRtPskPpzk08vJegQ6e0tbyYptrl7UnnYIDtisCheAQd1749220353', '257813', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-06 16:32:33', 'Ditotase Agency', NULL, 7, 1),
(169, '2506075MnZaa8eWqAp9Mlgl7jPT8KuEVdo5ZgPr9apcTdTOGUtchQqDV1749282932', '250135', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-07 09:55:32', 'Ditotase Agency', NULL, 7, 1),
(170, '250607PhLfpvfLJOt2Gmfl8YbAkzF24Po0OT33O9oWikgWC7QHjHpNfY1749302142', '255545', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-07 15:15:42', ' ', NULL, NULL, NULL),
(171, '2506090BBiyiMGFQUK91qayfVRJKwOWtKRRttwTamhH6sLov7SZm0gur1749451491', '253558', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-09 08:44:51', 'Ditotase Agency', NULL, 7, 1),
(172, '250609b6YVBfNRQJyU0JIeVdszPM8eefrh3073eIUAKApnkK2vfhEq0c1749465080', '254917', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-09 12:31:20', 'Ditotase Agency', NULL, 7, 1),
(173, '25060990wvo5Cr40akG6HjhmPoNNOcVd4rUlLY3hWaHQmHesnEQhOGMR1749468920', '256805', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-09 13:35:20', 'Ditotase Agency', NULL, 7, 1),
(174, '250609tosWzHvIbqTAuACHkmGISDbUNSU02RM32iWiysPsIHrt7tS8wV1749469069', '254260', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-09 13:37:49', ' ', NULL, NULL, NULL),
(175, '2506097aSQUpgQ92PCSVAedHeS5E9wG8MupirFVv9940ghNmMoDFlU8D1749470569', '250762', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-09 14:02:49', ' ', NULL, NULL, NULL),
(176, '250609lGD24V0OHV4nQd0UJ1SYCqTWcKLucPrLAlyPB6ylcTUZFlUZKZ1749472932', '259467', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'deleteschedule', NULL, '2025-06-09 14:42:12', 'Ditotase Agency', NULL, 7, 1),
(177, '250609YrnVk2niWAFueL32mJuf2bqkUf00bd2uD6DBF3ttUiFOYd4cR91749478919', '258734', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-09 16:21:59', 'Ditotase Agency', NULL, 7, 1),
(178, '250611JQFWvrq0Otn4cVwoce6QoJGqYdSJ1PNvhqgtFt8v41L0GZRqKZ1749626618', '256316', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-11 09:23:38', ' ', NULL, NULL, NULL),
(179, '250611236VmoFHryvIpYs9SJICKFiSQEdJutfTRB77fNeVSYVwm8whZH1749626638', '252345', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-11 09:23:58', 'Ditotase Agency', NULL, 7, 1),
(180, '250611wSCrIU2BPcWhntVecYsyGN74IOqmmFH10iidFL2Ev2Rs2buqr71749629608', '258983', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'deleteavailability', NULL, '2025-06-11 10:13:28', 'Ditotase Agency', NULL, 7, 1),
(181, '250611pLGdfDpn6MfZfdtN1Dcq8BOZRWns0pAH1WtidT7noi1LPWI4KI1749633019', '256373', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-11 11:10:19', 'Ditotase Agency', NULL, 7, 1),
(182, '250611TLD6HivJiHDtStCwGEpqHhunKbEVizNciIhhquKT8zAmHL8NqR1749633034', '253204', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-11 11:10:34', 'Ditotase Agency', NULL, 7, 1),
(183, '250611kvia9OZEgy40ZB1MCjN1uA7neA7RIEopKwWmeiRbnAWRidgw1P1749645485', '259011', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-11 14:38:05', 'Ditotase Agency', NULL, 7, 1),
(184, '250612ZhbVcH1ic6E3cYFJowVKikmZiBmBq4KzGlRevlCWI1dyQ5vNem1749719125', '256786', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-12 11:05:25', 'Ditotase Agency', NULL, 7, 1),
(185, '250612o9G0ervbaMLG9ZmHBTQVW2WT5cJQtjWKJuNeaNDLcMlBYoSBhe1749722471', '255794', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-12 12:01:11', 'Ditotase Agency', NULL, 7, 1),
(186, '250612YRmVSaFmnSMIjvooKllZMb6PQh6mVtLsf6q6UpEGl6LVrBLBgb1749726472', '250158', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-12 13:07:52', 'Ditotase Agency', NULL, 7, 1),
(187, '250612bmlT6aOmPKQv0VubOFrtVV5zWOL0VBzFpMGfst6Ap4ttqAfeCH1749733405', '251109', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'deletestudentquote', NULL, '2025-06-12 15:03:25', 'Ditotase Agency', NULL, 7, 1),
(188, '250612b5F0vGSlKcmwT88ZQuQ6U9pe4SUROCr0GFaI5U3RkVO6JoKjNA1749744684', '255930', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-12 18:11:24', 'Ditotase Agency', NULL, 7, 1),
(189, '250613DJZGjQMqLekgHwwy4KlvavlHhIJdw3ozy4LcqELD4wY57ycIl51749799713', '253425', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-13 09:28:33', 'Ditotase Agency', NULL, 7, 1),
(190, '250613Q3VMtYTqMUAqqkeDtgHo9VLGyoHfcGHifUcv8rRrqIyQiNRrum1749830222', '250558', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-13 17:57:02', ' ', NULL, NULL, NULL),
(191, '250613NgGWidqNlZYUg5iNEA8gAFZdlkjoqOd5KEP8GDDd9OSKFc6kl21749830232', '255457', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-13 17:57:12', 'Ditotase Agency', NULL, 7, 1),
(192, '250613Qe5pumtek4RWU6iiYBV6gCfFqOUOZqbvbKJ8CrN346C5DPTMWC1749832055', '258734', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-13 18:27:35', 'Ditotase Agency', NULL, 7, 1),
(193, '250616eVmmFrUFzpWdA81Pktq8GBdR7BRrrWOP9R05LRnUO9Y44ZEJJj1750059918', '254576', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-16 09:45:18', 'Ditotase Agency', NULL, 7, 1),
(194, '2506166hvNs9smnu5VLVkrwJL8Cn3hG4lrkc0YcjvUumS7zTtqoeIwOy1750077714', '258110', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'deletecourseclasses', NULL, '2025-06-16 14:41:54', 'Ditotase Agency', NULL, 7, 1),
(195, '250616Bnd38debItmMkAa4EkfI5nnAOAjIrtINK5aW1Uvu80AFrDwNYd1750077722', '257883', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'deletecourseclasses', NULL, '2025-06-16 14:42:02', 'Ditotase Agency', NULL, 7, 1),
(196, '2506161HWeiKOy4E4gYLss0KwBYNhefvcQHRG2ProN6L67ZnZwZUDc8b1750077726', '257450', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'deletecourseclasses', NULL, '2025-06-16 14:42:06', 'Ditotase Agency', NULL, 7, 1),
(197, '250616h3O9gYJlbfQ4pf2stDKjGTlKSSVp4TIniapMiA70DccCVaFZGD1750088699', '255574', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-16 17:44:59', 'Ditotase Agency', NULL, 7, 1),
(198, '250616czulpA6A0u3liOh1KqciWFiUcFyVaoMeCUyhqok0Hi3kYfIrpe1750089111', '256658', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-16 17:51:51', 'Ditotase Agency', NULL, 7, 1),
(199, '250617uBi3K7sQUFEqqem3wAKr82QUqc0tM5mnRZIZENfRMQARlVSEL91750161297', '253168', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-17 13:54:57', 'Ditotase Agency', NULL, 7, 1),
(200, '250617caImNvPRHI7BDTucEppRypKDMwHr2EqHHodT1iGi16cU4aFJpN1750175167', '251046', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-17 17:46:07', 'Ditotase Agency', NULL, 7, 1),
(201, '250619ahjtIt53gQClqi4iSI1MEYyKQ1EZSLTd6IIsGdq3QdgaDkI4Pw1750318332', '252203', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-19 09:32:12', 'Ditotase Agency', NULL, 7, 1),
(202, '250619ZU5or7AAmCrImchpAatiwOYuNCpyDWTUgAgnwK17T61OyJH9131750335675', '250766', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-19 14:21:15', ' ', NULL, NULL, NULL),
(203, '250619FoP84pl2ijp7LOg9DQDEVdfAjQNkcNHJps1zLlWtrtdh06y9LY1750335685', '253176', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-19 14:21:25', 'Ditotase Agency', NULL, 7, 1),
(204, '250619JU7huETM02jdgofzaBbWoZjlZT9lwRqGvLliyL45dzBqfEweYu1750344569', '252528', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'logout', NULL, '2025-06-19 16:49:29', 'Ditotase Agency', NULL, 7, 1),
(205, '250620NCoPfFPbChAik23beurdv9HpaYO5JSd9AG3OPktedj2j8yU8gv1750419260', '250538', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-20 13:34:20', 'Ditotase Agency', NULL, 7, 1),
(206, '2506244E3RzeRBggyHKRbQcWEdWpcUHmbFHTvNqcVBHHGUWEfDdH3apr1750779244', '257880', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'login', NULL, '2025-06-24 17:34:04', 'Ditotase Agency', NULL, 7, 1),
(207, '250704qodASviL51kOjVbqi626AKKP2aQk2NoUfO5qQ4uhuYvEaIisbR1751633620', '250941', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'login', NULL, '2025-07-04 14:53:40', 'chipeng rubuz', NULL, 9, 1),
(208, '250704uzz70rASg1plU2vuyGIgcUte3hzQUq08hY7ar60qY66TwdARMQ1751633836', '256015', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'update', NULL, '2025-07-04 14:57:16', 'chipeng rubuz', NULL, 9, 1),
(209, '250704cFBQtwyLKenK7a0fIoQEY2FTjmJnEMz3uYf8QUKJYuzQ2i0wjK1751633879', '259347', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'picture', NULL, '2025-07-04 14:57:59', 'chipeng rubuz', NULL, 9, 1),
(210, '250704YY51qsPCbf2FoPCskY8pNA8hS8Ljhcd9KEru4r2umE8OJAIIQK1751640398', '255001', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'logout', NULL, '2025-07-04 16:46:38', ' ', NULL, NULL, NULL),
(211, '250704cwvWuODzhwpu6WZcyWHijyZy2sHIz7JMZbpSZkCZ3kUdhKfKkU1751640414', '253926', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'login', NULL, '2025-07-04 16:46:54', 'chipeng rubuz', NULL, 9, 1),
(212, '250704MCA4GFGW6KP7hd7nu81Kh5k4UF0yDTGpOlf7Zjn1NSHwAf0luL1751640421', '257074', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'logout', NULL, '2025-07-04 16:47:01', 'chipeng rubuz', NULL, 9, 1),
(213, '250811FK0ClRFRYBLY8aF4Mk8Jvu03NhzW3lOUEUz5GetCBifs9JAlwr1754917323', '253701', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-11 15:02:03', 'Ditotase Agency', NULL, 7, 1),
(214, '250811f1jqA4PSlBsIJjTLcJditFzBvYRFb3mDvIdBriwjB8hgU7GERK1754917323', '259963', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-11 15:02:03', ' ', NULL, NULL, NULL),
(215, '250811OIaYuoeFKWNslRT5bFsEnFUiByZyf6FyjaBNRq6o91PqQAyAjm1754917424', '250655', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-11 15:03:44', 'Ditotase Agency', NULL, 7, 1),
(216, '250811zVoK9A9GtFGiWe7AOhoQpMCui8ANKfReUQbmiRkQCyPlBoLzR71754917433', '250690', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-11 15:03:53', 'Ditotase Agency', NULL, 7, 1),
(217, '2508112LLcbvGtL0Ry80wGmDhIzlomKPElM0UmcAMsJIW81R9Stsd9vv1754917441', '255887', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-11 15:04:01', 'Ditotase Agency', NULL, 7, 1),
(218, '2508113lmghuO7FoDPqjvrR8D2svsAmcub89LeT2WuIC59yliGpF9Emu1754920021', '256219', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-11 15:47:01', 'Ditotase Agency', NULL, 7, 1),
(219, '250811hTq1WECqYvO0SdRHiWuF4ocq32CPpHh6f5Oy4QaAPhsFWBzP7z1754920301', '257513', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-11 15:51:41', 'Ilunga Ilunga', NULL, 10, 1),
(220, '250811E9Kan8UMS2BEEog3cnQDPcKRZId9O2HoJPmavhDDKQmf0kyKLB1754922687', '259177', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-11 16:31:27', 'Ilunga Ilunga', NULL, 10, 1),
(221, '250813DMyzwYYfCVcNhZ2HcAViGjYdT8uib1oCCV2uUm9g9hARCpmjgK1755100190', '255353', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-13 17:49:50', 'MILINDI HUGUETTE', NULL, 11, 1),
(222, '250813sUW810WMyMFsrf3kzv4KZRJBucrPfvtyoeP4cWDtpAyjn67gtN1755100237', '253716', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'update', NULL, '2025-08-13 17:50:37', 'MILINDI HUGUETTE', NULL, 11, 1),
(223, '250813ntJaact8JiNgWe7tr1f5boUA7y8iLMWHloU5knqQpnJ7GjyQLL1755100526', '255705', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-13 17:55:26', 'MILINDI HUGUETTE', NULL, 11, 1),
(224, '250813EA9lRWCCVavnKaiEBMpJRp6R3l6Te4jZoiRzwzi10hNq1PBGTU1755100542', '256723', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-13 17:55:42', 'MILINDI HUGUETTE', NULL, 11, 1),
(225, '250813zikpPqfgbHU49hjV1mufD3y2kfYh3VoIU4cB33rGofythsEBze1755100602', '251688', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'picture', NULL, '2025-08-13 17:56:42', 'MILINDI HUGUETTE', NULL, 11, 1),
(226, '250813Zc0Q90FmczhRSkwdSzzLbuusFQnjLCQ7nMLtoUjcCrHm7yaBlQ1755100883', '259253', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-13 18:01:23', 'MILINDI HUGUETTE', NULL, 11, 1),
(227, '250813UB75EooP3V5ccG7wbaMOPbFTgCtDRTh6aeCWWSeaB9FSbl5yUF1755100953', '259130', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-13 18:02:33', ' ', NULL, NULL, NULL),
(228, '250813AjUa2csDnf6rORifECWnvwUFhkv8C3rotaOjn6z1qgiTbr1y4P1755100961', '258541', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-13 18:02:41', 'MILINDI HUGUETTE', NULL, 11, 1),
(229, '250813qLYCcPyIJ1R5wJb56a8fJQBgb5N5z4M7dUVpngtfe9dOTRdgm21755101486', '255642', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-13 18:11:26', ' ', NULL, NULL, NULL),
(230, '250814s53DPHLzlPfuMM5gdkfasmuSPvgfOojKKaFEMi7UEAcHbtcokM1755157038', '259033', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-14 09:37:18', ' ', NULL, NULL, NULL),
(231, '250823miO72P2N73pM8pMAz9rmgkIeLogtHTPO0yb2UheJuJqCthNnjj1755943184', '253478', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-23 11:59:44', 'Ditotase Agency', NULL, 7, 1),
(232, '250823QQMaWUzQwnmNTVrU8YjQDMIsRMrvIKctGKgCQ43hfbAdTAsDb71755943270', '258203', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-23 12:01:10', 'Ditotase Agency', NULL, 7, 1),
(233, '2508233JkZFgGjHgjhmlmnt2JcDMKLwWBkAPBjNK7uqVfSqd4diJNzc61755944385', '258617', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-23 12:19:45', 'college Trecaz Preegana Rubuz', NULL, 4, 4),
(234, '250823FToEEjpYH58YQcDeKPVssCjVrMDlYF3ZZGTU3LzLtGAkMEBd3A1755944385', '253841', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'reset', NULL, '2025-08-23 12:19:45', 'college Trecaz Preegana Rubuz', NULL, 4, 4),
(235, '25082392W77E63n5OwGsLJ65pbM74n6v5PqYf82TlCM8jHAKM1ny2Ncf1755944647', '258634', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-23 12:24:07', 'college Trecaz Preegana Rubuz', NULL, 4, 4),
(236, '25082326NZOKvj1odE1mjmq9AC8ndItsoD5Oz3T500QV7N3NsjyfAepK1755944752', '257970', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-23 12:25:52', 'college Trecaz Preegana Rubuz', NULL, 4, 4),
(237, '250823pqPVSE5bAr3KK9O5ecjkm8D1M93lKlLCfjw9OQbmYkwDPb7q891755944752', '252890', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'reset', NULL, '2025-08-23 12:25:52', 'college Trecaz Preegana Rubuz', NULL, 4, 4),
(238, '250823SBVDKvfORiCiWjogiAaFnOkNTIeyDarfJ6cOd1KUue5sZtqi0i1755944782', '254840', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-23 12:26:22', 'college Trecaz Preegana Rubuz', NULL, 4, 4),
(239, '250823EGTM0tkoF4vsQprOSLifTpnqnrvISebGhYwvLCpMUYIcPTplO21755944792', '254204', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-23 12:26:32', 'college Trecaz Preegana Rubuz', NULL, 4, 4),
(240, '250823DyVsUZuc10f2Htu4YBt96fewF7Za4jdkbow0prGlCSMCOw8hsH1755944922', '259479', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-23 12:28:42', 'college Trecaz Preegana Rubuz', NULL, 4, 4),
(241, '250823nJniRDZRYOP0vY8NFyeIaP4CYEspk1yjjIvSfLmB35SCmDztaz1755944987', '255949', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-23 12:29:47', 'Elie Mwez Rubuz', NULL, 2, 1),
(242, '250823YWTG1bWMMHG0DecvTyJYIQJmtNeriT32z0bl44ShviHrp926YW1755944987', '258157', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'reset', NULL, '2025-08-23 12:29:47', 'Elie Mwez Rubuz', NULL, 2, 1),
(243, '250823NmsCWEyDPvQB8kRn3fu8EiHouaIiSkoqmT3I3rvtFE8SYjwCNH1755946772', '259083', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-23 12:59:32', 'Elie Mwez Rubuz', NULL, 2, 1),
(244, '250823zcr92Wnij96G2zzREUnNgpSVVWvH9WecrhdCEm3RTRYbTmmz6Y1755946781', '251224', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-23 12:59:41', 'Ditotase Agency', NULL, 7, 1),
(245, '250823iFI3rYGnV3CYmjGbtDbTtyLsDhcrC4jbBrqKacZhIWCqnhFIA91755947011', '253589', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-23 13:03:31', 'Ditotase Agency', NULL, 7, 1),
(246, '250825bv4tQwD1DAgSYb6FnIcc1fDzTD9ujYkItO4SvEhYknNsCk9Rbw1756131264', '255152', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-25 16:14:24', 'Ditotase Agency', NULL, 7, 1),
(247, '2508258AqQUfNwFoSQ4l1YrDfObGowhWMepQrsYKNrOFNKPquTcqdOVw1756131376', '255957', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-25 16:16:16', 'Ditotase Agency', NULL, 7, 1),
(248, '2508251V7Bngr2GUBvFDhvc0EKh2IYaCvO75qBFW1S0gz3h2727LDtMF1756135534', '254649', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'login', NULL, '2025-08-25 17:25:34', 'chipeng rubuz', NULL, 9, 1);
INSERT INTO `users_activities` (`activity_id`, `activity_token`, `activity_code`, `activity_ipaddress`, `activity_device`, `activity_platform`, `activity_status`, `activity_type`, `activity_notes`, `activity_created_at`, `activity_created_by`, `activity_deleted_at`, `activity_user_id`, `activity_school_id`) VALUES
(249, '2508254cGmqomKGS3m8jnOWLF3BdkGHZT5zRY2GziNZKEOpjBJKpm07c1756135554', '257294', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'logout', NULL, '2025-08-25 17:25:54', 'chipeng rubuz', NULL, 9, 1),
(250, '2508266ZtVcNhhw6ZN8N81ObhaTI7gpUb1P4oYO51o1J1zgA43tC1Vk41756197110', '252232', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-08-26 10:31:50', 'rumbu chipeng', NULL, 14, 1),
(251, '250826j8L5FZRhuqc9wOmOA37i1ukDNAV3SM9bGkKew376cQpEKhBL3B1756197457', '253292', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'update', NULL, '2025-08-26 10:37:37', 'rumbu chipeng', NULL, 14, 1),
(252, '250826g2iF58YdO2KNcSAkDau9OyvIaRbLtECNRrEC5SM3VlY6RkGypG1756197474', '256121', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'update', NULL, '2025-08-26 10:37:54', 'rumbu chipeng', NULL, 14, 1),
(253, '250826PZYrHssPLg8mpJlHn8Im71EKoYGBWiqhMZUvmeM5G1y7bm2gS11756197491', '257104', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-08-26 10:38:11', 'rumbu chipeng', NULL, 14, 1),
(254, '250826b7FYJv7SJDJDS1tjBKRokyeVmz7QhpbR6zAu2k8I6mgD9k6SyL1756197508', '258700', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-08-26 10:38:28', 'rumbu chipeng', NULL, 14, 1),
(255, '250826vJ2dUFq9a7n3vV2lSmuwGhEWdORk28Td7LsltPIu0Y1ZwnLqEO1756198830', '257877', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-08-26 11:00:30', 'rumbu chipeng', NULL, 14, 1),
(256, '250826ay4CaekKbDzVj5pBkeUjcWoKK3SgIv5WMubgIc7uBkJrj27z3b1756198846', '253455', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-08-26 11:00:46', 'Ditotase Agency', NULL, 7, 1),
(257, '250826IjDHVQP0bFOrgQuOen6Qi6NWEj83EyeB633riKPYGBnLvG6kbe1756211912', '259368', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-08-26 14:38:32', 'Ditotase Agency', NULL, 7, 1),
(258, '2508264Rt5gY8KmQm48O9IgiPbiHegLUAY38dQuLn89NdQNiD5ipc8Oa1756218150', '258297', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-08-26 16:22:30', ' ', NULL, NULL, NULL),
(259, '250830eZPbw4mP6o4vnjmGsMzJGuFZm7C6uEf576c1zmoldVTFGyn8k91756540976', '258531', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-08-30 10:02:56', 'Ditotase Agency', NULL, 7, 1),
(260, '250830Lu7WcLqMAhiYpIeBRbToQVGTJesaOtuBK1mpyFJNak4vl3AV491756547390', '255848', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-08-30 11:49:50', ' ', NULL, NULL, NULL),
(261, '250830WkWuBZds99bRHEbkZ57U6BnB2rprAfCkTqeJZhG1Fp37ZN9Ofi1756549312', '256737', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-08-30 12:21:52', 'Ditotase Agency', NULL, 7, 1),
(262, '250830JOmH7mvNrqE1qh6lQj7IpAfK8vLR7yWqLRyJpbAWS2helZco8q1756549402', '252737', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-08-30 12:23:22', 'Ditotase Agency', NULL, 7, 1),
(263, '250830kVQmYRmwQ6lSvJdGF2vIziAJRgYNcmZGy55BaDeuSqpIMo3fyC1756549475', '259260', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-08-30 12:24:35', 'Ditotase Agency', NULL, 7, 1),
(264, '250901ojnYC3SrGDkSQReZv0LihijNTqb4arTVbcjIJOazv3Qg0pgw7e1756710287', '259010', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-01 09:04:47', ' ', NULL, NULL, NULL),
(265, '250901OWrWisI4LA0pGwDO2TCojlcWzysBe2fe9EYwseKADniTIeWrjn1756711006', '251208', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-01 09:16:46', 'Ditotase Agency', NULL, 7, 1),
(266, '2509017k2OnAL4Zm22dfcOzHkpoZQnHh4fGVUdS1LEBO18A6vmI1tJq51756711262', '254275', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-01 09:21:02', 'Ditotase Agency', NULL, 7, 1),
(267, '250901CQbrqnwsShEFEegl2AmrhNGvAypOc7Ia8BUq2Gc2HikY8CHIp81756711272', '255357', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-01 09:21:12', 'Ditotase Agency', NULL, 7, 1),
(268, '250901FZ9f4bvEatJVJR7u8WpoWQ5nwNqlAuPryQUWsfT4cIiA4msr5L1756719135', '251327', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-01 11:32:15', 'Ditotase Agency', NULL, 7, 1),
(269, '250901FR8NSnk26H27qyZNQ4uv49bBS5M7qDUglPgsOf60UwkHYeFHwv1756720187', '253804', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-01 11:49:47', 'Ditotase Agency', NULL, 7, 1),
(270, '250901hbTA7158ISKI9q83C2oNJ8Jz7mRDGzrdssRYJz1zEKkV29EY5G1756721703', '252322', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-01 12:15:03', 'Ditotase Agency', NULL, 7, 1),
(271, '250902UQA4SDgUoAbOumSfOZWRSVEK44UAD5f0KYfSKSwT7emoM1pdKS1756822660', '251719', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-02 16:17:40', 'Ditotase Agency', NULL, 7, 1),
(272, '250903wcR2LeFL2Q8c8skAnBnDLkpUQldiYdSYESHhjFLN0wqjfJTMzU1756883830', '256756', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-03 09:17:10', 'Ditotase Agency', NULL, 7, 1),
(273, '250903kT69HpvcQItCBphVolfkwpGytCqeMzCCMiJI8pkDroDd50B1a71756890935', '257493', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-03 11:15:35', 'Ditotase Agency', NULL, 7, 1),
(274, '250903c7g0nHfMpk5soZcVKzjc6vln3GfvNwmvnOLQFNEseoIK1zC0rg1756890950', '254583', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-03 11:15:50', 'Ditotase Agency', NULL, 7, 1),
(275, '250903MmrUBOhcCwNLKYD7mwHf39c2UFbl8VMRUpzqHTDGN22sVF6E7I1756904449', '252492', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'deleteevaluation', NULL, '2025-09-03 15:00:49', 'Ditotase Agency', NULL, 7, 1),
(276, '250903yz4Zlm61yWaywHZZjVNQnuLaIFbhN13G5RG4FSQOwMsuuv0tpQ1756908715', '258594', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-03 16:11:55', ' ', NULL, NULL, NULL),
(277, '250909GGt23B1ie8hBwSWfazvEHq17SVvc49t5rHpZIYYg8BZ3kZPkHT1757401973', '250938', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-09 09:12:53', 'Ditotase Agency', NULL, 7, 1),
(278, '250909hmqShMOdTmvIdJ2w95KLPtIE4ZvQ49Or4eGqThcCIZjWcMzwi91757403248', '255210', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-09 09:34:08', 'Ditotase Agency', NULL, 7, 1),
(279, '250909sstqZkNfyM8cpCuCCsVlvK9YmnfUW5rRmHMzV7aHy7Dzu4Wn5L1757403263', '253634', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-09 09:34:23', 'Ditotase Agency', NULL, 7, 1),
(280, '250909ZRKNa9W8rAE5BerGgfWrcWP8SuJvsnhaGWthA4fSOE7GqpJhiG1757403455', '255028', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-09 09:37:35', 'Ditotase Agency', NULL, 7, 1),
(281, '250909RFPjngW2ndJrmjsszfJymRPqBlSTbF63dOcKN5AmnVfBabKDaw1757422921', '254995', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-09 15:02:01', 'Ditotase Agency', NULL, 7, 1),
(282, '250909W5UQ7m09443AIvCPREp26GTklydSms2pO3sQGQjlvCpoLk86ze1757423243', '254764', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-09 15:07:23', 'Ditotase Agency', NULL, 7, 1),
(283, '250916dVNQWnoSCLrhVNjLNouztfiYZ2SMLM83sWmCmJEwzGlQ3B316g1758005519', '258416', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 08:51:59', 'Ditotase Agency', NULL, 7, 1),
(284, '250916lRFHACE7tvqpjk3aamUCCUKokulCU8IbqbPg7ZmRnypYr4KuHZ1758029029', '252495', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 15:23:49', ' ', NULL, NULL, NULL),
(285, '250916JTMkg7e04L16WNlsoYJhQKokwJVAHY7loyvwWMVQp1uqADKEUW1758031466', '256060', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 16:04:26', 'mboso ', NULL, 15, 1),
(286, '250916MWTJHAp8807pRgSnJfWLnsUWcJH59nicIOOtlG1CBA2LZYldWT1758031632', '258203', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 16:07:12', 'mboso ', NULL, 15, 1),
(287, '250916kLOSge9zzESCtEQCjQ44G95fPvQGd8UTUU8PgT5ZRPTlaNfIJ71758031640', '252089', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 16:07:20', 'mboso ', NULL, 15, 1),
(288, '250916IPgvKF3jJeqAQS1IQokacfussGkReZ08TLC9HdP00Q1mkJk6a51758031655', '259393', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 16:07:35', 'mboso ', NULL, 15, 1),
(289, '2509166b6jRRZLyW1Id2HWKZFiK6LTiBqa86ajNGYNM4AeFIJ311SvQ51758031703', '258298', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 16:08:23', 'chipeng rubuz', NULL, 9, 1),
(290, '250916rQ8RUAyRFav3taizv9VhAIt5ABgCQ42ZG7sTnOy83YpGC04WyZ1758031734', '255103', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 16:08:54', ' ', NULL, NULL, NULL),
(291, '250916RoeZb80hKqC9zBUkUwIWM2EGpG7yVt1qWW3jWHpQcqRbgMQVjl1758031777', '250181', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 16:09:37', 'chipeng rubuz', NULL, 9, 1),
(292, '250916y9vZiAlHSGH39bCopF9JVSKO9iU7mwLOPD86bAD4jqcj6SiTqJ1758033142', '258127', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 16:32:22', 'COLLEGE DITOTASE BUSINESS chifia jess', NULL, 16, 10),
(293, '250916ibOgbhorLLjuwBroeqKfmMy5P4KcCLD4e9IZNF2ZEoQqNmT6Dc1758033447', '252841', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 16:37:27', 'COLLEGE DITOTASE BUSINESS chifia jess', NULL, 16, 10),
(294, '250916HJagb98sfDGISZdTQl4tLHB1T7gBqMNMbOz9PUjR7LSLKlfSnu1758033821', '253098', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 16:43:41', 'ELIAS SCHOOL ELIAS', NULL, 17, 11),
(295, '250916unUnWkCEdVQKcEw35WKMYhLQWJ4yEyn75j7hm6eoMcJs8EGNR21758033831', '253922', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 16:43:51', 'ELIAS SCHOOL ELIAS', NULL, 17, 11),
(296, '250916ffcqSBofO831PvPTa7jResrIEI62CltUkQ1h2ZzVKqfSTqNM161758033940', '254640', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 16:45:40', 'Ditotase Business', NULL, 8, 9),
(297, '250916F12Jh1GIs6NrWwku9DMteOaLmykgcpEO4stcwIVFjz0waYnNNq1758033985', '256788', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 16:46:25', 'Ditotase Business', NULL, 8, 9),
(298, '250916QrqkTOTknmpSS8HamLBbehOwYtkZibPYc5r7UvowjCQ1CGTW4Q1758034095', '251554', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 16:48:15', 'COLLEGE DITOTASE BUSINESS chifia jess', NULL, 16, 10),
(299, '250916A6IPOwepHTPn6lothUaqYGjvGkFyLdymk8Jg6ssHJ8SMg7wL3O1758034262', '250485', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 16:51:02', 'COLLEGE DITOTASE BUSINESS chifia jess', NULL, 16, 10),
(300, '250916wjahWJrBhPRKSemtN6fycZP1EL2Z1nfb3TlIeqlQAgBickY78j1758034274', '251807', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 16:51:14', 'Ditotase Business', NULL, 8, 9),
(301, '250916KA2DHGzyoSFLpczl3EeoDASBDTHOiN6wPuQ9uelsS46iDTT6lT1758034292', '250894', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 16:51:32', 'Ditotase Business', NULL, 8, 9),
(302, '2509160V81N95hJwBmTdcd9UqpP6YDZQTNTACs1nKhOO8T2fUPW8YPs21758034318', '254494', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 16:51:58', 'Ditotase Business', NULL, 8, 9),
(303, '250916yRgQgQPrSLfqTzEMfAtNzwYFLJIn7EgdP7BzlUAbkkHtk2NltB1758034326', '252407', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 16:52:06', 'Ditotase Business', NULL, 8, 9),
(304, '250916itpgC3Q99ru9sfytPMc5l91Z7p6Rflzts61BB08AE8i8bJlg8B1758035402', '254977', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 17:10:02', ' ', NULL, NULL, NULL),
(305, '250916HJ5JeobsnbaYdeKNlagAvsGs6St6HwP0vmqZmkhgSQWN4PI4921758038658', '255539', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 18:04:18', ' ', NULL, NULL, NULL),
(306, '250916Bu99eQI0GWw6zgWhRr41sdNfbV7CrkiAIjjuSiN2BeVBdWEsbF1758038770', '251463', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'login', NULL, '2025-09-16 18:06:10', 'Ditotase Agency', NULL, 7, 1),
(307, '250916b8i2LvOkkoFwd62t8iifvZ4C10Asn640tTSzq7pwf6GUQiidPm1758038832', '257444', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'logout', NULL, '2025-09-16 18:07:12', 'Ditotase Agency', NULL, 7, 1),
(308, '2509170ZahRE2fmefMUc2iFM6YviBdIWPpACHgJhMy8JV0cP8bPJ84Hw1758095027', '252180', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-09-17 09:43:47', ' ', NULL, NULL, NULL),
(309, '250917ALSMiZv3q7wb1f5HkT7NANQDLdYGnPArOsLEWD8lj5phBP43iP1758095168', '253480', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-09-17 09:46:08', 'Ditotase Agency', NULL, 7, 1),
(310, '2509171R4IMa1mcMC867zZRnvFnjLP1mi1c1KJMknQuotLMC9BEBRpjt1758099168', '253805', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-09-17 10:52:48', ' ', NULL, NULL, NULL),
(311, '250917sR74sSvM2jVOLqrIf4cPPB9y1ocSoehI7NUdljcJwGzaumE3BQ1758099182', '259854', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-09-17 10:53:02', 'Ditotase Agency', NULL, 7, 1),
(312, '2509170L0CO5bg0GST1rjl7epht9iuOb1sevGR19pd9evwvhkmmKJVA51758100643', '253411', '127.0.0.1', 'Unidentified User Agent', '', 'actif', 'logout', NULL, '2025-09-17 11:17:23', ' ', NULL, NULL, NULL),
(313, '2509174GSrS6G0fdsR2n51hUqhqoIuHVqAKiyivhuRA2sOzb9GziCZVV1758100648', '259921', '127.0.0.1', 'Unidentified User Agent', '', 'actif', 'logout', NULL, '2025-09-17 11:17:28', ' ', NULL, NULL, NULL),
(314, '250917SjQpVDlU0F4tdNitjRpLsaMLRNiUq8sCAYz71WRaD9j65hmLKg1758118102', '255307', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-09-17 16:08:22', ' ', NULL, NULL, NULL),
(315, '250917N2wlBEouWZaheIfHWnAZVfqEbMhGyFUbZbUH0AEp4tsgoE4fQe1758118540', '255429', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-09-17 16:15:40', 'Ditotase Agency', NULL, 7, 1),
(316, '250917dDbNvt013sqVQIwzYGFJoNTurq5mrW0K7a8kjwYZigKQWycpta1758120926', '255405', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-09-17 16:55:26', 'Ditotase Agency', NULL, 7, 1),
(317, '250917kg8md54QO6Y9wg5Wb2fPzoPmMSpt94dFlecVCDmG229gfdhNV71758128259', '251765', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-09-17 18:57:39', 'Ditotase Agency', NULL, 7, 1),
(318, '250917Rz0IOaukvgOH8Uuj8OLM5K5lLVtCqus9YVp2PfLi2fuTEoyJgw1758128734', '258095', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-09-17 19:05:34', 'Ditotase Agency', NULL, 7, 1),
(319, '250918l7FrA3dP5QVMfk6GmjAzeGIkuN1mju7waO0zGshfWKe1GvP01S1758178629', '256845', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-09-18 08:57:09', 'Ditotase Agency', NULL, 7, 1),
(320, '250918BnLO6GTJ2UFHDHfmbeAOtGl3KSFkO9WOAq6FbvjL3NBzPZbte91758183492', '252131', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-09-18 10:18:12', 'Ditotase Agency', NULL, 7, 1),
(321, '250919bvNO4mi19GBOBQshMz1bRZRwIc67ARb6oGUrAbV3R3LWjuM5401758287411', '253590', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-09-19 15:10:11', 'Ditotase Agency', NULL, 7, 1),
(322, '250919nveF62Zu1O5ywOF968c2qeEBrERkyYIlj45yyRHk77PNwT0Wob1758288461', '252872', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-09-19 15:27:41', 'Ditotase Agency', NULL, 7, 1),
(323, '250919lgO4WtsjuiTRc77uWhNzLGkMPaO3WRiGkOPoHPPtEOhW60msHo1758288479', '257204', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-09-19 15:27:59', 'Elie Mwez Rubuz', NULL, 2, 1),
(324, '250919uhCscDIdQJSIF3YIAmizIgllSFuehefiUFcWVRiee7j43au1Ks1758288534', '257611', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-09-19 15:28:54', 'Elie Mwez Rubuz', NULL, 2, 1),
(325, '2509239pK2lvUkly6B2Zf1Jv0qLAl9ZfTVt1BPwdaKYfnYZNkpIrQzWE1758608292', '252486', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-09-23 08:18:12', 'Ditotase Agency', NULL, 7, 1),
(326, '250923Y3bQ6KHaZZWkyJaMsuVeyIkdWUlVGZ1c9JIwJZwrvoGjF8UqFD1758611348', '250328', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-09-23 09:09:08', 'Ditotase Agency', NULL, 7, 1),
(327, '250923QZyTJHd37GVfHdzDgNuOjJTiGtylcSSJdQK1Pr6NhMDigTFjoM1758624608', '254065', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-09-23 12:50:08', 'Ditotase Agency', NULL, 7, 1),
(328, '250929d946EJBzoKYkNTdalwwL2CK0jh2CZU755QS1aulWiKgcyPz9wK1759133392', '258402', '::1', 'Chrome 129.0.0.0', 'Linux', 'actif', 'login', NULL, '2025-09-29 10:09:52', 'Ditotase Agency', NULL, 7, 1),
(329, '251006D3tAYNVS0nyBd7ZTLmYhoi3W5VCu56hf2WKskIjRROSba67yMk1759748618', '250651', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-10-06 13:03:38', 'Ditotase Agency', NULL, 7, 1),
(330, '251006skufkp5DzGigB5aYDGVn1oUFBrJ6bQp8GhjH5fNouB3hHA47By1759751461', '252510', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-10-06 13:51:01', 'Ditotase Agency', NULL, 7, 1),
(331, '251007w7iUOTLZFGnnwAIRh10b2gADH2Bok8sTw1VP6tri6S7i8BSjQj1759841775', '257896', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-10-07 14:56:15', 'Ditotase Agency', NULL, 7, 1),
(332, '251008BNQYkAksYsjHga8DqSuy2SZbYo6KoBLJCZs4C6ZMome9K7DJeA1759905594', '255844', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-10-08 08:39:54', 'Ditotase Agency', NULL, 7, 1),
(333, '251008j37h5ikd3q53mnHDEVMJDOpf1ouOSNFbv4HyM4Ajn3bErnkVR21759929345', '256853', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-10-08 15:15:45', ' ', NULL, NULL, NULL),
(334, '2510086PqiefCgjlfjG3AQVUBqy0vy6W9ULBReCbEio64egQzb9hP0bS1759929352', '256600', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-10-08 15:15:52', 'Ditotase Agency', NULL, 7, 1),
(335, '251008PM2nwrlErpOllWzhJ9zlaMo5lFgh0lZsYddCYTNggkAqSLm1em1759929523', '254279', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'deletestudent', NULL, '2025-10-08 15:18:43', 'Ditotase Agency', NULL, 7, 1),
(336, '251008hwrtkNWvSVHf7LU2C4InahT2F34yyJH1Q9Gv1WUIHDsiNB6ruq1759934706', '252571', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-10-08 16:45:06', 'Ditotase Agency', NULL, 7, 1),
(337, '251009s8B9BR5QqoHBhgolb4dbnTVRzTfr2hmQzlCCgfLtdk8Cwb3k0R1760012517', '255984', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-10-09 14:21:57', 'Ditotase Agency', NULL, 7, 1),
(338, '251009Kh14RTKrU1uE6ZOIIPHuFQW1eN6nwQrRj3FJ6fbeAQByS6O8RZ1760016120', '259027', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-10-09 15:22:00', 'Ditotase Agency', NULL, 7, 1),
(339, '251009YAzEpzEipyiwteK3yUCU54M9fy44syvslKPSmT5AQO8gNWAPOn1760016126', '253100', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-10-09 15:22:06', 'chipeng rubuz', NULL, 9, 1),
(340, '251009zdJ39LwdKY0RfWi9ospJ7sA00HqUDlc6QzsazFKvfrDR9jEFS61760016143', '252873', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-10-09 15:22:23', 'chipeng rubuz', NULL, 9, 1),
(341, '2510097YKDKerbHOKhrZ28JtOUNS8GvgJW1u1RBO6PTl2eFjc5hNOuKz1760016181', '258309', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-10-09 15:23:01', 'Mumba vivien', NULL, 3, 1),
(342, '251009CBymrW16RIayVtGlNYhaa27jleooyr26CvtCKlIO8tctFR7v7i1760016211', '259125', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'logout', NULL, '2025-10-09 15:23:31', 'Mumba vivien', NULL, 3, 1),
(343, '251009egvK8QkN3CRHNevWp0mJCqyUdoUimprnFE2ywT2lb67jJg421T1760016235', '258523', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'login', NULL, '2025-10-09 15:23:55', 'college Trecaz Preegana Rubuz', NULL, 4, 4),
(344, '25112989Krh9lWypg7q8aDCNeFWfG3jEFDVr4e2FVf96dEIuztJIgH5a1764403164', '256027', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'login', NULL, '2025-11-29 09:59:24', 'Ditotase Agency', NULL, 7, 1),
(345, '251130bV0VDhCqtQeULNyHw9ycfqnwNNrdyFSmQueGMUURmVOjtmSssn1764488909', '253544', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'login', NULL, '2025-11-30 09:48:29', 'Ditotase Agency', NULL, 7, 1),
(346, '251202vIyEhHdArnAGcqAP2ujac1FKO7Oro9ohwSuFAYqiDM2dNIOvzp1764702570', '251492', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'logout', NULL, '2025-12-02 21:09:30', ' ', NULL, NULL, NULL),
(347, '2512026A2GH8qK5Q3jOakfiPknSICwPuqj114TmCiBpBGu8bFzOK9LI11764702591', '258870', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'login', NULL, '2025-12-02 21:09:51', 'Ditotase Agency', NULL, 7, 1),
(348, '2512026BgDObsz4v4DzRu6Kuf9vIqcgUyqjDVlNF0IPIrVA7mVDjOKmS1764702759', '253899', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'logout', NULL, '2025-12-02 21:12:39', 'Ditotase Agency', NULL, 7, 1),
(349, '251205AhIQJKFBGwJ2vTRBZVB6hKlOeV064YuTDUbD0HVIZgUWOn8Rkk1764935322', '258398', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'login', NULL, '2025-12-05 13:48:42', 'Ditotase Agency', NULL, 7, 1),
(350, '251205Pz6sk0lmT5tIuSEGVvyNi1JPLj6cY0c1sCEFhHhv8zQpaD94oq1764935605', '255407', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'logout', NULL, '2025-12-05 13:53:25', 'Ditotase Agency', NULL, 7, 1),
(351, '251206CPlWf77O8H5hZo5n6HHFZYAjlJqMQZMlku5nbs6CdUsKLK42fE1765030360', '256635', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'login', NULL, '2025-12-06 16:12:40', 'Ditotase Agency', NULL, 7, 1),
(352, '251206vRh3yp39q6Ol02Usl93MjhcbOBIBlZAU8UAGU82mCsPDQrflOF1765039091', '257418', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'logout', NULL, '2025-12-06 18:38:11', 'Ditotase Agency', NULL, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_branchs`
--

CREATE TABLE `users_branchs` (
  `branch_id` int(11) UNSIGNED NOT NULL,
  `branch_token` varchar(75) NOT NULL,
  `branch_code` varchar(10) NOT NULL,
  `branch_status` varchar(25) DEFAULT NULL,
  `branch_notes` text DEFAULT NULL,
  `branch_created_at` datetime DEFAULT NULL,
  `branch_updated_at` datetime DEFAULT NULL,
  `branch_deleted_at` datetime DEFAULT NULL,
  `branch_user_id` int(11) UNSIGNED DEFAULT NULL,
  `branch_section_id` int(11) UNSIGNED DEFAULT NULL,
  `branch_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_branchs`
--

INSERT INTO `users_branchs` (`branch_id`, `branch_token`, `branch_code`, `branch_status`, `branch_notes`, `branch_created_at`, `branch_updated_at`, `branch_deleted_at`, `branch_user_id`, `branch_section_id`, `branch_school_id`) VALUES
(1, '240828iCyBDIUIj2qDkPrfyy3LjTLckDuOZd1VgPAhCMKEDrpRHjiVJq1724852805', '', 'actif', 'RAS', '2024-08-28 13:46:45', NULL, NULL, 3, 3, 1),
(2, '240828Qdw2QSgfzgoWaI0g1EnISlfB9r58w6ERmfp0fwSKiHVSZ4fT011724853203', '', 'actif', '', '2024-08-28 13:53:23', NULL, NULL, 2, 2, 1),
(4, '240910MzCGmKFe2lpJlY8HMWwQyDyiBsg4uqspJdNOjuT0PSlnVeLzgC1725978865', '', 'actif', '', '2024-09-10 14:34:25', NULL, NULL, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_logs`
--

CREATE TABLE `users_logs` (
  `log_id` int(11) UNSIGNED NOT NULL,
  `log_token` varchar(75) NOT NULL,
  `log_code` varchar(10) NOT NULL,
  `log_ipaddress` varchar(75) DEFAULT NULL,
  `log_device` varchar(75) DEFAULT NULL,
  `log_platform` varchar(10) NOT NULL,
  `log_status` varchar(25) DEFAULT NULL,
  `log_type` varchar(75) DEFAULT NULL,
  `log_notes` text DEFAULT NULL,
  `log_created_at` datetime DEFAULT NULL,
  `log_created_by` varchar(75) DEFAULT NULL,
  `log_login_at` datetime DEFAULT NULL,
  `log_logout_at` datetime DEFAULT NULL,
  `log_deleted_at` datetime DEFAULT NULL,
  `log_user_id` int(11) UNSIGNED DEFAULT NULL,
  `log_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_logs`
--

INSERT INTO `users_logs` (`log_id`, `log_token`, `log_code`, `log_ipaddress`, `log_device`, `log_platform`, `log_status`, `log_type`, `log_notes`, `log_created_at`, `log_created_by`, `log_login_at`, `log_logout_at`, `log_deleted_at`, `log_user_id`, `log_school_id`) VALUES
(1, '240809m2DZ9GgYySVCzNEHFFF0uMNNePBaQvwAgr0Lndf6ca1lUoHwhR1723208884', '241583', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-09 13:08:04', NULL, '2024-08-09 13:08:04', NULL, NULL, 1, 1),
(2, '240809LpvLHQKYQvYTKfTpi4UvtA7ZeKy8GqYuBZfN0FN2ptlo90RhpP1723209068', '245432', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-09 13:11:08', NULL, '2024-08-09 13:11:08', NULL, NULL, 1, 1),
(3, '240810MY0tGoLgQvMshYo9ng93AsOwvsEF5YRnJE8LEQNtR6Y2zrR0Bb1723272167', '244405', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-10 06:42:47', NULL, '2024-08-10 06:42:47', NULL, NULL, 1, 1),
(4, '240812SJ0UGqCOrohNFOrPPU0GP5kKiuZn26zyu9cZSMIuhZT9GRz4C41723448241', '247965', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-12 07:37:21', NULL, '2024-08-12 07:37:21', NULL, NULL, 1, 1),
(5, '240814QeYRhNrbNBBRLEH09f7ufNJ4KcKu5wD2uhfzA4t1PV66KaNJfH1723640508', '240513', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-14 13:01:48', NULL, '2024-08-14 13:01:48', NULL, NULL, 1, 1),
(6, '240814bINSflgVUzME5ejY1WhOalw9tsiQshwDId8vEAQ6bPwL0krCoV1723647382', '240735', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-14 14:56:22', NULL, '2024-08-14 14:56:22', NULL, NULL, 1, 1),
(7, '2408154dNU8wgYqWIHBUrGAe3JHC1CDhZbGQpGpzH4zFYJUnVWMLiekg1723707655', '247452', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-15 07:40:55', NULL, '2024-08-15 07:40:55', NULL, NULL, 1, 1),
(8, '240815s11Bm3jCCEwCUFNaomApnUMFg1NZ7dLR4iQlyKMQetg3I8zDu91723726388', '241934', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-15 12:53:08', NULL, '2024-08-15 12:53:08', NULL, NULL, 1, 1),
(9, '240815qLdE0I5TBaUKEdur34Af0WzEI63BYnQWAFsd942uaqNZFwEdDr1723729481', '240113', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-15 13:44:41', NULL, '2024-08-15 13:44:41', NULL, NULL, 1, 1),
(10, '240816PmQTyginjPegvQ7OQuuw1YpTlOCi3mme5IG1A2TstPinGYT1SL1723793240', '247037', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-16 07:27:20', NULL, '2024-08-16 07:27:20', NULL, NULL, 1, 1),
(11, '240816vpNlC8qiiui8VzCFvSgeYPRj5aVmnVk3DkCvsRQBqg4MM0FhmK1723811670', '243491', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-16 12:34:30', NULL, '2024-08-16 12:34:30', NULL, NULL, 1, 1),
(12, '240816Dd6isZBi4gFlo5BEf2EhS1m4rG7BkqLJRiOy5b7IgSNRvmq7AP1723812873', '249207', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-16 12:54:33', NULL, '2024-08-16 12:54:33', NULL, NULL, 1, 1),
(13, '240817zAYI2YTC5CfaW6slo6q1syiPdcnZRp8DR3FH6mySgszAtuG0cd1723876714', '244626', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-17 06:38:34', NULL, '2024-08-17 06:38:34', NULL, NULL, 1, 1),
(14, '240819I1vuVvYQt1MgI5Lnz1oyPW5fdaGa9djoqq4PUmeoyw7BsJw8Qk1724051980', '249243', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-19 07:19:40', NULL, '2024-08-19 07:19:40', NULL, NULL, 1, 1),
(15, '240820VQvLJvZAg09EV1mnbRDhjF6HZl2J3CubBvTSow7MLmO1fuSe0H1724137692', '242311', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-20 07:08:12', NULL, '2024-08-20 07:08:12', NULL, NULL, 1, 1),
(16, '240820niFeCaHyK6H5S31H1aFqFV6m3afo1iw7zzJbKtw234yYQr8wn71724147167', '248559', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-20 09:46:07', NULL, '2024-08-20 09:46:07', NULL, NULL, 2, 1),
(17, '240820nAqW5w3BA4HgVO1mnn9ufLI8uYYhajiaQVR7Pz8VpTVHvK2bKS1724154543', '241206', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-20 11:49:03', NULL, '2024-08-20 11:49:03', NULL, NULL, 1, 1),
(18, '240821vwOtsnZKZl14WI1aF6uCAdGIGsfyvWffsrPbIip2PH9Bbgkufo1724235105', '249269', '127.0.0.1', 'Firefox 128.0', 'Linux', 'active', 'login', NULL, '2024-08-21 10:11:45', NULL, '2024-08-21 10:11:45', NULL, NULL, 1, 1),
(19, '240822VRaGjigJSWCtcmeg3cj4TKKmm82DbEyJ7ONgfKlRs03bVdccEP1724320583', '247489', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-22 09:56:23', NULL, '2024-08-22 09:56:23', NULL, NULL, 1, 1),
(20, '240823TqM5ShdkoP5kL5ICSUrKffiwdT1cYG9u0SMFRWHM3Nu2jLORzj1724401966', '246155', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-23 08:32:46', NULL, '2024-08-23 08:32:46', NULL, NULL, 1, 1),
(21, '240823ZACQnqCFJ7g4es8udB91wZybUrSgrogBJwJ1CSLS8CSdhSZ4ZJ1724402505', '245682', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-23 08:41:45', NULL, '2024-08-23 08:41:45', NULL, NULL, 1, 1),
(22, '240827TKc3UH8lo5O5boHtyyJV6bHFOf3Wy7MPse5Ud2KSlLW1ZLSkjO1724763347', '246870', '::1', 'Chrome 128.0.0.0', 'Linux', 'active', 'login', NULL, '2024-08-27 12:55:47', NULL, '2024-08-27 12:55:47', NULL, NULL, 1, 1),
(23, '240828pnT080vTwjHkJPzEUfG2Uv0M1AqCJa6msgHFUP3oa5HeWAbh651724836908', '242332', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-28 09:21:48', NULL, '2024-08-28 09:21:48', NULL, NULL, 2, 1),
(24, '240828NnCC3OidyHR8bzLhOCyJNruwnmIKnrBlliZvKcH1ro9pvsTZ141724838442', '240951', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-28 09:47:22', NULL, '2024-08-28 09:47:22', NULL, NULL, 1, 1),
(25, '240828QzRsY77FK11k8AHI0oVn66PonbTy5Q5VWfDct0I961e81MK0Sb1724839141', '248341', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-28 09:59:01', NULL, '2024-08-28 09:59:01', NULL, NULL, 1, 1),
(26, '240828bOQh6IC8wAaVWLF7TMmoVuQeo7QaKGaMAy8bI1BEv7blt6rilS1724853771', '246140', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-28 14:02:51', NULL, '2024-08-28 14:02:51', NULL, NULL, 2, 1),
(27, '240828mC9Uvt25MDChh7lpQ80CizMLZWz0WfOEfuYd4tJeHieiDRwqT41724854339', '249402', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-28 14:12:19', NULL, '2024-08-28 14:12:19', NULL, NULL, 1, 1),
(28, '240828t8aj4BCYTr08an2UvMlSuQuZ1QeQtazmOPkwKyWRsGwo1r2fhR1724854679', '244166', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-28 14:17:59', NULL, '2024-08-28 14:17:59', NULL, NULL, 2, 1),
(29, '2408286GjnWhc5h1yYnV37hcQggaToZFhp8T8t1uhsBmoI2sgGJMonbY1724855128', '243597', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-28 14:25:28', NULL, '2024-08-28 14:25:28', NULL, NULL, 1, 1),
(30, '240828CigWZk6gFizUktviCnS35IgMzCPjRWUsGG6opjtD8K4TkMZGtq1724855322', '245247', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-28 14:28:42', NULL, '2024-08-28 14:28:42', NULL, NULL, 1, 1),
(31, '240828Ll5fGDqGYNc3kgZSdmw5FrWewIHytriu6HoTqHcBd8fHEKT3mn1724861256', '245167', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-28 16:07:36', NULL, '2024-08-28 16:07:36', NULL, NULL, 2, 1),
(32, '240830PJHb7CmTm1khfIntrod9uQmARMCeNhmC9J8sPbBYebc7lI4kWp1725004787', '242391', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-08-30 07:59:47', NULL, '2024-08-30 07:59:47', NULL, NULL, 1, 1),
(33, '240910WZ53Pa9HbjSDsgPUFtquGjfheoL0bLD3vqo9dKap0JZQt4dqwa1725960464', '243875', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-10 09:27:44', NULL, '2024-09-10 09:27:44', NULL, NULL, 1, 1),
(34, '240910cMYUjpp2mF0WYuBiTo1RJzghM9NTf3mPoj60OlJeF6M6Mi4cgm1725978992', '242658', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-10 14:36:32', NULL, '2024-09-10 14:36:32', NULL, NULL, 2, 1),
(35, '240910ybDMnOYefyB3Cy2IVgsJnpHTYzlKhw4aj7d8gzv2PDeteaYRW41725982067', '244253', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-10 15:27:47', NULL, '2024-09-10 15:27:47', NULL, NULL, 3, 1),
(36, '240910IHtFB4iEudRZGEQsjThaoqLktnW1hdvAdFPEusduEdE3F2NGoa1725982113', '249085', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-10 15:28:33', NULL, '2024-09-10 15:28:33', NULL, NULL, 3, 1),
(37, '240911SMZ0ikaTwJ4Thv1vkzb99t3OUbuv0o3N8LcufSVZFmleQcsjkR1726039549', '240822', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-11 07:25:49', NULL, '2024-09-11 07:25:49', NULL, NULL, 1, 1),
(38, '240911i6ThgaHLFDiMZBDFRJsZIVTkZWrMoho7Fhgqs38nVDQPsjuOjG1726046271', '240246', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-11 09:17:51', NULL, '2024-09-11 09:17:51', NULL, NULL, 3, 1),
(39, '240911S8TO0ysef113DBIHjIGz458KbMS0keAqsf2LtHBlYvnsjs6NhI1726046458', '249204', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-11 09:20:58', NULL, '2024-09-11 09:20:58', NULL, NULL, 1, 1),
(40, '240911AYvDYGw2ZVTJOoM7iH9ciZve0dAibunlu30kw1q6bs86q8UaTL1726046540', '249286', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-11 09:22:20', NULL, '2024-09-11 09:22:20', NULL, NULL, 1, 1),
(41, '240911wo35ujM5JA0hZtYm9kIHY1iZh57NICcnWM7cBirsktW6fI0gAI1726046561', '240502', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-11 09:22:41', NULL, '2024-09-11 09:22:41', NULL, NULL, 3, 1),
(42, '24091164gE6h9OEVofTJl8VcP0BJa6b5oFICtchFsLr4S1pGVE18tF4c1726046748', '243607', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-11 09:25:48', NULL, '2024-09-11 09:25:48', NULL, NULL, 2, 1),
(43, '2409110Shp7cGszsi3p5UH9wiIwTKlmidusZijjVMmuATesyPchk8BPL1726053528', '240320', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-11 11:18:48', NULL, '2024-09-11 11:18:48', NULL, NULL, 2, 1),
(44, '240911emPie5d5o31Bza2oigyfGS69hs07dj5iI45ifteKlEfLAJEp8K1726057497', '246917', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-11 12:24:57', NULL, '2024-09-11 12:24:57', NULL, NULL, 1, 1),
(45, '240912mhyueEp1rcAdpNIKkBBQv07BZlshken6j4I7V5YyWZNkid6geG1726125867', '246977', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-12 07:24:27', NULL, '2024-09-12 07:24:27', NULL, NULL, 1, 1),
(46, '240912ciMrKtLvNhpboUbPTwDmY22pQvo556ePTqmAcOy9bEPjvI3i4M1726137296', '244137', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-12 10:34:56', NULL, '2024-09-12 10:34:56', NULL, NULL, 1, 1),
(47, '240912oVi8KQP4Dq1hp22vqNPBUvwCOefQ4uZJnyy8g9VEZfLzD7ByRV1726137465', '245736', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-12 10:37:45', NULL, '2024-09-12 10:37:45', NULL, NULL, 1, 1),
(48, '240917iTWeA5l2wSvjOpH0fm7o8cqVfjTS8tU5Pv1pEzyYlropVLgjLH1726582351', '241187', '::1', 'Chrome 128.0.0.0', 'Linux', 'active', 'login', NULL, '2024-09-17 14:12:31', NULL, '2024-09-17 14:12:31', NULL, NULL, 1, 1),
(49, '240918ApZtd32shOpsk6Q5DGSjgS1QBmGOMIFzGMUfTyHg3aqfVdAz9l1726650984', '248163', '127.0.0.1', 'Firefox 129.0', 'Linux', 'active', 'login', NULL, '2024-09-18 09:16:24', NULL, '2024-09-18 09:16:24', NULL, NULL, 1, 1),
(50, '240918J2sL5DimNN09FgISRz9DGGlU7bYFeJMplwYW3OC0FVa7oISii71726665553', '249437', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-18 13:19:13', NULL, '2024-09-18 13:19:13', NULL, NULL, 1, 1),
(51, '240918qFmV4aCCmE2VYsYHps4L1UV2KzlFw8Ktvewzle2CGbhGaD8neC1726672855', '247415', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-18 15:20:55', NULL, '2024-09-18 15:20:55', NULL, NULL, 4, 4),
(52, '240919Ga60gegz7tVtc8Kl6cN2evTuCYubY2J0mG4GwLrgkclNktmjq31726749025', '249034', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-09-19 12:30:25', NULL, '2024-09-19 12:30:25', NULL, NULL, 1, 1),
(53, '2409209lw0cSjVaLoqqnGeBWuhfM84PRdQhZusq2oQb1Fl7pS414LTFD1726817979', '247460', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-20 07:39:39', NULL, '2024-09-20 07:39:39', NULL, NULL, 1, 1),
(54, '2409205QSVDfiNnwyDWLRo4pdmykwuO6HTi3ZqoOc29wpaGOlZJVu15G1726831102', '245498', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-20 11:18:22', NULL, '2024-09-20 11:18:22', NULL, NULL, 1, 1),
(55, '240920SQOwhK9CE9peT76lQSt3lrM0MdGbbZmbIM62PnKO7sGCVGugNy1726841349', '244913', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-20 14:09:09', NULL, '2024-09-20 14:09:09', NULL, NULL, 1, 1),
(56, '240920riYpz9KA3m2Hr24HJCey9bE2rcTGcP6GeceMIUo7ZMN28f1Y5H1726844249', '243463', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-20 14:57:29', NULL, '2024-09-20 14:57:29', NULL, NULL, 1, 1),
(57, '240921dHoQ33gtctB1shqKlVE6HPf9llVFmo2EFKzv9Epyak7hSyK7061726905590', '243169', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-21 07:59:50', NULL, '2024-09-21 07:59:50', NULL, NULL, 1, 1),
(58, '240921F7o9NiQ9bH3EUeweW39VZFpoTUq4koiEfKgPWMMSfCbKiRlqse1726921532', '241710', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-09-21 14:25:32', NULL, '2024-09-21 14:25:32', NULL, NULL, 1, 1),
(59, '2409222OGRhdQjvUHlL0DMOAGmRoupAdLJWtILLEgsJWaGSH9vTl84wk1726994027', '248530', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-22 10:33:47', NULL, '2024-09-22 10:33:47', NULL, NULL, 1, 1),
(60, '240925P4aUvh428li6L7PuFOBmyREANLGbnIBi3SO1AOooGlnEL02BTC1727249256', '245755', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-25 09:27:36', NULL, '2024-09-25 09:27:36', NULL, NULL, 1, 1),
(61, '240925DlUbTUWILtKmitJuavjhW3ubYOmu2l1IJJFO8GNTdJrlZA4k0b1727265229', '240108', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-09-25 13:53:49', NULL, '2024-09-25 13:53:49', NULL, NULL, 1, 1),
(62, '240925tOhQ5tmZYQSwjAKpefTs7O1pVaAtYW7B1mzZZ81LFT4AZ10YFv1727273077', '242818', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-25 16:04:37', NULL, '2024-09-25 16:04:37', NULL, NULL, 1, 1),
(63, '240925NkFO6PRy5q9Wci7ARwT6MfGlAg2nrCvqsLKbNnwbjGO6avibPj1727277170', '247580', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-25 17:12:50', NULL, '2024-09-25 17:12:50', NULL, NULL, 1, 1),
(64, '2409265gW1FGEMBmPiSdSBeJpiP5iEH5vvRRayq1Dc5Ia4EHnLSRRADb1727345040', '247648', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-26 12:04:00', NULL, '2024-09-26 12:04:00', NULL, NULL, 1, 1),
(65, '2409272M6djDa8Jpt67rUd0pRf2Bq9TINq4AVGyQwVwphjHYLAGRtWTP1727428662', '242201', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-09-27 11:17:42', NULL, '2024-09-27 11:17:42', NULL, NULL, 1, 1),
(66, '240927CewVCDG6TWfWyDkLyMbYZ9QWHrpq0TvblW91C6nbd6O9O1qWzQ1727433639', '247989', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-09-27 12:40:39', NULL, '2024-09-27 12:40:39', NULL, NULL, 1, 1),
(67, '240928aSW0ywW5VF25tEEtIh6gTijj4sSbkScC5PkMyMAhez3488ECuW1727510431', '241478', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-09-28 10:00:31', NULL, '2024-09-28 10:00:31', NULL, NULL, 1, 1),
(68, '240930cGrMgsFnNKGyjBc5zDQKQe5mahUNqlugNHTmWVMTHf3IbLKbZV1727684629', '246163', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-09-30 10:23:49', NULL, '2024-09-30 10:23:49', NULL, NULL, 1, 1),
(69, '240930URYi1Hlp9ThiBWzmfVJ4OPRhH52LoqcliCNsEtbRtNQRqIuZvG1727702431', '247011', '::1', 'Chrome 128.0.0.0', 'Linux', 'active', 'login', NULL, '2024-09-30 15:20:31', NULL, '2024-09-30 15:20:31', NULL, NULL, 1, 1),
(70, '241001ce5oU29YiSBHV2B8oJG9EKmc0WNg8OvnomnanmnmhbVomb6AdK1727766971', '249528', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-01 09:16:11', NULL, '2024-10-01 09:16:11', NULL, NULL, 1, 1),
(71, '241001e3vyILLlV4GLPMv3hdmJYU0kFtLzR746kQvPA99MJS1ZcMdOko1727789250', '243963', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-01 15:27:30', NULL, '2024-10-01 15:27:30', NULL, NULL, 1, 1),
(72, '241001JULJSkQLIaD0fUKaQy33RSuLE5yGWQSAzshFMMllMSbtLdolf31727789297', '246921', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-01 15:28:17', NULL, '2024-10-01 15:28:17', NULL, NULL, 1, 1),
(73, '241001MWzf47Oq3Ep1SM993DelyRT7kcSIsLy8znVh30UyGVaIrwT9rc1727789334', '246021', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-01 15:28:54', NULL, '2024-10-01 15:28:54', NULL, NULL, 1, 1),
(74, '2410021GB4ww9e8uHaFtzOM84p6jLYc6Vfj16pqeKfYuGNVU6tGf5yJT1727858674', '241899', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-02 10:44:34', NULL, '2024-10-02 10:44:34', NULL, NULL, 1, 1),
(75, '2410023LiNRA3OwHRGLjcnmr8ZrVom511w2vObrIoEcl6o6l6YgU4Lk81727878128', '248187', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-02 16:08:48', NULL, '2024-10-02 16:08:48', NULL, NULL, 2, 1),
(76, '241002TNdgbGlw9KFzGvMVf6p2rc4SdAhusWatPWIM7d2hYc172el0vn1727880459', '248280', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-02 16:47:39', NULL, '2024-10-02 16:47:39', NULL, NULL, 2, 1),
(77, '241003f8m6kcH6siwjocBU9hhmsyZRy9Z7O9bMjmvHlaf1kc58vfhzS91727940462', '245788', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-03 09:27:42', NULL, '2024-10-03 09:27:42', NULL, NULL, 1, 1),
(78, '241003y424nOM8nDeQzg62lP2w8r8JNhBckJ9oQwVZGLPWkqWKdHpoa51727944189', '243288', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-03 10:29:49', NULL, '2024-10-03 10:29:49', NULL, NULL, 2, 1),
(79, '241003b9aSMc1c5TVtFhqrbCOusSpSoUZ2fDjSzYENhY92nEib0I8pAJ1727948050', '249594', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-03 11:34:10', NULL, '2024-10-03 11:34:10', NULL, NULL, 2, 1),
(80, '241004rynHyPirfHmS6a7REcYSVZ3bZpWODPUaAcFLpYKHtyI7kDiyDH1728029374', '246290', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-04 10:09:34', NULL, '2024-10-04 10:09:34', NULL, NULL, 1, 1),
(81, '241005eQtav9ZEIN93tomRc9uDFmBv1Kt71N2aVH4JAwPTGKVUiHb18Z1728113202', '245979', '127.0.0.1', 'Firefox 130.0', 'Linux', 'active', 'login', NULL, '2024-10-05 09:26:42', NULL, '2024-10-05 09:26:42', NULL, NULL, 1, 1),
(82, '241022y50kAeRElRSSlNyD8poiwCgDH1zEdebHh4HGWfARQPwLE5mtTb1729580355', '240819', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-22 08:59:15', NULL, '2024-10-22 08:59:15', NULL, NULL, 1, 1),
(83, '241022FgwrtDr4QiPIC36hsULQMDCTAMVzowQwaQOC8QcWqArP7HA7271729593725', '249341', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-22 12:42:05', NULL, '2024-10-22 12:42:05', NULL, NULL, 1, 1),
(84, '241022IoEfhT5f1O6F8Zg3AAasfvU0ufB2IQ1AHCetPSf5P1I2v6hJz41729601589', '246047', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-22 14:53:09', NULL, '2024-10-22 14:53:09', NULL, NULL, 6, 1),
(85, '241022J85m1lyIDM0pCyEJ0BFNHDyH4DR85LPVN4Czth3HSHkDw4BiA81729601901', '241285', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-22 14:58:21', NULL, '2024-10-22 14:58:21', NULL, NULL, 6, 1),
(86, '241022SanBH7qjNkuw5YkGKhk9m9us17SVeDd1VNUdvsRUUTwT6En4zB1729602316', '240305', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-22 15:05:16', NULL, '2024-10-22 15:05:16', NULL, NULL, 6, 1),
(87, '241022Z0qPAQR6dQ9LWFivWWI2fVWhqnTC4UaJhDbFpyektOoNq0uH5J1729602920', '248894', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-22 15:15:20', NULL, '2024-10-22 15:15:20', NULL, NULL, 6, 1),
(88, '2410228hkbdLhHYezhhECKoGrFCaVQMLEUMndF3QQBlrvyaZPG47fo8z1729603677', '240023', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-22 15:27:57', NULL, '2024-10-22 15:27:57', NULL, NULL, 6, 1),
(89, '241022nVOP2vafULe9aWG8f8rAJ7JKNgrrqcZ6fU5g5u60C2R4rkFkS51729606577', '241437', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-22 16:16:17', NULL, '2024-10-22 16:16:17', NULL, NULL, 2, 1),
(90, '241024SzZyl1qWim5E7DRtug6eWMCQrgTZzu4cE9aBgkZSoGDovBD2AL1729761140', '244341', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 11:12:20', NULL, '2024-10-24 11:12:20', NULL, NULL, 1, 1),
(91, '241024wldbJLCeGzmn87FzaGQdmHTuyBNvhGt7jvialbnuplc4mohPGd1729763950', '240195', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 11:59:10', NULL, '2024-10-24 11:59:10', NULL, NULL, 1, 1),
(92, '241024P78QPHqnOJm8ANnQ1YS2mCgK3i7wvFsvPeE9yub0tj6fgLnycH1729764414', '247046', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:06:54', NULL, '2024-10-24 12:06:54', NULL, NULL, 1, 1),
(93, '241024JDo9AKAgZ92TluphcknTWwQvNG88hOBaNTe25i96iztJdKDZAv1729764658', '248454', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:10:58', NULL, '2024-10-24 12:10:58', NULL, NULL, 1, 1),
(94, '241024trgQC30kZMQnCB8vGDzdC7fdMEi4PyJKHdoQ4hbn8ccayKgrTQ1729764871', '247147', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:14:31', NULL, '2024-10-24 12:14:31', NULL, NULL, 2, 1),
(95, '241024mLeEaaC3ig37BhJJTnMiJA7GZUfhTb1lnaCrjZJ5zUymshF4z81729764916', '241848', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:15:16', NULL, '2024-10-24 12:15:16', NULL, NULL, 1, 1),
(96, '2410244NbHR6NlKbPIqlGUhlhJJ8rMGZrYVRRAYTdl5E002lWI608gQz1729764932', '249531', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:15:32', NULL, '2024-10-24 12:15:32', NULL, NULL, 1, 1),
(97, '2410242CbHrgAFJNZGAw7hAwUENaA21WFIkP2f6lLewp2NIFmp5jDbNK1729765549', '246733', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:25:49', NULL, '2024-10-24 12:25:49', NULL, NULL, 1, 1),
(98, '241024BaiVfwG8yL47dYDTYZtbUzrIkKYWijE6Gj5yUJu6kB5ZayBFlK1729765619', '248700', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:26:59', NULL, '2024-10-24 12:26:59', NULL, NULL, 1, 1),
(99, '241024K4CZ6BblHDyazH79Z0zZzNE9ql03OtozSOB1VdmcAl6kZZzA0q1729765946', '240141', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:32:26', NULL, '2024-10-24 12:32:26', NULL, NULL, 1, 1),
(100, '241024dbhjDAbv0imCFy6wOpI5TDh8AafymtdSCqbrGiKRCpg145uPhj1729766648', '248401', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:44:08', NULL, '2024-10-24 12:44:08', NULL, NULL, 1, 1),
(101, '241024EUZiksVeDeYb3mZQpMnZGH4i0S49mgSlD5lrGFrLtW9tOmsyqR1729766871', '242513', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:47:51', NULL, '2024-10-24 12:47:51', NULL, NULL, 1, 1),
(102, '241024B2EhtErd0ZbBe6wmkDOPUfcHLEkm5EGzjCrg8mYwN21c4lJqRf1729767486', '246049', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 12:58:06', NULL, '2024-10-24 12:58:06', NULL, NULL, 1, 1),
(103, '241024tU2t390GOFcWSrVL8zcVKZ5uCWGOvdI7P0kj0boIatCsDwKFgq1729767730', '241417', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 13:02:10', NULL, '2024-10-24 13:02:10', NULL, NULL, 1, 1),
(104, '241024CEWYtq2Ic0NtWYOGNS4Kh52aMNbFPQC1SWNuIArZduR7MeJoI81729768096', '248892', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 13:08:16', NULL, '2024-10-24 13:08:16', NULL, NULL, 1, 1),
(105, '2410241pCntzjCDKM79arqunstpO8ZREofh751YkraHYaNNYi2EZdVrH1729768492', '243844', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-24 13:14:52', NULL, '2024-10-24 13:14:52', NULL, NULL, 1, 1),
(106, '241025QpsBsBHPz8v4fwNHQLR8y6dGIbYIYlu602aNgWMmLtklzEqkEC1729857375', '240257', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-25 13:56:15', NULL, '2024-10-25 13:56:15', NULL, NULL, 1, 1),
(107, '241025Lu1ElukdzDqgdbmmtCipZpwzMIGb2Nps5WuJRE9EI0It34ku381729857657', '248444', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-25 14:00:57', NULL, '2024-10-25 14:00:57', NULL, NULL, 1, 1),
(108, '241025DUGwhouOHq3o7FHGGHdWUsQk4OL0q5SzkyLNJo7ns2W3hfyMsJ1729866095', '247813', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-25 16:21:35', NULL, '2024-10-25 16:21:35', NULL, NULL, 1, 1),
(109, '241026hsl2cRgEaisvae7IOri8YPHuUOcJkBTMg8ZJj5dfbWTgYmICGC1729926821', '247179', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-26 09:13:41', NULL, '2024-10-26 09:13:41', NULL, NULL, 1, 1),
(110, '241026qn1ANqJqnvmE4E3iquZ7hUwzAbaBOTeTBBne5qw5tEnnJgVJ7S1729926906', '243249', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-26 09:15:06', NULL, '2024-10-26 09:15:06', NULL, NULL, 1, 1),
(111, '241026ZB7Zy3sSQGymow6ZMSsMm74WIpwOD5dH67F9Hjn24hPMDjgnhw1729929329', '242385', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-26 09:55:29', NULL, '2024-10-26 09:55:29', NULL, NULL, 1, 1),
(112, '241026RyEsIPOHd2cThQYh1OtoyM6DBqOQ9j1DbiFg1aLv3WBKMHdwQE1729929741', '248348', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-26 10:02:21', NULL, '2024-10-26 10:02:21', NULL, NULL, 1, 1),
(113, '241026NrPc3WdII6Mq0vGEHNtHuZK6zutKKmrOLaDH3p3vqgUU3iTNt21729930071', '245267', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-26 10:07:51', NULL, '2024-10-26 10:07:51', NULL, NULL, 1, 1),
(114, '241027g0fLTEidc0hOpGhtEcGWYzJ2KbtkfvCM5ADyzQqIZgB4YIRaDY1730023445', '240454', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-27 12:04:05', NULL, '2024-10-27 12:04:05', NULL, NULL, 1, 1),
(115, '2410275uJ759okfV6yPOWyCwTkwLqCWM0D0nSW7KzY1OoSgMQvl0gGVd1730023725', '245840', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-27 12:08:45', NULL, '2024-10-27 12:08:45', NULL, NULL, 1, 1),
(116, '2410271Id4cRmEDOnphnera8Fdvp0wTKo01UoHMn1DrtjEQUspAQreKR1730023760', '243200', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-27 12:09:20', NULL, '2024-10-27 12:09:20', NULL, NULL, 1, 1),
(117, '241027eeQWrLVzmpCyd4PGtySqQ3pgruuCCMcY9JJmOgNcalq8YBHw0F1730023871', '240326', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-27 12:11:11', NULL, '2024-10-27 12:11:11', NULL, NULL, 1, 1),
(118, '241027tb2FIHfmfKvPs4093IUfMD97Mf5Vu3ju1lcD6Y8blKNiCTK9R01730023924', '249056', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-27 12:12:04', NULL, '2024-10-27 12:12:04', NULL, NULL, 1, 1),
(119, '241027rYDsmeyuOYVvCucp2bcpAdpJCD5TcSiPFmFzVodgBUpUC44FU91730023982', '241027', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-27 12:13:02', NULL, '2024-10-27 12:13:02', NULL, NULL, 1, 1),
(120, '2410278aAZ5kIpyl2pSMV88uGlhJUkt89YjvnQg7IIvZ0Qea4m7Q90Yu1730024880', '249150', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-27 12:28:00', NULL, '2024-10-27 12:28:00', NULL, NULL, 1, 1),
(121, '241028OBy0BBnzzny3RMQHOpa3keZcSZAVGIZZfz1l2nveeVymzEmruf1730103127', '249650', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-28 10:12:07', NULL, '2024-10-28 10:12:07', NULL, NULL, 1, 1),
(122, '241028iROdWIca99mmOe009pLFTueUaZbRp4vDqeRlHSyFw6FgPegGH81730103940', '247805', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-28 10:25:40', NULL, '2024-10-28 10:25:40', NULL, NULL, 1, 1),
(123, '241028Tg9sRg5VckFyPPalinzvqyE6F5r46ARBiUEZWfHtnw623d3IOq1730103967', '246133', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-28 10:26:07', NULL, '2024-10-28 10:26:07', NULL, NULL, 1, 1),
(124, '241028ptrVC4WgVyWvQ8zG2HAS0naYYvPorKgkwhFtG3TPh3SDgVJyW01730124758', '242720', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-28 16:12:38', NULL, '2024-10-28 16:12:38', NULL, NULL, 1, 1),
(125, '241028ifn70H1tSD9WUDCWLKfuhmzSdphAQDycmRYtBngWAnD344qTQB1730125155', '249308', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-28 16:19:15', NULL, '2024-10-28 16:19:15', NULL, NULL, 1, 1),
(126, '241029hRtyEDA5zcjjdbYRsdWi76YplTACCz0rSVf2n1dy0NyNsgPArR1730190336', '240933', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-29 10:25:36', NULL, '2024-10-29 10:25:36', NULL, NULL, 1, 1),
(127, '241029HUYWMTfCpe3Pqq6kV2NB25P10ffIG8UBkIVnb0roTKazLwK5rO1730190368', '242178', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-29 10:26:08', NULL, '2024-10-29 10:26:08', NULL, NULL, 1, 1),
(128, '241029GVzIrCBNTpO50GDwey7UQvh1Em6V7WyOe6DrUmneqhATdaccap1730195934', '248502', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-29 11:58:54', NULL, '2024-10-29 11:58:54', NULL, NULL, 1, 1),
(129, '241029uGNrCuIP4KPDyB0tgQVcURHVP5qMDzcJmqsD2pGCzrM8RjG1jO1730195958', '249741', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-29 11:59:18', NULL, '2024-10-29 11:59:18', NULL, NULL, 1, 1),
(130, '241030CWAhrGFo7BEOSv9lHbAJa7rse4Ul1w5ZOuTeizTEQha1thK8FE1730275445', '247567', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-30 10:04:05', NULL, '2024-10-30 10:04:05', NULL, NULL, 1, 1),
(131, '241030EVyTNAa8uHuLL0jcdmzbv6HS4Pm5qfjqOr1usRKJqLW1SSKcLS1730277301', '240140', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-30 10:35:01', NULL, '2024-10-30 10:35:01', NULL, NULL, 1, 1),
(132, '241030HvIFh8UgonbjtGjgoEMTsz3uIFjjk5kHjNGpLz9Viqy5sg2ryi1730277371', '244295', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-30 10:36:11', NULL, '2024-10-30 10:36:11', NULL, NULL, 1, 1),
(133, '241030faZ9SqP1c76GrntHf1Aap011wWmyMBPlRCtqtme0QeVy2r2ELR1730277543', '246061', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-30 10:39:03', NULL, '2024-10-30 10:39:03', NULL, NULL, 2, 1),
(134, '241030tjJHFWPztsiw66SHfFaS5nQpzM9OfYO0M8l0afQaBEojqh5WtU1730278455', '240234', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-30 10:54:15', NULL, '2024-10-30 10:54:15', NULL, NULL, 1, 1),
(135, '241030ePBIgoagKo1PB7SdzhrHqr9ZdABdM9vnRvkNqVQyDud6GoFPw01730280376', '241783', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-30 11:26:16', NULL, '2024-10-30 11:26:16', NULL, NULL, 2, 1),
(136, '24103089nDQ9Swn6Sju9cwOuyQ1zAfMsvN2cWAOGcqu4SCuA4u6jmoBh1730280691', '240597', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-30 11:31:31', NULL, '2024-10-30 11:31:31', NULL, NULL, 1, 1),
(137, '241030k6QhVRe7dgVBuW8Emd7IVWHS5IKKS3movW8Yde8fOOuJQLwNmy1730281364', '245637', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-30 11:42:44', NULL, '2024-10-30 11:42:44', NULL, NULL, 1, 1),
(138, '241030eOyKCjAnlgppHRopHe2zREFY8ZftqlgvBk1GPmAorCOcBqlNw41730281709', '242732', '::1', 'Chrome 129.0.0.0', 'Linux', 'active', 'login', NULL, '2024-10-30 11:48:29', NULL, '2024-10-30 11:48:29', NULL, NULL, 1, 1),
(139, '241030LFzd6nr3VM0DDSAE0Oz0rM3QB6EEompprrsvMZFHecwRLoFmcz1730282766', '242209', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-30 12:06:06', NULL, '2024-10-30 12:06:06', NULL, NULL, 1, 1),
(140, '241030RUKhwkVpIh0E684H8PYTr7SgirfBezFJGyVOtZ2r3dpmgEt9ie1730287305', '244193', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-30 13:21:45', NULL, '2024-10-30 13:21:45', NULL, NULL, 1, 1),
(141, '241031ltrMjtA9DBcd4oYQ2rZRm1WbO3mnaDkiUuYis19izsfJ8N3w5j1730357091', '245665', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-31 08:44:51', NULL, '2024-10-31 08:44:51', NULL, NULL, 1, 1),
(142, '2410310AsMeZjrSV5pGEVH4kWySrOdM719e3hfgmfWzwuzbCo2ps1uuk1730357815', '249667', '127.0.0.1', 'Firefox 131.0', 'Linux', 'active', 'login', NULL, '2024-10-31 08:56:55', NULL, '2024-10-31 08:56:55', NULL, NULL, 1, 1),
(151, '24110446heTg2nengiIURGozhL86deWGEk1i7zfUMBoOhmzCUz25Lb1K1730715308', '241606', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'account', NULL, '2024-11-04 12:15:08', NULL, '2024-11-04 12:15:08', NULL, NULL, 1, 1),
(152, '241104TOPDkcQoTTUOh9noBgMyNR3stpLCK5wcRkHGw3WpFCM3Mb07SQ1730715379', '245480', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-04 12:16:19', NULL, '2024-11-04 12:16:19', NULL, NULL, 1, 1),
(153, '241104ECE4mKFSJC13zIsTZkFMvv69E74t2Ci1T0PW0leGBsvlvZKflR1730715388', '240286', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-04 12:16:28', NULL, '2024-11-04 12:16:28', NULL, NULL, 1, 1),
(154, '241104sAAQAdTAnaNUkqCSViFlFMObYWoml55JW0hKFJo3d1lWzI0gfM1730715884', '247528', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-04 12:24:44', NULL, '2024-11-04 12:24:44', NULL, NULL, 1, 1),
(155, '241104fIVNunsUN55yCnYPf3Iaya19V7qFlGdGeDpnHgRHtv9egMzBQQ1730716357', '240649', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-04 12:32:37', NULL, '2024-11-04 12:32:37', NULL, NULL, 1, 1),
(156, '241104TPRvUAL7rpZYykLDp4qCShhPbqkjkwGVDq3req4AmLBBjW5LQh1730717198', '244269', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-04 12:46:38', NULL, '2024-11-04 12:46:38', NULL, NULL, 1, 1),
(157, '241106TdRkBN8tzOIB3MmDt6rhTIBab2GhD9JWS3jDmKOwyqa85mIzH11730889537', '241468', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-06 12:38:57', NULL, '2024-11-06 12:38:57', NULL, NULL, 1, 1),
(158, '2411062JgkAASH40KkesyTNrfoJzQDnSoGleQfP2cqf2c2a2CoLZWa3H1730903715', '249021', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-06 16:35:15', NULL, '2024-11-06 16:35:15', NULL, NULL, NULL, NULL),
(159, '241106HHE0wQuDm2Z5K3gjh3vOcIO0kqq9hPpYkdZWl207Evb87hNRNp1730903725', '241238', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-06 16:35:25', NULL, '2024-11-06 16:35:25', NULL, NULL, 1, 1),
(160, '241106uNyu4s6tozh34BnuuYQAdKb5sViz0k7cVVS7wvorqb9CRnL7LP1730905350', '240380', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-06 17:02:30', NULL, '2024-11-06 17:02:30', NULL, NULL, NULL, NULL),
(161, '2411111I3Wiy1W0y5sDtJJO73ERupto3Fosy4qesiBw91Os0Yu2d4JJY1731310829', '249259', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-11 09:40:29', NULL, '2024-11-11 09:40:29', NULL, NULL, 1, 1),
(162, '241111H6W94dEBpsphOkQHoCPrsLvOTwfUbvsIelzAo0WyEZ14o2KqIt1731317540', '241837', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-11 11:32:20', NULL, '2024-11-11 11:32:20', NULL, NULL, NULL, NULL),
(163, '241111Vm1EKwbnBRzMQqfolMrdV3gy54rgJI5mTqeQcu9oorqhoIuyI51731317552', '248199', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-11 11:32:32', NULL, '2024-11-11 11:32:32', NULL, NULL, 1, 1),
(164, '241111grAcg1q8BkEez5Hb6M89JsoDv6tK3j5waUfCHeBZmJTPiqAZcj1731318094', '242744', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-11 11:41:34', NULL, '2024-11-11 11:41:34', NULL, NULL, NULL, NULL),
(165, '241111j4BYS4sthuEonQ85WGSfwn3pv6PhyGLImP4rE4TD2C5QyBC40o1731320138', '247153', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-11 12:15:38', NULL, '2024-11-11 12:15:38', NULL, NULL, 1, 1),
(166, '241111C77K9GBccwuoYUyzMpwf4nBAjT3muicLMJMPvzfRQdrlauskfv1731329147', '244231', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-11 14:45:47', NULL, '2024-11-11 14:45:47', NULL, NULL, 1, 1),
(167, '241111P4nl55SlCPVksizSIwz6rMznjKW55PRq1985ZlwF9ppeyWnwvM1731329865', '246493', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-11 14:57:45', NULL, '2024-11-11 14:57:45', NULL, NULL, 1, 1),
(168, '241111P9SB8Jc8UfK0zPjDKWZIZTCavuQjV1JTA8ekgT7biaU4Tc1BdF1731335511', '244267', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-11 16:31:51', NULL, '2024-11-11 16:31:51', NULL, NULL, 1, 1),
(169, '241111BSDcLe54wv4zFVJBhq6Og00BiA8I5RQRHdP0YMTuir7UEDkPNW1731335588', '247257', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-11 16:33:08', NULL, '2024-11-11 16:33:08', NULL, NULL, 1, 1),
(170, '241112qJP6M2rbkOSvQmduFc0Y2PSES71Z9nYI2H26ghvPwdMc9Wfw7W1731398255', '246287', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-12 09:57:35', NULL, '2024-11-12 09:57:35', NULL, NULL, 1, 1),
(171, '241112VZjbgHalg6oQFoqQBlTC9ddE3zi403eVzzqdDlPYqhVsOcH0fc1731405255', '243351', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-12 11:54:15', NULL, '2024-11-12 11:54:15', NULL, NULL, 1, 1),
(172, '241112JyNd8OQ0sQTviFZZEAv3SOwqmVlI7rVC0KrNAdaNDO7UMJnLdn1731405266', '249454', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-12 11:54:26', NULL, '2024-11-12 11:54:26', NULL, NULL, NULL, NULL),
(173, '241112jmiLKTmfWOA7ytjwCoYK6wBDnzwjRZnfYltHo7N6KsHzkR2ey31731405481', '248415', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-12 11:58:01', NULL, '2024-11-12 11:58:01', NULL, NULL, 1, 1),
(174, '241112afMRGSJDjtsqNFZljzj7YYpekk3wfBiopVnlUuO4tT46zImbgJ1731406244', '241041', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-12 12:10:44', NULL, '2024-11-12 12:10:44', NULL, NULL, 1, 1),
(175, '241112DjW2hV2TsM4Qcsm60c598DJLbrcfGsvPY79WJSAufT4tPt2jcq1731406264', '247061', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-12 12:11:04', NULL, '2024-11-12 12:11:04', NULL, NULL, 1, 1),
(176, '2411127thVaiGa4uiYuu9DYHtuEKONCQCcKfSD5nfertfpAyp2G9pwAe1731406726', '241873', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-12 12:18:46', NULL, '2024-11-12 12:18:46', NULL, NULL, NULL, NULL),
(177, '241113eFO0RrpEOnpAnkMQoyW5T04zs3ZNAdtT0zCkB721VOCHpATJPA1731483272', '240058', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-13 09:34:32', NULL, '2024-11-13 09:34:32', NULL, NULL, NULL, NULL),
(178, '241113j7eTGFGTEihRO97IebOa7IYkcFrAG0QHnI7ARv0VA0SIlbL59k1731503059', '240943', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-13 15:04:19', NULL, '2024-11-13 15:04:19', NULL, NULL, 2, 1),
(179, '2411137tEjtLKhk1N1OGsmkciKvbq8kJCYQSL7se4a2s5LwkEc2k8zIv1731507796', '247314', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-13 16:23:16', NULL, '2024-11-13 16:23:16', NULL, NULL, 2, 1),
(180, '241113y7Mr7syV54GRttH0iinvrCghstKEyRJPEN22Wo2sIwmLfZgJRO1731507807', '243157', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-13 16:23:27', NULL, '2024-11-13 16:23:27', NULL, NULL, 1, 1),
(181, '241113ZDVtL94fjcUlrL4JnM5sgiOUizMmh8l0aE93cJKOa7ikdG75U71731510485', '241144', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-13 17:08:05', NULL, '2024-11-13 17:08:05', NULL, NULL, 1, 1),
(182, '241113ACuSeaOWKRjaHUa6PseFlNcSRbzCr11jF8CJFfUY18Khp3e0NE1731510492', '249235', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-13 17:08:12', NULL, '2024-11-13 17:08:12', NULL, NULL, 2, 1),
(183, '241113ZSHhOhCHLViCb0PpIRoF24J0p3YgiZGBdqY04nlDBHNW7zRyDn1731512241', '246442', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-13 17:37:21', NULL, '2024-11-13 17:37:21', NULL, NULL, 2, 1),
(184, '241115f8YfnMQnk20FWoEvfFLZT5aoZ0jKYrZqBBAvQGSVZzNaTC0bG31731659569', '245530', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-15 10:32:49', NULL, '2024-11-15 10:32:49', NULL, NULL, NULL, NULL),
(185, '241115GpzZBduNpe7q5bnwBvR3Li5Zrh1I4iK0pCQOmT6Rsl7imNrOdI1731659577', '243887', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-15 10:32:57', NULL, '2024-11-15 10:32:57', NULL, NULL, 1, 1),
(186, '241116sf9WtteJnIHLInw1vllzkCZC8dr22bJLIhbq9LJOGTeaL6nGm91731748004', '245917', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-16 11:06:44', NULL, '2024-11-16 11:06:44', NULL, NULL, NULL, NULL),
(187, '241121wiS0JUtcwtCPqpdmhwASPZwoMB5ZMSl1hEUGhfvPo8gFoaeGzT1732188271', '240777', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:24:31', NULL, '2024-11-21 13:24:31', NULL, NULL, 1, 1),
(188, '2411213ava28nhe8Eqt3aTHbRgj09T7rVRDiCce7Pl0WhMrlZb0mHCsj1732188502', '244824', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:28:22', NULL, '2024-11-21 13:28:22', NULL, NULL, 1, 1),
(189, '241121fsYKYeB7H9hiDUDwEEPKowRFRGSSHlj7YlgyErpZud3qr8kdmL1732188513', '241180', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:28:33', NULL, '2024-11-21 13:28:33', NULL, NULL, 2, 1),
(190, '241121I0ESrDUiwbrIfJHSevft5gBvpB3SyGwa6FIfD6dwCEnnFlYeKk1732188671', '241032', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:31:11', NULL, '2024-11-21 13:31:11', NULL, NULL, 2, 1),
(191, '2411214uBBYgiCYwWIESgsbr0evfBZm2YkF4MlzHJyRHmgnSqVlh0u6h1732188683', '242744', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:31:23', NULL, '2024-11-21 13:31:23', NULL, NULL, 7, 1),
(192, '241121oGk3UBDM9VggNBGovLck7PvjvG1ykabPfEkuYn71WKqNimtJC71732189427', '243456', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:43:47', NULL, '2024-11-21 13:43:47', NULL, NULL, 7, 1),
(193, '241121uuEu0FAdcosn8GzE13D2RdkhPuQoYiKKscBEswDza7zy0Ha7uD1732189438', '241268', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:43:58', NULL, '2024-11-21 13:43:58', NULL, NULL, 1, 1),
(194, '241121k3R7JGoDVue1tZQ2FBYINHEClQmIbqp5EPmqHwbi9RrVNvNMCf1732189477', '240862', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:44:37', NULL, '2024-11-21 13:44:37', NULL, NULL, 1, 1),
(195, '241121UZHrTSIhgPbqruhAqoVpA69LHu2aiH4bsIMT7Nz2zCC4dCpBGs1732189505', '244562', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:45:05', NULL, '2024-11-21 13:45:05', NULL, NULL, 7, 1),
(196, '2411211i19WgjGjKR3lCIoBoOVhrtcR7WP2j1s8j0PLDW14QShRS3dpN1732189674', '242184', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:47:54', NULL, '2024-11-21 13:47:54', NULL, NULL, 7, 1),
(197, '2411216kS2uoctVubT6TQUTSTrR9mp7p27MUBUDcIN89jYt3qm35WeGz1732189684', '242713', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:48:04', NULL, '2024-11-21 13:48:04', NULL, NULL, 1, 1),
(198, '241121rcP1dTm8j4FjOhmPw1Y9jErPIQauaAWGb2mgsOeFzggFcsqi8f1732189766', '249844', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:49:26', NULL, '2024-11-21 13:49:26', NULL, NULL, 1, 1),
(199, '241121G1Mmt7B7WlN4iaETaPuGRw6kpw9aAOb2dpoUOIiar5yYzirL1L1732189805', '244369', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:50:05', NULL, '2024-11-21 13:50:05', NULL, NULL, 7, 1),
(200, '241121AqUfS9gPNSr4gFjIvH3jGGEmoRl8sBgkYtabebG3BSVEISnRhT1732189818', '247845', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:50:18', NULL, '2024-11-21 13:50:18', NULL, NULL, 7, 1),
(201, '241121bIBHk71hwtvGW7MZFEYOMYdmwUNoncyFuih8u7LvgiAq7qgUrl1732189826', '242100', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:50:26', NULL, '2024-11-21 13:50:26', NULL, NULL, 2, 1),
(202, '2411218fsLhoFR3Sq1Q623BwnG7ACEwDRSvzdpwTNHoPSVgHkeiwCDzO1732190324', '246130', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:58:44', NULL, '2024-11-21 13:58:44', NULL, NULL, 2, 1),
(203, '241121fbaO0OzHzJY4zV87RH5aBlWjbckMPj3m2ekbALGY8fbD7b57hL1732190334', '243682', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:58:54', NULL, '2024-11-21 13:58:54', NULL, NULL, NULL, NULL),
(204, '241121OCY5fSzj2iMgLL2Swg1dLBdZ2DBJrvT5zAnZ2J6dMqjh5IZu4A1732190351', '247988', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 13:59:11', NULL, '2024-11-21 13:59:11', NULL, NULL, 2, 1),
(205, '241121hIuQ0KGQ5NCojJLPhOR7STzBRUnf4EGJbJUPqoYGj3UONlubyT1732191238', '248836', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:13:58', NULL, '2024-11-21 14:13:58', NULL, NULL, 2, 1),
(206, '241121lAcKnV0Fs34bCdfyqNpbey7CIPmzQPP8K3749BfQrMiUrm9OfY1732191259', '240737', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:14:19', NULL, '2024-11-21 14:14:19', NULL, NULL, 2, 1),
(207, '241121i7GqPABs3NGEq7BvkPzagPFN1Bl74ugg9ZVvWlCjBDJM7YGUFn1732191548', '245734', '::1', 'Chrome 129.0.0.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:19:08', NULL, '2024-11-21 14:19:08', NULL, NULL, NULL, NULL),
(208, '2411218Q1ELqr5HAwKAscNlIr7NnMmg1tnIRQCaPNaqBit0U1wSEeKPg1732191558', '246081', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:19:18', NULL, '2024-11-21 14:19:18', NULL, NULL, 2, 1),
(209, '241121zEaBQCNsOIkSrYchq6nL9RrVA1w9MEBCcmbV7g3h3zMWKjqCEO1732191572', '247865', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:19:32', NULL, '2024-11-21 14:19:32', NULL, NULL, 2, 1),
(210, '241121ryHWz1eQzJfuadks18sIbW358ZE6tDCF85N3SL1lSR6RIgWtCW1732191586', '246029', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:19:46', NULL, '2024-11-21 14:19:46', NULL, NULL, 2, 1),
(211, '241121UGfRTkZIQYbrsFzJDBO8HMhu8p7U2JLTjnVJwbwreoHK1Ae82e1732191598', '240972', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:19:58', NULL, '2024-11-21 14:19:58', NULL, NULL, NULL, NULL),
(212, '241121OWH8iVsl38jaaPwu0UkYArPEYH5phUyADRAcT9hg0lBBqmhqF11732191605', '246279', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:20:05', NULL, '2024-11-21 14:20:05', NULL, NULL, 2, 1),
(213, '241121frYwoLfYbpUJZKq4jKw4ui9bbqVuSeWmENF4PE1vJqD6mFFrjC1732192150', '248010', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:29:10', NULL, '2024-11-21 14:29:10', NULL, NULL, 2, 1),
(214, '241121KIc6R20ZK8cM2gOWwWKwmWVnRbpVIffg2k5yAlhl6kd72y3MoR1732192158', '243002', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:29:18', NULL, '2024-11-21 14:29:18', NULL, NULL, 3, 1),
(215, '241121ETYdSfPyHqh1pV2n1ABukJiV4QllMrUl0CYiZAy8Vsk83YgyDw1732192170', '246877', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:29:30', NULL, '2024-11-21 14:29:30', NULL, NULL, 3, 1),
(216, '241121WAQd1iEBa6A3ev45dlJjABfcuel1IOOCJVGm0iuMVt1C8m7JcU1732192192', '248735', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:29:52', NULL, '2024-11-21 14:29:52', NULL, NULL, 7, 1),
(217, '241121EUqdbyC4DTusy3rwr0NJC6TBaDSN7zeZ2C946dbKl5rYiOCedc1732192501', '240499', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:35:01', NULL, '2024-11-21 14:35:01', NULL, NULL, 7, 1),
(218, '241121UUC89qidFGcETs5J9ES5JdGizFbE2eBB4V9FKcjJHj9UAMl5zV1732192512', '242616', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 14:35:12', NULL, '2024-11-21 14:35:12', NULL, NULL, 7, 1),
(219, '241121UZ2J8OaSpfUUcTGk0PBanvRaIVC0GvEEQnZdEeOMzzaHTbo3LR1732195173', '247943', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-21 15:19:33', NULL, '2024-11-21 15:19:33', NULL, NULL, 7, 1),
(220, '241125WODnEJYGmzwCH6sji5zCG7mZAKiutflqHsc2E8CddI3ITWi40g1732522310', '243790', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-25 10:11:50', NULL, '2024-11-25 10:11:50', NULL, NULL, 1, 1),
(221, '2411250zmzbDFuZpMEbi6Myb8z3cO1lGTR1J1lrkdE9uOEqdygfQ7zPF1732526187', '249092', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-25 11:16:27', NULL, '2024-11-25 11:16:27', NULL, NULL, 1, 1),
(222, '241125eyD34bgSMmQQpCQf8zw9WtqQ3IkaHAUivPyQS2hy1QJW5tKv2A1732546343', '249269', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-25 16:52:23', NULL, '2024-11-25 16:52:23', NULL, NULL, 1, 1),
(223, '241125I2oToVYWyud3d7T6baEgTskM05RLV1UckMnlrI8FTcSqr4Vk5o1732546376', '247308', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-25 16:52:56', NULL, '2024-11-25 16:52:56', NULL, NULL, 1, 1),
(224, '241126RcSvQI4S0H3Vp9WZdWRfHFiqyb3rUM1msibWCg4QcUyOFcyvgk1732614895', '243185', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-26 11:54:55', NULL, '2024-11-26 11:54:55', NULL, NULL, 1, 1),
(225, '241126v94Kl0Gmsj5QFmlGwQ56DibyhUqsYV9we7YL5Rt4iae9DPQuEk1732618935', '243088', '127.0.0.1', 'Firefox 132.0', 'Linux', 'actif', 'auth', NULL, '2024-11-26 13:02:15', NULL, '2024-11-26 13:02:15', NULL, NULL, 1, 1),
(226, '241203UBf3LC5gWOHVPPeddrOgF6A1ko3Iv1DTtUNp8ZQAD2cQs8bZ8G1733211739', '248702', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 09:42:19', NULL, '2024-12-03 09:42:19', NULL, NULL, 1, 1),
(227, '241203WuNA1brUKQfQfMGcN6VJuyiyQpHUu8R2609l5jPI7hVhSfiHle1733214238', '244028', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 10:23:58', NULL, '2024-12-03 10:23:58', NULL, NULL, NULL, NULL),
(228, '2412035w3lsHrVWrPLg3OpS7f4EEKrOW5047KwKpKdM21D8unjSlnM8i1733214266', '244795', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 10:24:26', NULL, '2024-12-03 10:24:26', NULL, NULL, 1, 1),
(229, '241203sndKj78IfpgfPd1z7QJOSrLQzYjFhnnaiQLdzL4mW6F5uNVFbI1733221061', '241116', '192.168.139.56', 'Chrome 102.0.0.0', 'Windows 10', 'actif', 'auth', NULL, '2024-12-03 12:17:41', NULL, '2024-12-03 12:17:41', NULL, NULL, 1, 1),
(230, '241203gSRKCRy9j441WnPt6uErIdghuRjg91ljMnScRYCCcUqTFnDjz11733221061', '245182', '192.168.139.56', 'Chrome 102.0.0.0', 'Windows 10', 'actif', 'auth', NULL, '2024-12-03 12:17:41', NULL, '2024-12-03 12:17:41', NULL, NULL, NULL, NULL),
(231, '241203z2dRUTEAKOUFB1zFpk4ERydkqqemknVYSud5zHlv6002NdKYgY1733221121', '242914', '192.168.139.56', 'Chrome 102.0.0.0', 'Windows 10', 'actif', 'auth', NULL, '2024-12-03 12:18:41', NULL, '2024-12-03 12:18:41', NULL, NULL, 2, 1),
(232, '241203yl2PFBrGIwIzABqhPtPJJLtpLYbM9RYvmP9uz34kHgHFbDEPzL1733221122', '249402', '192.168.139.56', 'Chrome 102.0.0.0', 'Windows 10', 'actif', 'auth', NULL, '2024-12-03 12:18:42', NULL, '2024-12-03 12:18:42', NULL, NULL, NULL, NULL),
(233, '241203L29c8FkEPl9aIO6ciPTf4irkMAtjqC8h21IGrn8yLzwG8zNhP11733221637', '242393', '192.168.139.123', 'Edge 131.0.0.0', 'Android', 'actif', 'auth', NULL, '2024-12-03 12:27:17', NULL, '2024-12-03 12:27:17', NULL, NULL, 1, 1),
(234, '241203HkK7F4BaEuNzv1D5qVyznK8OjN7NuRMDhOHQCRcih2W02aWYdk1733221638', '243912', '192.168.139.123', 'Edge 131.0.0.0', 'Android', 'actif', 'auth', NULL, '2024-12-03 12:27:18', NULL, '2024-12-03 12:27:18', NULL, NULL, NULL, NULL),
(235, '2412030GOZAhwY699UqZpVsSaqanpu4nvtH64TIqw4T0ry4iB3MC1vr31733226350', '242797', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 13:45:50', NULL, '2024-12-03 13:45:50', NULL, NULL, 1, 1);
INSERT INTO `users_logs` (`log_id`, `log_token`, `log_code`, `log_ipaddress`, `log_device`, `log_platform`, `log_status`, `log_type`, `log_notes`, `log_created_at`, `log_created_by`, `log_login_at`, `log_logout_at`, `log_deleted_at`, `log_user_id`, `log_school_id`) VALUES
(236, '241203e9Fk7LiygTW1tjPARcdAPCafG43oU2BgNnK2lW1yQUDStHKJ2K1733226387', '248064', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 13:46:27', NULL, '2024-12-03 13:46:27', NULL, NULL, 1, 1),
(237, '241203gj08cQFAicqQ1ruHWTwNcCW0mn3ANcUIZoNTCEF9bSChwtTNeY1733226456', '243702', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 13:47:36', NULL, '2024-12-03 13:47:36', NULL, NULL, 1, 1),
(238, '241203NtNPfNgZF9gsUITnvgVyYnKfm6qiFcWtCpChnVgJAP4ZgbsuQI1733226463', '241271', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 13:47:43', NULL, '2024-12-03 13:47:43', NULL, NULL, NULL, NULL),
(239, '241203GsG1bVkdwcVkfO73el4lrynwTF6pMch7D9Gj8lqq7699UQEDZs1733226481', '246015', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 13:48:01', NULL, '2024-12-03 13:48:01', NULL, NULL, 1, 1),
(240, '241203NAFpWILrulvN1bKtvsm9WDmcYvFohDzP4O8fFifEafJRgfpTny1733226767', '243540', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 13:52:47', NULL, '2024-12-03 13:52:47', NULL, NULL, 1, 1),
(241, '241203GLCyvqaaWWSEo9sRcEH9T6Il9QWgh2ErTAzoCZqMUtKbKqK4ej1733226780', '242920', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 13:53:00', NULL, '2024-12-03 13:53:00', NULL, NULL, 1, 1),
(242, '241203c3sMBq37eipZT0Aq6Wco60rBl0Yysq4cDNEc78wJEBOFY82FO51733235996', '244660', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-03 16:26:36', NULL, '2024-12-03 16:26:36', NULL, NULL, NULL, NULL),
(243, '241204dTz9MEi6fQzng1avkt9R5nF4fkol4CcyrdIQn7zLW3gUltJfOF1733299792', '249928', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-04 10:09:52', NULL, '2024-12-04 10:09:52', NULL, NULL, 1, 1),
(244, '241204W1pr7Ikd9jkHWPq9GT2S1HEjd1R1KO4g7Oumn3DweyIr33GwyV1733307552', '242445', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-04 12:19:12', NULL, '2024-12-04 12:19:12', NULL, NULL, 1, 1),
(245, '241204GMeWEV04v2NnO9zYBC1pRAhTbUU0m4FUK3PbqlOg9yPSyKRN5K1733318186', '241038', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-04 15:16:26', NULL, '2024-12-04 15:16:26', NULL, NULL, 1, 1),
(246, '241204u8jMwcEINFcIqmjfAD3BJmrmSZyrfLUlePZgRTyITDCehgW9291733318202', '244698', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-04 15:16:42', NULL, '2024-12-04 15:16:42', NULL, NULL, 1, 1),
(247, '241204525SjYHO4KvFjAhGgvSLNKmcNlCrGJ1Ih5Ywk8y7EZz4hOlBbW1733319154', '246538', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-04 15:32:34', NULL, '2024-12-04 15:32:34', NULL, NULL, NULL, NULL),
(248, '241204UDDZk9YmpagoYr3AsoMAOEzIItabILPdTWrpIYlrCFMiD6eKLG1733324626', '245293', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-04 17:03:46', NULL, '2024-12-04 17:03:46', NULL, NULL, 1, 1),
(249, '241207nzHpvqoBwPk7JQUZ0KWKLc3Rf8qEUMKnJ9IMEOaQelqmd8zy5r1733557494', '247679', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-07 09:44:54', NULL, '2024-12-07 09:44:54', NULL, NULL, 1, 1),
(250, '241207NJJ0ZatYIkYP1EoqFq6mUkz2rcqYdDwa3by77lLLTHi25qAaSI1733563123', '244965', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-07 11:18:43', NULL, '2024-12-07 11:18:43', NULL, NULL, 1, 1),
(251, '241220Lbj24v6ufQV2rjteFhdAUIuem1qKyqsgKGBhcvHQNlBfku5ydy1734695913', '240741', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-20 13:58:33', NULL, '2024-12-20 13:58:33', NULL, NULL, 1, 1),
(252, '241220DUSo0WJ6vkZb1M90uKbnqPzrOeFTyS3iEkPJW0lsHSOAp0y1Np1734696123', '246512', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-20 14:02:03', NULL, '2024-12-20 14:02:03', NULL, NULL, 1, 1),
(253, '241220y85nwN2MKOSeuiNlz9l8sTCNUN8mbYwqD9N3NNbvAKZleELSkL1734696132', '242475', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-20 14:02:12', NULL, '2024-12-20 14:02:12', NULL, NULL, 7, 1),
(254, '241220PzfMw17EPyj3ezgca1iVGdyQsOsY4tZNRtbW63OPZs2lZzoUju1734702758', '244043', '127.0.0.1', 'Firefox 133.0', 'Linux', 'actif', 'auth', NULL, '2024-12-20 15:52:38', NULL, '2024-12-20 15:52:38', NULL, NULL, 7, 1),
(255, '2501285isldsNohUGLbYfHi2h49FNc4doLGK1dk5eqCps5udv2Iht79R1738073465', '254861', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'auth', NULL, '2025-01-28 16:11:05', NULL, '2025-01-28 16:11:05', NULL, NULL, 1, 1),
(256, '250128KoPEyjRUfSnCfiUydMIFNSbhCybee4gjNCFmFkR9cLCGRIVjBj1738073752', '252914', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'auth', NULL, '2025-01-28 16:15:52', NULL, '2025-01-28 16:15:52', NULL, NULL, NULL, NULL),
(257, '250128mRhzl3o9GrIdI6MSCmCosO5NyAV3JDaGofigzGIO4BZZt8f5d81738073759', '254514', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'auth', NULL, '2025-01-28 16:15:59', NULL, '2025-01-28 16:15:59', NULL, NULL, 1, 1),
(258, '250128pl6U03tkhWBdWt35E6RP2ALCB9MDVfIIJFQrAntaTQjNs98DpG1738074118', '256463', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'auth', NULL, '2025-01-28 16:21:58', NULL, '2025-01-28 16:21:58', NULL, NULL, NULL, NULL),
(259, '250128919wAbMpIYNKZ8KCw85BtPcwPuAYReBRiOVcTA74qapndCcOmO1738074756', '250976', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'auth', NULL, '2025-01-28 16:32:36', NULL, '2025-01-28 16:32:36', NULL, NULL, NULL, NULL),
(260, '250128ZYa5yHaGFRoBsvcioKFIw93V9VEdylBGjMiCv8oEFVVDe9Pw2K1738075177', '258362', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'auth', NULL, '2025-01-28 16:39:37', NULL, '2025-01-28 16:39:37', NULL, NULL, 1, 1),
(261, '250128wB6KvyWUu4g1ofCLFh0pvIN6nd1KJFnis1o1jtwbeiMsydUIN81738080596', '252383', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'auth', NULL, '2025-01-28 18:09:56', NULL, '2025-01-28 18:09:56', NULL, NULL, NULL, NULL),
(262, '250128jSZVfD1Dwaq5JkDYNmFztmjBjHUVtKybV6c6aCv4QKbBSv414l1738080603', '250525', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'auth', NULL, '2025-01-28 18:10:03', NULL, '2025-01-28 18:10:03', NULL, NULL, 1, 1),
(263, '250130CEJVkbSKYPJnwzlNcVdAqpiLG2SbDO47HtANTGcrrCekdPnKpH1738248954', '252681', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'auth', NULL, '2025-01-30 16:55:54', NULL, '2025-01-30 16:55:54', NULL, NULL, 1, 1),
(264, '2501305sO9Z80Sn123bIDKD3s32cMymmGlJQhehR34Z9IUgRizDy4vCQ1738249039', '250549', '127.0.0.1', 'Firefox 134.0', 'Linux', 'actif', 'auth', NULL, '2025-01-30 16:57:19', NULL, '2025-01-30 16:57:19', NULL, NULL, 1, 1),
(265, '250210w3rEwOvJ39f0L2AzRTOiEyMKyK6MqjtTohNDFSy6jIZPPzLLRz1739173707', '257611', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-10 09:48:27', NULL, '2025-02-10 09:48:27', NULL, NULL, 1, 1),
(266, '250210jAiRKmLhsdeJJ6gBDGi94t9IlRiyvqCzuKigeUGFSj2WwKi65q1739174320', '257564', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-10 09:58:40', NULL, '2025-02-10 09:58:40', NULL, NULL, 1, 1),
(267, '250217emBOEjBt7G56Mon9iQiylVhu0a7t5Ydh1nb2VeYt3SYt0bgWuW1739796939', '258283', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-17 14:55:39', NULL, '2025-02-17 14:55:39', NULL, NULL, 7, 1),
(268, '2502175jzi5QS2CaBKwq4FIQ0Gp2IsCFsZVev3dz7vvCn0en7tliqBNm1739797190', '253074', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-17 14:59:50', NULL, '2025-02-17 14:59:50', NULL, NULL, 7, 1),
(269, '250217uFGd29gWUyUL5gbcWiLgB9gUWACu6vQwt6KVtSfOYG4gAfkrND1739797198', '252461', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-17 14:59:58', NULL, '2025-02-17 14:59:58', NULL, NULL, 7, 1),
(270, '250225cOWhpN03Ql77rLBdUps7IQwrwDBAbl36j4vtorohdg7UhHvwwy1740477116', '250244', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-25 11:51:56', NULL, '2025-02-25 11:51:56', NULL, NULL, 1, 1),
(271, '2502251cOgkr7I1cl1HCfsQuWGc1emAczM2eNTi7ZFmKnBavSeQuw4EC1740477548', '257943', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-25 11:59:08', NULL, '2025-02-25 11:59:08', NULL, NULL, NULL, NULL),
(272, '250225bJ1qhymg7fFYHNTaVYQP26n4BJhWy9ET2MsGnnZShonKgq3E8N1740481458', '251584', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-25 13:04:18', NULL, '2025-02-25 13:04:18', NULL, NULL, NULL, NULL),
(273, '250225l1Tf4U0BqSfu91DGTBc7j0yzPmzKcTpLQIKn4p1dUZcqvmW5wi1740484761', '259250', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-25 13:59:21', NULL, '2025-02-25 13:59:21', NULL, NULL, NULL, NULL),
(274, '2502253m8NBB15lAb6LgPkNQ4Al5uy8zloG2mupghlwfQkCgstdeh7TF1740491456', '255896', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-25 15:50:56', NULL, '2025-02-25 15:50:56', NULL, NULL, 1, 1),
(275, '250225qCbH88IQyyuiEbpDcE0dAH45hdUGbtaqTGdRGaWAjaleI4C7h51740494849', '259572', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-25 16:47:29', NULL, '2025-02-25 16:47:29', NULL, NULL, 8, 9),
(276, '250225euTgMNL7oUw8wfuNbS2HNcCosJvP3qzc45EpLICe99JLD8du4d1740495103', '255509', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'account', NULL, '2025-02-25 16:51:43', NULL, '2025-02-25 16:51:43', NULL, NULL, 8, 9),
(277, '250225y2izk6rqVzFh4n9gZw7NPHB0mH1fHAEBPIawglyhyT5pPBBPDu1740496864', '257630', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-25 17:21:04', NULL, '2025-02-25 17:21:04', NULL, NULL, 8, 9),
(278, '250225cKcNHKUCvYEbd0pNgWlIDfzrbnMvYfmH0QiQVSUmZKYAoJ182p1740497009', '254367', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-25 17:23:29', NULL, '2025-02-25 17:23:29', NULL, NULL, NULL, NULL),
(279, '250226h6kSwlcJ8Sww9Z2PFatnbaEDz8HD3YsNRNSnVmnTIq5BSdBF9L1740552235', '250012', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-26 08:43:55', NULL, '2025-02-26 08:43:55', NULL, NULL, NULL, NULL),
(280, '250226bU04Lob7TEAhynzkTFgF7TH2rIebcWYnHC3ZDdS6sS9ebnvZMI1740552272', '255059', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-26 08:44:32', NULL, '2025-02-26 08:44:32', NULL, NULL, 1, 1),
(281, '2502264j3OOOjfNnwoZPZj1SjJeEbB7D2EeN6NSnNeRUiRARPPHIIMNE1740554036', '259787', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-26 09:13:56', NULL, '2025-02-26 09:13:56', NULL, NULL, 1, 1),
(282, '250227R1RyQCpzni6VfHzfokqaQ6m3JqssFOez2Hk0ZFkesc11TOnNqa1740659881', '256547', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-27 14:38:01', NULL, '2025-02-27 14:38:01', NULL, NULL, NULL, NULL),
(283, '250228J74HQPkGP4WjzDLN1rrKM75uZJUNFYYqq0NTchYf9PkPF1eeVk1740727790', '254380', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-28 09:29:50', NULL, '2025-02-28 09:29:50', NULL, NULL, NULL, NULL),
(284, '250228Pu6PaIOH6iMBvJLFJt3EsM4vITu7U1zCVOD0k4EspUebozbgLd1740743696', '252956', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-28 13:54:56', NULL, '2025-02-28 13:54:56', NULL, NULL, NULL, NULL),
(285, '25022897JB2A2JK3Y0rmUCZoJ2HEhqHgUOgcmpuFCGh44nElQuwgTfF71740747965', '251644', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-28 15:06:05', NULL, '2025-02-28 15:06:05', NULL, NULL, 7, 1),
(286, '250228pP9ZvKHpd8ARn2v2Y6O2IKWBRAIZhqKMeW4y3IDICB9OCDlAFa1740748195', '252998', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-28 15:09:55', NULL, '2025-02-28 15:09:55', NULL, NULL, 7, 1),
(287, '250228cg1bTmUaPB6Yb9wK0Hzk4JFo6GEbTdwJ1eFJhRrGJ7Tsqlvgns1740749539', '258815', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-28 15:32:19', NULL, '2025-02-28 15:32:19', NULL, NULL, NULL, NULL),
(288, '250228ZhPdC6gm6YOViFL920lC2G6AHBStG4lF04eElcU08ncq00JaW01740749548', '257565', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-28 15:32:28', NULL, '2025-02-28 15:32:28', NULL, NULL, 7, 1),
(289, '250228iV2Qsi9oOMrSmPws0OhPdSnIfjzz2lwo2kd5I98WYT4Vnpes0q1740749599', '251003', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-02-28 15:33:19', NULL, '2025-02-28 15:33:19', NULL, NULL, 7, 1),
(290, '250301PDSTH4j3njMc1dQdIBbquqAIhDjE36dKKQUiscWzfO2su5lRAY1740814777', '257158', '127.0.0.1', 'Firefox 135.0', 'Linux', 'actif', 'auth', NULL, '2025-03-01 09:39:37', NULL, '2025-03-01 09:39:37', NULL, NULL, NULL, NULL),
(291, '250505PmHcV99YBKOvTEvcUTIrTi4eID5ljrTBTGNWTK2AaphdVnpqLg1746448859', '253613', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'auth', NULL, '2025-05-05 14:40:59', NULL, '2025-05-05 14:40:59', NULL, NULL, 1, 1),
(292, '250529wylYIAePbhFpFqCv9baNGWC3qy7s89839VjLQk80LIl40H8bl51748507457', '254102', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'auth', NULL, '2025-05-29 10:30:57', NULL, '2025-05-29 10:30:57', NULL, NULL, 7, 1),
(293, '250530gji0r2DsskoPilUejmJbPoTuTMoTMrUF5ciyaApjD8zadqhCjE1748594143', '252981', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'auth', NULL, '2025-05-30 10:35:43', NULL, '2025-05-30 10:35:43', NULL, NULL, 7, 1),
(294, '250530OE67sSi0AgND5s1CO74fD66MgMwolS3i76Vur3P1def9Nz77TH1748616834', '254820', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'auth', NULL, '2025-05-30 16:53:54', NULL, '2025-05-30 16:53:54', NULL, NULL, 7, 1),
(295, '250602DO7JPAQZrmFdJAOEZLwr2NmuamwcQQvmvzMcfFCj8o19qRrwpP1748853315', '254095', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'auth', NULL, '2025-06-02 10:35:15', NULL, '2025-06-02 10:35:15', NULL, NULL, 7, 1),
(296, '250602TBBfI6w8mOZJhEZRq2T6q8WYNUVdyuJRlMpc2uflitFY43EiNT1748864368', '258633', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'auth', NULL, '2025-06-02 13:39:28', NULL, '2025-06-02 13:39:28', NULL, NULL, NULL, NULL),
(297, '250602FcAEv26ZQVDtQweO8lEceiQ32yTrBHbY3n19R1SsbrYE4AuSM31748864439', '259296', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'auth', NULL, '2025-06-02 13:40:39', NULL, '2025-06-02 13:40:39', NULL, NULL, 7, 1),
(298, '250602NRDbMOyQDpnWQojBYBIwmAiHbasmtQg3mCbo1i7ishapoDKOsL1748870670', '253197', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'auth', NULL, '2025-06-02 15:24:30', NULL, '2025-06-02 15:24:30', NULL, NULL, 7, 1),
(299, '250603uZvqo8tYG0eROUfNkL6JbNyt3T0qTAeI0l3h0l2meBaQimnoDi1748938767', '255997', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'auth', NULL, '2025-06-03 10:19:27', NULL, '2025-06-03 10:19:27', NULL, NULL, 7, 1),
(300, '250603o28EjhBbPZ9VTqnOzKbaPNwNpBuF2770SqNwDeAbv4du2d3qdO1748950594', '254402', '127.0.0.1', 'Firefox 138.0', 'Linux', 'actif', 'auth', NULL, '2025-06-03 13:36:34', NULL, '2025-06-03 13:36:34', NULL, NULL, NULL, NULL),
(301, '250604DG8Qmv4HfOadvLTd5eMFgqgo8GOgcyFTwLToyV6TU7ifFa7yUY1749023445', '254300', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-04 09:50:45', NULL, '2025-06-04 09:50:45', NULL, NULL, 7, 1),
(302, '250604ektc6joVZdUREDIL3ef05KZdcfe2GD60RwRWdlYe2BqZfWLUf71749040495', '259074', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-04 14:34:55', NULL, '2025-06-04 14:34:55', NULL, NULL, NULL, NULL),
(303, '250604sm9adKV1MsVusRUgfdObnbO9aJa7smcGfpUkLbp5pDqVyBQ4ur1749040513', '252194', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-04 14:35:13', NULL, '2025-06-04 14:35:13', NULL, NULL, 7, 1),
(304, '250604Qn6lBeo0GuPeRBM7ZjrE4FAJUU9Cazim967cawErvVggad2r3f1749048129', '251701', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-04 16:42:09', NULL, '2025-06-04 16:42:09', NULL, NULL, 7, 1),
(305, '250606gO2v9piuV82LAwffAISc4Vc6HUscKinfcGo1cD9cHaPRDLFAus1749196874', '257247', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-06 10:01:14', NULL, '2025-06-06 10:01:14', NULL, NULL, 7, 1),
(306, '250606pqojjLMER3vWfrgUOhez7Es7SBvN22eLJskcPjwccJUhylT6KJ1749208164', '257878', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-06 13:09:24', NULL, '2025-06-06 13:09:24', NULL, NULL, NULL, NULL),
(307, '2506069CvCyuqgPBfYNEBR8jeMwLuIeElSSM5PZ4rgQS2w7EjtpANSvQ1749208176', '253414', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-06 13:09:36', NULL, '2025-06-06 13:09:36', NULL, NULL, 7, 1),
(308, '250606ZuzNH0eCcgpF8BUqpqaNudGlbcVsv3MPwDMeDaoATrBisnuNOL1749220353', '255153', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-06 16:32:33', NULL, '2025-06-06 16:32:33', NULL, NULL, 7, 1),
(309, '250607227hhFyFhCOBwZegCvjqtmBpz7CVEZF4VNBURqn2cUnyZCCoET1749282932', '251915', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-07 09:55:32', NULL, '2025-06-07 09:55:32', NULL, NULL, 7, 1),
(310, '250607fB36e06hzZnwMV9PI0QNP1rUASLfBMkdh2SUt4WqGRtSFFTItr1749302142', '252772', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-07 15:15:42', NULL, '2025-06-07 15:15:42', NULL, NULL, NULL, NULL),
(311, '2506090FNPhOWVcGN855obVQ6RpY5eRhKSBSuokqeaSikeNgNq1y2OiU1749451491', '253595', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-09 08:44:51', NULL, '2025-06-09 08:44:51', NULL, NULL, 7, 1),
(312, '2506099552ar7iloksWlgrifpoD1IdvKJa3Q3wTLu1OZDz8t5ItWL5EL1749465080', '251917', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-09 12:31:20', NULL, '2025-06-09 12:31:20', NULL, NULL, 7, 1),
(313, '250609OmwTPMbkKV79lBjlovmRm4kVj95BiyhDLG9IBPdTavSi0D7al21749468920', '257501', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-09 13:35:20', NULL, '2025-06-09 13:35:20', NULL, NULL, 7, 1),
(314, '250609NCH8hLYiALHbdMKqRFzaCGTo4Du2Jb3vhORyQFwacoqiH5boDv1749469069', '251447', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-09 13:37:49', NULL, '2025-06-09 13:37:49', NULL, NULL, NULL, NULL),
(315, '250609oYeGW51vlfCA116EC5AmqMT35nMtwuzosRnYz15OQjuNIWib3S1749470569', '252494', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-09 14:02:49', NULL, '2025-06-09 14:02:49', NULL, NULL, NULL, NULL),
(316, '250609L1V4S77unp8FbYmGnbFiTEvYSWPshpz6GMKLelFuRjpC0szLMQ1749478919', '257848', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-09 16:21:59', NULL, '2025-06-09 16:21:59', NULL, NULL, 7, 1),
(317, '250611PPsLv3U6gpkybjZL9OBwKKoo73nq39WJ6KhZmYp8bk1cy3cMgi1749626618', '254289', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-11 09:23:38', NULL, '2025-06-11 09:23:38', NULL, NULL, NULL, NULL),
(318, '250611F3yA4ep7teDCCaupIKGI7rGoZgZyNWlpDJzYKmpozGlRGbMkjy1749626638', '256915', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-11 09:23:58', NULL, '2025-06-11 09:23:58', NULL, NULL, 7, 1),
(319, '250611d3lMvAp4m4kFhWZNz589I2lZKBHMh76Hwe36taYc99HO8ZYOtA1749633019', '253471', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-11 11:10:19', NULL, '2025-06-11 11:10:19', NULL, NULL, 7, 1),
(320, '250611ZzBM1dTcKYDqLERIpiWildwSVywnep838DgSkKhwoPpv7lR0vW1749633034', '258077', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-11 11:10:34', NULL, '2025-06-11 11:10:34', NULL, NULL, 7, 1),
(321, '2506119JW2R9fY5MnD8DasSh5jhuRjlPN37pBslJ0jJHV8AFd9GUWm611749645485', '253047', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-11 14:38:05', NULL, '2025-06-11 14:38:05', NULL, NULL, 7, 1),
(322, '250612fcc67UmIu6K39IyOzDAjzdsYyIYCe46CYF88BU0RqFh6YMU3DD1749719121', '252392', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-12 11:05:21', NULL, '2025-06-12 11:05:21', NULL, NULL, 7, 1),
(323, '250612hbAGDqKoqkmsIvc1tNef53b1wH99T7PNYwTMzC2tpPFmgbNCs71749722471', '258995', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-12 12:01:11', NULL, '2025-06-12 12:01:11', NULL, NULL, 7, 1),
(324, '250612GhSQjot4cVj2e4kQR9I4gj4YOaEk6yGs80AuN97C8lZGb1Ggm71749726472', '252232', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-12 13:07:52', NULL, '2025-06-12 13:07:52', NULL, NULL, 7, 1),
(325, '2506123bTbRnMEtzussWbuRjFnCQYcwsrDaK6Y8N2uzZVwh7ePZm5DG51749744684', '258814', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-12 18:11:24', NULL, '2025-06-12 18:11:24', NULL, NULL, 7, 1),
(326, '250613Uc89W9Kt4WVYKvZNU96YwTpG1Po4U51E17rJItrtZ0GvZWJlcK1749799713', '254023', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-13 09:28:33', NULL, '2025-06-13 09:28:33', NULL, NULL, 7, 1),
(327, '250613UaZkHY91bZJVNT8ovN8D4omZBQ3hojEPOQme9peMRVDVCPh2y01749830222', '256619', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-13 17:57:02', NULL, '2025-06-13 17:57:02', NULL, NULL, NULL, NULL),
(328, '250613PMePOzmObU6FwJJPYTjCLbsmw3YUrnGe58nVQBTo39jegUIPKg1749830232', '250045', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-13 17:57:12', NULL, '2025-06-13 17:57:12', NULL, NULL, 7, 1),
(329, '250613MTru92RchfSMIVPbye3zaNKP6aKeBuoPVCOZ8mEREJlANZ5GN61749832055', '259141', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-13 18:27:35', NULL, '2025-06-13 18:27:35', NULL, NULL, 7, 1),
(330, '250616VqfPRLkwpGNj4w6nm1m6kKhvirfMGgDV30NM7NnAEKDREC66NT1750059918', '254701', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-16 09:45:18', NULL, '2025-06-16 09:45:18', NULL, NULL, 7, 1),
(331, '250616catmwTnb8WOS09GraUiK68ruq6psfhMGBSV7CHUTa23NdFOa7i1750088699', '259383', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-16 17:44:59', NULL, '2025-06-16 17:44:59', NULL, NULL, 7, 1),
(332, '250616kRLF3A6tb8hS9lEuwkDyyHYlPLUOrmqmPG5dPwj0HG7kF4G5Qf1750089111', '251977', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-16 17:51:51', NULL, '2025-06-16 17:51:51', NULL, NULL, 7, 1),
(333, '2506170yAv2GfeSjpokIPPt06Y6s7Dio4P33QE207ldywwfUjtZ8rGIH1750161297', '255031', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-17 13:54:57', NULL, '2025-06-17 13:54:57', NULL, NULL, 7, 1),
(334, '250617shK3NyEFV4WBoucVvmMQYdoJSE5ey5RbBOIlT1nTFpVUbLpRQ91750175167', '254718', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-17 17:46:07', NULL, '2025-06-17 17:46:07', NULL, NULL, 7, 1),
(335, '250619q24n4WMmihWHSyWcGTtPZYJnOKpwqMUB6BKlTsCezJF89nVail1750318332', '252445', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-19 09:32:12', NULL, '2025-06-19 09:32:12', NULL, NULL, 7, 1),
(336, '250619LBNrJ5EnQN2VD9NCeEqZOAUbd6yly1RcLcVzzMeMo2UciCk16u1750335675', '257077', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-19 14:21:15', NULL, '2025-06-19 14:21:15', NULL, NULL, NULL, NULL),
(337, '250619oRmyU1mcFb9AtvgNPwmBJWalmcLzKw3VR603ukQIYNgCegcper1750335685', '259460', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-19 14:21:25', NULL, '2025-06-19 14:21:25', NULL, NULL, 7, 1),
(338, '2506198hjBD1ofTnF0mjpOoYH5iH04kg7fECmZSsenan9LIjOU9Df4Bn1750344569', '252229', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-19 16:49:29', NULL, '2025-06-19 16:49:29', NULL, NULL, 7, 1),
(339, '250620UUijqsQyYTunHgl4yJoZ0oHYLRUUbgoHGo3TCo4HHBd1rW2qin1750419260', '250301', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-20 13:34:20', NULL, '2025-06-20 13:34:20', NULL, NULL, 7, 1),
(340, '2506246UuHsg0UfWLsBusprdSZhWRGvBY3HWdcn9SePWvwUHihMrmZZG1750779244', '256534', '127.0.0.1', 'Firefox 139.0', 'Linux', 'actif', 'auth', NULL, '2025-06-24 17:34:04', NULL, '2025-06-24 17:34:04', NULL, NULL, 7, 1),
(341, '250704PIe3gQmcqYsM1denhBfetni3E03LLYNW6moN5zvDJSihosvVYQ1751633620', '256114', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'auth', NULL, '2025-07-04 14:53:40', NULL, '2025-07-04 14:53:40', NULL, NULL, 9, 1),
(342, '250704Iw2ql0ZszUDpAHBcgPSEn9PlSs4WwLGA4gVfoH9uSmMKf8eBW31751633836', '259825', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'account', NULL, '2025-07-04 14:57:16', NULL, '2025-07-04 14:57:16', NULL, NULL, 9, 1),
(343, '250704FJPiAAu2GFQgTl6r16Yizdr1KCei2EGCDFrPU8LS2gqu2ZgOIa1751633879', '255814', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'account', NULL, '2025-07-04 14:57:59', NULL, '2025-07-04 14:57:59', NULL, NULL, 9, 1),
(344, '250704W4UQ5dD7cFRUKdnK2rg4Awh4RMKedJofvPFh0URWzruUa8Qzw21751640398', '259045', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'auth', NULL, '2025-07-04 16:46:38', NULL, '2025-07-04 16:46:38', NULL, NULL, NULL, NULL),
(345, '250704KaEzpbodiE82F2sMeBpNLpwYHqpM3y7Ev4nnRkYE9GF1jCZtFz1751640414', '251015', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'auth', NULL, '2025-07-04 16:46:54', NULL, '2025-07-04 16:46:54', NULL, NULL, 9, 1),
(346, '250704euN5dYRgOuVCPwgu2PYNky8fVTErPEqIajMYE0CyqmBryuhRQj1751640421', '256133', '127.0.0.1', 'Firefox 140.0', 'Linux', 'actif', 'auth', NULL, '2025-07-04 16:47:01', NULL, '2025-07-04 16:47:01', NULL, NULL, 9, 1),
(347, '25081188bZO7VRuiO4RcGQLQE1z3mZqCCCZkc74akn4FhsFKZO1Aj3og1754917323', '257388', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-11 15:02:03', NULL, '2025-08-11 15:02:03', NULL, NULL, 7, 1),
(348, '250811s7TFeH2DoLPWvgcwNaY7doLrPplWroZE8BRt1l1s5Ng2NAaRmk1754917323', '258042', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-11 15:02:03', NULL, '2025-08-11 15:02:03', NULL, NULL, NULL, NULL),
(349, '250811PussyycvTf2BWmEAj1RqTScuIY1mD1JFyaLyk20AcJzaCL2rEc1754917423', '251166', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-11 15:03:43', NULL, '2025-08-11 15:03:43', NULL, NULL, 7, 1),
(350, '250811fdfPRpcQ7hCFKpLacBuM3RzgaW7Ize35p0mYihtODfGJR2UJCa1754917433', '255711', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-11 15:03:53', NULL, '2025-08-11 15:03:53', NULL, NULL, 7, 1),
(351, '250811MzRDQpqgIN3NEQNmb9Yf9dcZGg3deOzDgmFAfsdK79LG1YRNnt1754917441', '254737', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-11 15:04:01', NULL, '2025-08-11 15:04:01', NULL, NULL, 7, 1),
(352, '250811Mq3fDtUfkIT5e4D9Ho9ByA9up79EjuZUtggiizYDSDGIcqJZpU1754920021', '259005', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-11 15:47:01', NULL, '2025-08-11 15:47:01', NULL, NULL, 7, 1),
(353, '250811QndDkwuZqop3lco1QGLWn34KR7YejoDwWD3b5ATDGVGHsVzEpM1754920301', '252780', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-11 15:51:41', NULL, '2025-08-11 15:51:41', NULL, NULL, 10, 1),
(354, '250811NVRqFGpAfT8eFAO9zLUVhoe9KF9483kGCs6MQ36yFDKwqfIkum1754922687', '256241', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-11 16:31:27', NULL, '2025-08-11 16:31:27', NULL, NULL, 10, 1),
(355, '250813TumKn5oMgPZkNU9RM7LF0dRd45h0mMYwgU11nhtv6kAN5l4m3A1755100190', '253154', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-13 17:49:50', NULL, '2025-08-13 17:49:50', NULL, NULL, 11, 1),
(356, '250813sZp1t0WYg9DgJy8bKp8JQ5mdrCCqiizDvYd1uasaj5u2gMTy6o1755100237', '250675', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'account', NULL, '2025-08-13 17:50:37', NULL, '2025-08-13 17:50:37', NULL, NULL, 11, 1),
(357, '2508133JwB7uKdnTPPBgvHsaAIf1mFDdj8UlVOwmmQq3VAZbejzA6yOo1755100526', '253945', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-13 17:55:26', NULL, '2025-08-13 17:55:26', NULL, NULL, 11, 1),
(358, '250813wiVlUozmyzJTdjemGuwDv5kwoP3cP53u0fTdVsRewimOFku6cM1755100542', '256116', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-13 17:55:42', NULL, '2025-08-13 17:55:42', NULL, NULL, 11, 1),
(359, '250813GPpaZSUHbU7HCOhpRZJCaFiH6b6caYGtl7W3HiLrqlbn7oO1Ik1755100602', '254355', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'account', NULL, '2025-08-13 17:56:42', NULL, '2025-08-13 17:56:42', NULL, NULL, 11, 1),
(360, '250813CELGJ6JrqlaNtRW3VRbcQmeqa18U93B9QkC5OTaH3So8ZRzoI91755100883', '254236', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-13 18:01:23', NULL, '2025-08-13 18:01:23', NULL, NULL, 11, 1),
(361, '250813lkimlZzctOzBNzjkHdWAYrbdZY5kfk9RA5IBaBhAQolfZp20s71755100953', '255678', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-13 18:02:33', NULL, '2025-08-13 18:02:33', NULL, NULL, NULL, NULL),
(362, '250813d42sh3P0VUTe68cKb3W7WmvcWMTBrQv9dFyo7suFOdueReSd7v1755100961', '257585', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-13 18:02:41', NULL, '2025-08-13 18:02:41', NULL, NULL, 11, 1),
(363, '250813N3EnWUEQvBjoOtvcVjYoCyE5WM84IY7stLDC3lGbqJVwZazjcv1755101486', '257189', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-13 18:11:26', NULL, '2025-08-13 18:11:26', NULL, NULL, NULL, NULL),
(364, '250814yjMdv5s8fYG1spLUDWT4zSnsiNe1HHoFmCbpHc13oRkk58YjoB1755157038', '254792', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-14 09:37:18', NULL, '2025-08-14 09:37:18', NULL, NULL, NULL, NULL),
(365, '250823mdcKDDW9N36iD68WbUlLHHBjDE3ZROqwZrnrj0J6ALcFL47Vgi1755943184', '251189', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 11:59:44', NULL, '2025-08-23 11:59:44', NULL, NULL, 7, 1),
(366, '250823SYpDwMAYhmoeulKuiP3SByu2CpFtZntqpOFyyRHQFetz62YrlE1755943270', '253471', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 12:01:10', NULL, '2025-08-23 12:01:10', NULL, NULL, 7, 1),
(367, '250823kVqpFhsVtpdP4JGj0JgdYrDtgHaIdyjLBkauma4nBu6R6WceKw1755944385', '257123', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 12:19:45', NULL, '2025-08-23 12:19:45', NULL, NULL, 4, 4),
(368, '250823DT3u0u7z1bEzNfKAYMLu3BcqJ0VkquE6dUBo8K2BZWwzEPPjHb1755944385', '256034', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'password', NULL, '2025-08-23 12:19:45', NULL, '2025-08-23 12:19:45', NULL, NULL, 4, 4),
(369, '250823HVo3sSKlYwwBzumHrSvDeZpNrUUyRcateEhC8wUggTrCKDN13p1755944647', '257696', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 12:24:07', NULL, '2025-08-23 12:24:07', NULL, NULL, 4, 4),
(370, '250823CyQ5WhSwMSH14y7HPlYZMIif0dRLAh7K77OfDB3qJGbkYfzFzg1755944752', '255597', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 12:25:52', NULL, '2025-08-23 12:25:52', NULL, NULL, 4, 4),
(371, '250823ZEv5memJkt59f4lLFgkEaadakMOCf1VWqDA0yaCjd9JpkqkQR41755944752', '253125', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'password', NULL, '2025-08-23 12:25:52', NULL, '2025-08-23 12:25:52', NULL, NULL, 4, 4),
(372, '250823TDougi3Ifg7IF53S9nFaOQbUUqRCbw6ffqYzYzWjw3wm1mdI0P1755944782', '254773', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 12:26:22', NULL, '2025-08-23 12:26:22', NULL, NULL, 4, 4),
(373, '250823K8hZVUAeJin5doBsS8lv2EHbQ4lFiYRfAbr6peGpO6JTeOiu6k1755944792', '253495', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 12:26:32', NULL, '2025-08-23 12:26:32', NULL, NULL, 4, 4),
(374, '250823mRkw8ZiBIdTyEHcbLA2mB2tu7VCijlhDjzDUQfG8e4Vma9qI5G1755944922', '256857', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 12:28:42', NULL, '2025-08-23 12:28:42', NULL, NULL, 4, 4),
(375, '25082357P5FALFBPKYAPms5HaO2ucVjcREBrE3wN6gFwaB3wGdTmtHdu1755944987', '259012', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 12:29:47', NULL, '2025-08-23 12:29:47', NULL, NULL, 2, 1),
(376, '250823fEuY3PRnVh4hFyoae4nbqEDDfScHfJGmmZJMoa9WETpVeAEzmq1755944987', '254959', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'password', NULL, '2025-08-23 12:29:47', NULL, '2025-08-23 12:29:47', NULL, NULL, 2, 1),
(377, '250823JAwZ5aBYUOepVP1VzWCpI6f9YuwJM78L2jfNJSMDLWmZHdvr4p1755946772', '258788', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 12:59:32', NULL, '2025-08-23 12:59:32', NULL, NULL, 2, 1),
(378, '250823WU2ckWpp32S0R61iioZGObbJsZNW2QELMh6HNjq7tfpUlRvVH11755946781', '250186', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 12:59:41', NULL, '2025-08-23 12:59:41', NULL, NULL, 7, 1),
(379, '250823sUIEcbcjURFAvlyZON0FPT8cqepoJynNS2KHUAjaQIhJN8kqeK1755947011', '258159', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-23 13:03:31', NULL, '2025-08-23 13:03:31', NULL, NULL, 7, 1),
(380, '250825FlopnyNUekIKSQslSTdCjM9G3gb3erUfavNyL65vsVTycPzVRv1756131264', '254013', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-25 16:14:24', NULL, '2025-08-25 16:14:24', NULL, NULL, 7, 1),
(381, '250825irzNp6TlezSRG5FMaKePo9DecJEoQJQeBrCABY9VRH9bRfLTcb1756131376', '256117', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-25 16:16:16', NULL, '2025-08-25 16:16:16', NULL, NULL, 7, 1),
(382, '2508258izC8wREqGFU1hT7SAPu3L5IT6ZhgpkvyYym6NIdfbsE2vWPjB1756135534', '254769', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-25 17:25:34', NULL, '2025-08-25 17:25:34', NULL, NULL, 9, 1),
(383, '250825O3BBNUqTFizAGZfrwnLkYLFsnfH1NHraBms6CDPnqB8s9rUKSg1756135554', '251737', '127.0.0.1', 'Firefox 141.0', 'Linux', 'actif', 'auth', NULL, '2025-08-25 17:25:54', NULL, '2025-08-25 17:25:54', NULL, NULL, 9, 1),
(384, '250826gLHjKBvieG3cq8ZQbB5cJGBRPcULuP2f91atEaWg88LOk2tdHv1756197110', '257541', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-26 10:31:50', NULL, '2025-08-26 10:31:50', NULL, NULL, 14, 1),
(385, '250826I3r3dAzoUURHt9YaqUicTStJwqkKH9V2zUhNY52AydFlTznP981756197457', '255389', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'account', NULL, '2025-08-26 10:37:37', NULL, '2025-08-26 10:37:37', NULL, NULL, 14, 1),
(386, '250826F9vDKQrPMKLvHgphlqvOFGdAVvo0bIyy9KWQYEUvn8v5jyc5FO1756197474', '258058', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'account', NULL, '2025-08-26 10:37:54', NULL, '2025-08-26 10:37:54', NULL, NULL, 14, 1),
(387, '250826ra2uToA80VktYQwqJVSjuu8sZSAwVVubLSKCDBVpqouQ8T1uQ11756197491', '257417', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-26 10:38:11', NULL, '2025-08-26 10:38:11', NULL, NULL, 14, 1),
(388, '250826ZfO8Bt8PPm2KkLAolFEvoRtEdfOBQ79vDiCPk8w2TeNSwH5Jj31756197508', '257840', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-26 10:38:28', NULL, '2025-08-26 10:38:28', NULL, NULL, 14, 1),
(389, '2508264St3NB2jS5qQG8gCV5oK0aYeW9kLBIF8vRMp0KbVN0JN4wca1r1756198830', '259153', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-26 11:00:30', NULL, '2025-08-26 11:00:30', NULL, NULL, 14, 1),
(390, '250826z5gk2lJ6OsnrFjOJGwhz0HgOwaz8KfVEV0jWitlcAZoB0a8o8s1756198846', '257470', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-26 11:00:46', NULL, '2025-08-26 11:00:46', NULL, NULL, 7, 1),
(391, '250826gTc5Lrq0aUEKG99oMQVQfnaFW86nRP9kPjuNSJhuylKCTafE7v1756211912', '250751', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-26 14:38:32', NULL, '2025-08-26 14:38:32', NULL, NULL, 7, 1),
(392, '250826HwQeAAS5cbOiAAGjYov0yUrQbUS2IPVrE7egbHQZAEz7MMZR3K1756218150', '254977', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-26 16:22:30', NULL, '2025-08-26 16:22:30', NULL, NULL, NULL, NULL),
(393, '250830DK8FDzZ6KtDB3IeJdsfZtSdHqMdpseUHOQhja6PJUmVNP9Ql2t1756540976', '253766', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-30 10:02:56', NULL, '2025-08-30 10:02:56', NULL, NULL, 7, 1),
(394, '250830jhkQH1DK9bHfdSZPQq8ayBmfiTeVpmI5DzAlUFnw9UPlwUhsR31756547390', '256833', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-30 11:49:50', NULL, '2025-08-30 11:49:50', NULL, NULL, NULL, NULL),
(395, '250830FeScY2MYA3AVjqggjcRM68JIEwckhL8kMskqWqs2H969bMeFnT1756549312', '254189', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-30 12:21:52', NULL, '2025-08-30 12:21:52', NULL, NULL, 7, 1),
(396, '250830R9MoTDg6plhlyLHcWjLFZMnqN69JUqml3Mal96StyuR4l0hNcp1756549402', '250697', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-30 12:23:22', NULL, '2025-08-30 12:23:22', NULL, NULL, 7, 1),
(397, '25083042AEJOmTud9ybi4HJ8DnfszR0HseSS1nf4I07aqfcwjrtyi3PM1756549475', '259501', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-08-30 12:24:35', NULL, '2025-08-30 12:24:35', NULL, NULL, 7, 1),
(398, '250901vP6J5zpUFT3BjqfOaDeaqSuzi6BUKClwaniqYMK9V3gTGgNttv1756710287', '259795', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-01 09:04:47', NULL, '2025-09-01 09:04:47', NULL, NULL, NULL, NULL),
(399, '250901DAGD9EawyaW4I5U8VhZ4mN4SGja44QmRSJg8VHGfNV4md7Cclw1756711006', '250606', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-01 09:16:46', NULL, '2025-09-01 09:16:46', NULL, NULL, 7, 1),
(400, '250901kw31wEeWG8eveHyJGpTdr43Yf02WoNwT8afO6hmFkyTL6PmCnB1756711262', '258522', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-01 09:21:02', NULL, '2025-09-01 09:21:02', NULL, NULL, 7, 1),
(401, '250901htgBfe1NEEwiQ73NEtapzi8LL2A0aWcIKtaGhozs6cfq9GecSj1756711272', '258272', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-01 09:21:12', NULL, '2025-09-01 09:21:12', NULL, NULL, 7, 1),
(402, '250901zCV0fieLhgFGrD4VtmZPHYhiUUaJKOmzy3dHpALmluhQlmZPI11756719135', '250293', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-01 11:32:15', NULL, '2025-09-01 11:32:15', NULL, NULL, 7, 1),
(403, '250901LEWBgHfuhBLD6Prw7Z6zVBh7pTCRHgJFcQ2NHkQM2vyfkbOo1l1756720187', '251980', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-01 11:49:47', NULL, '2025-09-01 11:49:47', NULL, NULL, 7, 1),
(404, '250901jNV5BiF0AD0SZ7ICwszadZvWRD04NITcr1HmJpoESDg18cPCkm1756721703', '258953', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-01 12:15:03', NULL, '2025-09-01 12:15:03', NULL, NULL, 7, 1),
(405, '250902O8bl0HMlOZ9GoNJy7d92snw9Pvwf4fV2bp4VtJ2pNlagrYledC1756822660', '256345', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-02 16:17:40', NULL, '2025-09-02 16:17:40', NULL, NULL, 7, 1),
(406, '250903VBB1lQv5oaJjmTDH0pyUTSUpJtL6UV1RZO3J5v92cjuNOu9PBr1756883830', '250974', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-03 09:17:10', NULL, '2025-09-03 09:17:10', NULL, NULL, 7, 1),
(407, '25090316Sk4qPGU44fZh9lSo1FRJs6hI07G9UK97Uf719vqM9d0kev1W1756890935', '257865', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-03 11:15:35', NULL, '2025-09-03 11:15:35', NULL, NULL, 7, 1),
(408, '250903jykcTZQRRWGN9cvnG3TfKb7Mzs43jHD1fjzb71HUffSWCuiF1J1756890950', '257109', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-03 11:15:50', NULL, '2025-09-03 11:15:50', NULL, NULL, 7, 1),
(409, '250903ZjyKNbNrEoDJ4qsRAjp6yv8ctVJ4hzW6DOHlUW1ai0R6gkEbJf1756908712', '256296', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-03 16:11:52', NULL, '2025-09-03 16:11:52', NULL, NULL, NULL, NULL),
(410, '250909jmBjzkD1awE2PsDSSBAED1fAfDsUCoLiAPy86B2sVi08qtiawF1757401973', '259884', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-09 09:12:53', NULL, '2025-09-09 09:12:53', NULL, NULL, 7, 1),
(411, '250909MBmf41BYhH5Sg5eppPoCJLwvaNEPgdJ7woMk4ohQEaUYIQ3K1q1757403248', '258480', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-09 09:34:08', NULL, '2025-09-09 09:34:08', NULL, NULL, 7, 1),
(412, '250909AuLZLtFvTvpzowtkRUFigqCnKDqdqbjLBrMsmIROkU8sBQnnCJ1757403263', '257966', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-09 09:34:23', NULL, '2025-09-09 09:34:23', NULL, NULL, 7, 1),
(413, '250909ja7yN4zAg6IqMzQWFq5m30hHhzAFhDlgRREi2y8omOoG6HMFJY1757403455', '257481', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-09 09:37:35', NULL, '2025-09-09 09:37:35', NULL, NULL, 7, 1),
(414, '250909OkLIu0Q4JFDK7ycm3nQGbgGN95ZToj4QvWjAEyn86PnPP86Alt1757422921', '252624', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-09 15:02:01', NULL, '2025-09-09 15:02:01', NULL, NULL, 7, 1),
(415, '250909OMRpUez0e0lsTiSvUArJdd7Y5MVbF5FKH1aymBBkwPEccoun7o1757423243', '257729', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-09 15:07:23', NULL, '2025-09-09 15:07:23', NULL, NULL, 7, 1),
(416, '250916At0LVS04PH3BFhSzA8C10tjl2LDLsuWdwjk87mAzZMYvLl3i3n1758005519', '258690', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 08:51:59', NULL, '2025-09-16 08:51:59', NULL, NULL, 7, 1),
(417, '250916sBukLUM0bWfIVpUFEZbqIuhqpE67vYC0Q39t4iN71j5kzru3To1758029029', '257852', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 15:23:49', NULL, '2025-09-16 15:23:49', NULL, NULL, NULL, NULL),
(418, '250916oZUjUcdmBybN6EARQLwh4bltmBcfui47S5GVW0zS6Nsdz7QCFJ1758031466', '258752', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:04:26', NULL, '2025-09-16 16:04:26', NULL, NULL, 15, 1),
(419, '2509169SDeErwORjbMULLJw2gwllWHTpyW5QztL7IFOGsuB12pAgfEiU1758031632', '251195', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:07:12', NULL, '2025-09-16 16:07:12', NULL, NULL, 15, 1),
(420, '250916jfKVDYYsv2u6hGKMfHUIYThOs31pQ2zlGlWWvb7QY6EudBinRZ1758031640', '256735', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:07:20', NULL, '2025-09-16 16:07:20', NULL, NULL, 15, 1),
(421, '250916zzRfg1cdOwmyWa5bSygfyGGvV7tUGUIIb7DYiAA33v6t9MIpuC1758031655', '258245', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:07:35', NULL, '2025-09-16 16:07:35', NULL, NULL, 15, 1),
(422, '250916CQTfoayL1o9GSitF2GMJwuAnagh22sSeiGc2EzrvoVhTToDaH11758031703', '253358', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:08:23', NULL, '2025-09-16 16:08:23', NULL, NULL, 9, 1),
(423, '250916CuCbjgTVLQ1piOPlQc3RepCyEY965HRfJ3w8Hzub9pzYGSNbpS1758031734', '259160', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:08:54', NULL, '2025-09-16 16:08:54', NULL, NULL, NULL, NULL),
(424, '250916QVWPZykNM9ricRp1weJwfqYYlvvs8aY5hgr33WF8tA7p73kpr51758031777', '254517', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:09:37', NULL, '2025-09-16 16:09:37', NULL, NULL, 9, 1),
(425, '250916cyZ0JjHu61OdOGTjwYps3IfGuNIF9IwzCtq3lFaWruZ0J6AbC31758033142', '255282', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:32:22', NULL, '2025-09-16 16:32:22', NULL, NULL, 16, 10),
(426, '2509169ekPtrv49vwA6VVSE3RlnmJyWdeSBjWq2Pb4nDTdZNZTSt38EM1758033447', '256450', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:37:27', NULL, '2025-09-16 16:37:27', NULL, NULL, 16, 10),
(427, '250916bHhpmkTfVFd2zeSKOHOa9edJzd4OaLy66uHOzqnj8NNmBsumta1758033821', '253556', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:43:41', NULL, '2025-09-16 16:43:41', NULL, NULL, 17, 11),
(428, '2509160oH983K43y5Q53e7dpoqBpjFlP6l2GBWWLKYPmiyU1QZWtj8NL1758033831', '252165', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:43:51', NULL, '2025-09-16 16:43:51', NULL, NULL, 17, 11),
(429, '250916lnqfJkyWk3kd6M4SiPejh3IqMwley9EVmDFVAFlycBEeO9cAqs1758033940', '251836', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:45:40', NULL, '2025-09-16 16:45:40', NULL, NULL, 8, 9),
(430, '250916uuvN1rARssUQup7oAhOEkVgw1uHHV1drTjvHmZHJ8GKuFiGVoc1758033985', '256338', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:46:25', NULL, '2025-09-16 16:46:25', NULL, NULL, 8, 9),
(431, '250916jwOFamBHNt0n4l6qhMIj4OcvvRM5EJsFr8sRZdpRmZeW1ynGjg1758034095', '252236', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:48:15', NULL, '2025-09-16 16:48:15', NULL, NULL, 16, 10),
(432, '2509161SJa4LuSC0R6QSLZrQbGNdw8USkkOo7Ra49BWC4niYbOekzZQ91758034262', '259742', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:51:02', NULL, '2025-09-16 16:51:02', NULL, NULL, 16, 10),
(433, '250916wNDdF4D7GSluNPGF8nbWnoOH7NCiH32GLFsszkpr4VVdKtb7RS1758034274', '250249', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:51:14', NULL, '2025-09-16 16:51:14', NULL, NULL, 8, 9),
(434, '250916g479iSluV7ttS0FTb1aQ9lmN8Pyj0Vi4LniyotlIlWPHBkWE2a1758034292', '251674', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:51:32', NULL, '2025-09-16 16:51:32', NULL, NULL, 8, 9),
(435, '250916ge2Z5Wkiroigh4BzHBbljh3HRsbVTYNUaocs8Wc33E18CksWPS1758034318', '256033', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:51:58', NULL, '2025-09-16 16:51:58', NULL, NULL, 8, 9),
(436, '250916a37al0uk8DF65Yi9Np6u0Wy9HInYSjfevDJKa2JtR89M3PTuz11758034326', '254795', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 16:52:06', NULL, '2025-09-16 16:52:06', NULL, NULL, 8, 9),
(437, '250916cyykwUzrjWmftDM8fLWsOUArv0jp8g7rZDnS1p05CIDSz1cyfk1758035402', '255894', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 17:10:02', NULL, '2025-09-16 17:10:02', NULL, NULL, NULL, NULL),
(438, '250916Sld7ZBh7d9YPkONHVayYWFIDRUBRhvbizkOS5OpGOL9Ok3e2o21758038658', '250077', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 18:04:18', NULL, '2025-09-16 18:04:18', NULL, NULL, NULL, NULL),
(439, '250916YeL9l2PTA67HLCIryhEcR5nDRT9BHiAhQscJRZBejrz0BU1l221758038770', '256481', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 18:06:10', NULL, '2025-09-16 18:06:10', NULL, NULL, 7, 1),
(440, '2509167NcSmzcK8CKvlmyrhUTAm0etAdMAJyG3i8G8HJpj0wFG1Zrioi1758038832', '258073', '127.0.0.1', 'Firefox 142.0', 'Linux', 'actif', 'auth', NULL, '2025-09-16 18:07:12', NULL, '2025-09-16 18:07:12', NULL, NULL, 7, 1),
(441, '250917y1IluwSpETUIrtHSFd0HfVUNTF5eFo6lmYbRyaTnQynmZ2AMg21758095026', '255628', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-17 09:43:46', NULL, '2025-09-17 09:43:46', NULL, NULL, NULL, NULL),
(442, '2509172dV7mYwQJ5y4MMLRhmBp4ZY7kulgSjo1mWzqN3ss82oRwH4dfm1758095168', '255851', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-17 09:46:08', NULL, '2025-09-17 09:46:08', NULL, NULL, 7, 1),
(443, '25091793Q7Am1ie3PHN6ur6wl9nPcwf7c5Sq8FdVFYo7u1hJjOlkhLN11758099168', '255830', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-17 10:52:48', NULL, '2025-09-17 10:52:48', NULL, NULL, NULL, NULL),
(444, '250917pwpjadM06C15Sw9ns3VbYHCSN4owrobHfIqSV3dD2HWTGrEPOH1758099182', '250887', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-17 10:53:02', NULL, '2025-09-17 10:53:02', NULL, NULL, 7, 1),
(445, '250917LRKbgdWSE5IGdPE3fvaB8ZHw5gLvVS35aEeVoji3vV0Imdy6sC1758100643', '255983', '127.0.0.1', 'Unidentified User Agent', '', 'actif', 'auth', NULL, '2025-09-17 11:17:23', NULL, '2025-09-17 11:17:23', NULL, NULL, NULL, NULL),
(446, '25091753qSGKSlsRT9TlyMuJQCYLD2dzsuCh0Fs0dveO51avmVeqaI3Q1758100648', '254902', '127.0.0.1', 'Unidentified User Agent', '', 'actif', 'auth', NULL, '2025-09-17 11:17:28', NULL, '2025-09-17 11:17:28', NULL, NULL, NULL, NULL),
(447, '250917z5A6OaUM9TMnFpPLAAtGpgmP2NYIyKQTafOZ2ZMwwHKlKvQNP41758118102', '255378', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-17 16:08:22', NULL, '2025-09-17 16:08:22', NULL, NULL, NULL, NULL),
(448, '25091717Uzu67aWoHu5mi8StdCkCiSK9WWucuS5R4ONcqAH6b5wn1w1M1758118540', '251658', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-17 16:15:40', NULL, '2025-09-17 16:15:40', NULL, NULL, 7, 1),
(449, '250917gzFwznPBiGUlymvjeFM8M3phsj9HAk2DbLe7HiAzAk5AsWgG4f1758120926', '253688', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-17 16:55:26', NULL, '2025-09-17 16:55:26', NULL, NULL, 7, 1),
(450, '250917FJuJ7a8ydJzGr1MjWGefEetOQQ17tg4Z8nkkkwgOWDzND0F7mO1758128259', '250625', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-17 18:57:39', NULL, '2025-09-17 18:57:39', NULL, NULL, 7, 1),
(451, '250917DRyfntGRtD2AreNmii2lLAwEQkv79BaMTEaaZSbjpfzckUIgHR1758128734', '259064', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-17 19:05:34', NULL, '2025-09-17 19:05:34', NULL, NULL, 7, 1),
(452, '250918ny80NGjDN0mW9jzRg7QpHKOk5A5kWJe7wslyCHuFBtSWHqaMu41758178629', '252656', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-18 08:57:09', NULL, '2025-09-18 08:57:09', NULL, NULL, 7, 1),
(453, '250918U9T1i3GZ8MSBZ87unaNbBIALefAVwhl2I0bGgeFppA3DMfKaww1758183492', '250668', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-18 10:18:12', NULL, '2025-09-18 10:18:12', NULL, NULL, 7, 1),
(454, '250919vCISS48V3wZclUU7VQL1FGVm3z4W0aP0yHnGeq5w3i8JPGVsg01758287411', '251108', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-19 15:10:11', NULL, '2025-09-19 15:10:11', NULL, NULL, 7, 1),
(455, '250919IWbd53SYgJkJjcvOTjswna6TjFKpg7ERjscOuOvmN1zcwvBd7S1758288461', '252772', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-19 15:27:41', NULL, '2025-09-19 15:27:41', NULL, NULL, 7, 1),
(456, '250919hPCROhLhRF85rTgTStFvACerRVZzydglqyCb3u5NsElzs0ITjm1758288479', '257687', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-19 15:27:59', NULL, '2025-09-19 15:27:59', NULL, NULL, 2, 1),
(457, '250919cHVm4iYUIdzaTB8ZAIq12oblgHfyUo964UJ2qQm6KkA8SUi1ts1758288534', '256682', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-19 15:28:54', NULL, '2025-09-19 15:28:54', NULL, NULL, 2, 1),
(458, '250923z1pvSN4ouc2yn4Z6t8QSzvBSq0pPB4IqOi3IDyhZNNrOgVHCmr1758608292', '258278', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-23 08:18:12', NULL, '2025-09-23 08:18:12', NULL, NULL, 7, 1),
(459, '250923tTLtgsPCvlAhR8IC3Rlf6gOUKcVLVqkhdQhanZgUhTlVvbzURE1758611348', '251279', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-23 09:09:08', NULL, '2025-09-23 09:09:08', NULL, NULL, 7, 1),
(460, '250923IgMmb7ZpO1tP1Avrwon23uI5RuGQMf8RTWnZ2cC0eIV5ZmNwil1758624608', '253039', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-09-23 12:50:08', NULL, '2025-09-23 12:50:08', NULL, NULL, 7, 1),
(461, '250929ch0gNwkiMzhyK9bC0cUO6QsomLK1sqbaFr428s3fyFNVqHekwr1759133392', '250194', '::1', 'Chrome 129.0.0.0', 'Linux', 'actif', 'auth', NULL, '2025-09-29 10:09:52', NULL, '2025-09-29 10:09:52', NULL, NULL, 7, 1),
(462, '251006Q8BKjauIVMUfpWantIidVVKCbKv2EkqaI5f0BD87GhTuVFZwUG1759748618', '253881', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-06 13:03:38', NULL, '2025-10-06 13:03:38', NULL, NULL, 7, 1);
INSERT INTO `users_logs` (`log_id`, `log_token`, `log_code`, `log_ipaddress`, `log_device`, `log_platform`, `log_status`, `log_type`, `log_notes`, `log_created_at`, `log_created_by`, `log_login_at`, `log_logout_at`, `log_deleted_at`, `log_user_id`, `log_school_id`) VALUES
(463, '251006fR8WSIwcUlutuDR3WJw9u4MJkzIIP3ckZiOOFLtA4yWM7oqg1D1759751461', '256819', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-06 13:51:01', NULL, '2025-10-06 13:51:01', NULL, NULL, 7, 1),
(464, '251007L4p48qLYhvMTTcjvZKcra9R8cjjwgYSsajNtesS6b3FyCw9O0n1759841775', '252306', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-07 14:56:15', NULL, '2025-10-07 14:56:15', NULL, NULL, 7, 1),
(465, '2510084Rt5FuQ7I3lTJGWOMCwoBYJKZa0Ce44l8GCiKvk0H8O2C7ZN3P1759905593', '251789', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-08 08:39:53', NULL, '2025-10-08 08:39:53', NULL, NULL, 7, 1),
(466, '251008lC1MgKcsyo9lDN23zVSY1erjU62MOVVKs9samQ3HNZhZG0riBl1759929345', '258253', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-08 15:15:45', NULL, '2025-10-08 15:15:45', NULL, NULL, NULL, NULL),
(467, '2510084p9KtfLsH2VY5PZOwtbMvszKVm1Ackc4ylskLQJzP4i7qucNnE1759929352', '251268', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-08 15:15:52', NULL, '2025-10-08 15:15:52', NULL, NULL, 7, 1),
(468, '251008A1c7StGbEAYhMIrjReVogSN2skQq9M5LPHA66iQu4iKKvCLuDF1759934706', '257851', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-08 16:45:06', NULL, '2025-10-08 16:45:06', NULL, NULL, 7, 1),
(469, '2510091ltliYR35OIJa2iQTmH0qOOiKIdDVkqk5ilAHkige9ozlLnlr81760012517', '257339', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-09 14:21:57', NULL, '2025-10-09 14:21:57', NULL, NULL, 7, 1),
(470, '251009sv9p9jKoKP3mhE21FLAfFiH6Q9ZLk2BhQT8GwIrD2jgVCuyRoA1760016120', '254138', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-09 15:22:00', NULL, '2025-10-09 15:22:00', NULL, NULL, 7, 1),
(471, '251009rlzlkc4Jup9pbm4vgGVgAsw81d7YdZGWeVmGLSesd8Pv12Ll0r1760016126', '259521', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-09 15:22:06', NULL, '2025-10-09 15:22:06', NULL, NULL, 9, 1),
(472, '251009uDbRk8ltEOapAhGJRKRJF47EIaORV9ZVvo54zjm2MdfeN7tP241760016143', '257120', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-09 15:22:23', NULL, '2025-10-09 15:22:23', NULL, NULL, 9, 1),
(473, '251009EAg0sPnwDvf7KrcIILBUN2dhEhmuewIJHfzBZqym6p4lgMBPUe1760016181', '250414', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-09 15:23:01', NULL, '2025-10-09 15:23:01', NULL, NULL, 3, 1),
(474, '251009nvwctJFWu2VhS7EY6QwQFmNnI1ED6YjKiMS3mM97qJEqCRu0Nc1760016211', '254039', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-09 15:23:31', NULL, '2025-10-09 15:23:31', NULL, NULL, 3, 1),
(475, '251009ZCFaToeWFwfE39QQKHELuIsnsMl6tcGFeSJeivkRWzKsucOmUV1760016235', '253160', '127.0.0.1', 'Firefox 143.0', 'Linux', 'actif', 'auth', NULL, '2025-10-09 15:23:55', NULL, '2025-10-09 15:23:55', NULL, NULL, 4, 4),
(476, '251129906MU31bbdYtIrBROPHt9TCqNVHbWKPAB96ymKmm3taMW2hq7w1764403164', '256645', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'auth', NULL, '2025-11-29 09:59:24', NULL, '2025-11-29 09:59:24', NULL, NULL, 7, 1),
(477, '251130OkB2T8Vt54K92SmVZ1n0RTbZfDuq5AsUklOvHjm66hyHJnADM71764488909', '251247', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'auth', NULL, '2025-11-30 09:48:29', NULL, '2025-11-30 09:48:29', NULL, NULL, 7, 1),
(478, '251202hDo9BASMYzi1yGDcCLPoj78DIDDMqen0mOq9Mg5f2L8LOqDkUb1764702570', '251794', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'auth', NULL, '2025-12-02 21:09:30', NULL, '2025-12-02 21:09:30', NULL, NULL, NULL, NULL),
(479, '25120256ykiBwaKhizSbq9g1Pw3VuL2liRsi8bVRq87IcF2NdUY1mmBf1764702591', '250323', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'auth', NULL, '2025-12-02 21:09:51', NULL, '2025-12-02 21:09:51', NULL, NULL, 7, 1),
(480, '251202TYSFcQRelWgrDtyc41KK8uJiQiuBDtlPdgfZEA7EgNBYWhigE51764702759', '258402', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'auth', NULL, '2025-12-02 21:12:39', NULL, '2025-12-02 21:12:39', NULL, NULL, 7, 1),
(481, '251205If4Cupl3RWAKib8zr56QJdzkpocYF0AFsZA2rHkf2yo0nUNc3q1764935322', '253850', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'auth', NULL, '2025-12-05 13:48:42', NULL, '2025-12-05 13:48:42', NULL, NULL, 7, 1),
(482, '251205MfRIZ1Rq12pc25FcWHtQB3PTm3MksNQUwy2KQORGUOF1IjwTcH1764935605', '256107', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'auth', NULL, '2025-12-05 13:53:25', NULL, '2025-12-05 13:53:25', NULL, NULL, 7, 1),
(483, '251206LOmBJwP3hzOqqgToEKIO1kBg8N1D1WWZ2Wwc0gssrMiE2pitOm1765030360', '256059', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'auth', NULL, '2025-12-06 16:12:40', NULL, '2025-12-06 16:12:40', NULL, NULL, 7, 1),
(484, '251206UU0qFLQdGG8KUlzePQ92flpl38Ffnt5GKUs5VviZ1RhVsMW4fR1765039091', '252076', '127.0.0.1', 'Firefox 145.0', 'Linux', 'actif', 'auth', NULL, '2025-12-06 18:38:11', NULL, '2025-12-06 18:38:11', NULL, NULL, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_passwords`
--

CREATE TABLE `users_passwords` (
  `password_id` int(11) UNSIGNED NOT NULL,
  `password_token` varchar(75) NOT NULL,
  `password_code` varchar(10) NOT NULL,
  `password_device` varchar(10) NOT NULL,
  `password_platform` varchar(10) NOT NULL,
  `password_time` varchar(10) NOT NULL,
  `password_ipaddress` varchar(75) DEFAULT NULL,
  `password_status` varchar(25) DEFAULT NULL,
  `password_type` varchar(75) DEFAULT NULL,
  `password_notes` text DEFAULT NULL,
  `password_created_at` datetime DEFAULT NULL,
  `password_created_by` varchar(75) DEFAULT NULL,
  `password_reseted_at` datetime DEFAULT NULL,
  `password_reseted_by` varchar(75) DEFAULT NULL,
  `password_deleted_at` datetime DEFAULT NULL,
  `password_user_id` int(11) UNSIGNED DEFAULT NULL,
  `password_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_passwords`
--

INSERT INTO `users_passwords` (`password_id`, `password_token`, `password_code`, `password_device`, `password_platform`, `password_time`, `password_ipaddress`, `password_status`, `password_type`, `password_notes`, `password_created_at`, `password_created_by`, `password_reseted_at`, `password_reseted_by`, `password_deleted_at`, `password_user_id`, `password_school_id`) VALUES
(1, 'znwIFL4FwDapelzPMWcFrMMWbfjK0YVo9pHeuRaw5JZrIitcAyZh9Ju2p1KtzmAhaBebVw2THKM', '78495', 'Firefox 12', 'Linux', '', '127.0.0.1', 'inactif', 'reset', 'Successfully reseted', '2024-08-20 09:29:53', NULL, '2024-08-20 09:35:04', 'Elie Mwez', NULL, 2, 1),
(240821, '240820rBnjpnSI9ACqg9oLwv26GUW5f2amdkvHgNm3ILGpqo04D7hps11724147167', '247176', 'Firefox 12', 'Linux', '', '127.0.0.1', 'actif', 'change', 'Successfully password changed', '2024-08-20 09:46:07', NULL, '2024-08-20 09:46:07', 'Elie Mwez', NULL, 2, 1),
(240822, 'JhdHscpgYdY5LGeF3c1Is4hVOGnpjIse6hcOHEFQgOLtc8HTlzMtnHQ80Rtng8SrHpcrEpM7aiV', '85902', 'Firefox 12', 'Linux', '', '127.0.0.1', 'actif', 'reset', NULL, '2024-08-28 08:44:55', NULL, NULL, NULL, NULL, 3, 1),
(240823, 'TbG1RtzTe8WbH188PBbkBtKcSV4Cj9GUOs1CqCelNNokLll62UhUeAlGtsZgEM2f0aF9RpErykj', '91251', 'Firefox 12', 'Linux', '', '127.0.0.1', 'actif', 'reset', NULL, '2024-08-28 08:51:38', NULL, NULL, NULL, NULL, 3, 1),
(240824, 'tOVz75jW0F2BeaysbKws2jhl9QVbdcZ3Q3uN84pFf7hPdjpTFgqrwBpmNKPrlYd1ephbOHVrCIO', '88041', 'Firefox 12', 'Linux', '', '127.0.0.1', 'inactif', 'reset', 'Successfully reseted', '2024-08-28 09:05:55', NULL, '2024-08-28 09:07:09', 'Elie Mwez', NULL, 2, 1),
(240825, '240828pOSkEvi652b3uIUuif6dQT9zI3hhj5SyRKLSPLUShUv42hFhbw1724836908', '248588', 'Firefox 12', 'Linux', '', '127.0.0.1', 'actif', 'change', 'Successfully password changed', '2024-08-28 09:21:48', NULL, '2024-08-28 09:21:48', 'Elie Mwez', NULL, 2, 1),
(240910, '240910CpaNFaSaenbTD4W9HuhWR2UaebFd1R3al0lTfmmKFaYi9PY6N61725978901', '248813', 'Firefox 12', 'Linux', '', '127.0.0.1', 'actif', 'reset', 'Successfully password reseted', '2024-09-10 14:35:01', NULL, '2024-09-10 14:35:01', 'Mumba', NULL, 3, 1),
(240911, '241220IYuafRB6L2wLS3MupoTK5e10pbOnpgudcjJAYsTURzlMTI11ib1734696119', '243199', 'Firefox 13', 'Linux', '', '127.0.0.1', 'actif', 'reset', 'Successfully password reseted', '2024-12-20 14:01:59', NULL, '2024-12-20 14:01:59', 'Ditotase', NULL, 7, 1),
(240912, 'IUF15Vt7kBAfirpsiagHo7d7ZWo2kferAsfCbzKIJF8a7wR7bQuGNnZoQqDKlybMqNJ1JrN1cas', '66930', 'Firefox 14', 'Linux', '', '127.0.0.1', 'inactif', 'reset', 'Successfully reseted', '2025-08-23 12:01:26', NULL, '2025-08-23 12:10:24', 'Mwez', NULL, 6, 1),
(240913, '250823wPwn9D1PSAn5Tj2NnCGYEuuRJa3W3zZmPYIv9eDgHMMNnQZlyd1755944385', '255534', 'Firefox 14', 'Linux', '', '127.0.0.1', 'actif', 'change', 'Successfully password changed', '2025-08-23 12:19:45', NULL, '2025-08-23 12:19:45', 'Mwez', NULL, 6, 1),
(240914, 'WdUdAfiDpJufhqQdLG69zrQReJBkCCYjPyIUMk3aj3V4bzrvMreC3TpaIM7mthK1C6Vqzqd2PPD', '33520', 'Firefox 14', 'Linux', '', '127.0.0.1', 'inactif', 'reset', 'Successfully reseted', '2025-08-23 12:24:48', NULL, '2025-08-23 12:25:16', 'college Trecaz', NULL, 4, 4),
(240915, '250823WbivJ299L4gbak8QCsflQisV5GpLRmCjaYcRvcBrZnq1rHn4N01755944752', '251965', 'Firefox 14', 'Linux', '', '127.0.0.1', 'actif', 'change', 'Successfully password changed', '2025-08-23 12:25:52', NULL, '2025-08-23 12:25:52', 'college Trecaz', NULL, 4, 4),
(240916, 'ZeVEnAl7QUJ1KTtGZKp4F8fBf2OAamrBM8EWzNedHElAAiwQK8nqpPGYhiSJ95Fqq3zBU0CQsyZ', '11963', 'Firefox 14', 'Linux', '', '127.0.0.1', 'inactif', 'reset', 'Successfully reseted', '2025-08-23 12:29:13', NULL, '2025-08-23 12:29:31', 'Elie Mwez', NULL, 2, 1),
(240917, '250823kyIVcnJqgf8V1A1SBlMkPTzca4bqYSCwalMek7evnH13tPt7z91755944987', '259918', 'Firefox 14', 'Linux', '', '127.0.0.1', 'actif', 'change', 'Successfully password changed', '2025-08-23 12:29:47', NULL, '2025-08-23 12:29:47', 'Elie Mwez', NULL, 2, 1),
(240918, '250919QHNz8Ef0GKIbBjqUtkouB0qaCNK6Dk9hJtrawoRbGlWhgYt5KK1758288453', '259945', 'Firefox 14', 'Linux', '', '127.0.0.1', 'actif', 'reset', 'Successfully password reseted', '2025-09-19 15:27:33', NULL, '2025-09-19 15:27:33', 'Elie Mwez', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `role_id` int(11) UNSIGNED NOT NULL,
  `role_token` varchar(75) NOT NULL,
  `role_code` varchar(10) NOT NULL,
  `role_name` varchar(75) DEFAULT NULL,
  `role_status` varchar(25) DEFAULT NULL,
  `role_type` varchar(75) DEFAULT NULL,
  `role_notes` text DEFAULT NULL,
  `role_created_at` datetime DEFAULT NULL,
  `role_updated_at` datetime DEFAULT NULL,
  `role_deleted_at` datetime DEFAULT NULL,
  `role_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`role_id`, `role_token`, `role_code`, `role_name`, `role_status`, `role_type`, `role_notes`, `role_created_at`, `role_updated_at`, `role_deleted_at`, `role_school_id`) VALUES
(1, '240722MiJj51V4h83m2utKk5tcWZ65RiJNB67pVgLKqFqPwnsTwq2TQl1721648221', '248890', 'Administrator', 'actif', 'system', '', '2024-07-22 11:37:01', '2024-08-05 09:41:17', NULL, 1),
(2, '240805jW1v8joOeSpegCwyWpZKaAYPEEBMYY3QtwfFBGliUhKbgu7PJj1722850825', '', 'Gestionnaire', 'actif', NULL, '', '2024-08-05 09:40:25', NULL, NULL, 1),
(3, '240805H7YVUqo2qWL5nPzH7TmvqbbiO4m5IJkDadheGloHZ0MMjKwMoM1722850838', '', 'Percepteur', 'actif', NULL, '', '2024-08-05 09:40:38', NULL, NULL, 1),
(4, '240918t7sS8OswHwbnokefAnV7rHjclK8IpinwtrjTOZEQsomlhhVeP51726671345', '243163', 'Administrator', 'actif', 'system', NULL, '2024-09-18 14:55:45', NULL, NULL, 4),
(5, '250225aYSnNrywBPmjVwHrOzOtuuRfSmBBuFr0CWMgp2BmmptYtsGDnU1740494849', '251596', 'Administrator', 'actif', 'system', NULL, '2025-02-25 16:47:29', NULL, NULL, 9),
(6, '2507043pAL7nY9Ej94kkMREvk1ZT42a5Bnifn2efYTr2mGdTJrVSgVQj1751633482', '259728', 'Etudiant', 'actif', 'student', NULL, '2025-07-04 14:51:22', NULL, NULL, 1),
(7, '250916pJjbAU08Fb95tsy0dBNnctVAuJFA72fHOtfg2JcniWnk0HANjW1758033130', '255293', 'Administrator', 'actif', 'system', NULL, '2025-09-16 16:32:10', NULL, NULL, 10),
(8, '250916MBJB71TSpB8EnPlf228ejnH53o5W0MtW2fEh2Za7cMUgqpKhMH1758033821', '255115', 'Administrator', 'actif', 'system', NULL, '2025-09-16 16:43:41', NULL, NULL, 11),
(9, '250920atIrCWR9zYJjpyb1ss7t2nINAJchH22mJfL6IWMsseuBa7MpYD1758355830', '257954', 'Administrator', 'actif', 'system', NULL, '2025-09-20 10:10:30', NULL, NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users_security`
--

CREATE TABLE `users_security` (
  `security_id` int(11) UNSIGNED NOT NULL,
  `security_token` varchar(75) NOT NULL,
  `security_code` varchar(10) NOT NULL,
  `security_question_1` varchar(75) DEFAULT NULL,
  `security_question_2` varchar(75) DEFAULT NULL,
  `security_question_3` varchar(75) NOT NULL,
  `security_response_1` varchar(75) DEFAULT NULL,
  `security_response_2` varchar(75) DEFAULT NULL,
  `security_response_3` varchar(75) NOT NULL,
  `security_status` varchar(25) DEFAULT NULL,
  `security_type` varchar(75) DEFAULT NULL,
  `security_notes` text DEFAULT NULL,
  `security_created_at` datetime DEFAULT NULL,
  `security_created_by` varchar(75) DEFAULT NULL,
  `security_updated_at` datetime DEFAULT NULL,
  `security_deleted_at` datetime DEFAULT NULL,
  `security_user_id` int(11) UNSIGNED DEFAULT NULL,
  `security_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_security`
--

INSERT INTO `users_security` (`security_id`, `security_token`, `security_code`, `security_question_1`, `security_question_2`, `security_question_3`, `security_response_1`, `security_response_2`, `security_response_3`, `security_status`, `security_type`, `security_notes`, `security_created_at`, `security_created_by`, `security_updated_at`, `security_deleted_at`, `security_user_id`, `security_school_id`) VALUES
(1, '240816fQnJSTrr2WiIPRuLhYyP5kWNWTHFuRnZKz82g3KfDBFTDnTWW21723795254', '243538', 'nom_fille_ainee', 'marque_voiture', 'village_origine', 'preefina', 'lexus', 'chiying', 'actif', NULL, NULL, '2024-08-16 08:00:54', NULL, '2024-08-22 09:57:58', NULL, 1, NULL),
(2, '241003bg48HopG0g15a623HHkuqsaov9TokWprUA9SK9eTJVzoUbvOeM1727948406', '246719', 'nom_fille_ainee', 'animal_domestique', 'village_origine', 'mewen', 'chat', 'chiying', 'actif', NULL, NULL, '2024-10-03 11:40:06', NULL, NULL, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `year_id` int(11) UNSIGNED NOT NULL,
  `year_token` varchar(75) NOT NULL,
  `year_started` year(4) NOT NULL,
  `year_ended` year(4) NOT NULL,
  `year_start_date` date DEFAULT NULL,
  `year_close_date` date DEFAULT NULL,
  `year_status` varchar(25) DEFAULT NULL,
  `year_notes` text DEFAULT NULL,
  `year_created_at` datetime DEFAULT NULL,
  `year_updated_at` datetime DEFAULT NULL,
  `year_deleted_at` datetime DEFAULT NULL,
  `year_school_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`year_id`, `year_token`, `year_started`, `year_ended`, `year_start_date`, `year_close_date`, `year_status`, `year_notes`, `year_created_at`, `year_updated_at`, `year_deleted_at`, `year_school_id`) VALUES
(1, '240722zgEMNcUhT7vGzoDcg9vTL7bproIAatpALFqeKcSvnWO1B3YR9s1721648325', '2024', '2025', '2024-07-22', '2025-07-22', 'actif', 'Premiere annee scolaire', '2024-07-22 11:38:45', '2025-11-30 10:54:57', NULL, 1),
(2, '240722zgEMNcUhT7vGzoDcg9vTL7bproIAatpALFqeKcSvnWO1B3YR9s17216485420', '2023', '2024', '2023-07-22', '2024-09-10', 'inactif', 'Premiere annee scolaire', '2024-07-22 11:38:45', '2024-09-10 13:30:26', NULL, 1),
(4, '240910lt0SdbLmzQNwpghFd7LyejspW1JEPHQ91qF6PT2r5HTb1AipKm1725974605', '2022', '2023', '2022-02-09', '2023-02-07', 'inactif', '', '2024-09-10 13:23:25', '2024-09-10 13:28:26', NULL, 1),
(5, '2409180Kpi2NKhdI3b5JNrVtal0EpJlVb5pdVllIG5QSBpcL7LyhQISI1726674401', '2024', '2025', '2024-09-18', '2024-09-18', 'inactif', 'Premiere annee scolaire', '2024-09-18 15:46:41', NULL, NULL, 8),
(6, '250225u5jPSGHftvtJsvDSsB432sQu6Rf3lbcdzMTptnMbkkDWsfIjKh1740494849', '2025', '2026', '2025-02-25', '2025-02-25', 'inactif', 'Premiere annee scolaire', '2025-02-25 16:47:29', NULL, NULL, 9),
(7, '2509166OIdnLlB0kk27YoBGKEhVNcW9vZrAqrHzISm7u59HbPLeSNHuH1758033142', '2025', '2026', '2025-09-16', '2025-09-16', 'inactif', 'Premiere annee scolaire', '2025-09-16 16:32:22', NULL, NULL, 10),
(8, '250916YMNN0QqtreUZhnGMAwlSyDLOKsRwodVjESnWIgzff4v1aAMlnA1758033821', '2025', '2026', '2025-09-16', '2025-09-16', 'inactif', 'Premiere annee scolaire', '2025-09-16 16:43:41', NULL, NULL, 11),
(9, '250920MINbu6dWuMD4NCnyjbSQwEEalj8Aw3oQ03SqKvgNqWauQjWhet1758355830', '2025', '2026', '2025-09-20', '2025-09-20', 'inactif', 'Premiere annee scolaire', '2025-09-20 10:10:30', NULL, NULL, 13),
(10, '2510095DeWFFi3BqfGgNQSTUnDiNkJBwKJhYQEPC7HO2VYSyJkYjYOLM1760016445', '2025', '2026', '2025-01-09', '2026-02-07', 'inactif', '', '2025-10-09 15:27:25', NULL, NULL, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `address_district`
--
ALTER TABLE `address_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `address_municipality`
--
ALTER TABLE `address_municipality`
  ADD PRIMARY KEY (`municipality_id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`agent_uid`);

--
-- Indexes for table `agents_attendances`
--
ALTER TABLE `agents_attendances`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `agents_contracts`
--
ALTER TABLE `agents_contracts`
  ADD PRIMARY KEY (`contract_uid`) USING BTREE;

--
-- Indexes for table `agents_payroll_payments`
--
ALTER TABLE `agents_payroll_payments`
  ADD PRIMARY KEY (`payment_uid`);

--
-- Indexes for table `agents_payroll_requests`
--
ALTER TABLE `agents_payroll_requests`
  ADD PRIMARY KEY (`request_uid`);

--
-- Indexes for table `agents_services`
--
ALTER TABLE `agents_services`
  ADD PRIMARY KEY (`service_uid`);

--
-- Indexes for table `agents_types`
--
ALTER TABLE `agents_types`
  ADD PRIMARY KEY (`category_uid`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`ip_address`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classe_id`),
  ADD KEY `classes_classe_school_id_foreign` (`classe_school_id`),
  ADD KEY `classes_classe_option_id_foreign` (`classe_option_id`),
  ADD KEY `classes_classe_degree_id_foreign` (`classe_degree_id`);

--
-- Indexes for table `classes_degrees`
--
ALTER TABLE `classes_degrees`
  ADD PRIMARY KEY (`degree_id`),
  ADD KEY `classes_degrees_degree_school_id_foreign` (`degree_school_id`);

--
-- Indexes for table `classes_options`
--
ALTER TABLE `classes_options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `classes_options_option_section_id_foreign` (`option_section_id`),
  ADD KEY `classes_options_option_school_id_foreign` (`option_school_id`);

--
-- Indexes for table `classes_teachers`
--
ALTER TABLE `classes_teachers`
  ADD PRIMARY KEY (`classeteacher_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `contacts_contact_school_id_foreign` (`contact_school_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `courses_branchs`
--
ALTER TABLE `courses_branchs`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `courses_classes`
--
ALTER TABLE `courses_classes`
  ADD PRIMARY KEY (`courseclasse_id`);

--
-- Indexes for table `courses_maximas`
--
ALTER TABLE `courses_maximas`
  ADD PRIMARY KEY (`maxima_id`);

--
-- Indexes for table `courses_periods`
--
ALTER TABLE `courses_periods`
  ADD PRIMARY KEY (`period_id`);

--
-- Indexes for table `courses_schedules`
--
ALTER TABLE `courses_schedules`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `courses_students_grades`
--
ALTER TABLE `courses_students_grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `courses_teachers`
--
ALTER TABLE `courses_teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `courses_teachers_attribution`
--
ALTER TABLE `courses_teachers_attribution`
  ADD PRIMARY KEY (`attribution_id`);

--
-- Indexes for table `courses_teachers_availability`
--
ALTER TABLE `courses_teachers_availability`
  ADD PRIMARY KEY (`availability_id`);

--
-- Indexes for table `courses_workdays`
--
ALTER TABLE `courses_workdays`
  ADD PRIMARY KEY (`workday_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`),
  ADD UNIQUE KEY `customer_phone` (`customer_phone`);

--
-- Indexes for table `customers_passwords`
--
ALTER TABLE `customers_passwords`
  ADD PRIMARY KEY (`password_id`),
  ADD KEY `customers_passwords_password_customer_id_foreign` (`password_customer_id`);

--
-- Indexes for table `disciplinary_behavior_positives`
--
ALTER TABLE `disciplinary_behavior_positives`
  ADD PRIMARY KEY (`positive_id`);

--
-- Indexes for table `disciplinary_incidents`
--
ALTER TABLE `disciplinary_incidents`
  ADD PRIMARY KEY (`incident_id`);

--
-- Indexes for table `disciplinary_parents_notifications`
--
ALTER TABLE `disciplinary_parents_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `disciplinary_sanctions`
--
ALTER TABLE `disciplinary_sanctions`
  ADD PRIMARY KEY (`sanction_id`),
  ADD KEY `sanction_incident_id` (`sanction_incident_id`);

--
-- Indexes for table `disciplinary_students_evaluations`
--
ALTER TABLE `disciplinary_students_evaluations`
  ADD PRIMARY KEY (`evaluation_id`);

--
-- Indexes for table `exemptions`
--
ALTER TABLE `exemptions`
  ADD PRIMARY KEY (`exemption_id`),
  ADD KEY `exemptions_exemption_year_id_foreign` (`exemption_year_id`),
  ADD KEY `exemptions_exemption_school_id_foreign` (`exemption_school_id`);

--
-- Indexes for table `exemptions_classes`
--
ALTER TABLE `exemptions_classes`
  ADD PRIMARY KEY (`exemptionclasse_id`),
  ADD KEY `exemptions_classes_exemptionclasse_classe_id_foreign` (`exemptionclasse_classe_id`),
  ADD KEY `exemptions_classes_exemptionclasse_exemption_id_foreign` (`exemptionclasse_exemption_id`),
  ADD KEY `exemptions_classes_exemptionclasse_school_id_foreign` (`exemptionclasse_school_id`);

--
-- Indexes for table `exemptions_discounts`
--
ALTER TABLE `exemptions_discounts`
  ADD PRIMARY KEY (`feediscount_id`),
  ADD KEY `exemptions_discounts_feediscount_feedetail_id_foreign` (`feediscount_feedetail_id`),
  ADD KEY `exemptions_discounts_feediscount_exemption_id_foreign` (`feediscount_exemption_id`),
  ADD KEY `exemptions_discounts_feediscount_school_id_foreign` (`feediscount_school_id`);

--
-- Indexes for table `exemptions_students`
--
ALTER TABLE `exemptions_students`
  ADD PRIMARY KEY (`feestudent_id`),
  ADD KEY `exemptions_students_feestudent_inscription_id_foreign` (`feestudent_inscription_id`),
  ADD KEY `exemptions_students_feestudent_exemption_id_foreign` (`feestudent_exemption_id`),
  ADD KEY `exemptions_students_feestudent_school_id_foreign` (`feestudent_school_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`fee_id`),
  ADD KEY `fees_fee_school_id_foreign` (`fee_school_id`);

--
-- Indexes for table `fees_classes`
--
ALTER TABLE `fees_classes`
  ADD PRIMARY KEY (`feeclasse_id`),
  ADD KEY `fees_classes_feeclasse_feedetail_id_foreign` (`feeclasse_feedetail_id`),
  ADD KEY `fees_classes_feeclasse_classe_id_foreign` (`feeclasse_classe_id`),
  ADD KEY `fees_classes_feeclasse_school_id_foreign` (`feeclasse_school_id`);

--
-- Indexes for table `fees_details`
--
ALTER TABLE `fees_details`
  ADD PRIMARY KEY (`feedetail_id`),
  ADD KEY `fees_details_feedetail_fee_id_foreign` (`feedetail_fee_id`),
  ADD KEY `fees_details_feedetail_school_id_foreign` (`feedetail_school_id`);

--
-- Indexes for table `finances_banks`
--
ALTER TABLE `finances_banks`
  ADD PRIMARY KEY (`bank_id`),
  ADD UNIQUE KEY `bank_account_number` (`bank_account_number`),
  ADD KEY `finances_banks_bank_school_id_foreign` (`bank_school_id`);

--
-- Indexes for table `finances_cashbox`
--
ALTER TABLE `finances_cashbox`
  ADD PRIMARY KEY (`cashbox_id`),
  ADD KEY `finances_cashbox_cashbox_school_id_foreign` (`cashbox_school_id`);

--
-- Indexes for table `finances_expenses`
--
ALTER TABLE `finances_expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `finances_expenses_expense_user_id_foreign` (`expense_user_id`),
  ADD KEY `finances_expenses_expense_cashbox_id_foreign` (`expense_cashbox_id`),
  ADD KEY `finances_expenses_expense_year_id_foreign` (`expense_year_id`),
  ADD KEY `finances_expenses_expense_school_id_foreign` (`expense_school_id`);

--
-- Indexes for table `finances_transactions`
--
ALTER TABLE `finances_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `finances_transactions_transaction_user_id_foreign` (`transaction_user_id`),
  ADD KEY `finances_transactions_transaction_cashbox_id_foreign` (`transaction_cashbox_id`),
  ADD KEY `finances_transactions_transaction_bank_id_foreign` (`transaction_bank_id`),
  ADD KEY `finances_transactions_transaction_year_id_foreign` (`transaction_year_id`),
  ADD KEY `finances_transactions_transaction_school_id_foreign` (`transaction_school_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `messages_message_school_id_foreign` (`message_school_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payments_payment_student_id_foreign` (`payment_student_id`),
  ADD KEY `payments_payment_year_id_foreign` (`payment_year_id`),
  ADD KEY `payments_payment_fee_id_foreign` (`payment_fee_id`),
  ADD KEY `payments_payment_school_id_foreign` (`payment_school_id`),
  ADD KEY `payments_payment_user_id_foreign` (`payment_user_id`);

--
-- Indexes for table `payments_details`
--
ALTER TABLE `payments_details`
  ADD PRIMARY KEY (`paydetails_id`),
  ADD KEY `payments_details_paydetails_fee_id_foreign` (`paydetails_fee_id`),
  ADD KEY `payments_details_paydetails_school_id_foreign` (`paydetails_school_id`),
  ADD KEY `payments_details_paydetails_payment_id_foreign` (`paydetails_payment_id`);

--
-- Indexes for table `payments_exchanges`
--
ALTER TABLE `payments_exchanges`
  ADD PRIMARY KEY (`exchange_id`),
  ADD KEY `payments_exchanges_exchange_school_id_foreign` (`exchange_school_id`);

--
-- Indexes for table `payments_reports`
--
ALTER TABLE `payments_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `payments_reports_report_student_id_foreign` (`report_student_id`),
  ADD KEY `payments_reports_report_year_id_foreign` (`report_year_id`),
  ADD KEY `payments_reports_report_school_id_foreign` (`report_school_id`),
  ADD KEY `payments_reports_report_user_id_foreign` (`report_user_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `results_result_annualperiod_id_foreign` (`result_annualperiod_id`),
  ADD KEY `results_result_student_id_foreign` (`result_student_id`),
  ADD KEY `results_result_school_id_foreign` (`result_school_id`);

--
-- Indexes for table `results_annual_period`
--
ALTER TABLE `results_annual_period`
  ADD PRIMARY KEY (`annualperiod_id`),
  ADD KEY `results_annual_period_annualperiod_period_id_foreign` (`annualperiod_period_id`),
  ADD KEY `results_annual_period_annualperiod_year_id_foreign` (`annualperiod_year_id`),
  ADD KEY `results_annual_period_annualperiod_school_id_foreign` (`annualperiod_school_id`);

--
-- Indexes for table `results_criteria`
--
ALTER TABLE `results_criteria`
  ADD PRIMARY KEY (`criteria_id`),
  ADD KEY `criteria_classe_id_foreign` (`criteria_classe_id`),
  ADD KEY `criteria_fee_id_foreign` (`criteria_fee_id`),
  ADD KEY `criteria_school_id_foreign` (`criteria_school_id`),
  ADD KEY `criteria_period_id` (`criteria_period_id`);

--
-- Indexes for table `results_period`
--
ALTER TABLE `results_period`
  ADD PRIMARY KEY (`period_id`),
  ADD KEY `results_period_period_school_id_foreign` (`period_school_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`),
  ADD UNIQUE KEY `school_phone` (`school_phone`),
  ADD KEY `schools_school_customer_id_foreign` (`school_customer_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `sections_section_school_id_foreign` (`section_school_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `students_student_school_id_foreign` (`student_school_id`),
  ADD KEY `students_student_parent_id_foreign` (`student_parent_id`);

--
-- Indexes for table `students_counters`
--
ALTER TABLE `students_counters`
  ADD PRIMARY KEY (`counter_id`);

--
-- Indexes for table `students_documents`
--
ALTER TABLE `students_documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `students_documents_document_student_id_foreign` (`document_student_id`),
  ADD KEY `students_documents_document_school_id_foreign` (`document_school_id`);

--
-- Indexes for table `students_inscriptions`
--
ALTER TABLE `students_inscriptions`
  ADD PRIMARY KEY (`inscription_id`),
  ADD KEY `students_inscriptions_inscription_school_id_foreign` (`inscription_school_id`),
  ADD KEY `students_inscriptions_inscription_student_id_foreign` (`inscription_student_id`),
  ADD KEY `students_inscriptions_inscription_classe_id_foreign` (`inscription_classe_id`),
  ADD KEY `students_inscriptions_inscription_year_id_foreign` (`inscription_year_id`);

--
-- Indexes for table `students_parents`
--
ALTER TABLE `students_parents`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `students_parents_parent_school_id_foreign` (`parent_school_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `users_user_role_id_foreign` (`user_role_id`),
  ADD KEY `users_user_school_id_foreign` (`user_school_id`);

--
-- Indexes for table `users_access`
--
ALTER TABLE `users_access`
  ADD PRIMARY KEY (`access_id`),
  ADD KEY `users_access_access_role_id_foreign` (`access_role_id`),
  ADD KEY `users_access_access_school_id_foreign` (`access_school_id`);

--
-- Indexes for table `users_activities`
--
ALTER TABLE `users_activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `users_activities_activity_user_id_foreign` (`activity_user_id`),
  ADD KEY `users_activities_activity_school_id_foreign` (`activity_school_id`);

--
-- Indexes for table `users_branchs`
--
ALTER TABLE `users_branchs`
  ADD PRIMARY KEY (`branch_id`),
  ADD KEY `users_branchs_branch_user_id_foreign` (`branch_user_id`),
  ADD KEY `users_branchs_branch_section_id_foreign` (`branch_section_id`),
  ADD KEY `users_branchs_branch_school_id_foreign` (`branch_school_id`);

--
-- Indexes for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `users_logs_log_user_id_foreign` (`log_user_id`),
  ADD KEY `users_logs_log_school_id_foreign` (`log_school_id`);

--
-- Indexes for table `users_passwords`
--
ALTER TABLE `users_passwords`
  ADD PRIMARY KEY (`password_id`),
  ADD KEY `users_passwords_password_user_id_foreign` (`password_user_id`),
  ADD KEY `users_passwords_password_school_id_foreign` (`password_school_id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `users_roles_role_school_id_foreign` (`role_school_id`);

--
-- Indexes for table `users_security`
--
ALTER TABLE `users_security`
  ADD PRIMARY KEY (`security_id`),
  ADD KEY `users_security_security_user_id_foreign` (`security_user_id`),
  ADD KEY `users_security_security_school_id_foreign` (`security_school_id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`year_id`),
  ADD KEY `years_year_school_id_foreign` (`year_school_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `address_district`
--
ALTER TABLE `address_district`
  MODIFY `district_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `address_municipality`
--
ALTER TABLE `address_municipality`
  MODIFY `municipality_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `agents_attendances`
--
ALTER TABLE `agents_attendances`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classe_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `classes_degrees`
--
ALTER TABLE `classes_degrees`
  MODIFY `degree_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `classes_options`
--
ALTER TABLE `classes_options`
  MODIFY `option_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `classes_teachers`
--
ALTER TABLE `classes_teachers`
  MODIFY `classeteacher_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses_branchs`
--
ALTER TABLE `courses_branchs`
  MODIFY `branch_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses_classes`
--
ALTER TABLE `courses_classes`
  MODIFY `courseclasse_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `courses_maximas`
--
ALTER TABLE `courses_maximas`
  MODIFY `maxima_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2506166;

--
-- AUTO_INCREMENT for table `courses_periods`
--
ALTER TABLE `courses_periods`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses_schedules`
--
ALTER TABLE `courses_schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courses_students_grades`
--
ALTER TABLE `courses_students_grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `courses_teachers`
--
ALTER TABLE `courses_teachers`
  MODIFY `teacher_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses_teachers_attribution`
--
ALTER TABLE `courses_teachers_attribution`
  MODIFY `attribution_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses_teachers_availability`
--
ALTER TABLE `courses_teachers_availability`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses_workdays`
--
ALTER TABLE `courses_workdays`
  MODIFY `workday_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers_passwords`
--
ALTER TABLE `customers_passwords`
  MODIFY `password_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24092044;

--
-- AUTO_INCREMENT for table `disciplinary_behavior_positives`
--
ALTER TABLE `disciplinary_behavior_positives`
  MODIFY `positive_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disciplinary_incidents`
--
ALTER TABLE `disciplinary_incidents`
  MODIFY `incident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `disciplinary_parents_notifications`
--
ALTER TABLE `disciplinary_parents_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disciplinary_sanctions`
--
ALTER TABLE `disciplinary_sanctions`
  MODIFY `sanction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `disciplinary_students_evaluations`
--
ALTER TABLE `disciplinary_students_evaluations`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exemptions`
--
ALTER TABLE `exemptions`
  MODIFY `exemption_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `exemptions_classes`
--
ALTER TABLE `exemptions_classes`
  MODIFY `exemptionclasse_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `exemptions_discounts`
--
ALTER TABLE `exemptions_discounts`
  MODIFY `feediscount_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `exemptions_students`
--
ALTER TABLE `exemptions_students`
  MODIFY `feestudent_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `fee_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fees_classes`
--
ALTER TABLE `fees_classes`
  MODIFY `feeclasse_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT for table `fees_details`
--
ALTER TABLE `fees_details`
  MODIFY `feedetail_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `finances_banks`
--
ALTER TABLE `finances_banks`
  MODIFY `bank_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `finances_cashbox`
--
ALTER TABLE `finances_cashbox`
  MODIFY `cashbox_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `finances_expenses`
--
ALTER TABLE `finances_expenses`
  MODIFY `expense_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `finances_transactions`
--
ALTER TABLE `finances_transactions`
  MODIFY `transaction_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `payments_details`
--
ALTER TABLE `payments_details`
  MODIFY `paydetails_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `payments_exchanges`
--
ALTER TABLE `payments_exchanges`
  MODIFY `exchange_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments_reports`
--
ALTER TABLE `payments_reports`
  MODIFY `report_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `results_annual_period`
--
ALTER TABLE `results_annual_period`
  MODIFY `annualperiod_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `results_criteria`
--
ALTER TABLE `results_criteria`
  MODIFY `criteria_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `results_period`
--
ALTER TABLE `results_period`
  MODIFY `period_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `students_counters`
--
ALTER TABLE `students_counters`
  MODIFY `counter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students_documents`
--
ALTER TABLE `students_documents`
  MODIFY `document_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students_inscriptions`
--
ALTER TABLE `students_inscriptions`
  MODIFY `inscription_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `students_parents`
--
ALTER TABLE `students_parents`
  MODIFY `parent_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users_access`
--
ALTER TABLE `users_access`
  MODIFY `access_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users_activities`
--
ALTER TABLE `users_activities`
  MODIFY `activity_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `users_branchs`
--
ALTER TABLE `users_branchs`
  MODIFY `branch_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `log_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;

--
-- AUTO_INCREMENT for table `users_passwords`
--
ALTER TABLE `users_passwords`
  MODIFY `password_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240919;

--
-- AUTO_INCREMENT for table `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `role_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_security`
--
ALTER TABLE `users_security`
  MODIFY `security_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `year_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_classe_degree_id_foreign` FOREIGN KEY (`classe_degree_id`) REFERENCES `classes_degrees` (`degree_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_classe_option_id_foreign` FOREIGN KEY (`classe_option_id`) REFERENCES `classes_options` (`option_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_classe_school_id_foreign` FOREIGN KEY (`classe_school_id`) REFERENCES `schools` (`school_id`) ON UPDATE CASCADE;

--
-- Constraints for table `classes_degrees`
--
ALTER TABLE `classes_degrees`
  ADD CONSTRAINT `classes_degrees_degree_school_id_foreign` FOREIGN KEY (`degree_school_id`) REFERENCES `schools` (`school_id`) ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_contact_school_id_foreign` FOREIGN KEY (`contact_school_id`) REFERENCES `schools` (`school_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
