<?php


header('Content-Type: application/json');
error_reporting(E_ALL & ~E_WARNING);

 try
{

    include 'connection.php'; 


    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {

         try
        {
           session_start();
           if ( !isset($_SESSION['UserId']) || !isset($_SESSION['AuthToken']) )
           {
            echo 
            header('HTTP/1.1 200 SUCCESS');
            $response['status'] ='200_SUCCESS' ;
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
                header('HTTP/1.1 200 SUCCESS');
                $response['status'] ='200_SUCCESS' ;
                $response['data'] = array("success_flag" => 1 , "message" => 'UNAUTHORIZED' );
                echo json_encode($response) ;  
                exit();  
            }
           else
           {

            if ( !isset($_POST['NewPassword']) || !isset($_POST['Verify']) )
            {

                header('HTTP/1.1 400 Bad Request');
                $response['status'] = '400_Bad_Request' ;
                $response['data'] = array("success_flag" => 0 , "message" => 'Required feilds are missed.' );
                echo json_encode($response) ; 
                exit();

            }
            else
            {

              if ( $_POST['Verify'] !=  $_POST['NewPassword'] )
              {
                
                header('HTTP/1.1 200 SUCCESS');
                $response['status'] ='200_SUCCESS' ;
                $response['data'] = array("success_flag" => 1 , "message" => 'Password and Verify Password do not match.' );
                echo json_encode($response) ;  
                exit(); 
                

              }
              else
              {
                
                $query = "update user set password = '".$_POST['NewPassword']."' where id = '".$_SESSION['UserId']."' " ;
                mysqli_query($conn, $query);

                $email = mysqli_fetch_assoc( mysqli_query( $conn ,"select email from user where id = '".$_SESSION['UserId']."' ;" ))['email'];

                $headers = "From: no-reply@clsonline.org\r\n" .
                         "Reply-To: no-reply@clsonline.org\r\n" .
                         "X-Mailer: PHP/" . phpversion();
                mail( $email , 'Password changed'  , 'Just want to let you know that your password at clsonline.org has been changed.' , $headers) ;


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
    

}
 catch (\Throwable $conn)
{
    header('HTTP/1.1 500 Internal Server Error');
    $response['status'] ='500_Internal_Server_Error' ;
    $response['data'] = array("success_flag" => 0 , "message" => $conn->getMessage() );
    echo json_encode($response) ;  
    exit();
}


?>