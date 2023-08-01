<?php

require_once 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];


    if ($password !== $confirmPassword) {
        echo "<script>alert('Password and Confirm Password do not match.'); window.location.href = 'signup.php';</script>";
        exit();
    }

    
    $stmt = $conn->prepare('SELECT COUNT(*) FROM user WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($userCount);
    $stmt->fetch();
    $stmt->close();

    if ($userCount > 0) {
        echo "<script>alert('Username already exists.'); window.location.href = 'signup.php';</script>";
        exit();
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $insertStmt = $conn->prepare('INSERT INTO user (Name, username, password) VALUES (?, ?, ?)');
    $insertStmt->bind_param('sss', $name, $username, $hashedPassword);

    if ($insertStmt->execute()) {
        $insertStmt->close();
    
        echo "<script>alert('User created successfully!'); window.location.href = 'index.php';</script>"; 
        exit();
    } else {
        $insertStmt->close();
        echo "<script>alert('Failed to create user. Please try again.'); window.location.href = 'signup.php';</script>";
        exit();
    }
}


$conn->close();
?>
