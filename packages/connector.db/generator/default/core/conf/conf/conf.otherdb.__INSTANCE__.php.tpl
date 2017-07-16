<?php

{if $confgenerator.instancecour.name != "rodkodrokdb"}

	$conf['{$confgenerator.instancecour.name}']['moteurbd']='{$confgenerator.instancecour.moteurbd}';

	
	$conf['database']['{$confgenerator.instancecour.name}']['host']='{$confgenerator.instancecour.host}';
	
	$conf['database']['{$confgenerator.instancecour.name}']['login']='{$confgenerator.instancecour.login}';
	$conf['database']['{$confgenerator.instancecour.name}']['pwd']='{$confgenerator.instancecour.pwd}';
	
	$conf['database']['{$confgenerator.instancecour.name}']['bd']='{$confgenerator.instancecour.schema}';
	
	$conf['database']['{$confgenerator.instancecour.name}']['indexloaded']='yes';
	$conf['database']['{$confgenerator.instancecour.name}']['ajaxloaded']='yes';
	$conf['database']['{$confgenerator.instancecour.name}']['wsloaded']='yes';
	$conf['database']['{$confgenerator.instancecour.name}']['terminalloaded']='yes';
	$conf['database']['{$confgenerator.instancecour.name}']['cronloaded']='yes';
	
{/if}

?>