<?php
    session_start();
        
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('Access Denied, Log in First.'); window.location.href = 'login.php';</script>";
        exit();
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
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">TT SYSTEM BACKEND</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">   
        </form>
        <!-- Navbar-->
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
                        <li class="breadcrumb-item active">Update</li>
                    </ol>
                    <div class="card mb-4">
                    <!--Starting the selection menu-->    
                    <div class="card-body">
                        <form action="updateFunction.php" method="POST">
                            <div class="row mb-3">
                                <div class="col">
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
                                <div class="col">
                                    <label for="timeDropdown">Time:</label>
                                    <select class="form-select" id="timeDropdown" name="selectedTime" required>
                                        <option value="">Select a time</option>
                                        <option value="8.30-9.30">8.30-9.30</option>
                                        <option value="9.30-10.30">9.30-10.30</option>
                                        <option value="10.30-11.30">10.30-11.30</option>
                                        <option value="11.30-12.30">11.30-12.30</option>
                                        <option value="1.30-2.30">1.30-2.30</option>
                                        <option value="2.30-3.30">2.30-3.30</option>
                                        <option value="3.30-4.30">3.30-4.30</option>
                                    </select>
                                </div>
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
                                        <option value="APPLIED_MATHEMATICS">APLLIED MATHEMATICS</option>
                                        <option value="IT">IT</option>
                                        <option value="BIOLOGY">BIOLOGY</option>
                                    </select>
                                </div>
                                
                                <div class="col">
                                    <label for="semester">Semester:</label>
                                    <select class="form-select" id="semesterDropdown" name="selectedsemester" required>
                                        <option value="">Select the semester</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="subjectInput" name="subject" placeholder="Enter the Subject Code Here" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="venue">Venue:</label>
                                    <select class="form-select" id="venueDropdown" name="selectedvenue" required>
                                    <option value="">Select the venue</option>
                                        <option value="NO">---NO---</option>
                                        <option value="ICTL">ICTL</option>
                                        <option value="CL1">CL1</option>
                                        <option value="CL2">CL2</option>
                                        <option value="LH1">LH1</option>
                                        <option value="LH2">LH2</option>
                                        <option value="SMART LECTURE HALL">SMART LECTURE HALL</option>
                                        <option value="EISL">EISL</option>
                                        <option value="EBL">EBL</option>
                                        <option value="ECL">ECL</option>
                                        <option value="SLH">SLH</option>
                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Update</button>
                            <button class="btn btn-danger" type="reset">Clear</button>
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
       
       function startSessionTimeout() {
           setTimeout(function() {
               window.location.href = 'autologout.php';
           }, 20 * 60 * 1000); // 20 minutes (20 minutes * 60 seconds * 1000 milliseconds)
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
