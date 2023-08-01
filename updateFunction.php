<?php
require_once 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $day = $_POST['selectedDay'];
    $time = $_POST['selectedTime'];
    $year = $_POST['selectedyear'];
    $course = $_POST['selectedcourse'];
    $semester = $_POST['selectedsemester'];
    $subject = $_POST['subject'];
    $venue = $_POST['selectedvenue'];

    $subject = str_replace(' ', '', strtoupper($subject));

    if (($year === '1' || $year === '2') && $course === 'CS') {
        echo "<script>alert('Course CS is not valid for 1st and 2nd year.'); window.location.href = 'index.php';</script>";
        exit;
    }

    
    if ($year === '4' && $semester === '2') {
        echo "<script>alert('Year of study 4th year with 2nd-semester combination is not valid.'); window.location.href = 'index.php';</script>";
        exit;
    }

    
    $checkSql = "SELECT * FROM schedule WHERE Day = ? AND Time = ? AND Year_of_study = ? AND Course = ? AND Semester = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ssiss", $day, $time, $year, $course, $semester);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        
        $updateSql = "UPDATE schedule SET Subject = ?, Venue = ? WHERE Day = ? AND Time = ? AND Year_of_study = ? AND Course = ? AND Semester = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssssiss", $subject, $venue, $day, $time, $year, $course, $semester);

        if ($updateStmt->execute()) {
    
            echo "<script>alert('Data updated successfully!'); window.location.href = 'update.php';</script>";
        } else {
            
            echo "<script>alert('Error: " . $updateStmt->error . "'); window.location.href = 'update.php';</script>";
        }

        
        $updateStmt->close();
    } else {
    
        echo "<script>alert('Data does not exist.'); window.location.href = 'update.php';</script>";
    }

    
    $checkStmt->close();
}


$conn->close();
?>
