 
<div class="col-md-4">
                
    <!-- Blog Search Well -->

    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search"  type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form> <!-- /.creating form -->
        <!-- /.input-group -->
    </div>


     <!-- Login Well -->

    <div class="well">
       
       
       <!-- login form visibility when looged in or logged out-- using short hand if condition -->
       
       <?php if(isset($_SESSION['user_role'])): ?>
            
            <h4>Logged in as: <?php echo $_SESSION['username'] ?> </h4>
            <a href="includes/logout.php" class="btn btn-primary">Logout</a>
           
        <?php else: ?>
            <h4>Login</h4>
            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <input name="username"  type="text" class="form-control" placeholder="Enter username">

                </div>
                <div class="input-group">

                    <input name="password"  type="password" class="form-control" placeholder="Enter password">
                    <span class="input-group-btn">
                       <button name="login" class="btn btn-default" type="submit">Submit</button>


                    </span>
                </div>
             </form> <!-- /.creating form -->
        <!-- /.input-group -->    
                    
        <?php endif; ?> 
    
    
        
        
       
       
        
    </div>


    <!-- Blog Categories Well -->

     <?php 
        $query = "SELECT * FROM categories LIMIT 10 ";
        $query_categories_sidebar = mysqli_query($connection,$query);
        
        if(!$query_categories_sidebar){
            
            die("connection failed". mysqli_error($connection));
        }

     ?>

    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                   <?php 
                        while($row = mysqli_fetch_assoc($query_categories_sidebar)){
                         $cat_title = $row['cat_title'];
                         $cat_id = $row['cat_id'];

                         echo "<li> <a href='category.php?category=$cat_id'> {$cat_title}</a></li>";
                         }
                    ?>

                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>
</div>