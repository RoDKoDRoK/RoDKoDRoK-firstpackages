{assign var="instancecour" value=$confgenerator.instancecour}

{if isset($instancecour.example) }
	{assign var="example" value=$instancecour.example}
{/if}

{if isset($instancecour.examples.example) }
	{if is_array($instancecour.columns.example) }
		{assign var="examples" value=$instancecour.examples.example}
	{else}
		{assign var="examples" value=[$instancecour.examples.example]}
	{/if}
{/if}

