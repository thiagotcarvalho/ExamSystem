<?php
/**
* A teacher portal that allows the teacher to choose questions from a question bank in order to create an exam,
* create custom questions to add to the question bank,
* and release grades after student submits exam.
* 
* @author  Thiago De Carvalho <tcd8@njit.edu>
* @version 1.0 -- RC (Release Candidate)
* @link    web.njit.edu/~tcd8/cs490/teacher-formExam.php
*/

session_start();
unset($_SESSION['loginType']);
session_destroy();

header("Location: https://web.njit.edu/~tcd8/cs490/login-form.php");
exit;
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
		<a href="https://web.njit.edu/~tcd8/cs490/student-formCheck.php">Check Grade</a>
		<a class="active" href="https://web.njit.edu/~tcd8/cs490/student-formLogout.php">Logout</a> 
	</header>

</body>
</html>