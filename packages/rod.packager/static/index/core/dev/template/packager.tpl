<h2>{$mainsubtitle}</h2>

<div id="packagerpage">


<div id="topzone">
	<!-- <div class="checkupdatebutton">{eval var=$form.checkupdatebutton}</div> -->
	<div class="paragraphe">{$content}</div>
</div>


<div id="leftzone">
	<h3>{$data.titleelmt}</h3>
	<div id="elmtzone">
	</div>
	
	<h3>{$data.titlefile}</h3>
	<div id="filezone">
	</div>
	
	<h3>{$data.titledb}</h3>
	<div id="dbzone">
	</div>

</div>


<div id="rightzone">
	<h3>{$data.titletopack}</h3>
	<div id="topackzone">
	</div>
	{eval var=$form.chainselect}
</div>


<div id="bottomzone">
	<div class="buttonzone">
		<div class="packbutton">{eval var=$form.packbutton}</div>
			
	</div>
	
</div>


</div>
