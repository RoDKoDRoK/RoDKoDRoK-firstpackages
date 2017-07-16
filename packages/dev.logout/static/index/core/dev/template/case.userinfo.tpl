<div class="case">

	<div class="caselineitem">
		<div class="label">User</div>
		<div class="champs">{$tabuserinfo.username}</div>
	</div>
	
	<div class="caselineitem">
		<div class="label">Mail</div>
		<div class="champs">{$tabuserinfo.usermail}</div>
	</div>
	
<!-- 
	<div class="caselineitem">
		<div class="label">Logged in</div>
		<div class="champs">{$tabuserinfo.userdatelastconnect}</div>
	</div>
-->

<form method="post" action="?page=home">	
	<div class="casebuttonzone">
		<input type="submit" name="logoutform" value="Logout" />
	</div>
</form>

</div>