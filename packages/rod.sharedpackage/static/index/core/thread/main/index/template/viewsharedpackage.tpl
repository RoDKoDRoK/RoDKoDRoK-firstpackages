			
	
				

	

<h2>{$mainsubtitle}</h2> 

{$content}

{section name=cpt loop=$data}
<div class="linelist">

{if isset($droit.edit) && $droit.edit==true}
	<a href="?page=formdeletesharedpackage&id={$data[cpt].idsharedpackage}">Delete shared package</a>
	<a href="?page=formsharedpackage&id={$data[cpt].idsharedpackage}&typeform=update">Update shared package</a>
{/if}

	<div class="hiddenelmt">
		<div class="label">Id</div>
		<div class="value">{$data[cpt].idsharedpackage}</div>
	</div>
	
	<div class="elmt">
		<div class="label">nomcodesharedpackage</div>
		<div class="value">{$data[cpt].nomcodesharedpackage}</div>
	</div>
	<div class="elmt">
		<div class="label">nomsharedpackage</div>
		<div class="value">{$data[cpt].nomsharedpackage}</div>
	</div>
	<div class="elmt">
		<div class="label">groupe</div>
		<div class="value">{$data[cpt].groupe}</div>
	</div>
	<div class="elmt">
		<div class="label">mainimg</div>
		<div class="value">{$data[cpt].mainimg}</div>
	</div>
	<div class="elmt">
		<div class="label">datecreate</div>
		<div class="value">{$data[cpt].datecreate}</div>
	</div>
	<div class="elmt">
		<div class="label">datemodif</div>
		<div class="value">{$data[cpt].datemodif}</div>
	</div>
	<div class="elmt">
		<div class="label">text</div>
		<div class="value">{$data[cpt].text}</div>
	</div>
	<div class="elmt">
		<div class="label">externallink</div>
		<div class="value">{$data[cpt].externallink}</div>
	</div>

	<div class="hiddenelmt">
		<div class="label">Author</div>
		<div class="value">{$data[cpt].idauthor}</div>
	</div>


</div>
{/section}


