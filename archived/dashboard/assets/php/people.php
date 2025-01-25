<?php

header('Content-Type: application/json');
error_reporting(E_ALL & ~E_WARNING);
include 'connection.php' ; 
session_start();

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
        

             if (!isset($_GET['type']))
             {
                header('HTTP/1.1 400 Bad Request');
                $response['status'] = '400_Bad_Request' ;
                $response['data'] = array("success_flag" => 0 , "message" => 'Missed api parameters.' );
                echo json_encode($response) ; 
                exit();
             }
             else
             {
                 if ($_GET['type'] == 'con' || $_GET['type'] == 'uncon' || $_GET['type'] == 'block' )
                 {
                   
                   if  ($_GET['type'] == 'con')
                   {
                       
                        $query=     "
                                    select 
                                    user.id user_id , 
                                    concat( first_name, ' ' ,last_name ) name ,
                                    user.image image,
                                    CASE role
                                    WHEN 'OWN' THEN CONCAT('Owner of ' ,university.code )
                                    WHEN 'INST' THEN CONCAT('Instructor at ' , university.code  )
                                    WHEN 'STD' THEN CONCAT('Student at ' , university.code  )
                                    ELSE 'Active member.'
                                    END as ROLE  
                                    from user
                                    left join city on city_id = city.id
                                    left join country on country_id = country.id
                                    left join university_member on university_member.user_id = user.id and university_member.status ='ACTIVE' 
                                    left join university on university_id = university.id
                                    where
                                    user.id in (select friend_id from user_friend where user_id = ".$_SESSION['UserId']." and blocked= '0' )
                                    and user.id not in ( select user_id from user_friend where friend_id = ".$_SESSION['UserId']." and blocked= '1' ) 
                                    and user.id <> 0 ;";
                        
                         $rs = mysqli_query($conn , $query);
                        $data = array();
                        $counter = mysqli_num_rows($rs);
                        for ($i = 0; $i < $counter ; $i++)
                        {
                        $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
                        $message = array("user_id"=>  $row["user_id"] , "name"=>  $row["name"] , "image"=>  $row["image"] ,  "role"=>  $row["ROLE"]   );
                        $data[] = $message ; 
                            
                        }
                        
                        header('HTTP/1.1 200 SUCCESS');
                        $response['status'] ='200_SUCCESS' ;
                        $response['data'] = array("success_flag" => 2 , "message"=> 'done' , "users"=> $data );
                        echo json_encode($response) ;  
                        exit();  
                       
                   }
                   else if ($_GET['type'] == 'uncon')
                   {
                        $query=     "select 
                                    user.id user_id , 
                                    concat( first_name, ' ' ,last_name ) name ,
                                    user.image image,
                                    CASE role
                                    WHEN 'OWN' THEN CONCAT('Owner of ' ,university.code )
                                    WHEN 'INST' THEN CONCAT('Instructor at ' , university.code  )
                                    WHEN 'STD' THEN CONCAT('Student at ' , university.code  )
                                    ELSE 'Active member.'
                                    END as ROLE  
                                    from user
                                    left join city on city_id = city.id
                                    left join country on country_id = country.id
                                    left join university_member on university_member.user_id = user.id and university_member.status ='ACTIVE' 
                                    left join university on university_id = university.id
                                    where user.id in ( select id from user where id not in ( select friend_id from user_friend where user_id =  ".$_SESSION['UserId']." ) ) and user.id <> 0 and user.id <>  ".$_SESSION['UserId']." ;";
                        
                        $rs = mysqli_query($conn , $query);
                        $data = array();
                        $counter = mysqli_num_rows($rs);
                        for ($i = 0; $i < $counter ; $i++)
                        {
                        $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
                        $message = array("user_id"=>  $row["user_id"] , "name"=>  $row["name"] , "image"=>  $row["image"] ,  "role"=>  $row["ROLE"]   );
                        $data[] = $message ; 
                            
                        }
                        
                        header('HTTP/1.1 200 SUCCESS');
                        $response['status'] ='200_SUCCESS' ;
                        $response['data'] = array("success_flag" => 2 , "message"=> 'done' , "users"=> $data );
                        echo json_encode($response) ;  
                        exit();  
                        
                   }
                   else // block
                   {
                       
                        $query=     "select 
                                    user.id user_id , 
                                    concat( first_name, ' ' ,last_name ) name ,
                                    user.image image,
                                    CASE role
                                    WHEN 'OWN' THEN CONCAT('Owner of ' ,university.code )
                                    WHEN 'INST' THEN CONCAT('Instructor at ' , university.code  )
                                    WHEN 'STD' THEN CONCAT('Student at ' , university.code  )
                                    ELSE 'Active member.'
                                    END as ROLE   
                                    from user
                                    left join city on city_id = city.id
                                    left join country on country_id = country.id
                                    left join university_member on university_member.user_id = user.id and university_member.status ='ACTIVE' 
                                    left join university on university_id = university.id
                                    where user.id in (select friend_id from user_friend where user_id = ".$_SESSION['UserId']." and blocked= '1' ) and user.id <> 0 ;";
                                    
                        $rs = mysqli_query($conn , $query);
                        $data = array();
                        $counter = mysqli_num_rows($rs);
                        for ($i = 0; $i < $counter ; $i++)
                        {
                        $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
                        $message = array("user_id"=>  $row["user_id"] , "name"=>  $row["name"] , "image"=>  $row["image"] ,  "role"=>  $row["ROLE"]   );
                        $data[] = $message ; 
                            
                        }
                        
                        header('HTTP/1.1 200 SUCCESS');
                        $response['status'] ='200_SUCCESS' ;
                        $response['data'] = array("success_flag" => 2 , "message"=> 'done' , "users"=> $data );
                        echo json_encode($response) ;  
                        exit();  
                       
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