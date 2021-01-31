<!DOCTYPE html>
<htlm>
	<head>
		<title>Account</title>
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
					<div class='border'>
						<div class='main-page'>
							<div class='login-form'>
							<?php 
								//get the session
								session_start();
								$user = $_SESSION['username'];

								//if there isn't a session, display the login form 
								if($user == ""){
									echo "<h1>Login</h1>";
									echo "<br>";
									echo "<form name='login' method='post' action='../controller/accountManagement.php'/>";
									echo 	"<div id='inputs'>";
									echo 		"<p> Email: <input name='mail' type='text' id='mail' /></p>";
									echo		"<p> Password:&nbsp;&nbsp;<input name='pass' type='password' id='pass' /></p>";
									echo		"<p> <input type='hidden' name='action' value='access'> </p>";
									echo	"</div>";
									echo	"<br><br>";
									echo	"<p><input type='submit' id='ent' value='Login'/> <button id='newAccountButton'><a href='accountCreation.php' id='newAccount'>Create Account</a></button></p>";
									echo "</form>";
								}else{ //if there is, display the user's username
									echo "<h1>".$user."</h1>";
									echo "<button id='LogoutButton'><a href='../controller/logout.php'>Logout</a></button> <button id='LogoutButton'><a href='deleteAccount.php'>Delete Account</a></button>";
								}
							?>
							</div>
						</div>
					</div>
				</div>
				<div class='col-sm-1'> </div>
			</div>
		</div>
		<br>
		<footer> MADE BY ADAM STEVEN. 1700431</footer>
	</body>
</html>