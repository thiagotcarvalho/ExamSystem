<?php
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
print_r($respQuestions);

// $jsonQuest = json_decode($respQuestions, true);
// print_r($jsonQuest);
?>