SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';




{if $instancecour.type == "table"}

DROP TABLE IF EXISTS `{$instancecour.name}` ;

  
  
	
	{if isset($options.historique) && $options.historique == "on"}
	
	
DROP TABLE IF EXISTS `revision{$instancecour.name}` ;


	
	{/if}
	
  
  
	
	{if isset($options.comment) && $options.comment == "on"}
	

DROP TABLE IF EXISTS `comment{$instancecour.name}` ;



	
	{/if}
	
	
	
	
	
	{if isset($options.like) && $options.like == "on"}
	
	
DROP TABLE IF EXISTS `user_like_{$instancecour.name}` ;

	
	{/if}
	
	
	
	
	{if isset($options.signal) && $options.signal == "on"}
	
	
DROP TABLE IF EXISTS `user_signal_{$instancecour.name}` ;

	
	{/if}
	
	
	

{/if}















{if $instancecour.type == "link"}

{if $instancecour.name != ""}

DROP TABLE IF EXISTS `{$instancecour.name}` ;

{else}

DROP TABLE IF EXISTS `{$instancecour.firsttable}_has_{$instancecour.secondtable}` ;

{/if}


{/if}





SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
