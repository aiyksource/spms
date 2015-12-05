<?php 
    if ($_POST) {
    	echo'
			<span class="sub_head">Add New Staff</span>
			<div id="addMember" class="sect-wrap">
				<form id="addMember_form" method="POST" action="index.php">
					<div class="input-wrap">
						<label for="staff_firstname">First Name:</label>
						<input id="staff_firstname" name="staff_firstname" type="text"/>
					</div>
					<div class="input-wrap">
						<label for="staff_lastname">Last Name:</label>
						<input id="staff_lastname" name="staff_lastname" type="text"/>
					</div>
					<div class="input-wrap">
						<label for="staff_title">Job Title:</label>
						<input id="staff_title" name="staff_title" type="text"/>
					</div>
					<div class="input-wrap">
						<label for="staff_email">Email Address:</label>
						<input id="staff_email" name="staff_email" type="email"/>
					</div><hr>
					<input type ="submit" id="sbt_addMember" name="sbt_addMember" class="button" value="ADD THIS STAFF"/>
				</form>
		    </div>
		';
    }
?>
