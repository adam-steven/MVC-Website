<html>
<head>
		<title>Display An Employee</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<br>
		<?php include("navbar.txt"); ?>
	<br>

	<h1>Display An Employee</h1>
	<?php
		$id = $_GET['id'] ;
	
		$requestdata -> jsonrpc = "2.0" ;
		$requestdata -> id = 1 ;
		$requestdata -> method = "getemployeebyid" ;
		$requestdata -> param -> id = $id ;
		$requesttxt = json_encode($requestdata) ;
		echo "REQUEST1" ;
		echo $requesttxt ;
		echo "REQUEST1" ;
		echo "<br/>" ;
		$url = "https://mayar.abertay.ac.uk/~g510572/week06/api/index.php" ;
	    $ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $requesttxt);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    		'Content-Type: application/json',                                                                                
    		'Content-Length: ' . strlen($requesttxt))                                                                       
		);                                                                                                                                                                                                                                       
		$responsetxt = curl_exec($ch) ;
  		if (!$responsetxt) {die('Error : "'.curl_error($ch).'" - Code: '.curl_errno($ch)); }
  		curl_close($ch) ;	
		
		
		echo "RESPONSE1" ;
		echo $responsetxt ;
		echo "RESPONSE1" ;
		echo "<br/>" ;
		echo "<br/>" ;
		
		$responsedata = json_decode($responsetxt) ;
		$err = $responsedata -> error ;
		$employeejson = $responsedata -> result ;
		
		// This is the same as before
		if ($err == NULL ) {
			echo "Employee :" ;			
			echo $employeejson ->ename ;
			echo " " ;
			echo $employeejson->ejob ;
			echo " in the ".$employeejson->edepartment." department" ;
			echo "<br/>" ;
			echo "Room " ;			
			echo $employeejson -> eroom ;
			echo " " ;
			echo "Phone " ;			
			echo $employeejson -> ephone ;
			echo " " ;
			echo "Email " ;			
			echo $employeejson -> eemail ;
			echo "<br/>" ; 
		}
		
		//echo "<a href='../view/index.html'>index.html</a>" ;
	?>  

</body>
</html>