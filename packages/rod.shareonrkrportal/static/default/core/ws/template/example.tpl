<coderesult>{$coderesult}</coderesult> 
{section name=cpt loop=$data}
<user>
	<iduser>{$data[cpt].iduser}</iduser>
	<mail>{$data[cpt].mail}</mail>
	<pwd>{$data[cpt].pwd}</pwd>
	<pseudo>{$data[cpt].pseudo}</pseudo>
	<photo>{$data[cpt].photo}</photo>
	<date_anniv>{$data[cpt].date_anniv}</date_anniv>
	<type>{$data[cpt].type}</type>
	<date_creation>{$data[cpt].date_creation}</date_creation>
	<date_last_connect>{$data[cpt].date_last_connect}</date_last_connect>
</user>
{/section}