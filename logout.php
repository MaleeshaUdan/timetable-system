<?php
session_start();

session_unset();

session_destroy();

echo "<script>alert('Logout Succesfully!'); window.location.href = 'login.php';</script>";
exit();
?>
