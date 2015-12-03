<?php
	include("core/db_config.php");
	
	if($_POST){
        $searchTerm = $db->escape($_POST['searchTerm']);
	    if(empty($searchTerm) OR $searchTerm == '' OR $searchTerm ==' '){
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
	    } else{
		    $query = $db->get_results("SELECT * FROM tbl_organizations  WHERE `name` LIKE '$searchTerm%' LIMIT 5");
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
		}
	}
?>