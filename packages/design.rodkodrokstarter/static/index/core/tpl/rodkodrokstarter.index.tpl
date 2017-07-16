<html>
<head>
<title>{$maintitle} | {$mainsubtitle}</title>
{$lib}
{$css}
{$js}
</head>
<body>
<div id="init"></div>

<div id="site">
<!-- //tpl header -->
{if file_exists("core/design/template/$header.tpl") }
	{include file="core/design/template/$header.tpl"}
{/if}
<!-- //...tpl header -->

<div id="maincontent">
	<div id="message">{$message}</div>
	<div id="content">{include file="core/dev/template/$page.tpl"}</div>
</div>

<!-- //tpl footer -->
{if file_exists("core/design/template/$footer.tpl") }
	{include file="core/design/template/$footer.tpl"}
{/if}
<!-- //...tpl footer -->
</div>

</body>
</html>