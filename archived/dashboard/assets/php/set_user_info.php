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

            if(!isset($_POST['fname']) || !isset($_POST['lname']) ||!isset($_POST['phone']) || !isset($_POST['address']) || !isset($_POST['dob']))
            {
                header('HTTP/1.1 400 Bad Request');
                $response['status'] ='400_Bad_Request' ;
                $response['data'] = array("success_flag" => 1 , "message" => 'Required feilds are missed.' );
                echo json_encode($response) ;  
                exit();  
            }
            else 
            {

                $query = 'update user set first_name = "'.$_POST['fname'].'" , last_name = "'.$_POST['lname'].'", phone = "'.$_POST['phone'].'" , city_id = "'.$_POST['address'].'"  , dob= "'.$_POST['dob'].'" where id = '.$_SESSION['UserId'].' ;';
                mysqli_query($conn , $query);
                header('HTTP/1.1 200 SUCCESS');
                $response['status'] ='200_SUCCESS' ;
                $response['data'] = array("success_flag" => 1 , "message" => 'DONE' );
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