-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.11 - MySQL Community Server (GPL)
-- SE du serveur:                Win32
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour madera
DROP DATABASE IF EXISTS `madera`;
CREATE DATABASE IF NOT EXISTS `madera` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `madera`;

-- Listage de la structure de la table madera. adresse
DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voie` text CHARACTER SET latin1 NOT NULL,
  `adresse` text CHARACTER SET latin1 NOT NULL,
  `numero` int(11) NOT NULL,
  `codePostal` varchar(5) CHARACTER SET latin1 NOT NULL,
  `ville` text CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. adresse_histo
DROP TABLE IF EXISTS `adresse_histo`;
CREATE TABLE IF NOT EXISTS `adresse_histo` (
  `id` int(11) NOT NULL DEFAULT '0',
  `voie` text CHARACTER SET latin1 NOT NULL,
  `adresse` text CHARACTER SET latin1 NOT NULL,
  `numero` int(11) NOT NULL,
  `codePostal` varchar(5) CHARACTER SET latin1 NOT NULL,
  `ville` text CHARACTER SET latin1 NOT NULL,
  `idAdresse` int(11) NOT NULL,
  `dateCreate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_adresse_histo_adresse` (`idAdresse`),
  CONSTRAINT `FK_adresse_histo_adresse` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. cctp
DROP TABLE IF EXISTS `cctp`;
CREATE TABLE IF NOT EXISTS `cctp` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. client
DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text CHARACTER SET latin1 NOT NULL,
  `email` text CHARACTER SET latin1 NOT NULL,
  `telephone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idAdresse` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_client_adresse` (`idAdresse`),
  CONSTRAINT `FK_client_adresse` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. client_histo
DROP TABLE IF EXISTS `client_histo`;
CREATE TABLE IF NOT EXISTS `client_histo` (
  `id` int(11) NOT NULL DEFAULT '0',
  `nom` text CHARACTER SET latin1 NOT NULL,
  `email` text CHARACTER SET latin1 NOT NULL,
  `telephone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idAdresseHisto` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_client_histo_adresse` (`idAdresseHisto`),
  KEY `FK_client_histo_client` (`idClient`),
  CONSTRAINT `FK_client_histo_adresse` FOREIGN KEY (`idAdresseHisto`) REFERENCES `adresse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_client_histo_client` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. composant
DROP TABLE IF EXISTS `composant`;
CREATE TABLE IF NOT EXISTS `composant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idFournisseur` int(11) NOT NULL,
  `idUniteUsage` int(11) NOT NULL,
  `idFamilleComposant` int(11) NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `qualite` int(11) NOT NULL,
  `prix` float NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_composant_fournisseur` (`idFournisseur`),
  KEY `FK_composant_unite` (`idUniteUsage`),
  KEY `FK_composant_fammillecomposant` (`idFamilleComposant`),
  CONSTRAINT `FK_composant_fammillecomposant` FOREIGN KEY (`idFamilleComposant`) REFERENCES `fammillecomposant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_composant_fournisseur` FOREIGN KEY (`idFournisseur`) REFERENCES `fournisseur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_composant_unite` FOREIGN KEY (`idUniteUsage`) REFERENCES `unite` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. composantdansmodule
DROP TABLE IF EXISTS `composantdansmodule`;
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

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. composantprix
DROP TABLE IF EXISTS `composantprix`;
CREATE TABLE IF NOT EXISTS `composantprix` (
  `id` int(11) NOT NULL,
  `idComposant` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idComposantHisto` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_composantprix_composant` (`idComposant`),
  KEY `FK_composantprix_composant_histo` (`idComposantHisto`),
  CONSTRAINT `FK_composantprix_composant` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_composantprix_composant_histo` FOREIGN KEY (`idComposantHisto`) REFERENCES `composant_histo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. composant_histo
DROP TABLE IF EXISTS `composant_histo`;
CREATE TABLE IF NOT EXISTS `composant_histo` (
  `id` int(11) NOT NULL DEFAULT '0',
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idFournisseur` int(11) NOT NULL,
  `idUniteUsage` int(11) NOT NULL,
  `idFamilleComposant` int(11) NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `qualite` int(11) NOT NULL,
  `prix` float NOT NULL,
  `idComposant` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_composant_histo_fournisseur` (`idFournisseur`),
  KEY `FK_composant_histo_unite` (`idUniteUsage`),
  KEY `FK_composant_histo_fammillecomposant` (`idFamilleComposant`),
  KEY `FK_composant_histo_composant` (`idComposant`),
  CONSTRAINT `FK_composant_histo_composant` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_composant_histo_fammillecomposant` FOREIGN KEY (`idFamilleComposant`) REFERENCES `fammillecomposant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_composant_histo_fournisseur` FOREIGN KEY (`idFournisseur`) REFERENCES `fournisseur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_composant_histo_unite` FOREIGN KEY (`idUniteUsage`) REFERENCES `unite` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. devis
DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `id` int(11) NOT NULL COMMENT 'devis id',
  `idModele` int(11) NOT NULL COMMENT 'id du modèle utilisé pour le devis',
  `dateCreation` date NOT NULL COMMENT 'date de création du devis',
  `idUserCreation` int(11) NOT NULL COMMENT 'id de l''utilisateur createur du devis',
  `reference` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'référence du devis : format date du jour+ numeroDevisDuJour + id user (YYYYMMJJ-NNN-IDD',
  `idClient` int(11) NOT NULL COMMENT 'id du client concerné',
  `etat` set('acceptée','en attente','refusée') CHARACTER SET latin1 NOT NULL COMMENT 'état du devis',
  `dateModif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idUserModif` int(11) NOT NULL COMMENT 'id de l''utilisateur modificateur du devis',
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. devis_histo
DROP TABLE IF EXISTS `devis_histo`;
CREATE TABLE IF NOT EXISTS `devis_histo` (
  `id` int(11) NOT NULL COMMENT 'devis id',
  `idModeleHisto` int(11) NOT NULL COMMENT 'id du modèle utilisé pour le devis',
  `dateFixage` date NOT NULL COMMENT 'date de création du devis',
  `idUserCreation` int(11) NOT NULL COMMENT 'id de l''utilisateur createur du devis',
  `reference` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'référence du devis : format date du jour+ numeroDevisDuJour + id user (YYYYMMJJ-NNN-IDD',
  `idClientHisto` int(11) NOT NULL COMMENT 'id du client concerné',
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_devis_histo_modele_histo` (`idModeleHisto`),
  KEY `FK_devis_histo_user` (`idUserCreation`),
  KEY `FK_devis_histo_client` (`idClientHisto`),
  CONSTRAINT `FK_devis_histo_client` FOREIGN KEY (`idClientHisto`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_devis_histo_modele_histo` FOREIGN KEY (`idModeleHisto`) REFERENCES `modele_histo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_devis_histo_user` FOREIGN KEY (`idUserCreation`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. droit
DROP TABLE IF EXISTS `droit`;
CREATE TABLE IF NOT EXISTS `droit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET latin1 NOT NULL,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `description` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. fammillecomposant
DROP TABLE IF EXISTS `fammillecomposant`;
CREATE TABLE IF NOT EXISTS `fammillecomposant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. finitionexterieure
DROP TABLE IF EXISTS `finitionexterieure`;
CREATE TABLE IF NOT EXISTS `finitionexterieure` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. fournisseur
DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAdresse` int(11) NOT NULL,
  `telephone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `email` text CHARACTER SET latin1 NOT NULL,
  `nom` varchar(20) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_fournisseur_adresse` (`idAdresse`),
  CONSTRAINT `FK_fournisseur_adresse` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. gamme
DROP TABLE IF EXISTS `gamme`;
CREATE TABLE IF NOT EXISTS `gamme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idModeleBase` int(11) DEFAULT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_gamme_modele` (`idModeleBase`),
  CONSTRAINT `FK_gamme_modele` FOREIGN KEY (`idModeleBase`) REFERENCES `modele` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. mesure
DROP TABLE IF EXISTS `mesure`;
CREATE TABLE IF NOT EXISTS `mesure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTypeMesure` int(11) NOT NULL,
  `idComposant` int(11) NOT NULL,
  `idModule` int(11) NOT NULL,
  `valeur` double NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_mesure_typemesure` (`idTypeMesure`),
  KEY `FK_mesure_composant` (`idComposant`),
  KEY `FK_mesure_module` (`idModule`),
  CONSTRAINT `FK_mesure_composant` FOREIGN KEY (`idComposant`) REFERENCES `composant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_mesure_module` FOREIGN KEY (`idModule`) REFERENCES `module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_mesure_typemesure` FOREIGN KEY (`idTypeMesure`) REFERENCES `typemesure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. modele
DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idFinitionExterieure` int(11) NOT NULL,
  `idTypeIsolant` int(11) NOT NULL,
  `idTypeCouverture` int(11) NOT NULL,
  `qualiteHuisserie` int(11) NOT NULL,
  `idGamme` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_modele_finitionexterieure` (`idFinitionExterieure`),
  KEY `FK_modele_typeisolant` (`idTypeIsolant`),
  KEY `FK_modele_typecouverture` (`idTypeCouverture`),
  KEY `FK_modele_gamme` (`idGamme`),
  CONSTRAINT `FK_modele_finitionexterieure` FOREIGN KEY (`idFinitionExterieure`) REFERENCES `finitionexterieure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modele_gamme` FOREIGN KEY (`idGamme`) REFERENCES `gamme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modele_typecouverture` FOREIGN KEY (`idTypeCouverture`) REFERENCES `typecouverture` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modele_typeisolant` FOREIGN KEY (`idTypeIsolant`) REFERENCES `typeisolant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. modele_histo
DROP TABLE IF EXISTS `modele_histo`;
CREATE TABLE IF NOT EXISTS `modele_histo` (
  `id` int(11) NOT NULL DEFAULT '0',
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idFinitionExterieure` int(11) NOT NULL,
  `idTypeIsolant` int(11) NOT NULL,
  `idTypeCouverture` int(11) NOT NULL,
  `qualiteHuisserie` int(11) NOT NULL,
  `idGamme` int(11) NOT NULL,
  `idModele` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_modele_histo_finitionexterieure` (`idFinitionExterieure`),
  KEY `FK_modele_histo_typeisolant` (`idTypeIsolant`),
  KEY `FK_modele_histo_typecouverture` (`idTypeCouverture`),
  KEY `FK_modele_histo_gamme` (`idGamme`),
  KEY `FK_modele_histo_modele` (`idModele`),
  CONSTRAINT `FK_modele_histo_finitionexterieure` FOREIGN KEY (`idFinitionExterieure`) REFERENCES `finitionexterieure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modele_histo_gamme` FOREIGN KEY (`idGamme`) REFERENCES `gamme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modele_histo_modele` FOREIGN KEY (`idModele`) REFERENCES `modele` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modele_histo_typecouverture` FOREIGN KEY (`idTypeCouverture`) REFERENCES `typecouverture` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_modele_histo_typeisolant` FOREIGN KEY (`idTypeIsolant`) REFERENCES `typeisolant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. module
DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idTypeModule` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_module_typemodule` (`idTypeModule`),
  CONSTRAINT `FK_module_typemodule` FOREIGN KEY (`idTypeModule`) REFERENCES `typemodule` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. moduledansmodele
DROP TABLE IF EXISTS `moduledansmodele`;
CREATE TABLE IF NOT EXISTS `moduledansmodele` (
  `idModule` int(11) NOT NULL,
  `idModele` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idModule`,`idModele`),
  KEY `FK_moduledansmodele_modele` (`idModele`),
  KEY `idModule` (`idModule`),
  CONSTRAINT `FK_moduledansmodele_modele` FOREIGN KEY (`idModele`) REFERENCES `modele` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_moduledansmodele_module` FOREIGN KEY (`idModule`) REFERENCES `module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. module_histo
DROP TABLE IF EXISTS `module_histo`;
CREATE TABLE IF NOT EXISTS `module_histo` (
  `id` int(11) NOT NULL DEFAULT '0',
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idTypeModule` int(11) NOT NULL,
  `idModule` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. profil
DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. profilhasdroit
DROP TABLE IF EXISTS `profilhasdroit`;
CREATE TABLE IF NOT EXISTS `profilhasdroit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProfil` int(11) NOT NULL,
  `idDroit` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. tracabilite
DROP TABLE IF EXISTS `tracabilite`;
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

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. typecoupeprincipe
DROP TABLE IF EXISTS `typecoupeprincipe`;
CREATE TABLE IF NOT EXISTS `typecoupeprincipe` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. typecouverture
DROP TABLE IF EXISTS `typecouverture`;
CREATE TABLE IF NOT EXISTS `typecouverture` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. typeisolant
DROP TABLE IF EXISTS `typeisolant`;
CREATE TABLE IF NOT EXISTS `typeisolant` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. typemesure
DROP TABLE IF EXISTS `typemesure`;
CREATE TABLE IF NOT EXISTS `typemesure` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `idUnite` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_typemesure_unite` (`idUnite`),
  CONSTRAINT `FK_typemesure_unite` FOREIGN KEY (`idUnite`) REFERENCES `unite` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. typemodule
DROP TABLE IF EXISTS `typemodule`;
CREATE TABLE IF NOT EXISTS `typemodule` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `iduniteUsage` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_typemodule_unite` (`iduniteUsage`),
  CONSTRAINT `FK_typemodule_unite` FOREIGN KEY (`iduniteUsage`) REFERENCES `unite` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. type_tracabilite
DROP TABLE IF EXISTS `type_tracabilite`;
CREATE TABLE IF NOT EXISTS `type_tracabilite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. unite
DROP TABLE IF EXISTS `unite`;
CREATE TABLE IF NOT EXISTS `unite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET latin1 NOT NULL,
  `abreviation` varchar(5) CHARACTER SET latin1 NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table madera. user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id',
  `username` varchar(15) CHARACTER SET latin1 NOT NULL COMMENT 'username',
  `password` varchar(30) CHARACTER SET latin1 NOT NULL COMMENT 'encoded user password',
  `idProfile` int(11) NOT NULL COMMENT 'user''s profile id',
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_user_profil` (`idProfile`),
  CONSTRAINT `FK_user_profil` FOREIGN KEY (`idProfile`) REFERENCES `profil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
