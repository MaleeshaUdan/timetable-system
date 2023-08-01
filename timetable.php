<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Time</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        
        .custom-header {
            background-color: #007bff; 
            color: #ffffff; 
            padding: 20px;
            text-align: center;
        }
        
        .subheader {
            font-size: 24px;
            font-weight: bold;
            color: #1e5799; 
        }
        
        .table-container {
            margin: 20px;
        }
    </style>
</head>
<body>
    <header class="custom-header">
        <div class="container">
            <h1 class="display-4">Faculty of Applied Science Time Table</h1>
            <p class="subheader">University of Vavuniya</p>
        </div>
    </header>

    <div class="card mb-4">
        <div class="card-body">
        <form action="" method="POST">
                <div class="row mb-3">
                    <div class="col-lg col-md-12 mb-3">
                        <label for="dayDropdown">Day:</label>
                        <select class="form-select" id="dayDropdown" name="selectedDay" required>
                            <option value="">Select a day</option>
                            <option value="Monday">MONDAY</option>
                            <option value="Tuesday">TUSEDAY</option>
                            <option value="Wednesday">WEDNESDAY</option>
                            <option value="Thursday">THURSDAY</option>
                            <option value="Friday">FRIDAY</option>
                        </select>
                    </div>
                    <div class="col-lg col-md-12 mb-3">
                        <label for="yearofstudy">Year of Study:</label>
                        <select class="form-select" id="yearDropdown" name="selectedyear" required>
                            <option value="">Select the year of study</option>
                            <option value="1">1ST YEAR</option>
                            <option value="2">2ND YEAR</option>
                            <option value="3">3RD YEAR</option>
                            <option value="4">4TH YEAR</option>
                        </select>
                    </div>
                    <div class="col-lg col-md-12 mb-3">
                        <label for="departmentDropdown">Course:</label>
                        <select class="form-select" id="courseDropdown" name="selectedcourse" required>
                            <option value="">Select the course</option>
                            <option value="CS">CS</option>
                            <option value="APPLIED MATHEMATICS">APPLIED MATHEMATICS</option>
                            <option value="IT">IT</option>
                            <option value="BIOLOGY">BIOLOGY</option>
                        </select>
                    </div>
                    <div class="col-lg col-md-12 mb-3">
                        <label for="semester">Semester:</label>
                        <select class="form-select" id="semesterDropdown" name="selectedsemester" required>
                            <option value="">Select the semester</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Show</button>
                <button class="btn btn-danger" type="reset">Clear</button>
            </form>
        </div>
    </div>
    <div class="table-container">
        <?php
        
        include_once 'dbconfig.php';

        $sql = "SELECT Time, Subject, Venue FROM schedule WHERE Day = ?  AND Year_of_study = ? AND Course = ? AND Semester = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "siss", $_POST['selectedDay'], $_POST['selectedyear'], $_POST['selectedcourse'], $_POST['selectedsemester']);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_store_result($stmt);


            if (mysqli_stmt_num_rows($stmt) > 0) {
                
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Time</th><th>Subject</th><th>Venue</th></tr></thead>";
                echo "<tbody>";

                
                mysqli_stmt_bind_result($stmt, $time, $subject, $venue);

            
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr><td>" . $time . "</td><td>" . $subject . "</td><td>" . $venue . "</td></tr>";
                }

                echo "</tbody></table>";
            } else {
                
                echo "No Record Found";
            }

        
            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
        ?>
    </div>
    <script>
        
        function clearForm() {
            
            document.getElementById("dayDropdown").value = "";
            document.getElementById("yearDropdown").value = "";
            document.getElementById("courseDropdown").value = "";
            document.getElementById("semesterDropdown").value = "";

            
            document.querySelector(".table-container").innerHTML = "";
        }

        
        document.querySelector(".btn-danger").addEventListener("click", function(event) {
            event.preventDefault(); 
            clearForm();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>
</body>
</html>
