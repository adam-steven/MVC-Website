<?php	
	include("../model/api.php") ;
	
	$data -> c_comment = $_POST['commentText'];
	$data -> c_user = $_POST['username'];
	$data -> drink = $_POST['drinkName'];

	$datatxt = json_encode($data) ;

	//validate that the user, comment and drink sent are not null
	if($data -> c_user != "" && $data -> c_comment != "" && $data -> drink != ""){
		//add comment using the api
		$res = commentOnArticle($datatxt) ;
	}

	header("location: ../view/week2.php?drink=".$data -> drink);
?>