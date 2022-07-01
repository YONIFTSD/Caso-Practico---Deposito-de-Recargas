-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.15-log - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bd_apuesta_total
CREATE DATABASE IF NOT EXISTS `bd_apuesta_total` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd_apuesta_total`;

-- Volcando estructura para tabla bd_apuesta_total.business
CREATE TABLE IF NOT EXISTS `business` (
  `id_company` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_type` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `document_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `tradename` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bd_apuesta_total.business: ~1 rows (aproximadamente)
INSERT INTO `business` (`id_company`, `document_type`, `document_number`, `name`, `tradename`, `address`, `logo`, `phone`, `email`, `state`, `created_at`, `updated_at`) VALUES
	(1, '6', '20100066603', 'Tu Empresa SR', 'Tu Empresa SR', 'tacna', 'company/tu-empresa-sr-1623284805.jpg', '-', '-', 1, '2021-10-07 01:53:35', '2021-10-07 01:53:36');

-- Volcando estructura para tabla bd_apuesta_total.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_type` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `document_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `coin` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=2001 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bd_apuesta_total.clients: ~2 rows (aproximadamente)
INSERT INTO `clients` (`id_client`, `document_type`, `document_number`, `name`, `country`, `city`, `address`, `phone`, `email`, `password`, `sex`, `date_of_birth`, `coin`, `balance`, `state`, `created_at`, `updated_at`) VALUES
	(1990, '1', '70359383', 'MAMANI CALISAYA YONATHAN WILLIAM', 'PE', 'tacna', 'av. alcides carrion mz 136 lt 11 cmt 50', '928872148', 'yonathanwilliammc@gmail.com', '$2y$10$ST06J9cMQUYJsk8raz/4tuukAwjfYXfH4EJtGxRLE5KOJwHPZfdEu', 'H', '0000-00-00', 'PEN', 600.00, 1, '2022-02-06 14:57:21', '2022-07-01 14:39:56'),
	(2000, '1', '52789652', 'TORRES MACHACA JUAN ANTONIO', 'PE', 'lima', 'av. alcides carrion mz 136 lt 11 cmt 50', '928872148', 'juanantonio@gmail.com', '$2y$10$ST06J9cMQUYJsk8raz/4tuukAwjfYXfH4EJtGxRLE5KOJwHPZfdEu', 'H', '2022-07-01', 'pen', 0.00, 1, '2022-07-01 19:50:00', '2022-07-01 19:50:00');

-- Volcando estructura para tabla bd_apuesta_total.correlatives
CREATE TABLE IF NOT EXISTS `correlatives` (
  `id_correlative` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_correlative`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bd_apuesta_total.correlatives: ~1 rows (aproximadamente)
INSERT INTO `correlatives` (`id_correlative`, `module`, `number`, `num`, `state`, `created_at`, `updated_at`) VALUES
	(1, 'Recharge', '00010010', 10010, 1, '2021-10-04 19:47:32', '2022-07-01 14:39:48');

-- Volcando estructura para tabla bd_apuesta_total.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id_country` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `iso3` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bd_apuesta_total.countries: ~250 rows (aproximadamente)
INSERT INTO `countries` (`id_country`, `name`, `code`, `iso3`, `created_at`, `updated_at`) VALUES
	(1, 'Afghanistan', 'AF', 'AFG', NULL, NULL),
	(2, 'Aland Islands', 'AX', 'ALA', NULL, NULL),
	(3, 'Albania', 'AL', 'ALB', NULL, NULL),
	(4, 'Algeria', 'DZ', 'DZA', NULL, NULL),
	(5, 'American Samoa', 'AS', 'ASM', NULL, NULL),
	(6, 'Andorra', 'AD', 'AND', NULL, NULL),
	(7, 'Angola', 'AO', 'AGO', NULL, NULL),
	(8, 'Anguilla', 'AI', 'AIA', NULL, NULL),
	(9, 'Antarctica', 'AQ', 'ATA', NULL, NULL),
	(10, 'Antigua And Barbuda', 'AG', 'ATG', NULL, NULL),
	(11, 'Argentina', 'AR', 'ARG', NULL, NULL),
	(12, 'Armenia', 'AM', 'ARM', NULL, NULL),
	(13, 'Aruba', 'AW', 'ABW', NULL, NULL),
	(14, 'Australia', 'AU', 'AUS', NULL, NULL),
	(15, 'Austria', 'AT', 'AUT', NULL, NULL),
	(16, 'Azerbaijan', 'AZ', 'AZE', NULL, NULL),
	(17, 'Bahamas The', 'BS', 'BHS', NULL, NULL),
	(18, 'Bahrain', 'BH', 'BHR', NULL, NULL),
	(19, 'Bangladesh', 'BD', 'BGD', NULL, NULL),
	(20, 'Barbados', 'BB', 'BRB', NULL, NULL),
	(21, 'Belarus', 'BY', 'BLR', NULL, NULL),
	(22, 'Belgium', 'BE', 'BEL', NULL, NULL),
	(23, 'Belize', 'BZ', 'BLZ', NULL, NULL),
	(24, 'Benin', 'BJ', 'BEN', NULL, NULL),
	(25, 'Bermuda', 'BM', 'BMU', NULL, NULL),
	(26, 'Bhutan', 'BT', 'BTN', NULL, NULL),
	(27, 'Bolivia', 'BO', 'BOL', NULL, NULL),
	(28, 'Bosnia and Herzegovina', 'BA', 'BIH', NULL, NULL),
	(29, 'Botswana', 'BW', 'BWA', NULL, NULL),
	(30, 'Bouvet Island', 'BV', 'BVT', NULL, NULL),
	(31, 'Brazil', 'BR', 'BRA', NULL, NULL),
	(32, 'British Indian Ocean Territory', 'IO', 'IOT', NULL, NULL),
	(33, 'Brunei', 'BN', 'BRN', NULL, NULL),
	(34, 'Bulgaria', 'BG', 'BGR', NULL, NULL),
	(35, 'Burkina Faso', 'BF', 'BFA', NULL, NULL),
	(36, 'Burundi', 'BI', 'BDI', NULL, NULL),
	(37, 'Cambodia', 'KH', 'KHM', NULL, NULL),
	(38, 'Cameroon', 'CM', 'CMR', NULL, NULL),
	(39, 'Canada', 'CA', 'CAN', NULL, NULL),
	(40, 'Cape Verde', 'CV', 'CPV', NULL, NULL),
	(41, 'Cayman Islands', 'KY', 'CYM', NULL, NULL),
	(42, 'Central African Republic', 'CF', 'CAF', NULL, NULL),
	(43, 'Chad', 'TD', 'TCD', NULL, NULL),
	(44, 'Chile', 'CL', 'CHL', NULL, NULL),
	(45, 'China', 'CN', 'CHN', NULL, NULL),
	(46, 'Christmas Island', 'CX', 'CXR', NULL, NULL),
	(47, 'Cocos (Keeling) Islands', 'CC', 'CCK', NULL, NULL),
	(48, 'Colombia', 'CO', 'COL', NULL, NULL),
	(49, 'Comoros', 'KM', 'COM', NULL, NULL),
	(50, 'Congo', 'CG', 'COG', NULL, NULL),
	(51, 'Congo The Democratic Republic Of The', 'CD', 'COD', NULL, NULL),
	(52, 'Cook Islands', 'CK', 'COK', NULL, NULL),
	(53, 'Costa Rica', 'CR', 'CRI', NULL, NULL),
	(54, 'Cote D\'Ivoire (Ivory Coast)', 'CI', 'CIV', NULL, NULL),
	(55, 'Croatia (Hrvatska)', 'HR', 'HRV', NULL, NULL),
	(56, 'Cuba', 'CU', 'CUB', NULL, NULL),
	(57, 'Cyprus', 'CY', 'CYP', NULL, NULL),
	(58, 'Czech Republic', 'CZ', 'CZE', NULL, NULL),
	(59, 'Denmark', 'DK', 'DNK', NULL, NULL),
	(60, 'Djibouti', 'DJ', 'DJI', NULL, NULL),
	(61, 'Dominica', 'DM', 'DMA', NULL, NULL),
	(62, 'Dominican Republic', 'DO', 'DOM', NULL, NULL),
	(63, 'East Timor', 'TL', 'TLS', NULL, NULL),
	(64, 'Ecuador', 'EC', 'ECU', NULL, NULL),
	(65, 'Egypt', 'EG', 'EGY', NULL, NULL),
	(66, 'El Salvador', 'SV', 'SLV', NULL, NULL),
	(67, 'Equatorial Guinea', 'GQ', 'GNQ', NULL, NULL),
	(68, 'Eritrea', 'ER', 'ERI', NULL, NULL),
	(69, 'Estonia', 'EE', 'EST', NULL, NULL),
	(70, 'Ethiopia', 'ET', 'ETH', NULL, NULL),
	(71, 'Falkland Islands', 'FK', 'FLK', NULL, NULL),
	(72, 'Faroe Islands', 'FO', 'FRO', NULL, NULL),
	(73, 'Fiji Islands', 'FJ', 'FJI', NULL, NULL),
	(74, 'Finland', 'FI', 'FIN', NULL, NULL),
	(75, 'France', 'FR', 'FRA', NULL, NULL),
	(76, 'French Guiana', 'GF', 'GUF', NULL, NULL),
	(77, 'French Polynesia', 'PF', 'PYF', NULL, NULL),
	(78, 'French Southern Territories', 'TF', 'ATF', NULL, NULL),
	(79, 'Gabon', 'GA', 'GAB', NULL, NULL),
	(80, 'Gambia The', 'GM', 'GMB', NULL, NULL),
	(81, 'Georgia', 'GE', 'GEO', NULL, NULL),
	(82, 'Germany', 'DE', 'DEU', NULL, NULL),
	(83, 'Ghana', 'GH', 'GHA', NULL, NULL),
	(84, 'Gibraltar', 'GI', 'GIB', NULL, NULL),
	(85, 'Greece', 'GR', 'GRC', NULL, NULL),
	(86, 'Greenland', 'GL', 'GRL', NULL, NULL),
	(87, 'Grenada', 'GD', 'GRD', NULL, NULL),
	(88, 'Guadeloupe', 'GP', 'GLP', NULL, NULL),
	(89, 'Guam', 'GU', 'GUM', NULL, NULL),
	(90, 'Guatemala', 'GT', 'GTM', NULL, NULL),
	(91, 'Guernsey and Alderney', 'GG', 'GGY', NULL, NULL),
	(92, 'Guinea', 'GN', 'GIN', NULL, NULL),
	(93, 'Guinea-Bissau', 'GW', 'GNB', NULL, NULL),
	(94, 'Guyana', 'GY', 'GUY', NULL, NULL),
	(95, 'Haiti', 'HT', 'HTI', NULL, NULL),
	(96, 'Heard Island and McDonald Islands', 'HM', 'HMD', NULL, NULL),
	(97, 'Honduras', 'HN', 'HND', NULL, NULL),
	(98, 'Hong Kong S.A.R.', 'HK', 'HKG', NULL, NULL),
	(99, 'Hungary', 'HU', 'HUN', NULL, NULL),
	(100, 'Iceland', 'IS', 'ISL', NULL, NULL),
	(101, 'India', 'IN', 'IND', NULL, NULL),
	(102, 'Indonesia', 'ID', 'IDN', NULL, NULL),
	(103, 'Iran', 'IR', 'IRN', NULL, NULL),
	(104, 'Iraq', 'IQ', 'IRQ', NULL, NULL),
	(105, 'Ireland', 'IE', 'IRL', NULL, NULL),
	(106, 'Israel', 'IL', 'ISR', NULL, NULL),
	(107, 'Italy', 'IT', 'ITA', NULL, NULL),
	(108, 'Jamaica', 'JM', 'JAM', NULL, NULL),
	(109, 'Japan', 'JP', 'JPN', NULL, NULL),
	(110, 'Jersey', 'JE', 'JEY', NULL, NULL),
	(111, 'Jordan', 'JO', 'JOR', NULL, NULL),
	(112, 'Kazakhstan', 'KZ', 'KAZ', NULL, NULL),
	(113, 'Kenya', 'KE', 'KEN', NULL, NULL),
	(114, 'Kiribati', 'KI', 'KIR', NULL, NULL),
	(115, 'Korea North', 'KP', 'PRK', NULL, NULL),
	(116, 'Korea South', 'KR', 'KOR', NULL, NULL),
	(117, 'Kuwait', 'KW', 'KWT', NULL, NULL),
	(118, 'Kyrgyzstan', 'KG', 'KGZ', NULL, NULL),
	(119, 'Laos', 'LA', 'LAO', NULL, NULL),
	(120, 'Latvia', 'LV', 'LVA', NULL, NULL),
	(121, 'Lebanon', 'LB', 'LBN', NULL, NULL),
	(122, 'Lesotho', 'LS', 'LSO', NULL, NULL),
	(123, 'Liberia', 'LR', 'LBR', NULL, NULL),
	(124, 'Libya', 'LY', 'LBY', NULL, NULL),
	(125, 'Liechtenstein', 'LI', 'LIE', NULL, NULL),
	(126, 'Lithuania', 'LT', 'LTU', NULL, NULL),
	(127, 'Luxembourg', 'LU', 'LUX', NULL, NULL),
	(128, 'Macau S.A.R.', 'MO', 'MAC', NULL, NULL),
	(129, 'Macedonia', 'MK', 'MKD', NULL, NULL),
	(130, 'Madagascar', 'MG', 'MDG', NULL, NULL),
	(131, 'Malawi', 'MW', 'MWI', NULL, NULL),
	(132, 'Malaysia', 'MY', 'MYS', NULL, NULL),
	(133, 'Maldives', 'MV', 'MDV', NULL, NULL),
	(134, 'Mali', 'ML', 'MLI', NULL, NULL),
	(135, 'Malta', 'MT', 'MLT', NULL, NULL),
	(136, 'Man (Isle of)', 'IM', 'IMN', NULL, NULL),
	(137, 'Marshall Islands', 'MH', 'MHL', NULL, NULL),
	(138, 'Martinique', 'MQ', 'MTQ', NULL, NULL),
	(139, 'Mauritania', 'MR', 'MRT', NULL, NULL),
	(140, 'Mauritius', 'MU', 'MUS', NULL, NULL),
	(141, 'Mayotte', 'YT', 'MYT', NULL, NULL),
	(142, 'Mexico', 'MX', 'MEX', NULL, NULL),
	(143, 'Micronesia', 'FM', 'FSM', NULL, NULL),
	(144, 'Moldova', 'MD', 'MDA', NULL, NULL),
	(145, 'Monaco', 'MC', 'MCO', NULL, NULL),
	(146, 'Mongolia', 'MN', 'MNG', NULL, NULL),
	(147, 'Montenegro', 'ME', 'MNE', NULL, NULL),
	(148, 'Montserrat', 'MS', 'MSR', NULL, NULL),
	(149, 'Morocco', 'MA', 'MAR', NULL, NULL),
	(150, 'Mozambique', 'MZ', 'MOZ', NULL, NULL),
	(151, 'Myanmar', 'MM', 'MMR', NULL, NULL),
	(152, 'Namibia', 'NA', 'NAM', NULL, NULL),
	(153, 'Nauru', 'NR', 'NRU', NULL, NULL),
	(154, 'Nepal', 'NP', 'NPL', NULL, NULL),
	(155, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', NULL, NULL),
	(156, 'Netherlands The', 'NL', 'NLD', NULL, NULL),
	(157, 'New Caledonia', 'NC', 'NCL', NULL, NULL),
	(158, 'New Zealand', 'NZ', 'NZL', NULL, NULL),
	(159, 'Nicaragua', 'NI', 'NIC', NULL, NULL),
	(160, 'Niger', 'NE', 'NER', NULL, NULL),
	(161, 'Nigeria', 'NG', 'NGA', NULL, NULL),
	(162, 'Niue', 'NU', 'NIU', NULL, NULL),
	(163, 'Norfolk Island', 'NF', 'NFK', NULL, NULL),
	(164, 'Northern Mariana Islands', 'MP', 'MNP', NULL, NULL),
	(165, 'Norway', 'NO', 'NOR', NULL, NULL),
	(166, 'Oman', 'OM', 'OMN', NULL, NULL),
	(167, 'Pakistan', 'PK', 'PAK', NULL, NULL),
	(168, 'Palau', 'PW', 'PLW', NULL, NULL),
	(169, 'Palestinian Territory Occupied', 'PS', 'PSE', NULL, NULL),
	(170, 'Panama', 'PA', 'PAN', NULL, NULL),
	(171, 'Papua new Guinea', 'PG', 'PNG', NULL, NULL),
	(172, 'Paraguay', 'PY', 'PRY', NULL, NULL),
	(173, 'Peru', 'PE', 'PER', NULL, NULL),
	(174, 'Philippines', 'PH', 'PHL', NULL, NULL),
	(175, 'Pitcairn Island', 'PN', 'PCN', NULL, NULL),
	(176, 'Poland', 'PL', 'POL', NULL, NULL),
	(177, 'Portugal', 'PT', 'PRT', NULL, NULL),
	(178, 'Puerto Rico', 'PR', 'PRI', NULL, NULL),
	(179, 'Qatar', 'QA', 'QAT', NULL, NULL),
	(180, 'Reunion', 'RE', 'REU', NULL, NULL),
	(181, 'Romania', 'RO', 'ROU', NULL, NULL),
	(182, 'Russia', 'RU', 'RUS', NULL, NULL),
	(183, 'Rwanda', 'RW', 'RWA', NULL, NULL),
	(184, 'Saint Helena', 'SH', 'SHN', NULL, NULL),
	(185, 'Saint Kitts And Nevis', 'KN', 'KNA', NULL, NULL),
	(186, 'Saint Lucia', 'LC', 'LCA', NULL, NULL),
	(187, 'Saint Pierre and Miquelon', 'PM', 'SPM', NULL, NULL),
	(188, 'Saint Vincent And The Grenadines', 'VC', 'VCT', NULL, NULL),
	(189, 'Saint-Barthelemy', 'BL', 'BLM', NULL, NULL),
	(190, 'Saint-Martin (French part)', 'MF', 'MAF', NULL, NULL),
	(191, 'Samoa', 'WS', 'WSM', NULL, NULL),
	(192, 'San Marino', 'SM', 'SMR', NULL, NULL),
	(193, 'Sao Tome and Principe', 'ST', 'STP', NULL, NULL),
	(194, 'Saudi Arabia', 'SA', 'SAU', NULL, NULL),
	(195, 'Senegal', 'SN', 'SEN', NULL, NULL),
	(196, 'Serbia', 'RS', 'SRB', NULL, NULL),
	(197, 'Seychelles', 'SC', 'SYC', NULL, NULL),
	(198, 'Sierra Leone', 'SL', 'SLE', NULL, NULL),
	(199, 'Singapore', 'SG', 'SGP', NULL, NULL),
	(200, 'Slovakia', 'SK', 'SVK', NULL, NULL),
	(201, 'Slovenia', 'SI', 'SVN', NULL, NULL),
	(202, 'Solomon Islands', 'SB', 'SLB', NULL, NULL),
	(203, 'Somalia', 'SO', 'SOM', NULL, NULL),
	(204, 'South Africa', 'ZA', 'ZAF', NULL, NULL),
	(205, 'South Georgia', 'GS', 'SGS', NULL, NULL),
	(206, 'South Sudan', 'SS', 'SSD', NULL, NULL),
	(207, 'Spain', 'ES', 'ESP', NULL, NULL),
	(208, 'Sri Lanka', 'LK', 'LKA', NULL, NULL),
	(209, 'Sudan', 'SD', 'SDN', NULL, NULL),
	(210, 'Suriname', 'SR', 'SUR', NULL, NULL),
	(211, 'Svalbard And Jan Mayen Islands', 'SJ', 'SJM', NULL, NULL),
	(212, 'Swaziland', 'SZ', 'SWZ', NULL, NULL),
	(213, 'Sweden', 'SE', 'SWE', NULL, NULL),
	(214, 'Switzerland', 'CH', 'CHE', NULL, NULL),
	(215, 'Syria', 'SY', 'SYR', NULL, NULL),
	(216, 'Taiwan', 'TW', 'TWN', NULL, NULL),
	(217, 'Tajikistan', 'TJ', 'TJK', NULL, NULL),
	(218, 'Tanzania', 'TZ', 'TZA', NULL, NULL),
	(219, 'Thailand', 'TH', 'THA', NULL, NULL),
	(220, 'Togo', 'TG', 'TGO', NULL, NULL),
	(221, 'Tokelau', 'TK', 'TKL', NULL, NULL),
	(222, 'Tonga', 'TO', 'TON', NULL, NULL),
	(223, 'Trinidad And Tobago', 'TT', 'TTO', NULL, NULL),
	(224, 'Tunisia', 'TN', 'TUN', NULL, NULL),
	(225, 'Turkey', 'TR', 'TUR', NULL, NULL),
	(226, 'Turkmenistan', 'TM', 'TKM', NULL, NULL),
	(227, 'Turks And Caicos Islands', 'TC', 'TCA', NULL, NULL),
	(228, 'Tuvalu', 'TV', 'TUV', NULL, NULL),
	(229, 'Uganda', 'UG', 'UGA', NULL, NULL),
	(230, 'Ukraine', 'UA', 'UKR', NULL, NULL),
	(231, 'United Arab Emirates', 'AE', 'ARE', NULL, NULL),
	(232, 'United Kingdom', 'GB', 'GBR', NULL, NULL),
	(233, 'United States', 'US', 'USA', NULL, NULL),
	(234, 'United States Minor Outlying Islands', 'UM', 'UMI', NULL, NULL),
	(235, 'Uruguay', 'UY', 'URY', NULL, NULL),
	(236, 'Uzbekistan', 'UZ', 'UZB', NULL, NULL),
	(237, 'Vanuatu', 'VU', 'VUT', NULL, NULL),
	(238, 'Vatican City State (Holy See)', 'VA', 'VAT', NULL, NULL),
	(239, 'Venezuela', 'VE', 'VEN', NULL, NULL),
	(240, 'Vietnam', 'VN', 'VNM', NULL, NULL),
	(241, 'Virgin Islands (British)', 'VG', 'VGB', NULL, NULL),
	(242, 'Virgin Islands (US)', 'VI', 'VIR', NULL, NULL),
	(243, 'Wallis And Futuna Islands', 'WF', 'WLF', NULL, NULL),
	(244, 'Western Sahara', 'EH', 'ESH', NULL, NULL),
	(245, 'Yemen', 'YE', 'YEM', NULL, NULL),
	(246, 'Zambia', 'ZM', 'ZMB', NULL, NULL),
	(247, 'Zimbabwe', 'ZW', 'ZWE', NULL, NULL),
	(248, 'Kosovo', 'XK', 'XKX', NULL, NULL),
	(249, 'Curaçao', 'CW', 'CUW', NULL, NULL),
	(250, 'Sint Maarten (Dutch part)', 'SX', 'SXM', NULL, NULL);

-- Volcando estructura para tabla bd_apuesta_total.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bd_apuesta_total.migrations: ~1 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2022_06_30_192828_create_recharge_table', 1);

-- Volcando estructura para tabla bd_apuesta_total.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bd_apuesta_total.password_resets: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bd_apuesta_total.recharge
CREATE TABLE IF NOT EXISTS `recharge` (
  `id_recharge` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_client` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `communication_channel` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `payment_reference` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `bank` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `observation` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `coin` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `state` int(11) NOT NULL,
  `reason_cancellation` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_recharge`) USING BTREE,
  KEY `recharge_id_client_foreign` (`id_client`),
  KEY `recharge_id_user_foreign` (`id_user`),
  CONSTRAINT `recharge_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`),
  CONSTRAINT `recharge_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bd_apuesta_total.recharge: ~2 rows (aproximadamente)
INSERT INTO `recharge` (`id_recharge`, `id_client`, `id_user`, `code`, `date`, `communication_channel`, `payment_method`, `payment_reference`, `bank`, `file`, `observation`, `coin`, `amount`, `state`, `reason_cancellation`, `created_at`, `updated_at`) VALUES
	(1, 1990, 1, '00010008', '2022-07-01', '01', '01', '22342343', '038', 'uploads/recharge/00010008-1656704396.jpeg', '', 'PEN', 100.00, 1, '', '2022-07-01 14:39:21', '2022-07-01 14:39:56'),
	(2, 1990, 1, '00010009', '2022-07-01', '02', '03', '3242342', '045', 'uploads/recharge/00010009-1656704388.jpeg', '', 'PEN', 500.00, 1, '', '2022-07-01 14:39:48', '2022-07-01 14:39:48');

-- Volcando estructura para tabla bd_apuesta_total.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user_type` int(10) unsigned NOT NULL,
  `id_room` int(10) unsigned NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL,
  `api_token` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`),
  KEY `users_id_user_type_foreign` (`id_user_type`),
  CONSTRAINT `users_id_user_type_foreign` FOREIGN KEY (`id_user_type`) REFERENCES `user_types` (`id_user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bd_apuesta_total.users: ~2 rows (aproximadamente)
INSERT INTO `users` (`id_user`, `id_user_type`, `id_room`, `name`, `last_name`, `user`, `email`, `password`, `phone`, `state`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Yonathan William', 'Mamani Calisaya', 'Yonathan', 'yonathan@gmail.com', '$2y$10$B6B6BtluE2Eu/FNMeJHpNu/hA3wNRAsVrIPBXm8RP9wpIBHEI6AMq', NULL, 1, 'WzazlL2DDvlzfPQRjI4Naq2dfOIynpgiPNcxgCzMuQnDnW4g401A7YxIvjAS', NULL, NULL, '2022-01-27 23:42:07'),
	(2, 1, 1, 'Juan', 'Juan', 'Juan', 'juan@gmail.com', '$2y$10$rfye1uBSiWWdfKkGysDETeKgkwr5ttVorct8E4DXhf.h3hyav05CK', '', 1, 'sdfOL9WeENERqYAhiS7DRWauIHR8PWepYhL4XPoUxizvVcC3fIO220kvS5UR', NULL, '2022-01-27 23:29:41', '2022-01-27 23:39:35');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
