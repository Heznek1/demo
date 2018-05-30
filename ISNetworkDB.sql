CREATE DATABASE ISNetworkDB; use ISNetworkDB;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--  `ISNetworkDB`
--

-- --------------------------------------------------------

--
--  `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT '0',
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- `alert_types`
--

CREATE TABLE `alert_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
--  `alert_types`
--

INSERT INTO `alert_types` (`id`, `name`) VALUES
(1, 'message'),
(2, 'follow');

-- --------------------------------------------------------

--
--  `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `university` text,
  `role` text,
  `location` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
--  `jobs`
--

INSERT INTO `jobs` (`id`, `university`, `role`, `location`, `description`, `date`) VALUES
(1, 'Texas University', 'Programmer', 'USA', 'Try this, you can manipulate the z-index on runtime or initializing', '2018-02-05 13:11:33'),
(2, 'University of MA', 'SEO & CEO', 'USA, India', 'Description of one text one two three', '2018-02-05 13:12:08');

-- --------------------------------------------------------

--
--  `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
--  `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `research_id` int(11) NOT NULL,
  `reads` int(11) NOT NULL DEFAULT '0',
  `is_hidden` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
--  `project_recomendations`
--

CREATE TABLE `project_recomendations` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
--  `researches`
--

CREATE TABLE `researches` (
  `id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
--  `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `about` text,
  `position` text,
  `image` varchar(255) DEFAULT NULL,
  `location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
--  `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `is_admin`, `password`, `about`, `position`, `image`, `location`) VALUES
(1, 'Admin', 'Dean', 'Lichtenshtein', 1, 'Admin', 'Founder & Administrator of iScience+\nIs interested in 3 researches and has 3 skill sets.', 'SEO', 'user2.jpg', 'USA, New York'),
(20, 'barazani@gmail.com', 'Or', 'Barazani', 1, '123', NULL, NULL, NULL, NULL),
(21, 'lank@test.com', 'or', 'Levi', 1, '123', NULL, NULL, NULL, NULL);
-- --------------------------------------------------------

--
-- `users_followers`
--

CREATE TABLE `users_followers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
--  `users_followers`
--

INSERT INTO `users_followers` (`id`, `user_id`, `follow_id`) VALUES
(1, 1, 5),
(2, 1, 14);

-- --------------------------------------------------------

--
--  `user_researches`
--

CREATE TABLE `user_researches` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `research` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- `user_researches`
--

INSERT INTO `user_researches` (`id`, `u_id`, `research`) VALUES
(2, 1, 'interest1');

-- --------------------------------------------------------

--
--  `user_skills`
--

CREATE TABLE `user_skills` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `skill` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
--  `user_skills`
--

INSERT INTO `user_skills` (`id`, `u_id`, `skill`) VALUES
(2, 1, 'skill1');

--
--
--

--
--  `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
--  `alert_types`
--
ALTER TABLE `alert_types`
  ADD PRIMARY KEY (`id`);

--
--  `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
--  `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_id` (`from_id`),
  ADD KEY `to_id` (`to_id`);

--
--  `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `research_id` (`research_id`);

--
--  `project_recomendations`
--
ALTER TABLE `project_recomendations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
--  `researches`
--
ALTER TABLE `researches`
  ADD PRIMARY KEY (`id`);

--
-- `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
--  `users_followers`
--
ALTER TABLE `users_followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `follow_id` (`follow_id`);

--
--  `user_researches`
--
ALTER TABLE `user_researches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`);

--
--  `user_skills`
--
ALTER TABLE `user_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`);

--
-- AUTO_INCREMENT
--

--
-- AUTO_INCREMENT  `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT  `alert_types`
--
ALTER TABLE `alert_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT  `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT  `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT  `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT  `project_recomendations`
--
ALTER TABLE `project_recomendations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT  `researches`
--
ALTER TABLE `researches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT  `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT  `users_followers`
--
ALTER TABLE `users_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT  `user_researches`
--
ALTER TABLE `user_researches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT  `user_skills`
--
ALTER TABLE `user_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
--
--

--
-- `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `alert_types` (`id`),
  ADD CONSTRAINT `alerts_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`);

--
--  `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
--  `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
--  `project_recomendations`
--
ALTER TABLE `project_recomendations`
  ADD CONSTRAINT `project_recomendations_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `project_recomendations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
--  `users_followers`
--
ALTER TABLE `users_followers`
  ADD CONSTRAINT `users_followers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_followers_ibfk_2` FOREIGN KEY (`follow_id`) REFERENCES `users` (`id`);

--
--  `user_researches`
--
ALTER TABLE `user_researches`
  ADD CONSTRAINT `user_researches_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`);

--
--  `user_skills`
--
ALTER TABLE `user_skills`
  ADD CONSTRAINT `user_skills_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
