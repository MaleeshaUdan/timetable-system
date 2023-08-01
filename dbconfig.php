<?php

$hostname = "testdbunivau.mysql.database.azure.com";
$username = "maleesha";
$password = "b82D6iAGqmaJm6d";
$database = "unidb";
$ca_cert_path = "C:\Users\Maleesha\Desktop\Microsoft Azure VM\DigiCertGlobalRootCA.crt.pem";

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, $ca_cert_path, NULL, NULL);
mysqli_real_connect($conn, $hostname, $username, $password, $database, 3306, MYSQLI_CLIENT_SSL);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>