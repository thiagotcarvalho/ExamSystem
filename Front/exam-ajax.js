/* AJAX Call to Confirm Login Type (student, teacher, invalid) */
var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		var loginStatus = JSON.parse(this.responseText);
		// console.log(loginStatus);

		if (loginStatus['userType'] == "student") {
			// alert("You have successfully logged in!");
			document.getElementById("login-status").innerHTML = "You have successfully logged in as a Student!";
		}
		else if (loginStatus['userType'] == "teacher") {
			// alert("Login has failed! Incorrect username and/or password.");
			document.getElementById("login-status").innerHTML = "You have successfully logged in as a Teacher!";
		}
		else if (loginStatus['userType'] == "none") {
			// alert("An error has occurred. Please try again...");
			document.getElementById("login-status").innerHTML = "The username and/or password you have entered is incorrect.";
		}
		else {
			document.getElementById("login-status").innerHTML = "An error has occurred. Please try again!";
		}
	}
};
xmlhttp.open("GET", web.njit.edu/~vac33/controller.php, true);
xmlhttp.send();