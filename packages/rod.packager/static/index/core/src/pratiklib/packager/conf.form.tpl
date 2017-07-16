
{$form.classicform__open}

{$form.hiddencodename}

{if $data.dependok=='0'}
	{if isset($form.lineform) && $data.deployed=='0' }
	{section name=cptlineform loop=$form.lineform}
	<div class="lineform">
		<div class="labelform">{$form.lineform[cptlineform].label}</div>
		<div class="champsform">{$form.lineform[cptlineform].champs}</div>
	</div>
	{/section}
	{/if}


	<div class="buttonzone">
	{if isset($data.update) && $data.update=='1'}
		{$form.updateconfirmbutton}
	{else}
		{if $data.deployed=='0'}
			{$form.deployconfirmbutton}
		{else}
			{$form.destroyconfirmbutton}
		{/if}
	{/if}
	</div>
{/if}

{$form.classicform__close}