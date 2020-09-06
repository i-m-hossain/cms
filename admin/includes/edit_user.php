<?php

    if(isset($_GET['edit'])){

        $the_user_id = $_GET['edit'];

        
        $query = "SELECT * FROM users WHERE user_id = $the_user_id";
        $select_user_data= mysqli_query($connection, $query);
        confimQuery($select_user_data);
    
        while($row = mysqli_fetch_assoc($select_user_data)){
        
            $user_id        = $row['user_id'];
            $username       = $row['username'];
            $user_password  = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname  = $row['user_lastname'];
            $user_email     = $row['user_email'];
            $user_image     = $row['user_image'];
            $user_role      = $row['user_role'];

        }

        // Post request to update user  
        if(isset($_POST['update_user'])){


            $username       =  $_POST['username']; 
            $user_password  =  $_POST['user_password'];
            $user_firstname =  $_POST['user_firstname'];
            $user_lastname  =  $_POST['user_lastname'];
            $user_email     =  $_POST['user_email'];
            $user_image     =  $_FILES['image']['name'];
            $user_image_tmp =  $_FILES['image']['tmp_name'];
            $user_role      =  $_POST['user_role'];
    
            move_uploaded_file($user_image_tmp, "../images/$user_image");


            if(empty($user_image)) {    

                $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
                $select_image = mysqli_query($connection,$query);

                while($row = mysqli_fetch_array($select_image)) {

                   $user_image = $row['user_image'];

                }
            }

            if(!empty($user_password)) {

                $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id ";
                $get_user_query = mysqli_query($connection,$query_password);
                confimQuery( $get_user_query );

                $row = mysqli_fetch_array( $get_user_query);

                $db_user_password = $row['user_password'];


                if($db_user_password != $user_password){

                    $hashed_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost'=> 10));//encrypting the password
                    }   


                //Query Update User

                $query  = "UPDATE users SET "; 
                $query .= "username       = '$username',";
                $query .= "user_password  = ' $hashed_password',";
                $query .= "user_firstname = '$user_firstname',"; 
                $query .= "user_lastname  = '$user_lastname',";
                $query .= "user_email     = '$user_email',";
                $query .= "user_image     = '$user_image',";
                $query .= "user_role      = '$user_role'";
                $query .= "WHERE user_id  = $the_user_id ";


                $queryEditUsers=mysqli_query($connection, $query);

                confimQuery($queryEditUsers);

                echo "User Updated" . " <a href='users.php'>View Users?</a>";


            } // if password is not empty, the new password shall be replaced
        
        }// Post request to update user end

    }else { 


        header("Location: index.php");


      } // If the user id is not present in the URL we redirect to the home page


?>


<form action="" method="post" enctype= "multipart/form-data">
   
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="password">User Password</label>
        <input type="password" autocomplete="off"  class="form-control" name="user_password">
    </div>

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
        <label for="user_image">User Image</label>
        <img width= 100 src="../images/<?php echo $user_image ?>" alt="image">
        <input type="file" name="image">
    </div>  


    <div class="form-group">

        <label for="user_role"> User Role</label> <br>

        <select  name="user_role" id="">

        <option value="<?php echo "$user_role"; ?>"><?php echo "$user_role"; ?></option>

        <?php
            if($user_role == 'Admin'){

                echo "<option value ='Subscriber'> Subscriber</option>";
            }else{
                echo "<option value ='Admin'>Admin</option>";

            }

        ?>


        </select>

    </div>




    <div class="form-group">
        <label for=""></label>
        <input class="btn btn-primary" type="submit" name="update_user"  value="Update">
    </div>
   
  
    
    
    
    
</form>