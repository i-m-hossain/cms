    <?php include "includes/db.php" ?>
    <?php include "includes/header.php" ?>

    <!-- Navigation -->
    
    <?php include "includes/navigation.php" ?>
   
    
 
   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               
                <?php
                    if(isset($_GET['category'])){
                        
                        $post_category_id = $_GET['category'];
                    
                        
                    

                    if(isset($_SESSION) && $_SESSION['user_role'] == 'Admin'){
                        
                        $stmt1= mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date,  post_image, post_content ,post_tags  ,post_status, post_comment_count, post_view_count FROM posts WHERE post_category_id = ?");
                        
                        
                    }else{
                        $stmt2= mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date,  post_image, post_content ,post_tags  ,post_status, post_comment_count, post_view_count FROM posts WHERE post_category_id = ? AND post_status = ?");
                        
                        $published= 'Published';
                    }
                    

                    if(isset($stmt1)){
                        mysqli_stmt_bind_param($stmt1, "i", $post_category_id);//if it is integer type data type 'i' and fo string type 's'
                        mysqli_stmt_execute($stmt1);
                        mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date,  $post_image, $post_content, $post_tags, $post_status, $post_comment_count, $post_view_count);
                        
                        $stmt = $stmt1;
                    }
                     else{
                        mysqli_stmt_bind_param($stmt2, "is", $post_category_id, $published);
                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date,  $post_image, $post_content, $post_tags, $post_status, $post_comment_count, $post_view_count);
                        
                        $stmt = $stmt2;
                    }
                        
                    if(mysqli_stmt_num_rows($stmt) ==0){
                        
                        echo "<h1 class='text-center'> No posts available </h1>";
                        
                        
                    }
                        
                    while(mysqli_stmt_fetch($stmt)):
                        
                
                ?>
                            
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author;?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo "Posted on ". $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=" This is a picture">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                        
                
                   
                        
                    <?php endwhile;}

                    else{
                        
                        header ("Location: index.php");
                    
                    }?>  
                
                
            </div>
            

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php" ?>
            
            

        </div>
        <!-- /.row -->

        <hr>
        
    <?php include "includes/footer.php" ?>

        