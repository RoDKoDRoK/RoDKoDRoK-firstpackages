<div id="search">{$search}</div>
<h2>{$mainsubtitle}</h2>

<div class="packagemanagerpage">

<div class="checkbutton">{eval var=$form.checkupdatebutton}</div>
<div class="checkbutton">{eval var=$form.checkreversebutton}</div>
<div class="paragraphe">{$content}</div>
<br />
{$pager}
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
			{if $data[cptdata].toupdate == '1' || $data[cptdata].toupdate == '3'}
				<div class="updatebutton">{eval var=$form.updatebutton}</div>
				{if $data[cptdata].localdev == '1'}<span style='color:#971212'>Warning before updating from RoDKoDRoK portal : Your personal dev version is already deployed for this package !!</span>{/if}
			{/if}
			{if $data[cptdata].toupdate == '2' || $data[cptdata].toupdate == '3'}
				<div class="updatebutton">{eval var=$form.updatelocalbutton}</div>
			{/if}
			{if $data[cptdata].indeployer == '0' && $data[cptdata].lockedbyotherdepend == '0'}
				{if $data[cptdata].deployed == '1'}
					<div class="destroybutton">{eval var=$form.destroybutton}</div>
					<div class="destroybutton">{eval var=$form.totaldestroybutton}</div>
				{else}
					{if $data[cptdata].todownload == '0'}
						<div class="deploybutton">{eval var=$form.deploybutton}</div>
						<div class="destroybutton">{eval var=$form.totaldestroybutton}</div>
					{else}
						<div class="deploybutton">{eval var=$form.downloadanddeploybutton}</div>
					{/if}
				{/if}
			{/if}
			{if $data[cptdata].deployed == '1'}
				{if $data[cptdata].reverse == '1'}
					<div class="reversebutton">{eval var=$form.reversebutton}</div>
				{/if}
				{if $data[cptdata].localreverse == '1'}
					<div class="reversebutton">{eval var=$form.localreversebutton}</div>
				{/if}
			{else}
				{if $data[cptdata].todownload == '1'}
					{if $data[cptdata].reverse == '1'}
						<div class="reversebutton">{eval var=$form.downloadolderversionanddeploybutton}</div>
					{/if}
					{if $data[cptdata].localreverse == '1'}
						<div class="reversebutton">{eval var=$form.deploylocalolderversionbutton}</div>
					{/if}
				{/if}
			{/if}
		</div>
	</div>

{/section}
</div>

{$pager}

</div>
