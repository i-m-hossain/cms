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
                

                    $query= "SELECT * FROM posts";
                    $select_post_query = mysqli_query($connection,$query);
                    if(!$select_post_query){
                        die ("QUERY FAILED".mysqli_error($connection));

                    }
                        
                    while($row = mysqli_fetch_assoc($select_post_query)){
                        
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0,100) ;
                        $post_tags = $row['post_tags'];
                        $post_status = $row['post_status'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_view_count = $row['post_view_count'];
                        
                        if($post_status == 'Published'){
                            
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
                                    by <a href="author_post.php?p_author=<?php echo $post_author;?>&p_id=<?php echo $post_id;?>"><?php echo $post_author;?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> <?php echo "Posted on ". $post_date; ?></p>
                                <hr>
                                <a href="post.php?p_id=<?php echo $post_id; ?>">
                                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=" This is a picture">
                                </a>
                                <hr>
                                <p><?php echo $post_content; ?></p>
                                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>

                
                   
                        
                <?php  } } ?>  
                
                
            </div>
            

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php" ?>
            
            

        </div>
        <!-- /.row -->

        <hr>
        
    <?php include "includes/footer.php" ?>

        