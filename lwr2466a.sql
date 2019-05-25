-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 07, 2019 at 04:04 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 5.6.38-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lwr2466a`
--

-- --------------------------------------------------------

--
-- Table structure for table `joueur`
--

CREATE TABLE IF NOT EXISTS `joueur` (
`id_joueur` int(11) NOT NULL,
  `numLicence` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `dateNaissance` date NOT NULL,
  `photoPath` varchar(200) DEFAULT NULL,
  `taille` double DEFAULT NULL,
  `poids` double DEFAULT NULL,
  `poste` varchar(200) DEFAULT NULL,
  `statut` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `joueur`
--

INSERT INTO `joueur` (`id_joueur`, `numLicence`, `nom`, `prenom`, `dateNaissance`, `photoPath`, `taille`, `poids`, `poste`, `statut`) VALUES
(1, 10001, 'Ben Boina', 'Salim', '1991-07-19', 'photo/salim.jpg', 189, NULL, 'Gardien', 'Actif'),
(2, 10002, 'Gasset', 'Robin', '1981-02-12', 'photo/robin.jpg', 182, NULL, 'Gardien', 'Actif'),
(3, 10003, 'Lauthe', 'Christopher', '1985-11-25', 'photo/christopher.jpg', 187, NULL, 'Pivot', 'Actif'),
(4, 10004, 'Boucenna', 'Nasser', '1978-01-09', 'photo/nasser.jpg', 180, NULL, 'Attaquant', 'Actif'),
(5, 10005, 'Fischer', 'Yannick', '1974-12-17', 'photo/yannick.jpg', 181, NULL, 'Defenseur', 'Actif'),
(6, 10006, 'Francois', 'Stephane', '1976-04-11', 'photo/stephane.jpg', 181, NULL, 'Defenseur', 'Actif'),
(7, 10007, 'Barbotti', 'Anthony', '1988-03-08', 'photo/anthony.jpg', 177, NULL, 'Attaquant', 'Actif'),
(8, 10008, 'Basquaise', 'Jeremy', '1985-09-21', 'photo/jeremy.jpg', 174, NULL, 'Attaquant', 'Absent'),
(9, 10009, 'Pagis', 'Mickael', '1973-08-17', 'photo/mickael.jpg', 181, NULL, 'Attaquant', 'Actif'),
(10, 10010, 'Samoun', 'Didier', '1980-08-29', 'photo/didier.jpg', 186, NULL, 'Ailier', 'Actif'),
(11, 10011, 'Sebastien', 'Huck', '1998-03-09', 'photo/huck.jpg', 185, NULL, 'Ailier', 'Actif'),
(12, 10012, 'Sansoni', 'Sebastien', '1978-01-30', 'photo/sebastien.jpg', 187, NULL, 'Defenseur', 'Actif');

-- --------------------------------------------------------

--
-- Table structure for table `matchs`
--

CREATE TABLE IF NOT EXISTS `matchs` (
`id_matchs` int(11) NOT NULL,
  `dateHeure` datetime NOT NULL,
  `equipeAdverse` varchar(200) NOT NULL,
  `lieu` varchar(200) NOT NULL,
  `resultat` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matchs`
--

INSERT INTO `matchs` (`id_matchs`, `dateHeure`, `equipeAdverse`, `lieu`, `resultat`) VALUES
(2, '2006-05-26 00:00:00', 'Hongrie', 'Naples', '4-2'),
(3, '2006-05-27 00:00:00', 'Italie', 'Naples', '5-5 (TAB)'),
(4, '2006-05-28 00:00:00', 'Portugal', 'Naples', '8-9'),
(5, '2007-05-03 00:00:00', 'Pologne', 'Tarragone', '5-1'),
(6, '2007-05-04 00:00:00', 'Portugal', 'Tarragone', '6-5'),
(7, '2007-05-05 00:00:00', 'Ukraine', 'Tarragone', '0-3'),
(9, '2017-07-09 15:35:00', 'Suisse', 'Nazare', '3-5'),
(10, '2017-07-08 15:30:00', 'Italie', 'Nazare', '0-1'),
(11, '2017-07-07 18:15:00', 'Portugal', 'Nazare', '5-10'),
(12, '2017-06-25 15:30:00', 'Allemagne', 'Belgrade', '5-4'),
(13, '2017-06-24 15:30:00', 'Espagne', 'Belgrade', '4-5'),
(14, '2017-06-23 16:45:00', 'Russie', 'Belgrade', '4-2'),
(15, '2016-09-11 14:00:00', 'Azerbaidjan', 'Jesolo', '4-3'),
(16, '2016-09-10 14:00:00', 'Russie', 'Jesolo', '3-9'),
(17, '2016-09-09 10:15:00', 'Grece', 'Jesolo', '7-4'),
(18, '2016-09-08 16:30:00', 'Portugal', 'Jesolo', '3-5'),
(19, '2016-09-07 10:15:00', 'Belarus', 'Jesolo', '4-4'),
(20, '2016-09-06 16:30:00', 'Hongrie', 'Jesolo', '8-7'),
(21, '2016-09-04 14:00:00', 'Bulgarie', 'Jesolo', '6-2'),
(22, '2016-09-02 12:45:00', 'Azerbaidjan', 'Jesolo', '3-2'),
(23, '2015-05-03 11:00:00', 'Espagne', 'Paris', '3-2'),
(24, '2015-05-01 17:00:00', 'Espagne', 'Paris', '2-5'),
(25, '2019-05-05 09:20:00', 'Belgique', 'Liege', '0-0');

-- --------------------------------------------------------

--
-- Table structure for table `participer`
--

CREATE TABLE IF NOT EXISTS `participer` (
  `id_joueur` int(11) NOT NULL,
  `id_matchs` int(11) NOT NULL,
  `titulaire` tinyint(1) NOT NULL,
  `note` int(1) DEFAULT NULL,
  `commentaire` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participer`
--

INSERT INTO `participer` (`id_joueur`, `id_matchs`, `titulaire`, `note`, `commentaire`) VALUES
(1, 3, 1, 2, '5 but pris, DOIT s''améliorer'),
(1, 4, 1, 2, 'Gardien, 5 but pris'),
(1, 5, 1, 4, 'Belle performance'),
(1, 7, 1, 2, '3 but pris'),
(1, 9, 1, 4, 'Beaux arrets'),
(1, 11, 1, 3, 'ArrÃªts et placement Ã  amÃ©liorer'),
(1, 13, 1, 2, 'Ailier, mauvaise prise de decision'),
(1, 14, 1, 3, 'Sans plus'),
(1, 17, 1, 4, 'AmÃ©lioration globale'),
(1, 19, 1, 3, 'Sans plus, 4 buts pris'),
(1, 20, 1, 2, '7 buts pris'),
(1, 22, 1, 4, 'Beaux arrÃªts'),
(1, 24, 1, 4, 'Bon dans l''ensemble'),
(2, 2, 1, 4, 'Deux buts pris mais beaux arrêts pour les autres'),
(2, 4, 1, 2, 'Gardien, 3 but pris'),
(2, 6, 1, 2, '5 but pris'),
(2, 10, 1, 3, 'Prise de dÃ©cision mauvaise'),
(2, 12, 1, 4, 'Beaux arrÃªts'),
(2, 13, 1, 3, 'Sans plus'),
(2, 15, 1, 2, 'Mauvais arrÃªts'),
(2, 16, 1, 4, 'AmÃ©lioration prise de dÃ©cision'),
(2, 18, 1, 1, 'Aucun arrÃªts'),
(2, 19, 1, 3, 'DÃ©fenseur, dÃ©placement moyens'),
(2, 21, 1, 4, 'Beaux arrÃªts'),
(2, 23, 1, 2, '5 buts pris'),
(2, 24, 1, 3, 'Attaquant, but, ok'),
(3, 2, 1, 5, 'très bonne passes et lecture du jeu'),
(3, 3, 0, NULL, 'N''a pas joué'),
(3, 4, 0, 3, 'Passes ok'),
(3, 5, 1, 4, 'Bonne passes'),
(3, 7, 1, 3, 'Passable'),
(3, 9, 1, 3, 'Peut s''amÃ©liorer sur la technique de passe'),
(3, 11, 1, 4, 'AmÃ©lioration des passes'),
(3, 13, 0, 3, 'Passes ok'),
(3, 14, 1, 4, 'AmÃ©lioration passes'),
(3, 15, 1, 4, 'Bonne passes'),
(3, 16, 0, 3, ''),
(3, 18, 1, 3, 'Passes ok'),
(3, 19, 1, 4, 'Bonnes passes'),
(3, 20, 0, 3, 'Passes ok'),
(3, 21, 1, 4, 'Belles passes'),
(3, 23, 1, 2, 'Passes moyennes'),
(4, 2, 1, 4, 'Bonne prise d''occasion, doublé'),
(4, 4, 0, 5, 'Quadruplé'),
(4, 5, 1, 4, 'Doublé'),
(4, 7, 1, 2, 'Mauvaise lecture du jeu'),
(4, 9, 1, 4, ''),
(4, 12, 1, 3, 'Sans plus'),
(4, 14, 0, 3, 'Sans plus'),
(4, 15, 1, 3, ''),
(4, 17, 1, 1, 'Mauvais'),
(4, 19, 1, 4, 'DoublÃ©'),
(4, 20, 1, 5, 'Excellent quintuplÃ©'),
(4, 22, 1, 4, 'DoublÃ©, bon positionnement'),
(4, 23, 1, 3, 'Prise de dÃ©cision ok'),
(4, 24, 0, 4, 'DoublÃ©, bonne saisie d''occasion'),
(5, 2, 0, 4, 'Bon positionnement'),
(5, 3, 1, 3, 'Moyen'),
(5, 4, 1, 2, 'Mauvais placement'),
(5, 6, 1, 3, 'Moyens'),
(5, 9, 1, 4, ''),
(5, 11, 1, 3, ''),
(5, 12, 1, 3, 'Pas donnÃ© Ã  100%'),
(5, 13, 1, 4, 'Bon dans l''ensemble'),
(5, 14, 0, 3, ''),
(5, 15, 1, 4, 'Bon positionnement'),
(5, 16, 0, 4, 'Bon dans l''ensemble'),
(5, 17, 1, 3, 'Sans plus, position ok'),
(5, 18, 1, 1, 'Mauvais postionnement'),
(5, 19, 1, 3, 'Sans plus'),
(5, 20, 1, 3, 'Moyens'),
(5, 21, 0, 4, ''),
(5, 22, 1, 4, 'Bon dans l''ensemble'),
(5, 23, 0, 3, 'Moyen'),
(6, 2, 1, 3, NULL),
(6, 5, 0, 4, NULL),
(6, 6, 1, 2, 'Mauvais placement'),
(6, 7, 1, 3, 'Placement moyens'),
(6, 9, 1, 2, 'Mauvais placement'),
(6, 10, 1, 4, 'AmÃ©lioration du placement et de la vision de jeu'),
(6, 11, 0, 4, 'Bon placement'),
(6, 12, 1, 4, 'Grosse amÃ©lioration placement'),
(6, 14, 1, 4, ''),
(6, 17, 1, 4, 'Bonne prise de dÃ©cision'),
(6, 18, 0, 3, 'Sans plus'),
(6, 20, 1, 2, 'Mauvais positionnement'),
(6, 24, 1, 4, 'Bon dans l''ensemble'),
(7, 2, 0, 4, 'Bon positionnement, doublé'),
(7, 3, 1, 4, 'Triplé'),
(7, 5, 1, 5, 'Triplé'),
(7, 6, 1, 4, 'doublÃ©, bon dÃ©placement'),
(7, 10, 1, 5, 'Beaux buts'),
(7, 11, 1, 4, 'Bonne prise de dÃ©cision'),
(7, 14, 1, 3, 'FatiguÃ©'),
(7, 16, 1, 3, 'Sans plus'),
(7, 17, 1, 3, 'Sans plus'),
(7, 18, 1, 4, 'DoublÃ©'),
(7, 19, 0, 4, 'DoublÃ©'),
(7, 21, 1, 5, 'QuadruplÃ©'),
(7, 22, 1, 2, 'Mauvaise prise de dÃ©cision et placement'),
(9, 3, 1, 4, 'Bonne lecture du jeu, doublé'),
(9, 4, 1, 5, 'Quadruplé'),
(9, 6, 1, 5, 'QuadruplÃ©'),
(9, 9, 0, 4, 'Bonnes frappes'),
(9, 10, 1, 2, 'Mauvaise prise de decision, manquement d''occasions'),
(9, 12, 1, 4, 'Bonne occasions'),
(9, 13, 1, 5, 'Excellent'),
(9, 15, 0, 4, 'Bonne occasions'),
(9, 16, 1, 4, 'AmÃ©lioration positionnement'),
(9, 18, 1, 3, 'but mais mauvaise lecture du jeu'),
(9, 20, 1, 5, 'Excellent triplÃ©'),
(9, 21, 1, 4, 'DoublÃ©, manquement d''occasions'),
(10, 2, 1, 4, 'BUT, Bon déplacements'),
(10, 3, 0, 4, 'Bon déplacements'),
(10, 5, 0, 4, 'Bon déplacements'),
(10, 6, 0, 4, ''),
(10, 7, 1, 3, 'Prise de dÃ©cision moyenne'),
(10, 9, 0, 3, ''),
(10, 10, 0, 4, 'Bon placement'),
(10, 11, 1, 3, ''),
(10, 13, 0, 4, 'Bonne prestation'),
(10, 15, 1, 4, 'Bon dÃ©placement'),
(10, 17, 0, 4, 'Bon dÃ©placements'),
(10, 18, 0, 2, 'Mauvais positionnement'),
(10, 19, 0, 3, ''),
(10, 20, 0, 3, ''),
(10, 21, 0, 4, 'Bon dÃ©placements'),
(10, 22, 0, 3, 'Sans plus'),
(10, 23, 0, 3, ''),
(10, 24, 1, 3, 'DÃ©placements ok'),
(11, 2, 0, 4, 'Bon dans l''ensemble'),
(11, 3, 1, 3, 'Prise de décision à améliorer'),
(11, 4, 1, 4, 'Bonne remontée et passes'),
(11, 5, 0, 3, 'Sans plus'),
(11, 6, 0, 4, 'Bon dÃ©placements'),
(11, 7, 0, 3, ''),
(11, 10, 0, 3, ''),
(11, 11, 0, 1, 'Placement mauvais'),
(11, 14, 1, 4, 'AmÃ©lioration position'),
(11, 15, 0, 3, ''),
(11, 16, 1, 3, ''),
(11, 18, 0, 3, 'DÃ©placement ok'),
(11, 19, 0, 4, 'Bons dÃ©placements'),
(11, 20, 0, 4, 'Bonne remontÃ©e terrain'),
(11, 23, 1, 2, 'Mauvais dÃ©placement'),
(11, 24, 1, 3, ''),
(12, 3, 0, 3, 'Sans plus'),
(12, 4, 0, 3, 'Moyen'),
(12, 5, 1, 4, 'Bon positionnement'),
(12, 6, 0, 3, ''),
(12, 7, 0, 2, 'Mauvaise prise de dÃ©cision'),
(12, 10, 1, 3, ''),
(12, 12, 0, 4, 'Bon placement'),
(12, 13, 1, 2, 'Mauvais placement'),
(12, 16, 1, 4, 'Bonne prise de dÃ©cision'),
(12, 17, 0, 3, ''),
(12, 21, 1, 4, 'Bonne dÃ©fense'),
(12, 22, 1, 4, 'Bon placement'),
(12, 23, 1, 2, 'Mauvais placement'),
(12, 24, 0, 4, 'Bon placement');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `joueur`
--
ALTER TABLE `joueur`
 ADD PRIMARY KEY (`id_joueur`);

--
-- Indexes for table `matchs`
--
ALTER TABLE `matchs`
 ADD PRIMARY KEY (`id_matchs`);

--
-- Indexes for table `participer`
--
ALTER TABLE `participer`
 ADD PRIMARY KEY (`id_joueur`,`id_matchs`), ADD KEY `id_matchs` (`id_matchs`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `joueur`
--
ALTER TABLE `joueur`
MODIFY `id_joueur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `matchs`
--
ALTER TABLE `matchs`
MODIFY `id_matchs` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `participer`
--
ALTER TABLE `participer`
ADD CONSTRAINT `Participer_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueur` (`id_joueur`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Participer_ibfk_2` FOREIGN KEY (`id_matchs`) REFERENCES `matchs` (`id_matchs`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
