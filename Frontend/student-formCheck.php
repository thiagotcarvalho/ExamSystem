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
// var_dump($_SESSION['theGrade']);

// $url = 'https://web.njit.edu/~tcd8/cs490/teacher-formRelease.php';

// $ch = curl_init($url);

// curl_setopt($ch,CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_HEADER, 0);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

// $resp = curl_exec($ch);
// echo $resp;
// curl_close($ch);
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Exam Portal | Student</title>
	<link rel="stylesheet" href="student-style.css">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
</head>
<body>

	<header id="navbar">
		<a href="https://web.njit.edu/~tcd8/cs490/student-formExam.php">Take Exam</a>
		<a class="active" href="https://web.njit.edu/~tcd8/cs490/student-formCheck.php">Check Grade</a>
		<a href="https://web.njit.edu/~tcd8/cs490/student-formLogout.php">Logout</a> 
	</header>

	<div id="check-grade" class="content">
		<h3>Check grade</h3>
		<p>See the results of the exam.</p>
		<div class="row">
		</div>
		<div class="row">
		</div>
	</div>

	<script type="text/javascript" src="student-script.js"></script>

</body>
</html>