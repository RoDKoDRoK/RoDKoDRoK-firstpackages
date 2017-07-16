{assign scope=parent var="instancecour" value=$confgenerator.instancecour}

{if isset($confgenerator.instancecour.options) }
	{assign scope=parent var="options" value=$confgenerator.instancecour.options}
{/if}

{if isset($instancecour.usercolumns.column) }
	{if is_array($instancecour.usercolumns.column) && isset($instancecour.usercolumns.column.0) }
		{assign scope=parent var="columns" value=$instancecour.usercolumns.column}
	{else}
		{assign scope=parent var="columns" value=[$instancecour.usercolumns.column]}
	{/if}
{/if}

{if isset($instancecour.userdroits.droit) }
	{if is_array($instancecour.userdroits.droit) && isset($instancecour.userdroits.droit.0) }
		{assign scope=parent var="droits" value=$instancecour.userdroits.droit}
	{else}
		{assign scope=parent var="droits" value=[$instancecour.userdroits.droit]}
	{/if}
{/if}

{if isset($instancecour.socialnetworkrelations.relation) }
	{if is_array($instancecour.socialnetworkrelations.relation) && isset($instancecour.socialnetworkrelations.relation.0) }
		{assign scope=parent var="relations" value=$instancecour.socialnetworkrelations.relation}
	{else}
		{assign scope=parent var="relations" value=[$instancecour.socialnetworkrelations.relation]}
	{/if}
{/if}

