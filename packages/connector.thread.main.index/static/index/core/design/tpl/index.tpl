<html>
<head>
<title>{if isset($maintitle) }{$maintitle}{/if}{if isset($mainsubtitle) } | {$mainsubtitle}{/if}</title>

{if isset($toprint.header) }
	{section name=cptheader loop=$toprint.header}
		{if isset($toprint.header[cptheader].type) && $toprint.header[cptheader].type=="subtpl" }
			{assign var="filename" value=$toprint.header[cptheader].value}
			{assign var="chemin" value=$toprint.header[cptheader].chemin}
			
			{if file_exists("$chemin/$filename.tpl") }
				{include file="$chemin/$filename.tpl"}
			{/if}
		{else}
			{$toprint.header[cptheader].value}
		{/if}
	{/section}
{/if}

</head>
<body>
<div id="init"></div>

{if isset($toprint.content) }
	{section name=cptcontent loop=$toprint.content}
		<div id="{$toprint.content[cptcontent].name}">
		{if isset($toprint.content[cptcontent].type) && $toprint.content[cptcontent].type=="subtpl" }
			{assign var="filename" value=$toprint.content[cptcontent].value}
			{assign var="chemin" value=$toprint.content[cptcontent].chemin}
			
			{if file_exists("$chemin/$filename.tpl") }
				{include file="$chemin/$filename.tpl"}
			{/if}
		{else}
			{$toprint.content[cptcontent].value}
		{/if}
		</div>
	{/section}
{/if}

</body>
</html>