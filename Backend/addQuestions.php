<?php

$host = "sql1.njit.edu";
$user = "jmk62";
$pass = "DebsRXRQG";
$database = "jmk62";

//connect to database
$conn = new mysqli($host, $user, $pass, $database);

//catch error if database can't connect
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$testCaseCount = 1;

$question = $_POST['newQuestion'];
$topic = $_POST['questionTopic'];
$difficulty = $_POST['difficulty'];
$testCaseOne = $_POST['testCaseOne'];
$testCaseAnsOne = $_POST['testCaseAnsOne'];

if (isset($_POST['testCaseTwo']) && isset($_POST['testCaseAnsTwo'])){
	$testCaseTwo = $_POST['testCaseTwo'];
	$testCaseAnsTwo = $_POST['testCaseAnsTwo'];
	$testCaseCount++;
}
if (isset($_POST['testCaseThree']) && isset($_POST['testCaseAnsThree'])){
	$testCaseThree = $_POST['testCaseThree'];
	$testCaseAnsThree = $_POST['testCaseAnsThree'];
	$testCaseCount++;
}
if (isset($_POST['testCaseFour']) && isset($_POST['testCaseAnsFour'])){
	$testCaseFour = $_POST['testCaseFour'];
	$testCaseAnsFour = $_POST['testCaseAnsFour'];
	$testCaseCount++;
}
if (isset($_POST['testCaseFive']) && isset($_POST['testCaseAnsFive'])){
	$testCaseFive = $_POST['testCaseFive'];
	$testCaseAnsFive = $_POST['testCaseAnsFive'];
	$testCaseCount++;
}

//add the question to the database
$sql = "INSERT INTO Questions (Question, Topic, Difficulty) VALUES (?, ?, ?)";
// '$question', '$topic', '$difficulty'
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $question, $topic, $difficulty);
$stmt->execute();


//loop through test cases and add them to the database
for ($i = 1; $i <= $testCaseCount; $i++){
	if($i == 1){$testCase = $testCaseOne; $testCaseAns = $testCaseAnsOne;}
	if($i == 2){$testCase = $testCaseTwo; $testCaseAns = $testCaseAnsTwo;}
	if($i == 3){$testCase = $testCaseThree; $testCaseAns = $testCaseAnsThree;}
	if($i == 4){$testCase = $testCaseFour; $testCaseAns = $testCaseAnsFour;}
	if($i == 5){$testCase = $testCaseFive; $testCaseAns = $testCaseAnsFive;}

	$sql2 = "INSERT INTO TestCases (QuestionNum, TestCase, TestCaseAnswer) SELECT ID, ?, ? FROM Questions WHERE question = ?";
	$stmt = $conn->prepare($sql2);
	$stmt->bind_param("sss", $testCase, $testCaseAns, $question);
	$stmt->execute();
}
$stmt->close();
$conn->close();

echo $question;


?>