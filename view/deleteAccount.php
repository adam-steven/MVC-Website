<!DOCTYPE html>
<html>
	<head>
		<title>Account Deletion</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container-fluid">	
			
			<br>
			<?php include("navbar.txt"); ?>
			<br>
			
			<div class="row">
				<div class="col-sm-1"> </div>
				<div class="col-sm-10">
					<div class="border">
						<div class="main-page">
							<div class="login-form">
								<div class="inviseBorder"><h1>Verify Account</h1></div>
								
								<div class="inviseBorder">
									<br>
									<form name="login" method="post" action="../controller/accountDeletion.php"/>
										<p> Username: <input name="name" type="text" id="name"/> </p>
										<p> Email: <input name="mail" type="text" id="mail"/> </p>
										<p> Password:&nbsp;&nbsp;<input name="pass" type="password" id="pass"/> </p>
										<br><br>
										<p><button type="submit" name="ent">SUBMIT</button></p> 
									</form>

								</div>
							</div>
						</div>
					</div>	
				</div>
				<div class="col-sm-1"> </div>
			</div>
		</div>
	</body>
</html>