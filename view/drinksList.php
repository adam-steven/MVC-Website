<!DOCTYPE html>
<htlm>
	<head>
		<title>Drinks List</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class='container-fluid'>
			<br>
		
			<?php
				//display the navbar
				include("navbar.txt");
				echo "<br>";
				
				//get the base from the URL
				$base = $_GET["base"];
			
				//with the base, get all the drinks that use that base from the api
				include("../model/api.php") ;
				$drinktxt =  getDrinksForBase($base);
				
				$drinkjson = json_decode($drinktxt) ;
				
				//check if any information was retrieved
				if (sizeof($drinkjson) > 0) {
						//display each retrieved drink 
						for ($i=0 ; $i<sizeof($drinkjson); $i++) {
						
							echo "<div class='row'>";
							echo "<a href='week2.php?drink=".$drinkjson[$i] -> d_name."'>"."<div class='col-sm' style='border-style: solid;'>"."<h2>".$drinkjson[$i] -> d_name."</h2>"."</div>"."</a>";
							echo "</div>";
							echo "<br>";
						}
				
				} else {//if no information was retrieved
					echo "NO ITEMS FOUND";
				}
			?>
		</div>
		<br>
		<footer> MADE BY ADAM STEVEN. 1700431</footer>
	</body>
</html>