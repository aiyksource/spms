<?php
	include("core/db_config.php");
	
	if($_POST){
        $searchTerm = $db->escape($_POST['searchTerm']);
	    if(empty($searchTerm) OR $searchTerm == '' OR $searchTerm ==' '){

	    } else{
		    $query = $db->get_results("SELECT * FROM tbl_org_categories  WHERE `category` LIKE '%$searchTerm%' LIMIT 5");
		    $number_of_records = $db->num_rows;
			if($number_of_records!=0){
				foreach ( $query as $result ) {
			        $category = $result->category;

			        echo '<button class="suggestedCat" onclick="auto_suggest($(this))">'.$category.'</button>';
			    }
			}
		}
	}
?>