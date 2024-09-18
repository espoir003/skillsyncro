-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 23 avr. 2024 à 17:42
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `skillsyncro`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id_agent` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `postnom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `poste` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id_agent`, `nom`, `postnom`, `prenom`, `poste`, `photo`, `password`, `id`) VALUES
(18, '     Ntadulu', '', 'Benjamin', 'Technicien de maintenance', '661f896032899.png', '', ''),
(24, 'Kisoni', '', 'Prisca', 'Technical Administrative Assistant', '661f91236aa9b.png', '', ''),
(25, 'Bazzoun', '', 'Ali', 'Administrative And Finance Director', '661f919ce9fc8.png', '', ''),
(26, 'Saad', '', 'Mahommad', 'Operations Director - Security Systems', '661f91ebd805d.png', '', ''),
(27, 'Lukuli', '', 'Jodas', 'Technical Lead', '661f92290bcfd.png', '', ''),
(28, 'Termos', '', 'Kassem', 'Technical Manager - Security Systems', '661f92745677c.png', '', ''),
(32, 'Tshimueneka', '', 'Justin', 'Représentant de la salle d\'éxposition ', '662195135568c.png', '1234', 'INTER0461V'),
(33, 'Denise', '', 'Denise', ' Assistant(e) Administratif(ve) du Directeur General ', '6621957b4c62e.png', '1234', 'INTER3438V'),
(34, 'Chance', '', 'Makengo', 'Charge De Comptes B2B', '662195f00f438.png', '1234', 'INTER7029V');

-- --------------------------------------------------------

--
-- Structure de la table `annee`
--

CREATE TABLE `annee` (
  `annee` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `annee`
--

INSERT INTO `annee` (`annee`) VALUES
('2024'),
('2025'),
('2026'),
('2027');

-- --------------------------------------------------------

--
-- Structure de la table `cotations`
--

CREATE TABLE `cotations` (
  `id_cot` int(11) NOT NULL,
  `agent` int(11) NOT NULL,
  `tache` int(11) NOT NULL,
  `jour` varchar(15) NOT NULL,
  `realiser` varchar(255) NOT NULL,
  `cotation` varchar(2) DEFAULT NULL,
  `commentaire` varchar(450) NOT NULL,
  `heure_debut` varchar(10) NOT NULL,
  `heure_fin` varchar(10) NOT NULL,
  `semaine` varchar(20) NOT NULL,
  `mois` varchar(20) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cotations`
--

INSERT INTO `cotations` (`id_cot`, `agent`, `tache`, `jour`, `realiser`, `cotation`, `commentaire`, `heure_debut`, `heure_fin`, `semaine`, `mois`, `annee`, `user`, `date`) VALUES
(33, 18, 50, 'Vendredi', 'Installation ms', '8', 'le système bbbbb', '10:10', '10:30', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 07:50:14'),
(34, 18, 51, 'Vendredi', 'Installation ms', '3', 'le système bbbbb', '10:10', '10:30', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 07:50:43'),
(35, 18, 51, 'Vendredi', 'Installation ms', '4', 'le système bbbbb', '10:10', '10:30', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 07:50:54'),
(36, 18, 54, 'Vendredi', 'Installation ms', '1', 'le système bbbbb', '10:10', '10:30', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 07:51:03'),
(37, 18, 50, 'Jeudi', 'Faille de squelette', '5', 'un commentaire', '10:10', '20:20', 'Semaine1', 'Avril', '2024', 5, '2024-04-19 07:58:35'),
(38, 18, 55, 'Jeudi', 'Cloture directe', '8', 'un commentaire', '10:10', '20:20', 'Semaine1', 'Avril', '2024', 5, '2024-04-19 07:58:51'),
(39, 18, 54, 'Jeudi', 'Essai', '2', 'un commentaire', '10:10', '20:20', 'Semaine1', 'Avril', '2024', 5, '2024-04-19 07:59:05'),
(40, 18, 50, 'Mercredi', 'Faille de squelette', '3', 'je suis un commentaire', '10:10', '10:20', 'Semaine1', 'Avril', '2024', 5, '2024-04-19 07:59:35'),
(41, 18, 50, 'Lundi', 'Faille de squelette', '8', 'je suis un commentaire', '20:20', '22:30', 'Semaine1', 'Avril', '2024', 5, '2024-04-19 08:00:09'),
(42, 18, 50, 'Lundi', 'Faille de squelette', '7', 'je suis un commentaire', '20:20', '22:30', 'Semaine1', 'Avril', '2024', 5, '2024-04-19 08:00:15'),
(43, 18, 52, 'Lundi', 'Faille de squelette', '7', 'je suis un commentaire', '20:20', '22:30', 'Semaine1', 'Avril', '2024', 5, '2024-04-19 08:00:19'),
(44, 18, 53, 'Mardi', 'Cloture directe', '2', 'je suis un commentaire', '10:20', '20:10', 'Semaine1', 'Avril', '2024', 5, '2024-04-19 08:00:45'),
(45, 18, 51, 'Lundi', 'créations des tables', '2', 'je suis un commentaire', '10:10', '12:30', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 08:01:30'),
(46, 18, 53, 'Lundi', 'créations des tables', '7', 'je suis un commentaire', '10:10', '12:30', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 08:01:37'),
(47, 18, 50, 'Lundi', 'créations des tables', '2', 'je suis un commentaire', '10:10', '12:30', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 08:01:44'),
(48, 18, 50, 'Mardi', 'Conception', '2', 'je suis commentaire', '10:10', '10:20', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 08:02:11'),
(49, 18, 50, 'Lundi', 'Faille de squelette', '8', 'je suis un commentaire', '10:20', '13:00', 'Semaine4', 'Avril', '2024', 5, '2024-04-19 08:02:43'),
(50, 18, 50, 'Lundi', 'Faille de squelette', '2', 'je suis un commentaire', '10:20', '13:00', 'Semaine4', 'Avril', '2024', 5, '2024-04-19 08:02:48'),
(51, 18, 54, 'Lundi', 'Faille de squelette', '4', 'je suis un commentaire', '10:20', '13:00', 'Semaine4', 'Avril', '2024', 5, '2024-04-19 08:02:53'),
(53, 18, 53, 'Lundi', 'Faille de squelette', '2', 'je suis un commentaire', '10:20', '13:00', 'Semaine4', 'Avril', '2024', 5, '2024-04-19 08:03:06'),
(54, 18, 50, 'Mardi', 'Creation de la table', '3', 'je sui un commentaire', '13:30', '14:30', 'Semaine4', 'Avril', '2024', 5, '2024-04-19 08:03:47'),
(55, 18, 51, 'Mardi', 'Les données', '7', 'je sui un commentaire', '13:30', '14:30', 'Semaine4', 'Avril', '2024', 5, '2024-04-19 08:03:59'),
(56, 18, 52, 'Mardi', 'Virtuel', '3', 'je sui un commentaire', '13:30', '14:30', 'Semaine4', 'Avril', '2024', 5, '2024-04-19 08:04:09'),
(57, 18, 53, 'Mardi', 'Liste de donnée', '9', 'je sui un commentaire', '13:30', '14:30', 'Semaine4', 'Avril', '2024', 5, '2024-04-19 08:04:21'),
(58, 18, 54, 'Mardi', 'Visuel basic', '7', 'message ', '13:30', '14:30', 'Semaine4', 'Avril', '2024', 5, '2024-04-19 08:04:40'),
(61, 18, 54, 'Vendredi', 'Visuel basic 6.0', '5', 'je suis un commentaire', '10:20', '12:30', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 08:05:45'),
(62, 18, 54, 'Vendredi', 'Visuel basic 6.0', '2', 'je suis un commentaire', '10:20', '12:30', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 08:05:49'),
(63, 18, 54, 'Vendredi', 'Visuel basic 6.0', '3', 'je suis un commentaire', '10:20', '12:30', 'Semaine3', 'Avril', '2024', 5, '2024-04-19 08:05:55'),
(64, 18, 50, 'Samedi', 'Aujourd\'hui', '6', 'je suis un commentaire d\'aujourd\'hui', '10:30', '13:00', 'Semaine3', 'Avril', '2024', 5, '2024-04-20 07:13:45'),
(65, 25, 73, 'Lundi', 'Faille de squelette', '5', 'lion', '10:10', '10:30', 'Semaine1', 'Janvier', '2024', 5, '2024-04-23 12:18:02'),
(66, 26, 80, 'Lundi', 'Faille de squelette', '8', 'oo', '10:10', '10:30', 'Semaine1', 'Janvier', '2024', 5, '2024-04-23 12:19:36');

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `idmission` int(11) NOT NULL,
  `agent` int(11) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `mission` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`idmission`, `agent`, `annee`, `mission`) VALUES
(24, 18, '2024', 'Assurer la performance et la fiabilité optimales de nos systèmes de sécurité intégrés (détection d\'intrusion, contrôle d\'accès, vidéosurveillance, réseaux, alarmes et téléphonie) grâce à une combinaison de pratiques de maintenance préventive et curative. Cette fonction joue un rôle essentiel dans la réduction des temps d\'arrêt des systèmes, la résolution proactive des problèmes potentiels et l\'optimisation de la durée de vie des systèmes de sécurité. En outre, vous répondrez aux demandes de service des clients pour les réparations et le dépannage, en assurant un service rapide et efficace sur le terrain.'),
(25, 24, '2024', 'L\'Assistante Technique Administrative joue un rôle essentiel dans le bon fonctionnement de notre entreprise, leader dans la distribution et l\'installation de systèmes de sécurité, de surveillance, de contrôle d\'accès, de réseaux, d\'alarmes et de téléphonie. Vous fournirez un support technique et administratif complet pour assurer un service client efficace, une gestion précise des données et une exécution des projets dans les délais impartis.'),
(26, 25, '2024', 'Le responsable finance et administration est un leader stratégique chargé de superviser toutes les opérations financières et les fonctions administratives afin d\'assurer le bon fonctionnement quotidien de l\'entreprise. Ce rôle est essentiel dans la protection des actifs financiers, la promotion de la rentabilité et la fourniture d\'informations financières précieuses pour éclairer la prise de décision. '),
(27, 26, '2024', 'Ce poste est essentiel pour assurer la satisfaction des clients, l\'efficacité opérationnelle, la réussite des projets et le développement de l\'équipe. Vous gérerez l\'entrepôt, dirigerez les projets d\'installation et d\'entretien des systèmes de sécurité et superviserez une équipe de techniciens.'),
(28, 27, '2024', 'Assurer la direction technique et l\'expertise nécessaires à la conception, à l\'installation et à la maintenance de nos systèmes de sécurité intégrés (détection d\'intrusion, contrôle d\'accès, vidéosurveillance, réseaux, alarmes et téléphonie). Ce rôle est essentiel pour garantir l\'intégrité et les performances techniques de nos systèmes tout en favorisant l\'amélioration continue au sein de l\'équipe technique. En outre, vous contribuerez à la réussite des projets en gérant les projets qui vous sont confiés et en favorisant un environnement de travail collaboratif et efficace.'),
(29, 28, '2024', 'Le Coordinateur Technique joue un rôle essentiel dans le bon fonctionnement des aspects techniques des projets ou au sein d\'un département. Il dirige et gère une équipe de personnel technique, garantissant une communication claire, une exécution efficace des plans et le respect des normes techniques. Il agit comme point de contact central pour les informations techniques, traduisant les données complexes dans un langage clair et concis.'),
(30, 32, '2024', 'Le Spécialiste des systèmes de sécurité joue un rôle essentiel dans la stimulation des ventes et la satisfaction de la clientèle pour notre entreprise, leader dans la distribution et l\'installation de systèmes de sécurité, de surveillance, de contrôle d\'accès, de réseaux, d\'alarmes et de téléphonie. Vous assurerez la gestion quotidienne de la salle d\'exposition, en fournissant un service client exceptionnel tout en contribuant à la croissance des ventes. Vous serez également responsable de la maintenance des niveaux de stock et de l\'utilisation du système CRM pour améliorer les relations clients.'),
(31, 33, '2024', 'Fournir un soutien administratif et opérationnel complet au Directeur Général, garantissant le bon déroulement des opérations quotidiennes et contribuant à la réussite globale de l\'entreprise.\r\nCe rôle est essentiel à la gestion du calendrier du Directeur Général, à la communication et à la supervision des tâches administratives. Vous contribuerez également à la coordination des projets et aux relations clients, en favorisant des interactions positives et en rationalisant les processus.\r\n'),
(32, 34, '2024', 'Le Chargé de comptes B2B est responsable du développement et de la fidélisation d\'un portefeuille de clients en BtoB. Il/elle prospecte de nouveaux clients, analyse leurs besoins commerciaux, propose des solutions adaptées et assure le suivi commercial des clients.');

-- --------------------------------------------------------

--
-- Structure de la table `mois`
--

CREATE TABLE `mois` (
  `mois` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mois`
--

INSERT INTO `mois` (`mois`) VALUES
('Aout'),
('Avril'),
('Decembre'),
('Fevrier'),
('Janvier'),
('Juillet'),
('Juin'),
('Mai'),
('Mars'),
('Novembre'),
('Octobre'),
('Septembre');

-- --------------------------------------------------------

--
-- Structure de la table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `employer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `privilege`
--

INSERT INTO `privilege` (`id`, `admin`, `employer`) VALUES
(22, 12, 18),
(23, 12, 24),
(24, 12, 25),
(28, 13, 18),
(29, 13, 24),
(33, 14, 18);

-- --------------------------------------------------------

--
-- Structure de la table `responsabilite`
--

CREATE TABLE `responsabilite` (
  `id_respo` int(11) NOT NULL,
  `responsabilite` varchar(255) NOT NULL,
  `pourcentage` int(11) NOT NULL,
  `agent` int(11) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `mois` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `responsabilite`
--

INSERT INTO `responsabilite` (`id_respo`, `responsabilite`, `pourcentage`, `agent`, `annee`, `mois`) VALUES
(49, 'Service et maintenance préventive et curative', 50, 18, '2024', 'Avril'),
(50, 'Collaboration avec les clients (15%)', 15, 18, '2024', 'Mai'),
(51, 'Respect des procédures de sécurité et des réglementations en vigueur (10%) ', 10, 18, '2024', 'Juin'),
(52, 'Autres responsabilités (5%) ', 5, 18, '2024', 'Juillet'),
(53, 'Support technique (35 %) ', 35, 24, '2024', 'Avril'),
(54, 'Support administratif (40 %) ', 40, 24, '2024', 'Mai'),
(55, 'Communication et collaboration (20 %) ', 20, 24, '2024', 'Juin'),
(56, 'Saisie de données et documentation (5 %) ', 5, 24, '2024', 'Juillet'),
(57, 'Finance (pondération de 60 %) ', 50, 25, '2024', 'Avril'),
(58, 'Administration (pondération de 40 %) ', 40, 25, '2024', 'Mai'),
(59, 'Satisfaction du client (20%)', 20, 26, '2024', 'Avril'),
(60, 'Efficacité opérationnelle (10 %)', 10, 26, '2024', 'Mai'),
(62, 'Gestion de projet (30 %)', 30, 26, '2024', 'Juin'),
(63, 'Exécution des commandes et gestion des stocks (5%) ', 5, 26, '2024', 'Juillet'),
(64, 'Gestion des ressources humaines  ', 30, 26, '2024', 'Aout'),
(65, 'Expertise Technique et Leadership', 60, 27, '2024', 'Avril'),
(66, 'Gestion de Projet et Coordination (30%)', 30, 27, '2024', 'Mai'),
(67, 'Leadership et gestion d\'équipe (20 %) ', 20, 28, '2024', 'Avril'),
(68, 'Soutien à la gestion de projet (40 %) ', 40, 28, '2024', 'Mai'),
(69, 'Communication et documentation techniques (25 %) ', 25, 28, '2024', 'Juin'),
(70, 'Revue technique et contrôle qualité (15 %) ', 15, 28, '2024', 'Juillet'),
(71, 'Support administratif (10 %) ', 10, 28, '2024', 'Aout'),
(72, 'Vente et service à la clientèle (50 %) ', 50, 32, '2024', 'Avril'),
(73, 'Gestion des stocks (20 %) ', 20, 32, '2024', 'Mai'),
(74, 'Gestion de la relation client et des données (15 %) ', 15, 32, '2024', 'Juin'),
(75, 'Logistique et administration (15 %) ', 15, 32, '2024', 'Juillet'),
(76, 'Soutien Administratif', 50, 33, '2024', 'Avril'),
(77, 'Soutien Projet &amp; Client (40%)', 40, 33, '2024', 'Mai'),
(78, 'Développement commercial (40 %)', 40, 34, '2024', 'Avril'),
(79, 'Prospection (30 %)', 30, 34, '2024', 'Mai'),
(80, 'Suivi et support client (20 %)', 20, 34, '2024', 'Juin'),
(81, 'Temps d\'arrivée au travail', 5, 18, '2024', 'Avril'),
(82, 'Temps d\'arrivée au travail', 5, 24, '2024', 'Avril'),
(83, 'Temps d\'arrivée au travail', 5, 25, '2024', 'Avril'),
(84, 'Temps d\'arrivée au travail', 5, 26, '2024', 'Avril'),
(85, 'Temps d\'arrivée au travail', 5, 27, '2024', 'Avril'),
(86, 'Temps d\'arrivée au travail', 5, 28, '2024', 'Avril'),
(87, 'Temps d\'arrivée au travail', 5, 32, '2024', 'Avril'),
(88, 'Temps d\'arrivée au travail', 5, 34, '2024', 'Avril'),
(89, 'Temps d\'arrivée au travail', 5, 33, '2024', 'Avril');

-- --------------------------------------------------------

--
-- Structure de la table `semaine`
--

CREATE TABLE `semaine` (
  `semaine` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `semaine`
--

INSERT INTO `semaine` (`semaine`) VALUES
('Semaine1'),
('Semaine2'),
('Semaine3'),
('Semaine4');

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `id_tache` int(11) NOT NULL,
  `tache` varchar(255) NOT NULL,
  `id_respo` int(11) NOT NULL,
  `pourcentage` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `taches`
--

INSERT INTO `taches` (`id_tache`, `tache`, `id_respo`, `pourcentage`) VALUES
(50, 'Réaliser des inspections régulières des équipements et des installation', 49, '8'),
(51, 'Vérification et maintien des équipements', 49, '6'),
(52, 'Identifier les signes d\'usure ou de défectuosité', 49, '5'),
(53, 'Effectuer des diagnostics précis des problèmes techniques', 49, '7'),
(54, 'Proposer des solutions de réparation', 49, '5'),
(55, 'Réparer les équipements et les installations', 49, '10'),
(57, 'Être capable d’échanger directement avec le clients', 50, '10'),
(58, 'Garantir la satisfaction des clients', 50, '5'),
(59, 'Suivre les procédures de sécurité', 51, '5'),
(60, 'Respecter les réglementations en vigueurs', 51, '3'),
(61, 'Prise en charge de la maintenance, du service et du dépannage des équipements et des installations', 52, '1'),
(62, 'Il participe au déploiement de projets d’installation et de configuration de tous les systèmes à l\'instar de la téléphonie, le CCTV et le réseau)', 52, '2'),
(64, 'pierrot mange', 53, '5'),
(65, 'Collecter et enregistrer les données techniques relatives aux problèmes des clients et aux équipements', 53, '25'),
(66, 'Gérer les données clients au sein du CRM en garantissant leur exactitude et leur exhaustivité', 54, '25'),
(67, 'Traiter les demandes de service, les devis et les factures en temps opportun et avec précision ', 54, '10'),
(68, 'Préparer des rapports et des présentations selon les besoins ', 54, '5'),
(69, 'Communiquer efficacement avec les techniciens, les représentants commerciaux et les clients pour comprendre et résoudre les demandes techniques', 55, '10'),
(70, 'Coordonner avec les fournisseurs pour assurer la livraison en temps opportun des équipements et du matériel', 55, '10'),
(71, 'Tenir des registres précis des stocks, des journaux de service et des informations clients', 56, '3'),
(72, 'Saisir les informations dans le CRM', 56, '2'),
(73, 'Maintenir des contrôles financiers robustes pour garantir l\'intégrité des données, atténuer les risques financiers et assurer la conformité', 57, '20'),
(74, 'Analyser les données financières, y compris l\'analyse des stocks, pour identifier des opportunités de réduction des coûts ', 57, '20'),
(75, 'Développer et mettre en œuvre des stratégies pour recouvrer efficacement les paiements en souffrance et minimiser les créances irrécouvrables', 57, '10'),
(76, 'Superviser toutes les fonctions administratives, y compris les ressources humaines, la gestion des installations, le support informatique (si applicable) et les opérations de bureau ', 58, '20'),
(77, 'Développer et mettre en œuvre des initiatives de réduction des coûts dans toutes les fonctions administratives, y compris la gestion des caisses enregistreuses pour améliorer l\'efficacité et la sécurité ', 58, '10'),
(78, 'Gérer les relations avec les fournisseurs et garantir l\'efficacité des processus d\'approvisionnement par l\'utilisation du CRM', 58, '5'),
(79, 'Gérer la paie, les avantages sociaux et les tâches RH de base ', 58, '5'),
(80, 'Gérer l\'expérience client depuis le premier contact jusqu\'à l\'installation, le service et l\'assistance continue', 59, '5'),
(81, 'Élaborer et mettre en œuvre des stratégies visant à améliorer le taux de satisfaction de la clientèle', 59, '5'),
(82, 'Suivre et traiter rapidement les préoccupations et les réclamations des clients', 59, '5'),
(83, 'Analyser le retour d\'information des clients afin d\'identifier les domaines susceptibles d\'être améliorés dans les processus et les services, y compris les opérations d\'entreposage', 59, '5'),
(84, 'Superviser le fonctionnement efficace de l\'entrepôt des systèmes de sécurité, y compris le contrôle des stocks, la réception, l\'emballage et l\'expédition', 60, '2'),
(85, 'Mise en œuvre et maintien d\'un aménagement efficace de l\'entrepôt et de systèmes de gestion des stocks', 60, '2'),
(86, 'Veiller au stockage et à la manipulation corrects des équipements afin de préserver la qualité et la sécurité des produits', 60, '2'),
(87, 'Optimiser l\'utilisation de l\'espace de l\'entrepôt et minimiser les coûts de stockage', 60, '2'),
(88, 'Gérer et planifier les techniciens des systèmes de sécurité pour les installations et les appels de service, en maximisant l\'utilisation de leur temps', 60, '2'),
(89, 'Diriger et gérer des projets d\'installation et d\'entretien de systèmes de sécurité, de la conception à l\'achèvement, en respectant les délais, les budgets et les spécifications du client', 62, '5'),
(90, 'Décomposer des projets complexes en tâches gérables, définir des jalons et affecter les ressources de manière efficace', 62, '5'),
(91, 'Gérer les risques liés aux projets et élaborer des plans d\'urgence pour atténuer les problèmes potentiels', 62, '5'),
(92, 'Communiquer efficacement l\'état d\'avancement du projet aux clients et aux parties prenantes internes', 62, '5'),
(93, 'Prendre des commandes à partir du système de gestion des relations avec la clientèle (pour assurer la fourniture des matériaux nécessaires à l\'exécution du projet) ', 62, '5'),
(94, 'Confirmation d\'achat (pour les matériaux du projet)', 62, '3'),
(95, 'Confirmation des bons de commande (pour les matériaux du projet)', 62, '2'),
(96, 'Coordonner la commande, la réception et le stockage des matériaux nécessaires à l\'installation des systèmes de sécurité et aux appels de service', 63, '2'),
(97, 'Veiller à l\'exactitude et à la rapidité de l\'exécution des commandes de matériel pour les projets', 63, '3'),
(98, 'Évaluer les employés et les décideurs (évaluation des performances)', 64, '10'),
(99, 'Gérer la structure des salaires (implication limitée, éventuellement liée à la recommandation d\'ajustements)', 64, '10'),
(100, 'Gérer les relations avec les employés', 64, '5'),
(101, 'Recruter et sélectionner de nouveaux employés', 64, '5'),
(102, 'Concevoir et mettre en place des systèmes de sécurité adaptés aux besoins du client, garantissant une fonctionnalité optimale et la conformité aux normes de l\'industrie', 65, '10'),
(103, 'Diagnostiquer et résoudre les problèmes techniques complexes liés aux systèmes de sécurité, aux réseaux et aux équipements', 65, '20'),
(104, 'Fournir des conseils techniques et un mentorat aux techniciens, en développant leurs compétences et leurs connaissances ', 65, '10'),
(105, 'Se tenir informé des technologies émergentes et des progrès dans le secteur des systèmes de sécurité ', 65, '10'),
(106, 'Développer et mettre en œuvre des meilleures pratiques techniques pour garantir l\'efficacité et la fiabilité du système ', 65, '10'),
(107, 'Gérer les projets d\'installation et de mise à niveau des systèmes de sécurité assignés, en supervisant les aspects techniques dans le respect du budget et des délais', 66, '15'),
(108, 'Collaborer avec le coordinateur technique et d\'autres équipes (ventes, ingénierie) pour assurer le bon déroulement du projet ', 66, '10'),
(109, 'Identifier et atténuer les risques techniques potentiels lors de la planification et de la mise en œuvre du projet ', 66, '5'),
(110, 'Fournir un leadership technique et des conseils à une équipe de techniciens', 67, '5'),
(111, 'Déléguer efficacement les tâches et les projets, en garantissant une communication claire et une responsabilisation', 67, '5'),
(112, 'Effectuer des évaluations de performance et fournir une rétroaction continue aux membres de l\'équipe', 67, '5'),
(113, 'Motiver et développer les compétences techniques de l\'équipe', 67, '5'),
(114, 'Assister le Responsable de Projets et Operations dans l\'élaboration et le maintien des plans et des échéanciers de projet en mettant l\'accent sur les aspects techniques', 68, '10'),
(115, 'Coordonner et suivre les livrables techniques des ingénieurs, des sous-traitants et des fournisseurs, en collaborant efficacement avec l\'équipe', 68, '10'),
(116, 'Gérer les risques techniques et identifier les problèmes potentiels, en proposant des solutions avec l\'équipe pour assurer la réussite du projet', 68, '10'),
(117, 'Préparer et présenter des rapports techniques et des mises à jour d\'avancement', 68, '10'),
(118, 'Agir en tant que liaison entre les équipes techniques et non techniques, en traduisant des informations complexes dans un langage clair et concis pour une utilisation dans le système CRM et d\'autres canaux de communication', 69, '10'),
(119, 'Préparer et maintenir la documentation technique, y compris les dessins, les diagrammes, les spécifications et les articles de la base de connaissances pour le système CRM', 69, '5'),
(120, 'Gérer et contrôler les documents techniques au sein du système CRM, en garantissant l\'exactitude et le respect des normes en vigueur', 69, '5'),
(121, 'Répondre aux demandes de renseignements techniques des intervenants internes et externes', 69, '5'),
(122, 'Examiner les documents techniques, les dessins et les plans pour en vérifier l\'exactitude et l\'exhaustivité, avec la participation de l\'équipe', 70, '5'),
(123, 'Effectuer des contrôles de qualité sur les livrables techniques, en veillant au respect des spécifications du projet', 70, '5'),
(124, 'Participer aux réunions et discussions techniques, en apportant une expertise technique et des points de vue éclairés', 70, '3'),
(125, 'Effectuer des recherches et se tenir au courant des normes et des meilleures pratiques du secteur', 70, '2'),
(126, 'Gérer les bases de données techniques et les systèmes de classement.', 71, '4'),
(127, 'Participer à l\'approvisionnement de matériel et d\'équipements techniques', 71, '2'),
(128, 'Commander et gérer les fournitures techniques', 71, '2'),
(129, 'Préparer des rapports techniques et des présentations', 71, '2'),
(130, 'Gérer le bon fonctionnement de la salle d\'exposition, en garantissant un environnement accueillant et professionnel pour les clients ', 72, '10'),
(131, 'Accueillir les clients, analyser leurs besoins et proposer des solutions de sécurité personnalisées ', 72, '10'),
(132, 'Gérer le processus de vente du premier contact jusqu\'à la finalisation de la commande, en dépassant les objectifs de vente et en maximisant le chiffre d\'affaires', 72, '20'),
(133, 'Traiter les demandes de renseignements, les plaintes et les retours des clients de manière opportune et professionnelle ', 72, '10'),
(134, 'Examiner la marchandise pour s\'assurer qu\'elle est correctement étiquetée, exposée et facilement disponible pour les démonstrations aux clients ', 73, '10'),
(135, 'Superviser les niveaux de stock et passer des commandes de réapprovisionnement pour maintenir un stock optimal ', 73, '5'),
(136, 'Contrôler et enregistrer les articles en stock, en garantissant l\'exactitude et la conformité aux commandes ', 73, '5'),
(137, 'Enregistrer les contacts et les interactions clients dans le système CRM', 74, '5'),
(138, 'Utiliser les données CRM pour générer des rapports clients et identifier des opportunités de vente', 74, '5'),
(139, 'Maintenir et mettre à jour les informations clients et les détails des commandes de produits dans le CRM ', 74, '5'),
(140, 'Préparer les factures pour les ventes directes et assurer le suivi auprès des clients', 75, '5'),
(141, 'Assurer la liaison avec le chef comptable pour les avoirs de vente', 75, '5'),
(142, 'Organiser le transport des produits vers les clients ', 75, '3'),
(143, 'Contribuer au maintien d\'un environnement propre et organisé dans la salle d\'exposition ', 75, '2'),
(144, 'Gérer le calendrier du Directeur Général, fixer les rendez-vous et organiser les voyages si nécessaire', 76, '10'),
(145, 'Rédiger et relire la correspondance, les présentations et les rapports du Directeur Général ', 76, '10'),
(146, 'Gérer les demandes par e-mail et par téléphone, en les orientant vers le personnel approprié ', 76, '10'),
(147, 'Organiser et maintenir les fichiers et dossiers du Directeur Général sous format électronique et physique ', 76, '10'),
(148, 'Gérer les fournitures et équipements de bureau', 76, '10'),
(149, 'Assister à la coordination des projets : collecte d\'informations, préparation des ordres du jour des réunions et suivi des points d\'action ', 77, '10'),
(150, 'Préparer des propositions et des présentations clients en collaboration avec le Directeur Général ', 77, '10'),
(151, 'Gérer la communication client, traiter les demandes de renseignements et garantir une expérience positive', 77, '10'),
(152, 'Saisie des données ', 77, '5'),
(153, 'Rechercher et compiler des données sectorielles ou des informations sur les concurrents pour des présentations ou des rapports', 77, '5'),
(154, 'Développer et mettre en œuvre des plans de visite efficaces pour les clients existants et prospects', 78, '10'),
(155, 'Identifier les besoins commerciaux des clients et proposer des solutions adaptées', 78, '5'),
(156, 'Présenter les avantages et les bénéfices des produits et services de l\'entreprise', 78, '5'),
(157, 'Négocier les prix, les conditions de vente et autres spécifications conformément aux politiques de l\'entreprise', 78, '5'),
(158, 'Préparer les ententes de vente et de service et enregistrer les commandes', 78, '5'),
(159, 'Assurer le suivi des clients et répondre à leurs demandes', 78, '5'),
(160, 'Gérer le CRM : saisie des informations clients, suivi des interactions, reporting basique', 78, '5'),
(161, 'Identifier et qualifier les nouveaux prospectsGérer le CRM : saisie des informations clients, suivi des interactions, reporting basique', 79, '10'),
(162, 'Comprendre les besoins commerciaux des prospects et proposer des solutions adaptées', 79, '10'),
(163, 'Prospecter de nouveaux marchés et identifier des opportunités d\'affaires', 79, '10'),
(164, 'Assurer le suivi des clients et répondre à leurs questions', 80, '10'),
(165, 'Gérer les relations clients et fidéliser la clientèle', 80, '5'),
(166, 'Aider à la résolution des problèmes des clients en collaboration avec les équipes techniques si nécessaire', 80, '5'),
(167, 'Heure d\'arrivée au travail', 81, '5'),
(168, 'Heure d\'arrivée au travail', 82, '5'),
(169, 'Heure d\'arrivée au travail', 83, '5'),
(170, 'Heure d\'arrivée au travail', 84, '5'),
(171, 'Heure d\'arrivée au travail', 85, '5'),
(172, 'Heure d\'arrivée au travail', 86, '5'),
(173, 'Heure d\'arrivée au travail', 87, '5'),
(174, 'Heure d\'arrivée au travail', 89, '5'),
(175, 'Heure d\'arrivée au travail', 88, '5');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `is_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`is_user`, `email`, `nom`, `password`, `type`) VALUES
(10, 'mambueneespoir@gmail.com', 'Espoir Mambuene', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(11, 'sifa.kasongo@gmail.com', 'Sifa Kasongo', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(12, 'espoir@gmail.com', 'Ninho', '81dc9bdb52d04dc20036dbd8313ed055', 'Simple'),
(13, 'antoine@gmail.com', 'Jean Marc', '81dc9bdb52d04dc20036dbd8313ed055', 'Simple'),
(14, 'pierrot@gmail.com', 'Pierrot', '81dc9bdb52d04dc20036dbd8313ed055', 'Simple');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id_agent`);

--
-- Index pour la table `annee`
--
ALTER TABLE `annee`
  ADD PRIMARY KEY (`annee`);

--
-- Index pour la table `cotations`
--
ALTER TABLE `cotations`
  ADD PRIMARY KEY (`id_cot`),
  ADD KEY `tache` (`tache`),
  ADD KEY `agent` (`agent`),
  ADD KEY `annee` (`annee`),
  ADD KEY `mois` (`mois`),
  ADD KEY `semaine` (`semaine`),
  ADD KEY `user` (`user`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`idmission`),
  ADD KEY `agent` (`agent`),
  ADD KEY `annee` (`annee`);

--
-- Index pour la table `mois`
--
ALTER TABLE `mois`
  ADD PRIMARY KEY (`mois`);

--
-- Index pour la table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin` (`admin`),
  ADD KEY `employer` (`employer`);

--
-- Index pour la table `responsabilite`
--
ALTER TABLE `responsabilite`
  ADD PRIMARY KEY (`id_respo`),
  ADD KEY `agent` (`agent`),
  ADD KEY `annee` (`annee`),
  ADD KEY `mois` (`mois`);

--
-- Index pour la table `semaine`
--
ALTER TABLE `semaine`
  ADD PRIMARY KEY (`semaine`);

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`id_tache`),
  ADD KEY `id_respo` (`id_respo`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`is_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `cotations`
--
ALTER TABLE `cotations`
  MODIFY `id_cot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `idmission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `responsabilite`
--
ALTER TABLE `responsabilite`
  MODIFY `id_respo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT pour la table `taches`
--
ALTER TABLE `taches`
  MODIFY `id_tache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `is_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cotations`
--
ALTER TABLE `cotations`
  ADD CONSTRAINT `cotations_ibfk_1` FOREIGN KEY (`tache`) REFERENCES `taches` (`id_tache`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotations_ibfk_2` FOREIGN KEY (`agent`) REFERENCES `agent` (`id_agent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotations_ibfk_3` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotations_ibfk_4` FOREIGN KEY (`mois`) REFERENCES `mois` (`mois`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotations_ibfk_5` FOREIGN KEY (`semaine`) REFERENCES `semaine` (`semaine`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mission`
--
ALTER TABLE `mission`
  ADD CONSTRAINT `mission_ibfk_1` FOREIGN KEY (`agent`) REFERENCES `agent` (`id_agent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mission_ibfk_2` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `privilege`
--
ALTER TABLE `privilege`
  ADD CONSTRAINT `privilege_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `user` (`is_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `privilege_ibfk_2` FOREIGN KEY (`employer`) REFERENCES `agent` (`id_agent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `responsabilite`
--
ALTER TABLE `responsabilite`
  ADD CONSTRAINT `responsabilite_ibfk_1` FOREIGN KEY (`agent`) REFERENCES `agent` (`id_agent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responsabilite_ibfk_2` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responsabilite_ibfk_3` FOREIGN KEY (`mois`) REFERENCES `mois` (`mois`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `taches`
--
ALTER TABLE `taches`
  ADD CONSTRAINT `taches_ibfk_1` FOREIGN KEY (`id_respo`) REFERENCES `responsabilite` (`id_respo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
