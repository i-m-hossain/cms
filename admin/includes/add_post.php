

<?php

if(isset($_POST['create_post'])){
    
    
    $post_title         = escape($_POST['post_title']);
    $post_category_id   = escape($_POST['post_category_id']);
    $post_author        = escape($_POST['post_author']);
    $post_status        = escape($_POST['post_status']);

    $post_image         = escape($_FILES['image']['name']);
    $post_image_tmp     = escape($_FILES['image']['tmp_name']);
    
    $post_tags          = escape($_POST['post_tags']);
    $post_content       = escape($_POST['post_content']);
    $post_date          = escape(date('d-m-y'));
    
    
         
    move_uploaded_file($post_image_tmp, "../images/$post_image");
    
    //Query Add Post
    
    $query  = "INSERT INTO posts( post_title, post_category_id,";
    $query .= "post_author, post_status, post_image, post_tags,";
    $query .= " post_content, post_date) " ;
    $query .= " VALUES('$post_title', $post_category_id, '$post_author',";
    $query .= "'$post_status','$post_image', '$post_tags', '$post_content',  now() )";
    
    $queryAddpost=mysqli_query($connection, $query);
    confimQuery($queryAddpost);
    
    
    //viewing the post just created
    
    $the_post_id= mysqli_insert_id($connection);
    
    echo " <p class= 'bg-success'> Post Created:<a href='../post.php?p_id= $the_post_id'> View post </a> or <a href='posts.php'> Edit more posts</a> </p> ";

    
    
    
}
    



?>


<form action="" method="post" enctype= "multipart/form-data">
   
   <div class="form-group">
       <label for="title">Post Title</label>
       <input type="text" class="form-control" name="post_title">
   </div>
     
   <div class="form-group">
       
       <label for="post_category_id">Category </label> <br>
       
          <select name="post_category_id" id="">
           
              <?php

                $query = "SELECT * FROM categories ";
                $select_categories = mysqli_query($connection,$query);

                confimQuery($select_categories);

                while($row = mysqli_fetch_assoc($select_categories )) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];


                    //if($cat_id == $post_category_id) {


                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";


                   //} else {

                     //echo "<option value='{$cat_id}'>{$cat_title}</option>";


                   //}

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


                    echo "<option value='{$user_id}'>{$username}</option>";

                }

              ?>
           
        
           </select>

   </div>
     
      
   <div class="form-group">
       <label for="post_status"> Post Status </label> <br>
       
          <select name="post_status" id="">
           
                <option value=''>Select Option</option>
                <option value='Draft'>Draft</option>
                
                <option value='Published'>Published</option> 

        
           </select>

   </div>
    
    
   <div class="form-group">
       <label for="post_image">Post Image</label>
       <input type="file" name="image">
   </div>
      
   <div class="form-group">
       <label for="post_tags">Post Tags</label>
       <input type="text" class="form-control" name="post_tags">
   </div>

    
   <div class="form-group">
       <label for="post_content">Post Content</label>
       <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">
           
       </textarea>
   </div>
   
   <div class="form-group">
       <label for=""></label>
       <input class="btn btn-primary" type="submit" name="create_post"  value="Publish Post">
   </div>
   
  
    
    
    
    
</form>