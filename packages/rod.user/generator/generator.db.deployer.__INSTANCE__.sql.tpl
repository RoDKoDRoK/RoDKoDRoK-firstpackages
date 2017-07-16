SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



CREATE  TABLE IF NOT EXISTS `{$instancecour.name}` (
  `id{$instancecour.name}` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `login_mail` VARCHAR(255) NULL ,
  `pseudo` VARCHAR(255) NULL ,
  `pwd` VARCHAR(255) NULL ,
  `lang` VARCHAR(10) NULL DEFAULT 'fr_fr',
  `droit` ENUM('admin','user','bloque','supprime'

{if isset($droits) }
{section name=cptuserdroits loop=$droits}
  ,'{$droits[cptuserdroits]}'
{/section}
{/if}
	
  ) NULL ,
  `date_creation` DATETIME NULL ,
  `date_last_connect` DATETIME NULL ,
  `token` TEXT NULL ,

{if isset($columns) }
  {section name=cptcolumns loop=$columns}
    `{$columns[cptcolumns].nom}` {$columns[cptcolumns].sqltype} NULL {if $columns[cptcolumns].sqltype != "TEXT" && $columns[cptcolumns].sqltype != "text" && $columns[cptcolumns].sqltype != "BLOB" && $columns[cptcolumns].sqltype != "blob"}DEFAULT {if $columns[cptcolumns].default == "NULL" || $columns[cptcolumns].default == "null"}NULL{else}"{$columns[cptcolumns].default}"{/if}{/if} ,
  {/section}
{/if}
	
  PRIMARY KEY (`id{$instancecour.name}`,`login_mail`,`pseudo`) )
ENGINE = MyISAM;


INSERT INTO `{$instancecour.name}` (`id{$instancecour.name}`,`login_mail`,`pseudo`,`pwd`,`droit`) VALUES (NULL,'admin','admin','21232f297a57a5a743894a0e4a801fc3','admin');

	
	{if isset($options.socialnetwork) && $options.socialnetwork == "on"}

CREATE  TABLE IF NOT EXISTS `{$instancecour.name}_relation` (
  `id{$instancecour.name}` BIGINT UNSIGNED NOT NULL ,
  `id{$instancecour.name}_dest` BIGINT UNSIGNED NOT NULL ,
  `statut` ENUM(
  
{section name=cptrelations loop=$relations}
	'{$relations[cptrelations]}','{$relations[cptrelations]}_en_attente','{$relations[cptrelations]}_annule'
{/section}

	,'bloque') NULL ,
  PRIMARY KEY (`id{$instancecour.name}`, `id{$instancecour.name}_dest`) ) 
ENGINE = MyISAM;
	
	{/if}
	



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
