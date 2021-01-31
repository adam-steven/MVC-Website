<!DOCTYPE html>
<htlm>
	<head>
		<title>CMP306 Cocktails</title>
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
				echo "<h1>CMP306 Cocktails</h1>";
				echo "<br>";
				
				//get all the cocktail bases from the api
				include("../model/api.php") ;
				$basetxt =  getAllBases();
				
				$basejson = json_decode($basetxt) ;
				
				$numberOfColumns = 4;
				
				//check if there is any information
				if(sizeof($basejson) > 0){
						//create the rows of the grid
						for ($i=0 ; $i<sizeof($basejson); $i += $numberOfColumns) {
						
							echo "	<div class='row'>";
							
								//create the columns of the grid
								for ($j = 0; $j < $numberOfColumns; $j++) {
									echo "<a href='drinksList.php?base=".$basejson[$j+$i] -> b_type."'>"."<div class='col-sm-3'>"."<div class='card'>"."<div class='card-header'>"."<img class='img-responsive' src='../images/".$basejson[$j+$i] -> b_image."' title='".$basejson[$j+$i] -> b_description."'>"."</div>"."<div class='card-body'>".$basejson[$j+$i] -> b_type."</div>"."</div>"."</div>"."</a>";
								}
								
							echo "</div><br>";
						}
				
				}else{//if there was no information
					echo "NO ITEMS FOUND";
				}
			?>
		</div>
		<br>
		<footer> MADE BY ADAM STEVEN. 1700431</footer>
	</body>
</html>