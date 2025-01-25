<?php 
session_start(); 
if (!empty($_SESSION)) {
  session_destroy();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CLS - Sign in</title>

  <!-- Favicons -->
  
<link href="/assets/img/logo1.jpg" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../css/main.css" rel="stylesheet">
  <link href="../css/login.css" rel="stylesheet">

</head>

<body>

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="../../index.php" class="logo d-flex align-items-center">
        <img src="../img/logo.jpg" alt="logo">
        <h1>CLS<span>.</span></h1>
      </a>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <nav>
        <div class="container">
          <ol>
            <li><a href="../../index.php">Home</a></li>
            <li>Sign in</li>
          </ol>
        </div>
      </nav> 
    </div><!-- End Breadcrumbs -->


    <section class="sections-bg">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="../img/statics/signin.png"
              class="img-fluid" >
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">


            <form method="POST" id='signin_from'>    
              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="email">Email address</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg"
                  placeholder="Enter a valid email address" />
              </div>
    
    <!-- Password input -->
              <div class="form-outline mb-3">
  <label class="form-label" for="password">Password</label>
  <div class="input-group">
    <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Enter password" />
    <button class="btn btn-outline-secondary" id='show_btn' type="button" onclick="togglePasswordVisibility()">
      <i class="bi bi-eye"></i>
    </button>
  </div>
</div>


<!-- ------------------------------------ -->

    
              <div class="d-flex justify-content-between align-items-center">
                <a href="../html/signup.php#breadcrumbs" class="text-body form-link">Don't have an account?</a>
                <a href="../html/reset.php" class="text-body form-link">Forgot password?</a>
              </div>

              
              <br>
               <!-- Password input -->
              <div class="form-outline mb-3" style="color:red; text-align:center; display: none;" id='response_message'>
                <br>
                <div class="form-label justify-content-center align-items-center" for="form3Example4"></div>
              </div>

    
              <div class="text-center text-lg-start mt-4 pt-2">
                 <button type="button" class="btn btn-primary btn-lg custom-submit-button" onclick="login(event)"
                  style="padding-left: 2.5rem; padding-right: 2.5rem; border: white; background-color: #008374;">Login</button>
              </div>

              
    
            </form>
          </div>
        </div>
      </div>

    </section>

  </main><!-- End #main -->


 
  <?php
    include('footer.php');
  ?> 
   

  <!-- Vendor JS Files -->
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Template Main JS File -->
  <script src="../js/login.js"></script>


</body>

</html>

