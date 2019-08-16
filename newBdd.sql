-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.11 - MySQL Community Server (GPL)
-- SE du serveur:                Win32
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table madera. client
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text CHARACTER SET latin1 NOT NULL,
  `email` text CHARACTER SET latin1 NOT NULL,
  `telephone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.client : ~0 rows (environ)
DELETE FROM `client`;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
/*!40000 ALTER TABLE `client` ENABLE KEYS */;

-- Listage de la structure de la table madera. composant
CREATE TABLE IF NOT EXISTS `composant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` text CHARACTER SET latin1 NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `taille` text,
  `prix` float NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.composant : ~17 rows (environ)
DELETE FROM `composant`;
/*!40000 ALTER TABLE `composant` DISABLE KEYS */;
INSERT INTO `composant` (`id`, `libelle`, `quantite`, `taille`, `prix`, `dateCreate`) VALUES
	(23, 'forfait mur piece', NULL, '25m²', 1000, '2019-08-07 23:37:20'),
	(24, 'forfait mur superisolé', NULL, '25m²', 2000, '2019-08-07 23:38:09'),
	(25, 'forfait sol basique', NULL, '25m²', 500, '2019-08-07 23:38:32'),
	(26, 'forfait sol superisolé', NULL, '25m²', 2000, '2019-08-07 23:38:52'),
	(27, 'forfait plafond basique', NULL, '25m²', 500, '2019-08-07 23:42:23'),
	(28, 'forfait plafond isolé', NULL, '25m²', 1000, '2019-08-08 23:42:43'),
	(29, 'forfait charpente + toit ', NULL, NULL, 5000, '2019-08-07 23:43:55'),
	(30, 'forfait finition exterieure', NULL, NULL, 1000, '2019-08-07 23:44:22'),
	(31, 'forfait finition interieure', NULL, NULL, 1000, '2019-08-07 23:44:34'),
	(32, 'forfait finition interieure ++', NULL, NULL, 2000, '2019-08-07 23:44:34'),
	(33, 'forfait finition exterieure ++', NULL, NULL, 2000, '2019-08-07 23:44:22'),
	(34, 'forfait charpente + toit  ++', NULL, NULL, 10000, '2019-08-07 23:43:55'),
	(35, 'forfait isolant +++', NULL, NULL, 5000, '2019-08-07 23:46:05'),
	(36, 'forfait huisserie base', NULL, NULL, 1000, '2019-08-07 23:46:36'),
	(37, 'forfait husserie luxe', NULL, NULL, 10000, '2019-08-07 23:46:48'),
	(38, 'forfait plomberie base', NULL, NULL, 20000, '2019-08-07 23:47:32'),
	(39, 'forfait plomberie luxe', NULL, NULL, 50000, '2019-08-07 23:47:43');
/*!40000 ALTER TABLE `composant` ENABLE KEYS */;

-- Listage de la structure de la table madera. composantdansmodule
CREATE TABLE IF NOT EXISTS `composantdansmodule` (
  `idComposant` int(11) NOT NULL,
  `idModule` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idComposant`,`idModule`),
  KEY `FK_composantdansmodule_module` (`idModule`),
  KEY `idComposant` (`idComposant`),
  CONSTRAINT `FK_composantdansmodule_composant` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_composantdansmodule_module` FOREIGN KEY (`idModule`) REFERENCES `module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.composantdansmodule : ~4 rows (environ)
DELETE FROM `composantdansmodule`;
/*!40000 ALTER TABLE `composantdansmodule` DISABLE KEYS */;
INSERT INTO `composantdansmodule` (`idComposant`, `idModule`, `dateCreate`) VALUES
	(23, 15, '2019-08-07 23:52:37'),
	(29, 38, '2019-08-07 23:52:59'),
	(30, 28, '2019-08-07 23:53:20'),
	(38, 6, '2019-08-07 23:53:37');
/*!40000 ALTER TABLE `composantdansmodule` ENABLE KEYS */;

-- Listage de la structure de la table madera. devis
CREATE TABLE IF NOT EXISTS `devis` (
  `id` int(11) NOT NULL COMMENT 'devis id',
  `idClient` int(11) NOT NULL COMMENT 'id du client concerné',
  `idModele` int(11) NOT NULL COMMENT 'id du modèle utilisé pour le devis',
  `etat` set('accepté','en attente','refusé') CHARACTER SET latin1 NOT NULL COMMENT 'état du devis',
  `dateCreation` date NOT NULL COMMENT 'date de création du devis',
  `adresse` text NOT NULL,
  `idUserCreation` int(11) NOT NULL COMMENT 'id de l''utilisateur createur du devis',
  `dateModif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idUserModif` int(11) NOT NULL COMMENT 'id de l''utilisateur modificateur du devis',
  PRIMARY KEY (`id`),
  KEY `FK_devis_modele` (`idModele`),
  KEY `FK_devis_user` (`idUserCreation`),
  KEY `FK_devis_client` (`idClient`),
  KEY `FK_devis_user_2` (`idUserModif`),
  CONSTRAINT `FK_devis_client` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_devis_modele` FOREIGN KEY (`idModele`) REFERENCES `modele` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_devis_user` FOREIGN KEY (`idUserCreation`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_devis_user_2` FOREIGN KEY (`idUserModif`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.devis : ~0 rows (environ)
DELETE FROM `devis`;
/*!40000 ALTER TABLE `devis` DISABLE KEYS */;
/*!40000 ALTER TABLE `devis` ENABLE KEYS */;

-- Listage de la structure de la table madera. devismodulehisto
CREATE TABLE IF NOT EXISTS `devismodulehisto` (
  `id` int(11) NOT NULL,
  `idDevis` int(11) NOT NULL,
  `adresse` text,
  `typeModule` text,
  `module` text,
  `composant` text,
  `prix` text,
  PRIMARY KEY (`id`),
  KEY `Index 2` (`idDevis`),
  CONSTRAINT `FK_devismodulehisto_devis` FOREIGN KEY (`idDevis`) REFERENCES `devis` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.devismodulehisto : ~0 rows (environ)
DELETE FROM `devismodulehisto`;
/*!40000 ALTER TABLE `devismodulehisto` DISABLE KEYS */;
/*!40000 ALTER TABLE `devismodulehisto` ENABLE KEYS */;

-- Listage de la structure de la table madera. devismodules
CREATE TABLE IF NOT EXISTS `devismodules` (
  `idDevis` int(11) DEFAULT NULL,
  `idModule` int(11) DEFAULT NULL,
  KEY `FK_devisModules_devis` (`idDevis`),
  KEY `FK_devisModules_module` (`idModule`),
  CONSTRAINT `FK_devisModules_devis` FOREIGN KEY (`idDevis`) REFERENCES `devis` (`id`),
  CONSTRAINT `FK_devisModules_module` FOREIGN KEY (`idModule`) REFERENCES `module` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.devismodules : ~0 rows (environ)
DELETE FROM `devismodules`;
/*!40000 ALTER TABLE `devismodules` DISABLE KEYS */;
/*!40000 ALTER TABLE `devismodules` ENABLE KEYS */;

-- Listage de la structure de la table madera. droit
CREATE TABLE IF NOT EXISTS `droit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET latin1 NOT NULL,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `description` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.droit : ~0 rows (environ)
DELETE FROM `droit`;
/*!40000 ALTER TABLE `droit` DISABLE KEYS */;
/*!40000 ALTER TABLE `droit` ENABLE KEYS */;

-- Listage de la structure de la table madera. gamme
CREATE TABLE IF NOT EXISTS `gamme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idModeleBase` int(11) DEFAULT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_gamme_modele` (`idModeleBase`),
  CONSTRAINT `FK_gamme_modele` FOREIGN KEY (`idModeleBase`) REFERENCES `modele` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.gamme : ~3 rows (environ)
DELETE FROM `gamme`;
/*!40000 ALTER TABLE `gamme` DISABLE KEYS */;
INSERT INTO `gamme` (`id`, `libelle`, `idModeleBase`, `dateCreate`) VALUES
	(1, 'nordique', 10, '2019-08-07 23:14:24'),
	(2, 'alsacien', 11, '2019-08-07 23:14:35'),
	(3, 'océanique', 12, '2019-08-07 23:14:54');
/*!40000 ALTER TABLE `gamme` ENABLE KEYS */;

-- Listage de la structure de la table madera. modele
CREATE TABLE IF NOT EXISTS `modele` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idGamme` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_modele_gamme` (`idGamme`),
  CONSTRAINT `FK_modele_gamme` FOREIGN KEY (`idGamme`) REFERENCES `gamme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.modele : ~6 rows (environ)
DELETE FROM `modele`;
/*!40000 ALTER TABLE `modele` DISABLE KEYS */;
INSERT INTO `modele` (`id`, `libelle`, `idGamme`, `dateCreate`) VALUES
	(7, 'eco', 3, '2019-08-07 23:19:28'),
	(8, 'classe', 3, '2019-08-07 23:19:37'),
	(9, 'luxe', 3, '2019-08-07 23:19:44'),
	(10, 'basique', 1, '2019-08-07 23:22:17'),
	(11, 'basique', 2, '2019-08-07 23:22:24'),
	(12, 'basique', 3, '2019-08-07 23:22:33');
/*!40000 ALTER TABLE `modele` ENABLE KEYS */;

-- Listage de la structure de la table madera. module
CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTypeModule` int(11) NOT NULL,
  `libelle` text CHARACTER SET latin1 NOT NULL,
  `reference` text NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_module_typemodule` (`idTypeModule`),
  CONSTRAINT `FK_module_typemodule` FOREIGN KEY (`idTypeModule`) REFERENCES `typemodule` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.module : ~40 rows (environ)
DELETE FROM `module`;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` (`id`, `idTypeModule`, `libelle`, `reference`, `dateCreate`) VALUES
	(1, 1, 'cuisine basique 4 prise', 'CUI001', '2019-08-07 22:02:41'),
	(2, 1, 'cuisine equipée 12 prises', 'CUI002', '2019-08-07 22:04:57'),
	(3, 1, 'cuisine ultra connectée', 'CUI003', '2019-08-07 22:06:48'),
	(4, 1, 'cuisine lowcost', 'CUI004', '2019-08-07 22:07:08'),
	(5, 2, 'salle d\'eau lowcost', 'SDB001', '2019-08-07 22:08:32'),
	(6, 2, 'salle d\'eau avec toilettes lowcost', 'SDB002', '2019-08-07 22:08:59'),
	(7, 2, 'salle d\'eau basique', 'SDB003', '2019-08-07 22:09:25'),
	(8, 2, 'salle d\'eau basique avec toilettes', 'SDB004', '2019-08-07 22:10:03'),
	(9, 2, 'salle d\'eau equipée', 'SDB005', '2019-08-07 22:10:58'),
	(10, 2, 'salle d\'eau equipée avec toilettes', 'SDB006', '2019-08-07 22:11:16'),
	(11, 2, 'salle d\'eau connectée', 'SDB007', '2019-08-07 22:11:32'),
	(12, 2, 'salle d\'eau connectée avec toilettes', 'SDB008', '2019-08-07 22:11:53'),
	(13, 2, 'salle d\'eau luxueuse', 'SDB009', '2019-08-07 22:12:09'),
	(14, 2, 'salle d\'eau luxueuse avec toilettes', 'SDB010', '2019-08-07 22:12:37'),
	(15, 3, 'chambre lowcost', 'CHB001', '2019-08-07 22:14:32'),
	(16, 3, 'chambre basique', 'CHB002', '2019-08-07 22:15:27'),
	(17, 3, 'chambre classieuse', 'CHB003', '2019-08-07 22:16:02'),
	(18, 3, 'chambre luxueuse', 'CHB004', '2019-08-07 22:16:19'),
	(19, 3, 'chambre connectée', 'CHB005', '2019-08-07 22:16:43'),
	(20, 3, 'salon lowcost', 'SLN001', '2019-08-07 22:17:45'),
	(21, 3, 'salon basique', 'SLN002', '2019-08-07 22:18:24'),
	(22, 3, 'salon classieux', 'SLN003', '2019-08-07 22:19:08'),
	(23, 3, 'salon luxueux', 'SLN004', '2019-08-07 22:19:28'),
	(24, 4, 'toilettes lowcost', 'TOI001', '2019-08-07 22:21:36'),
	(25, 4, 'toilettes basiques', 'TOI002', '2019-08-07 22:21:58'),
	(26, 4, 'toilettes design', 'TOI003', '2019-08-07 22:22:40'),
	(27, 4, 'toilettes luxueuses', 'TOI004', '2019-08-07 22:23:20'),
	(28, 5, 'finition brute', 'FINEXT001', '2019-08-07 22:43:04'),
	(29, 5, 'finitiion crépis lowcost', 'FINEXT002', '2019-08-07 22:43:29'),
	(30, 5, 'finition crépis luxe', 'FINEXT003', '2019-08-07 22:43:44'),
	(31, 6, 'placo brut', 'FININT001', '2019-08-07 22:44:04'),
	(32, 6, 'placo peint', 'FININT002', '2019-08-07 22:44:18'),
	(33, 6, 'placo vernis', 'FININT003', '2019-08-07 22:44:49'),
	(34, 6, 'tapisserie', 'FININT004', '2019-08-07 22:45:13'),
	(35, 7, 'laine de verre', 'ISO001', '2019-08-07 22:46:19'),
	(36, 7, 'laine de roche', 'ISO002', '2019-08-07 22:46:35'),
	(37, 7, 'mouse polyestere degueu', 'ISO003', '2019-08-07 22:49:40'),
	(38, 8, 'tuile', 'CVRT001', '2019-08-07 22:50:14'),
	(39, 8, 'ardoise', 'CVRT002', '2019-08-07 22:50:33'),
	(40, 8, 'tuile ++ ', 'CRT003', '2019-08-07 22:51:18');
/*!40000 ALTER TABLE `module` ENABLE KEYS */;

-- Listage de la structure de la table madera. moduledansmodele
CREATE TABLE IF NOT EXISTS `moduledansmodele` (
  `idModele` int(11) NOT NULL,
  `idModule` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idModule`,`idModele`),
  KEY `FK_moduledansmodele_modele` (`idModele`),
  KEY `idModule` (`idModule`),
  CONSTRAINT `FK_moduledansmodele_modele` FOREIGN KEY (`idModele`) REFERENCES `modele` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_moduledansmodele_module` FOREIGN KEY (`idModule`) REFERENCES `module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.moduledansmodele : ~7 rows (environ)
DELETE FROM `moduledansmodele`;
/*!40000 ALTER TABLE `moduledansmodele` DISABLE KEYS */;
INSERT INTO `moduledansmodele` (`idModele`, `idModule`, `dateCreate`) VALUES
	(7, 4, '2019-08-07 23:28:33'),
	(7, 6, '2019-08-07 23:28:52'),
	(7, 15, '2019-08-07 23:28:05'),
	(7, 28, '2019-08-07 23:29:15'),
	(7, 31, '2019-08-07 23:30:08'),
	(7, 37, '2019-08-07 23:29:32'),
	(7, 38, '2019-08-07 23:30:37');
/*!40000 ALTER TABLE `moduledansmodele` ENABLE KEYS */;

-- Listage de la structure de la table madera. profil
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.profil : ~1 rows (environ)
DELETE FROM `profil`;
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;
INSERT INTO `profil` (`id`, `libelle`, `dateCreate`) VALUES
	(1, 'Administrateur', '2019-07-15 11:47:49');
/*!40000 ALTER TABLE `profil` ENABLE KEYS */;

-- Listage de la structure de la table madera. profilhasdroit
CREATE TABLE IF NOT EXISTS `profilhasdroit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProfil` int(11) NOT NULL,
  `idDroit` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.profilhasdroit : ~0 rows (environ)
DELETE FROM `profilhasdroit`;
/*!40000 ALTER TABLE `profilhasdroit` DISABLE KEYS */;
/*!40000 ALTER TABLE `profilhasdroit` ENABLE KEYS */;

-- Listage de la structure de la table madera. tracabilite
CREATE TABLE IF NOT EXISTS `tracabilite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTypeTracabilite` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `texte` text CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_tracabilite_user` (`idUser`),
  CONSTRAINT `FK_tracabilite_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.tracabilite : ~0 rows (environ)
DELETE FROM `tracabilite`;
/*!40000 ALTER TABLE `tracabilite` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracabilite` ENABLE KEYS */;

-- Listage de la structure de la table madera. typemodule
CREATE TABLE IF NOT EXISTS `typemodule` (
  `id` int(11) NOT NULL,
  `libelle` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.typemodule : ~9 rows (environ)
DELETE FROM `typemodule`;
/*!40000 ALTER TABLE `typemodule` DISABLE KEYS */;
INSERT INTO `typemodule` (`id`, `libelle`) VALUES
	(1, 'cuisine'),
	(2, 'salle d\'eau'),
	(3, 'piece'),
	(4, 'toilettes seules'),
	(5, 'finition ext'),
	(6, 'finition int'),
	(7, 'isolant'),
	(8, 'couverture'),
	(9, 'huiserie');
/*!40000 ALTER TABLE `typemodule` ENABLE KEYS */;

-- Listage de la structure de la table madera. type_tracabilite
CREATE TABLE IF NOT EXISTS `type_tracabilite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.type_tracabilite : ~0 rows (environ)
DELETE FROM `type_tracabilite`;
/*!40000 ALTER TABLE `type_tracabilite` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_tracabilite` ENABLE KEYS */;

-- Listage de la structure de la table madera. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id',
  `username` varchar(15) CHARACTER SET latin1 NOT NULL COMMENT 'username',
  `password` varchar(30) CHARACTER SET latin1 NOT NULL COMMENT 'encoded user password',
  `idProfile` int(11) NOT NULL COMMENT 'user''s profile id',
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_user_profil` (`idProfile`),
  CONSTRAINT `FK_user_profil` FOREIGN KEY (`idProfile`) REFERENCES `profil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table madera.user : ~1 rows (environ)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `idProfile`, `dateCreate`) VALUES
	(1, 'admin', 'admin', 1, '2019-07-15 11:48:33');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
