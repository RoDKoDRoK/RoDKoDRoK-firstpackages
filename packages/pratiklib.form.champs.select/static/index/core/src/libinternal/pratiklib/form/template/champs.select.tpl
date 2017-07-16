<select id="{$lineform.name}" name="{$lineform.name}">
{section name=cptsuggestlist loop=$lineform.suggestlist}
	<option value="{$lineform.suggestlist[cptsuggestlist].codevalue}" {if $lineform.default == $lineform.suggestlist[cptsuggestlist].codevalue} selected{/if}>{$lineform.suggestlist[cptsuggestlist].value}</option>
{/section}
</select>