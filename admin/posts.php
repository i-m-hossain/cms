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
                        
                        <?php 
    
    
                            if (isset($_GET['source'])){
                        
                                $source = $_GET['source'];
                                
    
                                }else{
    
    
                                $source = '';

                                }
                                switch ($source){
                                    
                                    
                                    case 'add_post':
                                    include "includes/add_post.php";
                                    break;
                                        
                                    case 'edit_post':
                                    include "includes/edit_post.php";
                                    break;
                                    
                                    case '23':
                                    echo "";
                                    break;
                                    
                                    case '65':
                                    echo "";
                                    break;
                                    
                            
                                    
                                    default:
                                        include "includes/view_all_post.php";
                               
                                
                                }  
                            
                        
                        
                        
                        ?>
                        
                        
                        
                        
                        
                        
                    
                        
                        
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