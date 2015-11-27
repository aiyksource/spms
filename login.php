<?php
	session_start();
	include("core/db_config.php");

	if (isset($_SESSION['access'])) {
		header('Location:signout.php');
	}

	if (isset($_POST['sbt_login'])) {
		
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		if (!empty($username) && !empty($password)) {
			$query = $db->get_row("SELECT username, access FROM members WHERE username = '".$username."' AND password = '".$password."'");
			if($query == 1){
				$username = $query->username;
				$access = $query->access;
				if (!empty($username) AND !empty($password)) {
					$_SESSION['user'] = $username;
					$_SESSION['access'] = $access;
					 
					$db->disconnect();
					header('Location:index.php');
				}
			} else{
				$error = 'Wrong login credentials!';
			}
		} else{
			$error = "All fields are required";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>SPMS</title>
	<link href="css/main.css" rel="stylesheet" type="text/css"/>
	<link href="css/login.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div class="container">
		<div id="main_logo"><img src="images/logo.png"></div>
		<h3 class="main_header">Staff Profile Management System</h3>
		<div id="login_wrapper">
			<?php 
				if (isset($error)) {
					echo '<div class="error">'.$error.'</div>';
				}
			?>
			<span class="sub_head">System Log In</span>
			<form id="login_form" method="POST" action="login.php">
				<div class="input-wrap">
					<label for="username">Username or Email:</label>
					<input id="username" name="username" type="text"/>
				</div>
				<div class="input-wrap">
					<label for="password">Password:</label>
					<input id="password" name="password" placeholder="Password" type="password"/>
				</div>
				<input type ="submit" id="sbt_login" name="sbt_login" class="button" value="Log In"/>
			</form>
		</div>
	</div>
</body>
</html>