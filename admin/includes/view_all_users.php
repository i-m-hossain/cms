
<table class="table table-bordered table-hover">
    <thead>
        <tr>

            <th> User ID </th>
            <th> Username </th>
            <th> Firstname </th>
            <th> Lastname </th>
            <th> Email  </th>
            <th> Image </th>
            <th> User Role </th>
            <th> Change user role to admin </th>
            <th> Change user role to Subscriber </th>
            <th> Edit</th>
            <th> Delete  </th>

        </tr>
    </thead>


    <tbody>

       <?php

            $query = "SELECT * FROM users";
            $query_posts = mysqli_query($connection,$query);


            while($row = mysqli_fetch_assoc($query_posts)){

                 $user_id        = $row['user_id'];
                 $username       = $row['username'];
                 $user_password  = $row['user_password'];
                 $user_firstname = $row['user_firstname'];
                 $user_lastname  = $row['user_lastname'];
                 $user_email     = $row['user_email'];
                 $user_image     = $row['user_image'];
                 $user_role      = $row['user_role'];
                 $user_image     = $row['user_image'];


                echo "<tr>";

                 echo "<td>  $user_id  </td>";
                 echo "<td>  $username  </td>";
                 echo "<td>  $user_firstname </td>";
                 echo "<td>  $user_lastname </td>";
                 echo "<td>  $user_email  </td>";
                 echo "<td>  <img width=100 src='../images/$user_image' alt='image'</td>";

                 echo "<td>  $user_role  </td>";

                //$query= "SELECT * FROM posts where post_id=$comment_post_id";
                // $query_comment_post= mysqli_query($connection,$query);
                //confimQuery($query_comment_post);
                //while($row=mysqli_fetch_assoc($query_comment_post)){

                //    $post_id = $row['post_id'];

                //    $post_title=  $row['post_title'];

                //  echo "<td> <a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                //}

                echo "<td> <a class= 'btn btn-primary' href='users.php?change_to_admin=$user_id'>Change to Admin</a></td>";
                echo "<td> <a class= 'btn btn-primary' href='users.php?change_to_subscriber=$user_id'> Change to subscriber</a> </td>";
                echo "<td> <a class= 'btn btn-info' href='users.php?source=edit_user&edit={$user_id}'> Edit</a> </td>";

        ?>
                <form method="post"> <!-- deleting user by post method  -->
                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>" >
                    <?php echo '<td> <input class= "btn btn-danger" type= "submit" name="delete" value="Delete"</td>'; ?>
                </form>



        <?php
                //echo "<td> <a href='users.php?delete={$user_id}'> Delete</a> </td>";


             echo "<tr>";

            }

        ?>

        <?php //deleting USERS

              deleteuser();//delete USERS

        ?>
        <?php // setting user role to ADMIN

            if(isset($_GET['change_to_admin'])){

                $the_user_id = $_GET['change_to_admin'];

                $query = "UPDATE users SET user_role='Admin' WHERE user_id = $the_user_id";
                $query_admin = mysqli_query($connection, $query);
                confimQuery($query_admin);

               header("location:users.php" ); //for refreshing the page


           }
        ?>
        <?php //setting user role to SUBSCRIER

            if(isset($_GET['change_to_subscriber'])){

                $the_user_id = $_GET['change_to_subscriber'];

                $query = "UPDATE users SET user_role='Subscriber' WHERE user_id = $the_user_id";
                $query_subscriber = mysqli_query($connection, $query);
                confimQuery($query_subscriber);

               header("location:users.php" ); //for refreshing the page


           }
        ?>


    </tbody>
</table>


