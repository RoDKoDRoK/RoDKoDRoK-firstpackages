SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `rodframework` ;
CREATE SCHEMA IF NOT EXISTS `rodframework` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `rodframework` ;






DROP TABLE IF EXISTS `rodframework`.`user` ;

CREATE  TABLE IF NOT EXISTS `rodframework`.`user` (
  `iduser` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `login_mail` VARCHAR(255) NULL ,
  `pseudo` VARCHAR(255) NULL ,
  `pwd` VARCHAR(255) NULL ,
  `lang` VARCHAR(10) NULL DEFAULT 'fr_fr',
  `droit` ENUM('admin','user','bloque','supprime'
  
  	
  ) NULL ,
  `date_creation` DATETIME NULL ,
  `date_last_connect` DATETIME NULL ,
  `token` TEXT NULL ,
  
		
  PRIMARY KEY (`iduser`) )
ENGINE = MyISAM;


	
		
  









DROP TABLE IF EXISTS `rodframework`.`news` ;

CREATE  TABLE IF NOT EXISTS `rodframework`.`news` (
  `idnews` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  
		
  `titre` varchar(999) NULL DEFAULT "" ,
	
		
  `texte` varchar(999) NULL DEFAULT "" ,
	
		
  `date` varchar(999) NULL DEFAULT "" ,
	
		  `lang` VARCHAR(10) NULL DEFAULT 'fr_fr',
		  `idauthor` BIGINT UNSIGNED NOT NULL ,
			
  PRIMARY KEY (`idnews`) )
ENGINE = MyISAM;
  
  
	
		
	
DROP TABLE IF EXISTS `rodframework`.`revisionnews` ;

CREATE  TABLE IF NOT EXISTS `rodframework`.`revisionnews` (
  `idrevisionnews` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `date` DATETIME NULL ,
	
		
  `titre` varchar(999) NULL DEFAULT "" ,
	
		
  `texte` varchar(999) NULL DEFAULT "" ,
	
		
  `date` varchar(999) NULL DEFAULT "" ,
	
		  `lang` VARCHAR(10) NULL DEFAULT 'fr_fr',
		  `idauthor` BIGINT UNSIGNED NOT NULL ,
		  
  `idnews` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idnews`) )
ENGINE = MyISAM;

	
		
  
  
	
		

DROP TABLE IF EXISTS `rodframework`.`commentnews` ;

CREATE  TABLE IF NOT EXISTS `rodframework`.`commentnews` (
  `idcommentnews` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `commentaire` TEXT NULL ,
  `date` DATETIME NULL ,
  `idauthor` BIGINT UNSIGNED NOT NULL ,
  `idnews` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idcommentnews`) )
ENGINE = MyISAM;


	
		
	
	
	
	
		
	
	
	
		
	
	























DROP TABLE IF EXISTS `rodframework`.`menu` ;

CREATE  TABLE IF NOT EXISTS `rodframework`.`menu` (
  `idmenu` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `zone` VARCHAR(255) NULL ,
  `titre` VARCHAR(255) NULL ,
  `lien` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `lang` VARCHAR(10) NULL DEFAULT 'fr_fr',
  `ordre` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idmenu`) )
ENGINE = MyISAM;


DROP TABLE IF EXISTS `rodframework`.`menu_has_ssmenu` ;

CREATE  TABLE IF NOT EXISTS `rodframework`.`menu_has_ssmenu` (
  `idmenu` BIGINT UNSIGNED NOT NULL ,
  `idssmenu` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idmenu`,`idssmenu`) )
ENGINE = MyISAM;


INSERT INTO `rodframework`.`menu` VALUES (NULL,'main','Home','?page=home','Home','fr_fr','1');
INSERT INTO `rodframework`.`menu` VALUES (NULL,'main','Example','?page=example','Example','fr_fr','2');




DROP TABLE IF EXISTS `rodframework`.`mail` ;

CREATE  TABLE IF NOT EXISTS `rodframework`.`mail` (
  `idmail` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(255) NULL ,
  `objet` VARCHAR(255) NULL ,
  `texte` TEXT NULL ,
  `lang` VARCHAR(10) NULL DEFAULT 'fr_fr',
  PRIMARY KEY (`idmail`) )
ENGINE = MyISAM;

INSERT INTO `rodframework`.`mail` VALUES (NULL,'alert','Alerte','Un changement a été effectué sur le site. Connectez-vous!','fr_fr');




DROP TABLE IF EXISTS `rodframework`.`colonne` ;

CREATE  TABLE IF NOT EXISTS `rodframework`.`colonne` (
  `idcolonne` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nomcolonne` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`idcolonne`) )
ENGINE = MyISAM;


DROP TABLE IF EXISTS `rodframework`.`colonne_has_case` ;

CREATE  TABLE IF NOT EXISTS `rodframework`.`colonne_has_case` (
  `idcolonne` BIGINT UNSIGNED NOT NULL ,
  `idcase` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idcolonne`,`idcase`) )
ENGINE = MyISAM;


DROP TABLE IF EXISTS `rodframework`.`case` ;

CREATE  TABLE IF NOT EXISTS `rodframework`.`case` (
  `idcase` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nomcase` VARCHAR(255) NULL ,
  PRIMARY KEY (`idcase`) )
ENGINE = MyISAM;

INSERT INTO `rodframework`.`case` (`idcase`,`nomcase`) VALUES (NULL,'auth');
INSERT INTO `rodframework`.`case` VALUES (NULL,'userinfo');
INSERT INTO `rodframework`.`case` VALUES (NULL,'lang');




SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;