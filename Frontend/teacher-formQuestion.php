<?php
/**
* A teacher portal that allows the teacher to choose questions from a question bank in order to create an exam,
* create custom questions to add to the question bank,
* and release grades after student submits exam.
* 
* @author  Thiago De Carvalho <tcd8@njit.edu>
* @version 1.0 -- RC (Release Candidate)
* @link    web.njit.edu/~tcd8/cs490/teacher-formQuestion.php
*/

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

// echo "<pre>";
// print_r($respQuestions);

$jsonQuest = json_decode($respQuestions, true);

/**
* Initiates session in order to restrict access to webpages if login information is incorrect.
* Checks to see if user is teacher, if not, redirects back to login page.
*/
session_start();
if(!($_SESSION['loginType'] == 'teacher')) {
	session_unset();
	header("Location: https://web.njit.edu/~tcd8/cs490/login-form.php");
}

if (isset($_POST['createQuest'])) { 
	$questTopic = $_POST['quest-topic'];
	$quest = $_POST['custom-quest'];
	$difficulty = $_POST['difficulty'];
	$testCaseOne = $_POST['test-case1'];
	$tcAnsOne = $_POST['tc-ans1'];

	$data = [
		"questionTopic" => $questTopic,
		"newQuestion" => $quest,
		"difficulty" => $difficulty,
		"testCaseOne" => $testCaseOne,
		"testCaseAnsOne" => $tcAnsOne,
	];

	if (($_POST['test-case2'] != '') && ($_POST['tc-ans2'] != '')) {
		$data['testCaseTwo'] = $_POST['test-case2'];
		$data['testCaseAnsTwo'] = $_POST['tc-ans2'];
	}

	if (($_POST['test-case3'] != '') && ($_POST['tc-ans3'] != '')) {
		$data['testCaseThree'] = $_POST['test-case3'];
		$data['testCaseAnsThree'] = $_POST['tc-ans3'];
	}

	if (($_POST['test-case4'] != '') && ($_POST['tc-ans4'] != '')) {
		$data['testCaseFour'] = $_POST['test-case4'];
		$data['testCaseAnsFour'] = $_POST['tc-ans4'];
	}

	if (($_POST['test-case5'] != '') && ($_POST['tc-ans5'] != '')) {
		$data['testCaseFive'] = $_POST['test-case5'];
		$data['testCaseAnsFive'] = $_POST['tc-ans5'];
	}

	$url3 = 'https://web.njit.edu/~vac33/TeacherInput.php';
	// $url3 = 'https://web.njit.edu/~jmk62/CS490/addQuestions.php';

	$ch3 = curl_init($url3);

	curl_setopt($ch3, CURLOPT_URL, $url3);
	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch3, CURLOPT_POST, true);
	curl_setopt($ch3, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, 1);

	$resp = curl_exec ($ch3);
	// echo "<br/><br/>" .$resp;
	// close cURL resource
	curl_close($ch3);
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
		<a class="active" href="https://web.njit.edu/~tcd8/cs490/teacher-formQuestion.php">Create Question</a>
		<a href="https://web.njit.edu/~tcd8/cs490/teacher-formRelease.php">Release Grade</a>
		<a href="https://web.njit.edu/~tcd8/cs490/teacher-formLogout.php">Logout</a>
	</header>

	<!-- CREATE A QUESTION -->
	<div id="create-quest" class="content">
		<h3>Create Question</h3>
		<p>Fill out all the required fields to create a custom question.</p>
		<div class="center">

			<div class="row">
				<div class="col-window">

					<!-- CREATE QUESTION FORM-->
					<form id="add-quest" action="teacher-formQuestion.php" method="POST">
						<div class="row">
							<div class="col">
								Enter the topic of new question: 
								<select name="quest-topic">
									<option value="Arrays">Arrays</option>
									<option value="Conditionals">Conditionals</option>
									<option value="Loops">Loops</option>
									<option value="Math">Math</option>
									<option value="String">String</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<textarea rows="4" cols="50" name="custom-quest" placeholder="Enter new question here" required></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col">
								Enter difficulty of the question:
								<select name="difficulty">
									<option value="Easy">Easy</option>
									<option value="Medium">Medium</option>
									<option value="Hard">Hard</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col">
								Up to 5 test cases can be added for one question:
							</div>
						</div>

						<div class="row">
							<div class="col">
								<textarea rows="2" cols="25" name="test-case1" placeholder="Enter test case 1 here" required></textarea>
							</div>
							<div class="col">
								<textarea rows="2" cols="25" name="tc-ans1" placeholder="Enter answer to test case 1 here" required=""></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<textarea rows="2" cols="25" name="test-case2" placeholder="Enter test case 2 here"></textarea>
							</div>
							<div class="col">
								<textarea rows="2" cols="25" name="tc-ans2" placeholder="Enter answer to test case 2 here"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<textarea rows="2" cols="25" name="test-case3" placeholder="Enter test case 3 here"></textarea>
							</div>
							<div class="col">
								<textarea rows="2" cols="25" name="tc-ans3" placeholder="Enter answer to test case 3 here"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<textarea rows="2" cols="25" name="test-case4" placeholder="Enter test case 4 here"></textarea>
							</div>
							<div class="col">
								<textarea rows="2" cols="25" name="tc-ans4" placeholder="Enter answer to test case 4 here"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<textarea rows="2" cols="25" name="test-case5" placeholder="Enter test case 5 here"></textarea>
							</div>
							<div class="col">
								<textarea rows="2" cols="25" name="tc-ans5" placeholder="Enter answer to test case 5 here"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<input type="submit" value="Create Question" name="createQuest">
							</div>
						</div>

					</form>
					<!-- END CREATE QUESTION FORM-->
					
				</div>

				<!-- DIVIDER -->
				<div class="col-small"></div>
				<!-- END DIVIDER -->

				<div class="col-window">
					<div class="row"><b>Question Bank</b><hr/></div>

					<div class="row">
						<div class="col">
							<table id="questBank"></table>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
	<!-- END CREATE A QUESTION -->

	<script src="js/teacher-script.js"></script>
	<script>
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var myObj = JSON.parse(this.responseText);
				qBank = document.getElementById("questBank");

				for (var i = 0; i < myObj.length; i++) {
					qBank.innerHTML = qBank.innerHTML + '<tr><td id="'+ i +'">'+ myObj[i].Question +'</td><td>'+ myObj[i].Difficulty 
									  +'</td><td>'+ myObj[i].Topic +'</td></tr><br/>';
				}
			}
		};
		xhttp.open("GET", "grabQuestions.php", true);
		xhttp.send();
	</script>

</body>
</html>