<?php

include 'header.php' ;

?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Heading -->
                    <h1 class="h3 mb-2 text-gray-800">
                        <?php 
                        
                        if ($_GET['content'] == 'programs')
                        {
                        echo 'Programs';
                        }
                        elseif ($_GET['content'] == 'universities')
                        {
                        echo 'Universities';
                        }
                        elseif ($_GET['content'] == 'offers')
                        {
                        echo 'Offers' ;
                        }
                        else
                        {
                        echo '<script> window.location.href = "http://clsonline.org/assets/html/404.php"; </script>';
                        }

                        ?>
                    </h1>
                    <!-- description -->
                    <p class="mb-4"> 
                      <?php 
                        
                        if ($_GET['content'] == 'programs')
                        {
                        echo 'The following is a set of programs offered with details about them.';
                        }
                        elseif ($_GET['content'] == 'universities')
                        {
                        echo 'The following is a set of universities with details about them.';
                        }
                        elseif ($_GET['content'] == 'offers')
                        {
                        echo 'The following is a set of offers with details about them.' ;
                        }
                        else
                        {
                        echo '<script> window.location.href = "http://clsonline.org/assets/html/404.php"; </script>';
                        }

                        ?>
                    </p>




                    <!-- table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold" style='color:#138475;'>Live Data</h6>
                            
                            <a onclick='downloadTableAsCSV(event)' class="d-none d-sm-inline-block btn btn-sm shadow-sm" style='background-color:#138475; color:white;'><i
                                class="fas fa-download fa-sm text-white-50"></i> Download</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    
                                  
                                    
                                    <thead class='bg-primary'>
                                        <tr>
                                            
                                            
                                              <?php
                                    
                                     if ($_GET['content'] == 'programs')
                                    {
                                        
                                        $list = [ 'Name' , 'University' , 'Branch' ,  'College' , 'Low Accept Mark'  ];
                                        
                                        for ($i = 0; $i < count($list); $i++)
                                        {
                                            echo '<th>'.$list[$i].'</th>';
                                        }
                                    
                                    }
                                    elseif ($_GET['content'] == 'universities')
                                    {
                                         
                                        $list = [ 'Name' ,  'Code' , 'Owner' ];
                                        
                                        for ($i = 0; $i < count($list); $i++)
                                        {
                                            echo '<th>'.$list[$i].'</th>';
                                        }
                                    
                                    
                                   
                                    }
                                    elseif ($_GET['content'] == 'offers')
                                    {
                                             
                                        $list = [ 'University' , 'Position' , 'Status' , 'Experience' ];
                                        
                                        for ($i = 0; $i < count($list); $i++)
                                        {
                                            echo '<th>'.$list[$i].'</th>';
                                        }
                                    
                                    
                                    }
                                    else
                                    {
                                        
                                        echo '<script> window.location.href = "http://clsonline.org/assets/html/404.php"; </script>';
                                        
                                    }
                                    
                                    
                                    ?>
                                           
                                           
                                        </tr>
                                    </thead>
                                    
                                    
                                    <tfoot class='bg-primary'>
                                        <tr>
                                              <?php
                                    
                                     if ($_GET['content'] == 'programs')
                                    {
                                        
                                        $list = [ 'Name' , 'University' , 'Branch' , 'College' , 'Low Accept Mark'  ];
                                        
                                        for ($i = 0; $i < count($list); $i++)
                                        {
                                            echo '<th>'.$list[$i].'</th>';
                                        }
                                    
                                    }
                                    elseif ($_GET['content'] == 'universities')
                                    {
                                         
                                        $list = [ 'Name' , 'Code' , 'Owner' ];
                                        
                                        for ($i = 0; $i < count($list); $i++)
                                        {
                                            echo '<th>'.$list[$i].'</th>';
                                        }
                                    
                                    
                                   
                                    }
                                    elseif ($_GET['content'] == 'offers')
                                    {
                                             
                                        $list = [ 'University' , 'Position' , 'Status' , 'Experience' ];
                                        
                                        for ($i = 0; $i < count($list); $i++)
                                        {
                                            echo '<th>'.$list[$i].'</th>';
                                        }
                                    
                                    
                                    }
                                    else
                                    {
                                        
                                        echo '<script> window.location.href = "http://clsonline.org/assets/html/404.php"; </script>';
                                        
                                    }
                                    
                                    
                                    ?>
                                        </tr>
                                    </tfoot>
                                    
                                    
                                    
                                    
                                    <tbody>
                                        
                                        
                                             <?php
                                    
                                     if ($_GET['content'] == 'programs')
                                    {
                                        
                                         $query = "select program.name program , university.name university , branch.name branch , college.name college , program.low_accept_mark lam from program left join 
                                                    college on college_id = college.id
                                                    left join branch on branch_id = branch.id
                                                    left join university on university_id = university.id ;";
                                    
                                    $result = mysqli_query($conn, $query);
                                    $data = array();
                                    
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                            $data[] = $row;
                                    }
                                    
                                    foreach ($data as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$row['program'].'</td>';
                                        echo '<td>'.$row['university'].'</td>';
                                        echo '<td>'.$row['branch'].'</td>';
                                        echo '<td>'.$row['college'].'</td>';
                                        echo '<td>'.$row['lam'].'</td>';
                                        echo '</tr>';
                                    }
                                        
                                      
                                    }
                                    elseif ($_GET['content'] == 'universities')
                                    {
                                       
                                    $query = "SELECT university.name, university.code, user.email
                                              FROM university
                                              LEFT JOIN university_member ON university_id = university.id AND role = 'OWN'
                                              LEFT JOIN user ON user_id = user.id";
                                    
                                    $result = mysqli_query($conn, $query);
                                    $data = array();
                                    
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                            $data[] = $row;
                                    }
                                    
                                    foreach ($data as $row)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$row['name'].'</td>';
                                        echo '<td>'.$row['code'].'</td>';
                                        echo '<td>'.$row['email'].'</td>';
                                        echo '</tr>';
                                    }

                                    
                                   
                                    }
                                    elseif ($_GET['content'] == 'offers')
                                    {
                                                     
                                            $query = "select university.name university , program.name position , offer.status , offer.experience  from offer 
                                                        left join program on program_id = program.id
                                                        left join college on college_id  = college.id
                                                        left join branch on branch.id = branch_id
                                                        left join university on university.id = university_id ; ";
                                            
                                            $result = mysqli_query($conn, $query);
                                            $data = array();
                                            
                                            while ($row = mysqli_fetch_assoc($result))
                                            {
                                                    $data[] = $row;
                                            }
                                            
                                            foreach ($data as $row)
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$row['university'].'</td>';
                                                echo '<td>'.$row['position'].'</td>';
                                                echo '<td>'.$row['status'].'</td>';
                                                 echo '<td>'.$row['experience'].'</td>';
                                                echo '</tr>';
                                            }
        
                                            
                                    
                                    
                                    }
                                    else
                                    {
                                        
                                        echo '<script> window.location.href = "http://clsonline.org/assets/html/404.php"; </script>';
                                        
                                    }
                                    
                                    
                                    ?>
                                       
                                    </tbody>
                                    
                                    
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    

                </div>
                <!-- /.container-fluid -->
                
                <script src='../js/table.js'></script>
                

<?php
include 'footer.php' ;
?>