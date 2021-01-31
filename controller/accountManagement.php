<?php
	//validate captch
	require_once "recaptchalib.php";
	$secret = "6Lfd-8IUAAAAAAHZOnJ0z5LaFoDlJpZn5cIE43N9";
	$response = null;
	$reCaptcha = new ReCaptcha($secret);
	
	if ($_POST["g-recaptcha-response"]) {
		$response = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]
		);
	} 

	
	session_start();
	
	include("../model/api.php") ;

	$action = $_POST['action'];
	$correct = 0;
	$error = "ERROR: ";

	foreach ($_POST as $key => $value) {
		$data -> $key = $value;
	}
	
	$datatxt = json_encode($data);
	
	//the email and password set are not null
	if(($data -> mail != "") && ($data -> pass != "")){
		//login
		if($action == "access"){
		
			$res = login($datatxt) ;
			$resjson = json_decode($res) ;
			//id the username is not null
			if($resjson[0] -> u_username != "")
			{
				$_SESSION['username'] = $resjson[0] -> u_username;
			}
			
			header("location: ../view/week4.php");
		
		//create account
		} else if($action == "create"){
			//validate the security of all user inputted fields
			if(($data -> pass == $data -> passCheck) && (filter_var($data -> mail, FILTER_VALIDATE_EMAIL)) && (preg_match("/^\d{11}$/", $data -> phone)) && $response != null && $response->success)
			{
				//create account using the api
				$res = createaccount($datatxt) ;
				header("location: ../view/week4.php");
			}
			else
			{
				header("location: ../view/accountCreation.php");
			}
		}	
	}
	else
	{
		if($action == "access"){
			header("location: ../view/index.php");
		}
		else{
			header("location: ../view/accountCreation.php");
		}
	}
?>