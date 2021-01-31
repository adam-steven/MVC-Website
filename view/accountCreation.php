<!DOCTYPE html>
<html>
	<head>
		<title>Account Creation</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
		<script type="text/javascript" src="scripts.js"></script>
		
		<link rel="stylesheet" type= "text/css" href="styles.css">
	</head>
	<body ng-app="myapp">
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
								<div class="inviseBorder"><h1>Create Account</h1></div>
								
								<div class="inviseBorder">
									<br>
									<form name="login" method="post" action="../controller/accountManagement.php"/>
										<p> Username: <input name="user" type="text" id="user"/></p>
										<div id="mailIndecator"></div>
										<p> Email: <input name="mail" type="text" id="mail" onchange='check_email()'/> </p>
										<div id="phoneIndecator"></div>
										<p> Phone Number: <input name="phone" type="text" id="phone" onchange='check_phonenumber()'/> </p>
										<div ng-controller="PasswordController">
											<div id="passwordStrength"></div>
											<p> Password:&nbsp;&nbsp;<input name="pass" ng-model="password" ng-change="analyze(password)" type="password" id="pass" onchange='check_pass()'/> </p>
										</div>
										<div id="passCheckIndecator"></div>
										<p> Confirm Password: &nbsp;&nbsp;<input name="passCheck" type="password" id="passCheck" onchange='check_pass()'/> </p>
										<p><div class="g-recaptcha" data-sitekey="6Lfd-8IUAAAAAGRvEUUxFBsy4tVfpW4Gm-2e-LQ6"></div><p>
										<p> <input type="hidden" name="action" value="create" > </p>
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
		<script src='https://www.google.com/recaptcha/api.js?hl=en-GB'></script>
	</body>
</html>