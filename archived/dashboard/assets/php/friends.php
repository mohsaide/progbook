<?php


header('Content-Type: application/json');
error_reporting(E_ALL & ~E_WARNING);
session_start();
 try
{

    include 'connection.php'; 


    if ($_SERVER['REQUEST_METHOD'] === 'GET')
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

            $query='select user_friend.friend_id as f_id  , if (user_auth.value is null , "offline" , "online" ) status , image , concat (first_name , " " , last_name) name from user_friend
                    left join user_auth on friend_id = user_auth.user_id
                    left join user on friend_id = user.id
                    where user_friend.user_id = "'.$_SESSION['UserId'].'" and blocked = "0" order by user.id asc ;' ;
            $rs = mysqli_query($conn , $query);
            $data = array();
            $counter = mysqli_num_rows($rs);
            for ($i = 0; $i < $counter ; $i++) {
                $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
                $friend = array("id"=>  $row["f_id"] , "status"=>  $row["status"] , "image"=>  $row["image"] , "name"=>  $row["name"]  );
                $data[] = $friend ; 
              }

            header('HTTP/1.1 200 SUCCESS');
            $response['status'] ='200_SUCCESS' ;
            $response['data'] = array("success_flag" => 2 , "metaData"=> array("friends" => $data , 'counter' => $counter) );
            echo json_encode($response) ;  
            exit(); 

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