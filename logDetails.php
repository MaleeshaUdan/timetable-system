<?php
require_once 'dbconfig.php';

date_default_timezone_set('Asia/Colombo');

$dbUsername = $_SESSION['username'];
$name = $_SESSION['name'];

//$time = date('H:i:s');
$time = date('g:i A');
$date = date('Y-m-d');

$ipaddress = $_SERVER['REMOTE_ADDR'];

$stmt = $conn->prepare("INSERT INTO userloginfo (Username, Name, time, date, ipaddress) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $dbUsername, $name, $time, $date, $ipaddress);

$stmt->execute();

$stmt->close();
$conn->close();
?>
