<?php 
    session_start();
    include("core/db_config.php");

    if (isset($_POST['sbt_addMember'])) {
       
        $firstname = $_POST['staff_firstname'];
        $lastname = $_POST['staff_lastname'];
        $fullname = $firstname.' '.$lastname;
        $title = $_POST['staff_title'];
        $email = $_POST['staff_email'];
        $org = $_SESSION['id'];

        if (empty($firstname) OR empty($lastname) OR empty($title) OR empty($email)) {
           $error = 'all fields are required';
        } else{
            
            $db->get_results("SELECT * FROM users WHERE email = '$email' LIMIT 1");
			$number_of_records = $db->num_rows;
			if($number_of_records==0){
				$password = md5('password');
	            if($db->query("INSERT INTO members (id, firstname, lastname, job_title, password, email, avatar, organization, access, date_added) 
	                VALUES (NULL, '".$firstname."', '".$lastname."', '".$title."', '".$password."', '".$email."', 'images/member_logo/default.jpg', '".$org."', '4', ". $db->sysdate()." )"))
	        	{
	        		if ($db->query("INSERT INTO users (id, username, email, password, access, date_added) 
	                VALUES (NULL, '".$fullname."', '".$email."',  '".$password."', '4', ". $db->sysdate()." )")) 
	            	{
	            		$staff_count = $db->get_var("SELECT staff_count FROM tbl_organizations WHERE id='$org'");
	            		$staff_count = $staff_count + 1;
	            		$update_org = $db->query("UPDATE tbl_organizations SET staff_count='$staff_count' WHERE id='$org'");
	            		$success = $firstname.' '.$lastname.' successfully added.';
	            	}
	        	}
			} else{
				$error = 'username unavailable';
			}
        }
    }

    if (isset($_POST['sbt_addOrg'])) {
       
        $org_name = $_POST['org_name'];
        $org_category = $_POST['org_category'];
        $org_email = $_POST['org_email'];
        $org_password = md5($_POST['org_password']);

        if (empty($org_name) OR empty($org_category) OR empty($org_email) OR empty($org_password)) {
           $error = 'all fields are required';
        } else{
            
            $db->get_results("SELECT * FROM users WHERE email = '$org_email' LIMIT 1");
			$number_of_records = $db->num_rows;
			if($number_of_records==0){
	            if($db->query("INSERT INTO tbl_organizations (id, name, avatar, category, description, location, links, org_password, org_email, access_key, staff_count, fans, post_count, share_count, date_added) 
	                VALUES (NULL, '".$org_name."', 'images/org_logo/default.jpg', '".$org_category."', '', '', '', '".$org_password."', '".$org_email."', '3', '0', '0', '0', '0', ". $db->sysdate()." )"))
	            {
	            	if ($db->query("INSERT INTO users (id, username, email, password, access, date_added) 
	                VALUES (NULL, '".$org_name."', '".$org_email."',  '".$org_password."', '3', ". $db->sysdate()." )")) 
	            	{
	            		$query = $db->get_results("SELECT id FROM tbl_organizations WHERE org_email = '$org_email' LIMIT 1");
	            		foreach ( $query as $result ) {
			        		$id = $result->id;
			        	}
	            		$success = $org_name.' successfully created.';
		            	$_SESSION['user'] = $org_name;
		            	$_SESSION['id'] = $id;
						$_SESSION['access'] = 3;
	            	}

	            } else{
	            	$error=$org_name." wasn\'t successfully created, try again later.";
	            }
	        	
			} else{
				$error = 'an account already exists for this email address';
			}
        }
    }

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
	<title>SPMS - Home</title>
	<link href="css/main.css" rel="stylesheet" type="text/css"/>
	<link href="css/index.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div class="container">
		
		<div id="main_logo"><img src="images/logo.png"></div>
		<h3 class="main_header">Staff Profile Management System</h3>
		<?php 
			if (isset($error)) {
				echo '<div class="error">'.$error.'</div>';
			}
			if (isset($success)) {
				echo '<div class="success">'.$success.'</div>';
			}
		?>
		<div id="index">
			<span class="sub_head">Home Page</span>
			<div id="dashboard">
				<div id="db-lhs">
					<div class="sub-db" id="genDB1">
						<a id="index_DbLink" href="index.php" class="active_DbLink">Home</a>
						<span id="addOrganization_DbLink">Create Organization</span>
						<span id="viewOrg_DbLink">View Organizations</span>
						<span id="addMember_DbLink">New Staff</span>
						<span href="">View Staff</span>
					</div>
					<div class="sub-db" id="adminDB1">
						<span id="newPost_DbLink">New Post</span>
						<span id="viewPost_DbLink">View Post</span>
						<span id="newCat_DbLink">New Category</span>
						<span id="viewCat_DbLink">View Categories</span>
						<span id="userAcc_DbLink">My Account</span>
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