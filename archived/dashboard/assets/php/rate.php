<?php

header('Content-Type: application/json');
error_reporting(E_ALL & ~E_WARNING);
include 'connection.php' ; 
session_start();


 if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        try
        {
            
          if ( !isset($_SESSION['UserId']) || !isset($_SESSION['AuthToken']) )
          {

            header('HTTP/1.1 401 UNAUTHORIZED');
            $response['status'] ='401_UNAUTHORIZED' ;
            $response['data'] = array("success_flag" => 1 , "message" => 'UNAUTHORIZED' );
            echo json_encode($response) ;  
            exit();
             
          }
          else
           {
            
            $query = "select * from user_auth where user_id = '".$_SESSION['UserId']."' and value = '".$_SESSION['AuthToken']."'  ;" ;
            
            $rs = mysqli_query($conn, $query);
            if (mysqli_num_rows($rs) == 0)
            {
                header('HTTP/1.1 401 UNAUTHORIZED');
                $response['status'] ='401_UNAUTHORIZED' ;
                $response['data'] = array("success_flag" => 1 , "message" => 'UNAUTHORIZED' );
                echo json_encode($response) ;  
                exit();  
            }
            else
           {
        

             if (!isset($_POST['feedback']) || !isset($_POST['stars']) )
             {
                header('HTTP/1.1 400 Bad Request');
                $response['status'] = '400_Bad_Request' ;
                $response['data'] = array("success_flag" => 0 , "message" => 'Missed api parameters.' );
                echo json_encode($response) ; 
                exit();
             }
             else
             {
                  

                        
                        $query=     "INSERT INTO `clsonlin_core`.`user_testimonials`  (`id` , `user_id`, `rate`, `feedback`) VALUES ( (select max(id)+1 from user_testimonials as D )  ,'".$_SESSION['UserId']."', '".$_POST['stars']."', '".$_POST['feedback']."');" ;
                        mysqli_query($conn , $query);

                        header('HTTP/1.1 200 SUCCESS');
                        $response['status'] ='200_SUCCESS' ;
                        $response['data'] = array("success_flag" => 2 , "message"=> 'done' );
                        echo json_encode($response) ;  
                        exit();  
                       
            }
                  
 

                 
                
            }
            



          }
                    

        }
        catch (\Throwable $post_logic)
        {
            header('HTTP/1.1 500 Internal Server Error');
            $response['status'] =  '500_Internal_Server_Error' ;
            $response['data'] = array("success_flag" => 0 , "message" => $post_logic->getMessage() ) ;
            echo json_encode($response) ; 
            exit();  
        }
        
    }
else 
    {
        header('HTTP/1.1 400 Bad Request');
        $response['status'] = '400_Bad_Request' ;
        $response['data'] = array("success_flag" => 0 , "message" => 'UNDEFINED RESTFUL METHOD' );
        echo json_encode($response) ; 
        exit();
    }
    


?>