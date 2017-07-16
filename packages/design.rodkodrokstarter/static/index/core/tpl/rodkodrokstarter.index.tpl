<html>
<head>
<title>{if isset($maintitle) }{$maintitle}{/if}{if isset($mainsubtitle) } | {$mainsubtitle}{/if}</title>

{if isset($toprint.header) }
	{section name=cptheader loop=$toprint.header}
		{if isset($toprint.header[cptheader].type) && $toprint.header[cptheader].type=="subtpl" }
			{assign var="filename" value=$toprint.header[cptheader].value}
			{assign var="chemin" value=$toprint.header[cptheader].chemin}
			
			{if file_exists("$chemin$filename.tpl") }
				{include file="$chemin$filename.tpl"}
			{/if}
		{else}
			{$toprint.header[cptheader].value}
		{/if}
	{/section}
{/if}
</head>
<body>
<div id="init"></div>

<div id="site">
<!-- //tpl header -->
{if file_exists("{$arkitectoutput.tplpath_designheaderfooter}/$header.tpl") }
	{include file="{$arkitectoutput.tplpath_designheaderfooter}/$header.tpl"}
{/if}
<!-- //...tpl header -->

<div id="maincontent">
	<div id="message">{$message}</div>
	<div id="content">{include file="{$arkitectoutput.tplpath_threadmainindex}/$page.tpl"}</div>
</div>

<!-- //tpl footer -->
{if file_exists("{$arkitectoutput.tplpath_designheaderfooter}/$footer.tpl") }
	{include file="{$arkitectoutput.tplpath_designheaderfooter}/$footer.tpl"}
{/if}
<!-- //...tpl footer -->
</div>

</body>
</html>