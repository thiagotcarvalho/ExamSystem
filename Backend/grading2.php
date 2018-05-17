<?php

require_once('databaseConn.php');



//grab all the questions and info from the database
$sql = "SELECT examName FROM Exams WHERE ID = (SELECT MAX(ID) FROM Exams)";

//execture sql statement
$result = mysqli_query($conn, $sql);


while ($row = mysqli_fetch_assoc($result)){
	$examNameVar[] = $row; //insert all the questions & info to an array
}

//HAS THE EXAMNAME
$examName = $examNameVar[0]["examName"];

$sql0 = "SELECT QuestionID FROM Exams WHERE ExamName = '$examName'";
$result2 = mysqli_query($conn, $sql0);

while ($row = mysqli_fetch_assoc($result2)){
	$IDsVar[] = $row; //insert all the questions & info to an array
}

$questionIDNums = [];

foreach ($IDsVar as &$ID){
	$singleID = $ID["QuestionID"];
	array_push($questionIDNums, $singleID);
}


$ID1 = $questionIDNums[0];
$ID2 = $questionIDNums[1];
$ID3 = $questionIDNums[2];
$ID4 = $questionIDNums[3];


$sql1 = "SELECT TestCase, TestCaseAnswer FROM TestCases WHERE QuestionNum = '$ID1'";
$sql2 = "SELECT TestCase, TestCaseAnswer FROM TestCases WHERE QuestionNum = '$ID2'";
$sql3 = "SELECT TestCase, TestCaseAnswer FROM TestCases WHERE QuestionNum = '$ID3'";
$sql4 = "SELECT TestCase, TestCaseAnswer FROM TestCases WHERE QuestionNum = '$ID4'";

//Execture SQL to grab results for each individual ID at a time
$resultSQL1 = mysqli_query($conn, $sql1); 
$resultSQL2 = mysqli_query($conn, $sql2);
$resultSQL3 = mysqli_query($conn, $sql3);
$resultSQL4 = mysqli_query($conn, $sql4);

$finalResult = [];

//Run the queries and put each ID's test cases in its own array
while ($row = mysqli_fetch_assoc($resultSQL1)){
	$returnQuestions1[] = $row; //insert all the questions & info to an array
}
while ($row = mysqli_fetch_assoc($resultSQL2)){
	$returnQuestions2[] = $row; //insert all the questions & info to an array
}
while ($row = mysqli_fetch_assoc($resultSQL3)){
	$returnQuestions3[] = $row; //insert all the questions & info to an array
}
while ($row = mysqli_fetch_assoc($resultSQL4)){
	$returnQuestions4[] = $row; //insert all the questions & info to an array
}

//Check if there was any result for that specific ID, and push it to the final result array
if (!empty($returnQuestions1)){array_push($finalResult, $returnQuestions1);}
if (!empty($returnQuestions2)){array_push($finalResult, $returnQuestions2);}
if (!empty($returnQuestions3)){array_push($finalResult, $returnQuestions3);}
if (!empty($returnQuestions4)){array_push($finalResult, $returnQuestions4);}


//Execute SQL to grab all the point values corresponding to the questions
$sql5 = "SELECT PointValue FROM Exams WHERE ExamName = '$examName'";
$result3 = mysqli_query($conn, $sql5);

while ($row = mysqli_fetch_assoc($result3)){
	$PointsVar[] = $row; 
}



echo json_encode($PointsVar);

?>

