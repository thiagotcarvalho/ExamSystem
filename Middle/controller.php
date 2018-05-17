<?php
session_start();

foreach ($_POST['questions'] as $key => $qID) {
	$data['questions[' . $key . ']'] = $qID;
}

foreach ($_POST['points'] as $key => $pointValue) {
	$data['points['.$key.']'] = $pointValue;
}

$data['examName'] = $_POST['examName'];
print_r($data);

$urlBackend = 'https://web.njit.edu/~jmk62/CS490/addExam.php';

//create a new cURL resource
$ch2 = curl_init($urlBackend);

curl_setopt($ch2,CURLOPT_URL, $urlBackend);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);

$resp2 = curl_exec($ch2);
echo $resp2;
curl_close($ch2);

// $jsondata1 = json_decode($resp2, true);

//print_r($jsondata1);

$pointsForTEST = $_POST['points'];


#DONEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE

?>

