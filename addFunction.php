<?php
require_once 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $day = $_POST['selectedDay'];
    $time = $_POST['selectedTime'];
    $year = $_POST['selectedyear'];
    $course = $_POST['selectedcourse'];
    $semester = $_POST['selectedsemester'];
    $subject = $_POST['subject'];
    $venue = $_POST['selectedvenue'];


    if (($year === '1' || $year === '2') && $course === 'CS') {
        echo "<script>alert('Course CS is not valid for 1st and 2nd year.'); window.location.href = 'index.php';</script>";
        exit;
    }

    
    if ($year === '4' && $semester === '2') {
        echo "<script>alert('Year of study 4th year with 2nd-semester combination is not valid.'); window.location.href = 'index.php';</script>";
        exit;
    }

    
    $subject = str_replace(' ', '', strtoupper($subject));


    $checkSql = "SELECT * FROM schedule WHERE Day = ? AND Time = ? AND Year_of_study = ? AND Course = ? AND Semester = ? AND Subject = ? AND Venue = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ssissss", $day, $time, $year, $course, $semester, $subject, $venue);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        
        echo "<script>alert('Data already exists.'); window.location.href = 'index.php';</script>";
        exit;
    }


    $checkSql = "SELECT * FROM schedule WHERE Day = ? AND Time = ? AND Year_of_study = ? AND Course = ? AND Semester = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ssiss", $day, $time, $year, $course, $semester);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        
        echo "<script>alert('Time slot already occupied.'); window.location.href = 'index.php';</script>";
        exit;
    }

    $checkSql = "SELECT * FROM schedule WHERE Day = ? AND Time = ? AND Venue = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("sss", $day, $time,$venue);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        
        echo "<script>alert('Venue already occupied.'); window.location.href = 'index.php';</script>";
        exit;
    }


    
    $insertSql = "INSERT INTO schedule (Day, Time, Year_of_study, Course, Semester, Subject, Venue) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("ssissss", $day, $time, $year, $course, $semester, $subject, $venue);

    
    if ($insertStmt->execute()) {
        
        echo "<script>alert('Data inserted successfully!');window.location.href = 'index.php';</script>";
    } else {
        
        echo "<script>alert('Error: " . $insertStmt->error . "');window.location.href = 'index.php';</script>";
    }

    
    $insertStmt->close();
    $checkStmt->close();
}


$conn->close();
?>
