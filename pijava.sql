-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 11:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pijava`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_etab`
--

CREATE TABLE `action_etab` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `action_etab`
--

INSERT INTO `action_etab` (`id`, `text`) VALUES
(1, 'L\'établissement Etablissement a été modifier le 2024-04-27 23:54:12'),
(2, 'L\'établissement esprit a été créé le 2024-04-27 23:55:25'),
(3, 'L\'établissement esprit a été suprimer le 2024-04-27 23:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `certificat`
--

CREATE TABLE `certificat` (
  `id_certificat` int(11) NOT NULL,
  `nom_certificat` varchar(255) NOT NULL,
  `domaine_certificat` varchar(255) NOT NULL,
  `niveau` varchar(255) NOT NULL,
  `date_obtention_certificat` datetime NOT NULL,
  `ID_Etablissement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificat`
--

INSERT INTO `certificat` (`id_certificat`, `nom_certificat`, `domaine_certificat`, `niveau`, `date_obtention_certificat`, `ID_Etablissement`) VALUES
(2, 'aaaa', 'Finance', 'Certificat', '2024-04-10 00:00:00', 4),
(3, 'bbbbbbb', 'Finance', 'Certificat', '2024-04-17 00:00:00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240411143149', '2024-04-11 16:31:53', 118);

-- --------------------------------------------------------

--
-- Table structure for table `etablissement`
--

CREATE TABLE `etablissement` (
  `ID_Etablissement` int(11) NOT NULL,
  `img_etablissement` varchar(255) NOT NULL,
  `nom_etablissement` varchar(255) NOT NULL,
  `adresse_etablissement` varchar(255) NOT NULL,
  `type_etablissement` varchar(255) NOT NULL,
  `tel_etablissement` int(11) NOT NULL,
  `directeur_etablissement` varchar(255) NOT NULL,
  `date_fondation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `etablissement`
--

INSERT INTO `etablissement` (`ID_Etablissement`, `img_etablissement`, `nom_etablissement`, `adresse_etablissement`, `type_etablissement`, `tel_etablissement`, `directeur_etablissement`, `date_fondation`) VALUES
(4, 'aef3b0d2753b4f2e59870c2edfe50945.jpg', 'Etablissement', 'Adresse', 'École', 20332985, 'direct', '2024-04-24 00:00:00'),
(6, 'e9338377d73634e996c084ad2ff63eea.jpg', 'etab', 'Adresse', 'École', 20332985, 'direct', '2024-04-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `idEvent` int(11) NOT NULL,
  `idPartnerCE` int(11) NOT NULL,
  `idEstab` int(11) NOT NULL,
  `nameEvent` varchar(255) NOT NULL,
  `dateEvent` date NOT NULL,
  `nbrMax` int(11) NOT NULL,
  `prix` float NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`idEvent`, `idPartnerCE`, `idEstab`, `nameEvent`, `dateEvent`, `nbrMax`, `prix`, `description`, `image`) VALUES
(6, 3, 4, 'eve', '2024-04-26', 50, 22, 'FEAFA', '4b8d12de788c079ac70267bde6a3d152.png'),
(7, 3, 4, 'AAAA', '2024-04-22', 122, 12, 'ZZZZZZZZZ', '5c2c0df57a1423bb6b177b358dbe3f45.jpg'),
(8, 3, 6, 'aefa', '2024-05-08', 222, 12, 'EAFFAE', '');

-- --------------------------------------------------------

--
-- Table structure for table `formationn`
--

CREATE TABLE `formationn` (
  `id_formation` int(11) NOT NULL,
  `id_niveau` int(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date_d` date NOT NULL,
  `date_f` date NOT NULL,
  `lien` varchar(500) NOT NULL,
  `pdf_filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formationn`
--

INSERT INTO `formationn` (`id_formation`, `id_niveau`, `categorie`, `titre`, `description`, `date_d`, `date_f`, `lien`, `pdf_filename`) VALUES
(25, 3, 'Finance', 'ABCBCBCBBCABCBCBCBBC', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2024-04-28', '2024-05-04', 'https://meet.com', NULL),
(26, 15, 'Finance', 'vvvVVVVVVVVVVVVV', 'vvvVVVVVVVVVVVVV', '2024-04-28', '2024-05-03', 'https://meet.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:599:\\\"\n                <html>\n                    <body>\n                        <p>Hi user,</p>\n                        <p>Someone has requested a link to change your password. You can do this through the link below.</p>\n                        <p><a href=\\\"http://127.0.0.1:8000/verify-reset-code/6617f4bdd9e5a\\\">Change my password</a></p>\n                        <p>If you didn\\\'t request this, please ignore this email.</p>\n                        <p>Your password won\\\'t change until you access the link above and create a new one.</p>\n                    </body>\n                </html>\n                \\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:17:\\\"theKing@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:23:\\\"wajihfidodido@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:14:\\\"Reset Password\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-04-11 16:33:33', '2024-04-11 16:33:33', NULL),
(2, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:599:\\\"\n                <html>\n                    <body>\n                        <p>Hi user,</p>\n                        <p>Someone has requested a link to change your password. You can do this through the link below.</p>\n                        <p><a href=\\\"http://127.0.0.1:8000/verify-reset-code/6617f88417890\\\">Change my password</a></p>\n                        <p>If you didn\\\'t request this, please ignore this email.</p>\n                        <p>Your password won\\\'t change until you access the link above and create a new one.</p>\n                    </body>\n                </html>\n                \\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:23:\\\"wajihfidodido@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:23:\\\"wajihfidodido@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:14:\\\"Reset Password\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-04-11 16:49:40', '2024-04-11 16:49:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `niveau`
--

CREATE TABLE `niveau` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `prerequis` varchar(255) NOT NULL,
  `duree` varchar(255) NOT NULL,
  `nbformation` int(11) NOT NULL,
  `certificat` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `niveau`
--

INSERT INTO `niveau` (`id`, `name`, `prerequis`, `duree`, `nbformation`, `certificat`, `description`, `image`) VALUES
(3, 'Beginner', 'symfony', '5 mois', 20, 'Achievement', 'The Symfony Beginner Level is designed for developers who are new to the Symfony framework or have limited experience with it', 'C:\\xampp\\tmp\\phpE76F.tmp'),
(9, 'Advanced', 'symfony', '5 mois', 20, 'Completion', 'Le niveau avancé en Symfony s\'adresse aux développeurs expérimentés qui maîtrisent déjà les concepts fondamentaux du framework Symfony et souhaitent approfondir leur expertise.', '09312a8f7acfd8f54862a7e473a148cd.jpg'),
(13, 'Intermediate', 'java', '5 mois', 15, 'achievement', 'dsscs', '88d1fee000cbebb03a1a053097a2e090.png'),
(14, 'Beginner', 'linux', '3 mois', 15, 'Appreciation', 'hfghhfhh<fq', '2d17145d1fe04d117a513ad020a9d0d2.jpg'),
(15, 'Advanced', 'java', '3 mois', 15, 'achievement', 'hfhjhfhegh', '70fb53871ae83b17ffdec64a3445bbc5.jpg'),
(18, 'Intermediate', 'java', '3 mois', 15, 'achievement', 'hhhh', '9c2780668a37ad2691c542f1f9a1997a.jpg'),
(19, 'Beginner', 'java', '3 mois', 10, 'achievement', 'hdggdhd', '1bcd42b767e5e91ff68afa960aaed626.jpg'),
(22, 'Intermediate', 'java', '3 mois', 15, 'achievement', 'ggdddfhb', '9d045d6c29845adf78c86eef6e86c32a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `paiement`
--

CREATE TABLE `paiement` (
  `id` int(11) NOT NULL,
  `id_res` int(11) DEFAULT NULL,
  `montant` double NOT NULL,
  `heure_P` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paiement`
--

INSERT INTO `paiement` (`id`, `id_res`, `montant`, `heure_P`) VALUES
(14, 31, 28.8, '2024-04-28 19:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE `partner` (
  `idPartner` int(11) NOT NULL,
  `namePartner` varchar(255) NOT NULL,
  `typePartner` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`idPartner`, `namePartner`, `typePartner`, `email`, `tel`, `description`, `image`) VALUES
(3, 'abc', 'Default', 'wajih.mejri@esprit.tn', 12123123, 'afeafea', '0499d282a0c490a42c5d153176a5fddd.png'),
(4, 'def', 'NGO', 'mohamedoussema.feki@esprit.tn', 12123123, 'desc', '46b9bfef74cc24c47ff1be6e8fc2c15b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `id_formation` int(11) NOT NULL,
  `question1` varchar(255) NOT NULL,
  `answer1` varchar(255) NOT NULL,
  `question2` varchar(255) NOT NULL,
  `answer2` varchar(255) NOT NULL,
  `question3` varchar(255) NOT NULL,
  `answer3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `id_formation`, `question1`, `answer1`, `question2`, `answer2`, `question3`, `answer3`) VALUES
(9, 25, 'abcde ?', 'okk', 'abcde ?', 'okk', 'abcde ?', 'okk'),
(10, 25, 'abcdef ?', 'abc', 'xyufj ?', 'abc', 'hjklm ?', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `formation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remiseentry`
--

CREATE TABLE `remiseentry` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `pourcentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `remiseentry`
--

INSERT INTO `remiseentry` (`id`, `code`, `pourcentage`) VALUES
(6, '123', 20),
(7, '321', 10);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nb_places` int(11) NOT NULL,
  `imageSrc` varchar(100) DEFAULT NULL,
  `nameE` varchar(100) DEFAULT NULL,
  `eventPrice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `id_user`, `id_event`, `name`, `email`, `nb_places`, `imageSrc`, `nameE`, `eventPrice`) VALUES
(31, 1, 7, 'tasnim', 'tasnim.khelil@esprit.tn', 3, '5c2c0df57a1423bb6b177b358dbe3f45.jpg', 'AAAA', 12),
(32, 1, 7, 'tasnim', 'tasnim.khelil@esprit.tn', 4, '5c2c0df57a1423bb6b177b358dbe3f45.jpg', 'AAAA', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tuteur`
--

CREATE TABLE `tuteur` (
  `id_tuteur` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naisc` date NOT NULL,
  `tlf` int(11) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuteur`
--

INSERT INTO `tuteur` (`id_tuteur`, `nom`, `prenom`, `date_naisc`, `tlf`, `profession`, `email`, `image`) VALUES
(3, 'Amal', 'Driss', '1983-01-01', 12345678, 'Mobile', 'amen.driss@esprit.tn', 'C:\\xampp\\tmp\\phpAD22.tmp'),
(5, 'Elaa', 'Soua', '2002-09-24', 53621299, 'Symfony', 'elaa.soua@esprit.tn', 'C:\\xampp\\tmp\\phpADB1.tmp'),
(6, 'Ines', 'Mrad', '1999-01-01', 51234678, 'Réseau', 'ines.mrad@esprit.tn', 'C:\\xampp\\tmp\\php75E5.tmp');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(180) NOT NULL,
  `address` varchar(255) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reset_code` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `address`, `roles`, `password`, `question`, `answer`, `status`, `reset_code`, `image`, `lastlogin`, `created_at`) VALUES
(1, 'tasnim', 'tasnim.khelil@esprit.tn', 'esprit', '[\"ROLE_ADMIN\"]', '$2y$13$ZYo48yx5TRX/YKekDNVUm.BlKPZigQa8EKEm7s/vxP5BqbaM5wNEa', 'Quel est le nom de votre animal de compagnie?', 'chat', 'active', NULL, 'c030f9ee52d93c11d361ade97772d08d.jpg', '2024-04-28 23:29:56', NULL),
(7, 'User1234', 'user@tuteur.com', 'User1234', '[\"Tuteur\"]', '$2y$13$eKkIJ8099F/GtLFXg72kz.UcQ2uO3LyhJvycQGcm/LuyHQJ8Jw/Qu', 'Quel est votre plat préféré?', 'User1234', 'active', NULL, 'NoImage.png', '2024-04-28 22:42:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_etablissement`
--

CREATE TABLE `user_etablissement` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ID_Etablissement` int(11) DEFAULT NULL,
  `liked` tinyint(1) DEFAULT 0,
  `disliked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_etablissement`
--

INSERT INTO `user_etablissement` (`id`, `user_id`, `ID_Etablissement`, `liked`, `disliked`) VALUES
(3, 1, 4, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_etab`
--
ALTER TABLE `action_etab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificat`
--
ALTER TABLE `certificat`
  ADD PRIMARY KEY (`id_certificat`),
  ADD KEY `IDX_27448F77B251865F` (`ID_Etablissement`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `etablissement`
--
ALTER TABLE `etablissement`
  ADD PRIMARY KEY (`ID_Etablissement`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idEvent`),
  ADD KEY `idPartnerCE` (`idPartnerCE`),
  ADD KEY `idEstab` (`idEstab`);

--
-- Indexes for table `formationn`
--
ALTER TABLE `formationn`
  ADD PRIMARY KEY (`id_formation`),
  ADD KEY `id_niveau` (`id_niveau`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_res` (`id_res`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`idPartner`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formation_id` (`id_formation`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_12345` (`formation_id`),
  ADD KEY `FK_67890` (`user_id`);

--
-- Indexes for table `remiseentry`
--
ALTER TABLE `remiseentry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Indexes for table `user_etablissement`
--
ALTER TABLE `user_etablissement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `etablissement_id` (`ID_Etablissement`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_etab`
--
ALTER TABLE `action_etab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `certificat`
--
ALTER TABLE `certificat`
  MODIFY `id_certificat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `ID_Etablissement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `formationn`
--
ALTER TABLE `formationn`
  MODIFY `id_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `idPartner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remiseentry`
--
ALTER TABLE `remiseentry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_etablissement`
--
ALTER TABLE `user_etablissement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificat`
--
ALTER TABLE `certificat`
  ADD CONSTRAINT `FK_27448F77B251865F` FOREIGN KEY (`ID_Etablissement`) REFERENCES `etablissement` (`ID_Etablissement`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`idPartnerCE`) REFERENCES `partner` (`idPartner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`idEstab`) REFERENCES `etablissement` (`ID_Etablissement`);

--
-- Constraints for table `formationn`
--
ALTER TABLE `formationn`
  ADD CONSTRAINT `formationn_ibfk_1` FOREIGN KEY (`id_niveau`) REFERENCES `niveau` (`id`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formationn` (`id_formation`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `FK_12345` FOREIGN KEY (`formation_id`) REFERENCES `formationn` (`id_formation`),
  ADD CONSTRAINT `FK_67890` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_etablissement`
--
ALTER TABLE `user_etablissement`
  ADD CONSTRAINT `user_etablissement_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_etablissement_ibfk_2` FOREIGN KEY (`ID_Etablissement`) REFERENCES `etablissement` (`ID_Etablissement`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
