<?php
/**
* A teacher portal that allows the teacher to choose questions from a question bank in order to create an exam,
* create custom questions to add to the question bank,
* and release grades after student submits exam.
* 
* @author  Thiago De Carvalho <tcd8@njit.edu>
* @version 1.0 -- RC (Release Candidate)
* @link    web.njit.edu/~tcd8/cs490/teacher-formRelease.php
*/

/**
* Initiates session in order to restrict access to webpages if login information is incorrect.
* Checks to see if user is teacher, if not, redirects back to login page.
*/
session_start();
if(!($_SESSION['loginType'] == 'teacher')) {
	session_unset();
	header("Location: https://web.njit.edu/~tcd8/cs490/login-form.php");
}

$url = 'https://web.njit.edu/~vac33/StudentAction.php';

$ch = curl_init($url);

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

$respGrade = curl_exec($ch);
curl_close($ch);

if (isset($_POST['releaseGrade'])) {
	$data = [];
	$arrSize = sizeof($respGrade);

	for ($i = 0; $i < $arrSize)
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Exam Portal | Instructor</title>
	<link rel="stylesheet" type="text/css" href="css/teacher-style.css">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
</head>
<body>

	<header id="navbar">
		<a href="https://web.njit.edu/~tcd8/cs490/teacher-formExam.php">Create Exam</a>
		<a href="https://web.njit.edu/~tcd8/cs490/teacher-formQuestion.php">Create Question</a>
		<a class="active" href="https://web.njit.edu/~tcd8/cs490/teacher-formRelease.php">Release Grade</a>
		<a href="https://web.njit.edu/~tcd8/cs490/teacher-formLogout.php">Logout</a>
	</header>

	<!-- RELEASE GRADE -->
	<div id="release-grade" class="content">
		<h3>Release Grade</h3>
		<p>See the results of the exam and release the grade to the student.</p>
		<p>(Make comments if necessary)</p>

		<div class="row">
			<div class="col">
				<form id="examGrade"></form>
			</div>
		</div>

	</div>
	<!-- END RELEASE GRADE -->

	<script src="js/teacher-script.js"></script>
	<script src="js/teacher-examGrade.js"></script>

</body>
</html>