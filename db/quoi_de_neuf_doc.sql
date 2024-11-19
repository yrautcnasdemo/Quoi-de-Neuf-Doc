-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : lun. 18 nov. 2024 à 17:59
-- Version du serveur : 8.0.37
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quoi_de_neuf_doc`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

CREATE TABLE `appointment` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `doctor_id` int NOT NULL,
  `appointment_datetime` datetime NOT NULL,
  `note_info` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`id`, `user_id`, `doctor_id`, `appointment_datetime`, `note_info`) VALUES
(9, 12, 9, '2025-12-12 10:30:00', 'erghre igirghr zughrzouzehg ouerzh '),
(10, 12, 9, '2051-10-20 10:45:00', 'eiofhj ozejhf oiezfoi ezoif hoizehf oizehf ioehzio fhzeoifh oiezhf oiezhoif heozihf oiezhfoi ezhoifh zeiofh oiezhf iozehfo zehfoi zheiofh ezihf pieajdopje paodjpazej pajdpazjp djzapj dpazj\r\n'),
(12, 12, 9, '2090-12-06 05:30:00', 'Si vous êtes encore de ce monde, nous aurons quelques examen de contrôle a vous soumettre '),
(16, 11, 9, '2026-02-12 10:00:00', 'pensez a rapporter vos radios de la jambe droite');

-- --------------------------------------------------------

--
-- Structure de la table `doctors`
--

CREATE TABLE `doctors` (
  `id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender` enum('H','F') DEFAULT NULL,
  `doc_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `department` varchar(5) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` text,
  `phone` varchar(20) DEFAULT NULL,
  `payment_method` set('Carte_Bancaire','Cheque','Especes','Tiers_payant') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `professional_type` enum('Generaliste','Specialiste','Dentiste','Kinesitherapeute') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `availability` enum('Oui','Non') DEFAULT NULL,
  `Monday_schedules` varchar(50) DEFAULT NULL,
  `Tuesday_schedules` varchar(50) DEFAULT NULL,
  `Wednesday_schedules` varchar(50) DEFAULT NULL,
  `Thursday_schedules` varchar(50) DEFAULT NULL,
  `Friday_schedules` varchar(50) DEFAULT NULL,
  `Saturday_schedules` varchar(50) DEFAULT NULL,
  `Sunday_schedules` varchar(50) DEFAULT NULL,
  `region` enum('Auvergne-Rhône-Alpes','Bourgogne-Franche-Comté','Bretagne','Centre-Val de Loire','Corse','Grand Est','Hauts-de-France','Île-de-France','Normandie','Nouvelle-Aquitaine','Occitanie','Pays de la Loire','Provence-Alpes-Côte d''Azur') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `doctors`
--

INSERT INTO `doctors` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `doc_image`, `department`, `city`, `address`, `phone`, `payment_method`, `professional_type`, `specialization`, `availability`, `Monday_schedules`, `Tuesday_schedules`, `Wednesday_schedules`, `Thursday_schedules`, `Friday_schedules`, `Saturday_schedules`, `Sunday_schedules`, `region`) VALUES
(7, 'Jason', 'Voorhees', 'Vendredi13@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$VzJacU8xOVFkVzBPdlV3Mg$Qi9uUKPerZup/kaK6xKYRsHfwEuR6UoOXe4D75fC9+I', 'H', 'doc_6734e4c9ad7d55.85054390.png', '58000', 'Nevers', '01 Crystal Lake', '131946', 'Especes,Tiers_payant', 'Generaliste', 'Osteopathie', 'Oui', '9h00 - 21h00', 'Fermé', '9h00 - 21h00', '9h00 - 21h00', '21h00 - 5h00', '9h00 - 21h00', 'Fermé', NULL),
(8, 'Freddy', 'Krueger', 'Freddy@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$NklzdjdnRnFnTU5wbUJPWA$jjC+8Pnz0XG2zrfNLgBgrmBFbtagAMiPbbV1DPGTp8o', 'H', 'doc_6734e4c9ad7d55.85057398.jpg', '25000', 'Elm Street', '01 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1428-1428 ', 'Carte_Bancaire,Cheque,Especes', 'Specialiste', 'Chirurgie', 'Oui', '23h00 - 6h00', '23h00 - 6h00', '23h00 - 6h00', '23h00 - 6h00', '23h00 - 6h00', '23h00 - 6h00', '23h00 - 6h00', NULL),
(9, 'Mercredi', 'Addams', 'Mercredi@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$MmdPY0YyZjVVZTNLRFE4NQ$Kfo/FO0I8gHUB/65D9pzs8JVfpnbB1VvU12yfQoSVaE', 'F', 'doc_6724e4c9ad7d55.85057398.jpg', '58200', 'Westfield - Californie', '13 rue Chaume des pendus face au cimetière a droit du funerarium', '85-911-911', 'Carte_Bancaire,Especes,Tiers_payant', 'Generaliste', 'Osteopathie', 'Non', '8h00 - 12h00', '8h00 - 12h00 14h00 -17h00', 'Fermé', '8h00 - 12h00 14h00 -17h00', '8h00 - 12h00 14h00 -17h00', '8h00 - 12h00 14h00 -17h00', 'Fermé', 'Bretagne'),
(10, 'Beetle', 'Juice', 'Beetlejuice@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$bHhMRlRyNVRXYW01cDM4TQ$AjNwXqooKkrP1v8PVD676wvs1aYRvUzxmxvDnLpJu5A', 'H', 'doc_6725eed206e6c2.65804248.jpeg', '58600', 'Chicago', '9720 Boulvard Raystreet ', '0674125410', 'Especes,Tiers_payant', 'Specialiste', 'ORL', 'Oui', 'Fermé', '9h00-18h00', '9h00-18h00', '9h00-18h00', '9h00-18h00', 'Fermé', 'Fermé', NULL),
(11, 'Ellen', 'Ripley', 'Ellen@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$S2lNMDh2ZEVtdy95aXBEdQ$jj9p/97AFjOhpIbUPNjO8Zz0XpSpNF2s0GOFIeKL1qw', 'F', NULL, '00000', 'USCSS Nostromo', 'Infirmerie 1ère porte a droite après le chat', '00-2152-6585', NULL, 'Specialiste', 'Infectiologue ', '', '8h00 - 12h00 14h00 -17h00', 'Fermé', '8h00 - 12h00', '8h00 - 12h00 14h00 -17h00', '8h00 - 12h00 14h00 -17h00', '8h00 - 12h00 14h00 -17h00', 'Fermé', NULL),
(12, 'Dutch', 'Schaefer', 'Dutch@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$NjdOWWs0a3BHMTNFeURCaQ$ty4cuEJIAWSvHQliKvBdQ11lIBk02cpTAT0MWeJj7UU', 'H', NULL, '45620', 'Val Verde', '73 Route du bois prés verte dans l\'hexagone', '06-85-20-90-10', 'Carte_Bancaire,Cheque,Especes,Tiers_payant', 'Dentiste', 'Chirurgien Dentiste', 'Oui', '9h00-12h00', '8h30-12h00 13h00-16h30', 'Fermé', '8h30-12h00 13h00-16h30', '9h00-12h00', 'Fermé', 'Fermé', NULL),
(13, 'Peter', 'Venkman', 'Venkman@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$NkFmaDdLVFVuTkZrN1E4SA$5Bs67IU3HlhZW0VEUcQlxVMWcJXWZOP36Pr0gn8VjL0', NULL, NULL, '75000', 'Paris', '01 Rue des pres vertslime', '555-2368', 'Carte_Bancaire,Cheque,Especes,Tiers_payant', 'Specialiste', 'ORL', '', '8h00 - 20h00', '8h00 - 20h00', '8h00 - 20h00', '8h00 - 20h00', '8h00 - 20h00', '8h00 - 12h00', 'Fermé', NULL),
(14, 'Raymond', 'Stantz', 'Stantz@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TDRwZnM3MFcxVldTZHUzWg$cApMOZ+nuJ+3azr/kik5UAtp4KgfC7qKI/ppX9rSIlg', NULL, NULL, NULL, NULL, NULL, '555-2368', NULL, 'Specialiste', 'Paranormale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Egon', 'Spengler', 'Spengler@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$MVJsY0xlQS5lTmJMZ0ZKSg$EYbxHsiZWsUmwwXSZ3t+eNVZCDM/MPF3Mk44mxdOg1A', NULL, NULL, NULL, NULL, NULL, '555-2368', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Winston', 'Zeddemore', 'Zeddemore@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$LkxUNDVkaTJ0S1RiY0EyeA$224rRZt0MWRU5n60xWgrb7PNpO7M1XhOM47ygj7DfiA', NULL, NULL, NULL, NULL, NULL, '555-2368', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Hermione', 'Granger', 'granger@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$TjFVcjU2S0lzMW9CREZxMA$nY7GW8l8oN6Ye6SRQAU7s1F3pDgJwSOybWhBuhwBJSU', 'F', NULL, '78945', NULL, NULL, '03214578', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `doctor_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `doctor_id`) VALUES
(12, 12, 9),
(13, 12, 7),
(19, 11, 9);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_department` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_city` varchar(255) DEFAULT NULL,
  `user_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `user_phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user_firstname`, `user_lastname`, `user_image`, `user_mail`, `user_password`, `user_department`, `user_city`, `user_address`, `user_phone`) VALUES
(8, 'Billy', 'Peltzer', NULL, 'Peltzer@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$ci5kdTBuVm92S3dJT1BOcQ$5TyLMjmBxJ/YEcMBnH7VmBBcxyUD8LIWdzlxhFCtqKo', NULL, NULL, NULL, NULL),
(9, 'Alice', 'Hardy', NULL, 'Hardy@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$ZVNQbVUzQzljTlNzeHc3dQ$J9n32lpRGX8P9b1dnaXOy2Eox/tSYu1Ghv66bDopVd4', NULL, NULL, NULL, NULL),
(10, 'Mia', 'Wallace', NULL, 'Wallace@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$UzVDdEZobkFJdjljT0tSaA$0+/ZGrgygqAfrhboa2FefkePtL0b8+mgJwq6VOWP24Q', NULL, NULL, NULL, NULL),
(11, 'Vincent', 'Vega', 'user_6725ef46e21478.64733100.png', 'Vega@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Mnl0Ulg3bHMzY2pkQ1FhVw$DW4XybXlGuO6XnxC79s3MmXLDyo+Qk4/F3NhL0U5j2k', '52100', 'Los Angeles', '521 Roadstreet 874 East', '0352147454'),
(12, 'Sarah', 'Connor', 'user_6724d7940c7876.37465595.jpg', 'Connor@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$dmNKeUYua2JKalk5c3k3SQ$442uuIDxaueIx4UKM7JWBU+i6epgY6LTqLKBYz/u+nc', '90210', 'Beverly Hills', '13 Street Pine Canyon California', '02-210-715'),
(15, 'vert', 'Cirton', NULL, 'cv@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$ZkJDQW80VzRpYkQzYmU3UQ$Iqg+D2eTo9580DnK412zZUmVPEPFb1A/GgqauR6jbvE', NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Index pour la table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Contraintes pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
