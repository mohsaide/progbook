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
        

             if (!isset($_POST['userid']) || !isset($_POST['type']) )
             {
                header('HTTP/1.1 400 Bad Request');
                $response['status'] = '400_Bad_Request' ;
                $response['data'] = array("success_flag" => 0 , "message" => 'Missed api parameters.' );
                echo json_encode($response) ; 
                exit();
             }
             else
             {
                 if ($_POST['type'] == 'ADD' || $_POST['type'] == 'UNADD' || $_POST['type'] == 'BLOCK' ||  $_POST['type'] == 'UNBLOCK' )
                 {
                     

                  if  ($_POST['type'] == 'ADD')
                  {   
                         
                        $query=     "INSERT INTO `clsonlin_core`.`user_friend` (`user_id`, `friend_id`, `blocked`) VALUES ( '".$_POST['userid']."' , '".$_SESSION['UserId']."' , '0');";
                        mysqli_query($conn , $query);
                        $query=     "INSERT INTO `clsonlin_core`.`user_friend` (`friend_id`, `user_id`, `blocked`) VALUES ( '".$_POST['userid']."' , '".$_SESSION['UserId']."' , '0');";
                        mysqli_query($conn , $query);
                        $noti = "INSERT INTO `clsonlin_core`.`user_notifications` ( `id` ,  `user_id`, `title`, `value`, `deleted`, `seen`, `created`) VALUES ( default , '".$_POST['userid']."' , 'New Friend!', concat((select concat(first_name , ' ', last_name) from user where id = '".$_SESSION['UserId']."') , ' has added you.' ), '0', '0', now() );";
                        mysqli_query($conn , $noti );
                        header('HTTP/1.1 200 SUCCESS');
                        $response['status'] ='200_SUCCESS' ;
                        $response['data'] = array("success_flag" => 2 , "message"=> 'done' );
                        echo json_encode($response) ;  
                        exit();  
                       
                  }
                   if  ($_POST['type'] == 'UNADD')
                  {
                       
                        $query=     "delete from user_friend where user_id = '".$_POST['userid']."' and friend_id  = '".$_SESSION['UserId']."' or user_id = '".$_SESSION['UserId']."' and friend_id = '".$_POST['userid']."' " ;
                        mysqli_query($conn , $query);
                        $query=     "commit;" ;
                        mysqli_query($conn , $query);
                        

                        header('HTTP/1.1 200 SUCCESS');
                        $response['status'] ='200_SUCCESS' ;
                        $response['data'] = array("success_flag" => 2 , "message"=> 'done' );
                        echo json_encode($response) ;  
                        exit();   
                       
                  }
                   if  ($_POST['type'] == 'BLOCK')
                  {
                       
                        $query = "update user_friend set blocked = '1' where user_id = '".$_SESSION['UserId']."' and friend_id = '".$_POST['userid']."' ; ";
                        // OR  friend_id = '".$_SESSION['UserId']."' and  user_id  = '".$_POST['userid']."'
                        mysqli_query($conn , $query);

                    
                        header('HTTP/1.1 200 SUCCESS');
                        $response['status'] ='200_SUCCESS' ;
                        $response['data'] = array("success_flag" => 2 , "message"=> 'done' );
                        echo json_encode($response) ;  
                        exit();   
                       
                  }
                   if  ($_POST['type'] == 'UNBLOCK')
                  {
                       
                        $query = "update user_friend set blocked = '0' where user_id = '".$_SESSION['UserId']."' and friend_id = '".$_POST['userid']."' OR  friend_id = '".$_SESSION['UserId']."' and  user_id  = '".$_POST['userid']."' ; ";
                        mysqli_query($conn , $query);
                        

                        header('HTTP/1.1 200 SUCCESS');
                        $response['status'] ='200_SUCCESS' ;
                        $response['data'] = array("success_flag" => 2 , "message"=> 'done' );
                        echo json_encode($response) ;  
                        exit();   
                       
                  }
                  else
                  {
                      echo 'not ok'; 
                  }
                   
 
                 }
                 else
                 {
                     
                    header('HTTP/1.1 404 Not Found');
                    $response['status'] = '404_Not_Found' ;
                    $response['data'] = array("success_flag" => 0 , "message" => 'Api parameters are not ok.' );
                    echo json_encode($response) ; 
                    exit();
                     
                 }
                 
                
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