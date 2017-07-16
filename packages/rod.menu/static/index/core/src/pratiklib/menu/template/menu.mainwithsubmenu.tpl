<div id="mainmenu">
{section name=cptdata loop=$data}
	<div class="menu"><a href="{$data[cptdata].lien}">{$data[cptdata].titre}</a></div>

	<div class="mainssmenu">
	{section name=cptssmenu loop=$data[cptdata].ssmenu}
		<div class="ssmenu"><a href="{$data[cptdata].ssmenu[cptssmenu].lien}">{$data[cptdata].ssmenu[cptssmenu].titre}</a></div>
	{/section}
	</div>

{/section}
</div>
