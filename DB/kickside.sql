-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 06:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kickside`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_name`, `email`, `phone`, `password`, `type`, `state`, `status`) VALUES
(1, 'user1', 'user1@gmail.com', '0565443', '81dc9bdb52d04dc20036dbd8313ed055', 'Journalist', 'Working', 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `arenas`
--

CREATE TABLE `arenas` (
  `arena_id` int(11) NOT NULL,
  `arena_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `country` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `est_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arenas`
--

INSERT INTO `arenas` (`arena_id`, `arena_name`, `description`, `country`, `city`, `capacity`, `est_date`) VALUES
(1, 'Stamford Bridge', '', 2, 'London', 50000, ''),
(2, 'Emirates Stadium', 'Stadium for Arsenal', 2, 'London', 38000, '1903-12-24'),
(3, 'Etihad Stadium', '', 2, 'Manchester', 30000, ''),
(4, 'Kigali Pele Stadium', 'THe stadium formely names Petit Stade Nyamirambo, but after the Pele death it was Re Innovated and named Kigali Pele Stadium', 1, 'Kigali', 30000, '2003-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `audio_havens`
--

CREATE TABLE `audio_havens` (
  `haven_id` int(11) NOT NULL,
  `haven_title` text NOT NULL,
  `haven_description` text NOT NULL,
  `haven_image_name` text NOT NULL,
  `haven_link` text NOT NULL,
  `haven_upload date` varchar(255) NOT NULL,
  `haven_upload_time` varchar(255) NOT NULL,
  `haven_journalist` int(11) NOT NULL,
  `other_participants` text NOT NULL,
  `haven_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audio_havens`
--

INSERT INTO `audio_havens` (`haven_id`, `haven_title`, `haven_description`, `haven_image_name`, `haven_link`, `haven_upload date`, `haven_upload_time`, `haven_journalist`, `other_participants`, `haven_status`) VALUES
(1, 'This is the haven TItle put here.', 'THis is the description. THis is the description.THis is the description.THis is the description. THis is the description.THis is the description. THis is the description.THis is the description. THis is the description.THis is the description.THis is the description.', 'Podcast Cover - f fdfvvf c c cv.webp', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/dZ4olPw9laI?si=ZawFQySepBI2tOt7\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '2024-01-06', '', 8, '', 'Running'),
(2, 'This is the haven TItle put here.', 'THis is the description. THis is the description.THis is the description.THis is the description. THis is the description.THis is the description. THis is the description.THis is the description. THis is the description.THis is the description.THis is the description.THis is the description. THis is the description.THis is the description.THis is the description. THis is the description.THis is the description. THis is the description.THis is the description. THis is the description.THis is the description.THis is the description.THis is the description. THis is the description.THis is the description.THis is the description. THis is the description.THis is the description. THis is the description.THis is the description. THis is the description.THis is the description.THis is the description.', 'Podcast Cover - ddsdd.webp', 'dvdsvd', '2024-01-09', '09:20', 9, 'dvsvsv, f fvv,vdsd  s,', 'Running'),
(3, 'Fela Music - Utulips (Official Music Video)', 'Me, iji', 'Podcast Cover - Fela Music - Utulips (Official Music Video).webp', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/T3m1d8-gOGQ?si=d4CDy-C8TJ7iWCdh\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '2024-01-09', '11:11', 7, 'Me, YOu', 'Running'),
(4, 'bfbb dfvfv', 'dsvdvs svdscd', 'Podcast Cover - bfbb dfvfv.webp', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/yzBa04z3I78?si=-xWJOUMXiQtY22Ni\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '2024-01-04', '11:16', 7, 'dcdcd', 'Running');

-- --------------------------------------------------------

--
-- Table structure for table `audio_havens_streams`
--

CREATE TABLE `audio_havens_streams` (
  `stream_id` int(11) NOT NULL,
  `haven` int(11) NOT NULL,
  `streams_count` int(11) NOT NULL,
  `stream_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audio_havens_streams`
--

INSERT INTO `audio_havens_streams` (`stream_id`, `haven`, `streams_count`, `stream_date`) VALUES
(1, 1, 1, '2024-01-09 10:54:02'),
(2, 1, 1, '2024-01-09 10:54:52'),
(3, 1, 1, '2024-01-09 10:54:55'),
(4, 1, 1, '2024-01-09 10:55:40'),
(5, 1, 1, '2024-01-09 10:56:27'),
(6, 1, 1, '2024-01-09 10:57:33'),
(7, 2, 1, '2024-01-09 10:59:02'),
(8, 1, 1, '2024-01-09 10:59:11'),
(9, 1, 1, '2024-01-09 11:00:12'),
(10, 1, 1, '2024-01-09 11:05:02'),
(11, 1, 1, '2024-01-09 11:06:10'),
(12, 1, 1, '2024-01-09 11:07:05'),
(13, 3, 1, '2024-01-09 11:13:21'),
(14, 4, 1, '2024-01-09 11:36:07'),
(15, 3, 1, '2024-01-09 17:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text NOT NULL,
  `genre` int(11) NOT NULL,
  `category_icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`, `genre`, `category_icon`) VALUES
(1, 'Exclusive', 'News articles that are exclusive', 1, 'fa-star'),
(2, 'NBA', 'News for NBA', 2, 'fa-basketball-ball'),
(3, 'Breaking News', '', 1, 'fa-exclamation-triangle'),
(4, 'Transfer Rumors', '', 1, 'fa-exchange-alt');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `country_description`) VALUES
(1, 'Rwanda', ''),
(2, 'England', ''),
(3, 'Spain', ''),
(4, 'France', '');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genre_name` varchar(255) NOT NULL,
  `genre_description` text NOT NULL,
  `genre_icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genre_name`, `genre_description`, `genre_icon`) VALUES
(1, 'Football', 'This is football ', 'fa-football'),
(2, 'Basketball', 'Basketball play', 'fa-basketball');

-- --------------------------------------------------------

--
-- Table structure for table `history_today`
--

CREATE TABLE `history_today` (
  `ht_id` int(11) NOT NULL,
  `history_genre` int(11) NOT NULL,
  `history_title` varchar(255) NOT NULL,
  `history_description` text NOT NULL,
  `history_image` varchar(255) NOT NULL,
  `history_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_today`
--

INSERT INTO `history_today` (`ht_id`, `history_genre`, `history_title`, `history_description`, `history_image`, `history_date`) VALUES
(5, 1, 'dcd f  dfv fd  fd cv xc cx cx cx cx ', 'd   cvvsfv fd  f c c cx cxvdvd  vdvd', 'History image - dcd f  dfv fd  fd cv xc cx cx cx cx .png', '0111-01-03'),
(6, 1, '1st steamboat the North Star sails up the northern Red River, Americagfhgf', 'Victor Trumper\r\n1895 Victor Trumper makes first-class debut for NSW 17 yrs 64 days', 'History image - 1st steamboat the North Star sails up the northern Red River, America.png', '1985-01-05'),
(8, 2, 'dvd fbgb gfbgfb g v vc xv bgtbf', 'bfbfbfbd', 'History image - dvd fbgb gfbgfb g v vc xv bgtbf.png', '2024-01-06'),
(9, 2, 'ddhfggbg', 'gvffd cxbbgbgfbfgbgf', 'History image - ddhfggbg.webp', '2024-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `journalists`
--

CREATE TABLE `journalists` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Working'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `journalists`
--

INSERT INTO `journalists` (`id`, `first_name`, `last_name`, `user_name`, `email`, `phone_number`, `password`, `display_name`, `status`) VALUES
(6, 'NN', 'BBBB', 'NN.BBBB', 'nb@f.e', '04837922', '81dc9bdb52d04dc20036dbd8313ed055', 'NN BBBB', 'Working'),
(7, 'ghbgf', 'gfbgf', 'ghbgf.gfbgf', 'fbfb@gmail.com', 'fbfbd', '81dc9bdb52d04dc20036dbd8313ed055', 'ghbgf gfbgf', 'Working'),
(8, 'aa', 'bbbb', 'aa.bbbb', 'aa@gmail.com', '07837232324', '81dc9bdb52d04dc20036dbd8313ed055', 'aa bbbb', 'Working'),
(9, 'cs', 'as', 'cs.as', 'csas@gmail.com', '03564656565', '81dc9bdb52d04dc20036dbd8313ed055', 'cs as', 'Working');

-- --------------------------------------------------------

--
-- Table structure for table `journalists_favorites`
--

CREATE TABLE `journalists_favorites` (
  `fav_id` int(11) NOT NULL,
  `journalist` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `date_of_fav` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `journalists_favorites`
--

INSERT INTO `journalists_favorites` (`fav_id`, `journalist`, `article`, `date_of_fav`) VALUES
(1, 6, 6, '2024-01-03'),
(2, 6, 4, '2024-01-03'),
(5, 6, 7, '2024-01-03 13:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `league_competitions`
--

CREATE TABLE `league_competitions` (
  `l_c_id` int(11) NOT NULL,
  `league_genre` int(11) NOT NULL,
  `competition_name` varchar(255) NOT NULL,
  `league_description` text NOT NULL,
  `league_country` int(11) NOT NULL,
  `teams_number` int(11) NOT NULL,
  `league_est` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `league_competitions`
--

INSERT INTO `league_competitions` (`l_c_id`, `league_genre`, `competition_name`, `league_description`, `league_country`, `teams_number`, `league_est`) VALUES
(1, 1, 'English Premiere League', 'EPL', 2, 20, '1907-06-26'),
(2, 1, 'Ligue 1', 'First division League in France Football', 4, 20, '1990-12-27'),
(3, 1, 'Laliga', 'Laliga the first division from Across', 3, 20, '1900-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `league_matches`
--

CREATE TABLE `league_matches` (
  `l_m_id` int(11) NOT NULL,
  `league_year` int(11) NOT NULL,
  `home_team` int(11) NOT NULL,
  `away_team` int(11) NOT NULL,
  `proposed_time` varchar(255) NOT NULL,
  `match_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `league_matches`
--

INSERT INTO `league_matches` (`l_m_id`, `league_year`, `home_team`, `away_team`, `proposed_time`, `match_status`) VALUES
(3, 1, 1, 2, '2023-12-15 01:41', 'Waiting'),
(5, 1, 2, 1, '2023-01-31 19:10', 'Waiting'),
(6, 1, 3, 1, '2023-12-07 ', 'Waiting'),
(7, 1, 2, 3, '2023-12-16 19:10', 'Waiting');

-- --------------------------------------------------------

--
-- Table structure for table `league_years`
--

CREATE TABLE `league_years` (
  `l_y_id` int(11) NOT NULL,
  `league_id` int(11) NOT NULL,
  `starting_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `total_teams` int(11) NOT NULL,
  `total_match_days` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `league_years`
--

INSERT INTO `league_years` (`l_y_id`, `league_id`, `starting_date`, `end_date`, `total_teams`, `total_match_days`, `status`) VALUES
(1, 1, '2023-09-26 00:00:00', '2024-05-06 00:00:00', 20, 38, 'Progressing'),
(2, 3, '2018-08-27', '2019-05-27', 20, 38, 'Awarded');

-- --------------------------------------------------------

--
-- Table structure for table `league_year_teams`
--

CREATE TABLE `league_year_teams` (
  `l_y_t_id` int(11) NOT NULL,
  `league_year` int(11) NOT NULL,
  `team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `league_year_teams`
--

INSERT INTO `league_year_teams` (`l_y_t_id`, `league_year`, `team`) VALUES
(5, 1, 3),
(6, 1, 2),
(7, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_articles`
--

CREATE TABLE `news_articles` (
  `article_id` int(11) NOT NULL,
  `article_title` text NOT NULL,
  `article_overview` text NOT NULL,
  `article_poster` text NOT NULL,
  `article_full_details` text NOT NULL,
  `article_author` int(11) NOT NULL,
  `article_genre` int(11) NOT NULL,
  `article_publish_time` text NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `news_articles`
--

INSERT INTO `news_articles` (`article_id`, `article_title`, `article_overview`, `article_poster`, `article_full_details`, `article_author`, `article_genre`, `article_publish_time`) VALUES
(4, '54\'s Cristiano Ronaldo Jersey Give Away', 'Huge story to say about', 'Screenshot (1).png', 'Huge story to say about', 6, 1, '2024-01-02 10:35:25'),
(6, 'Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano', ' Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. ', 'pexels-lukas-1420709.jpg', 'Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.\r\n\r\n Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.\r\n\r\n\r\nConfirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.\r\n\r\nConfirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.', 6, 1, '2024-01-02 20:40:17'),
(7, 'Homee boy comming back home', 'WTF? is this?', 'pexels-ahmed-adly-1270184.jpg', 'I was thinking it\'s not real.', 6, 1, '2024-01-02 21:11:24'),
(8, 'gfhtyht nbnttdnt h dhnn  hgdng hg gd gb gbd bf bf fgb vbvbfbgbr rgwbrw . htndh n ndtyh tynynf n. gbgfb', 'rgrthbng rthth t bgfbfg  gb ', 'Podcast_1 copy.jpg', ' gfbfb nd dgb g. yjyuyfnhn . yjr hyny nythdeytn yrqtbttgt g rt h. ethrtehre hrh trhwt ht ytedtyjuju.yjyje jehtrehtrwh.ywr req  rq yrtsy td.', 8, 1, '2024-01-03 07:16:23'),
(9, 'e diuji nuinvudfn v/vdfv/dfvDFVfdvdfvfdvf.fd df df. d. dc.cx . d vdfvfdvafv fd dfav d cdc.dcsd.csdcds df dfa .   dfveveavvev.', 'sdfdbfgbtrgtrtrtttrhn hrt wtrgb', 'Screenshot 2019-12-24 at 10.13.53 am copy.jpg', ' rtrtbw gtr grtgre grevgr', 8, 1, '2024-01-03 07:16:56'),
(10, 'dfvv voi oi  iocvj io vi i i  . . . g .g fdb sfdf fd df f .f df .f .f fd d .f.fd dfvd df df d df d. d df dffd df fdfd dfv.', 'fdb  v bv v v v ', 'pexels-lukas-1420709.jpg', 'bvcb cv v', 8, 1, '2024-01-03 07:17:52'),
(11, 'ggffvb b  bbb  g bbtb.yh h trbtr b', 'gfbfg gf gfx hg .jb gbtgb s  .htgbfvf ', 'pexels-ahmed-adly-1270184.jpg', 'dvdv v.uy tyn ,. trt ht', 8, 1, '2024-01-03 07:18:18'),
(13, ' rebfb regr gr g ', 'gr ggr gr g grgr ag', 'Podcast_1 copy.jpg', 'gr rrgrgergregrregeerg', 8, 2, '2024-01-03 07:26:40'),
(16, 'dscdscdscdc dsvds d  d sdc sd x ', 'dsd   ', 'Screenshot 2019-12-24 at 10.13.53 am copy.jpg', ' x xxcxcx x x xc c c cdsfrev f fgrbtybg gh bgfb g  ', 6, 1, '2024-01-03 13:54:49'),
(20, 'hgj fgfj hcn sf ree hh', 'g htt jyhryjyj yjyyjyj', 'victor-trumper.webp', ' jyjdy djdhdh trhthtdhtdhd hdgdghgn', 8, 1, '2024-01-06 10:47:07'),
(21, 'Exclusive: Fabrizio Romano on Arsenal star’s future as potential replacement transfer linked.', 'It doesn’t currently look like anything is close for Arsenal midfielder Thomas Partey to leave the club despite transfer rumours involving a potential replacement in the form of Amadou Onana being targeted.', 'as-monaco-arsenal-friendly-thomas-partey-900x600.jpg.webp', 'The Gunners have an appreciation for Onana after his fine form at Everton, according to Fabrizio Romano here, but the journalist was also keen to point out that this doesn’t necessarily mean that anything is happening with Partey.\r\n\r\nSpeaking exclusively to CaughtOffside for his Daily Briefing column, Romano explained that the Ghana international looked like he could leave in the summer before Mikel Arteta changed his mind and decided to keep him.\r\n\r\nAnd now, it seems like it might again be a saga to watch in the summer, according to Romano, with Partey also currently injured, meaning any departure looks more complicated.\r\n\r\npalace arsenal thomas partey pic\r\nThomas Partey in action for Arsenal\r\nbundesligaglobal-ott logo BUNDESLIGA GLOBAL (OTT)\r\nLOADING OFFICIAL CONTENT\r\n“We know Arsenal have issues in midfield because Thomas Partey has barely played this season due to injury. Onana is a fine talent who could offer something similar in midfield, but it’s still early to know what will happen with Onana, and also with Partey,” Romano said.\r\n\r\nMore Stories / Latest News\r\nHighly-rated striker has rejected Arsenal and Man United for German giants\r\nHighly-rated striker has rejected Arsenal and Man United for German giants\r\n48 minutes ago\r\nLiverpool legend cites reasons why Jordan Henderson wants out of Saudi\r\nLiverpool legend cites reasons why Jordan Henderson wants out of Saudi\r\n51 minutes ago\r\n“He isn’t good enough to play against top sides”, ex-Arsenal player’s brutal assessment\r\n“He isn’t good enough to play against top sides”, ex-Arsenal player’s brutal assessment\r\n58 minutes ago\r\n“If you remember in the summer, Partey was already considered as candidate for sale until end of June, but then Mikel Arteta decided to keep him; so anything can happen there in the summer. For now it’s very quiet, as he’s injured now so there are no concrete updates so far.”\r\n\r\nArsenal fans would surely welcome a signing like Onana to replace Partey, however, as the former Atletico Madrid man has had so much trouble staying fit in recent times, and just doesn’t quite seem reliable enough, even if he’s a quality player when he is available.', 8, 1, '2024-01-09 11:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `news_articles_categories`
--

CREATE TABLE `news_articles_categories` (
  `id` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `date_of_exclusiveness` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `news_articles_categories`
--

INSERT INTO `news_articles_categories` (`id`, `article`, `category`, `date_of_exclusiveness`) VALUES
(3, 4, 3, '2024-01-02 20:49:44'),
(4, 6, 3, '2024-01-02 20:57:13'),
(7, 11, 3, '2024-01-03 07:21:45'),
(8, 10, 3, '2024-01-03 07:26:46'),
(9, 7, 3, '2024-01-03 07:28:06'),
(10, 9, 3, '2024-01-03 07:29:05'),
(11, 8, 3, '2024-01-03 07:31:15'),
(12, 13, 2, '2024-01-03 07:32:21'),
(14, 16, 4, '2024-01-03 14:00:14'),
(16, 20, 4, '2024-01-06 10:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `news_articles_views`
--

CREATE TABLE `news_articles_views` (
  `id` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `time` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `news_articles_views`
--

INSERT INTO `news_articles_views` (`id`, `article`, `view_count`, `time`) VALUES
(124, 7, 1, 2147483647),
(135, 7, 1, 2147483647),
(139, 7, 1, 2147483647),
(140, 7, 1, 2147483647),
(141, 11, 1, 2147483647),
(142, 6, 1, 2147483647),
(146, 6, 1, 2147483647),
(147, 6, 1, 2147483647),
(148, 6, 1, 2147483647),
(149, 6, 1, 2147483647),
(152, 20, 1, 2147483647),
(153, 20, 1, 2147483647),
(154, 20, 1, 2147483647),
(155, 20, 1, 2147483647),
(156, 20, 1, 2147483647),
(157, 4, 1, 2147483647),
(158, 6, 1, 2147483647),
(159, 20, 1, 2147483647),
(160, 20, 1, 2147483647),
(161, 6, 1, 2147483647),
(162, 6, 1, 2147483647),
(163, 6, 1, 2147483647),
(164, 6, 1, 2147483647),
(165, 6, 1, 2147483647),
(166, 6, 1, 2147483647),
(167, 6, 1, 2147483647),
(168, 6, 1, 2147483647),
(169, 6, 1, 2147483647),
(170, 6, 1, 2147483647),
(171, 6, 1, 2147483647),
(172, 6, 1, 2147483647),
(173, 6, 1, 2147483647),
(174, 6, 1, 2147483647),
(175, 6, 1, 2147483647),
(176, 6, 1, 2147483647),
(177, 6, 1, 2147483647),
(178, 6, 1, 2147483647),
(179, 6, 1, 2147483647),
(180, 6, 1, 2147483647),
(181, 6, 1, 2147483647),
(182, 6, 1, 2147483647),
(183, 6, 1, 2147483647),
(184, 6, 1, 2147483647),
(185, 6, 1, 2147483647),
(186, 6, 1, 2147483647),
(187, 6, 1, 2147483647),
(188, 6, 1, 2147483647),
(189, 6, 1, 2147483647),
(190, 6, 1, 2147483647),
(191, 6, 1, 2147483647),
(192, 6, 1, 2147483647),
(193, 6, 1, 2147483647),
(194, 6, 1, 2147483647),
(195, 6, 1, 2147483647),
(196, 6, 1, 2147483647),
(197, 6, 1, 2147483647),
(198, 6, 1, 2147483647),
(199, 6, 1, 2147483647),
(200, 6, 1, 2147483647),
(201, 6, 1, 2147483647),
(202, 6, 1, 2147483647),
(203, 6, 1, 2147483647),
(204, 6, 1, 2147483647),
(205, 6, 1, 2147483647),
(206, 6, 1, 2147483647),
(207, 6, 1, 2147483647),
(208, 6, 1, 2147483647),
(209, 6, 1, 2147483647),
(210, 20, 1, 2147483647),
(211, 20, 1, 2147483647),
(212, 20, 1, 2147483647),
(213, 20, 1, 2147483647),
(214, 20, 1, 2147483647),
(215, 20, 1, 2147483647),
(216, 20, 1, 2147483647),
(217, 20, 1, 2147483647),
(218, 20, 1, 2147483647),
(219, 20, 1, 2147483647),
(220, 20, 1, 2147483647),
(221, 11, 1, 2147483647),
(222, 11, 1, 2147483647),
(223, 11, 1, 2147483647),
(224, 11, 1, 2147483647),
(225, 11, 1, 2147483647),
(226, 11, 1, 2147483647),
(227, 11, 1, 2147483647),
(228, 11, 1, 2147483647),
(229, 6, 1, 2147483647),
(230, 11, 1, 2147483647),
(231, 6, 1, 2147483647),
(232, 11, 1, 2147483647),
(233, 6, 1, 2147483647),
(234, 6, 1, 2147483647),
(235, 6, 1, 2147483647),
(236, 6, 1, 2147483647),
(237, 6, 1, 2147483647),
(238, 6, 1, 2147483647),
(239, 6, 1, 2147483647),
(240, 6, 1, 2147483647),
(241, 6, 1, 2147483647),
(242, 6, 1, 2147483647),
(243, 6, 1, 2147483647),
(244, 6, 1, 2147483647),
(245, 6, 1, 2147483647),
(246, 6, 1, 2147483647),
(247, 6, 1, 2147483647),
(248, 6, 1, 2147483647),
(249, 6, 1, 2147483647),
(250, 6, 1, 2147483647),
(251, 6, 1, 2147483647),
(252, 6, 1, 2147483647),
(253, 6, 1, 2147483647),
(254, 6, 1, 2147483647),
(255, 6, 1, 2147483647),
(256, 6, 1, 2147483647),
(257, 6, 1, 2147483647),
(258, 6, 1, 2147483647),
(259, 6, 1, 2147483647),
(260, 6, 1, 2147483647),
(261, 6, 1, 2147483647),
(262, 6, 1, 2147483647),
(263, 6, 1, 2147483647),
(264, 6, 1, 2147483647),
(265, 6, 1, 2147483647),
(266, 6, 1, 2147483647),
(267, 6, 1, 2147483647),
(268, 6, 1, 2147483647),
(269, 6, 1, 2147483647),
(270, 6, 1, 2147483647),
(271, 6, 1, 2147483647),
(272, 6, 1, 2147483647),
(273, 6, 1, 2147483647),
(274, 6, 1, 2147483647),
(275, 6, 1, 2147483647),
(276, 6, 1, 2147483647),
(277, 6, 1, 2147483647),
(278, 6, 1, 2147483647),
(279, 6, 1, 2147483647),
(280, 6, 1, 2147483647),
(281, 6, 1, 2147483647),
(282, 6, 1, 2147483647),
(283, 6, 1, 2147483647),
(284, 6, 1, 2147483647),
(285, 6, 1, 2147483647),
(286, 6, 1, 2147483647),
(287, 6, 1, 2147483647),
(288, 7, 1, 2147483647),
(289, 7, 1, 2147483647),
(290, 7, 1, 2147483647),
(291, 7, 1, 2147483647),
(292, 7, 1, 2147483647),
(293, 7, 1, 2147483647),
(294, 7, 1, 2147483647),
(295, 6, 1, 2147483647),
(296, 6, 1, 2147483647),
(297, 6, 1, 2147483647),
(298, 6, 1, 2147483647),
(299, 6, 1, 2147483647),
(300, 6, 1, 2147483647),
(301, 6, 1, 2147483647),
(302, 6, 1, 2147483647),
(303, 6, 1, 2147483647),
(304, 6, 1, 2147483647),
(305, 6, 1, 2147483647),
(306, 6, 1, 2147483647),
(307, 6, 1, 2147483647),
(308, 6, 1, 2147483647),
(309, 6, 1, 2147483647),
(310, 6, 1, 2147483647),
(311, 6, 1, 2147483647),
(312, 6, 1, 2147483647),
(313, 6, 1, 2147483647),
(314, 6, 1, 2147483647),
(315, 6, 1, 2147483647),
(316, 6, 1, 2147483647),
(317, 6, 1, 2147483647),
(318, 6, 1, 2147483647),
(319, 6, 1, 2147483647),
(320, 6, 1, 2147483647),
(321, 6, 1, 2147483647),
(322, 6, 1, 2147483647),
(323, 20, 1, 2147483647),
(324, 20, 1, 2147483647),
(325, 20, 1, 2147483647),
(326, 4, 1, 2147483647),
(327, 10, 1, 2147483647),
(328, 20, 1, 2147483647),
(329, 20, 1, 2147483647),
(330, 6, 1, 2147483647),
(331, 6, 1, 2147483647),
(332, 6, 1, 2147483647),
(333, 7, 1, 2147483647),
(334, 21, 1, 2147483647),
(335, 21, 1, 2147483647),
(336, 21, 1, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `abbreviation` varchar(255) NOT NULL,
  `logo` text NOT NULL,
  `country` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `arena` int(11) NOT NULL,
  `est` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `abbreviation`, `logo`, `country`, `genre`, `arena`, `est`) VALUES
(1, 'Arsenal FC', 'They Shoot', 'The Gunners', 'England - Arsenal FC.png', 2, 1, 2, '2020-01-24'),
(2, 'Chelsea', 'The City is Blue', 'The Blues', 'England - Chelsea.png', 2, 1, 1, '1905-01-01'),
(3, 'Manchester City', 'They are the Citizens', 'Citizens', 'England - Manchester City.png', 2, 1, 3, '1894-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Abreviation` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `description` text NOT NULL,
  `genre` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`id`, `name`, `Abreviation`, `level`, `description`, `genre`, `country`, `logo`) VALUES
(1, 'Rwanda Primus National League', 'RPL', 1, 'The first division in Rwanda', 1, 'Rwanda', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arenas`
--
ALTER TABLE `arenas`
  ADD PRIMARY KEY (`arena_id`),
  ADD KEY `wededeewe` (`country`);

--
-- Indexes for table `audio_havens`
--
ALTER TABLE `audio_havens`
  ADD PRIMARY KEY (`haven_id`),
  ADD KEY `dsfdsfdsdsdf` (`haven_journalist`);

--
-- Indexes for table `audio_havens_streams`
--
ALTER TABLE `audio_havens_streams`
  ADD PRIMARY KEY (`stream_id`),
  ADD KEY `dsfsdfdsfdsvd` (`haven`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fgvdvdvfdfvbfggtbtrtg` (`genre`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_today`
--
ALTER TABLE `history_today`
  ADD PRIMARY KEY (`ht_id`),
  ADD KEY `gngfngfnfggf` (`history_genre`);

--
-- Indexes for table `journalists`
--
ALTER TABLE `journalists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journalists_favorites`
--
ALTER TABLE `journalists_favorites`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `fdvgfggdfgfg` (`article`),
  ADD KEY `fdgfgfgfvfv` (`journalist`);

--
-- Indexes for table `league_competitions`
--
ALTER TABLE `league_competitions`
  ADD PRIMARY KEY (`l_c_id`),
  ADD KEY `erfrfeg` (`league_genre`),
  ADD KEY `gtgggegrg` (`league_country`);

--
-- Indexes for table `league_matches`
--
ALTER TABLE `league_matches`
  ADD PRIMARY KEY (`l_m_id`),
  ADD KEY `rgrg` (`away_team`),
  ADD KEY `regfrggrgg` (`home_team`),
  ADD KEY `ervvdrffdvdfv` (`league_year`);

--
-- Indexes for table `league_years`
--
ALTER TABLE `league_years`
  ADD PRIMARY KEY (`l_y_id`),
  ADD KEY `ewfewfefff` (`league_id`);

--
-- Indexes for table `league_year_teams`
--
ALTER TABLE `league_year_teams`
  ADD PRIMARY KEY (`l_y_t_id`),
  ADD KEY `dsgfdggregreger` (`league_year`),
  ADD KEY `rgregergergregr` (`team`);

--
-- Indexes for table `news_articles`
--
ALTER TABLE `news_articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `weuifhewufiohfeuifwhoiehoi` (`article_author`),
  ADD KEY `dfeiofefef` (`article_genre`);

--
-- Indexes for table `news_articles_categories`
--
ALTER TABLE `news_articles_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dsgfioriohcviewu` (`article`),
  ADD KEY `sdfew9ufewjwh98eh` (`category`);

--
-- Indexes for table `news_articles_views`
--
ALTER TABLE `news_articles_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dcnservoinveon` (`article`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fffgdfgfdgfgre` (`country`),
  ADD KEY `efedffewfefew` (`genre`),
  ADD KEY `dfgrgrrerger` (`arena`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wciocjwiocjewijcdwojdi` (`genre`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arenas`
--
ALTER TABLE `arenas`
  MODIFY `arena_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `audio_havens`
--
ALTER TABLE `audio_havens`
  MODIFY `haven_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `audio_havens_streams`
--
ALTER TABLE `audio_havens_streams`
  MODIFY `stream_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history_today`
--
ALTER TABLE `history_today`
  MODIFY `ht_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `journalists`
--
ALTER TABLE `journalists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `journalists_favorites`
--
ALTER TABLE `journalists_favorites`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `league_competitions`
--
ALTER TABLE `league_competitions`
  MODIFY `l_c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `league_matches`
--
ALTER TABLE `league_matches`
  MODIFY `l_m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `league_years`
--
ALTER TABLE `league_years`
  MODIFY `l_y_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `league_year_teams`
--
ALTER TABLE `league_year_teams`
  MODIFY `l_y_t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news_articles`
--
ALTER TABLE `news_articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `news_articles_categories`
--
ALTER TABLE `news_articles_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `news_articles_views`
--
ALTER TABLE `news_articles_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arenas`
--
ALTER TABLE `arenas`
  ADD CONSTRAINT `wededeewe` FOREIGN KEY (`country`) REFERENCES `countries` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `audio_havens`
--
ALTER TABLE `audio_havens`
  ADD CONSTRAINT `dsfdsfdsdsdf` FOREIGN KEY (`haven_journalist`) REFERENCES `journalists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `audio_havens_streams`
--
ALTER TABLE `audio_havens_streams`
  ADD CONSTRAINT `dsfsdfdsfdsvd` FOREIGN KEY (`haven`) REFERENCES `audio_havens` (`haven_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fgvdvdvfdfvbfggtbtrtg` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history_today`
--
ALTER TABLE `history_today`
  ADD CONSTRAINT `gngfngfnfggf` FOREIGN KEY (`history_genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journalists_favorites`
--
ALTER TABLE `journalists_favorites`
  ADD CONSTRAINT `fdgfgfgfvfv` FOREIGN KEY (`journalist`) REFERENCES `journalists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fdvgfggdfgfg` FOREIGN KEY (`article`) REFERENCES `news_articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `league_competitions`
--
ALTER TABLE `league_competitions`
  ADD CONSTRAINT `erfrfeg` FOREIGN KEY (`league_genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gtgggegrg` FOREIGN KEY (`league_country`) REFERENCES `countries` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `league_matches`
--
ALTER TABLE `league_matches`
  ADD CONSTRAINT `ervvdrffdvdfv` FOREIGN KEY (`league_year`) REFERENCES `league_years` (`l_y_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `regfrggrgg` FOREIGN KEY (`home_team`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rgrg` FOREIGN KEY (`away_team`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `league_years`
--
ALTER TABLE `league_years`
  ADD CONSTRAINT `ewfewfefff` FOREIGN KEY (`league_id`) REFERENCES `league_competitions` (`l_c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `league_year_teams`
--
ALTER TABLE `league_year_teams`
  ADD CONSTRAINT `dsgfdggregreger` FOREIGN KEY (`league_year`) REFERENCES `league_years` (`l_y_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rgregergergregr` FOREIGN KEY (`team`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_articles`
--
ALTER TABLE `news_articles`
  ADD CONSTRAINT `dfeiofefef` FOREIGN KEY (`article_genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `weuifhewufiohfeuifwhoiehoi` FOREIGN KEY (`article_author`) REFERENCES `journalists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_articles_categories`
--
ALTER TABLE `news_articles_categories`
  ADD CONSTRAINT `dsgfioriohcviewu` FOREIGN KEY (`article`) REFERENCES `news_articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sdfew9ufewjwh98eh` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_articles_views`
--
ALTER TABLE `news_articles_views`
  ADD CONSTRAINT `dcnservoinveon` FOREIGN KEY (`article`) REFERENCES `news_articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `dfgrgrrerger` FOREIGN KEY (`arena`) REFERENCES `arenas` (`arena_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `efedffewfefew` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fffgdfgfdgfgre` FOREIGN KEY (`country`) REFERENCES `countries` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD CONSTRAINT `wciocjwiocjewijcdwojdi` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
