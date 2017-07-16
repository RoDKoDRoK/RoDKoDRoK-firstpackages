{if $instancecour.type == "table"}

"coderesult": "{literal}{$coderesult}{/literal}", 
{literal}{section name=cpt loop=$data}{/literal}
"{$tablenom}": {literal}{{/literal}
	"id{$tablenom}": "{literal}{$data[cpt].id{/literal}{$tablenom}{literal}}{/literal}",
{if isset($columns) }
{section name=cptcolumns loop=$columns}
	"{$columns[cptcolumns].nom}": "{literal}{$data[cpt].{/literal}{$columns[cptcolumns].nom}{literal}}{/literal}",
{/section}
{/if}

{if isset($options.hasauthor) && $options.hasauthor == "on"}
	"idauthor": {literal}{$data[cpt].idauthor}{/literal}",
	"nomauthor": {literal}{$data[cpt].nomauthor}{/literal}"
{/if}

{literal}}{/literal}
{literal}{/section}{/literal}

{/if}