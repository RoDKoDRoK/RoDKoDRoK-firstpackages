{assign scope=parent var="instancecour" value=$confgenerator.instancecour}

{if isset($instancecour.options) }
	{assign scope=parent var="options" value=$instancecour.options}
{/if}

{if isset($instancecour.columns.column) }
	{if is_array($instancecour.columns.column) && isset($instancecour.columns.column.0) }
		{assign scope=parent var="columns" value=$instancecour.columns.column}
	{else}
		{assign scope=parent var="columns" value=[$instancecour.columns.column]}
	{/if}
{/if}

