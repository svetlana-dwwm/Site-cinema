-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Фев 09 2024 г., 11:44
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `movies`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'fantasy'),
(2, 'adventure'),
(3, 'action'),
(4, 'fantastic'),
(5, 'animation'),
(6, 'drama'),
(7, 'family'),
(8, 'comedy'),
(9, 'history'),
(10, 'thriller'),
(11, 'criminal');

-- --------------------------------------------------------

--
-- Структура таблицы `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` int DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `casting` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `direction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` float DEFAULT NULL,
  `poster` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trailer` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `soft_delete` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `movies`
--

INSERT INTO `movies` (`id`, `title`, `slug`, `date`, `time`, `description`, `casting`, `direction`, `note`, `poster`, `trailer`, `soft_delete`, `created`, `updated`) VALUES
(13, 'The Dark Knight', 'the-dark-night', NULL, NULL, '', '', '', 0, 'images/the-dark-night.jpg', 'https://www.youtube.com/embed/UXmBT9JtuLo?si=4-NaDHKTeyhyXS4i', NULL, '2024-01-17 10:47:21', '2024-01-17 10:47:21'),
(24, 'Forrest Gump', 'forrest-gump', NULL, NULL, '', '', '', 0, 'images/forrest-gump.jpg', 'https://www.youtube.com/embed/XHhAG-YLdk8?si=lGCYuhbtFsVK4rBn', NULL, '2024-01-17 11:37:28', '2024-01-17 11:37:28'),
(25, 'Fight club', 'fight-club', NULL, 139, 'An employee of an insurance company suffers from chronic insomnia and is desperately trying to escape from an excruciatingly boring life. One day, on another business trip, he meets a certain Tyler Durden, a charismatic soap merchant with a perverted philosophy. Tyler is sure that self—improvement is the lot of the weak, and the only thing worth living for is self—destruction.  A little time passes, and now new friends are hitting each other for nothing in the parking lot in front of the bar, and the cleansing fight gives them the highest bliss. By introducing other men to the simple joys of physical cruelty, they found a secret Fight Club, which began to enjoy incredible popularity.', '', '', 8.7, 'images/fight-club.jpg', 'https://www.youtube.com/embed/BdJKm16Co6M?si=N-vXPEMzMYqD0Esg', NULL, '2024-01-17 11:50:32', '2024-01-17 11:50:32'),
(51, 'Killers of the Flower Moon', 'killers-of-the-flower-moon', NULL, 206, '', '', '', 0, 'images/killers-of-the-flower-moon.jpg', 'https://www.youtube.com/embed/7cx9nCHsemc?si=ws7ACYUD803MVuCw', NULL, '2024-01-26 11:55:16', '2024-01-26 11:55:16'),
(52, 'Titanic', 'titanic', '1997-11-01', 194, 'In the first and last voyage of the gorgeous Titanic, two people meet. Jack, a passenger on the lower deck, has won a card ticket, and the rich heiress Rosa is going to America to get married by calculation. The feelings of young people only have time to blossom, and not even class differences will create trials for lovers, but an iceberg that stood in the way of a ship that was considered unsinkable.', NULL, '', 8.4, 'images/titanic.jpg', 'https://www.youtube.com/embed/kVrqfYjkTdQ?si=YpTuka2OszYeyNS2', NULL, '2024-01-26 13:13:15', '2024-01-26 13:13:15'),
(53, 'Crossroads', 'crossroads', '2002-02-11', 93, 'There are no special signs for the schoolgirl Lucy. In the everyday life of a provincial town, nothing interesting shines for her until her friends call Lucy to a music competition in Los Angeles, where, as you know, stars light up and dreams come true. However, unexpected circumstances change these rosy hopes.', NULL, '', 5.7, 'images/crossroads.jpg', 'https://www.youtube.com/embed/hVs45na_gsk?si=aIaSP9qajlD7bFLu', NULL, '2024-01-26 13:22:18', '2024-01-26 13:22:18'),
(54, 'Spiderman', 'spiderman', NULL, 121, '', '', '', 7.7, 'images/spiderman.jpg', 'https://www.youtube.com/embed/t06RUxPbp_c?si=O0I-6AMj_pjVsYHd', NULL, '2024-01-30 11:06:10', '2024-01-30 11:06:10'),
(55, 'X-Men', 'x-men', '2000-07-12', 105, 'They are the children of the atomic age, superhumans, a new link in the chain of evolution. Each of them was born as a result of a unique genetic mutation that endowed them with extraordinary abilities from childhood. Under the guidance of Professor Charles Xavier, a world-renowned telepath, gifted students have learned to control and manage their amazing abilities in the interests of humanity.  But not all mutants share the professor\'s views: the powerful mutant Magneto, who is subject to all metals, has assembled a team of like-minded people. He does not believe that humans and mutants will ever be able to coexist peacefully. They have developed a plan to take over the world, and then only Professor Xavier\'s students will be able to protect this world.…', NULL, 'Bryan Singer', 7.7, 'images/x-men.jpg', 'https://www.youtube.com/embed/pK2zYHWDZKo?si=-KGZQSIKxNQNXAup', NULL, '2024-01-30 11:10:08', '2024-01-30 11:10:08'),
(56, 'Shrek', 'shrek', '2001-04-22', 90, 'Once upon a time there was a big green giant named Shrek in a fairy-tale state. He lived in proud solitude in the forest, in a swamp, which he considered his own. But one day, the evil little Lord Farquaad, the ruler of the magic kingdom, ruthlessly drove all the fabulous inhabitants to Shrek\'s swamp.  And the carefree life of the green giant came to an end. But Lord Farquaad promised to return the swamp to Shrek if the giant would get him the beautiful princess Fiona, who languishes in an impregnable tower guarded by a fire-breathing dragon.', NULL, 'Andrew Adamson', 8.2, 'images/shrek.jpg', 'https://www.youtube.com/embed/CwXOrWvPBPk?si=v7IzH2VXqkLQT_-7', NULL, '2024-01-30 11:15:21', '2024-01-30 11:15:21'),
(57, 'The Hobbit', 'the-hobbit', '2014-12-01', 144, 'When a group of thirteen dwarves hired the hobbit Bilbo Baggins as a burglar and the fourteenth, \"lucky\" participant in the campaign to the Lonely Mountain, Bilbo believed that his adventures would end when he completed his task - to find the treasure that the leader of the dwarves Thorin needed so much. The journey to Erebor, the kingdom of the dwarves captured by the dragon Smaug, turned out to be even more dangerous than the dwarves and even Gandalf, the wise wizard, extended a helping hand to Thorin and his squad.  An army of orcs, led by an ancient evil awakened in the ruins, rushed in pursuit of the dwarves, and the elves and people with whom Bilbo and his companions had to deal during the journey and who suffered from the consequences of the dwarves\' desire to return their home, claimed a generous reward - part of the treasures of the Lonely Mountain. Soon, five armies will meet near the Lonely Mountain, and only a bloody battle will determine the results of a brave dwarf campaign.', '', '', 7.9, 'images/hobbit.jpg', 'https://www.youtube.com/embed/ZSzeFFsKEt4?si=Sk61xlm1xf148wI2', NULL, '2024-01-30 11:24:18', '2024-01-30 11:24:18'),
(62, 'Mean Girls', 'mean-girls', '2004-04-19', 97, 'Having spent her childhood in Africa with zoological parents, Kady Heron thought she knew everything about the rule of \"survival of the fittest.\" But the law of the jungle is completely revised when a homely 15-year-old girl enters a regular school for the first time and falls in love with the ex-boyfriend of the meanest girl in school.', 'Lindsay Lohan, Rachel McAdams', 'Mark Waters', 7, 'images/mean-girls.jpg', 'https://www.youtube.com/embed/oDU84nmSDZY?si=OR_EW-OXrlT-Ujlg', NULL, '2024-02-01 13:52:37', '2024-02-01 13:52:37'),
(63, 'Southpaw', 'southpaw', NULL, 124, 'Boxer Billy Hope was fine: the title of champion, a beautiful wife and a beloved daughter. But fortune turns away from him: under tragic circumstances, his beloved wife dies, disqualification in the ring, zero income, the court deprives him of parental rights... Hope must defend the title of champion and bring his daughter back. Does Hope have a chance of winning? His famous left hook will solve everything.…', '', '', 7.5, 'images/southpaw.jpg', 'https://www.youtube.com/embed/Mh2ebPxhoLs?si=dVdVd-VTALMGjxxI', NULL, '2024-02-01 14:06:46', '2024-02-01 14:06:46'),
(64, 'True detective', 'true-detective', '2014-01-12', 60, 'The first season. In Louisiana, in 1995, there is a strange murder of a girl. In 2012, the 1995 murder case was reopened, as a similar murder occurred. To advance the investigation, the police decide to question the former detectives who worked on that case.  The second season. In the Californian city of Vinci, on the eve of the presentation of a new railway line that will improve the financial situation of the city, the head of the city administration disappears. Later, his body is found on the highway. A detective from the Vinci Police and a detective from the Ventura County Sheriff\'s Department are involved in the investigation.  The third season. The limestone plateau of the Ozarks, located simultaneously in several states. Detective Wayne Hayes, together with Arkansas investigator Roland West, are trying to figure out a mysterious crime that has stretched over three decades.  The fourth season. Polar night in Alaska. Two female police officers are investigating the mysterious disappearance of six employees of a research station.', '', '', 8.6, 'images/true-detective.jpg', 'https://www.youtube.com/embed/fVQUcaO4AvE?si=eWE4D2tJdxPe344z', NULL, '2024-02-09 09:20:15', '2024-02-09 09:20:15');

-- --------------------------------------------------------

--
-- Структура таблицы `movies_categories`
--

CREATE TABLE `movies_categories` (
  `movie_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `movies_categories`
--

INSERT INTO `movies_categories` (`movie_id`, `category_id`) VALUES
(13, 1),
(57, 1),
(13, 2),
(54, 2),
(55, 2),
(57, 2),
(13, 3),
(54, 3),
(55, 3),
(57, 3),
(54, 4),
(55, 4),
(56, 5),
(24, 6),
(25, 6),
(51, 6),
(52, 6),
(53, 6),
(63, 6),
(56, 7),
(24, 8),
(53, 8),
(56, 8),
(62, 8),
(24, 9),
(51, 9),
(52, 9),
(25, 10),
(52, 10),
(64, 10),
(25, 11),
(51, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `pwd`, `role_id`, `lastLogin`, `created`, `updated`) VALUES
('1d829978-baa6-11ee-ab58-00ffe16bb191', 'a@a.fr', '$2y$10$Mx1nQhxhOZ.oyKEI5V5GweG6VLTnYKzamyZHlc3RMfbOfBj95FrTW', 1, '2024-02-09 11:21:11', '2024-01-24 11:48:31', '2024-01-24 11:48:31'),
('b129b6fd-b939-11ee-be19-00ffe16bb191', 'jyy@uuh.fr', '$2y$10$em4C09yjP0Dur//sBBKda.GMtRMrsbRNtivlxAB3wjCaFtYMl0VQm', 1, NULL, '2024-01-22 16:19:53', '2024-01-22 16:19:53'),
('e1f4a8fa-b927-11ee-be19-00ffe16bb191', 'ks@k.fr', '$2y$10$RlKdTPnnuqmf8sBWuxzPN.7qiw6D3yF7pXona1dXFpA4t6rQPja2.', 1, NULL, '2024-01-22 14:12:24', '2024-01-22 14:12:24');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `movies_categories`
--
ALTER TABLE `movies_categories`
  ADD PRIMARY KEY (`movie_id`,`category_id`),
  ADD KEY `category` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `movies_categories`
--
ALTER TABLE `movies_categories`
  ADD CONSTRAINT `movies_categories_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `movies_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
