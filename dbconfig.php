<?php
//here i have implemented the database on cloud
$hostname = "_DB_URL_";
$username = "_enter_user_name";
$password = "enter_password_here";
$database = "_db_name";
$ca_cert_path = "_enter_the_path";

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, $ca_cert_path, NULL, NULL);
mysqli_real_connect($conn, $hostname, $username, $password, $database, 3306, MYSQLI_CLIENT_SSL);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
