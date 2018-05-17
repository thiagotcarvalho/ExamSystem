<?php
/**
* A teacher portal that allows the teacher to choose questions from a question bank in order to create an exam,
* create custom questions to add to the question bank,
* and release grades after student submits exam.
* 
* @author  Thiago De Carvalho <tcd8@njit.edu>
* @version 1.1 -- RC (Release Version)
* @link    web.njit.edu/~tcd8/cs490/teacher-formExam.php
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

/**
* This cURL is set up to retrieve questions from database and list them to web page.
* The questions are taken in the form of a JSON object.
*/
$url = 'https://web.njit.edu/~vac33/TeacherAction.php';

$ch = curl_init($url);

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

$respQuestions = curl_exec($ch);
curl_close($ch);

$jsonQuest = json_decode($respQuestions, true);

/**
* This cURL is set up to send the exam name and the question IDs to the database.
* The exam name and questions are selected by the user.
*/
if (isset($_POST['createExam'])) {
	foreach ($_POST['questions'] as $key => $qID) {
	  $data['questions[' . $key . ']'] = $qID;
	}
	foreach ($_POST['points'] as $key => $pointValue) {
	  $data['points[' . $key . ']'] = $pointValue;
	}
	$data['examName'] = $_POST['unique-exam'];

	$url2 = 'https://web.njit.edu/~vac33/TeacherExam.php';
	$ch2 = curl_init();

	curl_setopt($ch2, CURLOPT_URL, $url2);
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch2, CURLOPT_POST, true);
	curl_setopt($ch2, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);

	$output = curl_exec($ch2);
	curl_close($ch2);
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
		<a class="active" href="https://web.njit.edu/~tcd8/cs490/teacher-formExam.php">Create Exam</a>
		<a href="https://web.njit.edu/~tcd8/cs490/teacher-formQuestion.php">Create Question</a>
		<a href="https://web.njit.edu/~tcd8/cs490/teacher-formRelease.php">Release Grade</a>
		<a href="https://web.njit.edu/~tcd8/cs490/teacher-formLogout.php">Logout</a>
	</header>

	<!-- CREATE EXAM -->
	<div id="create-exam" class="content">
		<h3>Create Exam</h3>
		<p>Add questions from the Question Bank to create a new exam.</p>
		<div class="center">
			<div class="row">
				<div class="col-window">
					<!-- QUESTION BANK -->
					<form action="teacher-formExam.php" method="POST">
						<div class="row"><b>Question Bank</b><hr/></div>

						<div class="row">
							<div class="col">
								<select id="quest-difficulty" onchange="filterQuestions();">
									<option value="all">All</option>
									<option value="easy">Easy</option>
									<option value="medium">Medium</option>
									<option value="hard">Hard</option>
								</select>

								<select id="quest-topic" onchange="filterQuestions();">
									<option value="all">All</option>
									<option value="arrays">Arrays</option>
									<option value="conditionals">Conditionals</option>
									<option value="loops">Loops</option>
									<option value="math">Math</option>
									<option value="string">String</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<table id="questBank"></table>
							</div>

							<div class="col">
								<input type="submit" value="Add Questions" name="addQuest" onclick="questionAdd(); return false;">
								<!-- <input type="submit" value="<" name="remove"> -->
							</div>
						</div>
					</form>
					<!-- END QUESTION BANK -->
				</div>

				<!-- DIVIDER -->
				<div class="col-small"></div>
				<!-- END DIVIDER -->

				<!-- EXAM PREVIEW -->
				<div class="col-window">
					<form id="examCreate" name="examCreate" action="teacher-formExam.php" method="POST">
						<div class="row">
							<div class="col">
								Enter Exam Name: <input type="text" name="unique-exam" placeholder="SP18M01" required>
								<!-- <input type="submit" value="Create Exam" name="createExam"> -->
							</div>
						</div>

						<div class="row">
							<div class="col">
								<ol id="exam-preview"></ol>
							</div>
						</div>

						<div id="question-id"></div>

						<div class="row">
							<div class="col">
								<input type="submit" value="Create Exam" name="createExam">
							</div>
						</div>
					</form>
					<!-- END EXAM PREVIEW -->
				</div>

			</div>
		</div>
	</div>
	<!-- END CREATE EXAM -->

	<script src="js/teacher-script.js"></script>
	<script src="js/teacher-ajax.js"></script>

</body>
</html>