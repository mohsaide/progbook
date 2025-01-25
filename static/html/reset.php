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

  <title>Reset Password</title>


  <!-- Favicons -->
  <link href="../img/logo.jpg" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../css/main.css" rel="stylesheet">
  <link href="../css/reset.css" rel="stylesheet">

</head>

<body class="sections-bg">

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
            <li><a href="../html/login.php">Sign in</a></li>
            <li>Reset</li>   
          </ol>
        </div>
      </nav> 
    </div><!-- End Breadcrumbs -->


<div class="container d-flex justify-content-center align-items-center vh-75 ">

  <form class="card text-center" style="width: 400px;" id='autoreset_from'>
    <div class="card-header h5 text-white bg-primary" style="background-color: #008374 !important">Password Reset</div>
    <div class="card-body px-5">
        <p class="card-text py-2">
          Enter your email address to reset your password from our side.
        </p>
        <div class="form-outline">
            <input type="email" id="typeEmail" name ='email' class="form-control my-3" />
        </div>
        <a type="button"  class="btn btn-primary btn-lg custom-submit-button"
                  style="padding-left: 2.5rem; padding-right: 2.5rem; border: white; background-color: #008374;" onclick="AutoRset(event)" >Reset</a>
        </div>

        <p class="card-text py-2 " id='response_box' style="color:white;">
        </p>
        

  </form>
  


</div>

</div>

  </main><!-- End #main -->

  
  <?php
    include('footer.php');
  ?> 
   

  <!-- Vendor JS Files -->
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/aos/aos.js"></script>
  <script src="../vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../js/reset.js"></script>

</body>

</html>