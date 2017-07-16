{$mailcontent}
{section name=cpt_tabdata loop=$tabdata}
<div>
	<div>{$tabdata[cpt_tabdata].label} : {$tabdata[cpt_tabdata].champs}</div>
</div>
{/section}