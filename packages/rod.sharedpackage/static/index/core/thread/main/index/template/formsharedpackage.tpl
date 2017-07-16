			
	
				

	


<h2>{$mainsubtitle}</h2>

{$content}

{$form.classicform__open}

{$form.hiddenid}

{if isset($form.lineform) }
{section name=cptlineform loop=$form.lineform}
<div class="lineform">
	{if $form.lineform[cptlineform].hiddenlabel != "on"}
		<div class="labelform">{$form.lineform[cptlineform].label}</div>
	{/if}
	<div class="champsform">{$form.lineform[cptlineform].champs}</div>
</div>
{/section}
{/if}


<div class="buttonzone">
{$form.submitbutton}
{$form.cancelbutton}
{$form.backbutton}
</div>

{$form.classicform__close}



