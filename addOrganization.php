<?php 
    if ($_POST) {
	    echo '
		<span class="sub_head">Create New Business/Corporate Organization</span>
		<div id="addMember" class="sect-wrap">
			<form method="POST" action="index.php">
				<div class="input-wrap">
					<label for="org_name">Organization:</label>
					<input id="org_name" name="org_name" type="text"/>
				</div>
				<div class="input-wrap">
					<label for="org_category">Category:</label>
					<input id="org_category" name="org_category" type="text"/>
					<div id="ul_categoriesDisplay"></div>
				</div>
				<div class="input-wrap">
					<label for="org_email">Email Address:</label>
					<input id="org_email" name="org_email" type="email"/>
				</div>
				<div class="input-wrap">
					<label for="org_password">Password:</label>
					<input id="org_password" name="org_password" type="password"/>
				</div><hr>
				<input type ="submit" id="sbt_addOrg" name="sbt_addOrg" class="button" value="CREATE ORGANIZATION"/>
			</form>
	    </div>
	    ';
	}
?>
