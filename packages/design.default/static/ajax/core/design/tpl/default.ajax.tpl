<div class="headerajax">
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
</div>
<div class="contentajax">
{include file="{$arkitectoutput.tplpath_threadsubajax}/$page.tpl"}
</div>