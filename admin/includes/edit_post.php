<?php

    
        if(isset($_GET['p_id'])){
        
            $the_post_id = $_GET['p_id'];
            
        }
    
            $query = "SELECT * FROM posts WHERE post_id= $the_post_id";
            $query_posts_by_id = mysqli_query($connection,$query);
            confimQuery($query_posts_by_id);            
            while($row = mysqli_fetch_assoc($query_posts_by_id)){ 
                
                $post_id            = $row['post_id'];                           
                $post_author        = $row['post_author'];
                $post_title         = $row['post_title'];
                $post_category_id   = $row['post_category_id'];
                $post_status        = $row['post_status'];
                $post_image         = $row['post_image'];
                $post_tags          = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date          = $row['post_date'];
                $post_content       = $row['post_content'];
                
                
                if(isset($_POST['update_post'])){
                  
                    $post_title        = escape($_POST['post_title']);
                    $post_category_id  = escape($_POST['post_category_id']);
                    $post_author       = escape($_POST['post_author']);
                    $post_status       = escape($_POST['post_status']);
                    $post_image        = escape($_FILES['image']['name']);
                    $post_image_temp   = escape($_FILES['image']['tmp_name']);
                    $post_tags         = escape($_POST['post_tags']);
                    $post_date         = escape(date('d-m-y'));
                    $post_content      = escape($_POST['post_content']);
                    
                    move_uploaded_file($post_image_temp, "../images/$post_image");
                    
                    if(empty($post_image)) {

                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                        $select_image = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_array($select_image)) {

                           $post_image = $row['post_image'];

                        }
                     }
                         
                    

                    $query_post_update  = "UPDATE posts "; 
                    $query_post_update .= "SET post_title     = '$post_title',"; 
                    $query_post_update .= "post_category_id   = '$post_category_id ',"; 
                    $query_post_update .= "post_author        = '$post_author',";
                    $query_post_update .= "post_status        = '$post_status',";
                    $query_post_update .= "post_image         = '$post_image',"; 
                    $query_post_update .= "post_tags          = '$post_tags',"; 
                    $query_post_update .= "post_date          = '$post_date',";
                    $query_post_update .= "post_comment_count = '$post_comment_count',";
                    $query_post_update .= "post_content       = '$post_content'";
                    $query_post_update .= "WHERE post_id      = $the_post_id"; 

                    $query_update_con = mysqli_query($connection, $query_post_update);

                    confimQuery($query_update_con);

                    echo " <p class= 'bg-success'> Post Created:<a href='../post.php?p_id=$the_post_id'> View post </a> or <a href='posts.php'> Edit more posts</a> </p> ";


                }
            }
            

?>
    
    
 <form action="" method="post" enctype="multipart/form-data" >

    <div class="form-group">
       <label for="title">Post Title</label>
       <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>


     <div class="form-group">

           <label for="post_category_id">Categories ID</label>

              <select name="post_category_id" id="">

                  <?php

                    $query = "SELECT * FROM categories ";
                    $select_categories = mysqli_query($connection,$query);

                    confimQuery($select_categories);

                    while($row = mysqli_fetch_assoc($select_categories )) {
                        $cat_id     = $row['cat_id'];
                        $cat_title  = $row['cat_title'];


                        if($cat_id == $post_category_id) {


                        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";

                        }


                        else {

                            echo "<option value='{$cat_id}'>{$cat_title}</option>";


                        }

                    }

                  ?>


               </select>

    </div>



    <div class="form-group">
       
       <label for="post_author">Post Author</label> <br>
       
          <select name="post_author" id="">
           
              <?php

                $query = "SELECT * FROM users ";
                $select_users = mysqli_query($connection,$query);

                confimQuery($select_users);

                while($row = mysqli_fetch_assoc($select_users)) {
                    $user_id  = $row['user_id'];
                    $username = $row['username'];


                    echo "<option value='{$username}'>{$username}</option>";

                }

              ?>
           
        
           </select>

   </div>


    <div class="form-group">
        <label for="post_status"> Post Status </label> <br>

          <select name="post_status" id="post_status">

                    "<option value='<?php echo "$post_status"; ?>'><?php echo "$post_status"; ?></option>"
                    <?php

                        if ($post_status == 'Draft'){


                            echo "<option  value='Published'> Published </option>";

                        }else{
                            echo "<option  value='Draft'> Draft </option>";
                        }


                    ?>


           </select>

    </div>


    <div class="form-group">
       <label for="post_image">Post Image</label>
       <img width=100 src="../images/<?php echo $post_image?>" alt="image" > 
       <input type="file" name="image">
    </div>

    <div class="form-group">
       <label for="post_tags">Post Tags</label>
       <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>


    <div class="form-group">
       <label for="post_content">Post Content</label>
       <textarea  class="form-control" name="post_content" id="body" cols="30" rows="10">
            <?php echo $post_content; ?>

       </textarea> 
    </div>

    <div class="form-group">
       <label for=""></label>
       <input class="btn btn-primary" type="submit" name="update_post"  value="Update Post">
    </div>




</form>


  

  
  