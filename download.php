<?php
require_once 'dbconfig.php'; 

session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Access Denied, Log in First.'); window.location.href = 'login.php';</script>";
    exit();
}

require('TCPDF-main/tcpdf.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedYear = $_POST['selectedyear'];
    $selectedCourse = $_POST['selectedcourse'];

    $query = "SELECT Day, Time, Subject, Venue FROM schedule WHERE Year_of_study = $selectedYear AND Course = '$selectedCourse'";
    $result = mysqli_query($conn, $query);

    
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    
    function customSort($a, $b) {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $dayComparison = array_search($a['Day'], $days) - array_search($b['Day'], $days);
        if ($dayComparison === 0) {
            return compareTimes($a['Time'], $b['Time']);
        }
        return $dayComparison;
    }
    
    function compareTimes($time1, $time2) {
        $timeRanges = [
            '8.30-9.30', '9.30-10.30', '10.30-11.30', '11.30-12.30',
            '12.30-1.30', '1.30-2.30', '2.30-3.30', '3.30-4.30'
        ];

        $index1 = array_search($time1, $timeRanges);
        $index2 = array_search($time2, $timeRanges);

        return $index1 - $index2;
    }

    usort($rows, 'customSort');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetCreator('Your Application');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Timetable PDF');
    $pdf->AddPage();

    $logoPath = 'assets/img/logo.jpg'; 
    $pdf->Image($logoPath, 2, 2, 20);

    $pdf->SetFont('times', '', 14);
    $pdf->Cell(0, 10, 'Faculty of Applied Science of University of Vavuniya Time table', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Year of Study: ' . $selectedYear, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Course: ' . $selectedCourse, 0, 1, 'L');
    
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(40, 10, 'Day', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Time', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Subject', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Venue', 1, 1, 'C');

    foreach ($rows as $row) {
        $day = $row['Day'];
        $time = $row['Time'];
        $subject = $row['Subject'];
        $venue = $row['Venue'];

        $pdf->SetFont('times', '', 12);
        $pdf->Cell(40, 10, $day, 1, 0, 'C');
        $pdf->Cell(40, 10, $time, 1, 0, 'C');
        $pdf->Cell(40, 10, $subject, 1, 0, 'C');
        $pdf->Cell(60, 10, $venue, 1, 1, 'C');
    }

    $filename = 'Timetable_' . $selectedCourse . '_' . $selectedYear . '.pdf';
    $pdf->Output($filename, 'D');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Time Table System</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    
        <a class="navbar-brand ps-3" href="index.php">TT SYSTEM BACKEND</a>
        
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">   
        </form>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Dashboard</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Add    
                        </a>
                        <a class="nav-link" href="update.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sync-alt"></i></div> Update   
                        </a>
                        <a class="nav-link" href="delete.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-trash-alt"></i></div> Delete  
                        </a>
                        <a class="nav-link" href="signup.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div> Create User   
                        </a>
                        <a class="nav-link" href="userlog.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div> User Log info   
                        </a>
                        <a class="nav-link" href="download.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-download"></i></div> Download Time table   
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php
                            if (isset($_SESSION['name'])) {
                                echo $_SESSION['name'];
                            } else {
                                echo "Unauthorized Access";
                            }
                        ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
            <div class="container-fluid px-4">
                    <h1 class="mt-4">Time Table System</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Download Time Table</li>
                    </ol>
                    <div class="card mb-4">
                    <!--Starting the selection menu-->    
                    <div class="card-body">
                        <form action="download.php" method="POST">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="yearofstudy">Year of Study:</label>
                                    <select class="form-select" id="yearDropdown" name="selectedyear" required>
                                        <option value="">Select the year of study</option>
                                        <option value="1">1ST YEAR</option>
                                        <option value="2">2ND YEAR</option>
                                        <option value="3">3RD YEAR</option>
                                        <option value="4">4TH YEAR</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="departmentDropdown">Course:</label>
                                    <select class="form-select" id="courseDropdown" name="selectedcourse" required>
                                        <option value="">Select the course</option>
                                        <option value="CS">CS</option>
                                        <option value="APPLIED MATHEMATICS">APLLIED MATHEMATICS</option>
                                        <option value="IT">IT</option>
                                        <option value="BIOLOGY">BIOLOGY</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Download as PDF</button>
                        </form>
                    </div>
                     <!--End of the selection menu-->   
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; University of Vavuniya 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>




    <script>
        // Function to toggle the visibility of the "CS" option and Semester option 2 based on the selected Year of Study
        function toggleCSAndSemesterVisibility() {
            const yearDropdown = document.getElementById("yearDropdown");
            const courseCSOption = document.querySelector('#courseDropdown option[value="CS"]');
            const semesterOption2 = document.querySelector('#semesterDropdown option[value="2"]');

            if (yearDropdown.value === "4") {
                courseCSOption.style.display = "block";
                semesterOption2.style.display = "none";
            } else {
                courseCSOption.style.display = "block";
                semesterOption2.style.display = "block";
            }
        }

        // Call the toggleCSAndSemesterVisibility function initially to set the initial visibility of the "CS" option and Semester option 2
        toggleCSAndSemesterVisibility();

        // Add an event listener to the Year of Study dropdown to update the visibility of the "CS" option and Semester option 2 on change
        document.getElementById("yearDropdown").addEventListener("change", toggleCSAndSemesterVisibility);
    </script>
    
    <script>
       //auto logout JS function
        function startSessionTimeout() {
            setTimeout(function() {
                window.location.href = 'autologout.php';
            }, 20 * 60 * 1000); 
        }

        startSessionTimeout();

        document.addEventListener('mousemove', function() {
            startSessionTimeout();
        });

        document.addEventListener('keypress', function() {
            startSessionTimeout();
        });
    </script>

</body>
</html>
