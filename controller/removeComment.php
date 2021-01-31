<?php
	include("../model/api.php") ;
	
	$data -> c_id = $_POST['commentID'];
	$data -> drink = $_POST['drinkName'];

	$datatxt = json_encode($data);
	
	//insure that there is a comment id
	if($data -> c_id != ""){
		
		//delete the comment usings the api
		$res = delectCommentById($datatxt);

	}
	
	header("location: ../view/week2.php?drink=".$data -> drink);

?>