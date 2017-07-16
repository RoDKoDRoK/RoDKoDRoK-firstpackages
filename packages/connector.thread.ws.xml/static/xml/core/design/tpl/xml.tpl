<?xml version="1.0" encoding="utf-8" ?>
<result>

{if isset($toprint.content) }
	{section name=cptcontent loop=$toprint.content}
		{if isset($toprint.content[cptcontent].type) && $toprint.content[cptcontent].type=="subtpl" }
			{assign var="filename" value=$toprint.content[cptcontent].value}
			{assign var="chemin" value=$toprint.content[cptcontent].chemin}
			
			{if file_exists("$chemin/$filename.tpl") }
				{include file="$chemin/$filename.tpl"}
			{/if}
		{else}
			{$toprint.content[cptcontent].value}
		{/if}
	{/section}
{/if}

</result>
