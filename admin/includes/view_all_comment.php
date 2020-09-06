                    
                           
                          
                           
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>  Comment ID </th>
            <th>  Post ID </th>

            <th>  Author </th>

            <th>  Email  </th>
            <th>  Content </th>
            <th>  Status </th>
            <th>  In Response To </th>
            <th>  Date </th>
            <th>  Approve </th>
            <th>  Unapprove </th>
            <th>  Delete  </th>

        </tr>
    </thead>


    <tbody>

       <?php

            $query = "SELECT * FROM comments";
            $query_comments = mysqli_query($connection,$query);


            while($row = mysqli_fetch_assoc($query_comments)){

                 $comment_id      = $row['comment_id'];
                 $comment_post_id = $row['comment_post_id'];
                 $comment_author  = $row['comment_author'];
                 $comment_email   = $row['comment_email'];
                 $comment_content = $row['comment_content'];
                 $comment_status  = $row['comment_status'];
                 $comment_date    = $row['comment_date'];


            echo "<tr>";

                 echo "<td> $comment_id  </td>";
                 echo "<td> $comment_post_id  </td>";
                 echo "<td> $comment_author </td>";
                 echo "<td> $comment_email </td>";
                 echo "<td> $comment_content  </td>";
                 echo "<td> $comment_status </td>";
                
                 //for In Response To
                 $query= "SELECT * FROM posts where post_id=$comment_post_id";
                 $query_comment_post= mysqli_query($connection,$query);
                 confimQuery($query_comment_post);
                 while($row=mysqli_fetch_assoc($query_comment_post)){

                    $post_id = $row['post_id'];
                    $post_title=  $row['post_title'];

                    echo "<td> <a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                 }



                echo "<td>$comment_date </td>";


                echo "<td> <a class='btn btn-info' href='comments.php?approve=$comment_id'>Approve</a></td>";
                echo "<td> <a class='btn btn-info' href='comments.php?unapprove=$comment_id'> Unapprove</a> </td>";
                
        ?>
                <form method="post">
                    <input type="hidden" name="comment_id" value="<?php echo $comment_id ?>" >
                    <?php echo '<td> <input class= "btn btn-danger" type= "submit" name="delete" value="Delete"</td>'; ?>
                </form>
                
                
                
        <?php
                
                //echo "<td> <a href='comments.php?delete=$comment_id'> Delete</a> </td>";


            echo "<tr>";

            }

        ?>

        <?php

             echo deleteComment();//delete comment

        ?>
        <?php // setting the status approved

            if(isset($_GET['approve'])){

                $the_comment_id = $_GET['approve'];

                $query = "UPDATE comments SET comment_status='approved' WHERE comment_id = $the_comment_id";
                $query_approve = mysqli_query($connection, $query);
                confimQuery($query_approve);

                header("location:comments.php" ); //for refreshing the page


           }
        ?>
        <?php //setting the status unapproved

            if(isset($_GET['unapprove'])){

                $the_comment_id = $_GET['unapprove'];

                $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id = $the_comment_id";
                $query_approve = mysqli_query($connection, $query);
                confimQuery($query_approve);

                header("location:comments.php" ); //for refreshing the page


           }
        ?>


    </tbody>
</table>
                        
                       
