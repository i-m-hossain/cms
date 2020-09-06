<?php include "includes/admin_header.php" ?>
<?php include "includes/function.php" ?>
 
<?php ob_start() ?>
  
 
    <div id="wrapper">
    
        <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to the Admin page
                            <small>Author</small>
                        </h1>
                        
                        
                        <!--Inseting data into categoris -->
                        
                        <div class="col-xs-6">
                        
                             <?php  echo insert_categories();?>


                                <form action="" method="post">
                                    <div class="form-group">

                                        <label for="cat_title">Add category</label>
                                        <input type="text" class="form-control" name="cat_title">

                                    </div>
                                    <div class="form-group">

                                        <input type="submit" class=" btn btn-primary" name="submit" value="Add Category">

                                    </div>

                                </form>


                                <!-- Update category and include Query -->

                                <?php 
                                    if(isset($_GET['edit'])){

                                          $cat_id = $_GET['edit'];

                                          include "includes/update_category.php";

                                     }

                               ?>

                    
                        </div>
                            
                            
                        
                        
                        
                        <!--find All categories & delete query from categories -->
                        
                        <div class="col-xs-6"> <!--Adding table -->
                            
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Category Title </th>
                                        <th> Edit </th>
                                        <th> Delete </th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                   <?php //find All categories 
                                    
                                      echo findAllcategories();
                                    ?> 
                                    
                                    <?php // data delete query from categories
                                    
                                        echo deleteCategories();
                                        
                                    
                                    ?>  
                                    
                                </tbody>
                            </table>
                            
                        </div>
            
                        
                        
                    </div>
                          
                </div>
                <!-- /.row --> 

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>