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

  <title>CLS -Sign up</title>   


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
  <link href="../css/signup.css" rel="stylesheet">  

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
    <div class="breadcrumbs" id='breadcrumbs'>
      <nav>
        <div class="container">
          <ol>
            <li><a href="../../index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li>Sign up</li>   
          </ol>
        </div>
      </nav> 
    </div><!-- End Breadcrumbs -->


    


    <section class="vh-auto container-fluid" >

      <div class="row">



          <form class="row col-md-6" id='signup_form' autocomplete="off">

            <div class="col-lg-8 mx-auto form-container">
              <h1 class="mb-1">Let's Get <span style="color: var(--color-primary);">Started</span> </h1>
              <hr class="hr" style="color: var(--color-primary);" />
              <form>
                <div class="row">
                  <div class="col-lg-6">

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input pattern="[A-Za-z]+" type="text" placeholder="Fname" class="form-control" id="first_name" name="first_name" required>
                      </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input pattern="[A-Za-z]+" type="text" class="form-control" placeholder="Lname" id="last_name" name="last_name" required>
                      </div>
                  </div>

                </div>


                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                    <select  style="color:#6C7592 !important;" class="form-control" id="gender" name='gender' required >
                      <option value=""  selected hidden>Gender</option>
                      <option value='M'>Male</option>
                      <option value="F">Female</option>
                    </select>   
                    </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="form-group">
                      <label for="DOB">Date Of Birth</label>
                    <input type="date" class="form-control" placeholder="Date of birth" id="DOB"  name="DOB" onkeydown="return false" min="<?php echo date('Y-m-d', strtotime('-70 years')); ?>" 
       max="<?php echo date('Y-m-d', strtotime('-15 years')); ?>"  required>
                      </div>
                  </div>
                </div>

                <div class="form-group">
                <label for="address">Country</label>
                <select style="color:#6C7592 !important;" class="form-control" id="address" name='address' required >
                  <option value=""  selected hidden>Country - City</option>
                </select>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" placeholder="E-mail" id="email" name="email" required>
                  </div>
    
                  <div class="form-group">
                    <label for="phone">Phone </label>
                    <input type="tel" class="form-control" id="phone" placeholder="xxx xxx xxxx" name="phone" pattern="[0-9]{10}" >
                  </div>

    
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                  </div>

                  <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password" required>
                  </div>

                  <div class="form-group mt-3">
              
                    <button type="submit" class="btn btn-primary col-5  my-3 me-4" onclick=" signup(event)">Register</button>
                    <input type="reset" name="reset" value="Reset"  class="btn btn-primary col-5  my-3">

                  </div>
                  
              </form>
            </div>
          </from>

        
      <img src="../img/statics/signup.svg"
      class="img-fluid col-md-6" alt="signup">
       
      


    </div>

    </section>



  



  </main><!-- End #main -->

  <?php
include('footer.php');
   ?>



  <!-- Vendor JS Files -->
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Template Main JS File -->
  <script src="../js/signup.js"></script>

</body>

</html>