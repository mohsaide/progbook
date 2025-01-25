<?php
include 'header.php';
$data='';
$query = 'select min(id) mini , max(id) maxi from user ;';
$rs = mysqli_query($conn , $query);
$row = mysqli_fetch_assoc($rs);
             
            if( $_GET['UserId'] >= $row['mini'] && $_GET['UserId'] <= $row['maxi'] )
            {

                try {
                    
                    $query= "select
                    concat( first_name, ' ' ,last_name ) name ,
                     first_name ,
                     last_name ,
                     city_id ,
                     email ,
                     user.image image,
                     dob , 
                     phone ,
                     concat( country.name , ' - ' , city.name ) address,
                    CASE role
                                WHEN 'OWN' THEN CONCAT('  Owner of ' ,university.name )
                                WHEN 'INST' THEN CONCAT('  Instructor at ' , university.name  )
                                WHEN 'STD' THEN CONCAT('  Student at ' , university.name  )
                                ELSE '  Active member in our community'
                    END as ROLE  
                    from user
                    left join city on city_id = city.id
                    left join country on country_id = country.id
                    left join university_member on university_member.user_id = user.id and university_member.status ='ACTIVE' 
                    left join university on university_id = university.id
                    where user.id = '".$_GET['UserId']."' ;" ;
                    $result = mysqli_query($conn, $query);
                    $data = mysqli_fetch_assoc($result);
   

                    $enable_flag = $hidden_flag ='' ;
                    if($_GET['UserId'] != $_SESSION['UserId'])
                    {
                      $enable_flag ='disabled';
                      $hidden_flag = 'hidden';

                    }

                    } catch (\Throwable $th) {


                        echo '<script> window.location.href = "http://clsonline.org/assets/html/500.php"; </script>';
                       
                    }

            }
            else
            {
                 echo '<script> window.location.href = "http://clsonline.org/assets/html/404.php"; </script>';
            }

    



?>



<div class="container-fluid">
                 <link href="../css/profile.css" rel="stylesheet"> 
                 <div class="container rounded bg-primary mt-5 mb-5">
                     <div class="row">

                         <!-- image + email  -->
                         <form class="col-lg-6 border-right" id='personal_from'>

                             <div class="d-flex flex-column align-items-center p-3 py-5">

                                 
                                 
                                    <div id='profileImg' class="rounded-circle" style='width:150px; height:150px; background-image:url("../../../assets/img/user/<?php 
                                    try {
                                    echo $data['image'].'?t='.time();
                                    } catch (\Throwable $th) {

                                       echo 'default.png';
                                    }
                                    ?>");   background-size: cover; background-position: center; background-repeat: no-repeat;'>
                                    
                                    <div <?php echo $hidden_flag ; ?> class ='h-100 w-100 rounded-circle' id='imgCover'>
                                        <a class="mt-5 text-center btn btn-primary profile-button" style='margin-left:55px;' data-toggle="modal" data-target="#chg_prf_img" ><i class="bi bi-pencil"></i></a>
                                    </div>

                                  </div>


                                 <span class="font-weight-bold text-primary"> <?php 
                                    try {
                                    echo $data['name'];
                                    } catch (\Throwable $th) {

                                       echo 'Unknown User';
                                    }
                                    ?> </span><span class="text-black-50"><?php 
                                    try {
                                    echo $data['email'];
                                    } catch (\Throwable $th) {

                                       echo 'anonymise@clsonline.org';
                                    }
                                    ?></span><span> </span>

                                 <div class="row mt-3">
                                     <div class="col-md-6 mt-3"><label class="labels">First Name</label><input pattern="[A-Za-z]+" <?php echo $enable_flag ; ?> required type="text" class="form-control" name='fname' value="<?php 
                                    try {
                                    echo $data['first_name'];
                                    } catch (\Throwable $th) {

                                       echo 'Unknown';
                                    }
                                    ?>"></div>
                                     <div class="col-md-6 mt-3"><label class="labels">Last Name</label><input pattern="[A-Za-z]+" <?php echo $enable_flag ; ?> required type="text" class="form-control" name='lname' value="<?php 
                                    try {
                                    echo $data['last_name'];
                                    } catch (\Throwable $th) {

                                       echo 'User';
                                    }
                                    ?>" ></div>
                                     <div class="col-md-12 mt-3"><label class="labels">Mobile Number</label><input id='phone_input' pattern="[0-9]{10}" placeholder='xxxxxxxxxx' <?php echo $enable_flag ; ?>  type="tel" class="form-control" name='phone'  value="<?php 
                                    try {
                                    echo $data['phone'];
                                    } catch (\Throwable $th) {

                                       echo 'xxxxxxxxxx';
                                    }
                                    ?>"></div>
                                     <div class="col-md-12 mt-3"><label class="labels mt-2">Date of birth</label><input <?php echo $enable_flag ; ?> required type="date" class="form-control" name='dob' min="<?php echo date('Y-m-d', strtotime('-70 years')); ?>" 
       max="<?php echo date('Y-m-d', strtotime('-15 years')); ?>"  value="<?php 
                                    try {
                                    echo $data['dob'];
                                    } catch (\Throwable $th) {

                                       echo '9999-01-01';
                                    }
                                    ?>"></div>
                                     <div class="col-md-12 mt-3">
                                     <label for="address">Country - City</label>
                                         <select <?php echo $enable_flag ; ?> required class="form-control" id="address" name='address' >
                                             <option value ='<?php try {
                                    echo $data['city_id'];
                                    } catch (\Throwable $th) {

                                       echo '57';
                                    }
                                    ?>'> <?php try {
                                    echo $data['address'];
                                    } catch (\Throwable $th) {

                                       echo 'Undefined - Undefined';
                                    }
                                    ?>  </span></option>
                                         </select>
                                    </div>
                                 </div>
                                 

                                 <div class="mt-4 text-center"><button <?php echo $hidden_flag ; ?> class="btn btn-primary profile-button" type="button" onclick="save_profile(event)">
                                 Save Profile</button></div>
                        
                             </div>
                                
                           
                        


                         </form>


                         <div class="col-lg-6 border-right">

                         <div class="p-3 py-5">
                                 <div class="d-flex justify-content-between align-items-center mb-3">
                                     <h4 class="text-right text-primary">My experience</h4>
                                 </div>
                                 
                                 <ul class="list-group list-group-flush">
                                     <li class="list-group-item"> <i class="bi bi-check-lg text-lg" style="color: coral;"></i><?php 
                                    try {
                                    echo $data['ROLE'];
                                    } catch (\Throwable $th) {

                                       echo '  Active member in our community.';
                                    }
                                    ?></li>
                                     
                                   </ul> 


                            </div>
                              </div>

                     </div>
                 </div>
                 </div>
                 </div>
         
             </div>

                          <!-- profile img change Modal-->
                          <div class="modal fade" id="chg_prf_img" tabindex="-1" role="dialog" 
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Let's update it.</h5>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id='UploadImg'>
                                            <div class="form-group">
                                                <div class="square-input">
                                                <input required type="file"  class="form-control-file" name='image' accept="image/*" id="imageUpload">
                                            </div>
                                            </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" onclick="Myclear2(event)" data-dismiss="modal">Cancel</button>
                                            <a class="btn btn-primary" onclick='update_image(event)'>Change</a>
                                        </div>
                                    </div>
                                </div>
                            </div>              
                <script src='../js/profile.js'></script>

<?php
include 'footer.php' ;
?>