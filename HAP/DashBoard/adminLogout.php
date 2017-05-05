<?php

session_start();
 $base_url = 'http://localhost:8080/hapservices/v1/logout';

$url = $base_url;


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$responce=curl_exec($ch);
  
header("Location: http://localhost:8080/HAP/registration/loginAdmin.php");