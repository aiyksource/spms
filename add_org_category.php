<?php 
    session_start();
    include("core/db_config.php");

    if (isset($_POST['sbt_org_cat'])) {
       
        $txt_org_cat = $_POST['txt_org_cat'];
        $addad_by = $_SESSION['user'];

        if (empty($txt_org_cat)) {
           $error = 'Kindly key in the category in the provide text box.';
        } else{
            
            $db->get_results("SELECT * FROM tbl_org_categories WHERE category = '$txt_org_cat' LIMIT 1");
			$number_of_records = $db->num_rows;
			if($number_of_records==0){
	            $db->query("INSERT INTO tbl_org_categories (id, category, added_by, date_added) 
	                VALUES (NULL, '".$txt_org_cat."', '".$addad_by."', ". $db->sysdate()." )");
	        	$success = $txt_org_cat.' successfully added.';
			} else{
				$error = 'the specified category already exists on the system.';
			}
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>SPMS - New Category</title>
	<link href="css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div class="container">
		<?php 
        	if(isset($_SESSION['user']) && isset($_SESSION['access'])){
				if( $_SESSION['access']==1){
					$user= $_SESSION['user'];
					echo'<div id="loggedinuser">Hello '.$user.' <a href="signout.php">Log Out</a></div>';
				} else{
					header('Location:signout.php');
				}
			} else{
				header('Location:signout.php');
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
			<span class="sub_head">Add a New Corporate/Business Category</span>
			<form method="POST" action="add_org_category.php">
				<div class="input-wrap">
					<label for="txt_org_cat">Supply Category:</label>
					<input id="txt_org_cat" name="txt_org_cat" type="text"/>
				</div><hr>
				<input type ="submit" id="sbt_org_cat" name="sbt_org_cat" class="button" value="ADD THIS CATEGORY"/>
			</form>
	    </div>
	</div>
</body>
</html>