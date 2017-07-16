SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


CREATE  TABLE IF NOT EXISTS `elmt_has_param` (
  `idelmt_has_param` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idelmt` BIGINT UNSIGNED NOT NULL ,
  `elmt` VARCHAR(63) NULL ,
  `typeelmt` VARCHAR(255) NULL ,
  `idparam` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idelmt_has_param`) )
ENGINE = MyISAM;
-- tables gestion params

CREATE  TABLE IF NOT EXISTS `param` (
  `idparam` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nomcodeparam` VARCHAR(63) NOT NULL ,
  `nomparam` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `value` TEXT NULL ,
  `ordre` INT UNSIGNED NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`idparam`,`nomcodeparam`) )
ENGINE = MyISAM;



CREATE  TABLE IF NOT EXISTS `elmt_has_param` (
  `idelmt_has_param` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idelmt` BIGINT UNSIGNED NOT NULL ,
  `elmt` VARCHAR(63) NULL ,
  `typeelmt` VARCHAR(255) NULL ,
  `idparam` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idelmt_has_param`) )
ENGINE = MyISAM;




SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;