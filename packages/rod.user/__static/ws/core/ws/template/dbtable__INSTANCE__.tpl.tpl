<coderesult>{literal}{$coderesult}{/literal}</coderesult> 
{literal}{section name=cpt loop=$data}{/literal}
<{$tablenom}>
	<id{$tablenom}>{literal}{$data[cpt].id{/literal}{$tablenom}{literal}}{/literal}</id{$tablenom}>
{if isset($columns) }
{section name=cptcolumns loop=$columns}
	<{$columns[cptcolumns].nom}>{literal}{$data[cpt].{/literal}{$columns[cptcolumns].nom}{literal}}{/literal}</{$columns[cptcolumns].nom}>
{/section}
{/if}
</{$tablenom}>
{literal}{/section}{/literal}