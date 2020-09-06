
<?php
 
  
  if(isset($_POST['checkBoxArray'])){
      
    foreach($_POST['checkBoxArray'] as $postvalueID){
        
        $bulk_options=  $_POST['bulkoptions'];
        
        
        switch($bulk_options){
        
            case 'Published':
                
                $query = "UPDATE posts SET post_status= '{$bulk_options}' WHERE post_id = $postvalueID";
                $query_update_publish= mysqli_query($connection, $query);
                confimQuery($query_update_publish);
                
                break;
                
            case 'Draft':
                
                $query = "UPDATE posts SET post_status= '{$bulk_options}' WHERE post_id = $postvalueID";
                $query_update_draft= mysqli_query($connection, $query);
                confimQuery($query_update_draft);
               
                break;
                
            case 'Deleted':
                
                $query = "DELETE  FROM posts WHERE post_id = $postvalueID";
                $query_delete= mysqli_query($connection, $query);
                confimQuery($query_delete);
                break;
                
            case 'clone':
                
                $query = "SELECT * FROM posts WHERE post_id = '$postvalueID'";
                
                $select_post_query = mysqli_query($connection, $query);
                confimQuery($select_post_query);
                
                while($row= mysqli_fetch_array($select_post_query)){
                    
            
                     $post_title         = $row['post_title'];
                     $post_author        = $row['post_author'];
                     $post_category_id   = $row['post_category_id'];
                     $post_status        = $row['post_status'];
                     $post_image         = $row['post_image'];
                     $post_tags          = $row['post_tags'];
                     $post_comment_count = $row['post_comment_count'];
                     $post_date          = $row['post_date'];
                     $post_content       = $row['post_content'];
                    
                    
                }
                
                $query  = "INSERT INTO posts( post_title,";
                $query .= "post_author,";
                $query .= "post_category_id,"; 
                $query .= "post_status,"; 
                $query .= "post_image,"; 
                $query .= "post_tags,";
                $query .= "post_date,";
                $query .= "post_content )" ;
                $query .= "VALUES('$post_title',"; 
                $query .= "'$post_author',"; 
                $query .= " $post_category_id,"; 
                $query .= "'$post_status',"; 
                $query .= "'$post_image',"; 
                $query .= "'$post_tags',"; 
                $query .= " now(),"; 
                $query .= "'$post_content')";
    
                $clone_query=mysqli_query($connection, $query);
    
                confimQuery($clone_query);
                
                
                
                break;
            
              
                }
        
        
    }
      
      
      
  }
  
?>


 <form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-4">
        
            <select class="form-control" name="bulkoptions" id="">
                
                <option value=""> Select options </option>
                <option value="Published"> Publish </option>
                <option value="Draft"> Draft </option>
                <option value="Deleted"> Delete </option>
                <option value="clone"> Clone </option>
                
                    
            </select>
                    
            
        </div>
        <div class="col-xs-4">
         
          
            <input type="submit" class="btn btn-success" name="submit" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add new</a>  
            
        </div>
        
        <thead>
            <tr>
               
                <th> <input type="checkbox" id="selectAllBoxes"> </th>
                <th> Id </th>
                <th> Title </th>
                <th> Author </th>
                <th> Category  </th>
                <th> Status </th>
                <th> Image </th>
                <th> Tag </th>
                <th> Comment Count </th>
                <th> Date </th>
                <th> View post </th>
                <th> Post view count</th>
                <th> Edit </th>
                <th> Delete </th>
                
            </tr>
        </thead>


        <tbody>

           <?php
               
                
               /*** JOINING Table posts and Categories****/

                $query  = "SELECT  posts.post_id, posts.post_title, posts.post_author, posts.post_category_id, posts.post_status, posts.post_image,
                          posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_view_count, posts.post_content, categories.cat_id, categories.cat_title
                          FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";
                
            
                $query_posts = mysqli_query($connection,$query);
                confimQuery($query_posts);


                while($row = mysqli_fetch_array($query_posts)){

                     $post_id            = $row['post_id'];
                     $post_title         = $row['post_title'];
                     $post_author        = $row['post_author'];
                     $post_category_id   = $row['post_category_id'];
                     $post_status        = $row['post_status'];
                     $post_image         = $row['post_image'];
                     $post_tags          = $row['post_tags'];
                     $post_comment_count = $row['post_comment_count'];
                     $post_date          = $row['post_date'];
                     $post_view_count    = $row['post_view_count'];
                     $post_content       = $row['post_content'];
                     $cat_id             = $row['cat_id'];
                     $cat_title          = $row['cat_title'];

             echo "<tr>";
                
            ?>
                   
                    <td> <input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'> </td>
                     
            <?php                         

                 echo "<td> $post_id </td>";
                 echo "<td> $post_title </td>";

                 echo "<td> $post_author </td>";

                 // post category
                // $query = "SELECT * FROM categories WHERE cat_id= $post_category_id ";
                 //$select_categories = mysqli_query($connection,$query);

                 //confimQuery($select_categories);

                 //while($row = mysqli_fetch_assoc($select_categories )) {
                     //$cat_id = $row['cat_id'];
                    // $cat_title = $row['cat_title'];
                 echo "<td> $cat_title </td>";
                 //}

                 echo "<td> $post_status  </td>";

                 echo "<td> <img width=100 src='../images/$post_image' alt='image'  </td>";
                 echo "<td> $post_tags  </td>";
            
                


                 //post comment count start

                 $query = "SELECT * FROM comments WHERE comment_post_id= $post_id ";
                 $select_comment_query = mysqli_query($connection,$query);
                 confimQuery($select_comment_query);
                 $post_comment_count = mysqli_num_rows($select_comment_query);
                 echo "<td>  $post_comment_count</a></td>";
                    
                 //post comment count end

                 echo "<td> $post_date </td>";
                 echo "<td> <a class='btn btn-primary' href='../post.php?p_id=$post_id'>View post</a></td>";
                 echo "<td> <a  href='posts.php?reset={$post_id}'>$post_view_count</a> </td>";
                 echo "<td> <a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                    
            ?> 
                <form method="post">
                    
                    <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
            
                    <?php
                    echo "<td> <input class='btn btn-danger'  type='submit' name='delete' value='Delete' > </td>";
                    ?>  
                    
                    
                </form>
                <?php        
                    
                // echo "<td> <a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'> Delete</a> </td>";



            echo "<tr>";

              } 

            ?>
                

            <?php

                echo deletePost();//delete post

            ?>
        
            
            
            <!-- post view count reset -->
            
            <?php
            
            if (isset($_GET['reset'])){
                
                $the_post_id = $_GET['reset'];
                
                $query = "UPDATE posts set post_view_count= 0 WHERE post_id= $the_post_id";
                
                $query_reset = mysqli_query($connection, $query);
                
                if(!$query_reset){
        
                        die ("connection failed". mysqli_error($connection));
                         }
                header("Location: posts.php");
                         
                }
                
            ?>
                
            


        </tbody>
    </table>
</form>    