<?php
	session_start();
	$user = $_SESSION['username'];
	
	include("../model/api.php") ;

	$data -> name = $_POST['name'];
	$data -> mail = $_POST['mail'];
	$data -> pass = $_POST['pass'];

	$datatxt = json_encode($data);
	
	//validate the username, email and password the user inputted
	if(($data -> name == $user) && 	($data -> mail != "") && ($data -> pass != "")){
		
		$res = deleteAccount($datatxt) ;
		
		//check if the account was sucessfully deleted
		if($res > 0)
		{
			$_SESSION['username'] = "";
		}
		
		var_dump($res);
	}
	
	header("location: ../view/week4.php");

?>