<?php
/**
* A student portal that allows the student to take an exam and view their grades for the exam.
* 
* @author  Thiago De Carvalho <tcd8@njit.edu>
* @version 1.0 -- RC (Release Candidate)
* @link    web.njit.edu/~tcd8/cs490/student-form.php
*/

/**
* Initiates session in order to restrict access to webpages if login information is incorrect.
* Checks to see if user is teacher, if not, redirects back to login page.
*/
session_start();
if(!($_SESSION['loginType'] == 'student')) {
	session_unset();
	header("Location: https://web.njit.edu/~tcd8/cs490/login-form.php");
}

/**
* This cURL is set up to retrieve the exam from database and list them to web page.
* The exam is taken in the form of a JSON object.
*/
$url = 'https://web.njit.edu/~vac33/PreStudent.php';

$ch = curl_init($url);

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

$exam = curl_exec($ch);
curl_close($ch);

$decodedExam = json_decode($exam, true);

if (isset($_POST['submitExam'])) {
	$data = [];
	$arrSize = sizeof($decodedExam);

	for ($i = 0; $i < $arrSize; $i+=3) {
		$data[$decodedExam[$i+1]] = $_POST[$decodedExam[$i+1]];
		$data[$decodedExam[$i+1]] = str_replace(" ", "[sp]", $data[$decodedExam[$i+1]]);
	}

	$url2 = 'https://web.njit.edu/~vac33/StudentAction.php';
	$ch2 = curl_init();

	curl_setopt($ch2, CURLOPT_URL, $url2);
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch2, CURLOPT_POST, true);
	curl_setopt($ch2, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);

	$output = curl_exec($ch2);
	// echo $output;
	curl_close($ch2);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Exam Portal | Student</title>
	<link rel="stylesheet" href="css/student-style.css">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
</head>
<body>

	<header id="navbar">
		<a class="active" href="https://web.njit.edu/~tcd8/cs490/student-formExam.php">Take Exam</a>
		<a href="https://web.njit.edu/~tcd8/cs490/student-formCheck.php">Check Grade</a>
		<a href="https://web.njit.edu/~tcd8/cs490/student-formLogout.php">Logout</a> 
	</header>

	<div id="take-exam" class="content">
		<h3>Take Exam</h3>
		<p>Take the exam for your class.</p>

		<form id="exam-one" action="student-formExam.php" method="POST">
			<button class="button shadow" type="submit" id="examButton" name="examButton" onclick="loadExam(); return false;">Take Exam</button>
		</form>
		<form id="exam-two" action="student-formExam.php" method="POST">
			
		</form>
	</div>

	<script type="text/javascript" src="js/student-script.js"></script>
	<script src="js/student-showExam.js"></script>

</body>
</html>