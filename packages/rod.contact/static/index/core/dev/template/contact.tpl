<h1>{$mainsubtitle}</h1>

{$content}

{$form.startform}

{if isset($form.lineform) }
{section name=cptlineform loop=$form.lineform}
<div class="lineform">
	<div class="labelform">{$form.lineform[cptlineform].label}</div>
	<div class="champsform">{$form.lineform[cptlineform].champs}</div>
</div>
{/section}
{/if}


<div class="buttonzone">
{$form.submitbutton}
{$form.cancelbutton}
</div>

{$form.endform}
