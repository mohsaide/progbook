<?php

session_start(); 
if(isset($_SESSION['AuthToken']) && isset($_SESSION['UserId']))
{
    
    include 'connection.php';
    $set_auth = "select * from user_auth where user_id = '".$_SESSION['UserId']."' and value = '".$_SESSION['AuthToken']."'  ;" ;
    
    $rs = mysqli_query($conn, $set_auth);
    if (mysqli_num_rows($rs) == 0)
    {
        header("Location:/assets/html/401.php");
    }
    else
    {
        include 'header.php' ;
    }
    
}
else
{
    header("Location:/assets/html/401.php");
}

?>

<?php

if ( isset($_GET['userid']) )
{

    $query = "select if (   ".$_GET['userid']." in (select friend_id from user_friend where user_id =".$_SESSION['UserId']." AND blocked = '0' ) , 'OK' , 'ERROR' ) as FR_FLAG ;" ;
    $rs = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($rs);
    $flag = $row['FR_FLAG'];

    
    if ($flag === 'OK')
    {
        
        try{    $hover_script=" document.getElementById('".$_GET['userid']."').classList.add('active')";
                $disabled_flag= '';
                $query ='select user.image img , concat(first_name , " " , last_name) name from user where id = "'.$_GET['userid'].'" ;';
                $rs = mysqli_query($conn , $query);
                $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
                $user_img='../../../assets/img/user/'.$row['img'];
                $user_name =  $row['name'];
                
                $query= 'select content msg , if (message.sender_id = "'.$_SESSION['UserId'].'" , "ME" , "OTHER" ) src , DATE_FORMAT( message.created , "%M %d, %y") crtd from user_friend_message 
                left join user_friend on user_friend_id = user_friend.id and user_friend_message.deleted = "0"
                left join message on message_id = message.id
                where user_friend_message.deleted = "0" and blocked = "0" and user_friend.friend_id = "'.$_GET['userid'].'"  and user_friend.user_id = "'.$_SESSION['UserId'].'" order by message.created asc;';
                $rs = mysqli_query($conn , $query);
                $messages = array();
                $counter = mysqli_num_rows($rs);
                for ($i = 0; $i < $counter ; $i++)
                {
                $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
                $message = array("msg"=>  $row["msg"] , "src"=>  $row["src"] , "crtd"=>  $row["crtd"] );
                $messages[] = $message ;
                }
                $content = '';
                
                foreach ($messages as $message) {
                                                      if ( $message["src"] == 'ME')
                                                      {
                                                              $item ='<li class="clearfix">
                                                                    <div class="message-data">
                                                                    </div>
                                                                    <div class="message text-left my-message">'.$message["msg"].' <br> <small>'.$message["crtd"].'</small></div>
                                                                  </li>';
                                                          
                                                      }
                                                      else //  $message["src"] == 'OTHER'
                                                      {
                                                     
                                                                  
                                                                   $item ='<li class="clearfix">
                                                                        <div class="message-data text-right">
                                                                        <img src="'.$user_img.'" alt="avatar">
                                                                        </div>
                                                                        <div class="message text-left other-message float-right">'.$message["msg"].'<br> <small>'.$message["crtd"].'</small></div>
                                                                   </li>';
                                                          
                                                          
                                                         
                                                      }
                                                   
                                                    $content .= $item;
                                                }
                
                
        }
         catch (\Throwable $logic)
        {
            
             echo '<script> window.location.href = "http://clsonline.org/assets/html/500.php";</script>' ;
            
        }



    }
    else
    {
         echo '<script> window.location.href = "http://clsonline.org/assets/html/404.php";</script>' ;
    }
} 
else 
{
  $hover_script="document.getElementById('0').classList.add('active')";    
  $disabled_flag= 'disabled';
  $user_img='../../../assets/img/logo.jpg';
  $user_name = 'CLS';
  $query ='select first_name name from user where id = "'.$_SESSION['UserId'].'" ;';
                $rs = mysqli_query($conn , $query);
                $row = mysqli_fetch_array($rs, MYSQLI_ASSOC);
                
  $content ="  <li class='clearfix'>
               <div class='message-data text-right'>
               <img src='../../../assets/img/logo.jpg' alt='avatar'>
               </div>
               <div  class='message text-left other-message float-right'>Hi ".$row['name']." , Feel free to contact with us from <a class=' text-primary ' href='mailto:mohammad2001saide@gmail.com'>here.</a> <br> <small> Now.</small></div>
               </li>" ;
}

?>

    <link href="../css/inbox.css" rel="stylesheet">

                <!-- Begin Page Content -->
                <div class="container-fluid  pb-4">
                 
                    <div class="container">
                        <div class="row clearfix" >
                            <div class="col-lg-12"  >
                                <div class="card chat-app logo_icon" >

                                    <!-- people list -->
                                    <div id="plist" class="people-list" >


                                        <ul class="list-unstyled chat-list mt-2 mb-0 bg-light" id ='friendsList' style="height:67vh; overflow-y:scroll;">
                                            
                                         <li class="clearfix friend" id ='0'  onclick="window.location.href = 'http://clsonline.org/dashboard/assets/html/inbox.php';">
                                              <img src="../../../assets/img/logo.jpg" class='logo_icon'  alt="cls">
                                              <div class="about">
                                                  <div class="name">CLS</div>
                                                  <div class="status"> <i class="fa fa-circle online"></i> online </div>                                            
                                              </div>
                                          </li>
                                          
                                        </ul>
                                        
                                    </div>


                                    <div class="chat_elements bg-light mt-4 me-5" >

                                    <div class="chat" id='chat' >

                                     <!--element 1 - header -->
                                    <div class="chat-header clearfix rounded-left"  style='background: linear-gradient(to bottom right, #19756D, #46B9A4);'>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <a href="http://localhost/dashboard/html/profile.php?UserId=0">
                                                        <img id='chat_header_img' src="<?php echo $user_img ?>" alt="avatar">
                                                    </a>
                                                    <div class="chat-about">
                                                        <h6 class="pt-3 text-light" id='chat_header_text'> <?php echo $user_name ?> </h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 hidden-sm text-right">
                                                    <a href="javascript:void(0);" class="btn btn-primary "><i class="fa fa-cogs"></i></a>
                                                </div>
                                            </div>
                                        </div>


                                     <!--element 2 - content -->
                                    <div class="chat-history" id="chat-history" style="height:50vh; overflow-y:scroll;" >
                                            <ul class="m-b-0" id='chat_messages'>

                                                      <?php echo $content ?>
                            
                                            </ul>


                                        </div>

                                     
                                     <!--element 3 - input form  -->
                                    <form class="chat-message clearfix ">
                                            <div class="input-group mb-0">
                                                <div class="input-group-prepend">
                                                <button <?php echo $disabled_flag ?> id='send_btn' onclick='send(event)'  class="input-group-text btn btn-primary"> <i class="bi bi-send-fill"></i> </button>
                                                </div>
                                                <input id='plain_text' type="text"  autocomplete="off" class="form-control" <?php echo $disabled_flag ?> placeholder="Enter your text here ...">                                    
                                            </div>
                                    </form>
                                        
                                    </div>
                                
                                    </div>




                                </div>
                            </div>
                        </div>
                        </div>
                
                </div>

                <!-- End Page Content -->
                </div>
            
                </div>
                <!-- /.container-fluid -->

                <script defer  src='../js/inbox.js'></script>



<?php
include 'footer.php';
?>