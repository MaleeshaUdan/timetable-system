<?php
require_once "dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $selectedDay = $_POST["selectedDay"];
    $selectedTime = $_POST["selectedTime"];
    $selectedYear = $_POST["selectedyear"];
    $selectedCourse = $_POST["selectedcourse"];
    $selectedSemester = $_POST["selectedsemester"];

    
    $checkQuery = "SELECT Id FROM schedule WHERE Day = '$selectedDay' AND Time = '$selectedTime' AND Year_of_study = '$selectedYear' AND Course = '$selectedCourse' AND Semester = '$selectedSemester'";

    
    $result = $conn->query($checkQuery);

    if ($result->num_rows === 0) {
    
        echo '<script>alert("Record not found!"); window.location.href = "delete.php";</script>';
    } else {
        
        $sql = "DELETE FROM schedule WHERE Day = '$selectedDay' AND Time = '$selectedTime' AND Year_of_study = '$selectedYear' AND Course = '$selectedCourse' AND Semester = '$selectedSemester'";

    
        if ($conn->query($sql) === TRUE) {
        
            echo '<script>alert("Record has been deleted successfully!"); window.location.href = "delete.php";</script>';
        } else {
        
            echo '<script>alert("Error deleting record: ' . $conn->error . '"); window.location.href = "delete.php";</script>';
        }
    }
}
?>
