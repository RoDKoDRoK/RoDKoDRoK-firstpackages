<h2>{$mainsubtitle}</h2>

<div class="deploymanagerpage">

<div class="paragraphe">{$content}</div>
<br />

<div class="tabzone">
{section name=cptdata loop=$data}

	<div class="rowzone {if $data[cptdata].deployed == '1'}blacklockedpackage{/if}">
		<div class="colzone nomcode">
			{$data[cptdata].codenamewithspace}
		</div>
		<div class="colzone title">
			{$data[cptdata].nomdeployer}
		</div>
		<div class="colzone description">
			{$data[cptdata].description}
		</div>
		<!--
		<div class="colzone version">
			{$data[cptdata].version}
		</div>
		<div class="colzone depend">
			{$data[cptdata].depend}
		</div>
		-->

		<div class="lastcolzone buttonzone">
			{if $data[cptdata].deployed == '0'}
				<div class="deploybutton">{eval var=$form.deploybutton}</div>
			{else}
				<div class="destroybutton">{eval var=$form.destroybutton}</div>
			{/if}
		</div>
	</div>

{/section}
</div>

</div>
