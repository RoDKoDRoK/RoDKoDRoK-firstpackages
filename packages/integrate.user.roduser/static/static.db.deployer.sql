SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


CREATE  TABLE IF NOT EXISTS `user` (
  `iduser` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `login_mail` VARCHAR(255) NULL ,
  `pseudo` VARCHAR(255) NULL ,
  `pwd` VARCHAR(255) NULL ,
  `lang` VARCHAR(10) NULL DEFAULT 'fr_fr',
  `date_creation` DATETIME NULL ,
  `date_last_connect` DATETIME NULL ,
  PRIMARY KEY (`iduser`) )
--  PRIMARY KEY (`iduser`,`login_mail`,`pseudo`) )
ENGINE = MyISAM;


INSERT INTO `user` (`iduser`,`login_mail`,`pseudo`,`pwd`) VALUES (NULL,'admin','admin','21232f297a57a5a743894a0e4a801fc3');





SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;