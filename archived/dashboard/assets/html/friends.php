<?php
include 'header.php';
?>




<link rel="stylesheet" type="text/css" href="../css/friends.css">

<div class="container-fluid">
      <div class="row">
          
          
        <div class="col-xl-2 bg-light mt-3">
          <h4 class="mt-2">Type</h4>
          <hr />
          <ul class="list-group">
              
            <li class="list-group-item con_type active_con" class='con' id='con' onclick="location.href='http://clsonline.org/dashboard/assets/html/friends.php?TYPE=con'" >
               <i class="bi bi-person-check-fill mr-1" style='font-size:20px;'></i>
              <label >Friends</label>
            </li>
            
            <li class="list-group-item con_type" id='uncon' onclick="location.href='http://clsonline.org/dashboard/assets/html/friends.php?TYPE=uncon'" >
               <i class="bi bi-person-add mr-1" style='font-size:20px;'></i>
              <label >Others</label>
            </li>
            
             <li class="list-group-item con_type" id='block'  onclick="location.href='http://clsonline.org/dashboard/assets/html/friends.php?TYPE=block'" " >
                <i class="bi bi-person-dash mr-1" style='font-size:20px;'></i>
              <label>Blocked</label>
            </li>
            
            
          </ul>
        </div>
        
        
        <div class="col-xl-10 mt-3">
          <h4 class="mt-2">Users</h4>
          <hr />
          
          <div class="row" id='user_cards'>
              

          </div>
          
          
        </div>
        
        
      </div>
</div>



<script src="../js/friends.js"></script>


<?php

if ( isset($_GET['TYPE']) )
{
    if ($_GET['TYPE'] === 'con')
    {
         echo '<script> window.onload = load("con"); </script>' ;
    }
    else if ($_GET['TYPE'] === 'uncon')
    {
        echo '<script> window.onload = load("uncon"); </script>' ;
        
    }
     else if ($_GET['TYPE'] === 'block')
    {
        echo '<script> window.onload = load("block"); </script>' ;
        
    }
    else
    {
         echo '<script> window.location.href = "http://clsonline.org/assets/html/404.php";</script>' ;
    }
} 
else 
{
 echo '<script> window.location.href = "http://clsonline.org/assets/html/404.php";</script>' ;
}

?>



<?php
include 'footer.php' ;
?>