<div class="titlerightmenu">{$zone}</div>
<div id="rightmenu">
{section name=cptdata loop=$data}
	<div class="menu"><a href="{$data[cptdata].lien}">{$data[cptdata].titre}</a></div>
{/section}
</div>
