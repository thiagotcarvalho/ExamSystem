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
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Exam Login</title>
	<link rel="stylesheet" type="text/css" href="http://localhost:8080/thiago/login-formStyle.css">
</head>

<body>

	<div id="container">

		<header>
			<div class="title">EXAM PORTAL - LOGIN</div>
		</header>

		<form id="login" method="POST" action="login-form.php">
			<div class="row">
				<div class="col">
					<b>User:</b> <input type="text" name="username" required>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<b>Password:</b> <input type="password" name="password" required>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<button name="submit">Login</button>
				</div>
			</div>
		</form>

		<!-- Activated when "Login" button is pressed -->
		<?php 
		$url = 'https://web.njit.edu/~vac33/controller.php';

		/**
		* Checks to see if button was pressed.
		* If pressed, takes login credentials and sends it to database via controller.
		* Database checks if credentials exist and sends back either "student", "teacher", or "none."
		* $_SESSION stores value and redirects to respective web page.
		*/
		if (isset($_POST['submit'])) {
			$username = $_POST['username'];
			$password = md5($_POST['password']);

			$data = array(
				"username" => $username,
				"password" => $password
			);

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
				header("location: https://www.njit.edu");
				// print_r($_SESSION);
			}
			else if ($loginType['userType'] == 'teacher') {
				$_SESSION['loginType'] = 'teacher';
				header("location: https://web.njit.edu/~tcd8/cs490/teacher-form.php");
				// print_r($_SESSION);
			}
		}
		?>

	</div>

	<!-- <script>
		var loginType = "<?php //echo $loginType["userType"]; ?>";
		console.log(loginType);

		if (loginType == 'student') {
			document.getElementById('para').innerHTML = 'STUDENT';
			// window.location.href = "https://yahoo.com";
		}
		else if (loginType == 'teacher') {
			document.getElementById('para').innerHTML = 'TEACHER';
			window.location.href = "https://web.njit.edu/~tcd8/cs490/teacher-form.php";
		}
		else
			document.getElementById('para').innerHTML = 'FAILED. PLEASE TRY AGAIN';
	</script> -->
</body>

</html>