<?php include('partials/menu.php') ?>

     <!-- Main content section goes here -->

     <div class="main-content">
        
         <div class="wrapper">
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
             <h1>DASHBOARD</h1>
             <div class="col-4 text-center">
                 <h1>5</h1>
                 <br>
                 categories
             </div>
             <div class="col-4 text-center">
                 <h1>5</h1>
                 <br>
                 categories
             </div>
             <div class="col-4 text-center">
                 <h1>5</h1>
                 <br>
                 categories
             </div>
             <div class="col-4 text-center">
                 <h1>5</h1>
                 <br>
                 categories
             </div>
             <div class="clear-fix"></div>
         </div>
     </div>
    <!-- Main content section ends here -->

    <?php include('partials/footer.php')?>