<?php

session_start(); 
if(isset($_SESSION['AuthToken']) && isset($_SESSION['UserId']))
{
    
    include 'connection.php';
    $set_auth = "select * from user_auth where user_id = '".$_SESSION['UserId']."' and value = '".$_SESSION['AuthToken']."'  ;" ;
    
    $rs = mysqli_query($conn, $set_auth);
    if (mysqli_num_rows($rs) == 0)
    {
            header("Location:../../../assets/html/401.php");
            exit();

    }
    else
    {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
    
}
else
{

    header("Location:../../../assets/html/401.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../assets/img/logo.jpg">


    <title>CLS - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/custom_dash.css" rel="stylesheet">

     <!-- Vendor css -->
     <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

     <style>
  body {
    min-width: 576px; /* 4 grid columns at small screen size (576px) */
  }
</style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


            <!-- logo  -->

              <nav class="navbar justify-content-center">
                <a class="navbar-brand" href="main.php">
                  <img src="../../../assets/img/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="cls">
                </a>
              </nav>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="main.php">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                My Workspace
            </div>

                        <!-- Nav Item - Pages Collapse Menu -->
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#peo"
                                aria-expanded="true" aria-controls="collapsePages">
                                <i class="bi bi-people"></i>
                                <span>People</span>
                            </a>
                            <div id="peo" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <a class="collapse-item" href="http://clsonline.org/dashboard/assets/html/friends.php?TYPE=con">Frineds</a>
                                    <a class="collapse-item" href="http://clsonline.org/dashboard/assets/html/friends.php?TYPE=block">Bocked</a>
                                    <a class="collapse-item" href="http://clsonline.org/dashboard/assets/html/friends.php?TYPE=uncon">Others</a>
                                </div>
                            </div>
                        </li>
            
            
            
            
                        <!-- Nav Item - Pages Collapse Menu -->
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tool"
                                aria-expanded="true" aria-controls="collapsePages">
                                <i class="bi bi-lightning-charge"></i>
                                <span>Speedy</span>
                            </a>
                            <div id="tool" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <a class="collapse-item" href="http://clsonline.org/dashboard/assets/html/profile.php?UserId=<?php echo $_SESSION['UserId'] ?>">Profile</a>
                                    <a class="collapse-item" href="http://clsonline.org/dashboard/assets/html/inbox.php">My Inbox</a>
                                    <a class="collapse-item" href="http://clsonline.org/dashboard/assets/html/notifications.php">Notifications</a>
                                </div>
                            </div>
                        </li>

            
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-robot"></i>
                    <span>Advico</span></a>
            </li>


  


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                My University
            </div>


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="table.php?content=universities">
                    <i class="bi bi-buildings-fill"></i>
                    <span>Universities</span></a>
            </li>
            
            
              <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="table.php?content=programs">
                    <i class="bi bi-book-half"></i>
                    <span>Programs</span></a>
            </li>


              <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="table.php?content=offers">
                    <i class="bi bi-briefcase-fill"></i>
                    <span>Offers</span></a>
            </li>
            
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
 
            
            <!-- Feedback Space -->
            <li class="nav-item">
                <a class="nav-link feedback-link">
                    <i class="bi bi-chat-left-text"></i>
                    <span>RATE US</span>
                    <form class="feedback-form" id="feedback_area" style="display: block;">
                        <div class="form-group">
                                    <label for="rating">Feedback:</label>
                            <textarea class="form-control feedback-textarea" rows="3" placeholder="Enter your feedback" style="min-height: 100px;" name='feedback'></textarea>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <select class="form-control" id="rating" name='stars'>
                                <option value="1">★</option>
                                <option value="2">★★</option>
                                <option value="3">★★★</option>
                                <option value="4">★★★★</option>
                                <option value="5">★★★★★</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="rate(event)">Submit</button>
                    </form>
              </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

                        
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline mt-4">
                <button class="rounded-circle border-0" id="sidebarToggle" onclick='hide(event)'></button>
            </div>
            
            <script>
            
            function hide(event)
{
    event.preventDefault();

    if (document.getElementById('feedback_area').style.display ==='none') 
    {  
        document.getElementById('feedback_area').style.display = '' ;
    }
    else
    {
        document.getElementById('feedback_area').style.display = 'none';
        
    }
    
}

            </script>

        </ul>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!--<form-->
                    <!--    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">-->
                    <!--    <div class="input-group">-->
                    <!--        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."-->
                    <!--            aria-label="Search" aria-describedby="basic-addon2">-->
                    <!--        <div class="input-group-append">-->
                    <!--            <button class="btn btn-primary" type="button">-->
                    <!--                <i class="fas fa-search fa-sm"></i>-->
                    <!--            </button>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</form>-->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
  
                            <a class="nav-link dropdown-toggle" href="notifications.php" >
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">+1</span>
                            </a>
                           
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="inbox.php" >
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">+1</span>
                            </a>
                         
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php 
                                    try {
                                    include 'connection.php';
                                    $query= "select concat (first_name , ' ' , last_name) as fullname from user where id = '".$_SESSION['UserId']."' ;" ;
                                    $result = mysqli_query($conn, $query);
                                    $data = mysqli_fetch_assoc($result);
                                    echo $data['fullname']; 
                                       
                                    } catch (\Throwable $th) {
                                       
                                        echo 'Unkown User';
                                    }
                                    ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../../../assets/img/user/<?php 
                                    try {
                                    include 'connection.php';
                                    $query= "select image from user where id = '".$_SESSION['UserId']."' ;" ;
                                    $result = mysqli_query($conn, $query);
                                    $data = mysqli_fetch_assoc($result);
                                    echo $data['image'].'?t='.time(); 
                                       
                                    } catch (\Throwable $th) {
                                       
                                        echo 'default.png';
                                    }
                                    ?>">
                                    
                            </a>
                            <!-- Dropdown - User Information -->
                           <!--////// profile edie-->
                                
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                
                                <a class="dropdown-item" href="profile.php?UserId=<?php echo $_SESSION['UserId'] ?>">
                                    
                                    <i class="bi bi-person-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                                    profile
                                </a>
                                <div class="dropdown-divider"></div>
                                
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#support_modal">
                                    <i class="fas fa-headset fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Support Team
                                </a>
                               
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#manual_reset">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                
                                <a class="dropdown-item"  href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
