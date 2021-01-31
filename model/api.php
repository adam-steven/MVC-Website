<?php
	// Connect to database
	include("../model/connection.php");
	$db = new dbObj();
	$conn =  $db->getConnstring();
	
	//get all the cocktail bases from the database
	function getAllBases()
	{
		global $conn;
		$sql = "SELECT * FROM COCKTAIL_BASES";
		$result = mysqli_query($conn, $sql);
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows);
	}
	
	//get all drinks from the database with a given base
	function getDrinksForBase($base)
	{
		global $conn;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT * FROM COCKTAIL_DRINKS WHERE d_base = ?" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $base);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows);
	}
	
	//get the article from the database about a given drink
	function getArticleByDrink($drink)
	{
		global $conn;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT * FROM COCKTAIL_ARTICLES WHERE a_drink = ?" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $drink);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows);
	}
	
	//get a images for an aritcle form the database
	function getImagesByDrink($drink)
	{
		global $conn;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT * FROM COCKTAIL_IMAGES WHERE i_drink = ?" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $drink);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows);
	}
	
	//check if the users login credentials are in the database 
	function login($datatxt)
	{	
		global $conn;
		$data = json_decode($datatxt) ;
		
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT * FROM COCKTAIL_USERS WHERE u_email = ?" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $u_email);
		
		$u_email = $data -> mail ;
		
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
		
			if(password_verify($data -> pass, $r["u_password"]))
			{
				$rows[] = $r;
			}
		}
		return json_encode($rows);
	}
	
	//insert an account into the database
	function createaccount($datatxt)
	{		
		global $conn;
		$data = json_decode($datatxt) ;
			
		$stmt = $conn->prepare("insert into COCKTAIL_USERS (u_username, u_password, u_email, u_phone) values (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $u_username, $u_password, $u_email, $u_phone);
		$u_username = $data -> user ;
		$u_password = password_hash($data -> pass, PASSWORD_DEFAULT, ['cost' => 15]);
		$u_email = $data -> mail ;
		$u_phone = $data -> phone;
		
		$res = $stmt->execute();
		$res = $stmt->insert_id ;
		
		return $res;
	}
	
	//get all comments made on an article from the database
	function getCommentsByArticleDrink($drink)
	{
		global $conn;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT a_id FROM COCKTAIL_ARTICLES WHERE a_drink = ?" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $drink);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		while($r = mysqli_fetch_assoc($result)) {
    		$aritcalID = $r["a_id"];
		}
		
		$sql = "SELECT c_id, c_user, c_comment FROM COCKTAIL_COMMENTS WHERE c_articleID = ?" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $aritcalID);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		
		return json_encode($rows);
	}
	
	//insert a comment to the database referncing the user who sent it and the artile its on
	function commentOnArticle($datatxt)
	{
		global $conn;
		$data = json_decode($datatxt) ;
		
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT a_id FROM COCKTAIL_ARTICLES WHERE a_drink = ?" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $drink);
		$drink = $data -> drink;
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		while($r = mysqli_fetch_assoc($result)) {
    		$aritcalID = $r["a_id"];
		}
		

		$stmt = $conn->prepare("insert into COCKTAIL_COMMENTS (c_id, c_user, c_articleID, c_comment) values (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $c_id, $c_user, $c_articleID, $c_comment);
		$c_id = "";
		$c_user = $data -> c_user;
		$c_articleID = $aritcalID; 
		$c_comment = $data -> c_comment;
		
		$res = $stmt->execute();
		$res = $stmt->insert_id ;
		
		return $res;
	}
	
	//removing a comment from the database
	function delectCommentById($datatxt)
	{
		global $conn;
		$data = json_decode($datatxt) ;
			
		$stmt = mysqli_stmt_init($conn);
		$sql = "DELETE FROM COCKTAIL_COMMENTS WHERE c_id = ?" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		$id = $data -> c_id;
		mysqli_stmt_execute($stmt);
		
		return;
	}
	
	//removing an account from the database
	function deleteAccount($datatxt)
	{
		global $conn;
		$data = json_decode($datatxt) ;
		
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT * FROM COCKTAIL_USERS WHERE u_email = ?" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $u_email);
		
		$u_email = $data -> mail ;
		
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
		
			if(password_verify($data -> pass, $r["u_password"]))
			{
				$rows[] = $r;
			}
		}

		if(count($rows) > 0){
			$sql = "DELETE FROM COCKTAIL_USERS WHERE u_email = ? " ;
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, 's', $email);
			$email = $data -> mail;
			mysqli_stmt_execute($stmt);
		}
		
		return count($rows);
	}

?>