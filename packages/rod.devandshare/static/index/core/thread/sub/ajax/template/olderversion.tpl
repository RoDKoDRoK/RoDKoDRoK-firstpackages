<div class="ajaxloaded">
<div class='title'>{$windowtitle}</div>
<div class='text'>{$windowcontent}</div>

{$form.classicform__open}

{if isset($form.lineform) }
	{section name=cptlineform loop=$form.lineform}
	<div class="lineform">
		<div class="labelform">{$form.lineform[cptlineform].label}</div>
		<div class="champsform">{$form.lineform[cptlineform].champs}</div>
	</div>
	{/section}
{/if}


	<div class="buttonzone">
		{if isset($data.reverse) && $data.reverse == '1' }
			{$form.reverseafterselectbutton}
		{else}
			{$form.deployolderversionafterselectbutton}
		{/if}
	</div>

{$form.classicform__close}

</div>