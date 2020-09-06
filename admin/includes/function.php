
<?php

      // pari ni 
     function users_online() {

         if(isset($_GET['onlineusers'])) {

            global $connection;

            if(!$connection) {

                session_start();

                include("../includes/db.php");

                $session = session_id();
                $time = time();
                $time_out_in_seconds = 50;
                $time_out = $time - $time_out_in_seconds;

                $query = "SELECT * FROM users_online WHERE session = '$session'";
                $send_query = mysqli_query($connection, $query);
                $count = mysqli_num_rows($send_query);

                    if($count == NULL) {

                    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");


                    } else {

                    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");


                    }

                $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
                echo $count_user = mysqli_num_rows($users_online_query);


            }






            } // get request isset()


        }

    users_online();



    function confimQuery($result){
        global $connection; 
        if(!$result){

            die ("connection failed". mysqli_error($connection));
            }


    }

    function escape($string){
        
        global $connection;
        return mysqli_real_escape_string($connection, trim($string));
    }


    function insert_categories(){

        global $connection;


        if(isset($_POST['submit'])){

            $cat_title = $_POST['cat_title'];

            if($cat_title == "" || empty($cat_title)){


                echo "This field can not be empty";

            }else{

                //inserting data

                $stmt=mysqli_prepare($connection,"INSERT INTO categories(cat_title) VALUES(?)");

                mysqli_stmt_bind_param($stmt, "s", $cat_title);
                mysqli_stmt_execute($stmt);

                if(!$stmt){

                    die ('Error'. mysqli_error($connection));
               }

            }

        }

     }



    function findAllcategories(){

                global $connection;

                $query = "SELECT * FROM categories";
                $query_categories = mysqli_query($connection,$query);


                while($row = mysqli_fetch_assoc($query_categories)){

                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "</tr>";

                        echo "<td> {$cat_id} </td>";
                        echo "<td> {$cat_title} </td>";
                        echo "<td> <a class= 'btn btn-info' href='admin_categories.php?edit={$cat_id}'>Edit</a></td>";
                    
            ?>
                <form method="post">
                    <input type="hidden" name="cat_id" value="<?php echo $cat_id ?>" >
                    <?php echo '<td> <input class= "btn btn-danger" type= "submit" name="delete" value="Delete"</td>'; ?>
                </form>
                
                
                
            <?php
                        //echo "<td> <a href='admin_categories.php?delete={$cat_id}'>Delete</a></td>";



                    echo "</tr>";

                }



    }

    function deleteCategories(){

        global $connection;

        if(isset($_POST['delete'])){

                    $the_cat_id = $_POST['cat_id'];
                    $query_delete = "DELETE FROM categories WHERE cat_id = $the_cat_id";
                    $query_delete_con = mysqli_query($connection, $query_delete);

                    header("location:admin_categories.php" ); //for refreshing the page


                }

    }

    function deletePost(){

            global $connection;

            if(isset($_POST['delete'])){

                        $post_id = $_POST['post_id'];
                        $query_delete = "DELETE FROM posts WHERE post_id = $post_id";
                        $query_delete_con = mysqli_query($connection, $query_delete);

                        header("location:posts.php" ); //for refreshing the page


                    }


    }

    function deleteComment(){

            global $connection;

            if(isset($_POST['delete'])){

                        $comment_id = $_POST['comment_id'];
                        $query_delete = "DELETE FROM comments WHERE comment_id = $comment_id";
                        $query_delete_con = mysqli_query($connection, $query_delete);

                        header("location:comments.php" ); //for refreshing the page


                    }


    }


    function deleteuser(){

        global $connection;

            if(isset($_POST['delete'])){
                if(isset($_SESSION['user_role'])){
                    if($_SESSION['user_role'] == 'Admin'){

                        $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
                        $query_delete = "DELETE FROM users WHERE user_id = $user_id";
                        $query_delete_con = mysqli_query($connection, $query_delete);

                        header("location:users.php" ); //for refreshing the page
                    
                    


                    }
            }

        }
    }

    
/**** Refactoring the admin dashboard count ***/

    function recordCount($table){
        
        global $connection;

        $query = "SELECT * FROM ". $table ;
        $query_count = mysqli_query($connection, $query);
        $result =  mysqli_num_rows($query_count);
        confimQuery($result);

        return $result;
        
    }

/** Checking the users whether are Admin or not ##check users.php **/ 
    
    function isAdmin($username){
        
        global $connection;
        
        $query = "SELECT user_role FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        confimQuery($result);
        
        $row = mysqli_fetch_array($result);
        
        if($row['user_role']=='Admin'){
            return true;
        }else{
             return false;
            
        
            }
        
        }
    
    
      
   
?>