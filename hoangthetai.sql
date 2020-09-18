-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 01, 2020 lúc 03:08 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hoangthetai`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contry`
--

CREATE TABLE `contry` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alpha2Code` varchar(50) NOT NULL,
  `alpha3Code` varchar(50) DEFAULT NULL,
  `capital` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `subregion` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `contry`
--

INSERT INTO `contry` (`id`, `name`, `alpha2Code`, `alpha3Code`, `capital`, `region`, `subregion`, `flag`, `created_at`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 'Kabul', 'Asia', 'Southern Asia', 'images/flag_contry/afg.svg', '2020-05-27 16:21:38'),
(2, 'Åland Islands', 'AX', 'ALA', 'Mariehamn', 'Europe', 'Northern Europe', 'images/flag_contry/ala.svg', '2020-05-27 16:21:38'),
(3, 'Albania', 'AL', 'ALB', 'Tirana', 'Europe', 'Southern Europe', 'images/flag_contry/alb.svg', '2020-05-27 16:21:38'),
(4, 'Algeria', 'DZ', 'DZA', 'Algiers', 'Africa', 'Northern Africa', 'images/flag_contry/dza.svg', '2020-05-27 16:21:38'),
(5, 'American Samoa', 'AS', 'ASM', 'Pago Pago', 'Oceania', 'Polynesia', 'images/flag_contry/asm.svg', '2020-05-27 16:21:38'),
(6, 'Andorra', 'AD', 'AND', 'Andorra la Vella', 'Europe', 'Southern Europe', 'images/flag_contry/and.svg', '2020-05-27 16:21:38'),
(7, 'Angola', 'AO', 'AGO', 'Luanda', 'Africa', 'Middle Africa', 'images/flag_contry/ago.svg', '2020-05-27 16:21:39'),
(8, 'Anguilla', 'AI', 'AIA', 'The Valley', 'Americas', 'Caribbean', 'images/flag_contry/aia.svg', '2020-05-27 16:21:39'),
(9, 'Antarctica', 'AQ', 'ATA', '', 'Polar', '', 'images/flag_contry/ata.svg', '2020-05-27 16:21:39'),
(10, 'Antigua', 'AG', 'ATG', 'Saint John\'s', 'Americas', 'Caribbean', 'images/flag_contry/atg.svg', '2020-05-27 16:21:39'),
(11, 'Argentina', 'AR', 'ARG', 'Buenos Aires', 'Americas', 'South America', 'images/flag_contry/arg.svg', '2020-05-27 16:21:39'),
(12, 'Armenia', 'AM', 'ARM', 'Yerevan', 'Asia', 'Western Asia', 'images/flag_contry/arm.svg', '2020-05-27 16:21:39'),
(13, 'Aruba', 'AW', 'ABW', 'Oranjestad', 'Americas', 'Caribbean', 'images/flag_contry/abw.svg', '2020-05-27 16:21:39'),
(14, 'Australia', 'AU', 'AUS', 'Canberra', 'Oceania', 'Australia and New Zealand', 'images/flag_contry/aus.svg', '2020-05-27 16:21:39'),
(15, 'Austria', 'AT', 'AUT', 'Vienna', 'Europe', 'Western Europe', 'images/flag_contry/aut.svg', '2020-05-27 16:21:39'),
(16, 'Azerbaijan', 'AZ', 'AZE', 'Baku', 'Asia', 'Western Asia', 'images/flag_contry/aze.svg', '2020-05-27 16:21:39'),
(17, 'Bahamas', 'BS', 'BHS', 'Nassau', 'Americas', 'Caribbean', 'images/flag_contry/bhs.svg', '2020-05-27 16:21:39'),
(18, 'Bahrain', 'BH', 'BHR', 'Manama', 'Asia', 'Western Asia', 'images/flag_contry/bhr.svg', '2020-05-27 16:21:39'),
(19, 'Bangladesh', 'BD', 'BGD', 'Dhaka', 'Asia', 'Southern Asia', 'images/flag_contry/bgd.svg', '2020-05-27 16:21:39'),
(20, 'Barbados', 'BB', 'BRB', 'Bridgetown', 'Americas', 'Caribbean', 'images/flag_contry/brb.svg', '2020-05-27 16:21:39'),
(21, 'Belarus', 'BY', 'BLR', 'Minsk', 'Europe', 'Eastern Europe', 'images/flag_contry/blr.svg', '2020-05-27 16:21:39'),
(22, 'Belgium', 'BE', 'BEL', 'Brussels', 'Europe', 'Western Europe', 'images/flag_contry/bel.svg', '2020-05-27 16:21:39'),
(23, 'Belize', 'BZ', 'BLZ', 'Belmopan', 'Americas', 'Central America', 'images/flag_contry/blz.svg', '2020-05-27 16:21:39'),
(24, 'Benin', 'BJ', 'BEN', 'Porto-Novo', 'Africa', 'Western Africa', 'images/flag_contry/ben.svg', '2020-05-27 16:21:39'),
(25, 'Bermuda', 'BM', 'BMU', 'Hamilton', 'Americas', 'Northern America', 'images/flag_contry/bmu.svg', '2020-05-27 16:21:39'),
(26, 'Bhutan', 'BT', 'BTN', 'Thimphu', 'Asia', 'Southern Asia', 'images/flag_contry/btn.svg', '2020-05-27 16:21:39'),
(27, 'Bolivia', 'BO', 'BOL', 'Sucre', 'Americas', 'South America', 'images/flag_contry/bol.svg', '2020-05-27 16:21:39'),
(28, 'Bonaire', 'BQ', 'BES', 'Kralendijk', 'Americas', 'Caribbean', 'images/flag_contry/bes.svg', '2020-05-27 16:21:39'),
(29, 'Bosnia', 'BA', 'BIH', 'Sarajevo', 'Europe', 'Southern Europe', 'images/flag_contry/bih.svg', '2020-05-27 16:21:39'),
(30, 'Botswana', 'BW', 'BWA', 'Gaborone', 'Africa', 'Southern Africa', 'images/flag_contry/bwa.svg', '2020-05-27 16:21:39'),
(31, 'Bouvet Island', 'BV', 'BVT', '', '', '', 'images/flag_contry/bvt.svg', '2020-05-27 16:21:39'),
(32, 'Brazil', 'BR', 'BRA', 'Brasília', 'Americas', 'South America', 'images/flag_contry/bra.svg', '2020-05-27 16:21:39'),
(33, 'British Indian', 'IO', 'IOT', 'Diego Garcia', 'Africa', 'Eastern Africa', 'images/flag_contry/iot.svg', '2020-05-27 16:21:39'),
(34, 'United States', 'UM', 'UMI', '', 'Americas', 'Northern America', 'images/flag_contry/umi.svg', '2020-05-27 16:21:39'),
(35, 'Virgin Islands', 'VG', 'VGB', 'Road Town', 'Americas', 'Caribbean', 'images/flag_contry/vgb.svg', '2020-05-27 16:21:39'),
(36, 'Virgin Islands', 'VI', 'VIR', 'Charlotte Amalie', 'Americas', 'Caribbean', 'images/flag_contry/vir.svg', '2020-05-27 16:21:39'),
(37, 'Brunei Darussalam', 'BN', 'BRN', 'Bandar Seri Begawan', 'Asia', 'South-Eastern Asia', 'images/flag_contry/brn.svg', '2020-05-27 16:21:39'),
(38, 'Bulgaria', 'BG', 'BGR', 'Sofia', 'Europe', 'Eastern Europe', 'images/flag_contry/bgr.svg', '2020-05-27 16:21:39'),
(39, 'Burkina Faso', 'BF', 'BFA', 'Ouagadougou', 'Africa', 'Western Africa', 'images/flag_contry/bfa.svg', '2020-05-27 16:21:39'),
(40, 'Burundi', 'BI', 'BDI', 'Bujumbura', 'Africa', 'Eastern Africa', 'images/flag_contry/bdi.svg', '2020-05-27 16:21:39'),
(41, 'Cambodia', 'KH', 'KHM', 'Phnom Penh', 'Asia', 'South-Eastern Asia', 'images/flag_contry/khm.svg', '2020-05-27 16:21:40'),
(42, 'Cameroon', 'CM', 'CMR', 'Yaoundé', 'Africa', 'Middle Africa', 'images/flag_contry/cmr.svg', '2020-05-27 16:21:40'),
(43, 'Canada', 'CA', 'CAN', 'Ottawa', 'Americas', 'Northern America', 'images/flag_contry/can.svg', '2020-05-27 16:21:40'),
(44, 'Cabo Verde', 'CV', 'CPV', 'Praia', 'Africa', 'Western Africa', 'images/flag_contry/cpv.svg', '2020-05-27 16:21:40'),
(45, 'Cayman Islands', 'KY', 'CYM', 'George Town', 'Americas', 'Caribbean', 'images/flag_contry/cym.svg', '2020-05-27 16:21:40'),
(46, 'Central African', 'CF', 'CAF', 'Bangui', 'Africa', 'Middle Africa', 'images/flag_contry/caf.svg', '2020-05-27 16:21:40'),
(47, 'Chad', 'TD', 'TCD', 'N\'Djamena', 'Africa', 'Middle Africa', 'images/flag_contry/tcd.svg', '2020-05-27 16:21:40'),
(48, 'Chile', 'CL', 'CHL', 'Santiago', 'Americas', 'South America', 'images/flag_contry/chl.svg', '2020-05-27 16:21:40'),
(49, 'China', 'CN', 'CHN', 'Beijing', 'Asia', 'Eastern Asia', 'images/flag_contry/chn.svg', '2020-05-27 16:21:40'),
(50, 'Christmas Island', 'CX', 'CXR', 'Flying Fish Cove', 'Oceania', 'Australia and New Zealand', 'images/flag_contry/cxr.svg', '2020-05-27 16:21:40'),
(51, 'Cocos Islands', 'CC', 'CCK', 'West Island', 'Oceania', 'Australia and New Zealand', 'images/flag_contry/cck.svg', '2020-05-27 16:21:40'),
(52, 'Colombia', 'CO', 'COL', 'Bogotá', 'Americas', 'South America', 'images/flag_contry/col.svg', '2020-05-27 16:21:40'),
(53, 'Comoros', 'KM', 'COM', 'Moroni', 'Africa', 'Eastern Africa', 'images/flag_contry/com.svg', '2020-05-27 16:21:40'),
(54, 'Congo', 'CG', 'COG', 'Brazzaville', 'Africa', 'Middle Africa', 'images/flag_contry/cog.svg', '2020-05-27 16:21:40'),
(55, 'Congo Democratic', 'CD', 'COD', 'Kinshasa', 'Africa', 'Middle Africa', 'images/flag_contry/cod.svg', '2020-05-27 16:21:40'),
(56, 'Cook Islands', 'CK', 'COK', 'Avarua', 'Oceania', 'Polynesia', 'images/flag_contry/cok.svg', '2020-05-27 16:21:40'),
(57, 'Costa Rica', 'CR', 'CRI', 'San José', 'Americas', 'Central America', 'images/flag_contry/cri.svg', '2020-05-27 16:21:40'),
(58, 'Croatia', 'HR', 'HRV', 'Zagreb', 'Europe', 'Southern Europe', 'images/flag_contry/hrv.svg', '2020-05-27 16:21:40'),
(59, 'Cuba', 'CU', 'CUB', 'Havana', 'Americas', 'Caribbean', 'images/flag_contry/cub.svg', '2020-05-27 16:21:40'),
(60, 'Curaçao', 'CW', 'CUW', 'Willemstad', 'Americas', 'Caribbean', 'images/flag_contry/cuw.svg', '2020-05-27 16:21:40'),
(61, 'Cyprus', 'CY', 'CYP', 'Nicosia', 'Europe', 'Southern Europe', 'images/flag_contry/cyp.svg', '2020-05-27 16:21:40'),
(62, 'Czech Republic', 'CZ', 'CZE', 'Prague', 'Europe', 'Eastern Europe', 'images/flag_contry/cze.svg', '2020-05-27 16:21:40'),
(63, 'Denmark', 'DK', 'DNK', 'Copenhagen', 'Europe', 'Northern Europe', 'images/flag_contry/dnk.svg', '2020-05-27 16:21:40'),
(64, 'Djibouti', 'DJ', 'DJI', 'Djibouti', 'Africa', 'Eastern Africa', 'images/flag_contry/dji.svg', '2020-05-27 16:21:40'),
(65, 'Dominica', 'DM', 'DMA', 'Roseau', 'Americas', 'Caribbean', 'images/flag_contry/dma.svg', '2020-05-27 16:21:40'),
(66, 'Dominican Republic', 'DO', 'DOM', 'Santo Domingo', 'Americas', 'Caribbean', 'images/flag_contry/dom.svg', '2020-05-27 16:21:40'),
(67, 'Ecuador', 'EC', 'ECU', 'Quito', 'Americas', 'South America', 'images/flag_contry/ecu.svg', '2020-05-27 16:21:40'),
(68, 'Egypt', 'EG', 'EGY', 'Cairo', 'Africa', 'Northern Africa', 'images/flag_contry/egy.svg', '2020-05-27 16:21:40'),
(69, 'El Salvador', 'SV', 'SLV', 'San Salvador', 'Americas', 'Central America', 'images/flag_contry/slv.svg', '2020-05-27 16:21:40'),
(70, 'Equatorial Guinea', 'GQ', 'GNQ', 'Malabo', 'Africa', 'Middle Africa', 'images/flag_contry/gnq.svg', '2020-05-27 16:21:40'),
(71, 'Eritrea', 'ER', 'ERI', 'Asmara', 'Africa', 'Eastern Africa', 'images/flag_contry/eri.svg', '2020-05-27 16:21:40'),
(72, 'Estonia', 'EE', 'EST', 'Tallinn', 'Europe', 'Northern Europe', 'images/flag_contry/est.svg', '2020-05-27 16:21:40'),
(73, 'Ethiopia', 'ET', 'ETH', 'Addis Ababa', 'Africa', 'Eastern Africa', 'images/flag_contry/eth.svg', '2020-05-27 16:21:40'),
(74, 'Falkland Islands', 'FK', 'FLK', 'Stanley', 'Americas', 'South America', 'images/flag_contry/flk.svg', '2020-05-27 16:21:40'),
(75, 'Faroe Islands', 'FO', 'FRO', 'Tórshavn', 'Europe', 'Northern Europe', 'images/flag_contry/fro.svg', '2020-05-27 16:21:40'),
(76, 'Fiji', 'FJ', 'FJI', 'Suva', 'Oceania', 'Melanesia', 'images/flag_contry/fji.svg', '2020-05-27 16:21:41'),
(77, 'Finland', 'FI', 'FIN', 'Helsinki', 'Europe', 'Northern Europe', 'images/flag_contry/fin.svg', '2020-05-27 16:21:41'),
(78, 'France', 'FR', 'FRA', 'Paris', 'Europe', 'Western Europe', 'images/flag_contry/fra.svg', '2020-05-27 16:21:41'),
(79, 'French Guiana', 'GF', 'GUF', 'Cayenne', 'Americas', 'South America', 'images/flag_contry/guf.svg', '2020-05-27 16:21:41'),
(80, 'French Polynesia', 'PF', 'PYF', 'Papeetē', 'Oceania', 'Polynesia', 'images/flag_contry/pyf.svg', '2020-05-27 16:21:41'),
(81, 'French Southern', 'TF', 'ATF', 'Port-aux-Français', 'Africa', 'Southern Africa', 'images/flag_contry/atf.svg', '2020-05-27 16:21:41'),
(82, 'Gabon', 'GA', 'GAB', 'Libreville', 'Africa', 'Middle Africa', 'images/flag_contry/gab.svg', '2020-05-27 16:21:41'),
(83, 'Gambia', 'GM', 'GMB', 'Banjul', 'Africa', 'Western Africa', 'images/flag_contry/gmb.svg', '2020-05-27 16:21:41'),
(84, 'Georgia', 'GE', 'GEO', 'Tbilisi', 'Asia', 'Western Asia', 'images/flag_contry/geo.svg', '2020-05-27 16:21:41'),
(85, 'Germany', 'DE', 'DEU', 'Berlin', 'Europe', 'Western Europe', 'images/flag_contry/deu.svg', '2020-05-27 16:21:41'),
(86, 'Ghana', 'GH', 'GHA', 'Accra', 'Africa', 'Western Africa', 'images/flag_contry/gha.svg', '2020-05-27 16:21:41'),
(87, 'Gibraltar', 'GI', 'GIB', 'Gibraltar', 'Europe', 'Southern Europe', 'images/flag_contry/gib.svg', '2020-05-27 16:21:41'),
(88, 'Greece', 'GR', 'GRC', 'Athens', 'Europe', 'Southern Europe', 'images/flag_contry/grc.svg', '2020-05-27 16:21:41'),
(89, 'Greenland', 'GL', 'GRL', 'Nuuk', 'Americas', 'Northern America', 'images/flag_contry/grl.svg', '2020-05-27 16:21:41'),
(90, 'Grenada', 'GD', 'GRD', 'St. George\'s', 'Americas', 'Caribbean', 'images/flag_contry/grd.svg', '2020-05-27 16:21:41'),
(91, 'Guadeloupe', 'GP', 'GLP', 'Basse-Terre', 'Americas', 'Caribbean', 'images/flag_contry/glp.svg', '2020-05-27 16:21:41'),
(92, 'Guam', 'GU', 'GUM', 'Hagåtña', 'Oceania', 'Micronesia', 'images/flag_contry/gum.svg', '2020-05-27 16:21:41'),
(93, 'Guatemala', 'GT', 'GTM', 'Guatemala City', 'Americas', 'Central America', 'images/flag_contry/gtm.svg', '2020-05-27 16:21:41'),
(94, 'Guernsey', 'GG', 'GGY', 'St. Peter Port', 'Europe', 'Northern Europe', 'images/flag_contry/ggy.svg', '2020-05-27 16:21:41'),
(95, 'Guinea', 'GN', 'GIN', 'Conakry', 'Africa', 'Western Africa', 'images/flag_contry/gin.svg', '2020-05-27 16:21:41'),
(96, 'Guinea-Bissau', 'GW', 'GNB', 'Bissau', 'Africa', 'Western Africa', 'images/flag_contry/gnb.svg', '2020-05-27 16:21:41'),
(97, 'Guyana', 'GY', 'GUY', 'Georgetown', 'Americas', 'South America', 'images/flag_contry/guy.svg', '2020-05-27 16:21:41'),
(98, 'Haiti', 'HT', 'HTI', 'Port-au-Prince', 'Americas', 'Caribbean', 'images/flag_contry/hti.svg', '2020-05-27 16:21:41'),
(99, 'Heard Island', 'HM', 'HMD', '', '', '', 'images/flag_contry/hmd.svg', '2020-05-27 16:21:42'),
(100, 'Holy See', 'VA', 'VAT', 'Rome', 'Europe', 'Southern Europe', 'images/flag_contry/vat.svg', '2020-05-27 16:21:42'),
(101, 'Honduras', 'HN', 'HND', 'Tegucigalpa', 'Americas', 'Central America', 'images/flag_contry/hnd.svg', '2020-05-27 16:21:42'),
(102, 'Hong Kong', 'HK', 'HKG', 'City of Victoria', 'Asia', 'Eastern Asia', 'images/flag_contry/hkg.svg', '2020-05-27 16:21:42'),
(103, 'Hungary', 'HU', 'HUN', 'Budapest', 'Europe', 'Eastern Europe', 'images/flag_contry/hun.svg', '2020-05-27 16:21:42'),
(104, 'Iceland', 'IS', 'ISL', 'Reykjavík', 'Europe', 'Northern Europe', 'images/flag_contry/isl.svg', '2020-05-27 16:21:42'),
(105, 'India', 'IN', 'IND', 'New Delhi', 'Asia', 'Southern Asia', 'images/flag_contry/ind.svg', '2020-05-27 16:21:42'),
(106, 'Indonesia', 'ID', 'IDN', 'Jakarta', 'Asia', 'South-Eastern Asia', 'images/flag_contry/idn.svg', '2020-05-27 16:21:42'),
(107, 'Côte d\'Ivoire', 'CI', 'CIV', 'Yamoussoukro', 'Africa', 'Western Africa', 'images/flag_contry/civ.svg', '2020-05-27 16:21:42'),
(108, 'Iran', 'IR', 'IRN', 'Tehran', 'Asia', 'Southern Asia', 'images/flag_contry/irn.svg', '2020-05-27 16:21:42'),
(109, 'Iraq', 'IQ', 'IRQ', 'Baghdad', 'Asia', 'Western Asia', 'images/flag_contry/irq.svg', '2020-05-27 16:21:42'),
(110, 'Ireland', 'IE', 'IRL', 'Dublin', 'Europe', 'Northern Europe', 'images/flag_contry/irl.svg', '2020-05-27 16:21:42'),
(111, 'Isle of Man', 'IM', 'IMN', 'Douglas', 'Europe', 'Northern Europe', 'images/flag_contry/imn.svg', '2020-05-27 16:21:42'),
(112, 'Israel', 'IL', 'ISR', 'Jerusalem', 'Asia', 'Western Asia', 'images/flag_contry/isr.svg', '2020-05-27 16:21:42'),
(113, 'Italy', 'IT', 'ITA', 'Rome', 'Europe', 'Southern Europe', 'images/flag_contry/ita.svg', '2020-05-27 16:21:42'),
(114, 'Jamaica', 'JM', 'JAM', 'Kingston', 'Americas', 'Caribbean', 'images/flag_contry/jam.svg', '2020-05-27 16:21:42'),
(115, 'Japan', 'JP', 'JPN', 'Tokyo', 'Asia', 'Eastern Asia', 'images/flag_contry/jpn.svg', '2020-05-27 16:21:42'),
(116, 'Jersey', 'JE', 'JEY', 'Saint Helier', 'Europe', 'Northern Europe', 'images/flag_contry/jey.svg', '2020-05-27 16:21:42'),
(117, 'Jordan', 'JO', 'JOR', 'Amman', 'Asia', 'Western Asia', 'images/flag_contry/jor.svg', '2020-05-27 16:21:42'),
(118, 'Kazakhstan', 'KZ', 'KAZ', 'Astana', 'Asia', 'Central Asia', 'images/flag_contry/kaz.svg', '2020-05-27 16:21:42'),
(119, 'Kenya', 'KE', 'KEN', 'Nairobi', 'Africa', 'Eastern Africa', 'images/flag_contry/ken.svg', '2020-05-27 16:21:42'),
(120, 'Kiribati', 'KI', 'KIR', 'South Tarawa', 'Oceania', 'Micronesia', 'images/flag_contry/kir.svg', '2020-05-27 16:21:42'),
(121, 'Kuwait', 'KW', 'KWT', 'Kuwait City', 'Asia', 'Western Asia', 'images/flag_contry/kwt.svg', '2020-05-27 16:21:42'),
(122, 'Kyrgyzstan', 'KG', 'KGZ', 'Bishkek', 'Asia', 'Central Asia', 'images/flag_contry/kgz.svg', '2020-05-27 16:21:42'),
(123, 'Lao', 'LA', 'LAO', 'Vientiane', 'Asia', 'South-Eastern Asia', 'images/flag_contry/lao.svg', '2020-05-27 16:21:42'),
(124, 'Latvia', 'LV', 'LVA', 'Riga', 'Europe', 'Northern Europe', 'images/flag_contry/lva.svg', '2020-05-27 16:21:42'),
(125, 'Lebanon', 'LB', 'LBN', 'Beirut', 'Asia', 'Western Asia', 'images/flag_contry/lbn.svg', '2020-05-27 16:21:42'),
(126, 'Lesotho', 'LS', 'LSO', 'Maseru', 'Africa', 'Southern Africa', 'images/flag_contry/lso.svg', '2020-05-27 16:21:43'),
(127, 'Liberia', 'LR', 'LBR', 'Monrovia', 'Africa', 'Western Africa', 'images/flag_contry/lbr.svg', '2020-05-27 16:21:43'),
(128, 'Libya', 'LY', 'LBY', 'Tripoli', 'Africa', 'Northern Africa', 'images/flag_contry/lby.svg', '2020-05-27 16:21:43'),
(129, 'Liechtenstein', 'LI', 'LIE', 'Vaduz', 'Europe', 'Western Europe', 'images/flag_contry/lie.svg', '2020-05-27 16:21:43'),
(130, 'Lithuania', 'LT', 'LTU', 'Vilnius', 'Europe', 'Northern Europe', 'images/flag_contry/ltu.svg', '2020-05-27 16:21:43'),
(131, 'Luxembourg', 'LU', 'LUX', 'Luxembourg', 'Europe', 'Western Europe', 'images/flag_contry/lux.svg', '2020-05-27 16:21:43'),
(132, 'Macao', 'MO', 'MAC', '', 'Asia', 'Eastern Asia', 'images/flag_contry/mac.svg', '2020-05-27 16:21:43'),
(133, 'Macedonia', 'MK', 'MKD', 'Skopje', 'Europe', 'Southern Europe', 'images/flag_contry/mkd.svg', '2020-05-27 16:21:43'),
(134, 'Madagascar', 'MG', 'MDG', 'Antananarivo', 'Africa', 'Eastern Africa', 'images/flag_contry/mdg.svg', '2020-05-27 16:21:43'),
(135, 'Malawi', 'MW', 'MWI', 'Lilongwe', 'Africa', 'Eastern Africa', 'images/flag_contry/mwi.svg', '2020-05-27 16:21:43'),
(136, 'Malaysia', 'MY', 'MYS', 'Kuala Lumpur', 'Asia', 'South-Eastern Asia', 'images/flag_contry/mys.svg', '2020-05-27 16:21:43'),
(137, 'Maldives', 'MV', 'MDV', 'Malé', 'Asia', 'Southern Asia', 'images/flag_contry/mdv.svg', '2020-05-27 16:21:43'),
(138, 'Mali', 'ML', 'MLI', 'Bamako', 'Africa', 'Western Africa', 'images/flag_contry/mli.svg', '2020-05-27 16:21:43'),
(139, 'Malta', 'MT', 'MLT', 'Valletta', 'Europe', 'Southern Europe', 'images/flag_contry/mlt.svg', '2020-05-27 16:21:43'),
(140, 'Marshall Islands', 'MH', 'MHL', 'Majuro', 'Oceania', 'Micronesia', 'images/flag_contry/mhl.svg', '2020-05-27 16:21:43'),
(141, 'Martinique', 'MQ', 'MTQ', 'Fort-de-France', 'Americas', 'Caribbean', 'images/flag_contry/mtq.svg', '2020-05-27 16:21:43'),
(142, 'Mauritania', 'MR', 'MRT', 'Nouakchott', 'Africa', 'Western Africa', 'images/flag_contry/mrt.svg', '2020-05-27 16:21:43'),
(143, 'Mauritius', 'MU', 'MUS', 'Port Louis', 'Africa', 'Eastern Africa', 'images/flag_contry/mus.svg', '2020-05-27 16:21:43'),
(144, 'Mayotte', 'YT', 'MYT', 'Mamoudzou', 'Africa', 'Eastern Africa', 'images/flag_contry/myt.svg', '2020-05-27 16:21:43'),
(145, 'Mexico', 'MX', 'MEX', 'Mexico City', 'Americas', 'Central America', 'images/flag_contry/mex.svg', '2020-05-27 16:21:43'),
(146, 'Micronesia', 'FM', 'FSM', 'Palikir', 'Oceania', 'Micronesia', 'images/flag_contry/fsm.svg', '2020-05-27 16:21:43'),
(147, 'Moldova', 'MD', 'MDA', 'Chișinău', 'Europe', 'Eastern Europe', 'images/flag_contry/mda.svg', '2020-05-27 16:21:43'),
(148, 'Monaco', 'MC', 'MCO', 'Monaco', 'Europe', 'Western Europe', 'images/flag_contry/mco.svg', '2020-05-27 16:21:43'),
(149, 'Mongolia', 'MN', 'MNG', 'Ulan Bator', 'Asia', 'Eastern Asia', 'images/flag_contry/mng.svg', '2020-05-27 16:21:43'),
(150, 'Montenegro', 'ME', 'MNE', 'Podgorica', 'Europe', 'Southern Europe', 'images/flag_contry/mne.svg', '2020-05-27 16:21:43'),
(151, 'Montserrat', 'MS', 'MSR', 'Plymouth', 'Americas', 'Caribbean', 'images/flag_contry/msr.svg', '2020-05-27 16:21:43'),
(152, 'Morocco', 'MA', 'MAR', 'Rabat', 'Africa', 'Northern Africa', 'images/flag_contry/mar.svg', '2020-05-27 16:21:43'),
(153, 'Mozambique', 'MZ', 'MOZ', 'Maputo', 'Africa', 'Eastern Africa', 'images/flag_contry/moz.svg', '2020-05-27 16:21:43'),
(154, 'Myanmar', 'MM', 'MMR', 'Naypyidaw', 'Asia', 'South-Eastern Asia', 'images/flag_contry/mmr.svg', '2020-05-27 16:21:43'),
(155, 'Namibia', 'NA', 'NAM', 'Windhoek', 'Africa', 'Southern Africa', 'images/flag_contry/nam.svg', '2020-05-27 16:21:43'),
(156, 'Nauru', 'NR', 'NRU', 'Yaren', 'Oceania', 'Micronesia', 'images/flag_contry/nru.svg', '2020-05-27 16:21:43'),
(157, 'Nepal', 'NP', 'NPL', 'Kathmandu', 'Asia', 'Southern Asia', 'images/flag_contry/npl.svg', '2020-05-27 16:21:44'),
(158, 'Netherlands', 'NL', 'NLD', 'Amsterdam', 'Europe', 'Western Europe', 'images/flag_contry/nld.svg', '2020-05-27 16:21:44'),
(159, 'New Caledonia', 'NC', 'NCL', 'Nouméa', 'Oceania', 'Melanesia', 'images/flag_contry/ncl.svg', '2020-05-27 16:21:44'),
(160, 'New Zealand', 'NZ', 'NZL', 'Wellington', 'Oceania', 'Australia and New Zealand', 'images/flag_contry/nzl.svg', '2020-05-27 16:21:44'),
(161, 'Nicaragua', 'NI', 'NIC', 'Managua', 'Americas', 'Central America', 'images/flag_contry/nic.svg', '2020-05-27 16:21:44'),
(162, 'Niger', 'NE', 'NER', 'Niamey', 'Africa', 'Western Africa', 'images/flag_contry/ner.svg', '2020-05-27 16:21:44'),
(163, 'Nigeria', 'NG', 'NGA', 'Abuja', 'Africa', 'Western Africa', 'images/flag_contry/nga.svg', '2020-05-27 16:21:44'),
(164, 'Niue', 'NU', 'NIU', 'Alofi', 'Oceania', 'Polynesia', 'images/flag_contry/niu.svg', '2020-05-27 16:21:44'),
(165, 'Norfolk Island', 'NF', 'NFK', 'Kingston', 'Oceania', 'Australia and New Zealand', 'images/flag_contry/nfk.svg', '2020-05-27 16:21:44'),
(166, 'Korea', 'KP', 'PRK', 'Pyongyang', 'Asia', 'Eastern Asia', 'images/flag_contry/prk.svg', '2020-05-27 16:21:44'),
(167, 'Northern Mariana', 'MP', 'MNP', 'Saipan', 'Oceania', 'Micronesia', 'images/flag_contry/mnp.svg', '2020-05-27 16:21:44'),
(168, 'Norway', 'NO', 'NOR', 'Oslo', 'Europe', 'Northern Europe', 'images/flag_contry/nor.svg', '2020-05-27 16:21:44'),
(169, 'Oman', 'OM', 'OMN', 'Muscat', 'Asia', 'Western Asia', 'images/flag_contry/omn.svg', '2020-05-27 16:21:44'),
(170, 'Pakistan', 'PK', 'PAK', 'Islamabad', 'Asia', 'Southern Asia', 'images/flag_contry/pak.svg', '2020-05-27 16:21:44'),
(171, 'Palau', 'PW', 'PLW', 'Ngerulmud', 'Oceania', 'Micronesia', 'images/flag_contry/plw.svg', '2020-05-27 16:21:44'),
(172, 'Palestine', 'PS', 'PSE', 'Ramallah', 'Asia', 'Western Asia', 'images/flag_contry/pse.svg', '2020-05-27 16:21:44'),
(173, 'Panama', 'PA', 'PAN', 'Panama City', 'Americas', 'Central America', 'images/flag_contry/pan.svg', '2020-05-27 16:21:44'),
(174, 'Papua Guinea', 'PG', 'PNG', 'Port Moresby', 'Oceania', 'Melanesia', 'images/flag_contry/png.svg', '2020-05-27 16:21:44'),
(175, 'Paraguay', 'PY', 'PRY', 'Asunción', 'Americas', 'South America', 'images/flag_contry/pry.svg', '2020-05-27 16:21:44'),
(176, 'Peru', 'PE', 'PER', 'Lima', 'Americas', 'South America', 'images/flag_contry/per.svg', '2020-05-27 16:21:44'),
(177, 'Philippines', 'PH', 'PHL', 'Manila', 'Asia', 'South-Eastern Asia', 'images/flag_contry/phl.svg', '2020-05-27 16:21:44'),
(178, 'Pitcairn', 'PN', 'PCN', 'Adamstown', 'Oceania', 'Polynesia', 'images/flag_contry/pcn.svg', '2020-05-27 16:21:44'),
(179, 'Poland', 'PL', 'POL', 'Warsaw', 'Europe', 'Eastern Europe', 'images/flag_contry/pol.svg', '2020-05-27 16:21:44'),
(180, 'Portugal', 'PT', 'PRT', 'Lisbon', 'Europe', 'Southern Europe', 'images/flag_contry/prt.svg', '2020-05-27 16:21:44'),
(181, 'Puerto Rico', 'PR', 'PRI', 'San Juan', 'Americas', 'Caribbean', 'images/flag_contry/pri.svg', '2020-05-27 16:21:44'),
(182, 'Qatar', 'QA', 'QAT', 'Doha', 'Asia', 'Western Asia', 'images/flag_contry/qat.svg', '2020-05-27 16:21:44'),
(183, 'Republic of Kosovo', 'XK', 'KOS', 'Pristina', 'Europe', 'Eastern Europe', 'images/flag_contry/kos.svg', '2020-05-27 16:21:44'),
(184, 'Réunion', 'RE', 'REU', 'Saint-Denis', 'Africa', 'Eastern Africa', 'images/flag_contry/reu.svg', '2020-05-27 16:21:44'),
(185, 'Romania', 'RO', 'ROU', 'Bucharest', 'Europe', 'Eastern Europe', 'images/flag_contry/rou.svg', '2020-05-27 16:21:45'),
(186, 'Russian Federation', 'RU', 'RUS', 'Moscow', 'Europe', 'Eastern Europe', 'images/flag_contry/rus.svg', '2020-05-27 16:21:45'),
(187, 'Rwanda', 'RW', 'RWA', 'Kigali', 'Africa', 'Eastern Africa', 'images/flag_contry/rwa.svg', '2020-05-27 16:21:45'),
(188, 'Saint Barthélemy', 'BL', 'BLM', 'Gustavia', 'Americas', 'Caribbean', 'images/flag_contry/blm.svg', '2020-05-27 16:21:45'),
(189, 'Saint Helena', 'SH', 'SHN', 'Jamestown', 'Africa', 'Western Africa', 'images/flag_contry/shn.svg', '2020-05-27 16:21:45'),
(190, 'Saint Kitts', 'KN', 'KNA', 'Basseterre', 'Americas', 'Caribbean', 'images/flag_contry/kna.svg', '2020-05-27 16:21:45'),
(191, 'Saint Lucia', 'LC', 'LCA', 'Castries', 'Americas', 'Caribbean', 'images/flag_contry/lca.svg', '2020-05-27 16:21:45'),
(192, 'Saint Martin', 'MF', 'MAF', 'Marigot', 'Americas', 'Caribbean', 'images/flag_contry/maf.svg', '2020-05-27 16:21:45'),
(193, 'Saint Pierre', 'PM', 'SPM', 'Saint-Pierre', 'Americas', 'Northern America', 'images/flag_contry/spm.svg', '2020-05-27 16:21:45'),
(194, 'Saint Vincent', 'VC', 'VCT', 'Kingstown', 'Americas', 'Caribbean', 'images/flag_contry/vct.svg', '2020-05-27 16:21:45'),
(195, 'Samoa', 'WS', 'WSM', 'Apia', 'Oceania', 'Polynesia', 'images/flag_contry/wsm.svg', '2020-05-27 16:21:45'),
(196, 'San Marino', 'SM', 'SMR', 'City of San Marino', 'Europe', 'Southern Europe', 'images/flag_contry/smr.svg', '2020-05-27 16:21:45'),
(197, 'Sao Tome', 'ST', 'STP', 'São Tomé', 'Africa', 'Middle Africa', 'images/flag_contry/stp.svg', '2020-05-27 16:21:45'),
(198, 'Saudi Arabia', 'SA', 'SAU', 'Riyadh', 'Asia', 'Western Asia', 'images/flag_contry/sau.svg', '2020-05-27 16:21:45'),
(199, 'Senegal', 'SN', 'SEN', 'Dakar', 'Africa', 'Western Africa', 'images/flag_contry/sen.svg', '2020-05-27 16:21:45'),
(200, 'Serbia', 'RS', 'SRB', 'Belgrade', 'Europe', 'Southern Europe', 'images/flag_contry/srb.svg', '2020-05-27 16:21:45'),
(201, 'Seychelles', 'SC', 'SYC', 'Victoria', 'Africa', 'Eastern Africa', 'images/flag_contry/syc.svg', '2020-05-27 16:21:45'),
(202, 'Sierra Leone', 'SL', 'SLE', 'Freetown', 'Africa', 'Western Africa', 'images/flag_contry/sle.svg', '2020-05-27 16:21:45'),
(203, 'Singapore', 'SG', 'SGP', 'Singapore', 'Asia', 'South-Eastern Asia', 'images/flag_contry/sgp.svg', '2020-05-27 16:21:45'),
(204, 'Sint Maarten', 'SX', 'SXM', 'Philipsburg', 'Americas', 'Caribbean', 'images/flag_contry/sxm.svg', '2020-05-27 16:21:45'),
(205, 'Slovakia', 'SK', 'SVK', 'Bratislava', 'Europe', 'Eastern Europe', 'images/flag_contry/svk.svg', '2020-05-27 16:21:46'),
(206, 'Slovenia', 'SI', 'SVN', 'Ljubljana', 'Europe', 'Southern Europe', 'images/flag_contry/svn.svg', '2020-05-27 16:21:46'),
(207, 'Solomon Islands', 'SB', 'SLB', 'Honiara', 'Oceania', 'Melanesia', 'images/flag_contry/slb.svg', '2020-05-27 16:21:46'),
(208, 'Somalia', 'SO', 'SOM', 'Mogadishu', 'Africa', 'Eastern Africa', 'images/flag_contry/som.svg', '2020-05-27 16:21:46'),
(209, 'South Africa', 'ZA', 'ZAF', 'Pretoria', 'Africa', 'Southern Africa', 'images/flag_contry/zaf.svg', '2020-05-27 16:21:46'),
(210, 'South Georgia', 'GS', 'SGS', 'King Edward Point', 'Americas', 'South America', 'images/flag_contry/sgs.svg', '2020-05-27 16:21:46'),
(211, 'Korea', 'KR', 'KOR', 'Seoul', 'Asia', 'Eastern Asia', 'images/flag_contry/kor.svg', '2020-05-27 16:21:46'),
(212, 'South Sudan', 'SS', 'SSD', 'Juba', 'Africa', 'Middle Africa', 'images/flag_contry/ssd.svg', '2020-05-27 16:21:46'),
(213, 'Spain', 'ES', 'ESP', 'Madrid', 'Europe', 'Southern Europe', 'images/flag_contry/esp.svg', '2020-05-27 16:21:46'),
(214, 'Sri Lanka', 'LK', 'LKA', 'Colombo', 'Asia', 'Southern Asia', 'images/flag_contry/lka.svg', '2020-05-27 16:21:46'),
(215, 'Sudan', 'SD', 'SDN', 'Khartoum', 'Africa', 'Northern Africa', 'images/flag_contry/sdn.svg', '2020-05-27 16:21:46'),
(216, 'Suriname', 'SR', 'SUR', 'Paramaribo', 'Americas', 'South America', 'images/flag_contry/sur.svg', '2020-05-27 16:21:46'),
(217, 'Svalbard', 'SJ', 'SJM', 'Longyearbyen', 'Europe', 'Northern Europe', 'images/flag_contry/sjm.svg', '2020-05-27 16:21:46'),
(218, 'Swaziland', 'SZ', 'SWZ', 'Lobamba', 'Africa', 'Southern Africa', 'images/flag_contry/swz.svg', '2020-05-27 16:21:46'),
(219, 'Sweden', 'SE', 'SWE', 'Stockholm', 'Europe', 'Northern Europe', 'images/flag_contry/swe.svg', '2020-05-27 16:21:46'),
(220, 'Switzerland', 'CH', 'CHE', 'Bern', 'Europe', 'Western Europe', 'images/flag_contry/che.svg', '2020-05-27 16:21:46'),
(221, 'Syrian Arab Republic', 'SY', 'SYR', 'Damascus', 'Asia', 'Western Asia', 'images/flag_contry/syr.svg', '2020-05-27 16:21:46'),
(222, 'Taiwan', 'TW', 'TWN', 'Taipei', 'Asia', 'Eastern Asia', 'images/flag_contry/twn.svg', '2020-05-27 16:21:46'),
(223, 'Tajikistan', 'TJ', 'TJK', 'Dushanbe', 'Asia', 'Central Asia', 'images/flag_contry/tjk.svg', '2020-05-27 16:21:46'),
(224, 'Tanzania', 'TZ', 'TZA', 'Dodoma', 'Africa', 'Eastern Africa', 'images/flag_contry/tza.svg', '2020-05-27 16:21:46'),
(225, 'Thailand', 'TH', 'THA', 'Bangkok', 'Asia', 'South-Eastern Asia', 'images/flag_contry/tha.svg', '2020-05-27 16:21:46'),
(226, 'Timor-Leste', 'TL', 'TLS', 'Dili', 'Asia', 'South-Eastern Asia', 'images/flag_contry/tls.svg', '2020-05-27 16:21:46'),
(227, 'Togo', 'TG', 'TGO', 'Lomé', 'Africa', 'Western Africa', 'images/flag_contry/tgo.svg', '2020-05-27 16:21:46'),
(228, 'Tokelau', 'TK', 'TKL', 'Fakaofo', 'Oceania', 'Polynesia', 'images/flag_contry/tkl.svg', '2020-05-27 16:21:46'),
(229, 'Tonga', 'TO', 'TON', 'Nuku\'alofa', 'Oceania', 'Polynesia', 'images/flag_contry/ton.svg', '2020-05-27 16:21:46'),
(230, 'Trinidad', 'TT', 'TTO', 'Port of Spain', 'Americas', 'Caribbean', 'images/flag_contry/tto.svg', '2020-05-27 16:21:46'),
(231, 'Tunisia', 'TN', 'TUN', 'Tunis', 'Africa', 'Northern Africa', 'images/flag_contry/tun.svg', '2020-05-27 16:21:46'),
(232, 'Turkey', 'TR', 'TUR', 'Ankara', 'Asia', 'Western Asia', 'images/flag_contry/tur.svg', '2020-05-27 16:21:47'),
(233, 'Turkmenistan', 'TM', 'TKM', 'Ashgabat', 'Asia', 'Central Asia', 'images/flag_contry/tkm.svg', '2020-05-27 16:21:47'),
(234, 'Turks', 'TC', 'TCA', 'Cockburn Town', 'Americas', 'Caribbean', 'images/flag_contry/tca.svg', '2020-05-27 16:21:47'),
(235, 'Tuvalu', 'TV', 'TUV', 'Funafuti', 'Oceania', 'Polynesia', 'images/flag_contry/tuv.svg', '2020-05-27 16:21:47'),
(236, 'Uganda', 'UG', 'UGA', 'Kampala', 'Africa', 'Eastern Africa', 'images/flag_contry/uga.svg', '2020-05-27 16:21:47'),
(237, 'Ukraine', 'UA', 'UKR', 'Kiev', 'Europe', 'Eastern Europe', 'images/flag_contry/ukr.svg', '2020-05-27 16:21:47'),
(238, 'Arab Emirates', 'AE', 'ARE', 'Abu Dhabi', 'Asia', 'Western Asia', 'images/flag_contry/are.svg', '2020-05-27 16:21:47'),
(239, 'United Kingdom', 'GB', 'GBR', 'London', 'Europe', 'Northern Europe', 'images/flag_contry/gbr.svg', '2020-05-27 16:21:47'),
(240, 'United States', 'US', 'USA', 'Washington, D.C.', 'Americas', 'Northern America', 'images/flag_contry/usa.svg', '2020-05-27 16:21:47'),
(241, 'Uruguay', 'UY', 'URY', 'Montevideo', 'Americas', 'South America', 'images/flag_contry/ury.svg', '2020-05-27 16:21:47'),
(242, 'Uzbekistan', 'UZ', 'UZB', 'Tashkent', 'Asia', 'Central Asia', 'images/flag_contry/uzb.svg', '2020-05-27 16:21:47'),
(243, 'Vanuatu', 'VU', 'VUT', 'Port Vila', 'Oceania', 'Melanesia', 'images/flag_contry/vut.svg', '2020-05-27 16:21:47'),
(244, 'Venezuela', 'VE', 'VEN', 'Caracas', 'Americas', 'South America', 'images/flag_contry/ven.svg', '2020-05-27 16:21:47'),
(245, 'Viet Nam', 'VN', 'VNM', 'Hanoi', 'Asia', 'South-Eastern Asia', 'images/flag_contry/vnm.svg', '2020-05-27 16:21:47'),
(246, 'Wallis and Futuna', 'WF', 'WLF', 'Mata-Utu', 'Oceania', 'Polynesia', 'images/flag_contry/wlf.svg', '2020-05-27 16:21:47'),
(247, 'Western Sahara', 'EH', 'ESH', 'El Aaiún', 'Africa', 'Northern Africa', 'images/flag_contry/esh.svg', '2020-05-27 16:21:47'),
(248, 'Yemen', 'YE', 'YEM', 'Sana\'a', 'Asia', 'Western Asia', 'images/flag_contry/yem.svg', '2020-05-27 16:21:47'),
(249, 'Zambia', 'ZM', 'ZMB', 'Lusaka', 'Africa', 'Eastern Africa', 'images/flag_contry/zmb.svg', '2020-05-27 16:21:47'),
(250, 'Zimbabwe', 'ZW', 'ZWE', 'Harare', 'Africa', 'Eastern Africa', 'images/flag_contry/zwe.svg', '2020-05-27 16:21:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `franchise`
--

CREATE TABLE `franchise` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `license` int(255) DEFAULT 0,
  `ib_level` varchar(50) DEFAULT '',
  `license06` int(255) DEFAULT 0,
  `license06_bonus` int(255) DEFAULT 0,
  `introduce` varchar(50) DEFAULT '',
  `permission_open_ibc` tinyint(1) DEFAULT 0,
  `show_in_create` tinyint(1) NOT NULL DEFAULT 1,
  `investment` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `franchise`
--

INSERT INTO `franchise` (`id`, `type`, `name`, `license`, `ib_level`, `license06`, `license06_bonus`, `introduce`, `permission_open_ibc`, `show_in_create`, `investment`) VALUES
(1, 'mib', 'MIB 0.6', 0, '', 0, 0, '', 0, 0, ''),
(2, 'startup', 'Startup', 15, '0.8', 10, 5, '100', 0, 1, '6000'),
(3, 'entrepreneur', 'Entrepreneur', 35, '0.8', 20, 15, '100', 0, 1, '12000'),
(4, 'enterprise', 'Enterprise', 60, '1', 30, 30, '100', 1, 1, '18000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `franchise_request`
--

CREATE TABLE `franchise_request` (
  `id` int(11) NOT NULL,
  `user_request` varchar(255) NOT NULL,
  `user_enter` varchar(255) NOT NULL,
  `type_request` int(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `active_flag` tinyint(1) DEFAULT 0,
  `user_approve` varchar(255) DEFAULT NULL,
  `time_approve` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `parent_create` int(11) NOT NULL DEFAULT 0,
  `parent_enterprise` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `avatar` varchar(1000) NOT NULL DEFAULT '',
  `token` varchar(1000) DEFAULT '',
  `time_create_token` int(255) DEFAULT NULL,
  `license` int(255) NOT NULL DEFAULT 0,
  `license_remaining` int(255) NOT NULL DEFAULT 0,
  `count_login` int(255) NOT NULL DEFAULT 0,
  `permision` int(11) DEFAULT 2,
  `franchise` int(11) NOT NULL,
  `franchise_date` varchar(255) NOT NULL DEFAULT '',
  `fullname` varchar(1000) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `contry` varchar(255) NOT NULL DEFAULT '',
  `support_fees` varchar(255) NOT NULL DEFAULT '0',
  `income_franchise` varchar(255) NOT NULL DEFAULT '0',
  `income_mib` varchar(255) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `active_date` varchar(255) NOT NULL DEFAULT '',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `member`
--

INSERT INTO `member` (`id`, `parent_create`, `parent_enterprise`, `username`, `password`, `avatar`, `token`, `time_create_token`, `license`, `license_remaining`, `count_login`, `permision`, `franchise`, `franchise_date`, `fullname`, `email`, `phone`, `contry`, `support_fees`, `income_franchise`, `income_mib`, `active`, `active_date`, `updated_at`) VALUES
(1, 0, '', 'admin', '2783398162a621079cce75a7e98f5e35', '', 'a6b2b235b9300ea2cebc3aa3029cfb5e0ba6949e', 1590972713, 0, 0, 3, 1, 0, '', '', '', '', '', '0', '0', '0', 1, '', '2020-06-01 00:51:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `upgrade_request`
--

CREATE TABLE `upgrade_request` (
  `id` int(11) NOT NULL,
  `user_enter` varchar(255) NOT NULL,
  `user_request` varchar(255) NOT NULL,
  `type_request` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contry`
--
ALTER TABLE `contry`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `franchise`
--
ALTER TABLE `franchise`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `franchise_request`
--
ALTER TABLE `franchise_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_request` (`type_request`);

--
-- Chỉ mục cho bảng `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `upgrade_request`
--
ALTER TABLE `upgrade_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contry`
--
ALTER TABLE `contry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT cho bảng `franchise`
--
ALTER TABLE `franchise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `franchise_request`
--
ALTER TABLE `franchise_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `upgrade_request`
--
ALTER TABLE `upgrade_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
