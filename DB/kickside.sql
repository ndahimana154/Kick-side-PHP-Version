-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 03:42 AM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text NOT NULL,
  `genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`, `genre`) VALUES
(1, 'Exclusive', 'News articles that are exclusive', 1),
(2, 'NBA', 'News for NBA', 2),
(3, 'Breaking News', '', 1);

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
  `genre_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genre_name`, `genre_description`) VALUES
(1, 'Football', 'This is football '),
(2, 'Basketball', 'Basketball play');

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
(7, 'ghbgf', 'gfbgf', 'ghbgf.gfbgf', 'fbfb', 'fbfbd', '81dc9bdb52d04dc20036dbd8313ed055', 'ghbgf gfbgf', 'Working');

-- --------------------------------------------------------

--
-- Table structure for table `journalists_favorites`
--

CREATE TABLE `journalists_favorites` (
  `fav_id` int(11) NOT NULL,
  `journalist` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `date_of_fav` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(5, 'Taylor\'s Version 1989 is Making things on the FootBall Pitches.', 'Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches.', 'pexels-lil-artsy-1213447.jpg', 'Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches.\r\n\r\n\r\nTaylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches.Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches.Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches.\r\n\r\nTaylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches.\r\n\r\n\r\nTaylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches. Taylor\'s Version 1989 is Making things on the FootBall Pitches.Taylor\'s Version 1989 is Making things on the FootBall Pitches.Taylor\'s Version 1989 is Making things on the FootBall Pitches.Taylor\'s Version 1989 is Making things on the FootBall Pitches.Taylor\'s Version 1989 is Making things on the FootBall Pitches.Taylor\'s Version 1989 is Making things on the FootBall Pitches.', 6, 1, '2024-01-02 20:38:01'),
(6, 'Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano', ' Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. ', 'pexels-lukas-1420709.jpg', 'Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.\r\n\r\n Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.\r\n\r\n\r\nConfirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.\r\n\r\nConfirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano. Confirmed Thomas Partey will not be with Ghana Team due to Injury. Via. Fabrizio Romano.', 6, 1, '2024-01-02 20:40:17'),
(7, 'Homee boy comming back home', 'WTF? is this?', 'pexels-ahmed-adly-1270184.jpg', 'I was thinking it\'s not real.', 6, 1, '2024-01-02 21:11:24');

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
(6, 5, 3, '2024-01-02 20:58:06');

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
(125, 5, 1, 2147483647),
(126, 5, 1, 2147483647),
(127, 5, 1, 2147483647),
(128, 5, 1, 2147483647),
(129, 5, 1, 2147483647),
(130, 5, 1, 2147483647),
(131, 5, 1, 2147483647),
(132, 5, 1, 2147483647),
(133, 5, 1, 2147483647),
(134, 5, 1, 2147483647),
(135, 7, 1, 2147483647),
(136, 5, 1, 2147483647),
(137, 5, 1, 2147483647),
(138, 5, 1, 2147483647),
(139, 7, 1, 2147483647),
(140, 7, 1, 2147483647);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `journalists`
--
ALTER TABLE `journalists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `journalists_favorites`
--
ALTER TABLE `journalists_favorites`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news_articles_categories`
--
ALTER TABLE `news_articles_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news_articles_views`
--
ALTER TABLE `news_articles_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

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
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fgvdvdvfdfvbfggtbtrtg` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
