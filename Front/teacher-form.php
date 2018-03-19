<?php
	session_start();
	if(!($_SESSION['loginType'] == 'teacher')) {
		session_unset();
		header("Location: https://web.njit.edu/~tcd8/cs490/login-form.php");
	}
	
	$url = 'https://web.njit.edu/~vac33/TeacherAction.php';
	//create a new cURL resource
	$ch = curl_init($url);

	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	$respQuestions = curl_exec($ch);
	curl_close($ch2);

	$jsonQuest = json_decode($respQuestions, true);

	// function displayQuestions($questionArray)
	// {
	// 	$html = '';

	// 	foreach ($questionArray as $index => $questData) {
	// 		$html .= '<br />' . $questData['Question'] . '<input type="checkbox" value="' . $questData['ID'] . '"/>';
	// 	}
	// 	return $html;
	// }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Exam Portal - Instructor</title>
		<link rel="stylesheet" type="text/css" href="https://web.njit.edu/~tcd8/cs490/teacher-formStyle.css">
	</head>

	<body>
		<div id="container">

			<header>
				<div class="title">EXAM PORTAL - INSTRUCTOR</div>
			</header>

			<!-- Question Selection -->
			<div class="row">
				<div class="col">
					<div style="font-size: 24px;">Exam Question Selection</div>
				</div>
			</div>
			
			<form id="quest-select" action="teacher-form.php" method="POST">
				<div class="row">
					<div class="col">
						Enter Exam Name: <input type="text" name="unique-exam" placeholder="SP18M01" required>
					</div>
				</div>

				<div class="row">
					<div class="col" style="text-align: right;">		
						<?php
							$html = '';

							foreach ($jsonQuest as $index => $questData) {
								$html .= $questData['Question'] . '<input type="checkbox" value="' . $questData['ID'] . '" name="questions[]"/><br /><br />';
							}
							echo $html;
						?>
					</div>
					<div class="col">
						<input type="submit" value="Send Questions" name="send">
						<?php
							if (isset($_POST['send'])) {
								$questData = $_POST['questions'];
								$examID = $_POST['unique-exam'];

								foreach ($questData as $questions) {	
									$questionID[] = $questions;
								}

								echo "<pre>";
								// print_r($questionID);

								$data = [
									"questionID" => $questionID,
									"examName" => $examID
								];

								print_r($data);

								$url2 = 'https://web.njit.edu/~vac33/TeacherExam.php';
								$ch2 = curl_init();

								curl_setopt($ch2, CURLOPT_URL, $url2);
								curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch2, CURLOPT_POST, true);
								curl_setopt($ch2, CURLOPT_POSTFIELDS, $data);
								curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);

								$output = curl_exec ($ch2);
								//close cURL resource
								curl_close($ch);

								echo $output;
							}
						?>
					</div>
				</div>
			</form>
			<!-- Question Selection End -->

			<br />
			<div class="row">
				<div class="col">
					<div style="font-size: 24px"><strong>- OR -</strong></div>
				</div>
			</div>
			<br />

			<!-- New Question Creator -->
			<form id="form-two" action="teacher-form.php" method="POST">
				<div class="row">
					<div class="col">
						Enter the topic of new question: <input type="text" name="quest-topic" required>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<textarea rows="4" cols="50" name="custom-quest" placeholder="Enter new question here" required></textarea>
					</div>
				</div>

				<div class="row">
					<div class="col">
						Enter difficulty of the question: <input type="text" name="difficulty" placeholder="Easy, Medium, or Hard" required>
					</div>
				</div>

				<div class="row">
					<div class="col">
						Up to 3 test cases can be added for one question:
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
						<textarea rows="2" cols="25" name="tc-ans2" placeholder="Enter answer to test case 3 here"></textarea>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<input type="submit" value="Create" name="create">
					</div>
				</div>
			</form>

			<?php
				if (isset($_POST['create'])) { 

					$questTopic = $_POST['quest-topic'];
					$quest = $_POST['custom-quest'];
					$difficulty = $_POST['difficulty'];
					$testCaseOne = $_POST['test-case1'];
					$tcAnsOne = $_POST['tc-ans1'];
					$testCaseTwo = $_POST['test-case2'];
					$tcAnsTwo = $_POST['tc-ans2'];
					$testCaseThree = $_POST['test-case3'];
					$tcAnsThree = $_POST['tc-ans3']; 

					$data = [
						"questionTopic" => $questTopic,
						"newQuestion" => $quest,
						"difficulty" => $difficulty,
						"testCaseOne" => $testCaseOne,
						"testCaseAnsOne" => $tcAnsOne,
						"testCaseTwo" => $testCaseTwo,
						"testCaseAnsTwo" => $tcAnsTwo,
						"testCaseThree" => $testCaseThree,
						"testCaseAnsThree" => $tcAnsThree,

					];

					$url3 = 'https://web.njit.edu/~vac33/TeacherInput.php';

					$ch3 = curl_init($url3);

					curl_setopt($ch3, CURLOPT_URL, $url3);
					curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch3, CURLOPT_POST, true);
					curl_setopt($ch3, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, 1);

					$resp = curl_exec ($ch3);
					//close cURL resource
					curl_close($ch3);
				}
		
			?>

		</div>
	</body>
</html>