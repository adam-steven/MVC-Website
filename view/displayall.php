<html>
<head>
		<title>Display All Employees</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<br>
		<?php include("navbar.txt"); ?>
	<br>

	<h1>Display All Employees</h1>
	
	<?php

		$requestdata -> jsonrpc = "2.0" ;
		$requestdata -> id = "1" ;
		$requestdata -> method = "getallemployees" ;
		$requestdata -> param = NULL ;
		$requesttxt = json_encode($requestdata) ;
		// echo "REQUEST1" ;
		// echo $requesttxt ;
		// echo "REQUEST1" ;
		// echo "<br/>" ;
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

		// echo "RESPONSE1" ;
		// echo $responsetxt ;
		// echo "RESPONSE1" ;
		// echo "<br/>" ;
		// echo "<br/>" ;
		
		$responsedata = json_decode($responsetxt) ;
		$employeejson = $responsedata -> result ;
		
		//  This is as before 
		for ($i=0 ; $i<sizeof($employeejson) ; $i++) {
			echo "Employee :" ;			
			echo "<a href=displayemployee.php?id=" ;
			echo $employeejson[$i] -> eno ;
			echo ">" ;
			echo $employeejson[$i] -> ename ;
			echo "</a><br/>" ;
		}
	?> 
</body>
</html>