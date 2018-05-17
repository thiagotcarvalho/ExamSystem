<?php
/**
* A login form that, depending on whether the user is a student or a teacher,
* redirects them to the respective webpages
* 
* @author  Thiago De Carvalho <tcd8@njit.edu>
* @version 1.0 -- RC (Release Candidate)
* @link    web.njit.edu/~tcd8/cs490/login-form.php
*/

/**
* Initiates session in order to restrict access to webpages if login information is incorrect
*/
session_start();

/**
* Activated when "Login" button is pressed
* 
* Checks to see if button was pressed.
* If pressed, takes login credentials and sends it to database via controller.
* Database checks if credentials exist and sends back either "student", "teacher", or "none."
* $_SESSION stores value and redirects to respective web page.
*/
$url = 'https://web.njit.edu/~vac33/controller.php';

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$data = [
		"username" => $username,
		"password" => $password,
	];

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	$resp = curl_exec ($ch);
	//close cURL resource
	curl_close($ch);

	$loginType = json_decode($resp, true);

	if ($loginType['userType'] == 'student') {
		$_SESSION['loginType'] = 'student';
		header("location: https://web.njit.edu/~tcd8/cs490/student-formExam.php");
		// print_r($_SESSION);
	} else if ($loginType['userType'] == 'teacher') {
		$_SESSION['loginType'] = 'teacher';
		header("location: https://web.njit.edu/~tcd8/cs490/teacher-formExam.php");
		// print_r($_SESSION);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Exam Portal | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/login-style.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<form class="login100-form validate-form" method="POST" action="login-form.php">
					<span class="login100-form-title p-b-43">
						Exam Portal Login
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<input class="input100" type="text" name="username" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit">
							Sign In
						</button>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/bg-08.jpg');"></div>
			</div>
		</div>
	</div>
<!--===============================================================================================-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/login-script.js"></script>
<!--===============================================================================================-->

</body>
</html>