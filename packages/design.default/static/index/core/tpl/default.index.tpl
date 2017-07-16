<html>
<head>
<title>{$maintitle} | {$mainsubtitle}</title>
{$lib}
{$css}
{$js}
</head>
<body>
<div id="init"></div>

<!-- //tpl header -->
<div id="header">
{if file_exists("core/design/template/$header.tpl") }
	{include file="core/design/template/$header.tpl"}
{/if}
</div>
<!-- //...tpl header -->

<div id="maincontent">
	<div id="message">{$message}</div>
	<div id="content">{include file="core/dev/template/$page.tpl"}</div>
</div>

<!-- //tpl footer -->
<div id="footer">
{if file_exists("core/design/template/$footer.tpl") }
	{include file="core/design/template/$footer.tpl"}
{/if}
</div>
<!-- //...tpl footer -->

</body>
</html>