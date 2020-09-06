    <?php include "includes/db.php" ?>
    <?php include "includes/header.php" ?>

    <!-- Navigation -->
    
    <?php include "includes/navigation.php" ?>
    <?php include "includes/function.php"; ?>
   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               
                <?php
                
                    
    
                    if(isset($_GET['p_author'])){
                        
                      $the_post_author = $_GET['p_author'];
                      
                    }
                
                    
                    $query= "SELECT * FROM posts WHERE post_author = '$the_post_author' ";
                    $select_query = mysqli_query($connection,$query);
                    confimQuery($select_query);
                   
                    while($row = mysqli_fetch_assoc($select_query)){
                        
                        $post_title         = $row['post_title'];
                        $post_author        = $row['post_author'];
                        $post_date          = $row['post_date'];
                        $post_image         = $row['post_image'];
                        $post_content       = $row['post_content'];
                        $post_tags          = $row['post_tags'];
                        $post_status        = $row['post_status'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_view_count    = $row['post_view_count'];
                        
                ?>
                            
                        <h1 class="page-header">
                            Posts
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                             All post by <?php echo $post_author;?>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo "Posted on ". $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=" This is a picture">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <!--<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                        <hr>
                        
                
                   
                         
                <?php  }  ?>  
                
               
                  

                
                
                
                                        
                    

                
                
            </div>
            

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php" ?>
            
            

        </div>
        <!-- /.row -->
        
        
        

        <hr>
        
        
    <?php include "includes/footer.php" ?>

        