<?php
session_start();

require_once 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT username, password, Name FROM user WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($dbUsername, $hashedPassword, $name);
    $stmt->fetch();
    $stmt->close();

    
    if ($dbUsername && password_verify($password, $hashedPassword)) {
        
        $_SESSION['username'] = $dbUsername;
        $_SESSION['name'] = $name;

        require_once 'logDetails.php';
        
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Username or password incorrect!'); window.location.href = 'login.php';</script>";
        exit();
    }
}

$conn->close();
?>
