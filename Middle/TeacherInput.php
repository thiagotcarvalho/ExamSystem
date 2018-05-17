<?php
$string1 = $_POST["questionTopic"];
$string2 = $_POST["newQuestion"];
$string3 = $_POST["difficulty"];
$string4 = $_POST["testCaseOne"];
$string5 = $_POST["testCaseAnsOne"];


$rawPostData= array(
	"questionTopic" => $string1,
	"newQuestion" => $string2,
	"difficulty" => $string3,
	"testCaseOne" => $string4,
	"testCaseAnsOne" => $string5,
	
);
if (isset($_POST['testCaseTwo']) && isset($_POST['testCaseAnsTwo'])){
    $rawPostData['testCaseTwo'] = $_POST['testCaseTwo'];
    $rawPostData['testCaseAnsTwo'] = $_POST['testCaseAnsTwo'];
}
if (isset($_POST['testCaseThree']) && isset($_POST['testCaseAnsThree'])){
    $rawPostData['testCaseThree'] = $_POST['testCaseThree'];
    $rawPostData['testCaseAnsThree'] = $_POST['testCaseAnsThree'];
}

if (isset($_POST[‘testCaseFour’]) && isset($_POST[‘testCaseAnsFour’])) {
       $rawPostData[‘testCaseFour’] = $_POST[‘testCaseFour’];
       $rawPostData[‘testCaseAnsFour’] = $_POST[‘testCaseAnsFour’];
}

if (isset($_POST[‘testCaseFive’]) && isset($_POST[‘testCaseAnsFive’])) {
       $rawPostData[‘testCaseFive’] = $_POST[‘testCaseFive’];
       $rawPostData[‘testCaseAnsFive’] = $_POST[‘testCaseAnsFive’];
}


$urlBackend = 'https://web.njit.edu/~jmk62/CS490/addQuestions.php';

$ch2 = curl_init($urlBackend);

curl_setopt($ch2,CURLOPT_URL, $urlBackend);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $rawPostData);
curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);

$resp2 = curl_exec($ch2);
echo $resp2;
curl_close($ch2);



#DONEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE

?>



