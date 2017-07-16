SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';





-- tables gestion droit

CREATE  TABLE IF NOT EXISTS `droit` (
  `iddroit` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nomcodedroit` VARCHAR(63) NOT NULL ,
  `nomdroit` VARCHAR(25) NULL ,
  `ordre` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`iddroit`,`nomcodedroit`) )
ENGINE = MyISAM;


INSERT INTO `droit` VALUES (NULL,'admin','Admin','1');
INSERT INTO `droit` VALUES (NULL,'user','User','90');
INSERT INTO `droit` VALUES (NULL,'public','Public','100');




CREATE  TABLE IF NOT EXISTS `elmt_has_droit` (
  `idelmt_has_droit` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idelmt` BIGINT UNSIGNED NOT NULL ,
  `elmt` VARCHAR(255) NULL ,
  `typeelmt` VARCHAR(255) NULL ,
  `iddroit` BIGINT UNSIGNED NOT NULL ,
  `nomcodedroit` VARCHAR(255) NULL ,
  PRIMARY KEY (`idelmt_has_droit`) )
--  PRIMARY KEY (`idelmt_has_droit`,`idelmt`,`elmt`,`typeelmt`,`iddroit`,`nomcodedroit`) )
ENGINE = MyISAM;


CREATE  TABLE IF NOT EXISTS `user_has_droit` (
  `iduser_has_droit` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `iduser` BIGINT UNSIGNED NOT NULL ,
  `iddroit` BIGINT UNSIGNED NOT NULL ,
  `nomcodedroit` VARCHAR(63) NOT NULL ,
  PRIMARY KEY (`iduser_has_droit`) )
ENGINE = MyISAM;






SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;