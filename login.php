<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .gradient-custom {
      
      background: #6a11cb;
      
      background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
     
      background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
    }

    
    .card {
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }

    .form-outline {
      position: relative;
    }

    .form-control {
      border: 2px solid #fff;
      border-radius: 0.5rem;
      color: #fff;
      background-color: transparent;
    }

    .form-control:focus {
      box-shadow: none;
    }

    .form-label {
      position: absolute;
      top: 0.75rem;
      left: 1rem;
      pointer-events: none;
      color: #fff;
      transition: 0.3s;
    }

    .form-control:focus + .form-label,
    .form-control:not(:placeholder-shown) + .form-label {
      top: -1rem;
      font-size: 0.8rem;
    }

    .btn-outline-light {
      border-color: #fff;
      color: #fff;
    }

    .btn-outline-light:hover {
      background-color: #fff;
      color: #6a11cb;
    }
  </style>
</head>
<body>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <!-- Add the form element -->
              <form action="loginFunction.php" method="post">
                <div class="mb-md-5 mt-md-4 pb-5">
                  <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                  <p class="text-white-50 mb-5">Please enter your login and password!</p>

                  <div class="form-outline form-white mb-4">
                    <input type="text" id="username" name="username" required class="form-control form-control-lg" />
                    <label class="form-label" for="typeusername">Username</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" id="typePasswordX" name ="password"  required class="form-control form-control-lg" />
                    <label class="form-label" for="typePasswordX">Password</label>
                  </div>

                  <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
