{if $instancecour.type == "table"}

<h2>{literal}{$mainsubtitle}{/literal}</h2> 

{literal}{$content}{/literal}

{literal}{section name=cpt loop=$data}{/literal}
<div class="linelist">

{literal}{if isset($droit.edit) && $droit.edit==true}{/literal}	
	<a href="?page=formdelete{$tablenom}&id={literal}{$data[cpt].id{/literal}{$tablenom}{literal}}{/literal}">Delete {$tablenom}</a>
	<a href="?page=form{$tablenom}&id={literal}{$data[cpt].id{/literal}{$tablenom}{literal}}{/literal}&typeform=update">Update {$tablenom}</a>
{literal}{/if}{/literal}
	
	<div class="hiddenelmt">
		<div class="label">Id</div>
		<div class="value">{literal}{$data[cpt].id{/literal}{$tablenom}{literal}}{/literal}</div>
	</div>
	
{if isset($columns) }
{section name=cptcolumns loop=$columns}
	<div class="elmt">
		<div class="label">{$columns[cptcolumns].nom}</div>
		<div class="value">{literal}{$data[cpt].{/literal}{$columns[cptcolumns].nom}{literal}}{/literal}</div>
	</div>
{/section}
{/if}

{if isset($options.hasauthor) && $options.hasauthor == "on"}
	<div class="hiddenelmt">
		<div class="label">Author</div>
		<div class="value">{literal}{$data[cpt].idauthor}{/literal}</div>
	</div>
{/if}

{if isset($options.hasdest) && $options.hasdest == "on"}
	<div class="hiddenelmt">
		<div class="label">Userdest</div>
		<div class="value">{literal}{$data[cpt].iduserdest}{/literal}</div>
	</div>
{/if}

</div>
{literal}{/section}{/literal}

{/if}