<div class="titleleftmenu">{$zone}</div>
<div id="leftmenu">
{section name=cptdata loop=$data}
	<div class="menu"><a href="{$data[cptdata].lien}">{$data[cptdata].titre}</a></div>
{/section}
</div>
