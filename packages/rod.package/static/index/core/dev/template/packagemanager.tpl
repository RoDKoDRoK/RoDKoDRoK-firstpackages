<h2>{$mainsubtitle}</h2>

<div class="packagemanagerpage">

<div class="checkupdatebutton">{eval var=$form.checkupdatebutton}</div>
<div class="paragraphe">{$content}</div>
<br />

<div class="tabzone">
{section name=cptdata loop=$data}

	<div class="rowzone {if $data[cptdata].indeployer == '1' || $data[cptdata].lockedbyotherdepend == '1'}lockedpackage{/if} {if $data[cptdata].indeployer == '1'}blacklockedpackage{/if}">
		<div class="colzone nomcode">
			{$data[cptdata].codenamewithspace}
		</div>
		<div class="colzone title">
			{$data[cptdata].nompackage}
		</div>
		<div class="colzone description">
			{$data[cptdata].description}
		</div>
		<div class="colzone version">
			{$data[cptdata].version}
		</div>
		<!--
		<div class="colzone depend">
			{$data[cptdata].depend}
		</div>
		-->

		<div class="lastcolzone buttonzone">
			{if $data[cptdata].toupdate == '1'}
				<div class="updatebutton">{eval var=$form.updatebutton}</div>
			{/if}
			{if $data[cptdata].indeployer == '0' && $data[cptdata].lockedbyotherdepend == '0'}
				{if $data[cptdata].deployed == '1'}
					<div class="destroybutton">{eval var=$form.destroybutton}</div>
				{else}
					{if $data[cptdata].todownload == '0'}
						<div class="deploybutton">{eval var=$form.deploybutton}</div>
					{else}
						<div class="deploybutton">{eval var=$form.downloadanddeploybutton}</div>
					{/if}
				{/if}
			{/if}
		</div>
	</div>

{/section}
</div>

</div>
