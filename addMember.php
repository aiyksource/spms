<?php 
    session_start();
    include("core/db_config.php");

    if (isset($_POST['sbt_addMember'])) {
       
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $access = $_POST['access'];

        if (empty($firstname) OR empty($lastname) OR empty($username) OR empty($email) OR empty($access)) {
           $error = 'all fields are required';
        } else{
            
            $db->get_results("SELECT * FROM members WHERE username = '$username' LIMIT 1");
			$number_of_records = $db->num_rows;
			if($number_of_records==0){
				$password = md5('password');
	            $db->query("INSERT INTO members (id, firstname, lastname, username, password, email, access, date_added) 
	                VALUES (NULL, '".$firstname."', '".$lastname."', '".$username."', '".$password."', '".$email."', '".$access."', ". $db->sysdate()." )");
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
        	if(isset($_SESSION['user']) && isset($_SESSION['access']) && $_SESSION['access']==1){
				$user= $_SESSION['user'];
				echo'<div id="loggedinuser">Hello '.$user.' <a href="signout.php">Log Out</a></div>';
			} else{
				header('Location:signout.php');
			} 
	    ?>
		<div id="main_logo"><img src="images/logo.png"></div>
		<h3 class="main_header">Staff Profile Management System</h3>
		<div id="addMember">
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
				<input id="firstname" name="firstname" placeholder="First Name" type="text"/>
				<input id="lastname" name="lastname" placeholder="Last Name" type="text"/>
				<input id="username" name="username" placeholder="Username" type="text"/>
				<input id="email" name="email" placeholder="Email Address" type="email"/>
				<select id="access" name="access">
					<option>---Select Member Access Level.</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select> 
				<input type ="submit" id="sbt_addMember" name="sbt_addMember" class="button" value="Add Member"/>
			</form>
	    </div>
	</div>
</body>
</html>