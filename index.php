<?php 
    session_start();
    include("core/db_config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>SPMS - Home</title>
	<link href="css/main.css" rel="stylesheet" type="text/css"/>
	<link href="css/index.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div class="container">
		
		<div id="main_logo"><img src="images/logo.png"></div>
		<h3 class="main_header">Staff Profile Management System</h3>
		<div id="index" class="sect-wrap">
	        <?php 
				if (isset($error)) {
					echo '<div class="error">'.$error.'</div>';
				}
				if (isset($success)) {
					echo '<div class="success">'.$success.'</div>';
				}
			?>
			<span class="sub_head">Home Page</span>
			<div id="dashboard">
				<div id="db-lhs">
					<div class="sub-db" id="genDB1">
						<a href="index.php">Home</a>
						<a href="addOrganization.php">Create Roganization</a>
						<a href="">Account</a>
					</div>
					<div class="sub-db" id="orgDB1">
						<a href="">New Post</a>
						<a href="">View Post</a>
						<a href="addMember.php">New Staff</a>
						<a href="">View Staff</a>
					</div>
					<div class="sub-db" id="adminDB1">
						<a href="">New Category</a>
						<a href="">View Categories</a>
						<a href="">View Organizations</a>
					</div>
				</div>
				<div id="db-rhs">
					<?php
					if(!isset($_SESSION['access'])){ 
						echo'
						<div id="db-rhs-innerWrap">
							<a class="a-login" href="login.php">LOG IN</a><hr>
							<span id="createAccTip"> dont have an account?</span>
						</div>
						<a href="addOrganization.php" class="button db-button">CREATE ORGANIZATION</a>';
					} else{
						$loggedinuser= $_SESSION['user'];
						$loggedinid= $_SESSION['id'];
						$loggedinaccess= $_SESSION['access'];

						if ($loggedinaccess == 3) {
							$query = $db->get_results("SELECT avatar FROM tbl_organizations  WHERE `name` = '$loggedinuser' LIMIT 1");
							$number_of_records = $db->num_rows;
							if($number_of_records!=0){
								foreach ( $query as $result ) {
									$avatar = $result->avatar;
								}
							}
							echo'<img id="loggedinuseravatar" src="'.$avatar.'"/>
							<div id="loggedinuser">Hello '.$loggedinuser.' <a href="signout.php">Log Out</a></div>';
						}
					}
					?>
				</div>
				<span class="fake"></span>
			</div>
			<div id="index-innerwrap">
				<div id="iiwrap-lhs">
					<span class="sub_head">Organizations</span>
					<input type="text" id="iiwrap-lhs-search" name="iiwrap-lhs-search" placeholder="Search"/>
					<div id="divResponse">
						<?php
							$query = $db->get_results("SELECT * FROM tbl_organizations LIMIT 5");
						    $number_of_records = $db->num_rows;
							if($number_of_records!=0){
								foreach ( $query as $result ) {
							        $id = $result->id;
							        $name = $result->name;
							        $avatar = $result->avatar;
							        $category = $result->category;
							        $staff_count = $result->staff_count;
							        $fans = $result->fans;
							        $post_count = $result->post_count;
							        $share_count = $result->share_count;

							        echo '
							        <div class="response_wrap">
							        	<div class="responseimgwrap"><img src="'.$avatar.'"/></div>
							        	<div class="responsetextwrap">
								        	<legend>'.$name.'</legend>
								        	<span>'.$category.'</span>
								        	<div class="lhsOrgStat">
									        	<span class="indiv_stat">staff<span>'.$staff_count.'</span></span>
									        	<span class="indiv_stat">fans<span>'.$fans.'</span></span>
									        	<span class="indiv_stat">posts<span>'.$post_count.'</span></span>
									        	<span class="indiv_stat">share<span>'.$share_count.'</span></span>
								        	</div>
								        </div>
								        <span class="fake"></span>
							        </div>';
							    }
							} else{
								echo '<div class="zeroOrg">no organizations found</div>';
							}
						?>
					</div>
				</div>
				<div id="iiwrap-rhs">
					
				</div>
				<span class="fake"></span>
			</div>
	    </div>
	</div>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
</body>
</html>