{$mailcontent}
\n\n
{section name=cpt_tabdata loop=$tabdata}
	{$tabdata[cpt_tabdata].label} : {$tabdata[cpt_tabdata].champs}\n
{/section}