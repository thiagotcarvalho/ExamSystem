<?php
$string = $_POST["username"];
$string2 = $_POST["password"];	


$rawPostData= array(
	"user" => $string,
	"pass" => $string2,
);


$urlBackend = 'https://web.njit.edu/~jmk62/CS490/Model.php';
//create a new cURL resource
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


?>



