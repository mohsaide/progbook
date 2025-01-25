<?php

include 'header.php' ;

?>
                   
                   <div class="container">
                    <div class="row">
                        <div class="col-lg-9 right">

                            <div class="box shadow-sm rounded bg-white mb-3">

                                <div class="box-title border-bottom p-3">
                                    <h6 class="m-0">Notification Center</h6>
                                </div>

                                <div class="box-body p-0"  id='notifications_container'>

                   <?php
                   
                   try {
                       
                       include 'connection.php';

                        $query = "SELECT title, value, seen , cast(created as date ) as crtd FROM user_notifications WHERE user_id = ".$_SESSION["UserId"]." AND deleted = '0'";
                        $query2 = "update user_notifications set seen ='1' WHERE user_id = ".$_SESSION["UserId"]."; ";
                        
                        $result = mysqli_query($conn, $query);
                        mysqli_query($conn, $query2);
                        
                        if ($result) {
                            $data = array();
                            while ($row = mysqli_fetch_assoc($result)) {
                                $data[] = $row;
                            }
                            mysqli_free_result($result);
                            mysqli_close($conn);
            
                            foreach ($data as $row) {
                                $seen = '';
                                if ($row['seen']== '0')
                                {
                                  $seen = 'bg-primary';  
                                }
                                
                                echo ' <div class="p-3 d-flex align-items-center osahan-post-header '.$seen.'">
                                        <div class="dropdown-list-image mr-3">
                                           <i class="bi bi-bell-fill rounded-circle fs-3"></i>
                                        </div>
                                        <div class="mr-3">
                                            <div class="font-weight-bold mb-2">'.$row['title'].'</div>
                                            <p>'.$row['value'].'</p>
                                        </div>
                                        <span class="ml-auto mb-auto">
                                            <div class="text-right text-muted pt-1">'.$row['crtd'].'</div>
                                        </span>
                                    </div>';
                                

                            }
                          
                          
                    
                        }
                        else {
                            
                             echo '<script> window.location.href = "http://clsonline.org/assets/html/500.php";  </script>';
                           
                        }


                         
                        } catch (\Throwable $th) {
                            
                            // echo $th; exit();
                            echo '<script> window.location.href = "http://clsonline.org/assets/html/500.php";  </script>';
                          
                        }
                   
                   ?>




                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                
                
                </div>
            
                </div>


<?php
include 'footer.php' ;
?>