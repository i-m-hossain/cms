    <?php include "includes/db.php" ?>
    <?php include "includes/header.php" ?>

    <!-- Navigation -->
    
    <?php include "includes/navigation.php" ?>
    <?php include "includes/function.php" ?>
   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               
                <?php
                
                if(isset($_POST['submit'])){
                    
                    $search = $_POST['search'];

                    $query= "SELECT * FROM posts WHERE post_tags LIKE '%$search%'" ;
                    $search_query = mysqli_query($connection,$query);
                    confimQuery($search_query);

                    $count= mysqli_num_rows($search_query);
                    if ($count == 0){
                        echo "<h1> No result found </h1>";
                

                    }
                    else{
                    echo $count." result found";    
                    while($row = mysqli_fetch_assoc($search_query)){
                        
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tags'];
                        $post_status = $row['post_status'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_view_count = $row['post_view_count'];
                        
                ?>
                        
                        
                    <h1 class="page-header">
                        Post
                        
                    </h1>
                    

                    <!-- First Blog Post -->
                    <h2>
                        <p href="#"><?php echo $post_title; ?></p>
                    </h2>
                    <p class="lead">
                        by <a href="author_post.php?p_author=<?php echo $post_author;?>"><?php echo $post_author;?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo "Posted on ". $post_date; ?></p>
                    <hr>
                    <p class="lead">
                        Post tags: <a href="#"><?php echo $post_tags;?></a>
                    </p>
                    
                    
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=" This is a picture">
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

         <?php  }   


                    }
            
                }
           ?>  
                
                
            </div>
            

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php" ?>
            
            

        </div>
        <!-- /.row -->

        <hr>
        
    <?php include "includes/footer.php" ?>

        