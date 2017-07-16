SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';




{if $instancecour.type == "table"}

CREATE  TABLE IF NOT EXISTS `{$instancecour.name}` (
  `id{$instancecour.name}` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  
{if isset($columns) }
{section name=cptcolumns loop=$columns}
  `{$columns[cptcolumns].nom}` {$columns[cptcolumns].sqltype} NULL {if $columns[cptcolumns].sqltype != "TEXT" && $columns[cptcolumns].sqltype != "text" && $columns[cptcolumns].sqltype != "BLOB" && $columns[cptcolumns].sqltype != "blob"}DEFAULT {if $columns[cptcolumns].default == "NULL" || $columns[cptcolumns].default == "null"}NULL{else}"{$columns[cptcolumns].default}"{/if}{/if} ,
{/section}
{/if}
	
	{if isset($options.hastranslation) && $options.hastranslation == "on"}
  `lang` VARCHAR(10) NULL DEFAULT 'fr_fr',
	{/if}
	{if isset($options.hasauthor) && $options.hasauthor == "on"}
  `idauthor` BIGINT UNSIGNED NOT NULL ,
	{/if}
	{if isset($options.hasdest) && $options.hasdest == "on"}
  `iduserdest` BIGINT UNSIGNED NOT NULL ,
	{/if}
	
  PRIMARY KEY (`id{$instancecour.name}`) )
ENGINE = MyISAM;
  
  
	
	{if isset($options.historique) && $options.historique == "on"}
	
CREATE  TABLE IF NOT EXISTS `revision{$instancecour.name}` (
  `idrevision{$instancecour.name}` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `daterevision` DATETIME NULL ,

{if isset($columns) }
{section name=cptcolumns loop=$columns}
  `{$columns[cptcolumns].nom}` {$columns[cptcolumns].sqltype} NULL {if $columns[cptcolumns].sqltype != "TEXT" && $columns[cptcolumns].sqltype != "text" && $columns[cptcolumns].sqltype != "BLOB" && $columns[cptcolumns].sqltype != "blob"}DEFAULT {if $columns[cptcolumns].default == "NULL" || $columns[cptcolumns].default == "null"}NULL{else}"{$columns[cptcolumns].default}"{/if}{/if} ,
{/section}
{/if}
	
	{if isset($options.hastranslation) && $options.hastranslation == "on"}
  `lang` VARCHAR(10) NULL DEFAULT 'fr_fr',
	{/if}
	{if isset($options.hasauthor) && $options.hasauthor == "on"}
  `idauthor` BIGINT UNSIGNED NOT NULL ,
	{/if}
	{if isset($options.hasdest) && $options.hasdest == "on"}
  `iduserdest` BIGINT UNSIGNED NOT NULL ,
	{/if}
  
  `id{$instancecour.name}` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id{$instancecour.name}`) )
ENGINE = MyISAM;

	
	{/if}
	
  
  
	
	{if isset($options.comment) && $options.comment == "on"}
	
CREATE  TABLE IF NOT EXISTS `comment{$instancecour.name}` (
  `idcomment{$instancecour.name}` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `commentaire` TEXT NULL ,
  `datecommentaire` DATETIME NULL ,
  `idauthor` BIGINT UNSIGNED NOT NULL ,
  `id{$instancecour.name}` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idcomment{$instancecour.name}`) )
ENGINE = MyISAM;


	
	{/if}
	
	
	
	
	
	{if isset($options.like) && $options.like == "on"}
	
CREATE  TABLE IF NOT EXISTS `user_like_{$instancecour.name}` (
  `iduser` BIGINT UNSIGNED NOT NULL ,
  `id{$instancecour.name}` BIGINT UNSIGNED NOT NULL ,
  `like` ENUM('like','dontlike') NULL ,
  PRIMARY KEY (`iduser`, `id{$instancecour.name}`) )
ENGINE = MyISAM;
	
	{/if}
	
	
	
	
	{if isset($options.signal) && $options.signal == "on"}
	
CREATE  TABLE IF NOT EXISTS `user_signal_{$instancecour.name}` (
  `iduser` BIGINT UNSIGNED NOT NULL ,
  `id{$instancecour.name}` BIGINT UNSIGNED NOT NULL ,
  `like` ENUM('signal','alert') NULL ,
  PRIMARY KEY (`iduser`, `id{$instancecour.name}`) )
ENGINE = MyISAM;
	
	{/if}
	
	
	

{/if}















{if $instancecour.type == "link"}

{if $instancecour.name != ""}

CREATE  TABLE IF NOT EXISTS `{$instancecour.name}` (

{else}

CREATE  TABLE IF NOT EXISTS `{$instancecour.firsttable}_has_{$instancecour.secondtable}` (

{/if}

  `id{$instancecour.firsttable}` BIGINT UNSIGNED NOT NULL ,
  `id{$instancecour.secondtable}` BIGINT UNSIGNED NOT NULL ,

{if isset($columns) }  
{section name=cptcolumns loop=$columns}
  `{$columns[cptcolumns].nom}` {$columns[cptcolumns].sqltype} NULL {if $columns[cptcolumns].sqltype != "TEXT" && $columns[cptcolumns].sqltype != "text" && $columns[cptcolumns].sqltype != "BLOB" && $columns[cptcolumns].sqltype != "blob"}DEFAULT {if $columns[cptcolumns].default == "NULL" || $columns[cptcolumns].default == "null"}NULL{else}"{$columns[cptcolumns].default}"{/if}{/if} ,
{/section}
{/if}
	
  PRIMARY KEY (`id{$instancecour.firsttable}`, `id{$instancecour.secondtable}`) )
ENGINE = MyISAM;

{/if}





SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
