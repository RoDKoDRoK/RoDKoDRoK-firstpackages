<html>
<head>
{$css}
</head>
<body>
{if isset($arkitectoutput.pratiklib_mail) }
{include file="{$arkitectoutput.pratiklib_mail}{$arkitectoutput.ext_pratikmail_template}/$contentmailtpl.html.tpl"}
{/if}
</body>
</html>