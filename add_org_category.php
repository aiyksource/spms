<?php 
   if ($_POST) {
    	echo'
    	<span class="sub_head">Add a New Corporate/Business Category</span>
    	<div class="sect-wrap">
			<form method="POST" action="index.php">
				<div class="input-wrap">
					<label for="txt_org_cat">Supply Category:</label>
					<input id="txt_org_cat" name="txt_org_cat" type="text"/>
				</div><hr>
				<input type ="submit" id="sbt_org_cat" name="sbt_org_cat" class="button" value="ADD THIS CATEGORY"/>
			</form>
	    </div>
    	';
    } 
?>
