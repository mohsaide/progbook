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
        

             if (!isset($_POST['friend_id']) || !isset($_POST['msg']) )
             {
                header('HTTP/1.1 400 Bad Request');
                $response['status'] = '400_Bad_Request' ;
                $response['data'] = array("success_flag" => 0 , "message" => 'Missed api parameters.' );
                echo json_encode($response) ; 
                exit();
             }
             else
             {
               if (strlen($_POST['friend_id'])<1 || strlen($_POST['msg'])<1 )  
               {
                
                header('HTTP/1.1 400 Bad Request');
                $response['status'] = '400_Bad_Request' ;
                $response['data'] = array("success_flag" => 0 , "message" => 'One of parameters or both is/are empty.' );
                echo json_encode($response) ; 
                exit(); 
               }
            else
            {
            $msg = str_replace("'", "\'", $_POST['msg']); 
            $msg = str_replace('"', '\"', $msg); 
            $query = 'select max(id)+1 as next from message';  
            $rs = mysqli_query($conn, $query);
            $msg_id = mysqli_fetch_assoc($rs);
            $query = "INSERT INTO `clsonlin_core`.`message`  ( `id` , `content`, `sender_id`, `created`) VALUES (  ".$msg_id['next']." , '".$msg."'  , '".$_SESSION['UserId']."' , now());" ;
            $rs = mysqli_query($conn, $query);
            
            $query = "INSERT INTO `clsonlin_core`.`user_friend_message` ( `user_friend_id`, `message_id`, `deleted`) VALUES 
            ( (select id from user_friend where user_id =".$_SESSION['UserId']." and friend_id = ".$_POST['friend_id']." ) , ".$msg_id['next']." , '0') , 
            ((select id from user_friend where user_id =  ".$_POST['friend_id']." and friend_id =  ".$_SESSION['UserId']." ) , ".$msg_id['next']." , '0');" ;
            $rs = mysqli_query($conn, $query);
            
            
            header('HTTP/1.1 200 SUCCESS');
                $response['status'] ='200_SUCCESS' ;
                $response['data'] = array("success_flag" => 1 , "message" => 'DONE' );
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