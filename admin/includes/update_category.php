
                            
                             <form action="" method="POST">
                               
                                <div class="form-group">
                                  
                                    <label for="cat-title">Edit category</label>
                                       
                                        <?php //fetching the dta in the update category field 
                               
                                            if(isset($_GET['edit'])){

                                                $cat_id = $_GET['edit'];
                                                
                                                $query_edit= "SELECT * FROM categories WHERE cat_id  = $cat_id"; 
                                                $query_edit_con= mysqli_query($connection, $query_edit);
                                                
                                                
                                                while($row = mysqli_fetch_assoc($query_edit_con)){

                                                    $cat_id = $row['cat_id'];
                                                    $cat_title = $row['cat_title'];
                                                    
                                                    ?>
                                     <input type="text" value="<?php if(isset($cat_title)) {echo "$cat_title";} ?>" class="form-control" name="cat_title">  
                                               
                                        <?php   }} ?>
                                        
                                        
                                         <?php  //update query
                                                
                                   
                                             if(isset($_POST['update_category'])){

                                                $cat_title = $_POST['cat_title'];  

                                                $stmt=mysqli_prepare($connection,"UPDATE categories SET cat_title= ? WHERE cat_id= ?");

                                                mysqli_stmt_bind_param($stmt, 'si', $cat_title, $cat_id);
                                                mysqli_stmt_execute($stmt);

                                                if(!$stmt){

                                                    die ('Error'. mysqli_error($connection));
                                                }
                                              
                                             }
                                        ?> 
                                        
                                      
                                  
                                </div>
                                    
                                <div class="form-group">
                                   
                                    <input type="submit" class=" btn btn-primary" name="update_category" value="Update Category">
                                   
                                    
                                </div>
                                 
                               
                                
                            </form> 
                        