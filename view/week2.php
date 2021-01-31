<!DOCTYPE html>
<htlm>
	<head>
		<title>Article</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class='container-fluid'>
			<br>
			<?php include("navbar.txt"); ?>
			<br>
			<div class='row'>
				<div class='col-sm-1'> </div>
				<div class='col-sm-10'>
					<?php 		
						//get the session information
						session_start();
						$user = $_SESSION['username'];
					
						//get the drink from the URL
						$drink = $_GET["drink"];
						
						//with the drink, get the needed text information for the article from the api
						include("../model/api.php") ;
						$articletxt =  getArticleByDrink($drink);
						
						$articlejson = json_decode($articletxt);
						
						//check if any acticle information was retrieve 
						if (sizeof($articlejson) > 0) {
						
							echo "<div class='col-sm'>"."<h1>".$articlejson[0] -> a_drink."</h1> written by ".$articlejson[0] -> a_author."</div>";
							
							echo "<br><br>";
							
							echo "</div>";
							echo "<div class='col-sm-1'> </div>";
							echo "</div>";
							
							echo "<div class='row'>";
								echo "<div class='col-sm-13'>";
									//with the drink, get any article images from the api
									$imagestxt = getImagesByDrink($drink);
									$imagesjson = json_decode($imagestxt);
									
									//check if there is any images to display
									if (sizeof($imagesjson) > 0) {
										echo"<div id='myCarousel' class='carousel slide' data-ride='carousel'>";
											echo"<div class='carousel-inner'>";
										  
											echo"<div class='item active'>";
											  echo"<center><img class='img-responsive' src='../images/".$imagesjson[0] -> i_image."'><center>";
											echo"</div>";
											
											//check is there is 2 images 
											if (sizeof($imagesjson) > 1) {
												echo"<div class='item'>";
												  echo"<center><img class='img-responsive' src='../images/".$imagesjson[1] -> i_image."'><center>";
												echo"</div>";
											}
											
											//check is there is 3 images 
											if (sizeof($imagesjson) > 2) {
												echo"<div class='item'>";
												  echo"<center><img class='img-responsive' src='../images/".$imagesjson[2] -> i_image."'><center>";
												echo"</div>";
											}
											
											echo"</div>";
										  
											echo"<a class='left carousel-control' href='#myCarousel' data-slide='prev'>";
												echo"<span class='glyphicon glyphicon-chevron-left'></span>";
											echo"</a>";
											echo"<a class='right carousel-control' href='#myCarousel' data-slide='next'>";
												echo"<span class='glyphicon glyphicon-chevron-right'></span>";
											echo"</a>";
										echo"</div>";
									}
								
								echo "</div>";
							echo "</div>";
							
							echo "<div class='row'>";
								echo "<div class='col-sm-1'> </div>";
								echo "<div class='col-sm-10'>";
							
								echo "<br><br>";
								echo "<div class='col-sm'>".$articlejson[0] -> a_ingredients."</div>";
								echo "<br>";
								echo "<div class='col-sm'>".$articlejson[0] -> a_recipe."</div>";
								
								echo "<br>";
								echo "<h2>Comments</h2>";
								
								//check if the user if logged in from the session retrieved 
								if($user != "")	{
									echo "<form name='comment' method='post' action='../controller/commentManagement.php'/>";
									echo 	"<div id='inputs'>";
									echo 		"<input name='commentText' type='text' id='commentText' />";
									echo		"<input type='hidden' name='username' value='".$user."'>";
									echo		"<input type='hidden' name='drinkName' value='".$drink."'>";
									echo	"</div>";
									echo	"<input type='submit' id='ent' value='Submit'/>";
									echo "</form>";
								}
								else //if the user is not logged in
								{
									echo "Please Login To Add A Comment";
								}

								echo "<br><br>";
								
								//with the drink, get all the comment that were made on the article from the api								
								$commentstxt = getCommentsByArticleDrink($drink);
								$commentsjson = json_decode($commentstxt);
								
								//check if there is any comments 
								if(sizeof($commentsjson) > 0)
								{
									echo "<table class='table table-bordered'>";
										echo "<thead>";
											echo "<tr>";
												echo "<th>User</th>";
												echo "<th>Comment</th>";
												echo "<th></th>";
											echo "</tr>";
										echo "</thead>";
									
										echo "<tbody>";
											//display all the comments and how made them in a table
											for($i = 0; $i < sizeof($commentsjson); $i++)
											{
												echo "<tr>";
													echo "<td>".$commentsjson[$i] -> c_user."</td>";
													echo "<td>".$commentsjson[$i] -> c_comment."</td>";
												//check if the user made the comment
												if($commentsjson[$i] -> c_user == $user){
													echo "<td><center>";
													echo "<form name='remove' method='post' action='../controller/removeComment.php'/>";
													echo 	"<div id='inputs'>";
													echo		"<input type='hidden' name='commentID' value='".$commentsjson[$i] -> c_id."'>";
													echo		"<input type='hidden' name='drinkName' value='".$drink."'>";
													echo	"</div>";
													echo	"<input type='submit' id='delete' value='Delete'/>";
													echo "</form>";
													echo "</center></td>";
												}
												else //if the user did not make the comment 
													echo "<td></td>";
											}
										echo "</tbody>";
									echo "</table>";
								}
								else //if there are no comments on this article 
									echo "<p>No Comments Found</p>";
								
						} else { //if no article was found 
							echo "NO ITEMS FOUND";
						}
						
					?>
					</div>
					<div class='col-sm-1'> </div>
					</div>
				</div>
				<div class='col-sm-1'> </div>
			</div>
		</div>
		<br>
		<footer> MADE BY ADAM STEVEN. 1700431</footer>
	</body>
</html>