

<?php

if(isset($_POST['create_user'])){
    
    
    $username       = escape($_POST['username']);
    $user_password  = escape($_POST['user_password']);
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname  = escape($_POST['user_lastname']);
    $user_email     = escape($_POST['user_email']);
    $user_image     = escape($_FILES['image']['name']);
    $user_image_tmp = escape($_FILES['image']['tmp_name']);
    $user_role      = escape($_POST['user_role']);

         
    move_uploaded_file($user_image_tmp, "../images/$user_image");
    
    $user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost'=> 10));//encrypting the password (L26.3)
    
    //Query Add Post
    
    $query  = "INSERT INTO users( username, user_password, user_firstname,";
    $query .= "user_lastname, user_email, user_image, user_role)";
    $query .= "VALUES('$username', '$user_password', '$user_firstname',"; 
    $query .= "'$user_lastname', '$user_email','$user_image','$user_role')";
    
    $queryAddpost=mysqli_query($connection, $query);
    confimQuery($queryAddpost);
    
    echo " User created:". " ". "<a href='users.php'> View users</a>";
    
    
    
}
    



?>


<form action="" method="post" enctype= "multipart/form-data">
   
   <div class="form-group">
       <label for="username">Username</label>
       <input type="text" class="form-control" name="username">
   </div>
   <div class="form-group">
       <label for="user_password">User Password</label>
       <input type="passwod" class="form-control" name="user_password">
   </div>
    
   <div class="form-group">
       <label for="firstname">First Name</label>
       <input type="text" class="form-control" name="user_firstname">
   </div>
   
   <div class="form-group">
       <label for="lastnamer">Last Name</label>
       <input type="text" class="form-control" name="user_lastname">
   </div>
    
   <div class="form-group">
       <label for="email">Email</label>
       <input type="text" class="form-control" name="user_email">
   </div> 
   
   <div class="form-group">
       <label for="user_image">User Image</label>
       <input type="file" name="image">
   </div>  
    
     
   <div class="form-group">
       
       <label for="user_role"> User Role</label> <br>
       
          <select name="user_role" id="user_role">
               
              <option value="Subscriber">Select Option</option>
              <option value="Subscriber">Subscriber</option>
              <option value="Admin">Admin</option>
        
           </select>

   </div>
   
    
   
   
   <div class="form-group">
       <label for=""></label>
       <input class="btn btn-primary" type="submit" name="create_user"  value="Submit User Data">
   </div>
   
  
    
    
    
    
</form>