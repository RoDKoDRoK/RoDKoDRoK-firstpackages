<h2>{literal}{$mainsubtitle}{/literal}</h2> 

{literal}{$content}{/literal}

{literal}{section name=cpt loop=$data}{/literal}
<div class="linelist">
	
	<a href="?page=formdelete{$tablenom}&id={literal}{$data[cpt].id{/literal}{$tablenom}{literal}}{/literal}">Delete {$tablenom}</a>
	<a href="?page=form{$tablenom}&id={literal}{$data[cpt].id{/literal}{$tablenom}{literal}}{/literal}&typeform=update">Update {$tablenom}</a>
	
	<div class="hiddenelmt">
		<div class="label">Id</div>
		<div class="value">{literal}{$data[cpt].id{/literal}{$tablenom}{literal}}{/literal}</div>
	</div>
	
	<div class="elmt">
		<div class="label">Pseudo</div>
		<div class="value">{literal}{$data[cpt].pseudo}{/literal}</div>
	</div>
	
	<div class="hiddenelmt">
		<div class="label">Mail</div>
		<div class="value">{literal}{$data[cpt].login_mail}{/literal}</div>
	</div>
	
	<div class="elmt">
		<div class="label">Langue</div>
		<div class="value">{literal}{$data[cpt].lang}{/literal}</div>
	</div>
	
	<div class="elmt">
		<div class="label">Droit</div>
		<div class="value">{literal}{$data[cpt].droit}{/literal}</div>
	</div>
	

{if isset($columns) }
{section name=cptcolumns loop=$columns}
	<div class="elmt">
		<div class="label">{$columns[cptcolumns].nom}</div>
		<div class="value">{literal}{$data[cpt].{/literal}{$columns[cptcolumns].nom}{literal}}{/literal}</div>
	</div>
{/section}
{/if}

</div>
{literal}{/section}{/literal}