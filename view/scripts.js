var myApp = angular.module("myapp", []);
myApp.controller("PasswordController", function($scope) {

	var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
	var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

	// $scope.passwordStrength = {
		// "width": "100px",
		// "height": "25px",
	// };

	$scope.analyze = function(value) {
		if(strongRegex.test(value)) {
			//$scope.passwordStrength["background-color"] = "green";
			document.getElementById('passwordStrength').style.color = "green";
			document.getElementById('passwordStrength').innerHTML = "Strong";
		} else if(mediumRegex.test(value)) {
			//$scope.passwordStrength["background-color"] = "orange";
			document.getElementById('passwordStrength').style.color = "orange";
			document.getElementById('passwordStrength').innerHTML = "Average";
		} else {
			//$scope.passwordStrength["background-color"] = "red";
			document.getElementById('passwordStrength').style.color = "red";
			document.getElementById('passwordStrength').innerHTML = "Week";
		}
	};

});
			
function check_pass() {
	if (document.getElementById('pass').value == document.getElementById('passCheck').value) {
		document.getElementById('passCheckIndecator').style.color = "green";
		document.getElementById('passCheckIndecator').innerHTML = "Correct";
		//document.getElementById("login").disabled = false;
		
	} else {
		document.getElementById('passCheckIndecator').style.color = "red";
		document.getElementById('passCheckIndecator').innerHTML = "Incorrect";
		//document.getElementById("login").disabled = true;
		
	}
}

function check_email(){
	
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(document.getElementById('mail').value.match(mailformat))
	{
		document.getElementById('mailIndecator').style.color = "green";
		document.getElementById('mailIndecator').innerHTML = "Valid";
		//document.getElementById("login").disabled = false;
	}
	else
	{
		document.getElementById('mailIndecator').style.color = "red";
		document.getElementById('mailIndecator').innerHTML = "Invalid";
		//document.getElementById("login").disabled = true;
	}
}

function check_phonenumber(){
	
	var phoneno = /^\d{11}$/;
	if(document.getElementById('phone').value.match(phoneno))
	{
		document.getElementById('phoneIndecator').style.color = "green";
		document.getElementById('phoneIndecator').innerHTML = "Valid";
		//document.getElementById("login").disabled = false;
	}
	else
    {
		document.getElementById('phoneIndecator').style.color = "red";
		document.getElementById('phoneIndecator').innerHTML = "Invalid";
		//document.getElementById("login").disabled = true;
    }
}