<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Exam Login</title>
		<link rel="stylesheet" type="text/css" href="exam-loginStyle.css">
	</head>
	<body>
		<div id="container">
			<header>
				<div id="title">LOGIN</div>
			</header>

			<main>
				<form id="exam-login" method="POST">
					<div class="row">
						<div class="col">
							<label for="username"><strong>Username:</strong></label>
						</div>
						<div class="col">
							<p></p>
						</div>
						<div class="col">
							<input type="text" name="username" placeholder="abc123" required>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<label for="password"><strong>Password:</strong></label>
						</div>
						<div class="col">
							<p></p>
						</div>
						<div class="col">
							<input type="password" name="password" placeholder="********" required>
						</div>
					</div>

					<div id="login-status" class="row"></div>

					<div class="row">
						<button name="btnSubmit">Submit</button>
					</div>
				</form>

				<?php
					if (isset($_POST['btnSubmit'])) {
						$url = "https://web.njit.edu/~vac33/controller.php";

						$username = $_POST['username'];
						$password = $_POST['password'];

						$data = [
							"username" => $username,
							"password" => $password
						];

						/* DEBUG */
						// echo "<pre>";
						// print_r($data);

						$ch = curl_init();

						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

						$resp = curl_exec ($ch);

						//close cURL resource
						curl_close($ch);

						echo $resp;
						echo "<br>";
						echo "Test";
					}
				?>
			</main>
			<script src="exam-ajax.js"></script>
		</div>
	</body>
</html>