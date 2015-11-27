<?php 
    session_start();
    include("core/db_config.php");

    if (isset($_POST['sbt_addOrg'])) {
       
        $org_name = $_POST['org_name'];
        $org_category = $_POST['org_category'];
        $org_email = $_POST['org_email'];
        $org_password = md5($_POST['org_password']);

        if (empty($org_name) OR empty($org_category) OR empty($org_email) OR empty($org_password)) {
           $error = 'all fields are required';
        } else{
            
            $db->get_results("SELECT * FROM tbl_organizations WHERE org_email = '$org_email' LIMIT 1");
			$number_of_records = $db->num_rows;
			if($number_of_records==0){
	            if($db->query("INSERT INTO tbl_organizations (id, name, logo, category, description, location, links, org_password, org_email, access_key, date_added) 
	                VALUES (NULL, '".$org_name."', 'images/org_logo/default.jpg', '".$org_category."', '', '', '', '".$org_password."', '".$org_email."', '3', ". $db->sysdate()." )"))
	            {
	            	$success = $org_name.' successfully created.';
	            	$_SESSION['user'] = $org_name;
					$_SESSION['access'] = 3;
	            } else{
	            	$error=$org_name." wasn\'t successfully created, try again later.";
	            }
	        	
			} else{
				$error = 'an account already exists for this email address';
			}
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>SPMS - New Organization</title>
	<link href="css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div class="container">
		<?php 
        	if(isset($_SESSION['user']) && isset($_SESSION['access'])){
				$user= $_SESSION['user'];
				echo'<div id="loggedinuser">Hello '.$user.' <a href="signout.php">Log Out</a></div>';
			}
	    ?>
		<div id="main_logo"><img src="images/logo.png"></div>
		<h3 class="main_header">Staff Profile Management System</h3>
		<div id="addMember" class="sect-wrap">
	        <?php 
				if (isset($error)) {
					echo '<div class="error">'.$error.'</div>';
				}
				if (isset($success)) {
					echo '<div class="success">'.$success.'</div>';
				}
			?>
			<span class="sub_head">Create New Business/Corporate Organization</span>
			<form id="addMember_form" method="POST" action="addOrganization.php">
				<div class="input-wrap">
					<label for="org_name">Organization:</label>
					<input id="org_name" name="org_name" type="text"/>
				</div>
				<div class="input-wrap"><?php //like a search box which outputs sugestions as the user types a category?>
					<label for="org_category">Category:</label>
					<input id="org_category" name="org_category" type="text"/>
					<ul id="ul_categoriesDisplay"></ul>
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
	</div>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/categorySuggest.js"></script>
</body>
</html>