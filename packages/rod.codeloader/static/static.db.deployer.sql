SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



-- tables gestion codeloader

CREATE  TABLE IF NOT EXISTS `codesrc` (
  `idcodesrc` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nomcodecodesrc` VARCHAR(63) NOT NULL ,
  `nomcodesrc` VARCHAR(255) NULL ,
  `typecodesrc` VARCHAR(63) NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`idcodesrc`,`nomcodecodesrc`) )
ENGINE = MyISAM;


CREATE  TABLE IF NOT EXISTS `chainloadcodesrc` (
  `idchainloadcodesrc` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idchain` BIGINT UNSIGNED NOT NULL ,
  `idcodesrc` BIGINT UNSIGNED NOT NULL ,
  `cptconnectorcall` INT UNSIGNED NOT NULL DEFAULT '0',
  `ordre` INT UNSIGNED NOT NULL DEFAULT '0',
  `actif` INT UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`idchainloadcodesrc`) )
ENGINE = MyISAM;




SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;