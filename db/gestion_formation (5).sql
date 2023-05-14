-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 mai 2023 à 01:52
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_formation`
--

-- --------------------------------------------------------

--
-- Structure de la table `apprenant`
--

CREATE TABLE `apprenant` (
  `id_apprenant` int(50) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'images (9).jpeg',
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `apprenant`
--

INSERT INTO `apprenant` (`id_apprenant`, `firstname`, `lastname`, `email`, `password`, `img`, `role`) VALUES
(2, 'Jane', 'Doe', 'jane.doe@example.com', 'password2', '', 'user'),
(3, 'Bob', 'Smith', 'bob.smith@example.com', 'password3', '', 'user'),
(4, 'Alice', 'Jones', 'alice.jones@example.com', 'password4', '', 'user'),
(5, 'David', 'Lee', 'david.lee@example.com', 'password5', '', 'user'),
(6, 'Emily', 'Davis', 'emily.davis@example.com', 'password6', '', 'user'),
(7, 'Michael', 'Wilson', 'michael.wilson@example.com', 'password7', '', 'user'),
(8, 'Sarah', 'Taylor', 'sarah.taylor@example.com', 'password8', '', 'user'),
(9, 'James', 'Brown', 'james.brown@example.com', 'password9', '', 'user'),
(10, 'Jessica', 'Garcia', 'jessica.garcia@example.com', 'password10', '', 'user'),
(11, 'William', 'Jackson', 'william.jackson@example.com', 'password11', '', 'user'),
(12, 'Linda', 'Martinez', 'linda.martinez@example.com', 'password12', '', 'user'),
(13, 'Charles', 'Anderson', 'charles.anderson@example.com', 'password13', '', 'user'),
(14, 'Karen', 'Thomas', 'karen.thomas@example.com', 'password14', '', 'user'),
(15, 'Christopher', 'Hernandez', 'christopher.hernandez@example.com', 'password15', '', 'user'),
(16, 'Ashley', 'Moore', 'ashley.moore@example.com', 'password16', '', 'user'),
(17, 'Matthew', 'Martin', 'matthew.martin@example.com', 'password17', '', 'user'),
(18, 'Amanda', 'Jackson', 'amanda.jackson@example.com', 'password18', '', 'user'),
(19, 'Kevin', 'Lee', 'kevin.lee@example.com', 'password19', '', 'user'),
(20, 'Maria', 'Gonzalez', 'maria.gonzalez@example.com', 'password20', '', 'user'),
(21, 'YSN', 'moundelssi', 'moundelssi.yassine.solicode@gmail.com', '74feb4e23a9061886ecb6b03168e173c', 'images (9).jpeg', 'admin'),
(22, 'Catherine', 'Nguyen', 'catherine.nguyen@example.com', 'password22', '', 'user'),
(23, 'Daniel', 'Smith', 'daniel.smith@example.com', 'password23', '', 'user'),
(24, 'Elizabeth', 'Brown', 'elizabeth.brown@example.com', 'password24', '', 'user'),
(25, 'Frank', 'Garcia', 'frank.garcia@example.com', 'password25', '', 'user'),
(26, 'Gabriela', 'Martinez', 'gabriela.martinez@example.com', 'password26', '', 'user'),
(27, 'Henry', 'Johnson', 'henry.johnson@example.com', 'password27', '', 'user'),
(28, 'Isabella', 'Davis', 'isabella.davis@example.com', 'password28', '', 'user'),
(29, 'Jonathan', 'Gonzalez', 'jonathan.gonzalez@example.com', 'password29', '', 'user'),
(30, 'Karen', 'Johnson', 'karen.johnson@example.com', 'password30', '', 'user'),
(31, 'Olivia', 'Garcia', 'olivia.garcia@example.com', 'password31', '', 'user'),
(32, 'Patrick', 'Nguyen', 'patrick.nguyen@example.com', 'password32', '', 'user'),
(33, 'Rachel', 'Lee', 'rachel.lee@example.com', 'password33', '', 'user'),
(34, 'Samuel', 'Wilson', 'samuel.wilson@example.com', 'password34', '', 'user'),
(35, 'Tiffany', 'Johnson', 'tiffany.johnson@example.com', 'password35', '', 'user'),
(36, 'Ulysses', 'Davis', 'ulysses.davis@example.com', 'password36', '', 'user'),
(37, 'Victoria', 'Smith', 'victoria.smith@example.com', 'password37', '', 'user'),
(38, 'Wendy', 'Martinez', 'wendy.martinez@example.com', 'password38', '', 'user'),
(39, 'Xavier', 'Jackson', 'xavier.jackson@example.com', 'password39', '', 'user'),
(40, 'Yvonne', 'Brown', 'yvonne.brown@example.com', 'password40', '', 'user'),
(41, 'Zachary', 'Thomas', 'zachary.thomas@example.com', 'password41', '', 'user'),
(42, 'Avery', 'Hernandez', 'avery.hernandez@example.com', 'password42', '', 'user'),
(43, 'Benjamin', 'Jones', 'benjamin.jones@example.com', 'password43', '', 'user'),
(44, 'Caroline', 'Moore', 'caroline.moore@example.com', 'password44', '', 'user'),
(45, 'David', 'Taylor', 'david.taylor@example.com', 'password45', '', 'user'),
(46, 'Emma', 'Wilson', 'emma.wilson@example.com', 'password46', '', 'user'),
(47, 'Felix', 'Lee', 'felix.lee@example.com', 'password47', '', 'user'),
(48, 'Grace', 'Gonzalez', 'grace.gonzalez@example.com', 'password48', '', 'user'),
(49, 'Henry', 'Martin', 'henry.martin@example.com', 'password49', '', 'user'),
(50, 'Isabelle', 'Anderson', 'isabelle.anderson@example.com', 'password50', '', 'user'),
(51, 'Jackson', 'Davis', 'jackson.davis@example.com', 'password51', '', 'user'),
(52, 'Kimberly', 'Johnson', 'kimberly.johnson@example.com', 'password52', '', 'user'),
(53, 'Liam', 'Martinez', 'liam.martinez@example.com', 'password53', '', 'user'),
(54, 'Mia', 'Garcia', 'mia.garcia@example.com', 'password54', '', 'user'),
(55, 'Nathan', 'Nguyen', 'nathan.nguyen@example.com', 'password55', '', 'user'),
(56, 'Oliver', 'Lee', 'oliver.lee@example.com', 'password56', '', 'user'),
(57, 'Penelope', 'Wilson', 'penelope.wilson@example.com', 'password57', '', 'user'),
(58, 'Quinn', 'Anderson', 'quinn.anderson@example.com', 'password58', '', 'user'),
(59, 'Riley', 'Smith', 'riley.smith@example.com', 'password59', '', 'user'),
(60, 'Sophia', 'Brown', 'sophia.brown@example.com', 'password60', '', 'user'),
(61, 'Thomas', 'Jackson', 'thomas.jackson@example.com', 'password61', '', 'user'),
(62, 'Uma', 'Thomas', 'uma.thomas@example.com', 'password62', '', 'user'),
(63, 'Victoria', 'Gonzalez', 'victoria.gonzalez@example.com', 'password63', '', 'user'),
(64, 'William', 'Hernandez', 'william.hernandez@example.com', 'password64', '', 'user'),
(65, 'Xander', 'Wilson', 'xander.wilson@example.com', 'password65', '', 'user'),
(66, 'Yara', 'Moore', 'yara.moore@example.com', 'password66', '', 'user'),
(67, 'Zoe', 'Taylor', 'zoe.taylor@example.com', 'password67', '', 'user'),
(68, 'Adam', 'Brown', 'adam.brown@example.com', 'password68', '', 'user'),
(69, 'Brianna', 'Jones', 'brianna.jones@example.com', 'password69', '', 'user'),
(70, 'Caleb', 'Smith', 'caleb.smith@example.com', 'password70', '', 'user'),
(81, 'Ethan', 'Wilson', 'ethan.wilson@example.com', 'password81', '', 'user'),
(82, 'Fiona', 'Jones', 'fiona.jones@example.com', 'password82', '', 'user'),
(83, 'Gavin', 'Nguyen', 'gavin.nguyen@example.com', 'password83', '', 'user'),
(84, 'Hannah', 'Lee', 'hannah.lee@example.com', 'password84', '', 'user'),
(85, 'Isaac', 'Martinez', 'isaac.martinez@example.com', 'password85', '', 'user'),
(86, 'Julia', 'Davis', 'julia.davis@example.com', 'password86', '', 'user'),
(87, 'Kevin', 'Anderson', 'kevin.anderson@example.com', 'password87', '', 'user'),
(88, 'Lila', 'Moore', 'lila.moore@example.com', 'password88', '', 'user'),
(89, 'Mason', 'Taylor', 'mason.taylor@example.com', 'password89', '', 'user'),
(90, 'Nora', 'Garcia', 'nora.garcia@example.com', 'password90', '', 'user'),
(91, 'Oscar', 'Brown', 'oscar.brown@example.com', 'password91', '', 'user'),
(92, 'Peyton', 'Jackson', 'peyton.jackson@example.com', 'password92', '', 'user'),
(93, 'Quentin', 'Wilson', 'quentin.wilson@example.com', 'password93', '', 'user'),
(94, 'Rose', 'Anderson', 'rose.anderson@example.com', 'password94', '', 'user'),
(95, 'Sebastian', 'Hernandez', 'sebastian.hernandez@example.com', 'password95', '', 'user'),
(96, 'Tessa', 'Smith', 'tessa.smith@example.com', 'password96', '', 'user'),
(97, 'Uriel', 'Gonzalez', 'uriel.gonzalez@example.com', 'password97', '', 'user'),
(98, 'Violet', 'Johnson', 'violet.johnson@example.com', 'password98', '', 'user'),
(99, 'Wyatt', 'Brown', 'wyatt.brown@example.com', 'password99', '', 'user'),
(100, 'Ximena', 'Thomas', 'ximena.thomas@example.com', 'password100', '', 'user'),
(200, 'Avery', 'Johnson', 'avery.johnson@example.com', 'password200', '', 'user'),
(201, 'Benjamin', 'Garcia', 'benjamin.garcia@example.com', 'password201', '', 'user'),
(202, 'Caitlyn', 'Nguyen', 'caitlyn.nguyen@example.com', 'password202', '', 'user'),
(203, 'Daniel', 'Wilson', 'daniel.wilson@example.com', 'password203', '', 'user'),
(204, 'Ella', 'Anderson', 'ella.anderson@example.com', 'password204', '', 'user'),
(205, 'Finn', 'Martinez', 'finn.martinez@example.com', 'password205', '', 'user'),
(206, 'Greta', 'Lee', 'greta.lee@example.com', 'password206', '', 'user'),
(207, 'Henry', 'Davis', 'henry.davis@example.com', 'password207', '', 'user'),
(208, 'Isabella', 'Taylor', 'isabella.taylor@example.com', 'password208', '', 'user'),
(209, 'Jackson', 'Brown', 'jackson.brown@example.com', 'password209', '', 'user'),
(210, 'imane', 'bouziane', 'imane@gmail.com', 'f8bb9fade657afff5801630815283e0a', '', 'user'),
(211, 'benomar', 'mohammed yassin', 'moyassin.benomar@gmail.com', '3f7792d88529a4b243d93899032b9abc', '', 'user'),
(212, 'yassine', 'moundelssi', 'mod@gmail.com', '7907d9193f292dc5e1256659ec9c9ca2', 'images (9).jpeg', 'user'),
(213, 'yassine', 'moundelssi', 'md@gmail.com', '7d0865adf1f08c54a3030565974825e4', '', 'user'),
(214, 'mouad', 'jebbari', 'mdelssie@gmail.com', '4c54ad0c9cc6b8496318450f40bf5766', '', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `award_name` varchar(255) DEFAULT NULL,
  `award_description` text DEFAULT NULL,
  `awarded_by` varchar(255) DEFAULT NULL,
  `awarded_to` varchar(255) DEFAULT NULL,
  `award_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `awards`
--

INSERT INTO `awards` (`id`, `award_name`, `award_description`, `awarded_by`, `awarded_to`, `award_date`) VALUES
(1, 'Best Employee of the Year', 'Awarded to the employee who demonstrated exceptional performance throughout the year', 'ABC Corporation', 'John Doe', '2022-01-01'),
(2, 'Best Employee of the Year', 'Awarded to the employee who demonstrated exceptional performance throughout the year', 'ABC Corporation', 'John Doe', '2022-01-01'),
(3, 'Outstanding Contribution to the Community', 'Awarded to the individual who made significant contributions to the local community', 'XYZ Foundation', 'Jane Smith', '2022-02-15'),
(4, 'Innovation Award', 'Awarded to the team that developed the most innovative product of the year', 'ACME Inc.', 'Product Development Team', '2022-03-31'),
(8, 'fdgfdgdfg', 'dfgdfgdfgdf', 'fdgfdgfdg', 'fdgfdgdf', NULL),
(30, 'Award 30', 'Description for Award 30', 'Awarder 30', 'Recipient 30', '2023-04-20'),
(31, 'Award 31', 'Description for Award 31', 'Awarder 31', 'Recipient 31', '2023-04-21'),
(32, 'Award 32', 'Description for Award 32', 'Awarder 32', 'Recipient 32', '2023-04-22'),
(33, 'Award 33', 'Description for Award 33', 'Awarder 33', 'Recipient 33', '2023-04-23'),
(34, 'Award 34', 'Description for Award 34', 'Awarder 34', 'Recipient 34', '2023-04-24'),
(35, 'Award 35', 'Description for Award 35', 'Awarder 35', 'Recipient 35', '2023-04-25'),
(36, 'Award 36', 'Description for Award 36', 'Awarder 36', 'Recipient 36', '2023-04-26'),
(37, 'Award 37', 'Description for Award 37', 'Awarder 37', 'Recipient 37', '2023-04-27'),
(38, 'Award 38', 'Description for Award 38', 'Awarder 38', 'Recipient 38', '2023-04-28'),
(39, 'Award 39', 'Description for Award 39', 'Awarder 39', 'Recipient 39', '2023-04-29'),
(40, 'Award 40', 'Description for Award 40', 'Awarder 40', 'Recipient 40', '2023-04-30'),
(41, 'Award 41', 'Description for Award 41', 'Awarder 41', 'Recipient 41', '2023-05-01'),
(42, 'Award 42', 'Description for Award 42', 'Awarder 42', 'Recipient 42', '2023-05-02'),
(43, 'Award 43', 'Description for Award 43', 'Awarder 43', 'Recipient 43', '2023-05-03'),
(44, 'Award 44', 'Description for Award 44', 'Awarder 44', 'Recipient 44', '2023-05-04'),
(45, 'Award 45', 'Description for Award 45', 'Awarder 45', 'Recipient 45', '2023-05-05'),
(46, 'Award 46', 'Description for Award 46', 'Awarder 46', 'Recipient 46', '2023-05-06'),
(47, 'Award 47', 'Description for Award 47', 'Awarder 47', 'Recipient 47', '2023-05-07'),
(48, 'Award 48', 'Description for Award 48', 'Awarder 48', 'Recipient 48', '2023-05-08'),
(49, 'Award 49', 'Description for Award 49', 'Awarder 49', 'Recipient 49', '2023-05-09'),
(50, 'Award 50', 'Description for Award 50', 'Awarder 50', 'Recipient 50', '2023-05-10'),
(51, 'Award 51', 'Description for Award 51', 'Awarder 51', 'Recipient 51', '2023-05-11'),
(52, 'Award 52', 'Description for Award 52', 'Awarder 52', 'Recipient 52', '2023-05-12'),
(53, 'Award 53', 'Description for Award 53', 'Awarder 53', 'Recipient 53', '2023-05-13'),
(54, 'Award 54', 'Description for Award 54', 'Awarder 54', 'Recipient 54', '2023-05-14'),
(55, 'Award 55', 'Description for Award 55', 'Awarder 55', 'Recipient 55', '2023-05-15'),
(56, 'Award 56', 'Description for Award 56', 'Awarder 56', 'Recipient 56', '2023-05-16'),
(57, 'Award 57', 'Description for Award 57', 'Awarder 57', 'Recipient 57', '2023-05-17'),
(58, 'Award 58', 'Description for Award 58', 'Awarder 58', 'Recipient 58', '2023-05-18'),
(59, 'Award 59', 'Description for Award 59', 'Awarder 59', 'Recipient 59', '2023-05-19'),
(60, 'Award 60', 'Description for Award 60', 'Awarder 60', 'Recipient 60', '2023-05-20'),
(61, 'Award 61', 'Description for Award 61', 'Awarder 61', 'Recipient 61', '2023-05-21'),
(62, 'Award 62', 'Description for Award 62', 'Awarder 62', 'Recipient 62', '2023-05-22'),
(63, 'Award 63', 'Description for Award 63', 'Awarder 63', 'Recipient 63', '2023-05-23'),
(64, 'Award 64', 'Description for Award 64', 'Awarder 64', 'Recipient 64', '2023-05-24'),
(65, 'Award 65', 'Description for Award 65', 'Awarder 65', 'Recipient 65', '2023-05-25'),
(66, 'Award 66', 'Description for Award 66', 'Awarder 66', 'Recipient 66', '2023-05-26');

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

CREATE TABLE `formateur` (
  `id_formateur` int(50) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'formateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`id_formateur`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
(1, 'mr', 'bilal', 'bilal1234@formateur.com', '1234', 'formateur'),
(2, 'med', 'allali', 'med123solicode@formateur.com', '098765', 'formateur'),
(6, 'Karen', 'Davis', 'karenavis@example.com', 'password6', 'formateur'),
(7, 'David', 'Garcia', 'davidgarcia@example.com', 'password7', 'formateur'),
(8, 'Laura', 'Martinez', 'lauramartinez@example.com', 'password8', 'formateur'),
(9, 'Kevin', 'Lopez', 'kevinlopez@example.com', 'password9', 'formateur'),
(10, 'Emily', 'Lee', 'emilylee@example.com', 'password10', 'formateur'),
(11, 'Michael', 'Rodriguez', 'michaelrodriguez@example.com', 'password11', 'formateur'),
(12, 'Jessica', 'Davis', 'jessicadavis@example.com', 'password12', 'formateur'),
(13, 'James', 'Brown', 'jamesbrown@example.com', 'password13', 'formateur'),
(14, 'Maria', 'Garcia', 'mariagarcia@example.com', 'password14', 'formateur'),
(15, 'Daniel', 'Wilson', 'danielwilson@example.com', 'password15', 'formateur'),
(16, 'Ashley', 'Anderson', 'ashleyanderson@example.com', 'password16', 'formateur'),
(17, 'Christopher', 'Thomas', 'christopherthomas@example.com', 'password17', 'formateur'),
(18, 'Stephanie', 'Moore', 'stephaniemoore@example.com', 'password18', 'formateur'),
(19, 'Joseph', 'Jackson', 'josephjackson@example.com', 'password19', 'formateur'),
(20, 'Amanda', 'Martin', 'amandamartin@example.com', 'password20', 'formateur'),
(21, 'William', 'Lee', 'williamlee@example.com', 'password21', 'formateur'),
(22, 'Melissa', 'Taylor', 'melissataylor@example.com', 'password22', 'formateur'),
(23, 'Ryan', 'Thompson', 'ryanthompson@example.com', 'password23', 'formateur'),
(24, 'Elizabeth', 'White', 'elizabethwhite@example.com', 'password24', 'formateur'),
(25, 'Nicholas', 'Harris', 'nicholasharris@example.com', 'password25', 'formateur'),
(26, 'Megan', 'Clark', 'meganclark@example.com', 'password26', 'formateur'),
(27, 'Brandon', 'Lewis', 'brandonlewis@example.com', 'password27', 'formateur'),
(28, 'Lauren', 'Robinson', 'laurenrobinson@example.com', 'password28', 'formateur'),
(29, 'Jacob', 'Walker', 'jacobwalker@example.com', 'password29', 'formateur'),
(30, 'Taylor', 'Young', 'tayloryoung@example.com', 'password30', 'formateur'),
(222, 'mon', 'yassine', 'formateur@gmail.com', '74feb4e23a9061886ecb6b03168e173c', 'formateur'),
(223, 'mon', 'yassine', 'formateur@gmail.com', '74feb4e23a9061886ecb6b03168e173c', 'formateur');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id_formation` int(50) NOT NULL,
  `sujet` varchar(50) DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `masse_horaire` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id_formation`, `sujet`, `categorie`, `masse_horaire`, `description`, `image`) VALUES
(1, 'Word', 'Informatique', '20', 'Some quick example text to build on the card title and make up the bulk of the cards content', 'https://www.classcentral.com/report/wp-content/uploads/2022/06/Microsoft-Word-BCG-Banner-2.png'),
(2, 'chess', 'gaming', '13', 'Some quick example text to build on the card title and make up the bulk of the cards content', 'https://www.openstudycollege.com/osc/uploads/2019/11/ABC947.jpg'),
(4, 'power point', 'Developement', '9', 'Some quick example text to build on the card title and make up the bulk of the cards content', 'https://www.classcentral.com/report/wp-content/uploads/2022/07/Microsoft-PowerPoint-BCG-Banner.png'),
(5, 'Excel', 'Informatique', '11', 'Some quick example text to build on the card title and make up the bulk of the cards content', 'https://i.ytimg.com/vi/Vl0H-qTclOg/maxresdefault.jpg'),
(6, 'SQL', 'Developement', '19', 'Some quick example text to build on the card title and make up the bulk of the cards content', 'https://appmaster.io/api/_files/yKhnAuhLKWr9i83vVB3um7/download/'),
(7, 'PHP', 'Developement', '9', 'Some quick example text to build on the card title and make up the bulk of the cards content', 'https://www.freecodecamp.org/news/content/images/size/w2000/2020/10/phpframework.png'),
(8, 'Python', 'Programming', '15', 'This course teaches students how to use Python, a popular programming language for data analysis, machine learning, and web development.', 'https://www.python.org/static/community_logos/python-logo-master-v3-TM.png'),
(10, 'JavaScript', 'Programming', '20', 'This course teaches students how to use JavaScript, a popular programming language for web development, to create dynamic and interactive websites and web applications.', 'https://cdn.hackr.io/uploads/posts/large/1654234535LI9mLOk6yE.png');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id_apprenant` int(50) NOT NULL,
  `id_session` int(50) NOT NULL,
  `resultat` varchar(50) NOT NULL DEFAULT 'null',
  `date_validation` varchar(50) DEFAULT NULL,
  `date_inscription` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id_apprenant`, `id_session`, `resultat`, `date_validation`, `date_inscription`) VALUES
(5, 1, 'valid', NULL, NULL),
(6, 1, 'invalid', NULL, NULL),
(7, 1, 'null', NULL, NULL),
(8, 1, 'null', NULL, NULL),
(9, 1, 'null', NULL, NULL),
(11, 1, 'null', NULL, NULL),
(12, 1, 'null', NULL, NULL),
(13, 1, 'null', NULL, NULL),
(21, 2, 'null', NULL, '2023-05-15 00:40:44'),
(21, 10, 'null', NULL, '2023-05-14 16:50:20'),
(214, 1, 'null', NULL, '2023-05-13 07:04:13');

--
-- Déclencheurs `inscription`
--
DELIMITER $$
CREATE TRIGGER `prévenir_surcapacité` AFTER INSERT ON `inscription` FOR EACH ROW BEGIN
DECLARE max_capacity INT;
DECLARE num_registered INT;

SELECT nombre_places_max INTO max_capacity FROM session WHERE id_session = NEW.id_session;
SELECT COUNT(*) INTO num_registered FROM inscription WHERE id_session = NEW.id_session;

IF num_registered = max_capacity THEN
UPDATE session SET etat = 'Inscription achevée' WHERE id_session = NEW.id_session;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id_session` int(50) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `nombre_places_max` int(5) DEFAULT NULL,
  `etat` varchar(50) DEFAULT NULL,
  `id_formation` int(50) NOT NULL,
  `id_formateur` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id_session`, `date_debut`, `date_fin`, `nombre_places_max`, `etat`, `id_formation`, `id_formateur`) VALUES
(1, '2023-05-09', '2023-09-30', 10, 'clôturée', 4, 222),
(2, '2023-05-30', '2023-07-30', 10, 'in process of registration', 2, 1),
(3, '2024-05-13', '2024-06-14', 6, 'in process of registration', 1, 1),
(4, '2023-05-02', '2028-12-03', 10, 'en cours', 7, 222),
(5, '2022-01-02', '2022-01-03', 10, 'Annulée', 6, 2),
(6, '2024-01-09', '2024-02-03', 10, 'in process of registration', 5, 1),
(8, '2023-09-15', '2023-10-01', 20, 'in process of registration', 8, 10),
(9, '2023-10-01', '2023-11-01', 25, 'in process of registration', 10, 9),
(10, '2023-01-15', '2023-03-15', 15, 'in process of registration', 7, 222);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `apprenant`
--
ALTER TABLE `apprenant`
  ADD PRIMARY KEY (`id_apprenant`);

--
-- Index pour la table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD PRIMARY KEY (`id_formateur`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id_apprenant`,`id_session`),
  ADD KEY `id_session` (`id_session`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id_session`),
  ADD KEY `id_formation` (`id_formation`),
  ADD KEY `id_formateur` (`id_formateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `apprenant`
--
ALTER TABLE `apprenant`
  MODIFY `id_apprenant` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT pour la table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `formateur`
--
ALTER TABLE `formateur`
  MODIFY `id_formateur` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id_formation` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id_session` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`id_apprenant`) REFERENCES `apprenant` (`id_apprenant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`id_session`) REFERENCES `session` (`id_session`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id_formation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`id_formateur`) REFERENCES `formateur` (`id_formateur`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Évènements
--
CREATE DEFINER=`root`@`localhost` EVENT `e_hourly_annulée` ON SCHEDULE EVERY 1 SECOND STARTS '2023-05-13 00:29:28' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE `session` 
SET `etat` = 'Annulée' 
WHERE date_debut = CURRENT_DATE 
AND (SELECT COUNT(*) FROM inscription i WHERE i.id_session = session.id_session) < 3 
AND etat = 'in process of registration'$$

CREATE DEFINER=`root`@`localhost` EVENT `update_en_cours` ON SCHEDULE EVERY 1 HOUR STARTS '2023-05-13 00:40:20' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE session SET etat = 'en cours'
  WHERE date_debut = CURRENT_DATE 
  AND (SELECT COUNT(*) FROM inscription i WHERE i.id_session = session.id_session) >= 3 
  AND (etat = 'in process of registration' OR etat = 'inscription achevée')$$

CREATE DEFINER=`root`@`localhost` EVENT `update_cloturée` ON SCHEDULE EVERY 1 HOUR STARTS '2023-05-13 00:44:13' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE session SET etat = 'clôturée' 
WHERE date_fin = CURRENT_DATE 
AND etat = 'en cours'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
