<?php
#Recive Student Answers from Front.
#Store Them in an array called $studentResponses

function passTestCase($tc, $names, $questionIndex, $numTestCases){
	if (sizeof($names) == 1){
		$result = exec("/usr/bin/python aGrading.py '$tc[0]' '$tc[1]' '$questionIndex' '$numTestCases' '$names[0]'  ");		
	}
	if (sizeof($names) == 2){
		$result = exec("/usr/bin/python aGrading.py '$tc[0]' '$tc[1]' '$questionIndex' '$numTestCases' '$names[0]' '$names[1]' ");		
	}
	if (sizeof($names) == 3){
		$result = exec("/usr/bin/python aGrading.py '$tc[0]' '$tc[1]' '$questionIndex' '$numTestCases' '$names[0]' '$names[1]' '$names[2]' ");		
	}
	if (sizeof($names) == 4){
		$result = exec("/usr/bin/python aGrading.py '$tc[0]' '$tc[1]' '$questionIndex' '$numTestCases' '$names[0]' '$names[1]' '$names[2]' '$names[3]' ");		
	}
	if (sizeof($names) == 5){
		$result = exec("/usr/bin/python aGrading.py '$tc[0]' '$tc[1]' '$questionIndex' '$numTestCases' '$names[0]' '$names[1]' '$names[2]' '$names[3]' '$names[4]' ");		
	}
	if (sizeof($names) == 6){
		$result = exec("/usr/bin/python aGrading.py '$tc[0]' '$tc[1]' '$questionIndex' '$numTestCases' '$names[0]' '$names[1]' '$names[2]' '$names[3]' '$names[4]' '$names[5]' ");		
	}
	if (sizeof($names) == 7){
		$result = exec("/usr/bin/python aGrading.py '$tc[0]' '$tc[1]' '$questionIndex' '$numTestCases' '$names[0]' '$names[1]' '$names[2]' '$names[3]' '$names[4]' '$names[5]' '$names[6]' ");			
	}
	if (sizeof($names) == 8){
		$result = exec("/usr/bin/python aGrading.py '$tc[0]' '$tc[1]' '$questionIndex' '$numTestCases' '$names[0]' '$names[1]' '$names[2]' '$names[3]' '$names[4]' '$names[5]' '$names[6]' '$names[7]' ");
	}
	if (sizeof($names) == 9){
		$result = exec("/usr/bin/python aGrading.py '$tc[0]' '$tc[1]' '$questionIndex' '$numTestCases' '$names[0]' '$names[1]' '$names[2]' '$names[3]' '$names[4]' '$names[5]' '$names[6]' '$names[7]' '$names[8]' ");
	}
	if (sizeof($names) == 10){
		$result = exec("/usr/bin/python aGrading.py '$tc[0]' '$tc[1]' '$questionIndex' '$numTestCases' '$names[0]' '$names[1]' '$names[2]' '$names[3]' '$names[4]' '$names[5]' '$names[6]' '$names[7]' '$names[8]' '$names[9]' ");	
	}

	return $result;
}

function checkNames($tc){
	$result = exec("/usr/bin/python checkNames.py '$tc[0]'  ");
	return $result;
}

$studentResponses=array();

#Create array of Student Responses
foreach($_POST as $resp){
	#For each answer sent, create 
    $studentResponses[] = $resp;
}

#Send Student Responses to be printed onto a python script.
if (sizeof($studentResponses) == 1){
	$result3 = exec("/usr/bin/python CombineCode.py '$studentResponses[0]' ");
}

if (sizeof($studentResponses) == 2){
	$result3 = exec("/usr/bin/python CombineCode.py '$studentResponses[0]' '$studentResponses[1]'");
}

if (sizeof($studentResponses) == 3){
	$result3 = exec("/usr/bin/python CombineCode.py '$studentResponses[0]' '$studentResponses[1]' '$studentResponses[2]'");
}

if (sizeof($studentResponses) == 4){
	$result3 = exec("/usr/bin/python CombineCode.py '$studentResponses[0]' '$studentResponses[1]' '$studentResponses[2]' '$studentResponses[3]'");
}

if (sizeof($studentResponses) == 5){
 	$result3 = exec("/usr/bin/python CombineCode.py '$studentResponses[0]' '$studentResponses[1]' '$studentResponses[2]' '$studentResponses[3]' '$studentResponses[4]'");
}

if (sizeof($studentResponses) == 6){
	$result3 = exec("/usr/bin/python CombineCode.py '$studentResponses[0]' '$studentResponses[1]' '$studentResponses[2]' '$studentResponses[3]' '$studentResponses[4]' '$studentResponses[5]'");
}

if (sizeof($studentResponses) == 7){
	$result3 = exec("/usr/bin/python CombineCode.py '$studentResponses[0]' '$studentResponses[1]' '$studentResponses[2]' '$studentResponses[3]' '$studentResponses[4]' '$studentResponses[5]' '$studentResponses[6]'");
}

if (sizeof($studentResponses) == 8){
	$result3 = exec("/usr/bin/python CombineCode.py '$studentResponses[0]' '$studentResponses[1]' '$studentResponses[2]' '$studentResponses[3]' '$studentResponses[4]' '$studentResponses[5]' '$studentResponses[6]' '$studentResponses[7]'");
}

if (sizeof($studentResponses) == 9){
	$result3 = exec("/usr/bin/python CombineCode.py '$studentResponses[0]' '$studentResponses[1]' '$studentResponses[2]' '$studentResponses[3]' '$studentResponses[4]' '$studentResponses[5]' '$studentResponses[6]' '$studentResponses[7]' '$studentResponses[8]'");
}

if (sizeof($studentResponses) == 10){
	$result3 = exec("/usr/bin/python CombineCode.py '$studentResponses[0]' '$studentResponses[1]' '$studentResponses[2]' '$studentResponses[3]' '$studentResponses[4]' '$studentResponses[5]' '$studentResponses[6]' '$studentResponses[7]' '$studentResponses[8]' '$studentResponses[9]'");
}


echo $result3;

#Curl to Back, where I can extraced the corresponding Question-TestCases Pairings
$urlBackend = 'http://web.njit.edu/~jmk62/CS490/grading.php';
$ch2 = curl_init($urlBackend);

curl_setopt($ch2,CURLOPT_URL, $urlBackend);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);

$responseBack = curl_exec($ch2);
curl_close($ch2);

//Grabs testcases from the curled php file.
$jsondata1 = json_decode($responseBack, true);
$numofQuestions = count($jsondata1);

#Curl to Back, where I can extraced the corresponding Point Values for each Question
$urlBackend2 = 'http://web.njit.edu/~jmk62/CS490/grading2.php';
$ch3 = curl_init($urlBackend2);

curl_setopt($ch3,CURLOPT_URL, $urlBackend2);
curl_setopt($ch3, CURLOPT_POST, true);
curl_setopt($ch3, CURLOPT_HEADER, 0);
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, 1);

$responseBackPoints = curl_exec($ch3);
curl_close($ch3);

//Grabs testcases from the curled php file.
$jsondata2 = json_decode($responseBackPoints, true);

$pointSystem=array();

foreach ($jsondata2 as $key=>$array) {
	foreach ($array as $v) {
	   $pointSystem[] = $v;
	}
}


// print_r($jsondata1);

#Breaks down json into an array, that stores the passed TestCases
foreach ($jsondata1 as $key=>$array) {
	${'functionNamesfromBack' .  $key}=array();
	foreach ($array as $v) {
	    ${'functionNamesfromBack' .  $key}[] = $v;
	}
}

#For every testcase passed, extract and the proper name of the function names
// echo "<br>";
$namesofStudentFunc = [];
for ($i = 0; $i < $numofQuestions; $i++) {
	foreach (${'functionNamesfromBack' . $i} as $key=>$a) {
		${'functionName' .  $key}=array();
		foreach ($a as $z) {
			${'functionName' .  $key}[] = $z;
		}
		$answer = checkNames(${'functionName' . $key});		
	}
	$namesofStudentFunc[] = $answer;
}

$namesofStudentFunc = array_unique($namesofStudentFunc);
$properNames = $namesofStudentFunc;

// ECHO "ZZZZZZZZ ";
// print_r($properNames);



#Breaks down json data agian, to creat a new array called questionStoredinDB. That is indexed at 0 and increases by 1.
foreach ($jsondata1 as $key=>$array) {
	${'questionStoredinDB' .  $key}=array();
	foreach ($array as $v) {
		${'questionStoredinDB' .  $key}[] = $v;
	}
}
$testCases_Stats = [];


// echo "<br>";

#Loops through each question asked, and processes each testcase individually.
#Saves statics for each testcase and question.
#Stats: Test cases run correcly. Names of functions defined correctly
#Grades each testcase and stores a sum value, one grade per question 
#Grade for every question is storede in an array and then processed for a final grade

// echo ("this is the NUMBER OF QUESTIONS" . $numofQuestions );
for ($i = 0; $i < $numofQuestions; $i++) {
	
 	$numofTestCasesinEveryQuestion = count(${'questionStoredinDB' .  $i});
	
	#Avg Score per TestCase w/ Everything Correct
	$fullCredit = 1 / $numofTestCasesinEveryQuestion;
	$num_CorrectTestCases = 0;
	
	#Avg Score per TestCase w/ incorrect Function Name
	$partialCredit =( 1 / $numofTestCasesinEveryQuestion) * .85;
	$correctFunctionName = 0;
	
	#Value of Each Question according to selected PointSystem
	$valueofQuestion = ($pointSystem[$i]) / 100;
	
	
	// echo "<br>Start of New Qestion (Array):<br>";

	// print_r(${'questionStoredinDB' . $i });
	// echo "<br>";
	// echo "<br>";

	

 	$testCases_Score = [];	
 	foreach (${'questionStoredinDB' . $i} as $key=>$a) {
		${'testCase' .  $key}=array();
 		foreach ($a as $z) {
			${'testCase' .  $key}[] = $z;
			//  			echo "<br>";
			// PRINT_R(${'testCase' .  $key});
			
			$answer = passTestCase(${'testCase' . $key}, $properNames, $i, $numofTestCasesinEveryQuestion);
		}
		
		
		
		//echo ("<br>This is the answer for this TC:  " . $answer);
		
		$testCases_Score[] = $answer;
		

		if(round($answer, 2) == round($fullCredit, 2)){
			$num_CorrectTestCases++;
		}
		elseif(round($answer, 2) == round($partialCredit, 2)){
			$num_CorrectTestCases++;
		}
		else{
			$num_CorrectTestCases += 0;
		}

 	}

	if(round($answer, 2) == round($partialCredit, 2)){

		$correctFunctionName+=0;
	}
	else{
		$correctFunctionName++;
	}

	${'testcaseINFO' .  $i}=array();
	${'testcaseINFO' .  $i}[] = $correctFunctionName;
	${'testcaseINFO' .  $i}[] = $num_CorrectTestCases;

	$testCases_Stats[] = ${'testcaseINFO' .  $i};


	// echo "<br> This is the stats: ";
	// print_R(${'testcaseINFO' .  $i});
	// echo "<br>";
	//
	//
	// echo ("<br>Used the Correct TestCase Name (1 = Yes, 0 = No):  " . $correctFunctionName);
	//
	// echo ("<br>Number of TestCases with correct Output: " . $num_CorrectTestCases);
	//
	//
	// echo "<br>";

	$QuestionScore = array_sum($testCases_Score);
	$QuestionScore = round($QuestionScore, 2);


	// echo "<br>Grade Sum for this Question = " . $QuestionScore . "<br> <br>";

	#Rebric of how  much each question is worth
	$QuestionScore = $QuestionScore * $valueofQuestion;
	#Append the score of each question to the array ExamScore.
	$QuestionScore = round($QuestionScore,  2);

	$ScoreS[] = $QuestionScore;

}

$FinalScore = array_sum($ScoreS);
$FinalScore = $FinalScore *100;

//Append FinalGrade to array of scores. Last index is final Grade.
$ScoreS[] = $FinalScore;
// echo"Scores of each question: ";
// print_R($ScoreS);


#Sums the scores in the array ExamScore to output the Students Grade.
// echo "<br>Score = " . $FinalScore . "%<br>";
//
// echo "<br><br>";
//
$testCases_Stats[] = $ScoreS;
//
// echo ("This is the complete array of stats: <br>");
//
// print_r($testCases_Stats);



//NEED TO GRAB POINTS FROM JUSTIN//////


echo json_encode($testCases_Stats);

?>

