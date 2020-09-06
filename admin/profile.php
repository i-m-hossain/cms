<?php include "includes/admin_header.php" ?>
<?php include "includes/function.php" ?>
 
<?php ob_start() ?>
  
   <?php
    
        if(isset($_SESSION['username'])){
            
            $username= $_SESSION['username'];
            
            $query = "SELECT * FROM users WHERE username= '{$username}'";
            
            $query_profile = mysqli_query($connection, $query);
            
            confimQuery($query_profile);
            
            while($row = mysqli_fetch_assoc($query_profile)){
                
                $user_id        = $row['user_id'];
                $username       = $row['username'];
                $user_password  = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname  = $row['user_lastname'];
                $user_email     = $row['user_email'];
                $user_image     = $row['user_image'];
                //$user_role      = $row['user_role'];

              
                
            }
            
            
        }

    ?>
    
    
    
        <?php               
                                        
            if(isset($_POST['update_profile'])){


                // $username = $_POST['username'];
                $user_password  = $_POST['user_password'];
                $user_firstname = $_POST['user_firstname'];
                $user_lastname  = $_POST['user_lastname'];
                $user_email     = $_POST['user_email'];

                $user_image     = $_FILES['image']['name'];
                $user_image_tmp = $_FILES['image']['tmp_name'];

                //$user_role      = $_POST['user_role'];
                //$date = date('d-m-y');
                //$post_comment_count = 4;


                move_uploaded_file($user_image_tmp, "../images/$user_image");


                if(empty($user_image)) {

                    $query = "SELECT * FROM users WHERE username = '$username' ";
                    $select_image = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_array($select_image)) {

                        $user_image = $row['user_image'];
                        
                    }
                 }

            //Query Update User

            $query=" UPDATE users SET   user_password= '$user_password', user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_email = '$user_email', user_image = '$user_image', user_role = '$user_role' WHERE username =  '$username' ";


            $queryEditUsers=mysqli_query($connection, $query);

            confimQuery($queryEditUsers);
        
            echo " The user information is updated";
        
            }

        ?>

  
 
    <div id="wrapper">
    
        <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to the Admin page
                            <small>
                           
                            </small>
                        </h1>
                   
                  
                        <form action="" method="post" enctype= "multipart/form-data">

                           <!--
                           <div class="form-group">
                               <label for="username">Username</label>
                               <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                           </div>
                           
                           -->
                           <div class="form-group">
                               <label for="firstname">First Name</label>
                               <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
                           </div>
                           
                            <div class="form-group">
                               <label for="lastnamer">Last Name</label>
                               <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                           </div>
                           

                           <div class="form-group">
                               <label for="email">Email</label>
                               <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                           </div> 
                           
                            <div class="form-group">
                               <label for="password">User Password</label>
                               <input type="password" autocomplete="off" class="form-control" name="user_password">
                           </div>
                           
                          

                           <div class="form-group">
                               <label for="user_image">User Image</label>
                               <img width= 100 src="../images/<?php echo $user_image ?>" alt="image">
                               <input type="file" name="image">
                           </div>  
                           
                           


                          <!-- <div class="form-group">

                               <label for="user_role"> User Role</label> <br>

                                  <select  name="user_role" id="">

                                     <option value="Admin"><?php // echo " $user_role"; ?></option>

                                      <?php
                                           // if($user_role == 'Admin'){

                                               // echo "<option value='Subscriber'> Subscriber</option>";
                                            //}else{
                                                //echo "<option value='Admin'>Admin</option>";


                                           // }

                                        ?>


                                   </select>

                           </div> -->




                           <div class="form-group">
                               <label for=""></label>
                               <input class="btn btn-primary" type="submit" name="update_profile"  value="Update Profile">
                           </div>






                        </form>
                                          
                                          
                                          
                                          
                                          
                                           
                        
                        
                    </div>
                          
                </div>
                <!-- /.row --> 

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>