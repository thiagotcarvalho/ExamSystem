<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login Form</title>
		<link rel="stylesheet" type="text/css" href="viewStyle.css">
	</head>

	<body>
		<h1>PLEASE LOGIN</h1>

		<form action="view.php" method="post">
			<!-- <div class="container"> -->
				<label for="username"><b>Username:</b></label>
				<input type="text" placeholder="ucid" name="username" required>
				<br>

				<label for="password"><b>Password:</b></label>
				<input type="password" placeholder="********" name="password" required>
				<br>

				<button type="submit" name="btnSubmit">Login</button>
			<!-- </div> -->
		</form>

		<?php
			/* Checks to see if Login button was pressed */
			if (isset($_POST['btnSubmit'])) {
				// Url of controller file
				$url = "localhost:8080/thiago/controller.php";
				$rawLoginFormat = [
					'User' => $username = $_POST['username'],
					'Pass' => $password = $_POST['password']
				];

				/* Using PHP cURL to send the credentials to the controller */
				$login = curl_init($url);
				curl_setopt($login, CURLOPT_POST, true);
				curl_setopt($login, CURLOPT_POSTFIELDS, $rawLoginFormat);
				$response = curl_exec($login);
				curl_close($login);

				echo "$response";
			}
		?>

		<!-- Runs fetch() to grab the JSON file from Controller and output responses of DB and NJIT -->
		<script type="text/javascript" src="viewScript.js"></script>
	</body>
</html>