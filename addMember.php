<?php 
    session_start();
    include("core/db_config.php");

    if (isset($_POST['sbt_addMember'])) {
       
        $firstname = $_POST['staff_firstname'];
        $lastname = $_POST['staff_lastname'];
        $title = $_POST['staff_title'];
        $email = $_POST['staff_email'];

        if (empty($firstname) OR empty($lastname) OR empty($title) OR empty($email)) {
           $error = 'all fields are required';
        } else{
            
            $db->get_results("SELECT * FROM members WHERE username = '$username' LIMIT 1");
			$number_of_records = $db->num_rows;
			if($number_of_records==0){
				$password = md5('password');
	            $db->query("INSERT INTO members (id, firstname, lastname, username, password, email, access, date_added) 
	                VALUES (NULL, '".$firstname."', '".$lastname."', '".$title."', '".$password."', '".$email."', '4', ". $db->sysdate()." )");
	        	$success = $firstname.' '.$lastname.' successfully added.';
			} else{
				$error = 'username unavailable';
			}
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>SPMS - New Member</title>
	<link href="css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div class="container">
		<?php 
        	if(isset($_SESSION['user']) && isset($_SESSION['access'])){
				if( $_SESSION['access']==1 OR $_SESSION['access']==3){
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
			<span class="sub_head">Add New Member</span>
			<form id="addMember_form" method="POST" action="addMember.php">
<<<<<<< HEAD
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
=======
				<input id="firstname" name="firstname" placeholder="First Name" type="text"/>
				<input id="lastname" name="lastname" placeholder="Last Name" type="text"/>
				<input id="username" name="username" placeholder="Username" type="text"/>
				<input id="email" name="email" placeholder="Email Address" type="email"/>
				<select id="access" name="access">
					<option>---Select An Access Level</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select> 
				<input type ="submit" id="sbt_addMember" name="sbt_addMember" class="button" value="Add Member"/>
>>>>>>> origin/master
			</form>
	    </div>
	</div>
</body>
</html>
