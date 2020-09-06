    
<?php  

    function redirect($location){
        return header("Location:" .$location);
    }

    function confimQuery($result){
        global $connection; 
        if(!$result){

            die ("connection failed". mysqli_error($connection));
            }


    }

    
    function create_comment(){
        
        global $connection;
        
        if(isset($_POST['create_comment'])){

            $the_post_id     = $_GET['p_id'];
            $comment_author  = $_POST['comment_author']; 
            $comment_email   = $_POST['comment_email'] ;
            $comment_content = $_POST['comment_content']; 


            if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){


                $query="INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES  ($the_post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";

                $insert_comment=mysqli_query($connection, $query);
                confimQuery($insert_comment);
                //counting comment
                //$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
                //$select_comment_countt = mysqli_query($connection, $query);
                //if(!$select_comment_countt){

                    //die("query failed". mysqli_error($connection));
                //}

             }else{

                echo "<script> alert('Fields can not be empty') </script>";
             }

           }
    }

    /** checking if the registation parametrs are exist-- check registration.php**/ 

    function usernameExists($username){
        
        global $connection;
        
        $query  = "SELECT username FROM users WHERE username='$username'";
        $result = mysqli_query($connection, $query);
        confimQuery($result);
        
        if(mysqli_num_rows($result)>0){
            
            return true;
        }else{
            return false;
        }
    
    }


    function emailExists($email){
        
        global $connection;
        
        $query  = "SELECT user_email FROM users WHERE user_email='$email'";
        $result = mysqli_query($connection, $query);
        confimQuery($result);
        
        if(mysqli_num_rows($result)>0){
            
            return true;
        }else{
            return false;
        }
    
    }

    function register_user($username, $email, $password){
        
        global $connection;
 
        $username  = mysqli_real_escape_string($connection, $username);
        $email     = mysqli_real_escape_string($connection, $email);
        $password  = mysqli_real_escape_string($connection, $password);
        
        
        //easy way to encrypt password (L26.1)
        $password = password_hash( $password, PASSWORD_BCRYPT, array('cost'=> 12));
        // Query for inserting data
        $query  = "INSERT INTO users(username,";
        $query .= "user_password, user_email, user_role) VALUE('$username',";
        $query .= " '$password', '$email','Subscriber')";

        $query_registration = mysqli_query($connection, $query);
        confimQuery($query_registration);
        echo "<h4 class='text-center'> the data is submitted </h4>"; 

        
     }


    function login_user($username, $password){
        
        global $connection;
        
        $username = trim($username);
        $password = trim($password);
        
        //filtering the user input data
        
        $username = mysqli_real_escape_string($connection, $username); 
        $password = mysqli_real_escape_string ($connection, $password);
        
        
        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_query= mysqli_query($connection, $query);
    
        confimQuery($select_query);
        
        while($row = mysqli_fetch_array($select_query)){

            $db_user_id       = $row['user_id'];
            $db_username      = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_role     = $row['user_role'];
            $db_user_email    = $row['user_email'];

        }
         
        if (password_verify( $password, $db_user_password)){ //(L26.2)
           
           $_SESSION['username']  = $db_username;
           $_SESSION['password']  = $db_user_password;
           $_SESSION['email']     = $db_user_email;
           $_SESSION['id']        = $db_user_id;
           $_SESSION['user_role'] = $db_user_role;
           
           redirect("/cms/admin");
        
       }
        
        else{
            
           redirect("/cms/index.php");
        }
        
    }
        
        
        
    
        
   


    


?>